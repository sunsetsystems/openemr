<?php
// Copyright (C) 2006-2013 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

require_once("../globals.php");
require_once("$srcdir/acl.inc");
require_once("drugs.inc.php");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/options.inc.php");

function QuotedOrNull($fld) {
  if ($fld) return "'$fld'";
  return "NULL";
}

function checkWarehouseUsed($warehouse_id) {
  global $drug_id;
  $row = sqlQuery("SELECT count(*) AS count FROM drug_inventory WHERE " .
    "drug_id = '$drug_id' AND " .
    "destroy_date IS NULL AND warehouse_id = '$warehouse_id'");
  return $row['count'];
}

// Generate a <select> list of warehouses.
// If multiple lots are not allowed for this product, then restrict the
// list to warehouses that are unused for the product.
// Returns the number of warehouses allowed.
// For these purposes the "unassigned" option is considered a warehouse.
//
function genWarehouseList($tag_name, $currvalue, $title, $class='') {
  global $drug_id;

  $drow = sqlQuery("SELECT allow_multiple FROM drugs WHERE drug_id = '$drug_id'");
  $allow_multiple = $drow['allow_multiple'];

  $lres = sqlStatement("SELECT * FROM list_options " .
    "WHERE list_id = 'warehouse' ORDER BY seq, title");

  echo "<select name='$tag_name' id='$tag_name'";
  if ($class) echo " class='$class'";
  echo " title='$title'>";

  $got_selected = FALSE;
  $count = 0;

  if ($allow_multiple /* || !checkWarehouseUsed('') */) {
    echo "<option value=''>" . xl('Unassigned') . "</option>";
    ++$count;
  }

  while ($lrow = sqlFetchArray($lres)) {
    $whid = $lrow['option_id'];
    $facid = 0 + $lrow['option_value'];
    if ($whid != $currvalue && !$allow_multiple && checkWarehouseUsed($whid)) continue;
    // Value identifies both warehouse and facility to support validation.
    echo "<option value='$whid|$facid'";
    if ((strlen($currvalue) == 0 && $lrow['is_default']) ||
        (strlen($currvalue)  > 0 && $whid == $currvalue))
    {
      echo " selected";
      $got_selected = TRUE;
    }
    echo ">" . $lrow['title'] . "</option>\n";

    ++$count;
  }

  if (!$got_selected && strlen($currvalue) > 0) {
    $currescaped = htmlspecialchars($currvalue, ENT_QUOTES);
    echo "<option value='$currescaped' selected>* $currescaped *</option>";
    echo "</select>";
    echo " <font color='red' title='" .
      xl('Please choose a valid selection from the list.') . "'>" .
      xl('Fix this') . "!</font>";
  }
  else {
    echo "</select>";
  }

  return $count;
}

$drug_id = $_REQUEST['drug'] + 0;
$lot_id  = $_REQUEST['lot'] + 0;
$info_msg = "";

$form_trans_type = isset($_POST['form_trans_type']) ? formData('form_trans_type') : '0';

if (!acl_check('admin', 'drugs')) die(xl('Not authorized'));
if (!$drug_id) die(xl('Drug ID missing!'));
?>
<html>
<head>
<?php html_header_show();?>
<title><?php echo $lot_id ? xl("Edit") : xl("Add New"); xl('Lot','e',' '); ?></title>
<link rel="stylesheet" href='<?php echo $css_header ?>' type='text/css'>

<style>
td { font-size:10pt; }
</style>

<style  type="text/css">@import url(../../library/dynarch_calendar.css);</style>
<script type="text/javascript" src="../../library/textformat.js"></script>
<script type="text/javascript" src="../../library/dynarch_calendar.js"></script>
<script type="text/javascript" src="../../library/dynarch_calendar_en.js"></script>
<script type="text/javascript" src="../../library/dynarch_calendar_setup.js"></script>

<script language="JavaScript">

 var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';

 function validate() {
  var f = document.forms[0];

  // Get source and target facility IDs.
  var facfrom = 0;
  var facto = 0;
  var a = f.form_source_lot.value.split('|', 2);
  var lotfrom = parseInt(a[0]);
  if (a.length > 1) facfrom = parseInt(a[1]);
  a = f.form_warehouse_id.value.split('|', 2);
  if (a.length > 1) facto = parseInt(a[1]);

  if (lotfrom == '0' && f.form_lot_number.value.search(/\S/) < 0) {
   alert('<?php xl('A lot number is required','e'); ?>');
   return false;
  }
  /*******************************************************************
  if (f.form_trans_type.value == '6' && f.form_distributor_id.value == '') {
   alert('<?php xl('A distributor is required','e'); ?>');
   return false;
  }
  *******************************************************************/

  // Check the case of a transfer between different facilities.
  if (f.form_trans_type.value == '4' && facto != facfrom) {
   if (!confirm('<?php echo xl('Warning: Source and target facilities differ. Continue anyway?'); ?>'))
    return false;
  }

  return true;
 }

 function trans_type_changed() {
  var f = document.forms[0];
  var sel = f.form_trans_type;
  var type = sel.options[sel.selectedIndex].value;
  var showQuantity  = true;
  var showSaleDate  = true;
  var showCost      = true;
  var showSourceLot = true;
  var showNotes     = true;
  var showDistributor = false;
  if (type == '2') { // purchase
    showSourceLot = false;
  }
  else if (type == '3') { // return
    showSourceLot = false;
  }
  /*******************************************************************
  else if (type == '6') { // distribution
    showSourceLot = false;
    showDistributor = true;
  }
  *******************************************************************/
  else if (type == '4') { // transfer
    showCost = false;
  }
  else if (type == '5') { // adjustment
    showCost = false;
    showSourceLot = false;
  }
  else {
    showQuantity  = false;
    showSaleDate  = false;
    showCost      = false;
    showSourceLot = false;
    showNotes     = false;
  }
  document.getElementById('row_quantity'  ).style.display = showQuantity  ? '' : 'none';
  document.getElementById('row_sale_date' ).style.display = showSaleDate  ? '' : 'none';
  document.getElementById('row_cost'      ).style.display = showCost      ? '' : 'none';
  document.getElementById('row_source_lot').style.display = showSourceLot ? '' : 'none';
  document.getElementById('row_notes'     ).style.display = showNotes     ? '' : 'none';
  // document.getElementById('row_distributor').style.display = showDistributor ? '' : 'none';
 }

</script>

</head>

<body class="body_top">
<?php
if ($lot_id) {
  $row = sqlQuery("SELECT * FROM drug_inventory WHERE drug_id = '$drug_id' " .
    "AND inventory_id = '$lot_id'");
}

// If we are saving, then save and close the window.
//
if ($_POST['form_save'] || $_POST['form_delete']) {

  $form_quantity = formData('form_quantity') + 0;
  $form_cost = sprintf('%0.2f', formData('form_cost'));

  list($form_source_lot, $form_source_facility) = explode('|', formData('form_source_lot'));
  $form_source_lot = intval($form_source_lot);

  list($form_warehouse_id) = explode('|', formData('form_warehouse_id'));

  $form_distributor_id = formData('form_distributor_id') + 0;

  // Some fixups depending on transaction type.
  if ($form_trans_type == '3') { // return
    $form_quantity = 0 - $form_quantity;
    $form_cost = 0 - $form_cost;
  }
  else if ($form_trans_type == '5') { // adjustment
    $form_cost = 0;
  }
  else if ($form_trans_type == '0') { // no transaction
    $form_quantity = 0;
    $form_cost = 0;
  }
  else if ($form_trans_type == '6') { // distribution
    $form_quantity = 0 - $form_quantity;
    $form_cost = 0 - $form_cost;
  }
  if ($form_trans_type != '4') { // not transfer
    $form_source_lot = 0;
  }
  if ($form_trans_type != '6') { // not distribution
    $form_distributor_id = '0';
  }

  // If a transfer, make sure there is sufficient quantity in the source lot.
  if ($form_save && $form_source_lot && $form_quantity) {
    $srow = sqlQuery("SELECT on_hand FROM drug_inventory WHERE " .
      "drug_id = '$drug_id' AND inventory_id = '$form_source_lot'");
    if ($srow['on_hand'] < $form_quantity) {
        $info_msg = xl('Transfer failed, insufficient quantity in source lot');
    }
  }

  if (!$info_msg) {
    // Destination lot already exists.
    if ($lot_id) {
      if ($_POST['form_save']) {
        // Make sure the destination quantity will not end up negative.
        if (($row['on_hand'] + $form_quantity) < 0) {
          $info_msg = xl('Transaction failed, insufficient quantity in destination lot');
        }
        else {
          sqlStatement("UPDATE drug_inventory SET " .
            "lot_number = '"   . formData('form_lot_number')    . "', " .
            "manufacturer = '" . formData('form_manufacturer')  . "', " .
            "expiration = "    . QuotedOrNull($form_expiration) . ", "  .
            "vendor_id = '"    . formData('form_vendor_id')     . "', " .
            "warehouse_id = '" . $form_warehouse_id             . "', " .
            "on_hand = on_hand + '" . $form_quantity            . "' "  .
            "WHERE drug_id = '$drug_id' AND inventory_id = '$lot_id'");
        }
      }
      else {
        sqlStatement("DELETE FROM drug_inventory WHERE drug_id = '$drug_id' " .
          "AND inventory_id = '$lot_id'");
      }
    }
    // Destination lot will be created.
    else {
      if ($form_quantity < 0) {
        $info_msg = xl('Transaction failed, quantity is less than zero');
      }
      else {
        $exptest = $form_expiration ? "expiration = '$form_expiration'" : "expiration IS NULL";
        $crow = sqlQuery("SELECT count(*) AS count from drug_inventory " .
          "WHERE lot_number = '" . formData('form_lot_number') . "' " .
          "AND warehouse_id = '" . $form_warehouse_id          . "' " .
          "AND $exptest " .
          "AND destroy_date IS NULL");
        if ($crow['count']) {
          $info_msg = xl('Transaction failed, duplicate lot');
        }
        else {
          $lot_id = sqlInsert("INSERT INTO drug_inventory ( " .
            "drug_id, lot_number, manufacturer, expiration, " .
            "vendor_id, warehouse_id, on_hand " .
            ") VALUES ( " .
            "'$drug_id', "                            .
            "'" . formData('form_lot_number')   . "', " .
            "'" . formData('form_manufacturer') . "', " .
            QuotedOrNull($form_expiration)      . ", "  .
            "'" . formData('form_vendor_id')    . "', " .
            "'" . $form_warehouse_id            . "', " .
            "'" . $form_quantity                . "' "  .
            ")");
        }
      }
    }

    // Create the corresponding drug_sales transaction.
    if ($_POST['form_save'] && $form_quantity && $form_trans_type && !$info_msg) {
      $form_notes = formData('form_notes');
      $form_sale_date = formData('form_sale_date');
      if (empty($form_sale_date)) $form_sale_date = date('Y-m-d');
      sqlInsert("INSERT INTO drug_sales ( " .
        "drug_id, inventory_id, prescription_id, pid, encounter, user, sale_date, " .
        "quantity, fee, xfer_inventory_id, distributor_id, notes, trans_type " .
        ") VALUES ( " .
        "'$drug_id', '$lot_id', '0', '0', '0', " .
        "'" . $_SESSION['authUser'] . "', " .
        "'$form_sale_date', " .
        "'" . (0 - $form_quantity)  . "', " .
        "'" . (0 - $form_cost)      . "', " .
        "'$form_source_lot', " .
        "'$form_distributor_id', " .
        "'$form_notes', " .
        "'$form_trans_type' )");

      // If this is a transfer then reduce source QOH, and also copy some
      // fields from the source when they are missing.
      if ($form_source_lot) {
        sqlStatement("UPDATE drug_inventory SET " .
          "on_hand = on_hand - '$form_quantity' " .
          "WHERE inventory_id = '$form_source_lot'");

        foreach (array('lot_number', 'manufacturer', 'expiration', 'vendor_id') as $item) {
          sqlStatement("UPDATE drug_inventory AS di1, drug_inventory AS di2 " .
            "SET di1.$item = di2.$item " .
            "WHERE di1.inventory_id = '$lot_id' AND " .
            "di2.inventory_id = '$form_source_lot' AND " .
            "( di1.$item IS NULL OR di1.$item = '' OR di1.$item = '0' )");
        }
      }
    }
  } // end if not $info_msg

  // Close this window and redisplay the updated list of drugs.
  //
  echo "<script language='JavaScript'>\n";
  if ($info_msg) echo " alert('$info_msg');\n";
  echo " window.close();\n";
  echo " if (opener.refreshme) opener.refreshme();\n";
  echo "</script></body></html>\n";
  exit();
}
?>

<form method='post' name='theform' action='add_edit_lot.php?drug=<?php echo $drug_id ?>&lot=<?php echo $lot_id ?>'
 onsubmit='return validate()'>
<center>

<table border='0' width='100%'>

 <tr>
  <td valign='top' width='1%' nowrap><b><?php xl('Lot Number','e'); ?>:</b></td>
  <td>
   <input type='text' size='40' name='form_lot_number' maxlength='40' value='<?php echo $row['lot_number'] ?>' style='width:100%' />
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('Manufacturer','e'); ?>:</b></td>
  <td>
   <input type='text' size='40' name='form_manufacturer' maxlength='250' value='<?php echo $row['manufacturer'] ?>' style='width:100%' />
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('Expiration','e'); ?>:</b></td>
  <td>
   <input type='text' size='10' name='form_expiration' id='form_expiration'
    value='<?php echo $row['expiration'] ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)'
    title=<?php xl('yyyy-mm-dd date of expiration','e','\'','\''); ?> />
   <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_expiration' border='0' alt='[?]' style='cursor:pointer'
    title=<?php xl('Click here to choose a date','e','\'','\''); ?>>
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('Vendor','e'); ?>:</b></td>
  <td>
<?php
// Address book entries for vendors.
generate_form_field(array('data_type' => 14, 'field_id' => 'vendor_id',
  'list_id' => '', 'edit_options' => 'V',
  'description' => xl('Address book entry for the vendor')),
  $row['vendor_id']);
?>
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('Warehouse','e'); ?>:</b></td>
  <td>
<?php
  if (!genWarehouseList("form_warehouse_id", $row['warehouse_id'],
    xl('Location of this lot')))
  {
    $info_msg = xl('This product allows only one lot per warehouse.');
  }
?>
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('On Hand','e'); ?>:</b></td>
  <td>
   <?php echo $row['on_hand'] + 0; ?>
  </td>
 </tr>

 <tr>
  <td valign='top' nowrap><b><?php xl('Transaction','e'); ?>:</b></td>
  <td>
   <select name='form_trans_type' onchange='trans_type_changed()'>
<?php
foreach (array(
  '0' => xl('None'),
  '2' => xl('Purchase/Receipt'),
  '3' => xl('Return'),
  // '6' => xl('Distribution'),
  '4' => xl('Transfer'),
  '5' => xl('Adjustment'),
) as $key => $value)
{
  echo "<option value='$key'";
  if ($key == $form_trans_type) echo " selected";
  echo ">$value</option>\n";
}
?>
   </select>
  </td>
 </tr>

 <tr id='row_distributor'>
  <td valign='top' nowrap><b><?php xl('Distributor','e'); ?>:</b></td>
  <td>
<?php
// Address book entries for distributors.
generate_form_field(array('data_type' => 14, 'field_id' => 'distributor_id',
  'list_id' => '', 'edit_options' => 'R',
  'description' => xl('Address book entry for the distributor')), '');
?>
  </td>
 </tr>

 <tr id='row_sale_date'>
  <td valign='top' nowrap><b><?php xl('Date','e'); ?>:</b></td>
  <td>
   <input type='text' size='10' name='form_sale_date' id='form_sale_date'
    value='<?php echo date('Y-m-d') ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)'
    title=<?php xl('yyyy-mm-dd date of purchase or transfer','e','\'','\''); ?> />
   <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_sale_date' border='0' alt='[?]' style='cursor:pointer'
    title=<?php xl('Click here to choose a date','e','\'','\''); ?>>
  </td>
 </tr>

 <tr id='row_quantity'>
  <td valign='top' nowrap><b><?php xl('Quantity','e'); ?>:</b></td>
  <td>
   <input type='text' size='5' name='form_quantity' maxlength='7' />
  </td>
 </tr>

 <tr id='row_cost'>
  <td valign='top' nowrap><b><?php xl('Total Cost','e'); ?>:</b></td>
  <td>
   <input type='text' size='7' name='form_cost' maxlength='12' />
  </td>
 </tr>

 <tr id='row_source_lot'>
  <td valign='top' nowrap><b><?php xl('Source Lot','e'); ?>:</b></td>
  <td>
   <select name='form_source_lot'>
    <option value='0'> </option>
<?php
$lres = sqlStatement("SELECT " .
  "di.inventory_id, di.lot_number, di.on_hand, lo.title, lo.option_value " .
  "FROM drug_inventory AS di " .
  "LEFT JOIN list_options AS lo ON lo.list_id = 'warehouse' AND " .
  "lo.option_id = di.warehouse_id " .
  "WHERE di.drug_id = '$drug_id' AND di.inventory_id != '$lot_id' AND " .
  "di.on_hand > 0 AND di.destroy_date IS NULL " .
  "ORDER BY di.lot_number, lo.title, di.inventory_id");
while ($lrow = sqlFetchArray($lres)) {
  echo "<option value='" . $lrow['inventory_id'] . '|' . $lrow['option_value']  . "'>";
  echo $lrow['lot_number'];
  if (!empty($lrow['title'])) echo " / " . $lrow['title'];
  echo " (" . $lrow['on_hand'] . ")";
  echo "</option>\n";
}
?>
   </select>
  </td>
 </tr>

 <tr id='row_notes'>
  <td valign='top' nowrap><b><?php xl('Comments','e'); ?>:</b></td>
  <td>
   <input type='text' size='40' name='form_notes' maxlength='255' style='width:100%' />
  </td>
 </tr>

</table>

<p>
<input type='submit' name='form_save' value='<?php xl('Save','e'); ?>' />

<?php if ($lot_id) { ?>
&nbsp;
<input type='button' value='<?php xl('Destroy...','e'); ?>'
 onclick="window.location.href='destroy_lot.php?drug=<?php echo $drug_id ?>&lot=<?php echo $lot_id ?>'" />
<?php } ?>

&nbsp;
<input type='button' value='<?php xl('Cancel','e'); ?>' onclick='window.close()' />
</p>

</center>
</form>
<script language='JavaScript'>
 Calendar.setup({inputField:"form_expiration", ifFormat:"%Y-%m-%d", button:"img_expiration"});
 Calendar.setup({inputField:"form_sale_date", ifFormat:"%Y-%m-%d", button:"img_sale_date"});
<?php
if ($info_msg) {
  echo " alert('$info_msg');\n";
  echo " window.close();\n";
}
?>
trans_type_changed();
</script>
</body>
</html>
