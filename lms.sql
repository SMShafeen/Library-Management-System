-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 08:39 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ID` int(10) NOT NULL,
  `Book_Title` varchar(255) NOT NULL,
  `Book_Author` varchar(255) NOT NULL,
  `Book_Publication` varchar(255) NOT NULL,
  `Published_Year` int(25) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `ISBN` varchar(25) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Available_Copies` int(10) NOT NULL,
  `Total_Copies` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID`, `Book_Title`, `Book_Author`, `Book_Publication`, `Published_Year`, `Department`, `ISBN`, `Genre`, `Available_Copies`, `Total_Copies`) VALUES
(1, 'Basic Electrical Engineering', 'Ram Maurya', 'RCOE', 2020, 'All Department', '2362169345710', 'Electrical Engineering', 4, 10),
(2, 'COA', 'Rajan Deskmukh', 'Deshmukh', 1990, 'Comps, AI&amp;DS and ECS', '9062169345710', 'Computer Science and Engineering', 10, 10),
(4, 'ML', 'Mehmood', 'Rabey', 2004, 'Comps, AI&amp;DS and ECS', '2362169345725', 'Machine Learning', 30, 30),
(5, 'DBMS', 'Farhan Shaikh', 'RCOE', 2016, 'Comps, AI&amp;DS and ECS', '2362145345710', 'Computer Science and Engineering', 15, 15),
(6, 'DE', 'Dinesh', 'RCOE', 0, 'Comps, AI&amp;DS and ECS', '7312169345710', 'Electronics Engineering', 10, 10),
(7, 'ED', 'Anuja', 'RCOE', 2015, 'EXTC and ECS', '2362169345731', 'Electronics Engineering', 15, 15),
(8, 'ES &amp; RTOS', 'Sachin Charbe', 'RCOE', 2015, 'EXTC and ECS', '2362369345710', 'Electronics Engineering', 25, 25),
(9, 'Mechanical Engineering', 'Ameya', 'RCOE', 2010, 'All Department', '2362126345710', 'Mechanical Engineering', 17, 10),
(10, 'Maths 1', 'Ayub', 'RCOE', 2024, 'All Department', '2348109345710', 'Machine Learning', 10, 10),
(11, 'Maths 2', 'Shadab', 'RCOE', 0, 'All Department', '5362169345710', 'Machine Learning', 10, 10),
(12, 'Maths 3', 'Mehmood', 'RCOE', 2020, 'All Department', '1362169345710', 'Machine Learning', 25, 25),
(13, 'Maths 4', 'Rabey', 'RCOE', 2021, 'All Department', '8562169345710', 'Machine Learning', 8, 8),
(14, 'Fluids Mechanics', 'Jugal', 'RCOE', 2021, 'Mech', '4362169345710', 'Mechanical Engineering', 15, 15),
(15, 'AI', 'Taufiq', 'Qadri', 2017, 'Comps, AI&amp;DS and ECS', '4532169345710', 'Artificial Intelligence', 9, 10),
(16, 'DWM', 'Mukesh', 'RCOE', 2017, 'Comps, AI&amp;DS and ECS', '568216934571', 'Machine Learning', 10, 10),
(17, 'ML', 'Raju', 'RCOE', 2017, 'Comps, AI&amp;DS and ECS', '5682169345710', 'Machine Learning', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_book`
--

CREATE TABLE `borrowed_book` (
  `ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Book_ID` int(10) NOT NULL,
  `Borrow_Date` varchar(25) NOT NULL,
  `Due_Date` varchar(25) NOT NULL,
  `Dead_Line` varchar(25) NOT NULL,
  `Return_Status` varchar(25) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_book`
--

INSERT INTO `borrowed_book` (`ID`, `User_ID`, `Book_ID`, `Borrow_Date`, `Due_Date`, `Dead_Line`, `Return_Status`) VALUES
(1, 5, 9, '23-04-2024', '03-05-2024', '04-05-2024', 'Returned on 27-04-2024'),
(2, 5, 9, '23-04-2024', '03-05-2024', '04-05-2024', 'Returned on 27-04-2024'),
(3, 5, 1, '23-04-2024', '03-05-2024', '04-05-2024', 'Returned on 27-04-2024'),
(4, 5, 1, '23-04-2024', '03-05-2024', '04-05-2024', 'Returned on 27-04-2024'),
(5, 1, 1, '23-04-2024', '03-05-2024', '04-05-2024', 'Returned on 20-09-2024'),
(6, 1, 1, '23-04-2024', '03-05-2024', '04-05-2024', 'Pending'),
(7, 1, 1, '23-04-2024', '03-05-2024', '04-05-2024', 'Active'),
(8, 4, 15, '24-04-2024', '04-05-2024', '05-05-2024', 'Active'),
(9, 4, 9, '24-04-2024', '04-05-2024', '05-05-2024', 'Active'),
(10, 5, 1, '27-04-2024', '07-05-2024', '08-05-2024', 'Returned on 20-09-2024'),
(11, 5, 9, '27-04-2024', '07-05-2024', '08-05-2024', 'Active'),
(12, 1, 9, '27-04-2024', '07-05-2024', '08-05-2024', 'Active'),
(13, 2, 1, '16-07-2024', '26-07-2024', '27-07-2024', 'Returned on 16-07-2024'),
(14, 1, 1, '17-09-2025', '27-09-2025', '28-09-2025', 'Active'),
(15, 2, 5, '17-09-2025', '27-09-2025', '28-09-2025', 'Returned on 17-09-2025');

-- --------------------------------------------------------

--
-- Table structure for table `defaulter_list`
--

CREATE TABLE `defaulter_list` (
  `ID` int(11) NOT NULL,
  `BB_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Book_ID` int(11) NOT NULL,
  `Fine` varchar(25) NOT NULL,
  `Payment_Status` varchar(25) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `defaulter_list`
--

INSERT INTO `defaulter_list` (`ID`, `BB_ID`, `User_ID`, `Book_ID`, `Fine`, `Payment_Status`) VALUES
(1, 2, 5, 9, '2', 'Completed on 27-04-2024'),
(7, 6, 1, 1, '0', 'Completed on 27-04-2024'),
(8, 4, 5, 1, '0', 'Completed on 27-04-2024'),
(10, 4, 5, 1, '0', 'Pending'),
(13, 10, 5, 1, '0', 'Completed on 20-09-2024');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Number` varchar(15) NOT NULL,
  `UIN` varchar(20) NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `Year` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Active_Borrow` int(11) NOT NULL DEFAULT 0,
  `Total_Borrow` int(11) NOT NULL DEFAULT 0,
  `User_Type` varchar(25) NOT NULL DEFAULT 'student',
  `Profile_Picture` varchar(255) NOT NULL,
  `Status` varchar(25) NOT NULL DEFAULT 'Offline',
  `Date_and_Time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Number`, `UIN`, `Branch`, `Year`, `Password`, `Active_Borrow`, `Total_Borrow`, `User_Type`, `Profile_Picture`, `Status`, `Date_and_Time`) VALUES
(1, 'Shaikh Mohammad Shafeen', 'shafeen@gmail.com', '9920976743', '211S010', 'ECS', 'Fourth Year', '$2y$10$RJm7Jbwkq1ClvgQvrTHhPegUvSXEqo4769MdiZAz3dnr0KKTvjNlq', 3, 5, 'admin', 'new_img_1713102855_1154181404_pic-1.png', 'Active', '2024-04-14 19:24:16'),
(2, 'Ayub', 'ayub@gmail.com', '2147483645', '211A014', 'AI and DS', 'Third Year', '$2y$10$HwXL1ieqy9q8Luu/ZBa75.qn5DZ5u1NgEQWLMDPiAjYIxyZ90CFES', 0, 2, 'student', 'new_img_1713182384_902849799_author-1.jpg', 'Active', '2024-04-15 17:29:44'),
(3, 'Shadab', 'shadab@gmail.com', '2147483647', '211A018', 'AI and DS', 'Third Year', '$2y$10$laaWtenOvaVQ1LqBy0u5.epVVIrW1yMhZ2E3mQBVdPuwh0Oy/0Xd6', 0, 0, 'student', 'new_img_1713182491_944893934_author-3.jpg', 'offline', '2024-04-15 17:31:31'),
(4, 'Khan Taufiq', 'taufiq@gmail.com', '1234567809', '211S033', 'ECS', 'Third Year', '$2y$10$OnAprKazQ76M2NbB5OibLerWZAOUYPpFiisDlJJnJNRdkrTwDxC..', 0, 2, 'admin', 'new_img_1713182552_1055237253_pic-1.jpg', 'Offline', '2024-04-15 17:32:32'),
(5, 'Zaid Achhwa', 'zaidachhwa@gmail.com', '1234567899', '211S041', 'ECS', 'Third Year', '$2y$10$evW4DUWH1nlglMhPm8Mns.H0oyucUv5Jko3HxUixIsE9YwPS1R.W6', 0, 7, 'student', 'new_img_1713182629_1161271329_pic-3.jpg', 'Active', '2024-04-15 17:33:49'),
(6, 'Aamir', 'aamir@gmail.com', '8257896458', '211P042', 'Computer Engineering', 'Third Year', '$2y$10$2sV9notD6286WYig1FKNh.Eg1Qz/SNtZ7WqwVf82nBOdbatIdZ.ae', 0, 0, 'student', 'new_img_1713899622_1042111842_pic-1.png', 'Offline', '2024-04-24 00:43:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `borrowed_book`
--
ALTER TABLE `borrowed_book`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `borrowed_book_ibfk_1` (`User_ID`),
  ADD KEY `borrowed_book_ibfk_2` (`Book_ID`);

--
-- Indexes for table `defaulter_list`
--
ALTER TABLE `defaulter_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BB_ID` (`BB_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Book_ID` (`Book_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `borrowed_book`
--
ALTER TABLE `borrowed_book`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `defaulter_list`
--
ALTER TABLE `defaulter_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_book`
--
ALTER TABLE `borrowed_book`
  ADD CONSTRAINT `borrowed_book_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `borrowed_book_ibfk_2` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `defaulter_list`
--
ALTER TABLE `defaulter_list`
  ADD CONSTRAINT `defaulter_list_ibfk_1` FOREIGN KEY (`BB_ID`) REFERENCES `borrowed_book` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `defaulter_list_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `defaulter_list_ibfk_3` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
