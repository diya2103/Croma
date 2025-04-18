-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 04:57 PM
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
-- Database: `chroma`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_registration`
--

CREATE TABLE `customer_registration` (
  `cust_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `c_cart`
--

CREATE TABLE `c_cart` (
  `cc_id` int(11) NOT NULL,
  `cc_code` varchar(20) DEFAULT NULL,
  `cp_code` varchar(20) DEFAULT NULL,
  `cc_username` varchar(50) DEFAULT NULL,
  `psp_id` int(11) DEFAULT NULL,
  `cc_qty` int(11) DEFAULT NULL,
  `cc_price` float DEFAULT NULL,
  `cc_status` varchar(50) DEFAULT NULL,
  `return_date` date NOT NULL,
  `return_desc` varchar(500) NOT NULL,
  `return_status` varchar(30) NOT NULL,
  `cancel_date` varchar(20) NOT NULL,
  `cancel_desc` varchar(5000) NOT NULL,
  `cancel_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `c_deliver`
--

CREATE TABLE `c_deliver` (
  `cd_id` int(11) NOT NULL,
  `cp_code` varchar(20) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `cd_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `c_purchase`
--

CREATE TABLE `c_purchase` (
  `cp_id` int(11) NOT NULL,
  `cp_code` int(11) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `cp_name` varchar(50) DEFAULT NULL,
  `cp_address` varchar(80) DEFAULT NULL,
  `cp_contact` varchar(10) DEFAULT NULL,
  `cp_alternative_contact` varchar(10) DEFAULT NULL,
  `cp_pincode` int(11) DEFAULT NULL,
  `cp_date` varchar(20) DEFAULT NULL,
  `cp_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `c_wishlist`
--

CREATE TABLE `c_wishlist` (
  `cw_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `psp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `pin_id` int(11) NOT NULL,
  `pincode_no` varchar(11) NOT NULL,
  `pin_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_entry`
--

CREATE TABLE `product_entry` (
  `p_id` int(100) NOT NULL,
  `p_cid` int(20) NOT NULL,
  `p_subid` int(20) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pe_code` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `cgst` int(200) NOT NULL,
  `sgst` int(200) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_size_price`
--

CREATE TABLE `product_size_price` (
  `psp_id` int(11) NOT NULL,
  `pe_code` varchar(100) NOT NULL,
  `pcolor` varchar(100) NOT NULL,
  `pro_pur_qty` int(100) NOT NULL,
  `pro_pur_price` int(100) NOT NULL,
  `pro_sale_price` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `r_id` int(11) NOT NULL,
  `cc_code` varchar(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `cid` int(20) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer_registration`
--
ALTER TABLE `customer_registration`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `c_cart`
--
ALTER TABLE `c_cart`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `c_deliver`
--
ALTER TABLE `c_deliver`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `c_purchase`
--
ALTER TABLE `c_purchase`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `c_wishlist`
--
ALTER TABLE `c_wishlist`
  ADD PRIMARY KEY (`cw_id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`pin_id`);

--
-- Indexes for table `product_entry`
--
ALTER TABLE `product_entry`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_size_price`
--
ALTER TABLE `product_size_price`
  ADD PRIMARY KEY (`psp_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_registration`
--
ALTER TABLE `customer_registration`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_cart`
--
ALTER TABLE `c_cart`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_deliver`
--
ALTER TABLE `c_deliver`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_purchase`
--
ALTER TABLE `c_purchase`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_wishlist`
--
ALTER TABLE `c_wishlist`
  MODIFY `cw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_entry`
--
ALTER TABLE `product_entry`
  MODIFY `p_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size_price`
--
ALTER TABLE `product_size_price`
  MODIFY `psp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
