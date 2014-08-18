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
$newid = formSubmit("form_subjective", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Subjective Form", $newid, "subjective", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update form_subjective set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(), subjective='".$_POST["subjective"]."' where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
