-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 03:54 PM
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
(41, 'aura', 'aura@gmail.com', 20, '$2y$10$V1AV9sAuacqJMZyG.1no6.xGWc6eUUQD8Xl0oxP2f42wLwBICy7/y', '2025-05-28 14:06:07'),
(42, 'jokalzz', 'jokalzz@gmail.com', 20, '$2y$10$IaDiX82er2BHlmHqEl0aLu0gJdxLX8892qvHNvDv0/NI5ACYl6XFu', '2025-05-28 15:20:48'),
(43, 'jokalz', 'jokalz@gmail.com', 20, '$2y$10$/7isdCZgeFQMEv5NOpM9WeCS3916xaxU8BqnFOsKt01DjsOGmZAjO', '2025-06-03 14:07:20'),
(45, 'admin', 'admin@example.com', 30, '$2a$12$SI91HKN/QuFKFjVxi1Y72eMm9dEFoLr9rikNwcqdAD56Ghm6Q8FCa', '2025-06-09 10:16:58');

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
