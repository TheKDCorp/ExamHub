-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 01:29 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epoi`
--
CREATE DATABASE IF NOT EXISTS `epoi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `epoi`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityid` int(100) NOT NULL,
  `activityname` varchar(500) NOT NULL,
  `field1name` text NOT NULL,
  `field1type` text NOT NULL,
  `field1text` text NOT NULL,
  `field2name` text NOT NULL,
  `field2type` text NOT NULL,
  `field2text` text NOT NULL,
  `field3name` text NOT NULL,
  `field3type` text NOT NULL,
  `field3text` text NOT NULL,
  `field4name` text NOT NULL,
  `field4type` text NOT NULL,
  `field4text` text NOT NULL,
  `field5name` text NOT NULL,
  `field5type` text NOT NULL,
  `field5text` text NOT NULL,
  `field6name` text NOT NULL,
  `field6type` text NOT NULL,
  `field6text` text NOT NULL,
  `field7name` text NOT NULL,
  `field7type` text NOT NULL,
  `field7text` text NOT NULL,
  `field8name` text NOT NULL,
  `field8type` text NOT NULL,
  `field8text` text NOT NULL,
  `field9name` text NOT NULL,
  `field9type` text NOT NULL,
  `field9text` text NOT NULL,
  `field10name` text NOT NULL,
  `field10type` text NOT NULL,
  `field10text` text NOT NULL,
  `activityimg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityid`, `activityname`, `field1name`, `field1type`, `field1text`, `field2name`, `field2type`, `field2text`, `field3name`, `field3type`, `field3text`, `field4name`, `field4type`, `field4text`, `field5name`, `field5type`, `field5text`, `field6name`, `field6type`, `field6text`, `field7name`, `field7type`, `field7text`, `field8name`, `field8type`, `field8text`, `field9name`, `field9type`, `field9text`, `field10name`, `field10type`, `field10text`, `activityimg`) VALUES
(1, 'Art & Craft', 'Colouring', 'status', '', 'Interest in Drawing', 'status', '', 'Pasting Independently', 'status', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'Rhymes/Songs & Dance', 'Stimulation Towards Music', 'status', '', 'Felling happy to attend the music class', 'status', '', 'showing interest to shake their legs and hands with music', 'status', '', 'able to dance independently', 'status', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_members`
--

CREATE TABLE `admin_members` (
  `adminid` int(50) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_members`
--

INSERT INTO `admin_members` (`adminid`, `username`, `password`, `post`) VALUES
(3, 'jt@gmail.com', 'jt', 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `class_entry`
--

CREATE TABLE `class_entry` (
  `cid` int(50) NOT NULL,
  `classname` varchar(500) NOT NULL,
  `uid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `june`
--

CREATE TABLE `june` (
  `id` int(100) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `ac1` varchar(100) NOT NULL,
  `ac2` varchar(100) NOT NULL,
  `ac3` varchar(100) NOT NULL,
  `rsd1` varchar(100) NOT NULL,
  `rsd2` varchar(100) NOT NULL,
  `rsd3` varchar(100) NOT NULL,
  `rsd4` varchar(100) NOT NULL,
  `st1` varchar(100) NOT NULL,
  `st2` varchar(100) NOT NULL,
  `st3` varchar(100) NOT NULL,
  `st4` varchar(100) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section_entry`
--

CREATE TABLE `section_entry` (
  `sid` int(100) NOT NULL,
  `sectionname` varchar(500) NOT NULL,
  `uid` int(100) NOT NULL,
  `cid` varchar(500) NOT NULL,
  `classname` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_admission`
--

CREATE TABLE `student_admission` (
  `studentid` int(100) NOT NULL,
  `dateofadmission` date NOT NULL,
  `classid` varchar(100) NOT NULL,
  `uid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_biodata`
--

CREATE TABLE `student_biodata` (
  `biodataid` int(100) NOT NULL,
  `studentid` int(100) NOT NULL,
  `studentname` varchar(500) NOT NULL,
  `fathersname` varchar(500) NOT NULL,
  `mothersname` varchar(500) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `abouthim` text NOT NULL,
  `dp` varchar(500) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_contact`
--

CREATE TABLE `student_contact` (
  `contactid` int(100) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `mobileno1` varchar(100) NOT NULL,
  `mobileno2` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `hometown` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_csdetails`
--

CREATE TABLE `student_csdetails` (
  `studentcsid` int(100) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `classid` varchar(100) NOT NULL,
  `sectionid` varchar(100) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `dateofadmission` date NOT NULL,
  `classname` varchar(500) DEFAULT NULL,
  `sectionname` varchar(500) DEFAULT NULL,
  `session` varchar(500) DEFAULT NULL,
  `classteacher` varchar(500) DEFAULT NULL,
  `academiccoordinator` varchar(500) DEFAULT NULL,
  `principal` varchar(500) DEFAULT NULL,
  `dp` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_entry`
--

CREATE TABLE `student_entry` (
  `sid` int(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `fathersname` varchar(500) NOT NULL,
  `mothersname` varchar(500) NOT NULL,
  `mobile` varchar(500) NOT NULL,
  `classid` int(100) NOT NULL,
  `sectionid` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `classname` varchar(500) NOT NULL,
  `sectionname` varchar(500) NOT NULL,
  `principal` varchar(500) NOT NULL,
  `academiccoordinator` varchar(500) NOT NULL,
  `classteacher` varchar(500) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_gallery`
--

CREATE TABLE `student_gallery` (
  `imagesid` int(100) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `imagesname` varchar(500) NOT NULL,
  `imagesdescription` text NOT NULL,
  `date` date NOT NULL,
  `dp` varchar(500) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_monthfeedback`
--

CREATE TABLE `student_monthfeedback` (
  `mfid` int(11) NOT NULL,
  `studentcsid` varchar(100) NOT NULL,
  `activityid` varchar(100) NOT NULL,
  `month` varchar(500) NOT NULL,
  `field1answer` text NOT NULL,
  `field2answer` text NOT NULL,
  `field3answer` text NOT NULL,
  `field4answer` text NOT NULL,
  `field5answer` text NOT NULL,
  `field6answer` text NOT NULL,
  `field7answer` text NOT NULL,
  `field8answer` text NOT NULL,
  `field9answer` text NOT NULL,
  `field10answer` text NOT NULL,
  `dp` varchar(500) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_skills`
--

CREATE TABLE `student_skills` (
  `skillsid` int(100) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `skillsname` varchar(500) NOT NULL,
  `skillsdescription` text NOT NULL,
  `dp` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_entry`
--

CREATE TABLE `teacher_entry` (
  `uid` int(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `active` varchar(500) NOT NULL,
  `dp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityid`);

--
-- Indexes for table `admin_members`
--
ALTER TABLE `admin_members`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `class_entry`
--
ALTER TABLE `class_entry`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `june`
--
ALTER TABLE `june`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_entry`
--
ALTER TABLE `section_entry`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `student_admission`
--
ALTER TABLE `student_admission`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `student_biodata`
--
ALTER TABLE `student_biodata`
  ADD PRIMARY KEY (`biodataid`);

--
-- Indexes for table `student_contact`
--
ALTER TABLE `student_contact`
  ADD PRIMARY KEY (`contactid`);

--
-- Indexes for table `student_csdetails`
--
ALTER TABLE `student_csdetails`
  ADD PRIMARY KEY (`studentcsid`);

--
-- Indexes for table `student_entry`
--
ALTER TABLE `student_entry`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `student_gallery`
--
ALTER TABLE `student_gallery`
  ADD PRIMARY KEY (`imagesid`);

--
-- Indexes for table `student_monthfeedback`
--
ALTER TABLE `student_monthfeedback`
  ADD PRIMARY KEY (`mfid`);

--
-- Indexes for table `student_skills`
--
ALTER TABLE `student_skills`
  ADD PRIMARY KEY (`skillsid`);

--
-- Indexes for table `teacher_entry`
--
ALTER TABLE `teacher_entry`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activityid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_members`
--
ALTER TABLE `admin_members`
  MODIFY `adminid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_entry`
--
ALTER TABLE `class_entry`
  MODIFY `cid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `june`
--
ALTER TABLE `june`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_entry`
--
ALTER TABLE `section_entry`
  MODIFY `sid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_admission`
--
ALTER TABLE `student_admission`
  MODIFY `studentid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_biodata`
--
ALTER TABLE `student_biodata`
  MODIFY `biodataid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_contact`
--
ALTER TABLE `student_contact`
  MODIFY `contactid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_csdetails`
--
ALTER TABLE `student_csdetails`
  MODIFY `studentcsid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_entry`
--
ALTER TABLE `student_entry`
  MODIFY `sid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_gallery`
--
ALTER TABLE `student_gallery`
  MODIFY `imagesid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_monthfeedback`
--
ALTER TABLE `student_monthfeedback`
  MODIFY `mfid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_skills`
--
ALTER TABLE `student_skills`
  MODIFY `skillsid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_entry`
--
ALTER TABLE `teacher_entry`
  MODIFY `uid` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
