-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 08, 2025 at 06:11 PM
-- Server version: 8.0.40
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_mail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_mail`, `created_at`, `updated_at`) VALUES
(1, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(2, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(3, 'Leandro Bußmann', 'leandro.bussmann@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(4, 'Hans Schäfer', 'hans.schaefer@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(5, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(6, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', '2025-02-08 00:59:47', '2025-02-08 00:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `created_at`, `updated_at`) VALUES
(1, 'Refactoring: Improving the Design of Existing Code', 49.99, '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(2, 'Clean Architecture: A Craftsman\\\'s Guide to Software Structure and Design', 24.99, '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(3, 'Clean Architecture: A Craftsman\\\'s Guide to Software Structure and Design', 19.99, '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(4, 'Refactoring: Improving the Design of Existing Code', 37.98, '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(5, 'Refactoring: Improving the Design of Existing Code', 37.98, '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(6, 'Clean Architecture: A Craftsman\\\'s Guide to Software Structure and Design', 19.99, '2025-02-08 00:59:47', '2025-02-08 00:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `sale_date` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `customer_id`, `product_id`, `sale_date`, `version`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-04-02 08:05:12', '1.0.17+42', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(2, 2, 2, '2019-05-01 11:07:18', '1.0.17+59', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(3, 3, 3, '2019-05-06 14:26:14', '1.0.15+83', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(4, 4, 4, '2019-06-07 11:38:39', '1.0.17+65', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(5, 5, 5, '2019-07-01 15:01:13', '1.0.17+65', '2025-02-08 00:59:47', '2025-02-08 00:59:47'),
(6, 6, 6, '2019-08-07 19:08:56', '1.1.3', '2025-02-08 00:59:47', '2025-02-08 00:59:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`) USING BTREE,
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
