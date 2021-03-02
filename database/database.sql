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
CREATE DATABASE IF NOT EXISTS `admin_alguarisa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `admin_alguarisa`;

-- Volcando estructura para tabla alguarisa.claps
CREATE TABLE IF NOT EXISTS `claps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_clap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CLAP',
  `municipios_id` bigint(20) unsigned DEFAULT NULL,
  `parroquias_id` bigint(20) unsigned DEFAULT NULL,
  `comunidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_spda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_sica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bloques_id` bigint(20) unsigned DEFAULT NULL,
  `cedula_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_nombre_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segundo_nombre_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_apellido_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segundo_apellido_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nacionalidad_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nac_lider` date DEFAULT NULL,
  `profesion_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trabajo_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_1_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_2_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `longitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `productivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_produccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalles_produccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_familias` int(11) DEFAULT NULL,
  `num_lideres` int(11) DEFAULT NULL,
  `import_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `claps_import_id_foreign` (`import_id`),
  KEY `claps_bloques_id_foreign` (`bloques_id`),
  KEY `claps_parroquias_id_foreign` (`parroquias_id`),
  KEY `claps_municipios_id_foreign` (`municipios_id`),
  CONSTRAINT `claps_bloques_id_foreign` FOREIGN KEY (`bloques_id`) REFERENCES `parametros` (`id`) ON DELETE SET NULL,
  CONSTRAINT `claps_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `parametros` (`id`) ON DELETE SET NULL,
  CONSTRAINT `claps_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE SET NULL,
  CONSTRAINT `claps_parroquias_id_foreign` FOREIGN KEY (`parroquias_id`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.claps: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `claps` DISABLE KEYS */;
/*!40000 ALTER TABLE `claps` ENABLE KEYS */;

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

-- Volcando estructura para tabla alguarisa.import_claps
CREATE TABLE IF NOT EXISTS `import_claps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_clap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CLAP',
  `municipios_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parroquias_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comunidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_spda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_sica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bloques_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_nombre_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segundo_nombre_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_apellido_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segundo_apellido_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nacionalidad_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nac_lider` date DEFAULT NULL,
  `profesion_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trabajo_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_1_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_2_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus_lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `longitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `import_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `import_claps_import_id_foreign` (`import_id`),
  CONSTRAINT `import_claps_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `parametros` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.import_claps: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `import_claps` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_claps` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.migrations: ~14 rows (aproximadamente)
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
	(10, '2020_11_24_183254_create_parametros_table', 1),
	(11, '2020_11_27_061319_create_claps_table', 1),
	(12, '2020_11_27_064319_create_import_claps_table', 1),
	(13, '2021_03_01_071533_create_periodos_table', 1),
	(14, '2021_03_02_132002_add_claps_table', 1);
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
	(10, 'JUAN JOSE RONDON', 'RONDON', NULL, '2020-12-08 17:48:15'),
	(11, 'LEONARDO INFANTE', 'INFANTE\r', NULL, NULL),
	(12, 'JOSE FELIX RIBAS', 'RIBAS', NULL, '2021-02-25 23:48:52'),
	(13, 'EL SOCORRO', 'EL SOCORRO', NULL, '2021-02-24 00:11:22'),
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
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.parametros: ~195 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` (`id`, `nombre`, `tabla_id`, `valor`, `created_at`, `updated_at`) VALUES
	(1, 'familias_estadal', 0, '292146', '2020-12-14 16:57:25', '2021-02-26 00:05:48'),
	(2, 'claps_estadal', 0, '1787', '2020-12-14 16:57:25', '2021-02-26 00:05:11'),
	(3, 'familias', 9, '7389', '2020-12-14 20:00:40', '2021-02-26 02:51:06'),
	(4, 'claps', 9, '45', '2020-12-14 20:00:40', '2021-02-26 02:51:06'),
	(5, 'familias', 13, '8322', '2020-12-14 20:01:01', '2020-12-14 20:01:01'),
	(6, 'claps', 13, '51', '2020-12-14 20:01:01', '2021-02-24 00:13:02'),
	(7, 'familias', 7, '12690', '2020-12-14 20:01:22', '2020-12-14 20:01:22'),
	(8, 'claps', 7, '85', '2020-12-14 20:01:22', '2021-02-26 00:59:42'),
	(9, 'familias', 6, '52993', '2020-12-14 20:01:50', '2020-12-14 20:01:50'),
	(10, 'claps', 6, '250', '2020-12-14 20:01:50', '2020-12-14 20:01:50'),
	(11, 'familias', 12, '16101', '2020-12-14 20:02:15', '2020-12-14 20:02:15'),
	(12, 'claps', 12, '127', '2020-12-14 20:02:15', '2021-02-26 00:04:43'),
	(13, 'familias', 2, '27799', '2020-12-14 20:02:34', '2020-12-14 20:02:34'),
	(14, 'claps', 2, '119', '2020-12-14 20:02:34', '2020-12-14 20:02:34'),
	(15, 'familias', 3, '48758', '2020-12-14 20:02:56', '2020-12-14 20:02:56'),
	(16, 'claps', 3, '259', '2020-12-14 20:02:56', '2020-12-14 20:02:56'),
	(17, 'familias', 10, '13328', '2020-12-14 20:03:47', '2020-12-14 20:03:47'),
	(18, 'claps', 10, '77', '2020-12-14 20:03:47', '2020-12-14 20:03:47'),
	(19, 'familias', 5, '11859', '2020-12-14 20:04:12', '2020-12-14 20:04:12'),
	(20, 'claps', 5, '62', '2020-12-14 20:04:12', '2020-12-14 20:04:12'),
	(21, 'familias', 11, '40259', '2020-12-14 20:04:52', '2020-12-14 20:04:52'),
	(22, 'claps', 11, '262', '2020-12-14 20:04:52', '2020-12-14 20:04:52'),
	(23, 'familias', 4, '9379', '2020-12-14 20:05:14', '2020-12-14 20:05:14'),
	(24, 'claps', 4, '67', '2020-12-14 20:05:14', '2020-12-14 20:05:14'),
	(25, 'familias', 15, '22636', '2020-12-14 20:05:39', '2020-12-14 20:05:39'),
	(26, 'claps', 15, '187', '2020-12-14 20:05:39', '2020-12-14 20:05:39'),
	(27, 'familias', 8, '9484', '2020-12-14 20:06:09', '2020-12-14 20:06:09'),
	(28, 'claps', 8, '114', '2020-12-14 20:06:09', '2020-12-14 20:06:09'),
	(29, 'familias', 1, '5291', '2020-12-14 20:07:00', '2020-12-14 20:07:00'),
	(30, 'claps', 1, '31', '2020-12-14 20:07:00', '2020-12-14 20:07:00'),
	(31, 'familias', 14, '6840', '2020-12-14 20:07:28', '2020-12-14 20:07:28'),
	(32, 'claps', 14, '48', '2020-12-14 20:07:28', '2020-12-14 20:07:28'),
	(33, 'bloques', 9, '1', '2020-12-14 20:08:44', '2020-12-14 20:08:44'),
	(35, 'bloques', 13, '1', '2020-12-14 20:09:22', '2020-12-14 20:09:22'),
	(36, 'bloques', 7, '1', '2020-12-14 20:09:32', '2020-12-14 20:09:32'),
	(37, 'bloques', 6, '1', '2020-12-14 20:09:50', '2020-12-14 20:09:50'),
	(38, 'bloques', 6, '2', '2020-12-14 20:09:57', '2020-12-14 20:09:57'),
	(39, 'bloques', 6, '3', '2020-12-14 20:10:03', '2020-12-14 20:10:03'),
	(43, 'bloques', 3, '1', '2020-12-14 20:11:33', '2020-12-14 20:11:33'),
	(44, 'bloques', 3, '2', '2020-12-14 20:11:45', '2020-12-14 20:11:45'),
	(45, 'bloques', 3, '3', '2020-12-14 20:11:50', '2020-12-14 20:11:50'),
	(46, 'bloques', 3, '4', '2020-12-14 20:12:02', '2020-12-14 20:12:02'),
	(47, 'bloques', 10, '1', '2020-12-14 20:12:20', '2020-12-14 20:12:20'),
	(48, 'bloques', 5, '1', '2020-12-14 20:13:01', '2020-12-14 20:13:01'),
	(49, 'bloques', 11, '1', '2020-12-14 20:13:12', '2020-12-14 20:13:12'),
	(50, 'bloques', 11, '2', '2020-12-14 20:13:16', '2020-12-14 20:13:16'),
	(51, 'bloques', 11, '3', '2020-12-14 20:13:22', '2020-12-14 20:13:22'),
	(52, 'bloques', 11, '4', '2020-12-14 20:13:28', '2020-12-14 20:13:28'),
	(53, 'bloques', 4, '1', '2020-12-14 20:13:33', '2020-12-14 20:13:33'),
	(54, 'bloques', 15, '1', '2020-12-14 20:13:39', '2020-12-14 20:13:39'),
	(55, 'bloques', 8, '1', '2020-12-14 20:13:45', '2020-12-14 20:13:45'),
	(56, 'bloques', 1, '1', '2020-12-14 20:13:51', '2020-12-14 20:13:51'),
	(57, 'bloques', 14, '1', '2020-12-14 20:13:56', '2020-12-14 20:13:56'),
	(61, 'bloques', 7, 'BMS', '2020-12-16 16:36:04', '2021-02-22 23:43:53'),
	(62, 'bloque_claps', 61, '24', '2020-12-16 16:36:26', '2021-02-08 23:01:41'),
	(63, 'bloque_familias', 61, '1000', '2020-12-16 16:36:26', '2021-02-26 02:18:33'),
	(64, 'bloque_claps', 36, '61', '2021-01-05 17:33:53', '2021-02-08 23:01:16'),
	(65, 'bloque_familias', 36, '9544', '2021-01-05 17:33:53', '2021-02-08 23:01:16'),
	(66, 'bloque_claps', 37, '44', '2021-01-05 17:39:24', '2021-02-24 00:59:44'),
	(67, 'bloque_familias', 37, '14071', '2021-01-05 17:39:24', '2021-02-24 00:59:44'),
	(73, 'bloque_claps', 33, '21', '2021-01-15 16:54:41', '2021-02-24 00:50:58'),
	(74, 'bloque_familias', 33, '4502', '2021-01-15 16:54:41', '2021-02-24 00:50:58'),
	(109, 'bloque_claps', 38, '44', '2021-02-23 21:56:53', '2021-02-24 00:59:58'),
	(110, 'bloque_familias', 38, '14178', '2021-02-23 21:56:53', '2021-02-24 00:59:58'),
	(111, 'bloque_claps', 39, '128', '2021-02-23 21:57:26', '2021-02-24 01:00:09'),
	(112, 'bloque_familias', 39, '13073', '2021-02-23 21:57:26', '2021-02-24 01:00:09'),
	(162, 'bloque_claps', 35, '35', '2021-02-24 00:06:51', '2021-02-24 00:06:51'),
	(163, 'bloque_familias', 35, '7146', '2021-02-24 00:06:51', '2021-02-24 00:08:07'),
	(164, 'bloques', 13, 'BMS', '2021-02-24 00:06:58', '2021-02-24 00:07:16'),
	(166, 'bloque_claps', 164, '16', '2021-02-24 00:07:16', '2021-02-24 00:07:16'),
	(167, 'bloque_familias', 164, '1176', '2021-02-24 00:07:16', '2021-02-24 00:08:32'),
	(186, 'bloques', 9, 'BMS', '2021-02-24 00:49:35', '2021-02-24 00:50:15'),
	(187, 'bloque_claps', 186, '23', '2021-02-24 00:50:15', '2021-02-24 00:50:15'),
	(188, 'bloque_familias', 186, '1887', '2021-02-24 00:50:15', '2021-02-24 00:50:15'),
	(189, 'bloque_claps', 56, '21', '2021-02-24 00:51:47', '2021-02-24 00:51:47'),
	(190, 'bloque_familias', 56, '4293', '2021-02-24 00:51:47', '2021-02-24 00:51:47'),
	(191, 'bloques', 1, 'BMS', '2021-02-24 00:51:54', '2021-02-24 00:52:18'),
	(192, 'bloque_claps', 191, '10', '2021-02-24 00:52:18', '2021-02-24 00:52:18'),
	(193, 'bloque_familias', 191, '998', '2021-02-24 00:52:18', '2021-02-24 00:52:18'),
	(194, 'bloque_claps', 55, '78', '2021-02-24 00:52:55', '2021-02-27 21:40:33'),
	(195, 'bloque_familias', 55, '7096', '2021-02-24 00:52:55', '2021-02-24 00:52:55'),
	(196, 'bloques', 8, 'BMS', '2021-02-24 00:53:02', '2021-02-24 00:53:28'),
	(197, 'bloque_claps', 196, '36', '2021-02-24 00:53:28', '2021-02-27 21:40:44'),
	(198, 'bloque_familias', 196, '2388', '2021-02-24 00:53:28', '2021-02-24 00:53:28'),
	(199, 'import_clap', NULL, '3', '2021-02-24 00:54:00', '2021-02-24 00:54:00'),
	(200, 'bloques', 2, 'BMS', '2021-02-24 00:54:00', '2021-02-24 00:54:00'),
	(201, 'bloques', 2, '2', '2021-02-24 00:54:00', '2021-02-24 00:54:00'),
	(202, 'bloques', 2, '1', '2021-02-24 00:54:00', '2021-02-24 00:54:00'),
	(203, 'bloque_claps', 202, '25', '2021-02-24 00:55:06', '2021-02-24 00:55:06'),
	(204, 'bloque_familias', 202, '6754', '2021-02-24 00:55:06', '2021-02-24 00:55:06'),
	(205, 'import_clap', NULL, '4', '2021-02-24 00:55:14', '2021-02-24 00:55:14'),
	(206, 'bloque_claps', 201, '62', '2021-02-24 00:55:27', '2021-02-24 00:55:27'),
	(207, 'bloque_familias', 201, '13156', '2021-02-24 00:55:27', '2021-02-24 00:55:27'),
	(208, 'bloque_claps', 200, '32', '2021-02-24 00:55:45', '2021-02-26 02:20:51'),
	(209, 'bloque_familias', 200, '7890', '2021-02-24 00:55:45', '2021-02-24 00:55:45'),
	(210, 'bloques', 11, 'BMS', '2021-02-24 00:56:15', '2021-02-24 00:58:16'),
	(211, 'bloque_claps', 49, '46', '2021-02-24 00:56:33', '2021-02-24 00:56:33'),
	(212, 'bloque_familias', 49, '8586', '2021-02-24 00:56:33', '2021-02-24 00:56:33'),
	(213, 'bloque_claps', 50, '52', '2021-02-24 00:56:52', '2021-02-24 00:56:52'),
	(214, 'bloque_familias', 50, '7940', '2021-02-24 00:56:52', '2021-02-24 00:56:52'),
	(215, 'bloque_claps', 51, '47', '2021-02-24 00:57:16', '2021-02-24 00:57:16'),
	(216, 'bloque_familias', 51, '7960', '2021-02-24 00:57:16', '2021-02-24 00:57:16'),
	(217, 'bloque_claps', 52, '79', '2021-02-24 00:57:51', '2021-02-24 00:57:51'),
	(218, 'bloque_familias', 52, '10464', '2021-02-24 00:57:51', '2021-02-24 00:57:51'),
	(219, 'bloque_claps', 210, '38', '2021-02-24 00:58:16', '2021-02-24 00:58:16'),
	(220, 'bloque_familias', 210, '5309', '2021-02-24 00:58:16', '2021-02-24 00:58:16'),
	(221, 'bloques', 5, 'BMS', '2021-02-24 00:58:30', '2021-02-24 00:59:05'),
	(222, 'bloque_claps', 48, '43', '2021-02-24 00:58:42', '2021-02-24 00:58:42'),
	(223, 'bloque_familias', 48, '7377', '2021-02-24 00:58:42', '2021-02-24 00:58:42'),
	(224, 'bloque_claps', 221, '19', '2021-02-24 00:59:05', '2021-02-24 00:59:05'),
	(225, 'bloque_familias', 221, '4482', '2021-02-24 00:59:05', '2021-02-24 00:59:05'),
	(226, 'bloques', 6, 'BMS', '2021-02-24 00:59:26', '2021-02-24 01:00:26'),
	(227, 'bloque_claps', 226, '38', '2021-02-24 01:00:26', '2021-02-24 01:00:26'),
	(228, 'bloque_familias', 226, '11671', '2021-02-24 01:00:26', '2021-02-24 01:00:26'),
	(229, 'bloques', 4, 'BMS', '2021-02-24 01:00:37', '2021-02-24 01:01:01'),
	(230, 'bloque_claps', 53, '56', '2021-02-24 01:00:46', '2021-02-27 23:26:49'),
	(231, 'bloque_familias', 53, '8290', '2021-02-24 01:00:46', '2021-02-24 01:00:46'),
	(232, 'bloque_claps', 229, '11', '2021-02-24 01:01:01', '2021-02-27 23:26:43'),
	(233, 'bloque_familias', 229, '1089', '2021-02-24 01:01:01', '2021-02-24 01:01:01'),
	(239, 'bloques', 10, 'BMS', '2021-02-24 01:02:17', '2021-02-24 01:02:59'),
	(240, 'bloque_claps', 47, '42', '2021-02-24 01:02:34', '2021-02-24 01:02:34'),
	(241, 'bloque_familias', 47, '8100', '2021-02-24 01:02:34', '2021-02-24 01:02:34'),
	(242, 'bloque_claps', 239, '35', '2021-02-24 01:02:59', '2021-02-24 01:02:59'),
	(243, 'bloque_familias', 239, '5228', '2021-02-24 01:02:59', '2021-02-24 01:02:59'),
	(244, 'bloques', 3, 'BMS', '2021-02-24 01:03:12', '2021-02-24 01:04:34'),
	(245, 'bloque_claps', 43, '73', '2021-02-24 01:03:32', '2021-02-24 01:03:32'),
	(246, 'bloque_familias', 43, '8980', '2021-02-24 01:03:32', '2021-02-24 01:03:32'),
	(247, 'bloque_claps', 44, '51', '2021-02-24 01:03:48', '2021-02-24 01:03:48'),
	(248, 'bloque_familias', 44, '9252', '2021-02-24 01:03:48', '2021-02-24 01:03:48'),
	(249, 'bloque_claps', 45, '40', '2021-02-24 01:04:00', '2021-02-24 01:04:00'),
	(250, 'bloque_familias', 45, '7762', '2021-02-24 01:04:00', '2021-02-24 01:04:00'),
	(251, 'bloque_claps', 46, '38', '2021-02-24 01:04:16', '2021-02-24 01:04:16'),
	(252, 'bloque_familias', 46, '10117', '2021-02-24 01:04:16', '2021-02-24 01:04:16'),
	(253, 'bloque_claps', 244, '57', '2021-02-24 01:04:34', '2021-02-24 01:04:34'),
	(254, 'bloque_familias', 244, '12652', '2021-02-24 01:04:34', '2021-02-24 01:04:34'),
	(255, 'bloques', 14, 'BMS', '2021-02-24 01:04:42', '2021-02-24 01:05:29'),
	(256, 'bloque_claps', 57, '44', '2021-02-24 01:05:00', '2021-02-24 01:05:00'),
	(257, 'bloque_familias', 57, '5770', '2021-02-24 01:05:00', '2021-02-24 01:05:00'),
	(258, 'bloque_claps', 255, '4', '2021-02-24 01:05:29', '2021-02-24 01:05:29'),
	(259, 'bloque_familias', 255, '1070', '2021-02-24 01:05:29', '2021-02-24 01:05:29'),
	(261, 'bloque_claps', 54, '129', '2021-02-24 01:06:00', '2021-02-24 01:06:00'),
	(262, 'bloque_familias', 54, '20348', '2021-02-24 01:06:00', '2021-02-24 01:06:00'),
	(279, 'bloques', 12, '1', '2021-02-25 23:53:30', '2021-02-25 23:53:30'),
	(280, 'bloques', 12, 'BMS', '2021-02-25 23:53:46', '2021-02-25 23:54:39'),
	(281, 'bloque_claps', 279, '72', '2021-02-25 23:54:04', '2021-02-25 23:54:04'),
	(282, 'bloque_familias', 279, '11267', '2021-02-25 23:54:04', '2021-02-25 23:54:04'),
	(283, 'bloque_claps', 280, '55', '2021-02-25 23:54:39', '2021-02-25 23:54:39'),
	(284, 'bloque_familias', 280, '4834', '2021-02-25 23:54:39', '2021-02-25 23:54:39'),
	(300, 'bloques', 15, 'BMS', '2021-03-01 22:20:11', '2021-03-01 22:20:36'),
	(301, 'bloque_claps', 300, '58', '2021-03-01 22:20:36', '2021-03-01 22:20:36'),
	(302, 'bloque_familias', 300, '2288', '2021-03-01 22:20:36', '2021-03-01 22:20:36'),
	(306, 'bloques', 15, '3', '2021-03-02 19:45:18', '2021-03-02 19:45:18'),
	(307, 'bloques', 15, '3', '2021-03-02 19:45:19', '2021-03-02 19:45:19');
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

-- Volcando estructura para tabla alguarisa.periodos
CREATE TABLE IF NOT EXISTS `periodos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parametros_id` bigint(20) unsigned NOT NULL,
  `municipios_id` bigint(20) unsigned NOT NULL,
  `fecha_atencion` date NOT NULL,
  `tipo_entrega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'completa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periodos_parametros_id_foreign` (`parametros_id`),
  KEY `periodos_municipios_id_foreign` (`municipios_id`),
  CONSTRAINT `periodos_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `periodos_parametros_id_foreign` FOREIGN KEY (`parametros_id`) REFERENCES `parametros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.periodos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;

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

-- Volcando datos para la tabla alguarisa.sessions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `status`, `permisos`, `plataforma`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Yonathan Castillo ', 'leothan522@gmail.com', NULL, '$2y$10$BFBHUYVouoUZ5pCXG8yZNOwHNjvDJfzkVKUBbzNbXNsRqL7T8GXBW', '04243386600', NULL, 'ozgKJVMgMlwEEGNnxpkeRg4MIhRUaslSY1Amn0OpZr6WhBhVsVpR9lYuACDh', NULL, NULL, 100, 1, NULL, '0', NULL, '2020-11-24 17:39:46', '2020-12-10 05:34:43'),
	(3, 'Cesar Gamboa', 'planificacion.fundamercado@gmail.com', NULL, '$2y$10$UMtmFdfxRsFdn2376nyXDeTvxpJyBHgJN5q8IAt82ea78yqipDLpy', NULL, '19', 'svWdpDqkVGqIMx0l3txtCEZpmUHcLUXbhFFFcTPBF3nzYkSnTL8TZ1hcMXUp', NULL, NULL, 1, 1, '{"admin.dashboard":null,"usuarios.index":"true","usuarios.store":null,"usuarios.status":"true","usuarios.editar":null,"usuarios.clave":"true","usuarios.edit":null,"municipios.index":"true","municipios.store":null,"municipios.update":"true","municipios.destroy":null,"parroquias.index":"true","parroquias.store":null,"parroquias.update":"true","parroquias.destroy":null,"familias.index":"true","familias.store":"true","familias.update":"true","familias.destroy":"true","bloques.index":"true","bloques.store":"true","bloques.destroy":"true","bloques.consultar":"true","bloques.update":"true","gestionar_claps":"true","claps.index":"true","claps.show":"true","claps.create":"true","claps.store":"true","claps.edit":"true","claps.update":"true","claps.destroy":"true","claps.export":"true","claps.get_import":"true","claps.post_import":"true","claps.get_revision":"true","claps.post_revision":"true","claps.get_revision_export":"true","claps.borrar":"true","periodos.index":"true","periodos.store":"true","periodos.update":"true","periodos.destroy":"true","configuracion":"true","usuarios.show":"true","usuarios.update":"true","parametros":"true","gestionar_bloques":"true"}', '0', NULL, '2020-12-03 23:58:41', '2021-03-01 22:11:16'),
	(4, 'Jhonathan Duarte', 'jhonthan.duarte@gmail.com', NULL, '$2y$10$KoEVHv7M8dqoyI6ZIAQthu4fpwOoQfPFTmMVsJyVHnikYRoxT072W', '+584243333978', NULL, 'd15hdLAs4YA4Krr30xAq8a6zM0DYuRDU1iRXJC1VroauEQHJkYr8l8Af6XsE', NULL, NULL, 1, 1, '{"admin.dashboard":null,"usuarios.index":null,"usuarios.store":null,"usuarios.status":null,"usuarios.editar":null,"usuarios.clave":null,"usuarios.edit":null,"municipios.index":"true","municipios.store":null,"municipios.update":null,"municipios.destroy":null,"parroquias.index":"true","parroquias.store":null,"parroquias.update":null,"parroquias.destroy":null,"familias.index":"true","familias.store":"true","familias.update":"true","familias.destroy":"true","bloques.index":"true","bloques.store":"true","bloques.destroy":"true","bloques.consultar":"true","bloques.update":"true","gestionar_claps":"true","claps.index":"true","claps.show":"true","claps.create":"true","claps.store":"true","claps.edit":"true","claps.update":"true","claps.destroy":"true","claps.export":"true","claps.get_import":"true","claps.post_import":"true","claps.get_revision":"true","claps.post_revision":"true","claps.get_revision_export":"true","claps.borrar":"true","periodos.index":"true","periodos.store":"true","periodos.update":"true","periodos.destroy":"true","configuracion":null,"usuarios.show":null,"usuarios.update":null,"parametros":"true","gestionar_bloques":"true"}', '0', NULL, '2021-01-05 17:10:39', '2021-03-02 19:50:34'),
	(5, 'Sheila Ascanio', 'ascaniolinda17@gmail.com', NULL, '$2y$10$cuFJ8jFFSbTi0srlqpSDne0M2GEfWVI/Q6Rsx2GCrTzDPMmJUpTKG', '04243386600', '45', NULL, NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-09 13:43:43', '2021-02-26 19:34:40'),
	(6, 'César Gamboa', 'cesargamboa.86@gmail.com', NULL, '$2y$10$g4XWiaPtKVLhw5lLF8MaaOyOdLFDLFeUW1/ANcClfP/YMsuB/.Sli', '04165433446', NULL, NULL, NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-09 16:04:28', '2021-02-09 16:04:28'),
	(7, 'Jenny Alves', 'JennyAlves958@gmail.com', NULL, '$2y$10$HqI4gS02U.OlMKRe6ANVMec5Qwl2cBn.MALrvPY4QkNC5AslHf6oa', '04243479368', '37', NULL, NULL, NULL, 0, 0, NULL, '1', NULL, '2021-02-09 16:12:54', '2021-02-26 02:16:39'),
	(8, 'Emilio Avila', 'Emiliocamaguan76@gmail.com', NULL, '$2y$10$7bhoN4X.jPmlknH2paAbg.3sejjzmGuO7T7qkB9vxNuslB/U5zFMq', '04243351568', NULL, '22SWYNkd7ZslRlUAcvG4sYLBemVkLiKV5O6bDuytgLN7DG506i4Va87Zrv80', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-26 02:33:59', '2021-02-26 02:33:59'),
	(9, 'Osler Moreno', 'oslercotuvol3@gmail.com', NULL, '$2y$10$UrhO.xhj8XnFlwdT.bUtZutXEtso0YvPC0hE.BQUxCUTMv2qiPx7q', '04125089248', NULL, 'C4gNrtiteDBKzmVL4rhpsaz4qApD4wc3c5EAlQywIu2RiM9rXg69hL1Auub2', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-26 02:34:35', '2021-02-26 02:34:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
