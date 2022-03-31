-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 01:21 PM
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
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `exp_date` date NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `user_id`, `name`, `code`, `exp_date`, `course_id`) VALUES
(1, 0, 'aaa', '9XFNGJVFcq', '2022-03-23', 1),
(2, 0, 'aaa', '9XFNGJVFcq', '2022-03-26', 13),
(3, 0, 'aaa', 'j7Ur0IKEzh', '2022-03-03', 19),
(4, 14, 'sfd3', 'CucTB2Ns3e', '2022-03-25', 5);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) NOT NULL,
  `instructor_id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `fancy_title` varchar(1000) NOT NULL,
  `thumbnail` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `access` enum('Free','Registration','Paid','Password') NOT NULL,
  `description` varchar(1000) NOT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT 0,
  `courseID` varchar(20) NOT NULL,
  `timeLimitType` enum('Without Time Limit','Days','Months','Years') DEFAULT NULL,
  `timeLimitValue` int(5) DEFAULT NULL,
  `registration_required_email` tinyint(1) DEFAULT NULL,
  `registration_required_phone` tinyint(1) DEFAULT NULL,
  `registration_required_address` tinyint(1) DEFAULT NULL,
  `registration_required_tos` tinyint(1) DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `paypal_email` varchar(500) DEFAULT 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3',
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
  `coursePassword` varchar(100) DEFAULT NULL,
  `aboutInstructor` varchar(1000) NOT NULL,
  `paypal_client_api_key` varchar(1000) DEFAULT 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3',
  `instructorPicture` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `instructur_website` varchar(100) NOT NULL,
  `instructur_insta` varchar(100) NOT NULL,
  `instructur_facebook` varchar(100) NOT NULL,
  `instructur_linkedin` varchar(100) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `title`, `fancy_title`, `thumbnail`, `access`, `description`, `draft`, `courseID`, `timeLimitType`, `timeLimitValue`, `registration_required_email`, `registration_required_phone`, `registration_required_address`, `registration_required_tos`, `price`, `paypal_email`, `instructor_name`, `back_clr`, `front_clr`, `page_background_type`, `page_background_image`, `page_background_color`, `txtLessonBackground`, `courseTitleBg`, `courseTitleFg`, `signBgColor`, `signFgColor`, `bottomLogo`, `is_deleted`, `coursePassword`, `aboutInstructor`, `paypal_client_api_key`, `instructorPicture`, `instructur_website`, `instructur_insta`, `instructur_facebook`, `instructur_linkedin`, `currency`) VALUES
(1, 15, 'asdffds', '<p><span style=\"text-decoration: underline;\"><em><strong>asdffds</strong></em></span></p>', '12_DBLW4993.JPG', 'Paid', '<p>description</p>', 0, '123', '', 0, 0, 0, 0, 0, 1, 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8r', 'adsf', '#ffffff', '#000000', 'image', '64BqZs.jpg', '#ff0000', '#f0f0f0', '#ffffff', '#000000', '', '', '178494758_10151503797559959_2041080596206641614_n.jpg', 0, '111', 'I am a full stack developer, having over 4 Years of Experience in Web Applications Development, maintaining and updating apps. My areas of expertise are Angular, PHP, JavaScript, MySql, Python, Web Services and Security. My ambition is to reach the very top of my profession and to work with other leading developers in this field. I am committed to constantly improving myself by learning new technologies and frameworks.', NULL, 'default.jpg', 'https://kashifali.me', '', '', 'instagram.com/kashifali_11', 'USD'),
(5, 15, 'asdfadsf', '', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '2081827979', 'Without Time Limit', 0, 0, 0, 0, 0, 23, 'kmalik748@gmail.com', 'Kelin Anderson', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, NULL, '', NULL, 'default.jpg', '', '', '', '', ''),
(6, 15, 'Ron Course', '', 'default.jpg', 'Free', '<h3><strong><em>Course Description here....123123123123</em></strong></h3>', 0, '190423710', '', 0, 0, 0, 0, 0, 0, '', 'Kelin Anderson', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, NULL, '', NULL, 'default.jpg', '', '', '', '', ''),
(13, 14, 'kashfi', '', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '1641646634', '', 0, 0, 0, 0, 0, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '2222', '', NULL, 'default.jpg', '11', '33', '22', '44', ''),
(15, 14, '345345', '', 'default.jpg', 'Registration', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '111', '', 0, 0, 0, 0, 0, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '123', '', NULL, 'default.jpg', '', '', '', '', ''),
(16, 14, 'asf', '', 'default.jpg', 'Password', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '1189939914', 'Without Time Limit', 0, 1, 1, 1, 1, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, 'asf', 'asdfasdf asd fsdaf  sfdaf sd fsd', NULL, 'default.jpg', '', '', '', '', ''),
(17, 14, 'asdfasdfasdf', '', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '1367856839', '', 0, 0, 0, 0, 0, 4, '0', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', 'asdf', NULL, 'default.jpg', '', '', '', '', ''),
(18, 21, 'asdffasdf', '', 'default.jpg', 'Free', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '102628435', 'Without Time Limit', 0, 0, 0, 0, 0, 0, '0', 'aaaaa bbbb', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', 'sadfasdf a sdf sdaf', NULL, 'default.jpg', '', '', '', '', ''),
(19, 21, 'dg 23', '', 'default.jpg', 'Paid', '<h3><strong><em>Course Description here....</em></strong></h3>', 0, '1582839827', '', 0, 0, 0, 0, 0, 0, '0', 'aaaaa bbbb', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', '', NULL, 'IMG_1618.jpg', '', '', '', '', ''),
(20, 14, '2345', '', 'default.jpg', 'Free', '', 0, '1104571009', 'Without Time Limit', 0, 0, 0, 0, 0, 0, '0', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', '', 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3', 'default.jpg', '44', '66', '55', '77', ''),
(21, 14, 'dddddddddddd', '', 'default.jpg', 'Paid', '', 0, '317025682', '', 0, 0, 0, 0, 0, 3, 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', '', 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3', 'default.jpg', '', '', '', '', 'CAD'),
(22, 14, 'kashif', '<p><span style=\"color: #e03e2d;\">testing course</span></p>', 'default.jpg', 'Free', '', 0, '1696474750', '', 0, 0, 0, 0, 0, 0, '', 'Administrator 123', '#ffffff', '#000000', 'color', NULL, '#000000', NULL, '#ffffff', '#000', '#ffffff', '#000', 'default.png', 0, '', '', 'AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3', 'default.jpg', '', '', '', '', 'USD');

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
  `content` mediumtext NOT NULL,
  `arrange_order` int(10) DEFAULT 1111,
  `is_free` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `is_chapter`, `name`, `type`, `content`, `arrange_order`, `is_free`) VALUES
(3, 1, 0, 'Third Course', 'video', 'https://www.youtube.com/watch?v=2sxEsG64CsY&ab_channel=Wrsh98', 3, 0),
(6, 1, 0, 'New Lesson', 'video', 'https://www.youtube.com/watch?v=KEqpwpfFfhE&ab_channel=Nino%27sHome', 6, 0),
(8, 1, 1, 'Ron Chapter', 'video', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/dxHTkqSpz-w\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2, 0),
(10, 1, 0, 'new', 'video', 'https://www.youtube.com/watch?v=2-dndZVOPEM&ab_channel=Geoislam', 8, 1),
(13, 5, 0, 'First Lesson', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1, 0),
(15, 1, 0, 'test', 'video', 'https://www.youtube.com/watch?v=m-f0TnCfqtM&ab_channel=ARYDigital', 4, 0),
(16, 1, 1, 'Tom & Jerry Chap', 'video', 'https://www.youtube.com/watch?v=t0Q2otsqC4I&ab_channel=WBKids', 5, 0),
(17, 6, 0, 'Drama', 'video', 'https://www.youtube.com/watch?v=-e91ibFANEs&ab_channel=ARYDigital', 1, 0),
(19, 1, 0, 'third Lsn', 'video', 'https://www.youtube.com/watch?v=lHMlLCMkuPE&ab_channel=PrimitiveSurvivalTool', 7, 0),
(20, 1, 1, 'Test', 'test', '', 9, 0),
(21, 1, 0, 'Songggg', 'video', 'https://www.youtube.com/watch?v=T3D6lpWxrzM&ab_channel=T-Series', 10, 0),
(24, 1, 0, 'Intro text', 'text', '<p>Online program - Women only&nbsp;</p>\r\n<p>Women\'s Healthy Aging Program + Live Group Sessions With Neeva</p>\r\n<p>This women-only program was built to accommodate the needs of women who are over 40 years old and are now dealing with different issues that can be solved naturally. You will learn how nutrition affects your health and well-being, especially when you are getting older; how you can prevent diabetes, cancer, and other diseases, and overall how to live a healthy and happy life for many years to come.&nbsp;</p>\r\n<p>The program includes the latest knowledge about disease prevention, workout and yoga videos, meal plan, and healthy, delicious easy recipes. It also includes live weekly group sessions, where you will get the chance to ask me questions and connect with me directly..&nbsp;</p>\r\n<div>&nbsp;The sessions will take place every Monday, 7 PM (EST) and will include great motivation for the upcoming week!&nbsp;<br />The live sessions will be recorded so you will be able toasfd&nbsp; sdf</div>', 1, 0),
(25, 1, 0, 'file', 'file', 'CS304 - Midterm MCQS Solved With References By Moaaz.pdf', 12, 0),
(27, 1, 0, 'kashif lesn', 'text', '<h3><strong><em>test lsn</em></strong></h3>', 11, 0),
(29, 1, 0, 'link', 'link', 'https://kashifali.me', 13, 0),
(30, 15, 0, 'asdf', 'link', 'asdf', 1111, 0),
(31, 1, 0, '', 'text', '', 14, 0),
(32, 16, 0, '11', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1, 0),
(33, 16, 0, '', 'text', '<h3><strong><em>Lesson Description here....</em></strong></h3>', 2, 0),
(34, 16, 0, '443', 'text', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 3, 1),
(35, 16, 0, 'v', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 4, 1),
(36, 16, 0, 'now file', 'text', '<h3><strong><em>Lesson Description here....</em></strong></h3>', 1111, 0),
(37, 1, 0, '', 'link', 'https://kashifali.me', 1111, 0),
(38, 17, 0, '', 'link', 'https://kashifali.me', 1111, 0),
(39, 17, 0, '', 'link', 'https://kashifali.me', 1111, 0),
(40, 17, 0, 'Lesson Name', 'video', 'https://www.youtube.com/watch?v=RrpNF9Mu1mQ', 1111, 0),
(41, 17, 1, 'asdf', 'test', '', 1111, 0),
(42, 21, 0, 'now file', 'link', 'https://kashifali.me', 1111, 0);

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
(18, 'asdf', 'asdfasfd', 'km123alik748@gmail.com', '', '', '656554', '1a1dc91c907325c69271ddf0c944bc72', 'Student', 1, 'default.jpg', 0, '2022-03-07 15:02:02', 'Some info about user, edit it form profile section.....'),
(19, 'w5r4w234523445', '', '2423423423', '', '', '4234234234', 'e21222c4fdeb83dfc2f3ae5c6cd160f5', '', 0, 'default.jpg', 0, '2022-03-16 11:53:14', 'Some info about user, edit it form profile section.....   Some info about user, edit it form profile section.....'),
(20, '234234', '', '234234', '', '', '34234', '468171c825c02408cc99935447c785a5', 'Student', 0, 'default.jpg', 0, '2022-03-16 11:54:35', 'Some info about user, edit it form profile section.....   Some info about user, edit it form profile section.....'),
(21, 'aaaaa', 'bbbb', 'kashif1@ali.com', '243234', 'safd s fdsd f', '', '34b4e2f26dbb199c378f9a0bd300c8bf', 'Student', 1, 'default.jpg', 0, '2022-03-19 07:09:48', 'Some info about user, edit it form profile section.....   Some info about user, edit it form profile section.....'),
(22, 'New', 'User', 'madijoh872@snece.com', '', '', '', 'ZK8hbLU8', 'Student', 0, 'default.jpg', 0, '2022-03-19 11:03:31', 'Some info about user, edit it form profile section.....   Some info about user, edit it form profile section.....');

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE `users_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`id`, `user_id`, `course_id`) VALUES
(1, 22, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users_payments`
--

CREATE TABLE `users_payments` (
  `id` int(11) NOT NULL,
  `course_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `response` varchar(9000) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_payments`
--

INSERT INTO `users_payments` (`id`, `course_id`, `user_id`, `response`, `date_time`) VALUES
(1, 222, 0, '{\"id\":\"76F90381WL252153S\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"9KX50001KW864703N\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T12:59:07Z\",\"update_time\":\"2022-03-14T12:59:07Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T12:58:59Z\",\"update_time\":\"2022-03-14T12:59:07Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/76F90381WL252153S\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 12:59:57'),
(2, 1, 0, '{\"id\":\"4FX09976JV5652453\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"2Y296363HX4761458\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:00:22Z\",\"update_time\":\"2022-03-14T13:00:22Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:00:15Z\",\"update_time\":\"2022-03-14T13:00:22Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4FX09976JV5652453\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:00:23'),
(3, 1, 0, '{\"id\":\"8HJ832933K411130A\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"8PH587033F115433N\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:04:45Z\",\"update_time\":\"2022-03-14T13:04:45Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:04:35Z\",\"update_time\":\"2022-03-14T13:04:45Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8HJ832933K411130A\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:04:46'),
(4, 1, 0, '{\"id\":\"21M87100V9511274K\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"3NA60291VH978072H\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:05:12Z\",\"update_time\":\"2022-03-14T13:05:12Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:05:04Z\",\"update_time\":\"2022-03-14T13:05:12Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/21M87100V9511274K\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:05:13'),
(5, 1, 0, '{\"id\":\"5SL49286UA0832459\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"4L239856RX968341M\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:06:44Z\",\"update_time\":\"2022-03-14T13:06:44Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:06:37Z\",\"update_time\":\"2022-03-14T13:06:44Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/5SL49286UA0832459\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:06:44'),
(6, 1, 0, '{\"id\":\"4L737952G1717871C\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"6WB29957JN4310333\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:08:13Z\",\"update_time\":\"2022-03-14T13:08:13Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:07:39Z\",\"update_time\":\"2022-03-14T13:08:13Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4L737952G1717871C\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:08:13'),
(7, 1, 0, '{\"id\":\"0A905943E9234671P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"51F97419JU037112R\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:09:19Z\",\"update_time\":\"2022-03-14T13:09:19Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:09:05Z\",\"update_time\":\"2022-03-14T13:09:19Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/0A905943E9234671P\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:09:19'),
(8, 1, 0, '{\"id\":\"9K933206HN0744433\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"38T62336PD3658906\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:10:30Z\",\"update_time\":\"2022-03-14T13:10:30Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:10:22Z\",\"update_time\":\"2022-03-14T13:10:30Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/9K933206HN0744433\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:10:31'),
(9, 1, 0, '{\"id\":\"4FE165012P295833K\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"2A489309EW1265116\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:14:39Z\",\"update_time\":\"2022-03-14T13:14:39Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:14:32Z\",\"update_time\":\"2022-03-14T13:14:39Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4FE165012P295833K\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:14:40'),
(10, 1, 0, '{\"id\":\"01G03145H94892328\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"payee\":{\"email_address\":\"sb-k6mzj14332776@business.example.com\",\"merchant_id\":\"655H9GNBZ9JGY\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Maire-Victorin\",\"admin_area_2\":\"Toronto\",\"admin_area_1\":\"ON\",\"postal_code\":\"M5A 1E1\",\"country_code\":\"CA\"}},\"payments\":{\"captures\":[{\"id\":\"7WY25950B5974570K\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"CAD\",\"value\":\"2.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-03-14T13:27:44Z\",\"update_time\":\"2022-03-14T13:27:44Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-60taf3204984@personal.example.com\",\"payer_id\":\"H6WSJSFL6KNHC\",\"address\":{\"country_code\":\"CA\"}},\"create_time\":\"2022-03-14T13:27:28Z\",\"update_time\":\"2022-03-14T13:27:44Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/01G03145H94892328\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-03-14 13:27:45'),
(11, 13, 22, 'testttttt', '2022-03-19 11:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_payments`
--
ALTER TABLE `users_payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `forgetpass`
--
ALTER TABLE `forgetpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_payments`
--
ALTER TABLE `users_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
