-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 07:55 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kubera`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_image`) VALUES
(1, 'Nolan', 'https://www.hollywoodreporter.com/wp-content/uploads/2021/09/Christopher-Nolan-attends-the-screening-of-2001-A-Space-Odyssey-Getty-H-2021.jpg'),
(2, 'Rowling', 'https://www.globaltimes.cn/Portals/0/attachment/2020/2020-11-15/5aa0f4cd-ca32-46aa-ac18-79a047db4ebe.jpeg'),
(3, 'M.Mani', 'https://www.mediabistro.com/wp-content/uploads/2014/09/best-selling-author.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `book_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `trending` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `author_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_image`, `amount`, `book_path`, `status`, `trending`, `category_id`, `author_id`) VALUES
(1, 'Memento short story', 'https://nofilmschool.com/sites/default/files/uploads/2013/06/polaroid.jpg', '10', 'https://www.londonscreenwritersfestival.com/assets/Memento-Short-Story-by-Jonathan-Nolan.pdf', 0, 0, 1, 1),
(2, 'Harry Potter Book 1', 'https://upload.wikimedia.org/wikipedia/en/d/d7/Harry_Potter_character_poster.jpg', '10', 'https://hpread.scholastic.com/HP_Book1_Chapter_Excerpt.pdf', 0, 1, 2, 2),
(3, 'Yaar sirandha pakthan', 'https://gymtech.besttech.in/kubera/Yaar_sirandha_pakthan.jpeg', '10', 'https://gymtech.besttech.in/kubera/Yaar_sirandha_pakthan.pdf', 0, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Fiction', 'https://www.indianfolk.com/wp-content/uploads/2017/09/booklights.jpg'),
(2, 'Entertainment', 'https://www.popoptiq.com/wp-content/uploads/2019/01/1-26-1-870x653.jpg'),
(3, 'Spiritual', 'https://i.pinimg.com/474x/55/c1/0b/55c10b3504cea9f9b0161d7fa043b471.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `book_id` int(11) NOT NULL DEFAULT 0,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_id_instamojo` varchar(255) NOT NULL,
  `payment_request_id_instamojo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `book_id`, `payment_date`, `payment_id_instamojo`, `payment_request_id_instamojo`, `status`) VALUES
(1, 1, 1, '2021-11-29 16:42:21', 'MOJO1b29305Q57125356', 'f691122d15e6455ea7c4b8412dc52fc6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `referral_id` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `referral_count` int(11) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 0,
  `stage` int(11) NOT NULL DEFAULT 0,
  `referral_number` varchar(255) NOT NULL DEFAULT '0',
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `mobile_number`, `email`, `referral_id`, `password`, `registered_date`, `status`, `referral_count`, `level`, `stage`, `referral_number`, `payment_status`) VALUES
(1, 'admin', '8883388393', 'revanthapollo@gmail.com', 0, '0', '2021-11-27 21:13:46', 0, 0, 0, 0, '0', 0),
(3, 'Durai', '7092955272', 'aravindmec0w@gmail.com', 0, '12345', '2021-11-29 14:43:25', 0, 0, 0, 0, '0000000342747021', 0),
(4, 'parthiban', '8220101531', 'parthiyeshwanth@gmail.com', 0, 'danushda@1', '2021-11-29 18:36:01', 0, 0, 0, 0, '0000000458181365', 0),
(5, 'prabaharan ', '9791505131', 'athipraba8@gmail.com', 0, 'Digital@88', '2021-11-29 18:36:47', 0, 0, 0, 0, '0000000565737945', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
