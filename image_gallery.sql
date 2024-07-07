-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 04:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_gallery`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `like_foto` (IN `user_id` CHAR(36), IN `foto_id` BIGINT UNSIGNED)   BEGIN
    DECLARE like_count INT;
    
    SELECT COUNT(id) INTO like_count FROM likefoto WHERE user_id = user_id AND foto_id = foto_id;

    IF like_count = 0 THEN
        INSERT INTO likefoto VALUES (NULL, foto_id, user_id, NOW());
    ELSE
        DELETE FROM likefoto WHERE user_id = user_id AND foto_id = foto_id;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `nama_album`, `deskripsi`, `created_at`, `updated_at`, `user_id`) VALUES
(13, 'Walpapper Landscape', 'wallpapper untuk laptop atau pc dekstop', '2024-02-04 08:26:17', '2024-02-04 08:26:17', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(15, 'Makanan Ternikmat', 'Gambar makanan ternimat yang saya inginkan', '2024-02-05 20:34:14', '2024-02-05 20:34:14', '9b449d22-2104-4768-96db-d29912bfbbc1'),
(21, 'Grafik Digital Modern', 'Gambar grafik desain modern', '2024-02-09 22:10:36', '2024-02-09 22:10:36', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(22, 'Pemandangan alam', 'Landscape - Pemandangan alam', '2024-02-11 08:51:00', '2024-02-11 08:51:00', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(23, 'Pemandangan sore hari', 'Gambar - Pemandangan sore hari', '2024-02-11 08:52:26', '2024-02-11 08:52:26', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(24, 'Lukisan Water Paint', 'lukisan awan dengan teknik water painting', '2024-02-11 08:55:54', '2024-02-11 08:55:54', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(25, 'Pemandangn', 'pemandangan', '2024-02-12 01:14:16', '2024-02-12 01:14:16', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(26, 'Langit Sore', 'Langit sore', '2024-02-12 07:10:36', '2024-02-12 07:10:36', '9b3ee99c-e88f-4e29-9cad-59d327e830c5'),
(28, 'Gunung', 'gunung', '2024-02-16 01:25:27', '2024-02-16 01:25:27', '9b511c78-ba12-436d-afe9-6fcf24ec3344'),
(29, 'Miraculous', 'miraculous', '2024-02-16 02:32:58', '2024-02-16 02:32:58', '9b511c78-ba12-436d-afe9-6fcf24ec3344'),
(30, 'Jepang', 'jepang', '2024-02-16 02:35:08', '2024-02-16 02:35:08', '9b511c78-ba12-436d-afe9-6fcf24ec3344');

-- --------------------------------------------------------

--
-- Stand-in structure for view `album_report`
-- (See below for the actual view)
--
CREATE TABLE `album_report` (
`id` bigint(20) unsigned
,`nama_album` varchar(255)
,`deskripsi` text
,`created_at` timestamp
,`updated_at` timestamp
,`user_id` char(36)
,`thumbnail` varchar(255)
,`jumlah_foto` bigint(21)
,`jumlah_like` bigint(21)
,`jumlah_komentar` bigint(21)
);

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
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text DEFAULT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `album_id`, `user_id`, `judul_foto`, `deskripsi_foto`, `lokasi_file`, `created_at`, `updated_at`) VALUES
(10, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan Hutan', NULL, '1789982542348507.jpg', '2024-02-04 08:26:19', '2024-02-04 08:26:19'),
(11, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan Bukit Batu', NULL, '1789982544253346.jpg', '2024-02-04 08:26:19', '2024-02-04 08:26:19'),
(12, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Bermalam dihutan', NULL, '1789982544272842.jpg', '2024-02-04 08:26:19', '2024-02-04 08:26:19'),
(13, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Landscape Jalan Jepang', NULL, '1789982544476140.jpg', '2024-02-04 08:26:19', '2024-02-04 08:26:19'),
(14, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam', NULL, '1789982544508319.jpg', '2024-02-04 08:26:19', '2024-02-04 08:26:19'),
(19, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Black Forest Cake', NULL, '1790118938485779.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(20, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Black Forrest Cake', NULL, '1790118938581452.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(21, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Cupcake Strawberry', NULL, '1790118938652102.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(22, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Mie Goreng', NULL, '1790118938657153.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(23, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Cupcake coklat', NULL, '1790118938668394.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(24, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Coffee Late', NULL, '1790118938704436.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(25, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Red Valvet', NULL, '1790118938709151.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(26, 15, '9b449d22-2104-4768-96db-d29912bfbbc1', 'Teh manis', NULL, '1790118938715781.jpg', '2024-02-05 20:34:15', '2024-02-05 20:34:15'),
(104, 21, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Grafik Digital Modern - 1', NULL, '1790487388970811.jpg', '2024-02-09 22:10:36', '2024-02-09 22:10:36'),
(105, 21, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Grafik Digital Modern - 2', NULL, '1790487388991781.jpg', '2024-02-09 22:10:36', '2024-02-09 22:10:36'),
(106, 21, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Grafik Digital Modern - 3', NULL, '1790487389009096.jpg', '2024-02-09 22:10:36', '2024-02-09 22:10:36'),
(107, 21, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Grafik Digital Modern - 4', NULL, '1790487389013582.jpg', '2024-02-09 22:10:36', '2024-02-09 22:10:36'),
(108, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 1', NULL, '1790618276581277.jpg', '2024-02-11 08:51:00', '2024-02-11 08:51:00'),
(109, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 2', NULL, '1790618276642678.jpg', '2024-02-11 08:51:00', '2024-02-11 08:51:00'),
(110, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 3', NULL, '1790618276673973.jpg', '2024-02-11 08:51:00', '2024-02-11 08:51:00'),
(111, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 4', NULL, '1790618276737614.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(112, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 5', NULL, '1790618276742098.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(113, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 6', NULL, '1790618276768108.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(114, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 7', NULL, '1790618276803439.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(115, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 8', NULL, '1790618276821448.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(116, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 9', NULL, '1790618276876102.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(117, 22, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan alam - 10', NULL, '1790618276880626.jpg', '2024-02-11 08:51:01', '2024-02-11 08:51:01'),
(119, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 2', NULL, '1790618367538909.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(120, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 3', NULL, '1790618367543505.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(121, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 4', NULL, '1790618367547991.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(122, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 5', NULL, '1790618367552547.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(123, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 6', NULL, '1790618367558155.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(124, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 7', NULL, '1790618367563157.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(125, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 8', NULL, '1790618367567310.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(126, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 9', NULL, '1790618367606917.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(127, 23, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangan sore hari - 10', NULL, '1790618367612653.jpg', '2024-02-11 08:52:27', '2024-02-11 08:52:27'),
(128, 24, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Lukisan Water Paint - 1', NULL, '1790618584175728.jpg', '2024-02-11 08:55:54', '2024-02-11 08:55:54'),
(129, 25, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Pemandangn - 1', NULL, '1790680138010978.jpg', '2024-02-12 01:14:17', '2024-02-12 01:14:17'),
(130, 26, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Langit Sore - 1', NULL, '1790702556352980.jpg', '2024-02-12 07:10:37', '2024-02-12 07:10:37'),
(131, 26, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Langit Sore - 2', NULL, '1790702557347879.jpg', '2024-02-12 07:10:37', '2024-02-12 07:10:37'),
(132, 26, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Langit Sore - 3', NULL, '1790702557365059.jpg', '2024-02-12 07:10:37', '2024-02-12 07:10:37'),
(133, 26, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Langit Sore - 4', NULL, '1790702557377173.jpg', '2024-02-12 07:10:37', '2024-02-12 07:10:37'),
(134, 26, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Langit Sore - 5', NULL, '1790702557450805.jpg', '2024-02-12 07:10:37', '2024-02-12 07:10:37'),
(136, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 1', NULL, '1791043229240859.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(137, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 2', NULL, '1791043230532216.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(138, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 3', NULL, '1791043230589725.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(139, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 4', NULL, '1791043230627143.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(140, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 5', NULL, '1791043230630933.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(141, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 6', NULL, '1791043230665407.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(142, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 7', NULL, '1791043230671274.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(143, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 8', NULL, '1791043230675412.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(144, 28, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Gunung - 9', NULL, '1791043230689137.jpg', '2024-02-16 01:25:28', '2024-02-16 01:25:28'),
(145, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 1', NULL, '1791047476883608.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(146, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 2', NULL, '1791047477055599.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(147, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 3', NULL, '1791047477066275.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(148, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 4', NULL, '1791047477099220.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(149, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 5', NULL, '1791047477103009.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(150, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 6', NULL, '1791047477128677.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(151, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 7', NULL, '1791047477133260.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(152, 29, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Miraculous - 8', NULL, '1791047477137831.jpg', '2024-02-16 02:32:58', '2024-02-16 02:32:58'),
(153, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 1', NULL, '1791047613878617.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(154, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 2', NULL, '1791047613905900.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(155, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 3', NULL, '1791047613910350.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(156, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 4', NULL, '1791047613934295.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(157, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 5', NULL, '1791047613938509.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(158, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 6', NULL, '1791047613942657.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(159, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 7', NULL, '1791047613946980.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(160, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 8', NULL, '1791047613975805.jpg', '2024-02-16 02:35:08', '2024-02-16 02:35:08'),
(161, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 9', NULL, '1791047614086740.jpg', '2024-02-16 02:35:09', '2024-02-16 02:35:09'),
(162, 30, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Jepang - 10', NULL, '1791047614100915.jpg', '2024-02-16 02:35:09', '2024-02-16 02:35:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `foto_report`
-- (See below for the actual view)
--
CREATE TABLE `foto_report` (
`id` bigint(20) unsigned
,`album_id` bigint(20) unsigned
,`user_id` char(36)
,`judul_foto` varchar(255)
,`deskripsi_foto` text
,`lokasi_file` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`nama_album` varchar(255)
,`deskripsi` text
,`jumlah_like` bigint(21)
,`jumlah_komentar` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `isi_komentar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `foto_id`, `user_id`, `isi_komentar`, `created_at`, `updated_at`) VALUES
(1, 10, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Kren bg', '2024-02-05 08:56:24', '2024-02-05 08:56:24'),
(2, 11, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'minta bg', '2024-02-05 08:56:24', '2024-02-05 08:56:24'),
(3, 10, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'bang minta ya', '2024-02-05 08:48:45', '2024-02-05 08:48:45'),
(4, 13, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'jadi pengen kejepang', '2024-02-05 08:49:12', '2024-02-05 08:49:12'),
(5, 10, '9b43a829-4dfb-4f80-b462-7ccd0176ab93', 'bang izin download', '2024-02-05 09:12:28', '2024-02-05 09:12:28'),
(6, 19, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'jadi pingin', '2024-02-05 20:35:54', '2024-02-05 20:35:54'),
(23, 129, '9b511c78-ba12-436d-afe9-6fcf24ec3344', 'wih bagus', '2024-02-12 01:33:19', '2024-02-12 01:33:19'),
(24, 128, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'bang', '2024-02-12 01:45:14', '2024-02-12 01:45:14'),
(26, 129, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'bang izin download', '2024-02-12 01:47:02', '2024-02-12 01:47:02'),
(27, 129, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'bang', '2024-02-12 06:59:55', '2024-02-12 06:59:55'),
(28, 129, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'test', '2024-02-12 07:00:06', '2024-02-12 07:00:06'),
(30, 130, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'hallo', '2024-02-13 03:56:06', '2024-02-13 03:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`id`, `foto_id`, `user_id`, `created_at`) VALUES
(39, 11, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', '2024-02-16'),
(41, 129, '9b3ee99c-e88f-4e29-9cad-59d327e830c5', '2024-02-16'),
(42, 136, '9b511c78-ba12-436d-afe9-6fcf24ec3344', '2024-02-16');

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
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2024_01_31_021346_create_album_table', 1),
(15, '2024_01_31_021513_create_foto_table', 1),
(16, '2024_01_31_022418_create_komentar_table', 1),
(17, '2024_01_31_022838_create_likefoto_table', 1),
(18, '2024_01_31_132918_create_temp_images_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL DEFAULT 'default.png',
  `bio` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `profil`, `bio`, `email`, `password`, `created_at`, `updated_at`) VALUES
('9b3ee99c-e88f-4e29-9cad-59d327e830c5', 'Farras Fadhil Syafiq', 'Ras', '1790792368146460.gif', 'Pemandangan indah adalah kesukaanku', 'farrasfadhil06@gmail.com', '$2y$12$pgS.unyyYbJL0YuBLXoCH.DJnlvG3QQldvtGj2fTJfFyh0z7lEK0a', '2024-02-03 00:24:57', '2024-02-13 06:58:21'),
('9b43a829-4dfb-4f80-b462-7ccd0176ab93', 'Fadhil Aja', 'dhill', '1790075426347342.gif', 'Diam tak bergerak bukan berarti tidak merasakan apapun', 'fadhilaja@gmail.com', '$2y$12$2H.MLKSp/pNNA5n1ovSc/OJnFIcAbEIf8zP4S6N/foumjUCIs42mm', '2024-02-05 09:01:05', '2024-02-05 09:02:40'),
('9b449d22-2104-4768-96db-d29912bfbbc1', 'ALDI', 'ALDI_DWI', '1790205959164763.gif', NULL, 'ALSI@GMAIL.COM', '$2y$12$vP.RGuIZdZN6tXRLFrsPS.4NAay517gd1AxehYgBnMgaaOkXNeKGS', '2024-02-05 20:26:03', '2024-02-06 19:37:24'),
('9b46b287-019b-4fe0-b4af-77d775c83369', 'barikli', 'bar', 'default.png', NULL, 'bar@gamail.com', '$2y$12$3m8IGiPeI.dqJVL./f/dkOFdWy73WLwa.nIbKfIoyMi7aRMZVLEKC', '2024-02-06 21:17:32', '2024-02-06 21:18:36'),
('9b511c78-ba12-436d-afe9-6fcf24ec3344', 'Asep', 'asep', '1791044326416524.jpg', NULL, 'asep@gmail.com', '$2y$12$WQPCUiir9gEYy95sM29pQ.n/Hg4BYwJjC5AKmIeBFuBUAhMegMu/e', '2024-02-12 01:32:04', '2024-02-16 01:42:53');

-- --------------------------------------------------------

--
-- Structure for view `album_report`
--
DROP TABLE IF EXISTS `album_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `album_report`  AS SELECT `album`.`id` AS `id`, `album`.`nama_album` AS `nama_album`, `album`.`deskripsi` AS `deskripsi`, `album`.`created_at` AS `created_at`, `album`.`updated_at` AS `updated_at`, `album`.`user_id` AS `user_id`, `tfoto`.`thumbnail` AS `thumbnail`, ifnull(`tfoto`.`foto_count`,0) AS `jumlah_foto`, ifnull(`tlike`.`like_count`,0) AS `jumlah_like`, ifnull(`tkomentar`.`komentar_count`,0) AS `jumlah_komentar` FROM (((`album` left join (select `foto`.`album_id` AS `album_id`,count(0) AS `foto_count`,`foto`.`lokasi_file` AS `thumbnail` from `foto` group by `foto`.`album_id`) `tfoto` on(`tfoto`.`album_id` = `album`.`id`)) left join (select `foto`.`album_id` AS `album_id`,count(0) AS `like_count` from (`likefoto` join `foto` on(`likefoto`.`foto_id` = `foto`.`id`)) group by `foto`.`album_id`) `tlike` on(`tlike`.`album_id` = `album`.`id`)) left join (select `foto`.`album_id` AS `album_id`,count(0) AS `komentar_count` from (`komentar` join `foto` on(`komentar`.`foto_id` = `foto`.`id`)) group by `foto`.`album_id`) `tkomentar` on(`tkomentar`.`album_id` = `album`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `foto_report`
--
DROP TABLE IF EXISTS `foto_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `foto_report`  AS SELECT `foto`.`id` AS `id`, `foto`.`album_id` AS `album_id`, `foto`.`user_id` AS `user_id`, `foto`.`judul_foto` AS `judul_foto`, `foto`.`deskripsi_foto` AS `deskripsi_foto`, `foto`.`lokasi_file` AS `lokasi_file`, `foto`.`created_at` AS `created_at`, `foto`.`updated_at` AS `updated_at`, `album`.`nama_album` AS `nama_album`, `album`.`deskripsi` AS `deskripsi`, ifnull(`tlike`.`jumlah_like`,0) AS `jumlah_like`, ifnull(`tkomentar`.`jumlah_komentar`,0) AS `jumlah_komentar` FROM (((`foto` join `album` on(`album`.`id` = `foto`.`album_id`)) left join (select `likefoto`.`foto_id` AS `foto_id`,count(0) AS `jumlah_like` from `likefoto` group by `likefoto`.`foto_id`) `tlike` on(`tlike`.`foto_id` = `foto`.`id`)) left join (select `komentar`.`foto_id` AS `foto_id`,count(0) AS `jumlah_komentar` from `komentar` group by `komentar`.`foto_id`) `tkomentar` on(`tkomentar`.`foto_id` = `foto`.`id`)) GROUP BY `foto`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_album_id_foreign` (`album_id`),
  ADD KEY `foto_user_id_foreign` (`user_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komentar_foto_id_foreign` (`foto_id`),
  ADD KEY `komentar_user_id_foreign` (`user_id`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likefoto_foto_id_foreign` (`foto_id`),
  ADD KEY `likefoto_user_id_foreign` (`user_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_foto_id_foreign` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_foto_id_foreign` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likefoto_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
