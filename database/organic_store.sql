-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2025 at 03:41 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organic_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 1, 1, 2, '2025-12-07 14:39:48'),
(2, 1, 16, 1, '2025-12-07 14:39:48'),
(3, 2, 4, 3, '2025-12-07 14:39:48'),
(4, 2, 7, 2, '2025-12-07 14:39:48'),
(5, 3, 10, 1, '2025-12-07 14:39:48'),
(6, 3, 21, 4, '2025-12-07 14:39:48'),
(7, 3, 1, 1, '2025-12-07 14:39:48'),
(8, 7, 4, 1, '2025-12-07 14:39:48'),
(18, 11, 1, 1, '2025-12-17 15:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_address` text,
  `phone` varchar(20) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

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
(7, 11, '185000.00', 'pending', '2025-12-17 08:48:54', 'K4/20 Thành Vinh 3, Phường Sơn Trà, Đà Nẵng', '0935622486', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

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
(15, 7, 10, 1, '80000.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','paypal','bank_transfer','cash_on_delivery') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT '0',
  `image_url` text,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'Red organic apples from the USA, sweet and crisp, rich in vitamin C.', '60000.00', 100, 'https://th.bing.com/th/id/R.f2429a70a5a671f1ff81a98c04017bc0?rik=hiBAUNS2pMFIMw&pid=ImgRaw&r=0', 1, '2025-12-02 07:46:12', '2025-12-17 07:24:53'),
(2, 'Banana', 'Organic Cavendish bananas, tree-ripened, providing quick energy.', '30000.00', 150, 'https://img.freepik.com/premium-photo/bunch-organic-cavendish-bananas-isolated-white_139820-115.jpg?w=2000', 1, '2025-12-02 07:46:12', '2025-12-14 15:33:16'),
(3, 'Orange', 'Organic Valencia oranges, juicy, good for skin health.', '40000.00', 80, 'https://img-cdn.misfitsmarket.com/item_images/item_info_164_lg__photo2_2021-12-10_15-14-01.jpg', 1, '2025-12-02 07:46:12', '2025-12-14 15:33:39'),
(4, 'Carrot', 'Organic carrots from Da Lat, sweet and rich in beta-carotene.', '25000.00', 120, 'https://img.freepik.com/premium-photo/carrot-fruit-with-isolated-white-background_741910-21667.jpg?w=2000', 2, '2025-12-02 07:46:12', '2025-12-14 15:53:35'),
(5, 'Spinach', 'Organic spinach bunches, rich in iron and folate.', '35000.00', 90, 'https://m.media-amazon.com/images/I/71E2Cz7fMxL._SL1500_.jpg', 2, '2025-12-02 07:46:12', '2025-12-14 15:54:03'),
(6, 'Beetroot', 'Organic white beets, good for digestion.', '20000.00', 110, 'https://img.freepik.com/premium-photo/nutritious-fresh-eco-beets-food-nature-plant-generate-ai_98402-104933.jpg', 2, '2025-12-02 07:46:12', '2025-12-14 15:55:25'),
(7, 'Apple Juice', 'Cold-pressed from organic apples, no added sugar.', '60000.00', 60, 'https://www.tun-asia.com/wp-content/uploads/2014/08/Apple-Juice-3.jpg', 3, '2025-12-02 07:46:12', '2025-12-14 15:57:33'),
(8, 'Orange Juice', 'Freshly squeezed orange juice, rich in vitamin C.', '55000.00', 70, 'https://static.vecteezy.com/system/resources/previews/050/176/450/large_2x/full-glass-of-orange-juice-isolated-on-transparent-background-png.png', 3, '2025-12-02 07:46:12', '2025-12-14 15:58:47'),
(9, 'Dried Apple', 'Organic dried apples, healthy snacks.', '45000.00', 50, 'https://tse2.mm.bing.net/th/id/OIP.VISz_hki_6ETkk6FOAG3iQHaGx?cb=ucfimg2&ucfimg=1&w=1024&h=936&rs=1&pid=ImgDetMain&o=7&rm=3', 4, '2025-12-02 07:46:12', '2025-12-14 15:59:26'),
(10, 'Chestnuts', 'Roasted organic chestnuts, rich in protein.', '80000.00', 40, 'https://www.seasonal.com.sg/wp-content/uploads/2022/04/nuts.jpg', 4, '2025-12-02 07:46:12', '2025-12-14 16:00:45'),
(11, 'Raisins', 'Seedless dried grapes, naturally sweet.', '70000.00', 65, 'https://5.imimg.com/data5/OP/YO/IZ/SELLER-15173811/raisin-500x500.jpg', 4, '2025-12-02 07:46:12', '2025-12-17 15:09:11'),
(12, 'Almonds', 'Salted roasted almonds, good for heart health.', '90000.00', 55, 'https://www.lorentanuts.com/wp-content/uploads/2021/02/Roasted-Salted-Almonds-www.lorentanuts.com_.jpg', 4, '2025-12-02 07:46:12', '2025-12-17 15:10:09'),
(13, 'Strawberries', 'Sweet organic strawberries, perfect for desserts and snacks.', '75000.00', 85, 'https://img.freepik.com/free-photo/red-fresh-strawberries-with-green-leaves_114579-10506.jpg', 1, '2025-12-07 14:16:21', '2025-12-17 15:10:53'),
(14, 'Blueberries', 'Antioxidant-rich organic blueberries, packed in sustainable containers.', '95000.00', 70, 'https://tse1.mm.bing.net/th/id/OIP.25S4hA6gglrJpSyeCrT3qAHaHa?cb=ucfimg2&ucfimg=1&w=600&h=600&rs=1&pid=ImgDetMain&o=7&rm=3', 1, '2025-12-07 14:16:21', '2025-12-17 15:12:28'),
(15, 'Pears', 'Fresh, crisp organic pears, ideal for salads or direct consumption.', '42000.00', 110, 'https://cdn.shopify.com/s/files/1/0336/7167/5948/products/image-of-organic-bartlett-pears-fruit-28656612704300_512x512.jpg?v=1628112279', 1, '2025-12-07 14:16:21', '2025-12-17 15:13:19'),
(16, 'Zucchini', 'Firm organic zucchini, versatile for grilling, stir-fries, or baking.', '32000.00', 95, 'https://images.heb.com/is/image/HEBGrocery/000374744-1?jpegSize=150&hei=1400&fit=constrain&qlt=75', 2, '2025-12-07 14:16:21', '2025-12-17 15:13:57'),
(17, 'Broccoli', 'Fresh organic broccoli heads, high in Vitamin C and fiber.', '48000.00', 75, 'https://tse3.mm.bing.net/th/id/OIP.nl3c7u_iATQQEbfTVR5oAAHaE8?cb=ucfimg2&ucfimg=1&rs=1&pid=ImgDetMain&o=7&rm=3', 2, '2025-12-07 14:16:21', '2025-12-17 15:14:16'),
(18, 'Cucumber', 'Long organic cucumbers, great for hydrating salads and detox drinks.', '28000.00', 130, 'https://product.hstatic.net/1000282430/product/290010773000_b62f589f5baa4096b635cd8b1eab5cd4_master.jpg', 2, '2025-12-07 14:16:21', '2025-12-17 15:14:47'),
(19, 'Carrot & Apple Juice', 'Freshly pressed juice blend of organic carrots and apples.', '70000.00', 50, 'https://img.freepik.com/premium-photo/apple-carrot-red-beans-mix-juice_8595-4062.jpg', 3, '2025-12-07 14:16:21', '2025-12-17 15:15:39'),
(20, 'Mixed Berries Juice', 'Cold-pressed juice featuring organic strawberries, blueberries, and raspberries.', '110000.00', 45, 'https://tse2.mm.bing.net/th/id/OIP.Q8ZYDsYg3wh1TYwSB3WHcwHaHa?cb=ucfimg2&ucfimg=1&w=650&h=650&rs=1&pid=ImgDetMain&o=7&rm=3', 3, '2025-12-07 14:16:21', '2025-12-17 15:17:05'),
(21, 'Organic Cashews', 'Roasted and lightly salted organic cashews, creamy texture.', '120000.00', 60, 'https://tse4.mm.bing.net/th/id/OIP.YeN7iZb8nAjUQzhxtzu2DQHaHa?cb=ucfimg2&ucfimg=1&w=1200&h=1200&rs=1&pid=ImgDetMain&o=7&rm=3', 4, '2025-12-07 14:16:21', '2025-12-17 15:17:47'),
(22, 'Dried Mango Slices', 'Sweet and tangy organic dried mango slices, no added sugar.', '85000.00', 55, 'https://m.media-amazon.com/images/I/71p8v9M-m4L._SL1500_.jpg', 4, '2025-12-07 14:16:21', '2025-12-17 15:18:21'),
(23, 'Organic Cherry Tomatoes', 'Cherry tomatoes grown according to organic standards, fresh and delicious, perfect for eating raw or in salads', '38000.00', 100, 'https://fruitbrothers.com.au/wp-content/uploads/2024/09/Tomatoes-Truss-Mini-768x768.jpg', 2, '2025-12-14 15:47:35', '2025-12-17 15:21:37'),
(24, 'Dak Lak Booth Avocado', 'Dak Lak Booth avocados are grown according to organic standards, with large fruits, thick, creamy flesh, and very little fiber.', '25000.00', 120, 'https://cdn.lottemart.vn/media/catalog/product/cache/0x0/2/0/2039460000006-3.jpg.webp', 1, '2025-12-14 15:49:03', '2025-12-17 15:26:04'),
(25, 'Red-Fleshed Watermelon', 'Organic red-fleshed watermelons, thin rind, crisp and sweet flesh, very juicy, great for cooling down', '25000.00', 120, 'https://media.istockphoto.com/photos/seedless-mini-watermelon-picture-id1412758063?k=20&m=1412758063&s=612x612&w=0&h=ACC1NAI7rU3OWgBwnw-4xJEBBBt0n28Dcjr0RJ1zV4s=', 1, '2025-12-14 15:51:03', '2025-12-17 15:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

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
(12, 'Lê', 'Minh', 'minh.le123@gmail.com', '$2y$10$juk4ANm9Z0DKgncKR/SLhOKyopHNRD4X4obaYxh1zt0uhZo5OkL1y', 'customer', '2025-12-17 14:00:37', '2025-12-17 14:00:37');

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
