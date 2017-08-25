<?php
// Copyright (C) 2009-2016 Rod Roark <rod@sunsetsystems.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

//SANITIZE ALL ESCAPES
$sanitize_all_escapes=true;

//STOP FAKE REGISTER GLOBALS
$fake_register_globals=false;

require_once("../../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/patient.inc");

// The form name is passed to us as a GET parameter.
$formname = isset($_GET['formname']) ? $_GET['formname'] : '';

$patientid = empty($_REQUEST['patientid']) ? 0 : (0 + $_REQUEST['patientid']);
if ($patientid < 0) $patientid = 0 + $pid; // -1 means current pid

$visitid = empty($_REQUEST['visitid']) ? 0 : (0 + $_REQUEST['visitid']);
if ($visitid < 0) $visitid = 0 + $encounter; // -1 means current encounter

$formid = empty($_REQUEST['formid']) ? 0 : (0 + $_REQUEST['formid']);

// True if to display as a form to complete, false to display as information.
$isform = empty($_REQUEST['isform']) ? 0 : 1;

// Html2pdf fails to generate checked checkboxes properly, so write plain HTML
// if we are doing a visit-specific form to be completed.
$PDF_OUTPUT = ($formid && $isform) ? false : true;
// $PDF_OUTPUT = false; // debugging

if ($PDF_OUTPUT) {
  require_once("$srcdir/html2pdf/html2pdf.class.php");
  $pdf = new HTML2PDF('P', 'Letter', 'en');
  $pdf->setTestTdInOnePage(false); // Turn off error message for TD contents too big.
  $pdf->pdf->SetDisplayMode('real');
  ob_start();
}

$CPR = 4; // cells per row

$tmp = sqlQuery("SELECT title, notes FROM list_options WHERE " .
  "list_id = 'lbfnames' AND option_id = ? AND activity = 1 LIMIT 1", array($formname) );
$formtitle = $tmp['title'];

// Notes can be used to specify number of columns in the form.
if (preg_match('/columns=([0-9]+)/', $tmp['notes'], $matches)) {
  if ($matches[1] > 0 && $matches[1] < 13) $CPR = intval($matches[1]);
}

$fres = sqlStatement("SELECT * FROM layout_options " .
  "WHERE form_id = ? AND uor > 0 " .
  "ORDER BY group_name, seq", array($formname) );
?>
<?php if (!$PDF_OUTPUT) { ?>
<html>
<head>
<?php html_header_show();?>
<?php } ?>

<style>

<?php if ($PDF_OUTPUT) { ?>
td {
 font-family: Arial;
 font-weight: normal;
 font-size: 9pt;
}
<?php } else { ?>
body, td {
 font-family: Arial, Helvetica, sans-serif;
 font-weight: normal;
 font-size: 9pt;
}
body {
 padding: 5pt 5pt 5pt 5pt;
}
<?php } ?>

p.grpheader {
 font-family: Arial;
 font-weight: bold;
 font-size: 12pt;
 margin-bottom: 4pt;
}

div.section {
 width: 98%;
<?php
  // html2pdf screws up the div borders when a div overflows to a second page.
  // Our temporary solution is to turn off the borders in the case where this
  // is likely to happen (i.e. where all form options are listed).
  if (!$isform) {
?>
 border-style: solid;
 border-width: 1px;
 border-color: #000000;
<?php } ?>
 padding: 5pt;
}
div.section table {
 width: 100%;
}
div.section td.stuff {
 vertical-align: bottom;
 height: 16pt;
}

td.lcols1 { width: 20%; }
td.lcols2 { width: 50%; }
td.lcols3 { width: 70%; }
td.dcols1 { width: 30%; }
td.dcols2 { width: 50%; }
td.dcols3 { width: 80%; }

.mainhead {
 font-weight: bold;
 font-size: 14pt;
 text-align: center;
}

.subhead {
 font-weight: bold;
 font-size: 8pt;
}

.under {
 border-style: solid;
 border-width: 0 0 1px 0;
 border-color: #999999;
}

.ftitletable {
 width: 100%;
 margin: 0 0 8pt 0;
}
.ftitlecell1 {
 width: 35%;
 vertical-align: top;
 text-align: left;
 font-size: 14pt;
 font-weight: bold;
}
.ftitlecell2 {
 width: 35%;
 vertical-align: top;
 text-align: right;
 font-size: 9pt;
}
.ftitlecellm {
 width: 30%;
 vertical-align: top;
 text-align: center;
 font-size: 9pt;
}
</style>

<?php if (!$PDF_OUTPUT) { ?>
</head>
<body bgcolor='#ffffff'>
<?php } ?>

<form>

<?php
// Generate header with optional logo.
$logo = '';
$ma_logo_path = "sites/" . $_SESSION['site_id'] . "/images/ma_logo.png";
if (is_file("$webserver_root/$ma_logo_path")) {
  $logo = "<img src='$web_root/$ma_logo_path' />";
}
else {
  $logo = "<!-- '$ma_logo_path' does not exist. -->";
}
echo genFacilityTitle($formtitle, -1, $logo);
?>

<?php if ($isform) { ?>
<span class='subhead'>
 <?php echo xlt('Patient') ?>: ________________________________________ &nbsp;
 <?php echo xlt('Clinic') ?>: ____________________ &nbsp;
 <?php echo xlt('Date') ?>: ____________________<br />&nbsp;<br />
</span>
<?php } ?>

<?php

function end_cell() {
  global $item_count, $cell_count;
  if ($item_count > 0) {
    echo "</td>";
    $item_count = 0;
  }
}

function end_row() {
  global $cell_count, $CPR;
  end_cell();
  if ($cell_count > 0) {
    for (; $cell_count < $CPR; ++$cell_count) echo "<td></td>";
    echo "</tr>\n";
    $cell_count = 0;
  }
}

function getContent() {
  global $web_root, $webserver_root;
  $content = ob_get_clean();
  // Fix a nasty html2pdf bug - it ignores document root!
  $i = 0;
  $wrlen = strlen($web_root);
  $wsrlen = strlen($webserver_root);
  while (true) {
    $i = stripos($content, " src='/", $i + 1);
    if ($i === false) break;
    if (substr($content, $i+6, $wrlen) === $web_root &&
        substr($content, $i+6, $wsrlen) !== $webserver_root)
    {
      $content = substr($content, 0, $i + 6) . $webserver_root . substr($content, $i + 6 + $wrlen);
    }
  }
  return $content;
}

$cell_count = 0;
$item_count = 0;

// This is an array of the active group levels. Each entry is a group or
// subgroup name (with its order prefix) and represents a level of nesting.
$group_levels = array();

// This indicates if </table> will need to be written to end the fields in a group.
$group_table_active = false;

while ($frow = sqlFetchArray($fres)) {
  $this_group   = $frow['group_name'];
  $titlecols    = $frow['titlecols'];
  $datacols     = $frow['datacols'];
  $data_type    = $frow['data_type'];
  $field_id     = $frow['field_id'];
  $list_id      = $frow['list_id'];
  $edit_options = $frow['edit_options'];

  // Skip this field if its do-not-print option is set.
  if (strpos($edit_options, 'X') !== FALSE) continue;

  $currvalue = '';
  if ($formid || $visitid) {
    $currvalue = lbf_current_value($frow, $formid, $visitid);
    if ($currvalue === FALSE) continue; // should not happen
  }

  $this_levels = explode('|', $this_group);
  $i = 0;
  $mincount = min(count($this_levels), count($group_levels));
  while ($i < $mincount && $this_levels[$i] == $group_levels[$i]) ++$i;
  // $i is now the number of initial matching levels.

  // If ending a group or starting a subgroup, terminate the current row and its table.
  if ($group_table_active && ($i != count($group_levels) || $i != count($this_levels))) {
    end_row();
    echo " </table>\n";
    $group_table_active = false;
  }

  // Close any groups that we are done with.
  while (count($group_levels) > $i) {
    $gname = array_pop($group_levels);
    echo "</div>\n";
    // echo "</nobreak><br /><div><table><tr><td>&nbsp;</td></tr></table></div><br />\n";
    echo "</nobreak>\n";
  }

  // If there are any new groups, open them.
  while ($i < count($this_levels)) {
    end_row();
    if ($group_table_active) {
      echo " </table>\n";
      $group_table_active = false;
    }
    $gname = $this_levels[$i++];
    array_push($group_levels, $gname);

    // This is also for html2pdf. Telling it that the following stuff should
    // start on a new page if there is not otherwise room for it on this page.
    echo "<nobreak>\n";

    echo "<p class='grpheader'>" . text(xl_layout_label(substr($gname, 1))) . "</p>\n";
    echo "<div class='section'>\n";
    echo " <table border='0' cellpadding='0'>\n";
    echo "  <tr><td class='lcols1'></td><td class='dcols1'></td><td class='lcols1'></td><td class='dcols1'></td></tr>\n";

    $group_table_active = true;
  }

  // Handle starting of a new row.
  if (($titlecols > 0 && $cell_count >= $CPR) || $cell_count == 0) {
    end_row();
    echo "  <tr style='height:30pt'>";
  }

  if ($item_count == 0 && $titlecols == 0) $titlecols = 1;

  // Handle starting of a new label cell.
  if ($titlecols > 0) {
    end_cell();
    echo "<td colspan='$titlecols' ";
    echo "class='lcols$titlecols stuff " . (($frow['uor'] == 2) ? "required'" : "bold'");
    if ($cell_count == 2) echo " style='padding-left:10pt'";
    echo " nowrap>";
    $cell_count += $titlecols;
  }
  ++$item_count;

  echo "<b>";
    
  if ($frow['title']) echo (text(xl_layout_label($frow['title'])) . ":"); else echo "&nbsp;";

  echo "</b>";

  // Handle starting of a new data cell.
  if ($datacols > 0) {
    end_cell();
    echo "<td colspan='$datacols' class='dcols$datacols stuff under'";

    if ($cell_count > 0) echo " style='padding-left:5pt;'";
    echo ">";
    $cell_count += $datacols;
  }

  ++$item_count;

  if ($isform) {
    generate_print_field($frow, $currvalue);
  }
  else {
    $s = generate_display_field($frow, $currvalue);
    if ($s === '') $s = '&nbsp;';
    echo $s;
  }
}

// Close all open groups.
if ($group_table_active) {
  end_row();
  echo " </table>\n";
  $group_table_active = false;
}
while (count($group_levels)) {
  $gname = array_pop($group_levels);
  echo "</div>\n";
  echo "</nobreak>\n";
}

?>

</form>
<?php
if ($PDF_OUTPUT) {
  $content = getContent();
  $pdf->writeHTML($content, false);
  $pdf->Output('form.pdf', 'D'); // D = Download, I = Inline
}
else {
?>
<script language='JavaScript'>
 var win = top.printLogPrint ? top : opener.top;
 win.printLogPrint(window);
</script>
</body>
</html>
<?php } ?>
