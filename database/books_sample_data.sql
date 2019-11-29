-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: books
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB-0+deb9u1

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `cover_url` varchar(200) DEFAULT NULL,
  `uploader_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_uploader_idx` (`uploader_id`),
  KEY `fk_book_category1_idx` (`category_id`),
  CONSTRAINT `fk_book_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_uploader` FOREIGN KEY (`uploader_id`) REFERENCES `uploader` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (82,'C Programming Language','Jack Edwina',2000,'uploads/images/10-C-Programming-Language.jpg',10,5,'uploads/files/10-baitapon.pdf'),(83,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/10-javaforbengginer.jpg',10,5,'uploads/files/10-baitapon.pdf'),(84,'Fantastic Code In Bath Room','Jack Edwina',2011,'uploads/images/10-9781138626706.jpg',10,6,'uploads/files/10-baitapon.pdf'),(85,'Fantastic Code In Bath Room','Jack Edwina',2000,'uploads/images/14-3081cd96e225007b5934.jpg',14,6,'uploads/files/14-baitapon.pdf'),(86,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/11-javaforbengginer.jpg',11,6,'uploads/files/11-baitapon.pdf'),(87,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/11-Introduction-to-Combinatorics.jpg',11,5,'uploads/files/11-bi-tp-chng-2.pdf'),(88,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/11-C-Programming-Language.jpg',11,5,'uploads/files/11-baitapon.pdf'),(89,'C Programming Language','Ngoan Tran',2000,'uploads/images/11-9781138626706.jpg',11,5,'uploads/files/11-baitapon.pdf'),(90,'C Programming Language','Jack Edwina',0000,'uploads/images/11-Discrete-Mathematics-and-Its-Applications-Seventh-Edition.jpg',11,7,'uploads/files/11-baitapon.pdf'),(91,'C Programming Language','Richard Grimmett',2000,'uploads/images/11-javaforbengginer.jpg',11,7,'uploads/files/11-bi-tp-chng-2.pdf'),(92,'C Programming Language','Richard Grimmett',0000,'uploads/images/11-9781138626706.jpg',11,7,'uploads/files/11-baitapon.pdf'),(93,'C Programming Language','Maja Olejniczak',2000,'uploads/images/11-bai-tap-box-model-buoc-1.png',11,7,'uploads/files/11-baitapon.pdf'),(94,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/11-Introduction-to-Combinatorics.jpg',11,6,'uploads/files/11-baitapon.pdf'),(95,'Lap trinh Java','Jack Edwina',2000,'uploads/images/10-Discrete-Mathematics-and-Its-Applications-Seventh-Edition.jpg',10,7,'uploads/files/10-baitapon.pdf'),(96,'Lap trinh Java','Jack Edwina',2000,'uploads/images/10-C-Programming-Language.jpg',10,7,'uploads/files/10-baitapon.pdf'),(97,'Lap trinh Java','Maja Olejniczak',2000,'uploads/images/10-9781138626706.jpg',10,7,'uploads/files/10-baitapon.pdf'),(98,'C Programming Language','Richard Grimmett',2000,'uploads/images/10-javaforbengginer.jpg',10,7,'uploads/files/10-baitapon.pdf'),(99,'Lap trinh Java','Richard Grimmett',2000,'uploads/images/10-Discrete-Mathematics-and-Its-Applications-Seventh-Edition.jpg',10,7,'uploads/files/10-baitapon.pdf'),(100,'C Programming Language','Maja Olejniczak',2000,'uploads/images/10-C-Programming-Language.jpg',10,7,'uploads/files/10-baitapon.pdf'),(101,'C Programming Language','Maja Olejniczak',2000,'uploads/images/10-Introduction-to-Combinatorics.jpg',10,7,'uploads/files/10-baitapon.pdf'),(102,'Lap trinh Java','Jack Edwina',2000,'uploads/images/10-Discrete-Mathematics-and-Its-Applications-Seventh-Edition.jpg',10,7,'uploads/files/10-baitapon.pdf');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (7,'abc'),(6,'Art'),(5,'Computer Science');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploader`
--

DROP TABLE IF EXISTS `uploader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploader` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploader`
--

LOCK TABLES `uploader` WRITE;
/*!40000 ALTER TABLE `uploader` DISABLE KEYS */;
INSERT INTO `uploader` VALUES (10,'tvngoan','08aff88b292fe6eed1747cc2a08622f2ba1e39c2','ngoan98travinh@gmail.com','Ngoan Tran'),(11,'jackie','287667f9a218710dfbd7e6f58d64be83baecc4b2','jackie@mail.local','Jackie Chan'),(14,'joker','2fa570528a77894e2cc8cede9f0af2696a855e9b','joke@mail.co','Joker');
/*!40000 ALTER TABLE `uploader` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-29  1:52:53
