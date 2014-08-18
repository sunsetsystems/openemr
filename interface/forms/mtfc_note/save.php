<?php
# file save.php for work/school note.

include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
formHeader("Form: mtfc_note");


foreach ($_POST as $k => $var) {
   $_POST[$k] = mysql_escape_string($var);
   echo "$var\n";
}
if ($encounter == "")
   $encounter = date("Ymd");
   
if ($_GET["mode"] == "new"){
   $newid = formSubmit("form_mtfc_note", $_POST, $_GET["id"], $userauthorized);
   addForm($encounter, "Work/School Note", $newid, "mtfc_note", $pid, $userauthorized);
}
elseif ($_GET["mode"] == "update") {
	sqlInsert("update form_mtfc_note set pid = 	{$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, 	date = NOW(),
	note_type='".$_POST["note_type"]."',
	doctor='".$_POST["doctor"]."',
	date_of_signature='".$_POST["date_of_signature"]."',
	date_seen='".$_POST["date_seen"]."',
	unable_to_work='".$_POST["unable_to_work"]."',
	may_return_work='".$_POST["may_return_work"]."',
	patient_restrictions='".$_POST["patient_restrictions"]."',
	limited_work='".$_POST["limited_work"]."',
	sling='".$_POST["sling"]."',
	crutches='".$_POST["crutches"]."',
	splint='".$_POST["splint"]."',
	other='".$_POST["other"]."',
	medication_work='".$_POST["medication_work"]."' where id=$id");
}
$_SESSION["encounter"] = $encounter;
formJump();
formFooter(); 

?>
