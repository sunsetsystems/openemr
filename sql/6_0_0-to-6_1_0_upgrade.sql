--
--  Comment Meta Language Constructs:
--
--  #IfNotTable
--    argument: table_name
--    behavior: if the table_name does not exist,  the block will be executed

--  #IfTable
--    argument: table_name
--    behavior: if the table_name does exist, the block will be executed

--  #IfColumn
--    arguments: table_name colname
--    behavior:  if the table and column exist,  the block will be executed

--  #IfMissingColumn
--    arguments: table_name colname
--    behavior:  if the table exists but the column does not,  the block will be executed

--  #IfNotColumnType
--    arguments: table_name colname value
--    behavior:  If the table table_name does not have a column colname with a data type equal to value, then the block will be executed

--  #IfNotColumnTypeDefault
--    arguments: table_name colname value value2
--    behavior:  If the table table_name does not have a column colname with a data type equal to value and a default equal to value2, then the block will be executed

--  #IfNotRow
--    arguments: table_name colname value
--    behavior:  If the table table_name does not have a row where colname = value, the block will be executed.

--  #IfNotRow2D
--    arguments: table_name colname value colname2 value2
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2, the block will be executed.

--  #IfNotRow3D
--    arguments: table_name colname value colname2 value2 colname3 value3
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2 AND colname3 = value3, the block will be executed.

--  #IfNotRow4D
--    arguments: table_name colname value colname2 value2 colname3 value3 colname4 value4
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2 AND colname3 = value3 AND colname4 = value4, the block will be executed.

--  #IfNotRow2Dx2
--    desc:      This is a very specialized function to allow adding items to the list_options table to avoid both redundant option_id and title in each element.
--    arguments: table_name colname value colname2 value2 colname3 value3
--    behavior:  The block will be executed if both statements below are true:
--               1) The table table_name does not have a row where colname = value AND colname2 = value2.
--               2) The table table_name does not have a row where colname = value AND colname3 = value3.

--  #IfRow
--    arguments: table_name colname value
--    behavior:  If the table table_name does have a row where colname = value, the block will be executed.

--  #IfRow2D
--    arguments: table_name colname value colname2 value2
--    behavior:  If the table table_name does have a row where colname = value AND colname2 = value2, the block will be executed.

--  #IfRow3D
--        arguments: table_name colname value colname2 value2 colname3 value3
--        behavior:  If the table table_name does have a row where colname = value AND colname2 = value2 AND colname3 = value3, the block will be executed.

--  #IfIndex
--    desc:      This function is most often used for dropping of indexes/keys.
--    arguments: table_name colname
--    behavior:  If the table and index exist the relevant statements are executed, otherwise not.

--  #IfNotIndex
--    desc:      This function will allow adding of indexes/keys.
--    arguments: table_name colname
--    behavior:  If the index does not exist, it will be created

--  #IfUuidNeedUpdate
--    argument: table_name
--    behavior: this will add and populate a uuid column into table

--  #IfUuidNeedUpdateId
--    argument: table_name primary_id
--    behavior: this will add and populate a uuid column into table

--  #IfUuidNeedUpdateVertical
--    argument: table_name table_columns
--    behavior: this will add and populate a uuid column into vertical table for combinations of table_columns given

--  #EndIf
--    all blocks are terminated with a #EndIf statement.

--  #IfNotListReaction
--    Custom function for creating Reaction List

--  #IfNotListOccupation
--    Custom function for creating Occupation List

--  #IfTextNullFixNeeded
--    desc: convert all text fields without default null to have default null.
--    arguments: none

--  #IfTableEngine
--    desc:      Execute SQL if the table has been created with given engine specified.
--    arguments: table_name engine
--    behavior:  Use when engine conversion requires more than one ALTER TABLE

--  #IfInnoDBMigrationNeeded
--    desc: find all MyISAM tables and convert them to InnoDB.
--    arguments: none
--    behavior: can take a long time.

--  #IfDocumentNamingNeeded
--    desc: populate name field with document names.
--    arguments: none

#IfMissingColumn layout_group_properties grp_save_close
ALTER TABLE `layout_group_properties` ADD COLUMN `grp_save_close` tinyint(1) not null default 0;
#EndIf

#IfMissingColumn layout_group_properties grp_init_open
ALTER TABLE `layout_group_properties` ADD COLUMN `grp_init_open` tinyint(1) not null default 0;
UPDATE layout_group_properties AS p, layout_options AS o SET p.grp_init_open = 1 WHERE
o.form_id = p.grp_form_id AND o.group_id = p.grp_group_id AND o.uor > 0 AND o.edit_options LIKE '%I%';
UPDATE layout_group_properties AS p SET p.grp_init_open = 1 WHERE p.grp_group_id = '1' AND
(SELECT count(*) FROM layout_options AS o WHERE o.form_id = p.grp_form_id AND o.uor > 0 AND o.edit_options LIKE '%I%') = 0;
#EndIf

#IfMissingColumn layout_group_properties grp_last_update
ALTER TABLE `layout_group_properties` ADD COLUMN `grp_last_update` timestamp;
#EndIf

#---------- Support for Referrals section of LBFs. ----------#
#IfMissingColumn layout_group_properties grp_referrals
ALTER TABLE `layout_group_properties` ADD COLUMN `grp_referrals` tinyint(1) not null default 0;
#EndIf

#IfMissingColumn users_facility warehouse_id
ALTER TABLE `users_facility` ADD COLUMN `warehouse_id` varchar(31) NOT NULL default '';
ALTER TABLE `users_facility` DROP PRIMARY KEY, ADD PRIMARY KEY (`tablename`,`table_id`,`facility_id`,`warehouse_id`);
#EndIf

#IfNotColumnType drugs form varchar(31)
ALTER TABLE `drugs` CHANGE `form`  `form`  varchar(31) NOT NULL default '0';
#EndIf
#IfNotColumnType drugs unit varchar(31)
ALTER TABLE `drugs` CHANGE `unit`  `unit`  varchar(31) NOT NULL default '0';
#EndIf
#IfNotColumnType drugs route varchar(31)
ALTER TABLE `drugs` CHANGE `route` `route` varchar(31) NOT NULL default '0';
#EndIf

#IfMissingColumn drug_templates pkgqty
ALTER TABLE `drug_templates` ADD COLUMN `pkgqty` float NOT NULL DEFAULT 1.0 COMMENT 'Number of product items per template item';
#EndIf

#IfMissingColumn voids reason
ALTER TABLE `voids` ADD COLUMN `reason` VARCHAR(31) default '';
#EndIf

#IfMissingColumn voids notes
ALTER TABLE `voids` ADD COLUMN `notes` VARCHAR(255) default '';
#EndIf

#IfNotRow2D list_options list_id lists option_id void_reasons
INSERT INTO list_options (list_id, option_id, title, seq, is_default) VALUES ('lists','void_reasons','Void Reasons', 1,0);
INSERT INTO list_options (list_id, option_id, title, seq, is_default) VALUES ('void_reasons','one'  ,'Reason 1',10,1);
INSERT INTO list_options (list_id, option_id, title, seq, is_default) VALUES ('void_reasons','two'  ,'Reason 2',20,0);
#EndIf

#IfNotIndex log patient_id
CREATE INDEX `patient_id` ON `log` (`patient_id`);
#EndIf
