-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para alguarisa
CREATE DATABASE IF NOT EXISTS `alguarisa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `alguarisa`;

-- Volcando estructura para tabla alguarisa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Volcando datos para la tabla alguarisa.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.migrations: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2020_11_12_151908_create_sessions_table', 1),
	(7, '2020_11_22_133613_create_municipios_table', 1),
	(8, '2020_11_22_133823_create_parroquias_table', 1),
	(9, '2020_11_22_223710_add_users_plataforma', 1),
	(10, '2020_11_24_183254_create_parametros_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.municipios
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_corto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.municipios: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` (`id`, `nombre_completo`, `nombre_corto`, `created_at`, `updated_at`) VALUES
	(1, 'SAN JOSE DE GUARIBE', 'GUARIBE\r', NULL, NULL),
	(2, 'JOSE TADEO MONAGAS', 'MONAGAS\r', NULL, NULL),
	(3, 'JUAN GERMAN ROSCIO NIEVES', 'ROSCIO\r', NULL, NULL),
	(4, 'ORTIZ', 'ORTIZ\r', NULL, NULL),
	(5, 'JULIAN MELLADO', 'MELLADO\r', NULL, NULL),
	(6, 'FRANCISCO DE MIRANDA', 'MIRANDA\r', NULL, NULL),
	(7, 'ESTEROS DE CAMAGUAN', 'CAMAGUAN\r', NULL, NULL),
	(8, 'SAN GERONIMO DE GUAYABAL', 'GUAYABAL\r', NULL, NULL),
	(9, 'CHAGUARAMAS', 'CHAGUARAMAS\r', NULL, NULL),
	(10, 'JUAN JOSE RONDON', 'LAS MERCEDES\r', NULL, NULL),
	(11, 'LEONARDO INFANTE', 'INFANTE\r', NULL, NULL),
	(12, 'JOSE FELIX RIBAS', 'RIBAS\r', NULL, NULL),
	(13, 'EL SOCORRO', 'EL SOCORRO\r', NULL, NULL),
	(14, 'SANTA MARIA DE IPIRE', 'SANTA MARIA\r', NULL, NULL),
	(15, 'PEDRO ZARAZA', 'ZARAZA\r', NULL, NULL);
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabla_id` bigint(20) unsigned DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.parametros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.parroquias
CREATE TABLE IF NOT EXISTS `parroquias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_corto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipios_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parroquias_municipios_id_foreign` (`municipios_id`),
  CONSTRAINT `parroquias_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.parroquias: ~39 rows (aproximadamente)
/*!40000 ALTER TABLE `parroquias` DISABLE KEYS */;
INSERT INTO `parroquias` (`id`, `nombre_completo`, `nombre_corto`, `municipios_id`, `created_at`, `updated_at`) VALUES
	(1, 'GUARIBE', NULL, 1, NULL, NULL),
	(2, 'CARLOS SOUBLETTE', NULL, 2, NULL, NULL),
	(3, 'PASO REAL DE MACAIRA', NULL, 2, NULL, NULL),
	(4, 'SAN FRANCISCO DE MACAIRA', NULL, 2, NULL, NULL),
	(5, 'ALTAGRACIA DE ORITUCO', NULL, 2, NULL, NULL),
	(6, 'SAN RAFAEL DE ORITUCO', NULL, 2, NULL, NULL),
	(7, 'LIBERTAD DE ORITUCO', NULL, 2, NULL, NULL),
	(8, 'SAN FRANCISCO JAVIER DE LEZAMA', NULL, 2, NULL, NULL),
	(9, 'SAN JUAN', NULL, 3, NULL, NULL),
	(10, 'PARAPARA', NULL, 3, NULL, NULL),
	(11, 'CANTAGALLO', NULL, 3, NULL, NULL),
	(12, 'ORTIZ', NULL, 4, NULL, NULL),
	(13, 'SAN JOSE DE TIZNADOS', NULL, 4, NULL, NULL),
	(14, 'SAN LORENZO DE TIZNADOS', NULL, 4, NULL, NULL),
	(15, 'SAN FRANCISCO DE TIZNADOS', NULL, 4, NULL, NULL),
	(16, 'EL SOMBRERO', NULL, 5, NULL, NULL),
	(17, 'SOSA', NULL, 5, NULL, NULL),
	(18, 'CALABOZO', NULL, 6, NULL, NULL),
	(19, 'EL RASTRO', NULL, 6, NULL, NULL),
	(20, 'GUARDATINAJAS', NULL, 6, NULL, NULL),
	(21, 'EL CALVARIO', NULL, 6, NULL, NULL),
	(22, 'CAMAGUAN', NULL, 7, NULL, NULL),
	(23, 'PUERTO MIRANDA', NULL, 7, NULL, NULL),
	(24, 'UVERITO', NULL, 7, NULL, NULL),
	(25, 'GUAYABAL', NULL, 8, NULL, NULL),
	(26, 'CAZORLA', NULL, 8, NULL, NULL),
	(27, 'CHAGUARAMAS', NULL, 9, NULL, NULL),
	(28, 'LAS MERCEDES', NULL, 10, NULL, NULL),
	(29, 'SANTA RIRA DE MANAPIRE', NULL, 10, NULL, NULL),
	(30, 'CABRUTA', NULL, 10, NULL, NULL),
	(31, 'VALLE DE LA PASCUA', NULL, 11, NULL, NULL),
	(32, 'ESPINO', NULL, 11, NULL, NULL),
	(33, 'TUCUPIDO', NULL, 12, NULL, NULL),
	(34, 'SAN RAFAEL DE LAYA', NULL, 12, NULL, NULL),
	(35, 'EL SOCORRO', NULL, 13, NULL, NULL),
	(36, 'SANTA MARIA', NULL, 14, NULL, NULL),
	(37, 'ALTAMIRA', NULL, 14, NULL, NULL),
	(38, 'ZARAZA', NULL, 15, NULL, NULL),
	(39, 'SAN JOSE DE UNARE', NULL, 15, NULL, NULL);
/*!40000 ALTER TABLE `parroquias` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Volcando datos para la tabla alguarisa.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.sessions: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('QKogxRn0J2sHvZY5x0YK5eOQckFjOgyM71dyqiZU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNXNqWmFZbXljRFBtdDRlM3hIMlMxanhjSk1QaktEcklWdVlSekFRcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9wcm95ZWN0by50ZXN0L2Rhc2hib2FyZCI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkSXpaQi9Wc3lqUXlBNzBYeWE1c2gyLmRQNHFNOERoSzBFeEwyeS56YlVRdGdOYmNkQzhjOUMiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJEl6WkIvVnN5alF5QTcwWHlhNXNoMi5kUDRxTThEaEswRXhMMnkuemJVUXRnTmJjZEM4YzlDIjt9', 1606228835),
	('Sec3uUFdgslwRRSNfQSv0XKwxqJQcMLVt94dLQlS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoib1NBSHBrUlUwVVVDSnZheWZWMGczSTZxYnNGaGtsT0s2UTRnalhPNSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vcHJveWVjdG8udGVzdC9hZG1pbi91c3VhcmlvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRJelpCL1ZzeWpReUE3MFh5YTVzaDIuZFA0cU04RGhLMEV4TDJ5LnpiVVF0Z05iY2RDOGM5QyI7fQ==', 1606410473);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `role` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `permisos` text COLLATE utf8mb4_unicode_ci,
  `plataforma` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `status`, `permisos`, `plataforma`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Yonathan Castillo', 'leothan522@gmail.com', NULL, '$2y$10$IzZB/VsyjQyA70Xya5sh2.dP4qM8DhK0ExL2y.zbUQtgNbcdC8c9C', NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, '0', NULL, '2020-11-24 10:39:46', '2020-11-24 10:39:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
