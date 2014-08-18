<?
# file view.php for work/school note.
include_once("../../globals.php");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<?php
include_once("$srcdir/api.inc");
$obj = formFetch("form_mtfc_note", $_GET["id"]);

?>

<form method=post action="<?echo $rootdir?>/forms/mtfc_note/save.php?mode=update&id=<?echo $_GET["id"];?>" name="my_form">
<span class="title"><?echo stripslashes($obj{"note_type"});?></span><br></br>
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save Changes]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $id = $_GET["id"]; ?>
<a href="<?echo "$rootdir/forms/mtfc_note/work_excuse_form.php?id=$id";?>" class="link" target=New onclick="top.restoreSession()">[PRINTABLE PAGE]</a><br><br>
<br><br>
<span class="text">Note Type: </span>
<input type=entry name="note_type" value="<?echo
stripslashes($obj{"note_type"});?>" size="35"> 
<br>
<br>
<span class="text">Doctor: </span>
<input type=entry name="doctor" value="<?echo
stripslashes($obj{"doctor"});?>" size="40"> 
<br>
<br>
<span class="text">Date of Signature: </span>
<input type=entry name="date_of_signature" value="<?echo
stripslashes($obj{"date_of_signature"});?>" size="50"> 
<br>
<br>
<span class="text">Date Patient Was Seen: </span>
<input type=entry name="date_seen" value="<?echo
stripslashes($obj{"date_seen"});?>" size="35"> 
<br>
<br>
<span class="text">A. Patient is unable to return to work/school until the follow-up visit: </span><br>
<input type=entry name="unable_to_work" value="<?echo
stripslashes($obj{"unable_to_work"});?>" size="50"> 
<br>
<br>
<span class="text">B. Patient may return work/school on: </span><br>
<input type=entry name="may_return_work" value="<?echo
stripslashes($obj{"may_return_work"});?>" size="50"> 
<br>
<br>
<span class="text">C. Patient has the following restrictions: </span><br>
<input type=entry name="patient_restrictions" value="<?echo
stripslashes($obj{"patient_restrictions"});?>" size="50"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;3. Limited or no use of: </span><br>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=entry name="limited_work" value="<?echo
stripslashes($obj{"limited_work"});?>" size="50"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Use: i. Sling: </span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=entry name="sling" value="<?echo
stripslashes($obj{"sling"});?>" size="35"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii. Crutches: </span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=entry name="crutches" value="<?echo
stripslashes($obj{"crutches"});?>" size="35"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii. Splint: </span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=entry name="splint" value="<?echo
stripslashes($obj{"splint"});?>" size="35"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iv. Other: </span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=entry name="other" value="<?echo
stripslashes($obj{"other"});?>" size="35"> 
<br>
<br>
<span class="text">&nbsp;&nbsp;7. Medication which may be used at work/school:</span></br>
&nbsp;&nbsp;<textarea name="medication_work" cols ="67" rows="4"  wrap="virtual name">
<?echo stripslashes($obj{"medication_work"});?></textarea>
<br></br>

<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save Changes]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $id = $_GET["id"]; ?>
<a href="<?echo "$rootdir/forms/mtfc_note/work_excuse_form.php?id=$id";?>" class="link" target=New onclick="top.restoreSession()">[PRINTABLE PAGE]</a><br><br>
</form>
<?php
formFooter();
?>
