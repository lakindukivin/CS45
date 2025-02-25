-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 12:33 PM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `User_id`, `Address`, `Phone`, `Mobile`, `Name`) VALUES
(1, 1, 'No 112, temple road, Galle', '0768512877', '0766778889', 'Thihansa'),
(2, 1, 'me dkemkefmek', '0768512877', '0766778889', 'd3kmf3kfm');

-- --------------------------------------------------------

--
-- Table structure for table `custom_order`
--

CREATE TABLE `custom_order` (
  `customOrder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Specifications` text DEFAULT NULL,
  `customOrder_status` enum('pending','accepted','rejected','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_order`
--

INSERT INTO `custom_order` (`customOrder_id`, `customer_id`, `Company_name`, `Quantity`, `Email`, `Phone`, `Type`, `Specifications`, `customOrder_status`) VALUES
(1, 1, 'UCSC', 120, 'nnimasha43@gmail.com', '0768512877', 'oxo', 'crkcjevlejmv', 'pending'),
(2, 2, 'WSO2', 340, 'hi@gmail.com', '0768512877', 'oxo', 'dekcjlckw', 'pending'),
(3, 1, 'Q4us', 500, 'hello@gmail.com', '0768512877', 'oxo', 'dekcrclorkc', 'pending'),
(4, 2, 'syscolabs', 450, 'hiii@gmail.com', '0768512877', 'oxo', 'd3fglr;jsjbygfu', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `Discount_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `discountPercentage` decimal(5,2) DEFAULT NULL,
  `Product_price` decimal(10,2) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `orderStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `product_id`, `customer_id`, `Quantity`, `Total`, `deliveryAddress`, `billingAddress`, `orderDate`, `orderStatus`) VALUES
(1, 1, 1, 120, 340.00, 'dwkdl,lasmcks', 'dwkdjqldh', '2025-02-04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pellet`
--

CREATE TABLE `pellet` (
  `PelletOrder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `dateRequired` date DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `PelletOrderStatus` enum('pending','accepted','rejected','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pellet`
--

INSERT INTO `pellet` (`PelletOrder_id`, `customer_id`, `Company_name`, `Email`, `Amount`, `Contact`, `dateRequired`, `Date`, `PelletOrderStatus`) VALUES
(1, 1, 'UCSC', 'hi@gmail.com', 120.00, '0768512877', '2025-02-28', '2025-02-11 15:22:26', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `polytheneamount`
--

CREATE TABLE `polytheneamount` (
  `amount_id` int(50) NOT NULL,
  `polytheneamount` float NOT NULL,
  `message` varchar(100) NOT NULL,
  `month` enum('January','February','March','April','May','June','July','August','Sepetember','October','November','December') NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polytheneamount`
--

INSERT INTO `polytheneamount` (`amount_id`, `polytheneamount`, `message`, `month`, `updated_date`) VALUES
(1, 0.08, 'edkdmwkd', 'January', '2025-02-11 12:01:37'),
(2, 0.01, 'dwiwjowl,', 'February', '2025-02-11 12:08:53'),
(3, 0.03, 'vhbjnmgcg', 'March', '2025-02-11 12:16:45'),
(4, 0.03, 'hbkn', 'January', '2025-02-11 12:19:26'),
(5, 0.03, 'hbkn', 'January', '2025-02-11 12:27:25'),
(6, 0.03, 'dwjkdmqwdmwl,d', 'August', '2025-02-11 12:27:41'),
(7, 0.05, 'nakxmlx,', 'August', '2025-02-11 12:28:27'),
(8, 0.03, 'bjnwkdmw', 'July', '2025-02-11 12:44:56'),
(9, 0.01, 'bjbn', 'June', '2025-02-11 12:55:20'),
(10, 0.03, 'rgfrfr', 'January', '2025-02-22 03:59:55'),
(11, 0.02, 'efekfnek', 'December', '2025-02-22 05:01:17'),
(12, 0.02, 'hefiehfkjekf', 'June', '2025-02-22 12:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `polythenecollection`
--

CREATE TABLE `polythenecollection` (
  `Collection_id` int(11) NOT NULL,
  `Vehicle_id` int(11) DEFAULT NULL,
  `Collection_date` date DEFAULT NULL,
  `Collection_time` time DEFAULT NULL,
  `Area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polythenegiveaway`
--

CREATE TABLE `polythenegiveaway` (
  `Giveaway_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polythenegiveaway`
--

INSERT INTO `polythenegiveaway` (`Giveaway_id`, `Customer_id`, `Type`, `Address`, `quantity`) VALUES
(1, 1, 'dwmdw', 'wdnwkfmel', 23),
(2, 1, 'rfrf', 'ffrfft', 45),
(3, 1, 'hrifhrf', 'fgrfhrkfj', 45);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
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

INSERT INTO `product` (`Product_id`, `productName`, `productImage`, `productPrice`, `productDescription`, `productPackSize`, `productBagSize`, `productStatus`) VALUES
(1, 'oxo bag', 'hi', 120.00, 'nejejckcmsmac cbjcnzm', '20', '200cm', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `Reply_id` int(11) NOT NULL,
  `Review_id` int(11) NOT NULL,
  `Reply` text DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Reason` varchar(255) DEFAULT NULL,
  `Order_id` int(11) NOT NULL,
  `reportDescription` text DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_item`
--

CREATE TABLE `return_item` (
  `Return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `returnStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_item`
--

INSERT INTO `return_item` (`Return_id`, `order_id`, `returnStatus`) VALUES
(1, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_id`, `customer_id`, `order_id`, `Rating`, `Comment`, `Date`, `dateModified`) VALUES
(1, 1, 1, 3, 'gsuchsclwm,m', '2025-02-04 11:19:52', '2025-02-04 11:19:52'),
(2, 1, 1, 4, 'dhwidjwdjqd', '2025-02-03 15:30:11', '2025-02-04 11:19:52'),
(3, 1, 1, 5, 'ffhivjfbmbk', '2025-02-16 19:17:29', '2025-02-04 11:19:52'),
(4, 2, 1, 4, 'vhbknkbjn', '2025-02-17 19:19:58', '2025-02-12 19:19:58'),
(5, 1, 1, 4, 'rfgtgt', '2025-02-16 20:01:42', '2025-02-17 20:01:42'),
(6, 2, 1, 4, 'tgtgtgt', '2025-02-04 11:19:52', '2025-02-04 11:19:52'),
(7, 2, 1, 6, 'yhujuju', '2025-02-21 12:55:57', '2025-02-21 12:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `Reward_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Role_id` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Role_id`, `Role`) VALUES
(1, 'customer'),
(2, 'salesMarketingManager'),
(3, 'productionManager'),
(4, 'customerServiceManager');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Stock_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Total` int(11) DEFAULT NULL,
  `Sold` int(11) DEFAULT NULL,
  `Remaining` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Email`, `Password`, `Role_id`) VALUES
(1, 'lakindu@gmail.com', '111111', 1),
(2, 'chamudi@gmail.com', '222222', 2),
(3, 'nethmi@gmail.com', '333333', 3),
(4, 'nimasha@gmail.com', '444444', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`),
  ADD KEY `User_id` (`User_id`);

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
  ADD PRIMARY KEY (`Discount_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `pellet`
--
ALTER TABLE `pellet`
  ADD PRIMARY KEY (`PelletOrder_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `polytheneamount`
--
ALTER TABLE `polytheneamount`
  ADD PRIMARY KEY (`amount_id`);

--
-- Indexes for table `polythenecollection`
--
ALTER TABLE `polythenecollection`
  ADD PRIMARY KEY (`Collection_id`);

--
-- Indexes for table `polythenegiveaway`
--
ALTER TABLE `polythenegiveaway`
  ADD PRIMARY KEY (`Giveaway_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`Reply_id`),
  ADD KEY `Review_id` (`Review_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`Report_id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `Order_id` (`Order_id`);

--
-- Indexes for table `return_item`
--
ALTER TABLE `return_item`
  ADD PRIMARY KEY (`Return_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`Reward_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Stock_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `Role_id` (`Role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_order`
--
ALTER TABLE `custom_order`
  MODIFY `customOrder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `Discount_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pellet`
--
ALTER TABLE `pellet`
  MODIFY `PelletOrder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `polytheneamount`
--
ALTER TABLE `polytheneamount`
  MODIFY `amount_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `polythenecollection`
--
ALTER TABLE `polythenecollection`
  MODIFY `Collection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polythenegiveaway`
--
ALTER TABLE `polythenegiveaway`
  MODIFY `Giveaway_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `Reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_item`
--
ALTER TABLE `return_item`
  MODIFY `Return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `Reward_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `Role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `custom_order`
--
ALTER TABLE `custom_order`
  ADD CONSTRAINT `custom_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`Order_id`);

--
-- Constraints for table `pellet`
--
ALTER TABLE `pellet`
  ADD CONSTRAINT `pellet_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `polythenegiveaway`
--
ALTER TABLE `polythenegiveaway`
  ADD CONSTRAINT `polythenegiveaway_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`Review_id`) REFERENCES `review` (`Review_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`);

--
-- Constraints for table `return_item`
--
ALTER TABLE `return_item`
  ADD CONSTRAINT `return_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`Order_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`Order_id`);

--
-- Constraints for table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Role_id`) REFERENCES `role` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
