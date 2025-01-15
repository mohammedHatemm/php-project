-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2025 at 09:02 PM
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
-- Database: `cafateria`
--
CREATE DATABASE IF NOT EXISTS `cafateria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cafateria`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `productName` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `productName`, `price`, `category`, `product_description`, `product_img`) VALUES
(1, 'Espresso', 3.50, 'hot', 'Rich and concentrated coffee shot', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\espresso.jpg'),
(2, 'Cappuccino', 4.50, 'hot', 'Espresso with steamed milk and foam', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\cappuccino.jpg'),
(3, 'Cafe Latte', 4.00, 'hot', 'Espresso with steamed milk', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\cafelatte.jpg'),
(4, 'Hot Chocolate', 4.00, 'hot', 'Rich chocolate with steamed milk', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\hot chocolate.jpg'),
(5, 'Green Tea', 3.00, 'hot', 'Traditional Japanese green tea', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\green tea.jpg'),
(6, 'Chai Tea Latte', 4.50, 'hot', 'Spiced tea with steamed milk', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\chai tea latte.jpg'),
(7, 'Mocha', 5.00, 'hot', 'Espresso with chocolate and steamed milk', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\mocha.jpg'),
(8, 'Americano', 3.50, 'hot', 'Espresso with hot wate', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\americano.jpg'),
(9, 'Caramel Macchiato', 5.00, 'hot', 'Rich and concentrated coffee shot', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\caramrel macchiato.jpg'),
(10, 'Iced Coffee', 4.00, 'cold', 'Chilled coffee with ice', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\ice coffe.jpg'),
(11, 'Frappuccino', 5.50, 'cold', 'Blended coffee with ice and cream', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\frappuccino.jpg'),
(12, 'Iced Tea', 3.50, NULL, 'Espresso with steamed milk and foam', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\iced tea.jpg'),
(13, 'Lemonade', 3.50, 'cold', 'Fresh squeezed lemonade', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\lemonada.jpg'),
(14, 'Smoothie', 5.00, 'cold', 'Fresh fruit smoothie', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\R.jpg'),
(15, 'Milkshake', 5.50, 'cold', 'Chilled mocha with ice', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\milkshake.jpg'),
(17, 'Cold Brew', 4.50, 'cold', 'Chilled latte with ice', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\cold brew.jpg'),
(19, 'Chocolate Cake', 6.00, 'dessert', 'Rich chocolate layer cake', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\cocolate cake.jpg'),
(20, 'Cheesecake', 6.50, 'dessert', 'New York style cheesecake', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\cheesecake.jpg'),
(21, 'Apple Pie', 5.50, 'dessert', 'Homemade apple pie', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\apple pie.jpg'),
(22, 'Tiramisu', 6.50, 'dessert', 'Classic Italian dessert', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\yyy.jpg'),
(23, 'Brownie', 4.50, 'dessert', 'Chocolate fudge brownie', 'C:\\Users\\Falcon\\Desktop\\project php\\product-img\\brownie.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `room_capacity` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','occupied','maintenance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `user_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `role`, `user_img`) VALUES
(1, 'mohamead hatem', '123456789', 'mohamed@yahoo.com', '01145678932', 'user', ''),
(2, 'mohamedelsherif', '25f9e794323b453885f5181f1b624d0b', 'elsherif.m@yahoo.com', '01234567893', 'admin', ''),
(3, 'mostafa ', '25f9e794323b453885f5181f1b624d0b', 'mostafa@yahoo.com', '12345678923', 'admin', ''),
(4, 'rawda', '25f9e794323b453885f5181f1b624d0b', 'rawda@yahoo.com', '11245468789', 'admin', ''),
(5, 'mohamed', '25f9e794323b453885f5181f1b624d0b', 'mo@yahoo.com', '01234567893', 'admin', ''),
(6, 'koko', '25f9e794323b453885f5181f1b624d0b', 'koko@yahoo.com', '123456789', 'user', ''),
(7, 'mom', '25f9e794323b453885f5181f1b624d0b', 'mo@yahoo.com', '12345678923', 'admin', ''),
(8, 'hamo', '$2y$10$j9NU35KGKDtIKG9Ko3q5Ke.ID1Ga9oU42MXtb5DqzVCWr7KWbzE5G', 'admin@yahoo.com', '01234567893', 'admin', '../uploads/6787633aeadad_green tea.jpg'),
(9, 'KKKKK', '$2y$10$NbZeHv1z6q8My3hS/PBp0ONCziSzNH8GGgyPz.H3yf7qbyBbbMlcO', 'KKKK@yahoo.com', '01233456789', 'user', '../uploads/678763959f1be_hot chocolate.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
