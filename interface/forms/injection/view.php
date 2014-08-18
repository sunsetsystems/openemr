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
$obj = formFetch("form_injection", $_GET["id"]);
?>
<form method=post action="<?echo $rootdir?>/forms/injection/save.php?mode=update&id=<?echo $_GET["id"];?>" name="my_form">
<span class="title"><b>Injection Form</b></span><Br><br>

<table>

	<tr>
		<td valign=top><span class=bold>Injection Name: </span></td>
		<td><input type="text" name="injection_name" size='35' maxlength="30" value = '<? echo $obj{"injection_name"} ?>'></td>
	</tr>
    <tr>
        <td><span class=bold>Site: </span></td>
        <td><input type="text" name="site" size="25" maxlength="20" value = '<? echo $obj{"site"} ?>'></td>
    </tr>
    <tr>
        <td><span class=bold>Lot #: </span></td>
        <td><input type="text" name="lot" size="25" maxlength="20" value = '<? echo $obj{"lot"} ?>'></td>
    </tr>
    <tr>
        <td><span class=bold>Expiration: </span></td>
        <td><input type="text" name="expiration" size="25" maxlength="20" value = '<? echo $obj{"expiration"} ?>'></td>
    </tr>
    <tr>
        <td><span class=bold>Administrator: </span></td>
        <td><input type="text" name="administrator" size="25" maxlength="20" value = '<? echo $obj{"administrator"} ?>'></td>
    </tr>
    <tr>
        <td><span class=bold>Manufacturer Name: </span></td>
        <td><input type="text" name="manufacturer" size="25" maxlength="20" value = '<? echo $obj{"manufacturer"} ?>'></td>
    </tr>
</table>
<br>
<br>
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
&nbsp;&nbsp;&nbsp;<a href="<?echo $rootdir?>/forms/injection/delete.php?id=<?echo $_GET["id"];?>" class="link"><font color="red"><b>[Delete]</b></font></a>
<br><br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save Changes]</a>
</form>
<?php
formFooter();
?>
