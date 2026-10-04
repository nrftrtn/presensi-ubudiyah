-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2026 at 02:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi_ubudiyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status_kehadiran` enum('hadir','terlambat','alpha') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `santri_id`, `kegiatan_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `status_kehadiran`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2026-06-12', '18:40:00', NULL, 'hadir', '2026-06-12 04:37:48', '2026-06-12 04:37:48'),
(2, 2, 6, '2026-06-12', '18:48:00', NULL, 'terlambat', '2026-06-12 04:48:40', '2026-06-12 04:48:40'),
(3, 1, 1, '2026-06-12', '11:54:12', NULL, 'terlambat', '2026-06-12 04:54:12', '2026-06-12 04:54:12'),
(4, 2, 1, '2026-06-12', '11:54:27', NULL, 'terlambat', '2026-06-12 04:54:27', '2026-06-12 04:54:27'),
(5, 17, 3, '2026-06-29', '14:23:48', NULL, 'hadir', '2026-06-29 00:23:48', '2026-06-29 00:23:48'),
(6, 16, 4, '2026-06-29', '14:46:24', NULL, 'hadir', '2026-06-29 00:46:24', '2026-06-29 00:46:24'),
(7, 15, 4, '2026-06-29', '14:49:38', NULL, 'hadir', '2026-06-29 00:49:38', '2026-06-29 00:49:38'),
(8, 1, 1, '2026-08-11', '08:41:07', NULL, 'hadir', '2026-08-10 18:41:07', '2026-08-10 18:41:07'),
(9, 11, 1, '2026-08-11', '08:41:51', NULL, 'hadir', '2026-08-10 18:41:51', '2026-08-10 18:41:51'),
(10, 7, 1, '2026-08-11', '08:42:12', NULL, 'hadir', '2026-08-10 18:42:12', '2026-08-10 18:42:12'),
(11, 9, 1, '2026-08-11', '08:42:32', NULL, 'hadir', '2026-08-10 18:42:33', '2026-08-10 18:42:33'),
(12, 21, 1, '2026-08-11', '08:44:15', NULL, 'hadir', '2026-08-10 18:44:15', '2026-08-10 18:44:15'),
(13, 5, 1, '2026-08-11', '08:44:53', NULL, 'hadir', '2026-08-10 18:44:53', '2026-08-10 18:44:53'),
(14, 5, 2, '2026-08-11', '08:55:08', NULL, 'hadir', '2026-08-10 18:55:08', '2026-08-10 18:55:08'),
(15, 13, 2, '2026-08-11', '08:55:40', NULL, 'hadir', '2026-08-10 18:55:40', '2026-08-10 18:55:40'),
(16, 3, 2, '2026-08-11', '08:58:08', NULL, 'hadir', '2026-08-10 18:58:08', '2026-08-10 18:58:08'),
(17, 7, 2, '2026-08-11', '10:43:21', NULL, 'hadir', '2026-08-10 20:43:21', '2026-08-10 20:43:21'),
(18, 9, 3, '2026-08-11', '10:45:08', NULL, 'hadir', '2026-08-10 20:45:08', '2026-08-10 20:45:08'),
(19, 3, 3, '2026-08-11', '10:45:14', NULL, 'hadir', '2026-08-10 20:45:14', '2026-08-10 20:45:14'),
(20, 1, 3, '2026-08-11', '10:45:24', NULL, 'hadir', '2026-08-10 20:45:24', '2026-08-10 20:45:24'),
(21, 7, 3, '2026-08-11', '10:45:30', NULL, 'hadir', '2026-08-10 20:45:30', '2026-08-10 20:45:30'),
(22, 5, 3, '2026-08-11', '10:45:36', NULL, 'hadir', '2026-08-10 20:45:36', '2026-08-10 20:45:36'),
(23, 13, 3, '2026-08-11', '10:45:43', NULL, 'hadir', '2026-08-10 20:45:44', '2026-08-10 20:45:44'),
(24, 11, 3, '2026-08-11', '10:45:52', NULL, 'hadir', '2026-08-10 20:45:52', '2026-08-10 20:45:52'),
(25, 21, 3, '2026-08-11', '10:45:57', NULL, 'hadir', '2026-08-10 20:45:57', '2026-08-10 20:45:57'),
(26, 21, 4, '2026-08-11', '10:50:35', NULL, 'hadir', '2026-08-10 20:50:35', '2026-08-10 20:50:35'),
(27, 9, 4, '2026-08-11', '10:50:45', NULL, 'hadir', '2026-08-10 20:50:45', '2026-08-10 20:50:45'),
(28, 11, 1, '2026-08-12', '09:55:20', NULL, 'hadir', '2026-08-11 19:55:20', '2026-08-11 19:55:20'),
(29, 9, 1, '2026-08-12', '09:56:29', NULL, 'hadir', '2026-08-11 19:56:29', '2026-08-11 19:56:29'),
(30, 7, 1, '2026-08-12', '10:25:02', NULL, 'hadir', '2026-08-11 20:25:02', '2026-08-11 20:25:02'),
(31, 13, 1, '2026-08-12', '10:25:50', NULL, 'hadir', '2026-08-11 20:25:50', '2026-08-11 20:25:50'),
(32, 11, 2, '2026-08-12', '10:50:00', NULL, 'hadir', '2026-08-11 20:50:00', '2026-08-11 20:50:00'),
(33, 21, 2, '2026-08-12', '10:50:01', NULL, 'hadir', '2026-08-11 20:50:01', '2026-08-11 20:50:01'),
(34, 5, 2, '2026-08-12', '10:54:01', NULL, 'hadir', '2026-08-11 20:54:01', '2026-08-11 20:54:01'),
(35, 1, 2, '2026-08-12', '10:57:19', NULL, 'terlambat', '2026-08-11 20:57:19', '2026-08-11 20:57:19'),
(36, 3, 2, '2026-08-12', '11:14:44', NULL, 'hadir', '2026-08-11 21:14:44', '2026-08-11 21:14:44'),
(37, 13, 2, '2026-08-12', '11:15:36', NULL, 'hadir', '2026-08-11 21:15:36', '2026-08-11 21:15:36'),
(38, 7, 2, '2026-08-12', '11:20:00', NULL, 'terlambat', '2026-08-11 21:20:00', '2026-08-11 21:20:00'),
(39, 3, 3, '2026-08-12', '16:13:30', NULL, 'hadir', '2026-08-12 02:13:30', '2026-08-12 02:13:30'),
(40, 11, 3, '2026-08-12', '16:13:33', NULL, 'hadir', '2026-08-12 02:13:33', '2026-08-12 02:13:33'),
(41, 1, 3, '2026-08-12', '16:13:51', NULL, 'hadir', '2026-08-12 02:13:51', '2026-08-12 02:13:51'),
(42, 3, 1, '2026-08-19', '06:32:06', NULL, 'hadir', '2026-08-18 16:32:07', '2026-08-18 16:32:07'),
(43, 11, 1, '2026-08-19', '06:32:23', NULL, 'hadir', '2026-08-18 16:32:23', '2026-08-18 16:32:23'),
(44, 7, 2, '2026-08-19', '07:46:08', NULL, 'hadir', '2026-08-18 17:46:08', '2026-08-18 17:46:08'),
(45, 11, 2, '2026-08-19', '07:46:27', NULL, 'hadir', '2026-08-18 17:46:27', '2026-08-18 17:46:27'),
(46, 3, 2, '2026-08-19', '07:46:47', NULL, 'hadir', '2026-08-18 17:46:47', '2026-08-18 17:46:47'),
(47, 5, 6, '2026-08-26', '20:53:41', NULL, 'hadir', '2026-08-26 06:53:41', '2026-08-26 06:53:41'),
(48, 11, 6, '2026-08-26', '21:01:05', NULL, 'hadir', '2026-08-26 07:01:05', '2026-08-26 07:01:05'),
(49, 1, 6, '2026-08-26', '21:15:28', NULL, 'hadir', '2026-08-26 07:15:28', '2026-08-26 07:15:28'),
(50, 7, 6, '2026-08-26', '21:18:54', NULL, 'hadir', '2026-08-26 07:18:54', '2026-08-26 07:18:54'),
(51, 13, 1, '2026-08-27', '08:00:18', NULL, 'hadir', '2026-08-26 18:00:18', '2026-08-26 18:00:18'),
(52, 1, 2, '2026-08-27', '09:45:02', NULL, 'hadir', '2026-08-26 19:45:02', '2026-08-26 19:45:02'),
(53, 21, 2, '2026-08-27', '09:45:32', NULL, 'hadir', '2026-08-26 19:45:32', '2026-08-26 19:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-prayer_times_2026-09-03', 'a:5:{s:5:\"subuh\";s:8:\"04:08:00\";s:6:\"dzuhur\";s:8:\"11:25:00\";s:5:\"ashar\";s:8:\"14:42:00\";s:7:\"maghrib\";s:8:\"17:24:00\";s:4:\"isya\";s:8:\"18:34:00\";}', 1788458412),
('laravel-cache-prayer_times_2026-09-05', 'a:5:{s:5:\"subuh\";s:8:\"04:07:00\";s:6:\"dzuhur\";s:8:\"11:24:00\";s:5:\"ashar\";s:8:\"14:41:00\";s:7:\"maghrib\";s:8:\"17:24:00\";s:4:\"isya\";s:8:\"18:34:00\";}', 1788633037);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kamar` varchar(255) NOT NULL,
  `blok` varchar(255) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `nama_kamar`, `blok`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'BLOK A', NULL, '2026-06-12 04:20:53', '2026-06-12 04:20:53'),
(2, 'A2', 'BLOK A', NULL, '2026-06-12 04:21:07', '2026-06-12 04:21:07'),
(3, 'A3', 'BLOK A', NULL, '2026-06-12 04:21:16', '2026-06-12 04:21:16'),
(4, 'A4', 'BLOK A', NULL, '2026-06-12 04:21:33', '2026-06-12 04:21:33'),
(6, 'B1', 'BLOK B', NULL, '2026-06-12 04:21:46', '2026-06-12 04:21:46'),
(7, 'B2', 'BLOK B', NULL, '2026-06-12 04:21:56', '2026-06-12 04:21:56'),
(8, 'B3', 'BLOK B', NULL, '2026-06-12 04:22:11', '2026-06-12 04:22:11'),
(9, 'B4', 'BLOK B', NULL, '2026-06-12 04:22:26', '2026-06-12 04:22:26'),
(10, 'C1', 'BLOK C', NULL, '2026-06-12 04:23:48', '2026-06-12 04:23:48'),
(11, 'C2', 'BLOK C', NULL, '2026-06-12 04:24:05', '2026-06-12 04:24:05'),
(12, 'C3', 'BLOK C', NULL, '2026-06-12 04:24:23', '2026-06-12 04:24:23'),
(13, 'D1', 'BLOK D', NULL, '2026-06-12 04:24:48', '2026-06-12 04:24:48'),
(14, 'D2', 'BLOK D', NULL, '2026-06-12 04:25:03', '2026-06-12 04:25:03'),
(15, 'D3', 'BLOK D', NULL, '2026-06-12 04:25:20', '2026-06-12 04:25:20'),
(16, 'PONDOK BAWAH', 'BLOK BAWAH', NULL, '2026-06-12 04:25:32', '2026-06-12 04:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `jenis_jadwal` enum('harian','mingguan') NOT NULL DEFAULT 'harian',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `hari` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `nama_kegiatan`, `jenis_jadwal`, `jam_mulai`, `jam_selesai`, `hari`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jamaah Subuh', 'harian', '08:00:00', '08:10:00', 'Kamis', 'aktif', '2026-06-12 04:27:20', '2026-08-26 18:00:02'),
(2, 'Jamaah Dzuhur', 'harian', '09:43:00', '09:53:00', 'Kamis', 'aktif', '2026-06-12 04:27:40', '2026-08-26 19:43:51'),
(3, 'Jamaah Ashar', 'harian', '16:09:00', '16:19:00', 'Rabu', 'aktif', '2026-06-12 04:28:12', '2026-08-12 02:09:37'),
(4, 'Ratibul Haddad', 'harian', '17:00:00', '17:30:00', 'Setiap Hari', 'aktif', '2026-06-12 04:29:33', '2026-09-02 22:58:03'),
(5, 'Jamaah Maghrib', 'harian', '17:45:00', '17:55:00', 'Senin', 'aktif', '2026-06-12 04:33:14', '2026-06-12 04:33:14'),
(6, 'Jamaah Isya\'', 'harian', '21:15:00', '21:25:00', 'Rabu', 'aktif', '2026-06-12 04:34:08', '2026-08-26 07:14:37'),
(7, 'Diba\'iyah', 'mingguan', '19:30:00', '20:00:00', 'Kamis', 'aktif', '2026-06-12 04:34:45', '2026-09-02 22:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_21_084236_create_kamars_table', 1),
(5, '2026_05_21_084633_create_santris_table', 1),
(6, '2026_05_25_085606_create_kegiatans_table', 1),
(7, '2026_05_28_082459_create_absensis_table', 1),
(8, '2026_06_01_083209_update_status_kehadiran_absensis_table', 1),
(9, '2026_09_03_034243_update_absensis_for_masuk_keluar', 2),
(10, '2026_09_03_041333_add_jenis_jadwal_to_kegiatans_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `santris`
--

CREATE TABLE `santris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kamar_id` bigint(20) UNSIGNED NOT NULL,
  `uid_rfid` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `santris`
--

INSERT INTO `santris` (`id`, `nama`, `kamar_id`, `uid_rfid`, `alamat`, `no_hp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Aminah Az-Zuhriyah', 1, '1B:E0:36:39', 'Jaddung Pragaan Sumenep', '081234567283', 'aktif', '2026-06-12 04:36:17', '2026-08-10 18:36:54'),
(2, 'Arina Yasmin', 1, 'RFID002', 'Lenteng Sumenep', '081234567287', 'aktif', '2026-06-12 04:48:02', '2026-06-12 04:48:02'),
(3, 'Anindiya Adeeva Mysa Putri', 2, '5D:C5:2E:39', 'Moncek Tengah Lenteng', '081234567283', 'aktif', '2026-06-13 23:21:47', '2026-08-10 18:58:01'),
(4, 'Dewi Intan Purnama', 2, 'RFID202', 'Bataal Barat Ganding', '081234567283', 'aktif', '2026-06-13 23:22:38', '2026-06-13 23:22:38'),
(5, 'Azza Rifa Huwaidah Rachman', 3, 'E7:A5:2E:39', 'Palalang, Pakong, Pamekasan', '081234567283', 'aktif', '2026-06-13 23:23:37', '2026-08-08 01:38:31'),
(6, 'Gina Suci Ramadani', 3, 'RFID302', 'Seddur, Pakong, Pamekasan', '081234567283', 'aktif', '2026-06-13 23:24:27', '2026-06-13 23:24:27'),
(7, 'Arika Virgina Qonita', 4, '59:4E:2F:39', 'Ganding, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:25:45', '2026-08-08 01:39:21'),
(8, 'Barrotun Naqiyah', 4, 'RFID403', 'Ketawang Laok, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:26:39', '2026-06-13 23:26:39'),
(9, 'Aisyah Hanien Aulia HS', 6, '33:58:2F:39', 'Payudan Nangger, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:28:59', '2026-08-08 01:40:34'),
(10, 'A\'isyatul Fitriyah', 6, 'RFID502', 'Pakamban Daya, Pragaan Sumenep', '081234567283', 'aktif', '2026-06-13 23:30:38', '2026-06-13 23:30:38'),
(11, 'Azkia Zanata Haq', 7, 'AA:19:2F:39', 'Bragung, Gulul-guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:31:45', '2026-08-08 01:41:32'),
(13, 'Dina Madinatul Munawaroh', 8, 'CD:68:2E:39', 'Kertagena Laok, Kadur, Pamekasan', '081234567283', 'aktif', '2026-06-13 23:33:36', '2026-08-08 01:42:12'),
(14, 'Dini Makkatul Mukarromah', 8, 'RFID702', 'Kertagena Laok, Kadur, Pamekasan', '081234567283', 'aktif', '2026-06-13 23:34:41', '2026-06-13 23:34:41'),
(15, 'Afni Fuji Ababil', 9, 'RFID801', 'Moncek Timur, Lenteng, Sumenep', '081234567283', 'aktif', '2026-06-13 23:35:41', '2026-07-25 08:37:30'),
(16, 'Asbiliyah Kamalil Aisyi', 9, 'RFID802', 'Prenduan, Pragaan, Sumenep', '081234567283', 'aktif', '2026-06-13 23:36:32', '2026-06-13 23:36:32'),
(17, 'Afrida Cantika Dewi Susanto', 10, 'RFID901', 'Kebun dadab Barat, Saronggi, Sumenep', '081234567283', 'aktif', '2026-06-13 23:37:22', '2026-06-13 23:37:22'),
(20, 'Alya Nafarina Maulida', 10, 'RFID902', 'Guluk-guluk, Guluk-guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:39:01', '2026-06-13 23:39:01'),
(21, 'Aini Zahratul Aulia', 11, '60:1C:2F:39', 'Ketawang Laok, Guluk-guluk, Sumenep', '087822069803', 'aktif', '2026-06-13 23:40:20', '2026-08-10 18:44:10'),
(22, 'Almar\'atus shalihah', 11, 'RFID102', 'Lengkong Bragung, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:41:36', '2026-06-13 23:41:36'),
(23, 'Aisyatul Masrurah', 12, 'RFID1101', 'Aeng Panas, Pragaan, Sumenep', '081234567283', 'aktif', '2026-06-13 23:42:25', '2026-07-26 04:39:33'),
(24, 'Barrotut Taqiyah', 12, 'RFID1102', 'Klabaan laok, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-06-13 23:43:19', '2026-07-26 04:40:04'),
(25, 'Eka Yanti', 10, 'RFID903', 'Kertagena Tengah, Kadur, Pamekasan', '081935164416', 'aktif', '2026-07-25 06:17:48', '2026-07-25 06:17:48'),
(26, 'Faidatul Fathinah', 10, 'RFID904', 'Tambuko, Guluk-guluk, Sumenep', '082334965784', 'aktif', '2026-07-25 06:18:50', '2026-07-25 06:18:50'),
(27, 'Faradiba Annisa\'us Sholihah', 10, 'RFID905', 'Ketawang Laok, Guluk-Guluk, Sumenep', '081334256789', 'aktif', '2026-07-25 06:20:35', '2026-07-25 06:20:35'),
(28, 'Fatimatus Zahroil Batul', 10, 'RFID906', 'Payudan Nangger, Guluk-guluk, Sumenep', '08595958417', 'aktif', '2026-07-25 06:22:45', '2026-07-25 06:22:45'),
(29, 'Helmia Nabila', 10, 'RFID907', 'Romben Guna, Dungkek, Sumenep', '087818332241', 'aktif', '2026-07-25 06:24:56', '2026-07-25 06:24:56'),
(31, 'Infitahul Faizah', 10, 'RFID908', 'Jambesari, Jambesari Darus Sholah, Bondowoso', '085234872129', 'aktif', '2026-07-25 06:26:06', '2026-07-25 06:26:06'),
(33, 'Intan Ramadhani', 10, 'RFID909', 'Lembung Barat, Lenteng, Sumenep', '081256743908', 'aktif', '2026-07-25 06:27:49', '2026-07-25 06:31:18'),
(34, 'Musfirotul Jannah', 10, 'RFID910', 'Ketawang Laok, Guluk-guluk, Sumenep', '082989855641', 'aktif', '2026-07-25 06:30:46', '2026-07-25 06:30:46'),
(35, 'Najmatul Millah', 10, 'RFID911', 'Moh. Jufri', '087865552212', 'aktif', '2026-07-25 06:32:22', '2026-07-25 06:32:22'),
(36, 'Nuri Fitrotin', 10, 'RFID912', 'Banaresep Barat, Lenteng, Sumenep', '081346789325', 'aktif', '2026-07-25 06:35:57', '2026-07-25 06:35:57'),
(37, 'Nuri Utiya Jauhirotus Sunanah', 10, 'RFID913', 'Kaduara Timur, Pragaan, Sumenep', '082343577689', 'aktif', '2026-07-25 06:36:44', '2026-07-25 06:36:44'),
(38, 'Sisil Maurin Fitriyani', 10, 'RFID914', 'Jate, Gili Raja, Sumenep', '087856445678', 'aktif', '2026-07-25 06:37:42', '2026-07-25 06:37:42'),
(39, 'Suci Amaliatur Rofi\'ah', 10, 'RFID915', 'Payudan Karangsokon, Guluk-guluk, Sumenep', '087657453235', 'aktif', '2026-07-25 06:38:37', '2026-07-25 06:38:37'),
(40, 'Umi Miftahurrohmaniyah', 10, 'RFID916', 'Koncer Kidul, Tenggarang, Bondowoso', '087889645679', 'aktif', '2026-07-25 06:39:42', '2026-07-25 06:39:42'),
(41, 'Wasilah Faiz', 10, 'RFID917', 'Kertagena Daya, Kadur, Pamekasan', '081358699865', 'aktif', '2026-07-25 06:40:34', '2026-07-25 06:42:07'),
(42, 'Fudhlal Hidayah', 11, 'RFID103', 'Ging-Ging, Bluto, Sumenep', '081334256788', 'aktif', '2026-07-25 06:45:26', '2026-07-25 06:45:26'),
(43, 'Halilah', 11, 'RFID104', 'Bungbaruh, Kadur, Pamekasan', '08595958412', 'aktif', '2026-07-25 06:46:04', '2026-07-25 06:46:04'),
(44, 'Hoiriyah', 11, 'RFID105', 'Payudan Nangger, Guluk-guluk, Sumenep', '082334965787', 'aktif', '2026-07-25 06:47:22', '2026-07-25 06:47:22'),
(45, 'Isyti Rozana', 11, 'RFID106', 'Bataal Barat, Ganding, Sumenep', '082334965787', 'aktif', '2026-07-25 06:48:00', '2026-07-25 06:48:00'),
(46, 'Izzatul Lizamah', 11, 'RFID107', 'Montok, Larangan, Pamekasan', '082241017834', 'aktif', '2026-07-25 06:48:51', '2026-07-25 06:48:51'),
(47, 'Laila Maulidur Rahmah', 11, 'RFID108', 'Kaduara Barat, Larangan, Pamekasan', '081234567287', 'aktif', '2026-07-25 06:50:01', '2026-07-25 06:50:01'),
(48, 'Maftuhatur Romah AZ', 11, 'RFID109', 'Ponteh, Galis, Pamekasan', '081935164417', 'aktif', '2026-07-25 06:51:00', '2026-07-25 06:51:00'),
(49, 'Nazela Kholidia', 11, 'RFID110', 'Ponteh, Galis, Pamekasan', '082334965786', 'aktif', '2026-07-25 06:51:55', '2026-07-25 06:51:55'),
(53, 'Nur Fadhila', 11, 'RFID113', 'Romben Guna, Dungkek, Sumenep', '081935164416', 'aktif', '2026-07-25 06:55:01', '2026-07-25 06:55:01'),
(54, 'Qarinah Ema Kamilia Putri', 11, 'RFID114', 'Moncek Tengah, lenteng, Sumenep', '082334965785', 'aktif', '2026-07-25 06:59:17', '2026-07-25 06:59:17'),
(55, 'Yasaratul Hasanah', 11, 'RFID115', 'Mandala, Rubaru, Sumenep', '082334965783', 'aktif', '2026-07-25 07:00:10', '2026-07-25 07:00:10'),
(56, 'Diniatus Shalehah', 1, 'RFID003', 'Bragung, Guluk-Guluk, Sumenep', '081334256784', 'aktif', '2026-07-25 07:01:23', '2026-07-25 07:01:23'),
(57, 'Fika Esa Belian', 1, 'RFID004', 'Parebbaan Bragung, Guluk-Guluk, Sumenep', '081334256782', 'aktif', '2026-07-25 07:02:03', '2026-07-25 07:02:03'),
(58, 'Maulidiya Jamaliyah', 1, 'RFID005', 'Payudan Daleman, Guluk-Guluk, Sumenep', '082334965781', 'aktif', '2026-07-25 07:05:25', '2026-07-25 07:05:25'),
(59, 'Najahatin', 1, 'RFID006', 'Bragung, Guluk-Guluk, Sumenep', '081256743901', 'aktif', '2026-07-25 07:05:58', '2026-07-25 07:05:58'),
(60, 'Najana Kamala Nihaya Izzaty', 1, 'RFID007', 'Cangkreng, Lenteng, Sumenep', '082334965786', 'aktif', '2026-07-25 07:06:43', '2026-07-25 07:06:43'),
(61, 'Nilna Alfi Karomah', 1, 'RFID008', 'Guluk-Guluk, Guluk-Guluk, Sumenep', '082334965786', 'aktif', '2026-07-25 07:07:44', '2026-07-25 07:07:44'),
(62, 'Nur Amelia', 1, 'RFID009', 'Bragung, Guluk-Guluk, Sumenep', '081935164415', 'aktif', '2026-07-25 07:08:21', '2026-07-25 07:08:21'),
(63, 'Qanita Qatrunnada', 1, 'RFID010', 'Babbalan, Batuan, Sumenep', '082334965789', 'aktif', '2026-07-25 07:09:02', '2026-07-25 07:09:02'),
(65, 'Rifda Fatin Syadida', 1, 'RFID012', 'Bragung, Guluk-Guluk, Sumenep', '081256743904', 'aktif', '2026-07-25 07:10:31', '2026-07-25 07:10:31'),
(66, 'Dini Juliana', 2, 'RFID203', 'Dungkek, Dungkek, Sumenep', '082334965789', 'aktif', '2026-07-25 07:14:25', '2026-07-25 07:14:25'),
(67, 'Istianah Maulida', 2, 'RFID204', 'Gadu Barat, Ganding, Sumenep', '081935164416', 'aktif', '2026-07-25 07:15:32', '2026-07-26 21:56:03'),
(68, 'Masruratul Hasna\'', 2, 'RFID205', 'Ketawang Laok, Guluk- guluk, Sumenep', '081234567282', 'aktif', '2026-07-25 07:19:55', '2026-07-25 07:19:55'),
(69, 'Najla Syakira', 2, 'RFID206', 'Lenteng Barat, Lenteng, Sumenep', '081935164415', 'aktif', '2026-07-25 07:21:59', '2026-07-25 07:21:59'),
(70, 'Najmi Malaeka', 2, 'RFID207', 'Aeng Baja Kenek, Bluto, Sumenep', '082334965787', 'aktif', '2026-07-25 07:23:25', '2026-07-25 07:23:25'),
(71, 'Rofi Islaman Ovita Istighfaroh', 2, 'RFID208', 'Pananggungan, Guluk-guluk, Sumenep', '081935164416', 'aktif', '2026-07-25 07:24:12', '2026-07-25 07:24:12'),
(72, 'Sakhiyyatun Nisa\' Assadah', 2, 'RFID209', 'Aeng Panas, Pragaan, Sumenep', '081935164415', 'aktif', '2026-07-25 07:25:38', '2026-07-25 07:25:38'),
(73, 'Shireen Najma Aulia', 2, 'RFID210', 'Banaresep Barat, Lenteng, Sumenep', '081256743908', 'aktif', '2026-07-25 07:26:18', '2026-07-25 07:26:18'),
(74, 'Zidny Kaylanni\' Ami', 2, 'RFID211', 'Legung Timur, Batang-Batang, Sumenep', '082334965787', 'aktif', '2026-07-25 07:26:55', '2026-07-25 07:26:55'),
(75, 'Ifadatul Hasanah', 3, 'RFID303', 'Kertagena Daya, Kadur, Pamekasan', '082334965786', 'aktif', '2026-07-25 07:28:25', '2026-07-25 07:28:25'),
(79, 'Lainatul Kholbi', 3, 'RFID304', 'Rombiya Barat, Ganding, Sumenep', '081935164417', 'aktif', '2026-07-25 07:29:52', '2026-07-25 07:29:52'),
(80, 'Nur Azizah', 3, 'RFID305', 'Karang Sokon, Guluk-Guluk, Sumenep', '081935164415', 'aktif', '2026-07-25 07:31:43', '2026-07-25 07:31:43'),
(81, 'Qarni Aina', 3, 'RFID306', 'Sumberkima, Gerokgak, Buleleng', '081256743908', 'aktif', '2026-07-25 07:33:30', '2026-07-25 07:33:30'),
(82, 'Shofiatus Sholehah', 3, 'RFID307', 'Aeng Panas, Pragaan, Sumenep', '081256743908', 'aktif', '2026-07-25 07:34:39', '2026-07-25 07:34:39'),
(83, 'Untsa Imami', 3, 'RFID308', 'Rombiya Barat, Ganding, Sumenep', '082334965786', 'aktif', '2026-07-25 07:35:21', '2026-07-25 07:35:21'),
(84, 'Wildatul Ummamah', 3, 'RFID309', 'Klompang Timur, Pakong, Pamekasan', '082334965787', 'aktif', '2026-07-25 07:36:25', '2026-07-25 07:36:25'),
(85, 'Yunizar Fatonah', 3, 'RFID310', 'Pananggungan, Guluk-Guluk, Sumenep', '082334965786', 'aktif', '2026-07-25 07:40:39', '2026-07-25 07:40:39'),
(86, 'Zahratul Jannah', 3, 'RFID311', 'Bataal Timur, Ganding, Sumenep', '081935164416', 'aktif', '2026-07-25 07:41:20', '2026-07-25 07:41:20'),
(88, 'Fardatus Sholihah', 4, 'RFID402', 'Batuputih Kenek, Batuputih, Sumenep', '081256743908', 'aktif', '2026-07-25 07:45:26', '2026-07-25 07:45:26'),
(89, 'Lusi Amelia', 4, 'RFID404', 'Payudan, Dundang, Sumenep', '081935164415', 'aktif', '2026-07-25 07:46:11', '2026-07-25 07:46:11'),
(90, 'Maratus Sholihah', 4, 'RFID405', 'Jate, Gili Raja, Sumenep', '082334965787', 'aktif', '2026-07-25 07:48:20', '2026-07-25 07:48:20'),
(91, 'Maulidia Fajariyah Romadan', 4, 'RFID406', 'Bragung, Guluk-Guluk, Sumenep', '081935164416', 'aktif', '2026-07-25 07:49:55', '2026-07-25 07:49:55'),
(92, 'Mufidah', 4, 'RFID407', 'Bragung, Guluk-Guluk, Sumenep', '081935164415', 'aktif', '2026-07-25 07:50:36', '2026-07-25 07:50:36'),
(93, 'Nabilatus Sa\'adah', 4, 'RFID408', 'Ketawang Laok, Guluk-Guluk, Sumenep', '082334965787', 'aktif', '2026-07-25 07:52:45', '2026-07-25 07:52:45'),
(97, 'Nadiatul Hasna\'', 4, 'RFID409', 'Payudan, Nangger, Sumenep', '081256743907', 'aktif', '2026-07-25 07:54:47', '2026-07-25 07:54:47'),
(98, 'Syema Rumaisha', 4, 'RFID410', 'Ketawang Laok, Guluk-guluk, Sumenep', '081935164415', 'aktif', '2026-07-25 08:02:29', '2026-07-25 08:02:29'),
(99, 'Tanzilia Fanny Rasyid', 4, 'RFID411', 'Guluk-Guluk, Guluk-Guluk, Sumenep', '082334965787', 'aktif', '2026-07-25 08:03:10', '2026-07-25 08:03:10'),
(100, 'Zaskiya zahrana Aqila', 4, 'RFID412', 'Kaduara Timur, Pragaan, Sumenep', '082334965786', 'aktif', '2026-07-25 08:03:51', '2026-07-25 08:03:51'),
(101, 'Dinda Zakiyatun Nafisah', 6, 'RFID503', 'Rombasan, Pragaan, Sumenep', '081935164416', 'aktif', '2026-07-25 08:06:04', '2026-07-25 08:06:04'),
(102, 'Humairo Fitritillah', 6, 'RFID504', 'Lapataman, Dungkek, Sumenep', '081935164415', 'aktif', '2026-07-25 08:06:51', '2026-07-25 08:06:51'),
(103, 'Inayaturrobbaniyah', 6, 'RFID505', 'Palalang, Pakong, Pamekasan', '082334965787', 'aktif', '2026-07-25 08:08:49', '2026-07-25 08:08:49'),
(104, 'Khoirunnisa Al-Maghfiroh', 6, 'RFID506', 'Jambesari Darus Sholah, Bondowoso', '081256743908', 'aktif', '2026-07-25 08:10:34', '2026-07-25 08:10:34'),
(105, 'Khoridatun Nabila', 6, 'RFID507', 'Poreh, Lenteng, Sumenep', '082334965786', 'aktif', '2026-07-25 08:11:46', '2026-07-25 08:11:46'),
(106, 'Mamluatul Hasanah', 6, 'RFID508', 'Katawang Laok, Guluk-guluk, Sumenep', '081935164416', 'aktif', '2026-07-25 08:13:30', '2026-07-25 08:13:30'),
(107, 'Nuril Asyifa Rhamadani', 6, 'RFID509', 'Billapora Barat, Ganding, Sumenep', '081256743908', 'aktif', '2026-07-25 08:15:08', '2026-07-25 08:15:08'),
(108, 'Roza Isatul Mahbubah', 6, 'RFID510', 'Aeng Merah, Batu Putih, Sumenep', '081935164415', 'aktif', '2026-07-25 08:16:06', '2026-07-25 08:16:06'),
(109, 'Silvi Yuliana Putri', 6, 'RFID511', 'Jaddung, Pragaan, Sumenep', '081234567283', 'aktif', '2026-07-25 08:16:54', '2026-07-25 08:16:54'),
(110, 'Yunita Syarifah', 6, 'RFID512', 'Kertagena Laok, Kadur, Pamekasan', '081256743908', 'aktif', '2026-07-25 08:17:37', '2026-07-25 08:17:37'),
(111, 'Zahrotul Maghfiroh', 6, 'RFID513', 'Campaka, Pasongsongan, Sumenep', '082334965787', 'aktif', '2026-07-25 08:18:23', '2026-07-25 08:18:23'),
(112, 'Zainab', 6, 'RFID514', 'Gadu Barat, Ganding, Sumenep', '081256743908', 'aktif', '2026-07-25 08:19:13', '2026-07-25 08:19:13'),
(113, 'Elin Faulina Safika', 7, 'RFID602', 'Gelaman, Arjasa, Sumenep', '082334965786', 'aktif', '2026-07-25 08:21:17', '2026-07-25 08:21:17'),
(114, 'Fara Adnia Zizkien', 7, 'RFID603', 'Kertagena Tengah, Kadur, Pamekasan', '081935164415', 'aktif', '2026-07-25 08:22:12', '2026-07-25 08:22:12'),
(115, 'Hestin Arifanda', 7, 'RFID604', 'Lapalaok, Dungkek, Sumenep', '082334965786', 'aktif', '2026-07-25 08:22:55', '2026-07-25 08:22:55'),
(116, 'Ihza Maulana Shofa', 7, 'RFID605', 'Ketawang Laok, Guluk0guluk, Sumenep', '081256743908', 'aktif', '2026-07-25 08:23:44', '2026-07-25 08:23:44'),
(117, 'Ismatul Mardiyah', 7, 'RFID606', 'Montok, Larangan, Pamekasan', '081256743908', 'aktif', '2026-07-25 08:24:23', '2026-07-25 08:24:23'),
(118, 'Khoiratun Nisah', 7, 'RFID607', 'Dempo Barat, Pasaen, Pamekasan', '082334965786', 'aktif', '2026-07-25 08:25:15', '2026-07-25 08:25:15'),
(119, 'Kholida al-Zahro\' Al-Hakim', 3, 'RFID313', 'Payudan, Nangger, Sumenep', '082334965786', 'aktif', '2026-07-25 08:26:35', '2026-07-25 08:26:35'),
(120, 'Mala RJ', 7, 'RFID608', 'Ganding, Ganding, Sumenep', '082334965786', 'aktif', '2026-07-25 08:28:00', '2026-07-25 08:28:00'),
(121, 'Mufida Alin Ifkan Nabila', 7, 'RFID609', 'Gadu Barat, Ganding, Sumenep', '081935164416', 'aktif', '2026-07-25 08:28:45', '2026-07-25 08:28:45'),
(122, 'Mutmainnah', 7, 'RFID610', 'Guluk Manjung, Bluto, Sumenep', '081935164415', 'aktif', '2026-07-25 08:29:51', '2026-07-25 08:29:51'),
(123, 'Nafilatul Fajriyah', 7, 'RFID611', 'Lembung Timur, lenteng, Sumenep', '082334965786', 'aktif', '2026-07-25 08:30:36', '2026-07-25 08:30:36'),
(124, 'Noer Annisa', 7, 'RFID612', 'Guluk-guluk, Guluk-guluk, Sumenep', '082334965786', 'aktif', '2026-07-25 08:31:22', '2026-07-25 08:31:22'),
(125, 'Rahma Aliya Zakiya Derajat', 7, 'RFID613', 'Kaduara Timur, Pragaan, Sumenep', '081256743908', 'aktif', '2026-07-25 08:32:03', '2026-07-25 08:32:03'),
(126, 'Shofiatul Kamilah', 7, 'RFID614', 'Kaduara Timur, Pragaan, Sumenep', '082334965787', 'aktif', '2026-07-25 08:32:47', '2026-07-25 08:32:47'),
(127, 'Siti Farahiyatur Rasyidiyyah Fina', 7, 'RFID615', 'Giring, Manding, Sumenep', '081935164415', 'aktif', '2026-07-25 08:33:33', '2026-07-25 08:33:33'),
(130, 'Farahatuz Zahroh', 8, 'RFID703', 'Jatinegara, Cakung, Jakarta Timur', '081935164415', 'aktif', '2026-07-25 08:38:46', '2026-07-25 08:38:46'),
(131, 'Ilfa An Najwa', 8, 'RFID704', 'Payudan Dundang, Guluk-Guluk, Sumenep', '082334965786', 'aktif', '2026-07-25 08:39:25', '2026-07-25 08:39:25'),
(132, 'Lailatul Qomariyah', 8, 'RFID705', 'Sentol Daya, Pragaan, Sumenep', '082334965787', 'aktif', '2026-07-25 08:40:04', '2026-07-25 08:40:04'),
(133, 'Mufida Amin', 8, 'RFID706', 'Kertagena Laok, Kadur, Pamekasan', '082334965787', 'aktif', '2026-07-25 08:40:47', '2026-07-25 08:40:47'),
(134, 'Naura Febriza', 8, 'RFID707', 'Soloh Timur, Pademmawu, Pamekasan', '081935164415', 'aktif', '2026-07-25 08:41:28', '2026-07-25 08:41:28'),
(135, 'Qorina Nisa Fahma Ismillah', 8, 'RFID708', 'Kertagena Laok, Kadur, Pamekasan', '082334965786', 'aktif', '2026-07-25 08:42:14', '2026-07-25 08:42:14'),
(136, 'Rifdatin Nabila', 8, 'RFID709', 'Payudan Nangger, Guluk-Guluk, Sumenep', '081935164415', 'aktif', '2026-07-25 08:42:52', '2026-07-25 08:42:52'),
(137, 'Syafa\'atin Risqika Pangestu', 8, 'RFID710', 'Kaduara Timur, Pragaan, Sumenep', '081935164416', 'aktif', '2026-07-25 08:43:29', '2026-07-25 08:43:29'),
(138, 'Wahiyatul Jamilah', 8, 'RFID711', 'Ketawang Laok, Guluk-guluk, Sumenep', '081935164416', 'aktif', '2026-07-25 08:44:20', '2026-07-25 08:44:20'),
(140, 'Asbiliyah Kamalil Aisyi', 9, 'RFID803', 'Prenduan, Pragaan, Sumenep', '081256743908', 'aktif', '2026-07-25 08:48:26', '2026-07-25 08:48:26'),
(141, 'Faidatul Karomah', 9, 'RFID804', 'Aeng Panas, Pragaan, Sumenep', '081935164416', 'aktif', '2026-07-25 08:49:13', '2026-07-25 08:49:13'),
(142, 'Helsah Ilham Putri', 9, 'RFID805', 'Tonduk Raas, Raas, Sumenep', '081935164416', 'aktif', '2026-07-25 08:50:56', '2026-07-25 08:50:56'),
(143, 'Hikmatul Mufidah', 9, 'RFID806', 'Sumenep', '081935164416', 'aktif', '2026-07-25 08:51:53', '2026-07-25 08:51:53'),
(144, 'Keisha Aulia', 9, 'RFID807', 'Tobal Tengah, Sokobanah, Sampang', '081256743908', 'aktif', '2026-07-25 08:52:41', '2026-07-25 08:52:41'),
(146, 'Maidatul Mukholisah', 9, 'RFID808', 'Gadding, Manding, Sumenep', '081935164416', 'aktif', '2026-07-25 08:54:08', '2026-07-25 08:54:08'),
(147, 'Musyarrofah', 9, 'RFID809', 'Karduluk, Pragaan, Sumenep', '081935164416', 'aktif', '2026-07-25 08:54:48', '2026-07-25 08:54:48'),
(148, 'Nasyila Romadani', 9, 'RFID810', 'Manding, Sumenep', '081935164415', 'aktif', '2026-07-25 08:55:22', '2026-07-25 08:55:22'),
(149, 'Neisya Syahrani al Khumairoh', 9, 'RFID811', 'Banaresep, Lenteng, Sumenep', '081256743908', 'aktif', '2026-07-25 08:55:55', '2026-07-25 08:55:55'),
(150, 'Riqotun Nafisah', 9, 'RFID812', 'Banaresep Barat, Lenteng, Sumenep', '081234567283', 'aktif', '2026-07-26 04:24:42', '2026-07-26 04:33:43'),
(151, 'Safa Binti Nisfatullailatuh', 9, 'RFID813', 'Moncek Tengah, Lenteng, Sumenep', '081935164415', 'aktif', '2026-07-26 04:25:23', '2026-07-26 04:25:23'),
(153, 'Sania Ramadani', 9, 'RFID814', 'Banaresep Timur,  Lenteng, Sumenep', '081935164415', 'aktif', '2026-07-26 04:27:30', '2026-07-26 04:27:30'),
(154, 'Sofiyyatina Maulidia', 9, 'RFID815', 'Banaresep Barat, Lenteng, Sumenep', '081256743908', 'aktif', '2026-07-26 04:29:18', '2026-07-26 04:29:18'),
(155, 'Ulfatur Rofi\'ah', 9, 'RFID816', 'Banaresep Timur, Lenteng, sumenep', '082334965787', 'aktif', '2026-07-26 04:34:30', '2026-07-26 04:34:30'),
(159, 'Fajriyah Maimunah Al-Hakim', 12, 'RFID1103', 'Payudan Nangger, Guluk-Guluk, Sumenep', '082334965787', 'aktif', '2026-07-26 04:39:15', '2026-07-26 05:00:47'),
(160, 'Ikrimah Al-Farisi', 12, 'RFID1104', 'Payudan Karangsokon, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 04:57:44', '2026-07-26 05:01:07'),
(162, 'Laily Fauziyah', 12, 'RFID1105', 'Lenteng Barat, Lenteng, Sumenep', '082334965787', 'aktif', '2026-07-26 05:00:08', '2026-07-26 05:01:24'),
(163, 'Lia Noer Fadila', 12, 'RFID1106', 'Karangmalang, Jambesari, Bondowoso', '081935164416', 'aktif', '2026-07-26 05:03:13', '2026-07-26 05:03:13'),
(164, 'Mabrurotun Naqiyah', 12, 'RFID1107', 'Klabaan Laok, Guluk-Guluk, Sumenep', '082334965786', 'aktif', '2026-07-26 05:05:03', '2026-07-26 05:05:03'),
(165, 'Mubarokah Dini Fajriyah', 12, 'RFID1108', 'Guluk-Guluk, Sumenep', '081256743908', 'aktif', '2026-07-26 05:07:13', '2026-07-26 05:07:13'),
(166, 'Niswatil Hissy Amalia Putri', 12, 'RFID1109', 'Moncek Barat, Lenteng, Sumenep', '082334965786', 'aktif', '2026-07-26 05:07:51', '2026-07-26 05:07:51'),
(167, 'Ulfiati Nuril Mustafida', 12, 'RFID1110', 'Pakamban Daya, Pragaan, Sumenep', '082334965787', 'aktif', '2026-07-26 05:08:29', '2026-07-26 05:08:29'),
(168, 'Aftiyana Jessi', 13, 'RFID1201', 'Tamidung, Batang-Batang, Sumenep', '081935164416', 'aktif', '2026-07-26 21:26:37', '2026-07-26 21:26:37'),
(169, 'Dina Syafiqotun Nabila', 13, 'RFID1202', 'Gunungmalang, Sumberjambe, Jember', '081256743908', 'aktif', '2026-07-26 21:28:18', '2026-07-26 21:29:58'),
(170, 'Faza Ilya Kamalia', 13, 'RFID1203', 'Dungkek, Dungkek, Sumenep', '081935164415', 'aktif', '2026-07-26 21:29:32', '2026-07-26 21:30:20'),
(171, 'Ilvi Luqiyana Najwah', 13, 'RFID1204', 'Manding, Laok, Manding, Sumenep', '081256743908', 'aktif', '2026-07-26 21:31:43', '2026-07-26 21:31:43'),
(172, 'Luis Chamaliyah', 13, 'RFID1205', 'Dungkek, Dungkek, Sumenep', '081935164415', 'aktif', '2026-07-26 21:32:50', '2026-07-26 21:32:50'),
(173, 'Nabila', 13, 'RFID1206', 'Basuka, Rubaru, Sumenep', '082334965786', 'aktif', '2026-07-26 21:34:08', '2026-07-26 21:52:45'),
(175, 'Mellisa Cristie', 4, 'RFID413', 'Bragung, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 21:37:45', '2026-07-26 21:37:45'),
(176, 'Nabilatun Najwah', 13, 'RFID1207', 'Sogian, Ambunten, Sumenep', '081234567283', 'aktif', '2026-07-26 21:38:59', '2026-07-26 21:38:59'),
(177, 'Qurratul Aini', 13, 'RFID1208', 'Batukerbuy, Pasean, Pamekasan', '082334965787', 'aktif', '2026-07-26 21:40:04', '2026-07-26 21:40:04'),
(178, 'Rukyal Ainin El-Firdausy', 13, 'RFID1209', 'Rombasan, Pragaan, Sumenep', '081935164415', 'aktif', '2026-07-26 21:41:20', '2026-07-26 21:41:20'),
(179, 'Sabrina Farhati', 13, 'RFID1210', 'Sogian, Ambunten, Sumenep', '081256743908', 'aktif', '2026-07-26 21:42:19', '2026-07-26 21:42:19'),
(180, 'Salsabila Putri Aryani', 13, 'RFID1211', 'Manding Laok, Manding, Sumenep', '081935164416', 'aktif', '2026-07-26 21:43:41', '2026-07-26 21:43:41'),
(181, 'Siskatul Azizah', 13, 'RFID1212', 'Dungkek, Dungkek, Sumenep', '081234567283', 'aktif', '2026-07-26 21:44:36', '2026-07-26 21:44:36'),
(182, 'Siti Nur Wasilahtul Bahiro', 13, 'RFID1213', 'Dungkek, Dungkek, Sumenep', '081234567283', 'aktif', '2026-07-26 21:45:24', '2026-07-26 21:45:24'),
(183, 'Siti Roijah', 13, 'RFID1214', 'Ketawang Laok, Guluk-guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 21:46:16', '2026-07-26 21:46:16'),
(184, 'Susmiati', 13, 'RFID1215', 'Batu Kerbuy, Pasean, Pamekasan', '082334965786', 'aktif', '2026-07-26 21:50:57', '2026-07-26 21:50:57'),
(185, 'Ulaifatul Maulidah', 13, 'RFID1216', 'Lenteng Barat, Lenteng, Sumenep', '081935164415', 'aktif', '2026-07-26 21:55:28', '2026-07-26 21:55:28'),
(186, 'Yulia Nur Fadilah', 13, 'RFID1217', 'Gunung Kembar, Manding, Sumenep', '081935164413', 'aktif', '2026-07-26 21:57:06', '2026-07-26 21:57:06'),
(187, 'Ainul Khalifah', 14, 'RFID1301', 'Bragung, Guluk-guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 21:58:02', '2026-07-26 21:58:02'),
(188, 'Alfiyatul Hasanah', 14, 'RFID1302', 'Tambukoh, Guluk-Guluk, Sumenep', '081935164416', 'aktif', '2026-07-26 21:58:29', '2026-07-26 21:58:29'),
(189, 'Azzahra Kayla Assyifa', 14, 'RFID1303', 'Panjian Laok, Sumenep', '082334965787', 'aktif', '2026-07-26 21:59:16', '2026-07-26 21:59:16'),
(190, 'Devia El Fitrotir Riza', 14, 'RFID1304', 'Kadibas, Guluk-Guluk, Sumenep', '081935164416', 'aktif', '2026-07-26 22:00:05', '2026-07-26 22:00:05'),
(191, 'Dian Aulia Putri', 14, 'RFID1305', 'Batukerbuy, Pasean, Pamekasan', '081234567283', 'aktif', '2026-07-26 22:00:43', '2026-07-26 22:00:43'),
(192, 'Dwi Qorina Qathrun Nada', 14, 'RFID1306', 'Guluk-guluk, Guluk-guluk, Sumenep', '082334965786', 'aktif', '2026-07-26 22:01:24', '2026-07-26 22:01:24'),
(193, 'Fajra Nada Nadira Maulidya', 14, 'RFID1307', 'Ketawang Laok, Guluk-Guluk, Sumenep', '082334965787', 'aktif', '2026-07-26 22:02:03', '2026-07-26 22:02:03'),
(194, 'Fitroh Noer Ainie', 14, 'RFID1308', 'Payudan Nangger, Guluk-guluk, Sumenep', '082334965787', 'aktif', '2026-07-26 22:03:34', '2026-07-26 22:03:34'),
(195, 'Imroatul Azizah', 14, 'RFID1309', 'Tambukoh, Guluk-Guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 22:04:34', '2026-07-26 22:04:34'),
(196, 'Izzatun Nabila', 14, 'RFID1310', 'Bragung, Guluk-guluk, Sumenep', '081935164416', 'aktif', '2026-07-26 22:05:14', '2026-07-26 22:05:14'),
(197, 'Latifah El Kamilia', 14, 'RFID1311', 'Bragung, Guluk-guluk, Sumenep', '081256743908', 'aktif', '2026-07-26 22:06:02', '2026-07-26 22:06:02'),
(198, 'Nauroh Athiyatis Shofa', 14, 'RFID1312', 'Pakamban Daya, Pragaan, Sumenep', '082334965786', 'aktif', '2026-07-26 22:06:47', '2026-07-26 22:06:47'),
(199, 'Putri Amalia Nabila', 14, 'RFID1313', 'Tlagah, Banyuates, Sampang', '082334965787', 'aktif', '2026-07-26 22:07:34', '2026-07-26 22:07:34'),
(200, 'Silma Qonita Nuri', 14, 'RFID1314', 'Gedungan, Batuan, Sumenep', '081935164416', 'aktif', '2026-07-26 22:08:28', '2026-07-26 22:08:28'),
(201, 'Siti Aisyatun Nadiah', 14, 'RFID1315', 'Dempo Barat, Pasean, Pamekasan', '081935164415', 'aktif', '2026-07-26 22:09:42', '2026-07-26 22:09:42'),
(202, 'Sitti Mariya Ulfa', 14, 'RFID1316', 'Jambesari, Jambesari Darus Sholah, Bondowoso', '081256743908', 'aktif', '2026-07-26 22:11:19', '2026-07-26 22:11:19'),
(203, 'Zaqia Clara Dita', 14, 'RFID1317', 'Tambukoh, Guluk-Guluk, Sumenep', '081256743908', 'aktif', '2026-07-26 22:14:33', '2026-07-26 22:14:33'),
(204, 'Alfia Diana Rahmawati', 15, 'RFID1401', 'Karang Sokon, Guluk-guluk, Sumenep', '082334965786', 'aktif', '2026-07-26 22:21:42', '2026-07-26 22:21:42'),
(205, 'Atsila Nur Jamilah', 15, 'RFID1402', 'Bangkal, Kota Sumenep, Sumenep', '081256743908', 'aktif', '2026-07-26 22:22:38', '2026-07-26 22:22:38'),
(206, 'Balqis \'Abidah Syakira Rahiem', 15, 'RFID1403', 'Payudan Daleman, Guluk-Guluk, Sumenep', '081256743908', 'aktif', '2026-07-26 22:23:13', '2026-07-26 22:23:13'),
(207, 'Dewi Silfiyatur Rohmah', 15, 'RFID1404', 'Karduluk, Pragaan, Sumenep', '081234567283', 'aktif', '2026-07-26 22:24:17', '2026-07-26 22:24:17'),
(208, 'Intan Nur Aini', 15, 'RFID1405', 'Jambesari, Jambesari Darus Sholah, Bondowoso', '082334965787', 'aktif', '2026-07-26 22:25:28', '2026-07-26 22:25:28'),
(209, 'Maulidatin Ita Uzzakah', 15, 'RFID1406', 'Payudan Karang Sokon, Guluk-guluk, Sumenep', '082334965787', 'aktif', '2026-07-26 22:26:17', '2026-07-26 22:30:39'),
(210, 'Maziya Shalihah Masykur', 15, 'RFID1407', 'Ging-Ging, Bluto, Sumenep', '082334965787', 'aktif', '2026-07-26 22:27:11', '2026-07-26 22:27:11'),
(211, 'Qurratul Aini', 15, 'RFID1408', 'Payudan Karangsokon, Guluk-guluk, Sumenep', '081935164416', 'aktif', '2026-07-26 22:27:50', '2026-07-26 22:27:50'),
(212, 'Sabilatul Afaf', 15, 'RFID1409', 'Payudan Karangsokon, Guluk-guluk, Sumenep', '082334965787', 'aktif', '2026-07-26 22:28:15', '2026-07-26 22:28:15'),
(213, 'Silvi Rohmatin', 15, 'RFID1410', 'Payudan Daleman, Guluk-guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 22:29:04', '2026-07-26 22:29:04'),
(214, 'Tia Amelia', 15, 'RFID1411', 'Payudan Karangsokon, Guluk-guluk, Sumenep', '081234567283', 'aktif', '2026-07-26 22:29:44', '2026-07-26 22:29:44'),
(215, 'Faizatin Nikmah', 16, 'RFID1501', 'Ketawang Laok, Guluk-Guluk, Sumenep', '081935164415', 'aktif', '2026-07-27 05:16:54', '2026-07-27 05:16:54'),
(216, 'Fika Mayani', 16, 'RFID1502', 'Lanjuk, Manding, Sumenep', '081935164416', 'aktif', '2026-07-27 05:18:02', '2026-07-27 05:18:02'),
(217, 'Khalisatul Lailiyah', 16, 'RFID1503', 'Gadding, Manding, Sumenep', '082334965786', 'aktif', '2026-07-27 05:18:48', '2026-07-27 05:18:48'),
(218, 'Layyinah', 16, 'RFID1504', 'Brakas, Guluk-Guluk, Sumenep', '081935164416', 'aktif', '2026-07-27 05:19:55', '2026-07-27 05:19:55'),
(219, 'Nuriyatul Firdausiyah', 16, 'RFID1505', 'Kecer, Dasuk, Sumenep', '081935164416', 'aktif', '2026-07-27 05:20:53', '2026-07-27 05:20:53'),
(220, 'Nurul Fajriyah', 16, 'RFID1506', 'Sogian, Ambunten, Sumenep', '081256743908', 'aktif', '2026-07-27 05:21:35', '2026-07-27 05:21:35'),
(223, 'Siti Muflihatul Fadilah', 16, 'RFID1507', 'Pejagan, Jambesari Darus Sholah, Bondowoso', '082334965786', 'aktif', '2026-07-27 05:23:08', '2026-07-27 05:23:08'),
(224, 'Ulfainnah', 16, 'RFID1508', 'Aeng Panas, Pragaan, Sumenep', '081935164416', 'aktif', '2026-07-27 05:23:48', '2026-07-27 05:23:48'),
(225, 'Wildatul Karimah', 16, 'RFID1509', 'Banbaru, Gili Raja, Sumenep', '082334965786', 'aktif', '2026-07-27 05:24:26', '2026-07-27 05:24:26'),
(226, 'Aisyatul Jannah', 16, 'RFID1510', 'Lanjuk, Manding, Sumenep', '082334965787', 'aktif', '2026-07-27 05:25:28', '2026-07-27 05:25:28'),
(227, 'Khalifah', 16, 'RFID1011', 'Lanjuk, Manding, Sumenep', '082334965786', 'aktif', '2026-07-27 05:26:14', '2026-07-27 05:26:14'),
(228, 'Siti Aisyyah', 16, 'RFID1512', 'Jaddung, Pragaan, Sumenep', '081256743908', 'aktif', '2026-07-27 05:28:09', '2026-07-27 05:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0vzPW1FNzkeCg0SYpgwAM99o2HEUJm7LUGLDWtfj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWRrcjM3MHpQUG01cklHdTQ4QmVnWFdwSnVYWUlicXh2MDFGWXRLTCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1790820539),
('6qDFnpd9gxHDPKqUjcgtozI202D6YvXZdaYuhYeT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS0pSaGJDS1NUeVNzVGpSbWE0WTJ1UTVUOFNYOWxZZzZ0bWNmU0NqVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZWdpYXRhbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1788426240),
('w32viKKn5uUQNlGvcFZ23K0L1GA8N4dZPJ7QdeHx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidUZtVzRXYndPVFRZRGY1bHgycHJnaEJuUENOQVhCMGVkdk9ZMVJuWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYnNlbnNpIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1788594607),
('xJiZ1sqmYn22PhDysTAZkWEhmNtOT3aWi2cz1cTK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUhkNTRib1Uzb2JXanZFZG5EbzM3WUdJREVkSTZ0MEtBWE5PbFJqRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZWdpYXRhbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1787800059),
('zaZ0B8H0GRfUXIuHJ0svAWTEP1oKtPgpl7O9R8la', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZEllblpSZ2R3VGlLamdOUWt4Q0RMVW80dDhCek4zOVR0bURQVlo4VSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWthcCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1788138816);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$VCgs2pYG1xGzBi4A4406Vu3H7B4T5ypBP1U/QjttaFXB7K8o17/26', NULL, '2026-06-13 22:41:17', '2026-06-13 23:04:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `absensis_santri_kegiatan_tanggal_unique` (`santri_id`,`kegiatan_id`,`tanggal`),
  ADD KEY `absensis_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `santris`
--
ALTER TABLE `santris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `santris_uid_rfid_unique` (`uid_rfid`),
  ADD KEY `santris_kamar_id_foreign` (`kamar_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `santris`
--
ALTER TABLE `santris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `santris`
--
ALTER TABLE `santris`
  ADD CONSTRAINT `santris_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
