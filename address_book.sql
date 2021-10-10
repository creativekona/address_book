-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 10:40 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `address_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_groups`
--

CREATE TABLE `all_groups` (
  `id` bigint(20) NOT NULL,
  `group_name` varchar(40) NOT NULL,
  `parent_group_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_groups`
--

INSERT INTO `all_groups` (`id`, `group_name`, `parent_group_id`, `created_at`) VALUES
(1, 'A', 0, '2021-10-10 10:27:28'),
(2, 'AA', 1, '2021-10-10 10:27:33'),
(3, 'AB', 1, '2021-10-10 10:27:40'),
(4, 'ABA', 3, '2021-10-10 10:27:50'),
(5, 'B', 0, '2021-10-10 10:27:53'),
(6, 'C', 0, '2021-10-10 10:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `created_at`) VALUES
(1, 'Varanasi', '2021-10-06 09:06:26'),
(2, 'New Delhi', '2021-10-06 09:06:26'),
(3, 'Lucknow', '2021-10-06 09:06:26'),
(4, 'Hyderabad', '2021-10-06 09:06:26'),
(5, 'Pune', '2021-10-06 09:06:26'),
(6, 'Prayagraj', '2021-10-06 09:06:26'),
(7, 'Mizapur', '2021-10-06 09:06:26'),
(8, 'Jaunpur', '2021-10-06 09:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `my_addresses`
--

CREATE TABLE `my_addresses` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `street` varchar(40) NOT NULL,
  `zip` int(6) NOT NULL,
  `city` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `my_addresses`
--

INSERT INTO `my_addresses` (`id`, `first_name`, `last_name`, `email`, `street`, `zip`, `city`, `created_at`) VALUES
(1, 'A', '1', 'rbvindra@gmail.com', 'Madachak, Aharaura', 564655, '1', '2021-10-10 10:29:02'),
(2, 'AA', '1', 'sdf@54sd.com', 'Rampur, Sherwan', 654351, '3', '2021-10-10 10:29:18'),
(3, 'AB', '1', 'rbvindra@gmail.com', 'Rampur, Sherwan', 564653, '3', '2021-10-10 10:29:35'),
(4, 'ABA', '1', 'ituxie@gmail.com', 'Daulatabad, Bhulikhas', 564652, '3', '2021-10-10 10:30:03'),
(5, 'B', '1', 'zxsdf@545.sd', 'Rampur, Sherwan', 564651, '3', '2021-10-10 10:30:21'),
(6, 'C', '1', 'rbvindra@gmail.com', 'Madachak, Aharaura', 564651, '3', '2021-10-10 10:30:36'),
(7, 'A, B, C', '2', 'rbvindra@gmail.com', 'Rampur, Sherwan', 564656, '2', '2021-10-10 10:31:13'),
(8, 'AA, ABA', '2', 'sdf@54sd.com', 'Madachak, Aharaura', 564659, '5', '2021-10-10 10:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `relation_address_group`
--

CREATE TABLE `relation_address_group` (
  `id` bigint(20) NOT NULL,
  `address_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relation_address_group`
--

INSERT INTO `relation_address_group` (`id`, `address_id`, `group_id`, `created_at`) VALUES
(1, 1, 1, '2021-10-10 10:29:02'),
(2, 2, 2, '2021-10-10 10:29:18'),
(3, 3, 3, '2021-10-10 10:29:35'),
(4, 4, 4, '2021-10-10 10:30:03'),
(5, 5, 5, '2021-10-10 10:30:21'),
(6, 6, 6, '2021-10-10 10:30:36'),
(7, 7, 1, '2021-10-10 10:31:13'),
(8, 7, 5, '2021-10-10 10:31:13'),
(9, 7, 6, '2021-10-10 10:31:13'),
(10, 8, 2, '2021-10-10 10:32:03'),
(11, 8, 4, '2021-10-10 10:32:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_groups`
--
ALTER TABLE `all_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city` (`city`);

--
-- Indexes for table `my_addresses`
--
ALTER TABLE `my_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relation_address_group`
--
ALTER TABLE `relation_address_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_groups`
--
ALTER TABLE `all_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `my_addresses`
--
ALTER TABLE `my_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `relation_address_group`
--
ALTER TABLE `relation_address_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
