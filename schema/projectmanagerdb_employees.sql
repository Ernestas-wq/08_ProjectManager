CREATE DATABASE  IF NOT EXISTS `projectmanagerdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projectmanagerdb`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: projectmanagerdb
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Kristoferis','Perkinskas','2021-01-06 10:17:44'),(2,'Petras','Pojus','2021-01-06 10:17:44'),(3,'Dimitrijus','BC3','2021-01-06 10:17:44'),(4,'Henris','Zigmavičius','2021-01-06 10:17:44'),(5,'Germanas','Parisius','2021-01-06 10:17:44'),(6,'Jonas','Rndo','2021-01-06 10:17:44'),(7,'Domas','Lapinskas','2021-01-06 10:17:44'),(8,'Jonas','Perkinskas','2021-01-06 10:17:44'),(9,'Džiugas','Aminskas','2021-01-06 10:17:44'),(10,'Faustas','Baginskas','2021-01-06 10:17:44'),(11,'Gotautas','Arzinskas','2021-01-06 10:17:44'),(12,'Dimitrijus','X1','2021-01-06 10:17:44'),(13,'Germanas','A2','2021-01-06 10:17:44'),(14,'Bertas','Zigmavičius','2021-01-06 10:17:44'),(15,'Germanas','Lapinskas','2021-01-06 10:17:44'),(16,'Laurynas','AA3','2021-01-06 10:17:44'),(17,'Arijus','Rndo','2021-01-06 10:17:44'),(18,'Barbaras','Petravičius','2021-01-06 10:17:44'),(19,'Kostas','Z13','2021-01-06 10:17:44'),(20,'Stepas','AZ4','2021-01-06 10:17:44'),(21,'Jonas','Lapinskas','2021-01-06 10:17:44'),(22,'Balys','Rolonavičius','2021-01-06 10:17:44'),(23,'Jonas','B14','2021-01-06 10:17:44'),(24,'Augustas','Aržauskas','2021-01-06 10:17:44'),(25,'Dimitrijus','Arzinskas','2021-01-06 10:17:44'),(26,'Edvinas','Pavardenis','2021-01-06 10:17:44'),(27,'Rokas','Petravičius','2021-01-06 10:17:44'),(28,'Giedrius','Baginskas','2021-01-06 10:17:44'),(29,'Gustas','Pojus','2021-01-06 10:17:44'),(30,'Laurynas','Z13','2021-01-06 10:17:44'),(31,'Edvinas','Z23','2021-01-06 10:17:44'),(32,'Fedoras','AZ4','2021-01-06 10:17:44'),(33,'Laurynas','B14','2021-01-06 10:17:44'),(34,'Domas','Grikis','2021-01-06 10:17:44'),(35,'Adomas','Grigorijus','2021-01-06 10:17:44'),(36,'Kostas','Birštonas','2021-01-06 10:17:44'),(37,'Balys','AZ4','2021-01-06 10:17:44'),(38,'Boris','Arzinskas','2021-01-06 10:17:44'),(39,'Benas','A2243','2021-01-06 10:17:44'),(40,'Kęstutis','Zigmavičius','2021-01-06 10:17:44'),(41,'Dimitrijus','Rndo','2021-01-06 10:17:44'),(42,'Rokas','RNZ','2021-01-06 10:17:44'),(43,'Petras','Zigmavičius','2021-01-06 10:17:44'),(44,'Adas','Rolonavičius','2021-01-06 10:17:44'),(45,'Adas','Rndo','2021-01-06 10:17:44'),(46,'Stepas','AZ4','2021-01-06 10:17:44'),(47,'Hektoras','Petravičius','2021-01-06 10:17:44'),(48,'Ugnius','A2','2021-01-06 10:17:44'),(49,'Adas','Rndo','2021-01-06 10:17:44'),(50,'Hugas','AZ4','2021-01-06 10:17:44');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-06 12:20:17
