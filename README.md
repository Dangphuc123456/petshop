-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: petshop
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `AppointmentID` int NOT NULL AUTO_INCREMENT,
  `ServiceID` int NOT NULL,
  `ServiceName` varchar(255) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerContact` varchar(100) NOT NULL,
  `AppointmentDate` datetime NOT NULL,
  `Status` varchar(20) DEFAULT 'Chờ xác nhận',
  `CancellationReason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LocationName` varchar(255) NOT NULL,
  PRIMARY KEY (`AppointmentID`),
  KEY `ServiceID` (`ServiceID`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,2,'Veterinary Checkup','hoàng gia huy','0964505836','2025-03-22 04:25:00','Hoàn thành',NULL,'2025-03-20 10:11:08','2025-03-31 22:00:43','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(2,1,'Pet Grooming','hoàng gia huy','hoanghuy1995@gmail.com','2025-04-02 21:59:00','Hoàn thành',NULL,'2025-04-01 00:23:53','2025-04-19 11:33:04','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(3,3,'Pet Training','hoàng gia huy','0987543322','2025-04-02 08:30:00','Hoàn thành',NULL,'2025-04-01 00:24:58','2025-05-18 21:02:06','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(4,1,'Pet Grooming','Phạm Tuấn Anh','0964505836','2025-05-06 11:00:00','Hoàn thành',NULL,'2025-05-05 20:26:10','2025-05-18 21:03:50','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(5,1,'Pet Grooming','hoàng gia huy','0964505836','2025-05-06 00:41:00','Hoàn thành',NULL,'2025-05-05 20:39:51','2025-05-18 21:05:17','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(6,1,'Pet Grooming','Phạm Tuấn Anh','0964505836','2025-05-06 10:42:00','Hoàn thành',NULL,'2025-05-05 20:42:51','2025-05-19 01:59:30','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(7,1,'Pet Grooming','Phạm Tuấn Anh','0964505836','2025-05-19 12:01:00','Hoàn thành',NULL,'2025-05-19 08:01:56','2025-05-19 21:17:04','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(8,1,'Pet Grooming','hoàng gia huy','0964505836','2025-05-20 18:00:00','Đã hủy',NULL,'2025-05-19 23:03:27','2025-05-23 04:01:34','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(9,1,'Pet Grooming','hoàng gia huy','hoanghuy1995@gmail.com','2025-05-20 18:03:00','Hoàn thành',NULL,'2025-05-19 23:04:03','2025-05-22 21:01:47','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(10,1,'Pet Grooming','Phạm Tuấn Anh','0964505836','2025-05-22 00:00:00','Hoàn thành',NULL,'2025-05-21 21:15:50','2025-05-22 20:53:10','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(11,2,'Veterinary Checkup','Hoàng Gia Huy','0964505836','2025-05-23 14:30:00','Hoàn thành',NULL,'2025-05-23 00:27:00','2025-05-27 06:37:14','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(12,2,'Veterinary Checkup','Phạm Tuấn Anh','0964505836','2025-05-23 19:30:00','Hoàn thành',NULL,'2025-05-23 00:34:27','2025-05-27 06:37:13','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(13,1,'Pet Grooming','Phạm Tuấn Anh','0964505836','2025-05-25 18:40:00','Hoàn thành',NULL,'2025-05-24 23:34:45','2025-05-27 07:35:22','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(14,3,'Pet Training','Hoàng Gia Huy','hoanghuy1995@gmail.com','2025-05-28 18:30:00','Hoàn thành',NULL,'2025-05-28 00:27:13','2025-05-28 00:27:27','294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh'),(15,2,'Veterinary Checkup','Hoàng Gia Huy','hoanghuy1995@gmail.com','2025-05-28 18:30:00','Hoàn thành',NULL,'2025-05-28 00:27:49','2025-05-28 00:27:56','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(16,2,'Veterinary Checkup','Hoàng Gia Huy','0988888888','2025-06-04 01:30:00','Đã hủy','Thay đổi dịch vụ','2025-06-03 21:48:21','2025-06-04 00:09:35','Số 168 Thượng Đình - Thanh Xuân - Hà Nội'),(17,1,'Pet Grooming','Hoàng Gia Huy','hoanghuy1995@gmail.com','2025-06-08 07:10:00','Hoàn thành',NULL,'2025-06-07 17:10:30','2025-06-07 17:10:50','Số 168 Thượng Đình - Thanh Xuân - Hà Nội');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `BookingID` int NOT NULL AUTO_INCREMENT,
  `RoomID` int DEFAULT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `BookingStatus` enum('Chờ xác nhận','Đã xác nhận','Đã hủy','Đã trả phòng') DEFAULT 'Chờ xác nhận',
  `CancellationReason` varchar(255) DEFAULT NULL,
  `LocationName` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BookingID`),
  KEY `RoomID` (`RoomID`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,1,'hoàng gia huy','0987543322','hoanghuy1995@gmail.com','2025-04-03','2025-04-05',400000.00,'Đã trả phòng',NULL,'','2025-04-01 07:42:08','2025-04-01 00:44:32'),(2,1,'hoàng gia huy','0964505836','hoanghuy1995@gmail.com','2025-05-19','2025-05-23',800000.00,'Đã trả phòng',NULL,'','2025-05-19 15:43:37','2025-05-19 21:16:45'),(3,1,'hoàng gia huy','0974653542','hoanghuy1995@gmail.com','2025-05-20','2025-05-24',800000.00,'Đã trả phòng',NULL,'','2025-05-20 04:18:34','2025-05-19 21:19:22'),(4,1,'hoàng gia huy','0987543322','hoanghuy1995@gmail.com','2025-05-21','2025-06-01',2200000.00,'Đã hủy',NULL,'','2025-05-20 04:20:25','2025-05-22 03:07:03'),(5,2,'hoàng gia huy','0974653542','hoanghuy1995@gmail.com','2025-05-20','2025-05-31',2200000.00,'Đã hủy',NULL,'','2025-05-20 04:22:16','2025-05-22 20:48:06'),(6,3,'hoàng gia huy','0974653542','hoanghuy1995@gmail.com','2025-05-20','2025-05-25',1000000.00,'Đã trả phòng',NULL,'','2025-05-20 04:59:54','2025-05-22 20:52:38'),(7,3,'hoàng gia huy','0974653542','hoanghuy1995@gmail.com','2025-05-20','2025-05-25',1000000.00,'Đã hủy',NULL,'','2025-05-20 05:00:07','2025-05-22 20:52:52'),(8,1,'Hoàng Gia Huy','0987543322','hoanghuy1995@gmail.com','2025-05-23','2025-05-28',1000000.00,'Đã trả phòng',NULL,'','2025-05-23 07:38:27','2025-05-25 00:22:57'),(9,1,'Hoàng Gia Huy','0974653542','hoanghuy1995@gmail.com','2025-05-25','2025-05-30',1000000.00,'Đã trả phòng',NULL,'','2025-05-25 05:27:26','2025-05-27 06:31:32'),(10,1,'Phạm Tuấn Anh','0974653542','tuananh1234@gmail.com','2025-05-26','2025-05-31',1000000.00,'Đã trả phòng',NULL,'','2025-05-26 04:30:56','2025-05-31 21:47:21'),(11,1,'Hoàng Huy Khanh','0964505836','hoanghuy1995@gmail.com','2025-06-01','2025-06-10',1800000.00,'Đã trả phòng',NULL,'Số 168 Thượng Đình - Thanh Xuân - Hà Nội','2025-06-01 04:52:52','2025-05-31 22:14:03'),(12,11,'Hoàng Huy Khanh','0964505836','hoanghuy1995@gmail.com','2025-06-01','2025-06-14',2600000.00,'Đã trả phòng',NULL,'294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh','2025-06-01 05:13:27','2025-05-31 22:14:05'),(13,1,'Hoàng Gia Huy','0987543322','hoanghuy1995@gmail.com','2025-06-01','2025-06-10',1800000.00,'Đã trả phòng',NULL,'Số 168 Thượng Đình - Thanh Xuân - Hà Nội','2025-06-01 05:39:11','2025-05-31 22:42:07'),(14,1,'Hoàng Gia Huy','0964505836','hoanghuy1995@gmail.com','2025-06-01','2025-06-10',1800000.00,'Đã trả phòng',NULL,'Số 168 Thượng Đình - Thanh Xuân - Hà Nội','2025-06-01 05:42:31','2025-06-01 00:32:16'),(15,11,'Phạm Tuấn Anh','0974653542','tuananh1234@gmail.com','2025-06-01','2025-06-12',2200000.00,'Đã trả phòng',NULL,'294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh','2025-06-01 07:31:53','2025-06-01 00:32:17'),(16,1,'Hoàng Gia Huy','0988888888','hoanghuy1995@gmail.com','2025-06-04','2025-06-11',1400000.00,'Đã hủy','Sai thông tin ngày gửi','Số 168 Thượng Đình - Thanh Xuân - Hà Nội','2025-06-04 04:45:42','2025-06-03 23:58:42'),(17,1,'Hoàng Gia Huy','0988888888','hoanghuy1995@gmail.com','2025-06-08','2025-06-11',600000.00,'Đã trả phòng',NULL,'Số 168 Thượng Đình - Thanh Xuân - Hà Nội','2025-06-08 00:47:56','2025-06-07 17:48:21');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (23,'Balo'),(25,'Bát Ăn'),(26,'Bình Uống Nước'),(8,'Chó Alaska'),(6,'Chó Bắc Kinh'),(4,'Chó Chihuahua'),(12,'Chó Corgi'),(7,'Chó Dachshund'),(11,'Chó Golden Retriever'),(5,'Chó Phốc Minpin'),(3,'Chó Phốc Sóc'),(13,'Chó Poodle'),(1,'Chó Pug'),(2,'Chó Pull Pháp'),(9,'Chó Samoyed'),(10,'Chó Shiba Inu'),(22,'Đệm'),(29,'Đồ Ăn'),(28,'Đồ chơi'),(35,'Khay vệ sinh'),(24,'Lồng'),(14,'Mèo Anh'),(16,'Mèo Bengal'),(20,'Mèo Maine Coon'),(19,'Mèo Pharaoh'),(18,'Mèo Ragdoll'),(15,'Mèo Scottish'),(17,'Mèo Xiêm'),(27,'Quần Áo'),(21,'Xích Vòng Cổ');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'hoanghuy1995@gmail.com','âsâsâ','2025-01-20 12:34:40','2025-01-20 12:34:40');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Hoàng Gia Huy','$2y$10$bWMNy3h52b2AnzoOU2TLhexqCkOeD6hbN8.6Qdon3LbF8pb97JzYi','6eOmwW2iMrNxlHpoEaCrWecX1kzwyDRJ3BI72O2doTXa7K8Gjd00ZktKG1N3','Hoàng Gia Huy','hoanghuy1995@gmail.com','0987543322','Hà Nội',NULL,'2024-11-26 17:49:07','2025-06-02 12:48:47'),(2,'Tuấn Anh','$2y$10$YUzI6G6Vd/84eRqdpvx6qeI5Aw0gS3WwOzyHjZ5Xxvr0SiMveCzlO','mgI6yAHkYLpNvcghRcBwATztlIuEH90f4h7TMkPuPE6AOoSLN8fnwmYqSeSN','Phạm Tuấn Anh','tuananh1234@gmail.com','0974653542','Hưng Yên',NULL,'2024-11-27 02:30:36','2025-05-29 18:19:04'),(3,'Văn Phúc','$2y$10$TalG5BeZ3ZWxH0EB/WP0TupBR7PwBjJ1Sd5usfzHUtXuboqqbhc9e','YYhIUbGsIvx8tBM0UYRbH6z71w9TYGeAJxv5e3FKuJ5mH5K7i6rzY5WsNcKC','Đặng Văn Phúc','taisaoemkhoc9z@gmail.com','0988888888','Chùa công luận 1-văn giang -Hưng Yên',NULL,'2025-05-29 18:05:03','2025-05-29 18:19:32'),(4,'Hoàng Huy Khanh','$2y$10$xkpIl3S.YSvnrv3KAmwxJeryh1h1wh30nrDejfeefA1Gf/wd5oxJC','ufhMHOHjb1VliGWV4y817jWAaouUiiPMlmKc7Bqspr5ILxB6mn324XfCkFDm','Hoàng Huy Khanh','dangphucvghy195@gmail.com','0988888888','Thanh trì-Hà Nội',NULL,'2025-05-29 18:21:32','2025-06-01 14:28:21');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_role` (`role_id`),
  CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Huanhoahong','$2y$10$liXh66i4NsGkXd4L8KmY2u31eKkCujQhPcaUlYzRFeYs32YXTZ3rO','Bùi Xuân Huấn','Huanhoahong1999@gmail.com','0988888888','2024-11-26 15:03:09','2024-11-26 08:03:09',NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content2` text NOT NULL,
  `content3` text NOT NULL,
  `content4` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `image_url4` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content5` text NOT NULL,
  `content6` text NOT NULL,
  `content7` text NOT NULL,
  `image_url5` varchar(255) DEFAULT NULL,
  `image_url6` varchar(255) DEFAULT NULL,
  `content8` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Dấu hiệu không khỏe của chó mèo','Chó và mèo là những người bạn đồng hành tuyệt vời, nhưng đôi khi chúng cũng có thể bị bệnh. Việc nhận biết sớm các dấu hiệu cho thấy thú cưng của bạn đang không khỏe là rất quan trọng để kịp thời đưa chúng đến bác sĩ thú y. Dưới đây là những dấu hiệu điển hình mà bạn nên chú ý mà Pet House đã tổng hợp, các bạn tham khảo nhé!','1. Thay đổi hành vi\r\nTrở nên uể oải: Nếu chó hoặc mèo của bạn trở nên lười biếng, không muốn chơi đùa, hoặc không tham gia vào các hoạt động mà chúng thường thích, đây có thể là dấu hiệu của sự không khỏe.\r\nTừ chối ăn uống: Việc bỏ ăn hoặc ăn ít hơn bình thường có thể là dấu hiệu của bệnh hoặc đau đớn.\r\nTăng động hoặc lo âu: Một số thú cưng có thể trở nên quá hiếu động, lo âu hoặc kích thích nếu chúng cảm thấy không khỏe.','2. Vấn đề với ăn uống\r\nBỏ ăn hoặc ăn không ngon miệng: Nếu chó hoặc mèo của bạn từ chối thức ăn trong nhiều giờ hoặc ngày, điều này cần được chú ý.\r\nNôn hoặc tiêu chảy: Nôn mửa, tiêu chảy kéo dài hoặc có máu trong phân có thể cho thấy có vấn đề nghiêm trọng trong đường tiêu hóa.','3. Tình trạng da và lông\r\nRụng lông: Rụng lông nhiều hơn bình thường, hoặc có vảy, ngứa, đỏ da có thể cho thấy các vấn đề về da hoặc dị ứng.\r\nCó mùi hôi: Mùi hôi bất thường từ cơ thể hoặc miệng có thể là dấu hiệu của nhiễm khuẩn hoặc các vấn đề sức khỏe khác.','hanhvi.jpg','anuong.jpg','dalong.jpg','baitiet.jpg','Bác Sĩ :Trần Ngọc Hoa','2025-04-02 20:29:13','2025-05-17 20:38:53','4. Vấn đề về bài tiết\r\nĐi tiểu thường xuyên hoặc không thường xuyên: Nếu thấy chó hoặc mèo đi tiểu nhiều hơn hoặc ít hơn, hay bất thường trong việc đi cầu cũng cần chú ý.\r\nBí tiểu hoặc khó khăn khi đi tiểu: Nếu thấy thú cưng có vẻ đau đớn hoặc khó khăn khi cố gắng đi tiểu, hãy đưa chúng đến bác sĩ ngay lập tức.','5. Triệu chứng về hô hấp\r\nKhó thở hoặc thở khò khè: Nếu thấy chó hoặc mèo của bạn thở nhanh hơn bình thường, có tiếng khò khè hoặc ho, đây là dấu hiệu cần chú ý.\r\nChảy nước mũi hoặc mắt: Chảy nước mũi hay mắt có thể là dấu hiệu của nhiễm trùng hoặc dị ứng.','6. Tình trạng mắt và tai\r\nĐỏ hoặc sưng mắt: Mắt đỏ, sưng hoặc có chất nhầy có thể chỉ ra nhiễm trùng.\r\nTai đỏ hoặc có mùi: Tai có mùi hôi, tiết dịch bất thường có thể cho thấy nhiễm khuẩn hoặc nấm.','trieutrung.jpg','mat.jpg','Kết Luận\r\nChó và mèo không thể nói cho chúng ta biết khi nào chúng không khỏe, vì vậy việc theo dõi các dấu hiệu bất thường là rất quan trọng. Nếu bạn thấy bất kỳ triệu chứng nào trong số trên, hãy đưa chó hoặc mèo của bạn đến bác sĩ thú y để được khám và chẩn đoán kịp thời. Chăm sóc sức khỏe cho thú cưng không chỉ giúp chúng khỏe mạnh mà còn mang lại sự an tâm cho bạn'),(2,'Phụ Kiện Cho Di Chuyển: Nên Chọn Loại Nào Cho Chó Mèo Khi Đi Xa?','Di chuyển với thú cưng ngày càng trở nên phổ biến, nhưng việc lựa chọn phụ kiện phù hợp cho chó mèo khi đi xa cũng rất quan trọng. Dưới đây là những gợi ý cho ba trường hợp điển hình: gia đình có con nhỏ, gia đình không có con nhỏ và người độc thân mà Pet House đã tìm hiểu và tổng hợp, các bạn tham khảo nhé!','1. Gia Đình Có Con Nhỏ:Khi di chuyển với cả chó hoặc mèo và trẻ nhỏ, việc an toàn và tiện lợi là ưu tiên hàng đầu. Một vài phụ kiện thiết yếu bao gồm:\r\n\r\nBộ đựng nước và thức ăn: Nên chọn loại có thể gập lại và dễ dàng mang theo. Một bộ đựng tích hợp sẽ tiết kiệm không gian và thời gian.\r\nKhay hoặc túi đựng di động: Để đảm bảo vật nuôi không bị rơi khỏi xe, gia đình có thể sử dụng túi hoặc khoang riêng cho thú cưng, giúp tạo cảm giác an toàn cho cả trẻ em và thú cưng.\r\nDây xích và đai an toàn: Các phụ kiện này không chỉ giúp giữ chó mèo an toàn mà cũng ngăn chúng làm xao lạc trong lúc di chuyển. Nên chọn loại dây có thể điều chỉnh độ dài và có khóa an toàn.\r\nSản phẩm tham khảo:\r\n\r\nBộ đựng nước và thức ăn\r\n\r\nKhay hoặc túi đựng di động\r\n\r\nDây xích hoặc đai an toàn','2. Gia Đình Không Có Con Nhỏ:. Các phụ kiện cần thiết là:\r\n\r\nXe đẩy thú cưng: Rất hữu ích nếu bạn đi dạo hoặc đi chơi dài ngày. Xe đẩy có thể chứa thú cưng giúp chúng đỡ mệt, đồng thời dễ dàng di chuyển trong đám đông.\r\nGiỏ đặc biệt cho xe hơi: Giúp thú cưng ngồi thoải mái và an toàn trong xe. Một giỏ có thiết kế thoáng khí sẽ đảm bảo thú cưng không bị căng thẳng.\r\nĐồ chơi và bát ăn di động: Có thể mang theo một số đồ chơi yêu thích để giúp thú cưng cảm thấy thoải mái hơn trong suốt chuyến đi. Bát ăn có thể gập lại sẽ tiết kiệm không gian.\r\nSản phẩm tham khảo:\r\n\r\nVật dụng di chuyển thú cưng\r\n\r\nĐồ chơi và bát ăn di động','3. Người Độc Thân :Đối với người độc thân, việc di chuyển cùng chó mèo thường đi kèm với một lối sống năng động. Các phụ kiện lý tưởng bao gồm:\r\n\r\nBalo hoặc túi đặc biệt cho thú cưng: Nên chọn loại có thể đeo giúp dễ dàng di chuyển trong các chuyến đi ngắn hoặc công tác. Loại túi này cũng cần có thiết kế thoáng khí và an toàn.\r\nDây xích đa năng: Loại dây có thể điều chỉnh độ dài hoặc biến thành đai an toàn trong xe sẽ rất tiện lợi cho những chuyến đi ngắn hoặc hoạt động ngoài trời.\r\nBình nước tự động: Đây là thiết bị rất cần thiết giúp giữ cho thú cưng luôn đủ nước, đặc biệt là trong những ngày hè nóng bức. Một bình nước dễ dàng sử dụng và mang theo sẽ mang lại sự tiện lợi cao.\r\nSản phẩm tham khảo\r\n\r\nBalo, túi di chuyển cho thú cưng\r\n\r\nDây xích\r\n\r\nBình nước','gd.jpg','kgd.jpg','mm.jpg','dl.jpg','Nhân viên tư vấn:Bùi Linh Huệ','2025-04-02 23:52:58','2025-04-02 23:56:09','.','.','.','mn.jpg','cm.jpg','Kết Luận\r\nViệc chọn phụ kiện di chuyển cho chó mèo tùy thuộc vào nhu cầu và hoàn cảnh sống của từng gia đình. Dù bạn có con nhỏ, không có con nhỏ hay là người độc thân, việc đảm bảo sự an toàn, thoải mái cho thú cưng trong mỗi chuyến đi là điều cần thiết. Hãy luôn chuẩn bị kỹ lưỡng và đưa ra lựa chọn phù hợp trước khi bắt đầu hành trình!'),(3,'5 loại giun và sán thường gặp ở chó mèo','Chó và mèo, những người bạn thân thiết trong mỗi gia đình, tuy là nguồn vui lớn nhưng vẫn có thể mang theo những nguy cơ sức khỏe. Giun và sán là hai loại ký sinh trùng thường gặp ở thú cưng, ảnh hưởng không nhỏ đến sức khỏe của chúng. Không chỉ gây bệnh cho động vật, những ký sinh trùng này còn có khả năng lây lan sang con người. Bài viết dưới đây sẽ khám phá năm loại giun và sán phổ biến, từ đặc điểm nhận diện đến cách phòng ngừa, nhằm bảo vệ sức khỏe cho cả thú cưng và gia đình bạn.','1. Giun đũa (Toxocara canis và Toxocara cati) :Miêu tả: Giun đũa là loại ký sinh trùng phổ biến nhất ở chó và mèo. Giun trưởng thành có hình dáng dài, từ 4 đến 18 cm, và có màu vàng nhạt hoặc nâu.\r\nTriệu chứng: Thú cưng có thể bị nôn mửa, tiêu chảy, bụng to (chướng bụng), và mệt mỏi. Trong trường hợp nghiêm trọng, giun có thể gây tắc ruột.\r\nPhương pháp điều trị: Điều trị bằng thuốc tẩy giun theo chỉ định của bác sĩ thú y.','2.Giun móc (Ancylostoma spp. và Uncinaria stenocephala):\r\nMiêu tả: Giun móc là loại ký sinh trùng nhỏ hơn, thường có chiều dài khoảng 1-2 cm. Chúng có thể bám vào niêm mạc ruột để hút máu.\r\nTriệu chứng: Ngứa ngáy, triệu chứng tiêu chảy, có thể có máu trong phân, và thú cưng có thể giữ tư thế khúm núm do đau đớn.\r\nPhương pháp điều trị: Sử dụng thuốc tẩy giun được chỉ định và thực hiện xét nghiệm phân định kỳ.','3. Giun chỉ (Dirofilaria immitis):bên trái, con cái bên phải\r\nMiêu tả: Giun chỉ, hay còn gọi là giun tim, được truyền từ chó sang chó qua muỗi. Chúng có thể sống trong tim và mạch máu lớn.\r\nTriệu chứng: Giai đoạn đầu có thể không có triệu chứng, nhưng khi bệnh tiến triển, chó có thể bị ho, mệt mỏi, khó thở, và có thể dẫn đến suy tim.\r\nPhương pháp điều trị: Cần sự can thiệp của bác sĩ thú y, thường sử dụng thuốc tiêm để tiêu diệt giun trưởng thành và thuốc để tiêu diệt ấu trùng.','gdua.jpg','gmoc.jpg','gchi.jpg','san-day.jpg','Nhân viên thú y:Hoa Khúc Bạch','2025-04-03 00:12:06','2025-04-03 00:13:41','4.Sán dây (Dipylidium caninum):Miêu tả: Sán dây thường có hình dạng dẹt và có thể dài từ 10 đến 50 cm. Loại sán này thường nhiễm qua bọ chét hoặc khi chó mèo ăn phải động vật có mang ấu trùng.\r\nTriệu chứng: Thú cưng có thể bị ngứa hậu môn, thấy các mảnh sán ở quanh vùng hậu môn hoặc trong phân, và có thể có triệu chứng tiêu hóa như nôn mửa.\r\nPhương pháp điều trị: Sử dụng thuốc tẩy sán theo chỉ định và cố gắng phòng ngừa hoặc chữa trị bọ chét ở chó mèo.','5. Sán lá gan (Fasciola hepatica):Miêu tả: Đây là loại sán ký sinh trong gan, thường gặp ở chó khi ăn phải cá hoặc thực phẩm bị nhiễm khuẩn.\r\nTriệu chứng: Có thể gây sốt, giảm cân, vàng da, và đau bụng. Trong trường hợp nặng, có thể gây tổn thương nghiêm trọng đến gan.\r\nPhương pháp điều trị: Cần được khám và điều trị bởi bác sĩ thú y với thuốc kháng sán phù hợp.','6.Các sản phẩm tham khảo:\r\n\r\nThuốc xổ giun cho chó Drontal\r\n\r\nThuốc tẩy giun Bio dạng viên dành cho chó mèo\r\n\r\nThuốc tẩy giun Drontal dạng nước dành cho chó mèo\r\n\r\nThuốc tẩy giun Exotral dành cho chó mèo\r\n\r\nThuốc tẩy giun sán chó mèo Sanpet\r\n\r\nThuốc xổ giun cho chó Endogard','san-la-gan.jpg','thuoc-tay.jpg','Kết luận\r\nViệc nắm rõ các loại giun và sán thường gặp ở chó và mèo sẽ giúp bạn có biện pháp phòng ngừa và điều trị kịp thời. Bạn nên thực hiện định kỳ kiểm tra sức khỏe và đưa thú cưng của mình đến bác sĩ thú y để kiểm soát ký sinh trùng hiệu quả. Ngoài ra, việc chăm sóc vệ sinh, giữ cho thú cưng không tiếp xúc với nguồn lây nhiễm và tiêm phòng cũng rất quan trọng trong việc bảo vệ sức khỏe của chúng.');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `pet_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,57,1,22000000.00,'Chó Samoyed lớn, lông trắng bông.','2025-05-15 14:58:26','2025-05-15 07:58:26','Chó Samoyed 1.jpg'),(2,2,91,1,7000000.00,'Mèo Anh lông ngắn, thân thiện.','2025-05-16 07:13:15','2025-05-16 00:13:15','meo_anh6.jpg'),(3,3,86,1,13500000.00,'Poodle nhỏ gọn và dễ chăm sóc.','2025-05-19 09:39:16','2025-05-19 02:39:16','Chó Poodle4.jpg'),(4,4,6,1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','2025-05-19 15:58:49','2025-05-19 08:58:49','pug6.jpg'),(5,6,125,1,150000.00,'Vòng đeo cổ chuông lúc lắc','2025-05-20 16:22:48','2025-05-20 09:22:48','laco.jpg'),(6,7,125,1,150000.00,'Vòng đeo cổ chuông lúc lắc','2025-05-20 16:23:40','2025-05-20 09:23:40','laco.jpg'),(7,8,3,1,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','2025-05-20 16:27:29','2025-05-20 09:27:29','pug3.jpg'),(8,9,33,1,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','2025-05-20 16:29:50','2025-05-20 09:29:50','cogi2.jpg'),(9,10,33,1,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','2025-05-20 16:33:54','2025-05-20 09:33:54','cogi2.jpg'),(10,11,99,1,12000000.00,'Maine Coon lông dài, dễ thương.','2025-05-20 16:36:15','2025-05-20 09:36:15','Maine Coon5.jpg'),(11,13,99,1,12000000.00,'Maine Coon lông dài, dễ thương.','2025-05-20 17:15:00','2025-05-20 10:15:00','Maine Coon5.jpg'),(12,14,89,1,7000000.00,'Mèo Anh lông ngắn, thân thiện.','2025-05-20 17:21:45','2025-05-20 10:21:45','meo_anh4.jpg'),(13,15,107,1,500000.00,'Balo tiện dụng để mang thú cưng.','2025-05-22 12:10:40','2025-05-22 05:10:40','balo1.jpg'),(14,16,108,1,200000.00,'Bát ăn bằng inox chống trượt.','2025-05-22 12:13:38','2025-05-22 05:13:38','bat1.jpg'),(15,17,108,1,200000.00,'Bát ăn bằng inox chống trượt.','2025-05-23 17:16:28','2025-05-23 10:16:28','bat1.jpg'),(16,18,108,1,200000.00,'Bát ăn bằng inox chống trượt.','2025-05-23 17:18:00','2025-05-23 10:18:00','bat1.jpg'),(17,19,108,1,200000.00,'Bát ăn bằng inox chống trượt.','2025-05-23 17:20:14','2025-05-23 10:20:14','bat1.jpg'),(18,20,117,1,200000.00,'Bát ăn bằng inox chống trượt.','2025-05-23 17:35:07','2025-05-23 10:35:07','bat2.jpg'),(19,21,3,1,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','2025-05-25 06:19:25','2025-05-24 23:19:25','pug3.jpg'),(20,22,47,1,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','2025-05-26 06:21:03','2025-05-25 23:21:03','shiba5.jpg'),(21,23,37,1,18000000.00,'Golden Retriever thân thiện, dễ huấn luyện.','2025-05-26 06:40:43','2025-05-25 23:40:43','golden1.jpg'),(22,23,11,1,12000000.00,'Chó Pull Pháp năng động, lông mượt.','2025-05-26 06:40:43','2025-05-25 23:40:43','bull_phap5.jpg'),(23,24,72,1,23000000.00,'Samoyed thân thiện, lông dày đẹp.','2025-05-28 07:31:11','2025-05-28 00:31:11','Chó Samoyed 4.jpg'),(24,25,72,1,23000000.00,'Samoyed thân thiện, lông dày đẹp.','2025-05-28 07:31:11','2025-05-28 00:31:11','Chó Samoyed 4.jpg'),(25,26,21,1,9000000.00,'Chó Bắc Kinh nhỏ gọn, thông minh.','2025-05-28 07:35:22','2025-05-28 00:35:22','bac_kinh3.jpg'),(26,27,21,1,9000000.00,'Chó Bắc Kinh nhỏ gọn, thông minh.','2025-05-28 07:40:29','2025-05-28 00:40:29','bac_kinh3.jpg'),(27,28,76,1,17500000.00,'Bengal năng động, thân thiện với người.','2025-05-28 07:41:45','2025-05-28 00:41:45','bengal4.jpg'),(28,29,47,1,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','2025-05-29 03:22:23','2025-05-28 20:22:23','shiba5.jpg'),(29,30,44,1,19500000.00,'Shiba năng động và thông minh.','2025-05-29 04:47:50','2025-05-28 21:47:50','shiba7.jpg'),(30,31,2,1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','2025-05-29 17:05:23','2025-05-29 10:05:23','pug2.jpg'),(31,32,4,1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','2025-05-29 17:28:18','2025-05-29 10:28:18','pug4.jpg'),(32,33,147,1,1300000.00,'Chuồng chó mèo bằng sắt sàn nhựa','2025-05-29 17:49:35','2025-05-29 10:49:35','chuong-cho-meo-bang-sat-san-nhua-aupet-dog-cage-400x400-1.webp'),(33,34,31,1,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','2025-05-29 18:23:10','2025-05-29 11:23:10','cogi1.jpg'),(34,35,77,1,20000000.00,'Mèo Pharaoh không lông, ngoại hình độc đáo.','2025-05-30 02:51:15','2025-05-29 19:51:15','Mèo Pharaoh2.jpg'),(35,36,126,1,300000.00,'Balo để mang theo thú cưng đi chơi','2025-05-30 03:13:58','2025-05-29 20:13:58','balo3.jpg'),(36,37,45,1,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','2025-05-31 01:56:38','2025-05-30 18:56:38','shiba3.jpg'),(37,38,29,2,8000000.00,'Chó Chihuahua nhỏ gọn, tinh nghịch.','2025-05-31 02:33:32','2025-05-30 19:33:32','cho-Chihuahua-5.jpg'),(38,38,86,2,13500000.00,'Poodle nhỏ gọn và dễ chăm sóc.','2025-05-31 02:33:32','2025-05-30 19:33:32','Chó Poodle4.jpg'),(39,38,85,4,13000000.00,'Chó Poodle dễ thương, lông xoăn.','2025-05-31 02:33:32','2025-05-30 19:33:32','Chó Poodle3.jpg'),(40,39,20,1,9500000.00,'Chó Bắc Kinh thân thiện, dễ chăm sóc.','2025-06-01 06:35:10','2025-05-31 23:35:10','bac_kinh2.jpg'),(41,40,7,1,12000000.00,'Chó Pull Pháp năng động, lông mượt.','2025-06-01 13:26:43','2025-06-01 06:26:43','bull_phap4.jpg'),(42,41,55,1,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','2025-06-01 14:41:25','2025-06-01 07:41:25','Chó Dachshund1.jpg'),(43,42,69,1,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','2025-06-01 14:44:34','2025-06-01 07:44:34','Chó Dachshund3.jpg'),(44,43,69,1,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','2025-06-01 14:50:01','2025-06-01 07:50:01','Chó Dachshund3.jpg'),(45,44,69,1,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','2025-06-01 14:54:01','2025-06-01 07:54:01','Chó Dachshund3.jpg'),(46,45,7,1,12000000.00,'Chó Pull Pháp năng động, lông mượt.','2025-06-01 15:34:57','2025-06-01 08:34:57','bull_phap4.jpg'),(47,46,146,1,4600000.00,'Chuồng gỗ cho chó mèo 2 tầng','2025-06-02 13:34:21','2025-06-02 06:34:21','chuong-go-cho-cho-meo-2-tang-RICHELL-rc09-400x400-1.webp'),(48,47,1,2,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','2025-06-04 04:34:14','2025-06-03 21:34:14','dog8.png'),(49,48,7,1,12000000.00,'Chó Pull Pháp năng động, lông mượt.','2025-06-08 00:40:41','2025-06-07 17:40:41','bull_phap4.jpg');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Chờ xác nhận',
  `stock_deducted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `country` varchar(100) DEFAULT 'Vietnam',
  `postal_code` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `payment` varchar(225) DEFAULT NULL,
  `customer_name` varchar(225) DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,'2025-05-15 21:58:26',22000000.00,'Hoàn thành',1,'2025-05-15 14:58:26','2025-05-19 02:40:34','0988888888','Thanh Trì-Hà Nội','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(2,NULL,'2025-05-16 14:13:15',7000000.00,'Hoàn thành',0,'2025-05-16 07:13:15','2025-05-19 02:40:38','0988888888','Hưng Yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy',NULL),(3,NULL,'2025-05-19 16:39:16',13500000.00,'Hoàn thành',1,'2025-05-19 09:39:16','2025-05-19 02:40:31','0988888888','Hưng Yên','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(4,NULL,'2025-05-19 22:58:49',8500000.00,'Hoàn thành',0,'2025-05-19 15:58:49','2025-05-20 09:27:43','0988888888','hung yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy',NULL),(6,NULL,'2025-05-20 16:22:48',150000.00,'Hoàn thành',1,'2025-05-20 16:22:48','2025-05-20 09:22:48','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,NULL,'Phạm Tuấn Anh',NULL),(7,NULL,'2025-05-20 16:23:40',150000.00,'Hoàn thành',1,'2025-05-20 16:23:40','2025-05-20 09:23:40','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,NULL,'Phạm Tuấn Anh',NULL),(8,NULL,'2025-05-20 16:27:29',8000000.00,'Hoàn thành',1,'2025-05-20 16:27:29','2025-05-20 09:27:29','0988888888','Thị trấn Văn Giang','Vietnam',NULL,NULL,'cash','Hoàng Huy Khanh',NULL),(9,NULL,'2025-05-20 16:29:50',15000000.00,'Hoàn thành',1,'2025-05-20 16:29:50','2025-05-20 09:29:50','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,'cash','Phạm Tuấn Anh',NULL),(10,NULL,'2025-05-20 16:33:54',15000000.00,'Hoàn thành',1,'2025-05-20 16:33:54','2025-05-20 09:33:54','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,'cash','Hoàng Gia Huy',NULL),(11,NULL,'2025-05-20 16:36:15',12000000.00,'Hoàn thành',1,'2025-05-20 16:36:15','2025-05-20 09:36:15','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,'cash','Phạm Tuấn Anh',NULL),(13,NULL,'2025-05-20 17:15:00',12000000.00,'Hoàn thành',1,'2025-05-20 17:15:00','2025-05-20 10:15:00','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,'cash','Hoàng Huy Khanh',NULL),(14,NULL,'2025-05-20 17:21:45',7000000.00,'Hoàn thành',0,'2025-05-20 17:21:45','2025-05-20 10:21:45','0988888888','Chùa công luận 1-văn giang -Hưng Yên','Vietnam',NULL,NULL,'cash','Hoàng Huy Khanh',NULL),(15,NULL,'2025-05-22 19:10:40',500000.00,'Hoàn thành',1,'2025-05-22 12:10:40','2025-05-27 06:39:32','0988888888','Hà Nội','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(16,NULL,'2025-05-22 19:13:38',200000.00,'Đã hủy',0,'2025-05-22 12:13:38','2025-05-23 10:04:19','0988888888','Hung Yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy',NULL),(17,NULL,'2025-05-24 00:16:28',200000.00,'Đã hủy',0,'2025-05-23 17:16:28','2025-05-23 10:19:19','0988888888','Hưng yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy',NULL),(18,NULL,'2025-05-24 00:18:00',200000.00,'Đã hủy',0,'2025-05-23 17:18:00','2025-05-23 10:18:17','0988888888','hgg','Vietnam','HN09779','dangphucvghy195@gmail.com','cash','Hoàng Gia Huy',NULL),(19,NULL,'2025-05-24 00:20:14',200000.00,'Đã hủy',0,'2025-05-23 17:20:14','2025-05-23 10:20:26','0985289442','x','Vietnam','HY13586','huyquanhoa@gmail.com','cash','Hoàng Gia Huy',NULL),(20,NULL,'2025-05-24 00:35:07',200000.00,'Đã hủy',0,'2025-05-23 17:35:07','2025-05-23 10:40:32','0987543322','Hung yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy','Thay đổi địa chỉ/số điện thoại'),(21,NULL,'2025-05-25 13:19:25',8000000.00,'Hoàn thành',0,'2025-05-25 06:19:25','2025-05-27 06:39:23','0988888888','Hưng Yên','Vietnam','HY13586','hoanghuy1995@gmail.com','cash','Hoàng Gia Huy',NULL),(22,NULL,'2025-05-26 13:21:02',20000000.00,'Hoàn thành',0,'2025-05-26 06:21:02','2025-05-28 00:29:17','0985289442','s','Vietnam','HY13586','huyquanhoa@gmail.com','cash','Hoàng Huy Khanh',NULL),(23,NULL,'2025-05-26 13:40:43',30000000.00,'Hoàn thành',1,'2025-05-26 06:40:43','2025-05-27 06:50:23','0988888888','Hưng Yên','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(24,NULL,'2025-05-28 14:31:11',23000000.00,'Hoàn thành',0,'2025-05-28 07:31:11','2025-05-28 00:32:14','0988888888','df','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(25,NULL,'2025-05-28 14:31:11',23000000.00,'Hoàn thành',1,'2025-05-28 07:31:11','2025-05-28 00:32:15','0988888888','df','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(26,NULL,'2025-05-28 14:35:22',9000000.00,'Hoàn thành',1,'2025-05-28 07:35:22','2025-05-28 00:40:51','0988888888','Hà nội','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(27,NULL,'2025-05-28 14:40:29',9000000.00,'Hoàn thành',0,'2025-05-28 07:40:29','2025-05-28 00:40:50','0988888888','s','Vietnam','HY13586','hoanghuy1995@gmail.com','Cod','Hoàng Gia Huy',NULL),(28,NULL,'2025-05-28 14:41:45',17500000.00,'Hoàn thành',1,'2025-05-28 07:41:45','2025-05-28 04:51:08','0988888888','fd','Vietnam','HY13586','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(29,NULL,'2025-05-29 10:22:23',20000000.00,'Hoàn thành',1,'2025-05-29 03:22:23','2025-05-29 11:25:45','0988888888','Ngọc Hồi -Thanh Trì -Hà Nội','Vietnam','HN09779','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(30,NULL,'2025-05-29 11:47:50',19500000.00,'Hoàn thành',1,'2025-05-29 04:47:50','2025-05-29 11:25:47','0988888888','Ngọc Hồi-Thanh Trì-Hà Nội','Vietnam','HN09779','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(31,NULL,'2025-05-30 00:05:23',8500000.00,'Hoàn thành',1,'2025-05-29 17:05:23','2025-05-29 11:25:49','0988888888','Hưng Yên','Vietnam','HY13586','dangphucvghy195@gmail.com','vnpay','Hoàng Gia Huy',NULL),(32,NULL,'2025-05-30 00:28:18',8500000.00,'Hoàn thành',1,'2025-05-29 17:28:18','2025-05-29 11:25:51','0988888888','Hà Nội','Vietnam','HY13586','pvan58592@gmail.com','vnpay','Hoàng Gia Huy',NULL),(33,NULL,'2025-05-30 00:49:35',1300000.00,'Hoàn thành',1,'2025-05-29 17:49:35','2025-05-29 11:25:53','0988888888','Hà nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','vnpay','Hoàng Gia Huy',NULL),(34,NULL,'2025-05-30 01:23:10',15000000.00,'Hoàn thành',1,'2025-05-29 18:23:10','2025-05-29 11:25:55','0988888888','thanh trì hà nội','Vietnam','HN09779','dangphucvghy195@gmail.com','vnpay','Hoàng Huy Khanh',NULL),(35,NULL,'2025-05-30 09:51:15',20000000.00,'Hoàn thành',1,'2025-05-30 02:51:15','2025-05-31 20:43:01','0985289442','Hà Nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','vnpay','Hoàng Huy Khanh',NULL),(36,NULL,'2025-05-30 10:13:58',300000.00,'Hoàn thành',0,'2025-05-30 03:13:58','2025-05-31 20:43:00','0988888888','Hà Nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','Cod','Hoàng Huy Khanh',NULL),(37,NULL,'2025-05-31 08:56:38',20000000.00,'Đã hủy',0,'2025-05-31 01:56:38','2025-05-30 19:11:32','0988888888','gf','Vietnam','HN09779','huyquanhoa@gmail.com','vnpay','Hoàng Huy Khanh',NULL),(38,NULL,'2025-05-31 09:33:32',95000000.00,'Hoàn thành',1,'2025-05-31 02:33:32','2025-05-31 20:42:58','0988888888','cv','Vietnam','HN09779','huyquanhoa@gmail.com','vnpay','Hoàng Huy Khanh',NULL),(39,NULL,'2025-06-01 13:35:10',9500000.00,'Hoàn thành',0,'2025-06-01 06:35:10','2025-05-31 23:35:23','0988888888','fg','Vietnam','HN09779','hoanghuy1995@gmail.com','Cod','Hoàng Huy Khanh',NULL),(40,NULL,'2025-06-01 20:26:43',12000000.00,'Đã hủy',0,'2025-06-01 13:26:43','2025-06-01 06:31:32','0988888888','Hà Nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','Cod','Hoàng Huy Khanh','Thay đổi địa điểm'),(41,NULL,'2025-06-01 21:41:25',12000000.00,'Hoàn thành',0,'2025-06-01 14:41:25','2025-06-01 07:43:01','0964505836','Thị trấn Văn Giang -Văn Giang-Hưng Yên','Vietnam','HY13586','taisaoemkhoc9z@gmail.com','vnpay','Đặng Văn Phúc',NULL),(42,NULL,'2025-06-01 21:44:34',12000000.00,'Hoàn thành',0,'2025-06-01 14:44:34','2025-06-01 07:49:17','0964505836','Thị trấn Văn Giang-Văn Giang-Hưng Yên','Vietnam','HY13586','taisaoemkhoc9z@gmail.com','vnpay','Đặng Văn Phúc',NULL),(43,NULL,'2025-06-01 21:50:01',12000000.00,'Hoàn thành',0,'2025-06-01 14:50:01','2025-06-01 07:54:58','0964505836','Hà NỘI','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','vnpay','Đặng Văn Phúc',NULL),(44,NULL,'2025-06-01 21:54:01',12000000.00,'Hoàn thành',1,'2025-06-01 14:54:01','2025-06-01 07:54:56','0964505836','Hà Nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','vnpay','Đặng Văn Phúc',NULL),(45,NULL,'2025-06-01 22:34:57',12000000.00,'Hoàn thành',1,'2025-06-01 15:34:57','2025-06-01 08:35:41','0964505836','Hà Nội','Vietnam','HN09779','taisaoemkhoc9z@gmail.com','vnpay','Đặng Văn Phúc',NULL),(46,NULL,'2025-06-02 20:34:21',4600000.00,'Hoàn thành',0,'2025-06-02 13:34:21','2025-06-03 21:39:21','0988888888','Hà Nội','Vietnam','HN09779','hoanghuy1995@gmail.com','Cod','Hoàng Gia Huy',NULL),(47,NULL,'2025-06-04 11:34:14',16000000.00,'Hoàn thành',1,'2025-06-04 04:34:14','2025-06-03 21:35:39','0988888888','Hà Nội','Vietnam','HN09779','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL),(48,NULL,'2025-06-08 07:40:41',12000000.00,'Đã hủy',1,'2025-06-08 00:40:41','2025-06-07 17:42:16','0988888888','hà nội','Vietnam','HN09779','hoanghuy1995@gmail.com','vnpay','Hoàng Gia Huy',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,17,'momo',NULL,'pending','2025-03-30 22:35:39','2025-03-30 22:35:39'),(2,18,'momo',NULL,'pending','2025-03-30 22:36:19','2025-03-30 22:36:19'),(3,19,'cash',NULL,'pending','2025-03-30 22:43:28','2025-03-30 22:43:28'),(4,20,'cash',NULL,'pending','2025-03-30 23:15:46','2025-03-30 23:15:46'),(5,22,'momo',NULL,'pending','2025-03-30 23:29:36','2025-03-30 23:29:36'),(6,23,'cash',NULL,'pending','2025-03-30 23:34:08','2025-03-30 23:34:08'),(7,24,'cash',NULL,'pending','2025-03-30 23:44:44','2025-03-30 23:44:44'),(8,25,'cash',NULL,'pending','2025-03-31 00:02:18','2025-03-31 00:02:18'),(9,26,'cash',NULL,'pending','2025-03-31 00:12:26','2025-03-31 00:12:26'),(10,27,'cash',NULL,'pending','2025-03-31 00:13:25','2025-03-31 00:13:25'),(11,28,'cash',NULL,'pending','2025-03-31 00:18:26','2025-03-31 00:18:26'),(12,29,'cash',NULL,'pending','2025-03-31 00:19:28','2025-03-31 00:19:28'),(13,30,'cash',NULL,'pending','2025-03-31 00:25:11','2025-03-31 00:25:11'),(14,1,'cash',NULL,'pending','2025-03-31 22:40:22','2025-03-31 22:40:22'),(15,2,'cash',NULL,'pending','2025-05-05 23:47:15','2025-05-05 23:47:15'),(16,3,'cash',NULL,'pending','2025-05-06 00:11:02','2025-05-06 00:11:02'),(17,4,'cash',NULL,'pending','2025-05-09 19:36:41','2025-05-09 19:36:41'),(18,7,'cash',NULL,'pending','2025-05-09 23:02:40','2025-05-09 23:02:40');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pets` (
  `pet_id` int NOT NULL AUTO_INCREMENT,
  `species` varchar(50) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'available',
  `category_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` varchar(10) DEFAULT NULL,
  `quantity_in_stock` int DEFAULT '0',
  `quantity_sold` int DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
INSERT INTO `pets` VALUES (1,'Chó','Pug',2,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','dog8.png','available',1,'2024-11-23 13:22:35','2025-06-04 04:34:14','male',104,8,'cho-pug-nho-gon-thong-minh-va-dang-yeu'),(2,'Chó','Pug',1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','pug2.jpg','on',1,'2024-11-23 13:22:35','2025-05-29 17:05:23','male',1,11,NULL),(3,'Chó','Pug',2,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','pug3.jpg','on',1,'2024-11-23 13:22:35','2025-05-25 06:19:25','male',1,4,NULL),(4,'Chó','Pug',1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','pug4.jpg','on',1,'2024-11-23 13:22:35','2025-05-29 17:28:18','male',4,1,NULL),(5,'Chó','Pug',2,8000000.00,'Chó Pug nhỏ gọn, thông minh và đáng yêu.','bull_phap5.jpg','on',1,'2024-11-23 13:22:35','2025-05-13 22:26:07','male',3,1,NULL),(6,'Chó','Pug',1,8500000.00,'Chó Pug thân thiện, phù hợp nuôi trong nhà.','pug6.jpg','on',1,'2024-11-23 13:22:35','2025-05-19 15:58:49','male',2,2,NULL),(7,'Chó','Pull Pháp',2,12000000.00,'Chó Pull Pháp năng động, lông mượt.','bull_phap4.jpg','on',2,'2024-11-23 13:22:35','2025-06-08 00:40:41','male',2,3,'cho-pull-phap-nang-dong-long-muot'),(8,'Chó','Pull Pháp',1,11500000.00,'Chó Pull Pháp thân thiện và thông minh.','bull_phap2.png','on',2,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',6,1,NULL),(9,'Chó','Pull Pháp',2,12000000.00,'Chó Pull Pháp năng động, lông mượt.','bull_phap6.jpg','on',2,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(10,'Chó','Pull Pháp',1,11500000.00,'Chó Pull Pháp thân thiện và thông minh.','bull_phap1.jpg','on',2,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',3,1,NULL),(11,'Chó','Pull Pháp',2,12000000.00,'Chó Pull Pháp năng động, lông mượt.','bull_phap5.jpg','on',2,'2024-11-23 13:22:35','2025-05-26 06:40:43','male',3,1,NULL),(12,'Chó','Pull Pháp',1,11500000.00,'Chó Pull Pháp thân thiện và thông minh.','bull_phap3.webp','on',2,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',-1,3,NULL),(13,'Chó','Phốc Sóc',1,10000000.00,'Chó Phốc Sóc lông bông, đáng yêu.','phoc_soc1.jpg','on',3,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(14,'Chó','Phốc Sóc',2,10500000.00,'Phốc Sóc thích hợp nuôi trong nhà.','phoc_soc2.jpg','on',3,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',6,0,NULL),(15,'Chó','Phốc Sóc',1,10000000.00,'Chó Phốc Sóc lông bông, đáng yêu.','phoc_soc3.jpg','on',3,'2024-11-23 13:22:35','2025-05-14 00:06:55','male',1,1,NULL),(16,'Chó','Phốc Sóc',2,10500000.00,'Phốc Sóc thích hợp nuôi trong nhà.','phoc_soc4.jpg','on',3,'2024-11-23 13:22:35','2025-05-13 23:58:02','male',2,1,NULL),(17,'Chó','Phốc Sóc',1,10000000.00,'Chó Phốc Sóc lông bông, đáng yêu.','phoc_soc5.jpg','on',3,'2024-11-23 13:22:35','2025-05-11 13:43:10','male',2,3,NULL),(18,'Chó','Phốc Sóc',2,10500000.00,'Phốc Sóc thích hợp nuôi trong nhà.','phoc_soc6.jpg','on',3,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',6,0,NULL),(19,'Chó','Bắc Kinh',3,9000000.00,'Chó Bắc Kinh nhỏ gọn, thông minh.','bac_kinh1.jpg','on',6,'2024-11-23 13:22:35','2025-05-15 12:32:54','male',1,3,NULL),(20,'Chó','Bắc Kinh',2,9500000.00,'Chó Bắc Kinh thân thiện, dễ chăm sóc.','bac_kinh2.jpg','on',6,'2024-11-23 13:22:35','2025-05-31 23:35:10','male',0,1,'cho-bac-kinh-than-thien-de-cham-soc'),(21,'Chó','Bắc Kinh',3,9000000.00,'Chó Bắc Kinh nhỏ gọn, thông minh.','bac_kinh3.jpg','out of stock',6,'2024-11-23 13:22:35','2025-05-28 07:40:29','male',0,2,NULL),(22,'Chó','Bắc Kinh',2,9500000.00,'Chó Bắc Kinh thân thiện, dễ chăm sóc.','bac_kinh4.jpg','on',6,'2024-11-23 13:22:35','2025-05-15 12:14:53','male',0,2,NULL),(23,'Chó','Bắc Kinh',3,9000000.00,'Chó Bắc Kinh nhỏ gọn, thông minh.','bac_kinh5.jpg','on',6,'2024-11-23 13:22:35','2025-05-11 14:04:21','male',1,2,NULL),(24,'Chó','Bắc Kinh',2,9500000.00,'Chó Bắc Kinh thân thiện, dễ chăm sóc.','bac_kinh6.jpg','on',6,'2024-11-23 13:22:35','2025-01-07 02:15:53','male',3,0,NULL),(25,'Chó','Chihuahua',1,8000000.00,'Chó Chihuahua nhỏ gọn, tinh nghịch.','cho-Chihuahua-1.jpg','on',4,'2024-11-23 13:22:35','2025-05-14 00:48:35','male',1,1,NULL),(26,'Chó','Chihuahua',2,8500000.00,'Chihuahua nhanh nhẹn và thông minh.','cho-Chihuahua-2.jpg','on',4,'2024-11-23 13:22:35','2025-05-15 14:42:01','male',2,1,NULL),(27,'Chó','Chihuahua',1,8000000.00,'Chó Chihuahua nhỏ gọn, tinh nghịch.','cho-Chihuahua-3.jpg','on',4,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',-1,4,NULL),(28,'Chó','Chihuahua',2,8500000.00,'Chihuahua nhanh nhẹn và thông minh.','chh.jpg','on',4,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',4,1,'chihuahua-nhanh-nhen-va-thong-minh'),(29,'Chó','Chihuahua',1,8000000.00,'Chó Chihuahua nhỏ gọn, tinh nghịch.','cho-Chihuahua-5.jpg','on',4,'2024-11-23 13:22:35','2025-05-31 02:33:32','male',1,2,NULL),(30,'Chó','Chihuahua',2,8500000.00,'Chó Chihuahua nhanh nhẹn và thông minh.','cho-Chihuahua-6.jpg','on',4,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(31,'Chó','Corgi',2,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','cogi1.jpg','on',12,'2024-11-23 13:22:35','2025-05-29 18:23:10','male',4,1,NULL),(32,'Chó','Corgi',1,15500000.00,'Chó Corgi phù hợp cho gia đình.','cogi3.jpg','on',12,'2024-11-23 13:22:35','2025-02-25 22:15:19','male',5,0,NULL),(33,'Chó','Corgi',2,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','cogi2.jpg','on',12,'2024-11-23 13:22:35','2025-05-20 09:33:54','male',2,4,NULL),(34,'Chó','Corgi',1,15500000.00,'Chó Corgi phù hợp cho gia đình.','cogi4.jpg','on',12,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',6,0,NULL),(35,'Chó','Corgi',2,15000000.00,'Chó Corgi lùn, đuôi ngắn, đáng yêu.','cogi5.jpg','on',12,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',2,0,NULL),(36,'Chó','Corgi',1,15500000.00,'Chó Corgi phù hợp cho gia đình.','cogi6.jpg','on',12,'2024-11-23 13:22:35','2025-05-14 00:13:09','male',1,1,NULL),(37,'Chó','Golden Retriever',2,18000000.00,'Golden Retriever thân thiện, dễ huấn luyện.','golden1.jpg','on',11,'2024-11-23 13:22:35','2025-05-26 06:40:43','male',1,1,NULL),(38,'Chó','Golden Retriever',3,17500000.00,'Golden thông minh và trung thành.','golden2.jpg','on',11,'2024-11-23 13:22:35','2025-05-14 01:08:04','male',0,2,NULL),(39,'Chó','Golden Retriever',2,18000000.00,'Golden Retriever thân thiện, dễ huấn luyện.','golden3.jpg','on',11,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(40,'Chó','Golden Retriever',3,17500000.00,'Golden thông minh và trung thành.','golden4.jpg','on',11,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',2,1,NULL),(41,'Chó','Golden Retriever',2,18000000.00,'Golden Retriever thân thiện, dễ huấn luyện thông minh.','golden5.jpg','available',11,'2024-11-23 13:22:35','2025-05-27 10:04:28','male',1,1,'golden-retriever-than-thien-de-huan-luyen-thong-minh'),(42,'Chó','Golden Retriever',3,17500000.00,'Golden thông minh và trung thành.','golden6.jpg','on',11,'2024-11-23 13:22:35','2024-11-30 12:01:02','male',2,0,NULL),(43,'Chó','Shiba Inu',2,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','shiba1.jpg','on',10,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(44,'Chó','Shiba Inu',3,19500000.00,'Shiba năng động và thông minh.','shiba7.jpg','on',10,'2024-11-23 13:22:35','2025-05-29 04:47:50','male',2,1,NULL),(45,'Chó','Shiba Inu',2,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','shiba3.jpg','on',10,'2024-11-23 13:22:35','2025-05-31 01:56:38','male',3,1,NULL),(46,'Chó','Shiba Inu',3,19500000.00,'Shiba năng động và thông minh.','shiba6.jpg','on',10,'2024-11-23 13:22:35','2025-05-11 14:05:30','male',3,1,NULL),(47,'Chó','Shiba Inu',2,20000000.00,'Chó Shiba Inu tinh nghịch và đáng yêu.','shiba5.jpg','on',10,'2024-11-23 13:22:35','2025-05-29 03:22:23','male',3,2,NULL),(48,'Chó','Shiba Inu',3,19500000.00,'Shiba năng động và thông minh.','shiba4.jpg','on',10,'2024-11-23 13:22:35','2025-05-11 07:49:31','male',2,1,NULL),(49,'Chó','Alaska',2,25000000.00,'Chó Alaska lớn, lông mượt, thông minh.','alaska2.jpg','on',8,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',0,5,NULL),(50,'Chó','Alaska',1,26000000.00,'Chó Alaska thân thiện, dễ chăm sóc.','alaska1.jpg','on',8,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',-1,5,NULL),(51,'Chó','Alaska',2,25000000.00,'Chó Alaska lớn, lông mượt, thông minh.','alk.jpg','on',8,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',0,4,'cho-alaska-lon-long-muot-thong-minh'),(52,'Chó','Alaska',1,26000000.00,'Chó Alaska thân thiện, dễ chăm sóc.','alaska4.jpg','on',8,'2024-11-23 13:22:35','2025-05-15 06:59:19','male',0,4,'cho-alaska-than-thien-de-cham-soc'),(53,'Chó','Alaska',2,25000000.00,'Chó Alaska lớn, lông mượt, thông minh.','alaska5.jpg','on',8,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',-1,5,NULL),(54,'Chó','Alaska',1,26000000.00,'Chó Alaska thân thiện, dễ chăm sóc.','alaska6.jpg','on',8,'2024-11-23 13:22:35','2025-05-15 05:55:21','male',0,5,'cho-alaska-than-thien-de-cham-soc'),(55,'Chó','Dachshund',3,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','Chó Dachshund1.jpg','on',7,'2024-11-23 13:22:35','2025-06-01 14:41:25','male',1,3,'cho-dachshund-than-thien-hinh-dang-dang-yeu'),(56,'Chó','Dachshund',2,12500000.00,'Chó Dachshund nhỏ gọn, trung thành.','Chó Dachshund6.jpg','on',7,'2024-11-23 13:22:35','2025-05-15 05:37:46','male',2,2,'cho-dachshund-nho-gon-trung-thanh'),(57,'Chó','Samoyed',3,22000000.00,'Chó Samoyed lớn, lông trắng bông.','Chó Samoyed 1.jpg','on',9,'2024-11-23 13:22:35','2025-05-15 14:58:26','male',4,1,NULL),(58,'Chó','Samoyed',2,23000000.00,'Samoyed thân thiện, lông dày đẹp.','Chó Samoyed 2.jpg','on',9,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(59,'Chó','Phốc Minpin',2,10000000.00,'Chó Phốc Minpin nhỏ, lanh lợi.','Chó Phốc Minpin2.jpg','on',5,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(60,'Chó','Phốc Minpin',1,9500000.00,'Chó Phốc Minpin thông minh và trung thành.','Chó Phốc Minpin1.jpg','on',5,'2024-11-23 13:22:35','2025-05-13 23:51:37','male',3,1,NULL),(61,'Mèo','Bengal',2,17000000.00,'Mèo Bengal lông họa tiết đốm đẹp, thông minh.','begal1.jpg','on',16,'2024-11-23 13:22:35','2025-05-06 06:24:18','male',14,0,NULL),(62,'Mèo','Bengal',3,17500000.00,'Bengal năng động, thân thiện với người ưa nhìn thông minh.','bengal2.jpg','available',16,'2024-11-23 13:22:35','2025-05-27 09:59:33','male',10,0,'bengal-nang-dong-than-thien-voi-nguoi-ua-nhin-thong-minh'),(63,'Mèo','Pharaoh',1,20000000.00,'Mèo Pharaoh không lông, ngoại hình độc đáo.','Mèo Pharaoh1.jpg','on',19,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(64,'Mèo','Pharaoh',2,21000000.00,'Pharaoh thông minh, dễ chăm sóc.','Mèo Pharaoh3.jpg','on',19,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(65,'Mèo','Scottish',1,15000000.00,'Mèo Scottish tai cụp, dễ thương.','meo_scot2.jpg','on',15,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(66,'Mèo','Scottish',2,15500000.00,'Scottish thích hợp nuôi trong nhà.','meo_scot3.jpg','on',15,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(67,'Mèo','Xiêm',2,10000000.00,'Mèo Xiêm lông ngắn, đôi mắt xanh đẹp.','meo_xiem.jpg','on',17,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(68,'Mèo','Xiêm',1,9500000.00,'Mèo Xiêm thông minh nhanh nhẹn , dễ huấn luyện.','meo_xiem3.jpg','on',17,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(69,'Chó','Dachshund',3,12000000.00,'Chó Dachshund thân thiện, hình dáng đáng yêu.','Chó Dachshund3.jpg','on',7,'2024-11-23 13:22:35','2025-06-01 14:54:01','male',2,4,NULL),(70,'Chó','Dachshund',2,12500000.00,'Chó Dachshund nhỏ gọn, trung thành.','Chó Dachshund4.jpg','on',7,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',0,4,NULL),(71,'Chó','Samoyed',3,22000000.00,'Chó Samoyed lớn, lông trắng bông.','Chó Samoyed 3.jpg','on',9,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(72,'Chó','Samoyed',2,23000000.00,'Samoyed thân thiện, lông dày đẹp.','Chó Samoyed 4.jpg','on',9,'2024-11-23 13:22:35','2025-05-28 07:31:11','male',3,2,NULL),(73,'Chó','Phốc Minpin',2,10000000.00,'Chó Phốc Minpin nhỏ, lanh lợi.','Chó Phốc Minpin4.jpg','on',5,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(74,'Chó','Phốc Minpin',1,9500000.00,'Chó Phốc Minpin thông minh và trung thành.','Chó Phốc Minpin3.jpg','on',5,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(75,'Mèo','Bengal',2,17000000.00,'Mèo Bengal lông họa tiết đốm đẹp, thông minh.','bengal3.jpg','on',16,'2024-11-23 13:22:35','2025-05-13 23:33:25','male',3,1,NULL),(76,'Mèo','Bengal',3,17500000.00,'Bengal năng động, thân thiện với người.','bengal4.jpg','on',16,'2024-11-23 13:22:35','2025-05-28 07:41:45','male',4,1,NULL),(77,'Mèo','Pharaoh',1,20000000.00,'Mèo Pharaoh không lông, ngoại hình độc đáo.','Mèo Pharaoh2.jpg','on',19,'2024-11-23 13:22:35','2025-05-30 02:51:15','male',4,1,NULL),(78,'Mèo','Pharaoh',2,21000000.00,'Pharaoh thông minh, dễ chăm sóc.','Mèo Pharaoh4.jpg','on',19,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(79,'Mèo','Scottish',1,15000000.00,'Mèo Scottish tai cụp, dễ thương.','meo_scot4.jpg','on',15,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(80,'Mèo','Scottish',2,15500000.00,'Scottish thích hợp nuôi trong nhà.','meo_scot1.jpg','on',15,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(81,'Mèo','Xiêm',2,10000000.00,'Mèo Xiêm lông ngắn, đôi mắt xanh đẹp.','meo_xiem5.jpg','on',17,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(82,'Mèo','Xiêm',1,9500000.00,'Mèo Xiêm nhanh nhẹn, dễ huấn luyện.','meo_xiem4.jpg','on',17,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(83,'Chó','Poodle',1,13000000.00,'Chó Poodle dễ thương, lông xoăn.','poodle1.jpg','on',13,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(84,'Chó','Poodle',2,13500000.00,'Poodle nhỏ gọn và dễ chăm sóc.','Chó Poodle2.jpg','on',13,'2024-11-23 13:22:35','2025-05-14 00:55:59','male',2,2,NULL),(85,'Chó','Poodle',1,13000000.00,'Chó Poodle dễ thương, lông xoăn.','Chó Poodle3.jpg','out of stock',13,'2024-11-23 13:22:35','2025-05-31 02:33:32','male',-1,5,NULL),(86,'Chó','Poodle',2,13500000.00,'Poodle nhỏ gọn và dễ chăm sóc.','Chó Poodle4.jpg','out of stock',13,'2024-11-23 13:22:35','2025-05-31 02:33:32','male',0,4,NULL),(87,'Chó','Poodle',1,13000000.00,'Chó Poodle dễ thương, lông xoăn.','Chó Poodle5.jpg','on',13,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(88,'Chó','Poodle',2,13500000.00,'Poodle nhỏ gọn và dễ chăm sóc.','Chó Poodle6.jpg','on',13,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',6,0,NULL),(89,'Mèo','Mèo Anh',1,7000000.00,'Mèo Anh lông ngắn, thân thiện.','meo_anh4.jpg','on',14,'2024-11-23 13:22:35','2025-05-20 17:21:45','male',4,2,NULL),(90,'Mèo','Mèo Anh',2,7500000.00,'Mèo Anh thuần chủng, đáng yêu.','meo_anh2.jpg','on',14,'2024-11-23 13:22:35','2025-05-15 07:48:05','male',0,2,'meo-anh-thuan-chung-dang-yeu'),(91,'Mèo','Mèo Anh',1,7000000.00,'Mèo Anh lông ngắn, thân thiện.','meo_anh6.jpg','on',14,'2024-11-23 13:22:35','2025-05-16 07:13:15','male',1,3,NULL),(92,'Mèo','Mèo Anh',2,7500000.00,'Mèo Anh thuần chủng, đáng yêu.','meo_anh3.jpg','on',14,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(93,'Mèo','Mèo Anh',1,7000000.00,'Mèo Anh lông ngắn, thân thiện.','meo_anh1.jpg','on',14,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(94,'Mèo','Mèo Anh',2,7500000.00,'Mèo Anh thuần chủng, đáng yêu.','meo_anh5.jpg','on',14,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(95,'Mèo','Maine Coon',3,12000000.00,'Maine Coon lông dài, dễ thương.','Maine Coon 1.jpg','on',20,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(96,'Mèo','Maine Coon',2,12500000.00,'Maine Coon thân thiện, dễ chăm.','Maine Coon2.jpg','on',20,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(97,'Mèo','Maine Coon',3,12000000.00,'Maine Coon lông dài, dễ thương.','Maine Coon4.jpg','on',20,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(98,'Mèo','Maine Coon',2,12500000.00,'Maine Coon thân thiện, dễ chăm.','Maine Coon3.jpg','on',20,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(99,'Mèo','Maine Coon',3,12000000.00,'Maine Coon lông dài, dễ thương.','Maine Coon5.jpg','on',20,'2024-11-23 13:22:35','2025-05-20 10:15:00','male',1,4,NULL),(100,'Mèo','Maine Coon',2,12500000.00,'Maine Coon thân thiện, dễ chăm.','Maine Coon6.jpg','on',20,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(101,'Mèo','Ragdoll',2,14000000.00,'Ragdoll đáng yêu, lông mềm mại.','meo_rag1.jpg','on',18,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(102,'Mèo','Ragdoll',3,14500000.00,'Ragdoll năng động, dễ huấn luyện.','meo_rag2.jpg','on',18,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',4,1,NULL),(103,'Mèo','Ragdoll',2,14000000.00,'Ragdoll đáng yêu, lông mềm mại.','meo_rag3.jpg','on',18,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',2,0,NULL),(104,'Mèo','Ragdoll',3,14500000.00,'Ragdoll năng động, dễ huấn luyện.','meo_rag4.jpg','on',18,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',5,0,NULL),(105,'Mèo','Ragdoll',2,14000000.00,'Ragdoll đáng yêu, lông mềm mại.','meo_rag5.jpg','on',18,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',4,0,NULL),(106,'Mèo','Ragdoll',3,14500000.00,'Ragdoll năng động, dễ huấn luyện.','meo_rag6.jpg','on',18,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',3,0,NULL),(107,'Phụ Kiện','Balo',0,500000.00,'Balo tiện dụng để mang thú cưng.','balo1.jpg','on',23,'2024-11-23 13:22:35','2025-05-22 12:10:40','0',12,16,NULL),(108,'Phụ Kiện','Bát Ăn',0,200000.00,'Bát ăn bằng inox chống trượt.','bat1.jpg','on',25,'2024-11-23 13:22:35','2025-05-23 10:20:26','male',38,4,'bat-an-bang-inox-chong-truot'),(109,'Phụ Kiện','Bình Uống Nước',0,300000.00,'Bình nước thông minh cho thú cưng.','binh1.jpg','on',26,'2024-11-23 13:22:35','2025-01-07 02:02:52','male',50,0,NULL),(110,'Phụ Kiện','Đệm',0,1000000.00,'Đệm êm ái, phù hợp mọi thú cưng.','dem1.jpg','on',22,'2024-11-23 13:22:35','2025-01-07 02:32:46','male',10,0,NULL),(111,'Phụ Kiện','Đồ Ăn',0,500000.00,'Thức ăn giàu dinh dưỡng cho thú cưng.','doan.jpg','on',29,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',20,0,NULL),(112,'Phụ Kiện','Đồ Chơi',0,150000.00,'Đồ chơi vui nhộn cho thú cưng.','do_choi1.jpg','on',28,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',20,0,NULL),(113,'Phụ Kiện','Lồng',0,2000000.00,'Lồng rộng rãi, chất liệu bền đẹp.','long1.jpg','on',24,'2024-11-23 13:22:35','2025-05-15 04:00:44','male',8,1,NULL),(114,'Phụ Kiện','Quần Áo',0,300000.00,'Quần áo thời trang cho thú cưng.','ao1.jpg','on',27,'2024-11-23 13:22:35','2025-01-07 02:08:20','male',30,0,NULL),(115,'Phụ Kiện','Xích Vòng Cổ',0,400000.00,'Xích và vòng cổ chắc chắn.','xich2.jpg','on',21,'2024-11-23 13:22:35','2024-12-19 08:27:58','male',30,0,NULL),(116,'Phụ Kiện','Balo',0,500000.00,'Balo tiện dụng để mang thú cưng.','balo2.jpg','on',23,'2024-11-23 13:22:35','2025-05-20 16:16:47','male',14,4,NULL),(117,'Phụ Kiện','Bát Ăn',0,200000.00,'Bát ăn bằng inox chống trượt.','bat2.jpg','on',25,'2024-11-23 13:22:35','2025-05-23 10:40:32','male',30,1,'bat-an-bang-inox-chong-truot'),(118,'Phụ Kiện','Bình Uống Nước',0,300000.00,'Bình nước thông minh cho thú cưng.','binh2.jpg','on',26,'2024-11-23 13:22:35','2025-05-15 12:02:37','male',31,9,NULL),(119,'Phụ Kiện','Đệm',0,1000000.00,'Đệm êm ái, phù hợp mọi thú cưng.','dem2.jpg','on',22,'2024-11-23 13:22:35','2025-01-07 02:33:17','male',10,0,NULL),(120,'Phụ Kiện','Đồ Ăn',0,500000.00,'Thức ăn giàu dinh dưỡng cho thú cưng.','doan1.jpg','on',29,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',50,0,NULL),(121,'Phụ Kiện','Đồ Chơi',0,150000.00,'Đồ chơi vui nhộn cho thú cưng.','do_choi2.jpg','on',28,'2024-11-23 13:22:35','2025-05-06 13:38:32','male',20,0,NULL),(122,'Phụ Kiện','Lồng',0,2000000.00,'Lồng rộng rãi, chất liệu bền đẹp.','long2.jpg','on',24,'2024-11-23 13:22:35','2025-05-15 04:16:26','male',8,1,NULL),(123,'Phụ Kiện','Quần Áo',0,300000.00,'Quần áo thời trang cho thú cưng.','ao2.jpg','on',27,'2024-11-23 13:22:35','2025-01-07 02:09:16','male',30,0,NULL),(124,'Phụ Kiện','Xích Vòng Cổ',0,400000.00,'Xích và vòng cổ chắc chắn.','xich1.jpg','on',21,'2024-11-23 13:22:35','2024-12-19 08:28:58','male',30,0,NULL),(125,'Phụ kiện','Xích vòng cổ',0,150000.00,'Vòng đeo cổ chuông lúc lắc','laco.jpg','on',21,'2024-11-29 05:24:05','2025-05-20 09:23:40','male',26,4,NULL),(126,'Phụ kiện','Balo',0,300000.00,'Balo để mang theo thú cưng đi chơi','balo3.jpg','on',23,'2024-11-29 05:28:31','2025-05-29 20:13:58','male',12,5,'balo-de-mang-theo-thu-cung-di-choi'),(127,'Phụ kiện','Bát ăn',0,200000.00,'Bát ăn bằng nhựa gọn nhẹ chống trượt','bat3.jpg','on',25,'2024-11-29 05:32:13','2025-05-27 19:58:48','male',90,0,'bat-an-bang-nhua-gon-nhe-chong-truot'),(128,'Phụ kiện','Đồ ăn',0,450000.00,'Cỏ ăn dành cho mèo','co.webp','on',29,'2024-11-29 05:41:20','2025-05-20 16:16:47','male',20,1,NULL),(129,'Phụ kiện','Đồ ăn',0,350000.00,'Pate cho mèo','pate.webp','on',29,'2024-11-29 05:44:07','2025-05-20 16:16:47','male',30,1,NULL),(130,'Phụ kiện','Đồ ăn',0,250000.00,'Xúc xích cho chó mèo','xuc-xich.webp','on',29,'2024-11-29 05:45:40','2025-05-20 16:16:47','male',20,8,NULL),(131,'Phụ kiện','Đồ ăn',0,330000.00,'Thức ăn riêng cho chó poodle','doan3.jpg','on',29,'2024-11-29 05:49:37','2025-05-20 16:16:47','0',40,1,NULL),(132,'Phụ Kiện','Balo',0,400000.00,'Balo Phi Hành Gia','balo-thu-cung-phi-hanh-gia.jpg','on',23,'2025-05-14 04:04:09','2025-05-20 16:16:47','male',0,0,NULL),(133,'Phụ Kiện','Balo',0,330000.00,'Balo vận chuyển chó mèo 40x30x20cm','balo-cho-meo.webp','on',23,'2025-05-14 04:08:18','2025-05-20 16:16:47','male',0,0,'balo-van-chuyen-cho-meo-40x30x20cm'),(134,'Phụ kiện','Balo',0,350000.00,'Balô phi hành gia trong suốt cho thú cưng Vận chuyển chó mèo thú cưng','balo-phi-hanh-gia-van-chuyen.jpg','on',23,'2025-05-14 04:15:11','2025-05-20 16:16:47','male',0,0,NULL),(137,'Phụ Kiện','Bát ăn',0,160000.00,'Bát Ăn Chó Mèo Kèm 2 Chén Nhựa Và Bình Nước Tự Động','batannuoc.webp','on',25,'2025-05-22 12:22:26','2025-05-22 14:07:20','Khác',0,0,'bat-an-cho-meo-kem-2-chen-nhua-va-binh-nuoc-tu-dong'),(138,'Phụ Kiện','Bát ăn',0,170000.00,'Bát cho ăn tự động dành cho chó mèo','battudong.jpg','on',25,'2025-05-22 12:25:37','2025-05-22 14:07:20','unknown',0,0,'bat-cho-an-tu-dong-danh-cho-cho-meo'),(139,'Phụ kiện','Bát ăn',0,100000.00,'Bát đơn inox hình đoá hoa','bathoa.jpg','on',25,'2025-05-22 12:29:39','2025-05-22 14:07:20','Khác',0,0,'bat-don-inox-hinh-doa-hoa'),(140,'Phụ kiện','Bát ăn',0,150000.00,'Bát ăn dặm hình xương cá dành cho chó mèo 21×4.5cm','batxuongca.jpg','on',25,'2025-05-22 12:31:57','2025-05-22 14:07:20','Khác',0,0,'bat-an-dam-hinh-xuong-ca-danh-cho-cho-meo-2145cm'),(141,'Phụ kiện','Bát ăn',0,160000.00,'Bát đôi mèo inox có ngăn đổ nước tự động','bat-doi-meo-inox.jpg','on',25,'2025-05-22 12:32:58','2025-05-22 14:07:20','Khác',0,0,'bat-doi-meo-inox-co-ngan-do-nuoc-tu-dong'),(142,'Phụ kiện','Bình Uống Nước',0,100000.00,'Bình sữa chó mèo kèm dụng cụ vệ sinh','binhsua.jpg','on',26,'2025-05-22 12:38:48','2025-05-22 14:07:20','Khác',0,0,'binh-sua-cho-meo-kem-dung-cu-ve-sinh'),(143,'Phụ kiện','Bình Uống Nước',0,150000.00,'Máy uống nước tự động cao cấp có hai ngăn cho chó mèo','may-uong-tu-dong-cao-cap.jpg','on',26,'2025-05-22 12:41:08','2025-05-22 14:07:20','Khác',0,0,'may-uong-nuoc-tu-dong-cao-cap-co-hai-ngan-cho-cho-meo'),(144,'Phụ kiện','Bình Uống Nước',0,180000.00,'Bình uống nước tự động cho chó mèo','binh-uong-nuoc-tu-dong-cho-cho-meo-petmate-pearl-replendish-waterer-with-microban.jpg','on',26,'2025-05-22 12:44:18','2025-05-22 14:07:20','Khác',0,0,'binh-uong-nuoc-tu-dong-cho-cho-meo'),(145,'Phụ kiện','Lồng',0,2000000.00,'Chuồng cho chó mèo bằng nhựa','chuong-cho-meo-bang-nhua-iris-810-400x400-1.webp','on',24,'2025-05-22 12:46:15','2025-05-22 14:07:20','Khác',0,0,'chuong-cho-cho-meo-bang-nhua'),(146,'Phụ kiện','Lồng',0,4600000.00,'Chuồng gỗ cho chó mèo 2 tầng','chuong-go-cho-cho-meo-2-tang-RICHELL-rc09-400x400-1.webp','on',24,'2025-05-22 12:47:21','2025-06-02 06:34:21','Khác',10,1,'chuong-go-cho-cho-meo-2-tang'),(147,'Phụ kiện','Lồng',0,1300000.00,'Chuồng chó mèo bằng sắt sàn nhựa','chuong-cho-meo-bang-sat-san-nhua-aupet-dog-cage-400x400-1.webp','on',24,'2025-05-22 12:48:21','2025-05-29 17:49:35','Khác',9,1,'chuong-cho-meo-bang-sat-san-nhua'),(148,'Phụ kiện','Lồng',0,3000000.00,'Chuồng tầng bằng sắt cho mèo','Chuong-tang-bang-sat-cho-meo.jpg','on',24,'2025-05-22 12:50:28','2025-05-22 14:07:20','Đực',0,0,'chuong-tang-bang-sat-cho-meo'),(149,'Phụ kiện','Lồng',0,5000000.00,'Nhà gỗ nhiều tầng cho mèo','Nha-go-nhieu-tang-cho-meo.jpg','on',24,'2025-05-22 13:11:53','2025-05-22 14:07:20','Khác',0,0,'nha-go-nhieu-tang-cho-meo'),(150,'Phụ kiện','Khay vệ sinh',0,250000.00,'Khay cát mèo hình con vật cute 43*29*14cm','khay-cat-me.jpg','on',35,'2025-05-22 13:14:41','2025-05-22 14:07:20','Đực',0,0,'khay-cat-meo-hinh-con-vat-cute-432914cm'),(151,'Phụ kiện','Khay vệ sinh',0,450000.00,'Hộp cát cho mèo có cửa hình tai mèo kích thước lớn','hopcat.jpg','on',35,'2025-05-22 13:19:48','2025-05-22 14:07:20','Khác',0,0,'hop-cat-cho-meo-co-cua-hinh-tai-meo-kich-thuoc-lon'),(152,'Phụ kiện','Khay vệ sinh',0,500000.00,'Khay đi vệ sinh cho chó','do-ve-sinh-cho-cho.jpg','on',35,'2025-05-22 13:22:14','2025-05-22 14:07:20','Khác',0,0,'khay-di-ve-sinh-cho-cho'),(153,'Phụ kiện','Khay vệ sinh',0,450000.00,'Nhà vệ sinh 2 cửa khay kéo - nhà vệ sinh hộp tai mèo dành cho mèo','KHAYKEO.webp','on',35,'2025-05-22 13:24:46','2025-05-22 14:07:20','Khác',0,0,'nha-ve-sinh-2-cua-khay-keo-nha-ve-sinh-hop-tai-meo-danh-cho-meo'),(154,'Phụ kiện','Khay vệ sinh',0,250000.00,'Khay đi vệ sinh (không kèm xẻng)','khaykxeng.webp','on',35,'2025-05-22 13:26:18','2025-05-22 14:07:20','Khác',0,0,'khay-di-ve-sinh-khong-kem-xeng'),(155,'Phụ kiện','Khay vệ sinh',0,260000.00,'Nhà vệ sinh cho mèo loại hộp kín có lọc khí không mùi','khaylockhi.webp','on',35,'2025-05-22 13:28:25','2025-05-22 14:07:20','Khác',0,0,'nha-ve-sinh-cho-meo-loai-hop-kin-co-loc-khi-khong-mui'),(156,'Phụ kiện','Đệm',0,300000.00,'Đệm nằm - ổ nằm cho chó mèo ấm áp - Đệm mùa đông - Sofa mèo mùa đông đường kính: 50cm','demmeo.webp','on',22,'2025-05-22 13:30:43','2025-05-22 14:07:20','Khác',0,0,'dem-nam-o-nam-cho-cho-meo-am-ap-dem-mua-dong-sofa-meo-mua-dong-duong-kinh-50cm'),(157,'Phụ Kiện','Đệm',0,300000.00,'Nệm bông lông cho chó mèo (Size 42x31cm phù hợp cho các bé) Nệm Hai Lớp Cao Cấp','demmeo2.webp','on',22,'2025-05-22 13:32:12','2025-05-22 14:07:20','Khác',0,0,'nem-bong-long-cho-cho-meo-size-42x31cm-phu-hop-cho-cac-be-nem-hai-lop-cao-cap'),(158,'Phụ kiện','Đệm',0,320000.00,'Ổ Nệm Tròn Êm Ái Cho Chó Mèo','ONEM.webp','on',22,'2025-05-22 13:33:30','2025-05-22 14:07:20','Khác',0,0,'o-nem-tron-em-ai-cho-cho-meo'),(159,'Phụ kiện','Đệm',0,550000.00,'Nệm, ngủ cho chó to (có khoá kéo) tặng gối nằm , thảm nệm thú cưng','nemchoto.webp','on',22,'2025-05-22 13:35:53','2025-05-22 14:07:20','Khác',0,0,'nem-ngu-cho-cho-to-co-khoa-keo-tang-goi-nam-tham-nem-thu-cung'),(160,'Phụ kiện','Đệm',0,250000.00,'Giường nằm, Ổ Nệm Ngủ Cho Chó Mèo','giuongnem.webp','on',22,'2025-05-22 13:37:12','2025-05-22 14:07:20','Khác',0,0,'giuong-nam-o-nem-ngu-cho-cho-meo'),(161,'Phụ Kiện','Đồ chơi',0,150000.00,'Đồ Chơi Cần Câu Cho Mèo','cancau.webp','on',28,'2025-05-22 13:39:15','2025-05-22 14:07:20','Khác',0,0,'do-choi-can-cau-cho-meo'),(162,'Phụ kiện','Đồ chơi',0,290000.00,'Đồ chơi chải lông cho mèo','chaimeo.webp','on',28,'2025-05-22 13:40:45','2025-05-22 14:07:20','Khác',0,0,'do-choi-chai-long-cho-meo'),(163,'Phụ kiện','Đồ chơi',0,290000.00,'Đồ Chơi Tháp Bóng 3 Tầng Cho Mèo','thapmeo.webp','on',28,'2025-05-22 13:40:45','2025-05-22 14:07:20','unknown',0,0,'do-choi-thap-bong-3-tang-cho-meo'),(164,'Phụ kiện','Đồ chơi',0,150000.00,'Cần Câu Mèo Dây Sắt Kún Miu','canlong.webp','on',28,'2025-05-22 13:43:32','2025-05-22 14:07:20','Khác',0,0,'can-cau-meo-day-sat-kun-miu'),(165,'Phụ kiện','Đồ chơi',0,120000.00,'Đồ chơi bóng lồng chuột - lật đật chuột dành cho mèo','longchuot.webp','on',28,'2025-05-22 13:45:28','2025-05-22 14:07:20','Khác',0,0,'do-choi-bong-long-chuot-lat-dat-chuot-danh-cho-meo'),(166,'Phụ kiện','Đồ chơi',0,130000.00,'Trụ cào móng 2 tầng kèm đồ chơi cho mèo','trucao.webp','on',28,'2025-05-22 13:46:55','2025-05-22 14:07:20','Khác',0,0,'tru-cao-mong-2-tang-kem-do-choi-cho-meo'),(167,'Phụ kiện','Đồ chơi',0,60000.00,'Combo 3 banh xốp cầu vồng đồ chơi cho chó mèo','bongxop.webp','on',28,'2025-05-22 13:48:24','2025-05-22 14:07:20','Khác',0,0,'combo-3-banh-xop-cau-vong-do-choi-cho-cho-meo'),(168,'Phụ kiện','Quần Áo',0,75000.00,'Quần áo cho Chó Mèo Vải Len, dày ấm áp, Mùa Thu Đông ,  Quần áo cho thú cưng','quanao.webp','on',27,'2025-05-22 13:51:20','2025-05-22 14:07:20','Khác',0,0,'quan-ao-cho-cho-meo-vai-len-day-am-ap-mua-thu-dong-quan-ao-cho-thu-cung'),(169,'Phụ kiện','Quần Áo',0,80000.00,'Áo vải nỉ mỏng cho Chó Mèo , Áo Giữ ấm, có tay. Quần Áo Thú Cưng','quanao2.webp','on',27,'2025-05-22 13:52:35','2025-05-22 14:07:20','Khác',0,0,'ao-vai-ni-mong-cho-cho-meo-ao-giu-am-co-tay-quan-ao-thu-cung'),(170,'Phụ kiện','Quần Áo',0,120000.00,'Váy Tết cho thú cưng - Quần áo năm mới cho Chó Mèo - Quần áo Thú Cưng - Tet clothes for pets','vay.webp','on',27,'2025-05-22 13:53:47','2025-05-22 14:07:20','Đực',0,0,'vay-tet-cho-thu-cung-quan-ao-nam-moi-cho-cho-meo-quan-ao-thu-cung-tet-clothes-for-pets'),(171,'Phụ kiện','Quần Áo',0,100000.00,'Áo thun cao cấp cho chó mèo vải xin ( một cái, màu và mẫu giao ngẫu nhiên theo lô nhập )','aovi.webp','on',27,'2025-05-22 13:54:57','2025-05-22 14:07:20','Khác',0,0,'ao-thun-cao-cap-cho-cho-meo-vai-xin-mot-cai-mau-va-mau-giao-ngau-nhien-theo-lo-nhap'),(172,'Phụ kiện','Xích vòng cổ',0,130000.00,'Dây dẫn chó mèo ( Có yếm ) loai 7 sắc Dành cho mấy bé hay Nhoi','daydan.webp','on',21,'2025-05-22 13:56:30','2025-05-22 14:07:20','Khác',0,0,'day-dan-cho-meo-co-yem-loai-7-sac-danh-cho-may-be-hay-nhoi'),(173,'Phụ kiện','Xích vòng cổ',0,150000.00,'Dây Dắt Vòng Cổ Chó Mèo Kún Miu (1cm) - Giao Màu Ngẫu Nhiên','daydanngaunhien.webp','on',21,'2025-05-22 13:57:38','2025-05-22 14:07:20','Khác',0,0,'day-dat-vong-co-cho-meo-kun-miu-1cm-giao-mau-ngau-nhien'),(174,'Phụ kiện','Xích vòng cổ',0,180000.00,'(Bộ) Dây dắt chó police phản quang - dây dắt kèm yếm đai yên ngựa cho chó cảnh sát gồm dây dắt và đai yếm Màu ngẫu nhiên','daypolice.webp','on',21,'2025-05-22 13:58:48','2025-05-22 14:07:20','Khác',0,0,'bo-day-dat-cho-police-phan-quang-day-dat-kem-yem-dai-yen-ngua-cho-cho-canh-sat-gom-day-dat-va-dai-yem-mau-ngau-nhien'),(175,'Phụ kiện','Xích vòng cổ',0,130000.00,'Dây dắt cho chó vải đan co giãn nhẹ trợ lực chắc chắn dài 1.4m - Genyo rope 015 ( màu ngẫu nhiên )','daydu.webp','on',21,'2025-05-22 14:00:21','2025-05-22 14:07:20','Khác',0,0,'day-dat-cho-cho-vai-dan-co-gian-nhe-tro-luc-chac-chan-dai-14m-genyo-rope-015-mau-ngau-nhien'),(176,'Phụ kiện','Balo',0,240000.00,'Túi Vận Chuyển Lưới Kún Miu (Size M) - Giao Màu Ngẫu Nhiên','tui.webp','on',23,'2025-05-22 14:01:57','2025-05-22 14:07:20','Khác',0,0,'tui-van-chuyen-luoi-kun-miu-size-m-giao-mau-ngau-nhien'),(177,'Phụ kiện','Balo',0,230000.00,'Túi vận chuyển cứng cho chó mèo (mẫu giao ngẫu nhiên)','tui2.webp','on',23,'2025-05-22 14:02:47','2025-05-22 14:07:20','unknown',0,0,'tui-van-chuyen-cung-cho-cho-meo-mau-giao-ngau-nhien'),(178,'Mèo','Scottish',1,1300000.00,'Scottish thích hợp nuôi trong nhà thân thiện tinh nghịch.','meoScottish.jpg','pending',15,'2025-05-22 21:07:20','2025-05-31 21:14:57','male',0,0,'scottish-thich-hop-nuoi-trong-nha-than-thien-tinh-nghich'),(179,'Chó','Samoyed',1,20000000.00,'Chó Samoyed thân thiện dễ thương lông bông trắng như tuyết','chosamoy.jpg','1',9,'2025-05-23 07:59:23','2025-05-23 00:59:23','Đực',0,0,'cho-samoyed-than-thien-de-thuong-long-bong-trang-nhu-tuyet');
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_order_items` (
  `purchase_order_item_id` int NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int DEFAULT NULL,
  `pet_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_order_item_id`),
  KEY `purchase_order_id` (`purchase_order_id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `purchase_order_items_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`purchase_order_id`),
  CONSTRAINT `purchase_order_items_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
INSERT INTO `purchase_order_items` VALUES (1,1,41,2,8000000.00,'2024-11-30 11:58:27','2024-11-30 04:58:27'),(3,3,40,3,7000000.00,'2024-11-30 15:06:47','2024-11-30 08:06:47'),(4,4,122,10,1500000.00,'2024-12-09 05:17:38','2024-12-08 22:17:38'),(5,5,107,40,400000.00,'2024-12-09 06:02:52','2024-12-08 23:02:52'),(6,6,113,10,1500000.00,'2024-12-19 08:25:32','2024-12-19 01:25:32'),(7,7,115,30,300000.00,'2024-12-19 08:27:58','2024-12-19 01:27:58'),(8,8,124,30,300000.00,'2024-12-19 08:28:58','2024-12-19 01:28:58'),(9,9,125,30,100000.00,'2024-12-19 08:29:42','2024-12-19 01:29:42'),(10,10,108,40,150000.00,'2025-01-07 01:59:52','2025-01-06 18:59:52'),(11,11,117,30,150000.00,'2025-01-07 02:00:56','2025-01-06 19:00:56'),(13,13,109,50,280000.00,'2025-01-07 02:02:52','2025-01-06 19:02:52'),(14,14,118,40,280000.00,'2025-01-07 02:03:34','2025-01-06 19:03:34'),(18,18,114,30,280000.00,'2025-01-07 02:08:20','2025-01-06 19:08:20'),(19,19,123,30,280000.00,'2025-01-07 02:09:16','2025-01-06 19:09:16'),(20,20,19,4,800000.00,'2025-01-07 02:10:34','2025-01-06 19:10:34'),(21,21,20,2,9000000.00,'2025-01-07 02:11:19','2025-01-06 19:11:19'),(22,22,21,2,7000000.00,'2025-01-07 02:12:15','2025-01-06 19:12:15'),(23,23,22,2,8000000.00,'2025-01-07 02:13:08','2025-01-06 19:13:08'),(24,24,23,3,7000000.00,'2025-01-07 02:14:43','2025-01-06 19:14:43'),(25,25,24,3,8000000.00,'2025-01-07 02:15:53','2025-01-06 19:15:53'),(26,26,49,3,22000000.00,'2025-01-07 02:17:01','2025-01-06 19:17:01'),(27,27,50,2,23000000.00,'2025-01-07 02:18:10','2025-01-06 19:18:10'),(28,28,50,1,24000000.00,'2025-01-07 02:19:07','2025-01-06 19:19:07'),(29,29,51,2,24000000.00,'2025-01-07 02:20:11','2025-01-06 19:20:11'),(30,30,52,2,24000000.00,'2025-01-07 02:20:57','2025-01-06 19:20:57'),(31,31,53,2,24000000.00,'2025-01-07 02:22:07','2025-01-06 19:22:07'),(32,32,54,2,24000000.00,'2025-01-07 02:22:37','2025-01-06 19:22:37'),(33,33,1,2,6000000.00,'2025-01-07 02:24:29','2025-01-06 19:24:29'),(34,34,1,5,6000000.00,'2025-01-07 02:25:14','2025-01-06 19:25:14'),(35,35,2,5,6000000.00,'2025-01-07 02:26:13','2025-01-06 19:26:13'),(36,36,2,3,6000000.00,'2025-01-07 02:26:52','2025-01-06 19:26:52'),(37,37,3,5,6000000.00,'2025-01-07 02:28:34','2025-01-06 19:28:34'),(38,38,4,5,6000000.00,'2025-01-07 02:29:03','2025-01-06 19:29:03'),(39,39,5,5,6000000.00,'2025-01-07 02:30:25','2025-01-06 19:30:25'),(40,40,6,5,6000000.00,'2025-01-07 02:31:08','2025-01-06 19:31:08'),(42,42,119,10,600000.00,'2025-01-07 02:33:17','2025-01-06 19:33:17'),(43,43,32,5,13000000.00,'2025-01-12 04:03:29','2025-01-11 21:03:29'),(47,47,61,7,13800000.00,'2025-05-06 13:24:18','2025-05-06 06:24:18'),(48,48,62,5,13000000.00,'2025-05-06 13:30:40','2025-05-06 06:30:40'),(49,2,1,3,9000000.00,'2025-05-19 03:55:04','2025-05-18 20:55:04'),(53,50,1,12,5800000.00,'2025-05-27 17:31:03','2025-05-27 10:31:03'),(55,49,1,12,5800000.00,'2025-05-28 02:54:21','2025-05-27 19:54:21'),(56,12,127,30,1500000.00,'2025-05-28 02:58:48','2025-05-27 19:58:48'),(58,41,1,1,600000.00,'2025-05-28 04:35:27','2025-05-27 21:35:27'),(59,51,1,10,2500000.00,'2025-05-28 04:43:11','2025-05-27 21:43:11'),(60,52,146,6,3800000.00,'2025-05-28 04:58:58','2025-05-27 21:58:58');
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `purchase_order_id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `invoice_file` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `fk_purchase_employee` (`employee_id`),
  CONSTRAINT `fk_purchase_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
INSERT INTO `purchase_orders` VALUES (1,10,'2024-12-01 00:00:00',16000000.00,NULL,'2024-11-30 04:58:27','2024-11-30 11:58:27',NULL),(2,1,'2024-12-01 00:00:00',27000000.00,NULL,'2025-05-18 20:55:04','2024-11-30 12:01:02',NULL),(3,10,'2024-12-01 00:00:00',21000000.00,NULL,'2024-11-30 08:06:47','2024-11-30 15:06:47',NULL),(4,22,'2024-12-10 00:00:00',15000000.00,NULL,'2024-12-08 22:17:38','2024-12-09 05:17:38',NULL),(5,21,'2024-12-09 00:00:00',16000000.00,NULL,'2024-12-08 23:02:52','2024-12-09 06:02:52',NULL),(6,22,'2024-12-20 00:00:00',15000000.00,NULL,'2024-12-19 01:25:32','2024-12-19 08:25:32',NULL),(7,19,'2024-12-19 00:00:00',9000000.00,NULL,'2024-12-19 01:27:58','2024-12-19 08:27:58',NULL),(8,19,'2024-12-19 00:00:00',9000000.00,NULL,'2024-12-19 01:28:58','2024-12-19 08:28:58',NULL),(9,19,'2024-12-19 00:00:00',3000000.00,NULL,'2024-12-19 01:29:42','2024-12-19 08:29:42',NULL),(10,22,'2025-01-07 00:00:00',6000000.00,NULL,'2025-01-06 18:59:52','2025-01-07 01:59:52',NULL),(11,22,'2025-01-08 00:00:00',4500000.00,NULL,'2025-01-06 19:00:56','2025-01-07 02:00:56',NULL),(12,22,'2025-01-08 00:00:00',45000000.00,NULL,'2025-05-27 19:58:48','2025-01-07 02:01:39',NULL),(13,22,'2025-01-07 00:00:00',14000000.00,NULL,'2025-01-06 19:02:52','2025-01-07 02:02:52',NULL),(14,22,'2025-01-07 00:00:00',11200000.00,NULL,'2025-01-06 19:03:34','2025-01-07 02:03:34',NULL),(18,21,'2025-01-08 00:00:00',8400000.00,NULL,'2025-01-06 19:08:20','2025-01-07 02:08:20',NULL),(19,21,'2025-01-08 00:00:00',8400000.00,NULL,'2025-01-06 19:09:16','2025-01-07 02:09:16',NULL),(20,5,'2025-01-08 00:00:00',3200000.00,NULL,'2025-01-06 19:10:34','2025-01-07 02:10:34',NULL),(21,5,'2025-01-08 00:00:00',18000000.00,NULL,'2025-01-06 19:11:19','2025-01-07 02:11:19',NULL),(22,5,'2025-01-08 00:00:00',14000000.00,NULL,'2025-01-06 19:12:15','2025-01-07 02:12:15',NULL),(23,5,'2025-01-08 00:00:00',16000000.00,NULL,'2025-01-06 19:13:08','2025-01-07 02:13:08',NULL),(24,5,'2025-01-08 00:00:00',21000000.00,NULL,'2025-01-06 19:14:43','2025-01-07 02:14:43',NULL),(25,5,'2025-01-07 00:00:00',24000000.00,NULL,'2025-01-06 19:15:53','2025-01-07 02:15:53',NULL),(26,7,'2025-01-08 00:00:00',66000000.00,NULL,'2025-01-06 19:17:01','2025-01-07 02:17:01',NULL),(27,7,'2025-01-07 00:00:00',46000000.00,NULL,'2025-01-06 19:18:10','2025-01-07 02:18:10',NULL),(28,7,'2025-01-07 00:00:00',24000000.00,NULL,'2025-01-06 19:19:07','2025-01-07 02:19:07',NULL),(29,7,'2025-01-08 00:00:00',48000000.00,NULL,'2025-01-06 19:20:11','2025-01-07 02:20:11',NULL),(30,7,'2025-01-08 00:00:00',48000000.00,NULL,'2025-01-06 19:20:57','2025-01-07 02:20:57',NULL),(31,7,'2025-01-08 00:00:00',48000000.00,NULL,'2025-01-06 19:22:07','2025-01-07 02:22:07',NULL),(32,7,'2025-01-08 00:00:00',48000000.00,NULL,'2025-01-06 19:22:37','2025-01-07 02:22:37',NULL),(33,1,'2025-01-08 00:00:00',12000000.00,NULL,'2025-01-06 19:24:29','2025-01-07 02:24:29',NULL),(34,1,'2025-01-07 00:00:00',30000000.00,NULL,'2025-01-06 19:25:14','2025-01-07 02:25:14',NULL),(35,1,'2025-01-08 00:00:00',30000000.00,NULL,'2025-01-06 19:26:13','2025-01-07 02:26:13',NULL),(36,1,'2025-01-08 00:00:00',18000000.00,NULL,'2025-01-06 19:26:52','2025-01-07 02:26:52',NULL),(37,1,'2025-01-08 00:00:00',30000000.00,NULL,'2025-01-06 19:28:34','2025-01-07 02:28:34',NULL),(38,1,'2025-01-08 00:00:00',30000000.00,NULL,'2025-01-06 19:29:03','2025-01-07 02:29:03',NULL),(39,1,'2025-01-07 00:00:00',30000000.00,NULL,'2025-01-06 19:30:25','2025-01-07 02:30:25',NULL),(40,1,'2025-01-08 00:00:00',30000000.00,NULL,'2025-01-06 19:31:08','2025-01-07 02:31:08',NULL),(41,1,'2025-01-07 00:00:00',600000.00,NULL,'2025-05-27 21:35:27','2025-01-07 02:32:46',NULL),(42,20,'2025-01-07 00:00:00',6000000.00,NULL,'2025-01-06 19:33:17','2025-01-07 02:33:17',NULL),(43,11,'2025-01-12 00:00:00',65000000.00,NULL,'2025-01-11 21:03:29','2025-01-12 04:03:29',NULL),(47,15,'2025-05-06 00:00:00',96600000.00,NULL,'2025-05-06 06:24:18','2025-05-06 13:24:18',NULL),(48,15,'2025-05-06 00:00:00',65000000.00,NULL,'2025-05-06 06:30:40','2025-05-06 13:30:40',NULL),(49,1,'2025-05-22 00:00:00',69600000.00,NULL,'2025-05-27 19:54:21','2025-05-22 08:18:07',NULL),(50,1,'2025-05-22 00:00:00',69600000.00,NULL,'2025-05-27 10:31:03','2025-05-22 08:29:33',NULL),(51,1,'2025-05-28 00:00:00',25000000.00,'https://drive.google.com/drive/folders/1MMErVFCq6ACZg7uUzBRmzobupPCTCsUR?usp=sharing','2025-05-27 21:43:11','2025-05-28 04:26:27',NULL),(52,22,'2025-05-28 00:00:00',22800000.00,'https://drive.google.com/drive/folders/1MMErVFCq6ACZg7uUzBRmzobupPCTCsUR?usp=sharing','2025-05-27 21:58:58','2025-05-28 04:58:58',NULL);
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `pet_id` (`pet_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`),
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `reviews_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `RoomID` int NOT NULL AUTO_INCREMENT,
  `PricePerNight` decimal(10,2) NOT NULL,
  `Region` varchar(10) NOT NULL,
  `Status` enum('Available','Occupied','Maintenance') DEFAULT 'Available',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`RoomID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,200000.00,'Bac','Maintenance','2024-12-01 23:06:25','2025-06-07 17:48:32'),(2,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(3,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(4,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(5,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(6,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(7,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(8,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(9,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(10,200000.00,'Bac','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(11,200000.00,'Nam','Available','2024-12-01 23:06:25','2025-06-01 00:32:17'),(12,200000.00,'Nam','Available','2024-12-01 23:06:25','2025-06-01 05:03:27'),(13,200000.00,'Nam','Available','2025-05-22 07:55:37','2025-06-01 05:03:27'),(14,200000.00,'Nam','Available','2025-06-01 07:16:10','2025-06-01 00:16:10'),(15,200000.00,'Nam','Available','2025-06-01 07:16:18','2025-06-01 00:16:18'),(16,200000.00,'Nam','Available','2025-06-01 07:16:22','2025-06-01 07:17:23'),(17,200000.00,'Nam','Available','2025-06-01 07:16:29','2025-06-01 00:16:29'),(18,200000.00,'Nam','Available','2025-06-01 07:17:49','2025-06-01 00:17:49'),(19,200000.00,'Nam','Available','2025-06-01 07:29:40','2025-06-01 00:29:40'),(20,200000.00,'Nam','Available','2025-06-01 07:29:45','2025-06-01 00:29:45');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `ServiceID` int NOT NULL AUTO_INCREMENT,
  `ServiceName` varchar(100) NOT NULL,
  `Description` text,
  `Price` decimal(10,2) NOT NULL,
  `ServiceDuration` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `AvailableSlots` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ServiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Pet Grooming','Chăm sóc, làm đẹp cho thú cưng.',150000.00,60,'2024-12-02 08:14:13',45,'2025-02-22 22:04:56'),(2,'Veterinary Checkup','Khám sức khỏe định kỳ cho thú cưng.',200000.00,60,'2024-12-02 08:14:13',12,'2025-02-22 22:13:00'),(3,'Pet Training','Huấn luyện cơ bản cho thú cưng.',250000.00,90,'2024-12-02 08:14:13',2,'2025-02-22 22:18:34');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `address` text,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Trại Chó Pug Việt Nam','Nguyễn Văn HoàngS','Thôn Đông La- Xã Đông Sơn- Huyện Đông Anh- Hà Nội','0987654321','pugviet@gmail.com','2024-11-30 17:25:18','2025-05-18 21:18:57'),(2,'Trại Chó Pull Pháp Sài Gòn','Trần Thị Thu','Số 89- Đường Lê Văn Lương- Quận 7- TP. Hồ Chí Minh','0912356789','pullphapsg@gmail.com','2024-11-30 17:25:18','2024-11-30 05:54:20'),(3,'Trại Chó Phốc Sóc Đà Nẵng','Phạm Hữu Minh','Số 42- Đường Hoàng Diệu- Quận Hải Châu- Đà Nẵng','0932123456','phocsocdn@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(4,'Trại Chó Chihuahua Quốc Gia','Đặng Thanh Sơn','Số 11- Đường Nguyễn Văn Cừ- Quận Long Biên- Hà Nội','0947654321','chihuahuaqn@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(5,'Trại Chó Bắc Kinh Ninh Bình','Hoàng Đức Tài','Xã Ninh Xuân- Huyện Hoa Lư- Tỉnh Ninh Bình','0968754321','bkninhbinh@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(6,'Trại Chó Dachshund Cần Thơ','Nguyễn Thị Mỹ','Số 54-Đường 30/4- Quận Ninh Kiều- Cần Thơ','0978123456','dachshundct@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(7,'Trại Chó Alaska Gia Lai','Lê Minh Nhật','Xã Biển Hồ- TP. Pleiku- Gia Lai','0901234567','alaskagl@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(8,'Trại Chó Samoyed Hải Phòng','Nguyễn Văn Tú','Số 32- Đường Lạch Tray- Quận Ngô Quyền- Hải Phòng','0912765432','samoyedhp@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(9,'Trại Chó Shiba Inu Hà Nội','Trần Huy Hoàng','Số 78- Đường Láng Hạ- Quận Đống Đa- Hà Nội','0943234567','shibainuhn@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(10,'Trại Chó Golden Đà Lạt','Phạm Minh Châu','Số 56- Đường Hùng Vương- TP. Đà Lạt- Lâm Đồng','0987345678','goldendalat@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(11,'Trại Chó Corgi Biên Hòa','Nguyễn Đức Anh','Số 22- Đường Võ Thị Sáu- TP. Biên Hòa- Đồng Nai','0923435678','corgibienhoa@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(12,'Trại Chó Poodle Bình Dương','Trần Thị Lan','Số 12- Đường Nguyễn Văn Tiết- TP. Thuận An- Bình Dương','0934765432','poodlebduong@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(13,'Trại Mèo Anh Quốc Việt','Phạm Ngọc Tú','Số 23- Đường Cầu Giấy- Quận Cầu Giấy- Hà Nội','0986765432','meoanhquoc@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(14,'Trại Mèo Scottish Phú Nhuận','Lê Thanh Tùng','Số 34- Đường Trần Huy Liệu- Quận Phú Nhuận- TP. Hồ Chí Minh','0908754321','scottishphunhuan@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(15,'Trại Mèo Bengal Quốc Gia','Nguyễn Thị Mai','Số 67- Đường Trần Phú- Quận Ngô Quyền- Hải Phòng','0912786543','bengalqg@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(16,'Trại Mèo Xiêm Cần Thơ','Hoàng Văn Tùng','Số 18- Đường Nguyễn Văn Linh- Quận Ninh Kiều- Cần Thơ','0934876543','meoxiemct@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(17,'Trại Mèo Ragdoll Đà Nẵng','Phan Thị Huệ','Số 55- Đường Nguyễn Văn Thoại- Quận Sơn Trà- Đà Nẵng','0923765432','ragdolldn@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(18,'Trại Mèo Maine Coon Bắc Ninh','Nguyễn Văn Hùng','Xã Đại Đồng- Huyện Tiên Du- Bắc Ninh','0912876543','mainecoonbn@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(19,'Xưởng Xích Vòng Cổ Bình Minh','Trần Văn Minh','Làng Đông Hội- Xã Đông Anh- Hà Nội','0982345678','vongcolx@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(20,'Xưởng Đệm Phú Thành','Phạm Văn Lộc','Khu Công Nghiệp Thăng Long- Đông Anh- Hà Nội','0912987654','demphuthanh@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(21,'Xưởng Balo Hà Đông','Nguyễn Đức Phúc','Số 14- Đường Quang Trung, Quận Hà Đông- Hà Nội','0923456789','balohadong@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(22,'Công Ty Lồng Cao Cấp Nam Long','Lê Văn Long','Số 45 Đường Phạm Văn Đồng- Quận Bắc Từ Liêm- Hà Nội','0932765432','longnamlong@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18'),(23,'Xưởng Đồ Ăn Thú Cưng GreenPet','Trần Thị Hà','Số 25- Đường Nguyễn Chí Thanh, TP. Hồ Chí Minh','0909898765','greenpetfood@gmail.com','2024-11-30 17:25:18','2024-11-30 10:25:18');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'petshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08  8:49:28
