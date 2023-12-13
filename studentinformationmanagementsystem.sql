-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 08:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentinformationmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `Admin_ID` int(11) NOT NULL,
  `AdminFirstname` varchar(255) NOT NULL,
  `AdminMiddlename` varchar(255) NOT NULL,
  `AdminLastname` varchar(255) NOT NULL,
  `AdminExtensionname` varchar(255) DEFAULT NULL,
  `Admin_Birthdate` date NOT NULL,
  `Admin_Age` int(4) NOT NULL,
  `Gender_ID` int(11) NOT NULL,
  `Civil_Status_ID` int(11) NOT NULL,
  `Street_Number` varchar(255) NOT NULL,
  `Address_Name` varchar(255) NOT NULL,
  `Barangay_ID` int(11) NOT NULL,
  `Town_ID` int(11) NOT NULL,
  `Province_ID` int(11) NOT NULL,
  `Zip_Code` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`Admin_ID`, `AdminFirstname`, `AdminMiddlename`, `AdminLastname`, `AdminExtensionname`, `Admin_Birthdate`, `Admin_Age`, `Gender_ID`, `Civil_Status_ID`, `Street_Number`, `Address_Name`, `Barangay_ID`, `Town_ID`, `Province_ID`, `Zip_Code`, `Username`, `Password`) VALUES
(1, 'Edrian ', 'Sir', 'Ramos', 'N/A', '2017-06-23', 25, 1, 2, 'Zone 5', '555 Zone 5', 1, 2, 1, 4567, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_table`
--

CREATE TABLE `barangay_table` (
  `Barangay_ID` int(11) NOT NULL,
  `Barangay_Name` varchar(100) NOT NULL,
  `Town_ID` int(11) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_table`
--

INSERT INTO `barangay_table` (`Barangay_ID`, `Barangay_Name`, `Town_ID`, `Date_Created`) VALUES
(1, 'San Manuel', 2, '2023-12-06 15:00:46'),
(2, 'Batakil', 3, '2023-12-06 15:00:58'),
(3, 'Bobonan', 3, '2023-12-06 15:01:06'),
(4, 'Capaz', 1, '2023-12-06 15:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `civil_table`
--

CREATE TABLE `civil_table` (
  `Civil_Status_ID` int(11) NOT NULL,
  `Civil_Status_Name` varchar(100) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `civil_table`
--

INSERT INTO `civil_table` (`Civil_Status_ID`, `Civil_Status_Name`, `Date_Created`) VALUES
(1, 'Single', '2023-12-06 14:57:11'),
(2, 'Married', '2023-12-06 14:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `gender_table`
--

CREATE TABLE `gender_table` (
  `Gender_ID` int(11) NOT NULL,
  `Gender_Name` varchar(100) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender_table`
--

INSERT INTO `gender_table` (`Gender_ID`, `Gender_Name`, `Date_Created`) VALUES
(1, 'Male', '2023-12-06 14:56:59'),
(2, 'Female', '2023-12-06 14:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `parent_table`
--

CREATE TABLE `parent_table` (
  `Parent_ID` int(11) NOT NULL,
  `ParentFirstname` varchar(255) NOT NULL,
  `ParentMiddlename` varchar(255) NOT NULL,
  `ParentLastname` varchar(255) NOT NULL,
  `ParentExtensionname` varchar(255) DEFAULT NULL,
  `Parent_Birthdate` date NOT NULL,
  `Parent_Age` int(4) NOT NULL,
  `Gender_ID` int(11) NOT NULL,
  `Civil_Status_ID` int(11) NOT NULL,
  `Street_Number` varchar(255) NOT NULL,
  `Address_Name` varchar(255) NOT NULL,
  `Barangay_ID` int(11) NOT NULL,
  `Town_ID` int(11) NOT NULL,
  `Province_ID` int(11) NOT NULL,
  `Zipcode` int(11) NOT NULL,
  `Parent_Username` varchar(255) NOT NULL,
  `Parent_Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `province_table`
--

CREATE TABLE `province_table` (
  `Province_ID` int(11) NOT NULL,
  `Province_Name` varchar(100) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province_table`
--

INSERT INTO `province_table` (`Province_ID`, `Province_Name`, `Date_Created`) VALUES
(1, 'Pangasinan', '2023-12-06 14:57:28'),
(2, 'La Union', '2023-12-06 14:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `Student_ID` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Extensionname` varchar(255) DEFAULT NULL,
  `Birthdate` date NOT NULL,
  `Age` int(4) NOT NULL,
  `Gender_ID` int(11) NOT NULL,
  `Civil_Status_ID` int(11) NOT NULL,
  `Street_Number` varchar(255) NOT NULL,
  `Address_Name` varchar(255) NOT NULL,
  `Barangay_ID` int(11) NOT NULL,
  `Town_ID` int(11) NOT NULL,
  `Province_ID` int(11) NOT NULL,
  `Zipcode` int(11) NOT NULL,
  `Parent_ID` int(11) NOT NULL,
  `Student_Username` varchar(255) NOT NULL,
  `Student_Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `town_table`
--

CREATE TABLE `town_table` (
  `Town_ID` int(11) NOT NULL,
  `Town_Name` varchar(100) NOT NULL,
  `Province_ID` int(11) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `town_table`
--

INSERT INTO `town_table` (`Town_ID`, `Town_Name`, `Province_ID`, `Date_Created`) VALUES
(1, 'Agoo', 2, '2023-12-06 14:59:05'),
(2, 'Binalonan', 1, '2023-12-06 14:59:15'),
(3, 'Pozorrubio', 1, '2023-12-06 15:00:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD KEY `Barangay_ID` (`Barangay_ID`),
  ADD KEY `Civil_Status_ID` (`Civil_Status_ID`),
  ADD KEY `Gender_ID` (`Gender_ID`),
  ADD KEY `Province_ID` (`Province_ID`),
  ADD KEY `admin_table_ibfk_7` (`Town_ID`);

--
-- Indexes for table `barangay_table`
--
ALTER TABLE `barangay_table`
  ADD PRIMARY KEY (`Barangay_ID`),
  ADD KEY `Town_ID` (`Town_ID`);

--
-- Indexes for table `civil_table`
--
ALTER TABLE `civil_table`
  ADD PRIMARY KEY (`Civil_Status_ID`);

--
-- Indexes for table `gender_table`
--
ALTER TABLE `gender_table`
  ADD PRIMARY KEY (`Gender_ID`);

--
-- Indexes for table `parent_table`
--
ALTER TABLE `parent_table`
  ADD PRIMARY KEY (`Parent_ID`),
  ADD KEY `Barangay_ID` (`Barangay_ID`),
  ADD KEY `Civil_Status_ID` (`Civil_Status_ID`),
  ADD KEY `Gender_ID` (`Gender_ID`),
  ADD KEY `Province_ID` (`Province_ID`),
  ADD KEY `Town_ID` (`Town_ID`);

--
-- Indexes for table `province_table`
--
ALTER TABLE `province_table`
  ADD PRIMARY KEY (`Province_ID`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Barangay_ID` (`Barangay_ID`),
  ADD KEY `Civil_Status_ID` (`Civil_Status_ID`),
  ADD KEY `Gender_ID` (`Gender_ID`),
  ADD KEY `Parent_ID` (`Parent_ID`),
  ADD KEY `Town_ID` (`Town_ID`);

--
-- Indexes for table `town_table`
--
ALTER TABLE `town_table`
  ADD PRIMARY KEY (`Town_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barangay_table`
--
ALTER TABLE `barangay_table`
  MODIFY `Barangay_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `civil_table`
--
ALTER TABLE `civil_table`
  MODIFY `Civil_Status_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender_table`
--
ALTER TABLE `gender_table`
  MODIFY `Gender_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parent_table`
--
ALTER TABLE `parent_table`
  MODIFY `Parent_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `province_table`
--
ALTER TABLE `province_table`
  MODIFY `Province_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `town_table`
--
ALTER TABLE `town_table`
  MODIFY `Town_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
