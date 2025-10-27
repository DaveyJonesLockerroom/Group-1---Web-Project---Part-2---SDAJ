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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 10:05 AM
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
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `apply_num` int(11) NOT NULL,
  `reference_number` enum('LP032','GD045','AR058') NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` set('Male','Female') NOT NULL,
  `address` varchar(100) NOT NULL,
  `suburb` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postcode` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` bigint(15) NOT NULL,
  `otherskills` varchar(100) DEFAULT NULL,
  `value` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`apply_num`, `reference_number`, `firstname`, `lastname`, `dateofbirth`, `gender`, `address`, `suburb`, `state`, `postcode`, `email`, `phonenumber`, `otherskills`, `value`) VALUES
(1, 'LP032', 'Ari', 'Stein', '2005-02-06', 'Male', '58 Hilton Road', 'Ferny Creek', 'VIC', 3786, '105764217@student.swin.edu.au', 419634451, 'Ruby', 'New'),
(2, 'GD045', 'Silang', 'Song', '2005-01-17', 'Male', 'Silang', 'Song', 'VIC', 7301, '104548960@student.swin.edu.au', 104548960, '', 'New'),
(3, 'AR058', 'David', 'Shi', '1999-11-27', 'Male', '20 Flinders Lane', 'Melbourne CBD', 'VIC', 3000, '106148333@student.swin.edu.au', 106148333, 'Graphic Design', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
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

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `apply_num` int(11) NOT NULL,
  `cpp` tinyint(1) NOT NULL,
  `java` tinyint(1) NOT NULL,
  `python` tinyint(1) NOT NULL,
  `three_d` tinyint(1) NOT NULL,
  `two_d` tinyint(1) NOT NULL,
  `roadmap` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `apply_num`, `cpp`, `java`, `python`, `three_d`, `two_d`, `roadmap`) VALUES
(1, 1, 0, 0, 1, 0, 1, 0),
(2, 2, 1, 1, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_status` enum('User','Admin') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_status`) VALUES
(1, 'Admin', '$2y$10$EWJygZjQ3fBaYDzfZJ0BjeHJzGwNOVniN7fVqozwJMYLC/scBltHK', 'Admin'),
(2, 'User', '$2y$10$zLIFe/IYvpMrgXWese.DoeWe.LAjm/xlGLtVXn.W9CVi7ocIekAAm', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`apply_num`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD KEY `apply_num` (`apply_num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `apply_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`apply_num`) REFERENCES `eoi` (`apply_num`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* ABOUT table */

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2025 at 10:13 AM
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
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS`about` (
  `user_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project_1_contributions` text NOT NULL,
  `project_2_contributions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`user_id`, `member_name`, `project_1_contributions`, `project_2_contributions`) VALUES
(0, 'Ari Stein', 'Designed Jobs page (jobs.html)\nValidating website code', 'Pages created:\r\n- login.php\r\n- manage.php\r\n- process_eoi.php\r\n- process_login.php\r\n- jobs.php\r\n\r\nOther contributions:\r\n- Created user login table that authenticates username and password\r\n- Developed user manage page\r\n- Implemented database-driven table for jobs.php\r\n- Styling for jobs page\r\n- Table layouts used across pages.'),
(0, 'David Shi', 'Designed Home page (index.html)\nSubmitting team assignment', 'Pages created:\r\n- settings.php\r\n- env_loader.php\r\n- conn.php\r\n- Shared HTML \".inc\" files\r\n\r\nOther contributions:\r\n- Moved shared HTML into \".inc\" files and converted to PHP\r\n- Created database connection (env_loader.php, conn.php)\r\n- Implemented session handling\r\n- Styled responsive index page'),
(0, 'Silang Song', 'Designed Apply page (apply.html)\nTime keeping and organising weekly team meetings', 'Apply page (apply.php)\nOrganising weekly meetings\nExpression of interest table (process_eoi.php)\nDatabase table for EOI and skills section\nSanitised pages'),
(0, 'Jack Rosewarne', 'Designed About Page (about.html)\nOrganised and managed Jira checkpoints', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
