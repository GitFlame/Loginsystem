-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `username`, `email_id`, `password`, `created_at`, `is_deleted`) VALUES
(13, 'ajay', 'ajay@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 12:35:55', '0'),
(14, 'Rakesh', 'test2@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 12:52:06', '0'),
(16, 'Rohit', 'test3@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 12:53:08', '0'),
(17, 'Ramesh', 'test4@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 12:53:56', '0'),
(18, 'Ranvijay', 'test5@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 12:54:33', '0'),
(19, 'Rameshwar Dutta', 'rameshwardutta@gmail.com', 'a8db66f282b6f727c0b746bd5e97745b', '2023-10-16 19:11:42', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
