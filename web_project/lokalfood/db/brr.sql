-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2021 at 07:44 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lokalfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_type` int(11) NOT NULL COMMENT '1 for superAdmin, 2 for Restaurant Owner',
  `admin_username` varchar(11) NOT NULL,
  `admin_pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_type`, `admin_username`, `admin_pwd`) VALUES
(1, 2, 'rest1', '123'),
(2, 2, 'rest2', '123'),
(3, 2, 'rest3', '123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_pwd` varchar(8) NOT NULL,
  `pwdHash` varchar(255) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_pwd`, `pwdHash`) VALUES
(1, 'Sue Alias', 'sue@123.com', 'sue123', ''),
(2, 'lia mustapha', 'lia@13.com', 'lia', ''),
(3, 'aishah', 'aishah@xyz.com', 'aishah', ''),
(4, 'suraya', 'suraya@gmail.com', 'sue123', '$2y$10$Lb8x5ede4Z61T5TbRU1FeuOkU9UPnCKKLdvOQEUyTWiPWgsHoIQwq'),
(5, 'cust1', 'cust1@email.com', 'cust1', '$2y$10$SQfkZuh1B5mXjNSVXKk86uFBGIdIx81.pM2gsCMQBoT9PrN32pvkm'),
(6, 'cust2', 'cust2@email.com', 'cust2', '$2y$10$I5/Wcx1/1bP.QB6jPgOveOBMNFVmdHSrMLKH0y9mUtFtL67688fYG'),
(7, 'cust3', 'cust3@email.com', 'cust3', '$2y$10$MxrjQSZdI4nJO4xVgQuNUOjezfhiCaK4Vm.Uklsw9VtzqqXNmRB8W'),
(8, 'Maya H', 'maya@email.com', 'maya123', '$2y$10$0K0YvqaoVqoRSwA2M7L0MeqOAdmirFwT9.fY9Yf4Uf87Zn5gj4d4.'),
(9, 'Sari Ain', 'ain@email.com', 'ain123', '$2y$10$a0azSPg1bLAybwNohQFSzub8r17EhXg419Ui82JHkA0MLpey3xYGe'),
(10, 'mei mei', 'mei@email.com', '123', '$2y$10$uRMlh2vssvOdt.ssP/bkCeb8w1./nR8x8wDVeh7u.9QeTTsvA/JUi'),
(11, 'mei mei', 'mei@email.com', 'mei123', '$2y$10$GekyuVlzMRERPjXq/XIdAexO0QtpR1d7YugjcHZ.6eFupinwOfKu2'),
(12, 'maira', 'mai@email.com', '123', '$2y$10$Em651nM6.tVbqht4YPz8l.pvEmfrwdhqQBcIT1Po4Opkj7kYiXWly');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `rest_id` int(11) NOT NULL COMMENT 'restaurant id',
  `food_name` varchar(100) NOT NULL COMMENT 'menu name',
  `food_cat` int(1) NOT NULL,
  `food_price` float(8,2) NOT NULL,
  `food_img` varchar(255) NOT NULL,
  `food_availability` int(11) NOT NULL,
  PRIMARY KEY (`food_id`),
  KEY `rest_id` (`rest_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `rest_id`, `food_name`, `food_cat`, `food_price`, `food_img`, `food_availability`) VALUES
(1, 1, 'Nasi Lemak', 1, 5.00, 'img/food/nasi-lemak-kuning.jpg', 1),
(2, 1, 'Roti Canai', 1, 1.00, 'img/food/roti-canai.jpg', 1),
(3, 2, 'Nasi Goreng', 2, 6.50, 'img/food/nasi-goreng.jpg', 1),
(4, 2, 'Satay', 3, 10.00, 'img/food/satay.jpg', 1),
(5, 3, 'Karipap', 4, 0.50, 'img/food/karipap.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

DROP TABLE IF EXISTS `food_category`;
CREATE TABLE IF NOT EXISTS `food_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`cat_id`, `cat_name`, `cat_desc`, `creation_date`) VALUES
(1, 'breakfast', 'food for breakfast', '2021-06-01 00:00:00'),
(2, 'lunch', 'food for lunch', '2021-06-01 00:00:00'),
(3, 'dinner', 'food for dinner', '2021-06-01 00:00:00'),
(4, 'dessert', 'food for dessert', '2021-06-01 00:00:00'),
(5, 'beverages', 'beverages', '2021-06-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `food_review`
--

DROP TABLE IF EXISTS `food_review`;
CREATE TABLE IF NOT EXISTS `food_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_review` text NOT NULL,
  `food_ratings` int(11) NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `cust_id` (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

DROP TABLE IF EXISTS `order_invoice`;
CREATE TABLE IF NOT EXISTS `order_invoice` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` int(11) NOT NULL DEFAULT '1',
  `order_amt` float(8,2) NOT NULL,
  `cust_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `cust_id` (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

DROP TABLE IF EXISTS `order_line`;
CREATE TABLE IF NOT EXISTS `order_line` (
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_qty` int(11) NOT NULL,
  PRIMARY KEY (`line_id`),
  KEY `order_id` (`order_id`),
  KEY `menu_id` (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `rest_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT 'The admin_id to manage the restaurant',
  `rest_name` varchar(50) NOT NULL,
  `rest_location` varchar(50) NOT NULL,
  `rest_rating` int(2) NOT NULL,
  PRIMARY KEY (`rest_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rest_id`, `admin_id`, `rest_name`, `rest_location`, `rest_rating`) VALUES
(1, 1, 'Restoran Maju 1', 'Kingfisher', 4),
(2, 2, 'Restoran Maju 2', 'Plaza Likas', 5),
(3, 3, 'Restoran Maju 3', 'Menggatal Plaza', 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`rest_id`) REFERENCES `restaurant` (`rest_id`);

--
-- Constraints for table `food_review`
--
ALTER TABLE `food_review`
  ADD CONSTRAINT `food_review_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD CONSTRAINT `order_invoice_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_invoice` (`order_id`),
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
