
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder


#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  name tinytext NOT NULL,
  gender varchar(1) DEFAULT '' NOT NULL,
  first_name tinytext NOT NULL,
  middle_name tinytext NOT NULL,
  last_name tinytext NOT NULL,
  birthday int(11) DEFAULT '0' NOT NULL,
  title varchar(255) DEFAULT '' NOT NULL,
  email varchar(255) DEFAULT '' NOT NULL,
  phone varchar(30) DEFAULT '' NOT NULL,
  mobile varchar(30) DEFAULT '' NOT NULL,
  www varchar(255) DEFAULT '' NOT NULL,
  address tinytext NOT NULL,
  building varchar(20) DEFAULT '' NOT NULL,
  room varchar(15) DEFAULT '' NOT NULL,
  company varchar(255) DEFAULT '' NOT NULL,
  city varchar(255) DEFAULT '' NOT NULL,
  zip varchar(20) DEFAULT '' NOT NULL,
  region varchar(255) DEFAULT '' NOT NULL,
  country varchar(128) DEFAULT '' NOT NULL,
  image tinyblob NOT NULL,
  fax varchar(30) DEFAULT '' NOT NULL,
  deleted tinyint(3) DEFAULT '0',
  description text NOT NULL,
  addressgroup int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY pid (pid,email)
);


#
# Table structure for table 'tx_addressgroups_group'
#
CREATE TABLE tt_address_group (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	fe_group tinytext,
	title tinytext NOT NULL,
	parent_group int(11) DEFAULT '0' NOT NULL,
	description text NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tt_address_tx_addressgroups_group_mm'
#
#
CREATE TABLE tt_address_group_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (

	parent_address int(11) unsigned DEFAULT '0' NOT NULL,
	categories int(11) unsigned DEFAULT '0' NOT NULL,

	position varchar(255) DEFAULT '' NOT NULL,
	department varchar(255) DEFAULT '' NOT NULL,
	qualifications varchar(255) DEFAULT '' NOT NULL,
	fal_image int(11) unsigned NOT NULL default '0',
	nick_name varchar(255) DEFAULT '' NOT NULL,
	post_office_box varchar(255) DEFAULT '' NOT NULL,
	longitude varchar(255) DEFAULT '' NOT NULL,
	latitude varchar(255) DEFAULT '' NOT NULL,
	user int(11) unsigned DEFAULT '0',
	related_addresses int(11) unsigned DEFAULT '0' NOT NULL,
	other_addresses int(11) unsigned DEFAULT '0' NOT NULL,


	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_addresscollection_address_relatedaddresses_address_mm'
#
CREATE TABLE tx_addresscollection_address_relatedaddresses_address_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);