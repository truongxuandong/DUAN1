-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2024 at 06:04 AM
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
(1, 'Tuần lộc', 'hihihi', '../uploads/banner/1732041742_dong1213.jpg', 1, 1, '2024-11-19 12:18:21', '2024-11-19 18:42:22');

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
(10, 'Hài hước', 'Manga mang tính giải trí và hài hước', '2024-11-15 17:43:38', '2024-11-15 17:43:38');

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
(68, 'THÁNH HIỆP SĨ NƠI TẬN CÙNG THẾ GIỚI', 5, 9, 'Đây là sự trừng phạt, hay …\r\n\r\nThiếu niên William chán nản và buông bỏ “cuộc sống”, được ban cho cuộc sống mới với một gia đình kì quái và bất thường. Cậu sống dưới sự che chở của 3 undead trong thành phố người chết đã bị diệt vong. Đó là kiếm sĩ xương phóng khoáng Blood, giáo sĩ xác ướp quý phái Mary và hồn ma pháp sư lập dị Gus.\r\n\r\nWilliam cảm thấy hối hận về kiếp trước của mình và quyết tâm sẽ “sống một lần nữa” ở thế giới mới, nơi cậu được tái sinh…\r\n\r\nĐược biết đến từ trang web “Hãy trở thành tiểu thuyết gia”, tác phẩm high fantasy theo phong cách kinh điển, bắt đầu!', '2024-01-15', '38800.00', '50000.00', 50, '../uploads/product/1732037929_anh3.jpg', '2024-11-15 17:52:47', '2024-11-19 17:57:09'),
(70, 'LÀM VIỆC TỪ XA, YÊU NHÀ HÀNG XÓM', 2, 10, 'Mitsuhashi Nokoru là một kĩ sư hệ thống đang sống cuộc đời của một nô lệ tư bản. Từ khi chuyển sang làm việc từ xa, chất lượng cuộc sống của anh được cải thiện ngoài sức tưởng tượng…! Một ngày nọ, trong lúc đang bố trí lại nội thất căn hộ và tỉa tót ban công, anh vô tình chạm mặt cô hàng xóm Izumi Natsu, một sinh viên cao học chuyên ngành khảo cổ.\r\n\r\nĐây là câu chuyện về một anh chàng nhờ làm việc tại nhà mà gặp được vợ tương lai, bị sức hút tự nhiên của cô làm cho điêu đứng, cho đến ngày hai người chính thức kết hôn.\r\n\r\nXin hân hạnh gửi đến các bạn độc giả tác phẩm truyện tranh one-shot Làm Việc Từ Xa, Yêu Nhà Hàng Xóm đến từ Kintetsu Yamada - tác giả của series Ase to Sekken.', '2024-06-07', '43000.00', '60000.00', 90, '../uploads/product/1732037853_anh2.jpg', '2024-11-15 17:52:47', '2024-11-19 17:38:12'),
(71, 'BÀI HỌC CUỘC SỐNG TỪ ', 8, 10, 'Anh chàng Uramichi - một MC chương trình thiếu nhi - luôn nở nụ cười tươi rói nhưng vẫn không che giấu nổi sự mệt mỏi của một người lớn sầu đời. Hằng ngày, Uramichi luôn vui vẻ cùng các bé hát múa, nhưng sau khi \"xả vai\", trong đầu anh chỉ có sự chán đời ủ ê. Những đồng nghiệp của Uramichi cũng chẳng khá hơn, mỗi người lại có nỗi niềm riêng. Nếu bạn cần tiếng cười và thêm sầu đời, thì đây là bộ truyện không thể bỏ qua!!', '2024-01-18', '32000.00', '48000.00', 66, '../uploads/product/1732037785_anh1.jpg', '2024-11-15 17:52:47', '2024-11-19 17:36:25'),
(72, 'DRAGON QUEST DẤU ẤN ROTO ', 6, 9, 'Trận quyết chiến cuối cùng với Đại Ma vương Zoma! Trước sức mạnh áp đảo của hắn, các Dũng sĩ và chiến binh thần thánh lần lượt gục ngã… Trong khi đó, tinh linh Rubiss đã đưa ra một quyết định để chuộc tội. Nhân cơ hội ấy, Đại Ma vương Zoma đã bao phủ thế giới trong bóng tối. Trong bóng tối hư vô, nhân loại không còn cách nào khác ngoài tin vào “hi vọng” và cầu nguyện…\r\n\r\nTin tưởng ánh sáng, tin tưởng con người, tin tưởng chính mình…\r\n\r\nKết thúc cuộc chiến, điều gì đang chờ đợi các thiếu niên!?\r\n\r\nTất cả sẽ được giải đáp trong tập cuối cùng của câu chuyện về những con người được đưa đường chỉ lối.', '2024-01-19', '50000.00', '64999.00', 34, '../uploads/product/1732037981_anh4.jpg', '2024-11-15 17:52:47', '2024-11-19 17:57:51'),
(74, 'Doraemon Movie Story Màu - Tân Nobita Và Nước Nhật Thời Nguyên Thủy', 10, 10, 'Nobita học hành bết bát nên luôn bị mẹ mắng. Vì kết quả kiểm tra quá tệ, cậu bị cấm đọc truyện, xem phim và không được đi đâu chơi! Trùng hợp thay, cả nhóm đồng lòng bỏ nhà đến Nhật Bản 70.000 năm trước đi bụi! Chuyến phiêu lưu li kì nào đang chờ họ ở đó…!?', '2024-01-21', '35000.00', '40000.00', 70, '../uploads/product/1732038208_anh6.jpg', '2024-11-15 17:52:47', '2024-11-19 18:00:09'),
(75, 'Đạo Làm Chồng Đảm - Tập 13', 4, 10, 'Tatsu cùng bố vợ tổ chức một chuyến cắm trại trên xe nhằm thắt chặt tình cảm giữa hai bố con. Chuyến đi này cũng là niềm mơ ước của ông cụ bấy lâu nay, tuy nhiên MỘT ÔNG CHÚ THÂN THIỆN LẠ HOẮC BỖNG GÕ CỬA ĐÒI CHEN NGANG!? Chuyện gì xảy ra sau đó, mời các bạn đón xem tập 13 sẽ rõ!', '2024-01-22', '29000.00', '39000.00', 77, '../uploads/product/1732037452_anh9.jpg', '2024-11-15 17:52:47', '2024-11-19 17:32:32'),
(76, 'Ông Bà Hồi Xuân - Tập 3', 8, 5, 'Bằng sức mạnh kì lạ của quả táo vàng, cặp vợ chồng Shozo - Ine đã hồi xuân.\r\n\r\nCả hai vẫn tiếp tục tận hưởng những ngày tháng đầm ấm, êm ả không chút xáo trộn. Nhưng bỗng một hôm, chỉ có mình Shozo là trở lại ngoại hình ông già như lúc trước!?\r\n\r\nNgoại hình thay đổi nhưng lối sống không đổi thay, cụ già nhưng xương gà cụ vẫn nhai như máy! Hãy đón đọc tập 3 của câu chuyện hài hước về cặp ông bà hồi xuân nhé!!', '2024-01-23', '80000.00', '100000.00', 60, '../uploads/product/1732037643_anh11.jpg', '2024-11-15 17:52:47', '2024-11-19 17:35:03'),
(79, 'Bạch Tuyết Tóc Đỏ - Tập 24', 8, 8, 'Buổi dạ hội bọn Obi thâm nhập bỗng xảy ra bất thường!? Trong khi mọi người dần mất đi tỉnh táo, lại có một vị phu nhân vẫn vững vàng từng bước rời khỏi hội trường. Eisetsu đã đơn độc đuổi theo người phụ nữ đó…!? Không chỉ vậy, trong căn phòng người đó vừa bước ra tràn ngập một mùi hương kì lạ… Tập 24 hé lộ những hồi ức cay đắng lay động cả tâm can!!', '2024-11-13', '30000.00', '44000.00', 43, '../uploads/product/1732038103_anh5.jpg', '2024-11-19 17:41:43', '2024-11-19 17:41:43'),
(80, 'Khi ', 2, 4, 'Liên tục bị số mệnh trêu chọc, cặp đôi luôn có chút khác biệt cuối cùng cũng bắt đầu tìm thấy điểm kết nối và dần tiến xa hơn trước. Dù chậm chạp vô cùng, nhưng chắc chắn mối quan hệ của họ đang có tiến triển… Trong khi đó, một cặp đôi khác đã có buổi “hẹn hò” đầu tiên!?\r\n\r\nĐây là câu chuyện tình yêu mới lạ đầy hài hước giữa 3 anh chàng (vô cùng tồ tẹt) và 3 cô nàng (hay thích giả trai)!', '2024-11-16', '48000.00', '60000.00', 40, '../uploads/product/1732039378_anh7.jpg', '2024-11-19 18:02:58', '2024-11-19 18:03:22'),
(81, 'Nàng Juliet Ở Trường Nội Trú', 6, 4, 'Inuzuka Romio và Juliet Persia đang hẹn hò nhưng không thể công khai. Hai người vốn hẹn nhau đi chơi vào ngày cuối cùng của lễ hội, song đã có sự cố vô cùng nghiêm trọng xảy ra: Mẹ của Persia đến thăm học viện! “Điều cấm kị nhất ở học viện” mà cô ấy nhắc đến đã mở ra một cục diện mới…\r\n\r\nTÌNH YÊU BỊ CẤM ĐOÁN NÀY SẼ ĐẢO LỘN THẾ GIỚI!', '2024-05-29', '35000.00', '50000.00', 67, '../uploads/product/1732039494_anh8.jpg', '2024-11-19 18:04:54', '2024-11-19 18:04:54'),
(82, 'Wind Breaker', 7, 3, 'Với mục đích trở thành kẻ đứng đầu của trường Fuurin, Sakura Haruka đã chuyển đến khu phố Tonpuu. Sau đó, cậu biết được về băng nhóm \"Boufuurin\" của trường. Dù họ là học sinh “đầu gấu” đến từ trường có điểm chuẩn lẹt đẹt, nhưng họ lại là những người hùng dùng sức mạnh nấm đấm để bảo vệ khu phố. Chính “Boufuurin” đã cho Sakura biết được ý nghĩa thực sực của sức mạnh và tình bạn, kéo cậu ra khỏi cái bóng của sự cô độc, từ đó Sakura quyết định sẽ bắt đầu chiến đấu để bảo vệ nơi ấy như một thành viên của Fuurin.', '2024-06-18', '49000.00', '65000.00', 78, '../uploads/product/1732039706_anh9.jpg', '2024-11-19 18:08:26', '2024-11-19 18:08:26'),
(83, 'Dragon Ball Super', 9, 8, 'Trunks bắt tay vào tìm hiểu nội dung chiếc đĩa CD lấy về từ vụ biệt thự bỏ hoang trên núi Butterfly. Tuy nhiên, một gã tiến sĩ bí ẩn đã cử tay sai của hắn là Betah thâm nhập vào trường cậu dưới dạng học sinh mới hòng, cướp lại chiếc đĩa. Phải chăng, quân đoàn Red Ribbon sắp hồi sinh!?', '2024-08-09', '25000.00', '34000.00', 45, '../uploads/product/1732039811_anh10.jpg', '2024-11-19 18:10:11', '2024-11-19 18:10:11');

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
(23, 68, 'percent', '4.00', '2024-11-20 00:00:00', '2024-11-21 00:00:00', 'pending', '2024-11-18 16:33:28', '2024-11-19 17:49:56'),
(28, 74, 'percent', '30.00', '2024-11-20 00:00:00', '2024-11-23 00:00:00', 'pending', '2024-11-18 19:50:05', '2024-11-19 17:50:52'),
(33, 76, 'percent', '19.00', '2024-11-20 00:00:00', '2024-11-28 00:00:00', 'pending', '2024-11-18 20:30:39', '2024-11-19 17:51:18'),
(35, 79, 'percent', '11.00', '2024-11-20 00:00:00', '2024-11-27 00:00:00', 'pending', '2024-11-18 20:42:10', '2024-11-19 17:52:09');

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
(2, 68, 'Bìa cứng', 'Tiếng Việt', '38800.00', '50000.00', 10, '2024-11-14', '43535665666488', '../uploads/variants/1732038343_anh3.jpg', '2024-11-19 11:44:33', '2024-11-19 17:45:43'),
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
(1, 65, 68, 'dfgfdgdg', 0, 0, '2024-11-19 19:20:05', '2024-11-19 21:29:36', 2);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_comment` (`user_id`),
  ADD KEY `fk_comics_commemt` (`comics_id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_rating` (`user_id`),
  ADD KEY `fk_comics_rating` (`comic_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comics_commemt` FOREIGN KEY (`comics_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_comics_rating` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_rating` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
