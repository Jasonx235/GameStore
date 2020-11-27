-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2020 at 01:03 AM
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
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `picture_path` varchar(255) DEFAULT NULL,
  `USER_ID` int(5) DEFAULT NULL,
  `product_id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` int(6) NOT NULL,
  `NAME` char(100) DEFAULT NULL,
  `PRICE` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `NAME`, `PRICE`) VALUES
(90807, 'PS5', '399.99'),
(392184, 'Spider-man: Miles Morales', '49.99'),
(463241, 'Battlefield 5', '29.99'),
(482174, 'Destiny 2: Beyond Light', '39.99'),
(591436, 'XBOX SERIES X', '499.99'),
(693218, 'Bugsnax', '59.99'),
(726421, 'Red Dead Redemption 2', '49.99'),
(736214, 'Watch Dogs: Legion', '59.99'),
(827134, 'Doom Eternal', '39.99'),
(871631, 'Cybperpunk 2077', '59.99'),
(912621, 'Assassin\'s Creed Valhalla', '59.99'),
(917321, 'Nintendo Switch', '249.99');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `REVIEW_ID` int(4) NOT NULL,
  `PRODUCT_ID` int(6) DEFAULT NULL,
  `REVIEW_INFO` varchar(255) DEFAULT NULL,
  `USER_ID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`REVIEW_ID`, `PRODUCT_ID`, `REVIEW_INFO`, `USER_ID`) VALUES
(14, 90807, 'The best console ever!', 916),
(17, 591436, 'sssss', 916),
(18, 482174, 'd', 916),
(19, 871631, 'Very good game', 916);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(5) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL,
  `PHONE_NUM` varchar(255) DEFAULT NULL,
  `STREET` varchar(255) DEFAULT NULL,
  `CITY` varchar(255) DEFAULT NULL,
  `STATE` char(2) DEFAULT NULL,
  `ZIP` char(10) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `PHONE_NUM`, `STREET`, `CITY`, `STATE`, `ZIP`, `EMAIL`) VALUES
(911, '$2y$10$nKP1pB6JmwLH2mweUYc3guYg1xeBc33jqSS42YTcGvz0xyeRYhoAS', 'hi', 'hi', '9294228163', 'hi', 'hi', 'hi', 'hi', 'hi@yahoo.com'),
(912, '$2y$10$han4BP8HT33Y9hyezUlhfeMARHI0Jp4HsD5yS2xSy.hTe0PoPkSRK', 'hi', 'hi', '9294228163', 'hi', 'hi', 'hi', 'hi', 'hello@yahoo.com'),
(915, '$2y$10$FsyfLDQgaYzKaLMxA3vXQ.Eiy67I/SRDjbS949a3W29mvqyQrtKb6', 'Andrea', 'Habib', '9294228163', '6 BENSON ST FL 2', 'STATEN ISLAND', 'NY', '10312', 'andrea.atef@yahoo.com'),
(916, '$2y$10$5znPGejMjhY8wWBZLahyjOlIT15x5nAYqwYaWNsBEdurrAv6SjLD6', 'Andrea', 'Habib', '9294228163', '6 BENSON ST FL 2', 'STATEN ISLAND', 'NY', '10312', 'test@gmail.com'),
(917, '$2y$10$Jlvr/HZ4GG2Npts4KQDfW.QJW9uHlhXp049wVc5bGWI1P6iSySLTW', 'David', 'abdelmassieh', '9294228163', '6 Benson Street', 'Staten Island', 'NY', '10312', 'davidatef238@gmail.com'),
(918, '$2y$10$FHGLPY7DGYOix1S6hfIOhuB28sEC62xeqkvcjyxdC2jWUk1ctAVVu', 'James', 'Davis', '934293131', '2036', 'Brooklyn', 'NY', '11223', 'hey@gmail.com'),
(919, '$2y$10$5JHSut3Ho7rTdlw24FH9aOlwMytJ5xWEcN0H5qZIvmAWVqowQ.W2q', 'Andrea', 'Habib', '9294228163', '6 BENSON ST FL 2', 'STATEN ISLAND', 'NY', '10312', 'hheee@gmail.com'),
(920, '$2y$10$/61CuzyRaeF8PUm/V9wWHud2zguavJPJGxmtraLE0z11x.C0tXnai', 'Andrea', 'Habib', '9294228163', '6 BENSON ST FL 2', 'STATEN ISLAND', 'NY', '10312', 'test1@gmail.com'),
(921, '$2y$10$ScMQwdWTNcrKPs/LcCHUzePNBJ1tExMhJCOzcJfggpZenDTn52nsK', 'Andrea', 'Habib', '9294228163', '6 BENSON ST FL 2', 'STATEN ISLAND', 'NY', '10312', 'ddd@gmailc.om');

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
  MODIFY `PRODUCT_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=917322;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `REVIEW_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `SHOPPINGCART_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91180;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=922;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
