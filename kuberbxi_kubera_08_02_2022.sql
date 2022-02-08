-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2022 at 01:47 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuberbxi_kubera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_name`, `mobile_number`, `password`) VALUES
('kubera', '8056663491', 'kubera_password');

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
(3, 'M.Mani', 'https://www.mediabistro.com/wp-content/uploads/2014/09/best-selling-author.jpg'),
(12, 'Kalki', 'https://kuberaatechnologies.com/uploads/Kalki_Krishnamurthy_Tamil_Writer.jpg'),
(13, 'Sandilyan', 'https://kuberaatechnologies.com/uploads/SandilyanPic.jpg'),
(15, 'Sujatha', 'https://kuberaatechnologies.com/uploads/MV5BNWVjMjFjYmItNzI5OS00NzQ5LTgwMGEtMDQwOTlmOTI1MTU5XkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_.jpg'),
(16, 'Jeyaganthan', 'https://kuberaatechnologies.com/uploads/843589.jpg'),
(17, 'Indhra soundharajan', 'https://kuberaatechnologies.com/uploads/17087752.jpg'),
(18, 'Vairamuthu', 'https://kuberaatechnologies.com/uploads/MV5BZmQzMmMyOTEtZmQ5ZC00ODRkLWI0ZTMtODU3YmY1NDEzNDI5XkEyXkFqcGdeQXVyMjYwMDk5NjE@._V1_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_details_id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` int(11) NOT NULL DEFAULT '0',
  `trending` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_image`, `amount`, `book_path`, `status`, `trending`, `category_id`, `author_id`) VALUES
(3, 'Yaar sirandha pakthan', 'https://kuberaatechnologies.com/Yaar_sirandha_pakthan.jpeg', '21', 'https://kuberaatechnologies.com/Yaar_sirandha_pakthan.pdf', 0, 1, 3, 3);

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
(3, 'Spiritual', 'https://kuberaatechnologies.com/uploads/Spritual.png'),
(15, 'Entertainment ', 'https://kuberaatechnologies.com/uploads/4.png'),
(16, 'Sports ', 'https://kuberaatechnologies.com/uploads/3.png'),
(17, 'Love', 'https://kuberaatechnologies.com/uploads/5.png'),
(18, 'Science ', 'https://kuberaatechnologies.com/uploads/6.png'),
(19, 'Travels', 'https://kuberaatechnologies.com/uploads/7.png'),
(20, 'Yoga', 'https://kuberaatechnologies.com/uploads/8.png'),
(21, 'Cooking ', 'https://kuberaatechnologies.com/uploads/9.png'),
(22, 'Engineering ', 'https://kuberaatechnologies.com/uploads/10.png'),
(23, 'Business', 'https://kuberaatechnologies.com/uploads/11.png'),
(24, 'Political', 'https://kuberaatechnologies.com/uploads/12.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `notification` int(11) NOT NULL DEFAULT '1',
  `sent_by` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `mobile_number`, `message`, `notification`, `sent_by`, `date`, `time`, `status`) VALUES
(1, '9236294037', 'help', 1, 'user', '0000-00-00', '11:48:44am', 0),
(2, '9236294037', 'hii', 1, 'user', '0000-00-00', '11:49:02am', 0),
(3, '8220101531', 'hello help', 0, 'user', '0000-00-00', '01:09:26pm', 0),
(4, '8220101531', 'ok ok', 0, 'admin', '0000-00-00', '01:10:47pm', 0),
(5, '8220101531', 'another help', 0, 'user', '0000-00-00', '01:11:14pm', 0),
(6, '8220101531', 'forgot your', 0, 'user', '0000-00-00', '01:11:18pm', 0),
(7, '9236294037', 'hii', 1, 'user', '0000-00-00', '01:12:13pm', 0),
(8, '9236294037', 'hii', 1, 'user', '0000-00-00', '01:12:14pm', 0),
(9, '9236294037', 'welcome', 0, 'admin', '0000-00-00', '01:12:36pm', 0),
(10, '8220101531', 'welcome', 0, 'admin', '0000-00-00', '01:12:36pm', 0),
(11, '9791505131', 'hi admin', 0, 'user', '0000-00-00', '01:17:14pm', 0),
(12, '9791505131', 'hi admin', 0, 'user', '0000-00-00', '01:17:14pm', 0),
(13, '9791505131', 'hi', 0, 'admin', '0000-00-00', '01:17:27pm', 0),
(14, '8220101531', 'y', 0, 'user', '0000-00-00', '12:31:40am', 0),
(15, '8220101531', '', 0, 'user', '0000-00-00', '12:31:41am', 0),
(16, '8220101531', 'cc', 0, 'user', '0000-00-00', '12:31:47am', 0),
(17, '8220101531', 'cc', 0, 'user', '0000-00-00', '12:31:47am', 0),
(18, '8220101531', 'bbbb', 0, 'user', '0000-00-00', '12:31:55am', 0),
(19, '8220101531', 'hii', 0, 'user', '0000-00-00', '12:32:37am', 0),
(20, '8220101531', 'hii', 0, 'user', '0000-00-00', '12:32:48am', 0),
(21, '9788851539', 'hi', 0, 'user', '0000-00-00', '12:32:51am', 0),
(22, '9788851539', 'buddy', 0, 'user', '0000-00-00', '12:32:57am', 0),
(23, '8220101531', 'hiii', 0, 'user', '0000-00-00', '12:33:00am', 0),
(24, '8220101531', 'he\'ll', 0, 'user', '0000-00-00', '12:33:24am', 0),
(25, '9791505131', 'hi', 0, 'admin', '0000-00-00', '12:34:16am', 0),
(26, '8220101531', 'hii', 0, 'user', '0000-00-00', '12:34:23am', 0),
(27, '9788851539', 'hii', 0, 'admin', '2022-02-07', '12:34:42am', 0),
(28, '8220101531', 'tik tik', 0, 'user', '2022-02-07', '12:34:54am', 0),
(29, '8220101531', 'kjsjjjd', 0, 'user', '2022-02-07', '12:36:25am', 0),
(30, '8220101531', 'jsjjejjjee', 0, 'user', '2022-02-07', '12:36:38am', 0),
(31, '9791505131', 'check', 0, 'user', '2022-02-07', '12:37:24am', 0),
(32, '9791505131', 'super', 0, 'user', '2022-02-07', '12:37:39am', 0),
(33, '9791505131', '', 0, 'user', '2022-02-07', '12:37:39am', 0),
(34, '9791505131', 'ok', 0, 'admin', '2022-02-07', '12:37:40am', 0),
(35, '9791505131', 'super', 0, 'admin', '2022-02-07', '12:38:18am', 0),
(36, '8220101531', 'hii', 0, 'user', '2022-02-07', '01:09:08am', 0),
(37, '8220101531', 'hii', 0, 'user', '2022-02-07', '01:09:16am', 0),
(38, '8220101531', 'hai', 0, 'user', '2022-02-07', '01:09:30am', 0),
(39, '9788851539', 'hi', 0, 'user', '2022-02-07', '01:13:22am', 0),
(40, '9791505131', 'hi', 0, 'user', '2022-02-07', '01:14:22am', 0),
(41, '9791505131', 'hi', 0, 'user', '2022-02-07', '01:14:37am', 0),
(42, '9791505131', 'hi', 0, 'user', '2022-02-07', '01:18:56am', 0),
(43, '8220101531', 'hii', 0, 'user', '2022-02-07', '01:32:42am', 0),
(44, '8220101531', 'hello', 0, 'user', '2022-02-07', '01:32:47am', 0),
(45, '9791505131', 'hello', 0, 'admin', '2022-02-07', '01:33:36am', 0),
(46, '9788851539', 'ok', 0, 'admin', '2022-02-07', '01:33:45am', 0),
(47, '8220101531', 'ok', 0, 'admin', '2022-02-07', '01:33:55am', 0),
(48, '9791505131', 'hello', 0, 'user', '2022-02-07', '01:35:27am', 0),
(49, '9791505131', 'parthi', 0, 'user', '2022-02-07', '01:38:39am', 0),
(50, '9791505131', 'hi prabha', 0, 'admin', '2022-02-07', '01:38:57am', 0),
(51, '8220101532', 'hey', 1, 'user', '2022-02-07', '01:48:37am', 0),
(52, '9791505131', 'helo', 1, 'user', '2022-02-07', '01:48:56am', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `book_id` int(11) NOT NULL DEFAULT '0',
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `month_and_year` varchar(255) NOT NULL DEFAULT '0',
  `payment_id_razorpay` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `mobile_number`, `book_id`, `payment_date`, `month_and_year`, `payment_id_razorpay`, `status`) VALUES
(1, '9791505131', 3, '2022-01-30 07:49:02', 'January 2022', 'pay_IpsPK4FX52DBKO', 0),
(2, '8220101531', 3, '2022-02-06 18:07:54', 'February 2022', 'pay_Isoh2JZnkW7EBa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `referral_id` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `referral_count` int(11) NOT NULL DEFAULT '0',
  `avg_count` int(11) NOT NULL DEFAULT '0',
  `level_update_count` int(11) NOT NULL DEFAULT '0',
  `level_update_count_status` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `stage` int(11) NOT NULL DEFAULT '0',
  `referral_number` varchar(255) NOT NULL DEFAULT '0',
  `payment_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `mobile_number`, `email`, `referral_id`, `password`, `registered_date`, `status`, `referral_count`, `avg_count`, `level_update_count`, `level_update_count_status`, `level`, `stage`, `referral_number`, `payment_status`) VALUES
(1, 'venkat', '9236294037', '1', 0, '9236294037', '2022-01-12 07:20:25', 1, 1, 1, 0, 0, 1, 0, 'AAA0000', 1),
(2, 'parthiban', '8883388393', '', 0, '12345@ban', '2022-01-30 07:38:35', 0, 0, 0, 0, 0, 1, 0, 'AAA0001', 0),
(3, 'prabaharan ', '9791505131', '', 0, '123456', '2022-01-30 07:45:28', 0, 0, 0, 0, 0, 1, 0, 'JSJ9999', 1),
(4, 'parthi 2', '822', '', 0, '12345@ban', '2022-01-30 16:36:18', 0, 0, 0, 0, 0, 1, 0, 'JSY9999', 0),
(5, 'parthi3', '8220101', '', 0, '12345@ban', '2022-01-30 16:41:07', 0, 0, 0, 0, 0, 1, 0, 'JSZ9999', 0),
(6, 'parthi', '8220101532', '', 1, 'digital@88', '2022-01-30 16:49:16', 1, 0, 0, 0, 0, 1, 0, 'JTA0000', 1),
(7, 'nandha', '9788851539', '', 0, '12345', '2022-02-06 19:02:05', 0, 0, 0, 0, 0, 1, 0, 'JTA0001', 0),
(8, 'parthiban2', '8220101531', '', 0, 'digital@88', '2022-02-06 19:41:36', 0, 0, 0, 0, 0, 1, 0, 'JTA0002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `reward` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `level`, `reward`) VALUES
(2, 1, '0'),
(3, 2, '492'),
(4, 3, '5412'),
(5, 4, '54612'),
(7, 5, '746612');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_details_id`);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

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
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
