CREATE TABLE IF NOT EXISTS `form_injection` (
id bigint(20) NOT NULL auto_increment,
date datetime default NULL,
pid bigint(20) default NULL,
user varchar(255) default NULL,
groupname varchar(255) default NULL,
authorized tinyint(4) default NULL,
activity tinyint(4) default NULL,
injection_name varchar(255),
site varchar(255),
lot varchar(255),
expiration varchar(255),
administrator varchar(255),
manufacturer varchar(255),
PRIMARY KEY (id)
) TYPE=MyISAM;
