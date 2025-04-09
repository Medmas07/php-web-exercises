-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: student_management
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Génie Logiciel','Section dédiée au développement logiciel, à l’analyse, la conception, et l’ingénierie des applications.'),(2,'Réseaux et Télécommunications','Section axée sur les réseaux informatiques, les systèmes de communication et la sécurité réseau.'),(4,'IIA','Informatique Industrielle et Autamatique');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `section_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Amine Bensalem','2002-03-15','student1.png',1),(2,'Khadija El Mansouri','2001-11-28','Capture d\'écran 2023-11-16 222232.png',1),(3,'Yassir Ait Taleb','2002-05-10','student3.png',1),(4,'Salma Moujahid','2003-02-19','student4.png',1),(5,'Rachid Bouzid','2002-07-08','student5.png',1),(6,'Imane Idrissi','2001-09-30','student6.png',1),(7,'Walid Chafik','2002-12-03','student7.png',1),(8,'Sofia Berrada','2003-01-21','student8.jpg',1),(9,'Anass Hafidi','2001-04-25','student9.png',1),(10,'Hiba Jamal','2002-08-12','student10.png',1),(11,'Zakaria Dali','2003-06-09','student11.png',2),(12,'Sara Hamdi','2002-09-22','student12.png',2),(13,'Mohammed El Youssfi','2001-03-14','student13.png',2),(14,'Nadia Tazi','2002-10-11','student14.png',2),(15,'Adil Khattabi','2003-07-07','student15.png',2),(16,'Meriem Lahlou','2002-05-26','student16.png',2),(17,'Hamza Mouline','2001-11-02','student17.png',2),(18,'Rania Belkadi','2003-04-19','student18.png',2),(19,'Tariq Mernissi','2002-12-15','student19.png',2),(21,'Lina Sehmo','2001-06-06','colorful-bird-sits-pink-flower_1089151-209582.avif',2);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Youssef','youssef.admin@example.com','$2y$10$/XnzGSXMXmB/4i6xtM2qhuPAofH.UuR0PMqLRsYOAD6LLEl2Fenru','admin'),(5,'Mouhammad','mouhamed.admin@example.com','$2y$10$eYe6y3kgyyKJ17e0emmWc..N6MoBAvQkRmYnE5H9.HtHvU84stZi6','admin'),(6,'Aymen','aymen.admin@example.com','$2y$10$RS6VsmuwjsQuW6SP.q41YeRBtHL4aSUSdB5pvqMtBUo8wNa3jf9eS','user'),(7,'Mouhamed','mouhamed.admin@example.com','$2y$10$Wu7eX8GorBiJiXf/ys9inOQKt7wJMM/IPZ4Xg9w04z9hpu3KwHb3a','user');
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

-- Dump completed on 2025-04-09 17:46:34
