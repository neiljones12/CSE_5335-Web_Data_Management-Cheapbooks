-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2016 at 09:06 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--

CREATE TABLE `Author` (
  `ssn` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`ssn`, `name`, `address`, `phone`) VALUES
(1, 'Dan Brown', 'Los Angeles', '900800001'),
(2, 'J.K Rowling', 'London', '900800002'),
(3, 'Sidney Sheldon', 'New York', '900800003'),
(4, 'Stephen King', 'Manchester', '900800004\r\n'),
(5, 'Jefferey Archer', 'Washington', '900800005');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `ISBN` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`ISBN`, `title`, `year`, `price`, `publisher`) VALUES
(1, 'Harry Potter and the Prisoner of Azkaban', '1999', 29, 'Random'),
(2, 'Harry Potter and the Sorcerers Stone', '2002', 22, 'Random'),
(3, 'Harry Potter and the Chamber of Secrets', '2001', 21, 'Random'),
(4, 'Harry Potter and the Deathly Hallows', '2009', 29, 'Random'),
(5, 'Harry Potter and the Half Blood Prince', '2006', 26, 'Random'),
(6, 'Harry Potter and the Order of Phoenix', '2007', 25, 'Random'),
(7, 'Deception Point', '1999', 16, 'Random'),
(8, 'Inferno', '2013', 19, 'Random'),
(9, 'Angels and Demons', '2009', 19, 'Random'),
(10, 'The Da Vinci Code', '2001', 20, 'Random'),
(11, 'The Lost Symbol', '2006', 21, 'Random'),
(12, 'The Shining', '1989', 12, 'Random'),
(13, 'The Stand', '2007', 12, 'Random'),
(14, 'Misery', '2005', 28, 'Random'),
(15, 'Doctor Sleep', '2002', 16, 'Random'),
(16, 'On Writing', '1977', 19, 'Random'),
(17, 'If tomorrow comes', '1993', 10, 'Random'),
(18, 'Master of the game', '2010', 18, 'Random'),
(19, 'Tell me your dreams', '2007', 12, 'Random'),
(20, 'Bloodline', '2010', 23, 'Random'),
(21, 'The other side of midnight', '2001', 9, 'Random'),
(22, 'Kane and Abel', '1991', 24, 'Random'),
(23, 'Only time will tell', '2004', 18, 'Random'),
(24, 'The sins of the father', '2001', 19, 'Random'),
(25, 'Be careful what you wish for', '1992', 20, 'Random'),
(26, 'Best kept secret', '1997', 19, 'Random');

-- --------------------------------------------------------

--
-- Table structure for table `Contains`
--

CREATE TABLE `Contains` (
  `ISBN` int(11) NOT NULL,
  `basketID` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `username` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`username`, `address`, `email`, `phone`, `password`) VALUES
('yash', '', 'yash', 0, '123');

-- --------------------------------------------------------

--
-- Table structure for table `ShippingOrder`
--

CREATE TABLE `ShippingOrder` (
  `ISBN` int(11) NOT NULL,
  `warehouseCode` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ShoppingBasket`
--

CREATE TABLE `ShoppingBasket` (
  `basketID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ShoppingBasket`
--

INSERT INTO `ShoppingBasket` (`basketID`, `username`) VALUES
(1, 'neil');

-- --------------------------------------------------------

--
-- Table structure for table `Stocks`
--

CREATE TABLE `Stocks` (
  `warehouseCode` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Stocks`
--

INSERT INTO `Stocks` (`warehouseCode`, `ISBN`, `number`) VALUES
(1, 1, 5),
(1, 2, 5),
(1, 3, 5),
(1, 4, 5),
(1, 5, 5),
(1, 6, 5),
(1, 7, 5),
(2, 11, 5),
(1, 12, 5),
(1, 13, 5),
(2, 14, 5),
(2, 15, 5),
(2, 16, 5),
(2, 17, 5),
(2, 18, 5),
(3, 1, 5),
(3, 2, 5),
(3, 3, 5),
(3, 4, 5),
(3, 5, 5),
(3, 6, 5),
(3, 7, 5),
(3, 8, 5),
(3, 21, 5),
(3, 22, 5),
(3, 23, 5),
(3, 24, 5),
(3, 25, 5),
(3, 26, 5),
(3, 11, 5),
(3, 12, 5),
(3, 13, 5),
(3, 18, 5),
(3, 19, 5),
(4, 1, 5),
(4, 2, 5),
(4, 3, 5),
(4, 4, 5),
(4, 5, 5),
(4, 6, 5),
(4, 19, 5),
(4, 21, 5),
(4, 22, 5),
(4, 23, 5),
(4, 24, 5),
(4, 25, 5),
(4, 26, 5),
(5, 1, 5),
(5, 2, 5),
(5, 3, 5),
(5, 4, 5),
(5, 5, 5),
(5, 6, 5),
(5, 7, 5),
(5, 8, 5),
(5, 9, 5),
(5, 10, 5),
(5, 11, 5),
(5, 12, 5),
(5, 13, 5),
(5, 14, 5),
(5, 15, 5),
(5, 17, 5),
(5, 18, 5),
(5, 19, 5),
(5, 21, 5),
(5, 22, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Warehouse`
--

CREATE TABLE `Warehouse` (
  `warehouseCode` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Warehouse`
--

INSERT INTO `Warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
(1, 'Warehouse A', 'Virginia', '900800001'),
(2, 'Warehouse B', 'Minesotta', '900800002'),
(3, 'Warehouse C', 'Arizona', '900800003'),
(4, 'Warehouse D', 'Philadelphia', '900800004'),
(5, 'Warehouse E', 'Nebraska', '900800005');

-- --------------------------------------------------------

--
-- Table structure for table `WrittenBy`
--

CREATE TABLE `WrittenBy` (
  `ssn` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `WrittenBy`
--

INSERT INTO `WrittenBy` (`ssn`, `ISBN`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `Contains`
--
ALTER TABLE `Contains`
  ADD KEY `basketID` (`basketID`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `ShippingOrder`
--
ALTER TABLE `ShippingOrder`
  ADD KEY `ISBN` (`ISBN`),
  ADD KEY `warehouseCode` (`warehouseCode`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `ShoppingBasket`
--
ALTER TABLE `ShoppingBasket`
  ADD PRIMARY KEY (`basketID`);

--
-- Indexes for table `Stocks`
--
ALTER TABLE `Stocks`
  ADD KEY `warehouseCode` (`warehouseCode`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `Warehouse`
--
ALTER TABLE `Warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

--
-- Indexes for table `WrittenBy`
--
ALTER TABLE `WrittenBy`
  ADD KEY `ssn` (`ssn`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contains`
--
ALTER TABLE `Contains`
  ADD CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`basketID`) REFERENCES `ShoppingBasket` (`basketID`),
  ADD CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `Book` (`ISBN`);

--
-- Constraints for table `ShippingOrder`
--
ALTER TABLE `ShippingOrder`
  ADD CONSTRAINT `shippingorder_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `Book` (`ISBN`),
  ADD CONSTRAINT `shippingorder_ibfk_2` FOREIGN KEY (`warehouseCode`) REFERENCES `Warehouse` (`warehouseCode`),
  ADD CONSTRAINT `shippingorder_ibfk_3` FOREIGN KEY (`username`) REFERENCES `Customer` (`username`);

--
-- Constraints for table `Stocks`
--
ALTER TABLE `Stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`warehouseCode`) REFERENCES `Warehouse` (`warehouseCode`),
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `Book` (`ISBN`);

--
-- Constraints for table `WrittenBy`
--
ALTER TABLE `WrittenBy`
  ADD CONSTRAINT `writtenby_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `Author` (`ssn`),
  ADD CONSTRAINT `writtenby_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `Book` (`ISBN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
