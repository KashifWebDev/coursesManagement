-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 12:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_course`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `course_id`, `name`) VALUES
(1, 1, 'Intro to course'),
(2, 1, 'Advance concepts..'),
(3, 1, 'Ending of chapter');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) NOT NULL,
  `instructor_id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `thumbnail` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `access` enum('Free','Registration','Paid') NOT NULL,
  `description` varchar(1000) NOT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT 0,
  `courseID` int(11) NOT NULL,
  `timeLimitType` enum('Without Time Limit','Days','Months','Years') DEFAULT NULL,
  `timeLimitValue` int(5) DEFAULT NULL,
  `registration_required_email` tinyint(1) DEFAULT NULL,
  `registration_required_phone` tinyint(1) DEFAULT NULL,
  `registration_required_address` tinyint(1) DEFAULT NULL,
  `registration_required_tos` tinyint(1) DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `paypal_email` varchar(50) DEFAULT NULL,
  `instructor_name` varchar(50) NOT NULL,
  `back_clr` varchar(10) NOT NULL DEFAULT '#ffffff',
  `front_clr` varchar(10) NOT NULL DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `title`, `thumbnail`, `access`, `description`, `draft`, `courseID`, `timeLimitType`, `timeLimitValue`, `registration_required_email`, `registration_required_phone`, `registration_required_address`, `registration_required_tos`, `price`, `paypal_email`, `instructor_name`, `back_clr`, `front_clr`) VALUES
(1, 11, 'First Course', '12_DBLW4993.JPG', 'Free', '<p>description</p>', 1, 123, '', 0, 0, 0, 0, 0, 0, '', '', '#ffffff', '#000000'),
(5, 1, 'asdfadsf', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, 2081827979, 'Without Time Limit', 0, 0, 0, 0, 0, 23, 'kmalik748@gmail.com', 'Kelin Anderson', '#ffffff', '#000000'),
(6, 1, 'Ron Course', 'default.jpg', 'Free', '<h3><strong><em>Course Description here....123123123123</em></strong></h3>', 0, 190423710, '', 0, 0, 0, 0, 0, 0, '', 'Kelin Anderson', '#ffffff', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `chapter_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('test','link','file','video') NOT NULL,
  `content` varchar(1000) NOT NULL,
  `arrange_order` int(10) DEFAULT 1111
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `chapter_id`, `name`, `type`, `content`, `arrange_order`) VALUES
(3, 1, 1, 'Third Course', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2sxEsG64CsY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(6, 1, 1, 'Forth Lesson', 'video', 'https://www.youtube.com/watch?v=n_RDt2LK_tY&ab_channel=Mythpat', 2),
(8, 1, 1, 'Ron Video', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/dxHTkqSpz-w\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(10, 1, 1, 'new', 'video', 'https://www.youtube.com/watch?v=2-dndZVOPEM&ab_channel=Geoislam', 4),
(13, 5, 1, 'First Lesson', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1),
(15, 1, 2, 'test', 'video', 'https://www.youtube.com/watch?v=m-f0TnCfqtM&ab_channel=ARYDigital', 5),
(16, 1, 2, 'Tom & Jerry', 'video', 'https://www.youtube.com/watch?v=t0Q2otsqC4I&ab_channel=WBKids', 6),
(17, 6, 2, 'Drama', 'video', 'https://www.youtube.com/watch?v=-e91ibFANEs&ab_channel=ARYDigital', 1),
(19, 1, 3, 'first lesson of third chapter', 'video', 'https://www.youtube.com/watch?v=lHMlLCMkuPE&ab_channel=PrimitiveSurvivalTool', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
