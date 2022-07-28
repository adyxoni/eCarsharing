/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.19 : Database - freedb_carsharing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`freedb_carsharing` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `freedb_carsharing`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`status`) values 
(15,'testo','test1','ACTIVE'),
(40,'ajla','123','ACTIVE'),
(50,'asisic1','password','ACTIVE'),
(57,'test','5f4dcc3b5aa765d61d8327deb882cf99','PENDING'),
(58,'ajlaaa','19cf8fc05187049569a7fc2991782bac','PENDING'),
(59,'ajla.sisic','12345','ACTIVE');

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `posted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `comments` */

insert  into `comments`(`id`,`comment`,`posted`) values 
(1,'hello everyone!','2022-07-27 10:43:30'),
(2,'whats up','2022-07-28 05:27:03'),
(4,'testttt','2022-07-28 07:00:47'),
(5,'Chat proradio moglo bi se i leci spavati','2022-07-28 07:05:26'),
(7,'Ma kakvo spavanje dok se ne sredi sve','2022-07-28 07:06:54'),
(8,'Cik cak chat','2022-07-28 07:07:49'),
(9,'E ne mogu emoji zao mi je','2022-07-28 07:08:40'),
(10,'test','2022-07-28 07:09:14'),
(11,'Moram izvrnuti chat','2022-07-28 07:10:05'),
(12,'Dole mi idu nove poruke a gore stare ostaju, ne valja','2022-07-28 07:10:15'),
(13,'Eto ga i chat invertan','2022-07-28 07:42:09'),
(14,'CommentService.count() test','2022-07-28 07:43:53'),
(15,'Prosao i to','2022-07-28 07:44:00');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `payments` */

insert  into `payments`(`id`,`date`,`time`,`amount`) values 
(14,'2022-07-22','15:30:00',50),
(15,'2022-07-27','15:30:00',20),
(16,'2022-07-27','00:42:00',100),
(17,'2022-07-04','09:40:00',80),
(18,'2022-07-27','09:40:00',40),
(19,'2022-07-24','15:40:00',20),
(23,'2022-07-28','16:37:00',20),
(24,'2022-07-23','05:37:00',15),
(25,'2022-07-10','12:34:00',12),
(26,'2022-07-28','00:34:00',6),
(27,'2022-07-02','16:38:00',13),
(28,'2022-07-20','00:44:00',35);

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `body` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tasks` */

/*Table structure for table `todos` */

DROP TABLE IF EXISTS `todos`;

CREATE TABLE `todos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `body` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `icon` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `todos` */

insert  into `todos`(`id`,`title`,`body`,`icon`) values 
(1,'Hello World','This will be a great project. Looking forward to it!',0),
(2,'Inverted','Created to test out the timeline-inverted class. This should be on the right side!',2),
(3,'Task List','We must fix this todo list ASAP!...',5),
(4,'Meeting','Meeting tomorrow at 9:00 to figure out how to get this thing working',3),
(5,'Test','Test',4);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `email` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone_number` int NOT NULL,
  `role` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'USER',
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  `accountID` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`),
  KEY `fk_accountID` (`accountID`),
  CONSTRAINT `fk_accountID` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`full_name`,`DOB`,`email`,`phone_number`,`role`,`token`,`token_created_at`,`accountID`) values 
(34,'blablabla','1911-10-05','test123@gmail.com',865874,'USER','2f33b8236dd59a66970669e7852c7cff',NULL,15),
(57,'Ajla Sisic','2000-07-19','ajlasisic00@gmail.com',532525,'USER','5dbf2c6f3c7ae12a675ec443e7078506',NULL,40),
(65,'Ajla Sisic','2000-02-10','ajla.sisic19@gmail.com',634634,'ADMIN','764424075bb30b9ba58010c95d6b2475','2021-09-13 11:53:42',50),
(68,'Name Surname','2000-01-01','blabla@gmail.com',123456,'USER','903dcfb5079ae72466c5d527c412758a',NULL,57),
(69,'Name Surname','2001-07-29','ajla.sisic@stu.ibu.edu.ba',123456,'ADMIN',NULL,'2021-09-13 18:26:31',59);

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `car_brand` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `car_model` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mileage` int DEFAULT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `license_plate` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price_per_hour` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`car_brand`,`car_model`,`mileage`,`availability`,`license_plate`,`price_per_hour`) values 
(2,'Renaults','Clio',10231,1,'123A432',5.456),
(3,'Peugeot','308',4503,1,'276P432K',4.82),
(4,'vw','up',173,0,'840H946L',6.5),
(5,'renault','kadjar',1286,1,'347H215N',4.45),
(6,'audi','a3',165431,0,'137A259M',5.5),
(7,'audi','a2',243857,1,'912H828K',2.9),
(11,'peugeot','206',12374,1,'1397H5M2',3.53),
(12,'renault','clio',54372,1,'187G911V',1.99);

/* Trigger structure for table `comments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_add_posted` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_add_posted` BEFORE INSERT ON `comments` FOR EACH ROW SET NEW.posted = NOW() */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
