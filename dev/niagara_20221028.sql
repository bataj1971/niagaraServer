-- MariaDB dump 10.19  Distrib 10.8.4-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: testapi
-- ------------------------------------------------------
-- Server version	10.8.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` char(3) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES
(35,'','qui est soluta',NULL,'Gulgowskimouth','4345 Erdman Glen','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:24','2022-03-20 19:06:24'),
(36,'','officiis sapiente qui',NULL,'Joanieburgh','53531 Sipes Summit','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:24','2022-03-20 19:06:24'),
(37,'','possimus quia vero',NULL,'Braunfort','784 Rau Extension','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:25','2022-03-20 19:06:25'),
(38,'','ut repudiandae vitae',NULL,'East Stanleyville','554 Claudie Hill','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:25','2022-03-20 19:06:25'),
(39,'','eos accusantium modi',NULL,'East Monroeton','72137 Dennis Shoals','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:26','2022-03-20 19:06:26'),
(40,'','et et voluptas',NULL,'East Amos','6415 Cassidy Freeway','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:26','2022-03-20 19:06:26'),
(41,'','dolore iste officia',NULL,'Jovanifort','6887 Schulist Road','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:28','2022-03-20 19:06:28'),
(42,'','iste laboriosam vero',NULL,'Smithville','4569 Stracke Falls','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:28','2022-03-20 19:06:28'),
(43,'','at consectetur atque',NULL,'Swaniawskiville','4685 Considine Turnpike','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:29','2022-03-20 19:06:29'),
(44,'','doloremque sint reprehenderit',NULL,'Jeanberg','878 Iva Ford','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:29','2022-03-20 19:06:29'),
(45,'','assumenda placeat aut',NULL,'Port Leanne','61252 Christiana Spurs','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:30','2022-03-20 19:06:30'),
(46,'','excepturi debitis amet',NULL,'Hillsborough','51650 Josiane Overpass','{{zipcode}}','',NULL,1,1,'2022-03-20 19:06:30','2022-03-20 19:06:30'),
(47,'','enim molestiae sit',NULL,'Taylorberg','4162 Stan Junction','{{zipcode}}','',NULL,1,1,'2022-03-20 19:07:30','2022-03-20 19:07:30'),
(48,'','corporis est sit',NULL,'Vitastad','40158 Pagac Inlet','{{zipcode}}','',NULL,1,1,'2022-03-20 19:07:30','2022-03-20 19:07:30'),
(49,'','ad quibusdam et',NULL,'South Jaydonhaven','1083 Flatley Curve','{{zipcode}}','',NULL,1,1,'2022-03-20 19:07:31','2022-03-20 19:07:31'),
(50,'','praesentium excepturi laboriosam',NULL,'Port Rachaelville','7380 Declan Pine','{{zipcode}}','',NULL,1,1,'2022-03-20 19:07:31','2022-03-20 19:07:31'),
(51,'','natus non et_m',NULL,'Emietown','1654 Tracy Shoal','{{zipcode}}','',NULL,1,1,'2022-08-02 18:35:32','2022-08-20 19:10:44'),
(52,'','nisi cumque cupiditate',NULL,'Port Agustinaview','090 Mireya Ports','226','',NULL,1,1,'2022-08-03 20:23:55','2022-08-03 20:23:55'),
(53,'','voluptatem enim ullam',NULL,'Beattymouth','775 Heath Square','851','',NULL,1,1,'2022-08-03 20:26:05','2022-08-03 20:26:05'),
(54,'','maxime autem error',NULL,'West Genesis','2865 Breana Viaduct','111','',NULL,1,1,'2022-08-03 20:26:05','2022-08-03 20:26:05'),
(55,'','eos repellendus rerum',NULL,'East Giovani','23580 Gusikowski Mission','71','',NULL,1,1,'2022-08-03 20:26:33','2022-08-03 20:26:33'),
(56,'','deleniti odio vitae',NULL,'New Josefaport','95978 Feeney Freeway','885','',NULL,1,1,'2022-08-03 20:26:33','2022-08-03 20:26:33'),
(57,'','esse incidunt cupiditate mod 1-3 ',NULL,'South Nichole mod','1940 Pfannerstill Mall','315','',NULL,1,1,'2022-08-03 20:26:36','2022-08-03 20:26:44'),
(58,'','repellat excepturi aut mod 3 ',NULL,'Odessa mod','683 Ullrich Run','{{randomInt}}','',NULL,1,1,'2022-08-03 20:26:36','2022-08-03 20:26:44'),
(59,'','blanditiis et libero',NULL,'Josianemouth','8430 Haley Plaza','743','',NULL,1,1,'2022-08-19 17:24:39','2022-08-19 17:24:39'),
(60,'','eligendi provident aut',NULL,'Port Jordonchester','47712 Robel Drives','74','',NULL,1,1,'2022-08-19 20:51:45','2022-08-19 20:51:45'),
(61,'','veritatis sequi voluptas',NULL,'East Dena','0554 Nikolaus Corners','255','',NULL,1,1,'2022-08-20 11:15:42','2022-08-20 11:15:42'),
(62,'','dignissimos hic ex',NULL,'Charlottesville','8249 Hartmann Fall','522','',NULL,1,1,'2022-08-20 12:01:41','2022-08-20 12:01:41'),
(63,'','nihil alias rerum',NULL,'East Johann','8038 Mariana Ford','93','',NULL,1,1,'2022-08-20 12:03:20','2022-08-20 12:03:20'),
(70,'','dignissimos fugiat et',NULL,'Nicolasberg','247 Rath Mill','207','',NULL,1,1,'2022-08-20 12:20:04','2022-08-20 12:20:04'),
(71,'','vel sed tempore',NULL,'East Eleazartown','24772 Cynthia Flat','125','',NULL,1,1,'2022-08-25 12:25:14','2022-08-25 12:25:14'),
(72,'','voluptas maiores quod',NULL,'Valdosta','242 Nolan Lakes','77','',NULL,1,1,'2022-08-25 12:25:15','2022-08-25 12:25:15'),
(73,'','cumque nesciunt velit',NULL,'O\'Keefeburgh','08091 Madilyn Drive','803','',NULL,1,1,'2022-08-25 12:25:16','2022-08-25 12:25:16'),
(74,'','aut est et',NULL,'Ginostad','4790 Bruen Bypass','974','',NULL,1,1,'2022-08-25 12:25:17','2022-08-25 12:25:17'),
(75,'','laboriosam odit nam',NULL,'North Antoneview','5310 Leonel Mountains','243','',NULL,1,1,'2022-08-25 12:25:18','2022-08-25 12:25:18'),
(76,'','ut aut iusto',NULL,'Oro Valley','8215 Mae Field','523','',NULL,1,1,'2022-08-25 12:25:20','2022-08-25 12:25:20'),
(77,'','aut numquam quod',NULL,'Augustashire','2245 Abbigail Bridge','318','',NULL,1,1,'2022-08-25 12:25:26','2022-08-25 12:25:26'),
(78,'','reprehenderit veritatis illo',NULL,'New Meggie','849 Krajcik Mission','394','',NULL,1,1,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
(79,'','dignissimos voluptatum porro',NULL,'West Paxtonside','799 Heidenreich Crossing','966','',NULL,1,1,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
(80,'','quia qui eveniet',NULL,'Owenfort','08612 Lockman Wells','969','',NULL,1,1,'2022-08-25 12:25:32','2022-08-25 12:25:32'),
(81,'','rem omnis qui',NULL,'Helmerfort','00136 Roob Harbors','641','',NULL,1,1,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
(82,'','optio aperiam nesciunt',NULL,'South Roberta','032 Elsie Manors','99','',NULL,1,1,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
(83,'','sit nihil voluptatem',NULL,'Amandamouth','823 Gracie Valley','884','',NULL,1,1,'2022-08-25 12:25:35','2022-08-25 12:25:35'),
(84,'','corporis voluptatem quam',NULL,'Kenner','1565 O\'Kon Forges','709','',NULL,1,1,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
(85,'','eos nemo quis',NULL,'Brooklyn Park','96639 Myles Rapid','642','',NULL,1,1,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
(86,'','occaecati voluptas vel',NULL,'Milwaukee','336 Cali Pines','500','',NULL,1,1,'2022-08-25 12:25:37','2022-08-25 12:25:37'),
(87,'','autem in alias',NULL,'North Lenny','7828 Marcellus Trafficway','952','',NULL,1,1,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
(88,'','consectetur corrupti illo',NULL,'North Milo','125 Orval Isle','716','',NULL,1,1,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
(89,'','nulla asperiores porro',NULL,'East Delilahside','1202 Fahey Neck','65','',NULL,1,1,'2022-08-25 12:25:47','2022-08-25 12:25:47'),
(90,'','et velit id',NULL,'Flagstaff','61210 Adela Parkways','517','',NULL,1,1,'2022-08-25 12:25:48','2022-08-25 12:25:48'),
(91,'','consectetur veniam itaque',NULL,'Lake Narcisoburgh','125 Bartell Trail','848','',NULL,1,1,'2022-08-25 12:25:49','2022-08-25 12:25:49'),
(92,'','temporibus dicta in',NULL,'Hollismouth','4459 Schaden Stream','942','',NULL,1,1,'2022-08-25 12:25:50','2022-08-25 12:25:50');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `parent_category_id` (`parent_category_id`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `article_categories_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `article_categories` (`id`),
  CONSTRAINT `article_categories_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `article_categories_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_categories`
--

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;
INSERT INTO `article_categories` VALUES
(1,'nam natus eum',NULL,NULL,NULL,NULL,'2022-03-17 14:07:38','2022-08-03 20:32:36'),
(3,'aut sit asperiores','quam est odio',NULL,1,1,'2022-08-03 20:32:09','2022-08-03 20:32:09'),
(4,'voluptas est facere','sunt placeat voluptas',NULL,1,1,'2022-08-03 20:32:10','2022-08-03 20:32:10');
/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_prices`
--

DROP TABLE IF EXISTS `article_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `pricetype` char(3) NOT NULL,
  `price` decimal(13,2) DEFAULT NULL,
  `vat` decimal(6,2) DEFAULT NULL,
  `valid_from` datetime DEFAULT current_timestamp(),
  `valid_to` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_prices`
--

LOCK TABLES `article_prices` WRITE;
/*!40000 ALTER TABLE `article_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `ean` varchar(13) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `article_category_id` int(11) DEFAULT NULL,
  `price` decimal(13,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `suplier_customer_id` int(11) DEFAULT NULL,
  `manufacturer_customer_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `article_category_id` (`article_category_id`),
  KEY `suplier_customer_id` (`suplier_customer_id`),
  KEY `manufacturer_customer_id` (`manufacturer_customer_id`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`article_category_id`) REFERENCES `article_categories` (`id`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`suplier_customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`manufacturer_customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `articles_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `articles_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES
(1,'consequuntur iure maxime','1456479957971','cpy',1,149.00,'nihil ut ea',1,1,1,1,'2022-08-03 20:31:23','2022-08-03 20:31:23'),
(2,'velit qui doloremque','1881441281163','cpy',1,197.00,'deleniti dolores a',1,1,1,1,'2022-08-03 20:31:53','2022-08-03 20:31:53'),
(3,'dolores cum qui','1306693971173','cpy',1,377.00,'et sit deleniti',1,1,1,1,'2022-08-03 20:31:55','2022-08-03 20:31:55'),
(4,'nulla laborum voluptate','1940176480315','cpy',1,75.00,'architecto ad iure',1,1,1,1,'2022-08-03 20:31:56','2022-08-03 20:31:56');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counters` (
  `id` char(10) NOT NULL,
  `last_value` varchar(45) DEFAULT NULL,
  `last_requested` datetime DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  `counter_length` int(11) DEFAULT 6,
  `prefix_pattern` varchar(60) DEFAULT '',
  `suffix_pattern` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counters`
--

LOCK TABLES `counters` WRITE;
/*!40000 ALTER TABLE `counters` DISABLE KEYS */;
/*!40000 ALTER TABLE `counters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` char(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `currency_id` char(3) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `countries_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `countries_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES
('AD','ANDORRA ',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AE','UNITED ARAB EMIRATES',NULL,'AED',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('AF','AFGHANISTAN',NULL,'AFN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AG','ANTIGUA AND BARBUDA',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AI','ANGUILLA',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AL','ALBANIA',NULL,'ALL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AM','ARMENIA',NULL,'AMD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AN','NETHERLANDS ANTILLES',NULL,'ANG',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AO','ANGOLA',NULL,'AOA',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AQ','ANTARCTICA',NULL,'',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AR','ARGENTINA',NULL,'ARS',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AS','AMERICAN SAMOA',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AT','AUSTRIA',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AU','AUSTRALIA',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AW','ARUBA',NULL,'AWG',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('AZ','AZERBAIJAN',NULL,'AZM',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BA','BOSNIA AND HERZEGOVINA',NULL,'BAM',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BB','BARBADOS',NULL,'BBD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BD','BANGLADESH',NULL,'BDT',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BE','BELGIUM',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BF','BURKINA FASO',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BG','BULGARIA',NULL,'BGN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BH','BAHRAIN',NULL,'BHD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BI','BURUNDI',NULL,'BIF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BJ','BENIN',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BM','BERMUDA',NULL,'BMD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BN','BRUNEI DARUSSALAM',NULL,'BND',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BO','BOLIVIA',NULL,'BOB',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BR','BRAZIL',NULL,'BRL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BS','BAHAMAS',NULL,'BSD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BT','BHUTAN',NULL,'INR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BV','BOUVET ISLAND',NULL,'NOK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BW','BOTSWANA',NULL,'BWP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BY','BELARUS',NULL,'BYR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('BZ','BELIZE',NULL,'BZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CA','CANADA',NULL,'CAD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CC','COCOS (KEELING) ISLANDS',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CD','CONGO, THE DEMOCRATIC REPUBLIC OF',NULL,'CDF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CF','CENTRAL AFRICAN REPUBLIC',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CG','CONGO',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CH','SWITZERLAND',NULL,'CHF',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('CI','COTE D\'IVOIRE',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CK','COOK ISLANDS',NULL,'NZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CL','CHILE',NULL,'CLP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CM','CAMEROON',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CN','CHINA',NULL,'CNY',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CO','COLOMBIA',NULL,'COP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CR','COSTA RICA',NULL,'CRC',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CS','SERBIA & MONTENEGRO',NULL,'CSD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CU','CUBA',NULL,'CUP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CV','CAPE VERDE',NULL,'CVE',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CX','CHRISTMAS ISLAND',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CY','CYPRUS',NULL,'CYP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('CZ','CZECH REPUBLIC',NULL,'CZK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DE','GERMANY',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DJ','DJIBOUTI',NULL,'DJF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DK','DENMARK',NULL,'DKK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DM','DOMINICA',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DO','DOMINICAN REPUBLIC',NULL,'DOP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('DZ','ALGERIA',NULL,'DZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('EC','ECUADOR',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('EE','ESTONIA',NULL,'EEK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('EG','EGYPT',NULL,'EGP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('EH','WESTERN SAHARA',NULL,'MAD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('ER','ERITREA',NULL,'ERN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ES','SPAIN',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ET','ETHIOPIA',NULL,'ETB',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FI','FINLAND ',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FJ','FIJI',NULL,'FJD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FK','FALKLAND ISLANDS (MALVINAS)',NULL,'FKP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FM','MICRONESIA, FEDERATED STATES OF',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FO','FAROE ISLANDS',NULL,'DKK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('FR','FRANCE',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GA','GABON',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GB','UNITED KINGDOM',NULL,'GBP',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('GD','GRENADA',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GE','GEORGIA',NULL,'GEL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GF','FRENCH GUIANA ',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GH','GHANA',NULL,'GHC',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GI','GIBRALTAR',NULL,'GIP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GL','GREENLAND',NULL,'DKK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GM','GAMBIA',NULL,'GMD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GN','GUINEA',NULL,'GNF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GP','GUADELOUPE',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GQ','EQUATORIAL GUINEA',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GR','GREECE',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GS','SOUTH GEORGIA & THE SOUTH SANDWICH ISLANDS',NULL,'',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GT','GUATEMALA',NULL,'GTQ',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GU','GUAM',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GW','GUINEA-BISSAU',NULL,'GWP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('GY','GUYANA',NULL,'GYD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HK','HONG KONG',NULL,'HKD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HM','HEARD ISLAND AND MCDONALD ISLANDS',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HN','HONDURAS',NULL,'HNL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HR','CROATIA',NULL,'HRK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HT','HAITI',NULL,'HTG',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('HU','HUNGARY',NULL,'HUF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ID','INDONESIA',NULL,'IDR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IE','IRELAND',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IL','ISRAEL',NULL,'ILS',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IN','INDIA',NULL,'INR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IO','BRITISH INDIAN OCEAN TERRITORY',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IQ','IRAQ',NULL,'IQD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IR','IRAN, ISLAMIC REPUBLIC OF',NULL,'IRR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IS','ICELAND',NULL,'ISK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('IT','ITALY',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('JM','JAMAICA',NULL,'JMD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('JO','JORDAN',NULL,'JOD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('JP','JAPAN',NULL,'JPY',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KE','KENYA',NULL,'KES',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KG','KYRGYZSTAN',NULL,'KGS',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KH','CAMBODIA',NULL,'KHR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KI','KIRIBATI',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KM','COMOROS',NULL,'KMF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KN','SAINT KITTS AND NEVIS',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF',NULL,'KPW',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KR','KOREA, REPUBLIC OF',NULL,'KRW',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KW','KUWAIT',NULL,'KWD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KY','CAYMAN ISLANDS',NULL,'KYD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('KZ','KAZAKHSTAN',NULL,'KZT',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC',NULL,'LAK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LB','LEBANON',NULL,'LBP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LC','SAINT LUCIA',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LI','LIECHTENSTEIN',NULL,'CHF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LK','SRI LANKA',NULL,'LKR',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('LR','LIBERIA',NULL,'LRD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LS','LESOTHO',NULL,'ZAR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LT','LITHUANIA',NULL,'LTL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LU','LUXEMBOURG',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LV','LATVIA',NULL,'LVL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('LY','LIBYAN ARAB JAMAHIRIYA',NULL,'LYD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MA','MOROCCO',NULL,'MAD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MC','MONACO',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MD','MOLDOVA, REPUBLIC OF',NULL,'MDL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MG','MADAGASCAR',NULL,'MGA',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MH','MARSHALL ISLANDS',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',NULL,'MKD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ML','MALI',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MM','MYANMAR',NULL,'MMK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MN','MONGOLIA',NULL,'MNT',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MO','MACAO',NULL,'MOP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MP','NORTHERN MARIANA ISLANDS',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MQ','MARTINIQUE',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MR','MAURITANIA',NULL,'MRO',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MS','MONTSERRAT',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MT','MALTA',NULL,'MTL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MU','MAURITIUS',NULL,'MUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MV','MALDIVES',NULL,'MVR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MW','MALAWI',NULL,'MWK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MX','MEXICO',NULL,'MXN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MY','MALAYSIA',NULL,'MYR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('MZ','MOZAMBIQUE',NULL,'MZM',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NA','NAMIBIA',NULL,'ZAR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NC','NEW CALEDONIA',NULL,'XPF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NE','NIGER',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NF','NORFOLK ISLAND',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NG','NIGERIA',NULL,'NGN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NI','NICARAGUA',NULL,'NIO',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NL','NETHERLANDS',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NO','NORWAY',NULL,'NOK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NP','NEPAL',NULL,'NPR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NR','NAURU',NULL,'AUD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NU','NIUE',NULL,'NZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('NZ','NEW ZEALAND',NULL,'NZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('OM','OMAN',NULL,'OMR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PA','PANAMA',NULL,'PAB',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PE','PERU',NULL,'PEN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PF','FRENCH POLYNESIA',NULL,'XPF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PG','PAPUA NEW GUINEA',NULL,'PGK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PH','PHILIPPINES',NULL,'PHP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PK','PAKISTAN',NULL,'PKR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PL','POLAND',NULL,'PLN',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PM','SAINT PIERRE AND MIQUELON',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PN','PITCAIRN',NULL,'NZD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PR','PUERTO RICO',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PS','PALESTINIAN TERRITORY, OCCUPIED',NULL,'',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PT','PORTUGAL',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PW','PALAU',NULL,'USD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('PY','PARAGUAY',NULL,'PYG',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('QA','QATAR',NULL,'QAR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('RE','REUNION',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('RO','ROMANIA',NULL,'ROL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('RU','RUSSIAN FEDERATION',NULL,'RUB',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('RW','RWANDA',NULL,'RWF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SA','SAUDI ARABIA',NULL,'SAR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SB','SOLOMON ISLANDS',NULL,'SBD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SC','SEYCHELLES',NULL,'SCR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SD','SUDAN',NULL,'SDD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('SE','SWEDEN',NULL,'SEK',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('SG','SINGAPORE',NULL,'SGD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SH','SAINT HELENA',NULL,'SHP',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SI','SLOVENIA',NULL,'SIT',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SJ','SVALBARD AND JAN MAYEN',NULL,'NOK',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('SK','SLOVAKIA',NULL,'SKK',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SL','SIERRA LEONE',NULL,'SLL',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SM','SAN MARINO',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SN','SENEGAL',NULL,'XOF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SO','SOMALIA',NULL,'SOS',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SR','SURINAME',NULL,'SRD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('ST','SAO TOME AND PRINCIPE',NULL,'STD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SV','EL SALVADOR',NULL,'SVC',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('SY','SYRIAN ARAB REPUBLIC',NULL,'SYP',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('SZ','SWAZILAND',NULL,'SZL',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TC','TURKS AND CAICOS ISLANDS',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TD','CHAD',NULL,'XAF',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('TF','FRENCH SOUTHERN TERRITORIES',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('TG','TOGO',NULL,'XOF',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TH','THAILAND',NULL,'THB',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TJ','TAJIKISTAN',NULL,'TJS',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TK','TOKELAU',NULL,'NZD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TL','TIMOR-LESTE',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TM','TURKMENISTAN',NULL,'TMM',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TN','TUNISIA',NULL,'TND',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TO','TONGA',NULL,'TOP',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TR','TURKEY',NULL,'TRL',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TT','TRINIDAD AND TOBAGO',NULL,'TTD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TV','TUVALU',NULL,'AUD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TW','TAIWAN, PROVINCE OF CHINA',NULL,'TWD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('TZ','TANZANIA, UNITED REPUBLIC OF',NULL,'TZS',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('UA','UKRAINE',NULL,'UAH',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('UG','UGANDA',NULL,'UGX',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('UM','UNITED STATES MINOR OUTLYING ISLANDS',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('US','UNITED STATES',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('UY','URUGUAY',NULL,'UYU',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('UZ','UZBEKISTAN',NULL,'UZS',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('VA','HOLY SEE (VATICAN CITY STATE)',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('VC','SAINT VINCENT AND THE GRENADINES',NULL,'XCD',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('VE','VENEZUELA',NULL,'VEB',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('VG','VIRGIN ISLANDS, BRITISH',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('VI','VIRGIN ISLANDS, U.S.',NULL,'USD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('VN','VIET NAM',NULL,'VND',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('VU','VANUATU',NULL,'VUV',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('WF','WALLIS AND FUTUNA',NULL,'XPF',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('WS','SAMOA',NULL,'WST',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('YE','YEMEN',NULL,'YER',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('YT','MAYOTTE',NULL,'EUR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ZA','SOUTH AFRICA',NULL,'ZAR',1,1,'2022-08-03 20:33:25','2022-08-03 20:33:25'),
('ZM','ZAMBIA',NULL,'ZMK',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26'),
('ZW','ZIMBABWE',NULL,'ZWD',1,1,'2022-08-03 20:33:26','2022-08-03 20:33:26');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` char(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minor_unit` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES
('AED','UAE Dirham',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AFN','Afghani',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ALL','Lek',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AMD','Armenian Dram',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ANG','Netherlands Antillan Guilder',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AOA','Kwanza',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ARS','Argentine Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AUD','Australian Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AWG','Aruban Guilder',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('AZM','Azerbaijanian Manat',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BAM','Convertible Marks',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BBD','Barbados Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BDT','Taka',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BGN','Bulgarian Lev',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BHD','Bahraini Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BIF','Burundi Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BMD','Bermudian Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BND','Brunei Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BOB','Boliviano',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BOV','Mvdol',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BRL','Brazilian Real',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BSD','Bahamian Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BTN','Ngultrum',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BWP','Pula',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BYR','Belarussian Ruble',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('BZD','Belize Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CAD','Canadian Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CDF','Franc Congolais',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CHF','Swiss Franc',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CLF','Unidades de fomento',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CLP','Chilean Peso',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CNY','Yuan Renminbi',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('COP','Colombian Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('COU','Unidad de Valor Real',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CRC','Costa Rican Colon',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CSD','Serbian Dinar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CUP','Cuban Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CVE','Cape Verde Escudo',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CYP','Cyprus Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('CZK','Czech Koruna',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('DJF','Djibouti Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('DKK','Danish Krone',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('DOP','Dominican Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('DZD','Algerian Dinar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('EEK','Kroon',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('EGP','Egyptian Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ERN','Nakfa',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ETB','Ethiopian Birr',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('EUR','Euro',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('FJD','Fiji Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('FKP','Falkland Islands Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GBP','Pound Sterling',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GEL','Lari',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GHC','Cedi',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GIP','Gibraltar Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GMD','Dalasi',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GNF','Guinea Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GTQ','Quetzal',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GWP','Guinea-Bissau Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('GYD','Guyana Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('HKD','Hong Kong Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('HNL','Lempira',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('HRK','Croatian kuna',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('HTG','Gourde',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('HUF','Forint',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('IDR','Rupiah',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ILS','New Israeli Sheqel',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('INR','Indian Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('IQD','Iraqi Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('IRR','Iranian Rial',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ISK','Iceland Krona',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('JMD','Jamaican Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('JOD','Jordanian Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('JPY','Yen',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KES','Kenyan Shilling',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KGS','Som',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KHR','Riel',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KMF','Comoro Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KPW','North Korean Won',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KRW','Won',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KWD','Kuwaiti Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KYD','Cayman Islands Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('KZT','Tenge',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LAK','Kip',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LBP','Lebanese Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LKR','Sri Lanka Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LRD','Liberian Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LSL','Loti',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LTL','Lithuanian Litas',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LVL','Latvian Lats',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('LYD','Lybian Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MAD','Moroccan Dirham',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MDL','Moldovan Leu',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MGA','Ariary',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MGF','Malagasy Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MKD','Denar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MMK','Kyat',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MNT','Tugrik',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MOP','Pataca',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MRO','Ouguiya',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MTL','Maltese Lira',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MUR','Mauritius Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MVR','Rufiyaa',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MWK','Kwacha',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MXN','Mexican Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MXV','Mexican Unidad de Inversion (UDI)',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MYR','Malaysian Ringgit',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('MZM','Metical',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NAD','Namibia Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NGN','Naira',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NIO','Cordoba Oro',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NOK','Norvegian Krone',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NPR','Nepalese Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('NZD','New Zealand Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('OMR','Rial Omani',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PAB','Balboa',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PEN','Nuevo Sol',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PGK','Kina',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PHP','Philippine Peso',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PKR','Pakistan Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PLN','Zloty',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('PYG','Guarani',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('QAR','Qatari Rial',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ROL','Leu',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('RUB','Russian Ruble',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('RUR','Russian Ruble',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('RWF','Rwanda Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SAR','Saudi Riyal',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SBD','Solomon Islands Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SCR','Seychelles Rupee',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SDD','Sudanese Dinar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SEK','Swedish Krona',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SGD','Singapore Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SHP','Saint Helena Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SIT','Tolar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SKK','Slovak Koruna',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SLL','Leone',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SOS','Somali Shilling',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SRD','Suriname Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('STD','Dobra',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SVC','El Salvador Colon',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SYP','Syrian Pound',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('SZL','Lilangeni',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('THB','Baht',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TJS','Somoni',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TMM','Manat',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TND','Tunisian Dinar',3,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TOP','Pa?anga',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TRL','Turkish Lira',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TTD','Trinidad and Tobago Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TWD','New Taiwan Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('TZS','Tanzanian Shilling',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('UAH','Hryvnia',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('UGX','Uganda Shilling',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('USD','US Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('USN','US Dollar (Next day)',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('USS','US Dollar (Same day)',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('UYU','Peso Uruguayo',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('UZS','Uzbekistan Sum',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('VEB','Bolivar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('VND','Dong',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('VUV','Vatu',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('WST','Tala',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('XAF','CFA Franc BEAC',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('XCD','East Carribbean Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('XOF','CFA Franc BCEAO',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('XPF','CFP Franc',0,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('YER','Yemeni Rial',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ZAR','Rand',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ZMK','Kwacha',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19'),
('ZWD','Zimbabwe Dollar',2,NULL,1,1,'2022-08-03 20:33:19','2022-08-03 20:33:19');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_categories`
--

DROP TABLE IF EXISTS `customer_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_categories`
--

LOCK TABLES `customer_categories` WRITE;
/*!40000 ALTER TABLE `customer_categories` DISABLE KEYS */;
INSERT INTO `customer_categories` VALUES
(2,'illo similique rerum','voluptatem rerum officiis',NULL,1,1,'2022-03-17 14:39:46','2022-08-03 20:31:06'),
(3,'blanditiis est qui','ut est tempora',NULL,1,1,'2022-08-03 20:30:47','2022-08-03 20:30:47');
/*!40000 ALTER TABLE `customer_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `customer_category_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `customertype` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  KEY `customer_category_id` (`customer_category_id`),
  KEY `shipping_address_id` (`shipping_address_id`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`customer_category_id`) REFERENCES `customer_categories` (`id`),
  CONSTRAINT `customers_ibfk_3` FOREIGN KEY (`shipping_address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `customers_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `customers_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1,'Koelpin - Schroeder','Kaitlyn_Kuphal86@hotmail.com',35,NULL,36,'id recusandae aut',NULL,1,1,'2022-03-20 19:06:24','2022-03-20 19:06:24'),
(2,'Zboncak, Lakin and Schulist','Dee4@hotmail.com',37,NULL,38,'explicabo quis sit',NULL,1,1,'2022-03-20 19:06:25','2022-03-20 19:06:25'),
(3,'Pagac, Dickens and McKenzie','Leatha_Hackett70@hotmail.com',39,NULL,40,'harum autem dicta',NULL,1,1,'2022-03-20 19:06:26','2022-03-20 19:06:26'),
(4,'Hintz - Streich','Kellen68@yahoo.com',41,NULL,42,'inventore sit aperiam',NULL,1,1,'2022-03-20 19:06:28','2022-03-20 19:06:28'),
(5,'Kiehn - Huel','Royce_Walter@gmail.com',43,NULL,44,'ex harum dolores',NULL,1,1,'2022-03-20 19:06:29','2022-03-20 19:06:29'),
(6,'Hegmann, Davis and Lowe','Laurel.Feest@yahoo.com',45,NULL,46,'facilis magnam hic',NULL,1,1,'2022-03-20 19:06:30','2022-03-20 19:06:30'),
(7,'Lakin and Sons','Jack_VonRueden24@yahoo.com',47,NULL,48,'id inventore est',NULL,1,1,'2022-03-20 19:07:30','2022-03-20 19:07:30'),
(8,'Osinski, Zieme and Welch','Adolf.Harris29@yahoo.com',49,NULL,50,'quo explicabo blanditiis',NULL,1,1,'2022-03-20 19:07:31','2022-03-20 19:07:31'),
(9,'Stokes, Kilback and Dietrich','Stanford.Cassin18@gmail.com',53,NULL,54,'voluptate blanditiis dolores',NULL,1,1,'2022-08-03 20:26:05','2022-08-03 20:26:05'),
(10,'Dicki LLC','Greta39@hotmail.com',55,NULL,56,'vero expedita nostrum',NULL,1,1,'2022-08-03 20:26:33','2022-08-03 20:26:33'),
(11,'Legros - Thompson mod 11','Virgie_Barrows@gmail.com',57,NULL,58,'corrupti quis in mod',NULL,1,1,'2022-08-03 20:26:36','2022-08-03 20:26:44');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `has_right`
--

DROP TABLE IF EXISTS `has_right`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `has_right` (
  `userright_id` varchar(20) NOT NULL,
  `usergroup_id` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userright_id`,`usergroup_id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  KEY `usergroup_id` (`usergroup_id`),
  CONSTRAINT `has_right_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `has_right_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `has_right_ibfk_3` FOREIGN KEY (`userright_id`) REFERENCES `userrights` (`id`),
  CONSTRAINT `has_right_ibfk_4` FOREIGN KEY (`usergroup_id`) REFERENCES `usergroups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `has_right`
--

LOCK TABLES `has_right` WRITE;
/*!40000 ALTER TABLE `has_right` DISABLE KEYS */;
INSERT INTO `has_right` VALUES
('admin','admin',NULL,NULL,'2022-08-20 16:28:50','2022-08-20 16:28:50'),
('articles','sales',NULL,NULL,'2022-08-20 16:28:51','2022-08-20 16:28:51'),
('customers','sales',NULL,NULL,'2022-08-20 16:28:52','2022-08-20 16:28:52'),
('guest','guest',NULL,NULL,'2022-08-20 16:28:50','2022-08-20 16:28:50');
/*!40000 ALTER TABLE `has_right` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_of_group`
--

DROP TABLE IF EXISTS `member_of_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_of_group` (
  `usergroup_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`,`usergroup_id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  KEY `usergroup_id` (`usergroup_id`),
  CONSTRAINT `member_of_group_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `member_of_group_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `member_of_group_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `member_of_group_ibfk_4` FOREIGN KEY (`usergroup_id`) REFERENCES `usergroups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_of_group`
--

LOCK TABLES `member_of_group` WRITE;
/*!40000 ALTER TABLE `member_of_group` DISABLE KEYS */;
INSERT INTO `member_of_group` VALUES
('admin',1,NULL,NULL,'2022-08-20 16:28:43','2022-08-20 16:28:43'),
('guest',1,NULL,NULL,'2022-08-20 16:28:44','2022-08-20 16:28:44'),
('guest',13,NULL,NULL,'2022-08-20 16:28:44','2022-08-20 16:28:44'),
('sales',13,NULL,NULL,'2022-08-20 16:28:47','2022-08-20 16:28:47'),
('admin',17,NULL,NULL,'2022-08-20 16:28:22','2022-08-20 16:28:22'),
('guest',17,NULL,NULL,'2022-08-20 16:28:22','2022-08-20 16:28:22'),
('admin',31,NULL,NULL,'2022-08-25 12:25:14','2022-08-25 12:25:14'),
('sales',31,NULL,NULL,'2022-08-25 12:25:14','2022-08-25 12:25:14'),
('admin',32,NULL,NULL,'2022-08-25 12:25:15','2022-08-25 12:25:15'),
('sales',32,NULL,NULL,'2022-08-25 12:25:15','2022-08-25 12:25:15'),
('admin',33,NULL,NULL,'2022-08-25 12:25:16','2022-08-25 12:25:16'),
('sales',33,NULL,NULL,'2022-08-25 12:25:16','2022-08-25 12:25:16'),
('admin',34,NULL,NULL,'2022-08-25 12:25:17','2022-08-25 12:25:17'),
('sales',34,NULL,NULL,'2022-08-25 12:25:17','2022-08-25 12:25:17'),
('admin',35,NULL,NULL,'2022-08-25 12:25:18','2022-08-25 12:25:18'),
('sales',35,NULL,NULL,'2022-08-25 12:25:18','2022-08-25 12:25:18'),
('admin',36,NULL,NULL,'2022-08-25 12:25:20','2022-08-25 12:25:20'),
('sales',36,NULL,NULL,'2022-08-25 12:25:20','2022-08-25 12:25:20'),
('sales',37,NULL,NULL,'2022-08-25 12:25:26','2022-08-25 12:25:26'),
('sales',38,NULL,NULL,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
('sales',39,NULL,NULL,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
('sales',40,NULL,NULL,'2022-08-25 12:25:32','2022-08-25 12:25:32'),
('sales',41,NULL,NULL,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
('sales',42,NULL,NULL,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
('sales',43,NULL,NULL,'2022-08-25 12:25:35','2022-08-25 12:25:35'),
('sales',44,NULL,NULL,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
('sales',45,NULL,NULL,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
('sales',46,NULL,NULL,'2022-08-25 12:25:37','2022-08-25 12:25:37'),
('sales',47,NULL,NULL,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
('sales',48,NULL,NULL,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
('sales',49,NULL,NULL,'2022-08-25 12:25:47','2022-08-25 12:25:47'),
('sales',50,NULL,NULL,'2022-08-25 12:25:48','2022-08-25 12:25:48'),
('sales',51,NULL,NULL,'2022-08-25 12:25:49','2022-08-25 12:25:49'),
('sales',52,NULL,NULL,'2022-08-25 12:25:50','2022-08-25 12:25:50');
/*!40000 ALTER TABLE `member_of_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_lines`
--

DROP TABLE IF EXISTS `receipt_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `qty` decimal(13,2) DEFAULT NULL,
  `price` decimal(13,2) DEFAULT NULL,
  `vat` decimal(6,2) DEFAULT NULL,
  `rabat` decimal(6,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `receipt_id` (`receipt_id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `receipt_lines_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `receipt_lines_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`),
  CONSTRAINT `receipt_lines_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `receipt_lines_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_lines`
--

LOCK TABLES `receipt_lines` WRITE;
/*!40000 ALTER TABLE `receipt_lines` DISABLE KEYS */;
INSERT INTO `receipt_lines` VALUES
(1,3,4,32.00,240.00,27.00,10.00,1,1,'2022-08-04 19:51:22','2022-08-04 19:51:22'),
(2,3,1,257.00,240.00,27.00,10.00,1,1,'2022-08-04 20:03:48','2022-08-04 20:03:48'),
(3,3,1,202.00,240.00,27.00,10.00,1,1,'2022-08-04 20:13:00','2022-08-04 20:13:00');
/*!40000 ALTER TABLE `receipt_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptnumber` varchar(45) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `duedate` datetime DEFAULT NULL,
  `receipttype` char(3) DEFAULT NULL,
  `value` decimal(13,2) DEFAULT 0.00,
  `vat_value` decimal(13,2) DEFAULT 0.00,
  `currency_id` char(3) DEFAULT 'EUR',
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `currency_id` (`currency_id`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `receipts_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `receipts_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `receipts_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` VALUES
(3,'ORD-000001/2022',1,'2022-02-26 10:11:22','ORD',0.00,0.00,'EUR','Flat pricing',1,1,'2022-08-04 19:25:18','2022-08-04 19:25:18');
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `id` char(3) NOT NULL,
  `stock_type` char(3) NOT NULL,
  `storage_space` char(13) NOT NULL,
  `article_id` int(11) NOT NULL,
  `qty` decimal(13,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_types`
--

DROP TABLE IF EXISTS `stock_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_types` (
  `id` char(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_types`
--

LOCK TABLES `stock_types` WRITE;
/*!40000 ALTER TABLE `stock_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage_spaces`
--

DROP TABLE IF EXISTS `storage_spaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage_spaces` (
  `id` char(13) NOT NULL,
  `storage_type` char(3) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage_spaces`
--

LOCK TABLES `storage_spaces` WRITE;
/*!40000 ALTER TABLE `storage_spaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `storage_spaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_types` (
  `id` char(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `reference_on` char(3) DEFAULT '',
  `reference_required` tinyint(1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_types`
--

LOCK TABLES `transaction_types` WRITE;
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS `usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usergroups` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usergroups`
--

LOCK TABLES `usergroups` WRITE;
/*!40000 ALTER TABLE `usergroups` DISABLE KEYS */;
INSERT INTO `usergroups` VALUES
('admin','admin group',NULL,NULL,NULL,'2022-08-20 11:29:06','2022-08-20 11:29:06'),
('guest','guests1',NULL,NULL,NULL,'2022-08-20 11:28:59','2022-08-20 11:28:59'),
('sales','sales group',NULL,NULL,NULL,'2022-08-20 11:36:45','2022-08-20 11:36:45');
/*!40000 ALTER TABLE `usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrights`
--

DROP TABLE IF EXISTS `userrights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrights` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrights`
--

LOCK TABLES `userrights` WRITE;
/*!40000 ALTER TABLE `userrights` DISABLE KEYS */;
INSERT INTO `userrights` VALUES
('admin','admin rights',NULL,NULL,NULL,'2022-08-20 11:28:53','2022-08-20 11:28:53'),
('articles','articles rights',NULL,NULL,NULL,'2022-08-20 11:38:54','2022-08-20 11:38:54'),
('customers','customer rights',NULL,NULL,NULL,'2022-08-20 11:37:36','2022-08-20 11:37:36'),
('guest','guest rights',NULL,NULL,NULL,'2022-08-20 11:28:56','2022-08-20 11:28:56');
/*!40000 ALTER TABLE `userrights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'test','Koelpin - Schroeder','tset_111@test.com',NULL,'test',NULL,NULL,NULL,1,'2022-03-17 14:07:38','2022-05-08 13:04:30'),
(10,'Lydia29','Leonard Murazik','tset_300@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 09:39:12','2022-05-07 09:39:12'),
(11,'Hayley_Roberts','Randall Harvey','tset_973@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 09:41:36','2022-05-07 09:41:36'),
(13,'Martina.Runolfsdotti','Robin Reilly','tset_183@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 21:15:11','2022-05-07 21:15:11'),
(14,'Casper39','Carol Jaskolski','tset_288@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 21:15:13','2022-05-07 21:15:13'),
(15,'Camron40','Heather Mills','tset_57@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 21:15:14','2022-05-07 21:15:14'),
(16,'Astrid_Hoppe','Joy Okuneva','tset_198@test.com',NULL,NULL,NULL,NULL,1,1,'2022-05-07 21:15:17','2022-05-07 21:15:17'),
(17,'userVelva60_m','Ms. Eino Lemke','test_272@test.com','1975-03-02','usersolution155',51,NULL,1,1,'2022-08-02 18:35:32','2022-08-20 19:10:44'),
(18,'userNathaniel.Beier1','Mr. Wilfrid Little','test_662@test.com','1983-02-01','userQuality523',52,NULL,1,1,'2022-08-03 20:23:55','2022-08-03 20:23:55'),
(19,'userDoyle2','Ms. Emanuel Schoen','test_226@test.com','1983-02-01','userRubber292',59,NULL,1,1,'2022-08-19 17:24:39','2022-08-19 17:24:39'),
(20,'userClifford.Breiten','Miss Alexys Barrows','test_601@test.com','1983-02-01','userCOM911',60,NULL,1,1,'2022-08-19 20:51:45','2022-08-19 20:51:45'),
(21,'userAdriel55','Mr. Antonina Jast','test_295@test.com','1983-02-01','usermobile780',61,NULL,1,1,'2022-08-20 11:22:54','2022-08-20 11:22:54'),
(22,'userBetsy4','Mrs. Shakira Cassin','test_112@test.com','1983-02-01','userindexing339',62,NULL,1,1,'2022-08-20 12:02:06','2022-08-20 12:02:06'),
(23,'userJerry_Wiza49','Miss Barney Schneider','test_342@test.com','1983-02-01','usersensor415',63,NULL,1,1,'2022-08-20 12:03:21','2022-08-20 12:03:21'),
(30,'userChaya.Romaguera','Ms. Kathryn Medhurst','test_568@test.com','1983-02-01','userAccount242',70,NULL,1,1,'2022-08-20 12:20:08','2022-08-20 12:20:08'),
(31,'userJaquan_Haag','Ms. Oran Botsford','test_347@test.com','1983-02-01','usergeneration959',71,NULL,1,1,'2022-08-25 12:25:14','2022-08-25 12:25:14'),
(32,'userShana.Zulauf42','Dr. Forrest Gaylord','test_594@test.com','1983-02-01','userproductize89',72,NULL,1,1,'2022-08-25 12:25:15','2022-08-25 12:25:15'),
(33,'userGeorgianna.McClu','Mr. Myrl Anderson','test_517@test.com','1983-02-01','userSmall782',73,NULL,1,1,'2022-08-25 12:25:16','2022-08-25 12:25:16'),
(34,'userVeda.Gleichner','Mr. Catalina Swaniawski','test_646@test.com','1983-02-01','userTable511',74,NULL,1,1,'2022-08-25 12:25:17','2022-08-25 12:25:17'),
(35,'userDanika24','Ms. Jules Batz','test_971@test.com','1983-02-01','userChair746',75,NULL,1,1,'2022-08-25 12:25:18','2022-08-25 12:25:18'),
(36,'userCoralie31','Dr. Jaylan Wilderman','test_10@test.com','1983-02-01','userback419',76,NULL,1,1,'2022-08-25 12:25:20','2022-08-25 12:25:20'),
(37,'userMakayla.Marquard','Ms. Cristobal Hermiston','test_855@test.com','1983-02-01','userInternal815',77,NULL,1,1,'2022-08-25 12:25:26','2022-08-25 12:25:26'),
(38,'userGracie.Grant54','Ms. Ernesto Bayer','test_386@test.com','1983-02-01','userIncredible120',78,NULL,1,1,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
(39,'userRichard.Jenkins5','Mrs. Ramona Wiza','test_936@test.com','1983-02-01','userCambridgeshire917',79,NULL,1,1,'2022-08-25 12:25:28','2022-08-25 12:25:28'),
(40,'userChris.Rowe51','Mrs. Fae Rowe','test_258@test.com','1973-02-01','uservirtual753',80,NULL,1,1,'2022-08-25 12:25:32','2022-08-25 12:25:32'),
(41,'userAdolphus_Conn','Mrs. Jessyca Wiegand','test_2@test.com','1973-02-01','userPound337',81,NULL,1,1,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
(42,'userDerek92','Ms. Ahmad Hand','test_866@test.com','1973-02-01','userutilisation608',82,NULL,1,1,'2022-08-25 12:25:34','2022-08-25 12:25:34'),
(43,'userMaximilian.Denes','Miss Lindsay Lind','test_695@test.com','1973-02-01','userSwedish5',83,NULL,1,1,'2022-08-25 12:25:35','2022-08-25 12:25:35'),
(44,'userKamren85','Mr. Jolie Schimmel','test_544@test.com','1973-02-01','userHandmade623',84,NULL,1,1,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
(45,'userDonnie.OConner14','Mr. Ben Pollich','test_795@test.com','1973-02-01','userFantastic454',85,NULL,1,1,'2022-08-25 12:25:36','2022-08-25 12:25:36'),
(46,'userKarina_Murphy','Mr. Maritza Oberbrunner','test_842@test.com','1973-02-01','userNevada735',86,NULL,1,1,'2022-08-25 12:25:37','2022-08-25 12:25:37'),
(47,'userClare.Torphy8','Dr. Glennie Gerhold','test_904@test.com','1973-02-01','userFish940',87,NULL,1,1,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
(48,'userGwendolyn.Mayert','Mr. Turner Thompson','test_938@test.com','1973-02-01','userVirtual318',88,NULL,1,1,'2022-08-25 12:25:41','2022-08-25 12:25:41'),
(49,'userMarian17','Miss Deonte Ferry','test_382@test.com','1973-02-01','userLegacy98',89,NULL,1,1,'2022-08-25 12:25:47','2022-08-25 12:25:47'),
(50,'userDianna_Witting','Mr. Westley Kilback','test_944@test.com','1973-02-01','userChair329',90,NULL,1,1,'2022-08-25 12:25:48','2022-08-25 12:25:48'),
(51,'userGarry1','Ms. Bridgette Pfeffer','test_207@test.com','1973-02-01','usertransmitter311',91,NULL,1,1,'2022-08-25 12:25:49','2022-08-25 12:25:49'),
(52,'userKaya.Beahan','Miss Terrill MacGyver','test_963@test.com','1973-02-01','userMarketing547',92,NULL,1,1,'2022-08-25 12:25:50','2022-08-25 12:25:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-28 19:15:37
