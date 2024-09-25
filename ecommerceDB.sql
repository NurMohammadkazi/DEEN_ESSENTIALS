-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 07:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userpassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `username`, `userpassword`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `c_id` int(11) NOT NULL,
  `c_password` varchar(10) NOT NULL,
  `c_mail` varchar(50) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_address` varchar(50) NOT NULL,
  `c_phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`c_id`, `c_password`, `c_mail`, `c_name`, `c_address`, `c_phone`) VALUES
(1, '123', 'luthful.cse.20210204081@aust.edu', 'Galib', 'Dhaka,Mirpur', '01713269302'),
(2, '145', 'luthful.cse.20210204075@aust.edu', 'Hasan', 'Dhaka,Mirpur , Kazipara', '01538375527'),
(3, '123', 'nur.cse.20210204071@aust.edu', 'Nur', 'Dhaka, Kazipara', '01538378827'),
(4, '12346', 'raduan.cse.20210204081@aust.edu', 'Raduan', 'Dhaka,Mirpur', '01713269302'),
(5, '123456', 'radu56@gmail.com', 'Raduan', 'mirbag', '01732380602');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `o_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `Id` int(11) DEFAULT NULL,
  `PPrice` decimal(10,2) DEFAULT NULL,
  `PQuantity` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paid_table`
--

CREATE TABLE `paid_table` (
  `pay_id` varchar(50) NOT NULL,
  `c_id` int(11) NOT NULL,
  `c_phone` int(11) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `PPrice` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `Id` int(11) NOT NULL,
  `PQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paid_table`
--

INSERT INTO `paid_table` (`pay_id`, `c_id`, `c_phone`, `c_address`, `PPrice`, `payment_date`, `Id`, `PQuantity`) VALUES
('pay_66c9b68d97a84', 3, 1538378827, 'Dhaka, Kazipara', 75000, '2024-08-24 16:31:41', 47, 1),
('pay_66c9b68d97a84', 3, 1538378827, 'Dhaka, Kazipara', 3500, '2024-08-24 16:31:41', 66, 1),
('pay_66c9b68d97a84', 3, 1538378827, 'Dhaka, Kazipara', 2150, '2024-08-24 16:31:41', 57, 1),
('pay_66c9b6c524fdc', 1, 1713269302, 'Dhaka,Mirpur', 102000, '2024-08-24 16:32:37', 49, 1),
('pay_66cb42678a09e', 1, 1713269302, 'Dhaka,Mirpur', 53, '2024-08-25 20:40:39', 69, 3),
('pay_66cb42678a09e', 1, 1713269302, 'Dhaka,Mirpur', 5413, '2024-08-25 20:40:39', 71, 1),
('pay_66cb477bbc163', 1, 1713269302, 'Dhaka,Mirpur', 85000, '2024-08-25 21:02:19', 70, 1),
('pay_66cb4826b8ff4', 1, 1713269302, 'Dhaka,Mirpur', 53, '2024-08-25 21:05:10', 69, 4),
('pay_66cb4826b8ff4', 1, 1713269302, 'Dhaka,Mirpur', 85000, '2024-08-25 21:05:10', 70, 2),
('pay_66cb492ae1f82', 1, 1713269302, 'Dhaka,Mirpur', 53, '2024-08-25 21:09:30', 69, 4),
('pay_66cb492ae1f82', 1, 1713269302, 'Dhaka,Mirpur', 85000, '2024-08-25 21:09:30', 70, 4),
('pay_66cb49bdb9ece', 1, 1713269302, 'Dhaka,Mirpur', 53, '2024-08-25 21:11:57', 69, 4),
('pay_66cb49bdb9ece', 1, 1713269302, 'Dhaka,Mirpur', 85000, '2024-08-25 21:11:57', 70, 4),
('pay_66cb49d8e7f9d', 1, 1713269302, 'Dhaka,Mirpur', 53, '2024-08-25 21:12:24', 69, 4),
('pay_66cb49d8e7f9d', 1, 1713269302, 'Dhaka,Mirpur', 85000, '2024-08-25 21:12:24', 70, 4),
('pay_66f446eb6291d', 5, 1732380602, 'mirbag', 1500, '2024-09-25 23:22:51', 74, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `Id` int(11) NOT NULL,
  `PName` varchar(100) NOT NULL,
  `PPrice` varchar(100) NOT NULL,
  `PImage` varchar(200) NOT NULL,
  `PCategory` varchar(100) NOT NULL,
  `Pquantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`Id`, `PName`, `PPrice`, `PImage`, `PCategory`, `Pquantity`) VALUES
(73, 'Panjabi-1', '1020', 'Uploadimage/6314157393696636409.jpg', 'Laptop', 20),
(74, 'Panjabi-2', '1500', 'Uploadimage/6314157393696636406.jpg', 'Laptop', 22),
(75, 'Panjabi-3', '1850', 'Uploadimage/6314157393696636405.jpg', 'Laptop', 15),
(76, 'Panjabi-4', '2500', 'Uploadimage/6314157393696636404.jpg', 'Laptop', 30),
(77, 'Panjabi-5', '2999', 'Uploadimage/6314157393696636408.jpg', 'Laptop', 30),
(78, 'Panjabi-6', '1999', 'Uploadimage/6314157393696636407.jpg', 'Laptop', 35),
(79, 'Perfume-1', '250', 'Uploadimage/6314157393696636390.jpg', 'Mobiles', 50),
(80, 'Perfume-2', '499', 'Uploadimage/6314157393696636391.jpg', 'Mobiles', 25),
(81, 'Perfume-3', '250', 'Uploadimage/6314157393696636387.jpg', 'Mobiles', 55),
(82, 'Perfume-4', '800', 'Uploadimage/6314157393696636388.jpg', 'Mobiles', 56),
(83, 'Perfume-5', '700', 'Uploadimage/6314157393696636389.jpg', 'Mobiles', 40),
(84, 'Perfume-6', '600', 'Uploadimage/6314157393696636386.jpg', 'Mobiles', 45),
(85, 'Perfume-7', '1000', 'Uploadimage/6314157393696636385.jpg', 'Mobiles', 80),
(86, 'Perfume-8', '1050', 'Uploadimage/6314157393696636384.jpg', 'Mobiles', 23),
(88, 'Tazbi-1', '100', 'Uploadimage/6314157393696636394.jpg', 'Others', 25),
(89, 'Watch-1', '500', 'Uploadimage/6314157393696636428.jpg', 'Others', 56),
(90, 'Prayer Rug-1', '750', 'Uploadimage/6314157393696636425.jpg', 'Others', 45),
(91, 'Prayer Rug-2', '899', 'Uploadimage/6314157393696636392.jpg', 'Others', 30),
(92, 'Taqiyah-1', '150', 'Uploadimage/6314157393696636424.jpg', 'Others', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer_table` (`c_id`),
  ADD CONSTRAINT `order_table_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `tblproduct` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
