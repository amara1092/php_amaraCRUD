-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 15, 2019 at 11:10 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `login`
--
CREATE DATABASE IF NOT EXISTS `php_amaracrud` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_amaracrud`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'gatess', '$2y$12$tNCzOzeQsqpUnFWUKrAiXen1BwFfoNcFtHIWQjIVsk9QQuZZ9Cvsu'),
(2, 'Mark', '$2y$12$tIsi9qDTyHqgMptb.QyzJudZ3G1eUUQXSlAkiB95QnkU8hzGwRCCi'),
(3, 'Rob', '$2y$12$d3Fkg8O.iMrao4G58t45I.45epO.cEp1DIB5egsOrgGdMeIT2OnwS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
