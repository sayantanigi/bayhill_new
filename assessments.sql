-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 03:48 PM
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
-- Database: `bayhillds`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `session_date` date NOT NULL,
  `session_status` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `session_type` varchar(50) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `student` int(11) NOT NULL,
  `vehicle` varchar(100) NOT NULL,
  `changing_lane` varchar(20) DEFAULT NULL,
  `changing_lane_grade` varchar(3) DEFAULT NULL,
  `following_distance` varchar(20) DEFAULT NULL,
  `following_distance_grade` varchar(3) DEFAULT NULL,
  `left_turns` varchar(20) DEFAULT NULL,
  `left_turns_grade` varchar(3) DEFAULT NULL,
  `right_turns` varchar(20) DEFAULT NULL,
  `right_turns_grade` varchar(3) DEFAULT NULL,
  `staying_centered` varchar(20) DEFAULT NULL,
  `staying_centered_grade` varchar(3) DEFAULT NULL,
  `general_parking` varchar(20) DEFAULT NULL,
  `general_parking_grade` varchar(3) DEFAULT NULL,
  `straight_line_reversing` varchar(20) DEFAULT NULL,
  `straight_line_reversing_grade` varchar(3) DEFAULT NULL,
  `intersections` varchar(20) DEFAULT NULL,
  `intersections_grade` varchar(3) DEFAULT NULL,
  `acceleration` varchar(20) DEFAULT NULL,
  `acceleration_grade` varchar(3) DEFAULT NULL,
  `breaking` varchar(20) DEFAULT NULL,
  `breaking_grade` varchar(3) DEFAULT NULL,
  `blind_spot` varchar(20) DEFAULT NULL,
  `blind_spot_grade` varchar(3) DEFAULT NULL,
  `freeway_driving` varchar(20) DEFAULT NULL,
  `freeway_driving_grade` varchar(3) DEFAULT NULL,
  `proper_bike_lane` varchar(20) DEFAULT NULL,
  `proper_bike_lane_grade` varchar(3) DEFAULT NULL,
  `unprotected_left_turn` varchar(20) DEFAULT NULL,
  `unprotected_left_turn_grade` varchar(3) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
