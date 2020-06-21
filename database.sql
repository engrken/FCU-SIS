-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2020 at 02:09 AM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sid` varchar(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `admin` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `lastlogin` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `sid`, `fname`, `mname`, `lname`, `address`, `contact`, `email`, `grade`, `section`, `admin`, `picture`, `ip`, `lastlogin`, `created_at`) VALUES
(1, 'admin', '$2y$10$PaE15zS9ZefYAW6CDdgIq..JBfNvAjhPTI2iRY2C6CrTJjfHEHAUO', '00-000', 'First Name', 'Middle', 'last', 'Barangay', '099999', 'admin@admin.com', '1st Year', 'A', 1, 'Capture.PNG', '49.145.120.179', 'June 13, 2020, 8:38 am', '2020-04-02 05:41:02');


--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);



--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
