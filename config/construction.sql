-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2023 at 05:37 PM
-- Server version: 8.0.33-0ubuntu0.22.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_users`
--

CREATE TABLE `assigned_users` (
  `id` int NOT NULL,
  `owner_user_id` int DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `credit_status` enum('0','1') DEFAULT NULL COMMENT '''0'' is assigned user,1 is purched credit',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assigned_users`
--

INSERT INTO `assigned_users` (`id`, `owner_user_id`, `project_id`, `user_id`, `credit_status`, `created_date`) VALUES
(1, 3, 4, 13, '0', '2023-05-02 07:02:03'),
(2, 3, 8, 13, '1', '2023-05-12 09:58:27'),
(3, 7, 6, 13, '0', '2023-05-12 11:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `contractor_credit`
--

CREATE TABLE `contractor_credit` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_credit` double NOT NULL,
  `credit_status` enum('0','1') DEFAULT NULL,
  `credited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contractor_credit`
--

INSERT INTO `contractor_credit` (`id`, `user_id`, `total_credit`, `credit_status`, `credited_date`) VALUES
(1, 13, 20, NULL, '2023-04-25 09:09:50'),
(2, 35, 450, NULL, '2023-05-08 12:06:48'),
(3, 36, 800, NULL, '2023-05-08 12:07:27'),
(4, 37, 30, NULL, '2023-05-12 06:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `message_for` enum('0','1','2') DEFAULT NULL COMMENT '0 = admin , 1 = owner , 2 = scgc',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'o = unread , 1 = read',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `message_for`, `status`, `created_date`) VALUES
(1, 32, 'New Registration for Owner.', '0', '1', '2023-05-01 12:50:15'),
(2, 9, 'Your Project White House is accepted.', '1', '0', '2023-05-02 05:36:28'),
(3, 3, 'Your Project Highway Road is accepted.', '1', '0', '2023-05-02 05:37:51'),
(4, 3, 'Your project Highway Road is Assigned to Rahul Trivedi .', '1', '0', '2023-05-02 05:39:48'),
(5, 13, 'New project Highway Road is Assigned .', '2', '1', '2023-05-02 05:39:48'),
(6, 2, 'New Project Request From Deepu kumar.', '0', '1', '2023-05-02 06:37:13'),
(7, 3, 'Your project Highway Road is Assigned to Rahul Trivedi .', '1', '0', '2023-05-02 07:01:59'),
(8, 13, 'New project Highway Road is Assigned .', '2', '1', '2023-05-02 07:01:59'),
(9, 33, 'New Registration for General Contractor.', '0', '1', '2023-05-03 06:28:31'),
(10, 34, 'New Registration for Sub Contractor.', '0', '1', '2023-05-03 07:15:14'),
(11, 2, 'Your Project Test Project  is accepted.', '0', '1', '2023-05-03 07:26:35'),
(12, 13, 'Your credit is not enough! please refill it', '2', '1', '2023-05-03 09:56:45'),
(13, 35, 'New Registration for Sub Contractor.', '0', '1', '2023-05-03 11:41:19'),
(14, 14, '100 $ credit in your account.', '2', '0', '2023-05-08 12:06:48'),
(15, 12, '100 $ credit in your account.', '2', '0', '2023-05-08 12:07:29'),
(16, 36, 'New Registration for Sub Contractor.', '0', '1', '2023-05-09 07:18:05'),
(17, 37, 'New Registration for Sub Contractor.', '0', '1', '2023-05-11 11:13:28'),
(18, 37, '10 $ credit in your account.', '2', '0', '2023-05-12 06:09:57'),
(19, 37, '10 $ credit in your account.', '2', '0', '2023-05-12 06:11:02'),
(20, 3, 'Your project White House is Assigned to Rahul Trivedi .', '1', '0', '2023-05-12 09:58:23'),
(21, 13, 'New project White House is Assigned .', '2', '1', '2023-05-12 09:58:23'),
(22, 7, 'Your Project Police Staion is accepted.', '1', '0', '2023-05-12 11:35:40'),
(23, 7, 'Your project Police Staion is Assigned to Rahul Trivedi .', '1', '0', '2023-05-12 11:36:15'),
(24, 13, 'New project Police Staion is Assigned .', '2', '1', '2023-05-12 11:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `owner_services`
--

CREATE TABLE `owner_services` (
  `id` int NOT NULL,
  `project_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `owner_services`
--

INSERT INTO `owner_services` (`id`, `project_id`, `user_id`, `service_id`) VALUES
(1, 1, 2, 1),
(2, 1, NULL, 2),
(3, 1, NULL, 3),
(4, 1, NULL, 4),
(5, 1, NULL, 5),
(6, 1, NULL, 6),
(7, 1, NULL, 7),
(8, 1, NULL, 8),
(9, 1, NULL, 9),
(10, 1, NULL, 10),
(11, 1, NULL, 11),
(12, 1, NULL, 12),
(13, 1, NULL, 13),
(14, 1, NULL, 14),
(15, 1, NULL, 15),
(16, 1, NULL, 16),
(17, 1, NULL, 17),
(18, 2, NULL, 1),
(19, 2, NULL, 2),
(20, 2, NULL, 3),
(21, 2, NULL, 4),
(22, 2, NULL, 5),
(23, 2, NULL, 6),
(24, 2, NULL, 7),
(25, 2, NULL, 8),
(26, 2, NULL, 9),
(27, 2, NULL, 10),
(28, 2, NULL, 11),
(29, 2, NULL, 12),
(30, 2, NULL, 13),
(31, 2, NULL, 14),
(32, 2, NULL, 15),
(33, 2, NULL, 16),
(34, 2, NULL, 17),
(35, 3, NULL, 5),
(36, 3, NULL, 6),
(37, 3, NULL, 13),
(38, 3, NULL, 14),
(39, 3, NULL, 17),
(40, 4, NULL, 1),
(41, 4, NULL, 2),
(42, 4, NULL, 3),
(43, 4, NULL, 4),
(44, 4, NULL, 5),
(45, 4, NULL, 6),
(46, 4, NULL, 7),
(47, 4, NULL, 8),
(48, 4, NULL, 9),
(49, 4, NULL, 10),
(50, 4, NULL, 11),
(51, 4, NULL, 12),
(52, 4, NULL, 13),
(53, 4, NULL, 14),
(54, 4, NULL, 15),
(55, 4, NULL, 16),
(56, 4, NULL, 17),
(57, 5, NULL, 1),
(58, 5, NULL, 2),
(59, 5, NULL, 3),
(60, 5, NULL, 4),
(61, 5, NULL, 5),
(62, 5, NULL, 6),
(63, 5, NULL, 7),
(64, 5, NULL, 8),
(65, 5, NULL, 9),
(66, 5, NULL, 10),
(67, 5, NULL, 11),
(68, 5, NULL, 12),
(69, 5, NULL, 13),
(70, 5, NULL, 14),
(71, 5, NULL, 15),
(72, 5, NULL, 16),
(73, 5, NULL, 17),
(74, 6, NULL, 1),
(75, 6, NULL, 2),
(76, 6, NULL, 3),
(77, 6, NULL, 4),
(78, 6, NULL, 5),
(79, 6, NULL, 6),
(80, 6, NULL, 7),
(81, 6, NULL, 8),
(82, 6, NULL, 9),
(83, 6, NULL, 10),
(84, 6, NULL, 11),
(85, 6, NULL, 12),
(86, 6, NULL, 13),
(87, 6, NULL, 14),
(88, 6, NULL, 15),
(89, 6, NULL, 16),
(90, 6, NULL, 17),
(91, 7, NULL, 15),
(92, 7, NULL, 17),
(93, 8, NULL, 1),
(94, 8, NULL, 2),
(95, 8, NULL, 3),
(96, 8, NULL, 4),
(97, 8, NULL, 5),
(98, 8, NULL, 6),
(99, 8, NULL, 7),
(100, 8, NULL, 8),
(101, 8, NULL, 9),
(102, 8, NULL, 10),
(103, 8, NULL, 11),
(104, 8, NULL, 12),
(105, 8, NULL, 13),
(106, 8, NULL, 14),
(107, 8, NULL, 15),
(108, 8, NULL, 16),
(109, 8, NULL, 17),
(110, 9, NULL, 1),
(111, 9, NULL, 2),
(112, 9, NULL, 3),
(113, 9, NULL, 4),
(114, 9, NULL, 5),
(115, 9, NULL, 6),
(116, 9, NULL, 7),
(117, 9, NULL, 8),
(118, 9, NULL, 9),
(119, 9, NULL, 10),
(120, 9, NULL, 11),
(121, 9, NULL, 12),
(122, 9, NULL, 13),
(123, 9, NULL, 14),
(124, 9, NULL, 15),
(125, 9, NULL, 16),
(126, 9, NULL, 17);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `delete_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `service_id`, `product_name`, `delete_status`, `created`, `updated`) VALUES
(1, 1, 'All - General Contractor ', '1', '2019-08-09 04:32:38', '2022-03-25 04:48:12'),
(2, 2, 'Equipment Rental - Lot Clearing', '1', '2019-08-09 04:32:38', '2022-03-25 03:47:07'),
(3, 2, 'Landscape Supply', '1', '2019-08-09 04:36:46', '2022-03-25 03:12:22'),
(4, 5, 'Equipment Rental - Rough Grading', '1', '2019-08-09 04:36:46', '2022-03-25 03:47:25'),
(5, 1, 'Equipment Rental - Demolition', '1', '2019-08-09 04:36:46', '2022-03-25 03:47:32'),
(6, 1, 'Electrical Supplier - Temporary Electric', '1', '2019-08-09 04:36:46', '2022-03-25 03:46:38'),
(7, 2, 'Plumbing Supplier - Individual Wells', '1', '2019-08-09 04:36:46', '2022-03-25 03:55:39'),
(8, 1, 'Supplier - Water Service	Plumber', '1', '2019-08-09 04:36:46', '2022-03-25 03:57:07'),
(9, 1, 'Plumbing Supplier - Gas Service', '1', '2019-08-09 04:36:46', '2022-03-25 03:55:19'),
(10, 1, 'Electrical Supplier - Electric Service', '1', '2019-08-09 04:36:46', '2022-03-25 03:45:28'),
(11, 15, 'Concrete Supplier - Footings and Foundation', '1', '2019-08-09 04:36:46', '2022-03-25 03:39:21'),
(12, 1, 'Concrete Supplier - Rebar and Reinforcing Steel', '1', '2019-08-09 04:36:46', '2022-03-25 03:39:33'),
(13, 1, 'Concrete Supplier - Window Wells', '1', '2019-08-09 04:36:46', '2022-03-25 03:39:44'),
(14, 1, 'Concrete Supplier - Waterproofing', '1', '2022-03-24 18:30:00', '2022-03-25 03:39:55'),
(15, 1, 'Concrete Supplier - Termite Protection', '1', '2022-03-25 02:59:30', '2022-03-25 03:40:08'),
(16, 1, 'Lumber Yard - Framing - Lumber', '1', '2022-03-25 02:59:30', '2022-03-25 03:52:15'),
(17, 3, 'Truss Manufacturer', '1', '2022-03-25 02:59:30', '2022-03-25 03:16:31'),
(18, 1, 'Lumber Yard - Framing - Miscellaneous Lumber', '1', '2022-03-25 02:59:30', '2022-03-25 03:51:02'),
(19, 4, 'Window Dealer - Windows', '1', '2022-03-25 02:59:30', '2022-03-25 03:57:55'),
(20, 1, 'Window Dealer - Skylights', '1', '2022-03-25 02:59:30', '2022-03-25 03:58:00'),
(21, 1, 'Lumber Yard - Exterior Siding', '1', '2022-03-25 02:59:30', '2022-03-25 03:51:14'),
(22, 1, 'Lumber Yard - Exterior Trim', '1', '2022-03-25 02:59:30', '2022-03-25 03:51:41'),
(23, 1, 'Concrete Supplier - Flatwork', '1', '2022-03-25 02:59:30', '2022-03-25 03:40:42'),
(24, 1, 'Plumbing Supplier - HVAC', '1', '2022-03-25 02:59:30', '2022-03-25 03:54:38'),
(25, 1, 'Plumbing Supplier - Plumbing', '1', '2022-03-25 02:59:30', '2022-03-25 03:54:54'),
(26, 1, 'Electrical Supplier - Electrical', '1', '2022-03-25 02:59:30', '2022-03-25 03:45:08'),
(27, 1, 'Lumber Yard - Gutters and Downspout', '1', '2022-03-25 02:59:30', '2022-03-25 03:52:10'),
(28, 1, 'Roofing Supplier', '1', '2022-03-25 02:59:30', '2022-03-25 03:22:28'),
(29, 1, 'Door Dealer', '1', '2022-03-25 02:59:30', '2022-03-25 03:23:02'),
(30, 1, 'Garage Door Manufacturer', '1', '2022-03-25 02:59:30', '2022-03-25 03:25:01'),
(31, 1, 'Insulation Distributor', '1', '2022-03-25 02:59:30', '2022-03-25 03:25:18'),
(32, 1, 'Fireplace Dealer', '1', '2022-03-25 02:59:30', '2022-03-25 03:25:35'),
(33, 1, 'Drywall Distributor', '1', '2022-03-25 02:59:30', '2022-03-25 03:25:49'),
(34, 1, 'Lumber yard - Interior Trim', '1', '2022-03-25 02:59:30', '2022-03-25 03:49:39'),
(35, 1, 'Paint Supplier - Interior Painting', '1', '2022-03-25 02:59:30', '2022-03-25 03:53:36'),
(36, 1, 'Paint Supplier - Exterior Painting', '1', '2022-03-25 02:59:30', '2022-03-25 03:53:45'),
(37, 1, 'Cabinet Fabricator', '1', '2022-03-25 02:59:30', '2022-03-25 03:27:23'),
(38, 1, 'Counter Top Supplier', '1', '2022-03-25 02:59:30', '2022-03-25 03:27:34'),
(39, 1, 'Tile Retailer', '1', '2022-03-25 02:59:30', '2022-03-25 03:27:45'),
(40, 1, 'Flooring Retailer - Special Flooring', '1', '2022-03-25 02:59:30', '2022-03-25 03:48:19'),
(41, 1, 'Flooring Retailer - Carpet', '1', '2022-03-25 02:59:30', '2022-03-25 03:48:13'),
(42, 1, 'Specialty Glass Dealer', '1', '2022-03-25 02:59:30', '2022-03-25 03:28:36'),
(43, 1, 'Appliance Retailer', '1', '2022-03-25 02:59:30', '2022-03-25 03:28:50'),
(44, 1, 'Electrical Supplier - Electrical Fixtures', '1', '2022-03-25 02:59:30', '2022-03-25 03:46:03'),
(45, 1, 'Wall Covering Retailer', '1', '2022-03-25 02:59:30', '2022-03-25 03:29:21'),
(46, 1, 'Concrete Supplier - Driveways', '1', '2022-03-25 02:59:30', '2022-03-25 03:38:22'),
(47, 1, 'Lumber Yard - Decks', '1', '2022-03-25 02:59:30', '2022-03-25 03:50:41'),
(48, 1, 'Lumber Yard - Fences', '1', '2022-03-25 02:59:30', '2022-03-25 03:50:21'),
(49, 1, 'Nursery', '1', '2022-03-25 02:59:30', '2022-03-25 03:34:49'),
(50, 1, 'Concrete Supplier - Patios and Walkways', '1', '2022-03-25 02:59:30', '2022-03-25 03:38:02'),
(51, 1, 'Builders Risk', '1', '2022-07-14 05:57:37', '2022-07-14 05:57:37'),
(52, 1, 'General Liability Insurance', '1', '2022-07-14 05:57:37', '2022-07-14 05:57:37'),
(53, 1, 'Architecture & Design Fees (Soft Cost)', '1', '2022-07-14 05:57:37', '2022-07-14 05:57:37'),
(54, 1, 'Exterior/Interior Door', '1', '2023-04-25 01:33:10', '2023-04-25 01:33:10'),
(55, 1, 'Rose', '1', '2023-05-09 04:57:20', '2023-05-09 04:57:20'),
(56, 19, 'RRR', '1', '2023-05-10 12:42:12', '2023-05-10 12:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `project_name` varchar(255) NOT NULL,
  `contractor` int DEFAULT NULL,
  `project_address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `project_address2` varchar(250) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `property_type` enum('1','2') NOT NULL,
  `pincode` int NOT NULL,
  `assigned_status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0 is unassigned , 1 is assigned, 2is Delete',
  `accept_status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0 is unaccepted , 1 is accepted,2 is delete',
  `delete_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 is delete,1 is recover',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `project_name`, `contractor`, `project_address1`, `project_address2`, `state`, `city`, `property_type`, `pincode`, `assigned_status`, `accept_status`, `delete_status`, `created_date`) VALUES
(1, 2, 'Metro Station', 2, 'Chandigarh', 'Chandigarh', 'UT', 'Housing Board', '1', 123456, '0', '1', '1', '2023-04-21 05:35:06'),
(2, 2, 'GST Office', 2, 'Peer Mchhulla', 'Peer Mchhulla Sector 20', 'Punajb', 'Zirakpur', '1', 123456, '0', '1', '1', '2023-04-20 05:59:36'),
(3, 3, 'Goverment Colony', 3, 'Abhaypur', 'Abhaypur', 'Haryana', 'ManiMajra', '1', 123456, '0', '0', '1', '2023-04-28 06:35:44'),
(4, 3, 'Highway Road', 2, 'Shimla', '', 'Himachal', 'Shimla', '1', 123456, '1', '1', '1', '2023-04-28 06:39:13'),
(5, 7, 'Tunnel bridge', 2, 'Chandigarh', '', 'Chandigarh U/T', 'Mani Majra', '1', 123456, '1', '0', '1', '2023-04-28 07:15:11'),
(6, 7, 'Police Staion', 2, 'panchkula ', '', 'Haryana', 'Sector 22', '1', 123456, '1', '1', '1', '2023-04-28 07:16:56'),
(7, 9, 'Bricks Chinmey', 3, 'gurudashpur', '', 'Punjab', 'Gurudashpur', '1', 569872, '0', '0', '1', '2023-04-28 07:25:20'),
(8, 3, 'White House', 2, 'Abhaypur', '', 'Haryana', 'Majri Chouk', '1', 123456, '1', '1', '1', '2023-04-28 07:27:08'),
(9, NULL, 'Test Project ', 2, 'Mirganj', 'Gopalganj', 'Bihar', 'MIrganj', '1', 841428, '0', '1', '1', '2023-05-01 06:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `service` varchar(250) NOT NULL,
  `service_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `service_status`, `created`) VALUES
(1, 'Plants', '1', '2023-04-17 11:22:57'),
(2, 'HAVC', '1', '2023-04-17 11:23:53'),
(3, 'Siding', '1', '2023-04-17 11:24:46'),
(4, 'Roofing', '1', '2023-04-17 11:24:54'),
(5, 'Rough in Plumbing', '1', '2023-04-17 11:25:08'),
(6, 'Exterior Paint', '1', '2023-04-17 11:25:23'),
(7, 'Drywall', '1', '2023-04-17 11:25:30'),
(8, 'Security System', '1', '2023-04-17 11:25:43'),
(9, 'Garage Doors & Openers', '1', '2023-04-17 11:25:55'),
(10, 'Temp Toilet', '1', '2023-04-17 11:26:04'),
(11, 'Temp Utilities', '1', '2023-04-17 11:26:12'),
(12, 'Sewer/Septic', '1', '2023-04-17 11:26:23'),
(13, 'Interior Paint', '1', '2023-04-17 11:26:33'),
(14, 'Stairs & Railings', '1', '2023-04-17 11:26:44'),
(15, 'Fireplace/Chimney', '1', '2023-04-17 11:26:53'),
(16, 'Insurance', '1', '2023-04-17 11:27:01'),
(17, 'Engineering (Soft Cost)', '1', '2023-04-18 07:26:05'),
(18, 'New services', '1', '2023-05-04 05:42:17'),
(190, 'Deepu', '1', '2023-05-05 09:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `set_credit`
--

CREATE TABLE `set_credit` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `credit` int NOT NULL COMMENT 'credit for Lead Project for Contractor',
  `mp_credit` int NOT NULL COMMENT 'lead credit for material-providers',
  `min_credit` int NOT NULL COMMENT 'min credit for notification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `set_credit`
--

INSERT INTO `set_credit` (`id`, `user_id`, `credit`, `mp_credit`, `min_credit`) VALUES
(1, 1, 100, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `amount`, `transaction_id`, `created_date`) VALUES
(1, 13, '66', 'ch_3N2u7fLfcNO5LN3f17LLihwO', '2023-05-01 10:38:24'),
(2, 13, '60', 'ch_3N2vb7LfcNO5LN3f3sYWDtPW', '2023-05-01 12:12:54'),
(3, 13, '50', 'ch_3N2vhSLfcNO5LN3f14lg4fIo', '2023-05-01 12:19:27'),
(4, 13, '50', 'ch_3N2wGNLfcNO5LN3f3Ma51tmf', '2023-05-01 12:55:33'),
(5, 13, '51', 'ch_3N3F05LfcNO5LN3f27C6jGO9', '2023-05-02 08:55:58'),
(6, 13, '120', 'ch_3N3fS1LfcNO5LN3f0i9vMO5k', '2023-05-03 13:10:35'),
(7, 13, '100', 'ch_3N3fSeLfcNO5LN3f1WKcZajZ', '2023-05-03 13:11:13'),
(8, 13, '100', 'ch_3N3uU6LfcNO5LN3f0hid0Gp9', '2023-05-04 05:13:43'),
(16, 35, '100', 'ch_3N5SkbLfcNO5LN3f2aTPTQJ1', '2023-05-08 12:01:10'),
(17, 36, '120', 'ch_3N66dpLfcNO5LN3f21jNERat', '2023-05-10 06:36:51'),
(18, 36, '100', 'ch_3N66euLfcNO5LN3f15uG67DL', '2023-05-10 06:37:57'),
(19, 36, '100', 'ch_3N66hBLfcNO5LN3f1qNX2ApR', '2023-05-10 06:40:18'),
(20, 35, '100', 'ch_3N67mQLfcNO5LN3f2XmFORcv', '2023-05-10 07:49:46'),
(21, 35, '150', 'ch_3N67o4LfcNO5LN3f0qCzNORZ', '2023-05-10 07:51:29'),
(22, 36, '150', 'ch_3N6AcbLfcNO5LN3f1Rjsc1rm', '2023-05-10 10:51:50'),
(23, 36, '120', 'ch_3N6At9LfcNO5LN3f0NgYOROP', '2023-05-10 11:08:55'),
(24, 36, '130', 'ch_3N6B24LfcNO5LN3f0auQGyMs', '2023-05-10 11:18:09'),
(25, 37, '100', 'ch_3N6YxxLfcNO5LN3f3rOdF29p', '2023-05-11 12:51:30'),
(26, 13, '80', 'ch_3N6uIgLfcNO5LN3f33UrVtPF', '2023-05-12 11:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `own_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0 is disable,1 is enable',
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0 is inactive ,1 is active',
  `delete_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0 is delete,1 is recover',
  `user_type` enum('0','1','2','3','4') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0 is admin , 1 is owner,2gc,3sc,4 mp',
  `token` varchar(255) DEFAULT NULL,
  `approve_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0 is unapporove,1 is approve',
  `complete_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `own_status`, `status`, `delete_status`, `user_type`, `token`, `approve_status`, `complete_status`, `created_at`, `modified_at`) VALUES
(1, 'yadavblu381@gmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '0', NULL, '1', '1', '2023-04-20 04:03:24', '2023-04-20 09:37:03'),
(2, 'deepu999@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-15 04:11:09', '2023-05-10 11:22:50'),
(3, 'mohan@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:11:36', '2023-04-20 10:35:52'),
(4, 'nandu@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:12:09', '2023-04-20 10:35:52'),
(5, 'rani@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:12:34', '2023-04-20 10:35:52'),
(6, 'mahesh@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:13:14', '2023-04-20 10:35:52'),
(7, 'karan@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:13:35', '2023-04-21 12:37:20'),
(8, 'vikash@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:14:13', '2023-05-12 05:53:30'),
(9, 'abhishek@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:14:37', '2023-04-20 10:35:52'),
(10, 'sumit@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:15:02', '2023-04-20 10:35:52'),
(11, 'sneha@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '1', NULL, '1', '1', '2023-04-20 04:15:23', '2023-04-25 04:50:10'),
(12, 'shalini@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:15:43', '2023-04-26 12:28:32'),
(13, 'rahul@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:16:06', '2023-05-12 11:03:08'),
(14, 'niraj@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:16:30', '2023-04-20 10:35:52'),
(15, 'anukul@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:16:57', '2023-04-20 10:35:52'),
(16, 'manish@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:17:19', '2023-04-20 10:35:52'),
(17, 'msoni@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:18:12', '2023-04-20 10:35:52'),
(18, 'ak@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:18:50', '2023-04-20 10:35:52'),
(19, 'ram@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:19:31', '2023-04-26 11:16:31'),
(20, 'nupur@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:20:07', '2023-04-26 11:16:35'),
(21, 'ajay@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '2', NULL, '1', '1', '2023-04-20 04:20:48', '2023-04-26 11:16:38'),
(22, 'vipin@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:22:50', '2023-04-26 11:17:32'),
(23, 'preet@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:23:29', '2023-04-20 10:35:52'),
(24, 'sonali@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-13 04:23:57', '2023-04-26 11:17:49'),
(25, 'pakaj@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-12 04:24:21', '2023-05-08 17:52:55'),
(26, 'sonu@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:24:53', '2023-04-20 10:35:52'),
(27, 'rdrk@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:25:28', '2023-04-20 10:38:55'),
(28, 'rohit@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:26:28', '2023-04-20 10:35:52'),
(29, 'kajal@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:26:55', '2023-04-20 10:35:52'),
(30, 'kunal@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:29:19', '2023-04-20 10:35:52'),
(31, 'priya@yopmail.com', '$2y$10$i8gTV8L/Zxuz7DEhsogLXOv/WrmfQ9eaOE4LI2gX9Qv5CG7MvHpT6', '1', '1', '1', '3', NULL, '1', '1', '2023-04-20 04:29:39', '2023-05-08 17:55:00'),
(32, 'akash@yopmail.com', '$2y$10$yCJT.YdOuj6sgRuSgHNUeeXIup/BrsznCrmFWrKPsYll7SQ1xu59m', '1', '1', '1', '1', NULL, '1', '0', '2023-05-01 12:50:15', '2023-05-01 12:52:41'),
(33, 'test@yopmail.com', '$2y$10$yCJT.YdOuj6sgRuSgHNUeeXIup/BrsznCrmFWrKPsYll7SQ1xu59m', '1', '0', '1', '2', NULL, '1', '0', '2023-05-03 06:28:31', '2023-05-10 12:34:46'),
(34, 'rohan@yopmail.com', '$2y$10$MCZJlSh8Vz5ZnRzVBdxzpu26qCH0WwNFWJ/EgJO6KnENm/lm8zpfu', '1', '1', '1', '3', NULL, '0', '0', '2023-05-03 07:15:14', '2023-05-03 11:42:54'),
(35, 'ritik@yopmail.com', '$2y$10$L87rCAREtfCkHibBwIriOer1vyFd6yZeLa.ZhZZG4.x9Er2IA3V7y', '1', '1', '1', '4', NULL, '1', '1', '2023-05-03 11:41:19', '2023-05-11 10:59:33'),
(36, 'subham@yopmail.com', '$2y$10$oYDKH6piYXef.DUj.vJwBuMXMI8vhgkwqBKuseDIHJ14qWJ0.7hW2', '1', '1', '1', '4', NULL, '1', '1', '2023-05-09 07:18:05', '2023-05-10 13:14:36'),
(37, 'ayansh@yopmail.com', '$2y$10$ZOCyOOFzheQLK40khhLgQOJ9zpme0M7qchpWkUQHbp/hiBVVUjmKG', '1', '1', '1', '4', NULL, '1', '1', '2023-05-11 11:13:28', '2023-05-12 05:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`id`, `user_id`, `product_id`, `created_date`) VALUES
(3, 37, 5, '2023-05-11 11:23:00'),
(4, 37, 8, '2023-05-11 11:23:00'),
(5, 37, 11, '2023-05-11 11:23:00'),
(6, 37, 13, '2023-05-11 11:23:00'),
(7, 37, 5, '2023-05-11 11:23:00'),
(8, 37, 8, '2023-05-11 11:23:00'),
(9, 37, 11, '2023-05-11 11:23:00'),
(10, 37, 13, '2023-05-11 11:23:00'),
(11, 36, 2, '2023-05-12 05:54:25'),
(12, 36, 52, '2023-05-12 05:54:25'),
(13, 35, 18, '2023-05-12 06:09:29'),
(14, 35, 56, '2023-05-12 06:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address1` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address2` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pincode` int DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address1`, `address2`, `state`, `city`, `pincode`, `company_name`) VALUES
(1, 1, 'Bablu', 'Chaudhary', '8581969983', 'Uchkagaoon', 'Bargachhiya', 'BIhar', 'Line Bazar', 841438, NULL),
(2, 2, 'Deepu', 'kumar', '8844775511', 'Abhaypur', 'Abhaypur', 'Punjab', 'mani majra', 987450, NULL),
(3, 3, 'Mohan', 'Singh', '8745123654', 'Line Bazar', NULL, 'Bihar', 'Mirganj', 841438, NULL),
(4, 4, 'Nandu', 'Rai', '7412589635', 'Kushinagar', NULL, 'Uttar Pradesh', 'Gorakhpur', 123456, NULL),
(5, 5, 'Rani', 'Raj', '7894563214', 'Bhore', NULL, 'Bihar', 'Mairwa', 254136, NULL),
(6, 6, 'Mahesh', 'Singh', '9876541235', 'Siwan', NULL, 'Bihar', 'Siwan', 841428, NULL),
(7, 7, 'Karan', 'Singh', '8745632145', 'Patna', '', 'BIhar', 'JP Chauk', 784512, NULL),
(8, 8, 'Vikash', 'Bhakar', '8745214520', 'BHuwni', '', 'Haryana', 'Bhiwni', 541236, NULL),
(9, 9, 'Abhishek', 'Rawat', '8745216985', 'Hathua', NULL, 'BIhar', 'Mirganj', 841438, NULL),
(10, 10, 'Sumit', 'Soni', '9874561235', 'Siswan', NULL, 'Bihar', 'Siwan', 841428, NULL),
(11, 11, 'Sneha', 'Tiwari', '7788541253', 'Kusami', '', 'Uttar Pradesh', 'Kushinagar', 134560, NULL),
(12, 12, 'shalini', 'Rana', '8745123698', 'Palampur', '', 'Himanchal Pradesh', 'Shimla', 789456, 'SRCL'),
(13, 13, 'Rahul', 'Trivedi', '8745123654', 'Lucknow', '', 'Uttar pradesh', 'Lucknow', 123458, 'RTC'),
(14, 14, 'Niraj', 'Yadav', '7418529635', 'Mirazpur', '', 'Uttar pradesh', 'Ayodhya', 123456, 'NYCL'),
(15, 15, 'Anukul', 'Antwal', '9874563214', 'Yamuna nagar', '', 'Haryana', 'HR', 214563, 'AACL'),
(16, 16, 'Manish', 'Singh', '8745632154', 'Mirzapur', NULL, 'Uttar pradesh', 'Mirzapur', 789456, 'MSCL'),
(17, 17, 'Manisha', 'Soni', '9123456789', 'Banaras', '', 'Uttar pradesh', 'Ayodhya', 987456, 'ASC'),
(18, 18, 'Ankush', 'Kuma', '8765412358', 'Salon', '', 'Himanchal Pradesh', 'Baddi', 125478, 'AKCL'),
(19, 19, 'Ram', 'Singh', '9123456789', 'Panchkula', '', 'Haryana', 'Panchkula', 741852, 'RKCL'),
(20, 20, 'Nupur', 'Shara', '8521478965', 'ZIrakpur', '', 'Punjab', 'Peer Machhula', 852147, 'NSC'),
(21, 21, 'Ajay', 'Saini', '7894561230', 'Kanpur', '', 'Uttar pradesh', 'Jhansi', 963258, 'ASCL'),
(22, 22, 'Vpiin', 'yadav', '9765412385', 'Bhopal', '', 'Madhya pradesh', 'MP Nagar', 789456, 'VYCL'),
(23, 23, 'Raju', 'Preet', '8855447744', 'Raisen', NULL, 'Madhya pradesh', 'Bhopal', 462016, 'RPC'),
(24, 24, 'Sonali', 'Rajput', '6205188244', 'Jhansi', '', 'Uttar pradesh', 'Kanpur', 462017, 'SRCL\n'),
(25, 25, 'Pankaj', 'Thakur', '9132040332', 'Kurushetra', '', '', 'Ambala', 500782, ''),
(26, 26, 'Sonu', 'Verma', '9168351245', 'Ropan', '', 'Punjab', 'Zirakpur', 400543, 'SVC'),
(27, 27, 'Rohit', 'Singh', '9135523279', 'Amritsar', '', 'Punjab', 'Bhatinda', 745896, 'RSC'),
(28, 28, 'Rohit', 'Godila', '9199969895', 'Patiyala', '', 'Punjab', 'Punjab', 874512, 'RGC'),
(29, 29, 'Kajal', 'Tyagi', '8471256987', 'Sharanpur', '', 'Uttar pradesh', 'Kanpur', 995522, 'KTC'),
(30, 30, 'Kunal', 'singh', '6504125987', 'Baddi', '', 'Himanchal Pradesh', 'Salon', 120320, 'KSC'),
(31, 31, 'Priya', 'Sharma', '7894561237', 'Mohali', '', 'Punjab', 'Mohali', 145236, 'PSC'),
(32, 32, 'Akash', 'Khare', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 33, 'Test', 'User', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 34, 'Rohan', 'Kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 35, 'Ritik', 'Singh', '9874563215', 'Siwan', '', 'Bihar', 'Siwan', 841428, 'RMP7'),
(36, 36, 'Subham', 'Singh', '9876543214', 'Yamuna Nagar', '', 'Haryana', 'Yamuna Nagar', 789654, 'SS Material'),
(37, 37, 'Ayansh', 'Pal', '7854698745', 'Kasauli', '', 'HImachal Pradesh', 'Shimla', 841256, 'AMS');

-- --------------------------------------------------------

--
-- Table structure for table `user_services`
--

CREATE TABLE `user_services` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_services`
--

INSERT INTO `user_services` (`id`, `user_id`, `service_id`, `created_date`) VALUES
(1, 21, 1, '2023-04-20 05:15:05'),
(2, 21, 2, '2023-04-20 05:15:05'),
(3, 21, 3, '2023-04-20 05:15:05'),
(4, 21, 5, '2023-04-20 05:15:05'),
(5, 21, 6, '2023-04-20 05:15:05'),
(6, 21, 8, '2023-04-20 05:15:05'),
(7, 21, 9, '2023-04-20 05:15:05'),
(8, 21, 10, '2023-04-20 05:15:05'),
(9, 21, 11, '2023-04-20 05:15:05'),
(10, 21, 12, '2023-04-20 05:15:05'),
(11, 21, 13, '2023-04-20 05:15:05'),
(12, 21, 14, '2023-04-20 05:15:05'),
(13, 21, 16, '2023-04-20 05:15:05'),
(14, 21, 17, '2023-04-20 05:15:05'),
(15, 20, 1, '2023-04-20 05:15:25'),
(16, 20, 2, '2023-04-20 05:15:25'),
(17, 20, 3, '2023-04-20 05:15:25'),
(18, 20, 4, '2023-04-20 05:15:25'),
(19, 20, 5, '2023-04-20 05:15:25'),
(20, 20, 6, '2023-04-20 05:15:25'),
(21, 20, 7, '2023-04-20 05:15:25'),
(22, 20, 8, '2023-04-20 05:15:25'),
(23, 20, 9, '2023-04-20 05:15:25'),
(24, 20, 10, '2023-04-20 05:15:25'),
(25, 20, 11, '2023-04-20 05:15:25'),
(26, 20, 12, '2023-04-20 05:15:25'),
(27, 20, 13, '2023-04-20 05:15:25'),
(28, 20, 14, '2023-04-20 05:15:25'),
(29, 20, 15, '2023-04-20 05:15:25'),
(30, 20, 16, '2023-04-20 05:15:25'),
(31, 20, 17, '2023-04-20 05:15:25'),
(32, 19, 1, '2023-04-20 05:15:39'),
(33, 19, 4, '2023-04-20 05:15:39'),
(34, 19, 5, '2023-04-20 05:15:39'),
(35, 19, 6, '2023-04-20 05:15:39'),
(36, 19, 7, '2023-04-20 05:15:39'),
(37, 19, 8, '2023-04-20 05:15:39'),
(38, 19, 10, '2023-04-20 05:15:39'),
(39, 19, 13, '2023-04-20 05:15:39'),
(40, 19, 16, '2023-04-20 05:15:39'),
(46, 12, 1, '2023-04-20 05:16:11'),
(47, 12, 3, '2023-04-20 05:16:11'),
(48, 12, 9, '2023-04-20 05:16:11'),
(49, 12, 11, '2023-04-20 05:16:11'),
(50, 12, 12, '2023-04-20 05:16:11'),
(51, 12, 14, '2023-04-20 05:16:11'),
(52, 12, 15, '2023-04-20 05:16:11'),
(53, 12, 16, '2023-04-20 05:16:11'),
(54, 12, 17, '2023-04-20 05:16:11'),
(62, 15, 1, '2023-04-20 05:16:33'),
(63, 15, 2, '2023-04-20 05:16:33'),
(64, 15, 9, '2023-04-20 05:16:33'),
(65, 15, 11, '2023-04-20 05:16:33'),
(66, 15, 14, '2023-04-20 05:16:33'),
(70, 17, 4, '2023-04-20 05:16:44'),
(71, 17, 6, '2023-04-20 05:16:44'),
(72, 17, 9, '2023-04-20 05:16:44'),
(73, 18, 9, '2023-04-20 05:16:48'),
(74, 18, 11, '2023-04-20 05:16:48'),
(75, 18, 14, '2023-04-20 05:16:48'),
(76, 18, 16, '2023-04-20 05:16:48'),
(77, 18, 17, '2023-04-20 05:16:48'),
(78, 14, 1, '2023-04-20 05:17:51'),
(79, 31, 3, '2023-04-20 05:18:37'),
(80, 31, 6, '2023-04-20 05:18:37'),
(81, 31, 9, '2023-04-20 05:18:37'),
(82, 31, 11, '2023-04-20 05:18:37'),
(83, 31, 17, '2023-04-20 05:18:37'),
(84, 30, 3, '2023-04-20 05:18:44'),
(85, 30, 9, '2023-04-20 05:18:44'),
(86, 30, 11, '2023-04-20 05:18:44'),
(87, 29, 3, '2023-04-20 05:18:50'),
(88, 29, 6, '2023-04-20 05:18:50'),
(89, 29, 9, '2023-04-20 05:18:50'),
(90, 29, 12, '2023-04-20 05:18:50'),
(91, 29, 15, '2023-04-20 05:18:50'),
(92, 28, 6, '2023-04-20 05:18:55'),
(93, 28, 7, '2023-04-20 05:18:55'),
(97, 26, 2, '2023-04-20 05:19:08'),
(98, 26, 17, '2023-04-20 05:19:08'),
(99, 22, 16, '2023-04-20 05:19:13'),
(100, 22, 17, '2023-04-20 05:19:13'),
(106, 25, 3, '2023-04-20 05:19:23'),
(107, 25, 6, '2023-04-20 05:19:23'),
(108, 25, 9, '2023-04-20 05:19:23'),
(109, 25, 11, '2023-04-20 05:19:23'),
(110, 25, 14, '2023-04-20 05:19:23'),
(111, 27, 2, '2023-04-20 05:19:28'),
(112, 27, 3, '2023-04-20 05:19:28'),
(113, 27, 6, '2023-04-20 05:19:28'),
(114, 27, 12, '2023-04-20 05:19:28'),
(209, 24, 2, '2023-05-08 09:35:05'),
(308, 35, 1, '2023-05-09 12:53:06'),
(309, 35, 2, '2023-05-09 12:53:06'),
(310, 35, 3, '2023-05-09 12:53:06'),
(311, 35, 4, '2023-05-09 12:53:06'),
(312, 35, 12, '2023-05-09 12:53:06'),
(315, 13, 1, '2023-05-10 11:05:39'),
(316, 13, 2, '2023-05-10 11:05:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_users`
--
ALTER TABLE `assigned_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractor_credit`
--
ALTER TABLE `contractor_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_services`
--
ALTER TABLE `owner_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_credit`
--
ALTER TABLE `set_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_services`
--
ALTER TABLE `user_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_users`
--
ALTER TABLE `assigned_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contractor_credit`
--
ALTER TABLE `contractor_credit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `owner_services`
--
ALTER TABLE `owner_services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `set_credit`
--
ALTER TABLE `set_credit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_services`
--
ALTER TABLE `user_services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
