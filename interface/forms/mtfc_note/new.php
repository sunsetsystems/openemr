<?
// file new.php for work/school note
include_once("../../globals.php");
include_once("../../../library/api.inc");
formHeader("Form: mtfc_note");
?>
<html><head>
<SCRIPT language="JavaScript"><!--
/******************************************
   Today's Date           
*******************************************/

Style = 1; //pick a style from below

/*------------------------------
Style 1: March 17, 2000
Style 2: Mar 17, 2000
Style 3: Saturday March 17, 2000
Style 4: Sat Mar 17, 2000
Style 5: Sat March 17, 2000
Style 6: 17 March 2000
Style 7: 17 Mar 2000
Style 8: 17 Mar 00
Style 9: 3/17/00
Style 10: 3-17-00
Style 11: Saturday March 17
--------------------------------*/

months = new Array();
months[1] = "January";  months[7] = "July";
months[2] = "February"; months[8] = "August";
months[3] = "March";    months[9] = "September";
months[4] = "April";    months[10] = "October";
months[5] = "May";      months[11] = "November";
months[6] = "June";     months[12] = "December";

months2 = new Array();
months2[1] = "Jan"; months2[7] = "Jul";
months2[2] = "Feb"; months2[8] = "Aug";
months2[3] = "Mar"; months2[9] = "Sep";
months2[4] = "Apr"; months2[10] = "Oct";
months2[5] = "May"; months2[11] = "Nov";
months2[6] = "Jun"; months2[12] = "Dec";

days = new Array();
days[1] = "Sunday";    days[5] = "Thursday";
days[2] = "Monday";    days[6] = "Friday";
days[3] = "Tuesday";   days[7] = "Saturday";
days[4] = "Wednesday";

days2 = new Array();
days2[1] = "Sun"; days2[5] = "Thu";
days2[2] = "Mon"; days2[6] = "Fri";
days2[3] = "Tue"; days2[7] = "Sat";
days2[4] = "Wed";

todaysdate = new Date();
date  = todaysdate.getDate();
day  = todaysdate.getDay() + 1;
month = todaysdate.getMonth() + 1;
yy = todaysdate.getYear();
year = (yy < 1000) ? yy + 1900 : yy;
year2 = 2000 - year; year2 = (year2 < 10) ? "0" + year2 : year2;

dateline = new Array();
dateline[1] = months[month] + " " + date + ", " + year;
dateline[2] = months2[month] + " " + date + ", " + year;
dateline[3] = days[day] + " " + months[month] + " " + date + ", " + year;
dateline[4] = days2[day] + " " + months2[month] + " " + date + ", " + year;
dateline[5] = days2[day] + " " + months[month] + " " + date + ", " + year;
dateline[6] = date + " " + months[month] + " " + year;
dateline[7] = date + " " + months2[month] + " " + year;
dateline[8] = date + " " + months2[month] + " " + year2;
dateline[9] = month + "/" + date + "/" + year2;
dateline[10] = month + "-" + date + "-" + year2;
dateline[11] = days[day] + " " + months[month] + " " + date;
document.write(dateline[Style]);

//--></SCRIPT>


<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>


<body <?echo $top_bg_line;?>
topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?echo $rootdir;?>/forms/mtfc_note/save.php?mode=new" name="my_form">
<span class="title">MTFC Work/School Note</span><br></br>
<!--
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" style="color: #483D8B" onclick="top.restoreSession()">[Don't Save]</a>
<br></br>
-->
<?
//print "$name";
//print "Date:<input type=entry name=$date value=".date("Y-m-d")."> ";
?>
<table>
<tr>
  <td>
   <select name="note_type">
     <option value="Work Note">Work Note</option>
     <option value="School Note">School Note</option>
   <br></select>
   </td>
</tr>

<tr>
  <td colspan="2" bgcolor="#ffffff"></td>
</tr>
<tr align="left" valign="top">
  <td colspan="2" bgcolor="#e0e0e0">
  <br><br>
  <table width="100%" border = "0">
  <tr>
    <td><b>Date Seen:</b> &nbsp;&nbsp;<input type='text' size='15' name='date_seen' /><br></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Patient is unable to return to work/school until follow-up visit:</td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='100' name='unable_to_work' /></td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Patient may return work/school on:</td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='100' name='may_return_work' /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Patient has the following restrictions:</td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='100' name='patient_restrictions' /></td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. No running, climbing, prolonged standing and walking</td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. No physical education or organized sports</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Limited or no use of <input type='text' size='50' name='limited_work' /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. No overhead work</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5. No driving or operating dangerous machinery</td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Use:</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i. Sling&nbsp;&nbsp;<input type='text' size='10' name='sling' /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii. Crutches&nbsp;&nbsp;<input type='text' size='10' name='crutches' /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii. Splint&nbsp;&nbsp;<input type='text' size='10' name='splint' /></td>
  </tr>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iv. Other&nbsp;&nbsp;<input type='text' size='10' name='other' /></td>
  </tr>
  <tr>         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Medication which may be used at work/school:</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="medication_work" rows="7" cols="47" wrap="virtual name"></textarea></td>
  </tr>
  <tr>
    <td><b>Signature:</b></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;Doctor:&nbsp;&nbsp;&nbsp;<select name="doctor">
      						<option value="Katherine W. Jones, MD">Katherine W. Jones, MD</option>
      						<option value="Christina Savage, CFNP">Christina Savage, CFNP</option>
						<option value="Rachel M. McHenry, RN, MSN, CFNP">Rachel M. McHenry, RN, MSN, CFNP</option>
      						<br><br>
     						</select>
   </td>
  </tr>
</table>
</td>
</tr>
</table>
<?
//global $date;
//$date = date("Y-m-d");
//print "Date:$encounter";
//print "Date:<input type=entry name=$date value=".date("Y-m-d")."> ";
?>
<?
  $date = date("m-d-Y");
?>
<br>
<span class="text">Date:</span>&nbsp;&nbsp;<input type="entry" name="date_of_signature" 
value="<?php echo $date ?>">
</input>
<br></br>

<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" style="color: #483D8B" onclick="top.restoreSession()">[Don't Save]</a>
</form>
<?php
formFooter();
?>
