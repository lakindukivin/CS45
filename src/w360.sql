-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 11:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
-- Table structure for table `completedgiveaway`
--

CREATE TABLE `completedgiveaway` (
  `completed_id` int(11) NOT NULL,
  `giveaway_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `completion_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('accepted','rejected') NOT NULL,
  `decision_reason` text DEFAULT NULL,
  `message_to_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completedgiveaway`
--

INSERT INTO `completedgiveaway` (`completed_id`, `giveaway_id`, `customer_id`, `completion_date`, `status`, `decision_reason`, `message_to_customer`) VALUES
(1, 6, 6, '2025-04-14 02:08:27', '', 'hiii', 'boo'),
(2, 5, 5, '2025-04-14 02:12:49', 'rejected', 'jiii', 'kkk'),
(3, 2, 2, '2025-04-16 06:24:28', 'rejected', 'nice', 'hii'),
(4, 8, 8, '2025-04-16 06:25:42', '', 'oho', 'noo'),
(5, 9, 9, '2025-04-16 06:28:29', 'accepted', 'come', 'now');

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
(1, 11, 'accepted', '', '2025-04-10 11:01:40'),
(2, 10, 'rejected', 'noo', '2025-04-10 11:07:52'),
(3, 9, 'rejected', 'yes no', '2025-04-10 15:29:34'),
(4, 8, 'shipped', 'hii', '2025-04-10 17:34:55'),
(5, 4, 'processing', 'hii', '2025-04-17 07:06:40');

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
(1, 2, 2, 4, 1, 'accepted', 'yess', '2025-04-09 07:40:34', 'nooo'),
(2, 3, 3, 5, 2, 'accepted', 'bye', '2025-04-10 09:55:35', 'gn'),
(3, 5, 5, 4, 4, 'accepted', 'baby', '2025-04-09 07:47:41', 'love u'),
(4, 8, 7, 4, 6, 'rejected', 'wow', '2025-04-09 07:57:44', 'ok'),
(5, 9, 8, 5, 7, 'rejected', 'yes', '2025-04-09 07:41:55', 'ohoo'),
(6, 7, 11, 6, 10, 'accepted', 'mom', '2025-04-10 16:25:08', 'yes'),
(7, 6, 6, 5, 5, 'accepted', 'byeeeeeee', '2025-04-10 16:57:46', 'ggoooo'),
(8, 4, 4, 6, 3, 'accepted', 'booo', '2025-04-12 10:01:45', 'heyy');

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

INSERT INTO `customer` (`customer_id`, `user_id`, `address`, `phone`, `name`, `image`, `status`) VALUES
(1, 2, '123 Green St', '0112233445', 'Alice Perera', NULL, 1),
(2, 3, '456 Blue Ln', '0113344556', 'Nimal Silva', NULL, 1),
(3, 2, '789 Red Rd', '0114455667', 'Kamal Fernando', NULL, 1),
(4, 3, '321 Yellow Ave', '0115566778', 'Sunil Rajapaksha', NULL, 1),
(5, 2, '654 Orange Blvd', '0116677889', 'Diana Abeywardena', NULL, 1),
(6, 3, '222 Purple Dr', '0117788990', 'Hasini Wijesinghe', NULL, 1),
(7, 2, '999 White St', '0118899001', 'Ruwan Jayasuriya', NULL, 1),
(8, 2, '888 Brown St', '0119900112', 'Thilini Gamage', NULL, 1),
(9, 3, '777 Black St', '0111011223', 'Chamika Karunaratne', NULL, 1),
(10, 2, '666 Silver St', '0112122334', 'Sajith Wickramasinghe', NULL, 1);


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

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, '2025-04-09 07:18:23', '', 'Requesting eco tote bag for local school event.', NULL, 'yes'),
(2, 2, '2025-04-09 07:18:23', 'rejected', 'Need water bottles for community clean-up.', '2025-03-01 08:30:00', 'nice'),
(3, 3, '2025-04-09 07:18:23', '', 'Looking for LED lights for a community project.', '2025-03-02 06:00:00', 'yes'),
(4, 4, '2025-04-09 07:18:23', '', 'Request for compost bins for apartment residents.', NULL, 'yes'),
(5, 5, '2025-04-09 07:18:23', 'rejected', 'Giveaway items for environmental awareness campaign.', '2025-03-03 04:15:00', 'jiii'),
(6, 6, '2025-04-09 07:18:23', '', 'Trying to get notebooks for school kids.', '2025-03-04 10:50:00', 'hiii'),
(7, 7, '2025-04-09 07:18:23', 'pending', 'Reusable straw sets for local volunteers.', NULL, ''),
(8, 8, '2025-04-09 07:18:23', '', 'Soap bars for NGO hygiene kits.', '2025-03-05 04:45:00', 'oho'),
(9, 9, '2025-04-09 07:18:23', 'accepted', 'Requesting giveaway without event details.', '2025-03-06 07:30:00', 'come'),
(10, 10, '2025-04-09 07:18:23', 'pending', 'Eco pens for office staff awareness drive.', NULL, '');

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
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `orderStatus` enum('pending','accepted','rejected','shipped','delivered') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `quantity`, `total`, `deliveryAddress`, `billingAddress`, `orderDate`, `orderStatus`) VALUES
(2, 4, 1, 2, 1700.00, '123 Green St', '123 Green St', '2025-03-01', 'pending'),
(3, 5, 2, 1, 650.00, '456 Blue Ln', '456 Blue Ln', '2025-03-02', 'pending'),
(4, 6, 3, 3, 750.00, '789 Red Rd', '789 Red Rd', '2025-03-03', 'accepted'),
(5, 4, 4, 1, 3200.00, '321 Yellow Ave', '321 Yellow Ave', '2025-03-04', 'delivered'),
(6, 5, 5, 2, 2400.00, '654 Orange Blvd', '654 Orange Blvd', '2025-03-05', 'delivered'),
(7, 6, 6, 1, 1800.00, '222 Purple Dr', '222 Purple Dr', '2025-03-06', 'rejected'),
(8, 4, 7, 5, 750.00, '999 White St', '999 White St', '2025-03-07', 'accepted'),
(9, 5, 8, 2, 1900.00, '888 Brown St', '888 Brown St', '2025-03-08', 'rejected'),
(10, 6, 9, 1, 300.00, '777 Black St', '777 Black St', '2025-03-09', 'rejected'),
(11, 4, 10, 2, 1600.00, '666 Silver St', '666 Silver St', '2025-03-10', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `pack_size`
--

CREATE TABLE `pack_size` (
  `pack_id` int(11) NOT NULL,
  `pack_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `productName` varchar(255) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productDescription` text DEFAULT NULL,
  `productStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productName`, `productImage`, `productDescription`, `productStatus`) VALUES
(4, 'Oxo-Degradable Garbage Bag', 'oxo_bag.jpg', 'Eco-conscious garbage bags made with oxo-degradable material that breaks down over time.', 0),
(5, 'Bio-Degradable Garbage Bag', 'bio_bag.jpg', 'Compostable garbage bags made from natural materials, safe for the environment.', 0),
(6, 'Hydrogen Garbage Bag', 'hydrogen_bag.jpg', 'Innovative hydrogen-based garbage bags designed for enhanced odor control and decomposition.', 1),
(7, 'p1', NULL, 'this is dummy data', 1),
(8, 'p2', 'none.png', 'dummy2', 1),
(9, 'p3', 'nonee.png', 'dummy3', 1),
(10, 'p4', 'none.png', 'dummy4', 1),
(11, 'p5', NULL, NULL, 1),
(12, 'p6', NULL, NULL, 1),
(13, 'p6', NULL, NULL, 1),
(14, 'p7', NULL, NULL, 1),
(15, 'p8', NULL, NULL, 1),
(16, 'p9', NULL, NULL, 1);

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
(1, 12, 'modaya.yes', '2025-04-09 13:10:59', '2025-04-09 13:11:16');

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
(2, 2, 4, 'accepted', 'Product damaged on arrival', 'refund', '2025-04-09 07:40:34', ''),
(3, 3, 5, 'accepted', 'Wrong item delivered', 'refund', '2025-04-10 09:55:35', 'bye'),
(4, 4, 6, 'accepted', 'Not as described', 'refund', '2025-04-12 10:01:45', 'booo'),
(5, 5, 4, 'accepted', 'No valid reason provided', 'refund', '2025-04-09 07:47:41', 'baby'),
(6, 6, 5, 'accepted', 'Box was opened', 'refund', '2025-04-10 16:57:46', 'byeeeeeee'),
(7, 11, 6, 'accepted', 'Color mismatch', 'refund', '2025-04-10 16:25:08', 'mom'),
(8, 7, 4, 'rejected', 'Received late', 'refund', '2025-04-09 07:57:44', 'wow'),
(9, 8, 5, 'rejected', 'Found it cheaper elsewhere', 'refund', '2025-04-09 07:41:55', ''),
(10, 9, 6, 'pending', 'Changed my mind', 'refund', '2025-04-09 07:23:24', ''),
(11, 10, 4, 'pending', 'Non-returnable item', 'refund', '2025-04-09 07:25:00', '');

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
(12, 1, 4, 5, 'Excellent product and quick delivery!', '2025-03-01 04:30:00', '2025-04-09 07:40:59', 'replied'),
(13, 2, 5, 3, 'Product was okay, packaging could be better.', '2025-03-02 05:30:00', NULL, 'pending'),
(14, 3, 6, 4, 'Satisfied with the order.', '2025-03-03 07:00:00', NULL, 'pending'),
(15, 4, 7, 1, 'Wrong item sent but support resolved it.', '2025-03-04 07:50:00', '0000-00-00 00:00:00', 'pending'),
(16, 5, 11, 2, 'Did not meet expectations.', '2025-03-05 08:30:00', NULL, 'pending'),
(17, 6, 2, 5, 'Great value for money!', '2025-03-06 09:30:00', NULL, 'pending'),
(18, 7, 3, 5, 'Late delivery.', '2025-03-07 10:40:00', NULL, 'pending'),
(19, 8, 8, 4, 'Amazing experience!', '2025-03-08 11:45:00', '0000-00-00 00:00:00', 'pending'),
(20, 9, 9, 3, 'Average service.', '2025-03-09 13:00:00', NULL, 'pending'),
(21, 10, 10, 1, 'Very poor quality.', '2025-03-10 14:15:00', NULL, 'pending');

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
(5, 'Customer');

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
(6, 'nethmi', 'hi ', '0711234567', NULL, 4, 10, 1);

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
(2, 'upeka@gmail.com', '1234', 5),
(3, 'lakindu@gmail.com', '5555555', 5),
(4, 'nimasha@gmail.com', '444444', 4),
(8, 'kumarage@gmail.com', '2001', 2)
;

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
  ADD KEY `customer_id` (`customer_id`);

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
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carbon_footprint`
--
ALTER TABLE `carbon_footprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `completed_returns`
--
ALTER TABLE `completed_returns`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `custom_order`
--
ALTER TABLE `custom_order`
  MODIFY `customOrder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `giveawayrequests`
--
ALTER TABLE `giveawayrequests`
  MODIFY `giveaway_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pack_size`
--
ALTER TABLE `pack_size`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_item`
--
ALTER TABLE `return_item`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Constraints for table `giveawayrequests`
--
ALTER TABLE `giveawayrequests`
  ADD CONSTRAINT `giveawayrequests_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `pellet`
--
ALTER TABLE `pellet`
  ADD CONSTRAINT `pellet_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `product_has_bag_sizes`
--
ALTER TABLE `product_has_bag_sizes`
  ADD CONSTRAINT `product_has_bag_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_has_bag_sizes_ibfk_2` FOREIGN KEY (`bag_id`) REFERENCES `bag_size` (`bag_id`) ON DELETE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `return_item`
--
ALTER TABLE `return_item`
  ADD CONSTRAINT `return_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
