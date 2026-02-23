-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 23, 2026 at 08:25 AM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Chatroom`
--
CREATE DATABASE IF NOT EXISTS `Chatroom` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Chatroom`;

-- --------------------------------------------------------

--
-- Table structure for table `Messaggi`
--

CREATE TABLE `Messaggi` (
  `id` int(11) NOT NULL,
  `testo` varchar(200) NOT NULL,
  `giorno` datetime NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Stanze`
--

CREATE TABLE `Stanze` (
  `nome` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stanze`
--

INSERT INTO `Stanze` (`nome`, `username`) VALUES
('PHP', 'Leonardo');

-- --------------------------------------------------------

--
-- Table structure for table `Utenti`
--

CREATE TABLE `Utenti` (
  `username` varchar(50) NOT NULL,
  `psw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Utenti`
--

INSERT INTO `Utenti` (`username`, `psw`) VALUES
('Leonardo', '1234'),
('Marco', '5678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `Stanze`
--
ALTER TABLE `Stanze`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Messaggi`
--
ALTER TABLE `Messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD CONSTRAINT `Messaggi_ibfk_1` FOREIGN KEY (`nome`) REFERENCES `Stanze` (`nome`),
  ADD CONSTRAINT `Messaggi_ibfk_2` FOREIGN KEY (`username`) REFERENCES `Utenti` (`username`);

--
-- Constraints for table `Stanze`
--
ALTER TABLE `Stanze`
  ADD CONSTRAINT `Stanze_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Utenti` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
