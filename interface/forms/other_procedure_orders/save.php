<?php
//------------Forms generated from formsWiz
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
foreach ($_POST as $k => $var) {
$_POST[$k] = mysql_escape_string($var);
echo "$var\n";
}
if ($encounter == "")
$encounter = date("Ymd");
if ($_GET["mode"] == "new"){
$newid = formSubmit("other_procedure_orders", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Other Procedure Orders", $newid, "other_procedure_orders", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update other_procedure_orders set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(), notes='".$_POST["notes"]."' where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
