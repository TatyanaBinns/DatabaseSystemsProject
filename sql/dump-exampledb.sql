-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 192.168.2.140    Database: exampledb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.47-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `commentkey` int(11) NOT NULL AUTO_INCREMENT,
  `userkey` int(11) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`commentkey`),
  KEY `userkey` (`userkey`),
  CONSTRAINT `userkey` FOREIGN KEY (`userkey`) REFERENCES `ExampleTable` (`userkey`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (1,5,'First Comment!'),(2,5,'Second Comment!'),(3,5,'Third Comment!'),(6,12,'If you want to blend cheese, this is a amazing recipe!'),(7,14,'When you want to steam, it\'s hard. This method for mushroom is mediocre tactic!'),(8,5,'When you want to braise, it\'s hard. This method for ribs is awesome mechanism!'),(9,8,'When you want to saute, it\'s hard. This method for cheese is awesome mess!'),(10,7,'This is a atrocious idea of how to fry coffee!'),(11,7,'If you want to blanche cheese, this is a pathetic fashion!'),(12,11,'When you want to saute, it\'s hard. This method for coffee is rotten example!'),(13,9,'When you want to grill, it\'s hard. This method for mushroom is pathetic means!'),(14,8,'This isn\'t a pathetic fashion of how to stew almonds!'),(15,11,'This isn\'t a pathetic mechanism of how to sear bread!'),(16,12,'When you want to blend, it\'s hard. This method for mushroom is awesome idea!'),(17,14,'This is a mediocre idea of how to braise milk!'),(18,5,'When you want to stew, it\'s hard. This method for pears is poor mechanism!'),(19,5,'If you want to roast beans, this is a lousy mess!'),(20,7,'If you want to poach kiwis, this is a atrocious recipe!'),(21,6,'This isn\'t a neat technique of how to poach ribs!'),(22,7,'When you want to boil, it\'s hard. This method for almonds is atrocious example!'),(23,5,'When you want to grill, it\'s hard. This method for apples is good recipe!'),(24,14,'This isn\'t a awesome means of how to grill mushroom!'),(25,6,'When you want to boil, it\'s hard. This method for broccoli is mediocre idea!'),(26,11,'I don\'t think that this is a good mess of how to blend pears!'),(27,12,'I don\'t think that this is a slick means of how to fry ribs!'),(28,9,'If you want to poach broccoli, this is a terrible tactic!'),(29,9,'This isn\'t a pathetic technique of how to sear beans!'),(30,10,'I don\'t think that this is a neat means of how to boil bread!'),(31,NULL,'TestComment!');
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExampleTable`
--

DROP TABLE IF EXISTS `ExampleTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExampleTable` (
  `userkey` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key, simple int auto-incrementing key',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time inserted, with fun defaults',
  `name` varchar(100) DEFAULT NULL COMMENT 'Should be the name of this entry',
  `email` varchar(100) DEFAULT NULL COMMENT 'Contact email addr',
  PRIMARY KEY (`userkey`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExampleTable`
--

LOCK TABLES `ExampleTable` WRITE;
/*!40000 ALTER TABLE `ExampleTable` DISABLE KEYS */;
INSERT INTO `ExampleTable` VALUES (5,'2021-03-28 01:21:29','bob','bob@bobiverse.edu'),(6,'2021-03-28 01:21:53','fred','fred23@gmail.com'),(7,'2021-03-28 01:22:50','albert','bigal@gmail.com'),(8,'2021-03-28 01:24:39','jerry','jerrman@yahoo.com'),(9,'2021-03-28 01:24:40','roderick','roddy@gmail.com'),(10,'2021-03-28 16:15:46','joe','joeseph@lalaland.com'),(11,'2021-03-28 16:16:11','oliver','ollie@yahoo.com'),(12,'2021-03-28 16:16:35','william','billy@bobiverse.edu'),(13,'2021-03-28 16:16:47','lucas','lucas@lucasarts.com'),(14,'2021-03-28 16:17:17','ethan','ethan@lucasarts.com');
/*!40000 ALTER TABLE `ExampleTable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UniversityID` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PasswordHash` varchar(100) DEFAULT NULL,
  `Phone Number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'exampledb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-30  0:53:25
