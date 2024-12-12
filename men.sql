-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 04:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `men`
--
CREATE DATABASE IF NOT EXISTS `men` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci;
USE `men`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 1, 1, 2, '2024-12-01 16:49:09'),
(2, 2, 2, 1, '2024-12-01 16:49:09'),
(3, 3, 3, 3, '2024-12-01 16:49:09'),
(4, 4, 4, 1, '2024-12-01 16:49:09'),
(5, 5, 5, 2, '2024-12-01 16:49:09'),
(6, 6, 6, 1, '2024-12-01 16:49:09'),
(7, 7, 7, 5, '2024-12-01 16:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `user_id`, `address`, `phone_number`) VALUES
(1, 1, '123 Main Street, Cityville', '123-456-7890'),
(2, 2, '456 Oak Avenue, Townplace', '234-567-8901'),
(3, 3, '789 Pine Road, Villagetown', '345-678-9012'),
(4, 4, '101 Maple Lane, Suburbia', '456-789-0123'),
(5, 5, '202 Birch Blvd, Metropolis', '567-890-1234'),
(6, 6, '303 Cedar Drive, Uptown', '678-901-2345'),
(7, 7, '404 Elm Street, Downtown', '789-012-3456');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int DEFAULT '0',
  `image_url` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `created_at`) VALUES
(1, 'Red T-Shirt', 'Comfortable red cotton t-shirt', '19.99', 100, 'anh1.jpg', '2024-12-01 16:49:09'),
(2, 'Blue T-Shirt', 'Soft blue cotton t-shirt', '18.99', 50, 'anh2.jpg', '2024-12-01 16:49:09'),
(3, 'Green T-Shirt', 'Eco-friendly green t-shirt', '20.99', 75, 'anh3.jpg', '2024-12-01 16:49:09'),
(4, 'Black T-Shirt', 'Classic black cotton t-shirt', '21.99', 80, 'anh4.jpg', '2024-12-01 16:49:09'),
(5, 'White T-Shirt', 'Simple white cotton t-shirt', '17.99', 150, 'anh5.jpg', '2024-12-01 16:49:09'),
(6, 'Yellow T-Shirt', 'Bright yellow t-shirt', '22.99', 40, 'anh6.jpg', '2024-12-01 16:49:09'),
(7, 'Purple T-Shirt', 'Stylish purple cotton t-shirt', '23.99', 30, 'anh7.jpg', '2024-12-01 16:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `full_name`, `created_at`) VALUES
(1, 'admin', '123', 'user1@example.com', 'John', '2024-12-01 16:49:09'),
(2, 'user2', 'password2', 'user2@example.com', 'Jane', '2024-12-01 16:49:09'),
(3, 'user3', 'password3', 'user3@example.com', 'Michael', '2024-12-01 16:49:09'),
(4, 'user4', 'password4', 'user4@example.com', 'Emily', '2024-12-01 16:49:09'),
(5, 'user5', 'password5', 'user5@example.com', 'David', '2024-12-01 16:49:09'),
(6, 'user6', 'password6', 'user6@example.com', 'Sarah', '2024-12-01 16:49:09'),
(7, 'user7', 'password7', 'user7@example.com', 'James', '2024-12-01 16:49:09'),
(8, 'admin1', '123', 'johndoe@example.com', 'Luc Pham', '2024-12-01 16:52:11'),
(9, 'admin1', '123', 'johndoe@example.com', 'Hieu', '2024-12-01 16:52:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
