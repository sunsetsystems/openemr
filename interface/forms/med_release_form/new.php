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
<link rel=File-List href="med_release_frm_files/filelist.xml">
<title>Middle Tennessee Family Care</title>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="PostalCode"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="State"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="City"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="place"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="Street"/>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="address"/>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>K60188</o:Author>
  <o:LastAuthor>K60188</o:LastAuthor>
  <o:Revision>1</o:Revision>
  <o:TotalTime>13</o:TotalTime>
  <o:LastPrinted>2005-12-24T01:28:00Z</o:LastPrinted>
  <o:Created>2005-12-24T01:28:00Z</o:Created>
  <o:LastSaved>2005-12-24T01:41:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>138</o:Words>
  <o:Characters>788</o:Characters>
  <o:Company>State Of Tennessee</o:Company>
  <o:Lines>6</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>925</o:CharactersWithSpaces>
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
mso-layout-grid-align:none;text-autospace:none'><b><span style='font-size:18.0pt'>Middle
<st1:State w:st="on"><st1:place w:st="on">Tennessee</st1:place></st1:State>
Family Care<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><span style='font-size:
14.0pt'>Katherine W. Jones, MD<o:p></o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><span style='font-size:
14.0pt'>Christina Savage, CFNP<o:p></o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><span style='font-size:
14.0pt'>Rachel M. McHenry, RN, MSN, CFNP<o:p></o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><st1:Street w:st="on"><st1:address
 w:st="on"><b><i>2620 North Mount Juliet Road</i></b></st1:address></st1:Street><b><i><o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i>Mount <st1:place w:st="on"><st1:City
 w:st="on">Juliet</st1:City>, <st1:State w:st="on"><span class=SpellE>Tn</span></st1:State>
 <st1:PostalCode w:st="on">37122</st1:PostalCode></st1:place><o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i>PHONE: 615.773.2712<o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i>FAX: 615.773.2707<o:p></o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><i><o:p>&nbsp;</o:p></i></b></p>

<p class=MsoNormal align=center style='text-align:center;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><span style='font-size:16.0pt'>Medical
Records Release<o:p></o:p></span></b></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><o:p>&nbsp;</o:p></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><i><span style='font-size:14.0pt'>I
hereby request that</span></i><span style='font-size:14.0pt'>:<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Doctor<span
class=GramE>:_</span>_____________________________________________________<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Address<span
class=GramE>:_</span>____________________________________________________<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>City<span
class=GramE>:_</span>_____________________________, <span class=SpellE>State:________Zip</span>:_________<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><i><span style='font-size:14.0pt'>In
order to provide continuity of care, please release the following patient’s
medical records.<span style='mso-spacerun:yes'>  </span>I release from all
liability the above physician and his/her employees in regards to this release</span></i><span
style='font-size:14.0pt'>.<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>PLEASE
FORWARD RECORDS TO:<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span class=GramE><span
style='font-size:16.0pt'>_____ Katherine W. Jones, M.D.</span></span><span
style='font-size:16.0pt'><o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Patient’s
Name and Address:<o:p></o:p></span></p>
<? echo $fname . " " . $mid . " " . $lname ?><br>
<? echo $addr ?><br>
<? echo $city . ", " . $state . " " . $zip ?><br>
Ph: <? echo $phone_h ?><br>


<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Date
of Birth:<span style='mso-spacerun:yes'>   </span><? echo $dob ?><span style='mso-tab-count:
2'>       </span>&nbsp;&nbsp;&nbsp;SS#:<span style='mso-spacerun:yes'>   </span><? echo $ss ?><b><i> <o:p></o:p></i></b></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><b><span style='font-size:14.0pt'>_____________________________________________________________<o:p></o:p></span></b></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Patient
or Guardian Signature<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>_____________________________________________________________<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Witness
Signature<o:p></o:p></span></p>

<p class=MsoNormal style='tab-stops:.5in 1.0in 1.5in 2.0in 2.5in 3.0in 3.5in 4.0in 4.5in 5.0in 5.5in 6.0in 6.5in 7.0in;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>

</body>

</html>
