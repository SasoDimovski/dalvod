-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jan 30, 2026 at 03:58 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dalvod`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`%` PROCEDURE `create_gapres_table` ()   BEGIN
  CREATE TABLE IF NOT EXISTS gapres (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

    id_project INT NOT NULL,

    br_stolb  INT NULL,
    stac_t    FLOAT NULL,
    raspon    FLOAT NULL,

    grr_lpro  FLOAT NULL,
    grr_dpro  FLOAT NULL,
    grr_vpro  FLOAT NULL,
    proc_gv   FLOAT NULL,
    grr_st    FLOAT NULL,

    grr_lprk  FLOAT NULL,
    grr_dprk  FLOAT NULL,
    grr_vprk  FLOAT NULL,

    elr_pro1  FLOAT NULL,
    elr_pro2  FLOAT NULL,

    sre_ras   FLOAT NULL,
    proc_sr   FLOAT NULL,
    s_ra_st   FLOAT NULL,

    grr_lzaj  FLOAT NULL,
    grr_dzaj  FLOAT NULL,
    grr_vzaj  FLOAT NULL,
    proc_gz   FLOAT NULL,

    elr_zaj1  FLOAT NULL,
    elr_zaj2  FLOAT NULL,

    kota_pro  FLOAT NULL,
    kota_zaj  FLOAT NULL,

    ras_totp  FLOAT NULL,
    ras_totz  FLOAT NULL,

    agol_t    FLOAT NULL,
    stol_ag1  INT NULL,

    br_ras    VARCHAR(20) NULL,

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (id),
    INDEX idx_gapres_project (id_project),
    INDEX idx_gapres_project_stac (id_project, stac_t)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conductors`
--

CREATE TABLE `conductors` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `cross_section` float DEFAULT NULL,
  `diameter` float DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `model` float DEFAULT NULL,
  `temp_exp_coeff` float DEFAULT NULL,
  `allowable_stress_normal` float DEFAULT NULL,
  `allowable_stress_emergency` float DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `conductors`
--

INSERT INTO `conductors` (`id`, `type`, `cross_section`, `diameter`, `mass`, `model`, `temp_exp_coeff`, `allowable_stress_normal`, `allowable_stress_emergency`, `picture`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Al/Fe-16/2.5', 17.85, 5.4, 62, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(2, 'Al/Fe-25/4', 27.8, 6.8, 97, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(3, 'Al/Fe-35/6', 40, 8.1, 140, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(4, 'Al/Fe-50/8', 56.3, 9.6, 196, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(5, 'Al/Fe-70/12', 81.3, 11.7, 284, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(6, 'Al/Fe-95/15', 109.7, 13.6, 383, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(7, 'Al/Fe-120/20', 141.4, 15.5, 494, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(8, 'Al/Fe-150/25', 173.1, 17.1, 605, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(9, 'Al/Fe-185/30', 213.6, 19, 746, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(10, 'Al/Fe-210/35', 243.2, 20.3, 850, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(11, 'Al/Fe-240/40', 282.5, 21.9, 987, 7700, 0.0000189, 13, 24.5, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(12, 'Al/Fe-490/65', 553.9, 30.6, 1879, 7000, 0.0000193, 11, 21, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(13, 'AAAC-324-2Z', 323.97, 21.7, 908, 5600, 0.000023, 10.5, 20, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(14, 'AAA-TW-324Shape', 323.98, 21.7, 893, 6800, 0.000023, 11.8, 21, NULL, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', 1, 1),
(15, 'ACCC-122/28', 150.7, 14.35, 393.3, 6809, 0.00001647, 16.2, 30.4, '', 1, 0, '2025-03-29 15:44:24', '2026-01-05 20:01:57', 1, 1),
(16, '1', 2, 3, 4, 5, 6, 7, 8, '20260105_200511_JV1kuP3n.jpg', 1, 1, '2026-01-05 20:03:16', '2026-01-05 20:37:52', 1, 1),
(17, '1', 2, 3, 4, 5, 0, 6, 7, '20260105_200554_ooI.jpg', 0, 1, '2026-01-05 20:05:54', '2026-01-05 20:38:18', 1, 1),
(18, '1', 2, 3, 4, 5, 2, 66, 77, '', 1, 0, '2026-01-05 20:38:41', '2026-01-24 20:31:55', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user_logged` int NOT NULL,
  `id_module` int NOT NULL,
  `id_record` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `id_user_logged`, `id_module`, `id_record`, `name`, `file`, `type`, `path`, `size`, `comment`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'Test File', '_atest.xlsx', 'xlsx', '\\jenkins-deploy\\jenkins-kubernetes-deployment', '3', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 2, 1, 1, '1 Test File', '1_atest.pdf', 'pdf', '\\jenkins-deploy\\jenkins-kubernetes-deployment', '3', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `endpoints`
--

CREATE TABLE `endpoints` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `endpoints`
--

INSERT INTO `endpoints` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Трафостаница (Портал)', NULL, 1, 0, '2025-03-29 16:58:26', '2025-03-29 16:58:26'),
(2, 'Столб', NULL, 1, 0, '2025-03-29 16:58:28', '2025-03-29 16:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gapres`
--

CREATE TABLE `gapres` (
  `id` bigint UNSIGNED NOT NULL,
  `id_project` int NOT NULL,
  `br_stolb` int DEFAULT NULL,
  `stac_t` float DEFAULT NULL,
  `raspon` float DEFAULT NULL,
  `grr_lpro` float DEFAULT NULL,
  `grr_dpro` float DEFAULT NULL,
  `grr_vpro` float DEFAULT NULL,
  `proc_gv` float DEFAULT NULL,
  `grr_st` float DEFAULT NULL,
  `grr_lprk` float DEFAULT NULL,
  `grr_dprk` float DEFAULT NULL,
  `grr_vprk` float DEFAULT NULL,
  `elr_pro1` float DEFAULT NULL,
  `elr_pro2` float DEFAULT NULL,
  `sre_ras` float DEFAULT NULL,
  `proc_sr` float DEFAULT NULL,
  `s_ra_st` float DEFAULT NULL,
  `grr_lzaj` float DEFAULT NULL,
  `grr_dzaj` float DEFAULT NULL,
  `grr_vzaj` float DEFAULT NULL,
  `proc_gz` float DEFAULT NULL,
  `elr_zaj1` float DEFAULT NULL,
  `elr_zaj2` float DEFAULT NULL,
  `kota_pro` float DEFAULT NULL,
  `kota_zaj` float DEFAULT NULL,
  `ras_totp` float DEFAULT NULL,
  `ras_totz` float DEFAULT NULL,
  `agol_t` float DEFAULT NULL,
  `stol_ag1` int DEFAULT NULL,
  `br_ras` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gapres`
--

INSERT INTO `gapres` (`id`, `id_project`, `br_stolb`, `stac_t`, `raspon`, `grr_lpro`, `grr_dpro`, `grr_vpro`, `proc_gv`, `grr_st`, `grr_lprk`, `grr_dprk`, `grr_vprk`, `elr_pro1`, `elr_pro2`, `sre_ras`, `proc_sr`, `s_ra_st`, `grr_lzaj`, `grr_dzaj`, `grr_vzaj`, `proc_gz`, `elr_zaj1`, `elr_zaj2`, `kota_pro`, `kota_zaj`, `ras_totp`, `ras_totz`, `agol_t`, `stol_ag1`, `br_ras`, `created_at`, `updated_at`) VALUES
(410, 25, 1, 0, 332.56, 0, 332.56, 332.56, NULL, NULL, 0, 332.56, 332.56, NULL, NULL, 166.28, NULL, NULL, 0, 332.56, 332.56, NULL, NULL, NULL, 940.24, 942.34, 0, 0, 0, 60, '1-2', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(411, 25, 2, 332.56, 69.56, 0, 69.56, 69.56, NULL, NULL, 0, 69.56, 69.56, NULL, NULL, 201.06, NULL, NULL, 0, 69.56, 69.56, NULL, NULL, NULL, 969.56, 972.16, 0, 0, 0, 0, '2-3', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(412, 25, 3, 402.12, 114.86, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 92.21, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 973.81, 975.46, 0, 0, 0, 0, '3-4', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(413, 25, 4, 516.98, 124.24, 114.86, 0, 114.86, NULL, NULL, 114.86, 0, 114.86, NULL, NULL, 119.55, NULL, NULL, 114.86, 0, 114.86, NULL, NULL, NULL, 949.7, 952.3, 0, 0, 18, 30, '4-5', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(414, 25, 5, 641.22, 120.08, 124.24, 0, 124.24, NULL, NULL, 124.24, 0, 124.24, NULL, NULL, 122.16, NULL, NULL, 124.24, 0, 124.24, NULL, NULL, NULL, 921.29, 922.94, 0, 0, 0, 0, '5-6', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(415, 25, 6, 761.3, 136.42, 120.08, 0, 120.08, NULL, NULL, 120.08, 0, 120.08, NULL, NULL, 128.25, NULL, NULL, 120.08, 0, 120.08, NULL, NULL, NULL, 915.65, 917.3, 0, 0, 0, 0, '6-7', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(416, 25, 7, 897.72, 222.92, 136.42, 222.92, 359.34, NULL, NULL, 136.42, 222.92, 359.34, NULL, NULL, 179.67, NULL, NULL, 136.42, 222.92, 359.34, NULL, NULL, NULL, 912.02, 913.67, 0, 0, 0, 0, '7-8', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(417, 25, 8, 1120.64, 135.93, 0, 135.93, 135.93, NULL, NULL, 0, 135.93, 135.93, NULL, NULL, 179.425, NULL, NULL, 0, 135.93, 135.93, NULL, NULL, NULL, 915.99, 917.64, 0, 0, 0, 0, '8-9', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(418, 25, 9, 1256.57, 104, 0, 104, 104, NULL, NULL, 0, 104, 104, NULL, NULL, 119.965, NULL, NULL, 0, 104, 104, NULL, NULL, NULL, 932.7, 934.35, 0, 0, 0, 0, '9-10', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(419, 25, 10, 1360.57, 84.32, 0, 84.32, 84.32, NULL, NULL, 0, 84.32, 84.32, NULL, NULL, 94.16, NULL, NULL, 0, 84.32, 84.32, NULL, NULL, NULL, 964.31, 965.96, 0, 0, 0, 0, '10-11', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(420, 25, 11, 1444.89, 114.85, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 99.585, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 973.25, 974.9, 0, 0, 0, 0, '11-12', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(421, 25, 12, 1559.74, 91.31, 114.85, 0, 114.85, NULL, NULL, 114.85, 0, 114.85, NULL, NULL, 103.08, NULL, NULL, 114.85, 0, 114.85, NULL, NULL, NULL, 954.45, 957.05, 0, 0, 11, 30, '12-13', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(422, 25, 13, 1651.05, 103.43, 91.31, 0, 91.31, NULL, NULL, 91.31, 0, 91.31, NULL, NULL, 97.37, NULL, NULL, 91.31, 0, 91.31, NULL, NULL, NULL, 922.32, 923.97, 0, 0, 0, 0, '13-14', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(423, 25, 14, 1754.48, 141.99, 103.43, 0, 103.43, NULL, NULL, 103.43, 0, 103.43, NULL, NULL, 122.71, NULL, NULL, 103.43, 0, 103.43, NULL, NULL, NULL, 876.05, 877.7, 0, 0, 0, 0, '14-15', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(424, 25, 15, 1896.47, 53.21, 141.99, 0, 141.99, NULL, NULL, 141.99, 0, 141.99, NULL, NULL, 97.6, NULL, NULL, 141.99, 0, 141.99, NULL, NULL, NULL, 826.07, 828.67, 0, 0, 40, 60, '15-16', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(425, 25, 16, 1949.68, 183.29, 53.21, 183.29, 236.5, NULL, NULL, 53.21, 183.29, 236.5, NULL, NULL, 118.25, NULL, NULL, 53.21, 183.29, 236.5, NULL, NULL, NULL, 811.37, 813.02, 0, 0, 0, 0, '16-17', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(426, 25, 17, 2132.97, 78.17, 0, 78.17, 78.17, NULL, NULL, 0, 78.17, 78.17, NULL, NULL, 130.73, NULL, NULL, 0, 78.17, 78.17, NULL, NULL, NULL, 814.63, 816.28, 0, 0, 0, 0, '17-18', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(427, 25, 18, 2211.14, 41.59, 0, 41.59, 41.59, NULL, NULL, 0, 41.59, 41.59, NULL, NULL, 59.88, NULL, NULL, 0, 41.59, 41.59, NULL, NULL, NULL, 818.97, 821.57, 0, 0, 54, 60, '18-19', '2026-01-29 22:40:38', '2026-01-29 22:40:38'),
(428, 25, 19, 2252.73, NULL, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, 20.795, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 823.78, 826.63, NULL, NULL, 0, 0, '19-20', '2026-01-29 22:40:38', '2026-01-29 22:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `ground_wires`
--

CREATE TABLE `ground_wires` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `cross_section` float DEFAULT NULL,
  `diameter` float DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `model` float DEFAULT NULL,
  `temp_exp_coeff` float DEFAULT NULL,
  `allowable_stress_normal` float DEFAULT NULL,
  `allowable_stress_emergency` float DEFAULT NULL,
  `picture` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ground_wires`
--

INSERT INTO `ground_wires` (`id`, `type`, `cross_section`, `diameter`, `mass`, `model`, `temp_exp_coeff`, `allowable_stress_normal`, `allowable_stress_emergency`, `picture`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Fe-I-35/7', 34.36, 7.5, 272, 17500, 0.000011, 14.5, 26.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(2, 'Fe-I-50/7', 49.48, 9, 391, 17500, 0.000011, 14.5, 26.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(3, 'Fe-I-50/19', 48.36, 9, 384, 17500, 0.000011, 14.5, 26.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(4, 'Fe-I-70/19', 65.82, 10.5, 523, 17500, 0.000011, 14.5, 26.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(5, 'Fe-I-95/19', 93.27, 12.5, 741, 17500, 0.000011, 14.5, 26.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(6, 'Fe-II-35/7', 34.36, 7.5, 272, 17500, 0.000011, 26, 49, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(7, 'Fe-II-50/7', 49.48, 9, 391, 17500, 0.000011, 26, 49, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(8, 'Fe-II-50/19', 48.36, 9, 384, 17500, 0.000011, 26, 49, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(9, 'Fe-II-70/19', 65.82, 10.5, 523, 17500, 0.000011, 26, 49, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(10, 'Fe-II-95/19', 93.27, 12.5, 741, 17500, 0.000011, 26, 49, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(11, 'Fe-III-35/7', 34.36, 7.5, 272, 17500, 0.000011, 49.5, 93, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(12, 'Fe-III-50/7', 49.48, 9, 391, 17500, 0.000011, 49.5, 93, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(13, 'Fe-III-50/19', 48.36, 9, 384, 17500, 0.000011, 49.5, 93, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(14, 'Fe-III-70/19', 65.82, 10.5, 523, 17500, 0.000011, 49.5, 93, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(15, 'Fe-III-95/19', 93.27, 12.5, 741, 17500, 0.000011, 49.5, 93, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(16, 'AWG-19/9', 126.1, 14.5, 842, 16200, 0.000013, 49, 92.5, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(17, 'OPW-AAL/ACS93/5', 151.04, 16.4, 665, 10066, 0.0000168, 28.1, 48.2, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(18, 'AA/ACS-119.1-24', 119.1, 14.55, 494, 9440, 0.0000178, 23.6, 41.4, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(19, 'ACS-42-3,5', 42.4, 9, 312, 16200, 0.0000162, 51, 87.7, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(20, 'ASLH-D-48(50-4)', 49.5, 10, 377, 16200, 0.000013, 54.6, 93.7, '', 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', 1, 1),
(24, '2', 2, 2, 2, 2, 2, 2, 2, '20260105_213211_cxt.jpg', 1, 0, '2026-01-05 21:32:11', '2026-01-24 20:36:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Администратори', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'Полуадминистратори', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `groups_modules`
--

CREATE TABLE `groups_modules` (
  `id` int UNSIGNED NOT NULL,
  `group_id` int DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups_modules`
--

INSERT INTO `groups_modules` (`id`, `group_id`, `module_id`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 1, 2, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 1, 3, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, 1, 4, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, 1, 5, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(6, 1, 6, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(7, 1, 7, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(8, 1, 8, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(9, 1, 9, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(10, 2, 6, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

CREATE TABLE `groups_users` (
  `id` int UNSIGNED NOT NULL,
  `group_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insulators`
--

CREATE TABLE `insulators` (
  `id` int UNSIGNED NOT NULL,
  `sifra` varchar(20) DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `voltage` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `massd` float DEFAULT NULL,
  `id_insulator_chain` int NOT NULL,
  `support_insulator` int NOT NULL DEFAULT '0',
  `insulator_material` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number` int DEFAULT NULL,
  `breaking_load` float DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insulators`
--

INSERT INTO `insulators` (`id`, `sifra`, `type`, `voltage`, `length`, `mass`, `massd`, `id_insulator_chain`, `support_insulator`, `insulator_material`, `number`, `breaking_load`, `picture`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, '4201', 'EN', 35, 0.66, 17.02, 19.57, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(3, '4202', 'ENP', 35, 0.81, 21.22, 24.4, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(4, '4203', 'DN', 35, 0.96, 40.2, 46.23, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(5, '4204', 'DNP', 35, 1.1, 48.6, 55.89, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(6, '4205', 'ENa', 35, 0.67, 22.74, 26.15, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(7, '4206', 'ENPa', 35, 0.92, 28.8, 33.12, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(8, '4207', 'DNa', 35, 0.98, 55.35, 63.65, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(9, '4208', 'DNPa', 35, 1.13, 67.74, 77.9, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(10, '4209', 'ENza', 35, 0.84, 23.76, 27.32, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(11, '4210', 'ENPza', 35, 0.94, 24.94, 28.68, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(12, '4211', 'DNza', 35, 0.99, 55.35, 63.65, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(13, '4212', 'DNPza', 35, 1.1, 53.3, 61.3, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(14, '4213', 'EZ', 35, 0.8, 21.15, 25.38, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(15, '4214', 'EZP', 35, 0.95, 27.35, 32.82, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(16, '4215', 'DZ', 35, 1.05, 50.57, 60.68, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(17, '4216', 'DZP', 35, 1.2, 62.97, 75.56, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(18, '4217', 'EZa', 35, 0.85, 20.8, 24.96, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(19, '4218', 'EZPa', 35, 1, 28.46, 34.15, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(20, '4219', 'DZa', 35, 1.05, 45.89, 55.07, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(21, '4220', 'DZPa', 35, 1.2, 61.09, 73.31, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(22, '4221', 'EZza', 35, 0.9, 22.94, 27.53, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(23, '4222', 'EZPza', 35, 1.05, 29.4, 35.28, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(24, '4223', 'DZza', 35, 1.05, 40.08, 48.1, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(25, '4224', 'DZPza', 35, 1.2, 65.1, 78.12, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(26, '4225', 'EZs', 35, 0.8, 22.07, 26.48, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(27, '4226', 'EZPs', 35, 1.05, 28.3, 33.96, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(28, '4227', 'DZs', 35, 1.05, 45.84, 55.01, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(29, '4228', 'DZPs', 35, 1.2, 61.04, 73.25, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(30, '4229', 'EZa,s', 35, 0.85, 21.68, 26.02, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(31, '4230', 'EZPa,s', 35, 1, 29.34, 35.21, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(32, '4231', 'DZa,s', 35, 1.05, 47, 56.4, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(33, '4232', 'DZPa,s', 35, 1.2, 62.19, 74.63, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(34, '4233', 'EZza,s', 35, 0.9, 22.94, 26.381, 1, 0, 'STAK', 3, 120, '20251212_103145_11OzIbw0.png', 1, 0, '2025-11-28 13:25:53', '2025-12-12 10:31:45', 1, 1),
(35, '4234', 'EZPza,s', 35, 1.05, 30.54, 36.65, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(36, '4235', 'DZza,s', 35, 1.05, 48.53, 58.24, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(37, '4236', 'DZPza,s', 35, 1.2, 63.73, 76.48, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(38, '5101', 'ENm', 110, 1.73, 35, 42, 2, 0, 'PORC', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(39, '5102', 'ENPm', 110, 1.73, 38, 45, 2, 0, 'PORC', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(40, '5103', 'DNm', 110, 2, 73.6, 89, 2, 0, 'PORC', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(41, '5104', 'DNPm', 110, 2, 79.6, 96, 2, 0, 'PORC', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(42, '5105', 'EZm', 110, 1.65, 35, 42, 2, 0, 'PORC', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(43, '5106', 'EZPm', 110, 1.65, 38, 45, 2, 0, 'PORC', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(44, '5107', 'DZm', 110, 1.9, 73, 88, 2, 0, 'PORC', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(45, '5108', 'DZPm', 110, 1.9, 79, 95, 2, 0, 'PORC', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(46, '5109', 'EZs', 110, 1.54, 57.8, 17.6, 2, 0, 'PORC', 7, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(47, '5110', 'EZPs', 110, 1.71, 63.9, 17.6, 2, 0, 'PORC', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(48, '5111', 'DZs', 110, 1.64, 105.3, 17.6, 2, 0, 'PORC', 14, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(49, '5112', 'DZPs', 110, 1.8, 117.5, 17.6, 2, 0, 'PORC', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(50, '5113', 'EZri', 110, 1.54, 53.2, 17.6, 2, 0, 'PORC', 7, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(51, '5114', 'DZri', 110, 1.64, 106.5, 17.6, 2, 0, 'PORC', 14, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(52, '5115', 'EZPri', 110, 1.7, 59.3, 17.6, 2, 0, 'PORC', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(53, '5116', 'DZPri', 110, 1.8, 118.7, 17.6, 2, 0, 'PORC', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(54, '5201', 'EN', 110, 1.35, 42.22, 48.55, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(55, '5202', 'ENP', 110, 1.5, 40.42, 46.48, 1, 0, 'STAK', 9, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(56, '5203', 'DN', 110, 1.46, 87.11, 100.18, 1, 0, 'STAK', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(57, '5204', 'DNP', 110, 1.61, 94.71, 108.92, 1, 0, 'STAK', 18, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(58, '5205', 'EZ', 110, 1.5, 43.68, 52.42, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(59, '5206', 'EZP', 110, 1.65, 47.48, 56.98, 1, 0, 'STAK', 9, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(60, '5207', 'DZ', 110, 1.6, 84.26, 101.12, 1, 0, 'STAK', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(61, '5208', 'DZP', 110, 1.75, 91.86, 110.23, 1, 0, 'STAK', 18, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(62, '5209', 'EZs', 110, 1.5, 42.12, 50.55, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(63, '5210', 'EZPs', 110, 1.65, 45.92, 55.1, 1, 0, 'STAK', 9, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(64, '5211', 'DZs', 110, 1.6, 84.26, 101.12, 1, 0, 'STAK', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(65, '5212', 'DZPs', 110, 1.75, 91.86, 110.23, 1, 0, 'STAK', 18, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(66, '5213', 'EZri', 110, 1.5, 61.04, 73.25, 1, 0, 'STAK', 8, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(67, '5214', 'DZri', 110, 1.6, 106.62, 127.95, 1, 0, 'STAK', 16, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(68, '5215', 'EZPri', 110, 1.65, 69.84, 83.81, 1, 0, 'STAK', 9, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(69, '5216', 'DZPri', 110, 1.75, 114.22, 137.06, 1, 0, 'STAK', 18, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(70, '2201', 'EN', 10, 0.4, 9.3, 10.695, 1, 0, 'STAK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2026-01-24 22:05:37', 1, 1),
(71, '2202', 'ENP', 10, 0.55, 15.5, 17.83, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(72, '2203', 'DN', 10, 0.7, 26, 29.9, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(73, '2204', 'DNP', 10, 0.85, 38.4, 44.16, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(74, '2205', 'EZ', 10, 0.5, 8.75, 10.5, 1, 0, 'STAK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(75, '2206', 'EZP', 10, 0.65, 15, 18, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(76, '2207', 'EZs', 10, 0.55, 9.7, 11.64, 1, 0, 'STAK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(77, '2208', 'EZPs', 10, 0.7, 16, 19.2, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(78, '2209', 'EZPza', 10, 0.7, 17.1, 20.52, 1, 0, 'STAK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(79, '2210', 'EZPs,za', 10, 0.7, 18.1, 21.72, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(80, '2211', 'DZ', 10, 0.75, 25.8, 30.96, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(81, '2212', 'DZP', 10, 0.9, 38.5, 46.2, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(82, '2213', 'DZPza', 10, 0.9, 40.5, 48.6, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(83, '2214', 'DZs,za', 10, 0.9, 25.8, 30.96, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(84, '2215', 'DZPs,za', 10, 0.9, 41, 49.2, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(85, '3201', 'EN', 20, 0.55, 15.5, 17.825, 1, 0, 'STAK', 2, 120, '20251212_103629_dggDdhyK.png', 1, 0, '2025-11-28 13:25:53', '2025-12-12 10:36:29', 1, 1),
(86, '3202', 'ENP', 20, 0.7, 21.7, 24.96, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(87, '3203', 'DN', 20, 0.85, 38.5, 44.28, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(88, '3204', 'DNP', 20, 1, 50.8, 58.42, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(89, '3205', 'EZ', 20, 0.65, 15, 18, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(90, '3206', 'EZP', 20, 0.8, 21.5, 25.8, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(91, '3207', 'EZs', 20, 0.7, 22.5, 27, 1, 0, 'STAK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(92, '3208', 'EZPs', 20, 0.85, 29, 34.8, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(93, '3209', 'EZPza', 20, 0.85, 23.5, 28.2, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(94, '3210', 'EZPs,za', 20, 0.85, 24.5, 29.4, 1, 0, 'STAK', 3, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(95, '3211', 'DZ', 20, 0.9, 38.5, 46.2, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(96, '3212', 'DZP', 20, 1.05, 50.6, 60.72, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(97, '3213', 'DZPza', 20, 1.05, 52.7, 63.24, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(98, '3214', 'DZs,za', 20, 0.9, 38.5, 46.2, 1, 0, 'STAK', 4, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(99, '3215', 'DZPs,za', 20, 1.05, 53.5, 64.2, 1, 0, 'STAK', 6, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(100, '2303', 'EZ- D-135', 10, 0.2, 5, 5.75, 2, 1, '', 1, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-29 19:31:17', 1, 1),
(101, '2304', 'DZ- D-135', 10, 0.2, 10, 11.5, 2, 1, 'POTP', 2, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(102, '3303', 'EZ- D-175', 20, 0.25, 9, 10.35, 2, 1, 'POTP', 1, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(103, '3304', 'DZ- D-175', 20, 0.25, 18, 20.7, 2, 1, 'POTP', 2, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(104, '2301', 'EN- D-135', 10, 0.2, 5, 5.75, 2, 1, 'POTP', 1, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(105, '2302', 'DN- D-135', 10, 0.2, 10, 11.5, 2, 1, 'POTP', 2, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(106, '3301', 'EN- D-175', 20, 0.25, 9, 10.35, 2, 1, 'POTP', 1, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(107, '3302', 'DN- D-175', 20, 0.25, 18, 20.7, 2, 1, 'POTP', 2, 1.25, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(108, '3401', 'EN', 20, 0.6, 4, 4.6, 3, 0, 'SILK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(109, '3402', 'DN', 20, 0.9, 13, 14.95, 3, 0, 'SILK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(110, '3403', 'ENpot', 20, 0.3, 2.5, 2.88, 3, 1, 'SILK', 1, 80, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(111, '3404', 'DNpot', 20, 0.3, 5, 5.75, 3, 1, 'SILK', 2, 80, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(112, '4401', 'EN', 35, 0.7, 10, 11.5, 3, 0, 'SILK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(113, '4402', 'DN', 35, 0.8, 20, 23, 3, 0, 'SILK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(114, '4403', 'ENpot', 35, 0.5, 10, 11.5, 3, 0, 'SILK', 1, 80, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(115, '4404', 'DNpot', 35, 0.5, 20, 23, 3, 0, 'SILK', 2, 80, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(116, '3405', 'EZ', 20, 0.7, 3.4, 4.08, 3, 0, 'SILK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(117, '3406', 'DZ', 20, 0.8, 11.8, 14.16, 3, 0, 'SILK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(118, '4405', 'EZ', 35, 0.8, 10, 12, 3, 0, 'SILK', 1, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(119, '4406', 'DZ', 35, 0.95, 20, 24, 3, 0, 'SILK', 2, 120, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(120, '7201', 'EN', 400, 3.58, 163.8, 196.6, 1, 0, 'STAK', 20, 160, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(121, '7202', 'ENP', 400, 3.72, 170, 204, 1, 0, 'STAK', 21, 160, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(122, '7203', 'DN', 400, 3.94, 315.95, 379.2, 1, 0, 'STAK', 40, 320, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(123, '7204', 'DNP', 400, 4.09, 328.33, 394, 1, 0, 'STAK', 42, 320, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(124, '7211', 'DZ', 400, 4.1, 310.7, 388.4, 1, 0, 'STAK', 40, 320, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(125, '7212', 'DZP', 400, 4.25, 323.1, 483.9, 1, 0, 'STAK', 42, 320, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(127, '7212', 'DZP', 400, 4.25, 323.1, 483.9, 1, 0, 'STAK', 42, 320, '', 1, 0, '2025-11-28 13:25:53', '2025-11-28 13:25:53', 1, 1),
(132, '123', 'uuu', 35, 1, 3, 3.45, 3, 1, 'SILK', 1, 1.25, '20251210_082529_KfvvM4I6.jpg', 1, 0, '2025-12-10 07:05:34', '2026-01-24 22:05:58', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `insulator_chain`
--

CREATE TABLE `insulator_chain` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insulator_chain`
--

INSERT INTO `insulator_chain` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Стакло', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(2, 'Порцелан', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(3, 'Композит', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs_email`
--

CREATE TABLE `logs_email` (
  `id` int UNSIGNED NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_email_type` int DEFAULT NULL,
  `email_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs_email`
--

INSERT INTO `logs_email` (`id`, `id_user`, `id_email_type`, `email_type`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'SUCCESS RESET EXPIRED PASSWORD', 'password', '2025-03-29 05:44:21', '2025-03-29 05:44:21'),
(2, 3, 5, 'SUCCESS FIRS LOGIN PASSWORD', 'verana01', '2025-03-31 12:48:01', '2025-03-31 12:48:01'),
(3, 3, 4, 'SUCCESS RESET EXPIRED PASSWORD', 'verana1601', '2025-07-02 09:00:11', '2025-07-02 09:00:11'),
(4, 1, 4, 'SUCCESS RESET EXPIRED PASSWORD', 'password', '2025-10-02 15:46:03', '2025-10-02 15:46:03'),
(5, 1, 4, 'SUCCESS RESET EXPIRED PASSWORD', 'password', '2026-01-05 17:34:31', '2026-01-05 17:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_07_192313_create_users_table', 1),
(5, '2024_10_07_200409_create_passwords_table', 1),
(6, '2024_10_07_202221_create__expiration_time_table', 1),
(7, '2024_10_07_205713_create_logs_email_table', 1),
(8, '2024_10_08_055943_create__email_type_table', 1),
(9, '2024_10_08_060431_create__countries_table', 1),
(10, '2024_10_31_094915_create__languages_table', 1),
(11, '2024_11_02_171624_create_modules_table', 1),
(12, '2024_11_02_201016_create__modules_type_table', 1),
(13, '2024_11_02_201252_create__modules_design_table', 1),
(14, '2024_11_02_204501_create_modules_users_table', 1),
(15, '2024_11_02_220203_create_groups_table', 1),
(16, '2024_11_03_081212_create_groups_users_table', 1),
(17, '2024_11_03_083722_create_groups_modules_table', 1),
(18, '2024_11_10_214549_create__documents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int UNSIGNED NOT NULL,
  `id_parent` int DEFAULT NULL,
  `id_language` int DEFAULT NULL,
  `id_modules_type` int DEFAULT '0',
  `id_design_type` int DEFAULT '0',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `id_parent`, `id_language`, `id_modules_type`, `id_design_type`, `title`, `slug`, `description`, `link`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 1, 'Корисник', 'korisnik', '', '1/user/edit', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, NULL, 1, 1, 2, 'Корисници', 'korisnici', '', '2/users', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, NULL, 1, 1, 1, 'Модули', 'moduli', '3/modules', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, NULL, 1, 1, 1, 'Групи', 'grupi', '', '4/groups', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, NULL, 1, 1, 1, 'Јазици', 'jazici', '', '5/languages', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(6, NULL, 1, 1, 1, 'Тест', 'test', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(7, 6, 1, 1, 7, 'Тест 1', 'test1', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(8, 6, 1, 1, 3, 'Тест 2', 'test2', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(9, 8, 1, 1, 7, 'Тест 3', 'test3', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(10, NULL, 1, 2, 1, 'Авторизација', 'avtorizacija', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(11, NULL, 1, 1, 3, 'Проекти', 'proekti', '', '11/projects', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(12, NULL, 1, 1, 1, 'Елементи на ДВ', 'elementi_na_dv', '', '', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(13, 12, 1, 1, 6, 'Столбови', 'stolbovi', '', '13/towers', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(14, 12, 1, 1, 6, 'Изолатори', 'izolatori', '', '14/insulators', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(15, 12, 1, 1, 6, 'Проводници', 'provodnici', '', '15/conductors', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(16, 12, 1, 1, 6, 'Заштитни јажиња', 'zashtitni_jazjinja', '', '16/groundwires', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `modules_users`
--

CREATE TABLE `modules_users` (
  `id` int UNSIGNED NOT NULL,
  `module_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules_users`
--

INSERT INTO `modules_users` (`id`, `module_id`, `user_id`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(261, 1, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(262, 2, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(263, 11, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(264, 12, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(265, 13, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(266, 14, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(267, 15, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(268, 16, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(269, 17, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(270, 18, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(271, 19, 2, 1, 0, '2025-03-30 15:46:20', '2025-03-30 15:46:20'),
(272, 2, 1, 1, 0, '2025-03-30 16:10:43', '2025-03-30 16:10:43'),
(273, 11, 1, 1, 0, '2025-03-30 16:10:43', '2025-03-30 16:10:43'),
(274, 2, 3, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(275, 11, 3, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(276, 12, 1, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(277, 13, 1, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(278, 14, 1, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(279, 15, 1, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11'),
(280, 16, 1, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int UNSIGNED NOT NULL,
  `id_user` int DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `id_user`, `password`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$12$XotPrJviPOjf0Tqwy4UPJeNZ1WbmZjN9NKzkTUi7fmHP8q/9IZ3Dm', 1, 0, '2024-12-01 18:26:02', '2024-12-01 18:26:02'),
(2, 2, '$2y$12$IGUQ5.ihN8.1B2sHc94ySOU.bTiOQHyOa54.J1rcpgd8jz6B.O45.', 1, 0, '2024-12-02 18:26:02', '2024-12-01 18:26:02'),
(3, 1, '$2y$12$Y7PyKygkZjC600Jo60CpCOQAxllcwtz7LuHvgJDL9xlR5dGZXmUjy', 1, 0, '2025-03-29 05:44:18', '2025-03-29 05:44:18'),
(4, 3, '$2y$12$SmE7PbqlZ4NhgpGtQQC9AuObv4MN1vJBAYAco9/acdb6/uRo/qYQu', 1, 0, '2025-03-31 12:48:01', '2025-03-31 12:48:01'),
(5, 3, '$2y$12$kNhXMF.z1uG.dj9UXnxqxuedTiRrOhS8cJ61RkOypk20MYl9MZOYW', 1, 0, '2025-07-02 09:00:11', '2025-07-02 09:00:11'),
(6, 1, '$2y$12$JUkOXNcYuBfs0tb8ynUK9.3izm8mm/psKGPL46I8g5Y9/M/zAMPgS', 1, 0, '2025-10-02 15:46:02', '2025-10-02 15:46:02'),
(7, 1, '$2y$12$lkB72YSF5XVj7OoVAxsHAulR3yitTd.9NQTKc/7qP2i9V1LF2YqJq', 1, 0, '2026-01-05 17:34:30', '2026-01-05 17:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_voltage` int DEFAULT NULL,
  `id_conductor` int DEFAULT NULL,
  `id_ground_wires` int DEFAULT NULL,
  `id_ground_wires2` int DEFAULT NULL,
  `id_starting_point` int DEFAULT NULL,
  `id_ending_point` int DEFAULT NULL,
  `tensile_stress_cond` float DEFAULT NULL,
  `tensile_stress_ground` float DEFAULT NULL,
  `tensile_stress_ground2` float DEFAULT NULL,
  `kn` float DEFAULT NULL,
  `ki` float DEFAULT NULL,
  `id_wind_pressure` int DEFAULT NULL,
  `id_insulator_chain` int DEFAULT NULL,
  `approx_field_length` int DEFAULT NULL,
  `approx_number_towers` int DEFAULT NULL,
  `var_v` int DEFAULT NULL,
  `num_cond_systems` int DEFAULT NULL,
  `num_cond_bundle` int DEFAULT NULL,
  `num_ground_wires` int DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `id_voltage`, `id_conductor`, `id_ground_wires`, `id_ground_wires2`, `id_starting_point`, `id_ending_point`, `tensile_stress_cond`, `tensile_stress_ground`, `tensile_stress_ground2`, `kn`, `ki`, `id_wind_pressure`, `id_insulator_chain`, `approx_field_length`, `approx_number_towers`, `var_v`, `num_cond_systems`, `num_cond_bundle`, `num_ground_wires`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'DV 2x110 kV Dimonceq', 2, 1, 17, NULL, 1, 2, 12, 32, NULL, 1.6, 2, 2, 2, 100, 10, NULL, 2, 1, 1, 1, 0, '2025-03-30 09:24:30', '2025-03-30 14:10:24', 1, 1),
(2, 'DV 2x110 kV Dimonce', 1, 12, 5, NULL, 2, 1, 2.9, 31.3, NULL, 1, 2.9, 5, 1, 100, 10, NULL, 2, 1, 2, 0, 0, '2025-03-30 09:24:32', '2025-03-30 16:43:44', 1, 1),
(10, 'DV 2x110 kV Dimonce', 2, 1, 1, 0, 1, 2, 56, 54, 0, 4, 4, 1, 1, NULL, NULL, NULL, 1, 1, 2, 1, 0, '2025-11-03 04:10:20', '2025-12-08 17:14:06', 1, 1),
(11, 'DV 2x110 kV Dimonce', 1, 1, 1, 0, 2, 1, 76, 76, 0, 6, 6, 1, 1, NULL, NULL, NULL, 1, 1, 1, 1, 0, '2025-11-03 04:14:30', '2025-12-08 13:02:39', 1, 1),
(12, 'test', 2, 2, 1, 0, 1, 2, 4, 4, 0, 4, 4, 1, 1, NULL, NULL, NULL, 1, 1, 1, 1, 0, '2025-11-03 07:58:39', '2025-12-08 17:14:57', 1, 1),
(13, 'test stolb', 2, 1, 1, 0, 2, 2, 5, 5, 0, 5, 5, 1, 1, NULL, NULL, NULL, 1, 1, 1, 1, 0, '2025-11-03 07:59:42', '2025-12-08 20:29:15', 1, 1),
(14, 'gdfgdf', 1, 15, 2, 5, 1, 2, 65.65, 655.87, 8, 3.76, 2.76, 1, 2, NULL, NULL, NULL, 2, 2, 2, 1, 0, '2025-11-03 14:13:10', '2025-11-10 05:51:43', 1, 1),
(15, 'Тестен Далвод 220кв', 5, 3, 1, 4, 1, 2, 5, 5, 5, 4, 4, 1, 1, NULL, NULL, NULL, 1, 4, 2, 1, 0, '2025-11-10 12:20:46', '2025-12-11 14:08:01', 1, 1),
(19, 'Тестен далекувод 20', 2, 1, 4, 0, 1, 2, 7, 7, 0, 4, 4, 3, 1, NULL, NULL, NULL, 1, 2, 1, 1, 0, '2025-12-12 10:34:47', '2025-12-12 10:34:47', 1, 1),
(20, 'Тестен далновод 20kV', 2, 11, 2, 0, 1, 2, 8, 22, 0, 1.6, 2, 2, 3, NULL, NULL, NULL, 1, 2, 1, 1, 0, '2025-12-12 14:03:41', '2025-12-12 14:03:41', 1, 1),
(21, 'hgfhfdg', 2, 1, 2, 0, 1, 2, 5, 5, 0, 4, 4, 3, 1, NULL, NULL, NULL, 2, 1, 1, 1, 0, '2025-12-16 15:55:15', '2025-12-16 15:55:15', 1, 1),
(22, 'hgfhfdg', 2, 1, 2, 0, 1, 2, 5, 5, 0, 4, 4, 3, 1, NULL, NULL, NULL, 2, 1, 1, 1, 0, '2025-12-16 15:58:39', '2025-12-16 15:58:39', 1, 1),
(23, 'bcvbc', 2, 2, 3, 0, 1, 2, 45, 4, 0, 4, 4, 2, 1, NULL, NULL, NULL, 1, 2, 1, 1, 0, '2025-12-16 16:07:21', '2025-12-16 16:07:21', 1, 1),
(24, 'Test', 2, 4, 1, 0, 1, 2, 55, 5, 0, 4, 4, 2, 1, NULL, NULL, NULL, 1, 1, 1, 1, 0, '2025-12-16 19:16:19', '2025-12-16 19:16:19', 1, 1),
(25, 'Надземен вод 10(20)kV с.Јабланица –с.Безево', 2, 4, 1, 0, 2, 2, 8, 8, 0, 1, 2, 4, 1, NULL, NULL, NULL, 1, 1, 1, 1, 0, '2026-01-20 18:56:40', '2026-01-24 12:46:14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `raspres`
--

CREATE TABLE `raspres` (
  `id` int UNSIGNED NOT NULL,
  `id_project` int NOT NULL,
  `stac_t` float DEFAULT NULL,
  `kota_t` float DEFAULT NULL,
  `raspon` float DEFAULT NULL,
  `vr_pro` float DEFAULT NULL,
  `vr_zaj` float DEFAULT NULL,
  `kota_pro` float DEFAULT NULL,
  `kota_zaj` float DEFAULT NULL,
  `ras_totp` float DEFAULT NULL,
  `ras_t2op` float DEFAULT NULL,
  `ras_totz` float DEFAULT NULL,
  `ras_t2oz` float DEFAULT NULL,
  `dol_pro` float DEFAULT NULL,
  `dol_zaj` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `raspres`
--

INSERT INTO `raspres` (`id`, `id_project`, `stac_t`, `kota_t`, `raspon`, `vr_pro`, `vr_zaj`, `kota_pro`, `kota_zaj`, `ras_totp`, `ras_t2op`, `ras_totz`, `ras_t2oz`, `dol_pro`, `dol_zaj`, `created_at`, `updated_at`) VALUES
(77, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(78, 14, 0, 0, 0, 10.5, 10.5, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(79, 14, 0, 0, 0, -10.5, -10.5, 10.5, 10.5, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(80, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(81, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(82, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(83, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(84, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(85, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(86, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(87, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(88, 14, 0, 0, 4, 14.5, 14.5, 0, 0, NULL, NULL, NULL, NULL, 4, 4, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(89, 14, 4, 4, 1, 1, 1, 14.5, 14.5, NULL, NULL, NULL, NULL, 1, 1, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(90, 14, 5, 5, 38, 38, 38, 15.5, 15.5, NULL, NULL, NULL, NULL, 38, 38, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(91, 14, 43, 43, 357, 11.35, 11.35, 53.5, 53.5, NULL, NULL, NULL, NULL, 357.003, 357, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(380, 13, 0, 311.5, 0, -293.05, -283.5, 311.5, 311.5, NULL, NULL, NULL, NULL, 0, 0, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(381, 13, 0, 0, 0.5, 46.55, 37, 18.45, 28, NULL, NULL, NULL, NULL, 0.5, 0.5, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(382, 13, 0.5, 65, 0, 10.45, 20.5, 65, 65, NULL, NULL, NULL, NULL, 0, 0, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(383, 13, 0.5, 65, 0.1, 256.07, 246.02, 75.45, 85.5, NULL, NULL, NULL, NULL, 0.1, 0.1, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(384, 13, 0.6, 331.52, 1.4, -289.52, -280.52, 331.52, 331.52, NULL, NULL, NULL, NULL, 1.4, 1.4, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(385, 13, 2, 32, 1, -29.6, -34.8, 42, 51, NULL, NULL, NULL, NULL, 1, 1, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(386, 13, 3, 3, 0, 0, 0, 12.4, 16.2, NULL, NULL, NULL, NULL, 0, 0, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(387, 13, 3, 3, 2.7, 3.85, 0.05, 12.4, 16.2, NULL, NULL, NULL, NULL, 2.7, 2.7, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(388, 13, 5.7, 16.25, 1.95, 8.85, 8.85, 16.25, 16.25, NULL, NULL, NULL, NULL, 1.95, 1.95, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(389, 13, 7.65, 25.1, 14.35, 88.75, 88.75, 25.1, 25.1, NULL, NULL, NULL, NULL, 14.3501, 14.3503, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(390, 13, 22, 113.85, 0.26, 1.62, 1.62, 113.85, 113.85, NULL, NULL, NULL, NULL, 0.26, 0.26, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(391, 13, 22.26, 115.47, 0.4, 4.01, 4.01, 115.47, 115.47, NULL, NULL, NULL, NULL, 0.4, 0.4, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(392, 13, 22.66, 119.48, 1.84, 20.22, 20.22, 119.48, 119.48, NULL, NULL, NULL, NULL, 1.84, 1.84, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(393, 13, 24.5, 139.7, 0.96, -44.9, -44.9, 139.7, 139.7, NULL, NULL, NULL, NULL, 0.96, 0.96, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(394, 13, 25.46, 94.8, 0.27, 55.66, 55.66, 94.8, 94.8, NULL, NULL, NULL, NULL, 0.27, 0.27, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(395, 13, 25.73, 150.46, 1.17, -59.96, -59.96, 150.46, 150.46, NULL, NULL, NULL, NULL, 1.17, 1.17, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(396, 13, 26.9, 90.5, 1.54, 72.68, 72.68, 90.5, 90.5, NULL, NULL, NULL, NULL, 1.54, 1.54, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(397, 13, 28.44, 163.18, 1.8, 15.52, 15.52, 163.18, 163.18, NULL, NULL, NULL, NULL, 1.8, 1.8, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(398, 13, 30.24, 178.7, 1.41, 18.4, 18.4, 178.7, 178.7, NULL, NULL, NULL, NULL, 1.41, 1.41, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(399, 13, 31.65, 197.1, 7.6, 34.62, 34.62, 197.1, 197.1, NULL, NULL, NULL, NULL, 7.60001, 7.60005, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(400, 13, 39.25, 231.72, 2.16, 25.98, 25.98, 231.72, 231.72, NULL, NULL, NULL, NULL, 2.16, 2.16, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(401, 13, 41.41, 257.7, 1.37, 10.86, 10.86, 257.7, 257.7, NULL, NULL, NULL, NULL, 1.37, 1.37, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(402, 13, 42.78, 268.56, 2.94, 12.94, 12.94, 268.56, 268.56, NULL, NULL, NULL, NULL, 2.94, 2.94, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(403, 13, 45.72, 281.5, 0.7, 3.86, 3.86, 281.5, 281.5, NULL, NULL, NULL, NULL, 0.7, 0.7, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(404, 13, 46.42, 285.36, 1.05, 7.44, 7.44, 285.36, 285.36, NULL, NULL, NULL, NULL, 1.05, 1.05, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(405, 13, 47.47, 292.8, 252.53, -287.5, -287.8, 292.8, 292.8, NULL, NULL, NULL, NULL, 252.854, 254.215, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(406, 13, 300, 5, 150.53, -5.3, -5, 5.3, 5, NULL, NULL, NULL, NULL, 150.599, 150.887, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(699, 19, 0, 2.34, 0, 2.74, 2.19, 1.79, 2.34, NULL, NULL, NULL, NULL, 0, 0, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(700, 19, 0, 4.53, 16.25, 1.17, 1.17, 4.53, 4.53, NULL, NULL, NULL, NULL, 16.25, 16.2502, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(701, 19, 16.25, 5.7, 8.85, 12.38, 16.18, 5.7, 5.7, NULL, NULL, NULL, NULL, 8.85001, 8.85004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(702, 19, 25.1, 7.65, 65.4, 8.82, 5.02, 18.08, 21.88, NULL, NULL, NULL, NULL, 65.4029, 65.415, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(703, 19, 90.5, 26.9, 4.3, -1.44, -1.44, 26.9, 26.9, NULL, NULL, NULL, NULL, 4.3, 4.3, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(704, 19, 94.8, 25.46, 19.05, -3.46, -3.46, 25.46, 25.46, NULL, NULL, NULL, NULL, 19.0501, 19.0504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(705, 19, 113.85, 22, 1.62, 0.26, 0.26, 22, 22, NULL, NULL, NULL, NULL, 1.62, 1.62, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(706, 19, 115.47, 22.26, 4.01, 0.4, 0.4, 22.26, 22.26, NULL, NULL, NULL, NULL, 4.01, 4.01, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(707, 19, 119.48, 22.66, 20.22, 1.84, 1.84, 22.66, 22.66, NULL, NULL, NULL, NULL, 20.2201, 20.2204, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(708, 19, 139.7, 24.5, 10.76, 1.23, 1.23, 24.5, 24.5, NULL, NULL, NULL, NULL, 10.76, 10.7601, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(709, 19, 150.46, 25.73, 12.72, 2.71, 2.71, 25.73, 25.73, NULL, NULL, NULL, NULL, 12.72, 12.7201, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(710, 19, 163.18, 28.44, 15.52, 1.8, 1.8, 28.44, 28.44, NULL, NULL, NULL, NULL, 15.52, 15.5202, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(711, 19, 178.7, 30.24, 18.4, 1.41, 1.41, 30.24, 30.24, NULL, NULL, NULL, NULL, 18.4001, 18.4003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(712, 19, 197.1, 31.65, 34.62, 7.6, 7.6, 31.65, 31.65, NULL, NULL, NULL, NULL, 34.6204, 34.6222, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(713, 19, 231.72, 39.25, 25.98, 2.16, 2.16, 39.25, 39.25, NULL, NULL, NULL, NULL, 25.9802, 25.9809, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(714, 19, 257.7, 41.41, 10.86, 1.37, 1.37, 41.41, 41.41, NULL, NULL, NULL, NULL, 10.86, 10.8601, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(715, 19, 268.56, 42.78, 12.94, 2.94, 2.94, 42.78, 42.78, NULL, NULL, NULL, NULL, 12.94, 12.9401, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(716, 19, 281.5, 45.72, 3.86, 0.7, 0.7, 45.72, 45.72, NULL, NULL, NULL, NULL, 3.86, 3.86, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(717, 19, 285.36, 46.42, 7.44, 1.05, 1.05, 46.42, 46.42, NULL, NULL, NULL, NULL, 7.44, 7.44002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(718, 19, 292.8, 47.47, 18.7, 3.11, 3.11, 47.47, 47.47, NULL, NULL, NULL, NULL, 18.7001, 18.7004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(719, 19, 311.5, 50.58, 20.02, 4.32, 4.32, 50.58, 50.58, NULL, NULL, NULL, NULL, 20.0201, 20.0204, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(720, 19, 331.52, 54.9, 1.48, 0.33, 0.33, 54.9, 54.9, NULL, NULL, NULL, NULL, 1.48, 1.48, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(721, 19, 333, 55.23, 20.05, 7.38, 7.38, 55.23, 55.23, NULL, NULL, NULL, NULL, 20.0501, 20.0504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(722, 19, 353.05, 62.61, 30.33, 1.97, 1.97, 62.61, 62.61, NULL, NULL, NULL, NULL, 30.3303, 30.3315, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(723, 19, 383.38, 64.58, 19.29, 4.6, 4.6, 64.58, 64.58, NULL, NULL, NULL, NULL, 19.2901, 19.2904, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(724, 19, 402.67, 69.18, 16.23, 5.54, 5.54, 69.18, 69.18, NULL, NULL, NULL, NULL, 16.23, 16.2302, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(725, 19, 418.9, 74.72, 16.45, 1.36, 1.36, 74.72, 74.72, NULL, NULL, NULL, NULL, 16.45, 16.4502, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(726, 19, 435.35, 76.08, 22.95, 3.63, 3.63, 76.08, 76.08, NULL, NULL, NULL, NULL, 22.9501, 22.9506, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(727, 19, 458.3, 79.71, 3.88, 0.66, 0.66, 79.71, 79.71, NULL, NULL, NULL, NULL, 3.88, 3.88, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(728, 19, 462.18, 80.37, 19.14, 3.55, 3.55, 80.37, 80.37, NULL, NULL, NULL, NULL, 19.1401, 19.1404, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(729, 19, 481.32, 83.92, 9.03, 0.4, 0.4, 83.92, 83.92, NULL, NULL, NULL, NULL, 9.03001, 9.03004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(730, 19, 490.35, 84.32, 17.52, 1.92, 1.92, 84.32, 84.32, NULL, NULL, NULL, NULL, 17.5201, 17.5203, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(731, 19, 507.87, 86.24, 13, 1.76, 1.76, 86.24, 86.24, NULL, NULL, NULL, NULL, 13, 13.0001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(732, 19, 520.87, 88, 1.83, 0.43, 0.43, 88, 88, NULL, NULL, NULL, NULL, 1.83, 1.83, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(733, 19, 522.7, 88.43, 21.04, -0.45, -0.45, 88.43, 88.43, NULL, NULL, NULL, NULL, 21.0401, 21.0405, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(734, 19, 543.74, 87.98, 0.81, -0.02, -0.02, 87.98, 87.98, NULL, NULL, NULL, NULL, 0.81, 0.81, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(735, 19, 544.55, 87.96, 7.38, -1.06, -1.06, 87.96, 87.96, NULL, NULL, NULL, NULL, 7.38, 7.38002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(736, 19, 551.93, 86.9, 8.97, -1.22, -1.22, 86.9, 86.9, NULL, NULL, NULL, NULL, 8.97001, 8.97004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(737, 19, 560.9, 85.68, 0.8, -0.11, -0.11, 85.68, 85.68, NULL, NULL, NULL, NULL, 0.8, 0.8, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(738, 19, 561.7, 85.57, 14.6, -3.03, -3.03, 85.57, 85.57, NULL, NULL, NULL, NULL, 14.6, 14.6002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(739, 19, 576.3, 82.54, 0.94, -0.32, -0.32, 82.54, 82.54, NULL, NULL, NULL, NULL, 0.94, 0.94, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(740, 19, 577.24, 82.22, 2.58, -0.33, -0.33, 82.22, 82.22, NULL, NULL, NULL, NULL, 2.58, 2.58, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(741, 19, 579.82, 81.89, 20.98, -2.69, -2.69, 81.89, 81.89, NULL, NULL, NULL, NULL, 20.9801, 20.9805, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(742, 19, 600.8, 79.2, 19.45, 1.58, 1.58, 79.2, 79.2, NULL, NULL, NULL, NULL, 19.4501, 19.4504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(743, 19, 620.25, 80.78, 0.98, 0.02, 0.02, 80.78, 80.78, NULL, NULL, NULL, NULL, 0.98, 0.98, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(744, 19, 621.23, 80.8, 9.27, -2.19, -2.19, 80.8, 80.8, NULL, NULL, NULL, NULL, 9.27001, 9.27004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(745, 19, 630.5, 78.61, 9.37, -0.17, -0.17, 78.61, 78.61, NULL, NULL, NULL, NULL, 9.37001, 9.37004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(746, 19, 639.87, 78.44, 30.17, -7.14, -7.14, 78.44, 78.44, NULL, NULL, NULL, NULL, 30.1703, 30.1715, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(747, 19, 670.04, 71.3, 22.78, -9, -9, 71.3, 71.3, NULL, NULL, NULL, NULL, 22.7801, 22.7806, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(748, 19, 692.82, 62.3, 1.86, -0.8, -0.8, 62.3, 62.3, NULL, NULL, NULL, NULL, 1.86, 1.86, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(749, 19, 694.68, 61.5, 1.43, -0.44, -0.44, 61.5, 61.5, NULL, NULL, NULL, NULL, 1.43, 1.43, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(750, 19, 696.11, 61.06, 19.16, -5.4, -5.4, 61.06, 61.06, NULL, NULL, NULL, NULL, 19.1601, 19.1604, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(751, 19, 715.27, 55.66, 11.07, -0.73, -0.73, 55.66, 55.66, NULL, NULL, NULL, NULL, 11.07, 11.0701, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(752, 19, 726.34, 54.93, 7.43, -0.53, -0.53, 54.93, 54.93, NULL, NULL, NULL, NULL, 7.43, 7.43002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(753, 19, 733.77, 54.4, 10.2, 2.37, 2.37, 54.4, 54.4, NULL, NULL, NULL, NULL, 10.2, 10.2001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(754, 19, 743.97, 56.77, 5.95, 1.55, 1.55, 56.77, 56.77, NULL, NULL, NULL, NULL, 5.95, 5.95001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(755, 19, 749.92, 58.32, 1.55, -0.2, -0.2, 58.32, 58.32, NULL, NULL, NULL, NULL, 1.55, 1.55, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(756, 19, 751.47, 58.12, 11.85, -1.64, -1.64, 58.12, 58.12, NULL, NULL, NULL, NULL, 11.85, 11.8501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(757, 19, 763.32, 56.48, 9.21, -1.31, -1.31, 56.48, 56.48, NULL, NULL, NULL, NULL, 9.21001, 9.21004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(758, 19, 772.53, 55.17, 20.12, -7.21, -7.21, 55.17, 55.17, NULL, NULL, NULL, NULL, 20.1201, 20.1204, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(759, 19, 792.65, 47.96, 4.95, -0.87, -0.87, 47.96, 47.96, NULL, NULL, NULL, NULL, 4.95, 4.95001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(760, 19, 797.6, 47.09, 15.76, -2.42, -2.42, 47.09, 47.09, NULL, NULL, NULL, NULL, 15.76, 15.7602, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(761, 19, 813.36, 44.67, 17.08, -1.67, -1.67, 44.67, 44.67, NULL, NULL, NULL, NULL, 17.0801, 17.0803, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(762, 19, 830.44, 43, 5.4, -0.61, -0.61, 43, 43, NULL, NULL, NULL, NULL, 5.4, 5.40001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(763, 19, 835.84, 42.39, 21.02, 0.95, 0.95, 42.39, 42.39, NULL, NULL, NULL, NULL, 21.0201, 21.0205, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(764, 19, 856.86, 43.34, 5.69, 0.4, 0.4, 43.34, 43.34, NULL, NULL, NULL, NULL, 5.69, 5.69001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(765, 19, 862.55, 43.74, 12.12, -0.69, -0.69, 43.74, 43.74, NULL, NULL, NULL, NULL, 12.12, 12.1201, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(766, 19, 874.67, 43.05, 19.63, -1.65, -1.65, 43.05, 43.05, NULL, NULL, NULL, NULL, 19.6301, 19.6304, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(767, 19, 894.3, 41.4, 10.55, -0.18, -0.18, 41.4, 41.4, NULL, NULL, NULL, NULL, 10.55, 10.5501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(768, 19, 904.85, 41.22, 8.2, -0.24, -0.24, 41.22, 41.22, NULL, NULL, NULL, NULL, 8.20001, 8.20003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(769, 19, 913.05, 40.98, 20.1, -2.8, -2.8, 40.98, 40.98, NULL, NULL, NULL, NULL, 20.1001, 20.1004, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(770, 19, 933.15, 38.18, 1.32, -0.21, -0.21, 38.18, 38.18, NULL, NULL, NULL, NULL, 1.32, 1.32, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(771, 19, 934.47, 37.97, 6.23, 2.74, 2.74, 37.97, 37.97, NULL, NULL, NULL, NULL, 6.23, 6.23001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(772, 19, 940.7, 40.71, 12.33, 5.4, 5.4, 40.71, 40.71, NULL, NULL, NULL, NULL, 12.33, 12.3301, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(773, 19, 953.03, 46.11, 4.62, 1, 1, 46.11, 46.11, NULL, NULL, NULL, NULL, 4.62, 4.62001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(774, 19, 957.65, 47.11, 4.13, 0.04, 0.04, 47.11, 47.11, NULL, NULL, NULL, NULL, 4.13, 4.13, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(775, 19, 961.78, 47.15, 18.05, 0.18, 0.18, 47.15, 47.15, NULL, NULL, NULL, NULL, 18.0501, 18.0503, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(776, 19, 979.83, 47.33, 21.04, -6.66, -6.66, 47.33, 47.33, NULL, NULL, NULL, NULL, 21.0401, 21.0405, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(777, 19, 1000.87, 40.67, 18.51, -2.42, -2.42, 40.67, 40.67, NULL, NULL, NULL, NULL, 18.5101, 18.5103, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(778, 19, 1019.38, 38.25, 4.57, -0.2, -0.2, 38.25, 38.25, NULL, NULL, NULL, NULL, 4.57, 4.57, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(779, 19, 1023.95, 38.05, 21.35, -0.91, -0.91, 38.05, 38.05, NULL, NULL, NULL, NULL, 21.3501, 21.3505, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(780, 19, 1045.3, 37.14, 4.97, -0.38, -0.38, 37.14, 37.14, NULL, NULL, NULL, NULL, 4.97, 4.97001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(781, 19, 1050.27, 36.76, 27.33, -1.91, -1.91, 36.76, 36.76, NULL, NULL, NULL, NULL, 27.3302, 27.3311, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(782, 19, 1077.6, 34.85, 11.75, -0.43, -0.43, 34.85, 34.85, NULL, NULL, NULL, NULL, 11.75, 11.7501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(783, 19, 1089.35, 34.42, 11.2, -0.45, -0.45, 34.42, 34.42, NULL, NULL, NULL, NULL, 11.2, 11.2001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(784, 19, 1100.55, 33.97, 20.55, -0.19, -0.19, 33.97, 33.97, NULL, NULL, NULL, NULL, 20.5501, 20.5505, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(785, 19, 1121.1, 33.78, 33.3, 3.72, 3.72, 33.78, 33.78, NULL, NULL, NULL, NULL, 33.3004, 33.302, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(786, 19, 1154.4, 37.5, 24.2, 4.92, 4.92, 37.5, 37.5, NULL, NULL, NULL, NULL, 24.2001, 24.2008, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(787, 19, 1178.6, 42.42, 24.65, 5.42, 5.42, 42.42, 42.42, NULL, NULL, NULL, NULL, 24.6502, 24.6508, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(788, 19, 1203.25, 47.84, 6, 0.76, 0.76, 47.84, 47.84, NULL, NULL, NULL, NULL, 6, 6.00001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(789, 19, 1209.25, 48.6, 9.45, 1.27, 1.27, 48.6, 48.6, NULL, NULL, NULL, NULL, 9.45001, 9.45005, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(790, 19, 1218.7, 49.87, 10.7, 1.53, 1.53, 49.87, 49.87, NULL, NULL, NULL, NULL, 10.7, 10.7001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(791, 19, 1229.4, 51.4, 8.6, 1.24, 1.24, 51.4, 51.4, NULL, NULL, NULL, NULL, 8.60001, 8.60003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(792, 19, 1238, 52.64, 15.88, -3.09, -3.09, 52.64, 52.64, NULL, NULL, NULL, NULL, 15.88, 15.8802, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(793, 19, 1253.88, 49.55, 3.62, -0.48, -0.48, 49.55, 49.55, NULL, NULL, NULL, NULL, 3.62, 3.62, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(794, 19, 1257.5, 49.07, 19.65, -5.64, -5.64, 49.07, 49.07, NULL, NULL, NULL, NULL, 19.6501, 19.6504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(795, 19, 1277.15, 43.43, 22.08, -5.71, -5.71, 43.43, 43.43, NULL, NULL, NULL, NULL, 22.0801, 22.0806, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(796, 19, 1299.23, 37.72, 1.47, -0.34, -0.34, 37.72, 37.72, NULL, NULL, NULL, NULL, 1.47, 1.47, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(797, 19, 1300.7, 37.38, 21.95, -5.2, -5.2, 37.38, 37.38, NULL, NULL, NULL, NULL, 21.9501, 21.9506, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(798, 19, 1322.65, 32.18, 2.6, -0.64, -0.64, 32.18, 32.18, NULL, NULL, NULL, NULL, 2.6, 2.6, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(799, 19, 1325.25, 31.54, 18.85, -4.74, -4.74, 31.54, 31.54, NULL, NULL, NULL, NULL, 18.8501, 18.8504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(800, 19, 1344.1, 26.8, 1.96, -0.54, -0.54, 26.8, 26.8, NULL, NULL, NULL, NULL, 1.96, 1.96, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(801, 19, 1346.06, 26.26, 11.94, -2.43, -2.43, 26.26, 26.26, NULL, NULL, NULL, NULL, 11.94, 11.9401, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(802, 19, 1358, 23.83, 10.55, -1.91, -1.91, 23.83, 23.83, NULL, NULL, NULL, NULL, 10.55, 10.5501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(803, 19, 1368.55, 21.92, 1.28, -0.48, -0.48, 21.92, 21.92, NULL, NULL, NULL, NULL, 1.28, 1.28, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(804, 19, 1369.83, 21.44, 13.23, -3.09, -3.09, 21.44, 21.44, NULL, NULL, NULL, NULL, 13.23, 13.2301, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(805, 19, 1383.06, 18.35, 1.94, -0.45, -0.45, 18.35, 18.35, NULL, NULL, NULL, NULL, 1.94, 1.94, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(806, 19, 1385, 17.9, 13.15, -3.83, -3.83, 17.9, 17.9, NULL, NULL, NULL, NULL, 13.15, 13.1501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(807, 19, 1398.15, 14.07, 20.15, -4.75, -4.75, 14.07, 14.07, NULL, NULL, NULL, NULL, 20.1501, 20.1504, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(808, 19, 1418.3, 9.32, 20.9, -5.38, -5.38, 9.32, 9.32, NULL, NULL, NULL, NULL, 20.9001, 20.9005, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(809, 19, 1439.2, 3.94, 13.05, -2.24, -2.24, 3.94, 3.94, NULL, NULL, NULL, NULL, 13.05, 13.0501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(810, 19, 1452.25, 1.7, 7, -1.2, -1.2, 1.7, 1.7, NULL, NULL, NULL, NULL, 7, 7.00002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(811, 19, 1459.25, 0.5, 2.85, -0.5, -0.5, 0.5, 0.5, NULL, NULL, NULL, NULL, 2.85, 2.85, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(812, 19, 1462.1, 0, 6.85, -0.88, -0.88, 0, 0, NULL, NULL, NULL, NULL, 6.85, 6.85002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(813, 19, 1468.95, -0.88, 7.9, -1.8, -1.8, -0.88, -0.88, NULL, NULL, NULL, NULL, 7.9, 7.90003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(814, 19, 1476.85, -2.68, 1.65, -0.7, -0.7, -2.68, -2.68, NULL, NULL, NULL, NULL, 1.65, 1.65, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(815, 19, 1478.5, -3.38, 7.1, -4.35, -4.35, -3.38, -3.38, NULL, NULL, NULL, NULL, 7.1, 7.10002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(816, 19, 1485.6, -7.73, 1.5, -0.87, -0.87, -7.73, -7.73, NULL, NULL, NULL, NULL, 1.5, 1.5, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(817, 19, 1487.1, -8.6, 6.65, -0.95, -0.95, -8.6, -8.6, NULL, NULL, NULL, NULL, 6.65, 6.65002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(818, 19, 1493.75, -9.55, 6.4, -1, -1, -9.55, -9.55, NULL, NULL, NULL, NULL, 6.4, 6.40001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(819, 19, 1500.15, -10.55, 1.2, -0.1, -0.1, -10.55, -10.55, NULL, NULL, NULL, NULL, 1.2, 1.2, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(820, 19, 1501.35, -10.65, 12.4, 1, 1, -10.65, -10.65, NULL, NULL, NULL, NULL, 12.4, 12.4001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(821, 19, 1513.75, -9.65, 5.85, 1.27, 1.27, -9.65, -9.65, NULL, NULL, NULL, NULL, 5.85, 5.85001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(822, 19, 1519.6, -8.38, 8.2, 1.78, 1.78, -8.38, -8.38, NULL, NULL, NULL, NULL, 8.20001, 8.20003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(823, 19, 1527.8, -6.6, 10.25, 2.38, 2.38, -6.6, -6.6, NULL, NULL, NULL, NULL, 10.25, 10.2501, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(824, 19, 1538.05, -4.22, 12, 2.67, 2.67, -4.22, -4.22, NULL, NULL, NULL, NULL, 12, 12.0001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(825, 19, 1550.05, -1.55, 10.42, 2.07, 2.07, -1.55, -1.55, NULL, NULL, NULL, NULL, 10.42, 10.4201, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(826, 19, 1560.47, 0.52, 5.85, 1.23, 1.23, 0.52, 0.52, NULL, NULL, NULL, NULL, 5.85, 5.85001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(827, 19, 1566.32, 1.75, 3.01, 0.63, 0.63, 1.75, 1.75, NULL, NULL, NULL, NULL, 3.01, 3.01, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(828, 19, 1569.33, 2.38, 11.57, 2.77, 2.77, 2.38, 2.38, NULL, NULL, NULL, NULL, 11.57, 11.5701, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(829, 19, 1580.9, 5.15, 8, 2.01, 2.01, 5.15, 5.15, NULL, NULL, NULL, NULL, 8.00001, 8.00003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(830, 19, 1588.9, 7.16, 11.48, 2.18, 2.18, 7.16, 7.16, NULL, NULL, NULL, NULL, 11.48, 11.4801, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(831, 19, 1600.38, 9.34, 6.72, 1.2, 1.2, 9.34, 9.34, NULL, NULL, NULL, NULL, 6.72, 6.72002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(832, 19, 1607.1, 10.54, 16.08, 3.48, 3.48, 10.54, 10.54, NULL, NULL, NULL, NULL, 16.08, 16.0802, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(833, 19, 1623.18, 14.02, 6.39, 1.38, 1.38, 14.02, 14.02, NULL, NULL, NULL, NULL, 6.39, 6.39001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(834, 19, 1629.57, 15.4, 17.53, -0.52, -0.52, 15.4, 15.4, NULL, NULL, NULL, NULL, 17.5301, 17.5303, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(835, 19, 1647.1, 14.88, 10, -0.33, -0.33, 14.88, 14.88, NULL, NULL, NULL, NULL, 10, 10.0001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(836, 19, 1657.1, 14.55, 10.9, -0.35, -0.35, 14.55, 14.55, NULL, NULL, NULL, NULL, 10.9, 10.9001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(837, 19, 1668, 14.2, 3.33, -0.1, -0.1, 14.2, 14.2, NULL, NULL, NULL, NULL, 3.33, 3.33, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(838, 19, 1671.33, 14.1, 18.77, -0.61, -0.61, 14.1, 14.1, NULL, NULL, NULL, NULL, 18.7701, 18.7704, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(839, 19, 1690.1, 13.49, 7.25, -0.63, -0.63, 13.49, 13.49, NULL, NULL, NULL, NULL, 7.25, 7.25002, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(840, 19, 1697.35, 12.86, 12.4, -0.81, -0.81, 12.86, 12.86, NULL, NULL, NULL, NULL, 12.4, 12.4001, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(841, 19, 1709.75, 12.05, 8.05, -1.54, -1.54, 12.05, 12.05, NULL, NULL, NULL, NULL, 8.05, 8.05003, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(842, 19, 1717.8, 10.51, 7282.2, -4.26, -2.71, 10.51, 10.51, NULL, NULL, NULL, NULL, 11943.2, 54933.2, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(1558, 15, 0, 87, 45, -11.67, -4.5, 83.42, 87, NULL, NULL, NULL, NULL, 45.0019, 45.0095, '2025-12-14 07:11:31', '2025-12-14 07:11:31'),
(1559, 15, 45, 43, 855, -10.85, -14, 71.75, 82.5, NULL, NULL, NULL, NULL, 867.818, 921.791, '2025-12-14 07:11:31', '2025-12-14 07:11:31'),
(1560, 20, 0, 4.53, 16.25, 1.72, 1.17, 3.98, 4.53, NULL, NULL, NULL, NULL, 16.25, 16.25, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1561, 20, 16.25, 5.7, 8.85, 1.95, 1.95, 5.7, 5.7, NULL, NULL, NULL, NULL, 8.85001, 8.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1562, 20, 25.1, 7.65, 65.4, 19.25, 19.25, 7.65, 7.65, NULL, NULL, NULL, NULL, 65.4022, 65.4015, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1563, 20, 90.5, 26.9, 4.3, -1.44, -1.44, 26.9, 26.9, NULL, NULL, NULL, NULL, 4.3, 4.3, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1564, 20, 94.8, 25.46, 19.05, -3.46, -3.46, 25.46, 25.46, NULL, NULL, NULL, NULL, 19.0501, 19.05, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1565, 20, 113.85, 22, 1.62, 0.26, 0.26, 22, 22, NULL, NULL, NULL, NULL, 1.62, 1.62, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1566, 20, 115.47, 22.26, 4.01, 0.4, 0.4, 22.26, 22.26, NULL, NULL, NULL, NULL, 4.01, 4.01, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1567, 20, 119.48, 22.66, 20.22, 1.84, 1.84, 22.66, 22.66, NULL, NULL, NULL, NULL, 20.2201, 20.22, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1568, 20, 139.7, 24.5, 10.76, 1.23, 1.23, 24.5, 24.5, NULL, NULL, NULL, NULL, 10.76, 10.76, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1569, 20, 150.46, 25.73, 12.72, 2.71, 2.71, 25.73, 25.73, NULL, NULL, NULL, NULL, 12.72, 12.72, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1570, 20, 163.18, 28.44, 15.52, 1.8, 1.8, 28.44, 28.44, NULL, NULL, NULL, NULL, 15.52, 15.52, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1571, 20, 178.7, 30.24, 18.4, 1.41, 1.41, 30.24, 30.24, NULL, NULL, NULL, NULL, 18.4, 18.4, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1572, 20, 197.1, 31.65, 34.62, 7.6, 7.6, 31.65, 31.65, NULL, NULL, NULL, NULL, 34.6203, 34.6202, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1573, 20, 231.72, 39.25, 25.98, 2.16, 2.16, 39.25, 39.25, NULL, NULL, NULL, NULL, 25.9801, 25.9801, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1574, 20, 257.7, 41.41, 10.86, 1.37, 1.37, 41.41, 41.41, NULL, NULL, NULL, NULL, 10.86, 10.86, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1575, 20, 268.56, 42.78, 12.94, 2.94, 2.94, 42.78, 42.78, NULL, NULL, NULL, NULL, 12.94, 12.94, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1576, 20, 281.5, 45.72, 3.86, 0.7, 0.7, 45.72, 45.72, NULL, NULL, NULL, NULL, 3.86, 3.86, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1577, 20, 285.36, 46.42, 7.44, 1.05, 1.05, 46.42, 46.42, NULL, NULL, NULL, NULL, 7.44, 7.44, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1578, 20, 292.8, 47.47, 18.7, 3.11, 3.11, 47.47, 47.47, NULL, NULL, NULL, NULL, 18.7001, 18.7, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1579, 20, 311.5, 50.58, 20.02, 4.32, 4.32, 50.58, 50.58, NULL, NULL, NULL, NULL, 20.0201, 20.02, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1580, 20, 331.52, 54.9, 1.48, 0.33, 0.33, 54.9, 54.9, NULL, NULL, NULL, NULL, 1.48, 1.48, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1581, 20, 333, 55.23, 20.05, 7.38, 7.38, 55.23, 55.23, NULL, NULL, NULL, NULL, 20.0501, 20.05, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1582, 20, 353.05, 62.61, 30.33, 1.97, 1.97, 62.61, 62.61, NULL, NULL, NULL, NULL, 30.3302, 30.3302, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1583, 20, 383.38, 64.58, 19.29, 4.6, 4.6, 64.58, 64.58, NULL, NULL, NULL, NULL, 19.2901, 19.29, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1584, 20, 402.67, 69.18, 16.23, 34.54, 43.04, 69.18, 69.18, NULL, NULL, NULL, NULL, 16.23, 16.23, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1585, 20, 418.9, 74.72, 16.45, -27.64, -36.14, 103.72, 112.22, NULL, NULL, NULL, NULL, 16.45, 16.45, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1586, 20, 435.35, 76.08, 22.95, 3.63, 3.63, 76.08, 76.08, NULL, NULL, NULL, NULL, 22.9501, 22.9501, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1587, 20, 458.3, 79.71, 3.88, 0.66, 0.66, 79.71, 79.71, NULL, NULL, NULL, NULL, 3.88, 3.88, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1588, 20, 462.18, 80.37, 19.14, 3.55, 3.55, 80.37, 80.37, NULL, NULL, NULL, NULL, 19.1401, 19.14, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1589, 20, 481.32, 83.92, 9.03, 0.4, 0.4, 83.92, 83.92, NULL, NULL, NULL, NULL, 9.03001, 9.03, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1590, 20, 490.35, 84.32, 17.52, 1.92, 1.92, 84.32, 84.32, NULL, NULL, NULL, NULL, 17.52, 17.52, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1591, 20, 507.87, 86.24, 13, 1.76, 1.76, 86.24, 86.24, NULL, NULL, NULL, NULL, 13, 13, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1592, 20, 520.87, 88, 1.83, 0.43, 0.43, 88, 88, NULL, NULL, NULL, NULL, 1.83, 1.83, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1593, 20, 522.7, 88.43, 21.04, -0.45, -0.45, 88.43, 88.43, NULL, NULL, NULL, NULL, 21.0401, 21.0401, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1594, 20, 543.74, 87.98, 0.81, -0.02, -0.02, 87.98, 87.98, NULL, NULL, NULL, NULL, 0.81, 0.81, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1595, 20, 544.55, 87.96, 7.38, -1.06, -1.06, 87.96, 87.96, NULL, NULL, NULL, NULL, 7.38, 7.38, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1596, 20, 551.93, 86.9, 8.97, -1.22, -1.22, 86.9, 86.9, NULL, NULL, NULL, NULL, 8.97001, 8.97, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1597, 20, 560.9, 85.68, 0.8, -0.11, -0.11, 85.68, 85.68, NULL, NULL, NULL, NULL, 0.8, 0.8, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1598, 20, 561.7, 85.57, 14.6, -3.03, -3.03, 85.57, 85.57, NULL, NULL, NULL, NULL, 14.6, 14.6, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1599, 20, 576.3, 82.54, 0.94, -0.32, -0.32, 82.54, 82.54, NULL, NULL, NULL, NULL, 0.94, 0.94, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1600, 20, 577.24, 82.22, 2.58, -0.33, -0.33, 82.22, 82.22, NULL, NULL, NULL, NULL, 2.58, 2.58, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1601, 20, 579.82, 81.89, 20.98, 8.81, 17.81, 81.89, 81.89, NULL, NULL, NULL, NULL, 20.9801, 20.98, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1602, 20, 600.8, 79.2, 19.45, -9.92, -18.92, 90.7, 99.7, NULL, NULL, NULL, NULL, 19.4501, 19.45, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1603, 20, 620.25, 80.78, 0.98, 0.02, 0.02, 80.78, 80.78, NULL, NULL, NULL, NULL, 0.98, 0.98, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1604, 20, 621.23, 80.8, 9.27, -2.19, -2.19, 80.8, 80.8, NULL, NULL, NULL, NULL, 9.27001, 9.27, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1605, 20, 630.5, 78.61, 9.37, -0.17, -0.17, 78.61, 78.61, NULL, NULL, NULL, NULL, 9.37001, 9.37, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1606, 20, 639.87, 78.44, 30.17, -7.14, -7.14, 78.44, 78.44, NULL, NULL, NULL, NULL, 30.1702, 30.1701, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1607, 20, 670.04, 71.3, 22.78, -9, -9, 71.3, 71.3, NULL, NULL, NULL, NULL, 22.7801, 22.7801, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1608, 20, 692.82, 62.3, 1.86, -0.8, -0.8, 62.3, 62.3, NULL, NULL, NULL, NULL, 1.86, 1.86, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1609, 20, 694.68, 61.5, 1.43, -0.44, -0.44, 61.5, 61.5, NULL, NULL, NULL, NULL, 1.43, 1.43, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1610, 20, 696.11, 61.06, 19.16, -5.4, -5.4, 61.06, 61.06, NULL, NULL, NULL, NULL, 19.1601, 19.16, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1611, 20, 715.27, 55.66, 11.07, -0.73, -0.73, 55.66, 55.66, NULL, NULL, NULL, NULL, 11.07, 11.07, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1612, 20, 726.34, 54.93, 7.43, -0.53, -0.53, 54.93, 54.93, NULL, NULL, NULL, NULL, 7.43, 7.43, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1613, 20, 733.77, 54.4, 10.2, 2.37, 2.37, 54.4, 54.4, NULL, NULL, NULL, NULL, 10.2, 10.2, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1614, 20, 743.97, 56.77, 5.95, 1.55, 1.55, 56.77, 56.77, NULL, NULL, NULL, NULL, 5.95, 5.95, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1615, 20, 749.92, 58.32, 1.55, -0.2, -0.2, 58.32, 58.32, NULL, NULL, NULL, NULL, 1.55, 1.55, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1616, 20, 751.47, 58.12, 11.85, -1.64, -1.64, 58.12, 58.12, NULL, NULL, NULL, NULL, 11.85, 11.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1617, 20, 763.32, 56.48, 9.21, -1.31, -1.31, 56.48, 56.48, NULL, NULL, NULL, NULL, 9.21001, 9.21, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1618, 20, 772.53, 55.17, 20.12, -7.21, -7.21, 55.17, 55.17, NULL, NULL, NULL, NULL, 20.1201, 20.12, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1619, 20, 792.65, 47.96, 4.95, -0.87, -0.87, 47.96, 47.96, NULL, NULL, NULL, NULL, 4.95, 4.95, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1620, 20, 797.6, 47.09, 15.76, -2.42, -2.42, 47.09, 47.09, NULL, NULL, NULL, NULL, 15.76, 15.76, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1621, 20, 813.36, 44.67, 17.08, -1.67, -1.67, 44.67, 44.67, NULL, NULL, NULL, NULL, 17.08, 17.08, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1622, 20, 830.44, 43, 5.4, -0.61, -0.61, 43, 43, NULL, NULL, NULL, NULL, 5.4, 5.4, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1623, 20, 835.84, 42.39, 21.02, 0.95, 0.95, 42.39, 42.39, NULL, NULL, NULL, NULL, 21.0201, 21.0201, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1624, 20, 856.86, 43.34, 5.69, 0.4, 0.4, 43.34, 43.34, NULL, NULL, NULL, NULL, 5.69, 5.69, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1625, 20, 862.55, 43.74, 12.12, -0.69, -0.69, 43.74, 43.74, NULL, NULL, NULL, NULL, 12.12, 12.12, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1626, 20, 874.67, 43.05, 19.63, -1.65, -1.65, 43.05, 43.05, NULL, NULL, NULL, NULL, 19.6301, 19.63, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1627, 20, 894.3, 41.4, 10.55, -0.18, -0.18, 41.4, 41.4, NULL, NULL, NULL, NULL, 10.55, 10.55, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1628, 20, 904.85, 41.22, 8.2, -0.24, -0.24, 41.22, 41.22, NULL, NULL, NULL, NULL, 8.2, 8.2, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1629, 20, 913.05, 40.98, 20.1, -2.8, -2.8, 40.98, 40.98, NULL, NULL, NULL, NULL, 20.1001, 20.1, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1630, 20, 933.15, 38.18, 1.32, -0.21, -0.21, 38.18, 38.18, NULL, NULL, NULL, NULL, 1.32, 1.32, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1631, 20, 934.47, 37.97, 6.23, 2.74, 2.74, 37.97, 37.97, NULL, NULL, NULL, NULL, 6.23, 6.23, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1632, 20, 940.7, 40.71, 12.33, 20.4, 28.9, 40.71, 40.71, NULL, NULL, NULL, NULL, 12.33, 12.33, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1633, 20, 953.03, 46.11, 4.62, -14, -22.5, 61.11, 69.61, NULL, NULL, NULL, NULL, 4.62, 4.62, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1634, 20, 957.65, 47.11, 4.13, 0.04, 0.04, 47.11, 47.11, NULL, NULL, NULL, NULL, 4.13, 4.13, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1635, 20, 961.78, 47.15, 18.05, 0.18, 0.18, 47.15, 47.15, NULL, NULL, NULL, NULL, 18.05, 18.05, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1636, 20, 979.83, 47.33, 21.04, 3.34, 12.34, 47.33, 47.33, NULL, NULL, NULL, NULL, 21.0401, 21.0401, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1637, 20, 1000.87, 40.67, 18.51, -12.42, -21.42, 50.67, 59.67, NULL, NULL, NULL, NULL, 18.51, 18.51, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1638, 20, 1019.38, 38.25, 4.57, -0.2, -0.2, 38.25, 38.25, NULL, NULL, NULL, NULL, 4.57, 4.57, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1639, 20, 1023.95, 38.05, 21.35, -0.91, -0.91, 38.05, 38.05, NULL, NULL, NULL, NULL, 21.3501, 21.3501, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1640, 20, 1045.3, 37.14, 4.97, -0.38, -0.38, 37.14, 37.14, NULL, NULL, NULL, NULL, 4.97, 4.97, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1641, 20, 1050.27, 36.76, 27.33, -1.91, -1.91, 36.76, 36.76, NULL, NULL, NULL, NULL, 27.3302, 27.3301, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1642, 20, 1077.6, 34.85, 11.75, -0.43, -0.43, 34.85, 34.85, NULL, NULL, NULL, NULL, 11.75, 11.75, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1643, 20, 1089.35, 34.42, 11.2, -0.45, -0.45, 34.42, 34.42, NULL, NULL, NULL, NULL, 11.2, 11.2, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1644, 20, 1100.55, 33.97, 20.55, -0.19, -0.19, 33.97, 33.97, NULL, NULL, NULL, NULL, 20.5501, 20.55, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1645, 20, 1121.1, 33.78, 33.3, 21.22, 30.22, 33.78, 33.78, NULL, NULL, NULL, NULL, 33.3003, 33.3002, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1646, 20, 1154.4, 37.5, 24.2, -12.58, -21.58, 55, 64, NULL, NULL, NULL, NULL, 24.2001, 24.2001, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1647, 20, 1178.6, 42.42, 24.65, 5.42, 5.42, 42.42, 42.42, NULL, NULL, NULL, NULL, 24.6501, 24.6501, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1648, 20, 1203.25, 47.84, 6, 0.76, 0.76, 47.84, 47.84, NULL, NULL, NULL, NULL, 6, 6, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1649, 20, 1209.25, 48.6, 9.45, 1.27, 1.27, 48.6, 48.6, NULL, NULL, NULL, NULL, 9.45001, 9.45, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1650, 20, 1218.7, 49.87, 10.7, 1.53, 1.53, 49.87, 49.87, NULL, NULL, NULL, NULL, 10.7, 10.7, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1651, 20, 1229.4, 51.4, 8.6, 1.24, 1.24, 51.4, 51.4, NULL, NULL, NULL, NULL, 8.60001, 8.6, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1652, 20, 1238, 52.64, 15.88, -3.09, -3.09, 52.64, 52.64, NULL, NULL, NULL, NULL, 15.88, 15.88, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1653, 20, 1253.88, 49.55, 3.62, 11.97, 21.52, 49.55, 49.55, NULL, NULL, NULL, NULL, 3.62, 3.62, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1654, 20, 1257.5, 49.07, 19.65, -18.09, -27.64, 61.52, 71.07, NULL, NULL, NULL, NULL, 19.6501, 19.65, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1655, 20, 1277.15, 43.43, 22.08, -5.71, -5.71, 43.43, 43.43, NULL, NULL, NULL, NULL, 22.0801, 22.0801, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1656, 20, 1299.23, 37.72, 1.47, -0.34, -0.34, 37.72, 37.72, NULL, NULL, NULL, NULL, 1.47, 1.47, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1657, 20, 1300.7, 37.38, 21.95, -5.2, -5.2, 37.38, 37.38, NULL, NULL, NULL, NULL, 21.9501, 21.9501, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1658, 20, 1322.65, 32.18, 2.6, -0.64, -0.64, 32.18, 32.18, NULL, NULL, NULL, NULL, 2.6, 2.6, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1659, 20, 1325.25, 31.54, 18.85, -4.74, -4.74, 31.54, 31.54, NULL, NULL, NULL, NULL, 18.8501, 18.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1660, 20, 1344.1, 26.8, 1.96, -0.54, -0.54, 26.8, 26.8, NULL, NULL, NULL, NULL, 1.96, 1.96, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1661, 20, 1346.06, 26.26, 11.94, -2.43, -2.43, 26.26, 26.26, NULL, NULL, NULL, NULL, 11.94, 11.94, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1662, 20, 1358, 23.83, 10.55, -1.91, -1.91, 23.83, 23.83, NULL, NULL, NULL, NULL, 10.55, 10.55, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1663, 20, 1368.55, 21.92, 1.28, -0.48, -0.48, 21.92, 21.92, NULL, NULL, NULL, NULL, 1.28, 1.28, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1664, 20, 1369.83, 21.44, 13.23, -3.09, -3.09, 21.44, 21.44, NULL, NULL, NULL, NULL, 13.23, 13.23, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1665, 20, 1383.06, 18.35, 1.94, -0.45, -0.45, 18.35, 18.35, NULL, NULL, NULL, NULL, 1.94, 1.94, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1666, 20, 1385, 17.9, 13.15, -3.83, -3.83, 17.9, 17.9, NULL, NULL, NULL, NULL, 13.15, 13.15, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1667, 20, 1398.15, 14.07, 20.15, -4.75, -4.75, 14.07, 14.07, NULL, NULL, NULL, NULL, 20.1501, 20.15, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1668, 20, 1418.3, 9.32, 20.9, -5.38, -5.38, 9.32, 9.32, NULL, NULL, NULL, NULL, 20.9001, 20.9, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1669, 20, 1439.2, 3.94, 13.05, -2.24, -2.24, 3.94, 3.94, NULL, NULL, NULL, NULL, 13.05, 13.05, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1670, 20, 1452.25, 1.7, 7, -1.2, -1.2, 1.7, 1.7, NULL, NULL, NULL, NULL, 7, 7, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1671, 20, 1459.25, 0.5, 2.85, -0.5, -0.5, 0.5, 0.5, NULL, NULL, NULL, NULL, 2.85, 2.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1672, 20, 1462.1, 0, 6.85, -0.88, -0.88, 0, 0, NULL, NULL, NULL, NULL, 6.85, 6.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1673, 20, 1468.95, -0.88, 7.9, -1.8, -1.8, -0.88, -0.88, NULL, NULL, NULL, NULL, 7.9, 7.9, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1674, 20, 1476.85, -2.68, 1.65, -0.7, -0.7, -2.68, -2.68, NULL, NULL, NULL, NULL, 1.65, 1.65, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1675, 20, 1478.5, -3.38, 7.1, -4.35, -4.35, -3.38, -3.38, NULL, NULL, NULL, NULL, 7.1, 7.1, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1676, 20, 1485.6, -7.73, 1.5, -0.87, -0.87, -7.73, -7.73, NULL, NULL, NULL, NULL, 1.5, 1.5, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1677, 20, 1487.1, -8.6, 6.65, -0.95, -0.95, -8.6, -8.6, NULL, NULL, NULL, NULL, 6.65, 6.65, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1678, 20, 1493.75, -9.55, 6.4, -1, -1, -9.55, -9.55, NULL, NULL, NULL, NULL, 6.4, 6.4, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1679, 20, 1500.15, -10.55, 1.2, -0.1, -0.1, -10.55, -10.55, NULL, NULL, NULL, NULL, 1.2, 1.2, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1680, 20, 1501.35, -10.65, 12.4, 1, 1, -10.65, -10.65, NULL, NULL, NULL, NULL, 12.4, 12.4, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1681, 20, 1513.75, -9.65, 5.85, 1.27, 1.27, -9.65, -9.65, NULL, NULL, NULL, NULL, 5.85, 5.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1682, 20, 1519.6, -8.38, 8.2, 1.78, 1.78, -8.38, -8.38, NULL, NULL, NULL, NULL, 8.2, 8.2, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1683, 20, 1527.8, -6.6, 10.25, 2.38, 2.38, -6.6, -6.6, NULL, NULL, NULL, NULL, 10.25, 10.25, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1684, 20, 1538.05, -4.22, 12, 2.67, 2.67, -4.22, -4.22, NULL, NULL, NULL, NULL, 12, 12, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1685, 20, 1550.05, -1.55, 10.42, 2.07, 2.07, -1.55, -1.55, NULL, NULL, NULL, NULL, 10.42, 10.42, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1686, 20, 1560.47, 0.52, 5.85, 1.23, 1.23, 0.52, 0.52, NULL, NULL, NULL, NULL, 5.85, 5.85, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1687, 20, 1566.32, 1.75, 3.01, 0.63, 0.63, 1.75, 1.75, NULL, NULL, NULL, NULL, 3.01, 3.01, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1688, 20, 1569.33, 2.38, 11.57, 2.77, 2.77, 2.38, 2.38, NULL, NULL, NULL, NULL, 11.57, 11.57, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1689, 20, 1580.9, 5.15, 8, 2.01, 2.01, 5.15, 5.15, NULL, NULL, NULL, NULL, 8, 8, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1690, 20, 1588.9, 7.16, 11.48, 2.18, 2.18, 7.16, 7.16, NULL, NULL, NULL, NULL, 11.48, 11.48, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1691, 20, 1600.38, 9.34, 6.72, 1.2, 1.2, 9.34, 9.34, NULL, NULL, NULL, NULL, 6.72, 6.72, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1692, 20, 1607.1, 10.54, 16.08, 3.48, 3.48, 10.54, 10.54, NULL, NULL, NULL, NULL, 16.08, 16.08, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1693, 20, 1623.18, 14.02, 6.39, 1.38, 1.38, 14.02, 14.02, NULL, NULL, NULL, NULL, 6.39, 6.39, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1694, 20, 1629.57, 15.4, 17.53, -0.52, -0.52, 15.4, 15.4, NULL, NULL, NULL, NULL, 17.53, 17.53, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1695, 20, 1647.1, 14.88, 10, -0.33, -0.33, 14.88, 14.88, NULL, NULL, NULL, NULL, 10, 10, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1696, 20, 1657.1, 14.55, 10.9, -0.35, -0.35, 14.55, 14.55, NULL, NULL, NULL, NULL, 10.9, 10.9, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1697, 20, 1668, 14.2, 3.33, -0.1, -0.1, 14.2, 14.2, NULL, NULL, NULL, NULL, 3.33, 3.33, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1698, 20, 1671.33, 14.1, 18.77, -0.61, -0.61, 14.1, 14.1, NULL, NULL, NULL, NULL, 18.7701, 18.77, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1699, 20, 1690.1, 13.49, 7.25, -0.63, -0.63, 13.49, 13.49, NULL, NULL, NULL, NULL, 7.25, 7.25, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1700, 20, 1697.35, 12.86, 12.4, -0.81, -0.81, 12.86, 12.86, NULL, NULL, NULL, NULL, 12.4, 12.4, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1701, 20, 1709.75, 12.05, 7.25, 3.98, 7.78, 12.05, 12.05, NULL, NULL, NULL, NULL, 7.25, 7.25, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(1702, 20, 1717, 5.6, 0.8, -5.52, -9.32, 16.03, 19.83, NULL, NULL, NULL, NULL, 0.8, 0.8, '2025-12-16 15:52:11', '2025-12-16 15:52:11'),
(2884, 25, 0, 931.34, 332.56, 29.32, 29.82, 940.24, 942.34, NULL, NULL, NULL, NULL, 332.85, 334.063, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2885, 25, 332.56, 958.21, 69.56, 4.25, 3.3, 969.56, 972.16, NULL, NULL, NULL, NULL, 69.5627, 69.5737, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2886, 25, 402.12, 961.51, 114.86, -24.11, -23.16, 973.81, 975.46, NULL, NULL, NULL, NULL, 114.872, 114.922, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2887, 25, 516.98, 936.35, 124.24, -28.41, -29.36, 949.7, 952.3, NULL, NULL, NULL, NULL, 124.255, 124.318, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2888, 25, 641.22, 906.99, 120.08, -5.64, -5.64, 921.29, 922.94, NULL, NULL, NULL, NULL, 120.094, 120.151, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2889, 25, 761.3, 903.35, 136.42, -3.63, -3.63, 915.65, 917.3, NULL, NULL, NULL, NULL, 136.44, 136.524, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2890, 25, 897.72, 897.72, 222.92, 3.97, 3.97, 912.02, 913.67, NULL, NULL, NULL, NULL, 223.007, 223.372, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2891, 25, 1120.64, 903.69, 135.93, 16.71, 16.71, 915.99, 917.64, NULL, NULL, NULL, NULL, 135.95, 136.032, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2892, 25, 1256.57, 920.4, 104, 31.61, 31.61, 932.7, 934.35, NULL, NULL, NULL, NULL, 104.009, 104.046, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2893, 25, 1360.57, 952.01, 84.32, 8.94, 8.94, 964.31, 965.96, NULL, NULL, NULL, NULL, 84.3247, 84.3445, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2894, 25, 1444.89, 960.95, 114.85, -18.8, -17.85, 973.25, 974.9, NULL, NULL, NULL, NULL, 114.862, 114.912, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2895, 25, 1559.74, 943.1, 91.31, -32.13, -33.08, 954.45, 957.05, NULL, NULL, NULL, NULL, 91.316, 91.3411, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2896, 25, 1651.05, 910.02, 103.43, -46.27, -46.27, 922.32, 923.97, NULL, NULL, NULL, NULL, 103.439, 103.475, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2897, 25, 1754.48, 863.75, 141.99, -49.98, -49.03, 876.05, 877.7, NULL, NULL, NULL, NULL, 142.013, 142.107, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2898, 25, 1896.47, 814.72, 53.21, -14.7, -15.65, 826.07, 828.67, NULL, NULL, NULL, NULL, 53.2112, 53.2161, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2899, 25, 1949.68, 799.07, 183.29, 3.26, 3.26, 811.37, 813.02, NULL, NULL, NULL, NULL, 183.339, 183.541, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2900, 25, 2132.97, 802.33, 78.17, 4.34, 5.29, 814.63, 816.28, NULL, NULL, NULL, NULL, 78.1738, 78.1895, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(2901, 25, 2211.14, 807.62, 41.59, 4.81, 5.06, 818.97, 821.57, NULL, NULL, NULL, NULL, 41.5906, 41.5929, '2026-01-29 23:16:05', '2026-01-29 23:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bdLytkVnLHxS2utVksJ75ajVmocJpETEcByS7tOV', 1, '172.18.0.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmdGdncxN3l5UlJnUDRIdlF4SVg3WE80RTQ1ajFzVEFmNWU3TEZTUCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0OToiaHR0cDovL2RhbHZvZC9hZG1pbi9tay8xMS9wcm9qZWN0cy9lZGl0X3phdHBvbC8yNSI7fX0=', 1769728565);

-- --------------------------------------------------------

--
-- Table structure for table `towers`
--

CREATE TABLE `towers` (
  `id` int UNSIGNED NOT NULL,
  `sif` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `voltage` int DEFAULT NULL,
  `angle` float DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `vid` varchar(20) DEFAULT NULL,
  `vis` float DEFAULT NULL,
  `vig` float DEFAULT NULL,
  `mhr` float DEFAULT NULL,
  `dkp` float DEFAULT NULL,
  `dkz` float DEFAULT NULL,
  `rap` varchar(20) DEFAULT NULL,
  `raz` varchar(20) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `towers`
--

INSERT INTO `towers` (`id`, `sif`, `type`, `voltage`, `angle`, `mass`, `vid`, `vis`, `vig`, `mhr`, `dkp`, `dkz`, `rap`, `raz`, `picture`, `active`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '21000000', '---', 10, 0, 0, 'E', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(3, '31000000', '---', 20, 0, 0, 'E', 0, 0, 0, 0, 0, '', '', NULL, 0, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(4, '31000101', 'P-8,85', 20, 0, 338, 'E', 8.85, 0, 1, 1.52, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(5, '31000102', 'P-10,50', 20, 0, 402, 'E', 10.5, 0, 1, 1.52, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(6, '31000103', 'P-12,35', 20, 0, 446, 'E', 12.03, 0, 1, 1.52, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(7, '31000104', 'P-14,32', 20, 0, 534, 'E', 14.32, 0, 1, 1.52, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(8, '31100101', 'P-2-9,10', 20, 30, 524, 'E', 9.1, 0, 1, 1.6, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(9, '31100102', 'P-2-10,70', 20, 30, 619, 'E', 10.7, 0, 1, 1.6, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(10, '31100103', 'P-2-12,30', 20, 30, 702, 'E', 12.3, 0, 1, 1.6, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(11, '31100104', 'P-2-14,43', 20, 30, 849, 'E', 14.43, 0, 1, 1.6, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(12, '31200101', 'P-1-9,10', 20, 60, 570, 'E', 9.1, 0, 1.2, 1.76, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(13, '31200102', 'P-1-10,70', 20, 60, 664, 'E', 10.7, 0, 1.2, 1.76, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(14, '31200103', 'P-1-12,30', 20, 60, 774, 'E', 12.3, 0, 1.2, 1.76, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(15, '31200104', 'P-1-14,43', 20, 60, 915, 'E', 14.3, 0, 1.2, 1.76, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(16, '41000000', '---', 35, 0, 0, 'E', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(17, '41000101', 'TN1-8', 35, 0, 700, 'E', 8, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(18, '41000102', 'TN1-9', 35, 0, 744, 'E', 9, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(19, '41000103', 'TN1-10', 35, 0, 811, 'E', 10, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(20, '41000104', 'TN1-11', 35, 0, 860, 'E', 11.5, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(21, '41000105', 'TN1-12', 35, 0, 905, 'E', 12, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(22, '41000106', 'TN1-13', 35, 0, 990, 'E', 13, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(23, '41000107', 'TN1-14', 35, 0, 1073, 'E', 14, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(24, '41000108', 'TN1-15', 35, 0, 1122, 'E', 15, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(25, '41000109', 'TN1-16', 35, 0, 1182, 'E', 16, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(26, '41000110', 'TN1-17', 35, 0, 1233, 'E', 17, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(27, '41000111', 'TN1-18', 35, 0, 1325, 'E', 18, 5.15, 1.15, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(28, '41100101', 'TA1-140-8', 35, 40, 1030, 'E', 8, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(29, '41100102', 'TA1-140-9', 35, 40, 1115, 'E', 9, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(30, '41100103', 'TA1-140-10', 35, 40, 1185, 'E', 10, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(31, '41100104', 'TA1-140-11', 35, 40, 1288, 'E', 11, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(32, '41100105', 'TA1-140-12', 35, 40, 1356, 'E', 12, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(33, '41100106', 'TA1-140-13', 35, 40, 1436, 'E', 13, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(34, '41100107', 'TA1-140-14', 35, 40, 1540, 'E', 14, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(35, '41100108', 'TA1-140-15', 35, 40, 1626, 'E', 15, 5.8, 1.2, 3.04, 2.59, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(36, '41200101', 'TA1-120-8', 35, 60, 1152, 'E', 8, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(37, '41200102', 'TA1-120-9', 35, 60, 1246, 'E', 9, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(38, '41200103', 'TA1-120-10', 35, 60, 1386, 'E', 10, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(39, '41200104', 'TA1-120-11', 35, 60, 1478, 'E', 11.5, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(40, '41200105', 'TA1-120-12', 35, 60, 1553, 'E', 12, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(41, '41200106', 'TA1-120-13', 35, 60, 1654, 'E', 13, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(42, '41200107', 'TA1-120-14', 35, 60, 1800, 'E', 14, 6.05, 1.2, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(43, '41200108', 'TA1-120-15', 35, 60, 1925, 'E', 15, 6.05, 1.05, 3.28, 3.22, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(44, '51000000', '---', 110, 0, 0, 'E', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(45, '51000101', 'S-12.9', 110, 0, 1488, 'E', 12.9, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(46, '51000102', 'S-14.8', 110, 0, 1673, 'E', 14.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(47, '51000103', 'S-16.8', 110, 0, 1892, 'E', 16.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(48, '51000104', 'S-17.8', 110, 0, 2007, 'E', 17.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(49, '51000105', 'S-18.8', 110, 0, 2163, 'E', 18.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(50, '51000106', 'S-19.8', 110, 0, 2282, 'E', 19.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(51, '51000107', 'S-20.8', 110, 0, 2397, 'E', 20.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(52, '51000108', 'S-21.8', 110, 0, 2553, 'E', 21.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(53, '51000109', 'S-22.8', 110, 0, 2598, 'E', 22.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(54, '51000110', 'S-23.8', 110, 0, 2712, 'E', 23.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(55, '51000111', 'S-24.8', 110, 0, 2868, 'E', 24.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(56, '51000112', 'S-25.8', 110, 0, 2954, 'E', 25.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(57, '51000113', 'S-26.8', 110, 0, 3069, 'E', 26.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(58, '51000114', 'S-27.8', 110, 0, 3225, 'E', 27.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(59, '51000115', 'S-28.8', 110, 0, 3383, 'E', 28.8, 6.7, 2.06, 3.72, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(60, '51000201', 'SL-12.9', 110, 0, 1712, 'E', 12.9, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(61, '51000202', 'SL-14.8', 110, 0, 1920, 'E', 14.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(62, '51000203', 'SL-16.8', 110, 0, 2172, 'E', 16.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(63, '51000204', 'SL-17.8', 110, 0, 2296, 'E', 17.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(64, '51000205', 'SL-18.8', 110, 0, 2462, 'E', 18.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(65, '51000206', 'SL-19.8', 110, 0, 2595, 'E', 19.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(66, '51000207', 'SL-20.8', 110, 0, 2722, 'E', 20.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(67, '51000208', 'SL-21.8', 110, 0, 2886, 'E', 21.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(68, '51000209', 'SL-22.8', 110, 0, 2935, 'E', 22.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(69, '51000210', 'SL-23.8', 110, 0, 3060, 'E', 23.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(70, '51000211', 'SL-24.8', 110, 0, 3226, 'E', 24.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(71, '51000212', 'SL-25.8', 110, 0, 3326, 'E', 25.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(72, '51000213', 'SL-26.8', 110, 0, 3452, 'E', 26.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(73, '51000214', 'SL-27.8', 110, 0, 3617, 'E', 27.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(74, '51000215', 'SL-28.8', 110, 0, 3770, 'E', 28.8, 7.8, 2.06, 4.85, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(75, '51100101', 'A-150-13', 110, 30, 2565, 'E', 13, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(76, '51100102', 'A-150-15', 110, 30, 2866, 'E', 15, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(77, '51100103', 'A-150-16', 110, 30, 3008, 'E', 16, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(78, '51100104', 'A-150-17', 110, 30, 3174, 'E', 17, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(79, '51100105', 'A-150-18', 110, 30, 3422, 'E', 18, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(80, '51100106', 'A-150-19', 110, 30, 3565, 'E', 19, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(81, '51100107', 'A-150-20', 110, 30, 3731, 'E', 20, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(82, '51100108', 'A-150-21', 110, 30, 3949, 'E', 21, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(83, '51100109', 'A-150-22', 110, 30, 4092, 'E', 22, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(84, '51100110', 'A-150-23', 110, 30, 4258, 'E', 23, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(85, '51100111', 'A-150-24', 110, 30, 4483, 'E', 24, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(86, '51100112', 'A-150-25', 110, 30, 4626, 'E', 25, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(87, '51100113', 'A-150-26', 110, 30, 4792, 'E', 26, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(88, '51100114', 'A-150-27', 110, 30, 5042, 'E', 27, 9.2, 2.15, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(89, '51200101', 'A-120-13', 110, 60, 3080, 'E', 13, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(90, '51200102', 'A-120-15', 110, 60, 3455, 'E', 15, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(91, '51200103', 'A-120-16', 110, 60, 3632, 'E', 16, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(92, '51200104', 'A-120-17', 110, 60, 3848, 'E', 17, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(93, '51200105', 'A-120-18', 110, 60, 4109, 'E', 18, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(94, '51200106', 'A-120-19', 110, 60, 4287, 'E', 19, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(95, '51200107', 'A-120-20', 110, 60, 4487, 'E', 20, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(96, '51200108', 'A-120-21', 110, 60, 4653, 'E', 21, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(97, '51200109', 'A-120-22', 110, 60, 4836, 'E', 22, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(98, '51200110', 'A-120-23', 110, 60, 5059, 'E', 23, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(99, '51200111', 'A-120-24', 110, 60, 5454, 'E', 24, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(100, '51200112', 'A-120-25', 110, 60, 5609, 'E', 25, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(101, '51200113', 'A-120-26', 110, 60, 5857, 'E', 26, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(102, '51200114', 'A-120-27', 110, 60, 6235, 'E', 27, 9.2, 2.7, 4.56, 5.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(103, '21000201', 'DIS-D-10/6,8', 20, 0, 0, 'E', 6.8, 1.6, 0, 1.4, 0, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(104, '21000202', 'DIS-D-11/7,6', 20, 0, 0, 'E', 7.4, 1.8, 0, 1.6, 0, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(105, '21000203', 'DIS-D-12/8,4', 20, 0, 0, 'E', 8.2, 1.8, 0, 1.6, 0, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(106, '42000101', 'TND3-8', 35, 0, 1239, 'D', 8, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(107, '42000102', 'TND3-9', 35, 0, 1343, 'D', 9, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(108, '42000103', 'TND3-10', 35, 0, 1423, 'D', 10, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(109, '42000104', 'TND3-11', 35, 0, 1502, 'D', 11, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(110, '42000105', 'TND3-12', 35, 0, 1584, 'D', 12, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(111, '42000106', 'TND3-13', 35, 0, 1671, 'D', 13, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(112, '42000107', 'TND3-14', 35, 0, 1755, 'D', 14, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(113, '42000108', 'TND3-15', 35, 0, 1860, 'D', 15, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(114, '42000109', 'TND3-16', 35, 0, 1953, 'D', 16, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(115, '42000110', 'TND3-17', 35, 0, 2046, 'D', 17, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(116, '42000111', 'TND3-18', 35, 0, 2139, 'D', 18, 9.3, 1.3, 3.52, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(117, '42100101', 'TAD3-30-8', 35, 30, 1820, 'D', 8, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(118, '42100102', 'TAD3-30-9', 35, 30, 1993, 'D', 9, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(119, '42100103', 'TAD3-30-10', 35, 30, 2074, 'D', 10, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(120, '42100104', 'TAD3-30-11', 35, 30, 2189, 'D', 11, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(121, '42100105', 'TAD3-30-12', 35, 30, 2366, 'D', 12, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(122, '42100106', 'TAD3-30-13', 35, 30, 2483, 'D', 13, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(123, '42100107', 'TAD3-30-14', 35, 30, 2612, 'D', 14, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(124, '42100108', 'TAD3-30-15', 35, 30, 2739, 'D', 15, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(125, '42100109', 'TAD3-30-16', 35, 30, 2879, 'D', 16, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(126, '42100110', 'TAD3-30-17', 35, 30, 2997, 'D', 17, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(127, '42100111', 'TAD3-30-18', 35, 30, 3108, 'D', 18, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(128, '42200101', 'TAD3-60-8', 35, 60, 2107, 'D', 8, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(129, '42200102', 'TAD3-60-9', 35, 60, 2251, 'D', 9, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(130, '42200103', 'TAD3-60-10', 35, 60, 2398, 'D', 10, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(131, '42200104', 'TAD3-60-11', 35, 60, 2550, 'D', 11, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(132, '42200105', 'TAD3-60-12', 35, 60, 2702, 'D', 12, 10.2, 1.45, 3.1, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(133, '42200106', 'TAD3-60-13', 35, 60, 2858, 'D', 12.3, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(134, '42200107', 'TAD3-60-14', 35, 60, 3021, 'D', 14, 10.2, 1.45, 3.1, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(135, '42200108', 'TAD3-60-15', 35, 60, 3193, 'D', 15, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(136, '42200109', 'TAD3-60-16', 35, 60, 3384, 'D', 16, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(137, '42200110', 'TAD3-60-17', 35, 60, 3569, 'D', 17, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(138, '42200111', 'TAD3-60-18', 35, 60, 3755, 'D', 18, 10.2, 1.45, 3.52, 4.74, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(139, '22000000', '---', 10, 0, 0, 'D', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-11-28 17:52:34'),
(140, '32000000', '---', 20, 0, 0, 'D', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(141, '42000000', '---', 35, 0, 0, 'D', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(142, '52000000', '---', 110, 0, 0, 'D', 0, 0, 0, 0, 0, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(143, '51000301', 'S1-9', 110, 0, 1320, 'E', 9, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(144, '51000302', 'S1-10', 110, 0, 1390, 'E', 10, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(145, '51000303', 'S1-11', 110, 0, 1510, 'E', 11, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(146, '51000304', 'S1-12', 110, 0, 1630, 'E', 12, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(147, '51000305', 'S1-13', 110, 0, 1700, 'E', 13, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(148, '51000306', 'S1-14', 110, 0, 1780, 'E', 14, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(149, '51000307', 'S1-15', 110, 0, 1848, 'E', 15, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(150, '51000308', 'S1-16', 110, 0, 1946, 'E', 16, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(151, '51000309', 'S1-17', 110, 0, 2157, 'E', 17, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(152, '51000310', 'S1-18', 110, 0, 2254, 'E', 18, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(153, '51000311', 'S1-19', 110, 0, 2393, 'E', 19, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(154, '51000312', 'S1-20', 110, 0, 2544, 'E', 20, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(155, '51000313', 'S1-21', 110, 0, 2650, 'E', 21, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(156, '51000314', 'S1-22', 110, 0, 2788, 'E', 22, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(157, '51000315', 'S1-23', 110, 0, 2942, 'E', 23, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(158, '51000316', 'S1-24', 110, 0, 2962, 'E', 24, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(159, '51000317', 'S1-25', 110, 0, 3103, 'E', 25, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(160, '51000318', 'S1-26', 110, 0, 3254, 'E', 26, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(161, '51000319', 'S1-27', 110, 0, 3355, 'E', 27, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(162, '51000320', 'S1-28', 110, 0, 3493, 'E', 28, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(163, '51000321', 'S1-29', 110, 0, 3645, 'E', 29, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(164, '51000322', 'S1-30', 110, 0, 3798, 'E', 30, 7.5, 2.06, 4.6, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(165, '51100301', 'A1-150-9', 110, 30, 2743, 'E', 9, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(166, '51100302', 'A1-150-10', 110, 30, 2948, 'E', 10, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(167, '51100303', 'A1-150-11', 110, 30, 3078, 'E', 11, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(168, '51100304', 'A1-150-12', 110, 30, 3292, 'E', 12, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(169, '51100305', 'A1-150-13', 110, 30, 3443, 'E', 13, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(170, '51100306', 'A1-150-14', 110, 30, 3698, 'E', 14, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(171, '51100307', 'A1-150-15', 110, 30, 3813, 'E', 15, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(172, '51100308', 'A1-150-16', 110, 30, 3975, 'E', 16, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(173, '51100309', 'A1-150-17', 110, 30, 4197, 'E', 17, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(174, '51100310', 'A1-150-18', 110, 30, 4491, 'E', 18, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(175, '51100311', 'A1-150-19', 110, 30, 4653, 'E', 19, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(176, '51100312', 'A1-150-20', 110, 30, 4874, 'E', 20, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(177, '51100313', 'A1-150-21', 110, 30, 5076, 'E', 21, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(178, '51100314', 'A1-150-22', 110, 30, 5238, 'E', 22, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(179, '51100315', 'A1-150-23', 110, 30, 5460, 'E', 23, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(180, '51100316', 'A1-150-24', 110, 30, 5700, 'E', 24, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(181, '51100317', 'A1-150-25', 110, 30, 5862, 'E', 25, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(182, '51100318', 'A1-150-26', 110, 30, 6084, 'E', 26, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(183, '51100319', 'A1-150-27', 110, 30, 6272, 'E', 27, 9.7, 2.15, 4.87, 5.46, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(184, '51200301', 'A1-120-09', 110, 60, 3380, 'E', 9, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(185, '51200302', 'A1-120-10', 110, 60, 3550, 'E', 10, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(186, '51200303', 'A1-120-11', 110, 60, 3737, 'E', 11, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(187, '51200304', 'A1-120-12', 110, 60, 3924, 'E', 12, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(188, '51200305', 'A1-120-13', 110, 60, 4111, 'E', 13, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(189, '51200306', 'A1-120-14', 110, 60, 4298, 'E', 14, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(190, '51200307', 'A1-120-15', 110, 60, 4532, 'E', 15, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(191, '51200308', 'A1-120-16', 110, 60, 4724, 'E', 16, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(192, '51200309', 'A1-120-17', 110, 60, 4952, 'E', 17, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(193, '51200310', 'A1-120-18', 110, 60, 5235, 'E', 18, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(194, '51200311', 'A1-120-19', 110, 60, 5413, 'E', 19, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(195, '51200312', 'A1-120-20', 110, 60, 5627, 'E', 20, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(196, '51200313', 'A1-120-21', 110, 60, 5828, 'E', 21, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(197, '51200314', 'A1-120-22', 110, 60, 6073, 'E', 22, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(198, '51200315', 'A1-120-23', 110, 60, 6366, 'E', 23, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(199, '51200316', 'A1-120-24', 110, 60, 6710, 'E', 24, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(200, '51200317', 'A1-120-25', 110, 60, 7115, 'E', 25, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(201, '51200318', 'A1-120-26', 110, 60, 7590, 'E', 26, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(202, '51200319', 'A1-120-27', 110, 60, 8150, 'E', 27, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(203, '52000301', 'SD-12.85', 110, 0, 2332, 'D', 12.85, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(204, '52000302', 'SD-13.85', 110, 0, 2429, 'D', 13.85, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(205, '52000303', 'SD-14.80', 110, 0, 2650, 'D', 14.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(206, '52000304', 'SD-16.80', 110, 0, 2935, 'D', 16.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(207, '52000305', 'SD-17.80', 110, 0, 3022, 'D', 17.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(208, '52000306', 'SD-18.80', 110, 0, 3196, 'D', 18.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(209, '52000307', 'SD-19.80', 110, 0, 3373, 'D', 19.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(210, '52000308', 'SD-20.80', 110, 0, 3460, 'D', 20.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(211, '52000309', 'SD-21.80', 110, 0, 3634, 'D', 21.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(212, '52000310', 'SD-22.80', 110, 0, 3729, 'D', 22.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(213, '52000311', 'SD-23.80', 110, 0, 3817, 'D', 23.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(214, '52000312', 'SD-24.80', 110, 0, 3991, 'D', 24.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(215, '52000313', 'SD-25.80', 110, 0, 4252, 'D', 25.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(216, '52000314', 'SD-26.80', 110, 0, 4339, 'D', 26.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(217, '52000315', 'SD-27.80', 110, 0, 4514, 'D', 27.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(218, '52000316', 'SD-28.80', 110, 0, 4682, 'D', 28.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(219, '52000317', 'SD-29.80', 110, 0, 5182, 'D', 29.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(220, '52000318', 'SD-30.80', 110, 0, 5682, 'D', 30.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(221, '52000319', 'SD-31.80', 110, 0, 6182, 'D', 31.2, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(222, '52000320', 'SD-32.80', 110, 0, 6681, 'D', 32.8, 10.5, 2.05, 4.07, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(223, '52100301', 'AD-150-12', 110, 30, 3890, 'D', 12, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(224, '52100302', 'AD-150-13', 110, 30, 4169, 'D', 13, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(225, '52100303', 'AD-150-15', 110, 30, 4608, 'D', 15, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(226, '52100304', 'AD-150-16', 110, 30, 4769, 'D', 16, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(227, '52100305', 'AD-150-17', 110, 30, 5020, 'D', 17, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(228, '52100306', 'AD-150-18', 110, 30, 5438, 'D', 18, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(229, '52100307', 'AD-150-19', 110, 30, 5600, 'D', 19, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(230, '52100308', 'AD-150-20', 110, 30, 5852, 'D', 20, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(231, '52100309', 'AD-150-21', 110, 30, 6096, 'D', 21, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(232, '52100310', 'AD-150-22', 110, 30, 6258, 'D', 22, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(233, '52100311', 'AD-150-23', 110, 30, 6510, 'D', 23, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(234, '52100312', 'AD-150-24', 110, 30, 6863, 'D', 24, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(235, '52100313', 'AD-150-25', 110, 30, 7025, 'D', 25, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(236, '52100314', 'AD-150-26', 110, 30, 7275, 'D', 26, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(237, '52100315', 'AD-150-27', 110, 30, 7442, 'D', 27, 11.85, 2.15, 3.87, 5.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(238, '52200302', 'AD-120-13', 110, 60, 5234, 'D', 13, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(239, '52200304', 'AD-120-15', 110, 60, 5743, 'D', 15, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(240, '52200305', 'AD-120-16', 110, 60, 5935, 'D', 16, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(241, '52200306', 'AD-120-17', 110, 60, 6190, 'D', 17, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(242, '52200307', 'AD-120-18', 110, 60, 6517, 'D', 18, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(243, '52200308', 'AD-120-19', 110, 60, 6877, 'D', 19, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(244, '52200309', 'AD-120-20', 110, 60, 7190, 'D', 20, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(245, '52200310', 'AD-120-21', 110, 60, 7505, 'D', 21, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(246, '52200311', 'AD-120-22', 110, 60, 7593, 'D', 22, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(247, '52200312', 'AD-120-23', 110, 60, 7857, 'D', 23, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(248, '52200313', 'AD-120-24', 110, 60, 8339, 'D', 24, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(249, '52200314', 'AD-120-25', 110, 60, 8763, 'D', 25, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(250, '52200315', 'AD-120-26', 110, 60, 9106, 'D', 26, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(251, '52200316', 'AD-120-27', 110, 60, 9494, 'D', 27, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(252, '31000201', 'PD-7,05', 20, 0, 358, 'E', 7.05, 1.8, 1, 2.35, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(253, '31100201', 'P-2D-7,60', 20, 30, 563, 'E', 7.6, 1.5, 1, 2.19, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(254, '31100202', 'P-2D-9,20', 20, 30, 645, 'E', 9.2, 1.5, 1, 2.19, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(255, '31100203', 'P-2D-10,80', 20, 30, 728, 'E', 10.28, 1.5, 1, 2.19, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(256, '31100204', 'P-2D-12,93', 20, 30, 876, 'E', 12.93, 1.5, 1, 2.19, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(257, '31200301', 'P-1D-7,60', 20, 60, 594, 'E', 7.6, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(258, '31200302', 'P-1D-9,20', 20, 60, 699, 'E', 9.2, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(259, '31200303', 'P-1D-10,80', 20, 60, 779, 'E', 10.8, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(260, '31200304', 'P-1D-12,93', 20, 60, 927, 'E', 12.93, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(261, '31000202', 'PD-8,7', 20, 0, 425, 'E', 8.7, 1.8, 1, 2.35, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(262, '31000203', 'PD-10,25', 20, 0, 476, 'E', 10.25, 1.8, 1, 2.35, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(263, '31000204', 'PD-12,52', 20, 0, 563, 'E', 12.52, 1.8, 1, 2.35, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(264, '31000401', 'AS-8,93', 20, 0, 578, 'E', 8.93, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(265, '31000402', 'AS-10,10', 20, 0, 632, 'E', 10.1, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(266, '31000403', 'AS-11,13', 20, 0, 695, 'E', 11.13, 3.1, 1, 2.55, NULL, 'K', '', '20251212_092416_uo7k9bLl.png', 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-12-12 09:24:16'),
(267, '31000404', 'AS-12,03', 20, 0, 732, 'E', 12.03, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(268, '31000405', 'AS-13,50', 20, 0, 802, 'E', 13.5, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(269, '31000406', 'AS-14,21', 20, 0, 857, 'E', 14.21, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(270, '31000407', 'AS-16,05', 20, 0, 939, 'E', 16.05, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(271, '31000408', 'AS-18,26', 20, 0, 1093, 'E', 18.26, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(272, '31000409', 'AS-20,06', 20, 0, 1195, 'E', 20.06, 3.1, 1, 2.55, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(273, '31000501', 'B315N-12', 20, 0, NULL, 'E', 8.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(274, '31000502', 'B315N-13', 20, 0, NULL, 'E', 9.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(275, '31100501', 'B1050A40-12', 20, 40, NULL, 'E', 8.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(276, '31100502', 'B1050A40-13', 20, 40, NULL, 'E', 9.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(277, '31200501', 'B1520A60-12', 20, 60, NULL, 'E', 8.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(278, '31200502', 'B1520A60-13', 20, 60, NULL, 'E', 9.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(279, '31200601', 'B2250A60-12', 20, 60, NULL, 'E', 8.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(280, '31200602', 'B2250A60-13', 20, 60, NULL, 'E', 9.6, 1.4, 1, 1.87, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(281, '31000701', 'B315NL-12', 20, 0, NULL, 'E', 10, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(282, '31000702', 'B315NL-13', 20, 0, NULL, 'E', 11, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(283, '31100701', 'B1050A40L-12', 20, 40, NULL, 'E', 10, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(284, '31100702', 'B1050A40L-13', 20, 40, NULL, 'E', 11, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(285, '31200701', 'B1520A60L-12', 20, 60, NULL, 'E', 10, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(286, '31200702', 'B1520A60L-13', 20, 60, NULL, 'E', 11, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(287, '31200801', 'B2250A60L-12', 20, 60, NULL, 'E', 10, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(288, '31200802', 'B2250A60L-13', 20, 60, NULL, 'E', 11, NULL, NULL, 1.4, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(289, '31200201', 'P-1k-9,10', 20, 60, 570, 'E', 9.1, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(290, '31200202', 'P-1k-10,70', 20, 60, 664, 'E', 10.7, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(291, '31200203', 'P-1k-12,30', 20, 60, 774, 'E', 12.3, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(292, '31200204', 'P-1k-14,43', 20, 60, 915, 'E', 14.3, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(293, '31200401', 'P-1Dk-7,60', 20, 60, 594, 'E', 7.6, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(294, '31200402', 'P-1Dk-9,20', 20, 60, 699, 'E', 9.2, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(295, '31200403', 'P-1Dk-10,80', 20, 60, 779, 'E', 10.8, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(296, '31200404', 'P-1Dk-12,93', 20, 60, 927, 'E', 12.93, 1.5, 1.2, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(297, '31200201', 'P-1k-9,10', 20, 60, 570, 'E', 9.1, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(298, '31200202', 'P-1k-10,70', 20, 60, 664, 'E', 10.7, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(299, '31200203', 'P-1k-12,30', 20, 60, 774, 'E', 12.3, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(300, '31200204', 'P-1k-14,43', 20, 60, 915, 'E', 14.43, NULL, 1.2, 1.76, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(301, '31000901', 'CN1-8', 20, 0, 411, 'E', 8, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(302, '31000902', 'CN1-10', 20, 0, 518, 'E', 10, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(303, '31000903', 'CN1-12', 20, 0, 594, 'E', 12, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(304, '31000904', 'CN1-14', 20, 0, 693, 'E', 14, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(305, '31000905', 'CN1-16', 20, 0, 791, 'E', 16, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(306, '31100901', 'CA-150-8', 20, 30, 577, 'E', 8, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(307, '31100902', 'CA-150-10', 20, 30, 760, 'E', 10, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(308, '31100903', 'CA-150-12', 20, 30, 915, 'E', 12, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(309, '31100904', 'CA-150-14', 20, 30, 1100, 'E', 14, 1.95, 1, 2.31, 0, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(310, '31100905', 'CA-150-16', 20, 30, 1247, 'E', 16, 1.95, 1, 2.31, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(311, '31200901', 'CA-120-8', 20, 60, 730, 'E', 8, 1.95, 1, 2.37, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(312, '31200902', 'CA-120-10', 20, 60, 882, 'E', 10, 1.95, 1, 2.37, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(313, '31200903', 'CA-120-12', 20, 60, 1068, 'E', 12, 1.95, 1, 2.37, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(314, '31200904', 'CA-120-14', 20, 60, 1275, 'E', 14, 1.95, 1, 2.37, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(315, '31200905', 'CA-120-16', 20, 60, 1471, 'E', 16, 1.95, 1, 2.37, NULL, 'H', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(316, '32000101', 'DCN1-8', 20, 0, 717, 'D', 8, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(317, '32000102', 'DCN1-10', 20, 0, 827, 'D', 10, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(318, '32000103', 'DCN1-12', 20, 0, 937, 'D', 12, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(319, '32000104', 'DCN1-13', 20, 0, 997, 'D', 13, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(320, '32000105', 'DCN1-14', 20, 0, 1088, 'D', 14, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(321, '32000106', 'DCN1-15', 20, 0, 1179, 'D', 15, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(322, '32000107', 'DCN1-16', 20, 0, 1225, 'D', 16, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(323, '32000108', 'DCN1-17', 20, 0, 1358, 'D', 17, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(324, '32000109', 'DCN1-18', 20, 0, 1445, 'D', 18, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(325, '32000110', 'DCN1-19', 20, 0, 1585, 'D', 19, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(326, '32100101', 'DCA-150-8', 20, 30, 1116, 'D', 8, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(327, '32100102', 'DCA-150-10', 20, 30, 1321, 'D', 10, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(328, '32100103', 'DCA-150-12', 20, 30, 1495, 'D', 12, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(329, '32100104', 'DCA-150-14', 20, 30, 1723, 'D', 14, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(330, '32100105', 'DCA-150-16', 20, 30, 1890, 'D', 16, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(331, '32200101', 'DCA-120-8', 20, 60, 1285, 'D', 8, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(332, '32200102', 'DCA-120-10', 20, 60, 1512, 'D', 10, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(333, '32200103', 'DCA-120-12', 20, 60, 1693, 'D', 12, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(334, '32200104', 'DCA-120-14', 20, 60, 1937, 'D', 14, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(335, '32200105', 'DCA-120-16', 20, 60, 2152, 'D', 16, 4.4, 1, 1.97, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(336, '42000201', 'ND-10', 35, 0, 1080, 'D', 10, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(337, '42000202', 'ND-11,5', 35, 0, 1194, 'D', 11.5, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55');
INSERT INTO `towers` (`id`, `sif`, `type`, `voltage`, `angle`, `mass`, `vid`, `vis`, `vig`, `mhr`, `dkp`, `dkz`, `rap`, `raz`, `picture`, `active`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(338, '42000203', 'ND-13', 35, 0, 1280, 'D', 13, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(339, '42000204', 'ND-14,5', 35, 0, 1405, 'D', 14.5, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(340, '42000205', 'ND-16', 35, 0, 1478, 'D', 16, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(341, '42000206', 'ND-17,5', 35, 0, 1566, 'D', 17.5, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(342, '42000207', 'ND-19', 35, 0, 1665, 'D', 19, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(343, '42000208', 'ND-20,5', 35, 0, 1791, 'D', 20.5, 8.5, 1.2, 3.02, 3.02, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(344, '42100201', '3ZD-10', 35, 30, 1861, 'D', 10, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(345, '42100202', '3ZD-11,5', 35, 30, 1998, 'D', 11.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(346, '42100203', '3ZD-13', 35, 30, 2133, 'D', 13, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(347, '42100204', '3ZD-14,5', 35, 30, 2303, 'D', 14.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(348, '42100205', '3ZD-16', 35, 30, 2474, 'D', 16, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(349, '42100206', '3ZD-17,5', 35, 30, 2641, 'D', 17.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(350, '42100207', '3ZD-19', 35, 30, 2840, 'D', 19, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(351, '42100208', '3ZD-20,5', 35, 30, 3027, 'D', 20.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(352, '42200201', '6ZD-10', 35, 60, 2133, 'D', 10, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(353, '42200202', '6ZD-11,5', 35, 60, 2287, 'D', 11.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(354, '42200203', '6ZD-13', 35, 60, 2443, 'D', 13, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(355, '42200204', '6ZD-14,5', 35, 60, 2669, 'D', 14.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(356, '42200205', '6ZD-16', 35, 60, 2875, 'D', 16, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(357, '42200206', '6ZD-17,5', 35, 60, 3061, 'D', 17.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(358, '42200207', '6ZD-19', 35, 60, 3380, 'D', 19, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(359, '42200208', '6ZD-20,5', 35, 60, 3610, 'D', 20.5, 9, 1.2, 3.01, 3.44, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(360, '41000302', 'BN-12,7', 35, 0, NULL, 'E', 12.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(361, '41000303', 'BN-13,7', 35, 0, NULL, 'E', 13.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(362, '41000304', 'BN-14,7', 35, 0, NULL, 'E', 14.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(363, '41000305', 'BN-15,7', 35, 0, NULL, 'E', 15.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(364, '41200301', 'BAZ-40-11,7', 35, 40, NULL, 'E', 11.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(365, '41200302', 'BAZ-40-12,7', 35, 40, NULL, 'E', 12.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(366, '41200303', 'BAZ-40-13,7', 35, 40, NULL, 'E', 13.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(367, '41200304', 'BAZ-40-14,7', 35, 40, NULL, 'E', 14.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(368, '41000401', 'BNz-10,5', 35, 0, NULL, 'E', 10.5, 4.7, 1.05, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(369, '41000402', 'BNz-11,5', 35, 0, NULL, 'E', 11.5, 4.7, 1.05, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(370, '41000403', 'BNz-12,5', 35, 0, NULL, 'E', 12.5, 4.7, 1.05, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(371, '41000404', 'BNz-13,5', 35, 0, NULL, 'E', 13.5, 4.7, 1.05, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(372, '41000405', 'BNz-14,5', 35, 0, NULL, 'E', 14.5, 4.7, 1.05, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(373, '41100401', 'BAZz-20-9,9', 35, 20, NULL, 'E', 9.9, 5.3, 0.96, 3.21, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(374, '41100402', 'BAZz-20-10,7', 35, 20, NULL, 'E', 10.7, 5.3, 0.96, 3.21, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(375, '41100403', 'BAZz-20-11,9', 35, 20, NULL, 'E', 11.9, 5.3, 0.96, 3.21, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(376, '41100404', 'BAZz-20-12,2', 35, 20, NULL, 'E', 12.2, 5.3, 0.96, 3.21, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(377, '41100405', 'BAZz-20-13,9', 35, 20, NULL, 'E', 13.9, 5.3, 0.96, 3.2, 1.92, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(378, '41200601', 'BAZz-40-9,9', 35, 40, NULL, 'E', 9.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(379, '41200602', 'BAZz-40-10,7', 35, 40, NULL, 'E', 10.7, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(380, '41200603', 'BAZz-40-11,9', 35, 40, NULL, 'E', 11.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(381, '41200604', 'BAZz-40-12,2', 35, 40, NULL, 'E', 12.2, 5.3, 0.96, 3.21, 2.3, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(382, '41200605', 'BAZz-40-13,9', 35, 40, NULL, 'E', 13.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(383, '41300701', 'BAZz-60-9,9', 35, 60, NULL, 'E', 9.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(384, '41300702', 'BAZz-60-10,7', 35, 60, NULL, 'E', 10.7, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(385, '41300703', 'BAZz-60-11,9', 35, 60, NULL, 'E', 11.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(386, '41300704', 'BAZz-60-12,2', 35, 60, NULL, 'E', 12.2, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(387, '41300705', 'BAZz-60-13,9', 35, 60, NULL, 'E', 13.9, 5.3, 0.96, 3.21, 2.37, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(388, '41200305', 'BAZ-40-15,7', 35, 40, NULL, 'E', 15.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(389, '41100301', 'BAZ-20-11,7', 35, 20, NULL, 'E', 11.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(390, '41100302', 'BAZ-20-12,7', 35, 20, NULL, 'E', 12.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(391, '41100303', 'BAZ-20-13,7', 35, 20, NULL, 'E', 13.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(392, '41100304', 'BAZ-20-14,7', 35, 20, NULL, 'E', 14.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(393, '41100305', 'BAZ-20-15,7', 35, 20, NULL, 'E', 15.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(394, '41300401', 'BAZ-60-11,7', 35, 60, NULL, 'E', 11.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(395, '41300402', 'BAZ-60-12,7', 35, 60, NULL, 'E', 12.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(396, '41300403', 'BAZ-60-13,7', 35, 60, NULL, 'E', 13.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(397, '41300404', 'BAZ-60-14,7', 35, 60, NULL, 'E', 14.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(398, '41300405', 'BAZ-60-15,7', 35, 60, NULL, 'E', 15.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(399, '41400101', 'BZK-11,7', 35, 1, NULL, 'E', 11.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(400, '41400102', 'BZK-12,7', 35, 1, NULL, 'E', 12.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(401, '41400103', 'BZK-13,7', 35, 1, NULL, 'E', 13.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(402, '41400104', 'BZK-14,7', 35, 1, NULL, 'E', 14.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(403, '41400105', 'BZK-15,7', 35, 1, NULL, 'E', 15.7, 3.2, 1, 3.2, NULL, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(404, '41400201', 'BZKz-9,9', 35, 1, NULL, 'E', 9.9, 5.3, 1, 3.2, 2.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(405, '41400202', 'BZKz-10,9', 35, 1, NULL, 'E', 10.9, 5.3, 1, 3.2, 2.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(406, '41400203', 'BZKz-11,9', 35, 1, NULL, 'E', 11.9, 5.3, 1, 3.2, 2.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(407, '41400204', 'BZKz-12,9', 35, 1, NULL, 'E', 12.9, 5.3, 1, 3.2, 2.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(408, '41400205', 'BZKz-13,9', 35, 1, NULL, 'E', 13.9, 5.3, 1, 3.2, 2.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(409, '41000301', 'BN-11,7', 35, 0, NULL, 'E', 11.7, 3.2, 1, 3.2, 0, 'K', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(410, '52200401', 'Port-D-8-11', 110, 60, NULL, 'D', 8, 3, 2, 2, 4.03, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(411, '71000201', 'N-2-17.5', 400, 0, 5036, 'E', 17.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(412, '71000202', 'N-2-19.5', 400, 0, 5425, 'E', 19.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(413, '71000000', '---', 400, NULL, NULL, 'E', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(414, '71000203', 'N-2-21.5', 400, 0, 5685, 'E', 21.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(415, '71000204', 'N-2-23.9', 400, 0, 6245, 'E', 23.9, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(416, '71000205', 'N-2-26.3', 400, 0, 6545, 'E', 26.3, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(417, '71000206', 'N-2-28.8', 400, 0, 7208, 'E', 28.8, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(418, '71000207', 'N-2-31.3', 400, 0, 7440, 'E', 31.3, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(419, '71000208', 'N-2-33.9', 400, 0, 8285, 'E', 33.9, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(420, '71000209', 'N-2-36.5', 400, 0, 8588, 'E', 36.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(421, '71000210', 'N-2-39.25', 400, 0, 9683, 'E', 39.25, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(422, '71000211', 'N-2-42.0', 400, 0, 10228, 'E', 42, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(423, '71000301', 'N-3-17.5', 400, 0, 5242, 'E', 17.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(424, '71000302', 'N-3-19.5', 400, 0, 5775, 'E', 19.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(425, '71000303', 'N-3-21.5', 400, 0, 6058, 'E', 21.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(426, '71000304', 'N-3-23.9', 400, 0, 6574, 'E', 23.9, 3.5, 3.94, 8.04, 4.6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(427, '71000305', 'N-3-26.3', 400, 0, 6847, 'E', 26.3, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(428, '71000306', 'N-3-28.8', 400, 0, 7576, 'E', 28.8, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(429, '71000307', 'N-3-31.3', 400, 0, 7827, 'E', 31.3, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(430, '71000308', 'N-3-33.9', 400, 0, 8790, 'E', 33.9, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(431, '71000309', 'N-3-36.5', 400, 0, 9127, 'E', 36.5, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(432, '71000310', 'N-3-39.25', 400, 0, 10022, 'E', 39.25, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(433, '71000311', 'N-3-42.0', 400, 0, 10667, 'E', 42, 3.5, 3.94, 8.04, 4.6, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(434, '71000401', 'N-4-17.5', 400, 0, 6269, 'E', 17.5, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(435, '71000402', 'N-4-19.5', 400, 0, 6777, 'E', 19.5, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(436, '71000403', 'N-4-21.5', 400, 0, 7143, 'E', 21.5, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(437, '71000404', 'N-4-23.9', 400, 0, 7758, 'E', 23.9, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(438, '71000405', 'N-4-26.3', 400, 0, 8173, 'E', 26.3, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(439, '71000406', 'N-4-28.8', 400, 0, 9086, 'E', 28.8, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(440, '71000407', 'N-4-31.3', 400, 0, 9397, 'E', 31.3, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(441, '71000408', 'N-4-33.9', 400, 0, 10462, 'E', 33.9, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(442, '71000409', 'N-4-36.5', 400, 0, 10953, 'E', 36.5, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(443, '71000410', 'N-4-39.25', 400, 0, 12278, 'E', 39.25, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(444, '71000411', 'N-4-42.0', 400, 0, 12885, 'E', 42, 3.5, 4.13, 8.34, 4.8, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(445, '71100101', 'AZ1-10-17.0', 400, 10, 8972, 'E', 17, 6.5, 4.13, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(446, '71100102', 'AZ1-10-19.3', 400, 10, 10022, 'E', 19.3, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(447, '71100103', 'AZ1-10-21.6', 400, 10, 10485, 'E', 21.6, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(448, '71100104', 'AZ1-10-24.3', 400, 10, 10485, 'E', 24.3, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(449, '71100105', 'AZ1-10-27.0', 400, 10, 13534, 'E', 27, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(450, '71100106', 'AZ1-10-30.0', 400, 10, 14926, 'E', 30, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(451, '71100107', 'AZ1-10-33.0', 400, 10, 16218, 'E', 33, 6.5, 3.3, 8.17, 7.15, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(452, '71200101', 'AZ2-30-17.0', 400, 30, 11162, 'E', 17, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(453, '71200102', 'AZ2-30-19.3', 400, 30, 12285, 'E', 19.3, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(454, '71200103', 'AZ2-30-21.6', 400, 30, 12714, 'E', 21.6, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(455, '71200104', 'AZ2-30-24.3', 400, 30, 13682, 'E', 24.3, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(456, '71200105', 'AZ2-30-27.0', 400, 30, 14762, 'E', 27, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(457, '71200106', 'AZ2-30-30.0', 400, 30, 15947, 'E', 30, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(458, '71200107', 'AZ2-30-33.0', 400, 30, 17136, 'E', 33, 6.5, 3.9, 8.97, 7.2, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(459, '71300101', 'AZ3-50-17.0', 400, 50, 12329, 'E', 17, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(460, '71300102', 'AZ3-50-19.3', 400, 50, 13481, 'E', 19.3, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(461, '71300103', 'AZ3-50-21.6', 400, 50, 13938, 'E', 21.6, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(462, '71300104', 'AZ3-50-24.3', 400, 50, 15539, 'E', 24.3, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(463, '71300105', 'AZ3-50-27.0', 400, 50, 16467, 'E', 27, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(464, '71300106', 'AZ3-50-30.0', 400, 50, 17395, 'E', 30, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(465, '71300107', 'AZ3-50-33.0', 400, 50, 18774, 'E', 33, 6.5, 3.9, 9.17, 7.3, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(466, '71400101', 'AZ4-60-17.0', 400, 60, 15123, 'E', 17, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(467, '71400102', 'AZ4-60-19.3', 400, 60, 16834, 'E', 19.3, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(468, '71400103', 'AZ4-60-21.6', 400, 60, 17203, 'E', 21.6, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(469, '71400104', 'AZ4-60-24.3', 400, 60, 19126, 'E', 24.3, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(470, '71400105', 'AZ4-60-27.0', 400, 60, 20548, 'E', 27, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(471, '71400106', 'AZ4-60-30.0', 400, 60, 22092, 'E', 30, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(472, '71400107', 'AZ4-60-33.0', 400, 60, 23747, 'E', 33, 6.5, 4.2, 9.57, 7.38, 'H', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(473, '51000401', 'S2-9', 110, 0, 1422, 'E', 9, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(474, '51000402', 'S2-10', 110, NULL, 1490, 'E', 10, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(475, '51000403', 'S2-11', 110, NULL, 1658, 'E', 11, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(476, '51000404', 'S2-12', 110, NULL, 1705, 'E', 12, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(477, '51000405', 'S2-13', 110, NULL, 1772, 'E', 13, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(478, '51000406', 'S2-14', 110, NULL, 1913, 'E', 14, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(479, '51000407', 'S2-15', 110, NULL, 1982, 'E', 15, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(480, '51000408', 'S2-16', 110, NULL, 2105, 'E', 16, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(481, '51000409', 'S2-17', 110, NULL, 2347, 'E', 17, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(482, '51000410', 'S2-18', 110, NULL, 2443, 'E', 18, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(483, '51000411', 'S2-19', 110, NULL, 2585, 'E', 19, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(484, '51000412', 'S2-20', 110, NULL, 2717, 'E', 20, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(485, '51000413', 'S2-21', 110, NULL, 2874, 'E', 21, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(486, '51000414', 'S2-22', 110, NULL, 3016, 'E', 22, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(487, '51000415', 'S2-23', 110, NULL, 3148, 'E', 23, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(488, '51000416', 'S2-24', 110, NULL, 3217, 'E', 24, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(489, '51000417', 'S2-25', 110, NULL, 3359, 'E', 25, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(490, '51000418', 'S2-26', 110, NULL, 3491, 'E', 26, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(491, '51000419', 'S2-27', 110, NULL, 3613, 'E', 27, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(492, '51000420', 'S2-28', 110, NULL, 3755, 'E', 28, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(493, '51000421', 'S2-29', 110, NULL, 3887, 'E', 29, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(494, '51000422', 'S2-30', 110, NULL, 4057, 'E', 30, 8, 2.16, 4.89, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(495, '51000501', 'S3-9', 110, NULL, 1550, 'E', 9, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(496, '51000502', 'S3-10', 110, 0, 1630, 'E', 10, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(497, '51000503', 'S3-11', 110, NULL, 1850, 'E', 11, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(498, '51000504', 'S3-12', 110, NULL, 1900, 'E', 12, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(499, '51000505', 'S3-13', 110, NULL, 1970, 'E', 13, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(500, '51000506', 'S3-14', 110, NULL, 2150, 'E', 14, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(501, '51000507', 'S3-15', 110, NULL, 2230, 'E', 15, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(502, '51000508', 'S3-16', 110, NULL, 2310, 'E', 16, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(503, '51000509', 'S3-17', 110, NULL, 2532, 'E', 17, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(504, '51000510', 'S3-18', 110, NULL, 2635, 'E', 18, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(505, '51000511', 'S3-19', 110, NULL, 2772, 'E', 19, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(506, '51000512', 'S3-20', 110, NULL, 2956, 'E', 20, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(507, '51000513', 'S3-21', 110, NULL, 3072, 'E', 21, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(508, '51000514', 'S3-22', 110, NULL, 3206, 'E', 22, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(509, '51000515', 'S3-23', 110, NULL, 3391, 'E', 23, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(510, '51000516', 'S3-24', 110, NULL, 3485, 'E', 24, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(511, '51000517', 'S3-25', 110, NULL, 3654, 'E', 25, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(512, '51000518', 'S3-26', 110, NULL, 3755, 'E', 26, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(513, '51000519', 'S3-27', 110, NULL, 3924, 'E', 27, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(514, '51000520', 'S3-28', 110, NULL, 4062, 'E', 28, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(515, '51000521', 'S3-29', 110, NULL, 4245, 'E', 29, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(516, '51000522', 'S3-30', 110, NULL, 4426, 'E', 30, 8.5, 2.22, 5.18, 4.4, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(517, '51000601', 'J2-13.2', 110, NULL, 1616.3, 'E', 13.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(518, '51000602', 'J2-14.2', 110, NULL, 1770.21, 'E', 14.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(519, '51000603', 'J2-15.2', 110, NULL, 1855.81, 'E', 15.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(520, '51000604', 'J2-16.2', 110, NULL, 1952.89, 'E', 16.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(521, '51000605', 'J2-19.2', 110, NULL, 2175.81, 'E', 19.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(522, '51000606', 'J2-20.2', 110, NULL, 2360.8, 'E', 20.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(523, '51000607', 'J2-21.2', 110, NULL, 2458.51, 'E', 21.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(524, '51000608', 'J2-22.2', 110, NULL, 2539.87, 'E', 22.2, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(525, '51000609', 'J2-23.8', 110, NULL, 2658.67, 'E', 23.8, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(526, '51000610', 'J2-25.3', 110, NULL, 2918.76, 'E', 25.3, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(527, '51000611', 'J2-26.8', 110, NULL, 3052.56, 'E', 26.8, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(528, '51000612', 'J2-28.4', 110, NULL, 3323.04, 'E', 28.4, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(529, '51000613', 'J2-29.9', 110, NULL, 3635.59, 'E', 29.9, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(530, '51000614', 'J2-31.4', 110, NULL, 3827.35, 'E', 31.4, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(531, '51000615', 'J2-32.9', 110, NULL, 4109.51, 'E', 32.9, 7.4, 2.1, 4.46, 3.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(532, '51000701', 'J4-13.2', 110, NULL, 1862.31, 'E', 13.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(533, '51000702', 'J4-14.2', 110, NULL, 2031.18, 'E', 14.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(534, '51000703', 'J4-15.2', 110, NULL, 2123.74, 'E', 15.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(535, '51000704', 'J4-16.2', 110, NULL, 2247.22, 'E', 16.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(536, '51000705', 'J4-19.2', 110, NULL, 2448.53, 'E', 19.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(537, '51000706', 'J4-20.2', 110, NULL, 2645.49, 'E', 20.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(538, '51000707', 'J4-21.2', 110, NULL, 2743.33, 'E', 21.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(539, '51000708', 'J4-22.2', 110, NULL, 2870.97, 'E', 22.2, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(540, '51000709', 'J4-23.8', 110, NULL, 3018.57, 'E', 23.8, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(541, '51000710', 'J4-25.3', 110, NULL, 3315.75, 'E', 25.3, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(542, '51000711', 'J4-26.8', 110, NULL, 3499.51, 'E', 26.8, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(543, '51000712', 'J4-28.4', 110, NULL, 3675.9, 'E', 28.4, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(544, '51000713', 'J4-29.9', 110, NULL, 4010.05, 'E', 29.9, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(545, '51000714', 'J4-31.4', 110, NULL, 4223.37, 'E', 31.4, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(546, '51000715', 'J4-32.9', 110, NULL, 4563.13, 'E', 32.9, 8.4, 2.2, 5.25, 4.18, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(547, '51000801', 'J6-13.2', 110, NULL, 2040.32, 'E', 13.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(548, '51000802', 'J6-14.2', 110, NULL, 2276.36, 'E', 14.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(549, '51000803', 'J6-15.2', 110, NULL, 2382.12, 'E', 15.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(550, '51000804', 'J6-16.2', 110, NULL, 2530.32, 'E', 16.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(551, '51000805', 'J6-19.2', 110, NULL, 2747.17, 'E', 19.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(552, '51000806', 'J6-20.2', 110, NULL, 2993.57, 'E', 20.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(553, '51000807', 'J6-21.2', 110, NULL, 3083.57, 'E', 21.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(554, '51000808', 'J6-22.2', 110, NULL, 3237.49, 'E', 22.2, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(555, '51000809', 'J6-23.8', 110, NULL, 3395.88, 'E', 23.8, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(556, '51000810', 'J6-25.3', 110, NULL, 3725.78, 'E', 25.3, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(557, '51000811', 'J6-26.8', 110, NULL, 3940.86, 'E', 26.8, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(558, '51000812', 'J6-28.4', 110, NULL, 4119.85, 'E', 28.4, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(559, '51000813', 'J6-29.9', 110, NULL, 4486.3, 'E', 29.9, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(560, '51000814', 'J6-31.4', 110, NULL, 4710.3, 'E', 31.4, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(561, '51000815', 'J6-32.9', 110, NULL, 5069.74, 'E', 32.9, 8.59, 2.2, 5.47, 4.16, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(562, '51100601', 'J1-150-11.4', 110, 30, 3144.17, 'E', 11.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(563, '51100602', 'J1-150-12.4', 110, 30, 3471.53, 'E', 12.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(564, '51100603', 'J1-150-13.4', 110, 30, 3606.21, 'E', 12.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(565, '51100604', 'J1-150-14.4', 110, 30, 3755.85, 'E', 14.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(566, '51100605', 'J1-150-17.4', 110, 30, 4215.8, 'E', 17.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(567, '51100606', 'J1-150-18.4', 110, 30, 4634.25, 'E', 18.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(568, '51100607', 'J1-150-19.4', 110, 30, 4785.41, 'E', 19.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(569, '51100608', 'J1-150-20.4', 110, 30, 4957.25, 'E', 20.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(570, '51100609', 'J1-150-21.4', 110, 30, 5174.93, 'E', 21.4, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(571, '51100610', 'J1-150-22', 110, 30, 5369.57, 'E', 22, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(572, '51100611', 'J1-150-23.5', 110, 30, 5870.62, 'E', 23.5, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(573, '51100612', 'J1-150-25', 110, 30, 6137.42, 'E', 25, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(574, '51100613', 'J1-150-26.6', 110, 30, 6732.9, 'E', 26.6, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(575, '51100614', 'J1-150-28.1', 110, 30, 7271.26, 'E', 28.1, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(576, '51100615', 'J1-150-29.6', 110, 30, 7543.63, 'E', 29.6, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(577, '51100616', 'J1-150-31.1', 110, 30, 7915.21, 'E', 31.1, 8.86, 2, 5.34, 4.24, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(578, '51200601', 'J3-120-11.4', 110, 60, 3707.71, 'E', 11.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(579, '51200602', 'J3-120-12.4', 110, 60, 4082.78, 'E', 12.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(580, '51200603', 'J3-120-13.4', 110, 60, 4217.46, 'E', 13.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(581, '51200604', 'J3-120-14.4', 110, 60, 4367.1, 'E', 14.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(582, '51200605', 'J3-120-17.4', 110, 60, 4857.07, 'E', 17.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(583, '51200606', 'J3-120-18.4', 110, 60, 5566.97, 'E', 18.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(584, '51200607', 'J3-120-19.4', 110, 60, 5592.01, 'E', 19.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(585, '51200608', 'J3-120-20.4', 110, 60, 5723.73, 'E', 20.4, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(586, '51200609', 'J3-120-22.0', 110, 60, 6053.46, 'E', 22, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(587, '51200610', 'J3-120-23.5', 110, 60, 6856.49, 'E', 23.5, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(588, '51200611', 'J3-120-25.0', 110, 60, 7046.19, 'E', 25, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(589, '51200612', 'J3-120-26.6', 110, 60, 7203.41, 'E', 26.6, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(590, '51200613', 'J3-120-28.1', 110, 60, 8105.26, 'E', 28.1, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(591, '51200614', 'J3-120-29.6', 110, 60, 8437.54, 'E', 29.6, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(592, '51200615', 'J3-120-31.1', 110, 60, 8921.02, 'E', 31.1, 9.55, 2.1, 5.35, 5.05, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(593, '51200402', 'A1-120T-13', 110, 60, 5150, 'E', 13, 10.9, 2.75, 4.89, 6.34, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(594, '52200301', 'AD-120-12', 110, 60, 4864, 'D', 12, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(595, '52200303', 'AD-120-14', 110, 60, 5568, 'D', 14, 12.5, 2.25, 3.81, 6, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(596, '41000201', 'N-280-9.05', 35, 0, NULL, 'E', 9.05, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(597, '41000202', 'N-280-11', 35, NULL, NULL, 'E', 11, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(598, '41000203', 'N-280-13.25', 35, NULL, NULL, 'E', 13.25, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(599, '41000204', 'N-280-15.5', 35, NULL, NULL, 'E', 15.5, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(600, '41000205', 'N-280-17', 35, NULL, NULL, 'E', 17, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(601, '41000206', 'N-280-19.4', 35, NULL, NULL, 'E', 19.4, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(602, '41000207', 'N-280-22.1', 35, NULL, NULL, 'E', 22.1, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(603, '41000208', 'N-280-24', 35, NULL, NULL, 'E', 24, 7.2, 1, 4.2, 3.42, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(604, '41100201', 'AZ-20-7.88', 35, 20, NULL, 'E', 7.88, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(605, '41100202', 'AZ-20-10.05', 35, 20, NULL, 'E', 10.05, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(606, '41100203', 'AZ-20-12.52', 35, 20, NULL, 'E', 12.52, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(607, '41100204', 'AZ-20-14.26', 35, 20, NULL, 'E', 14.26, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(608, '41100205', 'AZ-20-16', 35, 20, NULL, 'E', 16, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(609, '41100206', 'AZ-20-18.17', 35, 20, NULL, 'E', 18.17, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(610, '41100207', 'AZ-20-20.34', 35, 20, NULL, 'E', 20.34, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(611, '41100208', 'AZ-20-23', 35, 20, NULL, 'E', 23, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(612, '41200201', 'AZ-40-8', 35, 40, NULL, 'E', 8, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(613, '41200202', 'AZ-40-9.95', 35, 40, NULL, 'E', 9.95, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(614, '41200203', 'AZ-40-11.9', 35, 40, NULL, 'E', 11.9, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(615, '41200204', 'AZ-40-13.95', 35, 40, NULL, 'E', 13.95, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(616, '41200205', 'AZ-40-16', 35, 40, NULL, 'E', 16, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(617, '41200206', 'AZ-40-18.25', 35, 40, NULL, 'E', 18.25, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(618, '41200207', 'AZ-40-20.5', 35, 40, NULL, 'E', 20.5, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(619, '41200208', 'AZ-40-23', 35, 40, NULL, 'E', 23, 7.8, 1, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(620, '41000601', 'E2-8.72', 35, NULL, 821.4, 'E', 8.72, 6.9, 1.2, 4.5, 2.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(621, '41000602', 'E2-10.3', 35, 0, 886.5, 'E', 10.3, 6.9, 1.2, 4.5, 2.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(622, '41000603', 'E2-14.3', 35, 0, 1113.2, 'E', 14.3, 6.9, 1.2, 4.5, 2.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(623, '41000604', 'E2-16.16', 35, NULL, 1225.8, 'E', 16.16, 6.9, 1.2, 4.5, 2.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(624, '41000605', 'E2-18.3', 35, NULL, 1347.2, 'E', 18.3, 6.9, 1.2, 4.5, 2.97, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(625, '41000701', 'E6-9.85', 35, NULL, 1028.6, 'E', 9.85, 7.4, 1.2, 4.21, 3.69, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(626, '41000702', 'E6-13.16', 35, NULL, 1232.9, 'E', 13.16, 7.4, 1.2, 4.21, 3.69, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(627, '41000703', 'E6-16.43', 35, NULL, 1440.1, 'E', 16.43, 7.4, 1.2, 4.21, 3.69, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(628, '41000704', 'E6-19.73', 35, NULL, 1706.4, 'E', 19.73, 7.4, 1.2, 4.21, 3.69, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(629, '41000705', 'E6-23.0', 35, NULL, 1966, 'E', 23, 7.4, 1.2, 4.21, 3.63, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(630, '41100601', 'E7-150-9.77', 35, 30, 1622.8, 'E', 9.77, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(631, '41100602', 'E7-150-11.23', 35, 30, 1798, 'E', 11.23, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(632, '41100603', 'E7-150-12.78', 35, 30, 1909, 'E', 12.78, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(633, '41100604', 'E7-150-14.43', 35, 30, 2092, 'E', 14.43, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(634, '41100605', 'E7-150-16.18', 35, 30, 2268.8, 'E', 16.18, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(635, '41100606', 'E7-150-18.04', 35, 30, 2505.5, 'E', 18.04, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(636, '41100607', 'E7-150-20.02', 35, 30, 2701.5, 'E', 20.02, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(637, '41100608', 'E7-150-22.12', 35, 30, 2948.5, 'E', 22.12, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(638, '41100609', 'E7-150-24.56', 35, 30, 3251, 'E', 24.56, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(639, '41100610', 'E7-150-27', 35, 30, 3528.5, 'E', 27, 7.75, 1.2, 4.41, 3.83, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(640, '41100621', 'KZ-20-7.88', 35, 20, NULL, 'E', 7.88, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(641, '41100622', 'KZ-20-10.05', 35, 20, NULL, 'E', 10.05, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(642, '41100623', 'KZ-20-12.52', 35, 20, NULL, 'E', 12.52, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(643, '41100624', 'KZ-20-14.26', 35, 20, NULL, 'E', 14.26, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(644, '41100625', 'KZ-20-16', 35, 20, NULL, 'E', 16, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(645, '41100626', 'KZ-20-18.17', 35, 20, NULL, 'E', 18.17, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(646, '41100627', 'KZ-20-20.34', 35, 20, NULL, 'E', 20.34, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(647, '41100628', 'KZ-20-23', 35, 20, NULL, 'E', 23, 8.05, 1.2, 4.1, 4.03, 'K', 'K', NULL, 1, 0, 1, 1, '2025-03-29 15:44:55', '2025-03-29 15:44:55'),
(654, '1', '1', 20, 1, 1, 'E', 1, 1, 1, 1, 1, 'H', 'V', '20251212_092722_VeaUEt1p.png', 1, 0, 1, 1, '2025-12-09 16:22:45', '2025-12-12 09:27:22'),
(656, '2', '2', 10, 2, 2, 'E', 2, 1, 2, 1, 2, 'V', 'V', '', 1, 0, 1, 1, '2025-12-09 17:00:45', '2025-12-10 08:12:37'),
(660, '', '1', 10, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', '20251209_170848_XYg.jpg', 1, 1, 1, 1, '2025-12-09 17:08:48', '2025-12-09 17:16:33'),
(661, '', '1', 10, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', '20251212_092625_rfyEpxh7.png', 1, 0, 1, 1, '2025-12-09 17:11:58', '2025-12-12 09:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `trafo`
--

CREATE TABLE `trafo` (
  `id` int UNSIGNED NOT NULL,
  `id_project` int NOT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `visna_p` varchar(20) DEFAULT NULL,
  `visina_zj` varchar(20) DEFAULT NULL,
  `hor_ras` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trafo`
--

INSERT INTO `trafo` (`id`, `id_project`, `ime`, `visna_p`, `visina_zj`, `hor_ras`, `created_at`, `updated_at`) VALUES
(6, 12, 'test13', NULL, NULL, NULL, '2025-11-03 07:58:39', '2025-11-03 07:58:39'),
(40, 14, NULL, NULL, NULL, NULL, '2025-11-10 05:51:43', '2025-11-10 05:51:43'),
(43, 11, NULL, NULL, NULL, NULL, '2025-12-08 13:02:39', '2025-12-08 13:02:39'),
(45, 15, 'Портал', '65', '66', '67', '2025-12-11 14:08:01', '2025-12-11 14:09:11'),
(46, 16, NULL, NULL, NULL, NULL, '2025-12-12 10:12:01', '2025-12-12 10:12:01'),
(47, 17, NULL, NULL, NULL, NULL, '2025-12-12 10:12:45', '2025-12-12 10:12:45'),
(48, 17, NULL, NULL, NULL, NULL, '2025-12-12 10:12:45', '2025-12-12 10:12:45'),
(49, 18, NULL, NULL, NULL, NULL, '2025-12-12 10:21:24', '2025-12-12 10:21:24'),
(50, 19, 'Трафостаница (Портал)', '5', '5', '5', '2025-12-12 10:34:47', '2025-12-12 10:37:56'),
(51, 20, 'Трафостаница (Портал)', '6', '9', '1', '2025-12-12 14:03:41', '2025-12-12 21:19:56'),
(52, 21, NULL, NULL, NULL, NULL, '2025-12-16 15:55:15', '2025-12-16 15:55:15'),
(53, 22, NULL, NULL, NULL, NULL, '2025-12-16 15:58:39', '2025-12-16 15:58:39'),
(54, 23, 'tedy', NULL, NULL, NULL, '2025-12-16 16:07:21', '2025-12-16 16:07:54'),
(55, 24, 'Tr', NULL, NULL, NULL, '2025-12-16 19:16:19', '2025-12-16 19:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `trasa`
--

CREATE TABLE `trasa` (
  `id` int UNSIGNED NOT NULL,
  `id_project` int NOT NULL,
  `stac_t` float DEFAULT NULL,
  `kota_t` float DEFAULT NULL,
  `x_t` float DEFAULT NULL,
  `agol_tr` float DEFAULT NULL,
  `id_tower` int DEFAULT NULL,
  `id_trafo` int DEFAULT NULL,
  `id_insulator1` int DEFAULT NULL,
  `id_insulator2` int DEFAULT NULL,
  `imported` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trasa`
--

INSERT INTO `trasa` (`id`, `id_project`, `stac_t`, `kota_t`, `x_t`, `agol_tr`, `id_tower`, `id_trafo`, `id_insulator1`, `id_insulator2`, `imported`, `created_at`, `updated_at`) VALUES
(5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-03 04:14:30', '2025-12-08 13:02:25'),
(6, 11, NULL, NULL, NULL, NULL, NULL, 43, NULL, NULL, 0, '2025-11-03 04:14:30', '2025-12-08 13:02:39'),
(7, 12, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 0, '2025-11-03 07:58:39', '2025-11-03 07:58:39'),
(8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-03 07:58:39', '2025-12-08 17:14:57'),
(9, 13, 0, NULL, NULL, NULL, 350, NULL, 85, NULL, 0, '2025-11-03 07:59:42', '2025-12-12 08:35:59'),
(10, 13, 300, 5, NULL, NULL, 44, NULL, 110, NULL, 0, '2025-11-03 07:59:42', '2025-12-12 08:35:59'),
(11, 14, NULL, NULL, NULL, NULL, NULL, 40, 78, NULL, 0, '2025-11-03 14:13:10', '2025-12-10 22:23:56'),
(12, 14, NULL, NULL, NULL, NULL, 2, NULL, 72, NULL, 0, '2025-11-03 14:13:10', '2025-12-10 22:23:56'),
(15, 14, 4, 4, NULL, 4, 5, NULL, 3, NULL, 0, '2025-11-09 11:02:45', '2025-11-09 11:02:45'),
(16, 14, 5, 5, NULL, 5, 5, NULL, 2, 5, 0, '2025-11-09 11:08:18', '2025-11-09 11:08:18'),
(31, 14, 400, 56, NULL, 6.87, 4, NULL, 2, 4, 0, '2025-11-09 12:07:31', '2025-11-09 12:07:31'),
(34, 14, NULL, NULL, NULL, NULL, 5, NULL, 2, 2, 0, '2025-11-09 17:41:53', '2025-11-09 17:41:53'),
(35, 14, 43, 43, NULL, 43, 5, NULL, 2, 5, 0, '2025-11-09 17:42:32', '2025-11-09 17:42:32'),
(37, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 17:45:40', '2025-11-09 17:45:40'),
(38, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 17:55:06', '2025-11-09 17:55:06'),
(39, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 17:56:46', '2025-11-09 17:56:46'),
(40, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 18:00:44', '2025-11-09 18:00:44'),
(41, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 19:24:09', '2025-11-09 19:24:09'),
(42, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 19:24:30', '2025-11-09 19:24:30'),
(43, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 19:27:02', '2025-11-09 19:27:02'),
(44, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-09 19:28:39', '2025-11-09 19:28:39'),
(45, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-10 06:07:04', '2025-11-10 06:07:04'),
(46, 15, 0, 87, NULL, 65, NULL, 45, 120, NULL, 0, '2025-11-10 12:20:46', '2025-12-11 14:09:11'),
(47, 15, 900, 45, NULL, NULL, 445, NULL, 5, NULL, 0, '2025-11-10 12:20:46', '2025-12-11 14:09:11'),
(48, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-10 12:35:59', '2025-11-10 12:35:59'),
(49, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-10 12:37:21', '2025-11-10 12:37:21'),
(61, 13, 3, 3, NULL, 3, 265, NULL, 72, 74, 0, '2025-12-11 07:49:38', '2025-12-11 07:49:38'),
(63, 13, 3, 3, NULL, 3, 265, NULL, 72, 74, 0, '2025-12-11 07:50:39', '2025-12-11 07:50:39'),
(64, 13, 2, 32, NULL, NULL, 344, NULL, NULL, NULL, 0, '2025-12-11 09:01:01', '2025-12-11 09:01:01'),
(67, 13, 0.5, 65, NULL, 65, NULL, NULL, NULL, NULL, 0, '2025-12-11 12:31:09', '2025-12-12 08:51:16'),
(68, 13, 0.5, 65, NULL, 65, NULL, NULL, NULL, NULL, 0, '2025-12-11 12:32:39', '2025-12-12 08:48:12'),
(74, 15, 45, 43, NULL, 55, 451, NULL, 127, 127, 0, '2025-12-11 14:10:16', '2025-12-11 14:10:16'),
(75, 13, 450.53, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(76, 13, 5.7, 16.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(77, 13, 7.65, 25.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(78, 13, 26.9, 90.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(79, 13, 25.46, 94.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(80, 13, 22, 113.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(81, 13, 22.26, 115.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(82, 13, 22.66, 119.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(83, 13, 24.5, 139.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(84, 13, 25.73, 150.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(85, 13, 28.44, 163.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(86, 13, 30.24, 178.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(87, 13, 31.65, 197.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(88, 13, 39.25, 231.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(89, 13, 41.41, 257.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(90, 13, 42.78, 268.56, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(91, 13, 45.72, 281.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(92, 13, 46.42, 285.36, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(93, 13, 47.47, 292.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-11 23:30:38', '2025-12-11 23:30:38'),
(95, 13, 0.6, 331.52, NULL, NULL, 654, NULL, 3, NULL, 0, '2025-12-11 23:30:38', '2025-12-12 08:53:37'),
(96, 16, NULL, NULL, NULL, NULL, NULL, 46, NULL, NULL, 0, '2025-12-12 10:12:01', '2025-12-12 10:12:01'),
(97, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:12:01', '2025-12-12 10:12:01'),
(98, 17, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 0, '2025-12-12 10:12:45', '2025-12-12 10:12:45'),
(99, 17, NULL, NULL, NULL, NULL, NULL, 48, NULL, NULL, 0, '2025-12-12 10:12:45', '2025-12-12 10:12:45'),
(100, 18, NULL, NULL, NULL, NULL, NULL, 49, NULL, NULL, 0, '2025-12-12 10:21:24', '2025-12-12 10:21:24'),
(101, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:21:24', '2025-12-12 10:21:24'),
(102, 19, 0, 2.34, NULL, NULL, NULL, 50, 85, NULL, 0, '2025-12-12 10:34:47', '2025-12-12 10:37:56'),
(103, 19, 9000, 5.8, NULL, NULL, 654, NULL, 85, NULL, 0, '2025-12-12 10:34:47', '2025-12-12 10:37:56'),
(105, 19, 16.25, 5.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(106, 19, 25.1, 7.65, NULL, NULL, 266, NULL, 116, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:39:15'),
(107, 19, 90.5, 26.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(108, 19, 94.8, 25.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(109, 19, 113.85, 22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(110, 19, 115.47, 22.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(111, 19, 119.48, 22.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(112, 19, 139.7, 24.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(113, 19, 150.46, 25.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(114, 19, 163.18, 28.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(115, 19, 178.7, 30.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(116, 19, 197.1, 31.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(117, 19, 231.72, 39.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(118, 19, 257.7, 41.41, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(119, 19, 268.56, 42.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(120, 19, 281.5, 45.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(121, 19, 285.36, 46.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(122, 19, 292.8, 47.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(123, 19, 311.5, 50.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(124, 19, 331.52, 54.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(125, 19, 333, 55.23, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(126, 19, 353.05, 62.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(127, 19, 383.38, 64.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(128, 19, 402.67, 69.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(129, 19, 418.9, 74.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(130, 19, 435.35, 76.08, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(131, 19, 458.3, 79.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(132, 19, 462.18, 80.37, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(133, 19, 481.32, 83.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(134, 19, 490.35, 84.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(135, 19, 507.87, 86.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(136, 19, 520.87, 88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(137, 19, 522.7, 88.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(138, 19, 543.74, 87.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(139, 19, 544.55, 87.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(140, 19, 551.93, 86.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(141, 19, 560.9, 85.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(142, 19, 561.7, 85.57, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(143, 19, 576.3, 82.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(144, 19, 577.24, 82.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(145, 19, 579.82, 81.89, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(146, 19, 600.8, 79.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(147, 19, 620.25, 80.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(148, 19, 621.23, 80.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(149, 19, 630.5, 78.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(150, 19, 639.87, 78.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(151, 19, 670.04, 71.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(152, 19, 692.82, 62.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(153, 19, 694.68, 61.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(154, 19, 696.11, 61.06, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(155, 19, 715.27, 55.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(156, 19, 726.34, 54.93, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(157, 19, 733.77, 54.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(158, 19, 743.97, 56.77, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(159, 19, 749.92, 58.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(160, 19, 751.47, 58.12, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(161, 19, 763.32, 56.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(162, 19, 772.53, 55.17, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(163, 19, 792.65, 47.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(164, 19, 797.6, 47.09, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(165, 19, 813.36, 44.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(166, 19, 830.44, 43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(167, 19, 835.84, 42.39, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(168, 19, 856.86, 43.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(169, 19, 862.55, 43.74, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(170, 19, 874.67, 43.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(171, 19, 894.3, 41.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(172, 19, 904.85, 41.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(173, 19, 913.05, 40.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(174, 19, 933.15, 38.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(175, 19, 934.47, 37.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(176, 19, 940.7, 40.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(177, 19, 953.03, 46.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(178, 19, 957.65, 47.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(179, 19, 961.78, 47.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(180, 19, 979.83, 47.33, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(181, 19, 1000.87, 40.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(182, 19, 1019.38, 38.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(183, 19, 1023.95, 38.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(184, 19, 1045.3, 37.14, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(185, 19, 1050.27, 36.76, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(186, 19, 1077.6, 34.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(187, 19, 1089.35, 34.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(188, 19, 1100.55, 33.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(189, 19, 1121.1, 33.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(190, 19, 1154.4, 37.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(191, 19, 1178.6, 42.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(192, 19, 1203.25, 47.84, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(193, 19, 1209.25, 48.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(194, 19, 1218.7, 49.87, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(195, 19, 1229.4, 51.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(196, 19, 1238, 52.64, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(197, 19, 1253.88, 49.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(198, 19, 1257.5, 49.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(199, 19, 1277.15, 43.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(200, 19, 1299.23, 37.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(201, 19, 1300.7, 37.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(202, 19, 1322.65, 32.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(203, 19, 1325.25, 31.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(204, 19, 1344.1, 26.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(205, 19, 1346.06, 26.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(206, 19, 1358, 23.83, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(207, 19, 1368.55, 21.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(208, 19, 1369.83, 21.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(209, 19, 1383.06, 18.35, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(210, 19, 1385, 17.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(211, 19, 1398.15, 14.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(212, 19, 1418.3, 9.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(213, 19, 1439.2, 3.94, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(214, 19, 1452.25, 1.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(215, 19, 1459.25, 0.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(216, 19, 1462.1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(217, 19, 1468.95, -0.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(218, 19, 1476.85, -2.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(219, 19, 1478.5, -3.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(220, 19, 1485.6, -7.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(221, 19, 1487.1, -8.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(222, 19, 1493.75, -9.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(223, 19, 1500.15, -10.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(224, 19, 1501.35, -10.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(225, 19, 1513.75, -9.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(226, 19, 1519.6, -8.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(227, 19, 1527.8, -6.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(228, 19, 1538.05, -4.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(229, 19, 1550.05, -1.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(230, 19, 1560.47, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(231, 19, 1566.32, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(232, 19, 1569.33, 2.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(233, 19, 1580.9, 5.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(234, 19, 1588.9, 7.16, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(235, 19, 1600.38, 9.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(236, 19, 1607.1, 10.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(237, 19, 1623.18, 14.02, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(238, 19, 1629.57, 15.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(239, 19, 1647.1, 14.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(240, 19, 1657.1, 14.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(241, 19, 1668, 14.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(242, 19, 1671.33, 14.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(243, 19, 1690.1, 13.49, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(244, 19, 1697.35, 12.86, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(245, 19, 1709.75, 12.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(246, 19, 1717.8, 10.51, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 10:38:25', '2025-12-12 10:38:25'),
(247, 20, 0, 4.53, NULL, 25, NULL, 51, 85, NULL, 0, '2025-12-12 14:03:41', '2025-12-12 21:19:56'),
(248, 20, 1717, 5.6, NULL, NULL, 266, NULL, 86, NULL, 0, '2025-12-12 14:03:41', '2025-12-12 21:19:56'),
(250, 20, 16.25, 5.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(251, 20, 25.1, 7.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(252, 20, 90.5, 26.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 21:40:12'),
(253, 20, 94.8, 25.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 17:52:36'),
(254, 20, 113.85, 22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(255, 20, 115.47, 22.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(256, 20, 119.48, 22.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(257, 20, 139.7, 24.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(258, 20, 150.46, 25.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(259, 20, 163.18, 28.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(260, 20, 178.7, 30.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(261, 20, 197.1, 31.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(262, 20, 231.72, 39.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(263, 20, 257.7, 41.41, NULL, NULL, 142, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-14 19:24:44'),
(264, 20, 268.56, 42.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(265, 20, 281.5, 45.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(266, 20, 285.36, 46.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(267, 20, 292.8, 47.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(268, 20, 311.5, 50.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(269, 20, 331.52, 54.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(270, 20, 333, 55.23, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(271, 20, 353.05, 62.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(272, 20, 383.38, 64.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(273, 20, 402.67, 69.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(274, 20, 418.9, 74.72, NULL, NULL, 515, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 19:42:09'),
(275, 20, 435.35, 76.08, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(276, 20, 458.3, 79.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(277, 20, 462.18, 80.37, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(278, 20, 481.32, 83.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(279, 20, 490.35, 84.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(280, 20, 507.87, 86.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(281, 20, 520.87, 88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(282, 20, 522.7, 88.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(283, 20, 543.74, 87.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(284, 20, 544.55, 87.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(285, 20, 551.93, 86.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(286, 20, 560.9, 85.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 20:21:56'),
(287, 20, 561.7, 85.57, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(288, 20, 576.3, 82.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(289, 20, 577.24, 82.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(290, 20, 579.82, 81.89, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(291, 20, 600.8, 79.2, NULL, NULL, 345, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-14 17:22:27'),
(292, 20, 620.25, 80.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(293, 20, 621.23, 80.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(294, 20, 630.5, 78.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(295, 20, 639.87, 78.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(296, 20, 670.04, 71.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(297, 20, 692.82, 62.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(298, 20, 694.68, 61.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(299, 20, 696.11, 61.06, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(300, 20, 715.27, 55.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(301, 20, 726.34, 54.93, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(302, 20, 733.77, 54.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(303, 20, 743.97, 56.77, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(304, 20, 749.92, 58.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(305, 20, 751.47, 58.12, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(306, 20, 763.32, 56.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(307, 20, 772.53, 55.17, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(308, 20, 792.65, 47.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(309, 20, 797.6, 47.09, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(310, 20, 813.36, 44.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(311, 20, 830.44, 43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(312, 20, 835.84, 42.39, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(313, 20, 856.86, 43.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(314, 20, 862.55, 43.74, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(315, 20, 874.67, 43.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 21:38:56'),
(316, 20, 894.3, 41.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(317, 20, 904.85, 41.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(318, 20, 913.05, 40.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(319, 20, 933.15, 38.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(320, 20, 934.47, 37.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(321, 20, 940.7, 40.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(322, 20, 953.03, 46.11, NULL, NULL, 501, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-15 03:28:42'),
(323, 20, 957.65, 47.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(324, 20, 961.78, 47.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(325, 20, 979.83, 47.33, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(326, 20, 1000.87, 40.67, NULL, NULL, 344, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 18:56:00'),
(327, 20, 1019.38, 38.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(328, 20, 1023.95, 38.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(329, 20, 1045.3, 37.14, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(330, 20, 1050.27, 36.76, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(331, 20, 1077.6, 34.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(332, 20, 1089.35, 34.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(333, 20, 1100.55, 33.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(334, 20, 1121.1, 33.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(335, 20, 1154.4, 37.5, NULL, NULL, 349, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-13 20:53:32'),
(336, 20, 1178.6, 42.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(337, 20, 1203.25, 47.84, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(338, 20, 1209.25, 48.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(339, 20, 1218.7, 49.87, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(340, 20, 1229.4, 51.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(341, 20, 1238, 52.64, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(342, 20, 1253.88, 49.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(343, 20, 1257.5, 49.07, NULL, NULL, 346, NULL, 85, 116, 0, '2025-12-12 14:08:59', '2025-12-14 20:28:07'),
(344, 20, 1277.15, 43.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(345, 20, 1299.23, 37.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(346, 20, 1300.7, 37.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(347, 20, 1322.65, 32.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(348, 20, 1325.25, 31.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(349, 20, 1344.1, 26.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(350, 20, 1346.06, 26.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(351, 20, 1358, 23.83, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(352, 20, 1368.55, 21.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(353, 20, 1369.83, 21.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(354, 20, 1383.06, 18.35, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(355, 20, 1385, 17.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(356, 20, 1398.15, 14.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(357, 20, 1418.3, 9.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(358, 20, 1439.2, 3.94, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(359, 20, 1452.25, 1.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(360, 20, 1459.25, 0.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(361, 20, 1462.1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(362, 20, 1468.95, -0.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(363, 20, 1476.85, -2.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(364, 20, 1478.5, -3.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(365, 20, 1485.6, -7.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(366, 20, 1487.1, -8.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(367, 20, 1493.75, -9.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(368, 20, 1500.15, -10.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(369, 20, 1501.35, -10.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(370, 20, 1513.75, -9.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(371, 20, 1519.6, -8.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(372, 20, 1527.8, -6.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(373, 20, 1538.05, -4.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(374, 20, 1550.05, -1.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(375, 20, 1560.47, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(376, 20, 1566.32, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(377, 20, 1569.33, 2.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(378, 20, 1580.9, 5.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(379, 20, 1588.9, 7.16, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(380, 20, 1600.38, 9.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(381, 20, 1607.1, 10.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(382, 20, 1623.18, 14.02, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(383, 20, 1629.57, 15.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(384, 20, 1647.1, 14.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(385, 20, 1657.1, 14.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(386, 20, 1668, 14.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(387, 20, 1671.33, 14.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(388, 20, 1690.1, 13.49, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(389, 20, 1697.35, 12.86, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(390, 20, 1709.75, 12.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(391, 20, 1717.8, 10.51, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-12 14:08:59', '2025-12-12 14:08:59'),
(392, 21, NULL, NULL, NULL, NULL, NULL, 52, NULL, NULL, 0, '2025-12-16 15:55:15', '2025-12-16 15:55:15'),
(393, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 15:55:15', '2025-12-16 15:55:15'),
(394, 22, NULL, NULL, NULL, NULL, NULL, 53, NULL, NULL, 0, '2025-12-16 15:58:39', '2025-12-16 16:02:11'),
(395, 22, 49, 50, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 15:58:39', '2025-12-16 16:02:11'),
(417, 22, 0, 4.53, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(418, 22, 16.25, 5.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(419, 22, 25.1, 7.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(420, 22, 90.5, 26.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(421, 22, 94.8, 25.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(422, 22, 113.85, 22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(423, 22, 115.47, 22.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(424, 22, 119.48, 22.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(425, 22, 139.7, 24.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(426, 22, 150.46, 25.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(427, 22, 163.18, 28.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(428, 22, 178.7, 30.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(429, 22, 197.1, 31.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(430, 22, 231.72, 39.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(431, 22, 257.7, 41.41, NULL, NULL, 101, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:41'),
(432, 22, 268.56, 42.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(433, 22, 281.5, 45.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(434, 22, 285.36, 46.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(435, 22, 292.8, 47.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(436, 22, 311.5, 50.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(437, 22, 331.52, 54.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(438, 22, 333, 55.23, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(439, 22, 353.05, 62.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(440, 22, 383.38, 64.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(441, 22, 402.67, 69.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(442, 22, 418.9, 74.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(443, 22, 435.35, 76.08, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(444, 22, 458.3, 79.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(445, 22, 462.18, 80.37, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(446, 22, 481.32, 83.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(447, 22, 490.35, 84.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(448, 22, 507.87, 86.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(449, 22, 520.87, 88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(450, 22, 522.7, 88.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(451, 22, 543.74, 87.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(452, 22, 544.55, 87.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(453, 22, 551.93, 86.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(454, 22, 560.9, 85.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(455, 22, 561.7, 85.57, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(456, 22, 576.3, 82.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(457, 22, 577.24, 82.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(458, 22, 579.82, 81.89, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(459, 22, 600.8, 79.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(460, 22, 620.25, 80.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(461, 22, 621.23, 80.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(462, 22, 630.5, 78.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(463, 22, 639.87, 78.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(464, 22, 670.04, 71.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(465, 22, 692.82, 62.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(466, 22, 694.68, 61.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(467, 22, 696.11, 61.06, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(468, 22, 715.27, 55.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(469, 22, 726.34, 54.93, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(470, 22, 733.77, 54.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(471, 22, 743.97, 56.77, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(472, 22, 749.92, 58.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(473, 22, 751.47, 58.12, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(474, 22, 763.32, 56.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(475, 22, 772.53, 55.17, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(476, 22, 792.65, 47.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(477, 22, 797.6, 47.09, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(478, 22, 813.36, 44.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(479, 22, 830.44, 43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(480, 22, 835.84, 42.39, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(481, 22, 856.86, 43.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(482, 22, 862.55, 43.74, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(483, 22, 874.67, 43.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(484, 22, 894.3, 41.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(485, 22, 904.85, 41.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(486, 22, 913.05, 40.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(487, 22, 933.15, 38.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(488, 22, 934.47, 37.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(489, 22, 940.7, 40.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(490, 22, 953.03, 46.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(491, 22, 957.65, 47.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(492, 22, 961.78, 47.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(493, 22, 979.83, 47.33, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(494, 22, 1000.87, 40.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(495, 22, 1019.38, 38.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(496, 22, 1023.95, 38.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(497, 22, 1045.3, 37.14, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(498, 22, 1050.27, 36.76, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(499, 22, 1077.6, 34.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(500, 22, 1089.35, 34.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(501, 22, 1100.55, 33.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(502, 22, 1121.1, 33.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(503, 22, 1154.4, 37.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(504, 22, 1178.6, 42.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(505, 22, 1203.25, 47.84, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(506, 22, 1209.25, 48.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(507, 22, 1218.7, 49.87, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(508, 22, 1229.4, 51.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(509, 22, 1238, 52.64, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(510, 22, 1253.88, 49.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(511, 22, 1257.5, 49.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(512, 22, 1277.15, 43.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(513, 22, 1299.23, 37.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(514, 22, 1300.7, 37.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(515, 22, 1322.65, 32.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(516, 22, 1325.25, 31.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(517, 22, 1344.1, 26.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(518, 22, 1346.06, 26.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(519, 22, 1358, 23.83, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(520, 22, 1368.55, 21.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(521, 22, 1369.83, 21.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(522, 22, 1383.06, 18.35, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(523, 22, 1385, 17.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(524, 22, 1398.15, 14.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(525, 22, 1418.3, 9.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(526, 22, 1439.2, 3.94, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(527, 22, 1452.25, 1.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(528, 22, 1459.25, 0.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12');
INSERT INTO `trasa` (`id`, `id_project`, `stac_t`, `kota_t`, `x_t`, `agol_tr`, `id_tower`, `id_trafo`, `id_insulator1`, `id_insulator2`, `imported`, `created_at`, `updated_at`) VALUES
(529, 22, 1462.1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(530, 22, 1468.95, -0.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(531, 22, 1476.85, -2.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(532, 22, 1478.5, -3.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(533, 22, 1485.6, -7.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(534, 22, 1487.1, -8.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(535, 22, 1493.75, -9.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(536, 22, 1500.15, -10.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(537, 22, 1501.35, -10.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(538, 22, 1513.75, -9.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(539, 22, 1519.6, -8.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(540, 22, 1527.8, -6.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(541, 22, 1538.05, -4.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(542, 22, 1550.05, -1.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(543, 22, 1560.47, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(544, 22, 1566.32, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(545, 22, 1569.33, 2.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(546, 22, 1580.9, 5.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(547, 22, 1588.9, 7.16, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(548, 22, 1600.38, 9.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(549, 22, 1607.1, 10.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(550, 22, 1623.18, 14.02, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(551, 22, 1629.57, 15.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(552, 22, 1647.1, 14.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(553, 22, 1657.1, 14.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(554, 22, 1668, 14.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(555, 22, 1671.33, 14.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(556, 22, 1690.1, 13.49, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(557, 22, 1697.35, 12.86, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(558, 22, 1709.75, 12.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(559, 22, 1717.8, 10.51, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:05:12', '2025-12-16 16:05:12'),
(560, 23, 0, 50, NULL, NULL, NULL, 54, NULL, NULL, 0, '2025-12-16 16:07:21', '2025-12-16 16:07:54'),
(561, 23, 1800, 50, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:07:21', '2025-12-16 16:07:54'),
(562, 23, 0, 4.53, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(563, 23, 16.25, 5.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(564, 23, 25.1, 7.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(565, 23, 90.5, 26.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(566, 23, 94.8, 25.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(567, 23, 113.85, 22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(568, 23, 115.47, 22.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(569, 23, 119.48, 22.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(570, 23, 139.7, 24.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(571, 23, 150.46, 25.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(572, 23, 163.18, 28.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(573, 23, 178.7, 30.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(574, 23, 197.1, 31.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(575, 23, 231.72, 39.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(576, 23, 257.7, 41.41, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(577, 23, 268.56, 42.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(578, 23, 281.5, 45.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(579, 23, 285.36, 46.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(580, 23, 292.8, 47.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(581, 23, 311.5, 50.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(582, 23, 331.52, 54.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(583, 23, 333, 55.23, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(584, 23, 353.05, 62.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(585, 23, 383.38, 64.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(586, 23, 402.67, 69.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(587, 23, 418.9, 74.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(588, 23, 435.35, 76.08, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(589, 23, 458.3, 79.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(590, 23, 462.18, 80.37, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(591, 23, 481.32, 83.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(592, 23, 490.35, 84.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(593, 23, 507.87, 86.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(594, 23, 520.87, 88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(595, 23, 522.7, 88.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(596, 23, 543.74, 87.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(597, 23, 544.55, 87.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(598, 23, 551.93, 86.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(599, 23, 560.9, 85.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(600, 23, 561.7, 85.57, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(601, 23, 576.3, 82.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(602, 23, 577.24, 82.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(603, 23, 579.82, 81.89, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(604, 23, 600.8, 79.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(605, 23, 620.25, 80.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(606, 23, 621.23, 80.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(607, 23, 630.5, 78.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(608, 23, 639.87, 78.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(609, 23, 670.04, 71.3, NULL, NULL, 346, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:52'),
(610, 23, 692.82, 62.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(611, 23, 694.68, 61.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(612, 23, 696.11, 61.06, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(613, 23, 715.27, 55.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(614, 23, 726.34, 54.93, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(615, 23, 733.77, 54.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(616, 23, 743.97, 56.77, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(617, 23, 749.92, 58.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(618, 23, 751.47, 58.12, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(619, 23, 763.32, 56.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(620, 23, 772.53, 55.17, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(621, 23, 792.65, 47.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(622, 23, 797.6, 47.09, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(623, 23, 813.36, 44.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(624, 23, 830.44, 43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(625, 23, 835.84, 42.39, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(626, 23, 856.86, 43.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(627, 23, 862.55, 43.74, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(628, 23, 874.67, 43.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(629, 23, 894.3, 41.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(630, 23, 904.85, 41.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(631, 23, 913.05, 40.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(632, 23, 933.15, 38.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(633, 23, 934.47, 37.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(634, 23, 940.7, 40.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(635, 23, 953.03, 46.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(636, 23, 957.65, 47.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(637, 23, 961.78, 47.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(638, 23, 979.83, 47.33, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(639, 23, 1000.87, 40.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(640, 23, 1019.38, 38.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(641, 23, 1023.95, 38.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(642, 23, 1045.3, 37.14, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(643, 23, 1050.27, 36.76, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(644, 23, 1077.6, 34.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(645, 23, 1089.35, 34.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(646, 23, 1100.55, 33.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(647, 23, 1121.1, 33.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(648, 23, 1154.4, 37.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(649, 23, 1178.6, 42.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(650, 23, 1203.25, 47.84, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(651, 23, 1209.25, 48.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(652, 23, 1218.7, 49.87, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(653, 23, 1229.4, 51.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(654, 23, 1238, 52.64, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(655, 23, 1253.88, 49.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(656, 23, 1257.5, 49.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(657, 23, 1277.15, 43.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(658, 23, 1299.23, 37.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(659, 23, 1300.7, 37.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(660, 23, 1322.65, 32.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(661, 23, 1325.25, 31.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(662, 23, 1344.1, 26.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(663, 23, 1346.06, 26.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(664, 23, 1358, 23.83, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(665, 23, 1368.55, 21.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(666, 23, 1369.83, 21.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(667, 23, 1383.06, 18.35, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(668, 23, 1385, 17.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(669, 23, 1398.15, 14.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(670, 23, 1418.3, 9.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(671, 23, 1439.2, 3.94, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(672, 23, 1452.25, 1.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(673, 23, 1459.25, 0.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(674, 23, 1462.1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(675, 23, 1468.95, -0.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(676, 23, 1476.85, -2.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(677, 23, 1478.5, -3.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(678, 23, 1485.6, -7.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(679, 23, 1487.1, -8.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(680, 23, 1493.75, -9.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(681, 23, 1500.15, -10.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(682, 23, 1501.35, -10.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(683, 23, 1513.75, -9.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(684, 23, 1519.6, -8.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(685, 23, 1527.8, -6.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(686, 23, 1538.05, -4.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(687, 23, 1550.05, -1.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(688, 23, 1560.47, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(689, 23, 1566.32, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(690, 23, 1569.33, 2.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(691, 23, 1580.9, 5.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(692, 23, 1588.9, 7.16, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(693, 23, 1600.38, 9.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(694, 23, 1607.1, 10.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(695, 23, 1623.18, 14.02, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(696, 23, 1629.57, 15.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(697, 23, 1647.1, 14.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(698, 23, 1657.1, 14.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(699, 23, 1668, 14.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(700, 23, 1671.33, 14.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(701, 23, 1690.1, 13.49, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(702, 23, 1697.35, 12.86, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(703, 23, 1709.75, 12.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(704, 23, 1717.8, 10.51, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 16:08:11', '2025-12-16 16:08:11'),
(705, 24, 0, 30, NULL, NULL, NULL, 55, NULL, NULL, 0, '2025-12-16 19:16:19', '2025-12-16 19:16:40'),
(706, 24, 1800, 30, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:19', '2025-12-16 19:16:40'),
(707, 24, 0, 4.53, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(708, 24, 16.25, 5.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(709, 24, 25.1, 7.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(710, 24, 90.5, 26.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(711, 24, 94.8, 25.46, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(712, 24, 113.85, 22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(713, 24, 115.47, 22.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(714, 24, 119.48, 22.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(715, 24, 139.7, 24.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(716, 24, 150.46, 25.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(717, 24, 163.18, 28.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(718, 24, 178.7, 30.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(719, 24, 197.1, 31.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(720, 24, 231.72, 39.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(721, 24, 257.7, 41.41, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(722, 24, 268.56, 42.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(723, 24, 281.5, 45.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(724, 24, 285.36, 46.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(725, 24, 292.8, 47.47, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(726, 24, 311.5, 50.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(727, 24, 331.52, 54.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(728, 24, 333, 55.23, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(729, 24, 353.05, 62.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(730, 24, 383.38, 64.58, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(731, 24, 402.67, 69.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(732, 24, 418.9, 74.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(733, 24, 435.35, 76.08, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(734, 24, 458.3, 79.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(735, 24, 462.18, 80.37, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(736, 24, 481.32, 83.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(737, 24, 490.35, 84.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(738, 24, 507.87, 86.24, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(739, 24, 520.87, 88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(740, 24, 522.7, 88.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(741, 24, 543.74, 87.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(742, 24, 544.55, 87.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(743, 24, 551.93, 86.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(744, 24, 560.9, 85.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(745, 24, 561.7, 85.57, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(746, 24, 576.3, 82.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(747, 24, 577.24, 82.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(748, 24, 579.82, 81.89, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(749, 24, 600.8, 79.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(750, 24, 620.25, 80.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(751, 24, 621.23, 80.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(752, 24, 630.5, 78.61, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(753, 24, 639.87, 78.44, NULL, NULL, 356, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:17:24'),
(754, 24, 670.04, 71.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(755, 24, 692.82, 62.3, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(756, 24, 694.68, 61.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(757, 24, 696.11, 61.06, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(758, 24, 715.27, 55.66, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(759, 24, 726.34, 54.93, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(760, 24, 733.77, 54.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(761, 24, 743.97, 56.77, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(762, 24, 749.92, 58.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(763, 24, 751.47, 58.12, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(764, 24, 763.32, 56.48, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(765, 24, 772.53, 55.17, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(766, 24, 792.65, 47.96, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(767, 24, 797.6, 47.09, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(768, 24, 813.36, 44.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(769, 24, 830.44, 43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(770, 24, 835.84, 42.39, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(771, 24, 856.86, 43.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(772, 24, 862.55, 43.74, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(773, 24, 874.67, 43.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(774, 24, 894.3, 41.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(775, 24, 904.85, 41.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(776, 24, 913.05, 40.98, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(777, 24, 933.15, 38.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(778, 24, 934.47, 37.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(779, 24, 940.7, 40.71, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(780, 24, 953.03, 46.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(781, 24, 957.65, 47.11, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(782, 24, 961.78, 47.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(783, 24, 979.83, 47.33, NULL, NULL, 482, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:19:09'),
(784, 24, 1000.87, 40.67, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(785, 24, 1019.38, 38.25, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(786, 24, 1023.95, 38.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(787, 24, 1045.3, 37.14, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(788, 24, 1050.27, 36.76, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(789, 24, 1077.6, 34.85, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(790, 24, 1089.35, 34.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(791, 24, 1100.55, 33.97, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(792, 24, 1121.1, 33.78, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(793, 24, 1154.4, 37.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(794, 24, 1178.6, 42.42, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(795, 24, 1203.25, 47.84, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(796, 24, 1209.25, 48.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(797, 24, 1218.7, 49.87, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(798, 24, 1229.4, 51.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(799, 24, 1238, 52.64, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(800, 24, 1253.88, 49.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(801, 24, 1257.5, 49.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(802, 24, 1277.15, 43.43, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(803, 24, 1299.23, 37.72, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(804, 24, 1300.7, 37.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(805, 24, 1322.65, 32.18, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(806, 24, 1325.25, 31.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(807, 24, 1344.1, 26.8, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(808, 24, 1346.06, 26.26, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(809, 24, 1358, 23.83, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(810, 24, 1368.55, 21.92, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(811, 24, 1369.83, 21.44, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(812, 24, 1383.06, 18.35, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(813, 24, 1385, 17.9, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(814, 24, 1398.15, 14.07, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(815, 24, 1418.3, 9.32, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(816, 24, 1439.2, 3.94, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(817, 24, 1452.25, 1.7, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(818, 24, 1459.25, 0.5, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(819, 24, 1462.1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(820, 24, 1468.95, -0.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(821, 24, 1476.85, -2.68, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(822, 24, 1478.5, -3.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(823, 24, 1485.6, -7.73, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(824, 24, 1487.1, -8.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(825, 24, 1493.75, -9.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(826, 24, 1500.15, -10.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(827, 24, 1501.35, -10.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(828, 24, 1513.75, -9.65, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(829, 24, 1519.6, -8.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(830, 24, 1527.8, -6.6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(831, 24, 1538.05, -4.22, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(832, 24, 1550.05, -1.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(833, 24, 1560.47, 0.52, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(834, 24, 1566.32, 1.75, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(835, 24, 1569.33, 2.38, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(836, 24, 1580.9, 5.15, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(837, 24, 1588.9, 7.16, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(838, 24, 1600.38, 9.34, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(839, 24, 1607.1, 10.54, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(840, 24, 1623.18, 14.02, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(841, 24, 1629.57, 15.4, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(842, 24, 1647.1, 14.88, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(843, 24, 1657.1, 14.55, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(844, 24, 1668, 14.2, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(845, 24, 1671.33, 14.1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(846, 24, 1690.1, 13.49, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(847, 24, 1697.35, 12.86, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(848, 24, 1709.75, 12.05, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(849, 24, 1717.8, 10.51, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-12-16 19:16:56', '2025-12-16 19:16:56'),
(850, 25, 0, 931.34, NULL, NULL, 280, NULL, 116, NULL, 0, '2026-01-20 18:56:40', '2026-01-29 21:46:34'),
(851, 25, 2252.73, 810.03, NULL, NULL, 268, NULL, 102, NULL, 0, '2026-01-20 18:56:40', '2026-01-29 21:46:34'),
(1138, 25, 332.56, 958.21, NULL, NULL, 303, NULL, 89, NULL, 1, '2026-01-23 13:38:03', '2026-01-29 19:35:48'),
(1139, 25, 402.12, 961.51, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-24 13:09:04'),
(1140, 25, 516.98, 936.35, NULL, 18, 309, NULL, 89, NULL, 1, '2026-01-23 13:38:03', '2026-01-24 13:12:09'),
(1141, 25, 641.22, 906.99, NULL, NULL, 304, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-24 13:13:25'),
(1142, 25, 761.3, 903.35, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-24 13:14:47'),
(1143, 25, 897.72, 897.72, NULL, NULL, 304, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-24 13:15:39'),
(1144, 25, 1120.64, 903.69, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1145, 25, 1256.57, 920.4, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1146, 25, 1360.57, 952.01, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1147, 25, 1444.89, 960.95, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1148, 25, 1559.74, 943.1, NULL, 11, 308, NULL, 89, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1149, 25, 1651.05, 910.02, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1150, 25, 1754.48, 863.75, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1151, 25, 1896.47, 814.72, NULL, 40, 313, NULL, 89, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1152, 25, 1949.68, 799.07, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1153, 25, 2132.97, 802.33, NULL, NULL, 303, NULL, 110, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03'),
(1154, 25, 2211.14, 807.62, NULL, 54, 313, NULL, 89, NULL, 1, '2026-01-23 13:38:03', '2026-01-23 13:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_country` int DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_hash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_hash_date` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code_expire` timestamp NULL DEFAULT NULL,
  `id_expiration_time` int DEFAULT NULL,
  `user_type` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `id_country`, `address`, `phone`, `picture`, `email`, `email_verified_at`, `username`, `password`, `comment`, `password_reset_hash`, `password_reset_type`, `password_reset_hash_date`, `verification_code`, `verification_code_expire`, `id_expiration_time`, `user_type`, `active`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Сашо', 'Димовски', 1, NULL, '911234567891', '', 'saso.dimovski@t.mk', NULL, 'password', '$2y$12$81bwTGFezpyIivLN1ZfcWuWJcD4ZqR8QEZXZIJtj4duf8yDDrti3C', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 0, 1, 1, '2025-03-24 18:26:02', '2026-01-29 17:29:12'),
(2, 'Перо', 'Перовски', 165, NULL, '911234567891', '', 'saso.bass@gmail.mk', NULL, 'username', '$2y$12$FmktJ0CgSmZxqnuvonP2g.V7Obg9a3fDRJF59LuiDcnHCNTHwxBhi', NULL, 'd65750f7428c63c07d0ea1ff23f208bd', 'registration', '2025-03-25 15:07:14', NULL, NULL, 2, 2, 1, 0, 1, 1, '2025-03-24 18:26:02', '2025-03-30 15:45:03'),
(3, 'Киро', 'Тасески', 165, NULL, NULL, '', 'kiro.taseski@gmail.com', NULL, 'kirotaseski', '$2y$12$/4beQcMC3WK6TprlCm0OnuNT9u3PZNaSCGVVFU0f6XM5/.gQKp9g6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 0, 1, 1, '2025-03-31 12:45:11', '2025-07-25 08:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `voltages`
--

CREATE TABLE `voltages` (
  `id` int UNSIGNED NOT NULL,
  `title` int DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `voltages`
--

INSERT INTO `voltages` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 10, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(2, 20, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(3, 35, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(4, 110, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(5, 220, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(6, 400, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `wind_pressure`
--

CREATE TABLE `wind_pressure` (
  `id` int UNSIGNED NOT NULL,
  `title` int DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wind_pressure`
--

INSERT INTO `wind_pressure` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 50, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(2, 60, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(3, 75, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(4, 90, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(5, 110, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(6, 130, '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `zatpol`
--

CREATE TABLE `zatpol` (
  `id` int NOT NULL,
  `id_project` int DEFAULT NULL,
  `po_stolb` int DEFAULT NULL,
  `stac_po` float DEFAULT NULL,
  `kr_stolb` float DEFAULT NULL,
  `stac_kr` float DEFAULT NULL,
  `pole_dol` float DEFAULT NULL,
  `nap_pro` float DEFAULT NULL,
  `nap_zaj` float DEFAULT NULL,
  `kndt` float DEFAULT NULL,
  `kidt` float DEFAULT NULL,
  `priv` float DEFAULT NULL,
  `id_raspon` float DEFAULT NULL,
  `tovpro` float DEFAULT NULL,
  `tovpro_1` float DEFAULT NULL,
  `tovpro_2` float DEFAULT NULL,
  `napreg1_p` float DEFAULT NULL,
  `napreg2_p` float DEFAULT NULL,
  `napreg3_p` float DEFAULT NULL,
  `napreg4_p` float DEFAULT NULL,
  `napreg5_p` float DEFAULT NULL,
  `napreg6_p` float DEFAULT NULL,
  `napreg7_p` float DEFAULT NULL,
  `napreg8_p` float DEFAULT NULL,
  `krit_te_p` float DEFAULT NULL,
  `krit_ra_p` float DEFAULT NULL,
  `tovzaj` float DEFAULT NULL,
  `tovzaj_1` float DEFAULT NULL,
  `tovzaj_2` float DEFAULT NULL,
  `napreg1_z` float DEFAULT NULL,
  `napreg2_z` float DEFAULT NULL,
  `napreg3_z` float DEFAULT NULL,
  `napreg4_z` float DEFAULT NULL,
  `napreg5_z` float DEFAULT NULL,
  `napreg6_z` float DEFAULT NULL,
  `napreg7_z` float DEFAULT NULL,
  `napreg8_z` float DEFAULT NULL,
  `krit_te_z` float DEFAULT NULL,
  `krit_ra_z` float DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zatpol`
--

INSERT INTO `zatpol` (`id`, `id_project`, `po_stolb`, `stac_po`, `kr_stolb`, `stac_kr`, `pole_dol`, `nap_pro`, `nap_zaj`, `kndt`, `kidt`, `priv`, `id_raspon`, `tovpro`, `tovpro_1`, `tovpro_2`, `napreg1_p`, `napreg2_p`, `napreg3_p`, `napreg4_p`, `napreg5_p`, `napreg6_p`, `napreg7_p`, `napreg8_p`, `krit_te_p`, `krit_ra_p`, `tovzaj`, `tovzaj_1`, `tovzaj_2`, `napreg1_z`, `napreg2_z`, `napreg3_z`, `napreg4_z`, `napreg5_z`, `napreg6_z`, `napreg7_z`, `napreg8_z`, `krit_te_z`, `krit_ra_z`, `created_at`, `updated_at`) VALUES
(28, 14, 11, 0, 15, 4, 4, 65.65, 655.87, 3.76, 2.76, NULL, 1.06372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(29, 14, 15, 4, 16, 5, 1, 65.65, 655.87, 3.76, 2.76, NULL, 0.707107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(30, 14, 16, 5, 35, 43, 38, 65.65, 655.87, 3.76, 2.76, NULL, 26.8701, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(31, 14, 35, 43, 31, 400, 357, 65.65, 655.87, 3.76, 2.76, NULL, 356.82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 09:33:20', '2025-11-10 09:33:20'),
(32, 15, 46, 0, 47, 900, 900, 5, 5, 4, 4, NULL, 899.211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:17:28', '2025-12-07 17:17:28'),
(39, 13, 94, 0, 67, 0.5, 0.5, 5, 5, 5, 5, NULL, 0.00537026, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(40, 13, 68, 0.5, 61, 3, 2.5, 5, 5, 5, 5, NULL, 0.00228627, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(41, 13, 63, 3, 75, 450.53, 447.53, 5, 5, 5, 5, NULL, 29.2714, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-12 08:40:44', '2025-12-12 08:40:44'),
(42, 19, 102, 0, 103, 9000, 9000, 7, 7, 4, 4, NULL, 6521.22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-12 10:39:41', '2025-12-12 10:39:41'),
(43, 20, 247, 0, 391, 1717.8, 1717.8, 8, 22, 1.6, 2, NULL, 2.48791, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-12 14:19:27', '2025-12-12 14:19:27'),
(146, 25, 280, 0, 309, 516.98, 516.98, 8, 8, 1, 2, 90, 248.694, 0.0034152, 0.0133212, 0.0232273, 2.21779, 2.18501, 2.15361, 2.1235, 2.09459, 2.06681, 2.04009, 8, 35.8783, 51.2496, 0.00776577, 0.0221124, 0.036459, 2.84295, 2.83488, 2.82689, 2.81896, 2.8111, 2.8033, 2.79557, 8, 21.9633, 24.3156, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(147, 25, 309, 516.98, 308, 1559.74, 1042.76, 8, 8, 1, 2, 90, 145.172, 0.0034152, 0.0133212, 0.0232273, 2.6516, 2.50887, 2.3853, 2.2772, 2.18175, 2.09676, 2.02053, 8, 35.8783, 51.2496, 0.00776577, 0.0221124, 0.036459, 2.91017, 2.88523, 2.86091, 2.83719, 2.81404, 2.79145, 2.76938, 8, 21.9633, 24.3156, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(148, 25, 308, 1559.74, 313, 1896.47, 336.73, 8, 8, 1, 2, 90, 109.919, 0.0034152, 0.0133212, 0.0232273, 3.38369, 3.00071, 2.70469, 2.47138, 2.2836, 2.1294, 2.0005, 8, 35.8783, 51.2496, 0.00776577, 0.0221124, 0.036459, 2.99047, 2.94427, 2.90011, 2.85784, 2.81732, 2.77845, 2.74111, 8, 21.9633, 24.3156, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(149, 25, 313, 1896.47, 313, 2211.14, 314.67, 8, 8, 1, 2, 90, 148.561, 0.0034152, 0.0133212, 0.0232273, 2.61617, 2.48359, 2.36795, 2.26612, 2.17568, 2.09474, 2.02181, 8, 35.8783, 51.2496, 0.00776577, 0.0221124, 0.036459, 2.90546, 2.88173, 2.85856, 2.83594, 2.81384, 2.79225, 2.77113, 8, 21.9633, 24.3156, '2026-01-29 23:16:05', '2026-01-29 23:16:05'),
(150, 25, 313, 2211.14, 268, 2252.73, 41.59, 8, 8, 1, 2, 90, NULL, 0.0034152, 0.0133212, 0.0232273, 8, 6.5447, 5.0894, 3.6341, 2.1788, 0.7235, 0.000000001, 5.81705, 35.8783, 51.2496, 0.00776577, 0.0221124, 0.036459, 8, 6.075, 4.15, 2.225, 0.3, 0.000000001, 0.000000001, 5.1125, 21.9633, 24.3156, '2026-01-29 23:16:05', '2026-01-29 23:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `_countries`
--

CREATE TABLE `_countries` (
  `id` int UNSIGNED NOT NULL,
  `code_s` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_l` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_countries`
--

INSERT INTO `_countries` (`id`, `code_s`, `code_l`, `name`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'af', 'afg', 'Afghanistan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'ax', 'ala', 'Åland Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 'al', 'alb', 'Albania', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, 'dz', 'dza', 'Algeria', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, 'as', 'asm', 'American Samoa', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(6, 'ad', 'and', 'Andorra', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(7, 'ao', 'ago', 'Angola', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(8, 'ai', 'aia', 'Anguilla', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(9, 'aq', 'ata', 'Antarctica', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(10, 'ag', 'atg', 'Antigua and Barbuda', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(11, 'ar', 'arg', 'Argentina', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(12, 'am', 'arm', 'Armenia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(13, 'aw', 'abw', 'Aruba', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(14, 'au', 'aus', 'Australia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(15, 'at', 'aut', 'Austria', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(16, 'az', 'aze', 'Azerbaijan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(17, 'bs', 'bhs', 'Bahamas', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(18, 'bh', 'bhr', 'Bahrain', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(19, 'bd', 'bgd', 'Bangladesh', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(20, 'bb', 'brb', 'Barbados', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(21, 'by', 'blr', 'Belarus', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(22, 'be', 'bel', 'Belgium', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(23, 'bz', 'blz', 'Belize', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(24, 'bj', 'ben', 'Benin', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(25, 'bm', 'bmu', 'Bermuda', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(26, 'bt', 'btn', 'Bhutan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(27, 'bo', 'bol', 'Bolivia, Plurinational State of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(28, 'bq', 'bes', 'Bonaire, Sint Eustatius and Saba', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(29, 'ba', 'bih', 'Bosnia and Herzegovina', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(30, 'bw', 'bwa', 'Botswana', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(31, 'bv', 'bvt', 'Bouvet Island', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(32, 'br', 'bra', 'Brazil', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(33, 'io', 'iot', 'British Indian Ocean Territory', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(34, 'bn', 'brn', 'Brunei Darussalam', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(35, 'bg', 'bgr', 'Bulgaria', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(36, 'bf', 'bfa', 'Burkina Faso', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(37, 'bi', 'bdi', 'Burundi', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(38, 'cv', 'cpv', 'Cabo Verde', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(39, 'kh', 'khm', 'Cambodia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(40, 'cm', 'cmr', 'Cameroon', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(41, 'ca', 'can', 'Canada', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(42, 'ky', 'cym', 'Cayman Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(43, 'cf', 'caf', 'Central African Republic', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(44, 'td', 'tcd', 'Chad', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(45, 'cl', 'chl', 'Chile', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(46, 'cn', 'chn', 'China', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(47, 'cx', 'cxr', 'Christmas Island', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(48, 'cc', 'cck', 'Cocos [Keeling] Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(49, 'co', 'col', 'Colombia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(50, 'km', 'com', 'Comoros', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(51, 'cg', 'cog', 'Congo', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(52, 'cd', 'cod', 'Congo, Democratic Republic of the', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(53, 'ck', 'cok', 'Cook Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(54, 'cr', 'cri', 'Costa Rica', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(55, 'ci', 'civ', 'Côte d\'Ivoire', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(56, 'hr', 'hrv', 'Croatia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(57, 'cu', 'cub', 'Cuba', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(58, 'cw', 'cuw', 'Curaçao', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(59, 'cy', 'cyp', 'Cyprus', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(60, 'cz', 'cze', 'Czechia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(61, 'dk', 'dnk', 'Denmark', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(62, 'dj', 'dji', 'Djibouti', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(63, 'dm', 'dma', 'Dominica', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(64, 'do', 'dom', 'Dominican Republic', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(65, 'ec', 'ecu', 'Ecuador', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(66, 'eg', 'egy', 'Egypt', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(67, 'sv', 'slv', 'El Salvador', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(68, 'gq', 'gnq', 'Equatorial Guinea', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(69, 'er', 'eri', 'Eritrea', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(70, 'ee', 'est', 'Estonia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(71, 'sz', 'swz', 'Eswatini', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(72, 'et', 'eth', 'Ethiopia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(73, 'fk', 'flk', 'Falkland Islands [Malvinas]', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(74, 'fo', 'fro', 'Faroe Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(75, 'fj', 'fji', 'Fiji', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(76, 'fi', 'fin', 'Finland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(77, 'fr', 'fra', 'France', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(78, 'gf', 'guf', 'French Guiana', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(79, 'pf', 'pyf', 'French Polynesia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(80, 'tf', 'atf', 'French Southern Territories', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(81, 'ga', 'gab', 'Gabon', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(82, 'gm', 'gmb', 'Gambia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(83, 'ge', 'geo', 'Georgia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(84, 'de', 'deu', 'Germany', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(85, 'gh', 'gha', 'Ghana', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(86, 'gi', 'gib', 'Gibraltar', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(87, 'gr', 'grc', 'Greece', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(88, 'gl', 'grl', 'Greenland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(89, 'gd', 'grd', 'Grenada', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(90, 'gp', 'glp', 'Guadeloupe', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(91, 'gu', 'gum', 'Guam', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(92, 'gt', 'gtm', 'Guatemala', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(93, 'gg', 'ggy', 'Guernsey', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(94, 'gn', 'gin', 'Guinea', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(95, 'gw', 'gnb', 'Guinea-Bissau', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(96, 'gy', 'guy', 'Guyana', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(97, 'ht', 'hti', 'Haiti', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(98, 'hm', 'hmd', 'Heard Island and McDonald Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(99, 'va', 'vat', 'Holy See', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(100, 'hn', 'hnd', 'Honduras', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(101, 'hk', 'hkg', 'Hong Kong', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(102, 'hu', 'hun', 'Hungary', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(103, 'is', 'isl', 'Iceland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(104, 'in', 'ind', 'India', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(105, 'id', 'idn', 'Indonesia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(106, 'ir', 'irn', 'Iran, Islamic Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(107, 'iq', 'irq', 'Iraq', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(108, 'ie', 'irl', 'Ireland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(109, 'im', 'imn', 'Isle of Man', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(110, 'il', 'isr', 'Israel', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(111, 'it', 'ita', 'Italy', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(112, 'jm', 'jam', 'Jamaica', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(113, 'jp', 'jpn', 'Japan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(114, 'je', 'jey', 'Jersey', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(115, 'jo', 'jor', 'Jordan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(116, 'kz', 'kaz', 'Kazakhstan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(117, 'ke', 'ken', 'Kenya', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(118, 'ki', 'kir', 'Kiribati', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(119, 'kp', 'prk', 'Korea, Democratic People\'s Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(120, 'kr', 'kor', 'Korea, Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(121, 'kw', 'kwt', 'Kuwait', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(122, 'kg', 'kgz', 'Kyrgyzstan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(123, 'la', 'lao', 'Lao People\'s Democratic Republic', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(124, 'lv', 'lva', 'Latvia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(125, 'lb', 'lbn', 'Lebanon', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(126, 'ls', 'lso', 'Lesotho', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(127, 'lr', 'lbr', 'Liberia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(128, 'ly', 'lby', 'Libya', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(129, 'li', 'lie', 'Liechtenstein', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(130, 'lt', 'ltu', 'Lithuania', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(131, 'lu', 'lux', 'Luxembourg', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(132, 'mo', 'mac', 'Macao', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(133, 'mg', 'mdg', 'Madagascar', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(134, 'mw', 'mwi', 'Malawi', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(135, 'my', 'mys', 'Malaysia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(136, 'mv', 'mdv', 'Maldives', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(137, 'ml', 'mli', 'Mali', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(138, 'mt', 'mlt', 'Malta', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(139, 'mh', 'mhl', 'Marshall Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(140, 'mq', 'mtq', 'Martinique', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(141, 'mr', 'mrt', 'Mauritania', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(142, 'mu', 'mus', 'Mauritius', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(143, 'yt', 'myt', 'Mayotte', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(144, 'mx', 'mex', 'Mexico', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(145, 'fm', 'fsm', 'Micronesia, Federated States of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(146, 'md', 'mda', 'Moldova, Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(147, 'mc', 'mco', 'Monaco', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(148, 'mn', 'mng', 'Mongolia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(149, 'me', 'mne', 'Montenegro', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(150, 'ms', 'msr', 'Montserrat', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(151, 'ma', 'mar', 'Morocco', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(152, 'mz', 'moz', 'Mozambique', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(153, 'mm', 'mmr', 'Myanmar', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(154, 'na', 'nam', 'Namibia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(155, 'nr', 'nru', 'Nauru', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(156, 'np', 'npl', 'Nepal', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(157, 'nl', 'nld', 'Netherlands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(158, 'nc', 'ncl', 'New Caledonia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(159, 'nz', 'nzl', 'New Zealand', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(160, 'ni', 'nic', 'Nicaragua', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(161, 'ne', 'ner', 'Niger', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(162, 'ng', 'nga', 'Nigeria', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(163, 'nu', 'niu', 'Niue', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(164, 'nf', 'nfk', 'Norfolk Island', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(165, 'mk', 'mkd', 'Macedonia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(166, 'mp', 'mnp', 'Northern Mariana Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(167, 'no', 'nor', 'Norway', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(168, 'om', 'omn', 'Oman', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(169, 'pk', 'pak', 'Pakistan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(170, 'pw', 'plw', 'Palau', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(171, 'ps', 'pse', 'Palestine, State of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(172, 'pa', 'pan', 'Panama', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(173, 'pg', 'png', 'Papua New Guinea', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(174, 'py', 'pry', 'Paraguay', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(175, 'pe', 'per', 'Peru', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(176, 'ph', 'phl', 'Philippines', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(177, 'pn', 'pcn', 'Pitcairn', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(178, 'pl', 'pol', 'Poland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(179, 'pt', 'prt', 'Portugal', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(180, 'pr', 'pri', 'Puerto Rico', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(181, 'qa', 'qat', 'Qatar', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(182, 're', 'reu', 'Réunion', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(183, 'ro', 'rou', 'Romania', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(184, 'ru', 'rus', 'Russian Federation', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(185, 'rw', 'rwa', 'Rwanda', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(186, 'bl', 'blm', 'Saint Barthélemy', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(187, 'sh', 'shn', 'Saint Helena, Ascension and Tristan da Cunha', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(188, 'kn', 'kna', 'Saint Kitts and Nevis', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(189, 'lc', 'lca', 'Saint Lucia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(190, 'mf', 'maf', 'Saint Martin [French part]', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(191, 'pm', 'spm', 'Saint Pierre and Miquelon', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(192, 'vc', 'vct', 'Saint Vincent and the Grenadines', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(193, 'ws', 'wsm', 'Samoa', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(194, 'sm', 'smr', 'San Marino', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(195, 'st', 'stp', 'Sao Tome and Principe', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(196, 'sa', 'sau', 'Saudi Arabia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(197, 'sn', 'sen', 'Senegal', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(198, 'rs', 'srb', 'Serbia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(199, 'sc', 'syc', 'Seychelles', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(200, 'sl', 'sle', 'Sierra Leone', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(201, 'sg', 'sgp', 'Singapore', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(202, 'sx', 'sxm', 'Sint Maarten [Dutch part]', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(203, 'sk', 'svk', 'Slovakia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(204, 'si', 'svn', 'Slovenia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(205, 'sb', 'slb', 'Solomon Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(206, 'so', 'som', 'Somalia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(207, 'za', 'zaf', 'South Africa', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(208, 'gs', 'sgs', 'South Georgia and the South Sandwich Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(209, 'ss', 'ssd', 'South Sudan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(210, 'es', 'esp', 'Spain', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(211, 'lk', 'lka', 'Sri Lanka', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(212, 'sd', 'sdn', 'Sudan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(213, 'sr', 'sur', 'Suriname', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(214, 'sj', 'sjm', 'Svalbard and Jan Mayen', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(215, 'se', 'swe', 'Sweden', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(216, 'ch', 'che', 'Switzerland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(217, 'sy', 'syr', 'Syrian Arab Republic', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(218, 'tw', 'twn', 'Taiwan, Province of China', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(219, 'tj', 'tjk', 'Tajikistan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(220, 'tz', 'tza', 'Tanzania, United Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(221, 'th', 'tha', 'Thailand', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(222, 'tl', 'tls', 'Timor-Leste', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(223, 'tg', 'tgo', 'Togo', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(224, 'tk', 'tkl', 'Tokelau', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(225, 'to', 'ton', 'Tonga', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(226, 'tt', 'tto', 'Trinidad and Tobago', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(227, 'tn', 'tun', 'Tunisia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(228, 'tr', 'tur', 'Türkiye', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(229, 'tm', 'tkm', 'Turkmenistan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(230, 'tc', 'tca', 'Turks and Caicos Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(231, 'tv', 'tuv', 'Tuvalu', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(232, 'ug', 'uga', 'Uganda', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(233, 'ua', 'ukr', 'Ukraine', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(234, 'ae', 'are', 'United Arab Emirates', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(235, 'gb', 'gbr', 'United Kingdom of Great Britain and Northern Ireland', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(236, 'us', 'usa', 'United States of America', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(237, 'um', 'umi', 'United States Minor Outlying Islands', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(238, 'uy', 'ury', 'Uruguay', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(239, 'uz', 'uzb', 'Uzbekistan', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(240, 'vu', 'vut', 'Vanuatu', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(241, 've', 'ven', 'Venezuela, Bolivarian Republic of', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(242, 'vn', 'vnm', 'Viet Nam', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(243, 'vg', 'vgb', 'Virgin Islands [British]', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(244, 'vi', 'vir', 'Virgin Islands [U.S.]', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(245, 'wf', 'wlf', 'Wallis and Futuna', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(246, 'eh', 'esh', 'Western Sahara', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(247, 'ye', 'yem', 'Yemen', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(248, 'zm', 'zmb', 'Zambia', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(249, 'zw', 'zwe', 'Zimbabwe', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `_email_type`
--

CREATE TABLE `_email_type` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_email_type`
--

INSERT INTO `_email_type` (`id`, `name`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'REQUEST FOR FORGOTTEN PASSWORD', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'REQUEST FOR FIRS LOGIN PASSWORD', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 'SUCCESS RESET FORGOTTEN PASSWORD', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, 'SUCCESS RESET EXPIRED PASSWORD', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, 'SUCCESS FIRS LOGIN PASSWORD', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `_expiration_time`
--

CREATE TABLE `_expiration_time` (
  `id` int UNSIGNED NOT NULL,
  `value` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_expiration_time`
--

INSERT INTO `_expiration_time` (`id`, `value`, `name`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 3, '3 months', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 6, '6 months', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 9, '9 months', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, 12, '12 months', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, 9999, 'Never', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `_languages`
--

CREATE TABLE `_languages` (
  `id` int UNSIGNED NOT NULL,
  `lang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_languages`
--

INSERT INTO `_languages` (`id`, `lang`, `language`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'mk', 'македонски', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'en', 'еnglish', 0, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 'sq', 'shqip', 0, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `_modules_design`
--

CREATE TABLE `_modules_design` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_color` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_modules_design`
--

INSERT INTO `_modules_design` (`id`, `title`, `icon`, `button_color`, `text_color`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'user icon, white text, info button', 'fas fa-user', 'bg-info', 'text-white', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'users icon, white text, info button', 'fas fa-users', 'bg-info', 'text-white', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(3, 'folder icon, white text, info button', 'far fa-folder', 'bg-success', 'text-white', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(4, 'file icon, white text, info button', 'far fa-file', 'bg-info', 'text-white', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(5, 'bars icon, black text, nocolor button', 'fas fa-bars', 'bg-info', 'text-white', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(6, 'circle icon, black text, nocolor button', 'far fa-circle', '', 'text-black', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(7, 'dot-circle, black text, nocolor button', 'far fa-dot-circle', '', 'text-black', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `_modules_type`
--

CREATE TABLE `_modules_type` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_modules_type`
--

INSERT INTO `_modules_type` (`id`, `title`, `description`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Модул', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02'),
(2, 'Привилегија', NULL, 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `conductors`
--
ALTER TABLE `conductors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endpoints`
--
ALTER TABLE `endpoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gapres`
--
ALTER TABLE `gapres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gapres_project` (`id_project`),
  ADD KEY `idx_gapres_project_stac` (`id_project`,`stac_t`);

--
-- Indexes for table `ground_wires`
--
ALTER TABLE `ground_wires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_modules`
--
ALTER TABLE `groups_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_users`
--
ALTER TABLE `groups_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insulators`
--
ALTER TABLE `insulators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insulator_chain`
--
ALTER TABLE `insulator_chain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs_email`
--
ALTER TABLE `logs_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_users`
--
ALTER TABLE `modules_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raspres`
--
ALTER TABLE `raspres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `towers`
--
ALTER TABLE `towers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trafo`
--
ALTER TABLE `trafo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trasa`
--
ALTER TABLE `trasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `voltages`
--
ALTER TABLE `voltages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wind_pressure`
--
ALTER TABLE `wind_pressure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zatpol`
--
ALTER TABLE `zatpol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_countries`
--
ALTER TABLE `_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_email_type`
--
ALTER TABLE `_email_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_expiration_time`
--
ALTER TABLE `_expiration_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_languages`
--
ALTER TABLE `_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_modules_design`
--
ALTER TABLE `_modules_design`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_modules_type`
--
ALTER TABLE `_modules_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conductors`
--
ALTER TABLE `conductors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `endpoints`
--
ALTER TABLE `endpoints`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gapres`
--
ALTER TABLE `gapres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT for table `ground_wires`
--
ALTER TABLE `ground_wires`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups_modules`
--
ALTER TABLE `groups_modules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `groups_users`
--
ALTER TABLE `groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insulators`
--
ALTER TABLE `insulators`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `insulator_chain`
--
ALTER TABLE `insulator_chain`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs_email`
--
ALTER TABLE `logs_email`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules_users`
--
ALTER TABLE `modules_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `raspres`
--
ALTER TABLE `raspres`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2902;

--
-- AUTO_INCREMENT for table `towers`
--
ALTER TABLE `towers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=662;

--
-- AUTO_INCREMENT for table `trafo`
--
ALTER TABLE `trafo`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `trasa`
--
ALTER TABLE `trasa`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voltages`
--
ALTER TABLE `voltages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wind_pressure`
--
ALTER TABLE `wind_pressure`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zatpol`
--
ALTER TABLE `zatpol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `_countries`
--
ALTER TABLE `_countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `_email_type`
--
ALTER TABLE `_email_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `_expiration_time`
--
ALTER TABLE `_expiration_time`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `_languages`
--
ALTER TABLE `_languages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `_modules_design`
--
ALTER TABLE `_modules_design`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `_modules_type`
--
ALTER TABLE `_modules_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
