-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2018 at 08:42 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `investments`
--

-- --------------------------------------------------------

--
-- Table structure for table `company1`
--

CREATE TABLE `company1` (
  `businessType` varchar(50) NOT NULL,
  `companyId` int(11) NOT NULL,
  `companyDescription` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `companyTin` varchar(50) NOT NULL,
  `companyUserCode` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `logo` varchar(1024) DEFAULT NULL,
  `standardLogo` varchar(1024) DEFAULT NULL,
  `dateIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company1`
--

INSERT INTO `company1` (`businessType`, `companyId`, `companyDescription`, `companyName`, `companyTin`, `companyUserCode`, `location`, `logo`, `standardLogo`, `dateIn`) VALUES
('Broker', 1, 'our company has 5 year experiance', 'CDH Capital', '43989kj', 2, 'Kigali', NULL, NULL, '2017-02-28 09:02:23'),
('Fintech', 2, 'our company is the best leading in capital brockra', 'Amros', '23234', 3, 'Kigali', NULL, NULL, '2017-02-28 10:03:53'),
('Finicaila Market', 3, 'Our company is the best in selling shares', 'Ali Brokers', '49832748789', 5, 'Kigali Kacyiru', NULL, NULL, '2017-03-01 11:52:21'),
('Stock Broker', 4, 'authorized selling agent for stocks and Bonds', 'CDH capital Ltd', '39475987', 6, 'Kigali', NULL, NULL, '2017-03-01 12:02:37'),
('', 5, 'this it the best investment vehicle ever', 'Inses', '12343534', 8, '', NULL, NULL, '2017-03-06 11:10:10'),
('', 6, 'OUr company is the best in the market of stock bro', 'Glad Broker', '234798', 9, '', NULL, NULL, '2017-03-06 13:13:33'),
('', 7, 'our company is the best in the market', 'First Bank of Nigeria', '3442223', 10, '', 'invest/assets/images/firstbank_logo.png', 'invest/assets/images/firstbank_nigeria.jpg', '2018-04-21 05:33:06'),
('', 8, '', 'Grakay', '1234567', 11, '', NULL, NULL, '2018-03-08 20:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `loginId` varchar(100) DEFAULT NULL,
  `pwd` varchar(250) NOT NULL,
  `names` varchar(100) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_picture` varchar(1024) DEFAULT NULL,
  `account_type` enum('user','admin') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `loginId`, `pwd`, `names`, `gender`, `phone`, `email`, `profile_picture`, `account_type`) VALUES
(1, 'admin', 'admin', 'admin', '0', '', '', 'invest/admin/assets/img/avatars/user.png', 'admin'),
(2, 'jean', 'jean', 'Clement', '0', '', '', 'invest/admin/assets/img/avatars/user.png', 'user'),
(3, 'c', 'c', 'Kumutima', '0', '', 'placidelunis@gmail.com', 'invest/admin/assets/img/avatars/user.png', 'user'),
(41, 'mure', 'mure', 'mure', '0', 'mure', 'mure', 'invest/admin/assets/img/avatars/user.png', 'user'),
(5, 'aly', 'aly', 'Alli', '0', '0827409283', 'aly@emai.com', 'invest/admin/assets/img/avatars/user.png', 'user'),
(6, 'alex', 'alex', 'ALex', '0', '12349084', 'alex@gmail.com', 'invest/admin/assets/img/avatars/user.png', 'user'),
(7, 'pacy', 'pacy', 'pacy', '0', '3458098', 'pacy', 'invest/admin/assets/img/avatars/user.png', 'user'),
(8, 'nana', 'nana', 'Nana', '0', '32489', 'nana', 'invest/admin/assets/img/avatars/user.png', 'user'),
(9, 'gla', 'gla', 'Gladys', '0', '2938', 'gla', 'invest/admin/assets/img/avatars/user.png', 'user'),
(10, 'firstbank', 'firstbank', 'First Bank of Nigeria Limited', '0', '2983749', 'mbeya@SBCDJHC.DSCJB', 'invest/admin/assets/img/avatars/user.png', 'user'),
(11, 'gracekay', '1234576', 'Grace Kay', '0', '0785656584', 'gracekay@uplus.rw', 'invest/admin/assets/img/avatars/user.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company1`
--
ALTER TABLE `company1`
  ADD PRIMARY KEY (`companyId`),
  ADD KEY `cumpanyUserCode` (`companyUserCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginId` (`loginId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company1`
--
ALTER TABLE `company1`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
