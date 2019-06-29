-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2017 at 05:38 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_book_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_name` varchar(60) NOT NULL,
  `book_author` varchar(60) NOT NULL,
  `book_publishers` varchar(60) NOT NULL,
  `book_price` float NOT NULL,
  `book_category` varchar(20) DEFAULT NULL,
  `book_id` int(11) NOT NULL,
  `book_code` varchar(30) NOT NULL,
  `books_available` int(11) NOT NULL,
  `books_sold` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_name`, `book_author`, `book_publishers`, `book_price`, `book_category`, `book_id`, `book_code`, `books_available`, `books_sold`) VALUES
('52 Programming Somossha', 'Tamim Shariar Shubin', 'Dimik Prokashoni', 110, 'Programming', 18, 'B1', 99, 20),
('Jerujlem', 'Bulbul Sorwar', 'Shopno Vromon', 310, 'Islamic', 19, 'B2', 100, 12),
('Programming Contest', 'Mahbubul Hasan', 'Dimik Prokashoni', 450, 'Programming', 20, 'B3', 100, 0),
('Quantum Physics', 'Abdul Gaffar Rony', 'Ron Prokashoni', 245, 'Science', 21, 'B4', 100, 5),
('Networking', 'Titash Sarkar', 'Khan Prokashoni', 360, 'Computer Science', 22, 'B5', 100, 13),
('C Programming', 'Jakir Hossain', 'Onno Prokash', 321, 'Programming', 23, 'B6', 97, 3),
('Html and Css', 'Thomas A. Powell', 'Lemar Company', 1190, 'Programming', 26, 'B8', 100, 0),
('Sciene Fiction - Ritin', 'Dr. Jafor Iqbal', 'Shopno Vromon', 210, 'Science', 25, 'B7', 100, 21),
('Kitta Koitam', 'Mostofa Kamal', 'Lava Publishers', 175, 'Funny', 27, 'B9', 100, 0),
('Rupoboti', 'Mostofa Kamal', 'Lava Publishers', 175, 'Literature', 28, 'B10', 200, 0),
('Science Fictions Collections', 'Humayun Ahmed', 'Shopno Vromon', 540, 'Science', 29, 'B11', 400, 0),
('Black Holer Baccha', 'Muhammad Jafor Iqbal', 'Lava Publishers', 245, 'Science', 30, 'B12', 0, 0),
('Basik Ali 1', 'Joti Benarji', 'Ron Prokashoni', 60, 'Funny', 31, 'B13', 100, 0),
('Basik Ali 2', 'Joti Benarji', 'Ron Prokashoni', 75, 'Funny', 32, 'B14', 100, 0),
('Basik Ali 3', 'Joti Benarji', 'Ron Prokashoni', 56, 'Funny', 33, 'B15', 250, 0),
('Basik Ali 4', 'Joti Benarji', 'Ron Prokashoni', 67, 'Funny', 34, 'B16', 0, 0),
('Laili', 'Sifat Haq', 'Ron Prokashoni', 76, 'Funny', 35, 'B17', 60, 0),
('Python', 'Tamim Shariar Shubin', 'Dimik Prokashoni', 234, 'Programming', 36, 'B18', 100, 0),
('Computer Programming 2', 'Tamim Shariar Shubin', 'Dimik Prokashoni', 234, 'Programming', 37, 'B19', 99, 1),
('PHP Laravel', 'Mahbubul Hasan', 'Dimik Prokashoni', 208, 'Computer Science', 38, 'B20', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `buying_table`
--

CREATE TABLE `buying_table` (
  `purchase_id` int(11) NOT NULL,
  `book_code` varchar(30) NOT NULL,
  `book_quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buying_table`
--

INSERT INTO `buying_table` (`purchase_id`, `book_code`, `book_quantity`) VALUES
(16, 'B1', 1),
(16, 'B6', 3),
(17, 'B19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `user_id` varchar(10) NOT NULL,
  `msg` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`user_id`, `msg`, `email`, `subject`) VALUES
('5', 'Thanks for your service!', 'arifulislam525@yahoo.com', 'Good Service');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `book_name` varchar(30) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`book_name`, `image`) VALUES
('52 Programming Somossha', 'Programming Somossha.jpg'),
('Jerujlem', 'Jerujalem.jpg'),
('Programming Contest', 'Programming Contest.jpg'),
('Quantum Physics', 'QuantumPhysics.jpg'),
('Networking', 'Networking.jpg'),
('C Programming', 'C Programming.jpg'),
('Rupoboti', 'Rupoboti.jpg'),
('Kitta Koitam', 'Kitta Koitam.jpg'),
('Html and Css', 'Html and Css.jpg'),
('Sciene Fiction - Ritin', 'Ritin.jpg'),
('Science Fictions Collections', 'Science Fictions Collections.jpg'),
('Black Holer Baccha', 'Black Holer Baccha.jpg'),
('Basik Ali 1', 'Basik Ali 1.jpg'),
('Basik Ali 2', 'Basik Ali 2.jpg'),
('Basik Ali 3', 'Basik Ali 3.jpg'),
('Basik Ali 4', 'Basik Ali 4.jpg'),
('Laili', 'Laili.jpg'),
('Python', 'Python.jpg'),
('Computer Programming 2', 'Computer Programming 2.jpg'),
('PHP Laravel', 'PHP Laravel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registratedusers`
--

CREATE TABLE `registratedusers` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobileno` varchar(11) NOT NULL,
  `address` varchar(40) NOT NULL,
  `date` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `Request` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registratedusers`
--

INSERT INTO `registratedusers` (`user_id`, `fname`, `lname`, `email`, `password`, `mobileno`, `address`, `date`, `gender`, `user_type`, `Request`) VALUES
(1, 'Arif', 'Islam', 'ez.boy763@gmail.com', '12345678', '01910039102', 'D.I.T Project , Merul Badda , Dhaka .', '19/01/1993', 'Male', 'admin', 'Accepted'),
(2, 'Rinat', 'Jaman', 'rinat763@gmail.com', '123456', '01910039103', 'Shantinagar , Dhaka . ', '29/03/1993', 'Female', 'buyer', 'Accepted'),
(4, 'Tazul', 'Islam', 'tazulislam@gmail.com', '123456', '01910039102', 'Badda, Dhaka.', '12/03/1991', 'Male', 'buyer', 'Accepted'),
(5, 'Eminem', 'Marshal', 'eminemmethars@gmail.com', '123456', '0183869789', 'NY ,America.', '6/11/1989', 'Male', 'buyer', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `total_purchase`
--

CREATE TABLE `total_purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_request` varchar(20) NOT NULL,
  `delivered` varchar(5) NOT NULL,
  `delivered_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_purchase`
--

INSERT INTO `total_purchase` (`purchase_id`, `purchase_date`, `purchase_total`, `user_id`, `purchase_request`, `delivered`, `delivered_date`) VALUES
(16, '2017-04-22 05:53:15', 1256, 2, 'Accepted', 'Yes', '2017-04-22'),
(17, '2017-04-23 04:04:36', 274, 2, 'Pending', 'No', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `registratedusers`
--
ALTER TABLE `registratedusers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `total_purchase`
--
ALTER TABLE `total_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `registratedusers`
--
ALTER TABLE `registratedusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `total_purchase`
--
ALTER TABLE `total_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
