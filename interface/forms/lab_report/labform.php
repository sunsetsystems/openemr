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
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="City"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="Street"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="address"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="State"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="place"/>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>K60188</o:Author>
  <o:LastAuthor>K60188</o:LastAuthor>
  <o:Revision>1</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:Created>2005-12-23T04:32:00Z</o:Created>
  <o:LastSaved>2005-12-23T04:33:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>236</o:Words>
  <o:Characters>1350</o:Characters>
  <o:Company>State Of Tennessee</o:Company>
  <o:Lines>11</o:Lines>
  <o:Paragraphs>3</o:Paragraphs>
  <o:CharactersWithSpaces>1583</o:CharactersWithSpaces>
  <o:Version>11.5606</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
 </w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" LatentStyleCount="156">
 </w:LatentStyles>
</xml><![endif]--><!--[if !mso]><object
 classid="clsid:38481807-CA0E-42D2-BF39-B33AF135CC4D" id=ieooui></object>
<style>
st1\:*{behavior:url(#ieooui) }
</style>
<![endif]-->
<style>
<!--
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";}
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
span.GramE
	{mso-style-name:"";
	mso-gram-e:yes;}
@page Section1
	{size:8.5in 11.0in;
	margin:1.0in 1.25in 1.0in 1.25in;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
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
<div class=Section1>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'>
<b><i><span style='font-size:
16.0pt'>Middle <st1:State w:st="on"><st1:place w:st="on">Tennessee</st1:place></st1:State>
Family Care<o:p></o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><span style='font-size:
14.0pt'>Katherine W. Jones, MD<o:p></o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><span style='font-size:
14.0pt'>Rebekah P. Cashin, MSM, PA-C</span><o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><st1:Street w:st="on"><st1:address
 w:st="on"><b><i>2620 N. Mt. Juliet Road</i></b></st1:address></st1:Street><b><i><o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><st1:place w:st="on"><st1:City
 w:st="on"><b><i>Mt. Juliet</i></b></st1:City><b><i>, <st1:State w:st="on">TN</st1:State></i></b></st1:place><b><i><span
style='mso-spacerun:yes'>  </span>37122<o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i>615.773.2712 Phone<o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i>615.773.2707 Fax<o:p></o:p></i></b></p>

<table width="100%" border=0>
<tr>
<td width="37%"><font size="2">Date </font>&nbsp;&nbsp;&nbsp;____________</td><td width="22%">&nbsp;</td>
<td width="9%"><font size="2">WBC:</font></td>
<td width="17%">_______</td>
<td width="6%"><font size="2">RBC:</font></td><td width="9%">_______</td></tr>
<tr><td><font size="2">Name:</font> &nbsp;&nbsp;&nbsp;<? echo $fname . " " . $mid . " " . $lname ?></td><td width="22%">&nbsp;</td>
  <td><font size="2">Epith:</font></td>
  <td>_______</td>
  <td><font size="2">Bact:</font></td><td>_______</td></tr>
<tr><td><font size="2">Ph: </font> &nbsp;&nbsp;&nbsp;<? echo $phone_h ?></td><td width="22%">&nbsp;</td>
  <td><font size="2">Mucus:</font></td>
  <td>_______</td>
  <td><font size="2">Crystal:</font></td><td>_______</td></tr>
<tr><td><font size="2">SSN: </font> &nbsp;&nbsp;&nbsp;<? echo $ss ?>&nbsp;&nbsp;&nbsp;&nbsp;<font size="2">DOB: </font><? echo $dob ?> &nbsp;&nbsp;<font size="2">Chart No: </font><? echo $id ?></td><td width="22%">&nbsp;</td>
  <td><font size="2">Cast:</font></td>
  <td>_______</td>
  <td><font size="2">Transetcer:</font></td><td>_______</td></tr>
<tr><td>&nbsp;</td><td width="22%">&nbsp;</td>
  <td><b>Urinalysis</b></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td width="22%">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td width="22%">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>Room ____________</td><td width="22%">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><b>Glucose</b></td><td width="22%">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td></tr>
</table>

<table width="100%" border=0>
<tr>
 <td width="50%"><font size="2">Patient Result</font></td><td width="10%">___________________</td><td width="30%"><font size="2"></font></td><td width="10%">&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Check Strip</font></td><td>__________________</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Low Control</font></td><td>__________________</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;High Control</font></td><td>__________________</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2"><b>Strep</b></font></td><td>&nbsp;</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">Patient Result</font></td><td>_________________________</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Reagent Color Change</font></td><td>_______</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Red Control Line</font></td><td>_______</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Clear Background</font></td><td>_______</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2"><b>Urine Pregnancy</b></font></td><td>&nbsp;</td><td colspan=2><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
</tr>
<tr>
 <td><font size="2">Patient Result</font></td><td>_________________________</td><td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
 <td>&nbsp;</td>
</tr>
<tr>
<td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Valid Internal Control</font></td><td>_____________</td><td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Rapid Flu</font></td><td>________________________</td>
</tr>
<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Control</font></td><td>________________________</td>
</tr>
<tr>
  <td><font size="2"><b>Mono</b></font></td><td>&nbsp;</td><td><font size="2"><b>KOH</b></font></td><td>_________________________</td>
</tr>
<tr>
 <td><font size="2">Patient Result</font></td><td>_________________________</td><td><font size="2"><b>WET PREP</b></font></td><td>____________________</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Valid Internal Control</font></td><td>______________</td><td colspan=2><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;clue cells ___ yeast ___ trich ___</font></td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">Patient Result</font></td><td>_________________________</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td><td>_________________________</td><td colspan=2><font size="2"><b>PH</b> - Vaginal Fluid ___________</font></td>
</tr>
<tr>
 <td>&nbsp;</td><td>_________________________</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;Valid Internal Control</font></td><td>______________</td><td><font size="2">TECH</font></td><td>_______________________</td>
</tr>
<tr>
 <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
 <td colspan=2><font size="2"><b><i>Katherine W. Jones, M.D. Medical Lab Director</i></b></font></td><td><font size="2">TIME</font></td><td>_______________________</td>
</tr>
<tr>
 <td><font size="2"><b><i>CLIA # 44D1011560</i></b></font></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>

</font>
</div>

</body>

</html>
