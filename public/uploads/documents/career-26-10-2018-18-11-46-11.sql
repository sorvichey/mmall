-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2017 at 11:57 PM
-- Server version: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `url` varchar(120) DEFAULT NULL,
  `photo` varchar(120) NOT NULL,
  `position` varchar(10) NOT NULL,
  `order_number` int(11) DEFAULT '0',
  `active` bit(1) NOT NULL DEFAULT b'1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `url`, `photo`, `position`, `order_number`, `active`, `create_at`, `modify_at`) VALUES
(1, 'www.vdoo.biz', '', 'Right', 0, b'0', '2017-08-12 15:19:28', '2017-08-12 15:19:28'),
(2, '#', 'create-webstie.png', 'Right', 1, b'1', '2017-08-12 15:20:50', '2017-08-12 15:20:50'),
(3, 'test', '', 'Button', 0, b'0', '2017-08-12 15:21:56', '2017-08-12 15:21:56'),
(4, 'testddds', 'blog-item-image-1.jpg', 'Top', 0, b'0', '2017-08-12 15:23:14', '2017-08-12 15:23:14'),
(5, '#', 'loan-system.png', 'Right', 2, b'1', '2017-08-12 15:35:16', '2017-08-12 15:35:16'),
(8, '#', 'if_Map-Marker-Flag--Left-Chartreuse_73042.png', 'Button', 3, b'0', '2017-08-15 07:45:58', '2017-08-15 07:45:58'),
(9, 'Ads1', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:53:38', '2017-08-15 16:53:38'),
(10, 'Sample1', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:53:55', '2017-08-15 16:53:55'),
(11, 'Sample2', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:54:26', '2017-08-15 16:54:26'),
(12, 'Sample3', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:54:35', '2017-08-15 16:54:35'),
(13, 'Sample4', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:54:45', '2017-08-15 16:54:45'),
(14, 'Sample5', 'adversitment.png', 'Bottom', 0, b'1', '2017-08-15 16:54:54', '2017-08-15 16:54:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
