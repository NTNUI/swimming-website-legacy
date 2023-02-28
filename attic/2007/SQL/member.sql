# MySQL dump 5.13
#
# Host: <REDACTED>	Database: <REDACTED>
#--------------------------------------------------------
# Server version	3.23.41-log

#
# Table structure for table 'BOARDMEMBER'
# 
# Legal values for position are: oppmann, kasserer, webmaster, 
# materialforvalter, historieskriver, leder, trener and nestleder
#
DROP TABLE IF EXISTS BOARDMEMBER;
CREATE TABLE BOARDMEMBER (
  id int(6) DEFAULT '0' NOT NULL,
  position varchar(20) DEFAULT '' NOT NULL,
  PRIMARY KEY (id,position)
);

#
# Table structure for table 'CITY'
#
DROP TABLE IF EXISTS CITY;
CREATE TABLE CITY (
  zipcode int(4) DEFAULT '0' NOT NULL,
  city varchar(15) DEFAULT '' NOT NULL,
  PRIMARY KEY (zipcode)
);

#
# Table structure for table 'EMAIL'
# 
# Legal values for list are: junk,ladies,sosial_inf and minor_arr
#
DROP TABLE IF EXISTS EMAIL;
CREATE TABLE EMAIL (
  id int(6) DEFAULT '0' NOT NULL,
  list varchar(15) DEFAULT '' NOT NULL,
  PRIMARY KEY (id,list)
);

#
# Table structure for table 'NSF'
#
DROP TABLE IF EXISTS NSF;
CREATE TABLE NSF (
  id int(6) DEFAULT '0' NOT NULL,
  year int(4) DEFAULT '0' NOT NULL,
  PRIMARY KEY (id,year)
);

#
# Table structure for table 'PERSON'
#
DROP TABLE IF EXISTS PERSON;
CREATE TABLE PERSON (
  id int(6) NOT NULL auto_increment,
  password varchar(8) DEFAULT '' NOT NULL,
  firstname varchar(40),
  lastname varchar(40),
  dateofbirth date,
  sex char(1),
  address varchar(50),
  zipcode int(4),
  email varchar(50) DEFAULT '' NOT NULL,
  phoneh varchar(8),
  phonec varchar(8),
  phonew varchar(8),
  credit decimal(6,2),
  registered date,
  language varchar(15) DEFAULT 'norwegian' NOT NULL;
  PRIMARY KEY (id)
);

