-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2018 at 10:22 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doa`
--

-- --------------------------------------------------------

--
-- Table structure for table `nida`
--

CREATE TABLE `nida` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `names` varchar(255) DEFAULT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL DEFAULT 'MALE',
  `dob` date DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `handleId` varchar(255) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `archived` enum('NO','YES') NOT NULL DEFAULT 'NO',
  `archivedBy` int(11) DEFAULT NULL,
  `archivedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nida`
--

INSERT INTO `nida` (`id`, `img`, `names`, `gender`, `dob`, `nid`, `handleId`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`, `archived`, `archivedBy`, `archivedDate`) VALUES
(1, NULL, 'MUHIRWA Clement', 'MALE', '1992-01-01', '1199280018360077', '', 1, '2018-05-04 07:37:19', NULL, NULL, 'NO', NULL, NULL),
(2, NULL, 'UMUTONI Nanah', 'FEMALE', '1990-06-21', '1199280018360077', NULL, 1, '2018-05-04 07:29:37', NULL, NULL, 'NO', NULL, NULL),
(3, NULL, 'IRIBAGIZA Ariane', 'FEMALE', '1991-04-10', '1199280018360077', NULL, 1, '2018-05-04 07:30:06', NULL, NULL, 'NO', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nida`
--
ALTER TABLE `nida`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nida`
--
ALTER TABLE `nida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
