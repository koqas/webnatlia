# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.56)
# Database: 029-dun-rawcircle
# Generation Time: 2014-06-26 02:56:07 +0000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`,`username`,`fullname`,`password`,`status`,`created`,`modified`)
VALUES
	(1,'admin',NULL,'06bac9a5c873bb82d43a13dda7c83380b74d851f',1,'2014-02-06 04:09:01','2014-02-06 04:09:01');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table brand_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brand_types`;

CREATE TABLE `brand_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `brand_types` WRITE;
/*!40000 ALTER TABLE `brand_types` DISABLE KEYS */;
INSERT INTO `brand_types` (`id`,`name`)
VALUES
	(1,'Package'),
	(2,'Packet'),
	(3,'Can'),
	(4,'Bag'),
	(5,'Piece');

/*!40000 ALTER TABLE `brand_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thebrand_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `brand_type_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`,`thebrand_id`,`name`,`brand_type_id`,`status`,`created`,`modified`)
VALUES
	(1,1,'Milo 3 in 1',3,1,'2014-02-09 13:55:39','2014-02-18 15:10:10'),
	(2,1,'Milo tin 100ml',5,1,'2014-02-13 00:00:00','2014-02-18 15:10:04'),
	(3,2,'Nescafe Rich',1,1,'2014-02-13 00:00:00','2014-02-18 15:09:53'),
	(4,2,'Nestle Branded Stuff',1,1,'2014-02-18 15:11:13','2014-03-13 12:09:05');

/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table checkin_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `checkin_logs`;

CREATE TABLE `checkin_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `checkin_time` datetime DEFAULT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `meet_count` int(4) DEFAULT NULL,
  `stock_checkin` int(4) DEFAULT NULL,
  `stock_checkout` int(4) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table cms_menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_menus`;

CREATE TABLE `cms_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(2) DEFAULT NULL,
  `superOnly` enum('0','1') NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

LOCK TABLES `cms_menus` WRITE;
/*!40000 ALTER TABLE `cms_menus` DISABLE KEYS */;
INSERT INTO `cms_menus` (`id`,`name`,`url`,`sort`,`superOnly`,`status`)
VALUES
	(1,'Region','Regions/Index',1,'0','1'),
	(2,'Supervisors','Supervisors/Index',8,'0','1'),
	(3,'Users','Users/index',10,'0','1'),
	(4,'Zone','Zones/Index',2,'0','1'),
	(5,'Venues','Venues/Index',3,'0','1'),
	(9,'Venue Type','VenueTypes/Index',4,'0','1'),
	(10,'Supervisor Types','SupervisorTypes/Index',10,'0','1'),
	(13,'Questioner','',20,'0','1');

/*!40000 ALTER TABLE `cms_menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_submenus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_submenus`;

CREATE TABLE `cms_submenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_menu_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `cms_submenus` WRITE;
/*!40000 ALTER TABLE `cms_submenus` DISABLE KEYS */;
INSERT INTO `cms_submenus` (`id`,`cms_menu_id`,`name`,`url`,`status`)
VALUES
	(1,13,'Questioner Campaign','QuestionerCampaign/index','1'),
	(2,13,'Quesioner Question','QuestionerQuestion/Index','1'),
	(3,13,'Questioner Answer','QuestionerAnswer/Index','1'),
	(4,13,'Questioner Result','QuestionerResultLog/Index','1');

/*!40000 ALTER TABLE `cms_submenus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `host` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL,
  `cloud` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Masih di server loka,1=Sudah di server cloud',
  `mime_type` varchar(100) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cloud` (`cloud`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` (`id`,`model`,`model_id`,`type`,`host`,`url`,`cloud`,`mime_type`,`path`)
VALUES
	(1,'Venue',1,'original','http://192.168.0.34/nestle-promoter/cms/','contents/Venue/1/1_original.jpg','0','image/jpeg','D:/abyfolder/xampp/htdocs/nestle-promoter/cms/app/webroot/contents/Venue/1/1_original.jpg'),
	(2,'Venue',2,'original','http://192.168.0.34/nestle-promoter/cms/','contents/Venue/2/2_original.jpg','0','image/jpeg','D:/abyfolder/xampp/htdocs/nestle-promoter/cms/app/webroot/contents/Venue/2/2_original.jpg'),
	(3,'Venue',3,'original','http://192.168.0.34/nestle-promoter/cms/','contents/Venue/3/3_original.jpg','0','image/jpeg','D:/abyfolder/xampp/htdocs/nestle-promoter/cms/app/webroot/contents/Venue/3/3_original.jpg'),
	(4,'Venue',4,'original','http://192.168.0.34/nestle-promoter/cms/','contents/Venue/4/4_original.jpg','0','image/jpeg','D:/abyfolder/xampp/htdocs/nestle-promoter/cms/app/webroot/contents/Venue/4/4_original.jpg'),
	(5,'User',1,'original','http://192.168.0.34/nestle-promoter/cms/','contents/User/1/1_original.jpg','0','image/jpeg','D:/abyfolder/xampp/htdocs/nestle-promoter/cms/app/webroot/contents/User/1/1_original.jpg');

/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questioner_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questioner_answers`;

CREATE TABLE `questioner_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questioner_question_id` int(11) DEFAULT NULL,
  `text_answer` int(1) NOT NULL DEFAULT '0',
  `have_child` int(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `answer` varchar(200) DEFAULT NULL,
  `point` smallint(2) DEFAULT NULL,
  `description` text,
  `sort` int(3) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `questioner_answers` WRITE;
/*!40000 ALTER TABLE `questioner_answers` DISABLE KEYS */;
INSERT INTO `questioner_answers` (`id`,`questioner_question_id`,`text_answer`,`have_child`,`parent_id`,`answer`,`point`,`description`,`sort`,`status`,`created`,`modified`)
VALUES
	(1,1,0,1,NULL,'Seberapa Sering posting sehari',NULL,'',1,1,'2014-05-26 16:45:44','2014-05-26 16:46:46'),
	(2,1,0,0,1,'Lebih dari 10',NULL,'',1,1,'2014-05-26 16:46:04','2014-05-26 16:46:04'),
	(3,1,0,0,1,'5 - 10 Post',NULL,'',1,1,'2014-05-26 16:46:32','2014-05-26 16:46:32');

/*!40000 ALTER TABLE `questioner_answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questioner_campaigns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questioner_campaigns`;

CREATE TABLE `questioner_campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `questioner_campaigns` WRITE;
/*!40000 ALTER TABLE `questioner_campaigns` DISABLE KEYS */;
INSERT INTO `questioner_campaigns` (`id`,`name`,`description`,`status`,`created`,`modified`)
VALUES
	(1,'Gentlement','',1,'2014-05-26 16:44:19','2014-05-26 16:44:19');

/*!40000 ALTER TABLE `questioner_campaigns` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questioner_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questioner_questions`;

CREATE TABLE `questioner_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questioner_campaign_id` int(11) NOT NULL,
  `question` varchar(200) DEFAULT NULL,
  `description` text,
  `multiple_choices` int(1) NOT NULL DEFAULT '0',
  `sort` int(3) NOT NULL DEFAULT '1',
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questioner_campaign_id` (`questioner_campaign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `questioner_questions` WRITE;
/*!40000 ALTER TABLE `questioner_questions` DISABLE KEYS */;
INSERT INTO `questioner_questions` (`id`,`questioner_campaign_id`,`question`,`description`,`multiple_choices`,`sort`,`status`,`created`,`modified`)
VALUES
	(1,1,'Test Question','hello world',1,1,1,'2014-05-26 16:44:39','2014-05-26 16:44:39');

/*!40000 ALTER TABLE `questioner_questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questioner_result_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questioner_result_logs`;

CREATE TABLE `questioner_result_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `questioner_campaign_id` int(11) DEFAULT NULL,
  `questioner_question_id` int(11) DEFAULT NULL,
  `questioner_answer_id` int(11) DEFAULT NULL,
  `questioner_answer_text` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table regions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `regions`;

CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` (`id`,`name`,`status`)
VALUES
	(3,'Jakarta',1);

/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL DEFAULT '',
  `site_title` varchar(255) NOT NULL DEFAULT 'djarum super mild',
  `site_description` text NOT NULL,
  `site_keywords` text NOT NULL,
  `site_domain` varchar(255) NOT NULL DEFAULT 'coda-technology.dev',
  `web_url` varchar(255) NOT NULL DEFAULT 'http://webmld.coda-technology.dev/',
  `wap_url` varchar(255) NOT NULL DEFAULT 'http://mld.coda-technology.dev/',
  `cms_url` varchar(255) NOT NULL,
  `path_content` varchar(255) NOT NULL DEFAULT 'D:/xampp/htdocs/mld-web/contents/',
  `path_webroot` varchar(255) NOT NULL,
  `facebook_app_id` varchar(255) NOT NULL,
  `facebook_app_secret` varchar(255) NOT NULL,
  `bucket_name` varchar(255) DEFAULT NULL,
  `aws_host` varchar(255) DEFAULT NULL,
  `aws_host_url` varchar(255) DEFAULT NULL,
  `aws_access_key` varchar(255) DEFAULT NULL,
  `aws_secret_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`,`site_name`,`site_title`,`site_description`,`site_keywords`,`site_domain`,`web_url`,`wap_url`,`cms_url`,`path_content`,`path_webroot`,`facebook_app_id`,`facebook_app_secret`,`bucket_name`,`aws_host`,`aws_host_url`,`aws_access_key`,`aws_secret_key`)
VALUES
	(2,'Dunhill - Rawcircle','::Dunhill Rawcircle::','::Dunhill Rawcircle::','::Dunhill Rawcircle::','localhost/client/029-dun-rawcircle/cms','','','http://localhost/client/029-dun-rawcircle/cms/','','','','','','','','','');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shifts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shifts`;

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `shifts` WRITE;
/*!40000 ALTER TABLE `shifts` DISABLE KEYS */;
INSERT INTO `shifts` (`id`,`start_time`,`end_time`,`status`,`created`,`modified`)
VALUES
	(1,'11:00:00','20:00:00',1,'2014-02-06 12:19:19','2014-02-06 12:19:23');

/*!40000 ALTER TABLE `shifts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supervisor_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supervisor_types`;

CREATE TABLE `supervisor_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `supervisor_types` WRITE;
/*!40000 ALTER TABLE `supervisor_types` DISABLE KEYS */;
INSERT INTO `supervisor_types` (`id`,`name`,`status`)
VALUES
	(1,'Agency Administrator',1),
	(2,'Nestle Supervisor',1);

/*!40000 ALTER TABLE `supervisor_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supervisors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supervisors`;

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `supervisor_type_id` int(11) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `agency_address` text NOT NULL,
  `agency_contact_no` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `supervisors` WRITE;
/*!40000 ALTER TABLE `supervisors` DISABLE KEYS */;
INSERT INTO `supervisors` (`id`,`name`,`email`,`username`,`password`,`supervisor_type_id`,`agency_name`,`agency_address`,`agency_contact_no`,`status`,`created`,`modified`)
VALUES
	(1,'Coda Agency',NULL,'coda_agency','5801b8b4d1fb28ff797639a93a1e7684cefbd505',1,'Coda Technology','Coda','123123123123',1,'2014-02-09 13:55:18','2014-02-09 13:55:18');

/*!40000 ALTER TABLE `supervisors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nip` varchar(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '2',
  `supervisor_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `address` text,
  `email` varchar(100) DEFAULT NULL,
  `im` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='jenis type : 1 = supervisor 2 = spg';

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`username`,`password`,`nip`,`type`,`supervisor_id`,`name`,`phone`,`phone_2`,`address`,`email`,`im`,`status`,`created`,`modified`)
VALUES
	(1,'spg001','28121883d0bf7c410c714db7a9953e8d1ccac6b6','1234567',2,1,'Spg 001','123123','123123','13123','','123',1,'2014-02-06 05:33:49','2014-02-10 13:06:57'),
	(3,'yuska','382334323a380ceff3620d214f3fa5a82cb7e32a','1234',2,1,'yuska yudistira','12345678','','','yuska@aniseasia.com','',1,'2014-02-10 19:04:19','2014-02-10 19:04:19'),
	(4,'kossa','a3f66b9db3db616ad41085f3ab9a17523615bb65','123',2,1,'Kossa Audi Prasena','123','123','123','kossa@coda-technology.com','123',1,'2014-02-10 22:33:33','2014-02-12 17:45:29');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table venue_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `venue_types`;

CREATE TABLE `venue_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `venue_types` WRITE;
/*!40000 ALTER TABLE `venue_types` DISABLE KEYS */;
INSERT INTO `venue_types` (`id`,`name`,`status`)
VALUES
	(1,'Supermarket',1),
	(2,'Restaurants',1);

/*!40000 ALTER TABLE `venue_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table venues
# ------------------------------------------------------------

DROP TABLE IF EXISTS `venues`;

CREATE TABLE `venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) DEFAULT NULL,
  `venue_type_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `lat` varchar(100) NOT NULL DEFAULT '0',
  `lng` varchar(100) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `venues` WRITE;
/*!40000 ALTER TABLE `venues` DISABLE KEYS */;
INSERT INTO `venues` (`id`,`zone_id`,`venue_type_id`,`name`,`address`,`lat`,`lng`,`status`,`created`,`modified`)
VALUES
	(2,7,2,'Plaza Indonesia','plaza indonesia, kav 1','-6.193376521585256','106.82232141494751',1,'2014-02-12 17:43:40','2014-02-12 17:43:40');

/*!40000 ALTER TABLE `venues` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table zones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `zones`;

CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` (`id`,`region_id`,`name`,`status`)
VALUES
	(7,3,'Jakarta Pusat',1);

/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
