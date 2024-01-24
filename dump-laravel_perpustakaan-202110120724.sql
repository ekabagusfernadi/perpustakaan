-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel_perpustakaan
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggotas`
--

DROP TABLE IF EXISTS `anggotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggotas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggotas`
--

LOCK TABLES `anggotas` WRITE;
/*!40000 ALTER TABLE `anggotas` DISABLE KEYS */;
INSERT INTO `anggotas` VALUES (1,'Eka Bagus Fernadi','L','089123456789','Sadang, Taman, Sidoarjo.','bagusfernadieka@gmail.com','2021-08-23 03:44:34',NULL),(2,'Uzumaki Bayu','L','089123456123','Wonokromo, Surabaya','bayu@gmail.com','2021-08-23 03:45:58',NULL),(3,'Intan Novi','P','089123453421','Gresik','intannovi@gmail.com','2021-08-24 03:41:21',NULL),(4,'Ali Usman','L','089123498765','Tandes, Surabaya','aliusman@gmail.com','2021-08-24 03:43:31',NULL),(95,'Clara Permata S.I.Kom','P','081878461250','Ds. Basket No. 177, Tebing Tinggi 38098, Jabar','clara18@yahoo.co.id','2021-08-31 21:27:56','2021-08-31 21:27:56'),(96,'Jaya Najmudin','L','081890989564','Kpg. Sampangan No. 21, Banjarbaru 60620, Sumsel','jaya29@gmail.co.id','2021-08-31 21:27:56','2021-08-31 21:27:56'),(97,'Jail Warsita Situmorang','L','082144243301','Kpg. Padma No. 1, Tanjung Pinang 59643, DKI','jail62@yahoo.com','2021-08-31 21:27:57','2021-08-31 21:27:57'),(98,'Eka Lazuardi','L','083813468786','Dk. Baya Kali Bungur No. 858, Gorontalo 44661, Jatim','eka3@yahoo.com','2021-08-31 21:27:57','2021-08-31 21:27:57'),(99,'Fitriani Purnawati','P','088373817781','Jr. Gardujati No. 307, Banjarmasin 34047, Maluku','fitriani36@gmail.co.id','2021-08-31 21:27:57','2021-08-31 21:27:57'),(100,'Talia Pertiwi','P','089862417659','Gg. Mahakam No. 594, Pariaman 11465, Maluku','talia77@gmail.co.id','2021-08-31 21:27:57','2021-08-31 21:27:57'),(101,'Sabrina Utami','P','089225292441','Kpg. Yap Tjwan Bing No. 499, Bontang 41547, NTT','sabrina91@yahoo.co.id','2021-08-31 21:27:57','2021-08-31 21:27:57'),(102,'Ade Jelita Yolanda M.TI.','P','081584437770','Gg. Setiabudhi No. 383, Surakarta 92953, Sulsel','ade25@gmail.co.id','2021-08-31 21:27:57','2021-09-12 16:56:35'),(103,'Upik Pratama','L','087975993122','Dk. Bawal No. 643, Cimahi 30754, Kalsel','upik30@gmail.com','2021-08-31 21:27:57','2021-08-31 21:27:57'),(104,'Hamzah Pranawa Rajasa','L','088088993873','Gg. Babadak No. 508, Blitar 17830, Jambi','hamzah15@gmail.com','2021-08-31 21:27:57','2021-08-31 21:27:57');
/*!40000 ALTER TABLE `anggotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bukus`
--

DROP TABLE IF EXISTS `bukus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `isbn` int NOT NULL,
  `judul` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `id_penerbit` bigint unsigned NOT NULL,
  `id_pengarang` bigint unsigned NOT NULL,
  `id_katalog` bigint unsigned NOT NULL,
  `qty_stok` int NOT NULL,
  `harga_pinjam` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukus_id_penerbit_foreign` (`id_penerbit`),
  KEY `bukus_id_pengarang_foreign` (`id_pengarang`),
  KEY `bukus_id_katalog_foreign` (`id_katalog`),
  CONSTRAINT `bukus_id_katalog_foreign` FOREIGN KEY (`id_katalog`) REFERENCES `katalogs` (`id`),
  CONSTRAINT `bukus_id_penerbit_foreign` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbits` (`id`),
  CONSTRAINT `bukus_id_pengarang_foreign` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarangs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bukus`
--

LOCK TABLES `bukus` WRITE;
/*!40000 ALTER TABLE `bukus` DISABLE KEYS */;
INSERT INTO `bukus` VALUES (1,1,'Iqro 4',1997,1,1,2,8,2000,'2021-08-24 03:55:10','2021-10-06 02:37:34'),(2,2,'Tutorial Hero Alucard',2021,3,2,5,192,200000,'2021-08-24 03:56:44',NULL),(3,3,'Panduan Kalistenik Lengkap',2020,1,1,4,14,10000,'2021-08-24 03:57:57',NULL),(4,4,'Membuat Nasi Goreng Viral',2020,1,1,3,22,15000,'2021-08-24 03:59:13',NULL),(141,441561,'Corrupti ab sed ut.',2020,5,3,3,15,17300,'2021-08-31 21:34:11','2021-08-31 21:34:11'),(148,513814,'Cubas',2019,3,5,5,4,19300,'2021-09-12 16:53:47','2021-10-06 02:37:35'),(149,480668,'Et amet a.',2021,7,5,5,15,10300,'2021-09-12 16:53:48','2021-09-12 16:53:48'),(150,880014,'Tempora nobis.',2020,7,1,4,17,12900,'2021-09-12 16:53:48','2021-10-06 02:36:41'),(151,725521,'Beatae.',2017,1,6,1,14,8100,'2021-09-12 16:53:48','2021-09-12 16:53:48'),(152,479306,'Facilis placeat.',2017,1,4,4,8,9300,'2021-09-12 16:53:48','2021-09-12 16:53:48'),(153,957365,'Ut corporis.',2015,6,5,1,7,7400,'2021-09-12 16:53:48','2021-09-12 16:53:48'),(154,468403,'Quasi nam.',2018,6,5,2,18,16100,'2021-09-12 16:53:49','2021-09-12 16:53:49'),(155,954225,'aaaaaaaa',2021,7,3,1,16,14700,'2021-09-12 16:53:49','2021-09-13 16:56:08'),(156,769240,'Enim ut non.',2016,4,1,5,10,5500,'2021-09-12 16:53:49','2021-09-12 16:53:49'),(157,372405,'Voluptas.',2017,2,2,1,18,6500,'2021-09-12 16:53:49','2021-09-12 16:53:49'),(158,803868,'Aut repudiandae sed.',2019,1,4,4,9,17200,'2021-09-12 16:53:49','2021-09-12 16:53:49'),(159,877065,'Qui.',2021,7,5,3,10,14500,'2021-09-12 16:53:49','2021-10-06 02:36:41'),(160,442214,'Reiciendis.',2018,5,6,4,9,6700,'2021-09-12 16:53:49','2021-10-06 17:06:37'),(161,757930,'Impedit neque.',2016,7,1,2,7,9900,'2021-09-12 16:53:49','2021-09-12 16:53:49'),(162,524582,'Veritatis illo.',2016,7,1,4,16,19100,'2021-09-12 16:53:50','2021-10-06 17:06:37'),(163,484583,'Autem non cupiditate iste.',2017,5,2,5,14,16500,'2021-09-12 16:53:50','2021-09-12 16:53:50'),(164,885505,'Qui.',2018,3,5,1,9,10200,'2021-09-12 16:53:50','2021-09-12 16:53:50'),(165,689212,'Veniam enim.',2021,7,1,3,10,11100,'2021-09-12 16:53:50','2021-10-06 17:06:37'),(166,725378,'Porro dolor quia.',2016,4,2,2,15,15500,'2021-09-12 16:53:50','2021-09-12 16:53:50'),(167,127529,'Aut sint.',2018,6,1,1,19,18700,'2021-09-12 16:53:50','2021-09-12 16:53:50');
/*!40000 ALTER TABLE `bukus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` bigint unsigned NOT NULL,
  `id_buku` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_peminjaman_id_peminjaman_foreign` (`id_peminjaman`),
  KEY `detail_peminjaman_id_buku_foreign` (`id_buku`),
  CONSTRAINT `detail_peminjaman_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id`),
  CONSTRAINT `detail_peminjaman_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
INSERT INTO `detail_peminjaman` VALUES (1,1,2,1,'2021-08-09 04:00:39',NULL),(2,2,1,1,'2021-08-12 04:01:28',NULL),(3,2,3,1,'2021-08-12 04:02:18',NULL),(4,3,2,1,'2021-08-09 04:02:31',NULL),(5,4,4,1,'2021-08-12 04:02:49',NULL),(23,23,1,1,'2021-10-06 02:37:34','2021-10-06 02:37:34'),(24,23,148,1,'2021-10-06 02:37:34','2021-10-06 02:37:34'),(25,24,160,1,'2021-10-06 17:06:36','2021-10-06 17:06:36'),(26,24,162,1,'2021-10-06 17:06:37','2021-10-06 17:06:37'),(27,24,165,1,'2021-10-06 17:06:37','2021-10-06 17:06:37');
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `katalogs`
--

DROP TABLE IF EXISTS `katalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `katalogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `katalogs`
--

LOCK TABLES `katalogs` WRITE;
/*!40000 ALTER TABLE `katalogs` DISABLE KEYS */;
INSERT INTO `katalogs` VALUES (1,'Buku Pelajaran','2021-08-24 03:49:42',NULL),(2,'Buku Agama','2021-08-24 03:50:11',NULL),(3,'Buku Kuliner','2021-08-24 03:50:25',NULL),(4,'Buku Olahraga','2021-08-24 03:50:49',NULL),(5,'Buku Hiburan','2021-08-24 03:51:02',NULL);
/*!40000 ALTER TABLE `katalogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_08_19_140303_create_anggotas_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2021_08_19_135718_create_penerbits_table',1),(6,'2021_08_19_135905_create_pengarangs_table',1),(7,'2021_08_19_135934_create_katalogs_table',1),(8,'2021_08_19_140044_create_bukus_table',1),(9,'2021_08_19_140045_create_peminjaman_table',1),(10,'2021_08_19_140136_create_detail_peminjaman_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint unsigned NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `peminjaman_id_anggota_foreign` (`id_anggota`),
  CONSTRAINT `peminjaman_id_anggota_foreign` FOREIGN KEY (`id_anggota`) REFERENCES `anggotas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (1,1,'2021-08-09','2021-08-13','2021-08-09 03:51:59','2021-08-13 03:51:59',1),(2,1,'2021-08-12','2021-08-19','2021-08-12 03:52:44','2021-08-19 03:52:44',1),(3,2,'2021-07-09','2021-07-13','2021-08-09 03:53:23','2021-08-13 03:53:23',1),(4,3,'2021-07-12','2021-07-19','2021-08-12 03:53:55','2021-08-19 03:53:55',0),(23,4,'2021-10-06','2021-10-13','2021-10-06 02:37:34','2021-10-06 02:37:34',0),(24,104,'2021-10-07','2021-10-15','2021-10-06 17:06:36','2021-10-07 14:56:57',0);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbits`
--

DROP TABLE IF EXISTS `penerbits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penerbits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbits`
--

LOCK TABLES `penerbits` WRITE;
/*!40000 ALTER TABLE `penerbits` DISABLE KEYS */;
INSERT INTO `penerbits` VALUES (1,'Kijangcitys','kijangcitys@gmail.com','089123453444','Sidoarjo','2021-08-24 03:47:04',NULL),(2,'Varmintz','varmintz@gmail.com','089123453555','Ponorogo','2021-08-24 03:48:43',NULL),(3,'Jaegerjaquest','jaeger@gmail.com','089123453666','Ngawi','2021-08-24 03:48:57',NULL),(4,'Suatu Percubaan','suatu@gmail.com','08112341234','Jombang','2021-08-28 22:44:17','2021-08-28 22:44:17'),(5,'El Psy Congro','elpsy@gmail.com','089123453777','Bandung','2021-08-29 06:49:42','2021-08-29 06:49:42'),(6,'Skull','skull@gmail.com','089123453888','Malang','2021-08-29 06:50:05','2021-08-29 06:50:05'),(7,'Proelio','proelio@gmail.com','089123453999','Jember','2021-08-29 06:51:37','2021-08-29 06:51:37');
/*!40000 ALTER TABLE `penerbits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengarangs`
--

DROP TABLE IF EXISTS `pengarangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengarangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengarang` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengarangs`
--

LOCK TABLES `pengarangs` WRITE;
/*!40000 ALTER TABLE `pengarangs` DISABLE KEYS */;
INSERT INTO `pengarangs` VALUES (1,'Muhammad Nur Alim','nuralim@gmail.com','089123453111','Jember','2021-08-24 03:44:55',NULL),(2,'Firza Hardi','firzahardi@gmail.com','089123453222','Surabaya','2021-08-24 03:45:50',NULL),(3,'Nur Rochmania','rochmania@gmail.com','089123453333','Gresik','2021-08-24 03:46:25','2021-08-27 00:52:32'),(4,'Abdul Hilmi','hilmi@gmail.com','089123451111','Mojokerto','2021-08-29 06:53:00','2021-08-30 21:49:11'),(5,'Dibio Agus','dibio@gmail.com','089123452222','Probolinggo','2021-08-29 06:53:29','2021-08-29 06:53:29'),(6,'Firya Nadhira','firya@gmail.com','089123453333','Pacitan','2021-08-29 06:54:10','2021-08-29 06:54:10');
/*!40000 ALTER TABLE `pengarangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_anggota` bigint unsigned NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_anggota_foreign` (`id_anggota`),
  CONSTRAINT `users_id_anggota_foreign` FOREIGN KEY (`id_anggota`) REFERENCES `anggotas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Eka Bagus Fernadi','bagusfernadieka@gmail.com',NULL,'$2y$10$Rzrkh35OODj5JTmzjcRq.ev2MicnwwcEIdVEATLaBL8dISVELVO46',1,NULL,'2021-08-22 21:34:42','2021-08-22 21:34:42'),(3,'Uzumaki Bayu','bayu@gmail.com',NULL,'$2y$10$JSbmoHRmIoEQT20kjCY4IOYJ/jjySvHrFq0uPz/fbTRBwUA5yNJY.',2,NULL,'2021-08-22 21:38:21','2021-08-22 21:38:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel_perpustakaan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-12  7:24:34
