<?
 include_once("../../globals.php");
 include_once("$srcdir/calendar.inc");
 include_once("$srcdir/lists.inc");
 include_once("$srcdir/patient.inc");
 include_once("$srcdir/acl.inc");
?>
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="xray_fem_files/filelist.xml">
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

<p><font size="2" face="Times-Roman"><b>RADIOLOGY REPORT</b></font></p>
<br>

<p><font size="2" face="Times-Roman">Exam Date<span>      </span>____________________<span>        </span>Provider<span>          </span>_______________________</font></p>
<font size="2" face="Times-Roman">
<? echo $fname . " " . $mid . " " . $lname ?><br>
Ph: <? echo $phone_h ?><br>
SSN: <? echo $ss ?>&nbsp;&nbsp;&nbsp;&nbsp;DOB: <? echo $dob ?><br>
</font>

<p><font size="2" face="Times-Roman">X-Ray No.:<span>     </span>____________________________________________________________</font></p>

<p><font size="2" face="Times-Roman">Examination:<span>   </span>____________________________________________________________</font></p>

<p><font size="2" face="Times-Roman">Clinical Information:<span>   </span>______________________________________________________</font></p>

<p><font size="2" face="Times-Roman">________________________________________________________________________</font></p>

<p><font size="2" face="Times-Roman">Impression (Treating Provider)<span>                       </span>__________<span>    </span>Normal</font></p>

<p><font size="2" face="Times-Roman">__________<span>    </span>No Significant Change</font></p>

<p><font size="2" face="Times-Roman">__________<span>    </span>Abnormal<span>        </span>____________<span>            </span></font></p>

<p><font size="2" face="Times-Roman"><span>                        </span>________________________</font></p>

<p><font size="2" face="Times-Roman">Request for Radiology Interpretation<span>             </span>_____<span>  </span>Yes<span>      </span>_____<span>  </span>No</font></p>

<p><font size="2" face="Times-Roman"><b>RADIOLOGY CONSENT FORM</b></font></p>

<p><font size="2" face="Times-Roman"><i>I, «<span>NameFirstLast</span><span>» ,</span> have been asked about my last normal menstrual
period.<span>  </span>I have assured Middle Tennessee Family Care
that I am not pregnant at this time and consent to having a radiograph as
ordered by my provider.</i></font></p>

<p><font size="2" face="Times-Roman"><b>Patients Signature</b>&nbsp;&nbsp;&nbsp;_________________________________________</font></p>

<p><font size="2" face="Times-Roman"><b>Date</b> &nbsp;&nbsp;&nbsp;_________________________________________</font></p>

<p><font size="2" face="Times-Roman"><b>Witness</b> &nbsp;&nbsp;&nbsp;_________________________________________</font></p>

<p><font size="2" face="Times-Roman"><b>Date of Last Menstrual Period</b> &nbsp;&nbsp;&nbsp;_________________________________________</font></p>

</div>

</body>

</html>
