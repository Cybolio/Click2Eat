-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2025 at 04:22 PM
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
(1, 'bamesj', 'Bames Jond', 'bamesjond@gmail.com', '123', '555666888', 'Cebu City', 'Minglanilla'),
(3, 'ivan', 'ivan', 'ivan@gmail.com', '123', '123', 'Cebu City', '');

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
  `Availability` int(11) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`FoodID`, `branch-ID`, `name`, `description`, `Price`, `Category`, `Availability`, `item_image`) VALUES
(1, 1, 'Jolly Spaghetti', 'Disgusting', 150.00, 'Main Course', 1, NULL),
(2, 1, 'Yum Burger', 'Extra Yummy', 50.00, 'Main Course', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderprocess`
--

CREATE TABLE `orderprocess` (
  `OrderID` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `RiderID` int(11) DEFAULT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderStatus` int(11) NOT NULL DEFAULT 1,
  `Total Amount` decimal(10,0) NOT NULL,
  `OrderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderprocess`
--

INSERT INTO `orderprocess` (`OrderID`, `BranchID`, `RiderID`, `CustomerID`, `OrderStatus`, `Total Amount`, `OrderDate`) VALUES
(38, 1, 1, 1, 1, 709, '2025-12-15 09:23:59'),
(42, 1, NULL, 1, 1, 380, '2025-12-15 09:42:46'),
(43, 1, 1, 1, 1, 380, '2025-12-15 09:43:17'),
(44, 1, 1, 1, 3, 380, '2025-12-15 09:43:31'),
(45, 1, 1, 1, 3, 380, '2025-12-15 09:43:42'),
(46, 1, NULL, 1, 1, 227, '2025-12-15 13:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_food_items`
--

CREATE TABLE `order_food_items` (
  `OrderFoodItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1,
  `PriceAtOrder` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_food_items`
--

INSERT INTO `order_food_items` (`OrderFoodItemID`, `OrderID`, `FoodID`, `Quantity`, `PriceAtOrder`) VALUES
(4, 38, 1, 4, 150.00),
(5, 38, 2, 1, 50.00),
(7, 42, 2, 4, 50.00),
(9, 43, 2, 4, 50.00),
(11, 44, 2, 4, 50.00),
(13, 45, 2, 4, 50.00),
(15, 46, 2, 1, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `paymentrecord`
--

CREATE TABLE `paymentrecord` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `DeliveryID` int(11) DEFAULT NULL,
  `PaymentDate` datetime NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `PaymentMethod` int(11) NOT NULL DEFAULT 1,
  `PaymentStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentrecord`
--

INSERT INTO `paymentrecord` (`PaymentID`, `OrderID`, `DeliveryID`, `PaymentDate`, `Amount`, `PaymentMethod`, `PaymentStatus`) VALUES
(1, 38, NULL, '2025-12-15 09:23:59', 709, 1, 1),
(2, 42, NULL, '2025-12-15 09:42:46', 380, 1, 1),
(3, 43, NULL, '2025-12-15 09:43:17', 380, 1, 1),
(4, 44, NULL, '2025-12-15 09:43:31', 380, 1, 1),
(5, 45, NULL, '2025-12-15 09:43:42', 380, 1, 1),
(6, 46, NULL, '2025-12-15 13:27:55', 227, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `branchID` int(11) NOT NULL,
  `branchaddress` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `restaurantname` varchar(50) NOT NULL,
  `contactnum` varchar(15) NOT NULL,
  `manager` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`branchID`, `branchaddress`, `email`, `restaurantname`, `contactnum`, `manager`, `password`, `status`) VALUES
(1, 'Cebu City', 'mickd@gmail.com', 'Jolibee', '11223344', 'Scrooge McDuck', '123', 1),
(10, 'Cebu', 'Ivan@gmail.com', 'Ivan', '92013', 'Ivan', '123', 0);

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
  `password` varchar(50) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`rider-id`, `LicenseNo.`, `fullname`, `Email`, `phone-no`, `vehicle-type`, `address`, `platenum`, `password`, `profile_image`, `status`) VALUES
(1, 'A00-000-0000', 'Christine Codilla', 'tintin@gmail.com', '112233445566', 'Blue 2010, Yamaha V Star 950 Tourer ', 'Cebu City', 'CCA112', '123', NULL, 1),
(2, 'A00-00-0000', 'John Cena', 'JC@gmail.com', '11223344', 'Toyota Corolla', 'Cebu CIty', 'GCC123', '1234', NULL, 0);

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
  ADD KEY `receives` (`CustomerID`),
  ADD KEY `riders` (`RiderID`) USING BTREE,
  ADD KEY `branch` (`BranchID`);

--
-- Indexes for table `order_food_items`
--
ALTER TABLE `order_food_items`
  ADD PRIMARY KEY (`OrderFoodItemID`),
  ADD KEY `ofi_order` (`OrderID`),
  ADD KEY `ofi_food` (`FoodID`);

--
-- Indexes for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  ADD PRIMARY KEY (`PaymentID`),
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
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `FoodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderprocess`
--
ALTER TABLE `orderprocess`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_food_items`
--
ALTER TABLE `order_food_items`
  MODIFY `OrderFoodItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `rider-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_order` FOREIGN KEY (`OrderID`) REFERENCES `orderprocess` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_rider` FOREIGN KEY (`RiderID`) REFERENCES `rider` (`rider-id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orderprocess_ibfk_4` FOREIGN KEY (`RiderID`) REFERENCES `rider` (`rider-id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_food_items`
--
ALTER TABLE `order_food_items`
  ADD CONSTRAINT `ofi_ibfk_food` FOREIGN KEY (`FoodID`) REFERENCES `menu` (`FoodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofi_ibfk_order` FOREIGN KEY (`OrderID`) REFERENCES `orderprocess` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paymentrecord`
--
ALTER TABLE `paymentrecord`
  ADD CONSTRAINT `paymentrecord_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orderprocess` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
