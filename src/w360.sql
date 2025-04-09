-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 10:01 AM
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
-- Table structure for table `carbon_footprint`
--

CREATE TABLE `carbon_footprint` (
  `id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `unit` varchar(10) NOT NULL,
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
  `status` enum('Approved','Rejected') NOT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completed_returns`
--

CREATE TABLE `completed_returns` (
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

INSERT INTO `completed_returns` (`return_id`, `order_id`, `product_id`, `customer_id`, `status`, `decision_reason`, `date_completed`, `message_to_customer`) VALUES
(2, 2, 4, 1, 'accepted', 'yess', '2025-04-09 07:40:34', 'nooo'),
(5, 5, 4, 4, 'accepted', 'baby', '2025-04-09 07:47:41', 'love u'),
(8, 7, 4, 6, 'rejected', 'wow', '2025-04-09 07:57:44', 'ok'),
(9, 8, 5, 7, 'rejected', 'yes', '2025-04-09 07:41:55', 'ohoo');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `address`, `phone`, `mobile`, `name`) VALUES
(1, 2, '123 Green St', '0112233445', '0771234567', 'Alice Perera'),
(2, 3, '456 Blue Ln', '0113344556', '0772345678', 'Nimal Silva'),
(3, 2, '789 Red Rd', '0114455667', '0773456789', 'Kamal Fernando'),
(4, 3, '321 Yellow Ave', '0115566778', '0774567890', 'Sunil Rajapaksha'),
(5, 2, '654 Orange Blvd', '0116677889', '0775678901', 'Diana Abeywardena'),
(6, 3, '222 Purple Dr', '0117788990', '0776789012', 'Hasini Wijesinghe'),
(7, 2, '999 White St', '0118899001', '0777890123', 'Ruwan Jayasuriya'),
(8, 2, '888 Brown St', '0119900112', '0778901234', 'Thilini Gamage'),
(9, 3, '777 Black St', '0111011223', '0779012345', 'Chamika Karunaratne'),
(10, 2, '666 Silver St', '0112122334', '0770123456', 'Sajith Wickramasinghe');

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
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `details` text DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `decision_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giveawayrequests`
--

INSERT INTO `giveawayrequests` (`giveaway_id`, `customer_id`, `request_date`, `status`, `details`, `manager_name`, `comments`, `decision_date`) VALUES
(1, 1, '2025-04-09 07:18:23', 'Pending', 'Requesting eco tote bag for local school event.', NULL, NULL, NULL),
(2, 2, '2025-04-09 07:18:23', 'Pending', 'Need water bottles for community clean-up.', NULL, 'Approved by Sarah', '2025-03-01 08:30:00'),
(3, 3, '2025-04-09 07:18:23', 'Pending', 'Looking for LED lights for a community project.', NULL, 'Out of stock', '2025-03-02 06:00:00'),
(4, 4, '2025-04-09 07:18:23', 'Pending', 'Request for compost bins for apartment residents.', NULL, NULL, NULL),
(5, 5, '2025-04-09 07:18:23', 'Pending', 'Giveaway items for environmental awareness campaign.', NULL, 'Manager approved', '2025-03-03 04:15:00'),
(6, 6, '2025-04-09 07:18:23', 'Pending', 'Trying to get notebooks for school kids.', NULL, 'Incomplete info provided', '2025-03-04 10:50:00'),
(7, 7, '2025-04-09 07:18:23', 'Pending', 'Reusable straw sets for local volunteers.', NULL, NULL, NULL),
(8, 8, '2025-04-09 07:18:23', 'Pending', 'Soap bars for NGO hygiene kits.', NULL, 'Approved - send next week', '2025-03-05 04:45:00'),
(9, 9, '2025-04-09 07:18:23', 'Pending', 'Requesting giveaway without event details.', NULL, 'Declined due to missing context', '2025-03-06 07:30:00'),
(10, 10, '2025-04-09 07:18:23', 'Pending', 'Eco pens for office staff awareness drive.', NULL, NULL, NULL);

--
-- Triggers `giveawayrequests`
--
DELIMITER $$
CREATE TRIGGER `moveToCompleted` AFTER UPDATE ON `giveawayrequests` FOR EACH ROW BEGIN
    -- If the request is marked as "Approved" or "Rejected", move it to CompletedGiveaway
    IF NEW.status IN ('Approved', 'Rejected') THEN
        INSERT INTO completedGiveaway (request_id, customer_id, completion_date, status, manager_name, comments)
        VALUES (NEW.giveaway_id, NEW.customer_id, NOW(), NEW.status, NEW.manager_name, NEW.comments);
        
        -- Remove the request from GiveawayRequests
        DELETE FROM giveawayRequests WHERE giveaway_id = NEW.giveaway_id;
    END IF;
END
$$
DELIMITER ;

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
  `orderStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `quantity`, `total`, `deliveryAddress`, `billingAddress`, `orderDate`, `orderStatus`) VALUES
(2, 4, 1, 2, 1700.00, '123 Green St', '123 Green St', '2025-03-01', 'delivered'),
(3, 5, 2, 1, 650.00, '456 Blue Ln', '456 Blue Ln', '2025-03-02', 'pending'),
(4, 6, 3, 3, 750.00, '789 Red Rd', '789 Red Rd', '2025-03-03', 'accepted'),
(5, 4, 4, 1, 3200.00, '321 Yellow Ave', '321 Yellow Ave', '2025-03-04', 'delivered'),
(6, 5, 5, 2, 2400.00, '654 Orange Blvd', '654 Orange Blvd', '2025-03-05', 'delivered'),
(7, 6, 6, 1, 1800.00, '222 Purple Dr', '222 Purple Dr', '2025-03-06', 'rejected'),
(8, 4, 7, 5, 750.00, '999 White St', '999 White St', '2025-03-07', 'pending'),
(9, 5, 8, 2, 1900.00, '888 Brown St', '888 Brown St', '2025-03-08', 'accepted'),
(10, 6, 9, 1, 300.00, '777 Black St', '777 Black St', '2025-03-09', 'delivered'),
(11, 4, 10, 2, 1600.00, '666 Silver St', '666 Silver St', '2025-03-10', 'pending');

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
  `productPrice` decimal(10,2) DEFAULT NULL,
  `productDescription` text DEFAULT NULL,
  `productPackSize` varchar(255) DEFAULT NULL,
  `productBagSize` varchar(255) DEFAULT NULL,
  `productStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productName`, `productImage`, `productPrice`, `productDescription`, `productPackSize`, `productBagSize`, `productStatus`) VALUES
(4, 'Oxo-Degradable Garbage Bag', 'oxo_bag.jpg', 450.00, 'Eco-conscious garbage bags made with oxo-degradable material that breaks down over time.', 'Roll of 30', 'Large', 'Active'),
(5, 'Bio-Degradable Garbage Bag', 'bio_bag.jpg', 500.00, 'Compostable garbage bags made from natural materials, safe for the environment.', 'Roll of 25', 'Medium', 'Active'),
(6, 'Hydrogen Garbage Bag', 'hydrogen_bag.jpg', 600.00, 'Innovative hydrogen-based garbage bags designed for enhanced odor control and decomposition.', 'Roll of 20', 'Large', 'Active');

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
(3, 3, 5, 'pending', 'Wrong item delivered', 'refund', '2025-04-09 07:23:24', ''),
(4, 4, 6, 'pending', 'Not as described', 'refund', '2025-04-09 07:23:55', ''),
(5, 5, 4, 'accepted', 'No valid reason provided', 'refund', '2025-04-09 07:47:41', 'baby'),
(6, 6, 5, 'pending', 'Box was opened', 'refund', '2025-04-09 07:24:26', ''),
(7, 11, 6, 'pending', 'Color mismatch', 'refund', '2025-04-09 07:23:24', ''),
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
  `role_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `role_id`, `user_name`) VALUES
(1, 'admin@gmail.com', '123456', 1, 'Chamudi'),
(2, 'upeka@gmail.com', '1234', 5, 'Upeka'),
(3, 'lakindu@gmail.com', '5555555', 5, NULL),
(4, 'nimasha@gmail.com', '444444', 4, NULL);

--
-- Indexes for dumped tables
--

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
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `completed_returns`
--
ALTER TABLE `completed_returns`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `User_id` (`user_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

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
-- AUTO_INCREMENT for table `carbon_footprint`
--
ALTER TABLE `carbon_footprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completedgiveaway`
--
ALTER TABLE `completedgiveaway`
  ADD CONSTRAINT `completedgiveaway_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

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
