-- --------------------------------------------------------
-- Host:                         127.0.0.1
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

-- Volcando estructura para tabla alguarisa.censo
CREATE TABLE IF NOT EXISTS `censo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `claps_id` bigint(20) unsigned NOT NULL,
  `num_familia` int(11) NOT NULL,
  `miembro_familia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_ci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estructura_clap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `lideres_id` bigint(20) unsigned DEFAULT NULL,
  `cdlp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `municipios_id` bigint(20) unsigned DEFAULT NULL,
  `parroquias_id` bigint(20) unsigned DEFAULT NULL,
  `import_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `censo_lideres_id_foreign` (`lideres_id`),
  KEY `censo_claps_id_foreign` (`claps_id`),
  KEY `censo_municipios_id_foreign` (`municipios_id`),
  KEY `censo_parroquias_id_foreign` (`parroquias_id`),
  CONSTRAINT `censo_claps_id_foreign` FOREIGN KEY (`claps_id`) REFERENCES `claps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `censo_lideres_id_foreign` FOREIGN KEY (`lideres_id`) REFERENCES `lideres` (`id`) ON DELETE SET NULL,
  CONSTRAINT `censo_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `censo_parroquias_id_foreign` FOREIGN KEY (`parroquias_id`) REFERENCES `parroquias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.censo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `censo` DISABLE KEYS */;
/*!40000 ALTER TABLE `censo` ENABLE KEYS */;

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

-- Volcando estructura para tabla alguarisa.ferias_campo
CREATE TABLE IF NOT EXISTS `ferias_campo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `municipios_id` bigint(20) unsigned NOT NULL,
  `parroquias_id` bigint(20) unsigned NOT NULL,
  `familias` int(11) NOT NULL,
  `tm` double(8,2) NOT NULL,
  `band` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ferias_campo_municipios_id_foreign` (`municipios_id`),
  KEY `ferias_campo_parroquias_id_foreign` (`parroquias_id`),
  CONSTRAINT `ferias_campo_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ferias_campo_parroquias_id_foreign` FOREIGN KEY (`parroquias_id`) REFERENCES `parroquias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.ferias_campo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ferias_campo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ferias_campo` ENABLE KEYS */;

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

-- Volcando estructura para tabla alguarisa.lideres
CREATE TABLE IF NOT EXISTS `lideres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `claps_id` bigint(20) unsigned NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `import_id` bigint(20) DEFAULT NULL,
  `municipios_id` bigint(20) unsigned DEFAULT NULL,
  `parroquias_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lideres_claps_id_foreign` (`claps_id`),
  KEY `lideres_municipios_id_foreign` (`municipios_id`),
  KEY `lideres_parroquias_id_foreign` (`parroquias_id`),
  CONSTRAINT `lideres_claps_id_foreign` FOREIGN KEY (`claps_id`) REFERENCES `claps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lideres_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lideres_parroquias_id_foreign` FOREIGN KEY (`parroquias_id`) REFERENCES `parroquias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.lideres: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `lideres` DISABLE KEYS */;
/*!40000 ALTER TABLE `lideres` ENABLE KEYS */;

-- Volcando estructura para tabla alguarisa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.migrations: ~23 rows (aproximadamente)
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
	(14, '2021_03_02_132002_add_claps_table', 1),
	(15, '2021_03_07_105526_create_lideres_table', 1),
	(16, '2021_03_07_110030_create_censo_table', 1),
	(17, '2021_03_07_132935_add_censo_table', 1),
	(18, '2021_03_07_133124_add_lideres_table', 1),
	(19, '2021_03_07_211609_add_new_censo_table', 1),
	(20, '2021_03_08_135621_add_other_censo_table', 1),
	(21, '2021_03_08_135755_add_other_lideres_table', 1),
	(22, '2021_04_28_121751_create_ferias_campo_table', 1),
	(23, '2021_05_09_154304_add_ferias_table', 1);
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

-- Volcando datos para la tabla alguarisa.municipios: ~0 rows (aproximadamente)
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
	(10, 'JUAN JOSE RONDON', 'RONDON', NULL, '2020-12-09 10:48:15'),
	(11, 'LEONARDO INFANTE', 'INFANTE\r', NULL, NULL),
	(12, 'JOSE FELIX RIBAS', 'RIBAS', NULL, '2021-02-26 16:48:52'),
	(13, 'EL SOCORRO', 'EL SOCORRO', NULL, '2021-02-24 17:11:22'),
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

-- Volcando datos para la tabla alguarisa.parroquias: ~0 rows (aproximadamente)
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
	(9, 'SAN JUAN DE LOS MORROS', 'SAN JUAN', 3, NULL, '2021-03-05 02:59:47'),
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
	(29, 'SANTA RITA DE MANAPIRE', 'SAN RITA', 10, NULL, '2021-03-04 06:10:45'),
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla alguarisa.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `status`, `permisos`, `plataforma`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Yonathan Castillo', 'leothan522@gmail.com', NULL, '$2y$10$BFBHUYVouoUZ5pCXG8yZNOwHNjvDJfzkVKUBbzNbXNsRqL7T8GXBW', '04243386600', NULL, 'R6y1fqDgFVDzpm1SJf110viBQ3kr9Kap8TdYZ0JGqm7wnABZRpZYs8g8UNDw', NULL, NULL, 100, 1, NULL, '0', NULL, '2020-11-25 10:39:46', '2020-12-10 22:34:43'),
	(3, 'Cesar Gamboa', 'planificacion.fundamercado@gmail.com', NULL, '$2y$10$UMtmFdfxRsFdn2376nyXDeTvxpJyBHgJN5q8IAt82ea78yqipDLpy', '04165433446', '19', 'ipGWNGz8IxmM9qroZvYAW3NA4oQZROXpEgCQ1okgiqs43DCqgwrwQFfvSpJb', NULL, NULL, 1, 1, '{"admin.dashboard":null,"usuarios.index":"true","usuarios.store":null,"usuarios.status":"true","usuarios.editar":null,"usuarios.clave":"true","usuarios.edit":null,"municipios.index":"true","municipios.store":null,"municipios.update":"true","municipios.destroy":null,"parroquias.index":"true","parroquias.store":null,"parroquias.update":"true","parroquias.destroy":null,"familias.index":"true","familias.store":"true","familias.update":"true","familias.destroy":"true","bloques.index":"true","bloques.store":"true","bloques.destroy":"true","bloques.consultar":"true","bloques.update":"true","gestionar_claps":"true","claps.index":"true","claps.show":"true","claps.create":"true","claps.store":"true","claps.edit":"true","claps.update":"true","claps.destroy":"true","claps.export":"true","claps.get_import":"true","claps.post_import":"true","claps.get_revision":"true","claps.post_revision":"true","claps.get_revision_export":"true","claps.borrar":"true","claps.lideres":"true","claps.censo":"true","claps.censo_import":"true","claps.censo_delete":"true","claps.formato":"true","periodos.index":"true","periodos.store":"true","periodos.update":"true","periodos.destroy":"true","periodos.show":"true","configuracion":"true","usuarios.show":"true","usuarios.update":"true","parametros":"true","gestionar_bloques":"true"}', '0', NULL, '2020-12-04 16:58:41', '2021-03-16 19:07:52'),
	(4, 'Jhonathan J Duarte M', 'jhonthan.duarte@gmail.com', NULL, '$2y$10$KoEVHv7M8dqoyI6ZIAQthu4fpwOoQfPFTmMVsJyVHnikYRoxT072W', '+584243333978', NULL, '8YFk0269I69jkDO03XtObw23L25kXl3wt2Sh9KHiKZnz1IQgQ5itJilCBTPQ', NULL, NULL, 1, 1, '{"admin.dashboard":null,"usuarios.index":null,"usuarios.store":null,"usuarios.status":null,"usuarios.editar":null,"usuarios.clave":null,"usuarios.edit":null,"municipios.index":"true","municipios.store":null,"municipios.update":"true","municipios.destroy":null,"parroquias.index":"true","parroquias.store":null,"parroquias.update":"true","parroquias.destroy":null,"familias.index":"true","familias.store":"true","familias.update":"true","familias.destroy":"true","bloques.index":"true","bloques.store":"true","bloques.destroy":"true","bloques.consultar":"true","bloques.update":"true","gestionar_claps":"true","claps.index":"true","claps.show":"true","claps.create":"true","claps.store":"true","claps.edit":"true","claps.update":"true","claps.destroy":"true","claps.export":"true","claps.get_import":"true","claps.post_import":"true","claps.get_revision":"true","claps.post_revision":"true","claps.get_revision_export":"true","claps.borrar":"true","claps.lideres":"true","claps.censo":"true","claps.censo_import":"true","claps.censo_delete":"true","claps.formato":"true","periodos.index":"true","periodos.store":"true","periodos.update":"true","periodos.destroy":"true","periodos.show":"true","configuracion":null,"usuarios.show":null,"usuarios.update":null,"parametros":"true","gestionar_bloques":"true"}', '0', NULL, '2021-01-06 10:10:39', '2021-03-21 01:45:44'),
	(5, 'Sheila Ascanio', 'ascaniolinda17@gmail.com', NULL, '$2y$10$cuFJ8jFFSbTi0srlqpSDne0M2GEfWVI/Q6Rsx2GCrTzDPMmJUpTKG', '04243386600', '45', NULL, NULL, NULL, 0, 0, NULL, '1', NULL, '2021-02-10 06:43:43', '2021-03-04 09:24:23'),
	(6, 'César Gamboa', 'cesargamboa.86@gmail.com', NULL, '$2y$10$g4XWiaPtKVLhw5lLF8MaaOyOdLFDLFeUW1/ANcClfP/YMsuB/.Sli', '04165433446', NULL, NULL, NULL, NULL, 0, 0, NULL, '1', NULL, '2021-02-10 09:04:28', '2021-03-04 09:25:55'),
	(7, 'Jenny Alves', 'JennyAlves958@gmail.com', NULL, '$2y$10$HqI4gS02U.OlMKRe6ANVMec5Qwl2cBn.MALrvPY4QkNC5AslHf6oa', '04243479368', '37', NULL, NULL, NULL, 0, 0, NULL, '1', NULL, '2021-02-10 09:12:54', '2021-02-26 19:16:39'),
	(8, 'Emilio Avila', 'Emiliocamaguan76@gmail.com', NULL, '$2y$10$7bhoN4X.jPmlknH2paAbg.3sejjzmGuO7T7qkB9vxNuslB/U5zFMq', '04243351568', NULL, '22SWYNkd7ZslRlUAcvG4sYLBemVkLiKV5O6bDuytgLN7DG506i4Va87Zrv80', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-26 19:33:59', '2021-02-26 19:33:59'),
	(9, 'Osler Moreno', 'oslercotuvol3@gmail.com', NULL, '$2y$10$UrhO.xhj8XnFlwdT.bUtZutXEtso0YvPC0hE.BQUxCUTMv2qiPx7q', '04125089248', NULL, 'C4gNrtiteDBKzmVL4rhpsaz4qApD4wc3c5EAlQywIu2RiM9rXg69hL1Auub2', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-02-26 19:34:35', '2021-02-26 19:34:35'),
	(10, 'Jose Avila', 'abilajoseluis@gmail.com', NULL, '$2y$10$qhVhn1Ct9H9dRjfnIYK7keNYoYTxjfxjSpYv5KPdHPFyoCFk7YTgO', '04127753648', NULL, 'v8Z19K2LPRCHXQ7Vj8yLXl6TYysUK7ENXBd6kUdAOkegFBJDPg7PcFYzdNkg', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-03-09 05:08:17', '2021-03-09 05:08:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
