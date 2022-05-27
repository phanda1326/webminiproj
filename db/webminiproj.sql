-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: webminiproj
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `otp` int(6) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES ('123','10504f9c15d84dfc199cf5f39d0fd1a8','Abishek',2147483647,0,6578,1,1),('rec','9b5032b573bfe51145133349fafd6d5a','asdklfal',2147483647,0,5942,1,2),('test','8206962d5bb78e93f0b19802aab82bbf','asdfklj',1921301330,0,5362,1,3),('abimob','3b9710090997a73a8bc0f6510c1dd1f3','Abishek',2147483647,0,8713,0,6),('harsha','b47d3017c3a30d5c232ecd190530d605','Harsha',2147483647,0,1474,1,7);
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `body` varchar(5000) NOT NULL,
  `image` varbinary(5000) NOT NULL,
  `posted_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (6,'123','hi','images/fd1a83cb7787473ba60bf4b710500566_1652969657.png','2022-05-19 14:14:17'),(7,'rec','first post','images/66c79884f6425f82c8acac4820257da3_1653071644.png','2022-05-20 18:34:04'),(8,'rec','test','images/31acf75d30c7609bdd2a5d0a857e359d_1653071665.png','2022-05-20 18:34:25'),(9,'test','my first post','images/665f6a4e9005e8993bc95ff3a2fd123d_1653071748.png','2022-05-20 18:35:48'),(10,'test','testing','images/30af6d937f32e37c92d0cd4b5a7bb3c8_1653071961.jpg','2022-05-20 18:39:21'),(11,'harsha','first post','images/32554b968a0ad569a14dd61adf835bd8_1653564403.png','2022-05-26 11:26:43');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `session_token` varchar(100) NOT NULL,
  `remember` tinyint(1) NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (1,'123','f8d885e2deec23e776093c184086b2a6',0,0,'2022-05-18 18:25:50'),(2,'123','4c9f7ba8eeea85ca02f9c56699c0c571',0,0,'2022-05-18 18:25:50'),(3,'123','c188110c0c71a3bbc9331816ac72fc26',0,0,'2022-05-18 18:25:50'),(4,'123','d4bc8c4110aa7878b4644a77a0c5cb3f',0,0,'2022-05-18 18:25:50'),(5,'123','39755fbd7ce793cd57598a352d44f29c',0,0,'2022-05-18 18:25:50'),(6,'123','62d780a3ce3789d9d3e27fec269d8bf2',0,0,'2022-05-18 18:25:50'),(7,'123','76a8608a4ea8bc79d9a6cf34f79e4234',0,0,'2022-05-18 18:25:50'),(8,'123','d35cc0a9b946def3ee9a2192161d19ad',0,0,'2022-05-18 18:25:50'),(9,'123','01104e72d0dc98f0e01d5142a496264d',0,0,'2022-05-18 18:25:50'),(10,'123','c012bb0a82438048f0832d796c5376c6',0,1,'2022-05-18 18:25:50'),(11,'123','d166e705a8c3e0df2533a7023cee85b9',0,1,'2022-05-18 18:26:22'),(12,'123','94d7f0a048025e0ebdaa62ee77774001',0,0,'2022-05-18 18:33:11'),(13,'123','93a8916c7ddcc7548be4efcf48bdc3c6',0,0,'2022-05-18 18:44:11'),(14,'123','5cd9cb4f26b8f6f649065629b7b4889b',0,0,'2022-05-18 20:20:10'),(15,'123','f288053e18599cbc6cbf7bcadb385226',0,1,'2022-05-18 20:20:13'),(16,'123','024450faaf4d7cf582b79a2bef02aed1',0,1,'2022-05-18 20:20:36'),(17,'123','70411e029894c196e35e85fa350bde30',0,0,'2022-05-18 20:34:10'),(18,'123','b5a4130021f73ca697ee8a89d04c8737',0,0,'2022-05-19 14:20:33'),(19,'rec','5c45b9a77f68d0397990b1e2928089c2',0,0,'2022-05-19 14:27:13'),(20,'test','3270ea864b02014430b9ce47a9663413',0,1,'2022-05-19 14:29:09'),(21,'123','a0e1943d7a7f27b5472014fa4a52ccf0',0,0,'2022-05-20 18:33:34'),(22,'rec','1c3c593cb65c72e4b1ad7b13e5f7cc6f',0,0,'2022-05-20 18:34:27'),(23,'test','e48f7a67b15fdb28a32c81a5413e134b',0,0,'2022-05-20 19:44:20'),(24,'harsha','6d03016ba284f1cab521222bbff505d5',0,0,'2022-05-26 11:34:38'),(25,'harsha','af021c5ec5ec843478852e17db2b117a',0,0,'2022-05-26 11:34:54');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-27 15:00:26
