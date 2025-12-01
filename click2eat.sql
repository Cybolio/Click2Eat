-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2025 at 03:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `click2eat`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `home_address` varchar(15) NOT NULL,
  `work_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `username`, `fullname`, `email`, `password`, `phone_no`, `home_address`, `work_address`) VALUES
(2, 'mhalianicole', '0', 'mhalianicole08@gmail.com', '123', '69696969', 'Cebu City', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `RiderID` int(11) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DeliveryTime` time NOT NULL,
  `DeliveryStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `FoodID` int(11) NOT NULL,
  `branch-ID` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`FoodID`, `branch-ID`, `name`, `description`, `Price`, `Category`, `Availability`) VALUES
(1, 1, 'Yum Burger', 'Dry Ahh', 50.00, 'Appetizer', 0),
(2, 1, 'Macha Latte', 'Performative', 50.00, 'Drink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderprocess`
--

CREATE TABLE `orderprocess` (
  `OrderID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `DeliveryID` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL,
  `RiderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderStatus` int(11) NOT NULL DEFAULT 1,
  `Total Amount` decimal(10,0) NOT NULL,
  `OrderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentrecord`
--

CREATE TABLE `paymentrecord` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `DeliveryID` int(11) NOT NULL,
  `PaymentDate` datetime NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `PaymentMethod` int(11) NOT NULL DEFAULT 1,
  `PaymentStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `branchID` int(11) NOT NULL,
  `branchaddress` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `restaurantname` varchar(50) NOT NULL,
  `contact-num` varchar(15) NOT NULL,
  `manager` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`branchID`, `branchaddress`, `email`, `restaurantname`, `contact-num`, `manager`, `password`) VALUES
(1, 'tunghaan, minglanilla', 'jolitunghaan@gmail.com', 'joibee', '696969696969', 'Kanye West', '123'),
(2, 'Cebu City', 'Ethan@gmail.com', 'JolliEthan', '42069', 'Ethan Saranza', '123');

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `rider-id` int(11) NOT NULL,
  `LicenseNo.` varchar(13) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `phone-no` varchar(15) NOT NULL,
  `vehicle-type` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `platenum` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`),
  ADD UNIQUE KEY `payments` (`PaymentID`),
  ADD KEY `order_num` (`OrderID`),
  ADD KEY `rider_id` (`RiderID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`FoodID`),
  ADD KEY `serves` (`branch-ID`);

--
-- Indexes for table `orderprocess`
--
ALTER TABLE `orderprocess`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `payment` (`PaymentID`),
  ADD UNIQUE KEY `branch` (`BranchID`),
  ADD UNIQUE KEY `deliveries` (`DeliveryID`),
  ADD UNIQUE KEY `delivers` (`BranchID`) USING BTREE,
  ADD UNIQUE KEY `riders` (`RiderID`),
  ADD KEY `receives` (`CustomerID`);

--
-- Indexes for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  ADD PRIMARY KEY (`PaymentID`),
  ADD UNIQUE KEY `delivery` (`DeliveryID`),
  ADD KEY `orderToPay` (`OrderID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`branchID`),
  ADD UNIQUE KEY `branchaddress` (`branchaddress`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`rider-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `FoodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderprocess`
--
ALTER TABLE `orderprocess`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `rider-id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`PaymentID`) REFERENCES `paymentrecord` (`PaymentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_num` FOREIGN KEY (`OrderID`) REFERENCES `orderprocess` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rider_id` FOREIGN KEY (`RiderID`) REFERENCES `rider` (`rider-id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`branch-ID`) REFERENCES `restaurant` (`branchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderprocess`
--
ALTER TABLE `orderprocess`
  ADD CONSTRAINT `orderprocess_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderprocess_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `restaurant` (`branchID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderprocess_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymentrecord` (`PaymentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderprocess_ibfk_4` FOREIGN KEY (`RiderID`) REFERENCES `rider` (`rider-id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderprocess_ibfk_5` FOREIGN KEY (`DeliveryID`) REFERENCES `delivery` (`DeliveryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  ADD CONSTRAINT `paymentrecord_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orderprocess` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paymentrecord_ibfk_2` FOREIGN KEY (`DeliveryID`) REFERENCES `delivery` (`DeliveryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
