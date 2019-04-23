-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2019 at 05:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emall`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_carts`
--

CREATE TABLE `add_to_carts` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pro_qty` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `net_total_price` float DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: active; 0 canceled',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: not yet order; 0 ordered',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `add_to_carts`
--

INSERT INTO `add_to_carts` (`id`, `buyer_id`, `size_id`, `color_id`, `product_id`, `pro_qty`, `total_price`, `net_total_price`, `active`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, 0, 0, 1, 12, 5, 5, 0, 1, '2019-01-28 16:14:51', '2019-03-07 15:14:58'),
(6, 3, 0, 0, 2, 3, 60, 60, 1, 1, '2019-01-28 16:18:19', '2019-04-08 12:17:36'),
(7, 3, 0, 0, 5, 1, 89.7, 89.7, 0, 1, '2019-03-02 04:44:30', '2019-03-07 15:15:22'),
(8, 3, 0, 0, 3, 9, 15, 15, 1, 1, '2019-03-02 04:45:15', '2019-03-08 10:22:24'),
(9, 2, 0, 0, 4, 2, 20, 20, 1, 1, '2019-03-20 17:16:27', '2019-03-27 15:13:12'),
(10, 2, 0, 0, 5, 4, 89.7, 89.7, 0, 1, '2019-03-27 12:03:45', '2019-03-27 15:16:16'),
(11, 3, 0, 17, 6, 2, 45, 45, 1, 0, '2019-04-08 11:47:05', '2019-04-18 15:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(100) DEFAULT NULL,
  `recovery_mode` tinyint(4) DEFAULT '0',
  `verify` int(4) DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `gender` varchar(6) DEFAULT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `create_at`, `photo`, `recovery_mode`, `verify`, `active`, `gender`, `activated`) VALUES
(1, 'vichey', 'sor', '1', 'admin@gmail.com', '$2y$10$6QDcAGzTF8OktnLjh/coPO1aRwtd726Vk9O4Ht0Y921PvD.u52k4.', '2018-10-17 01:29:00', NULL, 0, 0, 1, 'Male', 0),
(2, 'vichey1', 'sor', '010674459', 'sorvichey@gmail.com', '$2y$10$rLoj3tvbQUiP4OFJzoiXrucJkNrLGdnBqoSpWeYwcxPKwFwXpizWq', '2018-10-17 01:31:17', 'pro2.jpg', 0, 0, 1, 'Male', 1),
(3, 'test1', 'test', '010674459', 'rithysam.sr@gmail.com', '$2y$10$5ZS3U9QhgxxHFgPaPrZhaOmfajr2jDB67yxiH0FCo3xWCZ4RhbqSO', '2019-01-13 14:08:48', NULL, 0, 0, 1, 'Male', 1);

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(11) NOT NULL,
  `key_position` varchar(250) NOT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `dateline` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `department_id` int(11) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `hire` int(11) DEFAULT NULL,
  `career_category_id` int(11) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `requirement` longtext,
  `post_by` int(11) NOT NULL,
  `document` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `key_position`, `short_description`, `description`, `dateline`, `create_at`, `active`, `department_id`, `type`, `hire`, `career_category_id`, `gender`, `requirement`, `post_by`, `document`) VALUES
(1, 'vichey', 'Testing Khmer', '<p>test</p>', '2018-10-27', '2018-10-26 17:29:15', 0, 4, NULL, 1, 4, 'sor', '<p>test</p>', 1, NULL),
(2, 'Manager', 'Testing', '<p>testing 2</p>', '2018-10-31', '2018-10-26 17:34:00', 1, 4, 'full-time', 3, 4, 'Male or Female', '<p>testing 1</p>', 1, NULL),
(3, 'testing', 'testing', '<p>1234567</p>', '2018-10-27', '2018-10-26 17:37:35', 0, 5, 'part-time', 3, 4, 'testing', '<p>qwerty</p>', 1, NULL),
(4, 'Developer', 'Hello World', '<p>b</p>', '2018-10-27', '2018-10-26 17:49:05', 1, 4, 'full-time', 2, 5, 'Male', '<p>v</p>', 1, NULL),
(5, 'Developer', 'Hello World', '<p>b</p>', '2018-10-27', '2018-10-26 17:50:30', 1, 4, 'full-time', 2, 5, 'Male', '<p>v</p>', 1, NULL),
(6, 'Developer', 'Hello World', '<p>b</p>', '2018-10-27', '2018-10-26 17:50:48', 1, 4, 'full-time', 2, 5, 'Male', '<p>v</p>', 1, NULL),
(7, 'Developer', 'Hello World', '<p>b</p>', '2018-10-27', '2018-10-26 17:51:17', 1, 4, 'full-time', 2, 5, 'Male', '<p>v</p>', 1, NULL),
(8, 'Developer', 'Hello World', '<p>b</p>', '2018-10-27', '2018-10-26 17:51:36', 1, 4, 'full-time', 2, 5, 'Male', '<p>v</p>', 1, '8.doc'),
(9, '111111', '11111111', '<p>1111111</p>', '2018-10-20', '2018-10-26 17:55:19', 0, 4, 'full-time', 11111111, 5, '1111111', '<p>1111111</p>', 1, 'career-26-10-2018-17-55-19-9.sql'),
(10, '111111', '11111111', '<p>1111111</p>', '2018-10-20', '2018-10-26 18:11:29', 0, 4, 'full-time', 11111111, 5, '1111111', '<p>1111111</p>', 1, NULL),
(11, '111111', '11111111', '<p>1111111</p>', '2018-10-20', '2018-10-26 18:11:46', 0, 4, 'full-time', 11111111, 5, '1111111', '<p>1111111</p>', 1, 'career-26-10-2018-18-11-46-11.sql'),
(12, 'Manager', '12ererf', '<p>d1</p>', '2018-10-25', '2018-10-26 18:58:42', 0, 2, 'full-time', 1, 5, 'Male or Female', '<p>s</p>', 1, NULL),
(13, 'test111sdfasdf', '11111111', '<p>1111111</p>', '2018-12-20', '2018-10-26 19:06:27', 0, 4, 'full-time', 1, 5, '1111111', '<p>1111111q1</p>', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `career_categories`
--

CREATE TABLE `career_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `career_categories`
--

INSERT INTO `career_categories` (`id`, `name`, `active`) VALUES
(1, 'test', 0),
(2, 'IT program', 0),
(3, 'IT Network', 1),
(4, 'Accounting', 1),
(5, 'Administration', 1),
(6, 'Testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `career_locations`
--

CREATE TABLE `career_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `career_locations`
--

INSERT INTO `career_locations` (`id`, `name`, `active`) VALUES
(1, 'Takaev', 1),
(2, 'Svey Reang', 1),
(3, '12345678', 0),
(4, 'Prey Veng', 1),
(5, 'Phnom Penh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `career_locations_r_careers`
--

CREATE TABLE `career_locations_r_careers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `career_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `career_locations_r_careers`
--

INSERT INTO `career_locations_r_careers` (`id`, `name`, `active`, `career_id`) VALUES
(1, 'Takaev', 0, 13),
(3, 'Svey Reang', 0, 13),
(4, 'Prey Veng', 0, 13),
(5, 'Phnom Penh', 0, 13),
(6, 'Phnom Penh', 0, 13),
(7, 'Prey Veng', 0, 13),
(8, 'Svey Reang', 0, 13),
(9, 'Takaev', 0, 13),
(10, 'Svey Reang', 0, 13),
(11, 'Takaev', 0, 13),
(12, 'Svey Reang', 0, 13),
(13, 'Takaev', 0, 13),
(14, 'Phnom Penh', 0, 13),
(15, 'Takaev', 1, 13),
(16, 'Svey Reang', 0, 12),
(17, 'Prey Veng', 0, 12),
(18, 'Svey Reang', 0, 12),
(19, 'Phnom Penh', 0, 12),
(20, 'Svey Reang', 0, 12),
(21, 'Svey Reang', 0, 12),
(22, 'Prey Veng', 0, 12),
(23, 'Svey Reang', 0, 12),
(24, 'Svey Reang', 0, 12),
(25, 'Prey Veng', 0, 12),
(26, 'Svey Reang', 0, 12),
(27, 'Svey Reang', 0, 12),
(28, 'Prey Veng', 0, 12),
(29, 'Svey Reang', 0, 12),
(30, 'Prey Veng', 0, 12),
(31, 'Svey Reang', 0, 12),
(32, 'Phnom Penh', 0, 12),
(33, 'Prey Veng', 0, 12),
(34, 'Svey Reang', 0, 12),
(35, 'Svey Reang', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `address`, `active`) VALUES
(1, '#64 ABC Street 348 Sangkat Tuol Svay Prey 1, Khan Chamkarmorn Phnom Penh, Cambodia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_categories`
--

CREATE TABLE `department_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_categories`
--

INSERT INTO `department_categories` (`id`, `name`, `active`) VALUES
(1, '111', 0),
(2, 'Sale Department', 1),
(3, 'Social Department', 1),
(4, 'Marketing Department', 1),
(5, 'IT Department', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_options`
--

CREATE TABLE `menu_options` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `member_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `pro_qty` int(11) NOT NULL,
  `pro_discount` float DEFAULT NULL,
  `order_date` varchar(50) NOT NULL,
  `ship_date` varchar(50) DEFAULT NULL,
  `order_status_id` int(11) NOT NULL DEFAULT '1',
  `total` float NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unpaid; 1=paid',
  `payment_date` varchar(45) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `buyer_id`, `pro_id`, `color_id`, `size_id`, `pro_qty`, `pro_discount`, `order_date`, `ship_date`, `order_status_id`, `total`, `payment_status`, `payment_date`, `active`, `created_at`, `updated_at`) VALUES
(5, 'PO07PU8J1555602206', 3, 6, 17, 0, 2, NULL, '2019-04-18 22:43:26', NULL, 1, 90, 0, NULL, 0, '2019-04-18 15:43:26', NULL),
(6, 'PO07PU8J1555602496', 3, 6, 17, 0, 2, NULL, '2019-04-18 22:48:16', NULL, 1, 90, 0, NULL, 0, '2019-04-18 15:48:16', NULL),
(7, 'PO07PU8J1555602515', 3, 6, 17, 0, 2, NULL, '2019-04-18 22:48:35', NULL, 1, 90, 0, NULL, 0, '2019-04-18 15:48:35', NULL),
(8, 'PO07PU8J1555602692', 3, 6, 17, 0, 2, NULL, '2019-04-18 22:51:32', NULL, 1, 90, 0, NULL, 1, '2019-04-18 15:51:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_name`, `active`, `created_at`) VALUES
(1, 'Waiting to prepare', 1, '2019-03-08 08:44:12'),
(2, 'Preparing', 1, '2019-03-08 08:44:12'),
(3, 'To be delivery', 1, '2019-03-08 08:44:12'),
(4, 'On the way', 1, '2019-03-08 08:44:12'),
(5, 'Arrived', 1, '2019-03-08 09:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `description` text,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `photo`, `title`, `description`, `active`) VALUES
(1, '1.jpg', 'About Us', '<p>Welcome to M-Mall Buyer Protection. We want you to shop with confidence and worry less. Our Buyer Protection ensures that your purchases are covered in the event that you encounter a problem.</p>', 1),
(2, NULL, 'Press & Media', '<p>Press &amp; Media</p>', 1),
(3, NULL, 'Contact Us', '<p>Contact Us</p>', 1),
(4, NULL, 'Terms & Conditions', '<p>Terms &amp; Conditions</p>', 1),
(5, NULL, 'Privacy Policy', '<p>Privacy Policy</p>', 1),
(6, NULL, 'Security', '<p>Security</p>', 1),
(7, NULL, 'Delivery Services', '<p>Delivery Services</p>', 1),
(8, NULL, 'Affiliate Program', '<p>Affiliate Program</p>', 1),
(9, NULL, 'Seller Support Center', '<p>Seller Support Center</p>', 1),
(10, NULL, 'Service Marketplace', '<p>Service Marketplace</p>', 1),
(11, NULL, 'Customer Support Center', '<p>Customer Support Center</p>', 1),
(12, NULL, 'Partner Promotion', '<p>Partner Promotion</p>', 1),
(13, NULL, 'Compliance', '<p>Compliance</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `photo`, `url`, `active`, `order`) VALUES
(1, 'Master Card', '1.png', '#', 0, 1),
(2, 'Visa', '2.png', '#', 1, 1),
(3, 'Master Card', '3.png', '/page/1', 1, 2),
(4, 'Paypal', '4.png', '/page/1', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '0',
  `insert` tinyint(4) NOT NULL DEFAULT '0',
  `update` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `list`, `insert`, `update`, `delete`) VALUES
(1, 'Product', 0, 0, 0, 0),
(2, 'Class', 0, 0, 0, 0),
(3, 'School Year', 0, 0, 0, 0),
(4, 'Room', 0, 0, 0, 0),
(5, 'Subject', 0, 0, 0, 0),
(6, 'Student', 0, 0, 0, 0),
(7, 'Permission', 0, 0, 0, 0),
(8, 'Role', 0, 0, 0, 0),
(9, 'User', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phone_support`
--

CREATE TABLE `phone_support` (
  `id` int(11) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_support`
--

INSERT INTO `phone_support` (`id`, `phone`) VALUES
(1, '(+855) 8001-8588, (+855) 874 548 sss');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `featured_image` varchar(200) DEFAULT 'default.png',
  `description` longtext,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(11) DEFAULT NULL,
  `best_deal` int(11) DEFAULT '0',
  `condiction` varchar(30) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `best_seller` int(11) DEFAULT '0',
  `short_description` text,
  `sell_price` float DEFAULT NULL,
  `qr_code_link` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `shop_id`, `category_id`, `price`, `featured_image`, `description`, `active`, `create_at`, `quantity`, `best_deal`, `condiction`, `brand_id`, `best_seller`, `short_description`, `sell_price`, `qr_code_link`) VALUES
(1, 'Brand new T-shirt', 5, 2, 5, '1.png', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 0, '2019-01-12 13:39:44', 150, 0, 'New', 2, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, 'detail-product/1'),
(2, 'Dinner Jackie', 5, 8, 60, '2.png', '<h2><u><em><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit harum repellat quae quo? Libero et perferendis incidunt, labore alias ipsum nisi. Earum error ullam distinctio itaque natus reprehenderit rerum eum!</strong></em></u></h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit harum repellat quae quo? Libero et perferendis incidunt, labore alias ipsum nisi. Earum error ullam distinctio itaque natus reprehenderit rerum eum!</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit harum repellat quae quo? Libero et perferendis incidunt, labore alias ipsum nisi. Earum error ullam distinctio itaque natus reprehenderit rerum eum!</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit harum repellat quae quo? Libero et perferendis incidunt, labore alias ipsum nisi. Earum error ullam distinctio itaque natus reprehenderit rerum eum!</p>', 0, '2019-01-13 11:30:27', 10, 0, 'New', 6, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit harum repellat quae quo? Libero et perferendis incidunt, labore alias ipsum nisi. Earum error ullam distinctio itaque natus reprehenderit rerum eum!', NULL, 'detail-product/2'),
(3, 'Fashion Newborn Baby Boys Long', 5, 2, 15, '3.jpg', '<p><strong>orem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,&nbsp;</p>', 0, '2019-03-01 18:21:17', 20, 0, 'New', 2, 0, 'Fashion Newborn Baby Boys Long Fashion Newborn Baby Boys Long', NULL, 'detail-product/3'),
(4, 'Kids ware', 5, 2, 20, 'pro4.jpg', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</p>', 0, '2019-03-02 01:38:40', 20, 0, 'Second Hand', 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 'detail-product/4'),
(5, 'Adidas Shoe for men', 6, 8, 89.7, '5.jpg', '<p>We use <em>should</em> and shouldn\'t to give advice or to talk about what we think is right or wrong. ... When you regret <em>not</em> doing something in the past, you can say:.We use <em>should</em> and shouldn\'t to give advice or to talk about what we think is right or wrong. ... When you regret <em>not</em> doing something in the past, you can say:.</p>', 0, '2019-03-02 02:36:36', 14, 0, 'New', 2, 0, 'We use should and shouldn\'t to give advice or to talk about', NULL, 'detail-product/5'),
(6, 'Men\'s Watch Good and value', 7, 6, 45, '6.jpg', NULL, 1, '2019-03-29 15:57:18', 61, 0, 'New', 27, 0, 'Good for gentlemen', NULL, 'detail-product/6'),
(7, 'NAVIFORCE Brand new watch for man', 7, 6, 55, 'default.png', NULL, 0, '2019-03-29 16:02:58', 10, 0, 'New', 28, 0, 'NAVIFORCE Brand new watch for men', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `top_brand` tinyint(4) DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `top_brand`, `active`, `icon`) VALUES
(1, 'Xiaomi', 1, 1, NULL),
(2, 'Adidas', 1, 1, NULL),
(26, 'Dark', 1, 1, NULL),
(27, 'iWatch', 1, 1, NULL),
(28, 'NAVIFORCE', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) DEFAULT '0',
  `icon` varchar(250) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `color` tinyint(4) DEFAULT '0',
  `size` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`, `order`, `color`, `size`) VALUES
(1, 'Women’s Clothing', 1, '2018-08-23 16:05:19', 0, NULL, NULL, 1, 1),
(2, 'Men’s Clothing', 1, '2018-08-23 16:05:31', 0, NULL, NULL, 1, 1),
(3, 'Phones & Accessories', 1, '2018-08-23 16:05:39', 0, NULL, NULL, 1, NULL),
(4, 'Computer & Office', 1, '2018-08-23 16:05:47', 0, NULL, NULL, 1, NULL),
(5, 'Consumer Electronics', 1, '2018-08-23 16:05:55', 0, NULL, NULL, 0, 0),
(6, 'Jewelry & Watches', 1, '2018-08-23 16:06:00', 0, NULL, NULL, 1, 1),
(7, 'Home & Garden, Furniture', 1, '2018-08-23 16:06:09', 0, NULL, NULL, 0, 0),
(8, 'Bags & Shoes', 1, '2018-08-23 16:06:15', 0, NULL, NULL, 1, 1),
(9, 'Toys, Kids & Baby', 0, '2018-08-23 16:06:21', 0, NULL, NULL, 0, 0),
(10, 'Health & Beauty, Hair', 0, '2018-08-23 16:06:29', 0, NULL, NULL, 0, 0),
(11, 'Home Improvement', 0, '2018-08-23 16:06:35', 0, NULL, NULL, 0, 0),
(12, 'Beauty & Health', 0, '2018-08-23 16:06:42', 0, NULL, NULL, 0, 0),
(13, 'Watches', 0, '2018-08-23 16:06:48', 0, NULL, NULL, 0, 0),
(14, 'Toys & Hobbies', 0, '2018-08-23 16:06:59', 0, '14akp.png', NULL, 0, 0),
(15, 'Weddings & Events', 0, '2018-08-23 16:07:12', 0, NULL, NULL, 0, 0),
(16, 'Book', 0, '2018-09-29 04:55:38', 7, NULL, NULL, NULL, 1),
(18, 'Testing123', 0, '2019-03-29 14:56:07', 8, NULL, NULL, NULL, NULL),
(19, 'Watches', 1, '2019-03-29 15:24:45', 6, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `name`, `photo`, `product_id`, `active`, `created_at`) VALUES
(2, 'test', '2.jpg', 59, 1, '2019-03-27 16:28:30'),
(3, 'black', '3.jpg', 59, 1, '2019-03-27 16:28:30'),
(4, 'tset', '4.jpg', 59, 1, '2019-03-27 16:28:30'),
(11, '111', '11.jpg', 77, 1, '2019-03-27 16:28:30'),
(13, '2222222', '13.jpg', 77, 1, '2019-03-27 16:28:30'),
(14, 'Testing', '14.jpg', 2, 1, '2019-03-27 16:28:30'),
(15, 'Silver', '15.jpg', 0, 1, '2019-03-29 17:17:03'),
(17, 'Silver', '17.jpg', 6, 1, '2019-03-29 17:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` bigint(20) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `photo`, `product_id`) VALUES
(10, '10.jpg', 43),
(11, '11.jpg', 43),
(12, '12.png', 46),
(13, '13.jpg', 46),
(14, '14.jpg', 46),
(15, '15.png', 46),
(16, '16.jpg', 46),
(17, '17.jpg', 47),
(18, '18.png', 47),
(19, '19.png', 47),
(20, '20.jpg', 47),
(21, '21.jpg', 47),
(22, '22.jpg', 47),
(23, '23.jpg', 47),
(24, '24.jpg', 12),
(25, '25.jpg', 49),
(26, '26.jpg', 50),
(27, '27.png', 50),
(28, '28.jpg', 50),
(29, '29.jpg', 54),
(30, '30.jpg', 55),
(31, '31.jpg', 55),
(32, '32.jpg', 55),
(33, '33.jpg', 59),
(34, '34.jpg', 59),
(35, '35.jpg', 59),
(36, '36.png', 59),
(37, '37.jpg', 59),
(38, '38.jpg', 59),
(39, '39.jpg', 61),
(40, NULL, 61),
(41, '41.jpg', 77),
(42, '42.jpg', 77),
(44, '44.jpg', 77),
(45, '45.jpg', 41),
(46, NULL, 41),
(47, '47.png', 2),
(48, '48.png', 2),
(49, '49.jpg', 3),
(50, '50.jpg', 3),
(51, '51.jpg', 3),
(52, '52.png', 4),
(53, '53.jpg', 4),
(54, '54.jpg', 4),
(55, '55.jpg', 6),
(56, '56.jpg', 6),
(57, '57.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `discount_code` varchar(250) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `number_product` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `start_date` text,
  `end_date` datetime DEFAULT NULL,
  `discount_type` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `discount_code`, `product_id`, `number_product`, `discount`, `start_date`, `end_date`, `discount_type`, `description`, `active`, `created_at`, `updated_at`) VALUES
(12, 'P1NXA19', 1, 6, 15, '2019-03-01 00:02:04', '2019-03-07 00:00:00', 2, 'Khmer new year', 0, '2019-02-26 15:07:40', '2019-03-07 22:03:46'),
(13, 'P3W6B19', 3, 5, 15, '2019-03-02 20:45:02', '2019-03-08 00:00:00', 1, NULL, 0, '2019-03-01 18:43:30', NULL),
(14, 'P607PU19', 6, 10, 10, '2019-03-31 12:57:12', '2019-05-13 00:00:00', 1, 'Khmer new year', 0, '2019-03-30 05:57:13', '2019-03-30 13:06:16'),
(15, 'P607PU19', 6, 10, 10, '2019-03-30 13:05:33', '2019-04-14 00:00:00', 1, 'Khmer new year', 0, '2019-03-30 06:05:33', '2019-03-30 13:06:12'),
(16, 'P607PU19', 6, 10, 10, '2019-03-30 13:21:58', '2019-04-14 00:00:00', 1, NULL, 0, '2019-03-30 06:07:40', '2019-03-30 13:22:17'),
(17, 'P607PU19', 6, 10, 10, '2019-04-03 14:04:00', '2019-04-04 22:04:00', 1, 'Khmer New year promotion', 0, '2019-04-03 07:57:45', NULL),
(18, 'P07PU82019-04-03', 6, 12, 12, '2019-04-03 15:04:00', '2019-04-04 23:04:00', 1, NULL, 0, '2019-04-03 08:18:59', NULL),
(19, 'P07PU1554279681', 6, 12, 12, '2019-04-03 15:04:00', '2019-04-05 23:04:00', 1, 'Khmer New year', 0, '2019-04-03 08:21:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_types`
--

CREATE TABLE `promotion_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion_types`
--

INSERT INTO `promotion_types` (`id`, `name`, `active`, `created_at`) VALUES
(1, 'Basic', 1, '2019-02-25 06:09:49'),
(2, 'Flash Sale', 1, '2019-02-25 06:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `review_products`
--

CREATE TABLE `review_products` (
  `id` int(11) NOT NULL,
  `rate` int(4) DEFAULT NULL COMMENT 'rate from 1 to 5',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_products`
--

INSERT INTO `review_products` (`id`, `rate`, `active`, `create_at`, `description`, `approve`, `buyer_id`, `product_id`) VALUES
(1, 4, 1, '2018-09-19 05:04:49', 'testes', 1, 5, 46),
(2, 4, 1, '2018-09-19 04:32:06', 'test', 0, 7, 45),
(3, 5, 1, '2018-10-17 03:57:54', NULL, 0, 2, 50),
(4, 5, 0, '2019-03-20 16:25:49', NULL, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `create_by` bigint(20) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `create_by`, `active`, `create_at`) VALUES
(1, 'Administrator', 0, 1, '2017-10-31 04:12:44'),
(4, 'អ្នកបញ្ចូលទិន្នន័យ', 0, 0, '2017-10-31 04:12:44'),
(5, 'Manager', 0, 1, '2017-10-31 04:12:44'),
(10, 'Owner', 1, 0, '2017-10-31 04:39:46'),
(11, 'company admin', 1, 0, '2017-10-31 04:40:23'),
(12, 'root re', 1, 0, '2017-10-31 04:45:27'),
(13, 'Credit Officer', 20, 0, '2017-10-31 14:34:28'),
(14, 'Sale Manager', 1, 1, '2017-11-09 02:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `list` int(11) NOT NULL DEFAULT '0',
  `insert` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `list`, `insert`, `update`, `delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 6, 1, 1, 1, 1),
(3, 1, 5, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 3, 1, 1, 1, 1),
(6, 1, 2, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(9, 4, 2, 1, 1, 1, 1),
(10, 4, 3, 1, 1, 1, 1),
(11, 4, 6, 1, 1, 1, 1),
(12, 4, 9, 0, 0, 0, 0),
(13, 1, 9, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `code` varchar(250) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `shop_category` int(11) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `logo` varchar(200) NOT NULL DEFAULT 'default.png',
  `shop_owner_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext,
  `location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `code`, `name`, `shop_category`, `address`, `phone`, `email`, `website`, `logo`, `shop_owner_id`, `subscription_id`, `active`, `create_at`, `description`, `location`) VALUES
(7, NULL, 'HELLO ONLINE SHOP', 6, 'Phnom Penh', '010674459', 'rithysam.sr@gmail.com', NULL, 'pro1.jpg', 4, 1, 1, '2019-03-29 15:36:56', 'Hello online shop help you to be modern and valuable.\r\nOur values is your time!!', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7817.388743368863!2d104.91771359999996!3d11.573753699999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spnc!5e0!3m2!1skm!2skh!4v1546409981204\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Testing Testing', 0, '2019-03-20 15:55:35'),
(2, 'Testing', 1, '2019-03-20 15:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `shop_owners`
--

CREATE TABLE `shop_owners` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'default.png',
  `address` text,
  `password` varchar(250) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activated` tinyint(4) NOT NULL DEFAULT '1',
  `type` varchar(50) NOT NULL DEFAULT 'Free Account'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_owners`
--

INSERT INTO `shop_owners` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `photo`, `address`, `password`, `is_verified`, `active`, `create_at`, `activated`, `type`) VALUES
(1, 'Rithy', 'Sam', 'Male', 'rithysam@gmail.com', '010674459', 'default.png', NULL, '$2y$10$Z61gGzui9GoXPxkzIX03COMK9PKgfs1yVrOx2Jf76DTGg48fq8REm', 1, 0, '2018-10-25 15:25:49', 1, 'Normal Account'),
(3, 'Rithy', 'Sam', 'Male', 'rithysam.sr@gmail.com', '010674459', 'pro3.png', 'rithysam.sr@gmail.com', '$2y$10$Z61gGzui9GoXPxkzIX03COMK9PKgfs1yVrOx2Jf76DTGg48fq8REm', 1, 1, '2018-10-25 15:34:57', 1, 'Normal Account'),
(4, 'vichey', 'sor', 'Male', 'sorvichey@gmail.com', '0962555209', 'pro4.jpg', 'sorvichey@gmail.com', '$2y$10$p5t7ON8TpjDKX3en8VCC2eeyd6LANFhI4bcx1K/OA.xpVwDTwl7iq', 1, 1, '2018-12-14 13:56:02', 1, 'Normal Account'),
(5, 'Rithy', 'Rithy', 'Male', 'rithysam@uhs.edu.kh', '085674459', 'pro5.png', '', '$2y$10$rQ5yX40q4lV8NcHKoNaSouHDguv4b0D7DohVupszq41/5kvwa/eC.', 1, 1, '2019-03-02 02:00:53', 1, 'Free Account');

-- --------------------------------------------------------

--
-- Table structure for table `shop_sellers`
--

CREATE TABLE `shop_sellers` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'default.png',
  `address` text,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_product` int(11) NOT NULL DEFAULT '1',
  `shop_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_seller_documents`
--

CREATE TABLE `shop_seller_documents` (
  `id` int(11) NOT NULL,
  `description` varchar(220) DEFAULT NULL,
  `file_name` varchar(120) DEFAULT NULL,
  `shop_seller_id` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_subscriptions`
--

CREATE TABLE `shop_subscriptions` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_subscriptions`
--

INSERT INTO `shop_subscriptions` (`id`, `shop_id`, `subscription_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2019-01-02 22:50:14', NULL),
(2, 5, 1, 1, '2019-01-02 22:56:09', NULL),
(5, 5, 2, 1, '2019-01-02 23:58:24', '2019-01-05 16:53:46'),
(6, 5, 3, 1, '2019-01-08 23:09:28', '2019-03-20 16:10:35'),
(7, 5, 3, 1, '2019-01-08 23:09:33', '2019-03-20 16:10:35'),
(8, 5, 3, 1, '2019-01-08 23:11:03', '2019-03-20 16:10:35'),
(9, 5, 3, 1, '2019-01-08 23:12:24', '2019-03-20 16:10:35'),
(10, 6, 1, 1, '2019-03-02 09:09:43', NULL),
(11, 7, 1, 1, '2019-03-29 22:36:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `photo` varchar(80) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT '1',
  `order` tinyint(4) DEFAULT '0',
  `url` varchar(200) DEFAULT NULL,
  `short_description` varchar(150) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `photo`, `create_at`, `active`, `order`, `url`, `short_description`, `discount`) VALUES
(1, 'shop to get what you loves to', '1.jpg', '2018-08-14 03:09:32', 0, 1, '111', 'Timepieces that make a statement up to to', 50),
(2, 'shop to get what you loves', NULL, '2018-08-14 03:17:55', 0, 29, '22222', 'shop to get what you loves', 30),
(3, 'shop to get what you loves', NULL, '2018-08-14 03:18:10', 0, 29, '22222', 'shop to get what you loves', 30),
(4, 'shop to get what you loves', NULL, '2018-08-14 03:18:29', 0, 29, '22222', 'shop to get what you loves', 30),
(5, 'shop to get what you loves', NULL, '2018-08-14 03:18:50', 0, 100, '144', 'test', 100),
(6, 'shop to get what you loves', NULL, '2018-08-14 03:19:04', 0, 100, '144', 'test', 100),
(7, 'shop to get what you loves', NULL, '2018-08-14 03:19:32', 0, 100, '144', 'test', 100),
(8, 'shop to get what you loves', NULL, '2018-08-14 03:19:47', 0, 100, '144', 'test', 100),
(9, 'shop to get what you loves', NULL, '2018-08-14 03:19:54', 0, 100, '144', 'test', 100),
(10, 'shop to get what you loves', NULL, '2018-08-14 03:20:32', 0, 100, '144', 'test', 100),
(11, 'shop to get what you loves', NULL, '2018-08-14 03:20:44', 0, 100, '144', 'test', 100),
(12, 'shop to get what you loves', NULL, '2018-08-14 03:20:52', 0, 100, '144', 'test', 100),
(13, 'shop to get what you loves', NULL, '2018-08-14 03:21:11', 0, 100, '144', 'test', 100),
(14, 'shop to get what you loves', '14.png', '2018-08-14 03:21:34', 0, 100, '144', 'test', 100),
(15, 'shop to get what you loves', '15.jpg', '2018-08-14 03:21:58', 1, 2, '11', 'New Shop Now', 11),
(16, 'shop to get what you loves', '16.jpg', '2018-08-14 03:30:25', 1, 3, '#', 'shop to get what you loves', 20),
(17, 'fa fa-google-plus', '17.jpg', '2018-08-14 03:52:43', 1, 4, '#', 'fa fa-google-plus', NULL),
(18, 'Master Card', '18.png', '2018-08-15 03:07:53', 0, 1, '#', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `fa_fa_icon` varchar(50) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `name`, `fa_fa_icon`, `url`, `active`, `order`) VALUES
(1, 'Administrator', 'fa fa-facebook', 'https://www.facebook.com/', 0, NULL),
(2, 'Facebook', 'fa fa-facebook', 'https://www.facebook.com/', 1, 1),
(3, 'Youtube', 'fa fa-youtube', 'https://youtube.com', 1, 2),
(4, 'Facebook', 'fa fa-facebook', 'https://www.facebook.com/', 0, NULL),
(5, 'Twitter', 'fa fa-twitter', '#', 1, 3),
(6, 'Linkedin', 'fa fa-linkedin', '#', 1, 4),
(7, 'Google Plus', 'fa fa-google-plus', '#', 1, 5),
(8, 'RSS', 'fa fa-rss', '#', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `price` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `posted_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `description`, `price`, `active`, `duration`, `posted_product`) VALUES
(1, 'Normal', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, 365, 50),
(2, 'Silver', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 100, 1, 365, 100),
(3, 'Brown', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 80, 1, 365, 70),
(4, 'Gold', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 200, 1, 365, 365),
(5, 'Testing Testing', NULL, 123, 0, 365, 123);

-- --------------------------------------------------------

--
-- Table structure for table `sub_pages`
--

CREATE TABLE `sub_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `page_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_pages`
--

INSERT INTO `sub_pages` (`id`, `title`, `description`, `page_id`, `active`, `create_at`) VALUES
(1, 'test', '<p>test</p>', 1, 0, '2018-09-19 03:51:04'),
(2, 'Test', '<p>Test</p>', 1, 1, '2018-10-19 09:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_tracking`
--

CREATE TABLE `sub_tracking` (
  `id` int(11) NOT NULL,
  `tracking_id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `datetime` varchar(60) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_tracking`
--

INSERT INTO `sub_tracking` (`id`, `tracking_id`, `location`, `datetime`, `status`, `active`, `note`) VALUES
(1, 23, 'test', '10/10/2018 10:00PM', 'padding', 1, NULL),
(2, 23, 'test', '10/10/2018 10:00PM', 'padding', 1, NULL),
(3, 23, 'Test1111111111', '10/110/2018 10:00PM', 'start', 0, NULL),
(4, 23, 'Test1111111111', '111', 'start', 0, '111'),
(5, 23, 'Test1111111111', '111', 'start', 0, '111');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `waybill` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `pcs` varchar(20) NOT NULL,
  `datetime` varchar(60) NOT NULL,
  `status` varchar(30) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `receiver` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `waybill`, `origin`, `destination`, `pcs`, `datetime`, `status`, `active`, `receiver`) VALUES
(1, '00001', 'Cambodia', 'China', '100', '2018-11-14', 'Arrival', 0, ''),
(2, '1234567', 'Cambodia', 'China', '100', '2018-11-14', 'Arrival', 0, ''),
(3, '001', 'Cambodia', 'China', '11', '10/10/2018 10:00PM', 'Arrival', 0, ''),
(4, '002', 'Cambodia', 'China', '111', '10/10/2018 10:00PM', 'Arrival', 0, ''),
(5, '0001', 'Cambodia', 'China', '1', '01/12/2017 06:08 PM', 'Arrival', 0, ''),
(6, '0004', 'Cambodia', 'China', '11', '10/10/2018 10:00PM', 'Arrival', 0, ''),
(7, '0005', 'Vietnam', 'Hong Kong', '1001', '10/10/2018 10:00PM', 'Arrival', 0, ''),
(8, '00051', 'Cambodia', 'China', '111', '111', 'Pendding', 0, ''),
(9, '0011', 'Cambodia', 'China', '1', '111', 'Arrival', 1, '9asdfasdfasd'),
(10, 'abC11', 'Cambodiads', 'Cambodia', '2', '10/10/2018 10:00PM', 'padding', 1, '1'),
(11, '11111111111111', 'Cambodia', 'China', '111', '11', 'Arrival', 1, '111'),
(12, 'asdfasdf', 'Cambodia', 'China', '1111', 'asdfasdf', 'Arrival', 1, 'dsfasdfa'),
(13, '1111111111', 'Cambodia', 'China', '111', '111', 'Arrival', 1, '111eedsfasdfasdf'),
(14, '11111', 'Cambodiads', 'Cambodia', '11111', '10/10/2018 10:00PM', 'padding', 1, 'KH'),
(15, '001', 'Thailand', 'China', '11', '10/10/2018 10:00PM', 'Arrival', 1, '111'),
(16, '11111111111111d', 'Cambodia', 'China', '111', '10/10/2018 10:00PM', 'Arrival', 1, '111ee'),
(17, '4444', 'Cambodia', 'China', '111', '111', 'Arrival', 1, 'dfasdfasdf'),
(18, '001asdfasdfasdf', 'Cambodia', 'China', '1', '25/11/2018', 'Arrival', 1, '111ee111111dsfaf'),
(19, '11111111111111dfafasdf', 'Cambodia', 'China', '111', '25/33/2018', 'Arrival', 0, '1'),
(20, '11111111', 'Cambodiads', 'Cambodia', '111', '111', 'padding', 1, NULL),
(21, 'tset', 'Cambodiads', 'Cambodia', '11', '11', 'padding', 1, NULL),
(22, 'test', 'Cambodiads', 'Cambodia', '11', '11', 'padding', 1, NULL),
(23, '111', 'Cambodiads', 'Cambodia', '1', '111', 'start', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tracking_destinations`
--

CREATE TABLE `tracking_destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking_destinations`
--

INSERT INTO `tracking_destinations` (`id`, `name`) VALUES
(3, 'Cambodia');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_locations`
--

CREATE TABLE `tracking_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking_locations`
--

INSERT INTO `tracking_locations` (`id`, `name`) VALUES
(2, 'Test1111111111'),
(3, 'test3'),
(4, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_origins`
--

CREATE TABLE `tracking_origins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking_origins`
--

INSERT INTO `tracking_origins` (`id`, `name`) VALUES
(2, 'Thailand1'),
(3, 'Cambodiads');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_status`
--

CREATE TABLE `tracking_status` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking_status`
--

INSERT INTO `tracking_status` (`id`, `name`) VALUES
(2, 'start'),
(3, 'padding');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `api_token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `role_id`, `first_name`, `last_name`, `gender`, `phone`, `active`, `api_token`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Z61gGzui9GoXPxkzIX03COMK9PKgfs1yVrOx2Jf76DTGg48fq8REm', 'O1iwlSdW0oobJMMp3zbCmunbVtiwl6FaHeTiR1uBOkdCHnOCZObhvyBkR9Bu', '2017-05-27 22:35:52', '2017-05-27 22:35:52', '0.jpeg', 1, 'sor', 'vichey', 'Male', '01028339', 1, '5j1dPP09govoEL70bI63XofRHmlxKojbdv4E+QanCjY='),
(9, 'rithy', 'rithysam.sr@gmail.com', '$2y$10$mrKlR2AOICnOFPlj3wUuzOPhy.Jh3b6TVM6VABgWD8HFLzV1OPu0.', NULL, NULL, NULL, 'default.png', 1, 'Rithy', 'Sam', 'Male', '0112024938434', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`id`, `buyer_id`, `product_id`, `active`, `status`, `create_at`, `updated_at`) VALUES
(1, 3, 1, 0, 0, '2019-01-15 06:51:51', '2019-03-07 14:35:39'),
(2, 2, 5, 1, 0, '2019-03-20 17:16:15', '2019-03-27 12:03:45'),
(3, 2, 4, 1, 0, '2019-03-20 17:16:20', '2019-03-20 17:16:27'),
(4, 3, 6, 1, 0, '2019-04-08 11:31:54', '2019-04-08 11:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_carts`
--
ALTER TABLE `add_to_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_categories`
--
ALTER TABLE `career_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_locations`
--
ALTER TABLE `career_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_locations_r_careers`
--
ALTER TABLE `career_locations_r_careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_categories`
--
ALTER TABLE `department_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_options`
--
ALTER TABLE `menu_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_support`
--
ALTER TABLE `phone_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_types`
--
ALTER TABLE `promotion_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_products`
--
ALTER TABLE `review_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_owners`
--
ALTER TABLE `shop_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_sellers`
--
ALTER TABLE `shop_sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_seller_documents`
--
ALTER TABLE `shop_seller_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_subscriptions`
--
ALTER TABLE `shop_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_pages`
--
ALTER TABLE `sub_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_tracking`
--
ALTER TABLE `sub_tracking`
  ADD PRIMARY KEY (`id`,`tracking_id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_destinations`
--
ALTER TABLE `tracking_destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_locations`
--
ALTER TABLE `tracking_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_origins`
--
ALTER TABLE `tracking_origins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_status`
--
ALTER TABLE `tracking_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_carts`
--
ALTER TABLE `add_to_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `career_categories`
--
ALTER TABLE `career_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `career_locations`
--
ALTER TABLE `career_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `career_locations_r_careers`
--
ALTER TABLE `career_locations_r_careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department_categories`
--
ALTER TABLE `department_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu_options`
--
ALTER TABLE `menu_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `phone_support`
--
ALTER TABLE `phone_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `promotion_types`
--
ALTER TABLE `promotion_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review_products`
--
ALTER TABLE `review_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop_owners`
--
ALTER TABLE `shop_owners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_sellers`
--
ALTER TABLE `shop_sellers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_seller_documents`
--
ALTER TABLE `shop_seller_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_subscriptions`
--
ALTER TABLE `shop_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_pages`
--
ALTER TABLE `sub_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_tracking`
--
ALTER TABLE `sub_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tracking_destinations`
--
ALTER TABLE `tracking_destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracking_locations`
--
ALTER TABLE `tracking_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tracking_origins`
--
ALTER TABLE `tracking_origins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracking_status`
--
ALTER TABLE `tracking_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
