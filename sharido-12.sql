-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2024 at 04:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharido`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '12345'),
(2, 'admin2', '7272');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(83, 5, 52, 2),
(85, 5, 47, 1),
(86, 5, 48, 1),
(108, 1, 32, 4),
(109, 1, 28, 2),
(110, 1, 65, 1),
(111, 6, 26, 2),
(112, 6, 30, 1),
(113, 1, 30, 1),
(114, 1, 40, 1),
(115, 1, 26, 2),
(116, 7, 26, 1),
(117, 7, 27, 1),
(118, 1, 36, 3),
(119, 1, 63, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'hridoy', 'hridoymridha246@gmail.com', 'hi\r\n', '2024-11-21 05:35:59'),
(2, 'hridoy', 'hridoymridha246@gmail.com', 'hi how are you products are good\r\n', '2024-11-21 05:39:02'),
(3, 'hridoy', 'hello@gmail.com', 'such a nice product', '2024-11-22 01:47:38'),
(4, 'hridoy', 'hridoymridha246@gmail.com', 'goood', '2024-11-24 05:33:00'),
(5, 'admin', 'hello@gmail.com', 'good job', '2024-11-24 13:21:52'),
(6, 'hriooy', 'hridoymridha246@gmail.com', 'sobi valo', '2024-11-26 04:29:16'),
(7, 'shishir', 'shishir@gmail.com', 'Shey shey', '2024-11-27 16:09:12'),
(8, 'HR', 'Hr@gmail.com', 'good ', '2024-11-29 07:30:19'),
(9, 'zia', 'zia@gmail.com', 'good product', '2024-12-01 04:01:41'),
(10, 'hridy', 'hridoymridha246@gmail.com', 'good well done', '2024-12-01 07:41:13'),
(11, 'Hridoy Mridha', 'hridoymridhahs369@gmail.com', 'good product', '2024-12-03 13:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `shipping_address`, `product_id`, `quantity`, `total_price`, `order_date`, `status`) VALUES
(83, 1, '', '01706727260', 'bashundhara,dhaka', 32, 4, 8928.00, '2024-12-03 19:56:55', 'completed'),
(84, 1, '', '01706727260', 'bashundhara,dhaka', 28, 2, 3400.00, '2024-12-03 19:56:55', 'pending'),
(85, 1, '', '01706727260', 'bashundhara,dhaka', 65, 1, 800.00, '2024-12-03 19:56:55', 'pending'),
(86, 1, '', '01706727260', 'bashundhara,dhaka', 30, 1, 450.00, '2024-12-03 19:56:55', 'pending'),
(87, 1, '', '01706727260', 'bashundhara,dhaka', 40, 1, 450.00, '2024-12-03 19:56:55', 'pending'),
(88, 1, '', '01706727260', 'bashundhara,dhaka', 26, 2, 4000.00, '2024-12-03 19:56:55', 'pending'),
(89, 1, '', '01706727260', 'bashundhara,dhaka', 36, 3, 13599.00, '2024-12-03 19:56:55', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `price`, `image`, `stock`) VALUES
(26, 'Jewelry', 'Handmade Jewelry', 'Elegant pearl jewelry perfect for every occasion.', 2000.00, 'jew1.jpg', 45),
(27, 'Home Decor', 'Traditional Bangali Bucket', 'Beautiful handmade bucket for your plants.', 450.00, 'bu4.jpg', 50),
(28, 'Clothing', 'Traditional Saree', 'Authentic saree to embrace your cultural style.', 1700.00, 'shari2.jpeg', 30),
(29, 'Organic Products', 'Pure Organic Mehedi', 'Organic Mehedi for natural coloring.', 120.00, 'mehedi1.png', 200),
(30, 'Tote Bag', 'Handcrafted Tote Bag', 'Stylish tote bag for your daily needs.', 450.00, 'tote.webp', 80),
(31, 'Jewelry', 'Big Pearl Necklace', 'a touch of beauty', 2300.00, 'jew4.jpg', 10),
(32, 'Clothing', 'New Jamdani', 'new collection!!', 2232.00, 'shari3.jpeg', 8),
(34, 'Clothing', 'Dhakai Saree', 'new new new!!', 4323.00, 'share1.webp', 56),
(35, 'Clothing', 'Jamdani saree', 'new arrival!', 4533.00, 'shari4.jpeg', 5),
(36, 'Jewelry', 'Pearl Bracelets', 'new collection!!', 4533.00, 'jew5.jpg', 7),
(37, 'Clothing', 'Silk Saree', 'ne offer!!', 3242.00, 'shari6.jpeg', 4),
(38, 'Home decor', 'HandMade Bucket', 'new in market!!', 456.00, 'bu5.jpg', 5),
(39, 'Home decor', 'Traditional Bucket', 'new new new!!!', 522.00, 'bu1.jpg', 3),
(40, 'Tote Bag', 'New design  tote bags', 'new new new', 450.00, 'tote4.jpeg', 8),
(41, 'Organic Products', 'Othentic Mehedi', 'new in market!!!', 80.00, 'mehedi2.jpg', 5),
(42, 'Jewelry', 'Necklace With exclusive Pearl', 'New collections!!', 2000.00, 'jew3.jpg', 5),
(45, 'Tote Bag', 'New Tote bag', 'stay classic', 500.00, 'tote3.jpg', 10),
(46, 'Jewelry', 'pearl Stud Necklace', 'Elegant gold earrings for every occasion.', 1950.00, 'jew6.jpg', 10),
(47, 'Jewelry', 'Pearl Stud Earrings', 'Elegant Pearl earrings for every occasion.', 1200.00, 'jew7.webp', 20),
(48, 'Jewelry', 'Diamond Pendant', 'A stunning diamond pendant for a touch of luxury.', 2200.00, 'jew8.webp', 13),
(49, 'Home Decor', 'Wooden Wall Art', 'Handcrafted wall art made from reclaimed wood.', 1200.00, 'hm1.webp', 11),
(50, 'Home Decor', 'Handmade Jewelry Bucket', 'A beautifully crafted handmade bucket for organizing your jewelry.', 300.00, 'hm2.jpg', 20),
(51, 'Home Decor', 'Handmade Tree Plant Bucket', 'A durable and aesthetic handmade bucket for planting and decoration.', 500.00, 'hm3.jpg', 30),
(52, 'Home Decor', 'Handmade Wall Hanging', 'Elegant wall hanging made from natural fibers for a unique touch.', 700.00, 'hm4.webp', 5),
(53, 'Organic Products', 'Herbal Shampoo', 'Organic shampoo for healthy, shiny hair.', 690.00, 'or1.jpg', 10),
(54, 'Organic Products', 'Aloe Vera Gel', 'Pure organic aloe vera gel for skincare.', 490.00, 'or2.webp', 40),
(55, 'Organic Products', 'Organic Coconut Oil', 'Pure, cold-pressed coconut oil for cooking and skincare.', 450.00, 'or4.jpeg', 30),
(56, 'Organic Products', 'Natural Honey', 'Raw, unprocessed honey harvested from organic farms.', 700.00, 'or6.jpg', 40),
(57, 'Organic Products', 'Herbal Tea', 'Refreshing and healthy herbal tea made from natural ingredients.', 390.00, 'or5.webp', 20),
(58, 'Organic Products', 'Organic Turmeric Powder', 'High-quality organic turmeric for cooking and health.', 380.00, 'or7.jpg', 20),
(59, 'Organic Products', 'Neem Powder', 'Organic neem powder for skincare and health.', 400.00, 'or8.jpg', 20),
(60, 'Organic Products', 'Organic Soap', 'Handcrafted soap made with natural oils and herbs.', 400.00, 'or9.webp', 20),
(61, 'Clothing', 'Banarasi Silk Saree', 'Traditional Banarasi silk saree with intricate golden work.', 4999.97, 's1.jpeg', 30),
(62, 'Clothing', 'Kanjivaram Silk Saree', 'Elegant Kanjivaram silk saree, perfect for weddings and festivals.', 6999.98, 's2.webp', 20),
(63, 'Clothing', 'Cotton Saree', 'Light and breathable cotton saree, ideal for casual wear.', 3000.00, 's3.webp', 20),
(64, 'Tote Bag', 'Canvas Tote Bag', 'Durable canvas tote bag with a minimalist design, perfect for daily use.', 700.00, 't1.jpeg', 20),
(65, 'Tote Bag', 'Jute Tote Bag', 'Eco-friendly jute tote bag with floral prints, ideal for grocery shopping.', 800.00, 't6.jpeg', 20),
(66, 'Tote Bag', 'Leather Tote Bag', 'Premium leather tote bag with multiple compartments for organization.', 1200.00, 't3.webp', 20),
(67, 'Tote Bag', 'Woven Tote Bag', 'Handmade woven tote bag, perfect for beach outings and casual use.', 1200.00, 't4.jpeg', 10),
(68, 'Tote Bag', 'Printed Tote Bag', 'Stylish printed tote bag with inspirational quotes and vibrant colors.', 900.00, 't5.jpeg', 10),
(69, 'Tote Bag', 'Jute Tote Bag priemium', 'New collection', 700.00, 't2.avif', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'default-profile.png',
  `joined_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `profile_picture`, `joined_date`) VALUES
(1, 'Hridoy', 'hridoymridha246@gmail.com', '$2y$10$Wdt2EgEYOGaw6lXJ2Iim4u2ParJrMc2Md0U0YZg6DCf9GirA14v8.', '01706727260', 'bashundhara,dhaka', 'default-profile.png', '2024-11-21 08:30:56'),
(2, 'Hridoy', 'hridoyhs369@gamil.com', '$2y$10$LA5YEqaS/SgODdSEihN0LuYfGa.3HB58JryfURjXkBes5N2.V6yB6', NULL, NULL, 'default-profile.png', '2024-11-21 08:55:37'),
(3, 'Hridoy', 'hr@gmail.com', '$2y$10$rlVKGQok5SbMTFHzvZmXHuC55/Tt3pASUAHIpCb6WTfD.owzqYF1m', NULL, NULL, 'default-profile.png', '2024-11-21 08:57:38'),
(4, 'Hridoy', 'hridoy@gmail.com', '$2y$10$RTW5FevMjIq5KcUvvcQDk.uHgkTRVRWY3bAnqFtRHcUJJLe58zDF6', NULL, NULL, 'default-profile.png', '2024-11-21 11:21:11'),
(5, 'Hridoy Mridha', 'hridoy2@gmail.com', '$2y$10$BBtcPj/Ebt1tBIxbLaELx.Gf.Per/YhDQbckelJ6NKgxIHvJniQMi', '01322630001', 'Dhaka', 'default-profile.png', '2024-11-28 10:52:50'),
(6, 'zia', 'zia@gmail.com', '$2y$10$6S6m73Xu.PV4cjwKpPUHCe7L3QTsKGfVTgd/wNdQL7Rwuw3Z5fNVC', '01322630001', 'nsu,dhaka', 'default-profile.png', '2024-12-01 10:02:16'),
(7, 'h', 'h@gmail.com', '$2y$10$cMsFHEBqOBWiVyOIjSK2J.rDLyKW/HtkLhBzAH3zEspGQoyr8miRG', NULL, NULL, 'default-profile.png', '2024-12-02 17:58:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `address` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
