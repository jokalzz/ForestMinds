-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 11:52 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `kapan_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Age`, `Password`, `kapan_login`) VALUES
(26, 'jokaru', 'joka@example.com', 10, '$2y$10$5kB.0M0IMnsQX9ieEyM/d.cMSwiZXOVCNxLgJGk2at9P0XYvFGlS.', '2024-11-26 09:21:06'),
(27, 'oke', 'oke@gmail.com', 15, '$2y$10$I31LiofGqu0TBScRpXpMpuZGWIvVw9XKdDxysk/ORBpdCnNcNCXcG', '2024-11-26 09:31:28'),
(28, 'keefa', 'keefa@gmail.com', 18, '$2y$10$AUG0e.e2wxsWxb992jl1vu3Rk6L3giUB3SFF4ZVruyCUse0i/uEKy', '2024-11-26 14:37:06'),
(29, 'arkaf', 'arkaf@example.com', 15, '$2y$10$Svqxx3qLBORX8VcwAFv29u9Q/QQA5xYPRtSGSh/vJp.IRyzoQCeuW', '2024-11-26 17:06:16'),
(30, 'jokalzz', 'jokalzz@gmail.com', 12, '$2y$10$9v3Ob9RXdDLfbCehmQB.teS.wlFmObt8gwsrfz5Kg7HQ9KOwuQzaO', '2024-11-26 17:14:00'),
(31, 'edward', 'ed@gmail.com', 10, '$2y$10$dqe08eM3FhyLeRzxYZ0P9.l6FVyrDJOfo3SB1ijI8Fp/heIyYUApO', '2024-11-26 17:15:11'),
(32, 'aaaa', 'sa@gmail.com', 10, '$2y$10$uQSMgTpc.DVOg9Cybraabuth/IzwooAeR4G70cdApBjBIRF3tdo/S', '2024-11-26 17:16:54'),
(33, 'Jojo', 'jojo@gmail.com', 13, '$2y$10$5fYaiikAyLIuSgwpYHq2UunhnlGIne..RJ79a84P3wJ.RN5T0LAAK', '2024-11-26 17:23:10'),
(34, 'atan', 'rivaldo@gmail.com', 15, '$2y$10$vH5RH4O94VARKILv6/am7.dwRnsZJrDERMDUOKv.IQWQPH2tzjwmq', '2024-11-27 08:50:21'),
(35, 'Daniel', 'daniel@yahoo.com', 18, '$2y$10$aGjYnhPRjRME/wyZl.e9VubI59DjvViOhZjX/PwfcrEBkbvktlE/S', '2024-11-27 09:16:10'),
(36, 'Jokalzz', 'jokalzz@gmaill.com', 12, '$2y$10$P3fRo0tWZ7MqKKC39Yw2u.gU.7Nj7/tbC2hYHx3K2C5/ivwrnwHi.', '2024-11-29 06:11:18'),
(37, 'user', 'user@gmail.com', 15, '$2y$10$qQ/Yd6zWaXTISkqbm/qyVeCTkXHYN9DnKSisxg9TVfuyv6gRr6vqa', '2024-12-04 09:59:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
