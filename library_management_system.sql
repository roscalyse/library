-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 03:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `biography` text NOT NULL,
  `DOB` date DEFAULT NULL,
  `DOD` date DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `biography`, `DOB`, `DOD`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(2, 'Richard Fox', 'Richard Fox is a professor of computer science at Northern Kentucky University (NKU). He regularly teaches courses in both computer science and computer information technology', '0000-00-00', '0000-00-00', '2024-10-10', NULL, NULL, NULL),
(3, 'Merle Potter', 'MERLE C. POTTER has four engineering degrees from Michigan Technological University and The University of Michigan. ,he was inducted into the Academy of Mechanical Engineering at Michigan Tech; ASME awarded him the 1980 Centennial Award and the 2008 James', '0000-00-00', '0000-00-00', '2024-10-10', NULL, NULL, NULL),
(4, 'Eugene F. Brigham', 'Using the innovative approach and powerful examples that have become the signature of this longtime market leader, Brigham/Houston\'s FUNDAMENTALS OF FINANCIAL MANAGEMENT, 15e continues to equip learners with a thorough understanding of the what and the wh', '0000-00-00', '0000-00-00', '2024-10-10', NULL, NULL, NULL),
(5, 'BI guru Cindi Howson', 'Cindi has created, with her typical attention to details that matter, a contemporary forward-looking guide that organizations could use to evaluate existing or create a foundation for evolving business intelligence / analytics programs. The book touches o', '0000-00-00', '0000-00-00', '2024-10-10', NULL, NULL, NULL),
(6, 'Andrew Tanenbaum', 'author specialized in computer networks', '0000-00-00', '0000-00-00', '2024-10-12', NULL, NULL, NULL),
(7, 'John E. Canavan', 'John E. Canavan started his career in the IT field over 17 years ago working for Tymshare, \r\nInc., a computer services and software company that created the Tymnet X.25 network. He holds a B.S. in information systems and an M.S. in \r\ntelecommunications ma', '0000-00-00', '0000-00-00', '2024-10-12', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `breed` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_cost` double NOT NULL,
  `extra_quantity` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `maturity_date` date NOT NULL,
  `batch_number` int(11) NOT NULL,
  `purchase_date` date NOT NULL DEFAULT current_timestamp(),
  `company_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `publisher` varchar(20) NOT NULL,
  `publication_year` int(4) NOT NULL,
  `shelve_number` varchar(11) NOT NULL,
  `total_copies` int(11) NOT NULL,
  `available_copies` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `isbn`, `edition`, `publisher`, `publication_year`, `shelve_number`, `total_copies`, `available_copies`, `author_id`, `category_id`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, 'Information Technology', '036750720X', '2nd', 'Taylor & Francis Ltd', 2020, 'F2', 20, 20, 2, 1, '2024-10-10 00:00:00', NULL, NULL, NULL),
(2, 'Fundamentals of Engineering Review', '9781888577884', '11th', 'Professional Publica', 2003, 'F2', 3, 3, 3, 1, '2024-10-10 00:00:10', NULL, NULL, NULL),
(3, 'Fundamentals of Financial Management', '9781337671002', '15th', 'Cengage Learning', 2018, 'b6', 10, 10, 4, 2, '2024-10-10 00:00:12', NULL, NULL, NULL),
(4, 'Successful Business Intelligence', '007180918X', '2nd', 'McGraw Hill', 2013, 'b7', 5, 5, 5, 2, '2024-10-10 00:00:13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrowedbooks`
--

CREATE TABLE `borrowedbooks` (
  `id` int(11) NOT NULL,
  `borrow_date` date NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `book_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrowedbooks`
--

INSERT INTO `borrowedbooks` (`id`, `borrow_date`, `due_date`, `return_date`, `status`, `book_id`, `email`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, '2024-10-10', '2024-10-13', '2024-10-14', 1, 1, 'debby@gmail.com', NULL, NULL, NULL),
(2, '2024-10-10', '2024-10-13', '2024-10-15', 1, 3, 'roscalyse11@gmail.com', NULL, NULL, NULL),
(3, '2024-10-13', '2024-10-16', NULL, 0, 4, 'roscalyse11@gmail.com', NULL, NULL, NULL),
(10, '2024-10-11', '2024-10-14', NULL, 0, 3, 'debby@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, 'Information Technology', 'Information technology encompasses a wide range of technologies and systems that are used to store, retrieve, process and transmit data for specific use cases', '2024-10-10', NULL, NULL, NULL),
(2, 'Business', 'all business related books', '2024-10-10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `stud_id` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `stud_id`, `first_name`, `last_name`, `email`, `contact`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, 'Luct1100111', 'NAMUKASA', 'PROSCOVIA', 'roscalyse11@gmail.com', '+256 788121927', '2024-10-10', 'aisha2024@gmail.com', NULL, NULL),
(2, 'luct1100098', 'AKATUKUNDA', 'DEBORAH', 'debby@gmail.com', '+256 782085842', '2024-10-10', 'aisha2024@gmail.com', NULL, NULL),
(4, 'luct578', 'LUKWIYA', 'ARTHUR', 'omuron@gmail.com', '0755630332', '2024-10-11', 'aisha2024@gmail.com', '2024-10-12', 'aisha2024@gmail.com'),
(6, 'luct1111', 'NAKABUYE', 'REBBECA', 'roscalyse16@gmail.com', '+256 782085842', '2024-10-11', 'aisha2024@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `message`, `is_read`, `date_created`) VALUES
(24, 'debby@gmail.com', 'Reminder: The book \'Fundamentals of Financial Management\' is due today (2024-10-14). Please return it.', 1, '2024-10-14'),
(25, 'roscalyse11@gmail.com', 'Reminder: The book \'Successful Business Intelligence\' is due today (2024-10-15). Please return it.', 1, '2024-10-15'),
(26, 'roscalyse11@gmail.com', 'Reminder: The book \'Successful Business Intelligence\' is due today (2024-10-16). Please return it.', 1, '2024-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `online_books`
--

CREATE TABLE `online_books` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `online_books`
--

INSERT INTO `online_books` (`id`, `name`, `author_id`, `category_id`, `edition`, `file`, `date_created`) VALUES
(1, 'Computer Networks', 6, 1, '5th', 'fileUploads/670a9de418a426.50882691.pdf', '2024-10-12'),
(2, 'Fundamentals of Network security', 7, 1, '1st', 'fileUploads/670a9fbb23b956.41091927.pdf', '2024-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `email`, `amount`, `payment_date`) VALUES
(1, 'debby@gmail.com', '2000', '2024-10-14'),
(2, 'debby@gmail.com', '1000', '2024-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `reservation_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL,
  `book_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `reservation_date`, `status`, `book_id`, `email`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, '2024-10-10', 'Taken', 1, 'debby@gmail.com', NULL, NULL, NULL),
(2, '2024-10-10', 'Taken', 3, 'roscalyse11@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `book_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `review_date` date NOT NULL DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `book_id`, `email`, `review_date`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, 'very nice book', 1, 'debby@gmail.com', '2024-10-14', '2024-10-14 00:00:00', NULL, NULL, NULL),
(2, 'am into this book', 1, 'debby@gmail.com', '2024-10-14', '2024-10-14 00:00:00', NULL, NULL, NULL),
(3, 'i like it', 1, 'debby@gmail.com', '2024-10-14', '2024-10-14 08:08:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` int(20) NOT NULL,
  `status` varchar(8) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `email`, `contact`, `status`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, 'KIMERAH', 'RODGERS', 'rkimerah@gmail.com', 788368934, '', '2024-10-10', 'aisha2024@gmail.com', '2024-10-12', 'aisha2024@gmail.com'),
(3, 'NAVALU', 'AISHA', 'aisha2024@gmail.com', 787483647, 'admin', '2024-10-10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL DEFAULT current_timestamp(),
  `fine` varchar(255) NOT NULL,
  `amount` varchar(255) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_modified` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_date`, `fine`, `amount`, `email`, `date_created`, `created_by`, `date_modified`, `modified_by`) VALUES
(1, '2024-10-14', '2000', '0', 'debby@gmail.com', '2024-10-14', NULL, NULL, NULL),
(2, '2024-10-15', '4000', '0', 'roscalyse11@gmail.com', '2024-10-15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `usertype`, `pic`) VALUES
('aisha2024@gmail.com', 'd90b5f405979e3170c233147d23187858d61c8f9', 'admin', 'NULL'),
('debby@gmail.com', '56ab9c23da3d942b89b305a8f60be67ede533185', 'student', NULL),
('omuron@gmail.com', 'd89f580e101cfc25c2027b8ce839c6e1ff347bad', 'student', NULL),
('rkimerah@gmail.com', 'd89f580e101cfc25c2027b8ce839c6e1ff347bad', 'staff', NULL),
('roscalyse11@gmail.com', 'd89f580e101cfc25c2027b8ce839c6e1ff347bad', 'student', 'NULL'),
('roscalyse16@gmail.com', 'd89f580e101cfc25c2027b8ce839c6e1ff347bad', 'student', NULL),
('roscalyse1996@gmail.com', 'd90b5f405979e3170c233147d23187858d61c8f9', 'admin', 'NULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_books`
--
ALTER TABLE `online_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `online_books`
--
ALTER TABLE `online_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
