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
  `Created` varchar(100) DEFAULT NULL,
  `Scheduled` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `Events_FK` (`CreatorUserID`),
  KEY `Events_FK_1` (`UniversityID`),
  KEY `Events_FK_2` (`OrgID`),
  CONSTRAINT `Events_FK` FOREIGN KEY (`CreatorUserID`) REFERENCES `Users` (`UserID`),
  CONSTRAINT `Events_FK_1` FOREIGN KEY (`UniversityID`) REFERENCES `University` (`UniversityID`),
  CONSTRAINT `Events_FK_2` FOREIGN KEY (`OrgID`) REFERENCES `RStudentOrg` (`OrgID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Events`
--

LOCK TABLES `Events` WRITE;
/*!40000 ALTER TABLE `Events` DISABLE KEYS */;
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
  PRIMARY KEY (`MembershipID`),
  KEY `Membership_FK` (`UserID`),
  KEY `Membership_FK_1` (`OrgID`),
  CONSTRAINT `Membership_FK` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  CONSTRAINT `Membership_FK_1` FOREIGN KEY (`OrgID`) REFERENCES `RStudentOrg` (`OrgID`)
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
  CONSTRAINT `Roles_FK` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
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
  `Name` varchar(100) DEFAULT NULL,
  `Location` point DEFAULT NULL,
  `Description` varchar(900) DEFAULT NULL,
  `Domain` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UniversityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `University`
--

LOCK TABLES `University` WRITE;
/*!40000 ALTER TABLE `University` DISABLE KEYS */;
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
  KEY `Users_FK` (`UniversityID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (2,'test@testie.com','12345','(123) 456-7890',0,NULL,NULL);
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

-- Dump completed on 2021-04-14  1:06:15
