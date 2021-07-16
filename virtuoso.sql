-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 12:52 PM
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
  `course_desc` text NOT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `t_fid`, `approval_admin_fid`) VALUES
(72, 'Definitely a New Course', 'A legit description', 26, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_subtopics`
--

CREATE TABLE `course_subtopics` (
  `course_fid` int(11) NOT NULL,
  `sub_fid` int(11) NOT NULL,
  `display_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_subtopics`
--

INSERT INTO `course_subtopics` (`course_fid`, `sub_fid`, `display_order`) VALUES
(72, 9, 1),
(72, 6, 2),
(72, 1, 3),
(72, 3, 4),
(72, 5, 5),
(72, 13, 6),
(72, 11, 7);

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
(6, 'leysuyan@mail.com', '$2y$10$kQC1WHhQJ45fgKHAOVCEl.YLI6hFTbpBF6q5dKQfj7HzkqHkw6i.a', 'leysuyan', NULL, 'Leysuyan', 0),
(7, 'mail@mailmail.com', '$2y$10$2nDYA7XmxnUKhtN63HLBbOMJLWCbO1wV4sxu4lcz6HYIvHmJ1a81O', 'yessir', NULL, 'yes', 0),
(8, 'newtest@test.com', '$2y$10$gXpiQ6L6/BPI4tHZOX5og.1cyYblvG90UzcZIpqo3pyHGRCUB5vSm', 'testlearner', NULL, 'TestUser', 0),
(9, 'yessir222@mail.com', '$2y$10$mmRo0TX/9adhye7FrfW4x.v/zH/6VCVgyqAx7K6HgsH2NBWh744Je', 'yessir2', NULL, 'yessir two', 0);

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
(3, 'Maths', 'Mathematics includes the study of such topics as quantity, structure, space, and change. It has no generally accepted definition. Mathematicians seek and use patterns to formulate new conjectures; they resolve the truth or falsity of such by mathematical proof.', 25, NULL),
(4, 'Computer Programming', 'Computer programming is the process of designing and building an executable computer program to accomplish a specific computing result or to perform a specific task.', 26, NULL),
(5, 'English', 'the language of England, widely used in many varieties throughout the world.', 26, NULL),
(6, 'Chinese', 'Chinese is a group of language varieties that form the Sinitic branch of the Sino-Tibetan languages, spoken by the ethnic Han Chinese majority and many minority ethnic groups in Greater China. About 1.3 billion people speak a variety of Chinese as their first language.', 26, NULL);

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
(1, 'Atomic Structure', 'the structure of an atom, theoretically consisting of a positively charged nucleus surrounded and neutralized by negatively charged electrons revolving in orbits at varying distances from the nucleus, the constitution of the nucleus and the arrangement of the electrons differing with various chemical elements.', 25, NULL, 1),
(3, 'Cells', 'Cells are the basic building blocks of all living things. The human body is composed of trillions of cells. They provide structure for the body, take in nutrients from food, convert those nutrients into energy, and carry out specialized functions. Cells also contain the body’s hereditary material and can make copies of themselves.', 25, NULL, 4),
(4, 'Units and Standards', 'These are called the base quantities for that system and their units are the system\'s base units. All other physical quantities can then be expressed as algebraic combinations of the base quantities. Each of these physical quantities is then known as a derived quantity and each unit is called a derived unit.', 26, NULL, 5),
(5, 'Descriptive statistics', 'A descriptive statistic is a summary statistic that quantitatively describes or summarizes features from a collection of information, while descriptive statistics is the process of using and analysing those statistics.', 26, NULL, 6),
(6, 'Looping with C', 'Looping Statements in C execute the sequence of statements many times until the stated condition becomes false. A loop in C consists of two parts, a body of a loop and a control statement. The control statement is a combination of some conditions that direct the body of the loop to execute until the specified condition becomes false. The purpose of the C loop is to repeat the same code a number of times.', 26, NULL, 7),
(7, 'Variables in C', 'Your C programs can use two types of values: immediate and variable. An immediate value is one that you specify in the source code — a value you type or a defined constant. Variables are also values, but their contents can change. That’s why they’re called variables and not all-the-time-ables.', 26, NULL, 7),
(8, 'C Arithmetic Operators', 'An arithmetic operator performs mathematical operations such as addition, subtraction, multiplication, division etc on numerical values (constants and variables).', 26, NULL, 7),
(9, 'A Poison Tree', '\"A Poison Tree\" is a poem written by William Blake, published in 1794 as part of his Songs of Experience collection. It describes the narrator\'s repressed feelings of anger towards an individual, emotions which eventually lead to murder.', 26, NULL, 8),
(10, 'Probability', 'the quality or state of being probable; the extent to which something is likely to happen or be the case.', 26, NULL, 6),
(11, 'The Art of War', 'The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period. The work, which is attributed to the ancient Chinese military strategist Sun Tzu, is composed of 13 chapters.', 26, NULL, 9),
(12, 'Pointer in C', 'The Pointer in C, is a variable that stores address of another variable. A pointer can also be used to refer to another pointer function. A pointer can be incremented/decremented, i.e., to point to the next/ previous memory location. The purpose of pointer is to save memory space and achieve faster execution time.', 28, NULL, 7),
(13, 'Header Files in C', 'In C language, header files contain the set of predefined standard library functions. The “#include” preprocessing directive is used to include the header files with “.h” extension in the program.', 28, NULL, 7),
(14, 'Object oriented programming with Java', 'The OOPs Concepts in Java are abstraction, encapsulation, inheritance, and polymorphism. These concepts aim to implement real-world entities in programs.', 30, NULL, 10);

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
(26, 'newdummy', 'New Dummy', 'new@mail.com', '$2y$10$SH6y2mIvF.BcngxS2rg/MOxwrlaHnZYfKvwJQpsKkpeQlo/JR4oZC', 0, NULL),
(27, 'emptyteacher', 'Empty New Teacher', 'empty@mail.com', '$2y$10$MF8Rybph61xRbCMCf6LF9.SXak7qETo81ez8GcQflptymSLNykZmm', 0, NULL),
(28, 'yanteaches', 'Leysu Yan', 'yan@mail.com', '$2y$10$H4YJakfIZ6tOyPiX33G2X.1GeJEQBDS..jfo5UDSFqSG2PG.dWV8i', 0, NULL),
(29, 'clementteaches', 'Clement Ho', 'clement@mail.com', '$2y$10$BMTNRdp8HN7Sj8VcHzA6Pumahpu755bJbl3zDaNNqs9IaV/FlclNO', 0, NULL),
(30, 'helloworld', 'another yes sir', 'another@mail.com', '$2y$10$fxU1iUiK5O7QiAvHu41s4uOM52gZ/Ek0ZF.ktqMqgxgU0.PIisKWC', 0, NULL);

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
(4, 26, 'Biology', 'Biology is the scientific study of life. It is a natural science with a broad scope but has several unifying themes that tie it together as a single, coherent field.', NULL, 2),
(5, 26, 'Physics', 'the branch of science concerned with the nature and properties of matter and energy. The subject matter of physics includes mechanics, heat, light and other radiation, sound, electricity, magnetism, and the structure of atoms.', NULL, 2),
(6, 26, 'Statistics', 'Statistics is the discipline that concerns the collection, organization, analysis, interpretation, and presentation of data. In applying statistics to a scientific, industrial, or social problem, it is conventional to begin with a statistical population or a statistical model to be studied.', NULL, 3),
(7, 26, 'C', 'It was mainly developed as a system programming language to write an operating system. The main features of the C language include low-level memory access, a simple set of keywords, and a clean style, these features make C language suitable for system programmings like an operating system or compiler development', NULL, 4),
(8, 26, 'Literature', 'Literature broadly is any collection of written work, but it is also used more narrowly for writings specifically considered to be an art form, especially prose fiction, drama, and poetry. In recent centuries, the definition has expanded to include oral literature, much of which has been transcribed.', NULL, 5),
(9, 26, 'Chinese literature', 'The history of Chinese literature extends thousands of years, from the earliest recorded dynastic court archives to the mature vernacular fiction novels that arose during the Ming dynasty to entertain the masses of literate Chinese.', NULL, 6),
(10, 30, 'Java', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.', NULL, 4);

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
(13, 'Technology', '1', 'asdasd', 24, '', 26),
(14, 'Technology', '1', 'empty yes', 25, '', 27),
(15, 'Technology', '2', 'yan yes cooks', 26, '', 28),
(16, 'Science, adasdasd', '1', 'dsfdgdvbvbdfgwr', 27, '', 29);

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
(24, 'vibe.gif', '2021-07-09 18:52:35', '1'),
(25, 'dead.jpg', '2021-07-13 20:49:35', '1'),
(26, 'image_2021-07-13_234124.png', '2021-07-13 23:41:29', '1'),
(27, 'dead.jpg', '2021-07-14 15:37:12', '1');

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
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `l_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sbjt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subtopic`
--
ALTER TABLE `subtopic`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_proposal`
--
ALTER TABLE `t_proposal`
  MODIFY `t_proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
