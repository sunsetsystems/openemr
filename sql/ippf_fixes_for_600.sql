UPDATE version SET v_acl = 3;

CREATE TABLE `modules` (
  `mod_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mod_name` VARCHAR(64) NOT NULL DEFAULT '0',
  `mod_directory` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_parent` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_type` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_active` INT(1) UNSIGNED NOT NULL DEFAULT '0',
  `mod_ui_name` VARCHAR(20) NOT NULL DEFAULT '''',
  `mod_relative_link` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_ui_order` TINYINT(3) NOT NULL DEFAULT '0',
  `mod_ui_active` INT(1) UNSIGNED NOT NULL DEFAULT '0',
  `mod_description` VARCHAR(255) NOT NULL DEFAULT '',
  `mod_nick_name` VARCHAR(25) NOT NULL DEFAULT '',
  `mod_enc_menu` VARCHAR(10) NOT NULL DEFAULT 'no',
  `permissions_item_table` CHAR(100) DEFAULT NULL,
  `directory` VARCHAR(255) NOT NULL,
  `date` DATETIME NOT NULL,
  `sql_run` TINYINT(4) DEFAULT '0',
  `type` TINYINT(4) DEFAULT '0',
  PRIMARY KEY (`mod_id`,`mod_directory`)
) ENGINE=InnoDB;

CREATE TABLE `module_acl_group_settings` (
  `module_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`group_id`,`section_id`)
) ENGINE=InnoDB;

CREATE TABLE `module_acl_sections` (
  `section_id` int(11) DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `parent_section` int(11) DEFAULT NULL,
  `section_identifier` varchar(50) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE `module_acl_user_settings` (
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` int(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`user_id`,`section_id`)
) ENGINE=InnoDB;

CREATE TABLE `module_configuration` (
  `module_config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `field_name` varchar(45) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`module_config_id`)
) ENGINE=InnoDB;

CREATE TABLE `modules_hooks_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_id` int(11) DEFAULT NULL,
  `enabled_hooks` varchar(255) DEFAULT NULL,
  `attached_to` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `modules_settings` (
  `mod_id` INT(11) DEFAULT NULL,
  `fld_type` SMALLINT(6) DEFAULT NULL COMMENT '1=>ACL,2=>preferences,3=>hooks',
  `obj_name` VARCHAR(255) DEFAULT NULL,
  `menu_name` VARCHAR(255) DEFAULT NULL,
  `path` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE `keys` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL DEFAULT '',
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=InnoDB;

ALTER TABLE `patient_data` ADD COLUMN `cmsportal_login` varchar(60) NOT NULL default '';
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'cmsportal_login', '3', 'CMS Portal Login', 14, 2, 1, 30, 60, '', 1, 1, '', '', 'CMS Portal Login ID', 0, '');

INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('HIS','dc_father'        ,'2','Diagnosis Code'         , 2,15,1, 0,255,'',1,1,'','', '', 0,'');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('HIS','dc_mother'        ,'2','Diagnosis Code'         , 4,15,1, 0,255,'',1,1,'','', '', 0,'');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('HIS','dc_siblings'      ,'2','Diagnosis Code'         , 6,15,1, 0,255,'',1,1,'','', '', 0,'');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('HIS','dc_spouse'        ,'2','Diagnosis Code'         , 8,15,1, 0,255,'',1,1,'','', '', 0,'');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('HIS','dc_offspring'     ,'2','Diagnosis Code'         ,10,15,1, 0,255,'',1,1,'','', '', 0,'');

# INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'religion', '5', 'Religion', 13, 1, 1, 0, 0, 'religious_affiliation', 1, 3, '', '', 'Patient Religion', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'industry', '4', 'Industry', 1, 26, 1, 0, 0, 'Industry', 1, 1, '', '', 'Industry', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'county', '2', 'County', 5, 26, 1, 0, 0, 'county', 1, 1, '', '', 'County', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'care_team', '3', 'Care Team (Provider)', 21, 45, 1, 0, 0, '', 1, 1, '', '', '', 0, '');
# ALTER TABLE patient_data ADD COLUMN religion varchar(40) NOT NULL default '';
ALTER TABLE patient_data ADD COLUMN industry TEXT NOT NULL;
ALTER TABLE `patient_data` ADD COLUMN `county` varchar(40) NOT NULL default '';
alter table patient_data add column care_team int(11) DEFAULT NULL;

INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'billing_note', '1', 'Billing Note', 17, 2, 1, 60, 0, '', 1, 3, '', '', 'Patient Level Billing Note (Collections)', 0, '');
ALTER TABLE patient_data ADD COLUMN billing_note text NOT NULL;
UPDATE `patient_data` SET `billing_note` = `genericval2` WHERE `genericname2` = 'Billing';
UPDATE `patient_data` SET `genericval2` = '', `genericname2` = '' WHERE `genericname2` = 'Billing';

ALTER TABLE `patient_data` ADD COLUMN `imm_reg_status` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `imm_reg_stat_effdate` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `publicity_code` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `publ_code_eff_date` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `protect_indicator` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `prot_indi_effdate` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianrelationship` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardiansex` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianaddress` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardiancity` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianstate` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianpostalcode` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardiancountry` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianphone` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianworkphone` TEXT;
ALTER TABLE `patient_data` ADD COLUMN `guardianemail` TEXT;
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'imm_reg_status'  , '3', 'Immunization Registry Status'  ,15, 1, 1,1,0, 'immunization_registry_status', 1, 1, '', '', 'Immunization Registry Status', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'imm_reg_stat_effdate'  , '3', 'Immunization Registry Status Effective Date'  ,16, 4, 1,10,10, '', 1, 1, '', '', 'Immunization Registry Status Effective Date', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'publicity_code'  , '3', 'Publicity Code'  ,17, 1, 1,1,0, 'publicity_code', 1, 1, '', '', 'Publicity Code', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'publ_code_eff_date'  , '3', 'Publicity Code Effective Date'  ,18, 4, 1,10,10, '', 1, 1, '', '', 'Publicity Code Effective Date', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'protect_indicator'  , '3', 'Protection Indicator'  ,19, 1, 1,1,0, 'yesno', 1, 1, '', '', 'Protection Indicator', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'prot_indi_effdate'  , '3', 'Protection Indicator Effective Date'  ,20, 4, 1,10,10, '', 1, 1, '', '', 'Protection Indicator Effective Date', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianrelationship'  , '8', 'Relationship'  ,20, 1, 1,0,0, 'next_of_kin_relationship', 1, 1, '', '', 'Relationship', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardiansex'  , '8', 'Sex'  ,30, 1, 1,0,0, 'sex', 1, 1, '', '', 'Sex', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianaddress'  , '8', 'Address'  ,40, 2, 1,25,63, '', 1, 1, '', '', 'Address', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardiancity'  , '8', 'City'  ,50, 2, 1,15,63, '', 1, 1, '', '', 'City', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianstate'  , '8', 'State'  ,60, 26, 1,0,0, 'state', 1, 1, '', '', 'State', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianpostalcode'  , '8', 'Postal Code'  ,70, 2, 1,6,63, '', 1, 1, '', '', 'Postal Code', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardiancountry'  , '8', 'Country'  ,80, 26, 1,0,0, 'country', 1, 1, '', '', 'Country', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianphone'  , '8', 'Phone'  ,90, 2, 1,20,63, '', 1, 1, '', '', 'Phone', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianworkphone'  , '8', 'Work Phone'  ,100, 2, 1,20,63, '', 1, 1, '', '', 'Work Phone', 0, '');
INSERT INTO `layout_options` (`form_id`,`field_id`,`group_id`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`,`conditions`) VALUES ('DEM', 'guardianemail'  , '8', 'Email'  ,110, 2, 1,20,63, '', 1, 1, '', '', 'Guardian Email Address', 0, '');

