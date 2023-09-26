-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2023 at 04:10 PM
-- Server version: 8.0.34-0ubuntu0.22.04.1
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atom_fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('superadmin','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` char(21) COLLATE utf8mb4_general_ci NOT NULL,
  `product_code` char(23) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whislist_id` char(21) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cart_id` char(21) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activated` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`, `picture`, `whislist_id`, `cart_id`, `activated`, `last_modified`, `created_at`) VALUES
('928990df2899798bf50d67fba06502e3', 'Sampah', 'Sampah', 'sampah000sampah@gmail.com', NULL, NULL, NULL, 'f8263f5ae620f2fd29a7c010a905.png', NULL, NULL, 'Y', '2023-09-26 12:20:15', '2023-09-26 12:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `code` char(23) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` enum('clothes','footwear','perfume','cosmetics','glasses','bags','accessories') COLLATE utf8mb4_general_ci NOT NULL,
  `for_gender` enum('male','female','all','') COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `max_purchase` int DEFAULT NULL,
  `stock` int NOT NULL,
  `sold` int NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci,
  `tags` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `on_trending` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N',
  `best_seller` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N',
  `thumbnail_id` char(18) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`code`, `name`, `category`, `for_gender`, `price`, `discount`, `max_purchase`, `stock`, `sold`, `description`, `tags`, `rating`, `on_trending`, `best_seller`, `thumbnail_id`) VALUES
('PROD_158725C12E0DB9BA9A', 'SANDAL SWALLOW', 'footwear', 'all', 10000, 0, 0, 400, 154, 'Sandal Yang Melegenda', 'sandal,unisex,simpel', '4', 'N', 'N', 'THUMB_A429CEC4B25A'),
('PROD_2B9003654D79440835', 'Smart Watch Vital Plus', 'accessories', 'all', 400000, 0, 3, 30, 4, 'Kombinasi perangkat kesehatan + pelacak kebugaran yang lebih besar dan lebih baik di pergelangan tangan Anda dengan fitur yang disempurnakan untuk memantau aktivitas dan tanda-tanda vital Anda.', 'smartwatch,teknologi,jam,', '5', 'N', 'N', 'THUMB_BD91862F3E29'),
('PROD_392973E50BE0BDC4B1', 'Marks & Spencer Discover Spiced Amber Eau De Toilette 30ml', 'perfume', 'female', 200000, 0, 0, 150, 109, 'Eau de toilette dengan perpaduan aroma bunga yang manis hingga spicy dan campuran buah segar yang memberi kesan hangat dan sensual. Cocok digunakan untuk malam hari.\r\n\r\n- Notes: Woody, amber, geranium, cedar\r\n- Vegan friendly\r\n- Cruelty free\r\n- Ukuran: 30 ml\r\n- Expired date: 7/31/2025', 'elegant', '4', 'N', 'N', 'THUMB_C75A82DEAE60'),
('PROD_3FC92638BC4DD6B75F', 'Trekking & Running Shoes - Black', 'footwear', 'male', 600000, 0, 0, 30, 10, 'Upper berbahan mesh ringan dan breathable untuk menjaga kesejukan kaki dan kenyamananmu melangkah, Menahan bagian tumitmu sehingga lebih nyaman ketika bergerak cepat, Outsole ringan dan solid untuk menunjang kecepatanmu dalam bergerak', 'sepatu,pria,lari,olah raga', '5', 'N', 'N', 'THUMB_2B71C9EBC4FE'),
('PROD_8076C006C1FDA9663A', 'Black Floral Wrap Midi Skirt', 'clothes', 'female', 200000, 0, 0, 50, 7, 'Dengan motif bunga cantik dan balutan depan yang sedang tren, jadikan rok midi hitam ini sebagai pilihan tepat untuk setiap kesempatan. Padukan dengan kaus polos dan sandal untuk tampilan stylish yang mudah.', 'rok,wanita,bunga,hitam', '5', 'N', 'N', 'THUMB_6861201BE83E'),
('PROD_828AB11FC515B5BA70', 'Maison Margiela', 'footwear', 'all', 900000, 0, 0, 20, 5, '- Penutupan: bertali\r\n- Dilengkapi dengan sebuah kotak\r\n- Dilengkapi dengan kantong debu\r\n- Lapisan: kulit\r\n- Dibuat di Italia\r\n- Sol: sol dalam kulit, sol karet\r\n- Bentuk jari kaki: ujung bulat\r\n- Atas: kulit sapi', 'casual, men & women, daily', '5', 'N', 'N', 'THUMB_DFC0E6BA0AA2'),
('PROD_889972438E7D512D18', 'Korean Turtleneck Knit Lengan Panjang import Atasan', 'clothes', 'female', 80000, 0, 0, 5000, 134, 'Pakaian Harga Murah Tapi Bukan Murahan', 'pakaian,wanita,korea,lengan panjang', '5', 'N', 'N', 'THUMB_8DAA12CD0A26'),
('PROD_9E4C1D0E07842B6768', 'Compass Retrograde Low Black White', 'footwear', 'all', 538000, 0, 0, 50, 11, 'Compass®️ Retrograde adalah interpretasi ulang dari penggalian arsip merek Gazelle®️ untuk mengenang kembali merek Gazelle®️ yang populer pada tahun 80 & 90an di Indonesia.', 'sepatu,unisex,hitam', '4', 'N', 'N', 'THUMB_CDA7D50C76E4'),
('PROD_9EE3FD4957B679506C', 'Steve Madden BGLOWING Women\'s Crossbody Bags- Bone - Beige', 'bags', 'female', 1500000, 0, 0, 70, 44, ' Tas hobo BGLOWING dilengkapi penataan eksterior dan interior serta kancing berat yang memperkuat sudut dan tali pengikat selempang. Tas hobo selempang, Penutup ritsleting di bagian atas2 saku ritsleting luar, 1 saku ritsleting di dalam, Kantong ritsleting yang dapat dilepas, Cermin yang dapat dilepas, Tali yang dapat disesuaikan dengan grommet dan kancing, Tali pengikat: 21,5 inci, 10 inci L x 2,75 inci L x 5 inci T, Bahan buatan', 'women,casual', '4', 'N', 'N', 'THUMB_BB2739B7ABDA'),
('PROD_B887B9F978FD7E223C', 'Casual Men\'s Brown Shoes', 'footwear', 'male', 500000, 0, 2, 25, 2, 'Sepatu Menggunakan Bahan Sintesis Sol yang dijahit dengan tangan membuat sepatu boat pria ini tidak mudah sobek dan tidak licin', 'sepatu,pria,casual,coklat', '5', 'N', 'N', 'THUMB_66B530D31BA7'),
('PROD_C0D58BDE897278B3FF', 'Better Basics French Terry Sweatshorts', 'clothes', 'male', 500000, 0, 0, 100, 47, 'Koleksi Sweatshorts Better Basics menampilkan bahan katun yang 100% Lebih Baik. Semuanya bersumber dari BCI (Better Cotton Initiative), memberi Anda fashion bebas rasa bersalah.', 'celana,pria,merah', '4', 'N', 'N', 'THUMB_F0CA8518FA8F'),
('PROD_FEE8716F33D820B113', 'Bitzen Ikat pinggang pria model rel sabuk gesper', 'accessories', 'male', 41000, 0, 0, 50, 11, 'Membuat penampilan anda menarik dan keren, dengan desain fast unlock tidak repot pada saat memakainya.', 'sabuk,pria,hitam,rel', '4', 'N', 'N', 'THUMB_E8FA28A5D358');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` char(18) COLLATE utf8mb4_general_ci NOT NULL,
  `image` char(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `image`) VALUES
('THUMB_A429CEC4B25A', '41d19e8233767281700999b4dba6.png'),
('THUMB_A429CEC4B25A', '0d44076bce2a96760918bd693863.png'),
('THUMB_A429CEC4B25A', '2ec2e5d1233ea3443defb8981301.png'),
('THUMB_66B530D31BA7', 'ed8a94f4d23e824ca83fa4a69b2e.png'),
('THUMB_66B530D31BA7', '89da508ffc858a24791d582ae74f.png'),
('THUMB_BD91862F3E29', 'e58ef527a3c263b4272b05dc11e7.png'),
('THUMB_BD91862F3E29', '1cc27defd1ec2e8d79d8ece8a00f.png'),
('THUMB_E8FA28A5D358', 'b9a51a0cf74228ea940a624a695c.png'),
('THUMB_E8FA28A5D358', '21118bb5d9cbd67f39adcddcccd1.png'),
('THUMB_E8FA28A5D358', 'a01beccceecf988dc1b1f4d179c8.png'),
('THUMB_DFC0E6BA0AA2', '2cb20b50bed51a31bb583749c3db.png'),
('THUMB_DFC0E6BA0AA2', 'a73b3191bdd434be4480d3a0ecbd.png'),
('THUMB_DFC0E6BA0AA2', 'c4db445644b69cf940420b6f684f.png'),
('THUMB_C75A82DEAE60', 'df0b57fab649ab9d61e4be228b4e.png'),
('THUMB_C75A82DEAE60', '1d5ba3bdffc66a0f23c52143e8cd.png'),
('THUMB_CDA7D50C76E4', '962a3d2e2e71865d90e16d5b293c.png'),
('THUMB_CDA7D50C76E4', '2c1866bad6bc4923d5812a6ca85f.png'),
('THUMB_CDA7D50C76E4', 'b3970a1b8bdab49c4c90eaac1b8f.png'),
('THUMB_F0CA8518FA8F', '122786d66c31acc8b7273525f6d4.png'),
('THUMB_F0CA8518FA8F', '6fdb12912fd76f6b1307b01f4c77.png'),
('THUMB_6861201BE83E', 'e551bd44cc78ab29513ee5500f54.png'),
('THUMB_6861201BE83E', '6bd7ab16387eb526cc085b075a94.png'),
('THUMB_8DAA12CD0A26', '6dd109697e2790b854a1d5be1efb.png'),
('THUMB_2B71C9EBC4FE', '128eb9f5fafd805184e533941168.png'),
('THUMB_2B71C9EBC4FE', '0f5e4d9f1cf2b245861bf8c83805.png'),
('THUMB_BB2739B7ABDA', 'eee43c6b47109972695c3598cb39.png');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `customer_id` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('signup','forgot_password') COLLATE utf8mb4_general_ci NOT NULL,
  `key` char(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whislists`
--

CREATE TABLE `whislists` (
  `id` char(21) COLLATE utf8mb4_general_ci NOT NULL,
  `product_code` char(23) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD KEY `FK FROM PRODUCT CODE TO CARTS` (`product_code`),
  ADD KEY `FK FROM CUSTOMERS CART ID TO CARTS` (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `whislist_id` (`whislist_id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `UNIQUE thumbnail_id ON PRODUCTS` (`thumbnail_id`) USING BTREE;

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD KEY `FK FROM THUMBNAILS_ID ON id` (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `whislists`
--
ALTER TABLE `whislists`
  ADD KEY `FK FROM PRODUCT CODE TO WHISLISTS` (`product_code`),
  ADD KEY `	FK FROM CUSTOMERS WHISLIST ID TO WHISLISTS` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK FROM CUSTOMERS CART ID TO CARTS` FOREIGN KEY (`id`) REFERENCES `customers` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK FROM PRODUCT CODE TO CARTS` FOREIGN KEY (`product_code`) REFERENCES `products` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD CONSTRAINT `FK FROM THUMBNAILS_ID ON id` FOREIGN KEY (`id`) REFERENCES `products` (`thumbnail_id`) ON DELETE CASCADE;

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `FK FROM CUSTOMERS_ID TO id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `whislists`
--
ALTER TABLE `whislists`
  ADD CONSTRAINT `	FK FROM CUSTOMERS WHISLIST ID TO WHISLISTS` FOREIGN KEY (`id`) REFERENCES `customers` (`whislist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK FROM PRODUCT CODE TO WHISLISTS` FOREIGN KEY (`product_code`) REFERENCES `products` (`code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
