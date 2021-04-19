-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 192.168.2.140    Database: SchoolEventApp
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
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `EventID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `Content` varchar(900) DEFAULT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `Comments_FK` (`UserID`),
  KEY `Comments_FK_1` (`EventID`),
  CONSTRAINT `Comments_FK` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  CONSTRAINT `Comments_FK_1` FOREIGN KEY (`EventID`) REFERENCES `Events` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Events`
--

DROP TABLE IF EXISTS `Events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Events` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventVisibility` varchar(100) DEFAULT NULL,
  `Published` tinyint(1) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `CreatorUserID` int(11) DEFAULT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `OrgID` int(11) DEFAULT NULL,
  `ContactName` varchar(100) DEFAULT NULL,
  `ContactPhoneNumber` varchar(100) DEFAULT NULL,
  `ContactEmailAddr` varchar(100) DEFAULT NULL,
  `LatLon` point DEFAULT NULL,
  `AddressDesc` varchar(100) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Scheduled` datetime DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `Events_FK` (`CreatorUserID`),
  KEY `Events_FK_1` (`UniversityID`),
  KEY `Events_FK_2` (`OrgID`),
  CONSTRAINT `Events_FK` FOREIGN KEY (`CreatorUserID`) REFERENCES `Users` (`UserID`),
  CONSTRAINT `Events_FK_1` FOREIGN KEY (`UniversityID`) REFERENCES `University` (`UniversityID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Events`
--

LOCK TABLES `Events` WRITE;
/*!40000 ALTER TABLE `Events` DISABLE KEYS */;
INSERT INTO `Events` VALUES (1,'Public',1,'TestCategory','Ice Fishing',2,1,NULL,'Ted Testie','(555) 867-5309','ted@brrr.edu','\0\0\0\0\0\0\0±’œâ¿ÆS¿,¯	E≥cF¿','You\'ll see the hut!','2021-04-14 05:49:26','2021-04-21 05:49:26');
/*!40000 ALTER TABLE `Events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Membership`
--

DROP TABLE IF EXISTS `Membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Membership` (
  `MembershipID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `OrgID` int(11) DEFAULT NULL,
  `Accepted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MembershipID`),
  KEY `Membership_FK` (`UserID`),
  KEY `Membership_FK_1` (`OrgID`),
  CONSTRAINT `Membership_FK` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `Membership_FK_1` FOREIGN KEY (`OrgID`) REFERENCES `RStudentOrg` (`OrgID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Membership`
--

LOCK TABLES `Membership` WRITE;
/*!40000 ALTER TABLE `Membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `Membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RStudentOrg`
--

DROP TABLE IF EXISTS `RStudentOrg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RStudentOrg` (
  `OrgID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminUserID` int(11) DEFAULT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(900) DEFAULT NULL,
  PRIMARY KEY (`OrgID`),
  KEY `RStudentOrg_FK` (`AdminUserID`),
  KEY `RStudentOrg_FK_1` (`UniversityID`),
  CONSTRAINT `RStudentOrg_FK` FOREIGN KEY (`AdminUserID`) REFERENCES `Users` (`UserID`),
  CONSTRAINT `RStudentOrg_FK_1` FOREIGN KEY (`UniversityID`) REFERENCES `University` (`UniversityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RStudentOrg`
--

LOCK TABLES `RStudentOrg` WRITE;
/*!40000 ALTER TABLE `RStudentOrg` DISABLE KEYS */;
/*!40000 ALTER TABLE `RStudentOrg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rating`
--

DROP TABLE IF EXISTS `Rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rating` (
  `RatingID` int(11) NOT NULL AUTO_INCREMENT,
  `EventID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`RatingID`),
  KEY `Rating_FK` (`EventID`),
  KEY `Rating_FK_1` (`UserID`),
  CONSTRAINT `Rating_FK` FOREIGN KEY (`EventID`) REFERENCES `Events` (`EventID`),
  CONSTRAINT `Rating_FK_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rating`
--

LOCK TABLES `Rating` WRITE;
/*!40000 ALTER TABLE `Rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `Rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleType` varchar(100) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RoleID`),
  KEY `Roles_FK` (`UserID`),
  CONSTRAINT `Roles_FK` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (13,'Public',13),(14,'Student',13),(15,'Public',14),(16,'ApplicationAdmin',14),(17,'Public',15),(18,'Student',15),(19,'Public',16),(20,'Student',16),(21,'Public',17),(22,'Student',17),(23,'Public',18),(24,'Student',18),(25,'Public',19),(26,'Student',19),(27,'Public',20),(28,'Student',20),(29,'Public',21),(30,'Student',21),(31,'Public',22),(32,'Student',22),(33,'Public',23),(34,'Student',23),(35,'Public',24),(36,'Public',25),(37,'Student',25),(38,'Public',26),(39,'Student',26),(40,'Public',27),(41,'Student',27),(42,'Public',28),(43,'Student',28),(44,'Public',29),(45,'Student',29),(46,'Public',30),(47,'Student',30),(48,'Public',31),(49,'Student',31),(50,'Public',32),(51,'Student',32);
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `University`
--

DROP TABLE IF EXISTS `University`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `University` (
  `UniversityID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Location` point DEFAULT NULL,
  `Description` varchar(900) DEFAULT NULL,
  `Domain` varchar(100) NOT NULL,
  `AdminID` int(11) NOT NULL,
  PRIMARY KEY (`UniversityID`),
  UNIQUE KEY `University_UN` (`Name`),
  UNIQUE KEY `University_UN2` (`Domain`),
  KEY `University_FK` (`AdminID`),
  CONSTRAINT `University_FK` FOREIGN KEY (`AdminID`) REFERENCES `Users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `University`
--

LOCK TABLES `University` WRITE;
/*!40000 ALTER TABLE `University` DISABLE KEYS */;
INSERT INTO `University` VALUES (1,'Example University','\0\0\0\0\0\0\0=dH.ŒÀS¿ê∏≤´H¿','A great place to live!','brrr.edu',13),(8,'University of Central Florida','\0\0\0\0\0\0\0`º%ö<@b@úß”LT¿','test','knights.ucf.edu',16),(9,'Florida Tech','\0\0\0\0\0\0\0UÙz‘ú<@ƒÄÎÌ‚\'T¿','A private school','fit.edu',17);
/*!40000 ALTER TABLE `University` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) DEFAULT NULL,
  `PasswordHash` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(100) DEFAULT NULL,
  `UniversityID` int(11) DEFAULT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Users_UN` (`Email`),
  KEY `Users_FK` (`UniversityID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (2,'test@testie.com','12345','(123) 456-7890',0,NULL,NULL),(13,'joee@brrr.edu','$2y$10$x6UP/N96ZA3sAKtCl3VXR.yHeVfnAScEMUjNJh3rlEN4PmkWZJ8Ni','(555) 424-5253',1,'Joe','Eoj'),(14,'aadmin@test.test','$2y$10$VkLGQjUocrWl4Ibl2fmhlOftF9SJNWX9S0FjLXjitw/H4w5SYpDAa','-',NULL,'Application','Admin'),(15,'js@knights.ucf.edu','$2y$10$DcL0wJ85iv8mkcxlx7jF1ObDR7qZkWXHV3KCs.lOTSLPehySlPE6G','1',8,'John','Smith'),(16,'jdoe@knights.ucf.edu','$2y$10$/D2RFl2AiINa80mI3ym0MOgDoNoH0GUFisawt4xNR9EWm5Pt.8fq2','2222222222',8,'John','Doe'),(17,'janedoe@fit.edu','$2y$10$YIwUqULpVhTW6UcLwg1dOeCdZyQK4N5l2k9qSDYR/HtI80NbfuPja','3333333333',9,'Jane','Doe'),(18,'asand@knights.ucf.edu','$2y$10$YbUpHxl/pDgdoOwSSFeLPed495caaD0Y30GWEEshPlL8DR9wkBBBC','3333333333',8,'Adam','Sandford'),(19,'dc@knights.ucf.edu','$2y$10$3kK.EybGSStNolKLkNx1AO3wIoUekgskr5juNCi7Yb1D5rGagsq2u','4444444444',8,'Dane','Clyde'),(20,'tmyers@knights.ucf.edu','$2y$10$d0J.XnlpGCwBQuslxCCX9u/plsnzn7fOcrh6i747n5tqB/jSJJpWG','5555555555',8,'Twila','Myers'),(21,'tfry@knights.ucf.edu','$2y$10$kEeOdxdHpIDPQTjEyjAHxe8Hc6PEgIYBFwCeOJPzx47z3IqZbLXSa','6666666666',8,'Tristen','Fry'),(22,'lvi@knights.ucf.edu','$2y$10$bB98zVM.GN95oAjDXcA6YuBx/PeIgptfxG0PheICwsu72w3BWNVAe','6666666666',8,'Lauren','Vi'),(23,'rcarter@knights.ucf.edu','$2y$10$P8DVEhcATiliI6XZwJ833e0/pr1EcbR39rGI8PCaQI8sGyiTSYDYC','7777777777',8,'Robin','Carter'),(24,'jblakely@google.com','$2y$10$k/malUriCMZKPamKTPHaBO3BOMxvZWUO/DXm9fOsHE6pDR7376UFq','8888888888',NULL,'James','Blakely'),(25,'jclark@knights.ucf.edu','$2y$10$bG2VoIRMJVIq6wKk02fXKe/dMJ0HTvH5nqw3L8NbAJaerkP0p1JPK','8888888888',8,'Joline','Clark'),(26,'ckent@knights.ucf.edu','$2y$10$ZmUOMjwuavNgLzoJvt4LJOfSpChYAK2M/WTEdOHXDvSf.Qjys4CkW','9999999999',8,'Clark','Kent'),(27,'awonder@knights.ucf.edu','$2y$10$jHhC.9WmKG264SJaukgJz.oOdns6SJ8jE2pO.OizAQrKnIOTGn3/6','9876543211',8,'Alice','Wonder'),(28,'rdavis@fit.edu','$2y$10$DATSYAhEJvg9B4XgVR1dOu4WyFAv5Dl05LuuMjxfMxA1YpWQsR91m','3215559999',9,'Ray','Davis'),(29,'jdavis@fit.edu','$2y$10$yJH1S94PwUHWH99LNVntkOOPRIoIXz8E5YsYB8p5nDSIBx7Pm1P82','7899877897',9,'Jimmy','Davis'),(30,'ddavis@fit.edu','$2y$10$GCh1VpXkeh1sYY3gSITeqOeOTtw1bl9/HpG8ubgS/mElGU5oH89Rq','6544566544',9,'David','Davis'),(31,'ch@fit.edu','$2y$10$uC14.jnmY0m7ZjYFtmCLiO79JpPS2JMAHlNOGjkpPcSLZpINoH4j6','1233211231',9,'Chester','Henson'),(32,'whorton@fit.edu','$2y$10$Fu9r/.YoYmYMt//lRxtOt.8O74eAEwofgK4OvikPTsbzsSuHRp6xq','32112333213',9,'William','Horton');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'SchoolEventApp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-18 20:02:39
