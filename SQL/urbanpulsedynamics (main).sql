-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 12:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urbanpulsedynamics`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `job_reference_number` char(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'other',
  `street_address` varchar(40) NOT NULL,
  `suburb_town` varchar(20) NOT NULL,
  `state` char(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(254) NOT NULL,
  `skills_list` varchar(20) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `states` enum('new','current','final') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_id`, `job_reference_number`, `first_name`, `last_name`, `date_of_birth`, `gender`, `street_address`, `suburb_town`, `state`, `postcode`, `phone_number`, `email`, `skills_list`, `comments`, `states`) VALUES
(12111, '55555', 'lamia', 'khan', '12/11/2006', 'female', 'dccdc', 'sdvfvb', 'fab', '3000', '112345678909', 'ddfkjvnf@gmail.com', 'fdfv', 'dvdvv', 'current'),
(12113, '12345', 'Dorar', 'Alodhailah', '2026-06-01', 'female', '379A Cheltenham Rd', 'Keysborough', 'VIC', '3173', '0414 478 611', 'dorar0432@gmail.com', ', css, , php, my_sql', 'communictaion', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_ref` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `salary_min` int(11) NOT NULL,
  `salary_max` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `apply_by` date NOT NULL,
  `intro` text NOT NULL,
  `salary_detail` varchar(300) NOT NULL,
  `reports_to` varchar(200) NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_req` text NOT NULL,
  `preferable_req` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_ref`, `title`, `salary_min`, `salary_max`, `location`, `job_type`, `apply_by`, `intro`, `salary_detail`, `reports_to`, `responsibilities`, `essential_req`, `preferable_req`) VALUES
(1, 'SMC01', 'Smart Transport Systems Developer', 85000, 100000, 'Melbourne, VIC', 'Full-time', '2026-04-30', 'We are seeking an experienced Smart Transport Systems Developer to join our UrbanPulse Dynamics team. You will be responsible for designing and developing digital platforms that support smart transport solutions for councils and urban communities across Australia.', '$85,000 - $100,000 per annum (based on experience)', 'Senior Smart City Solutions Manager', 'Design and develop web-based platforms for smart transport monitoring\r\nIntegrate real-time transport data feeds into digital dashboards\r\nCollaborate with council partners to identify transport system needs\r\nConduct testing and performance reviews of transport platforms\r\nParticipate in Agile sprint planning and team meetings', 'Bachelor\'s degree in Computer Science, IT, or Engineering\r\nMinimum 2 years experience in web platform development\r\nStrong proficiency in HTML5, CSS3, and JavaScript\r\nExperience working with real-time data systems\r\nUnderstanding of smart city technologies and urban systems', 'Experience working with local councils or government partners\r\nKnowledge of IoT systems and sensor data integration\r\nFamiliarity with GIS or mapping technologies\r\nExperience with Agile/Scrum project management'),
(2, 'SMC02', 'Energy Monitoring Platform Engineer', 90000, 110000, 'Melbourne, VIC', 'Full-time', '2026-04-30', 'We are looking for a skilled Energy Monitoring Platform Engineer to develop and maintain digital platforms that track and analyse urban energy usage at UrbanPulse Dynamics. You will work closely with industry partners and councils to deliver accurate, accessible energy monitoring solutions for smarter cities.', ' $90,000 - $110,000 per annum (based on experience)', 'Head of Urban Digital Services', 'Build and maintain web platforms for urban energy monitoring\r\nDevelop data visualisation dashboards for energy usage reporting\r\nLiaise with energy providers and council partners for data integration\r\nEnsure platforms meet accessibility and usability standards\r\nMonitor platform performance and implement improvements', 'Bachelor\'s degree in Engineering, IT, or related field\r\nMinimum 2 years experience in platform or systems development\r\nStrong understanding of energy systems and monitoring technologies\r\nProficiency in web development technologies including HTML5 and CSS3\r\nExperience with data visualisation tools and dashboards', 'Experience in smart grid or renewable energy projects\r\nKnowledge of IoT sensor networks and data pipelines\r\nFamiliarity with cloud-based monitoring platforms\r\nExperience working in government or council environments');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `project_Part1_contribution` text DEFAULT NULL,
  `project_Part2_contribution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `role`, `project_Part1_contribution`, `project_Part2_contribution`) VALUES
(1, 'Dorar Alodhailah', 'Member', 'Worked on index.html', 'Task 1: Reuse common UI with PHP includes - moved shared HTMl into .inc files and converted pages to .php. Task 2: Database settings - created settings.php with host, user, password, and database name. Task 7: Created members table and updated about.php to load data from the database. Presentation Management: Order and timing for each member for the presentation. '),
(2, 'Zarin Tasnim', 'Member', 'Worked on jobs.html', 'Task 5: Created jobs table and rendered job descriptions dynamilcally with PHP, added search bar. Task 6: Worked on authentication - added user table and login page.'),
(3, 'Christopher Rose', 'Team leader', 'Worked on apply.html', 'Task 3: Created EOI table and added validated records via process.eoi.php. Task 4: Server-side validation and sanitising of application form.'),
(4, 'Lamia Ahmed Khan', 'Member', 'Worked on about.html', 'Task 6 : Worked on manage.php - list EOIs, search by job reference, delete EOIs and change EOI status.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(260) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'admin', '$2y$10$5fcop3d6mtnAqPGLYhJTU.1qM4UpKezX3k4Sk/HYDyK7oK2bmKDaa', '2026-05-25 08:22:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_ref` (`job_ref`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
