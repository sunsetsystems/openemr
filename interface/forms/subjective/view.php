<!-- Forms generated from formsWiz -->
<?php
include_once("../../globals.php");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<?php
include_once("$srcdir/api.inc");
$obj = formFetch("form_subjective", $_GET["id"]);
?>
<form method=post action="<?echo $rootdir?>/forms/subjective/save.php?mode=update&id=<?echo $_GET["id"];?>" name="my_form">
<span class="title"><b>Subjective Form</b></span><Br><br>

<table>

	<tr>
		<td valign=top><span class=formfield><b>Comments: </b> 
		<textarea name="subjective" rows="20" cols="60" wrap=virtual><?php echo $obj{"subjective"};?></textarea></span></td>
	</tr>
</table>
<br>
<br>
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br><br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save Changes]</a>
</form>
<?php
formFooter();
?>
