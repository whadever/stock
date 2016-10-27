-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2016 at 09:33 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_mutasi`
--

CREATE TABLE `cart_mutasi` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Ring'),
(2, 'Necklace'),
(3, 'Earrings');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'Vrrom', 'uu@u.u', '21231', 'adakldj'),
(2, 'Nana', 'oo@oo.co', '898', 'ooasd'),
(3, 'benny', 'ben@ss.com', '0989876', 'sdfsdf'),
(4, 'benny', 'ben@ss.com', '0989876', 'sdfsdf'),
(5, 'irpan', 'kads@ksa.com', '103', 'aldksf');

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

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`code`, `name`, `address`, `photo`) VALUES
('D08', 'saranghae', 'koreaa', 'uploads/driver/D08/photo.jpg'),
('D09', 'irvan', 'kelapa gading', 'uploads/driver/no-photo.png');

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
(2, 'outlet', 'setyawan', '2beb367e8f1ae90320a4268d7c84a68903be0248acdd63788206d415a7fcbc621279caf5052d7bbe126a0cf3920485b77307d5142eb6402a95ae2cad43298239', 'Setyawan Susanto', 'setyawan@gethassee.com', 'Apartment Puri Park View', '', '', 'setyawan', 'uploads/photos/setyawan/photo.jpg'),
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
  `model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`code`, `name`, `model`, `quantity`, `category`, `buying_price`, `selling_price`, `photo`, `thumb`, `outlet_id`, `date`, `active`) VALUES
('4970129000525', 'spidol', 'SPmerah', 0, 2, 2000, 4000, 'uploads/products/no-photo.png', 'uploads/products/no-photo.png', 2, '0000-00-00 00:00:00', 0),
('4970129727514', 'Spidol Hitam', 'SPhitam', 0, 2, 8800, 9680, 'uploads/products/no-photo.png', 'uploads/products/no-photo.png', 2, '0000-00-00 00:00:00', 0),
('4970129727538', 'spidol biru', 'SP12384', 1, 3, 8000, 12000, 'uploads/products/4970129727538/photo.jpg', 'uploads/products/4970129727538/photo_thumb.jpg', 2, '0000-00-00 00:00:00', 0),
('awefc21423', 'felia', 'flels', 0, 2, 2555, 3832.5, 'uploads/products/awefc21423/photo.jpg', 'uploads/products/awefc21423/photo_thumb.jpg', 2, '0000-00-00 00:00:00', 0),
('CRF120309', 'Caramel Frappuccino', 'FP12039', 1, 2, 15, 22.5, 'uploads/products/CRF120309/photo.jpg', 'uploads/products/CRF120309/photo_thumb.jpg', 4, '0000-00-00 00:00:00', 0),
('GRT341203', 'Green Tea Latte', 'LT10293', 0, 2, 10, 15, 'uploads/products/GRT341203/photo.jpg', 'uploads/products/GRT341203/photo_thumb.jpg', 2, '0000-00-00 00:00:00', 0),
('masmasmsas12', 'mas', 'masmas', 0, 2, 900, 1485, 'uploads/products/masmasmsas12/photo.jpg', 'uploads/products/masmasmsas12/photo_thumb.jpg', 2, '0000-00-00 00:00:00', 0),
('RG12389190', 'Sety Ring', 'ST12039', 0, 1, 1000, 2000, 'uploads/products/RG12389190/photo.jpg', 'uploads/products/RG12389190/photo_thumb.jpg', 2, '0000-00-00 00:00:00', 0),
('SET219301092', 'sety necklace', 'NC82193', 1, 2, 900, 1080, 'uploads/products/no-photo.png', 'uploads/products/no-photo.png', 2, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi`
--

CREATE TABLE `spesifikasi` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `spec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spesifikasi`
--

INSERT INTO `spesifikasi` (`id`, `kode_barang`, `spec`) VALUES
(1, 'RG12389190', '1 Rd D 0.114 Ct'),
(2, 'awefc21423', '2 Sd 0.467 Ct.'),
(3, 'awefc21423', '2 Sd 0.467 Ct.'),
(4, 'masmasmsas12', '75 W 3.5 Gr'),
(5, 'SET219301092', '1 Rd D 0.114 Ct'),
(6, 'SET219301092', '2 Sd 0.467 Ct.'),
(7, '4970129000525', 'merah'),
(8, '4970129727514', 'test'),
(9, '4970129727538', '1 Rd D 0.114 Ct'),
(10, '4970129727538', '2 Sd 0.467 Ct.'),
(11, '12312', '1 Rd D 0.114 Ct'),
(12, '9213892134', 'jkhkjh123jk'),
(13, '193102490123', 'b21312');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `transaction_type_id` int(11) NOT NULL COMMENT '1 = jual, 2 = beli, 3 = mutasi',
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `detail` varchar(255) NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `code`, `transaction_type_id`, `transaction_date`, `detail`, `total_harga`) VALUES
(1, 'b1231', 1, '2016-10-24 00:30:16', 'unknown', 9680),
(2, 'b98892', 1, '2016-10-24 11:13:36', 'unknown', 804.82),
(3, 'va123', 1, '2016-10-24 11:16:59', 'unknown', 1188),
(4, '87bb9874', 1, '2016-10-24 11:24:53', 'unknown', 13680),
(5, '87bb9875', 1, '2016-10-24 11:25:23', 'unknown', 13680),
(6, '8123016', 2, '2016-10-26 09:49:17', 'unknown', 8000),
(7, 'alksdf7', 2, '2016-10-26 11:31:04', 'unknown', 200),
(8, '19398138', 2, '2016-10-26 11:34:14', 'unknown', 8000),
(9, '12039029', 2, '2016-10-27 01:00:06', 'unknown', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `from_client_id` int(11) NOT NULL,
  `to_client_id` int(11) NOT NULL,
  `harga_jual` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_code`, `product_code`, `quantity`, `from_client_id`, `to_client_id`, `harga_jual`) VALUES
(1, 'b1231', '4970129727514', 1, 2, 1, 9680),
(3, '3', 'RG12389190', 1, 2, 1, 1600),
(4, 'b98892', 'awefc21423', 1, 2, 2, 804.82),
(6, 'va123', 'masmasmsas12', 1, 2, 1, 1188),
(7, '87bb9875', '4970129727514', 1, 2, 4, 9680),
(8, '87bb9875', '4970129000525', 1, 2, 4, 4000),
(9, '8123016', '4970129727538', 1, 1, 2, 12000),
(10, 'alksdf7', '12312', 1, 1, 2, 240),
(11, '19398138', '9213892134', 1, 1, 2, 15200),
(12, '12039029', '193102490123', 1, 1, 2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT '1 = jual, 2 = beli, 3 = mutasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`id`, `type`) VALUES
(1, 'penjualan'),
(2, 'pembelian'),
(3, 'mutasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_mutasi`
--
ALTER TABLE `cart_mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- Indexes for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart_mutasi`
--
ALTER TABLE `cart_mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
