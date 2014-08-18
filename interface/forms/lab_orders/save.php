<?php
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
	$newid = formSubmit("form_lab_orders", $_POST, $_GET["id"], $userauthorized);
	addForm($encounter, "Lab Orders", $newid, "lab_orders", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
	$sql = "update form_lab_orders set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(), notes='".$_POST["notes"]."' where id=$id";
	sqlInsert($sql);
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
