CREATE TABLE IF NOT EXISTS `form_mtfc_soap` (
`id` bigint(20) NOT NULL auto_increment,
`date` datetime default NULL,
`pid` bigint(20) default 0,
`user` varchar(255) default NULL,
`groupname` varchar(255) default NULL,
`authorized` tinyint(4) default 0,
`activity` tinyint(4) default 0,
`subjective` text default NULL,
`objective` text default NULL,
`assessment` text default NULL,
`plan` text default NULL,
`general` varchar(255) default NULL,
`heent` varchar(255) default NULL,
`neck` varchar(255) default NULL,
`cv` varchar(255) default NULL,
`lungs` varchar(255) default NULL,
`breasts` varchar(255) default NULL,
`abdomen` varchar(255) default NULL,
`gu` varchar(255) default NULL,
`bones_joints_extrem` varchar(255) default NULL,
`skin` varchar(255) default NULL,
`neuro_psych` varchar(255) default NULL,
`well_develop` varchar(255) default NULL,
`well_develop_comment` varchar(255) default NULL,
`dress_appropriate` varchar(255) default NULL,
`dress_appropriate_comment` varchar(255) default NULL,
`conj_lids` varchar(255) default NULL,
`conj_lids_comment` varchar(255) default NULL,
`peerla` varchar(255) default NULL,
`peerla_comment` varchar(255) default NULL,
`opthalm_exam` varchar(255) default NULL,
`opthalm_exam_comment` varchar(255) default NULL,
`inspect_ears` varchar(255) default NULL,
`inspect_ears_comment` varchar(255) default NULL,
`otoscopic_exam` varchar(255) default NULL,
`otoscopic_exam_comment` varchar(255) default NULL,
`assess_hearing` varchar(255) default NULL,
`assess_hearing_comment` varchar(255) default NULL,
`inspect_nasal` varchar(255) default NULL,
`inspect_nasal_comment` varchar(255) default NULL,
`inspect_lips` varchar(255) default NULL,
`inspect_lips_comment` varchar(255) default NULL,
`exam_oropharynx` varchar(255) default NULL,
`exam_oropharynx_comment` varchar(255) default NULL,
`sinus_wnl` varchar(255) default NULL,
`sinus_wnl_comment` varchar(255) default NULL,
`full_rom_midline_trachea` varchar(255) default NULL,
`fullrom_mid_trachea_comment` varchar(255) default NULL,
`exam_thyroid` varchar(255) default NULL,
`exam_thyroid_comment` varchar(255) default NULL,
`assess_resp` varchar(255) default NULL,
`assess_resp_comment` varchar(255) default NULL,
`percussion` varchar(255) default NULL,
`percussion_comment` varchar(255) default NULL,
`palpation` varchar(255) default NULL,
`palpation_comment` varchar(255) default NULL,
`auscultation` varchar(255) default NULL,
`auscultation_comment` varchar(255) default NULL,
`palp_heart` varchar(255) default NULL,
`palp_heart_comment` varchar(255) default NULL,
`auscu_heart` varchar(255) default NULL,
`auscu_heart_comment` varchar(255) default NULL,
`carotid` varchar(255) default NULL,
`carotid_comment` varchar(255) default NULL,
`abdominal_aorta` varchar(255) default NULL,
`abdominal_aorta_comment` varchar(255) default NULL,
`femoral_arteries` varchar(255) default NULL,
`femoral_arteries_comment` varchar(255) default NULL,
`pedal_pulses` varchar(255) default NULL,
`pedal_pulses_comment` varchar(255) default NULL,
`no_edema` varchar(255) default NULL,
`no_edema_comment` varchar(255) default NULL,
`assess_gait` varchar(255) default NULL,
`assess_gait_comment` varchar(255) default NULL,
`inspect_digits` varchar(255) default NULL,
`inspect_digits_comment` varchar(255) default NULL,
`head_neck` varchar(255) default NULL,
`spine_ribs` varchar(255) default NULL,
`rue` varchar(255) default NULL,
`lue` varchar(255) default NULL,
`rle` varchar(255) default NULL,
`lle` varchar(255) default NULL,
`inspect_deform` varchar(255) default NULL,
`inspect_deform_comment` varchar(255) default NULL,
`fullrom_limited` varchar(255) default NULL,
`fullrom_limited_comment` varchar(255) default NULL,
`joint_intact` varchar(255) default NULL,
`joint_intact_comment` varchar(255) default NULL,
`muscle_strength` varchar(255) default NULL,
`muscle_strength_comment` varchar(255) default NULL,
`cn11` varchar(255) default NULL,
`cn11_comment` varchar(255) default NULL,
`c2` varchar(255) default NULL,
`c2_comment` varchar(255) default NULL,
`c3` varchar(255) default NULL,
`c3_comment` varchar(255) default NULL,
`c5` varchar(255) default NULL,
`c5_comment` varchar(255) default NULL,
`c7` varchar(255) default NULL,
`c7_comment` varchar(255) default NULL,
`c8` varchar(255) default NULL,
`c8_comment` varchar(255) default NULL,
`c9` varchar(255) default NULL,
`c9_comment` varchar(255) default NULL,
`c11` varchar(255) default NULL,
`c11_comment` varchar(255) default NULL,
`c12` varchar(255) default NULL,
`c12_comment` varchar(255) default NULL,
`touch_pain` varchar(255) default NULL,
`touch_pain_comment` varchar(255) default NULL,
`dtr_equal` varchar(255) default NULL,
`dtr_equal_comment` varchar(255) default NULL,
`judge_n_insight` varchar(255) default NULL,
`judgensight_comment` varchar(255) default NULL,
`alert_oriented` varchar(255) default NULL,
`alert_oriented_comment` varchar(255) default NULL,
`recent_remote_memory` varchar(255) default NULL,
`recent_memory_comment` varchar(255) default NULL,
`no_mood_disorders` varchar(255) default NULL,
`nomood_disorders_comment` varchar(255) default NULL,
`suicidal_homicidal` varchar(255) default NULL,
`suicidal_homicidal_comment` varchar(255) default NULL,
`abdomen_soft` varchar(255) default NULL,
`abdomen_soft_comment` varchar(255) default NULL,
`liver_spleen` varchar(255) default NULL,
`liver_spleen_comment` varchar(255) default NULL,
`hernia` varchar(255) default NULL,
`hernia_comment` varchar(255) default NULL,
`rectal` varchar(255) default NULL,
`rectal_comment` varchar(255) default NULL,
`occult_blood_test` varchar(255) default NULL,
`occult_bloodtest_comment` varchar(255) default NULL,
`neg_cva` varchar(255) default NULL,
`neg_cva_comment` varchar(255) default NULL,
`area_palpated` varchar(255) default NULL,
`area_palpated_comment` varchar(255) default NULL,
`areapalpated_neck` varchar(255) default NULL,
`axillary` varchar(255) default NULL,
`groin` varchar(255) default NULL,
`other` varchar(255) default NULL,
`pink_no_rashes` varchar(255) default NULL,
`pink_norashes_comment` varchar(255) default NULL,
`moist_warm_dry` varchar(255) default NULL,
`moist_warm_dry_comment` varchar(255) default NULL,
`scrotum_epididymis` varchar(255) default NULL,
`scrotum_epididymis_comment` varchar(255) default NULL,
`penis_without_deformity` varchar(255) default NULL,
`penis_wo_deformity_comment` varchar(255) default NULL,
`prostate_lat_lobes` varchar(255) default NULL,
`prostate_lat_lobes_comment` varchar(255) default NULL,
`no_external_lesions` varchar(255) default NULL,
`noexternal_lesions_comment` varchar(255) default NULL,
`urethra_intact` varchar(255) default NULL,
`urethra_intact_comment` varchar(255) default NULL,
`bladder_wo_tenderness` varchar(255) default NULL,
`bladder_wo_tenderness_comment` varchar(255) default NULL,
`cervix_pink` varchar(255) default NULL,
`cervix_pink_comment` varchar(255) default NULL,
`uterus_midline` varchar(255) default NULL,
`uterus_midline_comment` varchar(255) default NULL,
`adnexal_masses` varchar(255) default NULL,
`adnexal_masses_comment` varchar(255) default NULL,
`inspect_breast` varchar(255) default NULL,
`inspect_breast_comment` varchar(255) default NULL,
`exam_breast` varchar(255) default NULL,
`exam_breast_comment` varchar(255) default NULL,
PRIMARY KEY (id)
) TYPE=InnoDB;
