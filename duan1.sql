-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 10:26 AM
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
(1, 'Tuần lộc', 'hihihi', '../uploads/banner/1733326931_slide1.webp', 1, 0, '2024-11-19 12:18:21', '2024-12-04 15:42:11'),
(3, 'sgdsg', 'etgwet', '../uploads/banner/1733326940_slide2.webp', 1, 0, '2024-12-03 06:48:29', '2024-12-04 15:42:20'),
(4, 'etwet', 'ưetewt', '../uploads/banner/1733326949_slide3.jpg', 1, 0, '2024-12-03 06:57:19', '2024-12-04 15:42:29');

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
(2, 64, '2024-11-12 17:57:07', '2024-11-12 17:57:07'),
(16, 84, '2024-12-02 09:22:08', '2024-12-02 09:22:08');

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

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `comic_id`, `quantity`, `unit_price`) VALUES
(35, 16, 68, 1, '50000.00'),
(36, 16, 68, 1, '50000.00'),
(37, 16, 71, 2, '48000.00'),
(40, 16, 71, 1, '48000.00'),
(41, 16, 68, 1, '50000.00'),
(42, 16, 72, 1, '50000.00');

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
(68, 'Ninja Rantaro - Tập 42', 5, 9, '“Chào các cháu độc giả yêu quý! Nhắc đến mùa hè là nói đến biển, mà nói đến biển là phải nhắc đến thủy quân! Cho nên vừa rồi bác đã tới thăm nơi nghề săn bắt cá voi kiểu cổ ra đời. Bác đã đến viện bảo tàng cá voi của quận Taiji thuộc tỉnh Wakayama. Dưới sự phối hợp nhịp nhàng của nhóm săn cá, tàu Seko sẵn sàng đương đầu với những chú cá voi khổng lồ. Tàu có mũi nhọn, lướt sóng băng băng và nó trông giống hệt với tàu nhỏ chạy nhanh mà thủy quân thường dùng. Dù đối phương là tàu địch hay cá voi thì chúng vẫn là tàu chiến. Và một lần nữa bác lại được cảm nhận sự khắc nghiệt của những trận chiến trên biển.” – Soubee Amako', '2024-12-08', '40000.00', '40000.00', 80, '../uploads/product/1733647149_1.jpg', '2024-11-15 17:52:47', '2024-12-08 09:04:35'),
(70, 'Vườn Thú Omagadoki - Tập 4', 6, 8, 'Hana và mọi người rất vui mừng vì Shiina lại được hóa giải lời nguyền thêm một bộ phận nữa! Đúng lúc đó, Hana nhận được tin nhắn từ bạn, nhắc nhở về buổi học phụ đạo. Háo hức vì lâu lắm mới lại được đến trường, Hana bất chợt bị cuốn vào một cuộc thảo luận không ngờ từ Kikuchi…!? ', '2024-12-08', '60000.00', '60000.00', 90, '../uploads/product/1733647235_2.jpg', '2024-11-15 17:52:47', '2024-12-08 09:04:43'),
(71, 'Theo Dấu Mây Ngàn - Tập 6', 8, 3, 'KHÍ HẬU NÓNG ẨM SẼ “ĐÁNH THỨC” KEI\r\n\r\nMICHITAKA BỊ BẮT ĐI, TẬP 6 ĐẦY CHẤN ĐỘNG!\r\n\r\nSau khi hoàn thành công việc mà anh em họ lần đầu cộng tác, bỗng có hai nhân vật tự xưng là cảnh sát đến áp giải Michitaka đi mất. ngay trước mắt Kei... Tại thủ đô Reykjavík nằm ở cực bắc địa cầu, nơi “tuyết cứ rơi rồi lại tan”, một chàng trai người Nhật 17 tuổi đang phải đối diện với nỗi mất mát lớn nhất cuộc đời.\r\n\r\nTên cậu là Miyama Kei, nghề nghiệp: thám tử.', '2024-12-08', '48000.00', '48000.00', 49, '../uploads/product/1733647306_3.jpg', '2024-11-15 17:52:47', '2024-12-08 09:06:47'),
(72, 'Attack On Titan - Tập 19', 6, 8, 'Sau nhiều năm sống yên ổn sau những bức tường thành cao lừng lững, loài người đã bắt đầu cảm nhận được nguy cơ diệt vong đến từ một giống loài khổng lồ mang tên Titan. Dù muốn dù không, họ buộc phải đứng lên, và đã đứng lên một cách đầy quyết tâm, mạnh mẽ để chống lại những kẻ thù hùng mạnh nhất.\r\n\r\nThế rồi họ dần nhận ra bản chất thật sự của những kẻ thù khổng lồ kia...', '2024-12-08', '100000.00', '100000.00', 63, '../uploads/product/1733647414_4.jpg', '2024-11-15 17:52:47', '2024-12-08 09:56:31'),
(74, 'Shin Cậu Bé Bút Chì Truyện Dài', 7, 10, 'Với tài năng kể chuyện hấp dẫn, tác giả đã biến các trang sách của mình thành những sân chơi ngập tràn tiếng cười của những cô bé, cậu bé hồn nhiên và một thế giới tuổi thơ đa sắc màu. Những bài học giáo dục nhẹ nhàng, thấm thía cũng được lồng ghép một cách khéo léo trong từng tình huống truyện. Có thể Shin là một cậu bé cá tính, hiếu động. Có thể những trò tinh nghịch của Shin đôi khi quá trớn, chẳng chừa một ai. Nhưng sau những “sự cố” do Shin gây ra, người lớn thấy mình cần “quan tâm” đến trẻ con nhiều hơn nữa, các bạn đọc nhỏ tuổi chắc hẳn cũng được dịp nhìn nhận lại bản thân, để phân biệt điều tốt điều xấu trong cuộc sống.', '2024-12-08', '40000.00', '40000.00', 65, '../uploads/product/1733647511_5.jpg', '2024-11-15 17:52:47', '2024-12-08 09:06:05'),
(76, 'Yona - Công Chúa Bình Minh - Tập 12', 8, 1, 'Thủ lĩnh hào tộc Hazara của đế quốc Kai tiến quân chiếm đánh vương quốc Kuoka...! Yona sẽ làm gì để bảo vệ quê hương!?\r\n\r\nTaaph này cũng bao gồm chương truyện Tứ Long đại náo suối nước nóng với chủ đề “Sau tấm lưng ấy” và ngoại truyện đặc biệt về “Kija”.', '2024-12-08', '100000.00', '100000.00', 60, '../uploads/product/1733647601_6.jpg', '2024-11-15 17:52:47', '2024-12-08 09:06:36'),
(79, 'Yona - Công Chúa Bình Minh - Tập 11', 6, 8, 'Nhóm Yona lên đường tìm kiếm loại hoa màu có thể gieo trồng trên vùng đất khô cằn! Suốt chuyến hành trình, Hak tỏ ra khó chịu khi dạy Yona tập kiếm… Yona nhận ra Hak có vẻ gì đó khác hẳn thường ngày…\r\n\r\nNgoài ra còn có câu chuyện về tuổi thơ của Yona, Hak và Soo Won mười năm trước.', '2024-12-08', '120000.00', '120000.00', 43, '../uploads/product/1733647718_7.jpg', '2024-11-19 17:41:43', '2024-12-08 09:05:02'),
(80, 'Yona - Công Chúa Bình Minh - Tập 10', 2, 4, 'Yona và mọi người đã đóng giả đạo tặc để bảo vệ ngôi làng khỏi bè lũ quan binh hung bạo ở Hỏa Tộc. Trong lúc đó, thứ nam Kan Tae Jun của Trưởng Hỏa Tộc nhận lệnh tới làng Katan để bắt cướp lại vô tình nghe thấy tiếng của Yona, người đáng lí ra đã bỏ mạng dưới tay hắn! Vì sơ suất, Tae Jun đã vô tình gọi quan binh đến gần ngôi làng!?', '2024-12-08', '90000.00', '90000.00', 40, '../uploads/product/1733647784_8.jpg', '2024-11-19 18:02:58', '2024-12-08 08:49:44'),
(81, 'Yona - Công Chúa Bình Minh - Tập 9', 6, 4, 'Hoàng Long Zeno nhập bọn, cuối cùng Tứ Long đã tề tựu đông đủ. Nhóm Yona quay về nơi Yoon đã sinh ra - Hỏa Tộc. Dân chúng nơi đây sống trong nghèo khó vì sưu cao thuế nặng và đất đai cằn côi. Yona sẽ làm thế nào để chống lại bè lũ quan binh hung bạo!?', '2024-12-08', '50000.00', '50000.00', 67, '../uploads/product/1733647837_9.jpg', '2024-11-19 18:04:54', '2024-12-08 08:50:37'),
(82, 'Yona - Công Chúa Bình Minh - Tập 8', 7, 3, 'Yona đã bắn hạ gã bạo chúa Kum Ji và giải cứu thành Awa! Lục Long cũng đồng ý đi cùng nhóm, chiến binh rồng duy nhất còn lại là Hoàng Long! Mặt khác, vì không có chiến tranh nên Trưởng Thổ Tộc Geun Tae bắt đầu khó chịu trước việc không thể bảo vệ vương quốc. Rồi Soo Won đến thăm Geun Tae ở thành Chi Shin để mời ông đánh trận giả và đề nghị tổ chức lễ hội…!?', '2024-12-08', '50000.00', '50000.00', 33, '../uploads/product/1733647890_10.jpg', '2024-11-19 18:08:26', '2024-12-08 08:51:30'),
(83, 'Yona - Công Chúa Bình Minh - Tập 7', 9, 8, 'Để cứu Awa khỏi ách thống trị của gã bạo chúa Kum Ji, nhóm Yona đồng ý sát cánh cùng Lục Long và thuyền hải tặc. Yona cùng Yoon trà trộn vào đường dây buôn người! Trong lúc Hak và những người còn lại chiến đấu, Yona đã thành công bắn pháo hiệu, nhưng chuyện gì sẽ xảy ra khi quân thù bao vây cô…!?', '2024-12-08', '25000.00', '25000.00', 30, '../uploads/product/1733647943_11.jpg', '2024-11-19 18:10:11', '2024-12-08 09:03:57'),
(85, 'Yona - Công Chúa Bình Minh - Tập 6', 3, 10, 'Nhóm Yona đã gặp Lục Long Jae Ha ở phố cảng Awa. Yona tình nguyện hợp tác với Jae Ha và nhóm cướp biển để chống lại Yang Kum Ji, thuyền trưởng Gi Gan đã thử sức Yona xem cô có thật sự đáng tin cậy không… Liệu Yona có thể một mình đối diện và vượt qua thử thách để đem Thiên Thụ Thảo từ vách núi trở về…!?', '2024-12-08', '60000.00', '60000.00', 67, '../uploads/product/1733647994_12.jpg', '2024-12-08 08:21:45', '2024-12-08 09:04:18'),
(86, 'Yona - Công Chúa Bình Minh - Tập 5', 6, 1, 'Động đất bất ngờ ập đến làng của Thanh Long khiến nhóm của Yona bị mắc kẹt! Nhờ sự giúp đỡ của Thanh Long mà cả bọn đã thoát ra an toàn, Yona ngỏ lời mời cậu đồng hành cùng cô, quyết định của Thanh Long là…!? Mặt khác, Kija cảm nhận được khí của Lục Long, tất cả hướng về phía cảng Awa ở lãnh địa Thổ Tộc. Khi tới đó, Hak đã tình cờ gặp một chàng trai…?!', '2024-12-08', '80000.00', '80000.00', 67, '../uploads/product/1733648085_13.jpg', '2024-12-08 08:54:45', '2024-12-08 09:05:15'),
(87, 'Yona - Công Chúa Bình Minh - Tập 4', 6, 1, 'Nhóm Yona bắt đầu hành trình tìm kiếm bốn chiến binh rồng trong truyền thuyết! Tại làng Sương Mù, họ đã gặp được Bạch Long Kija – người sau đó đã thề một lòng trung thành với Yona và nhập bọn cùng nàng. Tất cả tiếp tục truy tìm Thanh Long dựa vào cảm quan có thể phát hiện những chiến binh rồng khác của Kija, nhưng trên đường đi, họ liên tục gặp phải rắc rối!? Sau bao khổ nạn, cuối cùng cả nhóm đã tìm ra ngôi làng của Thanh Long, tuy nhiên lại nhận được câu trả lời “Thanh Long không có ở đây”!?', '2024-12-08', '100000.00', '100000.00', 67, '../uploads/product/1733648142_14.jpg', '2024-12-08 08:55:42', '2024-12-08 09:05:24'),
(88, 'Yona - Công Chúa Bình Minh - Tập 3', 6, 1, '“Hãy đi tìm vị Thần Quan có thể tiên đoán tương lai” – Nghe xong câu nói ấy, Yona và Hak lập tức lên đường! Sau khi ngã xuống vực sâu vì bị truy binh đuổi theo, cả hai được một thiếu niên tên Yoon cùng người bảo hộ của cậu – Ik Soo cứu sống. Ngờ đâu thân phận thật sự của Ik Soo lại chính là Thần Quan!? Trước lời cầu xin muốn bảo vệ mạng sống của người mình trân quý, con đường mà Ik Soo chỉ ra cho Yona là…!?', '2024-12-08', '70000.00', '70000.00', 87, '../uploads/product/1733648218_15.jpg', '2024-12-08 08:56:58', '2024-12-08 09:05:33'),
(89, 'Yona - Công Chúa Bình Minh - Tập 2', 6, 1, 'Nàng công chúa Yona độc nhất của nước Kouka lớn lên trong sự bảo bọc của vua cha cùng người bạn thân từ thuở nhỏ kiêm hộ vệ - Hak. Nhưng vào ngày sinh nhật 16 tuổi, cuộc sống của Yona đã bị đảo lộn dưới tay người anh họ nàng thầm thương trộm nhớ – Soo Won!? Yona chạy trốn khỏi Hoàng cung, cùng Hak trở về cố hương của cậu – Thành Fuuga. Tại đây, vết thương lòng của nàng dần được chữa lành, thế nhưng… !? Mời các bạn đón đọc tập 2 của bộ truyện tranh lãng mạn giả tưởng.', '2024-12-08', '80000.00', '80000.00', 54, '../uploads/product/1733648278_16.jpg', '2024-12-08 08:57:58', '2024-12-08 09:05:41'),
(90, 'Yona - Công Chúa Bình Minh - Tập 1', 6, 1, 'Nàng công chúa Yona độc nhất của nước Kouka lớn lên trong sự bảo bọc của vua cha cùng người bạn thân từ thuở nhỏ kiêm hộ vệ - Hak. Vào ngày sinh nhật 16 tuổi, người anh họ Soo Won mà nàng thầm thương trộm nhớ đã đến chúc mừng khiến Yona rất đỗi vui mừng. Nhưng vận mệnh nghiệt ngã được báo trước đang chờ đón nàng…!? Và từ đây, câu chuyện lãng mạn giả tưởng về nàng công chúa vong quốc bắt đầu. ', '2024-12-08', '84000.00', '84000.00', 68, '../uploads/product/1733648378_17.jpg', '2024-12-08 08:59:38', '2024-12-08 09:05:56'),
(91, 'Thám Tử Lừng Danh Conan - Bản Nâng Cấp - Tập 8', 3, 2, 'Xém chút nữa là Ran đã phát hiện ra thân phận của tôi rồi! Cũng may ứng biến kịp nên nguy hiểm tạm qua đi, nhưng giá mà tôi có thể làm cho cô ấy yên tâm hơn thì tốt biết mấy…\r\n\r\nTôi đâu phải không muốn trở lại là Kudo Shinichi, nhưng cứ hết vụ án này đến vụ án khác xảy ra khiến tôi chẳng còn tâm trí nghĩ đến chuyện đó nữa!! Rồi bỗng nhiên, “Nam tước bóng đêm” từ trên trời đáp xuống!!', '2024-12-08', '35000.00', '35000.00', 58, '../uploads/product/1733648439_18.jpg', '2024-12-08 09:00:39', '2024-12-08 09:04:27'),
(92, 'Chị Chion Ở Đền Mèo - Tập 8', 1, 3, 'Đón Tết tại đền mèo!!!\r\n\r\nĐiều quan trọng không phải là làm gì, mà là được ở bên cạnh ai... Những khoảnh khắc quý giá ấy trôi qua một cách nhẹ nhàng.\r\n\r\nCha mẹ của Chion xuất hiện! Chén rượu đầu tiên sau lễ thành niên. Lễ tốt nghiệp và cuộc sống mới. Và cả tương lai của ngôi đền.\r\n\r\nQuyết định cuối cùng của Chion là...?', '2024-12-08', '42000.00', '42000.00', 67, '../uploads/product/1733648522_19.jpg', '2024-12-08 09:02:02', '2024-12-08 09:04:08'),
(93, 'Dragon Ball Super - Tập 22', 9, 8, 'Piccolo vô tình biết được thông tin Red Ribbon đang nuôi âm mưu thôn tính Địa Cầu. Để thực hiện kế hoạch đó, chúng đã dụ dỗ Dr. Hedo về phe mình. Nhận thấy mối đe doạ lớn từ Son Goku và các bạn, Magenta quyết tâm triệt hạ Son Gohan, con trai của Goku.', '2024-12-08', '20000.00', '20000.00', 57, '../uploads/product/1733648600_20.jpg', '2024-12-08 09:03:20', '2024-12-08 09:03:20'),
(94, 'Boruto - Naruto Hậu Sinh Khả Úy - Tập 20', 3, 3, 'Ada đã bắt đầu cuộc sống tại làng Lá và còn tổ chức một buổi trò chuyện riêng với Sarada và Sumire. Các cô nàng sẽ tâm sự gì với nhau? Cùng lúc ấy, cảm nhận được sự tồn tại của Momoshiki bên trong Boruto, Kawaki đã hạ quyết tâm… Boruto và làng Lá sắp phải đối diện với biến cố lớn!!', '2024-12-08', '25000.00', '25000.00', 59, '../uploads/product/1733648874_21.jpg', '2024-12-08 09:07:54', '2024-12-08 09:07:54'),
(95, 'Thánh Hiệp Sĩ Nơi Tận Cùng Thế Giới - Tập 2', 8, 7, 'Cậu bé Will sinh ra với kí ức từ thế giới khác và được nuôi dưỡng bởi 3 undead, sẽ chào đón tuổi trưởng thành vào ngày Đông chí này. Cậu sẽ có trận quyết đấu với kiếm sĩ xương Blood, một trong những người đã nuôi nấng cậu. Will đã tận dụng triệt để những gì học được từ giáo sĩ xác ướp Mary, hồn ma pháp sư Gus và cả Blood để chiến đấu hết mình… Sau trận chiến, Will biết được sự thật về thành phố đổ nát và xuất thân trước nay vẫn được giấu kín của mình, đồng thời biết cả khế ước mà 3 undead đã trao đổi với một vị “Thần” trong quá khứ.\r\n\r\nĐược biết đến từ trang web “Hãy trở thành tiểu thuyết gia”, tác phẩm high fantasy theo phong cách kinh điển với nhiều biến động ở tập 2!', '2024-12-08', '40000.00', '40000.00', 90, '../uploads/product/1733648942_22.jpg', '2024-12-08 09:09:02', '2024-12-08 09:09:02'),
(96, 'Học Viện Siêu Anh Hùng Vigilantes - Tập 10', 10, 5, 'Cô nàng POP mất tích bấy lâu naybỗng dưng xuất hiện dưới nhân dạng một Villain! Dạo gần đây tôi chẳng thể nói lời nào với cô ấy. Rốt cuộc đã có chuyện gì xảy ra với cô ấy mà tôi không hề hay biết? Làm ơn đấy, POP! Hãy trở lại thành một cô gái dịu dàng, tốt bụng như trước kia đi mà. Là tôi đây, người đàn ông thích nghe cô ca hát, người muốn mang lại nụ cười cho cô gái luôn sẵn lòng giúp đỡ người khác, The Crawler đây!!', '2024-12-08', '30000.00', '30000.00', 69, '../uploads/product/1733649219_23.jpg', '2024-12-08 09:13:39', '2024-12-08 09:13:39'),
(97, 'Câu Lạc Bộ Những Kẻ Mất Ngủ - Tập 10', 3, 4, '“Nakami, cười thật tươi nào.”\r\n\r\nSau khi hồi phục và khỏe khoắn hơn hẳn, Isaki đã đón mùa đông đầu tiên với Ganta. Cùng lúc đó, Shiromaru đã mở tiệc thịt cua nhân dịp cuối năm cùng với cô giáo Kurashiki tại nhà riêng. Và rồi vào sáng ngày mồng 1, cả nhóm đã tập trung trước cửa tiệm game ngập tuyết!?\r\n\r\nSau khi đi chùa cầu nguyện vào đầu năm… thứ mà Isaki đã dốc hết tiền lì xì tiết kiệm trước giờ để mua chính là…?\r\n\r\nChưa hết, lí do mẹ Isaki bật khóc là gì…? Và cuộc hẹn về đêm bí mật mà tại đó, Isaki với Ganta đã cùng hẹn ước về tương lai… Tất cả sẽ được tiết lộ trong tập này.', '2024-12-08', '40000.00', '40000.00', 37, '../uploads/product/1733649444_24.jpg', '2024-12-08 09:17:24', '2024-12-08 09:50:22'),
(98, 'Soul Eater - Tập 14', 4, 7, 'Câu chuyện kể về cuộc phiêu lưu của Maka Albarn và vũ khí lưỡi hái khổng lồ của cô, Soul Eater. Khi đang làm nhiệm vụ ở Ý, cả hai bị vướng vào những âm mưu của mụ phù thủy Medusa, đó là hồi sinh Kishin, một sinh vật điên loạn sẽ hóa thành ác quỷ sau khi tiêu thụ linh hồn của người vô tội. Sau trận chiến dữ dội với đứa con của Medusa, Crona, Maka và Soul trở về Thành phố Chết và hợp tác với các đối thủ là Black Star và Death the Kid để chiến đấu chống lại Medusa.', '2024-12-08', '80000.00', '80000.00', 59, '../uploads/product/1733651981_25.jpg', '2024-12-08 09:59:41', '2024-12-08 09:59:41'),
(99, 'Nàng Juliet Ở Trường Nội Trú - Tập 9', 2, 1, 'Đang hẹn hò tuy không thể công khai, Inuzuka Romio và Persia Juliet đã lên đường du lịch đến Towa. Persia hóa trang thành Julio và nghỉ lại nhà Inuzuka, nhưng run rủi thay cô đã bị đánh hơi ra thân phận thật sự! Hai người phải làm thế nào để đánh bay nỗi hiềm nghi đây…?\r\n\r\nCâu chuyện tình yêu bùng nổ trong chuyến du lịch đến Towa ngộp thở!!!', '2024-12-08', '35000.00', '35000.00', 58, '../uploads/product/1733652076_26.jpg', '2024-12-08 10:01:16', '2024-12-08 10:01:16'),
(100, 'Saiyuki - Tập 1', 8, 6, 'Câu chuyện diễn ra tại một vùng đất mang tên Tougenkyou - chốn Đào Nguyên - nơi con người và yêu quái chung sống hòa bình. Bỗng một ngày, có kẻ muốn dùng thứ bùa phép bị cấm kỵ - \"sự kết hợp giữa hóa học và yêu thuật\" để hồi sinh đại yêu quái Ngưu Ma Vương. Bị ảnh hưởng bởi bùa phép, các yêu quái đột ngột phát điên, mất khả năng tự chủ và bắt đầu tấn công con người. Trước tình hình đó, các vị thần đã hạ lệnh cho Genjo Sanzo cùng 3 con yêu quái khác lên đường đến phía Tây Để tìm lại sự yên bình cho Tougenkyou.', '2024-12-08', '50000.00', '50000.00', 78, '../uploads/product/1733652144_27.jpg', '2024-12-08 10:02:24', '2024-12-08 10:02:24'),
(101, 'Xóm Trọ Yêu Quái - Tập 23', 8, 3, 'Inaba Yuushi chuyển đến một nhà trọ xinh đẹp với giá rẻ bất ngờ. Trớ trêu thay, đây lại là nhà trọ yêu thích của giới yêu quái và các pháp sư trừ tà. Cuộc sống của cậu cũng vì thế mà xáo trộn cả lên. Tuy nhiên, qua quá trình tiếp xúc, cậu dần nhận ra dù là người hay yêu ma thì họ vẫn có những phẩm chất tốt đẹp để cậu học tập.', '2024-12-08', '45000.00', '45000.00', 24, '../uploads/product/1733652229_28.jpg', '2024-12-08 10:03:49', '2024-12-08 10:03:49'),
(102, 'Phù Thủy Và Dã Thú - Tập 5', 2, 8, 'Câu chuyện mở đầu với bối cảnh ở một thị trấn yên bình, nơi có một phù thuỷ được dân chúng ca tụng là anh hùng. Tuy nhiên, cặp đôi cộng sự kỳ lạ Ashaf trầm tính và Guideau cộc cằn với phương châm: “Nơi nào có phù thuỷ, nơi đó sẽ kéo theo lời nguyền và tai ương”, đã nhận ra bộ mặt thật của phù thuỷ ở thị trấn này và cùng nhau lật tẩy âm mưu của ả.\r\n\r\nXuyên suốt hành trình cùng nhau săn lùng ả phù thuỷ đã nguyền rủa Guideau để phá giải lời nguyền trên người cô là những vụ án ly kỳ và hấp dẫn về phù thuỷ trong thế giới phép thuật đậm phong cách Gothic.', '2024-12-08', '42000.00', '42000.00', 56, '../uploads/product/1733652352_29.jpg', '2024-12-08 10:05:52', '2024-12-08 10:05:52'),
(103, 'Đạo Làm Chồng Đảm - Tập 13', 9, 10, 'Tatsu cùng bố vợ tổ chức một chuyến cắm trại trên xe nhằm thắt chặt tình cảm giữa hai bố con. Chuyến đi này cũng là niềm mơ ước của ông cụ bấy lâu nay, tuy nhiên MỘT ÔNG CHÚ THÂN THIỆN LẠ HOẮC BỖNG GÕ CỬA ĐÒI CHEN NGANG!? Chuyện gì xảy ra sau đó, mời các bạn đón xem tập 13 sẽ rõ!', '2024-12-08', '30000.00', '30000.00', 45, '../uploads/product/1733652498_30.jpg', '2024-12-08 10:07:02', '2024-12-08 10:08:18'),
(104, 'Ông Bà Hồi Xuân - Tập 3', 5, 1, 'Bằng sức mạnh kì lạ của quả táo vàng, cặp vợ chồng Shozo - Ine đã hồi xuân.\r\n\r\nCả hai vẫn tiếp tục tận hưởng những ngày tháng đầm ấm, êm ả không chút xáo trộn. Nhưng bỗng một hôm, chỉ có mình Shozo là trở lại ngoại hình ông già như lúc trước!?\r\n\r\nNgoại hình thay đổi nhưng lối sống không đổi thay, cụ già nhưng xương gà cụ vẫn nhai như máy! Hãy đón đọc tập 3 của câu chuyện hài hước về cặp ông bà hồi xuân nhé!!', '2024-12-08', '85000.00', '85000.00', 56, '../uploads/product/1733652482_31.jpg', '2024-12-08 10:08:02', '2024-12-08 10:08:02'),
(105, 'Tuổi Xanh Rực Rỡ', 7, 5, 'Tình cờ nghe được tin đồn Hiyama định bỏ chơi bóng chày, Oshima vô cùng thấp thỏm dù vẫn nhủ lòng đó là điều không thể. Thế rồi cậu nhận được lời cảnh cáo rằng bản thân đang “gây cản trở”...\r\n\r\nTrong lúc bộn bề suy nghĩ, Oshima đã tới cổ vũ cho Hiyama trong trận tranh vé vòng loại của giải bóng chày toàn quốc. Lần đầu được thấy dáng vẻ trên sân của “át chủ bài” CLB bóng chày, sự xuất sắc của người kia đã thôi thúc cậu quyết tâm chấm dứt mối quan hệ này.\r\n\r\nVà lời từ giã đơn phương đã được trao ngay sau lễ tốt nghiệp. Tương lai của đôi trẻ vụng về trong tình yêu ấy rốt cục sẽ ra sao?\r\n\r\nMời các bạn đón đọc Tuổi Xanh Rực Rỡ - phần ngoại truyện xoay quanh cuộc sống của đôi trẻ khi hai người đã trưởng thành hơn một chút!', '2024-12-08', '89000.00', '89000.00', 34, '../uploads/product/1733652556_32.jpg', '2024-12-08 10:09:16', '2024-12-08 10:09:16'),
(106, 'Attack On Titan - Tập 18', 2, 8, 'Sau nhiều năm sống yên ổn sau những bức tường thành cao lừng lững, loài người đã bắt đầu cảm nhận được nguy cơ diệt vong đến từ một giống loài khổng lồ mang tên Titan. Dù muốn dù không, họ buộc phải đứng lên, và đã đứng lên một cách đầy quyết tâm, mạnh mẽ để chống lại những kẻ thù hùng mạnh nhất.\r\n\r\nThế rồi họ dần nhận ra bản chất thật sự của những kẻ thù khổng lồ kia...', '2024-12-08', '48000.00', '48000.00', 78, '../uploads/product/1733652646_33.jpg', '2024-12-08 10:10:46', '2024-12-08 10:10:46'),
(107, 'Bạch Tuyết Tóc Đỏ - Tập 24', 6, 6, 'Bạch Tuyết Tóc Đỏ - Tập 24', '2024-12-08', '30000.00', '30000.00', 56, '../uploads/product/1733652758_34.jpg', '2024-12-08 10:12:38', '2024-12-08 10:12:38'),
(108, 'Lời Hứa Lọ Lem - Tập 4', 10, 4, 'Hayame đã mất đi mái nhà lẫn cuộc sống nội trợ sau khi li hôn. Vào thời điểm đen tối nhất, cô đã gặp cậu nhóc cấp 3 giàu có Issei và được cho ở lại nhà cậu ta với điều kiện phải tham gia “trò chơi cuộc đời” do Issei đề ra. Dần dà, hai người đã thân thiết với nhau hơn, nhưng Hayame đã quyết định nửa năm sau sẽ rời khỏi nhà Issei, khiến Issei bắt đầu hốt hoảng vì thời gian ở chung của cả hai không còn nhiều. Mặt khác, anh trai của Issei kiêm phó giám đốc nhà trọ lại xuất hiện ở chỗ làm rồi bất ngờ mời Hayame đi dùng bữa tại một nhà hàng sang trọng!!?', '2024-12-08', '40000.00', '40000.00', 67, '../uploads/product/1733652835_35.jpg', '2024-12-08 10:13:55', '2024-12-08 10:13:55'),
(109, 'Lời Hứa Lọ Lem - Tập 3', 10, 3, 'Hayame đã mất đi mái nhà lẫn cuộc sống nội trợ sau khi li hôn. Vào thời điểm đen tối nhất, cô đã gặp cậu nhóc cấp 3 giàu có Issei và được cho ở lại nhà cậu ta với điều kiện phải tham gia “trò chơi cuộc đời” do Issei đề ra.\r\n\r\nThử thách trò chơi lần này là “trừng trị tên quấy rối Koya trước mặt bàn dân thiên hạ”!!!?\r\n\r\nTuy rất bối rối khi bị ép phải thực hiện hành động vô lí trên, nhưng không hiểu sao Hayame lại hợp tác với Koya khiến Issei mới là người cảm thấy xấu hổ!!!?', '2024-12-08', '40000.00', '40000.00', 89, '../uploads/product/1733652968_36.jpg', '2024-12-08 10:16:08', '2024-12-08 10:16:08'),
(110, 'Attack On Titan - Tập 17', 3, 8, 'Sau nhiều năm sống yên ổn sau những bức tường thành cao lừng lững, loài người đã bắt đầu cảm nhận được nguy cơ diệt vong đến từ một giống loài khổng lồ mang tên Titan. Dù muốn dù không, họ buộc phải đứng lên, và đã đứng lên một cách đầy quyết tâm, mạnh mẽ để chống lại những kẻ thù hùng mạnh nhất.\r\n\r\nThế rồi họ dần nhận ra bản chất thật sự của những kẻ thù khổng lồ kia...', '2024-12-08', '48000.00', '48000.00', 67, '../uploads/product/1733653038_37.jpg', '2024-12-08 10:17:18', '2024-12-08 10:17:18'),
(111, 'Wind Breaker - Tập 3', 6, 4, 'Với mục đích trở thành kẻ đứng đầu của trường Fuurin, Sakura Haruka đã chuyển đến khu phố Tonpuu. Sau đó, cậu biết được về băng nhóm \"Boufuurin\" của trường. Dù họ là học sinh “đầu gấu” đến từ trường có điểm chuẩn lẹt đẹt, nhưng họ lại là những người hùng dùng sức mạnh nấm đấm để bảo vệ khu phố. Chính “Boufuurin” đã cho Sakura biết được ý nghĩa thực sực của sức mạnh và tình bạn, kéo cậu ra khỏi cái bóng của sự cô độc, từ đó Sakura quyết định sẽ bắt đầu chiến đấu để bảo vệ nơi ấy như một thành viên của Fuurin.', '2024-12-08', '45000.00', '45000.00', 45, '../uploads/product/1733653197_38.jpg', '2024-12-08 10:19:57', '2024-12-08 10:19:57'),
(112, 'Chúa Tể Bóng Tối - Tập 7 (Manga)', 8, 7, 'TRUYỆN TRANH CHUYỂN THỂ TỪ BỘ LIGHT-NOVEL “CHÚA TỂ BÓNG TỐI” RẤT ĐƯỢC YÊU THÍCH!!\r\n\r\nCậu thiếu niên Cid sau khi chuyển sinh sang thế giới khác vẫn tiếp tục chơi trò nhập vai Chúa tể Bóng tối, can thiệp vào mọi biến cố và bộc lộ sức mạnh thực sự của mình từ trong màn đêm. Với mục tiêu thảo phạt Ma cà rồng Tuỷ tổ “Huyết Nữ Vương”, Cid bị chị gái Claire lôi đến Vô Luật Tành. Tại vùng đất nổi danh với tình trạng trị an vô cùng kém này, Cid nhận ra mình sẽ quá nổi bật nếu tiếp tục vào vai “dân quèn” như mọi khi. Cậu nổi hứng nhập vai một thanh niên bí ẩn nở nụ cười nham hiểm trước cảnh tượng bạo loạn tàn sát. Giữa lúc đang khoái chí tận hưởng, vầng “Trăng Máu” truyền thuyết treo trên đầu Cid như thể báo hiệu một điềm xấu sắp xảy đến.\r\n\r\nXin hân hạnh gửi đến các bạn độc giả phiên bản chuyển thể truyện tranh đặc sắc của bộ light-novel ăn khách CHÚA TỂ BÓNG TỐI!', '2024-12-08', '40000.00', '40000.00', 78, '../uploads/product/1733653295_39.jpg', '2024-12-08 10:21:35', '2024-12-08 10:21:35'),
(113, 'Bluelock - Tập 24', 10, 3, 'CHỈ TRONG “KHOẢNH KHẮC” THÔI LÀ KHÔNG ĐỦ! “CHIẾN THẮNG HOÀN TOÀN” MỚI LÀ THỨ CẦN PHẢI THEO ĐUỔI!!\r\nĐội Đức đã hạ gục đội Anh nhờ pha phối hợp sút bóng của Isagi và Yukimiya. Isagi đang chăm chỉ luyện tập hơn nữa để định hình lí thuyết “hoàn hảo” của mình, nhằm đánh bại Kaiser bằng bàn thắng của bản thân vào lần tới. Trái ngược hẳn với điều đó thì Hiori, người vẫn chưa được ra sân lại mang một vẻ mặt chán nản. “Quá khứ” được chôn giấu trong lòng Hiori là gì, và đâu mới là “cảm xúc thực sự” cậu dành cho bóng đá? Đối thủ trong trận đấu tiếp theo của đội Đức chính là đội bóng mà Baro đầu quân, Ý! 11 cầu thủ ra sân trong trận đấu được mọi ánh mắt đổ dồn vào sẽ là ai đây!?\r\nBẮT ĐẦU TRẬN ĐẤU THỨ 5 VỚI UBERS! MỌI THỨ SẼ ĐƯỢC CHỨNG MINH BẰNG “BÀN THẮNG”! VÀ TÔI MỚI LÀ “TIỀN ĐẠO THỰC THỤ”!!', '2024-12-08', '35000.00', '35000.00', 90, '../uploads/product/1733653405_40.jpg', '2024-12-08 10:23:25', '2024-12-08 10:24:36');

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
(28, 74, 'percent', '30.00', '2024-12-08 00:00:00', '2024-12-30 00:00:00', 'active', '2024-11-18 19:50:05', '2024-12-08 09:23:48'),
(33, 76, 'percent', '19.00', '2024-12-08 00:00:00', '2024-12-27 00:00:00', 'active', '2024-11-18 20:30:39', '2024-12-08 09:25:49'),
(35, 79, 'percent', '11.00', '2024-12-08 00:00:00', '2024-12-26 00:00:00', 'active', '2024-11-18 20:42:10', '2024-12-08 09:25:26'),
(41, 70, 'percent', '10.00', '2024-12-08 00:00:00', '2024-12-27 00:00:00', 'active', '2024-11-23 15:44:11', '2024-12-08 09:26:13'),
(42, 72, 'percent', '16.00', '2024-12-08 00:00:00', '2024-12-28 00:00:00', 'active', '2024-11-23 15:44:11', '2024-12-08 09:24:05'),
(44, 80, 'percent', '15.00', '2024-12-08 00:00:00', '2024-12-26 00:00:00', 'active', '2024-11-23 16:40:34', '2024-12-08 09:25:10'),
(45, 81, 'percent', '32.00', '2024-12-08 00:00:00', '2024-12-20 00:00:00', 'active', '2024-11-23 16:41:37', '2024-12-08 09:26:01'),
(46, 83, 'percent', '19.00', '2024-12-08 00:00:00', '2024-12-27 00:00:00', 'active', '2024-11-23 16:42:47', '2024-12-08 09:24:33'),
(47, 82, 'percent', '20.00', '2024-11-23 00:00:00', '2024-11-27 00:00:00', 'inactive', '2024-11-23 16:46:02', '2024-11-27 16:15:42');

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
(3, 70, 'Bìa cứng', 'tiếng anh pháp', '40000.00', '40000.00', 11, '2024-11-21', '4446433', '../uploads/variants/1732017155_466964285_549571631227324_6373781640164775592_n.jpg', '2024-11-19 11:52:35', '2024-11-25 17:54:43'),
(4, 68, 'Bìa cứng', 'tiếng anh pháp', '350000.00', '350000.00', 2, '2024-11-20', '43535665666466', '../uploads/variants/1732300085_438302545_405722932385996_8603681128062131888_n.jpg', '2024-11-22 18:28:05', '2024-11-23 17:40:56'),
(5, 68, 'Bìa cứng', 'tiếng anh lon', '350000.00', '350000.00', 2312, '2024-11-27', '4446433', '../uploads/variants/1732304429_Ảnh chụp màn hình 2023-12-08 230032.png', '2024-11-22 19:40:21', '2024-11-23 17:40:56'),
(6, 97, 'Bìa mềm', 'Tiếng Việt', '40000.00', '40000.00', 70, '2024-12-08', '7834724839248', '../uploads/variants/1733650345_024.jpg', '2024-12-08 09:29:06', '2024-12-08 09:32:25'),
(7, 96, 'Bìa cứng', 'Tiếng Việt', '30000.00', '30000.00', 59, '2024-12-08', '7834724839248', '../uploads/variants/1733650510_023.jpg', '2024-12-08 09:35:10', '2024-12-08 09:35:10'),
(8, 95, 'Bìa mềm', 'Tiếng Việt', '40000.00', '40000.00', 57, '2024-12-08', '7834724839248', '../uploads/variants/1733650617_022.jpg', '2024-12-08 09:36:57', '2024-12-08 09:36:57'),
(9, 93, 'Bìa cứng', 'Tiếng Việt', '25000.00', '25000.00', 58, '2024-12-08', '7834724839248', '../uploads/variants/1733650780_021.jpg', '2024-12-08 09:39:40', '2024-12-08 09:39:40'),
(10, 92, 'Bìa mềm', 'Tiếng Việt', '50000.00', '50000.00', 48, '2024-12-08', '7834724839248', '../uploads/variants/1733650932_019.jpg', '2024-12-08 09:42:12', '2024-12-08 09:42:12'),
(11, 71, 'Bìa cứng', 'Tiếng Việt', '55000.00', '55000.00', 67, '2024-12-08', '7834724839248', '../uploads/variants/1733651094_03.jpg', '2024-12-08 09:44:54', '2024-12-08 09:44:54'),
(12, 113, 'Bìa mềm', 'Tiếng Việt', '35000.00', '35000.00', 90, '2024-12-08', '7834724839248', '../uploads/variants/1733653431_040.jpg', '2024-12-08 10:23:51', '2024-12-08 10:23:51');

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
(2, 84, 72, 'hay', 0, 0, '2024-12-01 21:06:51', '2024-12-01 21:06:51', 2),
(3, 86, 71, 'sfasf', 0, 0, '2024-12-03 12:27:24', '2024-12-03 12:27:24', 2),
(4, 86, 72, 'gsg', 0, 0, '2024-12-04 22:42:50', '2024-12-04 22:42:50', 2),
(5, 86, 68, 'sdgsdg', 0, 0, '2024-12-06 18:41:06', '2024-12-06 18:41:06', 2),
(6, 86, 68, 'sgsgd', 0, 0, '2024-12-06 18:51:55', '2024-12-06 18:51:55', 2),
(7, 86, 68, 'asfaf', 0, 0, '2024-12-06 18:52:59', '2024-12-06 18:52:59', 2),
(8, 86, 68, 'sdgsdg', 0, 0, '2024-12-06 23:23:24', '2024-12-06 23:23:24', 2),
(9, 83, 97, 'hay quá đi', 0, 0, '2024-12-08 16:51:11', '2024-12-08 16:51:11', 2),
(10, 83, 113, 'hay', 0, 0, '2024-12-08 17:24:49', '2024-12-08 17:24:49', 2);

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
  `payment_method` enum('CREDIT','COD','BANKING','MOMO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_status` enum('pending','delivering','delivered','returned','cancelled') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `phone_car` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_amount`, `payment_status`, `payment_method`, `shipping_status`, `shipping_address`, `receiver_name`, `phone_car`) VALUES
(90, 86, '2024-12-01 14:52:38', '100000.00', 'unpaid', 'COD', 'delivered', 'dsfdsf', 'Trương xuân đông', '0865819798'),
(91, 86, '2024-12-01 14:53:04', '96000.00', 'processing', 'BANKING', 'returned', 'dfdsfsdfs', 'Trương xuân đông', '0865819798'),
(92, 84, '2024-12-01 14:53:26', '126000.00', 'processing', 'BANKING', 'pending', 'sdsasad', 'Trương xuân đông', '0865819798'),
(93, 84, '2024-12-01 15:04:33', '56000.00', 'processing', 'MOMO', 'pending', 'dsffdsfdfsd', 'Trương xuân đông', '0865819798'),
(94, 84, '2024-12-01 15:06:28', '0.00', 'processing', 'MOMO', 'pending', 'dfsdsdsf', 'Trương xuân đông', '0865819798'),
(103, 84, '2024-12-01 16:16:57', '48000.00', 'unpaid', 'COD', 'delivering', 'fgdfgfdf', 'Trương xuân đông', '0865819798'),
(104, 84, '2024-12-01 16:40:27', '50000.00', 'unpaid', 'COD', 'pending', 'ddsfdsf', 'nguyễn phú tuấn', '0865819798'),
(105, 84, '2024-12-01 16:42:05', '50000.00', 'unpaid', 'COD', 'pending', 'fgffdggdf', 'Trương xuân đông', '0865819798'),
(106, 84, '2024-12-01 16:49:29', '450000.00', 'processing', 'MOMO', 'pending', 'dsdfdsf', 'nguyễn phú tuấn', '0865819798'),
(107, 84, '2024-12-01 16:56:24', '100000.00', 'processing', 'BANKING', 'pending', 'dfsdsfd', 'nguyễn phú tuấn', '0865819798'),
(108, 84, '2024-12-01 17:01:56', '1298000.00', 'unpaid', 'COD', 'pending', 'fdfdgfdg', 'Trương xuân đông', '0865819798'),
(109, 84, '2024-12-02 11:20:45', '96000.00', 'processing', 'MOMO', 'pending', 'ewrewerew', 'nguyễn phú tuấn', '0865819798'),
(110, 84, '2024-12-02 14:34:23', '48000.00', 'unpaid', 'COD', 'pending', 'hn', 'nguyễn phú tuấn', '0865819798'),
(111, 84, '2024-12-02 15:50:09', '25000.00', 'unpaid', 'COD', 'pending', 'ưerwre', 'nguyễn phú tuấn', '0865819798'),
(112, 84, '2024-12-03 03:47:31', '80000.00', 'processing', 'MOMO', 'pending', 'hdhdhdh', 'Tuấn con', '0976287625'),
(113, 86, '2024-12-03 11:50:44', '48000.00', 'unpaid', 'COD', 'cancelled', 'asfafs', 'fasf', '0987654312'),
(114, 86, '2024-12-03 11:50:44', '50000.00', 'unpaid', 'COD', 'cancelled', 'asfafs', 'fasf', '0987654312'),
(115, 86, '2024-12-04 16:56:25', '0.00', 'processing', 'COD', 'cancelled', 'sgdsdg', 'gsdgsd', '0987654312'),
(116, 86, '2024-12-04 16:57:36', '0.00', 'processing', 'COD', 'cancelled', 'sggsag', 'sfasf', '0987654312'),
(117, 86, '2024-12-06 15:37:25', '50000.00', 'unpaid', 'COD', 'cancelled', 'sgsegew', 'sgg', '0126548854'),
(118, 83, '2024-12-08 09:50:22', '80000.00', 'paid', 'COD', 'delivered', 'hihihi', 'Trương xuân đông', '0865819798'),
(119, 83, '2024-12-08 09:56:31', '168000.00', 'paid', 'MOMO', 'delivered', 'hghghghg', 'Trương Xuân Đông', '0865819798');

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
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `unit_price`)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `comic_id`, `quantity`, `unit_price`, `title`, `image`) VALUES
(49, 90, 68, 2, '50000.00', NULL, NULL),
(50, 91, 71, 2, '48000.00', NULL, NULL),
(51, 92, 72, 3, '42000.00', NULL, NULL),
(52, 93, 74, 2, '28000.00', NULL, NULL),
(66, 103, 71, 1, '48000.00', NULL, NULL),
(67, 104, 68, 1, '50000.00', NULL, NULL),
(68, 105, 68, 1, '50000.00', NULL, NULL),
(69, 106, 68, 9, '50000.00', NULL, NULL),
(70, 107, 68, 2, '50000.00', NULL, NULL),
(71, 108, 68, 9, '50000.00', NULL, NULL),
(72, 108, 68, 9, '50000.00', NULL, NULL),
(73, 108, 68, 7, '50000.00', NULL, NULL),
(74, 108, 71, 1, '48000.00', NULL, NULL),
(75, 109, 71, 2, '48000.00', NULL, NULL),
(76, 110, 71, 1, '48000.00', NULL, NULL),
(77, 111, 83, 1, '25000.00', NULL, NULL),
(78, 112, 74, 2, '40000.00', NULL, NULL),
(79, 113, 71, 1, '48000.00', NULL, NULL),
(80, 113, 72, 1, '50000.00', NULL, NULL),
(81, 117, 68, 1, '50000.00', NULL, NULL),
(82, 118, 97, 2, '40000.00', NULL, NULL),
(83, 119, 72, 2, '84000.00', NULL, NULL);

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
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `order_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `comic_id`, `user_id`, `rating`, `review_text`, `created_at`, `status`, `order_id`) VALUES
(23, 68, 86, 'average', 'etdg', '2024-12-06 16:21:19', 'approved', 90),
(24, 97, 83, 'good', 'rất hay', '2024-12-08 09:50:51', 'approved', NULL),
(25, 72, 83, 'excellent', 'tuyệt', '2024-12-08 09:57:37', 'approved', NULL);

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
(64, 'cường 123', 'admin@gmail.com', '$2y$10$eH1X2wekZK5nXYel23Tsfu8zce7Ftzcft6FguFmA6WhR2QIApMnkO', '0768765499', '../uploads/user/1733651607mb-bank-logo.png', 'user', '2024-11-12 16:49:03', '2024-12-08 09:53:27'),
(81, 'cuong', 'abd@gmail.com', '$2y$10$WmR/yLpls5LD0imzIgK3iOShE3XqIxcO75mMKc3rTQRWLIgS9lr0.', '06995848445', 'default.jpg', 'admin', '2024-11-30 13:50:33', '2024-11-30 14:04:15'),
(82, 'thanhlake', 'lake@gmail.com', '$2y$10$7xcm/L4ZIwkqJi2LlSoGxOo8fypCFs99vQbFzFHFIysbncSs4tQvq', '0768765499', '../uploads/user/1733651619momo-logo.png', 'user', '2024-11-30 15:34:20', '2024-12-08 09:53:39'),
(83, 'Trương Xuân Đông', 'dong@gmail.com', '$2y$10$/UXsgqETbFGLst401lOK5.OzvedmGsTylrYrpwPQpxYvH5CdCb4.K', '0865819798', '../uploads/user/1733651742momo-logo.png', 'user', '2024-12-01 06:06:45', '2024-12-08 09:55:42'),
(84, 'Trương xuân đông', 'Dongken474@gmail.com', '$2y$10$O3VVeMOg4t1pop8xdMq1XOFYSebfmEloObKUM2dwUHXrcxF3rpmVC', '0865819798', 'default.jpg', 'admin', '2024-12-01 13:28:26', '2024-12-01 13:31:39'),
(85, 'tien', 'admin123@gmail.com', '123123', '0932331573', '../uploads/user/1733651627mb-bank-logo.png', 'user', '2024-12-03 05:21:43', '2024-12-08 09:53:47'),
(86, 'tien', 'tien12@gmail.com', '$2y$10$LnpLYdf72vOOuh09DgQb1OjQ4nOiGSrpt56t4JC403eeTwVxyJGhO', '0123654789', 'default.jpg', 'admin', '2024-12-03 05:27:03', '2024-12-03 05:52:57');

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
  ADD KEY `fk_comics_rating` (`comic_id`),
  ADD KEY `fk_order_id` (`order_id`);

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
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `comic_sales`
--
ALTER TABLE `comic_sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `comic_variants`
--
ALTER TABLE `comic_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_rating` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
