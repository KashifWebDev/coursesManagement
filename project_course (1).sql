-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 09:53 AM
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
  `instructor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `title`, `thumbnail`, `access`, `description`, `draft`, `courseID`, `timeLimitType`, `timeLimitValue`, `registration_required_email`, `registration_required_phone`, `registration_required_address`, `registration_required_tos`, `price`, `paypal_email`, `instructor_name`) VALUES
(1, 11, 'First Course', '12_DBLW4993.JPG', 'Free', '<p>description</p>', 1, 0, '', 0, 0, 0, 0, 0, 0, '', ''),
(5, 1, 'asdfadsf', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, 2081827979, 'Without Time Limit', 0, 0, 0, 0, 0, 23, 'kmalik748@gmail.com', 'Kelin Anderson');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('test','link','file','video') NOT NULL,
  `content` varchar(1000) NOT NULL,
  `arrange_order` int(10) DEFAULT 1111
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `name`, `type`, `content`, `arrange_order`) VALUES
(3, 1, 'Third Course', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2sxEsG64CsY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2),
(6, 1, 'Forth Lesson', 'video', 'https://www.youtube.com/watch?v=n_RDt2LK_tY&ab_channel=Mythpat', 4),
(7, 1, 'Testing Video', 'video', 'https://www.youtube.com/watch?v=X9yBNiDRn78', 3),
(8, 1, 'Ron Video', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/dxHTkqSpz-w\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(10, 2, 'new', 'video', 'https://www.youtube.com/watch?v=2-dndZVOPEM&ab_channel=Geoislam', 1),
(13, 5, 'First Lesson', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1),
(15, 5, 'test', 'video', 'https://www.youtube.com/watch?v=m-f0TnCfqtM&ab_channel=ARYDigital', 2);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
