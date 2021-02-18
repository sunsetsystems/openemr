<?php
/**
 * compute_line_amounts.inc.php
 *
 * These functions are used by reports that need to allocate payments,
 * adjustments and taxes among the invoice line items.
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see 
 * http://www.gnu.org/licenses/licenses.html#GPL .
 *
 * @package OpenEMR
 * @license http://www.gnu.org/licenses/licenses.html#GPL GNU GPL V3+
 * @author  Rod Roark <rod@sunsetsystems.com>
 * @link    http://www.open-emr.org
 */

// Initialize the $aItems entry for this line item if it does not yet exist.
function ensureItems($invno, $codekey)
{
    global $aItems, $aTaxNames;
    if (!isset($aItems[$invno][$codekey])) {
        // Charges, Adjustments, Payments
        $aItems[$invno][$codekey] = array();
        $aItems[$invno][$codekey]['fee'] = 0;
        $aItems[$invno][$codekey]['adj'] = 0;
        $aItems[$invno][$codekey]['pay'] = 0;
        // Then a slot for each tax type.
        $aItems[$invno][$codekey]['tax'] = array();
        for ($i = 0; $i < count($aTaxNames); ++$i) {
            $aItems[$invno][$codekey]['tax'][$i] = 0;
        }
    }
}

// Get taxes matching this line item and store them in their proper $aItems array slots.
// $id here is S:id or P:sale_id, which matches ndc_info for a tax item.
// $codekey is relevant only for $aItems.
function getItemTaxes($patient_id, $encounter_id, $codekey, $id)
{
    global $aItems, $aTaxNames;
    $invno = "$patient_id.$encounter_id";
    $total = 0;
    $taxres = sqlStatement(
        "SELECT code, fee FROM billing WHERE pid = ? AND encounter = ? AND " .
        "code_type = 'TAX' AND activity = 1 AND ndc_info = ? " .
        "ORDER BY id",
        array($patient_id, $encounter_id, $id)
    );
    while ($taxrow = sqlFetchArray($taxres)) {
        $i = 0;
        $matchcount = 0;
        foreach ($aTaxNames as $tmpcode => $dummy) {
            if ($tmpcode == $taxrow['code']) {
                ++$matchcount;
                $aItems[$invno][$codekey]['tax'][$i] += $taxrow['fee'];
            }
            if ($matchcount != 1) {
                // TBD: This is an error.
                echo "ERROR: invno = '$invno' codekey = '$codekey' matchcount = '$matchcount'\n";
            }
            ++$i;
        }
        $total += $taxrow['fee'];
    }
    return $total;
}

// For a given encounter, this gets all charges and taxes and allocates payments
// and adjustments among them, if that has not already been done.
// Any invoice-level adjustments and payments are allocated among the line
// items in proportion to their line-level remaining balances.
//
function ensureLineAmounts($patient_id, $encounter_id, $def_provider_id=0, $set_overpayments=false)
{
    global $aItems, $aTaxNames, $overpayments;

    $invno = "$patient_id.$encounter_id";
    if (isset($aItems[$invno])) {
        return $invno;
    }

    $adjusts  = 0; // sum of invoice level adjustments
    $payments = 0; // sum of invoice level payments
    $denom    = 0; // sum of adjusted line item charges
    $aItems[$invno] = array();

    // From the billing table get charges, copays and taxes that are not specific
    // to line items. Then plug the service taxes into their line items.
    $tres = sqlStatement(
        "SELECT b.code_type, b.code, b.code_text, b.fee, b.id, " .
        "u.id AS uid, u.lname, u.fname, u.username " .
        "FROM billing AS b " .
        "LEFT JOIN users AS u ON u.id = IF(b.provider_id, b.provider_id, '$def_provider_id') " .
        "WHERE " .
        "b.pid = ? AND b.encounter = ? AND b.activity = 1 AND " .
        "(b.code_type != 'TAX' OR b.ndc_info = '') " .
        "ORDER BY u.lname, u.fname, u.id, b.code_type, b.code",
        array($patient_id, $encounter_id)
    );
    while ($trow = sqlFetchArray($tres)) {
        if ($trow['code_type'] == 'COPAY') {
            $payments -= $trow['fee'];
        }
        else {
            $codekey = $trow['code_type'] . ':' . $trow['code'];
            ensureItems($invno, $codekey);
            $denom += $trow['fee'];
            if ($trow['code_type'] == 'TAX') {
                // If this is a tax, put it in its correct column.
                $i = 0;
                foreach ($aTaxNames as $tmpcode => $dummy) {
                    if ($tmpcode == $trow['code']) {
                        $aItems[$invno][$codekey]['tax'][$i] += $trow['fee'];
                        $trow['fee'] = 0;
                    }
                    ++$i;
                }
            }
            $aItems[$invno][$codekey]['fee'] += $trow['fee'];
            $denom += getItemTaxes($patient_id, $encounter_id, $codekey, 'S:' . $trow['id']);
            $aItems[$invno][$codekey]['dsc']      = $trow['code_text'];
            $aItems[$invno][$codekey]['uid']      = isset($trow['uid']     ) ? $trow['uid']      : '';
            $aItems[$invno][$codekey]['username'] = isset($trow['username']) ? $trow['username'] : '';
            $aItems[$invno][$codekey]['lname']    = isset($trow['lname']   ) ? $trow['lname']    : '';
            $aItems[$invno][$codekey]['fname']    = isset($trow['fname']   ) ? $trow['fname']    : '';
        }
    }

    // Get charges from drug_sales table and associated taxes.
    $tres = sqlStatement(
        "SELECT s.drug_id, s.fee, s.sale_id, s.selector, " .
        "u.id AS uid, u.lname, u.fname, u.username " .
        "FROM drug_sales AS s " .
        "LEFT JOIN users AS u ON u.id = ? " .
        "WHERE s.pid = ? AND s.encounter = ?",
        array($def_provider_id, $patient_id, $encounter_id)
    );
    while ($trow = sqlFetchArray($tres)) {
        $codekey = 'PROD:' . $trow['drug_id'];
        if (!empty($trow['selector'])) {
            $codekey .= ':' . $trow['selector'];
        }
        ensureItems($invno, $codekey);
        $aItems[$invno][$codekey]['fee'] += $trow['fee'];
        $denom += $trow['fee'];
        $denom += getItemTaxes($patient_id, $encounter_id, $codekey, 'P:' . $trow['sale_id']);
        $aItems[$invno][$codekey]['uid']      = isset($trow['uid']     ) ? $trow['uid']      : '';
        $aItems[$invno][$codekey]['username'] = isset($trow['username']) ? $trow['username'] : '';
        $aItems[$invno][$codekey]['lname']    = isset($trow['lname']   ) ? $trow['lname']    : '';
        $aItems[$invno][$codekey]['fname']    = isset($trow['fname']   ) ? $trow['fname']    : '';
    }

    // Get adjustments and other payments from ar_activity table.
    $tres = sqlStatement(
        "SELECT " .
        "a.code_type, a.code, a.adj_amount, a.pay_amount " .
        "FROM ar_activity AS a WHERE a.pid = ? AND a.encounter = ? AND a.deleted IS NULL",
        array($patient_id, $encounter_id)
    );
    while ($trow = sqlFetchArray($tres)) {
        $codekey = $trow['code_type'] . ':' . $trow['code'];
        // ar_activity does not have a selector, which may be relevant for adjustments.
        // So search for a match in $aItems[$invno] ignoring selector.
        $cklen = strlen($codekey);
        $arrkey = '';
        foreach ($aItems[$invno] as $thiskey => $dummy) {
            if ($thiskey == $codekey || (substr($thiskey, 0, $cklen) == $codekey && substr($thiskey, $cklen, 1) == ':')) {
                $arrkey = $thiskey;
                break;
            }
        }
        if ($arrkey) {
            $aItems[$invno][$arrkey]['adj'] += $trow['adj_amount'];
            $aItems[$invno][$arrkey]['pay'] += $trow['pay_amount'];
            $denom -= $trow['adj_amount'];
            $denom -= $trow['pay_amount'];
        }
        else {
            $adjusts  += $trow['adj_amount'];
            $payments += $trow['pay_amount'];
        }
    }

    // Allocate all unmatched payments and adjustments among the line items.
    $adjrem = $adjusts;  // remaining unallocated adjustments
    $payrem = $payments; // remaining unallocated payments
    $nlines = count($aItems[$invno]);
    foreach ($aItems[$invno] AS $codekey => $dummy) {
        if (--$nlines > 0) {
            // Avoid dividing by zero!
            if ($denom) {
                $bal = $aItems[$invno][$codekey]['fee'] - $aItems[$invno][$codekey]['adj'] - $aItems[$invno][$codekey]['pay'];
                for ($i = 0; $i < count($aTaxNames); ++$i) {
                    $bal += $aItems[$invno][$codekey]['tax'][$i];
                }
                $factor = $bal / $denom;
                $tmp = sprintf('%01.2f', $adjusts * $factor);
                $aItems[$invno][$codekey]['adj'] += $tmp;
                $adjrem -= $tmp;
                $tmp = sprintf('%01.2f', $payments * $factor);
                $aItems[$invno][$codekey]['pay'] += $tmp;
                $payrem -= $tmp;
            }
        }
        else {
            // Last line gets what's left to avoid rounding errors.
            $aItems[$invno][$codekey]['adj'] += $adjrem;
            $aItems[$invno][$codekey]['pay'] += $payrem;
        }
    }

    if ($set_overpayments) {
        // For each line item having (payment > charge + tax - adjustment), move the
        // overpayment amount to a global variable $overpayments.
        foreach ($aItems[$invno] AS $codekey => $dummy) {
            $diff = $aItems[$invno][$codekey]['pay'] + $aItems[$invno][$codekey]['adj'] - $aItems[$invno][$codekey]['fee'];
            for ($i = 0; $i < count($aTaxNames); ++$i) {
                $diff -= $aItems[$invno][$codekey]['tax'][$i];
            }
            $diff = sprintf('%01.2f', $diff);
            if ($diff > 0.00) {
                $overpayments += $diff;
                $aItems[$invno][$codekey]['pay'] -= $diff;
            }
        }
    }

    return $invno;
}

function getTaxNames($pid) {
    global $aTaxNames;
    // Get the tax types applicable to this patient.
    $aTaxNames = array();
    $tnres = sqlStatement(
        "SELECT DISTINCT b.code, b.code_text " .
        "FROM billing AS b WHERE " .
        "b.code_type = 'TAX' AND b.activity = '1' AND b.pid = ? " .
        "ORDER BY b.code, b.code_text",
        array($pid)
    );
    while ($tnrow = sqlFetchArray($tnres)) {
        $aTaxNames[$tnrow['code']] = $tnrow['code_text'];
    }
}
