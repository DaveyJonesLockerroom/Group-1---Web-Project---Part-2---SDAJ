-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2025 at 12:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `about_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_db`
--

CREATE TABLE `about_db` (
  `user_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project_1_contributions` text NOT NULL,
  `project_2_contributions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_db`
--

INSERT INTO `about_db` (`user_id`, `member_name`, `project_1_contributions`, `project_2_contributions`) VALUES
(1, 'Ari Stein ', 'Designed Jobs page (jobs.html)\r\nValidating website code\r\n', ''),
(2, 'David Shi ', 'Designed Home page (index.html) \r\nSubmitting team assignment ', 'Designed common UI with PHP includes, settings.php, created member contribution table for about.php, drafted and prepared presentation slides. '),
(3, 'Silong Song', 'Designed Apply page (apply.html)\r\nTime keeping and organising weekly team meetings ', ''),
(4, 'Jack Rosewarne', 'Designed About Page (about.html)\r\nOrganised and managed Jira checkpoints', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_db`
--
ALTER TABLE `about_db`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_db`
--
ALTER TABLE `about_db`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
