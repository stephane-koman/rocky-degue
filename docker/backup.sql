-- MySQL dump 10.13  Distrib 5.7.35, for Linux (x86_64)
--
-- Host: localhost    Database: rockydb
-- ------------------------------------------------------
-- Server version	5.7.35

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
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (2,'ABIDJAN','ABJ',NULL,NULL,NULL,1),(3,'YAMOUSSOUKRO','YMK',NULL,NULL,NULL,1),(4,'LAGOS','LGS',NULL,NULL,NULL,2),(5,'TREICHVILLE','TREICH',NULL,NULL,NULL,1),(6,'PLATEAU','PLT',NULL,NULL,NULL,1),(7,'ADJAMÉ','ADJ',NULL,NULL,NULL,1),(8,'ATTECOUBÉ','ATTB',NULL,NULL,NULL,1),(9,'ABOBO','ABO',NULL,NULL,NULL,1),(10,'ANYAMA','ANYM',NULL,NULL,NULL,1),(11,'YOPOUGON','YOP',NULL,NULL,NULL,1),(12,'BASSAM','BSM',NULL,NULL,NULL,1),(13,'BONOUA','BON',NULL,NULL,NULL,1),(14,'ASSOINDÉ','ASS',NULL,NULL,NULL,1),(15,'ADIAKÉ','ADK',NULL,NULL,NULL,1),(16,'MARCORY','MRY',NULL,NULL,NULL,1),(17,'KOUMASSI','KMS',NULL,NULL,NULL,1),(18,'JACQUEVILLE','JCVL',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Côte d\'Ivoire','225',NULL,NULL,NULL),(2,'Nigéria','234',NULL,NULL,NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_country_id_foreign` (`country_id`),
  CONSTRAINT `customers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'ABC Test','097876543','14 RUE ROQUEPINE 75008 PARIS','test@abc.fr',NULL,NULL,NULL,NULL,1),(2,'Toto AZ','54567898','14 RUE ROQUEPINE 75008 PARIS','test@az.fr',NULL,NULL,NULL,NULL,1),(3,'ADAMS BG','34567890','12 RET sdef efefefefefefe','adms@bg.com',NULL,NULL,NULL,'2022-02-18 22:01:22',1),(4,'Ouidou','0845678976','123 TRE dsefef fefef','info@ouidou.fr',NULL,NULL,NULL,NULL,1),(5,'POUYTR','09876543876','123 sduyzgd iejkghezd','aref@fraf.fr',NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (18,'2014_10_02_000000_create_roles_table',1),(19,'2014_10_12_000000_create_users_table',1),(20,'2014_10_12_100000_create_password_resets_table',1),(21,'2019_08_19_000000_create_failed_jobs_table',1),(22,'2019_12_14_000001_create_personal_access_tokens_table',1),(23,'2022_02_02_190302_create_permissions_table',1),(24,'2022_02_02_192223_create_permissions_users_table',1),(25,'2022_02_02_194139_create_roles_permissions_table',1),(28,'2022_02_13_183856_create_countries_table',2),(29,'2022_02_13_184059_create_cities_table',2),(35,'2022_02_15_213444_create_customers_table',3),(36,'2022_02_17_190840_create_payment_types_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_types_code_unique` (`code`),
  UNIQUE KEY `payment_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
INSERT INTO `payment_types` VALUES (1,'CB','Carte Bancaire',NULL,NULL,NULL),(2,'C','Cash',NULL,NULL,NULL),(3,'OM','Orange Money',NULL,NULL,NULL);
/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (10,'show_user','Show user',NULL,NULL),(11,'add_user','Add user',NULL,NULL),(12,'edit_user','Edit user',NULL,NULL),(13,'delete_user','Delete user',NULL,NULL),(14,'show_role','Show role',NULL,NULL),(15,'add_role','Add role',NULL,NULL),(16,'edit_role','Edit role',NULL,NULL),(17,'delete_role','Delete role',NULL,NULL),(18,'show_permission','Show permission',NULL,NULL),(19,'show_country','Show country',NULL,NULL),(20,'add_country','Add country',NULL,NULL),(21,'edit_country','Edit country',NULL,NULL),(22,'delete_country','Delete country',NULL,NULL),(23,'show_city','Show city',NULL,NULL),(24,'add_city','Add city',NULL,NULL),(25,'edit_city','Edit city',NULL,NULL),(26,'delete_city','Delete city',NULL,NULL),(27,'show_customer','Show customer',NULL,NULL),(28,'add_customer','Add customer',NULL,NULL),(29,'edit_customer','Edit customer',NULL,NULL),(30,'delete_customer','Delete customer',NULL,NULL),(31,'show_payment_type','Show payment type',NULL,NULL),(32,'add_payment_type','Add payment type',NULL,NULL),(33,'edit_payment_type','Edit payment type',NULL,NULL),(34,'delete_payment_type','Delete payment type',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMIN','Rôle administrateur',NULL,NULL,NULL),(2,'USER','Rôle utilisateur standard',NULL,NULL,NULL),(3,'TEST','TEST',NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_permissions`
--

DROP TABLE IF EXISTS `roles_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  KEY `roles_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_permissions`
--

LOCK TABLES `roles_permissions` WRITE;
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
INSERT INTO `roles_permissions` VALUES (2,NULL,NULL,11,1),(3,NULL,NULL,12,1),(4,NULL,NULL,13,1),(5,NULL,NULL,14,1),(6,NULL,NULL,15,1),(7,NULL,NULL,16,1),(8,NULL,NULL,17,1),(9,NULL,NULL,18,1),(14,NULL,NULL,10,1),(18,NULL,NULL,10,2),(19,NULL,NULL,11,2),(22,NULL,NULL,14,2),(25,NULL,NULL,19,1),(26,NULL,NULL,20,1),(27,NULL,NULL,21,1),(28,NULL,NULL,22,1),(29,NULL,NULL,23,1),(30,NULL,NULL,24,1),(31,NULL,NULL,25,1),(32,NULL,NULL,26,1),(33,NULL,NULL,27,1),(34,NULL,NULL,28,1),(35,NULL,NULL,29,1),(36,NULL,NULL,30,1),(37,NULL,NULL,31,1),(38,NULL,NULL,32,1),(39,NULL,NULL,33,1),(40,NULL,NULL,34,1),(41,NULL,NULL,10,3);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'toto','toto@gmail.com',NULL,'$2y$10$5eMWF1lc5yU98cSBHsdKd.juB.DxZeiOMKI4xM/fogC7rU506tfjW',NULL,NULL,NULL,NULL,1),(2,'zDxIvGxwJD','9Y7yrzbw2s@gmail.com',NULL,'$2y$10$tzTSQ/CbzSdNserN67uHBerWG2Blw2BrYr55jzHz.gpOPqusrsIcS','2022-02-14 18:35:21',NULL,NULL,NULL,2),(3,'JqNDTuTclK','VN7xaDir9Y@gmail.com',NULL,'$2y$10$X2WNMtnWFy5fNwiN0E1n8Op1bPpG9POc9aoOZxv3os0vA.lMP7lIC','2022-02-14 18:36:27',NULL,NULL,NULL,1),(4,'YeESgxJuhF','T5HEfTGgaX@gmail.com',NULL,'$2y$10$vGWAsFq1v347.2ZmR1QIEehq/cqt51sj48jSC6PjIP/i4vlQT9Ku6','2022-02-14 18:35:24',NULL,NULL,NULL,NULL),(5,'MTSlCY7yqb','ag819ns3JK@gmail.com',NULL,'$2y$10$kly/7BpynX5q3S9anR0TTu2HovsInOiRynfIFqyv3s8OkaFEZTdA6','2022-02-14 18:35:31',NULL,NULL,NULL,NULL),(6,'F8gyzm5Oom','5v0IUDdlSN@gmail.com',NULL,'$2y$10$HWHUBrECYoMFK3NU/1u21.8rOT8F6blRSyAGoRjiYKZwcJUSqmLBW','2022-02-14 18:36:24',NULL,NULL,NULL,NULL),(7,'crtES03ibU','OyhRtg7wsQ@gmail.com',NULL,'$2y$10$V5DvBDuNDnBo8B1KrzoQK.6Cbhl7YX8RIJoqDZtGznDbH8EW3KKpG','2022-02-14 18:36:21',NULL,NULL,NULL,NULL),(8,'r5D9STu8SM','P5xuKKwlp2@gmail.com',NULL,'$2y$10$ted9YVsplR9gmOUNgPlcAeu98nnA6kgIyeZIc2klsv7iFT.KUR0hy','2022-02-14 18:35:35',NULL,NULL,NULL,NULL),(9,'v8upv9IZxM','govuZfhEDK@gmail.com',NULL,'$2y$10$9s1PXhjmmxST8jDD29ZRJerw2epFEjR2DDo2OQe1WY4J/oEA82HA6','2022-02-14 18:36:18',NULL,NULL,NULL,NULL),(10,'LsW2sxooGd','SeUm3bSXnX@gmail.com',NULL,'$2y$10$LSY1dZaCjucaxLGdzP2fSOjrBjCdC5xR7M.EnJHRlEslb.gnVxrAe','2022-02-14 18:35:58',NULL,NULL,NULL,NULL),(11,'TITI Titi','titi@gmail.com',NULL,'$2y$10$bFCZaYsisU9/y5MyOXXNIOpRMJEsOJovlu1lQejqRDyY09MWPINQy','2022-02-14 18:35:51',NULL,NULL,NULL,2),(12,'Adams Morak','adamsmorak@gmail.com',NULL,'$2y$10$Ea7tHs4CoK9VOu1bUcEFI.xvh1iN5y3BugU9OQOEqZOkJQ/rqdf6C','2022-02-14 18:36:02',NULL,NULL,NULL,2),(13,'aaaa','aaa@aa.fr',NULL,'$2y$10$omktSttHEGJ9aXCNMEq4E.RIoIFjdWzUBVOHByVLsYOHVGafEQZxC','2022-02-14 18:36:06',NULL,NULL,NULL,2),(14,'bbbb','bbbb@bb.fr',NULL,'$2y$10$6XQ.wPiY0TRe1VkRpNnqUumZQyr43UZBvk/6BD3pMavJjqbglWgT.','2022-02-14 18:36:09',NULL,NULL,NULL,2),(15,'cccc','ccc@cc.cc',NULL,'$2y$10$FtmJ.JimaGkc/QdhpcVhLO9ioIXEQH4Mt9B5V2w1mnGeaFN7SGKAO','2022-02-14 18:36:15',NULL,NULL,NULL,2),(16,'Stephane Koman','stefchris2@gmail.com',NULL,'$2y$10$xV6WLNZiQlmxYClDFPkQa.LPHACO3/Y6gw54TlNqoyN5CI2.Ndd7i',NULL,NULL,NULL,NULL,1),(17,'test','test@test.fr',NULL,'$2y$10$GMaVliyt/Xom3UsoGp7Ci.kSAKj3ydWnnGdxxkurFqcv54QWsZf0q',NULL,NULL,NULL,NULL,3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_permissions_user_id_foreign` (`user_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
INSERT INTO `users_permissions` VALUES (1,NULL,NULL,12,10),(2,NULL,NULL,12,11),(3,NULL,NULL,12,12),(4,NULL,NULL,12,13),(5,NULL,NULL,17,14);
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-19  8:40:09
