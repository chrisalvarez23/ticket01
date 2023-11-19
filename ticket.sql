/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.28-MariaDB : Database - cidemo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cidemo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `cidemo`;

/*Table structure for table `auth_groups_users` */

DROP TABLE IF EXISTS `auth_groups_users`;

CREATE TABLE `auth_groups_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_groups_users` */

insert  into `auth_groups_users`(`id`,`user_id`,`group`,`created_at`) values 
(1,1,'admin','2023-11-16 12:53:41'),
(4,7,'user','2023-11-18 07:43:40'),
(9,16,'user','2023-11-18 17:02:22');

/*Table structure for table `auth_identities` */

DROP TABLE IF EXISTS `auth_identities`;

CREATE TABLE `auth_identities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_identities` */

insert  into `auth_identities`(`id`,`user_id`,`type`,`name`,`secret`,`secret2`,`expires`,`extra`,`force_reset`,`last_used_at`,`created_at`,`updated_at`) values 
(1,1,'email_password',NULL,'admin@admin.com','$2y$12$5IrYo5qGP3wTjvcVZygnjOa4gU.8mLjFoG2TpJO7pJMw.cwKMdUe6',NULL,NULL,0,'2023-11-19 03:12:05','2023-11-16 12:53:41','2023-11-19 03:12:05'),
(6,7,'email_password',NULL,'test@gmail.com','$2y$12$tRKqybH2ilEQgbuxP05viOzGQ.kHZw5gpjofZZ/k/Fj.c1Esxbxwy',NULL,NULL,0,'2023-11-18 07:44:33','2023-11-18 07:43:40','2023-11-18 07:44:33'),
(12,16,'email_password',NULL,'saasdlfkjsadfj@jfalskjfd.com','$2y$12$vt250L/YVuHvTLoPgTVJ6OtAwqV4XSTVaySsgdbqJIpojCnvd/3YS',NULL,NULL,0,NULL,'2023-11-18 17:02:22','2023-11-18 17:02:22');

/*Table structure for table `auth_logins` */

DROP TABLE IF EXISTS `auth_logins`;

CREATE TABLE `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`ip_address`,`user_agent`,`id_type`,`identifier`,`user_id`,`date`,`success`) values 
(1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-16 13:21:58',1),
(2,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-16 13:45:49',0),
(3,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-16 13:45:58',0),
(4,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-16 13:46:05',1),
(5,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-17 00:32:28',1),
(6,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-17 03:27:06',0),
(7,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','email_password','chrisalvarez23@gmail.com',1,'2023-11-17 03:27:15',1),
(8,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','email_password','chrisalvarez23@gmail.com',1,'2023-11-17 03:28:29',1),
(9,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','email_password','chrisalvarez23@gmail.com',1,'2023-11-17 07:40:50',1),
(10,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-18 01:49:13',0),
(11,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-18 01:49:20',1),
(12,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','test@gmail.com',7,'2023-11-18 07:44:33',1),
(13,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-18 08:15:33',0),
(14,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-18 08:15:39',1),
(15,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-18 11:07:28',1),
(16,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-18 16:30:30',1),
(17,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','testing@gmail.com',13,'2023-11-18 16:46:37',1),
(18,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-18 17:06:48',1),
(19,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:54:48',0),
(20,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:54:58',0),
(21,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:55:07',0),
(22,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:55:12',0),
(23,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:55:26',0),
(24,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:56:16',0),
(25,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:56:24',0),
(26,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',NULL,'2023-11-19 00:56:28',0),
(27,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0','email_password','chrisalvarez23@gmail.com',1,'2023-11-19 00:56:32',1),
(28,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','email_password','chrisalvarez23@gmail.com',1,'2023-11-19 03:12:05',1);

/*Table structure for table `auth_permissions_users` */

DROP TABLE IF EXISTS `auth_permissions_users`;

CREATE TABLE `auth_permissions_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_permissions_users` */

/*Table structure for table `auth_remember_tokens` */

DROP TABLE IF EXISTS `auth_remember_tokens`;

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_remember_tokens` */

/*Table structure for table `auth_token_logins` */

DROP TABLE IF EXISTS `auth_token_logins`;

CREATE TABLE `auth_token_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `auth_token_logins` */

/*Table structure for table `authors` */

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `authors` */

insert  into `authors`(`id`,`first_name`,`last_name`,`email`,`birthdate`,`added`) values 
(2,'Rylan3','Muller','adams.dale@example.com','1997-08-23','1991-05-22 06:16:24'),
(3,'Kasey','Kohler','ronny.frami@example.org','2019-05-09','1985-04-23 22:16:41'),
(4,'Melvin','Quitzon','kautzer.buster@example.net','2001-03-28','1999-08-01 09:34:27'),
(5,'Obie','Hansen','gabriel.altenwerth@example.org','1989-10-29','1973-03-27 21:37:06'),
(6,'Enoch','Murazik','dina.koepp@example.net','1972-12-01','1976-09-21 07:51:46'),
(7,'Brenden','Goyette','wanda.hammes@example.net','2010-03-01','2013-06-06 19:42:28'),
(8,'Demetrius','Beier','murray.krystina@example.org','1984-10-22','1989-10-22 19:27:33'),
(9,'Felicia','Durgan','felipe.pouros@example.net','2022-06-15','1971-12-29 03:16:26'),
(10,'Pablo','Mann','johanna.veum@example.org','1979-12-17','1986-05-29 18:42:34'),
(11,'Sandrine','Smith','steve.pfannerstill@example.org','2012-03-14','2004-03-20 10:09:27'),
(12,'Noe','Okuneva','barton16@example.net','1989-06-16','1981-11-24 12:43:37'),
(13,'Alexane','Fisher','wisoky.watson@example.org','1989-07-06','1998-10-02 23:11:42'),
(14,'Abbie','Swift','ncrona@example.org','2004-06-24','2004-04-16 14:33:35'),
(15,'Vivian','Adams','fahey.santos@example.net','1986-07-27','2012-01-13 21:02:14'),
(16,'Mike','Davis','gaylord35@example.com','1971-01-20','1972-05-27 02:10:32'),
(17,'Evert','Leuschke','keon.zieme@example.org','1995-11-24','1980-01-12 17:52:38'),
(18,'Missouri','Hessel','casper.einar@example.org','1998-05-22','1997-01-22 07:28:52'),
(19,'Alexis','Maggio','monique94@example.org','1992-01-14','2007-09-18 13:24:37'),
(20,'Rodrick','Ernser','arlie.pouros@example.com','1986-05-04','2003-08-23 11:00:15'),
(21,'Gordon','Lesch','julia32@example.com','2016-04-30','1989-06-28 09:56:03'),
(22,'Deondre','Funk','ycummings@example.org','2016-07-20','1972-03-13 14:36:38'),
(23,'Fatima','Lockman','qnienow@example.org','2021-11-26','1988-11-18 17:23:32'),
(24,'Raphaelle','Gutmann','elindgren@example.org','1970-12-28','2007-07-30 19:01:59'),
(25,'Tina','Cummings','runolfsdottir.candelario@example.com','2014-08-24','2020-04-03 04:10:56'),
(26,'Osvaldo','Baumbach','upton.madaline@example.com','2023-05-12','2014-11-08 05:44:12'),
(27,'Lia','Olson','kristin.schoen@example.org','2015-10-11','1982-12-21 18:29:52'),
(28,'Jaiden','Tromp','albertha66@example.org','1986-05-20','2023-05-30 08:37:41'),
(29,'Rosa','Wiegand','sauer.andres@example.net','1992-12-05','1981-01-17 13:44:25'),
(30,'Florian','Parisian','romaguera.loren@example.net','1984-10-03','1971-04-16 23:28:54'),
(31,'Angela','Wunsch','janice.vandervort@example.com','1993-02-18','2014-10-19 01:29:56'),
(32,'Eli','Nader','walker.brooke@example.org','2005-04-07','1981-05-19 13:49:31'),
(33,'Elwyn','Hoeger','qdicki@example.com','2023-04-22','1979-04-26 20:23:21'),
(34,'Granville','Schinner','samanta.gorczany@example.org','2008-10-27','2001-10-22 09:19:47'),
(35,'Rodolfo','Blanda','wiegand.opal@example.org','1972-08-12','2009-09-23 06:06:35'),
(36,'Santiago','Lang','anderson.savanah@example.net','2009-09-06','1972-09-06 00:33:28'),
(37,'Ottilie','Keeling','hartmann.america@example.net','1979-07-19','1990-05-14 19:24:24'),
(38,'Erik','Bahringer','brionna77@example.com','2002-04-19','2004-06-27 18:57:54'),
(39,'Brice','Cruickshank','carol.carter@example.org','1995-10-11','2014-06-10 23:58:05'),
(40,'Dashawn','Abbott','eleonore.mante@example.net','1987-10-09','1988-06-08 07:18:15'),
(41,'Alivia','Schuppe','mercedes80@example.com','2019-05-21','2017-11-20 17:59:24'),
(42,'Elenora','Erdman','jast.darrel@example.org','1996-06-06','2010-04-15 17:25:45'),
(43,'Mae','Lakin','jess98@example.com','1986-12-18','1973-02-12 02:18:20'),
(44,'Franz','Purdy','conner71@example.org','1993-05-18','2022-03-21 02:57:40'),
(45,'Esther','Hayes','egleichner@example.org','1971-09-07','2019-06-10 21:33:39'),
(46,'Percy','Crooks','lmitchell@example.com','2007-12-30','1974-05-09 03:34:26'),
(47,'Bennett','Kunde','bdoyle@example.com','2020-10-26','1994-07-28 07:03:37'),
(48,'Dayana','O\'Conner','purdy.karina@example.com','2006-10-21','2000-06-01 20:18:49'),
(49,'Aglae','Lindgren','charity.thompson@example.net','2022-05-06','1990-01-13 11:04:02'),
(50,'Laurel','Blanda','nyah.reynolds@example.net','1999-12-20','1988-03-28 19:39:16'),
(51,'Selmer','Leffler','kemmer.rigoberto@example.net','2020-08-02','1973-12-06 05:55:14'),
(52,'Tyrese','Carter','schultz.kade@example.net','1982-02-15','2008-03-16 08:31:54'),
(53,'Kenya','Borer','o\'kon.vern@example.net','1987-04-25','2008-10-03 10:42:19'),
(54,'Lloyd','Crooks','qbayer@example.com','1982-03-31','1990-08-24 11:12:12'),
(55,'Nadia','West','haleigh16@example.net','2022-06-10','1974-07-01 12:23:30'),
(56,'Donna','Abbott','janie96@example.net','1988-01-03','1994-12-09 14:22:43'),
(57,'Chanelle','Reichel','joseph45@example.com','1981-07-06','1990-11-02 15:18:37'),
(58,'Joannie','Grimes','kameron.morissette@example.org','1985-02-02','1982-11-19 23:55:24'),
(59,'Nichole','Medhurst','windler.shaylee@example.net','2012-04-08','1979-06-06 06:06:08'),
(60,'Anna','Koch','brannon.witting@example.net','1988-11-23','1980-10-31 14:34:33'),
(61,'Jessika','Champlin','metz.harley@example.org','1974-11-26','2005-06-29 04:40:07'),
(62,'Maudie','Pollich','jayme.huels@example.org','2010-08-08','2010-08-25 08:50:18'),
(63,'Wiley','Orn','rosetta.reynolds@example.net','2015-05-25','2016-09-27 11:41:58'),
(64,'Duncan','Weber','jpowlowski@example.com','1971-07-11','2022-11-30 21:42:40'),
(65,'Casimer','Dooley','upton.selina@example.org','1978-04-17','1985-05-11 10:37:14'),
(66,'John','Kassulke','sokuneva@example.org','2003-03-25','1978-10-02 16:46:01'),
(67,'Elena','Streich','gwillms@example.net','1991-10-28','1999-06-03 06:50:18'),
(68,'Catherine','Nolan','mateo.gleason@example.net','1982-10-09','1981-10-03 07:07:42'),
(69,'Elbert','Ledner','pbaumbach@example.com','1972-03-14','2016-06-06 11:27:00'),
(70,'Immanuel','Howe','mueller.ashtyn@example.com','2018-06-09','2002-06-15 01:19:50'),
(71,'Jada','Goyette','ferne.sporer@example.net','1991-03-27','2003-03-24 03:19:36'),
(72,'Eleonore','Brekke','greta.kuphal@example.org','1987-10-30','2011-11-28 12:14:08'),
(73,'Lora','Jerde','noble30@example.net','2002-03-12','1984-01-31 23:15:39'),
(74,'Ivory','Thiel','iparisian@example.com','2015-05-20','1982-02-28 10:32:30'),
(75,'Tessie','Carroll','dariana75@example.net','1989-10-29','2009-10-23 06:44:33'),
(76,'Timmy','Smith','glenna71@example.org','2021-04-10','2001-12-10 21:30:16'),
(77,'Michele','Kovacek','renee84@example.net','2018-05-03','2013-05-05 17:41:28'),
(78,'Wendy','Mayert','dbode@example.com','2018-09-23','2003-12-10 02:15:37'),
(79,'Florian','Stark','vcummerata@example.net','2003-04-22','2006-02-13 21:50:52'),
(80,'Henriette','Corwin','koss.missouri@example.org','2000-03-29','1977-01-12 13:18:17'),
(81,'Holly','Waelchi','kevin53@example.net','1983-06-09','1988-06-28 09:58:29'),
(82,'Muhammad','Gleichner','tgottlieb@example.org','1973-11-19','1984-06-02 02:50:28'),
(83,'Gisselle','Johnson','miguel.witting@example.org','1982-02-25','1976-06-16 22:13:50'),
(84,'Odie','Stamm','etremblay@example.net','1975-11-29','1994-10-08 09:16:28'),
(85,'Chester','Goyette','german31@example.com','1994-09-07','2007-02-27 00:45:15'),
(86,'Cathrine','O\'Connell','mfay@example.net','2022-12-31','1992-09-08 22:15:55'),
(87,'Donald','Paucek','ziemann.salvatore@example.com','1991-03-24','2012-12-10 21:52:36'),
(88,'Chaim','Ratke','ziemann.callie@example.net','1998-10-13','2019-05-21 10:38:04'),
(89,'Kaleb','Moore','myrl.cummings@example.net','1977-09-29','1979-02-10 19:23:38'),
(90,'Will','Crona','genevieve94@example.com','1978-08-28','1974-05-21 16:01:42'),
(91,'Juliet','Jerde','gusikowski.taryn@example.net','1972-12-19','2009-01-26 10:24:23'),
(92,'Blair32','Conroy','eloise42@example.com','2021-08-25','1990-09-23 10:08:53'),
(93,'Jedidiah','Jones','rowe.richard@example.net','1990-06-09','1980-01-26 09:58:43'),
(94,'Judy','Gottlieb','bogisich.emie@example.org','1990-07-26','1994-11-11 22:21:59'),
(95,'Jeanette','Yost','watsica.moshe@example.com','2014-10-17','2001-11-25 14:01:04'),
(96,'Victor','Kub','cordelia07@example.org','1984-05-19','2002-02-11 20:02:22'),
(97,'Ollie','Gusikowski','cameron.ward@example.org','1971-04-03','2016-11-14 13:30:56'),
(98,'Celestino','Blick','lennie52@example.org','2004-07-07','2007-04-01 00:46:50'),
(99,'Cameron','Waters','turcotte.kassandra@example.org','1989-07-31','2016-07-29 17:46:33'),
(100,'Evie','Simonis','beahan.rico@example.org','1972-11-20','1980-10-11 11:20:17'),
(101,'sdfasf','asdf','sfsaf2@gmaill.com','2023-11-03','2023-11-17 15:08:33');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `employee` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2020-12-28-223112','CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables','default','CodeIgniter\\Shield',1700139168,1),
(2,'2021-07-04-041948','CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable','default','CodeIgniter\\Settings',1700139168,1),
(3,'2021-11-14-143905','CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn','default','CodeIgniter\\Settings',1700139168,1),
(4,'2023-11-16-130358','App\\Database\\Migrations\\AuthorsTable','default','App',1700139942,2),
(5,'2023-11-16-062614','App\\Database\\Migrations\\AuthorsTable','default','App',1700183359,3);

/*Table structure for table `office` */

DROP TABLE IF EXISTS `office`;

CREATE TABLE `office` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office` varchar(500) DEFAULT NULL,
  `code` varchar(12) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `office` */

insert  into `office`(`id`,`office`,`code`,`description`) values 
(9,'Corporate Planning Department2','CPS','test'),
(11,'Mangement Information Services Division','MISD','Manage ICT infrastructure and processes of the agency'),
(13,'Office of the general Manager','OGM','Office of the Head of Agency');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`author_id`,`title`,`description`,`content`,`created_at`,`updated_at`) values 
(1,1,'Sample Title','test','test content  ','2023-11-17 01:30:57','2023-11-17 01:30:57'),
(2,2,'test2','test','test','2023-11-17 07:15:17','2023-11-17 07:20:14'),
(3,8,'sdfasdf','saffsd','safsdf','2023-11-17 07:59:05','2023-11-17 07:59:05'),
(4,2,'safsadf','asfsdfsdf','sadfsafsf','2023-11-17 07:59:26','2023-11-17 07:59:26');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `settings` */

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `severity` varchar(3) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `accomplished_at` date DEFAULT NULL,
  `udpated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ticket` */

insert  into `ticket`(`id`,`first_name`,`last_name`,`email`,`office_id`,`severity`,`description`,`status`,`created_at`,`accomplished_at`,`udpated_at`) values 
(3,'testsafsdaf','sadfsdfsafsad','fsdfasfasdf@dfsafasdfsf',9,'H','asdfasdf','processing',NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`status`,`status_message`,`active`,`last_active`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'cc.alvarez',NULL,NULL,1,NULL,'2023-11-16 12:53:40','2023-11-16 12:53:41',NULL),
(7,'TESTasdfasdf',NULL,NULL,0,NULL,'2023-11-18 07:43:40','2023-11-18 07:43:40',NULL),
(16,'sajflksdjfksjf',NULL,NULL,0,NULL,'2023-11-18 17:02:21','2023-11-18 17:02:21',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
