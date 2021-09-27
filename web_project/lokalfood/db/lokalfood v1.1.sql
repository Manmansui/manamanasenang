-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 03:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_type` int(11) NOT NULL COMMENT '1 for superAdmin, 2 for Restaurant Owner',
  `admin_username` varchar(11) NOT NULL,
  `admin_pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_pwd` varchar(8) NOT NULL,
  `pwdHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 'maira', 'mai@email.com', '123', '$2y$10$Em651nM6.tVbqht4YPz8l.pvEmfrwdhqQBcIT1Po4Opkj7kYiXWly'),
(13, 'wahab', 'wahab@gmail.com', '123', '$2y$10$dfNg2fJiDhWv4TPEAwyWwOGjsYFo/wN234kAynQHgqUjU7idbsUe6'),
(14, 'dad', 'dsada@gmail.com', 'dsadadas', '$2y$10$q.gbCvbnyqwldFdinTRcdO9jxUigSfjbrz/DG0ucTcJB.7vqZlk/.');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL COMMENT 'restaurant id',
  `food_name` varchar(100) NOT NULL COMMENT 'menu name',
  `food_cat` int(1) NOT NULL,
  `food_price` float(8,2) NOT NULL,
  `food_img` varchar(255) NOT NULL,
  `food_availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `rest_id`, `food_name`, `food_cat`, `food_price`, `food_img`, `food_availability`) VALUES
(1, 3, 'Nasi Lemak', 1, 2.50, 'img/food/nasi-lemak-kuning.jpg', 1),
(2, 3, 'Roti Canai', 1, 1.20, 'img/food/roti-canai.jpg', 1),
(3, 3, 'Nasi Goreng', 2, 4.50, 'img/food/nasi-goreng.jpg', 1),
(4, 3, 'Satay', 3, 1.30, 'img/food/satay.jpg', 1),
(5, 3, 'Karipap', 4, 0.60, 'img/food/karipap.jpg', 1),
(6, 3, 'Sandwich', 1, 2.00, 'img/food/sandwich.jpg', 1),
(7, 2, 'Mee Goreng Kung-Fu', 2, 5.50, 'img/food/mee-goreng-kungfu.jpg', 1),
(8, 1, 'Nasi Kerabu', 2, 6.70, 'img/food/nasi-kerabu.jpg', 1),
(9, 1, 'Ayam Goreng Crispy', 2, 2.50, 'img/food/ayam-goreng-crispy.jpg', 1),
(10, 2, 'Siakap 3 Rasa', 3, 15.50, 'img/food/siakap-tiga-rasa.jpg', 1),
(11, 2, 'Roti John Meleleh', 3, 3.50, 'img/food/roti-john.jpg', 1),
(12, 1, 'Laksa Sarawak', 3, 6.70, 'img/food/laksa-sarawak.jpg', 1),
(13, 2, 'Kuih Koci Comel', 4, 0.70, 'img/food/kuih-koci.jpg', 1),
(14, 2, 'Pulut Panggang', 4, 0.30, 'img/food/pulut-panggang.jpg', 1),
(15, 1, 'Tepung Pelita', 4, 0.50, 'img/food/tepung-pelita.jpg', 1),
(16, 3, 'Apam Balik', 4, 1.00, 'img/food/apam-balik.jpg', 1),
(17, 2, 'Popiah Goreng Ayam', 4, 1.20, 'img/food/popiah-goreng-ayam.jpg', 1),
(18, 2, 'Teh Tarik', 5, 4.50, 'img/food/teh-tarik.jpg', 1),
(19, 1, 'Milo Ais Tabur', 5, 3.50, 'img/food/iced-milo.jpg', 1),
(20, 2, 'Air Bandung', 5, 4.00, 'img/food/air-bandung.jpg', 1),
(21, 1, 'Kopi O Pekat', 5, 2.00, 'img/food/kopi-o.jpg', 1),
(22, 1, 'Teh O Ais Limau', 5, 2.50, 'img/food/teh-o-ais-limau.jpg', 1),
(23, 3, 'Air Batu Campur (ABC)', 4, 5.00, 'img/food/abc.jpg', 1),
(24, 1, 'Char Kuey Teow Seafood', 3, 6.70, 'img/food/char-kuey-teow-seafood.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `food_review` (
  `review_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_review` text NOT NULL,
  `food_ratings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_review`
--

INSERT INTO `food_review` (`review_id`, `cust_id`, `order_id`, `food_id`, `food_review`, `food_ratings`) VALUES
(1, 13, 3, 3, 'Nasi Goreng paling sedap', 5),
(2, 13, 3, 1, 'Mantap', 4),
(3, 13, 3, 2, 'ok la', 3),
(4, 14, 14, 19, 'terbaik', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `order_id` int(11) NOT NULL,
  `order_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` int(11) NOT NULL DEFAULT 1,
  `order_amt` float(8,2) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_invoice`
--

INSERT INTO `order_invoice` (`order_id`, `order_datetime`, `order_status`, `order_amt`, `cust_id`) VALUES
(3, '2021-06-17 23:12:47', 1, 12.50, 13),
(4, '2021-06-17 23:34:58', 1, 12.50, 13),
(5, '2021-06-17 23:52:03', 1, 6.50, 13),
(12, '2021-06-18 18:31:24', 1, 50.00, 13),
(13, '2021-06-18 19:13:53', 1, 45.00, 13),
(14, '2021-06-26 09:15:31', 1, 3.50, 14);

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `line_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`line_id`, `order_id`, `food_id`, `food_qty`) VALUES
(1, 3, 3, 1),
(2, 3, 1, 1),
(3, 3, 2, 1),
(4, 4, 3, 1),
(5, 4, 1, 1),
(24, 12, 1, 10),
(25, 13, 1, 8),
(26, 13, 2, 5),
(27, 14, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rest_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT 'The admin_id to manage the restaurant',
  `rest_name` varchar(50) NOT NULL,
  `rest_location` varchar(50) NOT NULL,
  `rest_rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rest_id`, `admin_id`, `rest_name`, `rest_location`, `rest_rating`) VALUES
(1, 1, 'Restoran Maju 1', 'Kingfisher', 4),
(2, 2, 'Restoran Maju 2', 'Plaza Likas', 5),
(3, 3, 'Restoran Maju 3', 'Menggatal Plaza', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `rest_id` (`rest_id`) USING BTREE;

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `food_review`
--
ALTER TABLE `food_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`line_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`food_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rest_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `food_review`
--
ALTER TABLE `food_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
