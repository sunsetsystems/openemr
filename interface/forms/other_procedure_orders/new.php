<!-- Form generated from formsWiz -->
<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: other_procedure_orders");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?echo $rootdir;?>/forms/other_procedure_orders/save.php?mode=new" name="other_procedure_orders">
<div style="text-align: center;"><span class="title" >Other Procedure Orders</span></div><br><br>

<table>
	<tr>
		<td valign="top"><b>Notes:</b></td> 
		<td><span class="formfield"><textarea name="notes" rows="20" cols="80" wrap=virtual></textarea></span></td>
	</tr>
</table>
<br><br>
<a href="javascript:top.restoreSession();document.other_procedure_orders.submit();" class="link_submit"><b>[Save]</b></a>
<br><br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save]</a></center>
</form>
<?php
formFooter();
?>
