-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 03:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vawc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `case_id` int(11) NOT NULL,
  `case_number` varchar(50) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `is_new_record` tinyint(1) DEFAULT NULL,
  `victim_id` int(11) DEFAULT NULL,
  `date_reported` date DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `current_residence` text DEFAULT NULL,
  `date_of_incident` date DEFAULT NULL,
  `time_of_incident` varchar(50) DEFAULT NULL,
  `place_of_incident` text DEFAULT NULL,
  `case_filed` tinyint(1) DEFAULT NULL,
  `filed_at` varchar(100) DEFAULT NULL,
  `date_filed` date DEFAULT NULL,
  `case_status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_creators`
--

CREATE TABLE `case_creators` (
  `id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_nature`
--

CREATE TABLE `case_nature` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `law_code` varchar(20) DEFAULT NULL,
  `law_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `list_of_ppas` text DEFAULT NULL,
  `note_from_bghmc` text DEFAULT NULL,
  `note_from_cswdo` text DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `assisting_personnel` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perpetrators`
--

CREATE TABLE `perpetrators` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `relationship_to_victim` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `educational_attainment` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services_provided`
--

CREATE TABLE `services_provided` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `referred_to_cswdo` tinyint(1) DEFAULT 0,
  `services_by_cswdo` tinyint(1) DEFAULT 0,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `referred_to_pnp` tinyint(1) DEFAULT 0,
  `services_by_pnp` tinyint(1) DEFAULT 0,
  `referred_to_court` tinyint(1) DEFAULT 0,
  `referred_to_bghmc` tinyint(1) DEFAULT 0,
  `services_by_bghmc` tinyint(1) DEFAULT 0,
  `applied_bpo` tinyint(1) DEFAULT 0,
  `issued_bpo` tinyint(1) DEFAULT 0,
  `others_specify` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `office` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `full_name`, `position`, `office`, `role`) VALUES
(1, 'admin', 'admin', 'Francis Flores', 'Chief Officer', 'PACD', 'Admin'),
(2, 'staff', '$2y$10$TPsEpOmEwTpW9VKiXRCta.aImMuwrq7aUWQBYDbo3KMoWsaPoox4u', 'Mariel Haban', 'PO1', 'PACD', 'Police Staff'),
(3, 'staff', '$2y$10$DXl61VGcjJQuVJ766DahsORgScgMrXhGkNhc0HRUxclixq8YvlKvq', 'Randy Cardinez', 'PO1', 'Lab', NULL),
(4, 'staff', '$2y$10$XKHhV2LnG5RaJ2ctNmQmuuKM7wqA9Kyncg0b9568lV3rP7qA4wUbS', 'Cornee Y. Zambrano', 'PO2', 'Legal Office', 'Staff'),
(5, '123', '$2y$10$d7SJu9fmX.nWuAqFvGJl/uP/zhST1tSplz2LjPHn0HhOGUNmsV9Mu', 'Cordnee Y marilozo', 'SPO1', 'Legal Office', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `victims`
--

CREATE TABLE `victims` (
  `id` int(11) NOT NULL,
  `victim_first_name` varchar(255) DEFAULT NULL,
  `victim_middle_name` varchar(255) DEFAULT NULL,
  `victim_last_name` varchar(255) DEFAULT NULL,
  `victim_name_extension` varchar(255) DEFAULT NULL,
  `birth_certificate_no` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age_during_incident` int(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `educational_attainment` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_id`),
  ADD KEY `fk_cases_victim_id` (`victim_id`);

--
-- Indexes for table `case_creators`
--
ALTER TABLE `case_creators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `case_nature`
--
ALTER TABLE `case_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `perpetrators`
--
ALTER TABLE `perpetrators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `services_provided`
--
ALTER TABLE `services_provided`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `victims`
--
ALTER TABLE `victims`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_creators`
--
ALTER TABLE `case_creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_nature`
--
ALTER TABLE `case_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perpetrators`
--
ALTER TABLE `perpetrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_provided`
--
ALTER TABLE `services_provided`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `victims`
--
ALTER TABLE `victims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `fk_cases_victim_id` FOREIGN KEY (`victim_id`) REFERENCES `victims` (`id`);

--
-- Constraints for table `case_creators`
--
ALTER TABLE `case_creators`
  ADD CONSTRAINT `case_creators_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`),
  ADD CONSTRAINT `case_creators_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `case_nature`
--
ALTER TABLE `case_nature`
  ADD CONSTRAINT `case_nature_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`);

--
-- Constraints for table `perpetrators`
--
ALTER TABLE `perpetrators`
  ADD CONSTRAINT `perpetrators_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`);

--
-- Constraints for table `services_provided`
--
ALTER TABLE `services_provided`
  ADD CONSTRAINT `services_provided_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
