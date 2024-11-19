-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2024 at 02:25 PM
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
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Kentaro Miura', 'Tác giả Berserk, sinh năm 1966', '2024-11-15 17:41:36', '2024-11-19 14:17:43'),
(2, 'Naoki Urasawa', 'Tác giả Monster và 20th Century Boys', '2024-11-15 17:41:36', '2024-11-19 14:17:53'),
(3, 'Eiichiro Oda', 'Tác giả nổi tiếng của One Piece, sinh năm 1975', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(4, 'Masashi Kishimoto', 'Tác giả của series Naruto, sinh năm 1974', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(5, 'Akira Toriyama', 'Cha đẻ của Dragon Ball, sinh năm 1955', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(6, 'Yoshihiro Togashi', 'Tác giả Hunter x Hunter và Yu Yu Hakusho', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(7, 'Hajime Isayama', 'Tác giả Attack on Titan, sinh năm 1986', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(8, 'Gosho Aoyama', 'Tác giả Detective Conan, sinh năm 1963', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(9, 'Hiromu Arakawa', 'Tác giả Fullmetal Alchemist, sinh năm 1973', '2024-11-15 17:41:36', '2024-11-15 17:41:36'),
(10, 'Tite Kubo', 'Tác giả Bleach, sinh năm 1977', '2024-11-15 17:41:36', '2024-11-15 17:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `ID` int NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Position` int NOT NULL DEFAULT '0',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`ID`, `Title`, `Description`, `Img`, `Status`, `Position`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'vvfdsvdv', 'sdsfdsf', '../uploads/banner/1732018701_466964285_549571631227324_6373781640164775592_n.jpg', 1, 0, '2024-11-19 12:18:21', '2024-11-19 12:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 64, '2024-11-12 17:57:07', '2024-11-12 17:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `comic_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tình cảm', 'Những câu chuyện về tình yêu', '2024-11-15 17:43:38', '2024-11-19 14:18:42'),
(2, 'Trinh thám', 'Manga về các vụ án và điều tra', '2024-11-15 17:43:38', '2024-11-19 14:18:50'),
(3, 'Siêu nhiên', 'Manga về các yếu tố siêu nhiên', '2024-11-15 17:43:38', '2024-11-19 14:19:01'),
(4, 'Học đường', 'Câu chuyện trong môi trường học đường', '2024-11-15 17:43:38', '2024-11-19 14:19:13'),
(5, 'Thể thao', 'Manga về các môn thể thao', '2024-11-15 17:43:38', '2024-11-19 14:19:23'),
(6, 'Fantasy', 'Thế giới kỳ ảo với phép thuật', '2024-11-15 17:43:38', '2024-11-19 14:19:32'),
(7, 'Kinh dị', 'Thể loại manga kinh dị, rùng rợn', '2024-11-15 17:43:38', '2024-11-15 17:43:38'),
(8, 'Hành động', 'Thể loại manga với những pha hành động gay cấn', '2024-11-15 17:43:38', '2024-11-15 17:43:38'),
(9, 'Phiêu lưu', 'Những cuộc phiêu lưu kỳ thú và hấp dẫn', '2024-11-15 17:43:38', '2024-11-15 17:43:38'),
(10, 'Hài hước', 'Manga mang tính giải trí và hài hước', '2024-11-15 17:43:38', '2024-11-15 17:43:38'),
(11, 'Kinh dị', 'Thể loại manga kinh dị, rùng rợn', '2024-11-15 17:43:38', '2024-11-15 17:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `description` text,
  `publication_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `original_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock_quantity` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`id`, `title`, `author_id`, `category_id`, `description`, `publication_date`, `price`, `original_price`, `stock_quantity`, `image`, `created_at`, `updated_at`) VALUES
(68, 'One Piece - Tập 100', 5, 10, 'Cuộc chiến ở Wano quốc đạt đến đỉnh điểm', '2024-01-15', '25000.00', '30000.00', 100, '../uploads/product/1731693203_vivoy100.jpg', '2024-11-15 17:52:47', '2024-11-15 17:53:23'),
(70, 'Dragon Ball Super - Vol.20', 3, 8, 'Goku và những trận chiến mới', '2024-01-17', '26000.00', '31000.00', 90, '../uploads/product/1731693220_ip14plus.jpg', '2024-11-15 17:52:47', '2024-11-15 17:53:40'),
(71, 'Hunter x Hunter - Tập 37', 7, 11, 'Cuộc phiêu lưu trong thế giới Dark Continent', '2024-01-18', '28000.00', '33000.00', 75, '../uploads/product/1731693241_ip12.jpg', '2024-11-15 17:52:47', '2024-11-15 17:54:01'),
(72, 'Attack on Titan - Tập Cuối', 6, 5, 'Kết thúc của cuộc chiến người và titan', '2024-01-19', '30000.00', '35000.00', 95, '../uploads/product/1731693251_ip1.jpg', '2024-11-15 17:52:47', '2024-11-15 17:54:11'),
(74, 'Fullmetal Alchemist - Perfect', 4, 8, 'Phiên bản đặc biệt với nội dung mở rộng', '2024-01-21', '35000.00', '40000.00', 70, '../uploads/product/1731693271_ip15promax.jpg', '2024-11-15 17:52:47', '2024-11-15 17:54:31'),
(75, 'Bleach - TYBW Arc', 5, 11, 'Arc cuối cùng của series Bleach', '2024-01-22', '29000.00', '34000.00', 82, '../uploads/product/1731693279_ip15.jpg', '2024-11-15 17:52:47', '2024-11-15 17:54:39'),
(76, 'Berserk - Deluxe Edition', 9, 5, 'Phiên bản deluxe với chất lượng cao', '2024-01-23', '40000.00', '45000.00', 60, '../uploads/product/1731693289_ip14.jpg', '2024-11-15 17:52:47', '2024-11-15 17:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `comic_sales`
--

CREATE TABLE `comic_sales` (
  `id` int NOT NULL,
  `comic_id` int NOT NULL,
  `sale_type` enum('percent','fixed') NOT NULL,
  `sale_value` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('active','inactive','pending') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comic_sales`
--

INSERT INTO `comic_sales` (`id`, `comic_id`, `sale_type`, `sale_value`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(23, 75, 'percent', '4.00', '2024-11-18 00:00:00', '2024-11-21 00:00:00', 'pending', '2024-11-18 16:33:28', '2024-11-18 19:20:58'),
(28, 71, 'percent', '1.00', '2024-11-19 00:00:00', '2024-11-22 00:00:00', 'active', '2024-11-18 19:50:05', '2024-11-18 19:50:05'),
(33, 70, 'percent', '11.00', '2024-11-19 00:00:00', '2024-11-21 00:00:00', 'pending', '2024-11-18 20:30:39', '2024-11-18 20:30:39'),
(35, 71, 'percent', '11.00', '2024-11-19 00:00:00', '2024-11-22 00:00:00', 'pending', '2024-11-18 20:42:10', '2024-11-18 20:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `comic_variants`
--

CREATE TABLE `comic_variants` (
  `id` int NOT NULL,
  `comic_id` int DEFAULT NULL,
  `format` enum('Bìa cứng','Bìa mềm') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `stock_quantity` int DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comic_variants`
--

INSERT INTO `comic_variants` (`id`, `comic_id`, `format`, `language`, `price`, `original_price`, `stock_quantity`, `publication_date`, `isbn`, `image`, `created_at`, `updated_at`) VALUES
(2, 68, 'Bìa cứng', 'tiếng anh pháp', '400000.00', '122313.00', 11, '2024-11-14', '43535665666488', '../uploads/variants/1732016673_466964285_549571631227324_6373781640164775592_n.jpg', '2024-11-19 11:44:33', '2024-11-19 11:44:33'),
(3, 70, 'Bìa cứng', 'tiếng anh pháp', '400000.00', '232133.00', 11, '2024-11-21', '4446433', '../uploads/variants/1732017155_466964285_549571631227324_6373781640164775592_n.jpg', '2024-11-19 11:52:35', '2024-11-19 11:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int NOT NULL,
  `user_id` int NOT NULL,
  `comics_id` int NOT NULL,
  `Content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Like` int DEFAULT '0',
  `Dislike` int DEFAULT '0',
  `Create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `Update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID`, `user_id`, `comics_id`, `Content`, `Like`, `Dislike`, `Create_at`, `Update_at`, `status`) VALUES
(1, 65, 68, 'dfgfdgdg', 0, 0, '2024-11-19 19:20:05', '2024-11-19 19:21:32', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('unpaid','paid','refunded','failed','processing') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'unpaid',
  `payment_method` enum('Credit Card','Cash on Delivery','Internet Banking','E-Wallet') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_status` enum('pending','delivering','delivered','returned','cancelled') DEFAULT 'pending',
  `shipping_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_amount`, `payment_status`, `payment_method`, `shipping_status`, `shipping_address`) VALUES
(33, 64, '2024-11-17 14:30:31', '7767.00', 'processing', 'Internet Banking', 'pending', 'f'),
(38, 64, '2024-11-18 17:29:09', '120000.00', 'processing', 'Credit Card', 'pending', 'hh');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `comic_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `unit_price`)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `comic_id`, `quantity`, `unit_price`) VALUES
(21, 33, 72, 2, '300000.00'),
(26, 38, 68, 2, '300000.00');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_comic`
--

CREATE TABLE `promotion_comic` (
  `id` int NOT NULL,
  `promotion_id` int DEFAULT NULL,
  `comic_variant_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_order`
--

CREATE TABLE `promotion_order` (
  `id` int NOT NULL,
  `promotion_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `comic_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` enum('very_bad','bad','average','good','excellent') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `comic_id`, `user_id`, `rating`, `review_text`, `created_at`, `status`) VALUES
(2, 68, 65, 'good', 'hay', '2024-11-19 12:29:15', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(64, 'cường 123', 'admin@gmail.com', '$2y$10$eH1X2wekZK5nXYel23Tsfu8zce7Ftzcft6FguFmA6WhR2QIApMnkO', '0768765499', '../uploads/user/default.jpg', 'user', '2024-11-12 16:49:03', '2024-11-14 10:49:03'),
(65, 'hobathanh', 'admin@gmail.com', '$2y$10$JCe8g5y/RInz7BYBxEO11u..an3LCeXLJa2CYpf6xfVIEmajxcNAW', '0699584855', '../uploads/user/default.jpg', 'user', '2024-11-12 16:50:30', '2024-11-12 16:50:30'),
(66, 'duong112', 'admin@gmail.com', '$2y$10$3nyZDEtsgDmnJ2iW9A6yVeE19CGDVyZc8WQ8h7BwZcrlcQ7kfU00y', '0768765444', '../uploads/user/default.jpg', 'user', '2024-11-12 16:50:56', '2024-11-12 16:50:56'),
(67, 'duong', 'thanhhbph50161@gmail.com', '$2y$10$09lBPPNDXi/tpKmpZ9uq0.Ytan5LilvFMssdiro/xh1/LXdQn6ZM.', '0768765499', '../uploads/user/default.jpg', 'user', '2024-11-17 07:48:23', '2024-11-17 07:48:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `comic_sales`
--
ALTER TABLE `comic_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `comic_variants`
--
ALTER TABLE `comic_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_comic`
--
ALTER TABLE `promotion_comic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `comic_variant_id` (`comic_variant_id`);

--
-- Indexes for table `promotion_order`
--
ALTER TABLE `promotion_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `comic_sales`
--
ALTER TABLE `comic_sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `comic_variants`
--
ALTER TABLE `comic_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_comic`
--
ALTER TABLE `promotion_comic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_order`
--
ALTER TABLE `promotion_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`);

--
-- Constraints for table `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `comics_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comics_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comic_sales`
--
ALTER TABLE `comic_sales`
  ADD CONSTRAINT `comic_sales_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comic_variants`
--
ALTER TABLE `comic_variants`
  ADD CONSTRAINT `comic_variants_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotion_comic`
--
ALTER TABLE `promotion_comic`
  ADD CONSTRAINT `promotion_comic_ibfk_1` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_comic_ibfk_2` FOREIGN KEY (`comic_variant_id`) REFERENCES `comic_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotion_order`
--
ALTER TABLE `promotion_order`
  ADD CONSTRAINT `promotion_order_ibfk_1` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
