-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 08:05 AM
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
(2, 4, 1, 2, 1700.00, '123 Green St', '123 Green St', '2025-03-01', 'accepted'),
(3, 5, 2, 1, 650.00, '456 Blue Ln', '456 Blue Ln', '2025-03-02', 'accepted'),
(4, 6, 3, 3, 750.00, '789 Red Rd', '789 Red Rd', '2025-03-03', 'rejected'),
(5, 4, 4, 1, 3200.00, '321 Yellow Ave', '321 Yellow Ave', '2025-03-04', 'pending'),
(6, 5, 5, 2, 2400.00, '654 Orange Blvd', '654 Orange Blvd', '2025-03-05', 'pending'),
(7, 6, 6, 1, 1800.00, '222 Purple Dr', '222 Purple Dr', '2025-03-06', 'pending'),
(8, 4, 7, 5, 750.00, '999 White St', '999 White St', '2025-03-07', 'pending'),
(9, 5, 8, 2, 1900.00, '888 Brown St', '888 Brown St', '2025-03-08', 'accepted'),
(10, 6, 9, 1, 300.00, '777 Black St', '777 Black St', '2025-03-09', 'accepted'),
(11, 4, 10, 2, 1600.00, '666 Silver St', '666 Silver St', '2025-03-10', 'accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `orderDate` (`orderDate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
