-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2024 at 02:53 AM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movegolf_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '35199dc5f12007f591884a33187ff0bdc74c6b7d'),
(2, 'info@movegolf.co.za', '5855a1b6b7d756a3ec56b8edf56cba477e6bc881');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(8, 1, 1, 'Test product', 5, 1, 's-l1600.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'Thabo', '47thabo@gmail.com', '04525', '75755'),
(2, 1, 'Thabo', '47thabo@gmail.com', '05463643', 'sfgtgtrt');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `createdat`) VALUES
(1, 1, 'Thabo', '5252525', '47thabo@gmail.com', 'paypal', 'flat no. ioouiouio, uyutyuytu, tyutyutyuytu, Gauteng, tyutyuty - 545', 'trtyrty (20 x 1) - ', 20, '2024-05-04', 'pending', '2024-05-30 19:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `no_reviews` int(7) DEFAULT NULL,
  `stars` decimal(7,1) DEFAULT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `no_reviews`, `stars`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'Test product', 'Description example', 5, 2, 5.0, 's-l1600.jpg', 's-l1600.jpg', 's-l1600.jpg'),
(6, 'Golf simbox indoors', 'Size 3m x 3m x 3m, covered in black fabric on top and two sides', 99999, 1, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(7, ' Golf simbox  outdoors', 'Size 3m x 3m x 3m, comes with golf impact net and anti rebound foam', 99999, 4, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(8, 'High impact screen', 'Can be cut to size for individual needs of clients', 99999, 4, 4.6, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(9, 'Golf mat', ' Size is 1.5m x 1.5m', 99999, 2, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(10, 'Golf ball tray', ' ', 99999, 4, 4.2, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(11, 'Optoma projectors', 'Various options available , depends on clients needs and budget .', 99999, 3, 4.5, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(12, 'Gamimg laptop', ' ', 99999, 5, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(13, 'e6 connect', ' ', 99999, 7, 4.2, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(14, 'Projector housing unit', ' ', 99999, 3, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(15, 'Custom built foam padding ', ' ', 99999, 6, 4.7, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(16, 'Custom build curtains', ' ', 99999, 3, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(17, 'Custom built wooden frames', ' ', 99999, 8, 5.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(18, 'Artifical putting and chipping greens', ' ', 99999, 7, 4.6, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(19, 'Tracking units', ' ', 99999, 10, 4.4, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(20, 'Accoustic wall tiles', ' ', 99999, 6, 4.0, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(21, 'Ball bungee cords', ' ', 99999, 12, 4.1, 'no-preview.jpeg', 'no-preview.jpeg', 'no-preview.jpeg'),
(22, 'Test product 2', 'Description example', 200, 8, 4.7, 's-l1600.jpg', 's-l1600.jpg', 's-l1600.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `address` varchar(1000) DEFAULT 'empty',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `phone`, `address`, `password`) VALUES
(1, 'thabo', 'Tshabalala', '47thabo@gmail.com', '0', 'empty', 'a2582975132dc3c5b679447db9c3536a4bc5f994'),
(2, 'Mncedisi', 'Malesa', 'jared@movegolf.co.za', '0712345678', 'empty', '35199dc5f12007f591884a33187ff0bdc74c6b7d');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
