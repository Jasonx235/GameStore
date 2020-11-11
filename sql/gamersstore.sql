-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2020 at 09:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamersstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` int(6) NOT NULL,
  `NAME` char(15) DEFAULT NULL,
  `PRICE` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `NAME`, `PRICE`) VALUES
(90807, 'PS5', '399.99');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `REVIEW_ID` int(4) NOT NULL,
  `PRODUCT_ID` int(6) DEFAULT NULL,
  `REVIEW_INFO` char(50) DEFAULT NULL,
  `USER_ID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`REVIEW_ID`, `PRODUCT_ID`, `REVIEW_INFO`, `USER_ID`) VALUES
(1, 90807, 'Product is overheating', 908);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `SHOPPINGCART_ID` int(5) NOT NULL,
  `USER_ID` char(4) DEFAULT NULL,
  `PRODUCT_ID` char(6) DEFAULT NULL,
  `TOTAL` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`SHOPPINGCART_ID`, `USER_ID`, `PRODUCT_ID`, `TOTAL`) VALUES
(1234, '0908', '090807', '399.99');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(5) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `FIRST_NAME` char(15) DEFAULT NULL,
  `LAST_NAME` char(15) DEFAULT NULL,
  `PHONE_NUM` char(10) DEFAULT NULL,
  `STREET` char(15) DEFAULT NULL,
  `CITY` char(15) DEFAULT NULL,
  `STATE` char(2) DEFAULT NULL,
  `ZIP` char(5) DEFAULT NULL,
  `EMAIL` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `PHONE_NUM`, `STREET`, `CITY`, `STATE`, `ZIP`, `EMAIL`) VALUES
(908, 'test', 'Daniel', 'Dolan', '9178856098', '552 Amboy Road', 'Staten Island', 'NY', '10309', 'test@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`REVIEW_ID`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`SHOPPINGCART_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PRODUCT_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90808;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `REVIEW_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `SHOPPINGCART_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
