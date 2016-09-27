-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2016 at 02:56 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `name`, `email`, `address`, `phone_number`, `mobile_number`, `photo`) VALUES
(1, 'admin', 'irvan', '2beb367e8f1ae90320a4268d7c84a68903be0248acdd63788206d415a7fcbc621279caf5052d7bbe126a0cf3920485b77307d5142eb6402a95ae2cad43298239', 'Irvan Winata', 'irvan@gethassee.com', 'Gading Nirwana blok PF 17 no 11, Kelapa Gading, Jakarta Utara, 14240', '+6281316878995', '+6281316878995', 'uploads/photos/irvan/minion.png'),
(2, 'manager', 'setyawan', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Setyawan Susanto', 'setyawan@gethassee.com', '', '', '', ''),
(3, 'manager', 'John', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Jonathan Hosea', 'jonathan@gethassee.com', '', '', '', ''),
(4, 'staff', 'felita', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Felita Setiawan', 'felita@gethassee.com', '', '', '', ''),
(5, 'admin', 'reyner', 'bccbd5d823fc568cbae5a82069d48c46f36ab27ed0f629af8cb739d984c1e4ea6c71888496d4c42018427401a83043eeae8707de4fdcd0a7108fa5b8996d9b06', 'Gerald Reyner Liando', 'reyner@gethassee.com', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
