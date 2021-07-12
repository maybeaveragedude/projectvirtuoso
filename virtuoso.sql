-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 07:40 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtuoso`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `admin_email` varchar(128) NOT NULL,
  `admin_pwd` varchar(128) NOT NULL,
  `admin_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_name`, `admin_email`, `admin_pwd`, `admin_role`) VALUES
(1, 'dummyadmin', 'Dummy Admin', 'admin@dumb.mail', '123', '1');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(128) NOT NULL,
  `course_desc` int(11) NOT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_subtopics`
--

CREATE TABLE `course_subtopics` (
  `course_fid` int(11) NOT NULL,
  `sub_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `l_ID` int(11) NOT NULL,
  `l_email` varchar(128) NOT NULL,
  `l_pwd` varchar(128) NOT NULL,
  `l_username` varchar(128) NOT NULL,
  `l_nickname` varchar(128) DEFAULT NULL,
  `l_name` varchar(128) NOT NULL,
  `l_age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`l_ID`, `l_email`, `l_pwd`, `l_username`, `l_nickname`, `l_name`, `l_age`) VALUES
(1, 'dummy1@mail.com', 'dummypass', 'dummypass', 'dummypass', 'dummypass', 12),
(2, 'Dummy@mail.com', '$2y$10$mYt1d482B7p81IHzWe/b3uUzdur6BLBl2MiYpSCg0RnKQU7U64sQG', 'Dummy', NULL, 'Dummy', 0),
(3, 'dummytwo@mail.com', '$2y$10$5LJq8U7CHZmaAkYIPVwEGOxGDITO2CRkZu2UJJZhlpE0UGtb7OqwC', 'dummytwo', NULL, 'Dummytwo', 0),
(4, 'leysu@mail.com', '$2y$10$CvIkMDXGg0xM.IFahsLMLe13nNwXg/KIf7/7uWIGDon1qiT3G5wxa', 'Leysu', NULL, 'leysu', 0),
(5, 'textable@mail.com', '$2y$10$PlZwMn7Pb7wnykiQBkXH3uNDtoCygvygJB3TAg0g31NeCugG2H/s2', 'verytestable', NULL, 'Testing', 0),
(6, 'leysuyan@mail.com', '$2y$10$kQC1WHhQJ45fgKHAOVCEl.YLI6hFTbpBF6q5dKQfj7HzkqHkw6i.a', 'leysuyan', NULL, 'Leysuyan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `mat_id` int(11) NOT NULL,
  `mat_name` varchar(128) NOT NULL,
  `mat_file` longblob NOT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sbjt_id` int(11) NOT NULL,
  `sbjt_name` varchar(128) NOT NULL,
  `sbjt_desc` text NOT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sbjt_id`, `sbjt_name`, `sbjt_desc`, `t_fid`, `approval_admin_fid`) VALUES
(2, 'Science', 'Science is the pursuit and application of knowledge and understanding of the natural and social world following a systematic methodology based on evidence.', 25, NULL),
(3, 'Maths', 'Mathematics includes the study of such topics as quantity, structure, space, and change. It has no generally accepted definition. Mathematicians seek and use patterns to formulate new conjectures; they resolve the truth or falsity of such by mathematical proof.', 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE `subtopic` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(128) NOT NULL,
  `sub_desc` text NOT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) DEFAULT NULL,
  `topic_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtopic`
--

INSERT INTO `subtopic` (`sub_id`, `sub_name`, `sub_desc`, `t_fid`, `approval_admin_fid`, `topic_fid`) VALUES
(1, 'Atomic Structure', 'the structure of an atom, theoretically consisting of a positively charged nucleus surrounded and neutralized by negatively charged electrons revolving in orbits at varying distances from the nucleus, the constitution of the nucleus and the arrangement of the electrons differing with various chemical elements.', 25, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subtopic_materials`
--

CREATE TABLE `subtopic_materials` (
  `sub_fid` int(11) NOT NULL,
  `mat_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_ID` int(11) NOT NULL,
  `t_username` varchar(128) NOT NULL,
  `t_name` varchar(128) NOT NULL,
  `t_email` varchar(128) NOT NULL,
  `t_pwd` varchar(128) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 0,
  `approval_admin_fid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_ID`, `t_username`, `t_name`, `t_email`, `t_pwd`, `t_status`, `approval_admin_fid`) VALUES
(21, 'dummy', 'Shawn Lee Wen Xuen', 'leysuyan@mail.com', '$2y$10$t4vBtY7X/mZ66fnGeScIhOYt5OejdU8FaO.RO7q/soOti2ewO4e0e', 3, NULL),
(22, 'dummytwo', 'Shawn Lee Wen Xuen', 'dummytwo@mail.com', '$2y$10$aE2.PSPzHjHhhl19E/APmuwk4b1bNX2hYzs.Gp5W6Ml0CHr7nB3X6', 3, NULL),
(23, 'dummytwo333', 'Shawn Lee Wen Xuen', 'rebornedshawnlee@hotmail.com', '$2y$10$vqmOvsMseDuaFkhlxjg2FO8aHNLjvH.M5MKFN/1FzBjVrvluE3Pym', 3, NULL),
(24, 'AverageDude', 'Shawn Lee Wen Xuen', 'textable@mail.com', '$2y$10$j5e5Oh68epXR8IuHDr35fOcRSYBe5/luIrNpDRJAsvJqHZdJflEr2', 3, NULL),
(25, 'offteacher', 'Official Test', 'testteacher@mail.com', '$2y$10$5GGWibvVF1pbiRpsayZa8uhTjbzEbCXAAGF5/9J2Xd.TIwBU1k5Oa', 3, NULL),
(26, 'newdummy', 'New Dummy', 'new@mail.com', '$2y$10$SH6y2mIvF.BcngxS2rg/MOxwrlaHnZYfKvwJQpsKkpeQlo/JR4oZC', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL,
  `t_fid` int(11) NOT NULL,
  `topic_name` varchar(128) NOT NULL,
  `topic_desc` text NOT NULL,
  `approval_admin_fid` int(11) DEFAULT NULL,
  `sbjt_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_id`, `t_fid`, `topic_name`, `topic_desc`, `approval_admin_fid`, `sbjt_fid`) VALUES
(1, 25, 'Chemistry', 'the branch of science concerned with the substances of which matter is composed, the investigation of their properties and reactions, and the use of such reactions to form new substances.', NULL, 2),
(2, 25, 'Arithmetic ', 'the branch of mathematics dealing with the properties and manipulation of numbers.', NULL, 3),
(3, 26, 'Trigonometry', 'the branch of mathematics dealing with the relations of the sides and angles of triangles and with the relevant functions of any angles.', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_proposal`
--

CREATE TABLE `t_proposal` (
  `t_proposal_id` int(11) NOT NULL,
  `t_sub` varchar(128) NOT NULL,
  `t_years` varchar(128) NOT NULL,
  `t_brief` text NOT NULL,
  `t_up_fid` int(11) DEFAULT NULL,
  `t_url` varchar(128) DEFAULT NULL,
  `t_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_proposal`
--

INSERT INTO `t_proposal` (`t_proposal_id`, `t_sub`, `t_years`, `t_brief`, `t_up_fid`, `t_url`, `t_fid`) VALUES
(11, 'Science, Engineering, adasdasd', '2', 'qweqweqwe', 22, '', 24),
(12, 'Science', '2', 'asdasdasdasd', 23, '', 25),
(13, 'Technology', '1', 'asdasd', 24, '', 26);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `up_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`up_id`, `file_name`, `uploaded_on`, `status`) VALUES
(12, 'ezgif.com-gif-maker.png', '2021-07-02 21:00:21', '1'),
(13, 'ezgif.com-gif-maker.png', '2021-07-02 21:12:45', '1'),
(14, 'ezgif.com-gif-maker.png', '2021-07-02 21:13:11', '1'),
(15, 'Hnet.com-image.gif', '2021-07-02 21:14:46', '1'),
(16, 'Hnet.com-image.gif', '2021-07-02 21:15:13', '1'),
(17, 'Hnet.com-image.gif', '2021-07-02 21:16:58', '1'),
(18, 'Hnet.com-image.gif', '2021-07-02 21:31:19', '1'),
(19, 'Hnet.com-image.gif', '2021-07-02 21:36:48', '1'),
(20, 'Hnet.com-image.gif', '2021-07-02 21:40:53', '1'),
(21, 'Hnet.com-image.gif', '2021-07-02 22:41:35', '1'),
(22, 'ezgif.com-gif-maker.png', '2021-07-02 22:54:06', '1'),
(23, 'Hnet.com-image.gif', '2021-07-06 13:57:58', '1'),
(24, 'vibe.gif', '2021-07-09 18:52:35', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`);

--
-- Indexes for table `course_subtopics`
--
ALTER TABLE `course_subtopics`
  ADD KEY `course_fid` (`course_fid`,`sub_fid`),
  ADD KEY `sub_fid` (`sub_fid`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`l_ID`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`mat_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sbjt_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`);

--
-- Indexes for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`),
  ADD KEY `topic_fid` (`topic_fid`);

--
-- Indexes for table `subtopic_materials`
--
ALTER TABLE `subtopic_materials`
  ADD KEY `sub_fid` (`sub_fid`,`mat_fid`),
  ADD KEY `mat_fid` (`mat_fid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_ID`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`),
  ADD KEY `sbjt_fid` (`sbjt_fid`);

--
-- Indexes for table `t_proposal`
--
ALTER TABLE `t_proposal`
  ADD PRIMARY KEY (`t_proposal_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `t_up_fid` (`t_up_fid`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`up_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `l_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sbjt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subtopic`
--
ALTER TABLE `subtopic`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_proposal`
--
ALTER TABLE `t_proposal`
  MODIFY `t_proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`t_fid`) REFERENCES `teacher` (`t_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_subtopics`
--
ALTER TABLE `course_subtopics`
  ADD CONSTRAINT `course_subtopics_ibfk_1` FOREIGN KEY (`course_fid`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_subtopics_ibfk_2` FOREIGN KEY (`sub_fid`) REFERENCES `subtopic` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subjectcreator` FOREIGN KEY (`t_fid`) REFERENCES `teacher` (`t_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `subtopic_ibfk_1` FOREIGN KEY (`t_fid`) REFERENCES `teacher` (`t_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subtopic_ibfk_2` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topicsubtopic` FOREIGN KEY (`topic_fid`) REFERENCES `topic` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtopic_materials`
--
ALTER TABLE `subtopic_materials`
  ADD CONSTRAINT `subtopic_materials_ibfk_1` FOREIGN KEY (`sub_fid`) REFERENCES `subtopic` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subtopic_materials_ibfk_2` FOREIGN KEY (`mat_fid`) REFERENCES `materials` (`mat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `subjecttopic` FOREIGN KEY (`sbjt_fid`) REFERENCES `subject` (`sbjt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topiccreator` FOREIGN KEY (`t_fid`) REFERENCES `teacher` (`t_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_proposal`
--
ALTER TABLE `t_proposal`
  ADD CONSTRAINT `teacherproposal` FOREIGN KEY (`t_fid`) REFERENCES `teacher` (`t_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uploads` FOREIGN KEY (`t_up_fid`) REFERENCES `uploads` (`up_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
