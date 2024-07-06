-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table hoctap.account
CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table hoctap.account: ~2 rows (approximately)
INSERT INTO `account` (`username`, `password`, `id`) VALUES
	('thanhben01', '123', 1),
	('loclol01', '456', 2);

-- Dumping structure for table hoctap.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `mon_id` int DEFAULT NULL,
  `tenanh` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ghichu_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `mon_id` (`mon_id`),
  KEY `gallery_ibfk_3` (`ghichu_id`),
  CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`mon_id`) REFERENCES `monhoc` (`id`),
  CONSTRAINT `gallery_ibfk_3` FOREIGN KEY (`ghichu_id`) REFERENCES `ghichu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table hoctap.gallery: ~1 rows (approximately)
INSERT INTO `gallery` (`id`, `user_id`, `mon_id`, `tenanh`, `ghichu`, `ghichu_id`, `created_at`, `updated_at`) VALUES
	(27, 1, 1, 'http://res.cloudinary.com/ds82xoboc/image/upload/v1671438235/lu6fqi5t8qdi5cjmbixr.jpg', '123', 50, '2022-12-19 15:23:57', '2022-12-19 15:23:57'),
	(28, 1, 1, 'http://res.cloudinary.com/ds82xoboc/image/upload/v1677297424/k1iittwaon6nwsl8jwof.jpg', '123445', 51, '2023-02-25 10:57:07', '2023-02-25 10:57:07');

-- Dumping structure for table hoctap.ghichu
CREATE TABLE IF NOT EXISTS `ghichu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `noidung` longtext COLLATE utf8mb4_vietnamese_ci,
  `mon_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `ghichu_ibfk_2` (`mon_id`),
  CONSTRAINT `ghichu_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `account` (`id`),
  CONSTRAINT `ghichu_ibfk_2` FOREIGN KEY (`mon_id`) REFERENCES `monhoc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table hoctap.ghichu: ~1 rows (approximately)
INSERT INTO `ghichu` (`id`, `userId`, `noidung`, `mon_id`, `created_at`, `updated_at`) VALUES
	(50, 1, '123', 1, '2022-12-19 15:23:56', '2022-12-19 15:23:56'),
	(51, 1, '123445', 1, '2023-02-25 10:57:05', '2023-02-25 10:57:05');

-- Dumping structure for table hoctap.lichhoc
CREATE TABLE IF NOT EXISTS `lichhoc` (
  `id_lh` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `tenmon` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phonghoc` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tiet_bd` int DEFAULT NULL,
  `sotiet` int DEFAULT NULL,
  `thu` int DEFAULT NULL,
  PRIMARY KEY (`id_lh`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lichhoc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table hoctap.lichhoc: ~5 rows (approximately)
INSERT INTO `lichhoc` (`id_lh`, `user_id`, `tenmon`, `phonghoc`, `tiet_bd`, `sotiet`, `thu`) VALUES
	(1, 1, 'CƠ SỞ DỮ LIỆU', '207/C1', 3, 3, 0),
	(2, 1, 'LẬP TRÌNH HƯỚNG ĐỐI TƯỢNG', '306/D1', 6, 2, 0),
	(3, 1, 'AN TOÀN THÔNG TIN', '202/B1', 8, 2, 1),
	(5, 1, 'Vi tích phân A1', '101/NN', 4, 2, 1);

-- Dumping structure for table hoctap.monhoc
CREATE TABLE IF NOT EXISTS `monhoc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenmon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- Dumping data for table hoctap.monhoc: ~4 rows (approximately)
INSERT INTO `monhoc` (`id`, `tenmon`) VALUES
	(1, 'CƠ SỞ DỮ LIỆU'),
	(2, 'Cấu Trúc Dữ Liệu'),
	(3, 'Lập trình hướng đối tượng'),
	(4, 'Vi tích phân A1');

-- Dumping structure for table hoctap.nhacnho
CREATE TABLE IF NOT EXISTS `nhacnho` (
  `id_nn` int NOT NULL AUTO_INCREMENT,
  `ghichu_id` int DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id_nn`),
  KEY `nhacnho_fk1` (`ghichu_id`),
  CONSTRAINT `nhacnho_fk1` FOREIGN KEY (`ghichu_id`) REFERENCES `ghichu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
