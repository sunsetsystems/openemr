<!-- Form generated from formsWiz -->
<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: injection");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?echo $rootdir;?>/forms/injection/save.php?mode=new" name="inj_form">
<span class="title">Injection Form</span><br><br>

<table>

	<tr>
		<td valign=top><span class=bold>Injection Name: </span></td>
		<td><input type="text" name="injection_name" size='35' maxlength="30"></td>
	</tr>
    <tr>
        <td><span class=bold>Site: </span></td>
        <td><input type="text" name="site" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <td><span class=bold>Lot #: </span></td>
        <td><input type="text" name="lot" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <td><span class=bold>Expiration: </span></td>
        <td><input type="text" name="expiration" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <td><span class=bold>Administrator: </span></td>
        <td><input type="text" name="administrator" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <td><span class=bold>Manufacturer Name: </span></td>
        <td><input type="text" name="manufacturer" size="25" maxlength="20"></td>
    </tr>
</table>
<br><br>
<a href="javascript:top.restoreSession();document.inj_form.submit();" class="link_submit"><b>[Save]</b></a>
<br><br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save]</a></center>
</form>
<?php
formFooter();
?>
