-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 04:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `primary_id` int(11) NOT NULL,
  `worker_id` varchar(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `markdate` date NOT NULL DEFAULT current_timestamp(),
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`primary_id`, `worker_id`, `admin_id`, `markdate`, `status`) VALUES
(11, '102', 1, '2020-01-16', 'A'),
(12, '34', 1, '2020-01-16', 'A'),
(15, '103', 1, '2020-01-16', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `created_at`) VALUES
(1, 'aman', '$2y$10$sb8hF7jM3aF.OVtbKPhJoeAZGBi5wYoe8yWCXGAeiLIiHTlh6s2cK', '2020-01-09'),
(2, 'arjun', '$2y$10$UKxQ.6pRdoYk0trUw5fHpuZgwR5uEqPf1Em/fZKnwUElO.0nwQmni', '2020-01-10'),
(3, 'aryan', '$2y$10$KiqILrmQao0RBQ/LOJLJl.YfXPEEYs43v2pZGVAvYn7t0QRp2dieS', '2020-01-10'),
(7, 'Aman Gupta', '$2y$10$Nth0dcrFACEDwfzfIa3dI.R2YpcYZ1BTQ/Nm74YHsjbB1gl0h5Jky', '2020-01-10'),
(8, 'ayuforrun', '$2y$10$OpGvSw7KAovQN6cxe4qihe/rRxCS7aOFLth7CgGeTQQ0gFCg.8N4.', '2020-01-10'),
(9, 'ariesha', '$2y$10$eaTT/D5CqOUmTAnRNEEHL.Hq/ZW.jgtQDF4JjeYzP6NxCeIwM.DdO', '2020-01-16'),
(10, 'anshi', '$2y$10$vFNfmn7ZrbU9F8xbIMcie.vN/50XNZ41L8OODRgjkP62U0Mz1xv4S', '2020-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `u_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL,
  `image6` varchar(255) NOT NULL,
  `image7` varchar(255) NOT NULL,
  `image8` varchar(255) NOT NULL,
  `image9` varchar(255) NOT NULL,
  `image10` varchar(255) NOT NULL,
  `script` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`u_id`, `worker_id`, `admin_id`, `name`, `age`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`, `image7`, `image8`, `image9`, `image10`, `script`) VALUES
(29, 102, 1, 'aman', 24, '102-1.png', '102-2.png', '102-3.png', '102-4.png', '102-5.png', '102-6.png', '102-7.png', '102-8.png', '102-9.png', '102-10.png', 'fgfg'),
(30, 103, 1, 'gupta', 24, '103-1.jfif', '103-2.jfif', '103-3.jfif', '103-4.PNG', '103-5.PNG', '103-6.PNG', '103-7.PNG', '103-8.PNG', '103-9.PNG', '103-10.jfif', 'yyyy'),
(31, 34, 1, 'ariesha', 22, '34-1.PNG', '34-2.PNG', '34-3.PNG', '34-4.PNG', '34-5.PNG', '34-6.PNG', '34-7.PNG', '34-8.PNG', '34-9.PNG', '34-10.PNG', 'fsdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`primary_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
