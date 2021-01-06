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
-- Table structure for table `employees_projects`
--

DROP TABLE IF EXISTS `employees_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees_projects` (
  `employee_id` int(10) unsigned DEFAULT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `employee_id` (`employee_id`,`project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `employees_projects_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `employees_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees_projects`
--

LOCK TABLES `employees_projects` WRITE;
/*!40000 ALTER TABLE `employees_projects` DISABLE KEYS */;
INSERT INTO `employees_projects` VALUES (2,4),(3,8),(4,11),(5,1),(5,4),(6,3),(6,20),(7,4),(7,18),(9,2),(9,3),(9,8),(9,12),(13,6),(14,6),(15,11),(15,18),(16,7),(16,20),(17,4),(18,2),(18,15),(19,3),(19,8),(19,10),(19,19),(20,13),(20,19),(21,2),(21,14),(21,17),(21,19),(22,8),(22,18),(23,16),(26,14),(26,17),(28,7),(29,4),(30,16),(31,10),(33,7),(33,12),(36,10),(37,5),(37,11),(38,17),(38,18),(39,13),(41,16),(42,1),(42,7),(42,14),(43,15),(44,19),(46,9),(47,2),(47,16),(48,10),(48,14),(48,19),(49,16),(50,7),(50,20);
/*!40000 ALTER TABLE `employees_projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-06 12:20:18
