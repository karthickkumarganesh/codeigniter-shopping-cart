-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2015 at 07:02 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dss`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(20) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_time`, `modified_time`) VALUES
(1, 'Toys', '2015-05-27 10:33:10', '0000-00-00 00:00:00'),
(2, 'Electronics', '2015-05-27 10:33:10', '0000-00-00 00:00:00'),
(3, 'test', '2015-05-27 12:33:07', '0000-00-00 00:00:00');

--
-- Triggers `category`
--
DELIMITER //
CREATE TRIGGER `product_info_delete` AFTER DELETE ON `category`
 FOR EACH ROW DELETE FROM products
    WHERE products.products_category_id = old.category_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orders_id` int(20) NOT NULL,
  `order_ref_id` varchar(200) NOT NULL,
  `user_ref_id` int(20) NOT NULL,
  `product_ref_id` int(20) NOT NULL,
  `product_quantity` int(20) NOT NULL,
  `product_price` double NOT NULL,
  `total` double NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_ref_id`, `user_ref_id`, `product_ref_id`, `product_quantity`, `product_price`, `total`, `created_date`, `modified_date`) VALUES
(1, 'ZVlpfVtbDSYs1Ms', 3, 6, 1, 150.85, 150.85, '2015-05-31 10:27:50', '0000-00-00 00:00:00'),
(2, 'YK50VELd34hbAQB', 3, 4, 1, 102.2, 102.2, '2015-05-31 10:28:19', '0000-00-00 00:00:00'),
(3, 'YxMiAa3HZAZzh1p', 3, 5, 1, 150.85, 150.85, '2015-05-31 10:30:54', '0000-00-00 00:00:00'),
(4, 'YxMiAa3HZAZzh1p', 3, 4, 1, 102.2, 102.2, '2015-05-31 10:30:54', '0000-00-00 00:00:00'),
(5, 'YxMiAa3HZAZzh1p', 3, 6, 1, 150.85, 150.85, '2015-05-31 10:30:54', '0000-00-00 00:00:00'),
(6, 'etESYQJyXgR7EPf', 5, 4, 1, 102.2, 102.2, '2015-05-31 16:35:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`products_id` int(20) NOT NULL,
  `products_name` varchar(500) NOT NULL,
  `products_price` double(10,2) NOT NULL,
  `products_category_id` int(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_price`, `products_category_id`, `created_date`, `modified_date`) VALUES
(4, 'product one', 102.20, 1, '2015-05-28 06:27:05', '2015-05-28 06:40:35'),
(5, 'product two', 150.85, 2, '2015-05-28 06:27:05', '2015-05-28 07:54:19'),
(6, 'product three', 150.85, 2, '2015-05-28 06:27:05', '2015-05-28 07:54:19');

--
-- Triggers `products`
--
DELIMITER //
CREATE TRIGGER `products_images_delete` AFTER DELETE ON `products`
 FOR EACH ROW delete from products_image where products_image.products_ref_id=old.products_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE IF NOT EXISTS `products_image` (
`products_images_id` int(20) NOT NULL,
  `products_ref_id` int(20) NOT NULL,
  `products_image_path` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products_image`
--

INSERT INTO `products_image` (`products_images_id`, `products_ref_id`, `products_image_path`, `created_date`, `modified_date`) VALUES
(4, 4, 'product_images/image1.jpg', '2015-05-28 07:53:58', '2015-05-28 08:12:50'),
(5, 4, 'product_images/image2.jpg', '2015-05-28 07:53:58', '2015-05-28 08:12:54'),
(6, 5, 'product_images/image3.jpg', '2015-05-28 07:53:58', '2015-05-28 08:12:57'),
(7, 5, 'product_images/image4.jpg', '2015-05-28 07:53:58', '2015-05-28 08:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(20) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_password` text NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `facebook_user` tinyint(1) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_type`, `user_status`, `facebook_user`, `created_time`, `modified_time`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 0, '2015-05-27 06:25:21', '0000-00-00 00:00:00'),
(2, 'user@user.com', '21232f297a57a5a743894a0e4a801fc3', 0, 1, 0, '2015-05-27 06:25:21', '0000-00-00 00:00:00'),
(3, 'test@test.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 0, '2015-05-30 10:04:43', '0000-00-00 00:00:00'),
(4, 'wel@wel.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 0, '2015-05-31 15:45:45', '0000-00-00 00:00:00'),
(5, 'karthickkumarganesh@gmail.com', '', 0, 1, 1, '2015-05-31 16:34:39', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`), ADD UNIQUE KEY `unique` (`category_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
 ADD PRIMARY KEY (`products_images_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `orders_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `products_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE `products_image`
MODIFY `products_images_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
