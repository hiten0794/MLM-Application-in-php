-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2018 at 08:55 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `create_date`) VALUES
(8, 'Category 1', 'Category 1', '2018-06-01 06:12:50'),
(9, 'Category 2', 'Category 2', '2018-06-01 06:12:59'),
(10, 'Category 3', 'Category 3', '2018-06-01 06:13:07'),
(11, 'Category 4', 'Category 4', '2018-06-01 06:13:13'),
(12, 'Category 5', 'Category 5', '2018-06-01 06:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `member_log`
--

CREATE TABLE `member_log` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `parent_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_log`
--

INSERT INTO `member_log` (`id`, `name`, `parent_id`) VALUES
(335, 'Hiten Pingolia', 0),
(336, 'Ramesh kumar', 335),
(337, 'Shyam lal', 336),
(338, 'Chander Prakash', 335),
(339, 'Rajesh', 335),
(340, 'Mahesh', 339),
(341, 'Mahendra singh', 338),
(342, 'Rakesh kumar', 341),
(343, 'Sanjay', 341);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` text NOT NULL,
  `member_id` text NOT NULL,
  `member_name` text NOT NULL,
  `product_id` text NOT NULL,
  `qty` text NOT NULL,
  `is_igst` text NOT NULL,
  `unit_price` text NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `member_id`, `member_name`, `product_id`, `qty`, `is_igst`, `unit_price`, `create_date`) VALUES
(242, '03351527834133', '335', 'Hiten Pingolia', '234263', '1', 'undefined', '45000', '2018-06-01 08:22:13'),
(243, '03351527834332', '335', 'Hiten Pingolia', '234262', '1', 'undefined', '20000', '2018-06-01 08:25:32'),
(245, '03351527834508', '335', 'Bhawani Singh', '234261', '1', 'undefined', '15000', '2018-06-01 08:28:28'),
(246, '03351527834551', '335', 'Bhawani', '234261', '1', 'undefined', '15000', '2018-06-01 08:29:11'),
(247, '03361527834641', '336', 'Ramesh kumar', '234263', '1', 'undefined', '45000', '2018-06-01 08:30:41'),
(248, '03371527834720', '337', 'Shyam lal', '234260', '1', 'undefined', '10000', '2018-06-01 08:32:00'),
(249, '03381527834813', '338', 'Chander Prakash', '234262', '1', 'undefined', '20000', '2018-06-01 08:33:33'),
(250, '03391527835036', '339', 'Rajesh', '234261', '1', 'undefined', '15000', '2018-06-01 08:37:16'),
(251, '03401527835071', '340', 'Mahesh', '234263', '1', 'undefined', '45000', '2018-06-01 08:37:51'),
(252, '03411527835114', '341', 'Mahendra singh', '234260', '1', 'undefined', '10000', '2018-06-01 08:38:34'),
(253, '03421527835156', '342', 'Rakesh kumar', '234262', '1', 'undefined', '20000', '2018-06-01 08:39:16'),
(254, '03431527835180', '343', 'Sanjay', '234262', '1', 'undefined', '20000', '2018-06-01 08:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` text NOT NULL,
  `ProductName` text NOT NULL,
  `ProductCategory` text NOT NULL,
  `Tax` text NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL,
  `igst` float NOT NULL,
  `Available_qty` int(10) NOT NULL,
  `SKU` text NOT NULL,
  `Price` int(11) NOT NULL,
  `hsn` varchar(20) NOT NULL,
  `sac` varchar(20) NOT NULL,
  `SalePrice` int(11) NOT NULL,
  `description` text NOT NULL,
  `productImage` text NOT NULL,
  `company_name` text NOT NULL,
  `company_email` text NOT NULL,
  `company_phone` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Pincode` text NOT NULL,
  `company_address` text NOT NULL,
  `ip_address` text NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `type`, `ProductName`, `ProductCategory`, `Tax`, `sgst`, `cgst`, `igst`, `Available_qty`, `SKU`, `Price`, `hsn`, `sac`, `SalePrice`, `description`, `productImage`, `company_name`, `company_email`, `company_phone`, `City`, `State`, `Pincode`, `company_address`, `ip_address`, `create_date`) VALUES
(234260, 133, '', 'Product 1', 'Category 2', '', 5, 2, 1, 10, 'KJO8754', 10000, '', '', 10000, 'product desctrion ', 'test_-_Copy_(2).png', '', '', '', '', '', '', '', '::1', '2018-06-01 08:15:03'),
(234261, 133, '', 'Product 2', 'Category 3', '', 5, 2, 1, 10, 'KJO8754', 15000, '', '', 15000, 'product desctrion ', 'test_-_Copy_(2).png', '', '', '', '', '', '', '', '::1', '2018-06-01 08:16:48'),
(234262, 133, '', 'Product 3', 'Category 4', '', 5, 2, 1, 10, 'KJO8755', 20000, '', '', 20000, 'product desctrion ', 'test_-_Copy_(2).png', '', '', '', '', '', '', '', '::1', '2018-06-01 08:17:02'),
(234263, 133, '', 'Product 4', 'Category 5', '', 5, 2, 1, 10, 'KJO8754', 45000, '', '', 45000, 'product desctrion ', 'test_-_Copy_(2).png', '', '', '', '', '', '', '', '::1', '2018-06-01 08:17:16'),
(234264, 0, 'Purchase', 'test', '', '2', 0, 0, 0, 50, '', 4500, '', '', 4500, 'test', '', 'sinhit', 'test@test.com', '9785834', 'Jaipur', 'rajasthan', '302039', 'VDN, Jaipur, dfdf, dfdf\r\ndfdf', '::1', '2018-06-01 08:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `qty` int(10) NOT NULL,
  `unit_price` int(10) NOT NULL,
  `TaxAmount` text NOT NULL,
  `Tax` text NOT NULL,
  `description` text NOT NULL,
  `company_name` text NOT NULL,
  `company_email` text NOT NULL,
  `company_phone` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Pincode` text NOT NULL,
  `company_address` text NOT NULL,
  `ip_address` text NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `name`, `qty`, `unit_price`, `TaxAmount`, `Tax`, `description`, `company_name`, `company_email`, `company_phone`, `City`, `State`, `Pincode`, `company_address`, `ip_address`, `create_date`) VALUES
(12, 'Producth', 80, 599, '', '', 'Test test sadlfk', 'Testing', 'test@gmail.com', '978585834812', '', '', '', 'tes asdlf asdf ', '::1', '2018-01-25 11:47:15'),
(15, 'Product 1111', 5, 250, '', '', 'asdfaasfasdf', ' asldfk', 'test@gmail.com', '3424234', '', '', '', 'sdfsadfsdf', '::1', '2018-01-24 19:01:51'),
(17, 'Product 6', 5, 599, '', '', 'Test test sadlfk', 'Testing', 'test@gmail.com', '978585834812', '', '', '', 'tes asdlf asdf ', '::1', '2018-01-25 09:38:29'),
(18, 'Productererre', 5, 599, '', '', 'Test test sadlfk', 'Testing', 'test@gmail.com', '978585834812', '', '', '', 'tes asdlf asdf ', '::1', '2018-01-25 09:40:10'),
(23, 'Product Helo', 800, 599, '', '', 'Test test sadlfk', 'Testing', 'test@gmail.com', '978585834812', '', '', '', 'tes asdlf asdf ', '::1', '2018-01-25 11:47:24'),
(26, 'sari', 100, 500, '2500', '', 'rffghfhf', 'bvvb fg', 'gfg@gdfg', '878768768', 'ggfh', 'hgfhgfh', '4545', 'ghjgjhgj', '157.37.128.110', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `value`) VALUES
(1, 'tax', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `alternateEmail` text NOT NULL,
  `mobile_no` text NOT NULL,
  `language` text NOT NULL,
  `website` text NOT NULL,
  `picture_url` text NOT NULL,
  `profile_url` text NOT NULL,
  `dob` text NOT NULL,
  `gender` text NOT NULL,
  `about` text NOT NULL,
  `locale` text NOT NULL,
  `designation` text NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `pincode` text NOT NULL,
  `vat_number` text NOT NULL,
  `AccountNumber` text NOT NULL,
  `IFSCCode` text NOT NULL,
  `ip_address` text NOT NULL,
  `created` text NOT NULL,
  `lastlogged` text NOT NULL,
  `modified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `name`, `first_name`, `last_name`, `email`, `alternateEmail`, `mobile_no`, `language`, `website`, `picture_url`, `profile_url`, `dob`, `gender`, `about`, `locale`, `designation`, `address`, `country`, `city`, `pincode`, `vat_number`, `AccountNumber`, `IFSCCode`, `ip_address`, `created`, `lastlogged`, `modified`) VALUES
(133, 'admin@mlm.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PeFJqcpURF2QOrH4vqMEQELe9wDMLfZYe', 'Admin', 1, 'Admin MLM', 'Admin', 'MLM', 'admin@mlm.com', '', '9785834812', '', '', '2.png', '', '', '', 'about applicaiton', '', '', 'VDN Jaipur', 'india', 'JAIPUR', '332710', '', '', '', '::1', '2018-01-06 13:23:35', '01-06-2018 08:02 AM', '2018-06-01 08:08:38'),
(335, 'test@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PeLoyYG/tmPfdXxuFRSkC2pxeIfZSJYyq', 'Customer', 1, 'Hiten Pingolia', '', '', 'test@gmail.com', '', '9785834812', '', '', 'Hiten_Pingolia_n_2.jpg', '', '', '', '', '', '', 'VDN, Jaipur', '', '', '302039', '', '', '', '::1', '2018-06-01 08:22:13', '', ''),
(336, 'asdfsdf@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PevCL1nsTUdkc66kifObY9qjCaoO/7ctu', 'Customer', 0, 'Ramesh kumar', '', '', 'asdfsdf@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur, dfdf\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:30:41', '', ''),
(337, 'sll@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PebiuZICwrEHnLNE8ki24QtQGRs/9fgpu', 'Customer', 0, 'Shyam lal', '', '', 'sll@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:31:59', '', ''),
(338, 'ch@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PekLINsFq0HfMut2rbzXaD33SZ7WwUth.', 'Customer', 0, 'Chander Prakash', '', '', 'ch@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\n', '', '', '302039', '', '', '', '::1', '2018-06-01 08:33:32', '', ''),
(339, 'hiten0794@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PeHOnrjOJy5AZjouAQeWcQLb5MOtR9e4S', 'Customer', 0, 'Rajesh', '', '', 'hiten0794@gmail.com', '', '9785834812', '', '', '41.png', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:37:16', '', ''),
(340, 'asdf@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PeSILXXkosyp9DRRxrhmJa81LgvnwZBK6', 'Customer', 0, 'Mahesh', '', '', 'asdf@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:37:51', '', ''),
(341, 'arer@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1PeZksiurniWOXvt7bdTbXRCw6BtWp8OSO', 'Customer', 0, 'Mahendra singh', '', '', 'arer@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:38:33', '', ''),
(342, 'adsfasdfsdf@gmail.com', '$2y$12$RyMmZVcqPEt9X2lJbHg1Pe6VH8iAAzbIVBPsgkWn.VcyhZwU72KGO', 'Customer', 0, 'Rakesh kumar', '', '', 'adsfasdfsdf@gmail.com', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:39:15', '', ''),
(343, 's@gmail.comdfsdfs', '$2y$12$RyMmZVcqPEt9X2lJbHg1Pe2DzcekIZBqB3qcGslZEtH5BSg9SLfLK', 'Customer', 0, 'Sanjay', '', '', 's@gmail.comdfsdfs', '', '9785834812', '', '', '', '', '', '', '', '', '', 'VDN, Jaipur\r\ndfdf', '', '', '302039', '', '', '', '::1', '2018-06-01 08:39:39', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_log`
--
ALTER TABLE `member_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234265;
--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
