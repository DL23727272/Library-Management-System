-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 03:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_table`
--

CREATE TABLE `books_table` (
  `bookID` int(11) NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `bookAuthor` varchar(255) NOT NULL,
  `bookISBN` varchar(20) NOT NULL,
  `bookStatus` varchar(20) NOT NULL,
  `bookImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_table`
--

INSERT INTO `books_table` (`bookID`, `bookTitle`, `bookAuthor`, `bookISBN`, `bookStatus`, `bookImage`) VALUES
(1, 'TEST', 'DL', '978-3-16-148410-0', 'Available', 'book191768.png'),
(2, 'Book 2', 'DL', '978-3-16-148410-1', 'Available', 'book256883.png');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_isbn` varchar(20) NOT NULL,
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `student_id`, `student_name`, `book_title`, `book_author`, `book_isbn`, `borrow_date`) VALUES
(1, 'A21-00001', 'DL', 'Book 2', 'DL', '978-3-16-148410-1', '2024-05-30 18:38:49'),
(2, 'A21-00001', 'DL', 'TEST', 'DL', '978-3-16-148410-0', '2024-05-30 18:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `idNumber` varchar(50) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `idNumber`, `fullName`, `username`, `department`, `password`, `type`) VALUES
(1, 'A21-00003', 'Mark Jeriel', 'jeriel', 'CCS', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'A21-00001', 'DL Gamoso', 'DL', 'CCS', '202cb962ac59075b964b07152d234b70', 'user'),
(3, 'A21-00002', 'Phoebe Gamoso', 'Phoebe', 'CTE', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'A21-00004', 'Shanne Cabotaje', 'Shanne', 'CCS', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_table`
--
ALTER TABLE `books_table`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
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
-- AUTO_INCREMENT for table `books_table`
--
ALTER TABLE `books_table`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
