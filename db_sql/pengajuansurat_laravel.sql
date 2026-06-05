-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pengajuansurat_laravel.arsip
CREATE TABLE IF NOT EXISTS `arsip` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `file` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pengajuansurat_laravel.arsip: ~0 rows (approximately)
DELETE FROM `arsip`;

-- Dumping structure for table pengajuansurat_laravel.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table pengajuansurat_laravel.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table pengajuansurat_laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table pengajuansurat_laravel.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table pengajuansurat_laravel.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table pengajuansurat_laravel.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table pengajuansurat_laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table pengajuansurat_laravel.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table pengajuansurat_laravel.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('cX3W6jUg5KJu4ZnEP4B2aeuG9BpD4oz6WMVwuDEF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWThhdm95RzE0QVRkVFdHbFo4RDRjVHc0eEI2YzNHbUNqbm83U05QdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1776419521);

-- Dumping structure for table pengajuansurat_laravel.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `namalurah` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pengajuansurat_laravel.setting: ~0 rows (approximately)
DELETE FROM `setting`;
INSERT INTO `setting` (`id`, `namalurah`, `nip`) VALUES
	(1, 'ALIAS SAKBADI, S.A.P', '197201051993031007');

-- Dumping structure for table pengajuansurat_laravel.surat
CREATE TABLE IF NOT EXISTS `surat` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL DEFAULT '0',
  `jenis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jeniskelamin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempatlahir` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggallahir` date DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `masaberlakuawal` date DEFAULT NULL,
  `masaberlakusampai` date DEFAULT NULL,
  `statusperkawinan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namausaha` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatperusahaan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelpon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekbli` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasiusaha` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acara` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `suratpengantar` text COLLATE utf8mb4_general_ci,
  `ktp` text COLLATE utf8mb4_general_ci,
  `kk` text COLLATE utf8mb4_general_ci,
  `suratpernyataan` text COLLATE utf8mb4_general_ci,
  `foto` text COLLATE utf8mb4_general_ci,
  `suratpermohonan` text COLLATE utf8mb4_general_ci,
  `proposalkegiatan` text COLLATE utf8mb4_general_ci,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pengajuansurat_laravel.surat: ~1 rows (approximately)
DELETE FROM `surat`;
INSERT INTO `surat` (`id`, `user_id`, `jenis`, `nama`, `jeniskelamin`, `tempatlahir`, `tanggallahir`, `agama`, `pekerjaan`, `nik`, `alamat`, `masaberlakuawal`, `masaberlakusampai`, `statusperkawinan`, `jabatan`, `namausaha`, `nib`, `npwp`, `alamatperusahaan`, `notelpon`, `email`, `kodekbli`, `lokasiusaha`, `tanggal`, `tempat`, `acara`, `suratpengantar`, `ktp`, `kk`, `suratpernyataan`, `foto`, `suratpermohonan`, `proposalkegiatan`, `status`, `created_at`, `updated_at`) VALUES
	(16, 1, 'SKTM', 'Fahrul Adib', 'Laki-laki', 'Banyuasin', '1999-11-11', 'Islam', 'Programmer', '1231231231231231', 'Banyuasin', NULL, NULL, 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4vlHBA0PXg5JbR8G1uLa1j2yiqYqv3RiTpCicJod.jpg', 'tdHMWbMeaLvaS4t9OR2MSE97UG6uJVYt2XMhsyNx.jpg', 'aEJNPhu4GckeUjAimQmB3ToXAWoEFDDlshFyTUPP.jpg', '6Q9rGRnnHcPOwDgBrliYDom8YI9xJwPmM1iuTfkj.jpg', 'W6zrYiqJepNClaLXOVGCDeBmARKJRfGdbOlcWeVa.jpg', NULL, NULL, 'Diterima', '2026-04-17 13:26:14', '2026-04-17 13:29:30');

-- Dumping structure for table pengajuansurat_laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nokk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jeniskelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengajuansurat_laravel.users: ~4 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `alamat`, `nik`, `nokk`, `jeniskelamin`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Staff', 'staff@gmail.com', NULL, '$2y$12$TDZ/QLkX6oKMhqcnyp5uTutCLfV1QjdpX.JHDnpOMw6Ff.PErjBVO', 'Palembang', '12312344554', '388477362', 'Laki-laki', 'Staff', NULL, NULL, '2026-04-15 21:57:31'),
	(2, 'Fahrul Adib', 'fahruladib9@gmail.com', NULL, '$2y$12$eaRIGqqKIZ4fGGtL9FspBezHZtTXQ0HsT/AgoeKeVMWgKPGZN58sC', 'Banyuasin', '1231231231231231', '123211231', 'Laki-laki', 'Warga', NULL, '2026-04-15 20:02:36', '2026-04-15 20:03:49'),
	(3, 'Lurah', 'lurah@gmail.com', NULL, '$2y$12$eaRIGqqKIZ4fGGtL9FspBezHZtTXQ0HsT/AgoeKeVMWgKPGZN58sC', 'Palembang', '546564352523', '5674356435', 'Laki-laki', 'Lurah', NULL, NULL, NULL),
	(5, 'Sudendev', 'sudendev@gmail.com', NULL, '$2y$12$kgnMjIpFGXW8d5902yN69ukeP5jUoKbSPqVC193p8QR3GObdjM85e', 'Banyuasin', '21313124123131', '1231412', 'Laki-laki', 'Warga', NULL, '2026-04-17 02:36:49', '2026-04-17 02:36:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
