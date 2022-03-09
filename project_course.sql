-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 08:10 PM
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
  `access` enum('Free','Registration','Paid','Password') NOT NULL,
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
  `front_clr` varchar(10) NOT NULL DEFAULT '#000000',
  `page_background_type` enum('image','color') NOT NULL DEFAULT 'color',
  `page_background_image` varchar(100) DEFAULT NULL,
  `page_background_color` varchar(100) DEFAULT '#000000',
  `txtLessonBackground` varchar(10) DEFAULT NULL,
  `courseTitleBg` varchar(10) NOT NULL DEFAULT '#ffffff',
  `courseTitleFg` varchar(10) NOT NULL DEFAULT '#000',
  `signBgColor` varchar(10) NOT NULL DEFAULT '#ffffff',
  `signFgColor` varchar(10) NOT NULL DEFAULT '#000',
  `bottomLogo` varchar(100) NOT NULL DEFAULT 'default.png',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `coursePassword` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `title`, `thumbnail`, `access`, `description`, `draft`, `courseID`, `timeLimitType`, `timeLimitValue`, `registration_required_email`, `registration_required_phone`, `registration_required_address`, `registration_required_tos`, `price`, `paypal_email`, `instructor_name`, `back_clr`, `front_clr`, `page_background_type`, `page_background_image`, `page_background_color`, `txtLessonBackground`, `courseTitleBg`, `courseTitleFg`, `signBgColor`, `signFgColor`, `bottomLogo`, `is_deleted`, `coursePassword`) VALUES
(1, 15, 'First Course', '12_DBLW4993.JPG', 'Paid', '<p>description</p>', 0, 123, '', 0, 0, 0, 0, 0, 0, '', '', '#009933', '#ffffff', 'image', '64BqZs.jpg', '#ff0000', '#fa0000', '#ffffff', '#088000', '', '', '178494758_10151503797559959_2041080596206641614_n.jpg', 0, '234'),
(5, 15, 'asdfadsf', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, 2081827979, 'Without Time Limit', 0, 0, 0, 0, 0, 23, 'kmalik748@gmail.com', 'Kelin Anderson', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, NULL),
(6, 15, 'Ron Course', 'default.jpg', 'Free', '<h3><strong><em>Course Description here....123123123123</em></strong></h3>', 0, 190423710, '', 0, 0, 0, 0, 0, 0, '', 'Kelin Anderson', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, NULL),
(14, 14, 'kashfi', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, 1641646634, '', 0, 0, 0, 0, 0, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '2222'),
(15, 14, '345345', 'default.jpg', 'Password', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, 111, '', 0, 1, 1, 1, 1, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '123');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpass`
--

CREATE TABLE `forgetpass` (
  `id` int(11) NOT NULL,
  `user_id` int(3) NOT NULL,
  `code` int(6) NOT NULL,
  `date_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forgetpass`
--

INSERT INTO `forgetpass` (`id`, `user_id`, `code`, `date_time`) VALUES
(1, 15, 680448, 0),
(2, 15, 690736, 0),
(3, 15, 629293, 0),
(4, 15, 640798, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `is_chapter` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('test','link','file','video','text') NOT NULL,
  `content` varchar(1000) NOT NULL,
  `arrange_order` int(10) DEFAULT 1111,
  `is_free` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `is_chapter`, `name`, `type`, `content`, `arrange_order`, `is_free`) VALUES
(3, 1, 0, 'Third Course', 'video', 'https://www.youtube.com/watch?v=2sxEsG64CsY&ab_channel=Wrsh98', 3, 0),
(6, 1, 0, 'New Lesson', 'video', 'https://www.youtube.com/watch?v=KEqpwpfFfhE&ab_channel=Nino%27sHome', 6, 1),
(8, 1, 1, 'Ron Chapter', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/dxHTkqSpz-w\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2, 0),
(10, 1, 0, 'new', 'video', 'https://www.youtube.com/watch?v=2-dndZVOPEM&ab_channel=Geoislam', 8, 1),
(13, 5, 0, 'First Lesson', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1, 0),
(15, 1, 0, 'test', 'video', 'https://www.youtube.com/watch?v=m-f0TnCfqtM&ab_channel=ARYDigital', 4, 0),
(16, 1, 1, 'Tom & Jerry Chap', 'video', 'https://www.youtube.com/watch?v=t0Q2otsqC4I&ab_channel=WBKids', 5, 0),
(17, 6, 0, 'Drama', 'video', 'https://www.youtube.com/watch?v=-e91ibFANEs&ab_channel=ARYDigital', 1, 0),
(19, 1, 0, 'third Lsn', 'video', 'https://www.youtube.com/watch?v=lHMlLCMkuPE&ab_channel=PrimitiveSurvivalTool', 7, 0),
(20, 1, 1, 'Test', 'test', '', 9, 0),
(21, 1, 0, 'Songggg', 'video', 'https://www.youtube.com/watch?v=T3D6lpWxrzM&ab_channel=T-Series', 10, 0),
(24, 1, 0, 'Intro text', 'text', '<h1 style=\"text-align: center;\"><span style=\"color: #e03e2d;\">Intro to course123</span></h1>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\">Welcome !</p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\">Welcome !</p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\"><span style=\"color: #fbeeb8;\">Welco456e !</span></p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\">Welc123e !</p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\">Welc123e !</p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\">Welc123e !</p>\r\n<h1 style=\"text-align: center;\">&nbsp;</h1>\r\n<p style=\"text-align: center;\"><span style=\"color: #ecf0f1;\">Welc123e !</span></p>', 1, 1),
(25, 1, 0, 'file', 'file', 'CS304 - Midterm MCQS Solved With References By Moaaz.pdf', 12, 0),
(27, 1, 0, 'kashif lesn', 'text', '<h3><strong><em>test lsn</em></strong></h3>', 11, 0),
(29, 1, 0, 'link', 'link', 'google', 13, 0),
(30, 15, 0, 'asdf', 'link', 'asdf', 1111, 0),
(31, 1, 0, '', 'text', '', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactNum` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` enum('Admin','Instructor','Student') NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `pic` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `isBlocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `about` varchar(1000) NOT NULL DEFAULT 'Some info about user, edit it form profile section.....   Some info about user, edit it form profile section.....'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contactNum`, `address`, `username`, `password`, `type`, `verified`, `pic`, `isBlocked`, `created_on`, `about`) VALUES
(14, 'Administrator', '123', 'admin@admin.com', NULL, NULL, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'Admin', 1, '178494758_10151503797559959_2041080596206641614_n.jpg', 0, '2022-03-01 07:00:01', 'I\'m a admin'),
(15, 'Instructor', 'User', 'kmalik748@gmail.com', 'asd', 'Main Street', 'adsf', '1a1dc91c907325c69271ddf0c944bc72', 'Instructor', 1, 'default.jpg', 0, '2022-03-01 10:26:38', 'Some info about user, edit it form profile section.....'),
(16, 'Testing', 'asdf', 'sdf@adsf.ad', '', '', 'aksdfj', 'dcb64c94e1b81cd1cd3eb4a73ad27d99', 'Instructor', 0, 'default.jpg', 0, '2022-03-07 15:00:48', 'Some info about user, edit it form profile section.....'),
(18, 'asdf', 'asdfasfd', 'km123alik748@gmail.com', '', '', '656554', '1a1dc91c907325c69271ddf0c944bc72', 'Student', 1, 'default.jpg', 0, '2022-03-07 15:02:02', 'Some info about user, edit it form profile section.....');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpass`
--
ALTER TABLE `forgetpass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forgetpass`
--
ALTER TABLE `forgetpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
