-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2019 at 08:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distributed_systems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total_price` double NOT NULL,
  `confirm_status` varchar(50) NOT NULL,
  `buyer_username` varchar(50) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address`, `city`, `quantity`, `total_price`, `confirm_status`, `buyer_username`, `product_id`) VALUES
(1, 'abc', 'city', 1, 1000, 'bbbbbbb', '123', 1),
(2, 'hello', 'matara', 10, 120, 'confirmed', 'aaa', 2),
(3, 'aaa', 'aa', 0, 0, 'aaa', 'aaa', 0),
(4, 'ape gedara', 'matara', 1, 100, 'confirmed', 'tharindu123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `product_type`, `description`) VALUES
(1, 'Kapiri', 100, 'Pissu Kapiri', 'Kapiri Kapiri'),
(2, 'AA', 12, 'AA', 'AA'),
(3, 'Banis', 100, 'banis', 'fav bun'),
(5, 'IGURU PAN', 50, 'bun', 'blah blah'),
(6, 'bread', 90, 'bun', 'blah blah'),
(7, 'KIBULA BANIS', 22, 'BANIS', 'Crocodile buns');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `contact_number`, `city`, `email`, `user_type`) VALUES
('111', '111', '111', '111', '111', 'client'),
('111', '111', '111', '111', 'as@as.com', 'admin'),
('123', '123', '123', '123', 'as@as.com', 'admin'),
('aaa', 'aaa', 'aaa', 'aaaa', 'aaaa', 'client'),
('bbb', 'bbb', 'bbb', 'bb', 'bbb', 'client'),
('tharindu', '123456', '071', 'matara', 'ranaweerat@gmail.com', 'admin'),
('Tharindu', '123456', '071131', 'Matara', 'tharindu@gmail.com', 'admin'),
('tharindu123', 'tharindu123', '012121', 'matara', 'ranaweerat@gmail.com', 'client'),
('tharindu1234', 'tharindu1234', '012121', 'matara', 'ranaweerat@gmail.com', 'client'),
('tharindu12345', 'tharindu12345', '012121', 'matara', 'ranaweerat@gmail.com', 'client'),
('zzz', 'zzz', 'zzz', 'zzz', 'zzz@zz.com', 'admin');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
