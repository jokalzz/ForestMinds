-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 11:53 AM
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
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `video_url`, `description`, `created_at`) VALUES
(1, 'APA JADINYA JIKA TIDAK ADA HUTAN?', 'assets/images/videos/hutan-tidak-ada.mp4', NULL, '2024-11-28 20:57:20'),
(2, 'SATU MASALAH LINGKUNGAN YANG JARANG DIBAHAS', 'assets/images/videos/Satu Masalah Lingkungan yang Jarang Dibahas.mp4', NULL, '2024-11-28 21:02:40'),
(3, 'SEBERAPA BANYAK SAMPAH PLASTIK DI DUNIA', 'assets/images/videos/Seberapa Banyak Sampah Plastik di Dunia.mp4', NULL, '2024-11-28 21:02:40'),
(4, 'POLUSI UDARA – BAGAIMANA DAMPAKNYA TERHADAP KESEHATAN KITA', 'assets/images/videos/Polusi Udara - Bagaimana Dampaknya Terhadap Kesehatan.mp4', NULL, '2024-11-28 21:02:40'),
(5, 'BENARKAH LINGKUNGAN MEMBAIK SAAT PANDEMI CORONA', 'assets/images/videos/Benarkah Lingkungan Membaik Saat Pandemi Corona.mp4', NULL, '2024-11-28 21:02:40'),
(6, 'APAKAH KITA BISA MENGHENTIKAN PEMANASAN GLOBAL?', 'assets/images/videos/Bisakah Kita Menghentikan Pemanasan Global.mp4', NULL, '2024-11-28 21:02:40'),
(7, 'KENAPA INDONESIA SERING KEBAKARAN HUTAN?', 'assets/images/videos/Kenapa Indonesia Sering Kebakaran Hutan.mp4', NULL, '2024-11-28 21:02:40'),
(8, 'BISAKAH MANUSIA MENCEGAH KERUSAKAN BUMI?', 'assets/images/videos/Mampukah Manusia Mencegah Kehancuran Bumi.mp4', NULL, '2024-11-28 21:02:40'),
(9, 'KENAPA GUNUNG BERAPI MELETUS?', 'assets/images/videos/Kenapa Gunung Berapi Meletus.mp4', NULL, '2024-11-28 21:02:40'),
(10, 'APAKAH MINYAK DI DUNIA INI AKAN HABIS?', 'assets/images/videos/Apakah Minyak Di Dunia Ini Akan Habis.mp4', NULL, '2024-11-28 21:02:40'),
(11, 'GIMANA JIKA OKSIGEN DI BUMI NINGKAT DUA KALI LIPAT?', 'assets/images/videos/Gimana Jika Oksigen di Bumi Ningkat Dua Kali Lipat.mp4', NULL, '2024-11-28 21:02:40'),
(12, 'GURUN TERLUAS DI DUNIA? BUKAN SAHARA!', 'assets/images/videos/Gurun Terluas di Dunia Bukan Sahara.mp4', NULL, '2024-11-28 21:02:40'),
(13, 'MENJAGA HUTAN UNTUK MELINDUNGI OZON DAN MASA DEPAN KITA', 'assets/images/videos/Kalau Hutan Gundul, Akankah Ozon Semakin Bolong.mp4', NULL, '2024-11-28 21:02:40'),
(14, 'APA YANG MENJADI PENYEBAB KEBAKARAN HUTAN DI SUMATERA?', 'assets/images/videos/Inilah Penyelamat Bumi Kita yang Sebenarnya.mp4', NULL, '2024-11-28 21:02:40'),
(15, 'BAGAIMANA JADINYA JIKALAU SEMUA GUNUNG BERAPI MELETUS???', 'assets/images/videos/Inilah Penyelamat Bumi Kita yang Sebenarnya.mp4', NULL, '2024-11-28 21:02:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
