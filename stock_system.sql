-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 04:55 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` int(11) NOT NULL,
  `role` enum('admin','outlet') NOT NULL DEFAULT 'outlet',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `role`, `username`, `password`, `name`, `email`, `address`, `phone_number`, `mobile_number`, `pic`, `photo`) VALUES
(1, 'admin', 'irvan', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Irvan Winata', 'irvan@gethassee.com', 'Gading Nirwana blok PF 17 no 11, Kelapa Gading, Jakarta Utara, 14240', '+6281316878995', '+6281316878995', 'irvan', 'uploads/photos/irvan/photo.jpg'),
(2, 'outlet', 'setyawan', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Setyawan Susanto', 'setyawan@gethassee.com', 'Apartment Puri Park View', '', '', '', 'uploads/photos/setyawan/photo.jpg'),
(3, 'outlet', 'John', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Jonathan Hosea', 'jonathan@gethassee.com', '', '', '', '', ''),
(4, 'outlet', 'felita', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Felita Setiawan', 'felita@gethassee.com', '', '', '', '', 'uploads/photos/felita/photo.jpg'),
(6, 'outlet', 'FELITOT', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'FELITOT', '', 'GBOLOKKK', '', '', 'FELITA', ''),
(7, 'outlet', 'outlet A', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'outlet A', '', 'di A', '', '', 'felita', ''),
(8, 'outlet', 'KFC Artha', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'KFC Artha', '', 'Rukan Artha gading samting', '', '', 'Kasino', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`code`, `name`, `category`, `buying_price`, `selling_price`, `photo`, `thumb`) VALUES
('41234', 'adf', 1, 1234, 0, '', ''),
('BV000001', 'Green Tea', 1, 5000, 0, '', ''),
('BV000002', 'Milk Tea', 1, 7000, 0, '', ''),
('BV000003', 'test', 1, 10000, 0, 'uploads/BV000003/Black-Logo-Batman-wallpapers.jpg', 'uploads/BV000003/Black-Logo-Batman-wallpapers_thumb.jpg'),
('BV000004', 'Alazka Tea', 1, 8000, 0, '', ''),
('BV000005', 'Bro', 1, 9000, 0, 'uploads/BV000005/ironman_desktop.jpg', 'uploads/BV000005/ironman_desktop_thumb.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
