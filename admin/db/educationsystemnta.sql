-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 01:33 PM
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
-- Database: `educationsystemnta`
--
CREATE DATABASE IF NOT EXISTS `educationsystemnta` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `educationsystemnta`;

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
(1, 'superadmin@gmail.com', 'jatin', 'ADMINISTRATOR'),
(3, 'jt@gmail.com', 'jt', 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `aid` int(50) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `correctoption` varchar(1000) NOT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `cid` varchar(1000) DEFAULT NULL,
  `qid` varchar(1000) DEFAULT NULL,
  `examname` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `imgid` varchar(1000) DEFAULT NULL,
  `part` varchar(1000) DEFAULT NULL,
  `studentname` varchar(1000) NOT NULL,
  `level` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL,
  `examtype` text NOT NULL,
  `choosedoption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answers_new`
--

CREATE TABLE `answers_new` (
  `aid` int(50) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `correctoption` varchar(1000) NOT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `cid` varchar(1000) DEFAULT NULL,
  `qid` varchar(1000) DEFAULT NULL,
  `examname` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `imgid` varchar(1000) DEFAULT NULL,
  `part` varchar(1000) DEFAULT NULL,
  `studentname` varchar(1000) NOT NULL,
  `level` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL,
  `examtype` text NOT NULL,
  `choosedoption` text,
  `clickstatus` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `appupdate`
--

CREATE TABLE `appupdate` (
  `updateid` int(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appupdate`
--

INSERT INTO `appupdate` (`updateid`, `message`) VALUES
(1, 'No Update Available!!!');

-- --------------------------------------------------------

--
-- Table structure for table `calender_events`
--

CREATE TABLE `calender_events` (
  `eventid` int(100) NOT NULL,
  `details` text NOT NULL,
  `date` varchar(1000) NOT NULL,
  `month` varchar(1000) NOT NULL,
  `year` varchar(1000) NOT NULL,
  `fulldate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calender_events`
--

INSERT INTO `calender_events` (`eventid`, `details`, `date`, `month`, `year`, `fulldate`) VALUES
(1, 'Mo/ning_Assembly_Topic:_TED_Talks', '16', '10', '2018', '2018-10-16'),
(2, 'annual_fucntion', '30', '11', '2018', '2018-11-30'),
(3, 'fdsf', '30', '11', '2018', '2018-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `examattempted`
--

CREATE TABLE `examattempted` (
  `attid` int(50) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `examid` varchar(500) NOT NULL,
  `studentid` varchar(500) NOT NULL,
  `examtype` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `fid` int(100) NOT NULL,
  `breakfast` varchar(1000) NOT NULL,
  `lunch` varchar(1000) NOT NULL,
  `refreshment` varchar(1000) NOT NULL,
  `dinner` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `month` varchar(1000) NOT NULL,
  `year` varchar(1000) NOT NULL,
  `breakfast_img` varchar(1000) DEFAULT NULL,
  `lunch_img` varchar(1000) DEFAULT NULL,
  `refreshment_img` varchar(1000) DEFAULT NULL,
  `dinner_img` varchar(1000) DEFAULT NULL,
  `fulldate` date NOT NULL,
  `randid` varchar(1000) DEFAULT NULL,
  `breakfastdescription` varchar(1000) NOT NULL,
  `lunchdescription` varchar(1000) NOT NULL,
  `refreshmentdescription` varchar(1000) NOT NULL,
  `dinnerdescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `breakfast`, `lunch`, `refreshment`, `dinner`, `date`, `month`, `year`, `breakfast_img`, `lunch_img`, `refreshment_img`, `dinner_img`, `fulldate`, `randid`, `breakfastdescription`, `lunchdescription`, `refreshmentdescription`, `dinnerdescription`) VALUES
(1, 'Poha', 'Dal_Pakwan', 'Idli_Sambar', 'Rice_Dal', '16', '10', '2018', NULL, NULL, NULL, NULL, '2018-10-16', NULL, 'Poha_is_an_Traditional_Indian_Food.', 'Khasta_with_Daal_Creativity_of_MVA.', 'One_of_the_most_popular_South_Indian_Dish.', 'Traditional_Indian_Food.'),
(2, 'jj1', 'jj2', 'jj3', 'jj4', '30', '11', '2018', NULL, NULL, NULL, NULL, '2018-11-30', NULL, 'ds_klsdl_jsdlj_lsfjl', 'skl_nskl_klsjlksj', 's_kns_jkn_sjknskjn', 'kk_k_kk_k_k_k_k');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `lid` int(100) NOT NULL,
  `macaddress` text,
  `devicename` text,
  `message` text,
  `cid` text,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notiid` int(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `expiry` int(11) NOT NULL,
  `dateandtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partsresult`
--

CREATE TABLE `partsresult` (
  `pid` int(100) NOT NULL,
  `partname` varchar(1000) NOT NULL,
  `totalmarks` varchar(1000) NOT NULL,
  `markspositive` varchar(1000) NOT NULL,
  `cid` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `questionscorrect` varchar(1000) NOT NULL,
  `questionsincorrect` varchar(1000) NOT NULL,
  `marksnegative` varchar(1000) NOT NULL,
  `attempted` varchar(1000) NOT NULL,
  `mymarks` varchar(1000) NOT NULL,
  `level1marks` varchar(1000) NOT NULL,
  `level2marks` varchar(1000) NOT NULL,
  `level3marks` varchar(1000) NOT NULL,
  `examtype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partsresult_new`
--

CREATE TABLE `partsresult_new` (
  `pid` int(100) NOT NULL,
  `partname` varchar(1000) NOT NULL,
  `totalmarks` varchar(1000) NOT NULL,
  `markspositive` varchar(1000) NOT NULL,
  `cid` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `questionscorrect` varchar(1000) NOT NULL,
  `questionsincorrect` varchar(1000) NOT NULL,
  `marksnegative` varchar(1000) NOT NULL,
  `attempted` varchar(1000) NOT NULL,
  `mymarks` varchar(1000) NOT NULL,
  `level1marks` varchar(1000) NOT NULL,
  `level2marks` varchar(1000) NOT NULL,
  `level3marks` varchar(1000) NOT NULL,
  `examtype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `pid` int(100) NOT NULL,
  `username` text NOT NULL,
  `hash` text NOT NULL,
  `sender` text NOT NULL,
  `test` text NOT NULL,
  `senderemailid` varchar(1000) NOT NULL,
  `senderemailpassword` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionentry`
--

CREATE TABLE `questionentry` (
  `qid` int(50) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `option1` varchar(1000) NOT NULL,
  `option2` varchar(1000) NOT NULL,
  `option3` varchar(1000) NOT NULL,
  `option4` varchar(1000) NOT NULL,
  `correctoption` varchar(1000) NOT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `imgid` varchar(1000) DEFAULT NULL,
  `qpid` varchar(1000) NOT NULL,
  `qpname` varchar(1000) NOT NULL,
  `positivemarks` varchar(1000) NOT NULL,
  `negativemarks` varchar(1000) NOT NULL,
  `part` varchar(1000) NOT NULL,
  `correctanswer` varchar(1000) DEFAULT NULL,
  `opt1img` varchar(500) NOT NULL,
  `opt2img` varchar(500) NOT NULL,
  `opt3img` varchar(500) NOT NULL,
  `opt4img` varchar(500) NOT NULL,
  `level` varchar(1000) NOT NULL,
  `solution` text NOT NULL,
  `solutionimg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questionpaper`
--

CREATE TABLE `questionpaper` (
  `qpid` int(50) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `totalmarks` varchar(1000) NOT NULL,
  `totalquestions` varchar(1000) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `noofparts` varchar(1000) NOT NULL,
  `part1name` varchar(500) DEFAULT NULL,
  `part1topic` varchar(500) DEFAULT NULL,
  `part1marks` varchar(500) DEFAULT NULL,
  `part2name` varchar(500) DEFAULT NULL,
  `part2topic` varchar(500) DEFAULT NULL,
  `part2marks` varchar(500) DEFAULT NULL,
  `part3name` varchar(500) DEFAULT NULL,
  `part3topic` varchar(500) DEFAULT NULL,
  `part3marks` varchar(500) DEFAULT NULL,
  `part4name` varchar(500) DEFAULT NULL,
  `part4topic` varchar(500) DEFAULT NULL,
  `part4marks` varchar(500) DEFAULT NULL,
  `part5name` varchar(500) DEFAULT NULL,
  `part5topic` varchar(500) DEFAULT NULL,
  `part5marks` varchar(500) DEFAULT NULL,
  `part6name` varchar(500) DEFAULT NULL,
  `part6topic` varchar(500) DEFAULT NULL,
  `part6marks` varchar(500) DEFAULT NULL,
  `part7name` varchar(500) DEFAULT NULL,
  `part7topic` varchar(500) DEFAULT NULL,
  `part7marks` varchar(500) DEFAULT NULL,
  `part8name` varchar(500) DEFAULT NULL,
  `part8topic` varchar(500) DEFAULT NULL,
  `part8marks` varchar(500) DEFAULT NULL,
  `part9name` varchar(500) DEFAULT NULL,
  `part9topic` varchar(500) DEFAULT NULL,
  `part9marks` varchar(500) DEFAULT NULL,
  `part10name` varchar(500) DEFAULT NULL,
  `part10topic` varchar(500) DEFAULT NULL,
  `part10marks` varchar(500) DEFAULT NULL,
  `time` varchar(180) NOT NULL,
  `entrydate` date NOT NULL,
  `examdate` date NOT NULL,
  `noofattempts` int(50) DEFAULT NULL,
  `examtype` varchar(1000) NOT NULL,
  `hidden` text NOT NULL,
  `qptype` text,
  `part1noofque` int(100) DEFAULT NULL,
  `part2noofque` int(100) DEFAULT NULL,
  `part3noofque` int(100) DEFAULT NULL,
  `part4noofque` int(100) DEFAULT NULL,
  `part5noofque` int(100) DEFAULT NULL,
  `part6noofque` int(100) DEFAULT NULL,
  `part7noofque` int(100) DEFAULT NULL,
  `part8noofque` int(100) DEFAULT NULL,
  `part9noofque` int(100) DEFAULT NULL,
  `part10noofque` int(100) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `screentype` varchar(100) NOT NULL,
  `error` varchar(100) DEFAULT NULL,
  `shufflequestions` varchar(100) NOT NULL,
  `srnotype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resultrank`
--

CREATE TABLE `resultrank` (
  `rankid` int(100) NOT NULL,
  `cid` text NOT NULL,
  `studentname` text NOT NULL,
  `qindex` text NOT NULL,
  `examname` text NOT NULL,
  `examid` text NOT NULL,
  `rank` text NOT NULL,
  `resultid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `rid` int(100) NOT NULL,
  `cid` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `totalmarks` varchar(1000) NOT NULL,
  `correctquestions` varchar(1000) NOT NULL,
  `incorrectquestions` varchar(1000) DEFAULT NULL,
  `blank` varchar(1000) DEFAULT NULL,
  `attempted` varchar(1000) NOT NULL,
  `totalquestions` varchar(1000) NOT NULL,
  `mymarks` varchar(1000) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `totaltime` varchar(1000) NOT NULL,
  `mypercentile` varchar(1000) NOT NULL,
  `mytime` varchar(1000) NOT NULL,
  `correctmarks` varchar(1000) NOT NULL,
  `incorrectmarks` varchar(1000) NOT NULL,
  `timeleft` varchar(1000) NOT NULL,
  `studentname` varchar(1000) NOT NULL,
  `level1marks` varchar(1000) NOT NULL,
  `level2marks` varchar(1000) NOT NULL,
  `level3marks` varchar(1000) NOT NULL,
  `apppercent` varchar(500) NOT NULL,
  `level1questions` text NOT NULL,
  `level1correctquestions` text NOT NULL,
  `level1incorrectquestions` text NOT NULL,
  `level2questions` text NOT NULL,
  `level2correctquestions` text NOT NULL,
  `level2incorrectquestions` text NOT NULL,
  `level3questions` text NOT NULL,
  `level3correctquestions` text NOT NULL,
  `level3incorrectquestions` text NOT NULL,
  `level1correctmarks` text NOT NULL,
  `level1incorrectmarks` text NOT NULL,
  `level2correctmarks` text NOT NULL,
  `level2incorrectmarks` text NOT NULL,
  `level3correctmarks` text NOT NULL,
  `level3incorrectmarks` text NOT NULL,
  `level1totalmarks` text NOT NULL,
  `level2totalmarks` text NOT NULL,
  `level3totalmarks` text NOT NULL,
  `examtype` text,
  `macaddress` text,
  `computername` text,
  `datetime` datetime DEFAULT NULL,
  `generateresult` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results_new`
--

CREATE TABLE `results_new` (
  `rid` int(100) NOT NULL,
  `cid` varchar(1000) NOT NULL,
  `qindex` varchar(1000) NOT NULL,
  `totalmarks` varchar(1000) NOT NULL,
  `correctquestions` varchar(1000) NOT NULL,
  `incorrectquestions` varchar(1000) DEFAULT NULL,
  `blank` varchar(1000) DEFAULT NULL,
  `attempted` varchar(1000) NOT NULL,
  `totalquestions` varchar(1000) NOT NULL,
  `mymarks` varchar(1000) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `totaltime` varchar(1000) NOT NULL,
  `mypercentile` varchar(1000) NOT NULL,
  `mytime` varchar(1000) NOT NULL,
  `correctmarks` varchar(1000) NOT NULL,
  `incorrectmarks` varchar(1000) NOT NULL,
  `timeleft` varchar(1000) NOT NULL,
  `studentname` varchar(1000) NOT NULL,
  `level1marks` varchar(1000) NOT NULL,
  `level2marks` varchar(1000) NOT NULL,
  `level3marks` varchar(1000) NOT NULL,
  `apppercent` varchar(500) NOT NULL,
  `level1questions` text NOT NULL,
  `level1correctquestions` text NOT NULL,
  `level1incorrectquestions` text NOT NULL,
  `level2questions` text NOT NULL,
  `level2correctquestions` text NOT NULL,
  `level2incorrectquestions` text NOT NULL,
  `level3questions` text NOT NULL,
  `level3correctquestions` text NOT NULL,
  `level3incorrectquestions` text NOT NULL,
  `level1correctmarks` text NOT NULL,
  `level1incorrectmarks` text NOT NULL,
  `level2correctmarks` text NOT NULL,
  `level2incorrectmarks` text NOT NULL,
  `level3correctmarks` text NOT NULL,
  `level3incorrectmarks` text NOT NULL,
  `level1totalmarks` text NOT NULL,
  `level2totalmarks` text NOT NULL,
  `level3totalmarks` text NOT NULL,
  `examtype` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sid` int(100) NOT NULL,
  `practisetestallowed` text NOT NULL,
  `srnotype` text NOT NULL,
  `logs` varchar(100) DEFAULT NULL,
  `tracking` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sid`, `practisetestallowed`, `srnotype`, `logs`, `tracking`) VALUES
(1, 'false', 'numbers', 'false', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `studentbatchentry`
--

CREATE TABLE `studentbatchentry` (
  `batchid` int(100) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` int(50) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(1000) DEFAULT NULL,
  `class` varchar(1000) DEFAULT NULL,
  `section` varchar(1000) DEFAULT NULL,
  `fathersname` varchar(1000) DEFAULT NULL,
  `mothersname` varchar(1000) DEFAULT NULL,
  `mobileno` varchar(1000) DEFAULT NULL,
  `dob` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `imgsrc` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) NOT NULL,
  `loggedin` text NOT NULL,
  `updated` text NOT NULL,
  `page` text NOT NULL,
  `oldpassword` varchar(500) DEFAULT NULL,
  `randname` text,
  `batch` varchar(200) DEFAULT NULL,
  `active` varchar(100) DEFAULT NULL,
  `examname` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testcontinue`
--

CREATE TABLE `testcontinue` (
  `attid` int(50) NOT NULL,
  `examname` varchar(1000) NOT NULL,
  `examid` varchar(500) NOT NULL,
  `studentid` varchar(500) NOT NULL,
  `examtype` varchar(1000) NOT NULL,
  `qindex` varchar(100) DEFAULT NULL,
  `continuetime` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_members`
--
ALTER TABLE `admin_members`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `answers_new`
--
ALTER TABLE `answers_new`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `appupdate`
--
ALTER TABLE `appupdate`
  ADD PRIMARY KEY (`updateid`);

--
-- Indexes for table `calender_events`
--
ALTER TABLE `calender_events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `examattempted`
--
ALTER TABLE `examattempted`
  ADD PRIMARY KEY (`attid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notiid`);

--
-- Indexes for table `partsresult`
--
ALTER TABLE `partsresult`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `partsresult_new`
--
ALTER TABLE `partsresult_new`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `questionentry`
--
ALTER TABLE `questionentry`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `questionpaper`
--
ALTER TABLE `questionpaper`
  ADD PRIMARY KEY (`qpid`);

--
-- Indexes for table `resultrank`
--
ALTER TABLE `resultrank`
  ADD PRIMARY KEY (`rankid`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `results_new`
--
ALTER TABLE `results_new`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `studentbatchentry`
--
ALTER TABLE `studentbatchentry`
  ADD PRIMARY KEY (`batchid`) USING BTREE;

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `testcontinue`
--
ALTER TABLE `testcontinue`
  ADD PRIMARY KEY (`attid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_members`
--
ALTER TABLE `admin_members`
  MODIFY `adminid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers_new`
--
ALTER TABLE `answers_new`
  MODIFY `aid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appupdate`
--
ALTER TABLE `appupdate`
  MODIFY `updateid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calender_events`
--
ALTER TABLE `calender_events`
  MODIFY `eventid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examattempted`
--
ALTER TABLE `examattempted`
  MODIFY `attid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `fid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `lid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notiid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partsresult`
--
ALTER TABLE `partsresult`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partsresult_new`
--
ALTER TABLE `partsresult_new`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionentry`
--
ALTER TABLE `questionentry`
  MODIFY `qid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionpaper`
--
ALTER TABLE `questionpaper`
  MODIFY `qpid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resultrank`
--
ALTER TABLE `resultrank`
  MODIFY `rankid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results_new`
--
ALTER TABLE `results_new`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentbatchentry`
--
ALTER TABLE `studentbatchentry`
  MODIFY `batchid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testcontinue`
--
ALTER TABLE `testcontinue`
  MODIFY `attid` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
