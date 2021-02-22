<?php
// Copyright (C) 2019 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This provides common functions for the LBFcontra plug-in and others
// related to it.

require_once("../../../custom/code_types.inc.php");
require_once("../../../library/contraception_billing_scan.inc.php");

if (!$formid) {
  // Creating a new form, check if one already exists. If yes we'll use that instead.
  $row = sqlQuery("SELECT form_id FROM forms WHERE " .
    "pid = '$pid' AND encounter = '$encounter' AND formdir = '$formname' " .
    "AND deleted = 0 ORDER BY id DESC LIMIT 1");
  if (!empty($row)) {
    $GLOBALS['DUPLICATE_FORM_HANDLED'] = true;
    $formid = $row['form_id'];
  }
}

// The purpose of this function is to create JavaScript for the <head>
// section of the page.  This defines desired javaScript functions.
//
function LBFcontra_common_javascript() {
  global $formid;

  // Create a hash to map contrameth list IDs to an indicator of whether it is a modern method.
  echo "var contraMapping = new Object();\n";
  $res = sqlStatement("SELECT option_id, option_value FROM list_options WHERE " .
    "list_id = 'contrameth' AND activity = 1 ORDER BY seq, title");
  while ($row = sqlFetchArray($res)) {
    $mapping = $row['option_value'] ? '1' : '0';
    echo "contraMapping['" . $row['option_id'] . "'] = '$mapping';\n";
  }

  // Create a hash to map IPPFCM codes from ippfconmeth list to contrameth list IDs.
  echo "var ippfcmMapping = new Object();\n";
  $res = sqlStatement("SELECT option_id, notes FROM list_options WHERE " .
    "list_id = 'ippfconmeth' and activity = 1 ORDER BY option_id");
  while ($row = sqlFetchArray($res)) {
    echo "ippfcmMapping['" . addslashes($row['option_id']) . "'] = '" . addslashes($row['notes']) . "';\n";
  }

  echo "
var pastmodern_autoset = false;

// Get selected index of a select or radio group:
function getRBSelIndex(obj) {
  if (!obj.form) { // If not an Input element must be a checkbox group.
    for (var i = 0; i < obj.length; ++i) {
      if (obj[i].checked) return i + 1;
    }
  }
  else {
    return obj.selectedIndex;
  }
  return -1;
}

// Set selected index of a select or radio group:
function setRBSelIndex(obj, index) {
  if (!obj.form) {
    for (var i = 0; i < obj.length; ++i) {
      obj[i].checked = (i == index - 1);
    }
  }
  else {
    obj.selectedIndex = i;
  }
}

// Set disabled state of a select or radio group:
function disableRBSel(obj, dis) {
  if (!obj.form) {
    for (var i = 0; i < obj.length; ++i) {
      obj[i].disabled = dis;
    }
  }
  else {
    obj.disabled = dis;
  }
}

// Set onchange handler for a select or radio group:
function onchangeRBSel(obj) {
  if (!obj.form) {
    for (var i = 0; i < obj.length; ++i) {
      obj[i].onchange = function () { current_method_changed(); };
    }
  }
  else {
    obj.onchange = function () { current_method_changed(); };
  }
}

// Respond to selection of a current or new method, or a new value for form_cgen_newmauser.
// If (newmauser is unassigned or yes) and (current method is unassigned or not modern)
// then Past Modern is enabled, otherwise is disabled and auto-set to Yes.
// If current is assigned and not No Method and new method != current then ask reason for method change.
function current_method_changed() {
 var f = document.forms[0];
 disableRBSel(f.form_cgen_PastModern, true);
 f.form_cgen_MethChgReas.disabled = true;
 if (getRBSelIndex(f.form_cgen_newmauser) != 1 &&
     (f.form_cgen_MethCurr.selectedIndex <= 0 ||
      !ippfcmMapping[f.form_cgen_MethCurr.value] ||
      !contraMapping[ippfcmMapping[f.form_cgen_MethCurr.value]] ||
      contraMapping[ippfcmMapping[f.form_cgen_MethCurr.value]] == '0') &&
     !pastmodern_autoset)
 {
  disableRBSel(f.form_cgen_PastModern, false);
 }
 else {
  setRBSelIndex(f.form_cgen_PastModern, 2);
 }
 if (f.form_cgen_MethCurr.selectedIndex > 0) {
  // Here there is a selected current method.  Check if it is the same contrameth list type
  // that the new method relates to.  If not, enable the reason for change selector.
  // A missing related contrameth ID indicates No Method and method change reason is disabled.
  var ippfcm = f.form_cgen_MethAdopt.value.substring(7);
  var cvalue = f.form_cgen_MethCurr.value;
  if (ippfcmMapping[cvalue] && ippfcmMapping[ippfcm] && ippfcmMapping[cvalue] != ippfcmMapping[ippfcm]) {
   f.form_cgen_MethChgReas.disabled = false;
  }
 }
}

// Hook function called from LBF/new.php.
function billing_code_onchange() {
 current_method_changed();
}
";

  echo "
// Enable some form fields before submitting.
// This is because disabled fields do not submit their data, however
// we do want to save the default values that were set for them.
function mysubmit() {
 var f = document.forms[0];
 if (!validate(f)) return false;
 disableRBSel(f.form_cgen_newmauser, false);
 disableRBSel(f.form_cgen_PastModern, false);
 f.form_cgen_MethAdopt.disabled = false;
 if (f.form_cgen_provider) f.form_cgen_provider.disabled = false;
 f.form_cgen_MethChgReas.disabled = false;
 return true;
}
";
}

// The purpose of this function is to create JavaScript that is run
// once when the page is loaded.
//
function LBFcontra_common_javascript_onload() {
  global $formid, $pid, $encounter;
  global $contraception_billing_code, $contraception_billing_prov;
  global $code_types, $contraception_billing_desc;

  $encrow = sqlQuery("SELECT date, provider_id FROM form_encounter " .
    "WHERE pid = '$pid' AND encounter = '$encounter' " .
    "ORDER BY id DESC LIMIT 1");
  $encdate = $encrow['date'];

  // Get the normalized IPPFCM contraception code "$contraception_billing_code",
  // if any, indicated by the services in the visit.  This call returns
  // TRUE if there is one, otherwise FALSE.  Also set is the provider
  // of that service, $contraception_billing_prov.
  //
  $newdisabled = contraception_billing_scan($pid, $encounter, $encrow['provider_id']) ? 'true' : 'false';

  // Get the description of the contraceptive method.
  $contraception_billing_desc = '';
  if ($contraception_billing_code) {
    $tmp = sqlQuery("SELECT code_text FROM codes WHERE " .
      "code_type = ? AND code = ?",
      array($code_types['IPPFCM']['id'], $contraception_billing_code));
    if (!empty($tmp['code_text'])) {
      $contraception_billing_desc = addslashes($tmp['code_text']);
    }
  }

  // Get details of previous instances of this form.
  // * "First contraception at this clinic" should be auto-set to NO
  //   and disabled if that question was answered previously.
  // * "Previous modern contraceptive use" should auto-set to YES
  //   and disabled it was YES previously, or if a modern method was
  //   indicated in a previous instance of the form.
  //
  $newmauser_autoset = false;
  $pastmodern_autoset = false;
  $js_extra = "";
  $prvres = sqlStatement("SELECT " .
    "d1.field_value AS newmauser, " .
    "d2.field_value AS pastmodern, " .
    "d3.field_value AS newmethod " .
    "FROM form_encounter AS fe " .
    "     JOIN shared_attributes AS d1 ON d1.pid = fe.pid AND d1.encounter = fe.encounter AND d1.field_id = 'cgen_newmauser' " .
    "LEFT JOIN shared_attributes AS d2 ON d2.pid = fe.pid AND d2.encounter = fe.encounter AND d2.field_id = 'cgen_PastModern' " .
    "LEFT JOIN shared_attributes AS d3 ON d3.pid = fe.pid AND d3.encounter = fe.encounter AND d3.field_id = 'cgen_MethAdopt' " .
    "WHERE fe.pid = ? AND fe.encounter != ? AND fe.date <= ? " .
    "ORDER BY fe.date DESC, fe.encounter DESC",
    array($pid, $encounter, $encdate));
  while ($prvrow = sqlFetchArray($prvres)) {
    $newmauser_autoset = true;
    if (!empty($prvrow['pastmodern']) || !empty($prvrow['newmethod'])) {
      $pastmodern_autoset = true;
    }
  }
  if ($newmauser_autoset) {
    $js_extra .=
      "// There was a previous instance of this data so we know they are not a new MA user.\n" .
      "setRBSelIndex(f.form_cgen_newmauser, 1);\n" .
      "disableRBSel(f.form_cgen_newmauser, true);\n";
    if ($pastmodern_autoset) {
      $js_extra .=
        "\n// Past Modern must also be true now.\n" .
        "setRBSelIndex(f.form_cgen_PastModern, 2);\n" .
        "disableRBSel(f.form_cgen_PastModern, true);\n" .
        "pastmodern_autoset = true;\n";
    }
  }

  echo "
var f = document.forms[0];
var sel;

$js_extra

current_method_changed();

f.form_cgen_MethAdopt.disabled = $newdisabled;
if (f.form_cgen_MethAdopt__desc) {
 f.form_cgen_MethAdopt__desc.disabled = $newdisabled;
}
if ('$contraception_billing_code') {
 f.form_cgen_MethAdopt.value = 'IPPFCM:$contraception_billing_code';
 if (f.form_cgen_MethAdopt__desc) {
  f.form_cgen_MethAdopt__desc.value = '$contraception_billing_desc';
 }
}

sel = f.form_cgen_provider;
if (sel) {
 sel.disabled = $newdisabled;
 for (var i = 0; i < sel.options.length; ++i) {
  if (sel.options[i].value == '$contraception_billing_prov') {
   sel.selectedIndex = i;
   break;
  }
 }
 if (sel.selectedIndex == 0) sel.disabled = false;
}

onchangeRBSel(f.form_cgen_newmauser);
f.form_cgen_MethCurr.onchange = function () { current_method_changed(); };
// f.form_cgen_MethAdopt.onchange = function () { current_method_changed(); };
f.onsubmit = function () { return mysubmit(); };
";

  if (!empty($GLOBALS['DUPLICATE_FORM_HANDLED'])) {
    echo "
alert('" . xl('A Contraception Summary form already exists for this visit and has been opened here.') . "');
";
  }
  // Generate alert if method from services is different from a non-empty adopted method in this visit.
  $csrow = sqlQuery(
    "SELECT field_value FROM shared_attributes WHERE pid = ? AND encounter = ? AND field_id = 'cgen_MethAdopt'",
    array($pid, $encounter)
  );
  if (!empty($csrow['field_value']) && substr($csrow['field_value'], 7) != $contraception_billing_code) {
    echo "
alert('" . xl('Contraceptive method selected on Tally Sheet does not match Adopted Method on this form. Please resave the form with correct information.') . "');
";
  }
}

// This function generates HTML to go after the Save button.
//
function LBFcontra_common_additional_buttons() {
  global $formid, $pid, $encounter;
  echo "&nbsp;<input type='submit' name='bn_save' " .
    "value='" . xl('Save and Tally Sheet') . "' />\n";
  // If we came from fee sheet Save and Checkout, then add that option here.
  if (!empty($_REQUEST['from_save_and_checkout'])) {
    echo "&nbsp;<input type='submit' name='bn_save_checkout' " .
      "value='" . xl('Save and Checkout') . "' />\n";
  }
}

// Custom logic to run at end of save handler.
// We might redirect to the Tally Sheet or the checkout form.
//
function LBFcontra_common_save_exit() {
  global $pid, $encounter, $rootdir;
  if (!empty($_POST['bn_save']) && $_POST['bn_save'] == xl('Save and Tally Sheet')) {
    formJump("$rootdir/patient_file/encounter/load_form.php?formname=fee_sheet");
    formFooter();
    return true;
  }
  if (!empty($_POST['bn_save_checkout'])) {
    formJump("$rootdir/patient_file/pos_checkout.php?framed=1ptid=$pid&enid=$encounter");
    formFooter();
    return true;
  }
  return false;
}

// PHP end tag omitted.
