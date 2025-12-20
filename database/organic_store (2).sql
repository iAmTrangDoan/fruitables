-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql305.infinityfree.com
-- Generation Time: Dec 20, 2025 at 12:14 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40280315_organic_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 1, 1, 3, '2025-12-07 14:39:48'),
(2, 1, 16, 1, '2025-12-07 14:39:48'),
(3, 2, 4, 3, '2025-12-07 14:39:48'),
(4, 2, 7, 2, '2025-12-07 14:39:48'),
(5, 3, 10, 1, '2025-12-07 14:39:48'),
(6, 3, 21, 4, '2025-12-07 14:39:48'),
(7, 3, 1, 1, '2025-12-07 14:39:48'),
(8, 7, 4, 1, '2025-12-07 14:39:48'),
(23, 1, 2, 1, '2025-12-19 08:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Fruits', 'Fresh and delicious fruits, organically imported from trusted farms.', '2025-12-02 07:45:58'),
(2, 'Vegetables', 'Organically grown vegetables, free from chemicals, ensuring health safety.', '2025-12-02 07:45:58'),
(3, 'Juices', 'Fresh fruit juices, cold-pressed, retaining natural nutrients.', '2025-12-02 07:45:58'),
(4, 'Dried Products', 'Dried fruits, nuts, and other organic products.', '2025-12-02 07:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `order_date` timestamp NULL DEFAULT current_timestamp(),
  `shipping_address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `order_date`, `shipping_address`, `phone`, `note`) VALUES
(1, 1, '440000.00', 'delivered', '2025-12-08 07:33:13', '180 Cao Lỗ, Quận 8, HCM', '0935624459', NULL),
(2, 2, '480000.00', 'shipped', '2025-12-09 07:33:13', '25 Lê Duẩn, Quận 1, HCM', '0934112583', NULL),
(3, 3, '150000.00', 'delivered', '2025-12-10 07:33:13', '45 Nguyễn Huệ, Quận 1, HCM', '0842773223', NULL),
(4, 7, '689000.00', 'pending', '2025-12-13 07:33:13', '70 Bà Triệu, Hà Nội', '0908232524', NULL),
(5, 8, '90000.00', 'cancelled', '2025-12-11 07:33:13', '88 Đống Đa, Đà Nẵng', '0912433789', NULL),
(6, 3, '700000.00', 'delivered', '2025-12-03 07:33:13', '123 Trường Chinh, Hà Nội', '0937772476', NULL),
(7, 11, '185000.00', 'pending', '2025-12-17 08:48:54', 'K4/20 Thành Vinh 3, Phường Sơn Trà, Đà Nẵng', '0935622486', ''),
(8, 14, '433000.00', 'pending', '2025-12-17 16:52:00', 'HoChiMinh City, HoChiMinh', '0898172704', 'Một chai tài lộc '),
(9, 15, '120000.00', 'pending', '2025-12-20 04:04:07', 'K4/20 Thành Vinh 3, Phường Sơn Trà, Đà Nẵng', '0935624459', ''),
(10, 11, '145000.00', 'pending', '2025-12-20 04:16:47', 'K4/20 Thành Vinh 3, Phường Sơn Trà, Đà Nẵng', '0935624459', ''),
(11, 16, '90000.00', 'pending', '2025-12-20 04:30:47', '180 cao lo, hcm', '0963335256', ''),
(12, 11, '115000.00', 'pending', '2025-12-20 04:42:58', '180 cao lo, hcm', '0963335256', ''),
(13, 11, '60000.00', 'pending', '2025-12-20 05:00:32', '180 cao lo, hcm', '0963335256', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, '80000.00'),
(2, 1, 4, 3, '23000.00'),
(3, 2, 7, 4, '120000.00'),
(4, 3, 10, 1, '150000.00'),
(5, 4, 16, 5, '60000.00'),
(6, 5, 21, 1, '90000.00'),
(7, 6, 1, 5, '140000.00'),
(8, 1, 16, 2, '60000.00'),
(9, 1, 21, 1, '90000.00'),
(10, 4, 1, 1, '80000.00'),
(11, 4, 4, 3, '23000.00'),
(12, 4, 7, 2, '120000.00'),
(13, 7, 2, 2, '30000.00'),
(14, 7, 6, 1, '20000.00'),
(15, 7, 10, 1, '80000.00'),
(16, 8, 12, 1, '90000.00'),
(17, 8, 13, 2, '75000.00'),
(18, 8, 17, 1, '48000.00'),
(19, 8, 21, 1, '120000.00'),
(20, 9, 5, 1, '35000.00'),
(21, 9, 7, 1, '60000.00'),
(22, 10, 1, 1, '60000.00'),
(23, 10, 7, 1, '60000.00'),
(24, 11, 2, 1, '30000.00'),
(25, 11, 5, 1, '35000.00'),
(26, 12, 2, 1, '30000.00'),
(27, 12, 7, 1, '60000.00'),
(28, 13, 5, 1, '35000.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','paypal','bank_transfer','cash_on_delivery') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image_url` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'Red organic apples from the USA, sweet and crisp, rich in vitamin C.', '60000.00', 100, 'img/products/1766157909_Apple.jpg', 1, '2025-12-02 07:46:12', '2025-12-20 02:13:32'),
(2, 'Banana', 'Organic Cavendish bananas, tree-ripened, providing quick energy.', '30000.00', 150, 'img/products/1766158716_Banana.jpg', 1, '2025-12-02 07:46:12', '2025-12-19 15:49:37'),
(3, 'Orange', 'Organic Valencia oranges, juicy, good for skin health.', '40000.00', 80, 'img/products/1766158726_Orange.jpg', 1, '2025-12-02 07:46:12', '2025-12-19 15:49:56'),
(4, 'Carrot', 'Organic carrots from Da Lat, sweet and rich in beta-carotene.', '25000.00', 120, 'img/products/1766158734_Carrot.jpg', 2, '2025-12-02 07:46:12', '2025-12-19 15:50:04'),
(5, 'Spinach', 'Organic spinach bunches, rich in iron and folate.', '35000.00', 90, 'img/products/1766158744_Spinach.jpg', 2, '2025-12-02 07:46:12', '2025-12-19 15:50:13'),
(6, 'Beetroot', 'Organic white beets, good for digestion.', '20000.00', 110, 'img/products/1766158765_Beetrot.jpg', 2, '2025-12-02 07:46:12', '2025-12-19 15:50:20'),
(7, 'Apple Juice', 'Cold-pressed from organic apples, no added sugar.', '60000.00', 60, 'img/products/1766158774_Apple-Juice.jpg', 3, '2025-12-02 07:46:12', '2025-12-19 15:52:54'),
(8, 'Orange Juice', 'Freshly squeezed orange juice, rich in vitamin C.', '55000.00', 70, 'img/products/1766158783_Orange-Juice.webp', 3, '2025-12-02 07:46:12', '2025-12-19 15:53:03'),
(9, 'Dried Apple', 'Organic dried apples, healthy snacks.', '45000.00', 50, 'img/products/1766158793_Dried-Apple.webp', 4, '2025-12-02 07:46:12', '2025-12-19 15:53:18'),
(10, 'Chestnuts', 'Roasted organic chestnuts, rich in protein.', '80000.00', 40, 'img/products/1766158801_Chestnuts.jpg', 4, '2025-12-02 07:46:12', '2025-12-19 15:53:25'),
(11, 'Raisins', 'Seedless dried grapes, naturally sweet.', '70000.00', 65, 'img/products/1766158810_Raisin.webp', 4, '2025-12-02 07:46:12', '2025-12-19 15:53:32'),
(12, 'Almonds', 'Salted roasted almonds, good for heart health.', '90000.00', 55, 'img/products/1766158826_Roasted-Salted-Almonds.jpg', 4, '2025-12-02 07:46:12', '2025-12-19 15:53:44'),
(13, 'Strawberries', 'Sweet organic strawberries, perfect for desserts and snacks.', '75000.00', 85, 'img/products/1766158836_Strawberries.jpg', 1, '2025-12-07 14:16:21', '2025-12-19 15:53:54'),
(14, 'Blueberries', 'Antioxidant-rich organic blueberries, packed in sustainable containers.', '95000.00', 70, 'img/products/1766158843_Bluberries.webp', 1, '2025-12-07 14:16:21', '2025-12-19 15:54:06'),
(15, 'Pears', 'Fresh, crisp organic pears, ideal for salads or direct consumption.', '42000.00', 110, 'img/products/1766158853_Pears.webp', 1, '2025-12-07 14:16:21', '2025-12-19 15:54:17'),
(16, 'Zucchini', 'Firm organic zucchini, versatile for grilling, stir-fries, or baking.', '32000.00', 95, 'img/products/1766158866_Zucchini.webp', 2, '2025-12-07 14:16:21', '2025-12-19 15:54:25'),
(17, 'Broccoli', 'Fresh organic broccoli heads, high in Vitamin C and fiber.', '48000.00', 75, 'img/products/1766158875_Broccoli.webp', 2, '2025-12-07 14:16:21', '2025-12-19 15:54:31'),
(18, 'Cucumber', 'Long organic cucumbers, great for hydrating salads and detox drinks.', '28000.00', 130, 'img/products/1766158883_Cucumber.jpg', 2, '2025-12-07 14:16:21', '2025-12-19 15:54:40'),
(19, 'Carrot & Apple Juice', 'Freshly pressed juice blend of organic carrots and apples.', '70000.00', 50, 'img/products/1766158892_Apple-Carrot-Mix-Juice.jpg', 3, '2025-12-07 14:16:21', '2025-12-19 15:54:54'),
(20, 'Mixed Berries Juice', 'Cold-pressed juice featuring organic strawberries, blueberries, and raspberries.', '110000.00', 45, 'img/products/1766158902_Mixed-Berries-Juice.webp', 3, '2025-12-07 14:16:21', '2025-12-19 15:55:00'),
(21, 'Organic Cashews', 'Roasted and lightly salted organic cashews, creamy texture.', '120000.00', 60, 'img/products/1766158923_Cashews.webp', 4, '2025-12-07 14:16:21', '2025-12-19 15:55:09'),
(22, 'Dried Mango Slices', 'Sweet and tangy organic dried mango slices, no added sugar.', '85000.00', 55, 'img/products/1766158931_Dried-Mango.jpg', 4, '2025-12-07 14:16:21', '2025-12-19 15:55:18'),
(23, 'Organic Cherry Tomatoes', 'Cherry tomatoes grown according to organic standards, fresh and delicious, perfect for eating raw or in salads', '38000.00', 100, 'img/products/1766158941_Tomatoes-Truss-Mini.jpg', 2, '2025-12-14 15:47:35', '2025-12-19 15:55:25'),
(24, 'Dak Lak Booth Avocado', 'Dak Lak Booth avocados are grown according to organic standards, with large fruits, thick, creamy flesh, and very little fiber.', '25000.00', 120, 'img/products/1766158950_Booth-Avocado.webp', 1, '2025-12-14 15:49:03', '2025-12-19 15:55:31'),
(25, 'Red-Fleshed Watermelon', 'Organic red-fleshed watermelons, thin rind, crisp and sweet flesh, very juicy, great for cooling down', '25000.00', 120, 'img/products/1766158958_Red-Fleshed-Watermelon.jpg', 1, '2025-12-14 15:51:03', '2025-12-19 15:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Trang', 'Doan', 'doantrangltt@gmail.com', '$2y$10$J7xqto2w80P9FFS0/m75beITNzxGnQWt2rTExHdvTvjeFJfe2TaX6', 'customer', '2025-11-30 09:27:25', '2025-11-30 09:27:25'),
(2, 'Quynh', 'Le', 'lethimyquynh@gmail.com', '$2y$10$7A.ZMdb4hUygrAZz8jTqWudV0VYium.CaEE8iQyByesUmj6Vbmyi2', 'customer', '2025-11-30 09:28:56', '2025-11-30 09:28:56'),
(3, 'Bao Khang', 'Nguyen Luu', 'baokhang123@gmail.com', '$2y$10$BbHOu8trU7CrGfqhn5RMxetvbCMW8qmZoqOAUGkvX.LIpVvVmDQSu', 'customer', '2025-11-30 09:34:45', '2025-11-30 09:34:45'),
(7, 'user', '1', 'user@gmail.com', '$2y$10$76.dS5KEIUu3.uZfjQ7YweiXKHRvruEN2CwfU3amseVIPz9jDcs/G', 'customer', '2025-11-30 09:45:54', '2025-12-07 14:35:41'),
(8, 'user', '2', 'user2@gmail.com', '$2y$10$baawUh9Z0Vba2Gr7kmUWUeopkHYvoB5kdemIxtRTq6KgPCmHY4YOy', 'customer', '2025-11-30 16:40:14', '2025-12-07 14:36:00'),
(10, 'admin', '1', 'admin1@gmail.com', '$2y$10$.zPam/cXp1cnMkT14RBZWOEkNZMGmd8LEX8DBzJjw4fjM0RPJvqpO', 'admin', '2025-12-05 14:57:06', '2025-12-05 14:57:20'),
(11, 'Nguyễn Thị', 'Trà Vinh', 'vinhtra_nguyen12@gmail.com', '$2y$10$K6GsovWwhF2RX1QjgVHTPOlokOMc6RGPbqDkXRRovvWLxiXDUotsi', 'customer', '2025-12-14 16:36:06', '2025-12-14 16:36:06'),
(12, 'Lê', 'Minh', 'minh.le123@gmail.com', '$2y$10$juk4ANm9Z0DKgncKR/SLhOKyopHNRD4X4obaYxh1zt0uhZo5OkL1y', 'customer', '2025-12-17 14:00:37', '2025-12-17 14:00:37'),
(14, 'Quynh', 'Le', 'meomaydoraemon@gmail.com', '$2y$10$H9/HGa4VhNZAtnJQKWO08OPBzfn0ccVC2YmkVAG.NOqF/qsFDUNAm', 'customer', '2025-12-17 16:50:02', '2025-12-17 16:50:02'),
(15, 'nguyen', 'a', 'nguyena@gmail.com', '$2y$10$6Y18kae9j4jTvs0HAD1qq.5sX5TeSfjKm52q6H24Wpmoiu5RqPAKC', 'customer', '2025-12-20 04:02:44', '2025-12-20 04:02:44'),
(16, 'user', '3', 'u@gmail.com', '$2y$10$tBix/Azviw33aWjSbyYgLeZqAXClKRnm3XMMsyD0e2mly0/pj6K.2', 'customer', '2025-12-20 04:29:44', '2025-12-20 04:29:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
