<!-- Form generated from formsWiz -->
<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: mtfc_reviewofs");
?>
<html><head>
<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">
</head>
<body <?echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?echo $rootdir;?>/forms/mtfc_reviewofs/save.php?mode=new" name="my_form">
<span class="title">Review of Systems Checks</span><br><br>

<table><tr><td valign=top>

<span class=bold>General</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='fever' value='pos'>
<input type="radio" name='fever' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Fever</span><br>
<input type="radio" name='chills' value='pos'>
<input type="radio" name='chills' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Chills</span><br>
<input type="radio" name='night_sweats' value='pos'>
<input type="radio" name='night_sweats' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Night Sweats</span><br>
<input type="radio" name='weight_gain' value='pos'>
<input type="radio" name='weight_gain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Weight Gain</span><br>
<input type="radio" name='weight_loss' value='pos'>
<input type="radio" name='weight_loss' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Weight Loss</span><br>
<input type="radio" name='appetite change' value='pos'>
<input type="radio" name='appetite change' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Appetite Change</span><br>
<input type="radio" name='insomnia' value='pos'>
<input type="radio" name='insomnia' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Insomnia</span><br>
<input type="radio" name='fatigue' value='pos'>
<input type="radio" name='fatigue' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Fatigue</span><br>
<input type="radio" name='depressed' value='pos'>
<input type="radio" name='depressed' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Depressed</span><br>
<input type="radio" name='anxious' value='pos'>
<input type="radio" name='anxious' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Anxious</span><br>
<input type="radio" name='irritable' value='pos'>
<input type="radio" name='irritable' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Irritable</span><br>
<input type="radio" name='travel_to_foreign_country' value='pos'>
<input type="radio" name='travel_to_foreign_country' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Recent Travel to Foreign Country</span><br>
<br>
<span class=bold>Skin</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='rashes' value='pos'>
<input type="radio" name='rashes' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Rashes</span><br>
<input type="radio" name='infections' value='pos'>
<input type="radio" name='infections' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Infections</span><br>
<input type="radio" name='ulcerations' value='pos'>
<input type="radio" name='ulcerations' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Ulcerations</span><br>
<input type="radio" name='new_lesions' value='pos'>
<input type="radio" name='new_lesions' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>New Lesions</span><br>
<input type="radio" name='change_in_moles' value='pos'>
<input type="radio" name='change_in_moles' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Change in Moles</span><br>

</td><td valign=top>

<span class=bold>HEENT</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='double_vision' value='pos'>
<input type="radio" name='double_vision' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Double Vision</span><br>
<input type="radio" name='blurred_vision' value='pos'>
<input type="radio" name='blurred_vision' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Blurred Vision</span><br>
<input type="radio" name='change_in_hearing' value='pos'>
<input type="radio" name='change_in_hearing' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Change in Hearing</span><br>
<input type="radio" name='headaches' value='pos'>
<input type="radio" name='headaches' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Headaches</span><br>
<input type="radio" name='ringing_in_ears' value='pos'>
<input type="radio" name='ringing_in_ears' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Ringing in Ears</span><br>
<input type="radio" name='bloody_nose' value='pos'>
<input type="radio" name='bloody_nose' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Bloody Nose</span><br>
<input type="radio" name='sinus_pressure' value='pos'>
<input type="radio" name='sinus_pressure' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Sinus Pressure</span><br>
<input type="radio" name='dry_mouth' value='pos'>
<input type="radio" name='dry_mouth' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Dry Mouth</span><br>
<input type="radio" name='sore_throat' value='pos'>
<input type="radio" name='sore_throat' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Sore Throat</span><br>
<input type="radio" name='swollen_lymph_nodes' value='pos'>
<input type="radio" name='swollen_lymph_nodes' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Swollen Lymph Nodes</span><br>
<input type="radio" name='rhinorrhea' value='pos'>
<input type="radio" name='rhinorrhea' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Rhinorrhea</span><br>
<input type="radio" name='facial_pain' value='pos'>
<input type="radio" name='facial_pain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Facial Pain</span><br>
<input type="radio" name='earache' value='pos'>
<input type="radio" name='earache' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Earache</span><br>

</td><td valign=top>

<span class=bold>Cardiovascular</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='syncope_or_nearsyncope' value='pos'>
<input type="radio" name='syncope_or_nearsyncope' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Syncope or Nearsyncope</span><br>
<input type="radio" name='edema' value='pos'>
<input type="radio" name='edema' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Edema</span><br>
<input type="radio" name='doe' value='pos'>
<input type="radio" name='doe' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>DOE</span><br>
<input type="radio" name='pnd' value='pos'>
<input type="radio" name='pnd' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>PND</span><br>
<input type="radio" name='orthophea' value='pos'>
<input type="radio" name='orthophea' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Orthophea</span><br>
<input type="radio" name='irregular_heart_beat' value='pos'>
<input type="radio" name='irregular_heart_beat' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Irregular Heart Beat/Palpitations</span><br>
<input type="radio" name='chest_pain' value='pos'>
<input type="radio" name='chest_pain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Chest Pain</span><br>
<input type="radio" name='shortness_of_breath' value='pos'>
<input type="radio" name='shortness_of_breath' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Shortness of Breath</span><br>
<input type="radio" name='high_blood_pressure' value='pos'>
<input type="radio" name='high_blood_pressure' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>High Blood Pressure</span><br>

<br><span class=bold>Endocrine</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='polyuria' value='pos'>
<input type="radio" name='polyuria' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Polyuria</span><br>
<input type="radio" name='polydipsia' value='pos'>
<input type="radio" name='polydipsia' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Polydipsia</span><br>
<input type="radio" name='tremulousness' value='pos'>
<input type="radio" name='tremulousness' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Tremulousness</span><br>
<input type="radio" name='hair_loss' value='pos'>
<input type="radio" name='hair_loss' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hair Loss</span><br>
<input type="radio" name='skin_changes' value='pos'>
<input type="radio" name='skin_changes' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Skin Changes</span><br>

</td><td valign=top>

<span class=bold>Pulmonary</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='hemoptysis' value='pos'>
<input type="radio" name='hemoptysis' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hemoptysis</span><br>
<input type="radio" name='wheezing' value='pos'>
<input type="radio" name='wheezing' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Wheezing</span><br>
<input type="radio" name='cough' value='pos'>
<input type="radio" name='cough' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Cough</span><br>
<input type="radio" name='shortness_of_breath_2' value='pos'>
<input type="radio" name='shortness_of_breath_2' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Shortness of Breath</span><br>

<br><span class=bold>Genitourinary</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='burning_with_urination' value='pos'>
<input type="radio" name='burning_with_urination' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Burning with Urination/Dysuria</span><br>
<input type="radio" name='discharge_from_urethra' value='pos'>
<input type="radio" name='discharge_from_urethra' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Discharge From Urethra</span><br>
<input type="radio" name='incontinence' value='pos'>
<input type="radio" name='incontinence' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Incontinence</span><br>
<input type="radio" name='change_in_menses' value='pos'>
<input type="radio" name='change_in_menses' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Change in Menses</span><br>
<input type="radio" name='urinary_frequency' value='pos'>
<input type="radio" name='urinary_frequency' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Urinary Frequency</span><br>
<input type="radio" name='urinary_hesitency' value='pos'>
<input type="radio" name='urinary_hesitency' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Urinary Hesitency</span><br>
<input type="radio" name='nocturia' value='pos'>
<input type="radio" name='nocturia' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Nocturia</span><br>
<input type="radio" name='enuresis' value='pos'>
<input type="radio" name='enuresis' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Enuresis</span><br>

</td><td valign=top>

<span class=bold>Gastrointestinal</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='abdominal_pain' value='pos'>
<input type="radio" name='abdominal_pain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Abdominal Pain</span><br>
<input type="radio" name='nausea' value='pos'>
<input type="radio" name='nausea' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Nausea</span><br>
<input type="radio" name='vomiting' value='pos'>
<input type="radio" name='vomiting' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Vomiting</span><br>
<input type="radio" name='diarrhea' value='pos'>
<input type="radio" name='diarrhea' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Diarrhea</span><br>
<input type="radio" name='constipation' value='pos'>
<input type="radio" name='constipation' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Constipation</span><br>
<input type="radio" name='dysphagia' value='pos'>
<input type="radio" name='dysphagia' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Dysphagia</span><br>
<input type="radio" name='heartburn' value='pos'>
<input type="radio" name='heartburn' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Heartburn</span><br>
<input type="radio" name='melena' value='pos'>
<input type="radio" name='melena' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Melena</span><br>
<input type="radio" name='hemato_chezia' value='pos'>
<input type="radio" name='hemato_chezia' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hemato-chezia</span><br>
<input type="radio" name='other_change_in_bowel_habits' value='pos'>
<input type="radio" name='other_change_in_bowel_habits' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Other Change in Bowel Habits</span><br>

</td><td valign=top>

<span class=bold>Musculoskeletal</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='swollen_joints' value='pos'>
<input type="radio" name='swollen_joints' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Swollen Joints</span><br>
<input type="radio" name='stiff_joints' value='pos'>
<input type="radio" name='stiff_joints' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Stiff Joints</span><br>
<input type="radio" name='neck_problems' value='pos'>
<input type="radio" name='neck_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Neck Problems</span><br>
<input type="radio" name='back_problems' value='pos'>
<input type="radio" name='back_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Back Problems</span><br>
<input type="radio" name='shoulder_problems' value='pos'>
<input type="radio" name='shoulder_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Shoulder Problems</span><br>
<input type="radio" name='elbow_problems' value='pos'>
<input type="radio" name='elbow_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Elbow Problems</span><br>
<input type="radio" name='wrist_problems' value='pos'>
<input type="radio" name='wrist_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Wrist Problems</span><br>
<input type="radio" name='hand_problems' value='pos'>
<input type="radio" name='hand_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hand Problems</span><br>
<input type="radio" name='hip_problems' value='pos'>
<input type="radio" name='hip_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hip Problems</span><br>
<input type="radio" name='knee_problems' value='pos'>
<input type="radio" name='knee_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Knee Problems</span><br>
<input type="radio" name='ankle_problems' value='pos'>
<input type="radio" name='ankle_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Ankle Problems</span><br>
<input type="radio" name='foot_problems' value='pos'>
<input type="radio" name='foot_problems' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Foot Problems</span><br>
<input type="radio" name='myalgias' value='pos'>
<input type="radio" name='myalgias' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Myalgias</span><br>
<input type="radio" name='redness' value='pos'>
<input type="radio" name='redness' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Redness</span><br>
<br>
<span class=bold>Neuro</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='ha' value='pos'>
<input type="radio" name='ha' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>HA</span><br>
<input type="radio" name='vision_change' value='pos'>
<input type="radio" name='vision_change' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Vision Change</span><br>
<input type="radio" name='numbness' value='pos'>
<input type="radio" name='numbness' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Numbness</span><br>
<input type="radio" name='dizziness' value='pos'>
<input type="radio" name='dizziness' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Dizziness</span><br>
<input type="radio" name='weakness' value='pos'>
<input type="radio" name='weakness' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Weakness</span><br>
<input type="radio" name='imbalance' value='pos'>
<input type="radio" name='imbalance' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Imbalance</span><br>
<input type="radio" name='change_in_gait' value='pos'>
<input type="radio" name='change_in_gait' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Change in Gait</span><br>
<input type="radio" name='memory_difficulties' value='pos'>
<input type="radio" name='memory_difficulties' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Memory Difficulties</span><br>
<input type="radio" name='spasticity' value='pos'>
<input type="radio" name='spasticity' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Spasticity</span><br>
</td>
</tr>
</table>





<br><br><br>
<center><span class=text><b>Additional Notes:</b> </span><br><textarea cols=80 rows=12 wrap=virtual name="additional_notes" ></textarea><br>
<br>
<a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit"><b>[Save]</b></a>
<br>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link" onclick="top.restoreSession()">[Don't Save]</a></center>
</form>
<?php
formFooter();
?>
