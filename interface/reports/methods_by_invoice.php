<?php
// Copyright (C) 2012 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This is a report of invoice payments with a column per payment method.

require_once("../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/acl.inc");
require_once("$srcdir/formatting.inc.php");

$insarray = array();
$patients = array();

// Sort type affects which keys are used in the 1st and 2nd array level.
// $insarray keys   1st      2nd      3rd
// When sorting by
// date             encdate  patient  invno
// patient          patient  encdate  invno
// user             username encdate  invno
// invoice          --       --       invno
//
$form_orderby = empty($_REQUEST['form_orderby']) ? 'date' : $_REQUEST['form_orderby'];

function bucks($amount) {
  if ($amount) return oeFormatMoney($amount);
  return '';
}

function recordPayment($encdate, $patient_id, $encounter_id, $rowmethod,
  $rowchgamount, $rowpayamount, $rowadjamount, $username, $invoice_refno)
{
  global $insarray, $metharray, $grandchgtotal, $grandadjtotal, $patients;
  global $form_orderby;

  /*******************************************************************
  echo "<!-- " .
    "encdate = '$encdate' " .
    "patient_id = '$patient_id' " .
    "encounter_id = '$encounter_id' " .
    "rowmethod = '$rowmethod' " .
    "rowchgamount = '$rowchgamount' " .
    "rowpayamount = '$rowpayamount' " .
    "rowadjamount = '$rowadjamount' " .
    "-->\n"; // debugging
  *******************************************************************/

  if ($invoice_refno === '') $invoice_refno = "($patient_id.$encounter_id)";

  if ($form_orderby == 'patient') {
    $key1 = $patient_id;
    $key2 = $encdate;
  }
  else if ($form_orderby == 'user') {
    $key1 = $username;
    $key2 = $encdate;
  }
  else if ($form_orderby == 'invoice') {
    $key1 = $invoice_refno;
    $key2 = $patient_id;
  }
  else {
    $key1 = $encdate;
    $key2 = $patient_id;
  }

  // Extract only the first word as the payment method because any
  // following text will be some petty detail like a check number.
  $rowmethod = substr($rowmethod, 0, strcspn($rowmethod, ' /'));

  // Unexpected method is translated to Unassigned.
  if (empty($rowmethod) || !isset($metharray[$rowmethod])) {
    $rowmethod = 'zzz';
  }

  /*******************************************************************
  // If not a recognized method, create a new entry for it.
  if ($rowpayamount != 0 && !isset($metharray[$rowmethod])) {
    // echo "<!-- Adding method '$rowmethod' -->\n"; // debugging
    $metharray[$rowmethod] = array('title' => $rowmethod, 'paytotal' => 0);
  }
  *******************************************************************/

  // Get patient info here so names will be available at sort time.
  if (!isset($patients[$patient_id])) {
    $patients[$patient_id] = sqlQuery("SELECT " .
      "pubpid, fname, mname, lname " .
      "FROM patient_data WHERE pid = '$patient_id' LIMIT 1");
  }

  // If necessary create missing array hierarchy elements.
  if (!isset($insarray[$key1]))
    $insarray[$key1] = array();
  if (!isset($insarray[$key1][$key2]))
    $insarray[$key1][$key2] = array();
  if (!isset($insarray[$key1][$key2][$encounter_id])) {
    // Here are some other attributes needed later:
    $insarray[$key1][$key2][$encounter_id] = array(
      '#$' => 0,            // charges
      '#@' => 0,            // adjustments
      '#D' => $encdate,     // visit date
      '#P' => $patient_id,  // patient id
      '#U' => $username,    // username
      '#I' => $invoice_refno, // invoice reference number
    );
  }
  if (!isset($insarray[$key1][$key2][$encounter_id][$rowmethod])) {
    $insarray[$key1][$key2][$encounter_id][$rowmethod] = 0;
  }

  // Accumulate charges, payments and adjustments.
  $insarray[$key1][$key2][$encounter_id][$rowmethod] += $rowpayamount;
  $insarray[$key1][$key2][$encounter_id]['#$']       += $rowchgamount;
  $insarray[$key1][$key2][$encounter_id]['#@']       += $rowadjamount;

  // Accumulate also for bottom line totals.
  if ($rowpayamount != 0) $metharray[$rowmethod]['paytotal'] += $rowpayamount;
  $grandchgtotal += $rowchgamount;
  $grandadjtotal += $rowadjamount;
}

// Called from sortCmp1 or sortCmp2. Compares by patient name given pids.
function sortCmpPatient($a, $b) {
  global $patients;
  if ($patients[$a]['lname'] < $patients[$b]['lname']) return -1;
  if ($patients[$a]['lname'] > $patients[$b]['lname']) return  1;
  if ($patients[$a]['fname'] < $patients[$b]['fname']) return -1;
  if ($patients[$a]['fname'] > $patients[$b]['fname']) return  1;
  if ($patients[$a]['mname'] < $patients[$b]['mname']) return -1;
  if ($patients[$a]['mname'] > $patients[$b]['mname']) return  1;
  return 0;
}

// Called by uksort() when sorting the first level of keys.
function sortCmp1($a, $b) {
  global $form_orderby;
  if ($form_orderby == 'patient') return sortCmpPatient($a, $b);
  if ($a < $b) return -1;
  if ($a > $b) return  1;
  return 0;
}

// Called by uksort() when sorting the second level of keys.
function sortCmp2($a, $b) {
  global $form_orderby;
  if ($form_orderby == 'date') return sortCmpPatient($a, $b);
  if ($a < $b) return -1;
  if ($a > $b) return  1;
  return 0;
}

function echoSort($sortid) {
  global $form_orderby;
  echo "onclick=\"return dosort('$sortid')\"";
  $color = ($form_orderby == "$sortid") ? '#00cc00' : '#0000cc';
  echo " style=\"color:$color;cursor:pointer;cursor:hand\"";
}

if (! acl_check('acct', 'rep')) die(xl("Unauthorized access."));

$form_use_edate = $_POST['form_use_edate'];
$form_from_date = fixDate($_POST['form_from_date'], date('Y-m-d'));
$form_to_date   = fixDate($_POST['form_to_date']  , date('Y-m-d'));
$form_facility  = $_POST['form_facility'];

// Build array of payment methods. Key is method ID, value is an array of title
// and payment total accumulator.  Last entry is for no method.
//
$metharray = array();
$mres = sqlStatement("SELECT option_id, title FROM list_options WHERE " .
  "list_id = 'paymethod' ORDER BY seq, title");
while ($mrow = sqlFetchArray($mres)) {
  if ($mrow['option_id'] === '') continue;
  $metharray[$mrow['option_id']] = array('title' => $mrow['title'], 'paytotal' => 0);
}
$metharray['zzz'] = array('title' => xl('Unassigned'), 'paytotal' => 0);
//
if ($_POST['form_csvexport']) {
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Disposition: attachment; filename=receipts_by_payment_method.csv");
  header("Content-Description: File Transfer");
  // CSV headers:
  echo '"' . xl('ID'         ) . '",';
  echo '"' . xl('Patient'    ) . '",';
  echo '"' . xl('Invoice'    ) . '",';
  echo '"' . xl('Svc Date'   ) . '",';
  echo '"' . xl('Charges'    ) . '",';
  echo '"' . xl('Adjustments') . '",';
  echo '"' . xl('Total Paid' ) . '",';
  echo '"' . xl('Balance'    ) . '",';
  foreach ($metharray as $key => $value) {
    echo '"' . $value['title'] . '",';
  }
  echo '"' . xl('Voids'      ) . '",';
  echo '"' . xl('User'       ) . '"' . "\n";
} // end export
else {
?>
<html>
<head>
<style>
td.dehead { font-size:10pt; text-align:center; }
td.detail { font-size:10pt; }
td.delink { color:#0000cc; font-size:10pt; cursor:pointer }
</style>

<script type="text/javascript" src="../../library/topdialog.js"></script>
<script type="text/javascript" src="../../library/dialog.js"></script>

<script language="JavaScript">

<?php require($GLOBALS['srcdir'] . "/restoreSession.php"); ?>

function dosort(orderby) {
 var f = document.forms[0];
 f.form_orderby.value = orderby;
 opener.top.restoreSession();
 f.submit();
 return false;
}

// Process click to pop up the invoice receipt.
function doinvopen(ptid,encid) {
 dlgopen('../patient_file/pos_checkout.php?ptid=' + ptid + '&enc=' + encid, '_blank', 750, 550);
}

</script>

<?php if (function_exists('html_header_show')) html_header_show(); ?>
<title><?php xl('Receipts/Invoices by Payment Method','e') ?></title>
</head>

<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
<center>

<h2><?php xl('Receipts/Invoices by Payment Method','e') ?></h2>

<form method='post' action='methods_by_invoice.php'>

<table border='0' cellpadding='3'>

 <tr>
  <td align='center'>
<?php
// Build a drop-down list of facilities.
//
$query = "SELECT id, name FROM facility ORDER BY name";
$fres = sqlStatement($query);
echo "   <select name='form_facility'>\n";
echo "    <option value=''>-- " . xl('All Facilities') . " --\n";
while ($frow = sqlFetchArray($fres)) {
  $facid = $frow['id'];
  echo "    <option value='$facid'";
  if ($facid == $form_facility) echo " selected";
  echo ">" . $frow['name'] . "\n";
}
echo "   </select>\n";
?>
<?php
	// Build a drop-down list of "cashiers".
	//
	$query = "select id, lname, fname from users where " .
		"username != '' and active = 1 order by lname, fname";
	$res = sqlStatement($query);
	echo "   <select name='form_cashier'>\n";
	echo "    <option value=''>-- " . xl('All Cashiers') . " --\n";
	while ($row = sqlFetchArray($res)) {
		$cashierid = $row['id'];
		echo "    <option value='$cashierid'";
		if ($cashierid == $_POST['form_cashier']) echo " selected";
		echo ">" . $row['lname'] . ", " . $row['fname'] . "\n";
	}
	echo "   </select>\n";
?>
  </td>
 </tr>

 <tr>
  <td align='center'>
   <select name='form_use_edate'>
    <option value='0'><?php xl('Payment Date','e'); ?></option>
    <option value='1'<?php if ($form_use_edate) echo ' selected' ?>><?php xl('Invoice Date','e'); ?></option>
   </select>
   &nbsp;<?xl('From:','e')?>
   <input type='text' name='form_from_date' id="form_from_date" size='10' value='<?php echo $form_from_date ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' title='yyyy-mm-dd'>
   <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_from_date' border='0' alt='[?]' style='cursor:pointer'
    title='<?php xl('Click here to choose a date','e'); ?>'>
   &nbsp;<?php xl('To:','e'); ?>
   <input type='text' name='form_to_date' id="form_to_date" size='10' value='<?php echo $form_to_date ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' title='yyyy-mm-dd'>
   <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_to_date' border='0' alt='[?]' style='cursor:pointer'
    title='<?php xl('Click here to choose a date','e'); ?>'>
   &nbsp;
   <input type='submit' name='form_refresh' value="<?xl('Refresh','e')?>">
   &nbsp;
   <input type='submit' name='form_csvexport' value="<?php xl('Export to CSV','e') ?>">
   &nbsp;
   <input type='button' value='<?php xl('Print','e'); ?>' onclick='window.print()' />
  </td>
 </tr>

 <tr>
  <td height="1">
  </td>
 </tr>
<?php
} // end not export

if (isset($_POST['form_orderby'])) {
  $from_date    = $form_from_date;
  $to_date      = $form_to_date;
  $form_cashier = $_POST['form_cashier'];

  $paymethod   = "";
  $paymethodleft = "";
  $grandchgtotal  = 0;
  $grandadjtotal  = 0;

  // Get service charges and co-pays using the encounter date as the pay date.
  // Co-pays will always be considered patient payments.
  //
  $query = "SELECT b.fee, b.pid, b.encounter, b.code_type, b.code_text, " .
    "fe.date, fe.facility_id, fe.invoice_refno, u.username " .
    "FROM billing AS b " .
    "JOIN form_encounter AS fe ON fe.pid = b.pid AND fe.encounter = b.encounter " .
    "LEFT JOIN users AS u ON u.id = b.user " .
    "WHERE b.activity = 1 AND b.fee != 0 AND " .
    "fe.date >= '$from_date 00:00:00' AND fe.date <= '$to_date 23:59:59'";
  // If a facility was specified.
  if ($form_facility) $query .= " AND fe.facility_id = '$form_facility'";
  // If a cashier was specified.
  if ($form_cashier) $query .= " AND b.user = '$form_cashier'";
  //
  $query .= " ORDER BY fe.date, b.pid, b.encounter, fe.id";
  //
  $res = sqlStatement($query);
  while ($row = sqlFetchArray($res)) {
    if ($row['code_type'] == 'COPAY') {
      $rowmethod = trim($row['code_text']);
      recordPayment(substr($row['date'], 0, 10), $row['pid'], $row['encounter'],
        $rowmethod, 0, 0 - $row['fee'], 0, $row['username'], $row['invoice_refno']);
    }
    else {
      // Record a charge. Note these will only be the charges from the report period.
      recordPayment(substr($row['date'], 0, 10), $row['pid'], $row['encounter'],
        '', $row['fee'], 0, 0, $row['username'], $row['invoice_refno']);
    }
  }

  // Get product sales.  These are deemed to have occurred on the encounter date.
  //
  $query = "SELECT s.fee, s.pid, s.encounter, s.user AS username, " .
    "fe.date, fe.facility_id, fe.invoice_refno " .
    "FROM drug_sales AS s " .
    "JOIN form_encounter AS fe ON fe.pid = s.pid AND fe.encounter = s.encounter " .
    "LEFT JOIN users AS u ON u.username = s.user " .
    "WHERE s.pid != 0 AND s.fee != 0 AND " .
    "fe.date >= '$from_date 00:00:00' AND fe.date <= '$to_date 23:59:59'";
  // If a facility was specified.
  if ($form_facility) $query .= " AND fe.facility_id = '$form_facility'";
  // If a cashier was specified.
  if ($form_cashier) $query .= " AND u.id = '$form_cashier'";
  //
  $query .= " ORDER BY fe.date, s.pid, s.encounter, fe.id";
  //
  $res = sqlStatement($query);
  while ($row = sqlFetchArray($res)) {
    // Record a charge. Note these will only be the charges from the report period.
    recordPayment(substr($row['date'], 0, 10), $row['pid'], $row['encounter'],
      '', $row['fee'], 0, 0, $row['username'], $row['invoice_refno']);
  }

  // Get all other payments and adjustments and their dates, corresponding
  // payers and check reference data, and the encounter dates separately.
  //
  $query = "SELECT a.pid, a.encounter, a.post_time, a.pay_amount, " .
    "a.adj_amount, a.memo, a.session_id, a.code, a.payer_type, " .
    "fe.id, fe.date, fe.invoice_refno, fe.provider_id, " .
    "s.deposit_date, s.payer_id, s.reference, u.username " .
    "FROM ar_activity AS a " .
    "JOIN form_encounter AS fe ON fe.pid = a.pid AND fe.encounter = a.encounter " .
    "JOIN forms AS f ON f.pid = a.pid AND f.encounter = a.encounter AND f.formdir = 'newpatient' " .
    "LEFT JOIN ar_session AS s ON s.session_id = a.session_id " .
    "LEFT JOIN users AS u ON u.id = a.post_user " .
    "WHERE ( a.pay_amount != 0 OR a.adj_amount != 0 )";
  if ($form_use_edate) {
    $query .= " AND fe.date >= '$from_date 00:00:00' AND fe.date <= '$to_date 23:59:59'";
  } else {
    $query .= " AND ( ( s.deposit_date IS NOT NULL AND " .
      "s.deposit_date >= '$from_date' AND s.deposit_date <= '$to_date' ) OR " .
      "( s.deposit_date IS NULL AND a.post_time >= '$from_date 00:00:00' AND " .
      "a.post_time <= '$to_date 23:59:59' ) )";
  }
  // If a facility was specified.
  if ($form_facility) $query .= " AND fe.facility_id = '$form_facility'";
  // If a cashier was specified.
  if ($form_cashier) $query .= " AND a.post_user = '$form_cashier'";
  //
  $query .= " ORDER BY fe.date, a.pid, a.encounter, fe.id";
  //
  $res = sqlStatement($query);
  while ($row = sqlFetchArray($res)) {
    $encdate = substr($row['date'], 0, 10);
    // Compute payment method.
    if (empty($row['session_id'])) {
      $rowmethod = trim($row['memo']);
    } else {
      $rowmethod = trim($row['reference']);
    }
    recordPayment($encdate, $row['pid'], $row['encounter'], $rowmethod, 0,
      $row['pay_amount'], $row['adj_amount'], $row['username'], $row['invoice_refno']);
  }

  if (!$_POST['form_csvexport']) {

  // echo "<!-- insarray:\n"; print_r($insarray); echo " -->\n"; // debugging
?>

</table>

<table border='0' cellpadding='1' cellspacing='2' width='98%'>

 <tr bgcolor="#dddddd" style="font-weight:bold">
  <td class="dehead">
   <?php xl('ID','e') ?>
  </td>
  <td class="dehead" <?php echoSort('patient'); ?>>
   <?php xl('Patient','e') ?>
  </td>
  <td class="dehead" <?php echoSort('invoice'); ?>>
   <?php xl('Invoice','e') ?>
  </td>
  <td class="dehead" <?php echoSort('date'); ?>>
   <?php xl('Svc Date','e') ?>
  </td>
  <td class="dehead" align="right">
   <?php xl('Charges','e') ?>
  </td>
  <td class="dehead" align="right">
   <?php xl('Adjustments','e') ?>
  </td>
  <td class="dehead">
   <?php xl('Total Paid','e') ?>
  </td>
  <td class="dehead">
   <?php xl('Balance','e') ?>
  </td>
<?php

// ksort($metharray);

foreach ($metharray as $key => $value) {
  echo "  <td class='dehead' align='right'>\n";
  echo htmlspecialchars($value['title']);
  echo "  </td>\n";
}
?>
  <td class="dehead">
   <?php xl('Voids','e') ?>
  </td>
  <td class="dehead" <?php echoSort('user'); ?>>
   <?php xl('User','e') ?>
  </td>
 </tr>

<?php
  } // end not export

  uksort($insarray, 'sortCmp1'); // sort by first key
  $encount = 0;
  $displevel = 1;
  $grandvoidtotal = 0;
  foreach ($insarray as $key1 => $value1) {
    $subcnttotal = 0;
    $subchgtotal = 0;
    $subadjtotal = 0;
    $subpaytotal = 0;
    $subvoidtotal = 0;
    $subuser     = '';
    foreach ($metharray as $meth => $dummy) $metharray[$meth]['subtotal'] = 0;

    uksort($value1, 'sortCmp2'); // sort by second key
    foreach ($value1 as $key2 => $value2) {
      ksort($value2);              // sort by encounter ID
      foreach ($value2 as $encid => $encarray) {
        $ptid = $encarray['#P'];
        $invoice_refno = $encarray['#I'];

        // Get total of voids for this $ptid, $encid.
        $tmp = sqlQuery("SELECT SUM(v.amount2) AS amount2 " .
          "FROM voids AS v " .
          "JOIN form_encounter AS fe ON fe.pid = v.patient_id AND fe.encounter = v.encounter_id " .
          "WHERE v.patient_id = '$ptid' AND v.encounter_id = '$encid' AND " .
          "fe.date >= '$from_date 00:00:00' AND fe.date <= '$to_date 23:59:59'");
        $voids = $tmp['amount2'];

        $disp_dos  = oeFormatShortDate($encarray['#D']);

        /*************************************************************
        if ($form_orderby == 'date'    && $displevel > 1 ||
            $form_orderby == 'patient' && $displevel > 2 ||
            $form_orderby == 'user'    && $displevel > 2)
        {
          $disp_dos = '&nbsp;';
        }
        *************************************************************/

        $disp_id   = $patients[$ptid]['pubpid'];
        $disp_name = $patients[$ptid]['lname'] . ", " .
          $patients[$ptid]['fname'] . " " .
          $patients[$ptid]['mname'];      

        /*************************************************************
        if ($form_orderby == 'date'    && $displevel > 2 ||
            $form_orderby == 'patient' && $displevel > 1)
        {
          $disp_id   = '&nbsp;';
          $disp_name = '&nbsp;';
        }
        *************************************************************/

        $totpaid = 0;
        foreach ($metharray as $meth => $dummy) {
          $totpaid += $encarray[$meth];
          $metharray[$meth]['subtotal'] += $encarray[$meth];
        }
        $totpaid = sprintf('%01.2f', $totpaid);

        $subcnttotal += 1;
        $subchgtotal += $encarray['#$'];
        $subadjtotal += $encarray['#@'];
        $subpaytotal += $totpaid;
        $subvoidtotal += $voids;
        $subuser      = $encarray['#U'];

        $grandvoidtotal += $voids;

        if ($_POST['form_csvexport']) {
          echo '"'  . $disp_id   . '"';
          echo ',"' . $disp_name . '"';
          echo ',"' . addslashes($invoice_refno) . '"';
          echo ',"' . $disp_dos . '"';
          echo ',"' . bucks($encarray['#$']) . '"';
          echo ',"' . bucks($encarray['#@']) . '"';
          echo ',"' . bucks($totpaid) . '"';
          echo ',"' . bucks($encarray['#$'] - $encarray['#@'] - $totpaid) . '"';
          foreach ($metharray as $meth => $dummy) {
            echo ',"' . bucks($encarray[$meth]) . '"';
          }
          echo ',"' . bucks($voids) . '"';
          echo ',"' . $encarray['#U'] . '"' . "\n";
        }
        else {

          ++$encount;
          // $bgcolor = "#" . (($encount & 1) ? "ddddff" : "ffdddd");
          $bgcolor = "#ddddff";
          echo " <tr bgcolor='$bgcolor'>\n";
?>
  <td class="detail">
   <?php echo $disp_id; ?>
  </td>
  <td class="detail">
   <?php echo $disp_name; ?>
  </td>
  <td class="delink" onclick='doinvopen(<?php echo "$ptid,$encid"; ?>)'>
   <?php echo htmlspecialchars($invoice_refno); ?>
  </td>
  <td class="dehead">
   <?php echo $disp_dos; ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($encarray['#$']); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($encarray['#@']); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($totpaid); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($encarray['#$'] - $encarray['#@'] - $totpaid); ?>
  </td>
<?php
          foreach ($metharray as $meth => $dummy) {
            echo "  <td class='detail' align='right'>\n";
            echo bucks($encarray[$meth]);
            echo "  </td>\n";
          }

          echo "  <td class='detail' align='right'>\n";
          echo bucks($voids);
          echo "  </td>\n";

          echo "  <td class='detail'>\n";
          echo $encarray['#U'];
          echo "  </td>\n";

          echo " </tr>\n";

        } // end not export

        $displevel = 3;
      }

      $displevel = 2;
    }

    if (!$_POST['form_csvexport']) {

      if ($form_orderby == 'user' && $subcnttotal) {
        if (empty($subuser)) $subuser = xl('Unassigned');
?>
 <tr bgcolor="#dddddd" style="font-weight:bold">
  <td class="detail" colspan="4">
   <?php echo xl('Subtotals for') . ' ' . $subuser; ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($subchgtotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($subadjtotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($subpaytotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($subchgtotal - $subadjtotal - $subpaytotal); ?>
  </td>
<?php
        foreach ($metharray as $meth => $value) {
          echo "  <td class='detail' align='right'>\n";
          echo bucks($value['subtotal']);
          echo "  </td>\n";
        }
?>
  <td class="detail" align="right">
   <?php echo bucks($subvoidtotal); ?>
  </td>
  <td class="detail">
   <?php echo $subuser; ?>
  </td>
 </tr>
<?php
      }
    } // end not export

    $displevel = 1;
  }

  $grandpaytotal = 0;
  foreach ($metharray as $meth => $value) {
    $grandpaytotal += $value['paytotal'];
  }

  if (!$_POST['form_csvexport']) {
?>
 <tr bgcolor="#dddddd" style="font-weight:bold">
  <td class="detail" colspan="4">
   <?php xl('Grand Totals','e'); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($grandchgtotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($grandadjtotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($grandpaytotal); ?>
  </td>
  <td class="detail" align="right">
   <?php echo bucks($grandchgtotal - $grandadjtotal - $grandpaytotal); ?>
  </td>
<?php
  foreach ($metharray as $meth => $value) {
    echo "  <td class='detail' align='right'>\n";
    echo bucks($value['paytotal']);
    echo "  </td>\n";
  }
?>
  <td class="detail" align="right">
   <?php echo bucks($grandvoidtotal); ?>
  </td>
  <td class="detail">
   &nbsp;
  </td>
 </tr>

<?php
  } // end not export
} // end form refresh

if (!$_POST['form_csvexport']) {
?>

</table>
<input type="hidden" name="form_orderby" value="<?php echo $form_orderby ?>" />
</form>
</center>
</body>

<!-- stuff for the popup calendar -->
<style type="text/css">@import url(../../library/dynarch_calendar.css);</style>
<script type="text/javascript" src="../../library/dynarch_calendar.js"></script>
<script type="text/javascript" src="../../library/dynarch_calendar_en.js"></script>
<script type="text/javascript" src="../../library/dynarch_calendar_setup.js"></script>
<script language="Javascript">
 Calendar.setup({inputField:"form_from_date", ifFormat:"%Y-%m-%d", button:"img_from_date"});
 Calendar.setup({inputField:"form_to_date", ifFormat:"%Y-%m-%d", button:"img_to_date"});
</script>

</html>
<?php
} // end not export
?>
