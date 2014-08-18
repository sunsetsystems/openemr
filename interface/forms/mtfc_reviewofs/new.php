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

<span class=bold>GN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Fever info -->
<input type="radio" name='fever' value='na' checked >
<input type="radio" name='fever' value='pos'>
<input type="radio" name='fever' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Fever</span><br>

<!-- Night Sweats info -->
<input type="radio" name='night_sweats' value='na' checked >
<input type="radio" name='night_sweats' value='pos'>
<input type="radio" name='night_sweats' value='neg' >&nbsp;&nbsp;&nbsp;<span class=text>N. Sweats</span><br>

<!-- Weight Change info -->
<input type="radio" name='weight_change' value='na' checked >
<input type="radio" name='weight_change' value='pos'>
<input type="radio" name='weight_change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Wt.Change</span><br>

<!-- Fatigue info -->
<input type="radio" name='fatigue' value='na' checked >
<input type="radio" name='fatigue' value='pos'>
<input type="radio" name='fatigue' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Fatigue</span><br>

<!-- Appetite info -->
<input type="radio" name='appetite change' value='na' checked >
<input type="radio" name='appetite change' value='pos'>
<input type="radio" name='appetite change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Appetite</span><br>

<!-- Irritable info -->
<input type="radio" name='irritable' value='na' checked >
<input type="radio" name='irritable' value='pos'>
<input type="radio" name='irritable' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Irritable</span><br>

<!-- Don't need

<input type="radio" name='travel_to_foreign_country' value='pos'>
<input type="radio" name='travel_to_foreign_country' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Recent Travel to Foreign Country</span><br>
<input type="radio" name='chills' value='pos'>
<input type="radio" name='chills' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Chills</span><br>
<input type="radio" name='weight_gain' value='pos'>
<input type="radio" name='weight_gain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Weight Gain</span><br>
<input type="radio" name='weight_loss' value='pos'>
<input type="radio" name='weight_loss' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Weight Loss</span><br>
-->

<br><span class=bold>ENT:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Ear ache info -->
<input type="radio" name='earache' value='na' checked>
<input type="radio" name='earache' value='pos'>
<input type="radio" name='earache' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ear ache</span><br>

<!-- Hearing Loss info -->
<input type="radio" name='change_in_hearing' value='na' checked>
<input type="radio" name='change_in_hearing' value='pos'>
<input type="radio" name='change_in_hearing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hearing Loss</span><br>

<!-- Rhinorrhea info -->
<input type="radio" name='rhinorrhea' value='na' checked>
<input type="radio" name='rhinorrhea' value='pos'>
<input type="radio" name='rhinorrhea' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Rhinorrhea</span><br>

<!-- Sneezing info -->
<input type="radio" name='sneezing' value='na' checked>
<input type="radio" name='sneezing' value='pos'>
<input type="radio" name='sneezing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Sneezing</span><br>

<!-- Facial Pain info -->
<input type="radio" name='facial_pain' value='na' checked>
<input type="radio" name='facial_pain' value='pos'>
<input type="radio" name='facial_pain' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Facial Pain</span><br>

<!-- Sore Throat info -->
<input type="radio" name='sore_throat' value='na' checked>
<input type="radio" name='sore_throat' value='pos'>
<input type="radio" name='sore_throat' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Sore Throat</span><br>

<!-- Epistaxis info -->
<input type="radio" name='epistaxis' value='na' checked>
<input type="radio" name='epistaxis' value='pos'>
<input type="radio" name='epistaxis' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Epistaxis</span><br>


<!-- Don't need
</td><td valign=top>

<span class=bold>HEENT</span><br>
&nbsp; <span class=bold>+ &nbsp;&nbsp; -</span><br>
<input type="radio" name='double_vision' value='pos'>
<input type="radio" name='double_vision' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Double Vision</span><br>
<input type="radio" name='blurred_vision' value='pos'>
<input type="radio" name='blurred_vision' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Blurred Vision</span><br>
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
<input type="radio" name='swollen_lymph_nodes' value='pos'>
<input type="radio" name='swollen_lymph_nodes' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Swollen Lymph Nodes</span><br>
-->
</td><td valign=top>

<span class=bold>CV:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>
<!-- CP/PALP info -->
<input type="radio" name='cp_palp' value='na' checked>
<input type="radio" name='cp_palp' value='pos'>
<input type="radio" name='cp_palp' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>CP/PALP</span><br>

<!-- DOE/PND info -->
<input type="radio" name='doe_pnd' value='na' checked>
<input type="radio" name='doe_pnd' value='pos'>
<input type="radio" name='doe_pnd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>DOE/PND</span><br>

<!-- Orthopnea info -->
<input type="radio" name='orthophea' value='na' checked>
<input type="radio" name='orthophea' value='pos'>
<input type="radio" name='orthophea' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Orthopnea</span><br>

<!-- Syncope info -->
<input type="radio" name='syncope_or_nearsyncope' value='na' checked>
<input type="radio" name='syncope_or_nearsyncope' value='pos'>
<input type="radio" name='syncope_or_nearsyncope' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Syncope</span><br>

<!-- Edema info -->
<input type="radio" name='edema' value='na' checked>
<input type="radio" name='edema' value='pos'>
<input type="radio" name='edema' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Edema</span><br>

<!-- Change in Blood Pressure info -->
<input type="radio" name='change_in_bp' value='na' checked>
<input type="radio" name='change_in_bp' value='pos'>
<input type="radio" name='change_in_bp' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in BP</span><br>

<!-- don't need 
<input type="radio" name='doe' value='pos'>
<input type="radio" name='doe' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>DOE</span><br>
<input type="radio" name='pnd' value='pos'>
<input type="radio" name='pnd' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>PND</span><br>
<input type="radio" name='irregular_heart_beat' value='pos'>
<input type="radio" name='irregular_heart_beat' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Irregular Heart Beat/Palpitations</span><br>
<input type="radio" name='chest_pain' value='pos'>
<input type="radio" name='chest_pain' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Chest Pain</span><br>
<input type="radio" name='shortness_of_breath' value='pos'>
<input type="radio" name='shortness_of_breath' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Shortness of Breath</span><br>
<input type="radio" name='high_blood_pressure' value='pos'>
<input type="radio" name='high_blood_pressure' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>High Blood Pressure</span><br>
<input type="radio" name='hemoptysis' value='pos'>
<input type="radio" name='hemoptysis' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Hemoptysis</span><br>
-->

<br><span class=bold>ENDO:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Increase in Urination info -->
<input type="radio" name='polyuria' value='na' checked>
<input type="radio" name='polyuria' value='pos'>
<input type="radio" name='polyuria' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Urination</span><br>

<!-- Increase in Thirst info -->
<input type="radio" name='polydipsia' value='na' checked>
<input type="radio" name='polydipsia' value='pos'>
<input type="radio" name='polydipsia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Thirst</span><br>

<!-- Increase in Hunger info -->
<input type="radio" name='incr_in_hunger' value='na' checked>
<input type="radio" name='incr_in_hunger' value='pos'>
<input type="radio" name='incr_in_hunger' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incr. in Hunger</span><br>

<!-- Tremulousness info -->
<input type="radio" name='tremulousness' value='na' checked>
<input type="radio" name='tremulousness' value='pos'>
<input type="radio" name='tremulousness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Tremulousness</span><br>

<!-- Hair Loss info -->
<input type="radio" name='hair_loss' value='na' checked>
<input type="radio" name='hair_loss' value='pos'>
<input type="radio" name='hair_loss' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hair Loss</span><br>

<!-- Skin Changes info -->
<input type="radio" name='skin_changes' value='na' checked>
<input type="radio" name='skin_changes' value='pos'>
<input type="radio" name='skin_changes' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Skin Changes</span><br>

</td><td valign=top>

<span class=bold>RESP:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Cough info -->
<input type="radio" name='cough' value='na' checked>
<input type="radio" name='cough' value='pos'>
<input type="radio" name='cough' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Cough</span><br>

<!-- Wheeze info -->
<input type="radio" name='wheezing' value='na' checked>
<input type="radio" name='wheezing' value='pos'>
<input type="radio" name='wheezing' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Wheeze</span><br>

<!-- Shortness of Breath info -->
<input type="radio" name='shortness_of_breath_2' value='na' checked>
<input type="radio" name='shortness_of_breath_2' value='pos'>
<input type="radio" name='shortness_of_breath_2' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>SOB</span><br>


<br><br><br><br><span class=bold>PSYCH:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Anxiety info -->
<input type="radio" name='anxiety' value='na' checked>
<input type="radio" name='anxiety' value='pos'>
<input type="radio" name='anxiety' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Anxiety</span><br>

<!-- Depression info -->
<input type="radio" name='depressed' value='na' checked>
<input type="radio" name='depressed' value='pos'>
<input type="radio" name='depressed' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Depression</span><br>

<!-- Insomnia info -->
<input type="radio" name='insomnia' value='na' checked>
<input type="radio" name='insomnia' value='pos'>
<input type="radio" name='insomnia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Insomnia</span><br>

<!-- ADHD info -->
<input type="radio" name='adhd' value='na' checked>
<input type="radio" name='adhd' value='pos'>
<input type="radio" name='adhd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>ADHD</span><br>

<!-- ADD info -->
<input type="radio" name='add_info' value='na' checked>
<input type="radio" name='add_info' value='pos'>
<input type="radio" name='add_info' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>ADD</span><br>

<!-- Bipolar info -->
<input type="radio" name='bipolar' value='na' checked>
<input type="radio" name='bipolar' value='pos'>
<input type="radio" name='bipolar' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Bipolar</span><br>

</td><td valign=top>

<span class=bold>GI:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- NVD info -->
<input type="radio" name='nvd' value='na' checked>
<input type="radio" name='nvd' value='pos'>
<input type="radio" name='nvd' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>N - V - D</span><br>

<!-- Dysphagia info -->
<input type="radio" name='dysphagia' value='na' checked>
<input type="radio" name='dysphagia' value='pos'>
<input type="radio" name='dysphagia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dysphagia</span><br>

<!-- Bowel Habits Change info -->
<input type="radio" name='other_change_in_bowel_habits' value='na' checked>
<input type="radio" name='other_change_in_bowel_habits' value='pos'>
<input type="radio" name='other_change_in_bowel_habits' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Bowel Habits Ch.</span><br>

<!-- Heartburn info -->
<input type="radio" name='heartburn' value='na' checked>
<input type="radio" name='heartburn' value='pos'>
<input type="radio" name='heartburn' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Heartburn</span><br>

<!-- Abdominal Pain info -->
<input type="radio" name='abdominal_pain' value='na' checked>
<input type="radio" name='abdominal_pain' value='pos'>
<input type="radio" name='abdominal_pain' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Abd.Pain</span><br>

<!-- Melena info -->
<input type="radio" name='melena' value='na' checked>
<input type="radio" name='melena' value='pos'>
<input type="radio" name='melena' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Melena</span><br>

<!-- Hematochezia info -->
<input type="radio" name='hemato_chezia' value='na' checked>
<input type="radio" name='hemato_chezia' value='pos'>
<input type="radio" name='hemato_chezia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hematochezia</span><br>

<br><span class=bold>GYN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Change in Menses -->
<input type="radio" name='change_in_menses' value='na' checked>
<input type="radio" name='change_in_menses' value='pos'>
<input type="radio" name='change_in_menses' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Menses</span><br>

<!-- D/C info -->
<input type="radio" name='discharge_from_urethra' value='na' checked>
<input type="radio" name='discharge_from_urethra' value='pos'>
<input type="radio" name='discharge_from_urethra' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>D/C</span><br>

<!-- Don't need 
<input type="radio" name='nausea' value='pos'>
<input type="radio" name='nausea' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Nausea</span><br>
<input type="radio" name='vomiting' value='pos'>
<input type="radio" name='vomiting' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Vomiting</span><br>
<input type="radio" name='diarrhea' value='pos'>
<input type="radio" name='diarrhea' value='neg' checked>&nbsp;&nbsp;&nbsp;<span class=text>Diarrhea</span><br>
<input type="radio" name='constipation' value='pos'>
<input type="radio" name='constipation' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Constipation</span><br>
-->

</td><td valign=top>
<span class=bold>GU:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Dysuria info -->
<input type="radio" name='burning_with_urination' value='na' checked>
<input type="radio" name='burning_with_urination' value='pos'>
<input type="radio" name='burning_with_urination' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dysuria</span><br>

<!-- Incontinence info -->
<input type="radio" name='incontinence' value='na' checked>
<input type="radio" name='incontinence' value='pos'>
<input type="radio" name='incontinence' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Incontinence</span><br>

<!-- Hematuria info -->
<input type="radio" name='hematuria' value='na' checked>
<input type="radio" name='hematuria' value='pos'>
<input type="radio" name='hematuria' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hematuria</span><br>

<!-- Frequency info -->
<input type="radio" name='urinary_frequency' value='na' checked>
<input type="radio" name='urinary_frequency' value='pos'>
<input type="radio" name='urinary_frequency' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Frequency</span><br>

<!-- Nocturia info -->
<input type="radio" name='nocturia' value='na' checked>
<input type="radio" name='nocturia' value='pos'>
<input type="radio" name='nocturia' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Nocturia</span><br>

<!-- Hesitancy info -->
<input type="radio" name='urinary_hesitency' value='na' checked>
<input type="radio" name='urinary_hesitency' value='pos'>
<input type="radio" name='urinary_hesitency' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Hesitancy</span><br>

<!-- Don't need

<input type="radio" name='enuresis' value='pos'>
<input type="radio" name='enuresis' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Enuresis</span><br>
-->


</td><td valign=top>

<span class=bold>MSK:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Myalgias info -->
<input type="radio" name='myalgias' value='na' checked >
<input type="radio" name='myalgias' value='pos'>
<input type="radio" name='myalgias' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Myalgias</span><br>

<!-- Arthralgias info -->
<input type="radio" name='arthralgias' value='na' checked >
<input type="radio" name='arthralgias' value='pos'>
<input type="radio" name='arthralgias' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Arthralgias</span><br>

<!-- Redness info -->
<input type="radio" name='redness' value='na' checked >
<input type="radio" name='redness' value='pos'>
<input type="radio" name='redness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Redness</span><br>

<!-- Swelling info -->
<input type="radio" name='swollen_joints' value='na' checked >
<input type="radio" name='swollen_joints' value='pos'>
<input type="radio" name='swollen_joints' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Swelling</span><br>

<!-- Stiffness info -->
<input type="radio" name='stiff_joints' value='na' checked>
<input type="radio" name='stiff_joints' value='pos'>
<input type="radio" name='stiff_joints' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Stiffness</span><br>


<!-- Don't need

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

-->

</td><td valign=top>

<span class=bold>SKIN:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Rash info -->
<input type="radio" name='rashes' value='na' checked>
<input type="radio" name='rashes' value='pos'>
<input type="radio" name='rashes' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Rash</span><br>

<!-- New Lesions info -->
<input type="radio" name='new_lesions' value='na' checked>
<input type="radio" name='new_lesions' value='pos'>
<input type="radio" name='new_lesions' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>New Lesions</span><br>

<!-- Change in Moles info -->
<input type="radio" name='change_in_moles' value='na' checked>
<input type="radio" name='change_in_moles' value='pos'>
<input type="radio" name='change_in_moles' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Mole(s)</span><br>

<!-- Change in Nails info -->
<input type="radio" name='change_in_nails' value='na' checked>
<input type="radio" name='change_in_nails' value='pos'>
<input type="radio" name='change_in_nails' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Ch. in Nails</span><br>


<!-- Don't need
<input type="radio" name='infections' value='pos'>
<input type="radio" name='infections' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Infections</span><br>
<input type="radio" name='ulcerations' value='pos'>
<input type="radio" name='ulcerations' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Ulcerations</span><br>
-->


</td><td valign=top>
<span class=bold>NEURO:</span><br>
<span class=bold>N/A &nbsp; + &nbsp;&nbsp; -</span><br>

<!-- Headache info -->
<input type="radio" name='ha' value='na' checked>
<input type="radio" name='ha' value='pos'>
<input type="radio" name='ha' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Headache</span><br>

<!-- Vision Change info -->
<input type="radio" name='vision_change' value='na' checked>
<input type="radio" name='vision_change' value='pos'>
<input type="radio" name='vision_change' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Vision Ch.</span><br>

<!-- Numbness info -->
<input type="radio" name='numbness' value='na' checked>
<input type="radio" name='numbness' value='pos'>
<input type="radio" name='numbness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Numbness</span><br>

<!-- Dizziness info -->
<input type="radio" name='dizziness' value='na' checked>
<input type="radio" name='dizziness' value='pos'>
<input type="radio" name='dizziness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Dizziness</span><br>

<!-- Weakness info -->
<input type="radio" name='weakness' value='na' checked>
<input type="radio" name='weakness' value='pos'>
<input type="radio" name='weakness' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Weakness</span><br>

<!-- Imbalance info -->
<input type="radio" name='imbalance' value='na' checked>
<input type="radio" name='imbalance' value='pos'>
<input type="radio" name='imbalance' value='neg'>&nbsp;&nbsp;&nbsp;<span class=text>Imbalance</span><br>

<!-- Don't need
<input type="radio" name='change_in_gait' value='pos'>
<input type="radio" name='change_in_gait' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Change in Gait</span><br>
<input type="radio" name='memory_difficulties' value='pos'>
<input type="radio" name='memory_difficulties' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Memory Difficulties</span><br>
<input type="radio" name='spasticity' value='pos'>
<input type="radio" name='spasticity' value='neg' checked >&nbsp;&nbsp;&nbsp;<span class=text>Spasticity</span><br>
-->


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
