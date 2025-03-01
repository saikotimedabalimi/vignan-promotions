-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 10:10 AM
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
-- Database: `news-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(35) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `reset_token`, `reset_expires`) VALUES
(1, 'mk@gmail.com', '$2y$10$73SDI6CKBQ0IpLvNAS9rkeBiq4SyNpf/x5w7QSqaPYkAmLIKajGmO', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `article_title` varchar(250) NOT NULL,
  `article_image` varchar(200) NOT NULL,
  `article_description` text NOT NULL,
  `article_date` date NOT NULL,
  `article_trend` tinyint(4) NOT NULL,
  `article_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(35) NOT NULL,
  `author_password` varchar(100) NOT NULL,
  `author_email` varchar(45) NOT NULL,
  `author_reg_number` varchar(50) NOT NULL,  -- New field for registration number
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_password`, `author_email`, `author_reg_number`) VALUES
(3, 'koti', '$2y$10$yfqAfNTZiiGgStBU9089rOysv0n35bqk9t.M/tjC/H2ahfmPedoyS', 'koti@gmail.com', 'REG12345'),
(5, 'saik', '$2y$10$KsDczdASEcC9.o.Ekms92uI/84T12QzHRgiZbi2o.rltWKF.Ly7Xm', 'sai@gmail.com', 'REG67890');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`bookmark_id`, `user_id`, `article_id`) VALUES
(9, 1, 4),
(10, 2, 7),
(11, 1, 29),
(12, 2, 4),
(16, 1, 1),
(18, 1, 19),
(19, 2, 20),
(20, 4, 37),
(21, 6, 28),
(22, 6, 29),
(23, 1, 37),
(24, 1, 6),
(25, 1, 17),
(26, 1, 7),
(27, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_color` varchar(35) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `category_description` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_color`, `category_image`, `category_description`) VALUES
(1, 'Vignan to day update', 'tag-brown', 'Vignan to day update1736402733.jpeg', '\"Exciting News! Our college has introduced new courses, state-of-the-art facilities, and updated extracurricular programs to enhance your learning experience. Stay tuned for upcoming events and workshops designed to help you grow academically and personally!\"\r\n\r\nLet me know if you’d like a more specific update or additional details included!'),
(2, 'Technology', 'tag-orange', 'Technology1616565177.jpg', 'World is changing rapidly because of the development of technology and boom in the need for technology, because nothing can be done without technology in today\'s world. So be up to date on the latest developments.'),
(3, 'promotions', 'tag-purple', 'promotions1736401764.jpeg', '\"Boost your learning journey with our education promotions! Get special discounts, scholarships, and free resources to help you achieve academic success. Enroll now!\"\r\n\r\nIf you need a specific focus (e.g., discounts, courses, or tools), let me know, and I can tailor the content further.'),
(4, 'Education', 'tag-yellow', 'Education1736401697.jpeg', 'Education is everything to survive in this competetive world. what is the latest when it comes to education and need to get education to every part of the world and the poor.'),
(5, 'sports', 'tag-pink', 'sports1736401674.jpeg', '\"Gear up for greatness with our exclusive sports promotions! Enjoy discounts on top-brand equipment, apparel, and accessories. Train like a pro—shop now!\"\r\n\r\nLet me know if you\'d like this customized further for a specific sport or event!'),
(6, 'Sports', 'tag-purple', 'Sports1616565300.jpg', 'And it\'s a six or GOALLL!!!! are a few things that make us feel like a child. Sports, tournaments and league matches, where is each team standing, what is new in the world of sports??'),
(7, 'events', 'tag-orange', 'events1736401711.jpeg', 'ROLL. CAMERA. ACTION. Behold the drama unfold in the coolest way possible. Catch your favorite celebrities on their new projects and endorsements.'),
(8, 'today updates', 'tag-yellow', 'today updates1736402945.webp', '\"Exciting News! Our college has introduced new courses, state-of-the-art facilities, and updated extracurricular programs to enhance your learning experience. Stay tuned for upcoming events and workshops designed to help you grow academically and personally!\" Let me know if you’d like a more specific update or additional details included!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_reg_number` varchar(50) NOT NULL,  -- New field for registration number
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_reg_number`) VALUES
(7, 'koti', 'koti@gmail.com', '$2y$10$cSJx3HdzzKKFHrBV32EhiOUWLvBLWBPS9ZN9/9F/KNHCTRBDDDusS', 'REG12345'),
(8, 'saik', 'sai@gmail.com', '$2y$10$KsDczdASEcC9.o.Ekms92uI/84T12QzHRgiZbi2o.rltWKF.Ly7Xm', 'REG67890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;