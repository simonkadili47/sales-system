-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 07:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `productionCost` double(10,0) NOT NULL,
  `productPrice` double(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `description`, `productionCost`, `productPrice`) VALUES
(1, 'shirt', 'blue large size', 5000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantitySold` double(10,0) DEFAULT NULL,
  `amountPaid` double(10,0) DEFAULT NULL,
  `attendant` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `sellingPrice` double(10,0) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesID`, `customerName`, `productID`, `quantitySold`, `amountPaid`, `attendant`, `date`, `sellingPrice`, `status`, `created_at`) VALUES
(1, '', 1, 2, 16000, 'est', '2022-06-13', 8000, 0, '2022-06-13 16:40:14'),
(2, 'papa', 1, 3, 24000, 'est', '2022-06-12', 8000, 0, '2022-06-13 16:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantityStocked` double(10,0) NOT NULL,
  `attendant` varchar(45) NOT NULL,
  `restockDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `productID`, `quantityStocked`, `attendant`, `restockDate`) VALUES
(1, 1, 5, 'EST', '2022-06-13'),
(2, 1, 3, 'EST', '2022-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `role` varchar(11) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `username`, `password`, `email_address`, `role`, `department`) VALUES
(16, 'esther clement mdoe ', 'est', '0926c950fe247c3b465eb13e258ee468d239a065', 'esther123@example.com', 'admin', 'duka'),
(17, 'Rajabu Shabani', 'rajabu', 'f4ad13c205b7346004ee7aad972b50861a21e8e6', 'rajabu12@gmail.com', 'user', 'duka'),
(18, 'mdoe', 'esther', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ester@gmail.com', 'admin', ''),
(19, 'esther mdoe clement', 'ester', '0926c950fe247c3b465eb13e258ee468d239a065', 'rajabu12@gmail.com', 'admin', 'duka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
