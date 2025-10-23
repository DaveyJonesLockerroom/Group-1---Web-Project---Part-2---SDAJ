/* 17/10/2025 – Added the 'about' (members' contributions) table to the one existing SQL file.  
Created a local copy of 'group1_db' so the 'about' table and its data can be loaded into about.php  
without creating a separate database. - David */




-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 01:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group1_db`
--
CREATE DATABASE IF NOT EXISTS `group1_db`; /* creates database if it already exists, otherwise it moves on */
USE `group1_db`;                           /* making sure we are using the right database */
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2025 at 11:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_status` enum('User','Admin') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_status`) VALUES
(1, 'user', '$2y$10$LhxnnPFjLyW5jTGOJG4rterI2hRUgjpzI7RNsYxMWmkzhRl0/N0NG', 'User'),
(2, 'admin', '$2y$10$H4EakRA4WepRkmlm9OBiR.rmyBW/ANRaNubwhDfqgSJtEytjy2Bpa', 'Admin'),
(3, 'test', '$2y$10$USAc3KD0UFpUU8E7AAebX.UpZi3Y.2lnrTBLjmMGtZ4b.YqTJF.JS', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*--------------------------------------------------------------*/
/* About.php SQL table data */
/*--------------------------------------------------------------*/

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


-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `user_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project_1_contributions` text NOT NULL,
  `project_2_contributions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (member_name, project_1_contributions, project_2_contributions) VALUES
('Ari Stein', 'Designed Jobs page (jobs.html)\nValidating website code', ''),
('David Shi', 'Designed Home page (index.html)\nSubmitting team assignment', 'Designed common UI with PHP includes, settings.php, drafted slides'),
('Silong Song', 'Designed Apply page (apply.html)\nTime keeping and organising weekly team meetings', ''),
('Jack Rosewarne', 'Designed About Page (about.html)\nOrganised and managed Jira checkpoints', '');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



/*--------------------------------------------------------------*/
/* Jobs.php SQL table data */
/*--------------------------------------------------------------*/

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2025 at 08:02 AM
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
-- Database: `group1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(10) NOT NULL,
  `Job Title/Salary` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Responsibilities & Requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `reference_number`, `Job Title/Salary`, `Description`, `Responsibilities & Requirements`) VALUES
(1, 'LP032', 'Lead Game Programmer - $120,000 - $150,000', 'Oversees the programming team and ensures code quality and performance. Reports to: Game Director.', 'Responsibilities: Develop ideas and gameplay systems that fit the overall design of projects. \r\n  Create engaging level designs, puzzles, and mechanics for 2D environments. \r\n  Work closely with programmers and artists to ensure the design vision is faithfully executed. \r\n  Essential Requirements: 5+ years experience in game design or interactive media. \r\n  Proficiency with mainstream design tools such as Unity, Unreal Engine. \r\n  Strong understanding of gameplay flow, pacing, and player engagement. \r\n  Preferable Skills: Experience in tile-based level editors or retro game mechanics design. \r\n  Experience with leading a team and project management.'),
(2, 'GD045', 'Game Designer - $90,000 - $110,000', 'Responsible for designing the core mechanics of our games. Reports to: Lead Game Designer.', 'Responsibilities: Create engaging level designs, puzzles, and mechanics for 2D environments. \r\n  Develop ideas that keep the experience challenging, while still fair. \r\n  Essential Requirements: 2+ years experience in game design. \r\n  Proficiency with design tools such as Unity, Unreal Engine, or Godot. \r\n  Willing to work well with a team and take constructive criticism. \r\n  Preferable Skills: Experience in tile-based level editors or retro game mechanics design. \r\n  Knowledge of classic game genres: platformers, beat ’em ups, and RPGs.'),
(3, 'AR058', '2D Artist - $80,000 - $95,000', 'Create 2D models and animations for our games. Reports to: Art Director.', 'Responsibilities: Create concept art and character designs that fit the game’s aesthetic. \r\n  Produce high-quality 2D assets including sprites, backgrounds, and UI elements. \r\n  Collaborate with designers and programmers to ensure art assets are implemented correctly. \r\n  Essential Requirements: 2+ years experience in 2D art and animation. \r\n  Proficiency with graphic design software such as Adobe Photoshop, Illustrator, or similar tools. \r\n  Preferable Skills: Experience with pixel art and animation techniques. \r\n  Knowledge of game development pipelines and asset optimization.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2025 at 11:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
