-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 08:20 AM
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
-- Database: `w360`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads_and_banners`
--

CREATE TABLE `ads_and_banners` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads_and_banners`
--

INSERT INTO `ads_and_banners` (`ad_id`, `title`, `image`, `description`, `status`, `start_date`, `end_date`) VALUES
(1, 'ad1', NULL, 'ad1', 1, '2025-04-01', '2025-04-30'),
(2, 'add2', NULL, 'ad2', 1, '2025-04-14', '2025-04-26'),
(3, 'ad3', NULL, 'ad3', 1, '2025-04-26', '2025-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `bag_size`
--

CREATE TABLE `bag_size` (
  `bag_id` int(11) NOT NULL,
  `bag_size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bag_size`
--

INSERT INTO `bag_size` (`bag_id`, `bag_size`) VALUES
(1, 'small'),
(2, 'medium'),
(3, 'large');

-- --------------------------------------------------------

--
-- Table structure for table `carbon_footprint`
--

CREATE TABLE `carbon_footprint` (
  `id` int(11) NOT NULL,
  `giveaway_amount` decimal(10,2) DEFAULT 0.00,
  `purchased_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `code_id` int(11) NOT NULL,
  `cname` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','accepted','','') NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`code_id`, `cname`, `phone`, `date`, `status`, `description`) VALUES
(3, 'nethmi', 768512877, '2025-04-28 02:51:03', 'accepted', ''),
(9, '', 112233445, '2025-04-27 10:50:35', 'pending', ''),
(10, 'nimasha', 112233445, '2025-04-28 03:39:07', 'accepted', 'yrf'),
(11, 'sanduni', 768512877, '2025-04-28 03:08:58', 'accepted', 'fhbjn'),
(12, 'sanduni', 768512877, '2025-04-28 02:24:24', 'accepted', ''),
(13, 'dev', 116677889, '2025-04-28 02:47:34', 'accepted', ''),
(14, 'llll', 112233445, '2025-04-28 02:57:58', 'accepted', ''),
(15, 'gggg', 116677889, '2025-04-28 02:24:20', 'accepted', ''),
(16, 'nethmi', 768512877, '2025-04-27 17:06:34', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `completedgiveaway`
--

CREATE TABLE `completedgiveaway` (
  `completed_id` int(11) NOT NULL,
  `giveaway_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `completion_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('accepted','rejected','collected') NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `decision_reason` text DEFAULT NULL,
  `message_to_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completedgiveaway`
--

INSERT INTO `completedgiveaway` (`completed_id`, `giveaway_id`, `customer_id`, `completion_date`, `status`, `amount`, `decision_reason`, `message_to_customer`) VALUES
(21, 10, 10, '2025-04-26 05:25:40', 'collected', 0, 'yes', 'go to near collection point'),
(22, 5, 5, '2025-04-26 05:28:45', 'collected', 10, 'noo', 'gghl;llkjhg'),
(23, 13, 5, '2025-04-26 15:05:58', 'collected', 50, 'accepted', 'go to collection point'),
(24, 19, 5, '2025-04-26 15:08:11', 'rejected', 0, 'cannot accept', ''),
(25, 11, 11, '2025-04-26 17:01:48', 'collected', 50, 'dfghj', 'bhdgvb'),
(26, 15, 11, '2025-04-27 03:50:32', 'accepted', 0, 'tgyhjk,l', 'cfghbjnkml'),
(27, 12, 13, '2025-04-27 03:51:00', 'accepted', 0, 'dfgbhnjmk', 'gbhjnkm'),
(28, 14, 13, '2025-04-27 06:15:06', 'accepted', 0, 'm,fghj', 'fghjk');

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `completed_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` enum('accepted','rejected','processing','shipped','delivered') NOT NULL,
  `message_to_customer` text DEFAULT NULL,
  `date_completed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`completed_id`, `order_id`, `status`, `message_to_customer`, `date_completed`) VALUES
(1, 11, 'delivered', 'bbrjcnrk', '2025-04-25 14:18:33'),
(8, 17, 'delivered', 'ghjk', '2025-04-27 06:16:46'),
(9, 16, 'accepted', 'hii', '2025-04-23 08:05:39'),
(10, 20, 'accepted', 'correct', '2025-04-25 13:28:41'),
(11, 23, 'accepted', 'hkml,\r\n', '2025-04-25 14:17:54'),
(12, 12, 'processing', 'ghjk', '2025-04-27 06:16:22'),
(13, 29, 'processing', 'sjkl;gj', '2025-04-26 10:45:56'),
(14, 15, 'accepted', 'sdfghjk', '2025-04-26 14:54:02'),
(15, 21, 'accepted', 'dfghbjk', '2025-04-26 14:54:11'),
(16, 18, 'accepted', 'dfghj', '2025-04-26 15:59:09'),
(17, 26, 'rejected', 'fghj', '2025-04-26 15:59:53'),
(18, 24, 'accepted', 'ghjnkm', '2025-04-27 06:16:06'),
(19, 31, 'accepted', 'goooo', '2025-04-28 06:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `completed_returns`
--

CREATE TABLE `completed_returns` (
  `completed_id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` enum('accepted','rejected','returned') DEFAULT NULL,
  `decision_reason` text DEFAULT NULL,
  `date_completed` timestamp NOT NULL DEFAULT current_timestamp(),
  `message_to_customer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_returns`
--

INSERT INTO `completed_returns` (`completed_id`, `return_id`, `order_id`, `product_id`, `customer_id`, `status`, `decision_reason`, `date_completed`, `message_to_customer`) VALUES
(14, 7, 11, 6, 5, 'accepted', 'fghjkl', '2025-04-26 11:59:12', ''),
(15, 15, 33, 4, 10, 'accepted', '', '2025-04-26 12:14:01', ''),
(16, 11, 15, 6, 14, 'accepted', '', '2025-04-26 15:35:40', ''),
(17, 8, 12, 5, 10, 'accepted', '', '2025-04-26 15:44:34', ''),
(18, 16, 31, 5, 13, 'accepted', '', '2025-04-26 15:44:50', ''),
(19, 9, 13, 6, 11, 'accepted', '', '2025-04-26 15:45:02', ''),
(20, 10, 14, 7, 13, 'accepted', 'goooooo', '2025-04-28 06:09:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `address`, `phone`, `image`, `name`, `status`) VALUES
(5, 2, '654 Orange Blvd', '0116677889', 'aboutUs.png', 'Diani Abeywardena', 1),
(10, 3, '123 Main St', '0712345678', NULL, 'Chamudi Upeka', 1),
(11, 7, '456 Elm St', '0712345678', NULL, 'Lakindu Vithanage', 1),
(13, 5, '101 Pine St', '0712345678', NULL, 'Thihansa Sanjunie', 1),
(14, 6, '202 Maple St', '0712345678', NULL, 'Sanu Munasinghe', 1),
(15, 4, '123.Reid avenue, Colombo 7', NULL, NULL, 'nimasha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_has_carbon_footprint`
--

CREATE TABLE `customer_has_carbon_footprint` (
  `customer_id` int(11) DEFAULT NULL,
  `carbon_footprint_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_order`
--

CREATE TABLE `custom_order` (
  `customOrder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `Specifications` text DEFAULT NULL,
  `customOrder_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_order`
--

INSERT INTO `custom_order` (`customOrder_id`, `customer_id`, `company_name`, `quantity`, `email`, `phone`, `type`, `Specifications`, `customOrder_status`) VALUES
(1, 5, 'clogard', 1, 'clogard@gmail.com', '0332235444', NULL, NULL, 'completed'),
(2, 5, 'safeguard', 5, 'safeguard@gmail.com', '0332235000', NULL, 'logo printed bags', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `product_id`, `discount_percentage`, `start_date`, `end_date`, `status`) VALUES
(2, 5, 0.50, '2025-04-01', '2025-04-30', 1),
(3, 10, 0.50, '2025-04-01', '2025-04-23', 1),
(4, 12, 0.50, '2025-04-02', '2025-04-23', 1),
(5, 16, 9.00, '2025-04-15', '2025-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `giveawayrequests`
--

CREATE TABLE `giveawayrequests` (
  `giveaway_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `giveawayStatus` enum('pending','accepted','rejected') DEFAULT 'pending',
  `details` text DEFAULT NULL,
  `decision_date` timestamp NULL DEFAULT NULL,
  `decision_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giveawayrequests`
--

INSERT INTO `giveawayrequests` (`giveaway_id`, `customer_id`, `request_date`, `giveawayStatus`, `details`, `decision_date`, `decision_reason`) VALUES
(5, 5, '2025-04-09 07:18:23', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'noo'),
(10, 10, '2025-04-14 02:12:49', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'yes'),
(11, 11, '2025-04-14 02:12:49', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'dfghj'),
(12, 13, '2025-04-14 02:12:49', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'dfgbhnjmk'),
(13, 5, '2025-04-14 02:12:49', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'accepted'),
(14, 13, '2025-04-14 02:12:49', 'accepted', 'Giveaway items for environmental awareness campaign.', NULL, 'm,fghj'),
(15, 11, '2025-04-23 13:23:21', 'accepted', 'asdf', '2025-04-24 13:22:51', 'tgyhjk,l'),
(16, 13, '2025-04-25 06:12:18', 'pending', '50 kg roughly', NULL, ''),
(17, 14, '2025-04-25 06:15:51', 'pending', '100kg', NULL, ''),
(18, 13, '2025-04-25 08:18:54', 'pending', NULL, NULL, ''),
(19, 5, '2025-04-25 08:56:29', 'rejected', NULL, NULL, 'cannot accept'),
(20, 14, '2025-04-25 09:36:09', 'pending', NULL, NULL, ''),
(21, 14, '2025-04-27 05:18:54', 'pending', 'fgbhnjkm,', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `guest_collection`
--

CREATE TABLE `guest_collection` (
  `collection_id` int(11) NOT NULL,
  `guest_name` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest_collection`
--

INSERT INTO `guest_collection` (`collection_id`, `guest_name`, `phone`, `amount`, `date`) VALUES
(8, 'chamudi', 112233445, 50, '2025-04-24 18:30:00'),
(9, 'lakindu', 728483265, 100, '2025-04-24 18:30:00'),
(10, 'sajani', 116677889, 200, '2025-04-24 18:30:00'),
(11, 'sajani', 768512877, 100, '2025-04-26 18:30:00'),
(12, 'chamudi', 116677889, 100, '2025-04-26 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issue_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `action_taken` varchar(255) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue_id`, `description`, `email`, `phone`, `status`, `action_taken`) VALUES
(1, 'error1', '', '', 1, '123456'),
(2, 'error2', 'wwwef', 'dcdva', NULL, NULL),
(4, 'error1', 'adsc', 'cfedf', 1, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `bag_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `orderStatus` enum('pending','accepted','rejected','shipped','delivered') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `pack_id`, `bag_id`, `quantity`, `total`, `deliveryAddress`, `billingAddress`, `orderDate`, `orderStatus`) VALUES
(11, 4, 5, 1, 1, 2, 1600.00, '666 Silver St', '666 Silver St', '2025-03-10 00:00:00', 'accepted'),
(12, 5, 10, 1, 1, 1, 1000.00, '123 Main St', '123 Main St', '2025-04-14 00:00:00', 'accepted'),
(13, 6, 11, 2, 2, 1, 1200.00, '456 Elm St', '456 Elm St', '2025-04-14 00:00:00', 'pending'),
(14, 7, 13, 2, 2, 1, 1400.00, '789 Oak St', '789 Oak St', '2025-04-14 00:00:00', 'pending'),
(15, 8, 14, 1, 3, 1, 1600.00, '101 Pine St', '101 Pine St', '2025-04-14 00:00:00', 'accepted'),
(16, 7, 5, 1, 1, 50, 1700.00, NULL, NULL, '2025-04-22 00:00:00', 'accepted'),
(17, 6, 10, 2, 2, 45, 1600.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(18, 6, 11, 1, 2, 50, 1600.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(19, 4, 13, 2, 3, 100, 650.00, NULL, NULL, '2025-04-23 00:00:00', 'pending'),
(20, 7, 5, 1, 3, 200, 3000.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(21, 8, 11, 1, 3, 50, 1600.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(22, 6, 14, 2, 3, 50, 650.00, NULL, NULL, '2025-04-23 00:00:00', 'pending'),
(23, 6, 5, 1, 3, 50, 650.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(24, 6, 13, 1, 3, 50, 1700.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(25, 5, 11, 2, 3, 2, 750.00, NULL, NULL, '2025-04-24 00:00:00', 'pending'),
(26, 5, 11, 1, 2, 2, 750.00, NULL, NULL, '2025-04-24 00:00:00', 'rejected'),
(29, 5, 11, 2, 1, 2, 750.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(30, 4, 10, 1, 3, 50, 750.00, 'dsfv', 'asdg', '2025-04-24 00:00:00', 'delivered'),
(31, 6, 13, 1, 3, 50, 650.00, NULL, NULL, '2025-04-23 00:00:00', 'accepted'),
(32, 6, 11, 2, 3, 100, 1900.00, NULL, NULL, '2025-04-23 00:00:00', 'pending'),
(33, 5, 10, 1, 3, 50, 750.00, NULL, NULL, '2025-04-24 23:59:49', 'pending'),
(34, 4, 13, 2, 3, 50, 1900.00, NULL, NULL, '2025-04-26 20:21:14', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pack_size`
--

CREATE TABLE `pack_size` (
  `pack_id` int(11) NOT NULL,
  `pack_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pack_size`
--

INSERT INTO `pack_size` (`pack_id`, `pack_size`) VALUES
(1, 50),
(2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pellet`
--

CREATE TABLE `pellet` (
  `pelletOrder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `dateRequired` date DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pelletOrderStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polytheneamount`
--

CREATE TABLE `polytheneamount` (
  `polythene_id` int(11) NOT NULL,
  `polythene_amount` decimal(10,0) NOT NULL,
  `message` varchar(100) NOT NULL,
  `month` varchar(20) NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polytheneamount`
--

INSERT INTO `polytheneamount` (`polythene_id`, `polythene_amount`, `message`, `month`, `updated_date`) VALUES
(1, 1, 'sd', 'January', '2025-04-22'),
(2, 2, 'done', 'February', '2025-04-22'),
(3, 45, 'updated amount', 'May', '2025-04-22'),
(4, 2, 'updated', 'April', '2025-04-22'),
(5, 1, 'rer', 'March', '2025-04-22'),
(6, 1, 'srr', 'July', '2025-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `polythenecollection`
--

CREATE TABLE `polythenecollection` (
  `collection_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `collection_time` time DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `productType` varchar(20) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productDescription` text DEFAULT NULL,
  `productStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productType`, `productName`, `productImage`, `productDescription`, `productStatus`) VALUES
(4, '', 'Oxo-Degradable Garbage Bag', 'oxo_bag.jpg', 'Eco-conscious garbage bags made with oxo-degradable material that breaks down over time.', 0),
(5, '', 'Bio-Degradable Garbage Bag', 'bio_bag.jpg', 'Compostable garbage bags made from natural materials, safe for the environment.', 0),
(6, '', 'Hydrogen Garbage Bag', 'hydrogen_bag.jpg', 'Innovative hydrogen-based garbage bags designed for enhanced odor control and decomposition.', 1),
(7, '', 'p1', NULL, 'this is dummy data', 1),
(8, '', 'p2', 'none.png', 'dummy2', 1),
(9, '', 'p3', 'nonee.png', 'dummy3', 1),
(10, '', 'p4', 'none.png', 'dummy4', 1),
(11, '', 'p5', NULL, NULL, 1),
(12, '', 'p6', NULL, NULL, 1),
(13, '', 'p6', NULL, NULL, 1),
(14, '', 'p7', NULL, NULL, 1),
(15, '', 'p8', NULL, NULL, 1),
(16, '', 'p9', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_has_bag_sizes`
--

CREATE TABLE `product_has_bag_sizes` (
  `product_id` int(11) NOT NULL,
  `bag_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `reply` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `review_id`, `reply`, `date`, `dateModified`) VALUES
(5, 20, 'thanksss', '2025-04-27 11:39:29', '2025-04-27 11:41:52'),
(6, 25, 'dfghjk', '2025-04-27 11:40:38', '2025-04-27 11:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `reportDescription` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_item`
--

CREATE TABLE `return_item` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `returnStatus` enum('pending','accepted','rejected','returned') DEFAULT NULL,
  `returnDetails` varchar(100) NOT NULL,
  `cus_requirements` enum('refund','replacement','','') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `decision_reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_item`
--

INSERT INTO `return_item` (`return_id`, `order_id`, `product_id`, `returnStatus`, `returnDetails`, `cus_requirements`, `date`, `decision_reason`) VALUES
(7, 11, 6, 'accepted', 'Color mismatch', 'refund', '2025-04-26 11:59:12', 'fghjkl'),
(8, 12, 5, 'accepted', 'Size mismatch', 'replacement', '2025-04-26 15:44:34', ''),
(9, 13, 6, 'accepted', 'Damaged item', 'refund', '2025-04-26 15:45:02', ''),
(10, 14, 7, 'accepted', 'Wrong item received', 'replacement', '2025-04-28 06:09:47', 'goooooo'),
(11, 15, 6, 'accepted', 'Quality issue', 'refund', '2025-04-26 15:43:24', ''),
(15, 33, 4, 'accepted', 'fghjkl', 'refund', '2025-04-26 12:14:01', ''),
(16, 31, 5, 'accepted', 'jesrtyuio', 'replacement', '2025-04-26 15:44:50', '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT NULL,
  `status` enum('pending','replied','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `customer_id`, `order_id`, `rating`, `comment`, `date`, `dateModified`, `status`) VALUES
(16, 5, 11, 2, 'Did not meet expectations.', '2025-03-05 08:30:00', '2025-04-26 12:53:15', 'replied'),
(17, 10, 12, 4, 'Good quality and eco-friendly.', '2025-04-14 02:12:49', '2025-04-26 13:19:57', 'replied'),
(18, 11, 13, 5, 'Excellent product!', '2025-04-14 02:12:49', '2025-04-26 13:21:45', 'replied'),
(19, 13, 14, 3, 'Average quality.', '2025-04-14 02:12:49', NULL, 'pending'),
(20, 5, 15, 1, 'Very disappointed with the product.', '2025-04-14 02:12:49', '2025-04-27 06:09:29', 'replied'),
(25, 11, 32, 5, 'Good quality and eco-friendly.', '2025-04-26 16:22:24', '2025-04-27 06:10:39', 'replied'),
(26, 13, 34, 5, 'Good quality and eco-friendly.', '2025-04-26 16:23:11', '2025-04-26 16:23:11', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'admin'),
(2, 'sales manager'),
(3, 'Production Manager'),
(4, 'Customer Service Manager'),
(5, 'Customer'),
(6, 'collection agent');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `address`, `phone`, `image`, `role_id`, `user_id`, `status`) VALUES
(1, 'Chamudi', '21e2e', '0711234567', NULL, 1, 1, 1),
(2, 'Chamudi', 'fchjyty', '0711234567', NULL, NULL, NULL, 1),
(3, 'b', 'jbbj', '0711234567', NULL, NULL, NULL, 1),
(4, 'upeka', 'upemks', '0711234567', NULL, 2, NULL, 1),
(6, 'nethmi', 'hi ', '0711234567', NULL, 4, 10, 1),
(7, 'Nimasha D.V.N', '123.Reid avenue, Colombo 7', '0112233445', 'uploads/profiles/pro', 4, 4, 1),
(8, 'nishaaa', '123.Temple rd,Galle', '0768512877', NULL, 6, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `role_id`) VALUES
(1, 'admin@gmail.com', '123456', 1),
(2, 'upeka@gmail.com', '$2y$10$/od0QD2OL0S3AeU0vrt/ougQvzTQ4M.QMk.NDcUyS5W4S8x0HNpp6', 5),
(3, 'lakindu@gmail.com', '5555555', 5),
(4, 'nimasha@gmail.com', '$2y$10$cDb.0YdAUe23PdHE7eTmLOk9BqzpqFltQIee1TyJcsYm75UYZt1fu', 4),
(5, 'thinza@gmail.com', '2222', 5),
(6, 'sanu@gmail.com', '3333', 5),
(7, 'yehan@gmail.com', '1111', 5),
(8, 'kumarage@gmail.com', '$2y$10$U3db0JA9bLi3v.GtaDEi1.R.F40xsQ5e5VJXW2qmwY/MNDuh9jPqu', 2),
(9, 'ravi@gmail.com', '$2y$10$V5c4L0fOCtCxfZN25t5XOeNpEafxxMACuPrfbQ0RruxgyeDrTq94e', 3),
(10, 'nethmii@gmail.com', '$2y$10$saS26lvj45ssLCEb72iyjOc9xNAZlM3bCph/j9e2HzoSCNG3NV/y6', 4),
(11, 'chamudi@gmail.com', '$2y$10$7ylG8WlGqYZTBAGUHCj1lemceytfJSJdtoAN4lAmJ5oGuXMoZBy4e', 3),
(12, 'nisha@gmail.com', '$2y$10$87MlTIdzP2E0pUNYuwX2dOQeSfolU0RLZk9jIJ/Fh84A2wZZ/yPee', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads_and_banners`
--
ALTER TABLE `ads_and_banners`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `bag_size`
--
ALTER TABLE `bag_size`
  ADD PRIMARY KEY (`bag_id`);

--
-- Indexes for table `carbon_footprint`
--
ALTER TABLE `carbon_footprint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  ADD PRIMARY KEY (`completed_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `giveaway_id` (`giveaway_id`);

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`completed_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `completed_returns`
--
ALTER TABLE `completed_returns`
  ADD PRIMARY KEY (`completed_id`),
  ADD UNIQUE KEY `return_id` (`return_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `User_id` (`user_id`);

--
-- Indexes for table `customer_has_carbon_footprint`
--
ALTER TABLE `customer_has_carbon_footprint`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `carbon_footprint_id` (`carbon_footprint_id`);

--
-- Indexes for table `custom_order`
--
ALTER TABLE `custom_order`
  ADD PRIMARY KEY (`customOrder_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `Product_id` (`product_id`);

--
-- Indexes for table `giveawayrequests`
--
ALTER TABLE `giveawayrequests`
  ADD PRIMARY KEY (`giveaway_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `guest_collection`
--
ALTER TABLE `guest_collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `pack_id` (`pack_id`),
  ADD KEY `bag_id` (`bag_id`);

--
-- Indexes for table `pack_size`
--
ALTER TABLE `pack_size`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `pellet`
--
ALTER TABLE `pellet`
  ADD PRIMARY KEY (`pelletOrder_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `polythenecollection`
--
ALTER TABLE `polythenecollection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_has_bag_sizes`
--
ALTER TABLE `product_has_bag_sizes`
  ADD PRIMARY KEY (`product_id`,`bag_id`),
  ADD KEY `bag_id` (`bag_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `Review_id` (`review_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `Customer_id` (`customer_id`),
  ADD KEY `Order_id` (`order_id`);

--
-- Indexes for table `return_item`
--
ALTER TABLE `return_item`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`reward_id`),
  ADD KEY `Customer_id` (`customer_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `Product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `Role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads_and_banners`
--
ALTER TABLE `ads_and_banners`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bag_size`
--
ALTER TABLE `bag_size`
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carbon_footprint`
--
ALTER TABLE `carbon_footprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `completed_returns`
--
ALTER TABLE `completed_returns`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `custom_order`
--
ALTER TABLE `custom_order`
  MODIFY `customOrder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `giveawayrequests`
--
ALTER TABLE `giveawayrequests`
  MODIFY `giveaway_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `guest_collection`
--
ALTER TABLE `guest_collection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pack_size`
--
ALTER TABLE `pack_size`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pellet`
--
ALTER TABLE `pellet`
  MODIFY `pelletOrder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polythenecollection`
--
ALTER TABLE `polythenecollection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_item`
--
ALTER TABLE `return_item`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  ADD CONSTRAINT `completedgiveaway_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD CONSTRAINT `completed_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `completed_returns`
--
ALTER TABLE `completed_returns`
  ADD CONSTRAINT `completed_returns_ibfk_1` FOREIGN KEY (`return_id`) REFERENCES `return_item` (`return_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `customer_has_carbon_footprint`
--
ALTER TABLE `customer_has_carbon_footprint`
  ADD CONSTRAINT `customer_has_carbon_footprint_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `customer_has_carbon_footprint_ibfk_2` FOREIGN KEY (`carbon_footprint_id`) REFERENCES `carbon_footprint` (`id`);

--
-- Constraints for table `custom_order`
--
ALTER TABLE `custom_order`
  ADD CONSTRAINT `custom_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
