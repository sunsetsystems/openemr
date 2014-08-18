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
$newid = formSubmit("form_injection", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Injection Form", $newid, "injection", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update form_injection set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(), injection_name='".$_POST["injection_name"]."', site='".$_POST["site"]."', lot='".$_POST["lot"]."', expiration='".$_POST["expiration"]."', administrator='".$_POST["administrator"]."', manufacturer='".$_POST["manufacturer"]."' where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
