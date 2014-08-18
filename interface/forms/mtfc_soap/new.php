<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: Physical Exam");
?>

<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
               
               
                
               
                // When checkbox yes is clicked
                $(".showcomment").click(function () {
                   var IDofComment = $(this).attr("data-commentValue");
                  
                //$("#comment_container").removeClass("hideMe"); 
                $('#' + IDofComment).removeClass("hideMe");
                
                //$("#comment_container").addClass("showMe");
                $('#' + IDofComment).addClass("showMe");
                
                //$('#' + IDofComment).slideDown("slow");
 
                });
                
                
                // When checkbox no is clicked
                $(".hidecomment").click(function () {

                var IDofComment = $(this).attr("data-commentValue");
                
                //$('#' + IDofComment).slideUp("slow");
               
               // $("#comment_container").removeClass("showMe");
                $('#' + IDofComment).removeClass("showMe");
                
                //$("#comment_container").addClass("hideMe");              
                $('#' + IDofComment).addClass("hideMe");
                
                });
                
              

});
</script>

 <style type="text/css" title="mystyles" media="all">
<!--

.showMe {
    font-size:11pt;
    font-family:arial;
}
.hideMe {
	display:none;
}
input.cmnt {
    height: 5em;
    }
td {
	font-size:12pt;
	font-family:helvetica;
}
li{
	font-size:11pt;
	font-family:helvetica;
	margin-left: 15px;
}
a {
	font-size:11pt;
	font-family:helvetica;
}
.title {
	font-family: sans-serif;
	font-size: 12pt;
	font-weight: bold;
	text-decoration: none;
	color: #000000;
}

.form_text{
	font-family: sans-serif;
	font-size: 9pt;
	text-decoration: none;
	color: #000000;
}

.formfield * {
    vertical-align: middle;
}

-->
</style>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?echo $rootdir;?>/forms/mtfc_soap/save.php?mode=new" name="my_form">
<p align="Center"><span class="title">Middle Tennessee Family Care Physical Exam</span></p>

<table width="100%" border="1">
	<tr>
		<td align="left"><font size="1" face="arial"><b>GENERAL:</b></font></td>
		<td width="90%" valign="top">
		   <table width="100%">
		     <tr>
		        <td width="100%"><font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='well_develop' class="hidecomment" data-commentValue="cmnt_container1" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='well_develop' class="showcomment" data-commentValue="cmnt_container1" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Well developed, Well nourished, No acute distress</span><br>
                   </font>
                   
                   <div id="cmnt_container1" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="well_develop_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='dress_appropriate' class="hidecomment" data-commentValue="cmnt_container2" value='nrml' checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='dress_appropriate' class="showcomment" data-commentValue="cmnt_container2" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Dressed appropriately, age appropriate speech</span><br>
                   </font>
                   
                   <div id="cmnt_container2" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="dress_appropriate_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                </td>
             </tr>
           </table>
		</td>
	</tr>
	<tr>
	    <td align="left"><font size="1" face="arial"><b>EYES:</b></font></td>
	    <td width="90%" valign="top">
		   <table width="100%">
		     <tr>
		        <td width="100%"><font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='conj_lids' value='nrml' class="hidecomment" data-commentValue="cmnt_container3" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='conj_lids' class="showcomment" data-commentValue="cmnt_container3" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection of conjunctivae and lids</span><br>
                   </font>
                   
                   <div id="cmnt_container3" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="conj_lids_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='peerla' value='nrml' class="hidecomment" data-commentValue="cmnt_container4" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='peerla' class="showcomment" data-commentValue="cmnt_container4" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>PEERLA</span><br>
                   </font>
                   
                   <div id="cmnt_container4" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="peerla_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='opthalm_exam' value='nrml' class="hidecomment" data-commentValue="cmnt_container5" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='opthalm_exam' class="showcomment" data-commentValue="cmnt_container5" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Opthalmoscopic examination</span><br>
                   </font>
                   
                   <div id="cmnt_container5" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="opthalm_exam_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                 </td>
             </tr>
           </table>
		</td>
	</tr>
	<tr>
	    <td align="left"><font size="1" face="arial"><b>ENT:</b></font></td>
	    <td width="90%" valign="top">
		   <table width="100%">
		     <tr>
		        <td width="100%"><font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='inspect_ears' value='nrml' class="hidecomment" data-commentValue="cmnt_container6" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='inspect_ears' class="showcomment" data-commentValue="cmnt_container6" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>External inspection of ears and nose</span><br>
                   </font>
                   
                   <div id="cmnt_container6" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_ears_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='otoscopic_exam' value='nrml' class="hidecomment" data-commentValue="cmnt_container7" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='otoscopic_exam' class="showcomment" data-commentValue="cmnt_container7" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Otoscopic exam (TM dull, air/fluid level, red, bulging)</span><br>
                   </font>
                   
                   <div id="cmnt_container7" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="otoscopic_exam_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='assess_hearing' value='nrml' class="hidecomment" data-commentValue="cmnt_container8" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='assess_hearing' class="showcomment" data-commentValue="cmnt_container8" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Assessment of Hearing</span><br>
                   </font>
                   
                   <div id="cmnt_container8" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="assess_hearing_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='inspect_nasal' value='nrml' class="hidecomment" data-commentValue="cmnt_container9" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='inspect_nasal' class="showcomment" data-commentValue="cmnt_container9" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection of nasal mucosa ( pale boggy, red, swelling, discharge - clear, yellow, green, bloody )</span><br>
                   </font>
                   
                   <div id="cmnt_container9" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_nasal_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='inspect_lips' value='nrml' class="hidecomment" data-commentValue="cmnt_container10" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='inspect_lips' class="showcomment" data-commentValue="cmnt_container10" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection of lips, teeth, gums</span><br>
                   </font>
                   
                   <div id="cmnt_container10" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_lips_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='exam_oropharynx' value='nrml' class="hidecomment" data-commentValue="cmnt_container11" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='exam_oropharynx' class="showcomment" data-commentValue="cmnt_container11" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Exam of oropharynx (red, tonsilar swelling, exudates)</span><br>
                   </font>
                   
                   <div id="cmnt_container11" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="exam_oropharynx_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='sinus_wnl' value='nrml' class="hidecomment" data-commentValue="cmnt_container12" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='sinus_wnl' class="showcomment" data-commentValue="cmnt_container12" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Sinus WNL ( F, E, M, pain to palp, percussion )</span><br>
                   </font>
                   
                   <div id="cmnt_container12" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="sinus_wnl_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                 </td>
             </tr>
           </table>
		</td>
	</tr>
	<tr>
	    <td align="left"><font size="1" face="arial"><b>NECK:</b></font></td>
	    <td width="90%" valign="top">
		   <table width="100%">
		     <tr>
		        <td width="100%">
		           
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='full_rom_midline_trachea' class="hidecomment" data-commentValue="cmnt_container13" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='full_rom_midline_trachea' class="showcomment" data-commentValue="cmnt_container13" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Full ROM, midline trachea</span><br>
                   </font>
                   
                   <div id="cmnt_container13" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="fullrom_mid_trachea_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                   
                   <font size="1" face="arial">
                   <span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
                   &nbsp;&nbsp;<input type="radio" name='exam_thyroid' value='nrml' class="hidecomment" data-commentValue="cmnt_container14" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name='exam_thyroid' class="showcomment" data-commentValue="cmnt_container14" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Examination of thyroid</span><br>
                   </font>
                   
                   <div id="cmnt_container14" class="hideMe"><br>
                   <font size="1" face="arial">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="exam_thyroid_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                   </font><br><br></div>
                 </td>
             </tr>
           </table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>RESP:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="assess_resp" class="hidecomment" data-commentValue="cmnt_container15" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="assess_resp" class="showcomment" data-commentValue="cmnt_container15" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Assessment of resp. effort (labored, shallow, tachypnic)</span><br>
						</font>
						
						<div id="cmnt_container15" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="assess_resp_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                   
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="percussion" class="hidecomment" data-commentValue="cmnt_container16" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="percussion" class="showcomment" data-commentValue="cmnt_container16" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Percussion (flatness, dullness, hyperresonance)</span><br>
						</font>
						
						<div id="cmnt_container16" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="percussion_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="palpation" class="hidecomment" data-commentValue="cmnt_container17" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="palpation" class="showcomment" data-commentValue="cmnt_container17" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Palpation (tactile fremitus, pain with AP and Lat. Palp)</span><br>
						</font>
						
						<div id="cmnt_container17" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="palpation_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="auscultation" class="hidecomment" data-commentValue="cmnt_container18" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="auscultation" class="showcomment" data-commentValue="cmnt_container18" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Auscultation (tight, wheeze, crackles, stridor)</span><br>
						</font>
						
						<div id="cmnt_container18" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="auscultation_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>CV:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="palp_heart" class="hidecomment" data-commentValue="cmnt_container19" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="palp_heart" class="showcomment" data-commentValue="cmnt_container19" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Palpation of heart with no thrills</span><br>
						</font>
						
						<div id="cmnt_container19" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="palp_heart_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="auscu_heart" class="hidecomment" data-commentValue="cmnt_container20" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="auscu_heart" class="showcomment" data-commentValue="cmnt_container20" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Auscultation of heart with RRR, no murmurs or gallops</span><br>
						</font>
						
						<div id="cmnt_container20" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="auscu_heart_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="carotid" class="hidecomment" data-commentValue="cmnt_container21" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="carotid" class="showcomment" data-commentValue="cmnt_container21" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Carotid arteries</span><br>
						</font>
						
						<div id="cmnt_container21" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="carotid_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="abdominal_aorta" class="hidecomment" data-commentValue="cmnt_container22" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="abdominal_aorta" class="showcomment" data-commentValue="cmnt_container22" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Abdominal aorta</span><br>
						</font>
						
						<div id="cmnt_container22" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="abdominal_aorta_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="femoral_arteries" class="hidecomment" data-commentValue="cmnt_container23" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="femoral_arteries" class="showcomment" data-commentValue="cmnt_container23" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Femoral arteries</span><br>
						</font>
						
						<div id="cmnt_container23" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="femoral_arteries_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="pedal_pulses" class="hidecomment" data-commentValue="cmnt_container24" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="pedal_pulses" class="showcomment" data-commentValue="cmnt_container24" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Pedal pulses ( dorsalis pedis, posterior tibial )</span><br>
						</font>
						
						<div id="cmnt_container24" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="pedal_pulses_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="no_edema" class="hidecomment" data-commentValue="cmnt_container25" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="no_edema" class="showcomment" data-commentValue="cmnt_container25" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>No edema or varicosities in extremities</span><br>
						</font>
						
						<div id="cmnt_container25" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="no_edema_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>MSKL:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="assess_gait" class="hidecomment" data-commentValue="cmnt_container26" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="assess_gait" class="showcomment" data-commentValue="cmnt_container26" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Assessment of gait</span><br>
						</font>
						
						<div id="cmnt_container26" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="assess_gait_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="inspect_digits" class="hidecomment" data-commentValue="cmnt_container27" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="inspect_digits" class="showcomment" data-commentValue="cmnt_container27" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection and/or palpation of digits and nails.</span><br>
						<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;One or more of the following areas:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. <input type="checkbox" name="head_neck" value='hn'> Head/Neck
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. <input type="checkbox" name="rue" value='rue'> RUE
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5. <input type="checkbox" name="lue" value='lue'> LUE<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. <input type="checkbox" name="spine_ribs" value='sr'> Spine, Ribs, Pelvis
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. <input type="checkbox" name="rle" value='rle'> RLE
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. <input type="checkbox" name="lle" value='lle'> LLE</span></font><br>
						
						<div id="cmnt_container27" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_digits_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="inspect_deform" class="hidecomment" data-commentValue="cmnt_container28" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="inspect_deform" class="showcomment" data-commentValue="cmnt_container28" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection and/or palpation without deformity</span><br>
						</font>
						
						<div id="cmnt_container28" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_deform_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="fullrom_limited" class="hidecomment" data-commentValue="cmnt_container29" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="fullrom_limited" class="showcomment" data-commentValue="cmnt_container29" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Full ROM ( limited ROM, pain, crepitus )</span><br>
						</font>
						
						<div id="cmnt_container29" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="fullrom_limited_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="joint_intact" class="hidecomment" data-commentValue="cmnt_container30" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="joint_intact" class="showcomment" data-commentValue="cmnt_container30" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Joint intact and stable</span><br>
						</font>
						
						<div id="cmnt_container30" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="joint_intact_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="muscle_strength" class="hidecomment" data-commentValue="cmnt_container31" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="muscle_strength" class="showcomment" data-commentValue="cmnt_container31" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Muscle strength and tone ( weakness to resistance, atrophy )</span><br>
						</font>
						
						<div id="cmnt_container31" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="muscle_strength_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>Neuro:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="cn11" class="hidecomment" data-commentValue="cmnt_container32" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="cn11" class="showcomment" data-commentValue="cmnt_container32" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>CN 11-X11 Intact</span><br>
						</font>
						
						<div id="cmnt_container32" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="cn11_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c2" class="hidecomment" data-commentValue="cmnt_container33" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c2" class="showcomment" data-commentValue="cmnt_container33" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C2- Visual fields full to confrontation</span><br>
						</font>
						 
						<div id="cmnt_container33" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c2_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c3" class="hidecomment" data-commentValue="cmnt_container34" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c3" class="showcomment" data-commentValue="cmnt_container34" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C3 - C4 - C6- PERRLA, EOMs intact</span><br>
						</font>
						
						<div id="cmnt_container34" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c3_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c5" class="hidecomment" data-commentValue="cmnt_container35" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c5" class="showcomment" data-commentValue="cmnt_container35" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C5- Corneal reflex intact bilat., jaw clenching, sensation to maxillary and mandible</span><br>
						</font>
						
						<div id="cmnt_container35" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c5_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c7" class="hidecomment" data-commentValue="cmnt_container36" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c7" class="showcomment" data-commentValue="cmnt_container36" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C7- Facial movement symmetrical</span><br>
						</font>
						
						<div id="cmnt_container36" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c7_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c8" class="hidecomment" data-commentValue="cmnt_container37" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c8" class="showcomment" data-commentValue="cmnt_container37" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C8- Vibrations sensed equally bilat, repeats > 60% whispered words.</span><br>
						</font>
						
						<div id="cmnt_container37" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c8_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c9" class="hidecomment" data-commentValue="cmnt_container38" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c9" class="showcomment" data-commentValue="cmnt_container38" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C9 - C10- Upward movt. of palate and contraction of pharyngeal muscles, uvula midline, Gag reflex</span><br>
						</font>
						
						<div id="cmnt_container38" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c9_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c11" class="hidecomment" data-commentValue="cmnt_container39" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c11" class="showcomment" data-commentValue="cmnt_container39" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C11- Bilat symmetric with full resistance to opposition</span><br>
						</font>
						
						<div id="cmnt_container39" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c11_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="c12" class="hidecomment" data-commentValue="cmnt_container40" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="c12" class="showcomment" data-commentValue="cmnt_container40" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>C12- Tongue steady, firm pressure, symmetrical with no atrophy</span><br>
						</font>
						
						<div id="cmnt_container40" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="c12_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="touch_pain" class="hidecomment" data-commentValue="cmnt_container41" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="touch_pain" class="showcomment" data-commentValue="cmnt_container41" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Touch and pain sensation intact bilat</span><br>
						</font>
						
						<div id="cmnt_container41" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="touch_pain_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="dtr_equal" class="hidecomment" data-commentValue="cmnt_container42" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="dtr_equal" class="showcomment" data-commentValue="cmnt_container42" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>DTR equal, Neg. Babinski, Neg. Rhomberg, MAEW, rapid alternating hand movt., heel to chin</span><br>
						</font>
						
						<div id="cmnt_container42" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="dtr_equal_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>Psych:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="judge_n_insight" class="hidecomment" data-commentValue="cmnt_container43" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="judge_n_insight" class="showcomment" data-commentValue="cmnt_container43" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Judgement and insight WNL</span><br>
						</font>
						
						<div id="cmnt_container43" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="judgensight_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="alert_oriented" class="hidecomment" data-commentValue="cmnt_container44" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="alert_oriented" class="showcomment" data-commentValue="cmnt_container44" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Alert and oriented X 3</span><br>
						</font>
						
						<div id="cmnt_container44" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="alert_oriented_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="recent_remote_memory" class="hidecomment" data-commentValue="cmnt_container45" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="recent_remote_memory" class="showcomment" data-commentValue="cmnt_container45" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Recent and remote memory intact</span><br>
						</font>
						
						<div id="cmnt_container45" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="recent_memory_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="no_mood_disorders" class="hidecomment" data-commentValue="cmnt_container46" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="no_mood_disorders" class="showcomment" data-commentValue="cmnt_container46" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>No mood disorders noted, affect, flat, dull, anxious, crying</span><br>
						</font>
						
						<div id="cmnt_container46" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="nomood_disorders_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="suicidal_homicidal" class="hidecomment" data-commentValue="cmnt_container47" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="suicidal_homicidal" class="showcomment" data-commentValue="cmnt_container47" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Suicidal, homicidal / delusions, hallucinations</span><br>
						</font>
						
						<div id="cmnt_container47" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="suicidal_homicidal_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>GI:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="abdomen_soft" class="hidecomment" data-commentValue="cmnt_container48" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="abdomen_soft" class="showcomment" data-commentValue="cmnt_container48" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Abdomen soft non-tender, no masses, BS x 4 quad</span><br>
						</font>
						
						<div id="cmnt_container48" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="abdomen_soft_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="liver_spleen" class="hidecomment" data-commentValue="cmnt_container49" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="liver_spleen" class="showcomment" data-commentValue="cmnt_container49" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Liver and spleen without tenderness or enlargement</span><br>
						</font>
						
						<div id="cmnt_container49" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="liver_spleen_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="hernia" class="hidecomment" data-commentValue="cmnt_container50" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="hernia" class="showcomment" data-commentValue="cmnt_container50" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Hernia ( ventral, umbilical, inguinal - direct or indirect )</span><br>
						</font>
						
						<div id="cmnt_container50" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="hernia_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="rectal" value='nrml' class="hidecomment" data-commentValue="cmnt_container51" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="rectal" class="showcomment" data-commentValue="cmnt_container51" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Rectal: Even sphincter tone, no hemorrhoids</span><br>
						</font>
						
						<div id="cmnt_container51" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="rectal_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="occult_blood_test" class="hidecomment" data-commentValue="cmnt_container52" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="occult_blood_test" class="showcomment" data-commentValue="cmnt_container52" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Occult blood test negative with no gross blood present</span><br>
						</font>
						
						<div id="cmnt_container52" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="occult_bloodtest_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="neg_cva" class="hidecomment" data-commentValue="cmnt_container53" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="neg_cva" class="showcomment" data-commentValue="cmnt_container53" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Neg. CVA, rebound, heel slap, obturator, psoas, rovsing's</span><br>
						</font>
						
						<div id="cmnt_container53" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="neg_cva_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>Lymph:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%">
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="area_palpated" class="hidecomment" data-commentValue="cmnt_container54" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="area_palpated" class="showcomment" data-commentValue="cmnt_container54" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Area palpated with no enlargement (select 2)</span><br>
						<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. <input type="checkbox" name="areapalpated_neck" value='neck'> Neck
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. <input type="checkbox" name="axillary" value='axillary'> Axillary
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. <input type="checkbox" name="groin" value='groin'> Groin
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. <input type="checkbox" name="other" value='other'> Other <br>
						</span></font>
						
						<div id="cmnt_container54" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="area_palpated_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>Skin:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="pink_no_rashes" class="hidecomment" data-commentValue="cmnt_container55" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="pink_no_rashes" class="showcomment" data-commentValue="cmnt_container55" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Pink with no rashes, lesions, ulcers, ecchymosis</span><br>
						</font>
						
						<div id="cmnt_container55" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="pink_norashes_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="moist_warm_dry" class="hidecomment" data-commentValue="cmnt_container56" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="moist_warm_dry" class="showcomment" data-commentValue="cmnt_container56" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Moist, warm, dry with normal turger and brisk cap refill</span><br>
						</font>
						
						<div id="cmnt_container56" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="moist_warm_dry_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>GU:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Male:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="scrotum_epididymis" class="hidecomment" data-commentValue="cmnt_container57" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="scrotum_epididymis" class="showcomment" data-commentValue="cmnt_container57" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Scrotum, epididymis, testes</span><br>
						</font>
						
						<div id="cmnt_container57" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="scrotum_epididymis_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="penis_without_deformity" class="hidecomment" data-commentValue="cmnt_container58" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="penis_without_deformity" class="showcomment" data-commentValue="cmnt_container58" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Penis without deformity, lesions, or discharge</span><br>
						</font>
						
						<div id="cmnt_container58" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="penis_wo_deformity_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="prostate_lat_lobes" class="hidecomment" data-commentValue="cmnt_container59" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="prostate_lat_lobes" class="showcomment" data-commentValue="cmnt_container59" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Prostate, lateral lobes symmetrical, smooth, rubbery</span><br>
						</font>
						
						<div id="cmnt_container59" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="prostate_lat_lobes_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div><br>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Female:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="no_external_lesions" class="hidecomment" data-commentValue="cmnt_container60" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="no_external_lesions" class="showcomment" data-commentValue="cmnt_container60" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>No external lesions. Normal hair distribution. Vaginal mucosa moist and pink without lesions or abnormal DC.</span><br>
						</font>
						
						<div id="cmnt_container60" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="noexternal_lesions_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="urethra_intact" class="hidecomment" data-commentValue="cmnt_container61" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="urethra_intact" class="showcomment" data-commentValue="cmnt_container61" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Urethra intact, no tenderness, masses, inflammation or DC.</span><br>
						</font>
						
						<div id="cmnt_container61" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="urethra_intact_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="bladder_wo_tenderness" class="hidecomment" data-commentValue="cmnt_container62" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="bladder_wo_tenderness" class="showcomment" data-commentValue="cmnt_container62" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Bladder without tenderness or masses, no incontinence</span><br>
						</font>
						
						<div id="cmnt_container62" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="bladder_wo_tenderness_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cervix_pink" class="hidecomment" data-commentValue="cmnt_container63" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="cervix_pink" class="showcomment" data-commentValue="cmnt_container63" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Cervix pink, no lesions, odor or DC.</span><br>
						</font>
						
						<div id="cmnt_container63" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="cervix_pink_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="uterus_midline" class="hidecomment" data-commentValue="cmnt_container64" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="uterus_midline" class="showcomment" data-commentValue="cmnt_container64" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Uterus midline, non-tender, firm, smooth</span><br>
						</font>
						
						<div id="cmnt_container64" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="uterus_midline_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="adnexal_masses" class="hidecomment" data-commentValue="cmnt_container65" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="adnexal_masses" class="showcomment" data-commentValue="cmnt_container65" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>No adnexal masses, nodules, tenderness</span><br>
						</font>
						
						<div id="cmnt_container65" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="adnexal_masses_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><font size="1" face="arial"><b>Chest:</b></font></td>
		<td width="90%" valign="top">
			<table width="100%">
				<tr>
					<td width="100%"><font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="inspect_breast" class="hidecomment" data-commentValue="cmnt_container66" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="inspect_breast" class="showcomment" data-commentValue="cmnt_container66" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Inspection of breast with no dimpling or nipple discharge</span><br>
						</font>
						
						<div id="cmnt_container66" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="inspect_breast_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
                        
						<font size="1" face="arial">
						<span class=bold><font size="1" face="arial">Normal &nbsp;&nbsp;&nbsp;Abnormal</font></span><br>
						&nbsp;&nbsp;<input type="radio" name="exam_breast" class="hidecomment" data-commentValue="cmnt_container67" value='nrml' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="exam_breast" class="showcomment" data-commentValue="cmnt_container67" value='abnl'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=text>Examination of breast with no masses, lumps, tenderness</span><br>
						</font>
						
						<div id="cmnt_container67" class="hideMe"><br>
                        <font size="1" face="arial">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="formfield"><b>Comments:</b> <textarea name="exam_breast_comment" rows="4" cols="50" wrap=virtual></textarea></span>
                        </font><br><br></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
	 <!-- 
	 	<td><input type="submit" name="Submit" value="Save Form"></td><td><a href="{$DONT_SAVE_LINK}" class="link" onclick="top.restoreSession()">[Don't Save]</a></td>
	-->
		<td><a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit"><b><font color="red">[Save]</font></b></a></td>
	    <td><a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()"><font color="blue">[Don't Save]</font></a></td>
	</tr>
	
</table>
<!--  
<input type="hidden" name="id" value="{$data->get_id()}" />
<input type="hidden" name="activity" value="{$data->get_activity()}">
<input type="hidden" name="pid" value="{$data->get_pid()}">
<input type="hidden" name="process" value="true">
-->
</form>
<?php formFooter();?>
</body>
</html>
