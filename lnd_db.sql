CREATE DATABASE  IF NOT EXISTS `lnd_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lnd_db`;
-- MySQL dump 10.13  Distrib 8.0.34, for macos13 (arm64)
--
-- Host: localhost    Database: lnd_db
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `Agent`
--

DROP TABLE IF EXISTS `Agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Agent` (
  `A_Id` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(45) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `Specilization` varchar(45) NOT NULL,
  `Licience_Number` varchar(10) NOT NULL,
  PRIMARY KEY (`A_Id`),
  UNIQUE KEY `Licience Number_UNIQUE` (`Licience_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=5452 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Agent`
--

LOCK TABLES `Agent` WRITE;
/*!40000 ALTER TABLE `Agent` DISABLE KEYS */;
INSERT INTO `Agent` VALUES (5051,'Neelima','Thondapu','neelima@lndagency.com','2100001222','Senior Agent','1001'),(5052,'Lara','Haiek','lara@lndagency.com','2100001223','New Agent','1002'),(5053,'Dhavan','Raveendranath','dhavan@lndagency.com','2100001224','Senior Agent','1003');
/*!40000 ALTER TABLE `Agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Appointment`
--

DROP TABLE IF EXISTS `Appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Appointment` (
  `Appointment_Id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(45) NOT NULL,
  `query` varchar(100) DEFAULT NULL,
  `P_no` varchar(10) DEFAULT NULL,
  `A_Id` int DEFAULT NULL,
  PRIMARY KEY (`Appointment_Id`),
  KEY `fk_Appointment_Agent1_idx` (`A_Id`),
  CONSTRAINT `fk_Appointment_Agent1` FOREIGN KEY (`A_Id`) REFERENCES `Agent` (`A_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Appointment`
--

LOCK TABLES `Appointment` WRITE;
/*!40000 ALTER TABLE `Appointment` DISABLE KEYS */;
INSERT INTO `Appointment` VALUES (14,'John Watson','john@gmail.com','3678456738','2023-12-05','02:00 PM - 03:00 PM','Buy Apartment','1022',5053),(15,'Irene Adler','irene@gmail.com','7698578935','2023-12-07','10:00 AM - 11:00 AM','Buy a condo','1024',5052),(16,'Alex Rider','alex@gmail.com','2783678790','2023-12-08','04:00 PM - 05:00 PM','Sell my house','',5051),(17,'Test 3','test3@gmail.com','4567345678','2023-12-06','02:00 PM - 03:00 PM','Buy Property','',5052),(18,'Test 3','test3@gmail.com','4567345678','2023-12-10','04:00 PM - 05:00 PM','Buy Property','1035',5053),(19,'Dave','dave@gmail.com','2678467390','2023-12-06','03:00 PM - 04:00 PM','Sell my house','',5052);
/*!40000 ALTER TABLE `Appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Buyer`
--

DROP TABLE IF EXISTS `Buyer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Buyer` (
  `B_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `Budget` decimal(10,0) DEFAULT NULL,
  `Preference` varchar(200) DEFAULT NULL,
  `P_Id` int NOT NULL,
  `A_Id` int NOT NULL,
  PRIMARY KEY (`B_ID`,`A_Id`),
  UNIQUE KEY `Phone_Number_UNIQUE` (`Phone_Number`),
  KEY `fk_Buyer_Agent_idx` (`A_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3008 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Buyer`
--

LOCK TABLES `Buyer` WRITE;
/*!40000 ALTER TABLE `Buyer` DISABLE KEYS */;
INSERT INTO `Buyer` VALUES (3001,'Peter','Burke','peter@gmail.com','2345678987',150000,'Apartment - 2 Bed - 2 Bath - Furnished',1023,5052),(3004,'John','Smith','johns@gmail.com','6787365678',250000,'',1024,5051),(3006,'Jimmy','Oliver','jimmy@gmail.com','6738978678',200000,'',1037,5052),(3007,'Sam','Tyler','sam@gmail.com','6278935678',250000,'',1038,5053);
/*!40000 ALTER TABLE `Buyer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Marketing`
--

DROP TABLE IF EXISTS `Marketing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Marketing` (
  `M_Id` int NOT NULL AUTO_INCREMENT,
  `M_Name` varchar(45) NOT NULL,
  `P_Id` int NOT NULL,
  `A_Id` int NOT NULL,
  PRIMARY KEY (`M_Id`,`P_Id`),
  KEY `fk_Marketing_Property1_idx` (`P_Id`),
  KEY `fk_Marketing_Agent1_idx` (`A_Id`),
  CONSTRAINT `fk_Marketing_Agent1` FOREIGN KEY (`A_Id`) REFERENCES `Agent` (`A_Id`),
  CONSTRAINT `fk_Marketing_Property1` FOREIGN KEY (`P_Id`) REFERENCES `Property` (`P_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7005 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Marketing`
--

LOCK TABLES `Marketing` WRITE;
/*!40000 ALTER TABLE `Marketing` DISABLE KEYS */;
INSERT INTO `Marketing` VALUES (7001,'Zillow',1021,5051),(7003,'Realtor',1022,5052),(7004,'Detroit Post',1022,5053);
/*!40000 ALTER TABLE `Marketing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Property`
--

DROP TABLE IF EXISTS `Property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Property` (
  `P_Id` int NOT NULL AUTO_INCREMENT,
  `listing_date` date NOT NULL,
  `city` varchar(45) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `p_status` varchar(45) NOT NULL,
  `p_type` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `no_bedroom` int NOT NULL,
  `no_bathroom` int NOT NULL,
  `area` int NOT NULL,
  `furnished` varchar(45) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `movein_date` date NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `A_Id` int NOT NULL,
  PRIMARY KEY (`P_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1039 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property`
--

LOCK TABLES `Property` WRITE;
/*!40000 ALTER TABLE `Property` DISABLE KEYS */;
INSERT INTO `Property` VALUES (1021,'2024-01-01','Auburn Hills','house-img-1.webp','Available','House','123 Avenue Auburn Hills MI',4,3,6000,'Furnished',500000,'2024-02-01','3 bed , 3 barh',5052),(1022,'2024-02-23','Southfield','house-img-2.webp','Coming Soon','Apartment','345 West Southfield MI ',3,3,2456,'Un-Furnished',150000,'2024-02-02','4 bed, 3 bath',5051),(1023,'2023-09-01','Detroit','house-img-6.webp','Sold','Apartment','567 North Woods , Detroit MI',2,2,1500,'Furnished',150000,'2023-10-01','3 bed, 2 bath',5052),(1024,'2024-01-01','Warren','house-img-4.webp','Available','Condo','890 pointe Dr, Warren MI',4,4,3000,'Semi-Furnished',250000,'2024-01-30','3 bed, 2 bath',5051),(1025,'2024-01-02','Southfield','house-img-2.webp','Coming Soon','Apartment','345 West Southfield MI ',3,2,1400,'Un-Furnished',130000,'2024-02-02','3 bed, 2 bath',5053),(1035,'2023-12-03','Rochester Hills','house-pic.jpeg','Available','House','2455 North Sq Rd Rochester MI - 48326',5,4,3000,'Furnished',200000,'2023-12-15','',5053),(1036,'2023-12-05','Rochester Hills','house.jpeg','Coming Soon','House','2137 Timber Ln Rochester Hills MI ',3,3,2800,'Furnished',160000,'2023-12-20','Lake View Property',5053),(1037,'2023-12-05','Rochester Hills','house 4.jpeg','Sold','House','6347 Squirrel Rd Rochester Hills MI',3,2,2500,'Furnished',200000,'2023-12-15','Close to Oakland University',5052),(1038,'2023-12-05','Ann Arbor','House Picture.jpeg','Sold','House','123128hb jhbfhjab',4,3,3000,'Furnished',250000,'2023-12-15','Lake view',5053);
/*!40000 ALTER TABLE `Property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Review`
--

DROP TABLE IF EXISTS `Review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Review` (
  `R_Id` int NOT NULL AUTO_INCREMENT,
  `U_ID` int NOT NULL,
  `display_name` varchar(45) NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `review` varchar(500) NOT NULL,
  PRIMARY KEY (`R_Id`),
  KEY `fk_Review & Ratings_User1_idx` (`U_ID`),
  CONSTRAINT `fk_Review & Ratings_User1` FOREIGN KEY (`U_ID`) REFERENCES `User` (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7012 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Review`
--

LOCK TABLES `Review` WRITE;
/*!40000 ALTER TABLE `Review` DISABLE KEYS */;
INSERT INTO `Review` VALUES (7001,1,'Connie',4.5,'I didn\'t know how to begin the search for a realtor in the area I was interested in purchasing my next home. LND was recommended to me. They were responsive and efficient in getting back to me very quickly and recommended a realtor who turned out to be absolutely terrfic. I would highly recommend them to assist you in your search.'),(7002,1,'Monica',4.5,'My husaband and I were first time home buyers. After going to LND website, I answered a few questions and the next day got matched up with our realtor. It was the absolute best, and we were able to find our Starter home Soon after. LND service was so easy, and I have them to thank for setting us up with our amazing realtor.I am very happy with LND.'),(7003,1,'Thomas',4.5,'The service that LND provided was a tremendous help. LND was able to match our specific situation and needs to a selection of local realtors and remove a lot of the legwork from the selection process.I am very happy that work done within a month and I moved into the house with my family and My childern are loved with the place.'),(7004,1,'Cory',4.5,'Using HomeLight made it to easy to find the top selling real estate agent in our area. The process from beginning to end was so quick and easy. Our LND got to work right away and was very confident in the listing process. Our home went under contract just 2-3 weeks and sold quickly!'),(7005,1,'Pattie',4.5,'Purely Professional from start to finish. I received an immediate response. In less than two months the property was sold for much more than expected. LND is the game changer of real estate. I am very happy that I can earn more than what I expected. They explained eveything in details.  '),(7010,2008,'Singh',5.0,'Amazing service, thanks for helping me find the perfect home.'),(7011,2010,'David',5.0,'Good');
/*!40000 ALTER TABLE `Review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Search_Engine`
--

DROP TABLE IF EXISTS `Search_Engine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Search_Engine` (
  `S_Id` int NOT NULL AUTO_INCREMENT,
  `U_ID` int NOT NULL,
  `search_date` date NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  `p_type` varchar(45) DEFAULT NULL,
  `p_status` varchar(45) DEFAULT NULL,
  `no_bedroom` varchar(45) DEFAULT NULL,
  `no_bathroom` varchar(45) DEFAULT NULL,
  `furnished` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`S_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Search_Engine`
--

LOCK TABLES `Search_Engine` WRITE;
/*!40000 ALTER TABLE `Search_Engine` DISABLE KEYS */;
INSERT INTO `Search_Engine` VALUES (1,1,'2023-12-03','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(2,1,'2023-12-03','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(3,1,'2023-12-03','Warren','Condo','Available','4','4','Semi-Furnished'),(4,1,'2023-12-03','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(5,2008,'2023-12-05','Southfield','House','Coming Soon','3','3','Un-Furnished'),(6,2008,'2023-12-05','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(7,2008,'2023-12-05','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(8,2008,'2023-12-05','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(9,2009,'2023-12-05','Southfield','Apartment','Coming Soon','3','3','Un-Furnished'),(10,2010,'2023-12-05','Auburn Hills','House','Available','4','3','Furnished');
/*!40000 ALTER TABLE `Search_Engine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Seller`
--

DROP TABLE IF EXISTS `Seller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Seller` (
  `S_Id` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `Sale_Description` varchar(200) DEFAULT NULL,
  `P_Id` int NOT NULL,
  `A_Id` int NOT NULL,
  PRIMARY KEY (`S_Id`,`A_Id`),
  KEY `fk_Sellar_Property1_idx` (`P_Id`),
  CONSTRAINT `fk_Sellar_Property1` FOREIGN KEY (`P_Id`) REFERENCES `Property` (`P_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9102 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Seller`
--

LOCK TABLES `Seller` WRITE;
/*!40000 ALTER TABLE `Seller` DISABLE KEYS */;
INSERT INTO `Seller` VALUES (2001,'Harvey','Spectre','harvey@gmail.com','6748369804','Currently available to Move-in',1021,5052),(2002,'Nick','Holden','nick@gmail.com','2647864657','Available to Move-in on 01/01/2024',1022,5051),(2003,'Alison','Tisdale','alison@gmail.com','9846735678','Vacant and ready to Move-in',1023,5052),(2004,'Kate','Becket','kate@gmail.com','7846758367','Available after Feb 2024',1024,5051),(2005,'Richard','Castle','richard@gmail.com','9846245746','Available to Move-in on 01/01/2024',1025,5053),(9098,'Jake','Peralta','jake@gmail.com','3678236767','efg',1035,5053),(9099,'Mary','Jane','mary@gmail.com','6738764567','',1024,5051),(9100,'Nathan','Adams','nathan@gmail.com','6738965401','On sale immediately',1037,5052),(9101,'Alex','Rider','alex@gmail.com','6738987654','',1038,5053);
/*!40000 ALTER TABLE `Seller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Transaction`
--

DROP TABLE IF EXISTS `Transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Transaction` (
  `T_ID` int NOT NULL AUTO_INCREMENT,
  `t_date` date NOT NULL,
  `t_type` varchar(45) NOT NULL,
  `t_amount` int NOT NULL,
  `S_Id` int NOT NULL,
  `A_Id` int NOT NULL,
  `B_Id` int NOT NULL,
  PRIMARY KEY (`T_ID`),
  KEY `fk_Transcation_Sellar1_idx` (`S_Id`),
  KEY `fk_Transcation_Buyer1_idx` (`B_Id`,`A_Id`),
  CONSTRAINT `fk_Transcation_Buyer1` FOREIGN KEY (`B_Id`, `A_Id`) REFERENCES `Buyer` (`B_ID`, `A_Id`),
  CONSTRAINT `fk_Transcation_Sellar1` FOREIGN KEY (`S_Id`) REFERENCES `Seller` (`S_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23246 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Transaction`
--

LOCK TABLES `Transaction` WRITE;
/*!40000 ALTER TABLE `Transaction` DISABLE KEYS */;
INSERT INTO `Transaction` VALUES (23243,'2023-12-10','Check',150000,2003,5052,3001),(23244,'2023-12-12','Cash',250000,9099,5051,3004),(23245,'2023-12-07','Card',200000,9100,5052,3006);
/*!40000 ALTER TABLE `Transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `U_ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT 'User',
  PRIMARY KEY (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2011 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Dhavan Raveendranath','dhavanraveendranath@gmail.com','7d9732bcfc78dd39f2efd9bda174e808','Dhavan.jpeg','Admin'),(2005,'Test','test@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','','User'),(2006,'Dhavan Raveendranath','dhavan.raveendranath29@gmail.com','7d9732bcfc78dd39f2efd9bda174e808','','User'),(2007,'test','test1@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Test - 3.png','User'),(2008,'Test','test3@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Screenshot 2023-12-05 at 11.44.12 AM.png','User'),(2009,'Dave Walter','dave@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Screenshot 2023-12-05 at 3.29.56 PM.png','User'),(2010,'David Turner','david@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Profile Picture.png','User');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_has_Serach Engine`
--

DROP TABLE IF EXISTS `User_has_Serach Engine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User_has_Serach Engine` (
  `U_ID` int NOT NULL,
  `S_Id` int NOT NULL,
  PRIMARY KEY (`U_ID`,`S_Id`),
  KEY `fk_User_has_Serach Engine_Serach Engine1_idx` (`S_Id`),
  KEY `fk_User_has_Serach Engine_User1_idx` (`U_ID`),
  CONSTRAINT `fk_User_has_Serach Engine_Serach Engine1` FOREIGN KEY (`S_Id`) REFERENCES `Search_Engine` (`S_Id`),
  CONSTRAINT `fk_User_has_Serach Engine_User1` FOREIGN KEY (`U_ID`) REFERENCES `User` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_has_Serach Engine`
--

LOCK TABLES `User_has_Serach Engine` WRITE;
/*!40000 ALTER TABLE `User_has_Serach Engine` DISABLE KEYS */;
/*!40000 ALTER TABLE `User_has_Serach Engine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'lnd_db'
--

--
-- Dumping routines for database 'lnd_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetAgentTransactions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAgentTransactions`(IN agentEmail VARCHAR(45), IN agentFirstName VARCHAR(45))
BEGIN
    SELECT 
        t.*, 
        a.First_Name AS A_FirstName, 
        a.Last_Name AS A_LastName, 
        a.Phone_Number AS Agent_phone,
        s.First_Name AS S_FirstName,
        s.Last_Name AS S_LastName,
        s.Phone_Number AS Seller_phone,
        b.First_Name AS B_FirstName,
        b.Last_Name AS B_LastName, 
        b.Phone_Number AS Buyer_phone
    FROM 
        Transaction t
        INNER JOIN Agent a ON t.A_Id = a.A_Id
        INNER JOIN Seller s ON t.S_Id = s.S_Id
        INNER JOIN Buyer b ON t.B_Id = b.B_ID
    WHERE 
        a.Email = agentEmail AND a.First_Name = agentFirstName
    ORDER BY 
        t.t_date DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-13 22:21:03
