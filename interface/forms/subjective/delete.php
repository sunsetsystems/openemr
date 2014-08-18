<?php
//------------Forms generated from formsWiz
// this form is used to delete the record shown in the encounter
// for mtfc_subjective
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
include_once("$srcdir/sql.inc");
$id = $_GET["id"];
$pid = $_GET["pid"];
$formname = $_GET["formname"];

// Update the deleted column in the forms table to remove the injection
//$sql_1 = "DELETE FROM form_injection where id='" . $id . "'";
//$sql_2 = "DELETE FROM forms where form_id='" . $id . "'";
$sql_1 = "UPDATE forms set deleted=1 where form_id='" . $id . "' and formdir='" . $formname . "' and pid='" . $pid . "'";

// Getting document information from the database

$res_1 = sqlQuery($sql_1);
//$res_2 = sqlQuery($sql_2);

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();

?>
