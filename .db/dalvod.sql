-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2025 at 05:38 PM
-- Server version: 8.0.43
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediummk_dalvod`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('dalvod_cache_|172.18.0.12:timer', 'i:1742840890;', 1742840890),
('dalvod_cache_|37.25.84.149', 'i:1;', 1750701648),
('dalvod_cache_|37.25.84.149:timer', 'i:1750701648;', 1750701648),
('dalvod_cache_|77.28.255.12', 'i:1;', 1746470356),
('dalvod_cache_|77.28.255.12:timer', 'i:1746470356;', 1746470356),
('dalvod_cache_|79.141.112.10', 'i:2;', 1753635594),
('dalvod_cache_|79.141.112.10:timer', 'i:1753635594;', 1753635594),
('dalvod_cache_|89.205.13.237', 'i:3;', 1750525114),
('dalvod_cache_|89.205.13.237:timer', 'i:1750525114;', 1750525114);

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
  `cross_section` decimal(10,2) DEFAULT NULL,
  `diameter` decimal(10,2) DEFAULT NULL,
  `mass` decimal(10,2) DEFAULT NULL,
  `model` decimal(10,2) DEFAULT NULL,
  `resistance_per_km` decimal(12,8) DEFAULT NULL,
  `nominal_voltage` decimal(10,1) DEFAULT NULL,
  `test_voltage` decimal(10,1) DEFAULT NULL,
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

INSERT INTO `conductors` (`id`, `type`, `cross_section`, `diameter`, `mass`, `model`, `resistance_per_km`, `nominal_voltage`, `test_voltage`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Al/Fe-16/2.5', 17.85, 5.40, 62.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(2, 'Al/Fe-25/4', 27.80, 6.80, 97.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(3, 'Al/Fe-35/6', 40.00, 8.10, 140.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(4, 'Al/Fe-50/8', 56.30, 9.60, 196.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(5, 'Al/Fe-70/12', 81.30, 11.70, 284.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(6, 'Al/Fe-95/15', 109.70, 13.60, 383.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(7, 'Al/Fe-120/20', 141.40, 15.50, 494.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(8, 'Al/Fe-150/25', 173.10, 17.10, 605.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(9, 'Al/Fe-185/30', 213.60, 19.00, 746.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(10, 'Al/Fe-210/35', 243.20, 20.30, 850.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(11, 'Al/Fe-240/40', 282.50, 21.90, 987.00, 7700.00, 0.00001890, 13.0, 24.5, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(12, 'Al/Fe-490/65', 553.90, 30.60, 1879.00, 7000.00, 0.00001930, 11.0, 21.0, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(13, 'AAAC-324-2Z', 323.97, 21.70, 908.00, 5600.00, 0.00002300, 10.5, 20.0, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(14, 'AAA-TW-324Shape', 323.98, 21.70, 893.00, 6800.00, 0.00002300, 11.8, 21.0, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL),
(15, 'ACCC-122/28', 150.70, 14.35, 393.30, 6809.00, 0.00001647, 16.2, 30.4, 1, 0, '2025-03-29 15:44:24', '2025-03-29 15:44:55', NULL, NULL);

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
(1, 'Трафостаница', NULL, 1, 0, '2025-03-29 16:58:26', '2025-03-29 16:58:26'),
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
-- Table structure for table `ground_wires`
--

CREATE TABLE `ground_wires` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `cross_section` decimal(10,2) DEFAULT NULL,
  `diameter` decimal(10,2) DEFAULT NULL,
  `mass` decimal(10,2) DEFAULT NULL,
  `model` decimal(10,2) DEFAULT NULL,
  `resistance_per_km` decimal(12,8) DEFAULT NULL,
  `nominal_voltage` decimal(10,1) DEFAULT NULL,
  `test_voltage` decimal(10,1) DEFAULT NULL,
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

INSERT INTO `ground_wires` (`id`, `type`, `cross_section`, `diameter`, `mass`, `model`, `resistance_per_km`, `nominal_voltage`, `test_voltage`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Fe-I-35/7', 34.36, 7.50, 272.00, 17500.00, 0.00001100, 14.5, 26.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(2, 'Fe-I-50/7', 49.48, 9.00, 391.00, 17500.00, 0.00001100, 14.5, 26.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(3, 'Fe-I-50/19', 48.36, 9.00, 384.00, 17500.00, 0.00001100, 14.5, 26.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(4, 'Fe-I-70/19', 65.82, 10.50, 523.00, 17500.00, 0.00001100, 14.5, 26.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(5, 'Fe-I-95/19', 93.27, 12.50, 741.00, 17500.00, 0.00001100, 14.5, 26.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(6, 'Fe-II-35/7', 34.36, 7.50, 272.00, 17500.00, 0.00001100, 26.0, 49.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(7, 'Fe-II-50/7', 49.48, 9.00, 391.00, 17500.00, 0.00001100, 26.0, 49.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(8, 'Fe-II-50/19', 48.36, 9.00, 384.00, 17500.00, 0.00001100, 26.0, 49.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(9, 'Fe-II-70/19', 65.82, 10.50, 523.00, 17500.00, 0.00001100, 26.0, 49.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(10, 'Fe-II-95/19', 93.27, 12.50, 741.00, 17500.00, 0.00001100, 26.0, 49.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(11, 'Fe-III-35/7', 34.36, 7.50, 272.00, 17500.00, 0.00001100, 49.5, 93.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(12, 'Fe-III-50/7', 49.48, 9.00, 391.00, 17500.00, 0.00001100, 49.5, 93.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(13, 'Fe-III-50/19', 48.36, 9.00, 384.00, 17500.00, 0.00001100, 49.5, 93.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(14, 'Fe-III-70/19', 65.82, 10.50, 523.00, 17500.00, 0.00001100, 49.5, 93.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(15, 'Fe-III-95/19', 93.27, 12.50, 741.00, 17500.00, 0.00001100, 49.5, 93.0, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(16, 'AWG-19/9', 126.10, 14.50, 842.00, 16200.00, 0.00001300, 49.0, 92.5, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(17, 'OPW-AAL/ACS93/5', 151.04, 16.40, 665.00, 10066.00, 0.00001680, 28.1, 48.2, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(18, 'AA/ACS-119.1-24', 119.10, 14.55, 494.00, 9440.00, 0.00001780, 23.6, 41.4, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(19, 'ACS-42-3,5', 42.40, 9.00, 312.00, 16200.00, 0.00001620, 51.0, 87.7, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL),
(20, 'ASLH-D-48(50-4)', 49.50, 10.00, 377.00, 16200.00, 0.00001300, 54.6, 93.7, 1, 0, '2025-03-29 16:02:01', '2025-03-29 16:02:01', NULL, NULL);

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
(3, 'Композит', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(4, 'Силикон', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(7, 'Полимер', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

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
(3, 3, 4, 'SUCCESS RESET EXPIRED PASSWORD', 'verana1601', '2025-07-02 09:00:11', '2025-07-02 09:00:11');

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
(11, NULL, 1, 1, 3, 'Проекти', 'proekti', '', '11/projects', 1, 0, '2025-03-24 18:26:02', '2025-03-24 18:26:02');

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
(275, 11, 3, 1, 0, '2025-03-31 12:45:11', '2025-03-31 12:45:11');

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
(5, 3, '$2y$12$kNhXMF.z1uG.dj9UXnxqxuedTiRrOhS8cJ61RkOypk20MYl9MZOYW', 1, 0, '2025-07-02 09:00:11', '2025-07-02 09:00:11');

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
  `id_starting_point` int DEFAULT NULL,
  `id_ending_point` int DEFAULT NULL,
  `tensile_stress_cond` float DEFAULT NULL,
  `tensile_stress_ground` float DEFAULT NULL,
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

INSERT INTO `projects` (`id`, `title`, `id_voltage`, `id_conductor`, `id_ground_wires`, `id_starting_point`, `id_ending_point`, `tensile_stress_cond`, `tensile_stress_ground`, `kn`, `ki`, `id_wind_pressure`, `id_insulator_chain`, `approx_field_length`, `approx_number_towers`, `var_v`, `num_cond_systems`, `num_cond_bundle`, `num_ground_wires`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'DV 2x110 kV Dimonceq', 2, 1, 1, 1, 2, 12, 32, 1.6, 2, 2, 2, 100, 10, NULL, 2, 1, 1, 1, 0, '2025-03-30 09:24:30', '2025-03-30 14:10:24', 1, 1),
(2, 'DV 2x110 kV Dimonce', 1, 12, 5, 2, 1, 2.9, 31.3, 1, 2.9, 5, 1, 100, 10, NULL, 2, 1, 2, 0, 0, '2025-03-30 09:24:32', '2025-03-30 16:43:44', 1, 1);

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
('03r036ZPSpP6v58mgulRPkDOyaJJe2ezsVAvqJtq', NULL, '162.142.125.35', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTRqSkJLODlEVkhHMHNwQk0wcFJrNFNhemRVcUJabXU0Sk9UcHlzZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vd3d3LmRhbHZvZC5tZWRpdW0zLm1rIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753769451),
('1ZzdSJcRfppY0gPJc33WYyyF60Us4K8EoGzYvPOA', NULL, '79.141.112.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0NVNG05cDNOSloweDg4SjVaMlRVNUhhV3JkTDhpdnhIODhld2RjTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZGFsdm9kLm1lZGl1bTMubWsvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753712887),
('aBNcuo6Q6ZJFsNhRrJZw28XCGsWHS9tIMmtQHPS5', NULL, '139.59.86.7', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUx2S3VRN0cwTWxlOEV1bFdIbWpCZFplSG5iRk1YalQ4dDk5eWk2ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kYWx2b2QubWVkaXVtMy5tay9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753755985),
('BzV9uGNwge4Cn9jVjB7XizpPHfMa6cYWdGvHBIym', NULL, '165.227.217.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1JqR3ZqVVljRUZpeW1Mb29OTW9TTWVLZkpUd242d2pvUGZNZUM2RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly93d3cuZGFsdm9kLm1lZGl1bTMubWsvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753769809),
('cDvUeEeaYcywXuG1V4eRpSeTcxJIIh4f2CfUoaPL', NULL, '139.59.86.7', 'Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUtScklmZWFZUW1ldGlScUp2a3BoSlJqOWxKRms5b3NBS1VReVM4dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZGFsdm9kLm1lZGl1bTMubWsvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753755990),
('Cphrb156RwzHDMLyroBVtBd2TTIaXiRHIHDxbGLv', NULL, '128.199.29.59', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjVIemkyOWdYOWN5cGU3UmU0OENoOXRUdUpYSDNQMU1VUHViWm1QZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kYWx2b2QubWVkaXVtMy5tay9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753921065),
('lffOjarWme7Xe4VRkW2pv4GmYSWYnVp78MVAz0Ig', NULL, '165.22.199.52', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXZwMlo0WFByS09Wa1U2YjNoNkhvN2pmWVVBcjAwbEJ2eE9INVZwciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vd3d3LmRhbHZvZC5tZWRpdW0zLm1rL2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753945116),
('lo2nCeAiXmlxFDS7gXPRxJNOD74V63cI64uT7ghB', NULL, '165.227.217.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWdVUm1TYlVoRTFmN1ZkakhtWVlIZjVTUHpyMXV0ZHNQYmJtc1JGRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vd3d3LmRhbHZvZC5tZWRpdW0zLm1rL2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753769812),
('ng86ReUw9Rhf2kLu1MSRZZN2xFNXHYViDJVsZfvq', NULL, '128.199.29.59', 'Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN293MnEzMnNtQUo1ZU12NjVmZFF2dmFsbHE2TEhTU1NVb20wUGZDciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZGFsdm9kLm1lZGl1bTMubWsvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753921069),
('oOBk7IXVvELAvc3z6yJ9nl5h28pwG4x3zf18dzQ4', NULL, '165.22.199.52', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3hTMHFEN3FnSzVSbnlCWXpSTVhVVmU1YTJySjRndDduSlVzb0x2VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly93d3cuZGFsdm9kLm1lZGl1bTMubWsvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753945115),
('w34NvnPBnJyXb8JNyrDI4oGXPTLz6hxgyv1wfaF9', NULL, '162.142.125.35', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVdjWWdBQkFZaXB2UEtQRFhpTjdSbDRWMURVS1JyUGJ2MThicUNHaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vd3d3LmRhbHZvZC5tZWRpdW0zLm1rL2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1753769515);

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
(1, 'Сашо', 'Димовски', 1, NULL, '911234567891', '', 'saso.dimovski@t.mk', NULL, 'password', '$2y$12$zPCe2dpTLn2AV4afdoKdcOCCZj449z12FfBdDy7cTJ5z.cdzXBt5W', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 0, 1, 1, '2025-03-24 18:26:02', '2025-05-05 16:38:25'),
(2, 'Перо', 'Перовски', 165, NULL, '911234567891', '', 'saso.bass@gmail.mk', NULL, 'username', '$2y$12$FmktJ0CgSmZxqnuvonP2g.V7Obg9a3fDRJF59LuiDcnHCNTHwxBhi', NULL, 'd65750f7428c63c07d0ea1ff23f208bd', 'registration', '2025-03-25 15:07:14', NULL, NULL, 2, 2, 1, 0, 1, 1, '2025-03-24 18:26:02', '2025-03-30 15:45:03'),
(3, 'Киро', 'Тасески', 165, NULL, NULL, '', 'kiro.taseski@gmail.com', NULL, 'kirotaseski', '$2y$12$/4beQcMC3WK6TprlCm0OnuNT9u3PZNaSCGVVFU0f6XM5/.gQKp9g6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 0, 1, 1, '2025-03-31 12:45:11', '2025-07-25 08:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `voltages`
--

CREATE TABLE `voltages` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
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
(1, '20', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(2, '35', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(3, '110', '', 0, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `wind_pressure`
--

CREATE TABLE `wind_pressure` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
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
(1, '50', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(2, '60', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(3, '75', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(4, '90', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(5, '110', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37'),
(6, '130', '', 1, 0, '2025-03-29 16:38:37', '2025-03-29 16:38:37');

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `ground_wires`
--
ALTER TABLE `ground_wires`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `modules_users`
--
ALTER TABLE `modules_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voltages`
--
ALTER TABLE `voltages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wind_pressure`
--
ALTER TABLE `wind_pressure`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
