-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 09:29 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenleaf`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`) VALUES
(4, 'Bob\'s Farm'),
(5, 'Bob\'s Farm');

-- --------------------------------------------------------

--
-- Table structure for table `nozzle`
--

CREATE TABLE `nozzle` (
  `id` int(15) NOT NULL,
  `partnumber` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  `onhand` int(7) NOT NULL DEFAULT '0',
  `min` int(7) NOT NULL,
  `max` int(7) NOT NULL,
  `p1` varchar(15) DEFAULT NULL,
  `p2` varchar(15) DEFAULT NULL,
  `p3` varchar(15) DEFAULT NULL,
  `p4` varchar(15) DEFAULT NULL,
  `p5` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Nozzle Table';

--
-- Dumping data for table `nozzle`
--

INSERT INTO `nozzle` (`id`, `partnumber`, `description`, `onhand`, `min`, `max`, `p1`, `p2`, `p3`, `p4`, `p5`) VALUES
(3, 'TACDF015', 'TurboDropÂ® Asymmetric DualFan Nozzle', 11, 10, 100, 'CADF', 'SMP11001', 'SMP8002', 'TDVC015', 'G125'),
(4, 'DF03', 'SprayMax Asymmetric DualFan Nozzles', 0, 10, 100, 'CADF', 'SMP11001', 'SMP8002', '', ''),
(5, 'DF09', 'SprayMax Symmetric DualFan Nozzles', 0, 10, 100, 'TDXLV01', 'TDXLV015', 'TDXLV02', 'TDXLV025', 'TDXLV03');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id` int(15) NOT NULL,
  `partnumber` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  `onhand` int(7) NOT NULL DEFAULT '0',
  `min` int(7) NOT NULL,
  `max` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Parts Table';

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `partnumber`, `description`, `onhand`, `min`, `max`) VALUES
(13, 'G125', 'nozzle part', 50, 20, 200),
(14, 'TDXLV01', 'nozzle part', 49, 20, 200),
(15, 'TDXLV015', 'nozzle part', 49, 20, 200),
(16, 'TDXLV02', 'nozzle part', 49, 20, 200),
(17, 'TDXLV025', 'nozzle part', 49, 20, 200),
(18, 'TDXLV03', 'nozzle part', 49, 20, 200),
(19, 'TDXLV04', 'nozzle part', 50, 20, 200),
(21, 'TDXLV05', 'nozzle part', 50, 20, 200),
(22, 'TDXLV06', 'nozzle part', 50, 20, 200),
(23, 'TDXLV08', 'nozzle part', 50, 20, 200),
(24, 'TDXLV10', 'nozzle part', 50, 20, 200),
(25, 'TDXLV15', 'nozzle part', 50, 20, 200),
(26, 'TDVC01', 'nozzle part', 50, 20, 200),
(27, 'TDVC015', 'nozzle part', 50, 20, 200),
(28, 'TDVC02', 'nozzle part', 50, 20, 200),
(29, 'TDVC025', 'nozzle part', 50, 20, 200),
(30, 'TDVC03', 'nozzle part', 50, 20, 200),
(31, 'TDVC04', 'nozzle part', 50, 20, 200),
(32, 'TDVC05', 'nozzle part', 50, 20, 200),
(34, 'TDVC06', 'nozzle part', 50, 20, 200),
(35, 'TDVC10', 'nozzle part', 50, 20, 200),
(36, 'TDVC08', 'nozzle part', 50, 20, 200),
(38, 'SMP11001', 'nozzle part', 48, 20, 200),
(39, 'SMP110015', 'nozzle part', 50, 20, 200),
(40, 'SMP11002', 'nozzle part', 50, 20, 200),
(41, 'SMP110025', 'nozzle part', 50, 20, 200),
(42, 'SMP11003', 'nozzle part', 50, 20, 200),
(43, 'SMP11004', 'nozzle part', 50, 20, 200),
(44, 'SMP11005', 'nozzle part', 50, 20, 200),
(45, 'SMP11006', 'nozzle part', 50, 20, 200),
(46, 'SMP11008', 'nozzle part', 50, 20, 200),
(47, 'SMP11010', 'nozzle part', 50, 20, 200),
(48, 'SMP11015', 'nozzle part', 50, 20, 200),
(49, 'SMP8002', 'nozzle part', 48, 20, 200),
(50, 'SMP8003', 'nozzle part', 50, 20, 200),
(51, 'SMP8004', 'nozzle part', 50, 20, 200),
(52, 'SMP8005', 'nozzle part', 50, 20, 200),
(55, 'SMP8006', 'nozzle part', 50, 20, 200),
(56, 'CADF', 'nozzle part', 48, 20, 100);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(15) NOT NULL,
  `customer` int(30) NOT NULL,
  `partnumber` int(15) NOT NULL,
  `qty` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nozzle`
--
ALTER TABLE `nozzle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `partnumber` (`partnumber`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nozzle`
--
ALTER TABLE `nozzle`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
