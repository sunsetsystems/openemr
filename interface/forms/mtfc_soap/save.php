<?php
//------------Forms generated from formsWiz
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
foreach ($_POST as $k => $var) {
$_POST[$k] = mysql_escape_string($var);
echo "$var\n";
}
if ($encounter == "")
$encounter = date("Ymd");
if ($_GET["mode"] == "new"){
$newid = formSubmit("form_mtfc_soap", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Physical Exam", $newid, "mtfc_soap", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
	
	// ---- Clearing comment fields if conditions are normal before
	// ---- we update the data
	if (($_POST["well_develop"] == "nrml") or ($_POST["well_develop"] == "not_ex"))
	{
		$_POST["well_develop_comment"] = "";
	}
	if (($_POST["dress_appropriate"] == "nrml") or ($_POST["dress_appropriate"] == "not_ex"))
	{
		$_POST["dress_appropriate_comment"] = "";
	}
	if (($_POST["conj_lids"] == "nrml") or ($_POST["conj_lids"] == "not_ex"))
	{
		$_POST["conj_lids_comment"] = "";
	}
	if (($_POST["peerla"] == "nrml") or ($_POST["peerla"] == "not_ex"))
	{
		$_POST["peerla_comment"] = "";
	}
	if (($_POST["opthalm_exam"] == "nrml") or ($_POST["opthalm_exam"] == "not_ex"))
	{
		$_POST["opthalm_exam_comment"] = "";
	}
	if (($_POST["inspect_ears"] == "nrml") or ($_POST["inspect_ears"] == "not_ex"))
	{
		$_POST["inspect_ears_comment"] = "";
	}
	if (($_POST["otoscopic_exam"] == "nrml") or ($_POST["otoscopic_exam"] == "not_ex"))
	{
		$_POST["otoscopic_exam_comment"] = "";
	}
	if (($_POST["assess_hearing"] == "nrml") or ($_POST["assess_hearing"] == "not_ex"))
	{
		$_POST["assess_hearing_comment"] = "";
	}
	if (($_POST["inspect_nasal"] == "nrml") or ($_POST["inspect_nasal"] == "not_ex"))
	{
		$_POST["inspect_nasal_comment"] = "";
	}
	if (($_POST["inspect_lips"] == "nrml") or ($_POST["inspect_lips"] == "not_ex"))
	{
		$_POST["inspect_lips_comment"] = "";
	}
	if (($_POST["exam_oropharynx"] == "nrml") or ($_POST["exam_oropharynx"] == "not_ex"))
	{
		$_POST["exam_oropharynx_comment"] = "";
	}
	if (($_POST["sinus_wnl"] == "nrml") or ($_POST["sinus_wnl"] == "not_ex"))
	{
		$_POST["sinus_wnl_comment"] = "";
	}
	if (($_POST["full_rom_midline_trachea"] == "nrml") or ($_POST["full_rom_midline_trachea"] == "not_ex"))
	{
		$_POST["fullrom_mid_trachea_comment"] = "";
	}
	if (($_POST["exam_thyroid"] == "nrml") or ($_POST["exam_thyroid"] == "not_ex"))
	{
		$_POST["exam_thyroid_comment"] = "";
	}
	if (($_POST["assess_resp"] == "nrml") or ($_POST["assess_resp"] == "not_ex"))
	{
		$_POST["assess_resp_comment"] = "";
	}
	if (($_POST["percussion"] == "nrml") or ($_POST["percussion"] == "not_ex"))
	{
		$_POST["percussion_comment"] = "";
	}
	if (($_POST["palpation"] == "nrml") or ($_POST["palpation"] = "not_ex"))
	{
		$_POST["palpation_comment"] = "";
	}
	if (($_POST["auscultation"] == "nrml") or ($_POST["auscultation"] == "not_ex"))
	{
		$_POST["auscultation_comment"] = "";
	}
	if (($_POST["palp_heart"] == "nrml") or ($_POST["palp_heart"] == "not_ex"))
	{
		$_POST["palp_heart_comment"] = "";
	}
	if (($_POST["auscu_heart"] == "nrml") or ($_POST["auscu_heart"] == "not_ex"))
	{
		$_POST["auscu_heart_comment"] = "";
	}
	if (($_POST["carotid"] == "nrml") or ($_POST["carotid"] == "not_ex"))
	{
		$_POST["carotid_comment"] = "";
	}
	if (($_POST["abdominal_aorta"] == "nrml") or ($_POST["abdominal_aorta"] == "not_ex"))
	{
		$_POST["abdominal_aorta_comment"] = "";
	}
	if (($_POST["femoral_arteries"] == "nrml") or ($_POST["femoral_arteries"] == "not_ex"))
	{
		$_POST["femoral_arteries_comment"] = "";
	}
	if (($_POST["pedal_pulses"] == "nrml") or ($_POST["pedal_pulses"] == "not_ex"))
	{
		$_POST["pedal_pulses_comment"] = "";
	}
	if (($_POST["no_edema"] == "nrml") or ($_POST["no_edema"] == "not_ex"))
	{
		$_POST["no_edema_comment"] = "";
	}
	if (($_POST["assess_gait"] == "nrml") or ($_POST["assess_gait"] == "not_ex"))
	{
		$_POST["assess_gait_comment"] = "";
	}
	if (($_POST["inspect_digits"] == "nrml") or ($_POST["inspect_digits"] == "not_ex"))
	{
		$_POST["inspect_digits_comment"] = "";
	}
	if (($_POST["inspect_deform"] == "nrml") or ($_POST["inspect_deform"] == "not_ex"))
	{
		$_POST["inspect_deform_comment"] = "";
	}
	if (($_POST["fullrom_limited"] == "nrml") or ($_POST["fullrom_limited"] == "not_ex"))
	{
		$_POST["fullrom_limited_comment"] = "";
	}
	if (($_POST["joint_intact"] == "nrml") or ($_POST["joint_intact"] == "not_ex"))
	{
		$_POST["joint_intact_comment"] = "";
	}
	if (($_POST["muscle_strength"] == "nrml") or ($_POST["muscle_strength"] == "not_ex"))
	{
		$_POST["muscle_strength_comment"] = "";
	}
	if (($_POST["cn11"] == "nrml") or ($_POST["cn11"] == "not_ex"))
	{
		$_POST["cn11_comment"] = "";
	}
	if (($_POST["c2"] == "nrml") or ($_POST["c2"] == "not_ex"))
	{
		$_POST["c2_comment"] = "";
	}
	if (($_POST["c3"] == "nrml") or ($_POST["c3"] == "not_ex"))
	{
		$_POST["c3_comment"] = "";
	}
	if (($_POST["c5"] == "nrml") or ($_POST["c5"] == "not_ex"))
	{
		$_POST["c5_comment"] = "";
	}
	if (($_POST["c7"] == "nrml") or ($_POST["c7"] == "not_ex"))
	{
		$_POST["c7_comment"] = "";
	}
	if (($_POST["c8"] == "nrml") or ($_POST["c8"] == "not_ex"))
	{
		$_POST["c8_comment"] = "";
	}
	if (($_POST["c9"] == "nrml") or ($_POST["c9"] == "not_ex"))
	{
		$_POST["c9_comment"] = "";
	}
	if (($_POST["c11"] == "nrml") or ($_POST["c11"] == "not_ex"))
	{
		$_POST["c11_comment"] = "";
	}
	if (($_POST["c12"] == "nrml") or ($_POST["c12"] == "not_ex"))
	{
		$_POST["c12_comment"] = "";
	}
	if (($_POST["touch_pain"] == "nrml") or ($_POST["touch_pain"] == "not_ex"))
	{
		$_POST["touch_pain_comment"] = "";
	}
	if (($_POST["dtr_equal"] == "nrml") or ($_POST["dtr_equal"] == "not_ex"))
	{
		$_POST["dtr_equal_comment"] = "";
	}
	if (($_POST["judge_n_insight"] == "nrml") or ($_POST["judge_n_insight"] == "not_ex"))
	{
		$_POST["judgensight_comment"] = "";
	}
	if (($_POST["alert_oriented"] == "nrml") or ($_POST["alert_oriented"] == "not_ex"))
	{
		$_POST["alert_oriented_comment"] = "";
	}
	if (($_POST["recent_remote_memory"] == "nrml") or ($_POST["recent_remote_memory"] == "not_ex"))
	{
		$_POST["recent_memory_comment"] = "";
	}
	if (($_POST["no_mood_disorders"] == "nrml") or ($_POST["no_mood_disorders"] == "not_ex"))
	{
		$_POST["nomood_disorders_comment"] = "";
	}
	if (($_POST["suicidal_homicidal"] == "nrml") or ($_POST["suicidal_homicidal"] == "not_ex"))
	{
		$_POST["suicidal_homicidal_comment"] = "";
	}
	if (($_POST["abdomen_soft"] == "nrml") or ($_POST["abdomen_soft"] == "not_ex"))
	{
		$_POST["abdomen_soft_comment"] = "";
	}
	if (($_POST["liver_spleen"] == "nrml") or ($_POST["liver_spleen"] == "not_ex"))
	{
		$_POST["liver_spleen_comment"] = "";
	}
	if (($_POST["hernia"] == "nrml") or ($_POST["hernia"] == "not_ex"))
	{
		$_POST["hernia_comment"] = "";
	}
	if (($_POST["rectal"] == "nrml") or ($_POST["rectal"] == "not_ex"))
	{
		$_POST["rectal_comment"] = "";
	}
	if (($_POST["occult_blood_test"] == "nrml") or ($_POST["occult_blood_test"] == "not_ex"))
	{
		$_POST["occult_bloodtest_comment"] = "";
	}
	if (($_POST["neg_cva"] == "nrml") or ($_POST["neg_cva"] == "not_ex"))
	{
		$_POST["neg_cva_comment"] = "";
	}
	if (($_POST["area_palpated"] == "nrml") or ($_POST["area_palpated"] == "not_ex"))
	{
		$_POST["area_palpated_comment"] = "";
	}
	if (($_POST["pink_no_rashes"] == "nrml") or ($_POST["pink_no_rashes"] == "not_ex"))
	{
		$_POST["pink_norashes_comment"] = "";
	}
	if (($_POST["moist_warm_dry"] == "nrml") or ($_POST["moist_warm_dry"] == "not_ex"))
	{
		$_POST["moist_warm_dry_comment"] = "";
	}
	if (($_POST["scrotum_epididymis"] == "nrml") or ($_POST["scrotum_epididymis"] == "not_ex"))
	{
		$_POST["scrotum_epididymis_comment"] = "";
	}
	if (($_POST["penis_without_deformity"] == "nrml") or ($_POST["penis_without_deformity"] == "not_ex"))
	{
		$_POST["penis_wo_deformity_comment"] = "";
	}
	if (($_POST["prostate_lat_lobes"] == "nrml") or ($_POST["prostate_lat_lobes"] == "not_ex"))
	{
		$_POST["prostate_lat_lobes_comment"] = "";
	}
	if (($_POST["no_external_lesions"] == "nrml") or ($_POST["no_external_lesions"] == "not_ex"))
	{
		$_POST["noexternal_lesions_comment"] = "";
	}
	if (($_POST["urethra_intact"] == "nrml") or ($_POST["urethra_intact"] == "not_ex"))
	{
		$_POST["urethra_intact_comment"] = "";
	}
	if (($_POST["bladder_wo_tenderness"] == "nrml") or ($_POST["bladder_wo_tenderness"] == "not_ex"))
	{
		$_POST["bladder_wo_tenderness_comment"] = "";
	}
	if (($_POST["cervix_pink"] == "nrml") or ($_POST["cervix_pink"] == "not_ex"))
	{
		$_POST["cervix_pink_comment"] = "";
	}
	if (($_POST["uterus_midline"] == "nrml") or ($_POST["uterus_midline"] == "not_ex"))
	{
		$_POST["uterus_midline_comment"] = "";
	}
	if (($_POST["adnexal_masses"] == "nrml") or ($_POST["adnexal_masses"] == "not_ex"))
	{
		$_POST["adnexal_masses_comment"] = "";
	}
	if (($_POST["inspect_breast"] == "nrml") or ($_POST["inspect_breast"] == "not_ex"))
	{
		$_POST["inspect_breast_comment"] = "";
	}
	if (($_POST["exam_breast"] == "nrml") or ($_POST["exam_breast"] == "not_ex"))
	{
		$_POST["exam_breast_comment"] = "";
	}
	
	
	// ---- sql statement to update information
	sqlInsert("update form_mtfc_soap set pid = {$_SESSION["pid"]}, " .
         "groupname='".$_SESSION["authProvider"]."', " .
         "user='".$_SESSION["authUser"]."', " .
         "authorized=$userauthorized, " .
         "activity=1, " .
         "date = NOW(), " .
         "subjective='".$_POST["subjective"]."', " .
         "objective='".$_POST["objective"]."', " .
         "assessment='".$_POST["assessment"]."', " .
         "plan='".$_POST["plan"]."', " .
         "general='".$_POST["general"]."', " .
         "heent='".$_POST["heent"]."', " .
         "neck='".$_POST["neck"]."', " .
         "cv='".$_POST["cv"]."', " .
         "lungs='".$_POST["lungs"]."', " .
         "breasts='".$_POST["breasts"]."', " .
         "abdomen='".$_POST["abdomen"]."', " .
         "gu='".$_POST["gu"]."', " .
         "bones_joints_extrem='".$_POST["bones_joints_extrem"]."', " .
         "skin='".$_POST["skin"]."', " .
         "neuro_psych='".$_POST["neuro_psych"]."', " .
         "well_develop='".$_POST["well_develop"]."', " .
         "well_develop_comment='".$_POST["well_develop_comment"]."', " .
         "dress_appropriate='".$_POST["dress_appropriate"]."', " .
         "dress_appropriate_comment='".$_POST["dress_appropriate_comment"]."', " .
         "conj_lids='".$_POST["conj_lids"]."', " .
         "conj_lids_comment='".$_POST["conj_lids_comment"]."', " .
         "peerla='".$_POST["peerla"]."', " .
         "peerla_comment='".$_POST["peerla_comment"]."', " .
         "opthalm_exam='".$_POST["opthalm_exam"]."', " .
         "opthalm_exam_comment='".$_POST["opthalm_exam_comment"]."', " .
         "inspect_ears='".$_POST["inspect_ears"]."', " .
         "inspect_ears_comment='".$_POST["inspect_ears_comment"]."', " .
         "otoscopic_exam='".$_POST["otoscopic_exam"]."', " .
         "otoscopic_exam_comment='".$_POST["otoscopic_exam_comment"]."', " .
         "assess_hearing='".$_POST["assess_hearing"]."', " .
         "assess_hearing_comment='".$_POST["assess_hearing_comment"]."', " .
         "inspect_nasal='".$_POST["inspect_nasal"]."', " .
         "inspect_nasal_comment='".$_POST["inspect_nasal_comment"]."', " .
         "inspect_lips='".$_POST["inspect_lips"]."', " .
         "inspect_lips_comment='".$_POST["inspect_lips_comment"]."', " .
         "exam_oropharynx='".$_POST["exam_oropharynx"]."', " .
         "exam_oropharynx_comment='".$_POST["exam_oropharynx_comment"]."', " .
         "sinus_wnl='".$_POST["sinus_wnl"]."', " .
         "sinus_wnl_comment='".$_POST["sinus_wnl_comment"]."', " .
         "full_rom_midline_trachea='".$_POST["full_rom_midline_trachea"]."', " .
         "fullrom_mid_trachea_comment='".$_POST["fullrom_mid_trachea_comment"]."', " .
         "exam_thyroid='".$_POST["exam_thyroid"]."', " .
         "exam_thyroid_comment='".$_POST["exam_thyroid_comment"]."', " .
         "assess_resp='".$_POST["assess_resp"]."', " .
         "assess_resp_comment='".$_POST["assess_resp_comment"]."', " .
         "percussion='".$_POST["percussion"]."', " .
         "percussion_comment='".$_POST["percussion_comment"]."', " .
         "palpation='".$_POST["palpation"]."', " .
         "palpation_comment='".$_POST["palpation_comment"]."', " .
         "auscultation='".$_POST["auscultation"]."', " .
         "auscultation_comment='".$_POST["auscultation_comment"]."', " .
         "palp_heart='".$_POST["palp_heart"]."', " .
         "palp_heart_comment='".$_POST["palp_heart_comment"]."', " .
         "auscu_heart='".$_POST["auscu_heart"]."', " .
         "auscu_heart_comment='".$_POST["auscu_heart_comment"]."', " .
         "carotid='".$_POST["carotid"]."', " .
         "carotid_comment='".$_POST["carotid_comment"]."', " .
         "abdominal_aorta='".$_POST["abdominal_aorta"]."', " .
         "abdominal_aorta_comment='".$_POST["abdominal_aorta_comment"]."', " .
         "femoral_arteries='".$_POST["femoral_arteries"]."', " .
         "femoral_arteries_comment='".$_POST["femoral_arteries_comment"]."', " .
         "pedal_pulses='".$_POST["pedal_pulses"]."', " .
         "pedal_pulses_comment='".$_POST["pedal_pulses_comment"]."', " .
         "no_edema='".$_POST["no_edema"]."', " .
         "no_edema_comment='".$_POST["no_edema_comment"]."', " .
         "assess_gait='".$_POST["assess_gait"]."', " .
         "assess_gait_comment='".$_POST["assess_gait_comment"]."', " .
         "inspect_digits='".$_POST["inspect_digits"]."', " .
         "inspect_digits_comment='".$_POST["inspect_digits_comment"]."', " .
         "head_neck='".$_POST["head_neck"]."', " .
         "spine_ribs='".$_POST["spine_ribs"]."', " .
         "rue='".$_POST["rue"]."', " .
         "lue='".$_POST["lue"]."', " .
         "rle='".$_POST["rle"]."', " .
         "lle='".$_POST["lle"]."', " .
         "inspect_deform='".$_POST["inspect_deform"]."', " .
         "inspect_deform_comment='".$_POST["inspect_deform_comment"]."', " .
         "fullrom_limited='".$_POST["fullrom_limited"]."', " .
         "fullrom_limited_comment='".$_POST["fullrom_limited_comment"]."', " .
         "joint_intact='".$_POST["joint_intact"]."', " .
         "joint_intact_comment='".$_POST["joint_intact_comment"]."', " .
         "muscle_strength='".$_POST["muscle_strength"]."', " .
         "muscle_strength_comment='".$_POST["muscle_strength_comment"]."', " .
         "cn11='".$_POST["cn11"]."', " .
         "cn11_comment='".$_POST["cn11_comment"]."', " .
         "c2='".$_POST["c2"]."', " .
         "c2_comment='".$_POST["c2_comment"]."', " .
         "c3='".$_POST["c3"]."', " .
         "c3_comment='".$_POST["c3_comment"]."', " .
         "c5='".$_POST["c5"]."', " .
         "c5_comment='".$_POST["c5_comment"]."', " .
         "c7='".$_POST["c7"]."', " .
         "c7_comment='".$_POST["c7_comment"]."', " .
         "c8='".$_POST["c8"]."', " .
         "c8_comment='".$_POST["c8_comment"]."', " .
         "c9='".$_POST["c9"]."', " .
         "c9_comment='".$_POST["c9_comment"]."', " .
         "c11='".$_POST["c11"]."', " .
         "c11_comment='".$_POST["c11_comment"]."', " .
         "c12='".$_POST["c12"]."', " .
         "c12_comment='".$_POST["c12_comment"]."', " .
         "touch_pain='".$_POST["touch_pain"]."', " .
         "touch_pain_comment='".$_POST["touch_pain_comment"]."', " .
         "dtr_equal='".$_POST["dtr_equal"]."', " .
         "dtr_equal_comment='".$_POST["dtr_equal_comment"]."', " .
         "judge_n_insight='".$_POST["judge_n_insight"]."', " .
         "judgensight_comment='".$_POST["judgensight_comment"]."', " .
         "alert_oriented='".$_POST["alert_oriented"]."', " .
         "alert_oriented_comment='".$_POST["alert_oriented_comment"]."', " .
         "recent_remote_memory='".$_POST["recent_remote_memory"]."', " .
         "recent_memory_comment='".$_POST["recent_memory_comment"]."', " .
         "no_mood_disorders='".$_POST["no_mood_disorders"]."', " .
         "nomood_disorders_comment='".$_POST["nomood_disorders_comment"]."', " .
         "suicidal_homicidal='".$_POST["suicidal_homicidal"]."', " .
         "suicidal_homicidal_comment='".$_POST["suicidal_homicidal_comment"]."', " .
         "abdomen_soft='".$_POST["abdomen_soft"]."', " .
         "abdomen_soft_comment='".$_POST["abdomen_soft_comment"]."', " .
         "liver_spleen='".$_POST["liver_spleen"]."', " .
         "liver_spleen_comment='".$_POST["liver_spleen_comment"]."', " .
         "hernia='".$_POST["hernia"]."', " .
         "hernia_comment='".$_POST["hernia_comment"]."', " .
         "rectal='".$_POST["rectal"]."', " .
         "rectal_comment='".$_POST["rectal_comment"]."', " .
         "occult_blood_test='".$_POST["occult_blood_test"]."', " .
         "occult_bloodtest_comment='".$_POST["occult_bloodtest_comment"]."', " .
         "neg_cva='".$_POST["neg_cva"]."', " .
         "neg_cva_comment='".$_POST["neg_cva_comment"]."', " .
         "area_palpated='".$_POST["area_palpated"]."', " .
         "area_palpated_comment='".$_POST["area_palpated_comment"]."', " .
         "areapalpated_neck='".$_POST["areapalpated_neck"]."', " .
         "axillary='".$_POST["axillary"]."', " .
         "groin='".$_POST["groin"]."', " .
         "other='".$_POST["other"]."', " .
         "pink_no_rashes='".$_POST["pink_no_rashes"]."', " .
         "pink_norashes_comment='".$_POST["pink_norashes_comment"]."', " .
         "moist_warm_dry='".$_POST["moist_warm_dry"]."', " .
         "moist_warm_dry_comment='".$_POST["moist_warm_dry_comment"]."', " .
         "scrotum_epididymis='".$_POST["scrotum_epididymis"]."', " .
         "scrotum_epididymis_comment='".$_POST["scrotum_epididymis_comment"]."', " .
         "penis_without_deformity='".$_POST["penis_without_deformity"]."', " .
         "penis_wo_deformity_comment='".$_POST["penis_wo_deformity_comment"]."', " .
         "prostate_lat_lobes='".$_POST["prostate_lat_lobes"]."', " .
         "prostate_lat_lobes_comment='".$_POST["prostate_lat_lobes_comment"]."', " .
         "no_external_lesions='".$_POST["no_external_lesions"]."', " .
         "noexternal_lesions_comment='".$_POST["noexternal_lesions_comment"]."', " .
         "urethra_intact='".$_POST["urethra_intact"]."', " .
         "urethra_intact_comment='".$_POST["urethra_intact_comment"]."', " .
         "bladder_wo_tenderness='".$_POST["bladder_wo_tenderness"]."', " .
         "bladder_wo_tenderness_comment='".$_POST["bladder_wo_tenderness_comment"]."', " .
         "cervix_pink='".$_POST["cervix_pink"]."', " .
         "cervix_pink_comment='".$_POST["cervix_pink_comment"]."', " .
         "uterus_midline='".$_POST["uterus_midline"]."', " .
         "uterus_midline_comment='".$_POST["uterus_midline_comment"]."', " .
         "adnexal_masses='".$_POST["adnexal_masses"]."', " .
         "adnexal_masses_comment='".$_POST["adnexal_masses_comment"]."', " .
         "inspect_breast='".$_POST["inspect_breast"]."', " .
         "inspect_breast_comment='".$_POST["inspect_breast_comment"]."', " .
         "exam_breast='".$_POST["exam_breast"]."', " .
         "exam_breast_comment='".$_POST["exam_breast_comment"]."' " .
         "where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
