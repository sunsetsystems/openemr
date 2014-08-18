<?
 include_once("../../globals.php");
 include_once("$srcdir/calendar.inc");
 include_once("$srcdir/lists.inc");
 include_once("$srcdir/patient.inc");
 include_once("$srcdir/acl.inc");
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:st1="urn:schemas-microsoft-com:office:smarttags"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="lab_report_files/filelist.xml">
<title>Middle Tennessee Family Care</title>

<style>

/* specifically include & exclude from printing */
@media print {
	#report_parameters {
		visibility: hidden;
		display: none;
	}
	#report_parameters_daterange {
		visibility: visible;
		display: inline;
	}
	#report_results table {
		margin-top: 0px;
	}
}

dl {
       visibility: hidden;
       display: none;
   }

</style>


</head>

<body lang=EN-US style='tab-interval:.5in'>
<?php
$pid = $_SESSION["pid"];
$sql1 = "SELECT * FROM patient_data where pid='" . $pid . "'";

// Getting patient information from the database
$res = sqlStatement($sql1);
for ($iter =0; $row = sqlFetchArray($res);$iter++)
   $result[$iter] = $row;
if (count($result) == 1 ) {
  $fname = $result[0]{"fname"};
  $mid = $result[0]{"mname"};
  $lname = $result[0]{"lname"};
  $addr = $result[0]{"street"};
  $city = $result[0]{"city"};
  $state = $result[0]{"state"};
  $zip = $result[0]{"postal_code"};
  $phone_h = $result[0]{"phone_home"};
  $ss = $result[0]{"ss"};
  $dob = $result[0]{"DOB"};
}

?>


<div id="report_parameters">
<div><a class='css_button_small' href='##' onClick="window.print()"><span>Print Form</span></a>
</div>
</div>

<table width="60%" align="center">
<tr>
	<td colspan="4" align="center"><?php echo($labformimg); ?></td>
</tr>
<tr><td width="25%"><font size="2" face="Times-Roman">Katherine W. Jones, MD</font></td>
    <td width="25%"><font size="2" face="Times-Roman">Christina Savage, CFNP</font></td>
    <td width="25%"><font size="2" face="Times-Roman">Jade Morales, CFNP</font></td>
    <td width="25%"><font size="2" face="Times-Roman">Donna Blanton, CFNP</font></td>
</tr>
<tr>
	<td colspan="4" align="center"><font size="2" face="Times-Roman">2025 N. Mt. Juliet Road, Suite 120, &nbsp;&nbsp;&nbsp; Mt. Juliet, TN 37122</font></td>
</tr>
<tr>
    <td colspan="4" align="center"><font size="2" face="Times-Roman">Phone: 615.773.2712 &nbsp;&nbsp;&nbsp; Fax: 615.773.2707</font></td>
</tr>
</table>
</font>
<font size="2" face="Times-Roman">
<br>
<p>Date _________________________</p>

<? echo $fname . " " . $mid . " " . $lname ?><br>
Ph: <? echo $phone_h ?><br>
SSN: <? echo $ss ?>&nbsp;&nbsp;&nbsp;&nbsp;DOB: <? echo $dob ?> &nbsp;&nbsp;&nbsp;&nbsp;Room ____________________<br>
<br>
<b>Glucose</b><br>
</font>
<table width="100%" border=0>
<tr>
 <td width="50%"><font size="2" face="Times-Roman">Patient Result</font></td><td width="10%">___________________</td><td width="30%"><font size="2" face="Times-Roman"><b>Urinalysis</b></font></td><td width="10%">&nbsp;</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Check Strip</font></td><td>__________________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Color</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Low Control</font></td><td>__________________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Clarity</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;High Control</font></td><td>__________________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Urobilinogen</font></td><td>________________________</td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Glucose</font></td><td>________________________</td>
</tr>
 <td><font size="2" face="Times-Roman"><b>Strep</b></font></td><td>&nbsp;</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Ketone</font></td><td>________________________</td>
</tr>
 <td><font size="2" face="Times-Roman">Patient Result</font></td><td>_________________________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Reagent Color Change</font></td><td>_______</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Protein</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Red Control Line</font></td><td>_______</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Nitrate</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Clear Background</font></td><td>_______</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Leucocytes</font></td><td>________________________</td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Blood</font></td><td>________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman"><b>Urine Pregnancy</b></font></td><td>&nbsp;</td><td colspan=2><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;pH
________________________</font></td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">Patient Result</font></td><td>_________________________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Specific Gravity</font></td><td>____________</td>
</tr>
<tr>
<td><font size="2" face="Times-Roman">Valid Internal Control</font></td><td>_____________</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Rapid Flu</font></td><td>________________________</td>
</tr>
<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;Control</font></td><td>________________________</td>
</tr>
<tr>
  <td><font size="2" face="Times-Roman"><b>Mono</b></font></td><td>&nbsp;</td><td><font size="2" face="Times-Roman"><b>KOH</b></font></td><td>_________________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">Patient Result</font></td><td>_________________________</td><td><font size="2" face="Times-Roman"><b>WET PREP</b></font></td><td>____________________</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">Valid Internal Control</font></td><td>______________</td><td colspan=2><font size="2" face="Times-Roman">&nbsp;&nbsp;&nbsp;&nbsp;clue cells ___ yeast ___ trich ___</font></td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">Patient Result</font></td><td>_________________________</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td><td>_________________________</td><td colspan=2><font size="2" face="Times-Roman"><b>PH</b> - Vaginal Fluid ___________</font></td>
</tr>
<tr>
 <td>&nbsp;</td><td>_________________________</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2" face="Times-Roman">Valid Internal Control</font></td><td>______________</td><td><font size="2" face="Times-Roman">TECH</font></td><td>_______________________</td>
</tr>
<tr>
 <td colspan=2><font size="1" face="Times-Roman"><b><i>Katherine W. Jones, M.D. Medical Lab Director</i></b></font></td><td><font size="2" face="Times-Roman">TIME</font></td><td>_______________________</td>
</tr>
<tr>
 <td><font size="1" face="Times-Roman"><b><i>CLIA # 44D1011560</i></b></font></td><td>&nbsp;</td>
</tr>
</table>

</font>

</body>

</html>