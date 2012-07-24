<?php
// Copyright (C) 2005-2012 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

require_once("../../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once("codes.php");
require_once("../../../custom/code_types.inc.php");
require_once("../../drugs/drugs.inc.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/calendar_events.inc.php");
require_once("$srcdir/classes/Prescription.class.php");

// Some table cells will not be displayed unless insurance billing is used.
$usbillstyle = $GLOBALS['ippf_specific'] ? " style='display:none'" : "";
$justifystyle = justify_is_used() ? "" : " style='display:none'";

// This flag comes from the LBFmsivd form and perhaps later others.
$rapid_data_entry = empty($_GET['rde']) ? 0 : 1;

function alphaCodeType($id) {
  global $code_types;
  foreach ($code_types as $key => $value) {
    if ($value['id'] == $id) return $key;
  }
  return '';
}

// Helper function for creating drop-lists.
function endFSCategory() {
  global $i, $last_category, $FEE_SHEET_COLUMNS;
  if (! $last_category) return;
  echo "   </select>\n";
  echo "  </td>\n";
  if ($i >= $FEE_SHEET_COLUMNS) {
    echo " </tr>\n";
    $i = 0;
  }
}

// Generate JavaScript to build the array of diagnoses.
function genDiagJS($code_type, $code) {
  if ($code_type == 'ICD9') {
    echo "diags.push('$code');\n";
  }
}

/*********************************************************************
// For Family Planning only.
//
function contraceptionClass($code_type, $code) {
  global $code_types, $contraception_code, $contraception_cyp;
  if (!$GLOBALS['ippf_specific']) return 0;
  // $contra = 0;
  // Get the related service codes.
  $codesrow = sqlQuery("SELECT related_code FROM codes WHERE " .
    "code_type = '" . $code_types[$code_type]['id'] .
    "' AND code = '$code' LIMIT 1");
  if (!empty($codesrow['related_code']) && $code_type == 'MA') {
    $relcodes = explode(';', $codesrow['related_code']);
    foreach ($relcodes as $relstring) {
      if ($relstring === '') continue;
      list($reltype, $relcode) = explode(':', $relstring);
      if ($reltype !== 'IPPF') continue;
      if (
        preg_match('/^11....110/'    , $relcode) ||
        preg_match('/^11...[1-5]999/', $relcode) ||
        preg_match('/^112152010/'    , $relcode) ||
        preg_match('/^11317[1-2]111/', $relcode) ||
        preg_match('/^12118[1-2].13/', $relcode) ||
        preg_match('/^121181999/'    , $relcode) ||
        preg_match('/^122182.13/'    , $relcode) ||
        preg_match('/^122182999/'    , $relcode)
      ) {
        $tmprow = sqlQuery("SELECT cyp_factor FROM codes WHERE " .
          "code_type = '11' AND code = '$relcode' LIMIT 1");
        $cyp = 0 + $tmprow['cyp_factor'];
        if ($cyp > $contraception_cyp) {
          $contraception_cyp = $cyp;
          $contraception_code = $relcode;
        }
      }
    }
  }
  // return $contra;
}
*********************************************************************/

/*********************************************************************
// For Family Planning only.
//
function checkForContraception($code_type, $code) {
  global $code_types, $contraception_found;
  if (!$GLOBALS['ippf_specific']) return 0;
  // Get the related service codes.
  $codesrow = sqlQuery("SELECT related_code FROM codes WHERE " .
    "code_type = '" . $code_types[$code_type]['id'] .
    "' AND code = '$code' LIMIT 1");
  if (!empty($codesrow['related_code']) && $code_type == 'MA') {
    $relcodes = explode(';', $codesrow['related_code']);
    foreach ($relcodes as $relstring) {
      if ($relstring === '') continue;
      list($reltype, $relcode) = explode(':', $relstring);
      if ($reltype !== 'IPPF') continue;
      if (
        preg_match('/^11....110/'    , $relcode) ||
        preg_match('/^11...[1-5]999/', $relcode) ||
        preg_match('/^112152010/'    , $relcode) ||
        preg_match('/^11317[1-2]111/', $relcode) ||
        preg_match('/^12118[1-2].13/', $relcode) ||
        preg_match('/^121181999/'    , $relcode) ||
        preg_match('/^122182.13/'    , $relcode) ||
        preg_match('/^122182999/'    , $relcode)
      ) {
        $contraception_found = true;
      }
    }
  }
}
*********************************************************************/

// This is called for each service in the visit to determine the IPPF code
// of the service with highest CYP.
//
function checkForContraception($code_type, $code) {
  global $code_types, $contraception_code, $contraception_cyp;

  // This logic is only used for family planning clinics, and then only when
  // the option is chosen to auto-generate Contraception forms.
  if (!$GLOBALS['ippf_specific'] || !$GLOBALS['gbl_new_acceptor_policy']) return;

  $sql = "SELECT related_code FROM codes WHERE " .
    "code_type = '" . $code_types[$code_type]['id'] .
    "' AND code = '$code' LIMIT 1";

  // echo "<!-- checkForContraception: $sql -->\n"; // debugging

  $codesrow = sqlQuery($sql);

  if (!empty($codesrow['related_code']) && $code_type == 'MA') {
    $relcodes = explode(';', $codesrow['related_code']);
    foreach ($relcodes as $relstring) {
      if ($relstring === '') continue;
      list($reltype, $relcode) = explode(':', $relstring);
      if ($reltype !== 'IPPF') continue;
      if (
        preg_match('/^11....110/'    , $relcode) ||
        preg_match('/^11...[1-5]999/', $relcode) ||
        preg_match('/^112152010/'    , $relcode) ||
        preg_match('/^11317[1-2]111/', $relcode) ||
        preg_match('/^12118[1-2].13/', $relcode) ||
        preg_match('/^121181999/'    , $relcode) ||
        preg_match('/^122182.13/'    , $relcode) ||
        preg_match('/^122182999/'    , $relcode) ||
        preg_match('/^145212.10/'    , $relcode) ||
        preg_match('/^14521.999/'    , $relcode)
      ) {
        $tmprow = sqlQuery("SELECT cyp_factor FROM codes WHERE " .
          "code_type = '11' AND code = '$relcode' LIMIT 1");
        $cyp = 0 + $tmprow['cyp_factor'];
        if ($cyp > $contraception_cyp) {
          $contraception_cyp  = $cyp;
          $contraception_code = $relcode;
        }
      }
    }
  }
}

// This writes a billing line item to the output page.
//
function echoLine($lino, $codetype, $code, $modifier, $ndc_info='',
  $auth = TRUE, $del = FALSE, $units = NULL, $fee = NULL, $id = NULL,
  $billed = FALSE, $code_text = NULL, $justify = NULL, $provider_id = 0)
{
  global $code_types, $ndc_applies, $ndc_uom_choices, $justinit, $pid;
  global $usbillstyle, $justifystyle, $hasCharges, $required_code_count;

  if ($codetype == 'COPAY') {
    if (!$code_text) $code_text = 'Cash';
    if ($fee > 0) $fee = 0 - $fee;
  }
  if (! $code_text) {
    $query = "select id, units, code_text from codes where code_type = '" .
      $code_types[$codetype]['id'] . "' and " .
      "code = '$code' and ";
    if ($modifier) {
      $query .= "modifier = '$modifier'";
    } else {
      $query .= "(modifier is null or modifier = '')";
    }
    $result = sqlQuery($query);
    $code_text = $result['code_text'];
    if (empty($units)) $units = max(1, intval($result['units']));
    if (!isset($fee)) {
      // Fees come from the prices table now.
      $query = "SELECT prices.pr_price " .
        "FROM patient_data, prices WHERE " .
        "patient_data.pid = '$pid' AND " .
        "prices.pr_id = '" . $result['id'] . "' AND " .
        "prices.pr_selector = '' AND " .
        "prices.pr_level = patient_data.pricelevel " .
        "LIMIT 1";
      // echo "\n<!-- $query -->\n"; // debugging
      $prrow = sqlQuery($query);
      $fee = empty($prrow) ? 0 : $prrow['pr_price'];
    }
  }
  $fee = sprintf('%01.2f', $fee);
  if (empty($units)) $units = 1;
  $units = max(1, intval($units));
  // We put unit price on the screen, not the total line item fee.
  // $price = sprintf('%01.2f', $fee / $units);
  $price = $fee / $units;
  $strike1 = ($id && $del) ? "<strike>" : "";
  $strike2 = ($id && $del) ? "</strike>" : "";
  echo " <tr>\n";
  echo "  <td class='billcell'>$strike1" .
    ($codetype == 'COPAY' ? xl($codetype) : $codetype) . $strike2;
  if ($id) {
    echo "<input type='hidden' name='bill[$lino][id]' value='$id'>";
  }
  echo "<input type='hidden' name='bill[$lino][code_type]' value='$codetype'>";
  echo "<input type='hidden' name='bill[$lino][code]' value='$code'>";
  echo "<input type='hidden' name='bill[$lino][billed]' value='$billed'>";
  echo "</td>\n";
  if ($codetype != 'COPAY') {
    echo "  <td class='billcell'>$strike1$code$strike2</td>\n";
  } else {
    echo "  <td class='billcell'>&nbsp;</td>\n";
  }
  if ($billed) {
    if (modifiers_are_used(true)) {
      echo "  <td class='billcell'>$strike1$modifier$strike2" .
        "<input type='hidden' name='bill[$lino][mod]' value='$modifier'></td>\n";
    }
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" . oeFormatMoney($price) . "</td>\n";
      if ($codetype != 'COPAY') {
        echo "  <td class='billcell' align='center'>$units</td>\n";
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
      }
      echo "  <td class='billcell' align='center'$justifystyle>$justify</td>\n";
    }

    // Show provider for this line.
    echo "  <td class='billcell' align='center'>";
    genProviderSelect('', '-- Default --', $provider_id, true);
    echo "</td>\n";
    echo "  <td class='billcell' align='center'$usbillstyle><input type='checkbox'" .
      ($auth ? " checked" : "") . " disabled /></td>\n";
    if ($GLOBALS['gbl_auto_create_rx']) {
      echo "  <td class='billcell' align='center'>&nbsp;</td>\n";
    }
    echo "  <td class='billcell' align='center'><input type='checkbox'" .
      " disabled /></td>\n";
  }
  else { // not billed
    if (modifiers_are_used(true)) {
      if ($codetype != 'COPAY' && ($code_types[$codetype]['mod'] || $modifier)) {
        echo "  <td class='billcell'><input type='text' name='bill[$lino][mod]' " .
          "value='$modifier' size='" . $code_types[$codetype]['mod'] . "'></td>\n";
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
      }
    }
    if (fees_are_used()) {
      if ($codetype == 'COPAY' || $code_types[$codetype]['fee'] || $fee != 0) {
        echo "  <td class='billcell' align='right'>" .
          "<input type='text' name='bill[$lino][price]' " .
          "value='$price' size='6' onchange='setSaveAndClose()'";
        if (acl_check('acct','disc'))
          echo " style='text-align:right'";
        else
          echo " style='text-align:right;background-color:transparent' readonly";
        echo "></td>\n";
        echo "  <td class='billcell' align='center'>";
        if ($codetype != 'COPAY') {
          echo "<input type='text' name='bill[$lino][units]' " .
          "value='$units' size='2' style='text-align:right'>";
        } else {
          echo "<input type='hidden' name='bill[$lino][units]' value='$units'>";
        }
        echo "</td>\n";
        if ($code_types[$codetype]['just'] || $justify) {
          echo "  <td class='billcell' align='center'$justifystyle>";
          echo "<select name='bill[$lino][justify]' onchange='setJustify(this)'>";
          echo "<option value='$justify'>$justify</option></select>";
          echo "</td>\n";
          $justinit .= "setJustify(f['bill[$lino][justify]']);\n";
        } else {
          echo "  <td class='billcell'$justifystyle>&nbsp;</td>\n";
        }
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
        echo "  <td class='billcell'>&nbsp;</td>\n";
        echo "  <td class='billcell'$justifystyle>&nbsp;</td>\n"; // justify
      }
    }

    // Provider drop-list for this line.
    echo "  <td class='billcell' align='center'>";
    genProviderSelect("bill[$lino][provid]", '-- Default --', $provider_id);
    echo "</td>\n";
    echo "  <td class='billcell' align='center'$usbillstyle><input type='checkbox' name='bill[$lino][auth]' " .
      "value='1'" . ($auth ? " checked" : "") . " /></td>\n";
    if ($GLOBALS['gbl_auto_create_rx']) {
      echo "  <td class='billcell' align='center'>&nbsp;</td>\n";
    }
    echo "  <td class='billcell' align='center'><input type='checkbox' name='bill[$lino][del]' " .
      "value='1'" . ($del ? " checked" : "") . " /></td>\n";
  }

  echo "  <td class='billcell'>$strike1" . ucfirst(strtolower($code_text)) . "$strike2</td>\n";
  echo " </tr>\n";

  // If NDC info exists or may be required, add a line for it.
  if ($codetype == 'HCPCS' && $ndc_applies && !$billed) {
    $ndcnum = ''; $ndcuom = ''; $ndcqty = '';
    if (preg_match('/^N4(\S+)\s+(\S\S)(.*)/', $ndc_info, $tmp)) {
      $ndcnum = $tmp[1]; $ndcuom = $tmp[2]; $ndcqty = $tmp[3];
    }
    echo " <tr>\n";
    echo "  <td class='billcell' colspan='2'>&nbsp;</td>\n";
    echo "  <td class='billcell' colspan='6'>&nbsp;NDC:&nbsp;";
    echo "<input type='text' name='bill[$lino][ndcnum]' value='$ndcnum' " .
      "size='11' style='background-color:transparent'>";
    echo " &nbsp;Qty:&nbsp;";
    echo "<input type='text' name='bill[$lino][ndcqty]' value='$ndcqty' " .
      "size='3' style='background-color:transparent;text-align:right'>";
    echo " ";
    echo "<select name='bill[$lino][ndcuom]' style='background-color:transparent'>";
    foreach ($ndc_uom_choices as $key => $value) {
      echo "<option value='$key'";
      if ($key == $ndcuom) echo " selected";
      echo ">$value</option>";
    }
    echo "</select>";
    echo "</td>\n";
    echo " </tr>\n";
  }
  else if ($ndc_info) {
    echo " <tr>\n";
    echo "  <td class='billcell' colspan='2'>&nbsp;</td>\n";
    echo "  <td class='billcell' colspan='6'>&nbsp;NDC Data: $ndc_info</td>\n";
    echo " </tr>\n";
  }

  // For Family Planning.  Track services.
  if (!$del) checkForContraception($codetype, $code);
  if ($codetype == 'MA') ++$required_code_count;

  if ($fee != 0) $hasCharges = true;
}

// This writes a product (drug_sales) line item to the output page.
//
function echoProdLine($lino, $drug_id, $rx = FALSE, $del = FALSE, $units = NULL,
  $fee = NULL, $sale_id = 0, $billed = FALSE)
{
  global $code_types, $ndc_applies, $pid, $usbillstyle, $justifystyle, $hasCharges;
  global $required_code_count;
  $drow = sqlQuery("SELECT name FROM drugs WHERE drug_id = '$drug_id'");
  $code_text = $drow['name'];

  $fee = sprintf('%01.2f', $fee);
  if (empty($units)) $units = 1;
  $units = max(1, intval($units));
  // We put unit price on the screen, not the total line item fee.
  // $price = sprintf('%01.2f', $fee / $units);
  $price = $fee / $units;
  $strike1 = ($sale_id && $del) ? "<strike>" : "";
  $strike2 = ($sale_id && $del) ? "</strike>" : "";
  echo " <tr>\n";
  echo "  <td class='billcell'>{$strike1}Product$strike2";
  echo "<input type='hidden' name='prod[$lino][sale_id]' value='$sale_id'>";
  echo "<input type='hidden' name='prod[$lino][drug_id]' value='$drug_id'>";
  echo "<input type='hidden' name='prod[$lino][billed]' value='$billed'>";
  echo "</td>\n";
  echo "  <td class='billcell'>$strike1$drug_id$strike2</td>\n";
  if (modifiers_are_used(true)) {
    echo "  <td class='billcell'>&nbsp;</td>\n";
  }
  if ($billed) {
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" . oeFormatMoney($price) . "</td>\n";
      echo "  <td class='billcell' align='center'>$units</td>\n";
      echo "  <td class='billcell' align='center'$justifystyle>&nbsp;</td>\n"; // justify
    }
    echo "  <td class='billcell' align='center'>&nbsp;</td>\n";             // provider
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // auth
    if ($GLOBALS['gbl_auto_create_rx']) {
      echo "  <td class='billcell' align='center'><input type='checkbox'" . // rx
        " disabled /></td>\n";
    }
    echo "  <td class='billcell' align='center'><input type='checkbox'" .   // del
      " disabled /></td>\n";
  } else {
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" .
        "<input type='text' name='prod[$lino][price]' " .
        "value='$price' size='6' onchange='setSaveAndClose()'";
      if (acl_check('acct','disc'))
        echo " style='text-align:right'";
      else
        echo " style='text-align:right;background-color:transparent' readonly";
      echo "></td>\n";
      echo "  <td class='billcell' align='center'>";
      echo "<input type='text' name='prod[$lino][units]' " .
        "value='$units' size='2' style='text-align:right'>";
      echo "</td>\n";
      echo "  <td class='billcell'$justifystyle>&nbsp;</td>\n"; // justify
    }
    echo "  <td class='billcell' align='center'>&nbsp;</td>\n"; // provider
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // auth
    if ($GLOBALS['gbl_auto_create_rx']) {
      echo "  <td class='billcell' align='center'>" .
        "<input type='checkbox' name='prod[$lino][rx]' value='1'" .
        ($rx ? " checked" : "") . " /></td>\n";
    }
    echo "  <td class='billcell' align='center'><input type='checkbox' name='prod[$lino][del]' " .
      "value='1'" . ($del ? " checked" : "") . " /></td>\n";
  }

  echo "  <td class='billcell'>$strike1" . ucfirst(strtolower($code_text)) . "$strike2</td>\n";
  echo " </tr>\n";

  if ($fee != 0) $hasCharges = true;
  ++$required_code_count;
}

// Build a drop-down list of providers.  This includes users who
// have the word "provider" anywhere in their "additional info"
// field, so that we can define providers (for billing purposes)
// who do not appear in the calendar.
//
function genProviderSelect($selname, $toptext, $default=0, $disabled=false) {
  $query = "SELECT id, lname, fname FROM users WHERE " .
    "( authorized = 1 OR info LIKE '%provider%' ) AND username != '' " .
    "AND active = 1 AND ( info IS NULL OR info NOT LIKE '%Inactive%' ) " .
    "ORDER BY lname, fname";
  $res = sqlStatement($query);
  echo "   <select name='$selname'";
  if ($disabled) echo " disabled";
  echo ">\n";
  echo "    <option value=''>$toptext\n";
  while ($row = sqlFetchArray($res)) {
    $provid = $row['id'];
    echo "    <option value='$provid'";
    if ($provid == $default) echo " selected";
    echo ">" . $row['lname'] . ", " . $row['fname'] . "\n";
  }
  echo "   </select>\n";
}

function justify_is_used() {
 global $code_types;
 foreach ($code_types as $value) { if ($value['just']) return true; }
 return false;
}


function insert_lbf_item($form_id, $field_id, $field_value) {
  if ($form_id) {
    sqlInsert("INSERT INTO lbf_data (form_id, field_id, field_value) " .
      "VALUES ($form_id, '$field_id', '$field_value')");
  }
  else {
    $form_id = sqlInsert("INSERT INTO lbf_data (field_id, field_value) " .
      "VALUES ('$field_id', '$field_value')");
  }
  return $form_id;
}

/*********************************************************************
// This is just for Family Planning, to indicate if the visit includes
// contraceptive services.
$contraception_found = false;
*********************************************************************/

// These variables are used to compute the service with highest CYP.
//
$contraception_code = '';
$contraception_cyp  = -1;

// Possible units of measure for NDC drug quantities.
//
$ndc_uom_choices = array(
  'ML' => 'ML',
  'GR' => 'Grams',
  'F2' => 'I.U.',
  'UN' => 'Units'
);

// $FEE_SHEET_COLUMNS should be defined in codes.php.
if (empty($FEE_SHEET_COLUMNS)) $FEE_SHEET_COLUMNS = 2;

$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

// Update price level in patient demographics.
if (!empty($_POST['pricelevel'])) {
  sqlStatement("UPDATE patient_data SET pricelevel = '" .
    $_POST['pricelevel'] . "' WHERE pid = '$pid'");
}

// Get some info about this visit.
$visit_row = sqlQuery("SELECT fe.date, opc.pc_catname " .
  "FROM form_encounter AS fe " .
  "LEFT JOIN openemr_postcalendar_categories AS opc ON opc.pc_catid = fe.pc_catid " .
  "WHERE fe.pid = '$pid' AND fe.encounter = '$encounter' LIMIT 1");
$visit_date = substr($visit_row['date'], 0, 10);

// If Save or Save-and-Close was clicked, save the new and modified billing
// lines; then if no error, redirect to $returnurl.
//
if ($_POST['bn_save'] || $_POST['bn_save_close']) {
  $main_provid = 0 + $_POST['ProviderID'];
  $main_supid  = 0 + $_POST['SupervisorID'];
  if ($main_supid == $main_provid) $main_supid = 0;
  $default_warehouse = $_POST['default_warehouse'];

  $bill = $_POST['bill'];
  for ($lino = 1; $bill["$lino"]['code_type']; ++$lino) {
    $iter = $bill["$lino"];
    $code_type = $iter['code_type'];
    $code      = $iter['code'];
    $del       = $iter['del'];

    // Get some information about this service code.
    $codesrow = sqlQuery("SELECT code_text FROM codes WHERE " .
      "code_type = '" . $code_types[$code_type]['id'] .
      "' AND code = '$code' LIMIT 1");

    // Skip disabled (billed) line items.
    if ($iter['billed']) continue;

    $id        = $iter['id'];
    $modifier  = trim($iter['mod']);
    $units     = max(1, intval(trim($iter['units'])));
    $fee       = sprintf('%01.2f',(0 + trim($iter['price'])) * $units);
    if ($code_type == 'COPAY') {
      if ($fee > 0) $fee = 0 - $fee;
      $code = sprintf('%01.2f', 0 - $fee);
    }
    $justify   = trim($iter['justify']);
    if ($justify) $justify = str_replace(',', ':', $justify) . ':';
    // $auth      = $iter['auth'] ? "1" : "0";
    $auth      = "1";
    $provid    = 0 + $iter['provid'];

    $ndc_info = '';
    if ($iter['ndcnum']) {
    $ndc_info = 'N4' . trim($iter['ndcnum']) . '   ' . $iter['ndcuom'] .
      trim($iter['ndcqty']);
    }

    // If the item is already in the database...
    if ($id) {
      if ($del) {
        deleteBilling($id);
      }
      else {
        // authorizeBilling($id, $auth);
        sqlQuery("UPDATE billing SET code = '$code', " .
          "units = '$units', fee = '$fee', modifier = '$modifier', " .
          "authorized = $auth, provider_id = '$provid', " .
          "ndc_info = '$ndc_info', justify = '$justify' WHERE " .
          "id = '$id' AND billed = 0 AND activity = 1");
      }
    }

    // Otherwise it's a new item...
    else if (! $del) {
      $code_text = addslashes($codesrow['code_text']);
      addBilling($encounter, $code_type, $code, $code_text, $pid, $auth,
        $provid, $modifier, $units, $fee, $ndc_info, $justify);
    }
  } // end for

  // Doing similarly to the above but for products.
  $prod = $_POST['prod'];
  for ($lino = 1; $prod["$lino"]['drug_id']; ++$lino) {
    $iter = $prod["$lino"];

    if (!empty($iter['billed'])) continue;

    $drug_id   = $iter['drug_id'];
    $sale_id   = $iter['sale_id']; // present only if already saved
    $units     = max(1, intval(trim($iter['units'])));
    $fee       = sprintf('%01.2f',(0 + trim($iter['price'])) * $units);
    $del       = $iter['del'];
    $rxid      = 0;

    // If the item is already in the database...
    if ($sale_id) {
      $tmprow = sqlQuery("SELECT prescription_id FROM drug_sales WHERE " .
        "sale_id = '$sale_id'");
      $rxid = 0 + $tmprow['prescription_id'];

      if ($del) {
        // Zero out this sale and reverse its inventory update.  We bring in
        // drug_sales twice so that the original quantity can be referenced
        // unambiguously.
        sqlStatement("UPDATE drug_sales AS dsr, drug_sales AS ds, " .
          "drug_inventory AS di " .
          "SET di.on_hand = di.on_hand + dsr.quantity, " .
          "ds.quantity = 0, ds.fee = 0 WHERE " .
          "dsr.sale_id = '$sale_id' AND ds.sale_id = dsr.sale_id AND " .
          "di.inventory_id = ds.inventory_id");
        // And delete the sale for good measure.
        sqlStatement("DELETE FROM drug_sales WHERE sale_id = '$sale_id'");
        // If there was a prescription delete it also.
        if ($rxid) {
          sqlStatement("DELETE FROM prescriptions WHERE id = '$rxid'");
        }
      }
      else {
        // Modify the sale and adjust inventory accordingly.
        $query = "UPDATE drug_sales AS dsr, drug_sales AS ds, " .
          "drug_inventory AS di " .
          "SET di.on_hand = di.on_hand + dsr.quantity - $units, " .
          "ds.quantity = '$units', ds.fee = '$fee', " .
          "ds.sale_date = '$visit_date' WHERE " .
          "dsr.sale_id = '$sale_id' AND ds.sale_id = dsr.sale_id AND " .
          "di.inventory_id = ds.inventory_id";
        sqlStatement($query);
        // Delete Rx if $rxid and flag not set.
        if ($GLOBALS['gbl_auto_create_rx'] && $rxid && empty($iter['rx'])) {
          sqlStatement("DELETE FROM prescriptions WHERE id = '$rxid'");
        }
      }
    }

    // Otherwise it's a new item...
    else if (! $del) {
      $sale_id = sellDrug($drug_id, $units, $fee, $pid, $encounter, 0,
        $visit_date, '', $default_warehouse);
      if (!$sale_id) die(xl('Insufficient inventory for product ID') . " \"$drug_id\".");
    }

    // If a prescription applies, create or update it.
    if (!empty($iter['rx']) && !$del) {
      // If an active rx already exists for this drug and date we will
      // replace it, otherwise we'll make a new one.
      if (empty($rxid)) $rxid = '';
      // Get default drug attributes.
      $drow = sqlQuery("SELECT dt.*, " .
        "d.name, d.form, d.size, d.unit, d.route, d.substitute " .
        "FROM drugs AS d, drug_templates AS dt WHERE " .
        "d.drug_id = '$drug_id' AND dt.drug_id = d.drug_id " .
        "ORDER BY dt.quantity, dt.dosage, dt.selector LIMIT 1");
      if (!empty($drow)) {
        $rxobj = new Prescription($rxid);
        $rxobj->set_patient_id($pid);
        $rxobj->set_provider_id($main_provid);
        $rxobj->set_drug_id($drug_id);
        $rxobj->set_quantity($units);
        $rxobj->set_per_refill($units);
        $rxobj->set_start_date_y(substr($visit_date,0,4));
        $rxobj->set_start_date_m(substr($visit_date,5,2));
        $rxobj->set_start_date_d(substr($visit_date,8,2));
        $rxobj->set_date_added($visit_date);
        // Remaining attributes are the drug and template defaults.
        $rxobj->set_drug($drow['name']);
        $rxobj->set_unit($drow['unit']);
        $rxobj->set_dosage($drow['dosage']);
        $rxobj->set_form($drow['form']);
        $rxobj->set_refills($drow['refills']);
        $rxobj->set_size($drow['size']);
        $rxobj->set_route($drow['route']);
        $rxobj->set_interval($drow['period']);
        $rxobj->set_substitute($drow['substitute']);
        //
        $rxobj->persist();
        // Set drug_sales.prescription_id to $rxobj->get_id().
        $rxid = 0 + $rxobj->get_id();
        sqlStatement("UPDATE drug_sales SET prescription_id = '$rxid' WHERE " .
          "sale_id = '$sale_id'");
      }
    }

  } // end for

  // Set the main/default service provider in the new-encounter form.
  /*******************************************************************
  sqlStatement("UPDATE forms, users SET forms.user = users.username WHERE " .
    "forms.pid = '$pid' AND forms.encounter = '$encounter' AND " .
    "forms.formdir = 'newpatient' AND users.id = '$provid'");
  *******************************************************************/
  sqlStatement("UPDATE form_encounter SET provider_id = '$main_provid', " .
    "supervisor_id = '$main_supid'  WHERE " .
    "pid = '$pid' AND encounter = '$encounter'");

  // Save-and-Close is currently specific to Family Planning but might be more
  // generally useful.  It provides the ability to mark an encounter as billed
  // directly from the Fee Sheet, if there are no charges.
  if ($_POST['bn_save_close'] && !$_POST['form_has_charges']) {
    $tmp1 = sqlQuery("SELECT SUM(ABS(fee)) AS sum FROM drug_sales WHERE " .
      "pid = '$pid' AND encounter = '$encounter'");
    $tmp2 = sqlQuery("SELECT SUM(ABS(fee)) AS sum FROM billing WHERE " .
      "pid = '$pid' AND encounter = '$encounter' AND billed = 0 AND " .
      "activity = 1");
    if ($tmp1['sum'] + $tmp2['sum'] == 0) {
      sqlStatement("update drug_sales SET billed = 1 WHERE " .
        "pid = '$pid' AND encounter = '$encounter' AND billed = 0");
      sqlStatement("UPDATE billing SET billed = 1, bill_date = NOW() WHERE " .
        "pid = '$pid' AND encounter = '$encounter' AND billed = 0 AND " .
        "activity = 1");
    }
    else {
      // Would be good to display an error message here... they clicked
      // Save and Close but the close could not be done.  However the
      // framework does not provide an easy way to do that.
    }
  }

  /*******************************************************************
  // More Family Planning stuff.
  if (!empty($_POST['contrasel']) && !empty($_POST['contrastart']) && $_POST['contrasel'] != 5) {
    $contrasel   = $_POST['contrasel'];
    $contrastart = $_POST['contrastart'];
    $ippfconmeth = $_POST['ippfconmeth'];
    // Add contraception form but only if it does not already exist
    // (if it does, must be 2 users working on the visit concurrently).
    $csrow = sqlQuery("SELECT COUNT(*) AS count FROM forms AS f WHERE " .
      "f.pid = '$pid' AND f.encounter = '$encounter' AND " .
      "f.formdir = 'LBFcontra' AND f.deleted = 0");
    if ($csrow['count'] == 0) {
      $newid = insert_lbf_item(0, 'contratype', $contrasel);
      insert_lbf_item($newid, 'contrastart', $contrastart);
      insert_lbf_item($newid, 'ippfconmeth', $ippfconmeth);
      addForm($encounter, 'Contraception Start', $newid, 'LBFcontra', $pid, $userauthorized);
    }
  }
  *******************************************************************/

  // Note: Taxes are computed at checkout time (in pos_checkout.php which
  // also posts to SL).  Currently taxes with insurance claims make no sense,
  // so for now we'll ignore tax computation in the insurance billing logic.

  // If appropriate, update the status of the related appointment to
  // "In exam room".
  updateAppointmentStatus($pid, $visit_date, '<');

  // More Family Planning stuff.
  if (isset($_POST['ippfconmeth'])) {
    $csrow = sqlQuery("SELECT f.form_id, ld.field_value FROM forms AS f " .
      "LEFT JOIN lbf_data AS ld ON ld.form_id = f.form_id AND ld.field_id = 'newmethod' " .
      "WHERE " .
      "f.pid = '$pid' AND f.encounter = '$encounter' AND " .
      "f.formdir = 'LBFccicon' AND f.deleted = 0 " .
      "ORDER BY f.form_id DESC LIMIT 1");
    if (isset($_POST['newmauser'])) {
      $newmauser   = $_POST['newmauser'];
      $ippfconmeth = $_POST['ippfconmeth'];
      // Add contraception form but only if it does not already exist
      // (if it does, must be 2 users working on the visit concurrently).
      if (empty($csrow)) {
        $newid = insert_lbf_item(0, 'newmauser', $newmauser);
        insert_lbf_item($newid, 'newmethod', $ippfconmeth);
        // Do we care about a service-specific provider here?
        insert_lbf_item($newid, 'provider', $main_provid);
        addForm($encounter, 'Contraception', $newid, 'LBFccicon', $pid, $userauthorized);
      }
    }
    else if (empty($csrow) || $csrow['field_value'] != $ippfconmeth) {
      // Contraceptive method does not match what is in an existing Contraception
      // form for this visit, or there is no such form.  Open the form.
      formJump("{$GLOBALS['rootdir']}/patient_file/encounter/view_form.php" .
        "?formname=LBFccicon&id=" . (empty($csrow) ? 0 : $csrow['form_id']));
      formFooter();
      exit;
    }
  }

  if ($rapid_data_entry || ($_POST['bn_save_close'] && $_POST['form_has_charges'])) {
    // In rapid data entry mode or if "Save and Checkout" was clicked,
    // we go directly to the Checkout page.
    formJump("{$GLOBALS['rootdir']}/patient_file/pos_checkout.php?framed=1&rde=$rapid_data_entry");
  }
  else {
    // Otherwise return to the normal encounter summary frameset.
    formHeader("Redirecting....");
    formJump();
  }
  formFooter();
  exit;
}

$billresult = getBillingByEncounter($pid, $encounter, "*");
?>
<html>
<head>
<?php html_header_show(); ?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<style>
.billcell { font-family: sans-serif; font-size: 10pt }
</style>
<style type="text/css">@import url(../../../library/dynarch_calendar.css);</style>
<script type="text/javascript" src="../../../library/textformat.js"></script>
<script type="text/javascript" src="../../../library/dialog.js"></script>
<script type="text/javascript" src="../../../library/dynarch_calendar.js"></script>
<script type="text/javascript" src="../../../library/dynarch_calendar_en.js"></script>
<script type="text/javascript" src="../../../library/dynarch_calendar_setup.js"></script>
<script language="JavaScript">

var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';

var diags = new Array();

<?php
if ($billresult) {
  foreach ($billresult as $iter) {
    genDiagJS($iter["code_type"], trim($iter["code"]));
  }
}
if ($_POST['bill']) {
  foreach ($_POST['bill'] as $iter) {
    if ($iter["del"]) continue; // skip if Delete was checked
    if ($iter["id"])  continue; // skip if it came from the database
    genDiagJS($iter["code_type"], $iter["code"]);
  }
}
if ($_POST['newcodes']) {
  $arrcodes = explode('~', $_POST['newcodes']);
  foreach ($arrcodes as $codestring) {
    if ($codestring === '') continue;
    $arrcode = explode('|', $codestring);
    list($code, $modifier) = explode(":", $arrcode[1]);
    genDiagJS($arrcode[0], $code);
  }
}
?>

// This is invoked by <select onchange> for the various dropdowns,
// including search results.
function codeselect(selobj) {
 var i = selobj.selectedIndex;
 if (i > 0) {
  top.restoreSession();
  var f = document.forms[0];
  f.newcodes.value = selobj.options[i].value;
  f.submit();
 }
}

function copayselect() {
 top.restoreSession();
 var f = document.forms[0];
 f.newcodes.value = 'COPAY||';
 f.submit();
}

function validate(f) {
 var refreshing = f.bn_refresh.clicked ? true : false;
 var searching  = f.bn_search.clicked  ? true : false;
 f.bn_refresh.clicked = false;
 f.bn_search.clicked = false;
 for (var lino = 1; f['bill['+lino+'][code_type]']; ++lino) {
  var pfx = 'bill['+lino+']';
  if (f[pfx+'[ndcnum]'] && f[pfx+'[ndcnum]'].value) {
   // Check NDC number format.
   var ndcok = true;
   var ndc = f[pfx+'[ndcnum]'].value;
   var a = ndc.split('-');
   if (a.length != 3) {
    ndcok = false;
   }
   else if (a[0].length < 1 || a[1].length < 1 || a[2].length < 1 ||
    a[0].length > 5 || a[1].length > 4 || a[2].length > 2) {
    ndcok = false;
   }
   else {
    for (var i = 0; i < 3; ++i) {
     for (var j = 0; j < a[i].length; ++j) {
      var c = a[i].charAt(j);
      if (c < '0' || c > '9') ndcok = false;
     }
    }
   }
   if (!ndcok) {
    alert('<?php xl('Format incorrect for NDC','e') ?> "' + ndc +
     '", <?php xl('should be like nnnnn-nnnn-nn','e') ?>');
    if (f[pfx+'[ndcnum]'].focus) f[pfx+'[ndcnum]'].focus();
    return false;
   }
   // Check for valid quantity.
   var qty = f[pfx+'[ndcqty]'].value - 0;
   if (isNaN(qty) || qty <= 0) {
    alert('<?php xl('Quantity for NDC','e') ?> "' + ndc +
     '" <?php xl('is not valid (decimal fractions are OK).','e') ?>');
    if (f[pfx+'[ndcqty]'].focus) f[pfx+'[ndcqty]'].focus();
    return false;
   }
  }
 }
 if (!refreshing && !searching) {
  if (!f.ProviderID.value) {
   alert('<?php echo xl('Default provider is required.') ?>');
   return false;
  }
<?php if (isset($code_types['MA'])) { ?>
  if (required_code_count == 0) {
   if (!confirm('<?php echo xl('You have not entered any clinical services or products.' .
    ' Click Cancel to add them. Or click OK if you want to save as-is.') ?>')) {
    return false;
   }
  }
<?php } ?>
 }
 top.restoreSession();
 return true;
}

// When a justify selection is made, apply it to the current list for
// this procedure and then rebuild its selection list.
//
function setJustify(seljust) {
 var theopts = seljust.options;
 var jdisplay = theopts[0].text;
 // Compute revised justification string.  Note this does nothing if
 // the first entry is still selected, which is handy at startup.
 if (seljust.selectedIndex > 0) {
  var newdiag = seljust.value;
  if (newdiag.length == 0) {
   jdisplay = '';
  }
  else {
   if (jdisplay.length) jdisplay += ',';
   jdisplay += newdiag;
  }
 }
 // Rebuild selection list.
 var jhaystack = ',' + jdisplay + ',';
 var j = 0;
 theopts.length = 0;
 theopts[j++] = new Option(jdisplay,jdisplay,true,true);
 for (var i = 0; i < diags.length; ++i) {
  if (jhaystack.indexOf(',' + diags[i] + ',') < 0) {
   theopts[j++] = new Option(diags[i],diags[i],false,false);
  }
 }
 theopts[j++] = new Option('Clear','',false,false);
}

// Function to check if there are any charges in the form, and to enable
// or disable the Save and Close button accordingly.
//
function setSaveAndClose() {
 var f = document.forms[0];
 if (!f.bn_save_close) return;
 var hascharges = false;
 for (var i = 0; i < f.elements.length; ++i) {
  var elem = f.elements[i];
  if (elem.name.indexOf('[price]') > 0) {
   var fee = Number(elem.value);
   // alert('Fee is "' + fee + '"'); // debugging
   if (!isNaN(fee) && fee != 0) hascharges = true;
  }
 }
 // f.bn_save_close.disabled = hascharges;
 if (hascharges) {
  f.form_has_charges.value = '1';
  f.bn_save_close.value = '<?php echo xl('Save and Checkout'); ?>';
 }
 else {
  f.form_has_charges.value = '0';
  f.bn_save_close.value = '<?php echo xl('Save and Close'); ?>';
 }
}

/*********************************************************************
// Make contrastart and ippfconmeth visible or not, depending on user selection.
// This applies only to family planning installations.
function contrasel_changed(selobj) {
 document.getElementById('contrasel_span').style.visibility =
  selobj.value > '4' ? 'hidden' : 'visible';
}
*********************************************************************/

// Open the add-event dialog.
function newEvt() {
 var f = document.forms[0];
 var url = '../../main/calendar/add_edit_event.php?patientid=<?php echo $pid ?>';
 if (f.ProviderID && f.ProviderID.value) {
  url += '&userid=' + parseInt(f.ProviderID.value);
 }
 dlgopen(url, '_blank', 600, 300);
 return false;
}

</script>
</head>

<body class="body_top">
<form method="post" action="<?php echo $rootdir; ?>/forms/fee_sheet/new.php?rde=<?php echo $rapid_data_entry; ?>"
 onsubmit="return validate(this)">
<span class="title"><?php xl('Fee Sheet','e'); ?></span><br>
<input type='hidden' name='newcodes' value=''>

<center>

<?php
$isBilled = isEncounterBilled($pid, $encounter);
if ($isBilled) {
  echo "<p><font color='green'>This encounter has been billed. If you " .
    "need to change it, it must be re-opened.</font></p>\n";
}
else { // the encounter is not yet billed
?>

<table width='95%'>
<?php
$i = 0;
$last_category = '';

// Create drop-lists based on the fee_sheet_options table.
$res = sqlStatement("SELECT * FROM fee_sheet_options " .
  "ORDER BY fs_category, fs_option");
while ($row = sqlFetchArray($res)) {
  $fs_category = $row['fs_category'];
  $fs_option   = $row['fs_option'];
  $fs_codes    = $row['fs_codes'];
  if($fs_category !== $last_category) {
    endFSCategory();
    $last_category = $fs_category;
    ++$i;
    echo ($i <= 1) ? " <tr>\n" : "";
    echo "  <td width='50%' align='center' nowrap>\n";
    echo "   <select style='width:96%' onchange='codeselect(this)'>\n";
    echo "    <option value=''> " . substr($fs_category, 1) . "</option>\n";
  }
  echo "    <option value='$fs_codes'>" . substr($fs_option, 1) . "</option>\n";
}
endFSCategory();

// Create drop-lists based on categories defined within the codes.
$pres = sqlStatement("SELECT option_id, title FROM list_options " .
  "WHERE list_id = 'superbill' ORDER BY seq");
while ($prow = sqlFetchArray($pres)) {
  global $code_types;
  ++$i;
  echo ($i <= 1) ? " <tr>\n" : "";
  echo "  <td width='50%' align='center' nowrap>\n";
  echo "   <select style='width:96%' onchange='codeselect(this)'>\n";
  echo "    <option value=''> " . $prow['title'] . "\n";
  $res = sqlStatement("SELECT code_type, code, code_text,modifier FROM codes " .
    "WHERE superbill = '" . $prow['option_id'] . "' AND active = 1 " .
    "ORDER BY code_text");
  while ($row = sqlFetchArray($res)) {
    $ctkey = alphaCodeType($row['code_type']);
    if ($code_types[$ctkey]['nofs']) continue;
    echo "    <option value='$ctkey|" .
      $row['code'] . ':'. $row['modifier']. "|'>" . $row['code_text'] . "</option>\n";
  }
  echo "   </select>\n";
  echo "  </td>\n";
  if ($i >= $FEE_SHEET_COLUMNS) {
    echo " </tr>\n";
    $i = 0;
  }
}

// Create one more drop-list, for Products.
if ($GLOBALS['sell_non_drug_products']) {
  ++$i;
  echo ($i <= 1) ? " <tr>\n" : "";
  echo "  <td width='50%' align='center' nowrap>\n";
  echo "   <select name='Products' style='width:96%' onchange='codeselect(this)'>\n";
  echo "    <option value=''> " . xl('Products') . "\n";
  $tres = sqlStatement("SELECT dt.drug_id, dt.selector, d.name " .
    "FROM drug_templates AS dt, drugs AS d WHERE " .
    "d.drug_id = dt.drug_id AND d.active = 1 " .
    "ORDER BY d.name, dt.selector, dt.drug_id");
  while ($trow = sqlFetchArray($tres)) {
    echo "    <option value='PROD|" . $trow['drug_id'] . '|' . $trow['selector'] . "'>" .
      $trow['drug_id'] . ':' . $trow['selector'];
    if ($trow['name'] !== $trow['selector']) echo ' ' . $trow['name'];
    echo "</option>\n";
  }
  echo "   </select>\n";
  echo "  </td>\n";
  if ($i >= $FEE_SHEET_COLUMNS) {
    echo " </tr>\n";
    $i = 0;
  }
}

$search_type = $default_search_type;
if ($_POST['search_type']) $search_type = $_POST['search_type'];

$ndc_applies = true; // Assume all payers require NDC info.

echo $i ? "  <td></td>\n </tr>\n" : "";
echo " <tr>\n";
echo "  <td colspan='$FEE_SHEET_COLUMNS' align='center' nowrap>\n";

// If Search was clicked, do it and write the list of results here.
// There's no limit on the number of results!
//
$numrows = 0;
if ($_POST['bn_search'] && $_POST['search_term']) {
  $query = "SELECT code, modifier, code_text FROM codes WHERE " .
    "(code_text LIKE '%" . $_POST['search_term'] . "%' OR " .
    "code LIKE '%" . $_POST['search_term'] . "%') AND " .
    "code_type = '" . $code_types[$search_type]['id'] . "' " .
    "AND active = 1 ORDER BY code";
  $res = sqlStatement($query);
  $numrows = mysql_num_rows($res); // FIXME - not portable!
}

echo "   <select name='Search Results' style='width:98%' " .
  "onchange='codeselect(this)'";
if (! $numrows) echo ' disabled';
echo ">\n";
echo "    <option value=''> Search Results ($numrows items)\n";

if ($numrows) {
  while ($row = sqlFetchArray($res)) {
    $code = $row['code'];
    if ($row['modifier']) $code .= ":" . $row['modifier'];
    echo "    <option value='$search_type|$code|'>$code " .
      ucfirst(strtolower($row['code_text'])) . "</option>\n";
  }
}

echo "   </select>\n";
echo "  </td>\n";
echo " </tr>\n";
?>

</table>

<p style='margin-top:8px;margin-bottom:8px'>
<table>
 <tr>
  <td>
   <input type='button' value='<?php xl('Add Copay','e');?>'
    onclick="copayselect()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </td>
  <td>
   <?php xl('Search','e'); ?>&nbsp;
<?php
  foreach ($code_types as $key => $value) {
    if (!empty($value['nofs'])) continue;
    echo "   <input type='radio' name='search_type' value='$key'";
    if ($key == $default_search_type) echo " checked";
    echo " />$key&nbsp;\n";
  }
?>
   <?php xl('for','e'); ?>&nbsp;
  </td>
  <td>
   <input type='text' name='search_term' value=''> &nbsp;
  </td>
  <td>
   <input type='submit' name='bn_search' value='<?php xl('Search','e');?>'
    onclick='return this.clicked = true;'>
  </td>
 </tr>
</table>
</p>
<p style='margin-top:16px;margin-bottom:8px'>

<?php } // end encounter not billed ?>

<table cellspacing='5'>
 <tr>
  <td class='billcell'><b><?php xl('Type','e');?></b></td>
  <td class='billcell'><b><?php xl('Code','e');?></b></td>
<?php if (modifiers_are_used(true)) { ?>
  <td class='billcell'><b><?php xl('Mod','e');?></b></td>
<?php } ?>
<?php if (fees_are_used()) { ?>
  <td class='billcell' align='right'><b><?php xl('Price','e');?></b>&nbsp;</td>
  <td class='billcell' align='center'><b><?php xl('Units','e');?></b></td>
  <td class='billcell' align='center'<?php echo $justifystyle; ?>><b><?php xl('Justify','e');?></b></td>
<?php } ?>
  <td class='billcell' align='center'><b><?php xl('Provider','e');?></b></td>
  <td class='billcell' align='center'<?php echo $usbillstyle; ?>><b><?php xl('Auth','e');?></b></td>
<?php if ($GLOBALS['gbl_auto_create_rx']) { ?>
  <td class='billcell' align='center'><b><?php xl('Rx','e');?></b></td>
<?php } ?>
  <td class='billcell' align='center'><b><?php xl('Delete','e');?></b></td>
  <td class='billcell'><b><?php xl('Description','e');?></b></td>
 </tr>

<?php
$justinit = "var f = document.forms[0];\n";

// $encounter_provid = -1;

$hasCharges = false;
$required_code_count = 0;

// Generate lines for items already in the billing table for this encounter,
// and also set the rendering provider if we come across one.
//
$bill_lino = 0;
if ($billresult) {
  foreach ($billresult as $iter) {
    ++$bill_lino;
    $bline = $_POST['bill']["$bill_lino"];
    $del = $bline['del']; // preserve Delete if checked

    $modifier   = trim($iter["modifier"]);
    $units      = $iter["units"];
    $fee        = $iter["fee"];
    $authorized = $iter["authorized"];
    $ndc_info   = $iter["ndc_info"];
    $justify    = trim($iter['justify']);
    if ($justify) $justify = substr(str_replace(':', ',', $justify), 0, strlen($justify) - 1);
    $provider_id = $iter['provider_id'];

    // Also preserve other items from the form, if present.
    if ($bline['id'] && !$iter["billed"]) {
      $modifier   = trim($bline['mod']);
      $units      = max(1, intval(trim($bline['units'])));
      $fee        = sprintf('%01.2f',(0 + trim($bline['price'])) * $units);
      $authorized = $bline['auth'];
      $ndc_info   = '';
      if ($bline['ndcnum']) {
        $ndc_info = 'N4' . trim($bline['ndcnum']) . '   ' . $bline['ndcuom'] .
        trim($bline['ndcqty']);
      }
      $justify    = $bline['justify'];
      $provider_id = 0 + $bline['provid'];
    }

    // list($code, $modifier) = explode("-", $iter["code"]);
    echoLine($bill_lino, $iter["code_type"], trim($iter["code"]),
      $modifier, $ndc_info,  $authorized,
      $del, $units, $fee, $iter["id"], $iter["billed"],
      $iter["code_text"], $justify, $provider_id);
  }
}

// Echo new billing items from this form here, but omit any line
// whose Delete checkbox is checked.
//
if ($_POST['bill']) {
  foreach ($_POST['bill'] as $key => $iter) {
    if ($iter["id"])  continue; // skip if it came from the database
    if ($iter["del"]) continue; // skip if Delete was checked
    $ndc_info = '';
    if ($iter['ndcnum']) {
      $ndc_info = 'N4' . trim($iter['ndcnum']) . '   ' . $iter['ndcuom'] .
      trim($iter['ndcqty']);
    }
    // $fee = 0 + trim($iter['fee']);
    $units = max(1, intval(trim($iter['units'])));
    $fee = sprintf('%01.2f',(0 + trim($iter['price'])) * $units);
    if ($iter['code_type'] == 'COPAY' && $fee > 0) $fee = 0 - $fee;
    echoLine(++$bill_lino, $iter["code_type"], $iter["code"], trim($iter["mod"]),
      $ndc_info, $iter["auth"], $iter["del"], $units,
      $fee, NULL, FALSE, NULL, $iter["justify"], 0 + $iter['provid']);
  }
}

// Generate lines for items already in the drug_sales table for this encounter.
//
$query = "SELECT * FROM drug_sales WHERE " .
  "pid = '$pid' AND encounter = '$encounter' " .
  "ORDER BY sale_id";
$sres = sqlStatement($query);
$prod_lino = 0;
while ($srow = sqlFetchArray($sres)) {
  ++$prod_lino;
  $pline = $_POST['prod']["$prod_lino"];
  $rx    = !empty($srow['prescription_id']);
  $del   = $pline['del']; // preserve Delete if checked
  $sale_id = $srow['sale_id'];
  $drug_id = $srow['drug_id'];
  $units   = $srow['quantity'];
  $fee     = $srow['fee'];
  $billed  = $srow['billed'];
  // Also preserve other items from the form, if present and unbilled.
  if ($pline['sale_id'] && !$srow['billed']) {
    // $units      = trim($pline['units']);
    // $fee        = trim($pline['fee']);
    $units = max(1, intval(trim($pline['units'])));
    $fee   = sprintf('%01.2f',(0 + trim($pline['price'])) * $units);
    $rx    = !empty($pline['rx']);
  }
  echoProdLine($prod_lino, $drug_id, $rx, $del, $units, $fee, $sale_id, $billed);
}

// Echo new product items from this form here, but omit any line
// whose Delete checkbox is checked.
//
if ($_POST['prod']) {
  foreach ($_POST['prod'] as $key => $iter) {
    if ($iter["sale_id"])  continue; // skip if it came from the database
    if ($iter["del"]) continue; // skip if Delete was checked
    // $fee = 0 + trim($iter['fee']);
    $units = max(1, intval(trim($iter['units'])));
    $fee   = sprintf('%01.2f',(0 + trim($iter['price'])) * $units);
    $rx    = !empty($iter['rx']); // preserve Rx if checked
    echoProdLine(++$prod_lino, $iter['drug_id'], $rx, FALSE, $units, $fee);
  }
}

// If new billing code(s) were <select>ed, add their line(s) here.
//
if ($_POST['newcodes']) {
  $arrcodes = explode('~', $_POST['newcodes']);
  foreach ($arrcodes as $codestring) {
    if ($codestring === '') continue;
    $arrcode = explode('|', $codestring);
    $newtype = $arrcode[0];
    $newcode = $arrcode[1];
    $newsel  = $arrcode[2];
    if ($newtype == 'COPAY') {
      $tmp = sqlQuery("SELECT copay FROM insurance_data WHERE pid = '$pid' " .
        "AND type = 'primary' ORDER BY date DESC LIMIT 1");
      $code = sprintf('%01.2f', 0 + $tmp['copay']);
      echoLine(++$bill_lino, $newtype, $code, '', '', '1', '0', '1',
        sprintf('%01.2f', 0 - $code));
    }
    else if ($newtype == 'PROD') {
      $result = sqlQuery("SELECT dt.quantity, d.route " .
        "FROM drug_templates AS dt, drugs AS d WHERE " .
        "dt.drug_id = '$newcode' AND dt.selector = '$newsel' AND " .
        "d.drug_id = dt.drug_id");
      $units = max(1, intval($result['quantity']));
      // By default create a prescription if drug route is set.
      $rx = !empty($result['route']);
      $prrow = sqlQuery("SELECT prices.pr_price " .
        "FROM patient_data, prices WHERE " .
        "patient_data.pid = '$pid' AND " .
        "prices.pr_id = '$newcode' AND " .
        "prices.pr_selector = '$newsel' AND " .
        "prices.pr_level = patient_data.pricelevel " .
        "LIMIT 1");
      $fee = empty($prrow) ? 0 : $prrow['pr_price'];
      echoProdLine(++$prod_lino, $newcode, $rx, FALSE, $units, $fee);
    }
    else {
      list($code, $modifier) = explode(":", $newcode);
      $ndc_info = '';
      // If HCPCS, find last NDC string used for this code.
      if ($newtype == 'HCPCS' && $ndc_applies) {
        $tmp = sqlQuery("SELECT ndc_info FROM billing WHERE " .
          "code_type = '$newtype' AND code = '$code' AND ndc_info LIKE 'N4%' " .
          "ORDER BY date DESC LIMIT 1");
        if (!empty($tmp)) $ndc_info = $tmp['ndc_info'];
      }
      echoLine(++$bill_lino, $newtype, $code, trim($modifier), $ndc_info);
    }
  }
}

$tmp = sqlQuery("SELECT provider_id, supervisor_id FROM form_encounter " .
  "WHERE pid = '$pid' AND encounter = '$encounter' " .
  "ORDER BY id DESC LIMIT 1");
$encounter_provid = 0 + $tmp['provider_id'];
$encounter_supid  = 0 + $tmp['supervisor_id'];
?>
</table>
</p>

<br />
&nbsp;

<?php
// Choose rendering and supervising providers.
echo "<span class='billcell'><b>\n";
echo xl('Providers') . ": &nbsp;";

echo "&nbsp;&nbsp;" . xl('Rendering') . "\n";
genProviderSelect('ProviderID', '-- Please Select --', $encounter_provid, $isBilled);

if (!$GLOBALS['ippf_specific']) {
  echo "&nbsp;&nbsp;" . xl('Supervising') . "\n";
  genProviderSelect('SupervisorID', '-- N/A --', $encounter_supid, $isBilled);
}

echo "<input type='button' value='" . xl('New Appointment') . "' onclick='newEvt()' />\n";

echo "</b></span>\n";
?>

<p>
&nbsp;

<?php
/*********************************************************************
// If applicable, ask for the contraceptive services start date.
if ($contraception_code && !$isBilled) {
  $csrow = sqlQuery("SELECT COUNT(*) AS count FROM forms AS f WHERE " .
    "f.pid = '$pid' AND f.encounter = '$encounter' AND " .
    "f.formdir = 'LBFcontra' AND f.deleted = 0");
  // Do it only if a contraception form does not already exist for this visit.
  // Otherwise assume that whoever created it knows what they were doing.
  if ($csrow['count'] == 0) {
    $date1 = substr($visit_row['date'], 0, 10);
    $servicemeth = '';
    // If surgical
    if (preg_match('/^12/', $contraception_code)) {
      // Identify the method with the IPPF code for the corresponding surgical procedure.
      $servicemeth = substr($contraception_code, 0, 7) . '13';
    }
    else {
      // Determine if this client ever started contraception with the MA.
      $csrow = sqlQuery("SELECT f.form_id FROM forms AS f " .
        "JOIN lbf_data AS d1 ON d1.form_id = f.form_id AND d1.field_id = 'contratype' AND " .
        "(d1.field_value = '2' OR d1.field_value = 3) " .
        // "JOIN lbf_data AS d2 ON d2.form_id = f.form_id AND d2.field_id = 'contrastart' " .
        "WHERE f.pid = '$pid' AND " .
        "f.formdir = 'LBFcontra' AND " .
        "f.deleted = 0 " .
        "ORDER BY f.form_id DESC LIMIT 1");
      if (empty($csrow)) {
        // Identify the method with its IPPF code for Initial Consultation.
        $servicemeth = substr($contraception_code, 0, 6) . '110';
      }
    }
    if ($servicemeth) {
      // Xavier confirms that the codes for Cervical Cap (112152010 and 112152011) are
      // an unintended change in pattern, but at this point we have to live with it.
      // -- Rod 2011-09-26
      if ($servicemeth == '112152110') $servicemeth = '112152010';
      // Contraception visit form types are:
      // 1 - starting for lifetime, not ma (not applicable here)
      // 2 - starting for ma, not lifetime
      // 3 - starting for both lifetime and ma (default)
      // 4 - change of method, not a new user (not applicable here)
      // 5 - not choosing contraception (contrastart is null)
      echo "   <select name='contrasel' onchange='contrasel_changed(this);'>\n";
      //
      // // Check the Contraception Event Types list to see if the Lifetime option applies.
      // $tmp = sqlQuery("SELECT COUNT(*) AS count FROM list_options WHERE " .
      //   "list_id = 'contratype' AND option_id = '1'");
      // if (empty($tmp['count'])) {
      //   echo "    <option value='2'>" . xl('Starting contraception') . "</option>\n";
      // }
      // else {
      //   echo "    <option value='3'>" . xl('Starting contraception for lifetime') . "</option>\n";
      //   echo "    <option value='2'>" . xl('Starting for MA but not lifetime') . "</option>\n";
      // }
      // echo "    <option value='5'>" . xl('Refusing contraception') . "</option>\n";
      //
      // Meeting with LV and AM on 2011-12-15 we decided that until the full contraception
      // form is implemented (in a couple of weeks), only these choices are applicable:
      echo "    <option value='2'>" . xl('Starting contraception at association') . "</option>\n";
      echo "    <option value='4'>" . xl('Method change') . "</option>\n";
      // Another side note: We are not responsible here for collecting old contraception
      // start data. Reporting will only be valid going forward.
      //
      echo "   </select>\n";
      //
      echo "<span id='contrasel_span' style='visibility:visible'> " . xl('on') . " ";
      echo "<input type='text' name='contrastart' id='contrastart' size='10' value='$date1' " .
        "onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' /> " .
        "<img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22' " .
        "id='img_contrastart' border='0' alt='[?]' style='cursor:pointer' " .
        "title='" . xl('Click here to choose a date') . "' />\n";
      echo ' ' . xl('using') . ' ';
      echo generate_select_list('ippfconmeth', 'ippfconmeth', $servicemeth, '');
      echo "</span><p>&nbsp;\n";
    }
  }
}
*********************************************************************/

if ($contraception_code && !$isBilled) {
  // If surgical
  if (preg_match('/^12/', $contraception_code)) {
    // Identify the method with the IPPF code for the corresponding surgical procedure.
    $contraception_code = substr($contraception_code, 0, 7) . '13';
  }
  else {
    // Xavier confirms that the codes for Cervical Cap (112152010 and 112152011) are
    // an unintended change in pattern, but at this point we have to live with it.
    // -- Rod 2011-09-26
    $contraception_code = substr($contraception_code, 0, 6) . '110';
    if ($contraception_code == '112152110') $contraception_code = '112152010';
  }

  // This will give the form save logic the associated contraceptive method.
  echo "<input type='hidden' name='ippfconmeth' value='$contraception_code'>\n";

  // If Contraception forms can be auto-created by the Fee Sheet we might need
  // to ask if this is the client's first contraception at this clinic.
  //
  if ($GLOBALS['gbl_new_acceptor_policy'] == '1') {
    $csrow = sqlQuery("SELECT COUNT(*) AS count FROM forms AS f WHERE " .
      "f.pid = '$pid' AND f.encounter = '$encounter' AND " .
      "f.formdir = 'LBFccicon' AND f.deleted = 0");
    // Do it only if a contraception form does not already exist for this visit.
    // Otherwise assume that whoever created it knows what they were doing.
    if ($csrow['count'] == 0) {
      $date1 = substr($visit_row['date'], 0, 10);
      $ask_new_user = false;
      // If surgical
      if (preg_match('/^12/', $contraception_code)) {
        // Identify the method with the IPPF code for the corresponding surgical procedure.
        $ask_new_user = true;
      }
      else {
        // Determine if this client ever started contraception with the MA.
        // Even if only a method change, we assume they have.
        /***************************************************************
        // But this version would be used if method changes don't count.
        $query = "SELECT f.form_id FROM forms AS f " .
          "JOIN form_encounter AS fe ON fe.pid = f.pid AND fe.encounter = f.encounter " .
          "JOIN lbf_data AS d1 ON d1.form_id = f.form_id AND d1.field_id = 'newmethod' " .
          "LEFT JOIN lbf_data AS d2 ON d2.form_id = f.form_id AND d2.field_id = 'newmauser' " .
          "WHERE f.formdir = 'LBFccicon' AND f.deleted = 0 AND f.pid = '$pid' AND " .
          "(d1.field_value LIKE '12%' OR (d2.field_value IS NOT NULL AND d2.field_value = '1')) " .
          "ORDER BY fe.date DESC LIMIT 1";
        ***************************************************************/
        $query = "SELECT f.form_id FROM forms AS f " .
          "JOIN form_encounter AS fe ON fe.pid = f.pid AND fe.encounter = f.encounter " .
          "WHERE f.formdir = 'LBFccicon' AND f.deleted = 0 AND f.pid = '$pid' " .
          "ORDER BY fe.date DESC LIMIT 1";
        $csrow = sqlQuery($query);
        if (empty($csrow)) {
          $ask_new_user = true;
        }
      }
      if ($ask_new_user) {
        echo "<select name='newmauser'>\n";
        echo " <option value='1'>" . xl('First contraception at this clinic') . "</option>\n";
        echo " <option value='0'>" . xl('Method change') . "</option>\n";
        echo "</select>\n";
        echo "<p>&nbsp;\n";
      }
    }
  }
}

// If there is a choice of warehouses, allow override of user default.
if ($prod_lino > 0) { // if any products are in this form
  $trow = sqlQuery("SELECT count(*) AS count FROM list_options WHERE list_id = 'warehouse'");
  if ($trow['count'] > 1) {
    $trow = sqlQuery("SELECT default_warehouse FROM users WHERE username = '" .
      $_SESSION['authUser'] . "'");
    echo "   <span class='billcell'><b>" . xl('Warehouse') . ":</b></span>\n";
    echo generate_select_list('default_warehouse', 'warehouse',
      $trow['default_warehouse'], '');
    echo "&nbsp; &nbsp; &nbsp;\n";
  }
}

// Allow the patient price level to be fixed here.
$plres = sqlStatement("SELECT option_id, title FROM list_options " .
  "WHERE list_id = 'pricelevel' ORDER BY seq");
if (true) {
  $trow = sqlQuery("SELECT pricelevel FROM patient_data WHERE " .
    "pid = '$pid' LIMIT 1");
  $pricelevel = $trow['pricelevel'];
  echo "   <span class='billcell'><b>" . xl('Price Level') . ":</b></span>\n";
  echo "   <select name='pricelevel'";
  if ($isBilled) echo " disabled";
  echo ">\n";
  while ($plrow = sqlFetchArray($plres)) {
    $key = $plrow['option_id'];
    $val = $plrow['title'];
    echo "    <option value='$key'";
    if ($key == $pricelevel) echo ' selected';
    echo ">$val</option>\n";
  }
  echo "   </select>\n";
}
?>

&nbsp; &nbsp; &nbsp;

<?php if (!$isBilled) { ?>
<input type='submit' name='bn_save' value='<?php xl('Save','e');?>'
<?php if ($rapid_data_entry) echo " style='background-color:#cc0000';color:#ffffff'"; ?>
/>
&nbsp;
<?php if ($GLOBALS['ippf_specific']) { ?>
<?php if ($hasCharges) { ?>
<input type='submit' name='bn_save_close' value='<?php xl('Save and Checkout','e');?>' />
<?php } else { ?>
<input type='submit' name='bn_save_close' value='<?php xl('Save and Close','e');?>' />
<?php } // end no charges ?>
&nbsp;
<?php } ?>
<input type='submit' name='bn_refresh' onclick='return this.clicked = true;'
 value='<?php xl('Refresh','e');?>'>
&nbsp;
<?php } ?>
<input type='hidden' name='form_has_charges' value='<?php echo $hasCharges ? 1 : 0; ?>' />

<input type='button' value='<?php xl('Cancel','e');?>'
 onclick="top.restoreSession();location='<?php echo "$rootdir/patient_file/encounter/$returnurl" ?>'" />

<?php if ($code_types['UCSMC']) { ?>
<p style='font-family:sans-serif;font-size:8pt;color:#666666;'>
&nbsp;<br>
<?php xl('UCSMC codes provided by the University of Calgary Sports Medicine Centre','e');?>
</p>
<?php } ?>

</center>

</form>

<?php
// TBD: If $alertmsg, display it with a JavaScript alert().
?>

<script language='JavaScript'>
/*********************************************************************
if (document.getElementById('img_contrastart')) {
 Calendar.setup({inputField:"contrastart", ifFormat:"%Y-%m-%d", button:"img_contrastart"});
}
*********************************************************************/
var required_code_count = <?php echo $required_code_count; ?>;
setSaveAndClose();
<?php echo $justinit; ?>
</script>

</body>
</html>
