-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2025 at 10:26 AM
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

CREATE TABLE `about` (
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
(0, 'Silong Song', 'Designed Apply page (apply.html)\nTime keeping and organising weekly team meetings', ''),
(0, 'Jack Rosewarne', 'Designed About Page (about.html)\nOrganised and managed Jira checkpoints', '');

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
(1, 'LP032', 'Lead Game Programmer - $120,000 - $150,000', 'Oversees the programming team and ensures code quality and performance. Reports to: Game Director.', 'Responsibilities: Develop ideas and gameplay systems that fit the overall design of projects. \r\nCreate engaging level designs, puzzles, and mechanics for 2D environments. \r\nWork closely with programmers and artists to ensure the design vision is faithfully executed. \r\nEssential Requirements: 5+ years experience in game design or interactive media. \r\nProficiency with mainstream design tools such as Unity, Unreal Engine. \r\nStrong understanding of gameplay flow, pacing, and player engagement. \r\nPreferable Skills: Experience in tile-based level editors or retro game mechanics design. \r\nExperience with leading a team and project management.'),
(2, 'GD045', 'Game Designer - $90,000 - $110,000', 'Responsible for designing the core mechanics of our games. Reports to: Lead Game Designer.', 'Responsibilities: Create engaging level designs, puzzles, and mechanics for 2D environments. \r\nDevelop ideas that keep the experience challenging, while still fair. \r\nEssential Requirements: 2+ years experience in game design. \r\nProficiency with design tools such as Unity, Unreal Engine, or Godot. \r\nWilling to work well with a team and take constructive criticism. \r\nPreferable Skills: Experience in tile-based level editors or retro game mechanics design. \r\nKnowledge of classic game genres: platformers, beat ’em ups, and RPGs.'),
(3, 'AR058', '2D Artist - $80,000 - $95,000', 'Create 2D models and animations for our games. Reports to: Art Director.', 'Responsibilities: Create concept art and character designs that fit the game’s aesthetic. \r\nProduce high-quality 2D assets including sprites, backgrounds, and UI elements. \r\nCollaborate with designers and programmers to ensure art assets are implemented correctly. \r\nEssential Requirements: 2+ years experience in 2D art and animation. \r\nProficiency with graphic design software such as Adobe Photoshop, Illustrator, or similar tools. \r\nPreferable Skills: Experience with pixel art and animation techniques. \r\nKnowledge of game development pipelines and asset optimization.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
