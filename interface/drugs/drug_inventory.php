<?php

 // Copyright (C) 2006-2021 Rod Roark <rod@sunsetsystems.com>
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

require_once("../globals.php");
require_once("drugs.inc.php");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Core\Header;

// Check authorization.
$thisauth = AclMain::aclCheckCore('admin', 'drugs');
if (!$thisauth) {
    die(xlt('Not authorized'));
}

// For each sorting option, specify the ORDER BY argument.
//
$ORDERHASH = array(
  'prod' => 'd.name, d.drug_id, di.expiration, di.lot_number',
  'ndc'  => 'd.ndc_number, d.name, d.drug_id, di.expiration, di.lot_number',
  'form' => 'lof.title, d.name, d.drug_id, di.expiration, di.lot_number',
  'lot'  => 'di.lot_number, d.name, d.drug_id, di.expiration',
  'wh'   => 'lo.title, d.name, d.drug_id, di.expiration, di.lot_number',
  'fac'  => 'f.name, d.name, d.drug_id, di.expiration, di.lot_number',    
  'qoh'  => 'di.on_hand, d.name, d.drug_id, di.expiration, di.lot_number',
  'exp'  => 'di.expiration, d.name, d.drug_id, di.lot_number',
);

$form_facility = 0 + empty($_REQUEST['form_facility']) ? 0 : $_REQUEST['form_facility'];
$form_show_empty = empty($_REQUEST['form_show_empty']) ? 0 : 1;
$form_show_inactive = empty($_REQUEST['form_show_inactive']) ? 0 : 1;

// Incoming form_warehouse, if not empty is in the form "warehouse/facility".
// The facility part is an attribute used by JavaScript logic.
$form_warehouse = empty($_REQUEST['form_warehouse']) ? '' : $_REQUEST['form_warehouse'];
$tmp = explode('/', $form_warehouse);
$form_warehouse = $tmp[0];

// Get the order hash array value and key for this request.
$form_orderby = isset($ORDERHASH[$_REQUEST['form_orderby'] ?? '']) ? $_REQUEST['form_orderby'] : 'prod';
$orderby = $ORDERHASH[$form_orderby];

$where = "WHERE 1 = 1";
if ($form_facility ) {
    $where .= " AND lo.option_value IS NOT NULL AND lo.option_value = '$form_facility'";
}
if ($form_warehouse) {
    $where .= " AND di.warehouse_id IS NOT NULL AND di.warehouse_id = '$form_warehouse'";
}
if (!$form_show_inactive) {
    $where .= " AND d.active = 1";
}

$dion = $form_show_empty ? "" : "AND di.on_hand != 0";

// get drugs
$res = sqlStatement("SELECT d.*, " .
  "di.inventory_id, di.lot_number, di.expiration, di.manufacturer, " .
  "di.on_hand, lo.title, lo.option_value AS facid, f.name AS facname " .
  "FROM drugs AS d " .
  "LEFT JOIN drug_inventory AS di ON di.drug_id = d.drug_id " .
  "AND di.destroy_date IS NULL $dion " .
  "LEFT JOIN list_options AS lo ON lo.list_id = 'warehouse' AND " .
  "lo.option_id = di.warehouse_id AND lo.activity = 1 " .
  "LEFT JOIN facility AS f ON f.id = lo.option_value " .         
  "LEFT JOIN list_options AS lof ON lof.list_id = 'drug_form' AND " .
  "lof.option_id = d.form AND lof.activity = 1 " .
  "$where ORDER BY d.active DESC, $orderby"
);

 function generateEmptyTd($n)
 {
     $temp = '';
     while ($n > 0) {
         $temp .= "<td></td>";
         $n--;
     }
     echo $temp;
 }
 function processData($data)
 {
     $data['inventory_id'] = [$data['inventory_id']];
     $data['lot_number'] = [$data['lot_number']];
     $data['facname'] =  [$data['facname']];
     $data['title'] =  [$data['title']];
     $data['on_hand'] = [$data['on_hand']];
     $data['expiration'] = [$data['expiration']];
     return $data;
 }
 function mergeData($d1, $d2)
 {
     $d1['inventory_id'] = array_merge($d1['inventory_id'], $d2['inventory_id']);
     $d1['lot_number'] = array_merge($d1['lot_number'], $d2['lot_number']);
     $d1['facname'] = array_merge($d1['facname'], $d2['facname']);
     $d1['title'] = array_merge($d1['title'], $d2['title']);
     $d1['on_hand'] = array_merge($d1['on_hand'], $d2['on_hand']);
     $d1['expiration'] = array_merge($d1['expiration'], $d2['expiration']);
     return $d1;
 }
 function mapToTable($row)
 {
    $today = date('Y-m-d');
     if ($row) {
         echo " <tr class='detail'>\n";
         $lastid = $row['drug_id'];
         echo "<td title='" . xla('Click to edit') . "' onclick='dodclick(" . attr(addslashes($lastid)) . ")'>" .
         "<a href='' onclick='return false'>" .
         text($row['name']) . "</a></td>\n";
         echo "  <td>" . ($row['active'] ? xlt('Yes') : xlt('No')) . "</td>\n";
         echo "  <td>" . text($row['ndc_number']) . "</td>\n";
         echo "  <td>" .
         generate_display_field(array('data_type' => '1','list_id' => 'drug_form'), $row['form']) .
         "</td>\n";
         echo "  <td>" . text($row['size']) . "</td>\n";
         echo "  <td>" .
         generate_display_field(array('data_type' => '1','list_id' => 'drug_units'), $row['unit']) .
         "</td>\n";

        if ($row['dispensable']) {
            echo "  <td title='" . xla('Click to receive (add) new lot') . "' onclick='doiclick(" .
                attr(addslashes($lastid)) . ",0)' title='" . xla('Add new lot and transaction') . "'>" .
                "<a href='' onclick='return false'>" . xlt('New') . "</a></td>\n";
        } else {
            echo "  <td title='" . xla('Inventory not enabled for this product') . "'>&nbsp;</td>\n";
        }

         if (!empty($row['inventory_id'][0])) {
             echo "<td>";
             foreach ($row['inventory_id'] as $key => $value) {
                 echo "<div title='" . xla('Click to edit') . "' onclick='doiclick(" . attr(addslashes($lastid)) . "," . attr(addslashes($row['inventory_id'][$key])) . ")'>" .
                 "<a href='' onclick='return false'>" . text($row['lot_number'][$key]) . "</a></div>";
             }
             echo "</td>\n<td>";

             foreach ($row['facname'] as $value) {
                 $value = $value != null ? $value : "N/A";
                 echo "<div >" .  text($value) . "</div>";
             }
             echo "</td>\n<td>";

             foreach ($row['title'] as $value) {
                 $value = $value != null ? $value : "N/A";
                 echo "<div >" .  text($value) . "</div>";
             }
             echo "</td>\n<td>";

             foreach ($row['on_hand'] as $value) {
                 $value = $value != null ? $value : "N/A";
                 echo "<div >" . text($value) . "</div>";
             }
             echo "</td>\n<td>";

             foreach ($row['expiration'] as $value) {
                // Make the expiration date red if expired.
                $expired = !empty($value) && strcmp($value, $today) <= 0;
                $value = !empty($value) ? oeFormatShortDate($value) : xl('N/A');
                echo "<div" . ($expired ? " style='color:red'" : "") . ">" . text($value) . "</div>";
             }
             echo "</td>\n";

         } else {
                 generateEmptyTd(4);
         }
         echo " </tr>\n";
     }
 }
    ?>
<html>

<head>

<title><?php echo xlt('Drug Inventory'); ?></title>

<style>
a, a:visited, a:hover {
  color: var(--primary);
}
#mymaintable thead .sorting::before,
#mymaintable thead .sorting_asc::before,
#mymaintable thead .sorting_asc::after,
#mymaintable thead .sorting_desc::before,
#mymaintable thead .sorting_desc::after,
#mymaintable thead .sorting::after {
  display: none;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 0 !important;
  margin: 0 !important;
  border: 0 !important;
}

.paginate_button:hover {
  background: transparent !important;
}

</style>

<?php Header::setupHeader(['datatables', 'datatables-dt', 'datatables-bs', 'report-helper']); ?>

<script>

// callback from add_edit_drug.php or add_edit_drug_inventory.php:
function refreshme() {
 location.reload();
}

// Process click on drug title.
function dodclick(id) {
 dlgopen('add_edit_drug.php?drug=' + id, '_blank', 725, 475);
}

// Process click on drug QOO or lot.
function doiclick(id, lot) {
 dlgopen('add_edit_lot.php?drug=' + id + '&lot=' + lot, '_blank', 600, 475);
}

// Enable/disable warehouse options depending on current facility.
function facchanged() {
    var f = document.forms[0];
    var facid = f.form_facility.value;
    var theopts = f.form_warehouse.options;
    for (var i = 1; i < theopts.length; ++i) {
        var tmp = theopts[i].value.split('/');
        var dis = facid && (tmp.length < 2 || tmp[1] != facid);
        theopts[i].disabled = dis;
        if (dis) {
            theopts[i].selected = false;
        }
    }
}

$(function () {
  $('#mymaintable').DataTable({
            stripeClasses:['stripe1','stripe2'],
            orderClasses: false,
            <?php // Bring in the translations ?>
            <?php require($GLOBALS['srcdir'] . '/js/xl/datatables-net.js.php'); ?>
        });
});
</script>

</head>

<body class="body_top">
<form method='post' action='drug_inventory.php' onsubmit='return top.restoreSession()'>

<table border='0' cellpadding='3' width='100%'>
 <tr>
  <td>
   <b><?php echo xlt('Inventory Management'); ?></b>
  </td>
  <td align='right'>
<?php
// Build a drop-down list of facilities.
$query = "SELECT id, name FROM facility ORDER BY name";
$fres = sqlStatement($query);
echo "   <select name='form_facility' onchange='facchanged()'>\n";
echo "    <option value=''>-- " . xl('All Facilities') . " --\n";
while ($frow = sqlFetchArray($fres)) {
    $facid = $frow['id'];
    echo "    <option value='$facid'";
    if ($facid == $form_facility) {
        echo " selected";
    }
    echo ">" . $frow['name'] . "\n";
}
echo "   </select>\n";

// Build a drop-down list of warehouses.
echo "&nbsp;";
echo "   <select name='form_warehouse'>\n";
echo "    <option value=''>" . xl('All Warehouses') . "</option>\n";
$lres = sqlStatement(
    "SELECT * FROM list_options " .
    "WHERE list_id = 'warehouse' ORDER BY seq, title"
);
while ($lrow = sqlFetchArray($lres)) {
    echo "    <option value='" . $lrow['option_id'] . "/" . $lrow['option_value'] . "'";
    echo " id='fac" . $lrow['option_value'] . "'";
    if (strlen($form_warehouse)  > 0 && $lrow['option_id'] == $form_warehouse) {
        echo " selected";
    }
    echo ">" . xl_list_label($lrow['title']) . "</option>\n";
}
echo "   </select>\n";
?>
  </td>
  <td>
   <input type='checkbox' name='form_show_empty' value='1'<?php if ($form_show_empty) echo " checked"; ?> />
   <?php echo xl('Show empty lots'); ?><br />
   <input type='checkbox' name='form_show_inactive' value='1'<?php if ($form_show_inactive) echo " checked"; ?> />
   <?php echo xl('Show inactive'); ?>
  </td>
  <td>
   <input type='submit' name='form_refresh' value="<?php echo xla('Refresh'); ?>" />
  </td>
 </tr>
 <tr>
  <td height="1">
  </td>
 </tr>
</table>

<!-- TODO: Why are we not using the BS4 table class here? !-->
<table id='mymaintable' class="display table-striped">
 <thead>
 <tr class='head'>
  <th>
    <?php echo xlt('Name'); ?> </a>
  </th>
  <th>
    <?php echo xlt('Act'); ?>
  </th>
  <th>
   <?php echo xlt('NDC'); ?> </a>
  </th>
  <th>
   <?php echo xlt('Form'); ?> </a>
  </th>
  <th>
    <?php echo xlt('Size'); ?>
  </th>
  <th>
    <?php echo xlt('Unit'); ?>
  </th>
  <th>
    <?php echo xlt('New'); ?>
  </th>
  <th>
    <?php echo xlt('Lot'); ?> </a>
  </th>
  <th>
    <?php echo xlt('Facility'); ?> </a>
  </th>
  <th>
    <?php echo xlt('Warehouse'); ?> </a>
  </th>
  <th>
    <?php echo xlt('QOH'); ?> </a>
  </th>
  <th>
    <?php echo xlt('Expires'); ?> </a>
  </th>
 </tr>
 </thead>
 <tbody>
<?php
 $prevRow = '';
while ($row = sqlFetchArray($res)) {
    $row = processData($row);
    if ($prevRow == '') {
        $prevRow = $row;
        continue;
    }
    if ($prevRow['drug_id'] == $row['drug_id']) {
        $row = mergeData($prevRow, $row);
    } else {
        mapToTable($prevRow);
    }
    $prevRow = $row;
} // end while
mapToTable($prevRow);
?>
 </tbody>
</table>

<input class="btn btn-primary btn-block w-25 mx-auto" type='button' value='<?php echo xla('Add Drug'); ?>' onclick='dodclick(0)' />

<input type="hidden" name="form_orderby" value="<?php echo attr($form_orderby) ?>" />

</form>

<script>
facchanged();
</script>

</body>
</html>
