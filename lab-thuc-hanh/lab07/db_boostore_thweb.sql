-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2025 at 04:54 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_boostore_thweb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_liet_ke_sach_theo_loai` (IN `p_maloai` VARCHAR(5))   BEGIN
    -- Câu lệnh SELECT để truy vấn sách dựa trên mã loại (imaloai)
    SELECT
        s.imasach,
        s.itensach
    FROM
        `bookstore`.`sach` s
    WHERE
        s.imaloai = p_maloai;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `bang_top_10_sach_gia_cao`
-- (See below for the actual view)
--
CREATE TABLE `bang_top_10_sach_gia_cao` (
`gia` float
,`imasach` varchar(15)
,`itensach` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethd`
--

CREATE TABLE `chitiethd` (
  `imahd` int NOT NULL,
  `imasach` varchar(15) NOT NULL,
  `soluong` tinyint NOT NULL,
  `agia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `imahd` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `ngayhd` datetime NOT NULL,
  `itennguoinhan` varchar(50) NOT NULL,
  `diachinguoinhan` varchar(80) NOT NULL,
  `ngaynhan` date DEFAULT NULL,
  `dienthoainguoinhan` varchar(11) DEFAULT NULL,
  `trangthai` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `email` varchar(50) NOT NULL,
  `matkhau` varchar(32) NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `dienthoai` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `imaloai` varchar(5) NOT NULL,
  `itenloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhaxb`
--

CREATE TABLE `nhaxb` (
  `imanhxb` varchar(5) NOT NULL,
  `tennxb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `imasach` varchar(15) NOT NULL,
  `itensach` varchar(250) NOT NULL,
  `imota` text,
  `gia` float NOT NULL,
  `ihinh` varchar(50) DEFAULT NULL,
  `imanhxb` varchar(5) NOT NULL,
  `imaloai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethd`
--
ALTER TABLE `chitiethd`
  ADD PRIMARY KEY (`imahd`,`imasach`),
  ADD KEY `fk_chitiethd_sach` (`imasach`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`imahd`),
  ADD KEY `fk_hoadon_khachhang` (`email`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`imaloai`);

--
-- Indexes for table `nhaxb`
--
ALTER TABLE `nhaxb`
  ADD PRIMARY KEY (`imanhxb`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`imasach`),
  ADD KEY `fk_sach_nhaxb` (`imanhxb`),
  ADD KEY `fk_sach_loai` (`imaloai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `imahd` int NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Structure for view `bang_top_10_sach_gia_cao`
--
DROP TABLE IF EXISTS `bang_top_10_sach_gia_cao`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bang_top_10_sach_gia_cao`  AS SELECT `sach`.`imasach` AS `imasach`, `sach`.`itensach` AS `itensach`, `sach`.`gia` AS `gia` FROM `sach` ORDER BY `sach`.`gia` DESC LIMIT 0, 10 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethd`
--
ALTER TABLE `chitiethd`
  ADD CONSTRAINT `fk_chitiethd_hoadon` FOREIGN KEY (`imahd`) REFERENCES `hoadon` (`imahd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chitiethd_sach` FOREIGN KEY (`imasach`) REFERENCES `sach` (`imasach`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hoadon_khachhang` FOREIGN KEY (`email`) REFERENCES `khachhang` (`email`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `fk_sach_loai` FOREIGN KEY (`imaloai`) REFERENCES `loai` (`imaloai`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sach_nhaxb` FOREIGN KEY (`imanhxb`) REFERENCES `nhaxb` (`imanhxb`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
