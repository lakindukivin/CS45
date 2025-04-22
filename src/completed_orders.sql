-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 08:06 AM
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
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `completed_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` enum('accepted','rejected','shipped','delivered','processing') DEFAULT NULL,
  `message_to_customer` text DEFAULT NULL,
  `date_completed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`completed_id`, `order_id`, `status`, `message_to_customer`, `date_completed`) VALUES
(5, 2, 'delivered', 'bye', '2025-04-21'),
(6, 3, 'shipped', 'gone', '2025-04-21'),
(7, 4, 'rejected', 'can not accept', '2025-04-21'),
(8, 11, 'shipped', 'boo', '2025-04-21'),
(9, 10, 'delivered', 'byee', '2025-04-21'),
(10, 9, 'delivered', 'vii', '2025-04-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`completed_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD CONSTRAINT `completed_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
