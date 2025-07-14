-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 08:02 PM
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
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `full_name`, `email`, `contact_number`, `address`, `quantity`, `total_amount`, `status`, `created_at`) VALUES
(45, 3, 1, 'Omar Farooq', 'omar@gmail.com', '03003583878', 'f45', 4, 159.00, 'pending', '2025-07-12 17:09:53'),
(46, 3, 2, 'Faraz', 'omar@gmail.com', '03003583878', 'House # L-64, Zaman Town, Korangi # 4, Karachi.', 1, 49.00, 'Shipped', '2025-07-12 18:10:10'),
(59, 3, 1, 'Omar Farooq', 'omar@gmail.com', '03003583878', 'House # L-64, Zaman Town, Korangi # 4, Karachi.', 1, 39.00, 'pending', '2025-07-14 13:49:57'),
(60, 3, NULL, 'Omar Farooq', 'omar@gmail.com', '03003583878', 'House # L-64, Zaman Town, Korangi # 4, Karachi.', 0, 0.00, 'pending', '2025-07-14 13:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(8, 45, 1, 4, 39.00, 159.00),
(9, 46, 2, 1, 49.00, 49.00),
(12, 59, 1, 1, 39.00, 39.00),
(13, 60, 1, 1, 39.99, 39.99),
(14, 60, 2, 3, 49.99, 149.97);

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `page_name`, `view_count`) VALUES
(1, 'home', 449),
(2, 'shop', 4),
(3, 'product', 14),
(4, 'search', 14),
(5, 'login', 34),
(6, 'register', 3),
(7, 'cart', 17);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `category`, `image`, `created_at`) VALUES
(1, 'Premium Hoodie', 39.99, 'Crafted from ultra-soft fleece, this premium hoodie offers unmatched comfort for daily wear. Its sleek design, reinforced stitching, and adjustable drawstrings make it both stylish and practical. Whether you’re lounging at home or heading out, this hoodie keeps you warm and on-trend.', 'hoodie', 'premium-hoodie.jpeg', '2025-07-14 08:08:46'),
(2, 'Casual Jacket', 49.99, 'Designed for urban explorers, this casual jacket features lightweight breathable material with a modern cut. Zippered pockets, snap-button cuffs, and a high collar protect you from chilly winds. It pairs perfectly with jeans, chinos, or joggers for a smart yet relaxed look.', 'jacket', 'casual-jacket.jpeg', '2025-07-14 08:08:46'),
(3, 'Stylish Sneakers', 59.99, 'These sneakers combine bold design with cloud-like cushioning. With anti-slip rubber soles and breathable mesh upper, they’re made for movement. From the gym to the streets, step into all-day comfort and urban style that speaks confidence.', 'sneakers', 'stylish-sneakers.jpeg', '2025-07-14 08:08:46'),
(4, 'Graphic T-Shirt', 24.99, 'Comfortable and stylish cotton graphic t-shirt, perfect for everyday wear.', 'shirt', 'graphic-t-shirt.jpeg', '2025-07-14 08:08:46'),
(5, 'Luxury Timepiece', 120.00, 'Discover timeless sophistication with our Luxury Watch, masterfully crafted for those who value elegance, precision, and status. Engineered with a high-grade stainless steel case and scratch-resistant sapphire crystal, this watch is more than just an accessory — it’s a statement.\r\n\r\nWhether you\'re in a business meeting or at a formal event, the sleek design and luxurious finish complement any outfit. With water resistance, automatic movement, and a long-lasting battery, this timepiece combines functionality with flawless aesthetics.', '', 'luxury-watch.jpeg', '2025-07-14 08:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `contact`, `address`, `status`, `created_at`) VALUES
(3, 'omar@gmail.com', 'omar123', 'Omar Farooq', '03003583878', 'House#L-64, Korangi, Karachi.', 'deactive', '2025-07-12 22:19:58'),
(5, 'faraz@gmail.com', 'faraz123', 'Faraz Khan', '03006781908', 'Korangi.', 'active', '2025-07-14 09:00:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
