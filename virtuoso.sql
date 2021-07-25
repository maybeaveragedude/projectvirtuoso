-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 06:10 PM
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
  `approval_admin_fid` int(11) DEFAULT NULL,
  `course_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `t_fid`, `approval_admin_fid`, `course_status`) VALUES
(73, 'asasd', 'qweqwe', 24, NULL, 0),
(75, 'New Test Course', 'yes', 26, NULL, 0),
(76, 'ANOTHER ONE', 'ANOTHER ONE', 26, NULL, 0),
(77, 'This file test course', 'Yes desc; yes', 31, NULL, 0),
(78, 'Sunday Test', 'YASALSKDJKA*&*&', 26, NULL, 0),
(81, 'Crash Test', 'Testing', 26, NULL, 0),
(82, 'NEW', 'qweqweqwe', 26, NULL, 0),
(83, 'Very Maths', 'Thank you', 21, NULL, 0);

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
(73, 1, 1),
(73, 3, 2),
(76, 5, 1),
(76, 9, 2),
(76, 10, 3),
(76, 6, 4),
(76, 11, 5),
(76, 15, 6),
(77, 8, 1),
(77, 5, 2),
(77, 6, 3),
(77, 9, 4),
(77, 10, 5),
(78, 5, 1),
(78, 16, 2),
(78, 4, 3),
(78, 11, 4),
(78, 15, 5),
(75, 8, 1),
(75, 14, 2),
(75, 6, 3),
(75, 13, 4),
(75, 15, 5),
(81, 5, 1),
(81, 1, 2),
(82, 1, 1),
(82, 5, 2),
(83, 5, 1),
(83, 6, 2),
(83, 14, 3);

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
(9, 'yessir222@mail.com', '$2y$10$mmRo0TX/9adhye7FrfW4x.v/zH/6VCVgyqAx7K6HgsH2NBWh744Je', 'yessir2', NULL, 'yessir two', 0),
(10, 'error@mail.com', '$2y$10$7N6YvCuntKcvGQBEw7jpO.29fPt1unuk70jOxHlhjI9I0OwSW2usm', 'isthereerror', NULL, 'TesterrorStudent', 0),
(11, 'asd', '$2y$10$HsDM0cCVBndeqnAEMDUVquj.DGjHlUTlzhL2LRO1oW4tD1AHbODDK', 'asd', NULL, 'asd', 0),
(12, 'test@mail.com', '$2y$10$Jx/0n8OKs16c1MqXIsO0/.fGo2LjnePr3hBHp26SjcWW3.jFf2pPC', 'testforemail', NULL, 'Test For Email', 0),
(13, 'test@learner.com', '$2y$10$7WDa5Ft6aNO5cL4kXvQzu.SmUfBBdzWI31OAlcK0kYg1piyClBSai', 'newesttestlearner', NULL, 'Newest Test Learner', 0);

-- --------------------------------------------------------

--
-- Table structure for table `learners_course`
--

CREATE TABLE `learners_course` (
  `l_fid` int(11) NOT NULL,
  `course_fid` int(11) NOT NULL,
  `total_progress` int(4) NOT NULL DEFAULT 0,
  `quiz_scores` int(4) NOT NULL DEFAULT 0,
  `subscription_date` datetime NOT NULL,
  `material_progress` mediumtext DEFAULT NULL,
  `quiz_progress` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learners_course`
--

INSERT INTO `learners_course` (`l_fid`, `course_fid`, `total_progress`, `quiz_scores`, `subscription_date`, `material_progress`, `quiz_progress`) VALUES
(6, 75, 100, 100, '2021-07-24 22:36:18', '[\"mat102\",\"mat94\",\"mat78\",\"mat104\"]', '[\"quiz108\",\"quiz117\",\"quiz119\"]'),
(6, 76, 0, 0, '2021-07-25 18:33:57', NULL, NULL),
(6, 82, 0, 0, '2021-07-25 18:35:27', NULL, NULL),
(13, 76, 27, 20, '2021-07-25 18:35:59', '[\"mat97\",\"mat93\"]', '[\"quiz112\"]');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `mat_id` int(11) NOT NULL,
  `mat_name` varchar(128) NOT NULL,
  `mat_file_upload_fid` int(11) DEFAULT NULL,
  `mat_contents` mediumtext DEFAULT NULL,
  `t_fid` int(11) NOT NULL,
  `approval_admin_fid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`mat_id`, `mat_name`, `mat_file_upload_fid`, `mat_contents`, `t_fid`, `approval_admin_fid`) VALUES
(77, 'Stable Octet', 54, 'The term “stable octet” describes the fact that many atoms in molecules are most stable when the valence shell contains effectively eight electrons. This counts both non-bonding electrons and electrons in chemical bonds between atoms. Molecules tend to be', 26, NULL),
(78, 'for Loop', 55, 'How for loop works?\r\nThe initialization statement is executed only once.\r\nThen, the test expression is evaluated. If the test expression is evaluated to false, the for loop is terminated.\r\nHowever, if the test expression is evaluated to true, statements i', 26, NULL),
(93, 'Descriptive Statistics', 66, 'Descriptive statistics are used to describe the basic features of the data in a study. They provide simple summaries about the sample and the measures. Together with simple graphics analysis, they form the basis of virtually every quantitative analysis of', 21, NULL),
(94, 'List of OOP Concepts in Java', 67, 'There are four main OOP concepts in Java. These are:\r\n\r\nAbstraction. Abstraction means using simple things to represent complexity. We all know how to turn the TV on, but we don’t need to know how it works in order to enjoy it. In Java, abstraction means ', 24, NULL),
(96, 'Atomic Mass', 69, 'Protons and neutrons have approximately the same mass, about 1.67 × 10-24 grams. Scientists define this amount of mass as one atomic mass unit (amu) or one Dalton. Although similar in mass, protons are positively charged, while neutrons have no charge. Therefore, the number of neutrons in an atom contributes significantly to its mass, but not to its charge.\r\n\r\nElectrons are much smaller in mass than protons, weighing only 9.11 × 10-28 grams, or about 1/1800 of an atomic mass unit. Therefore, they do not contribute much to an element’s overall atomic mass. When considering atomic mass, it is customary to ignore the mass of any electrons and calculate the atom’s mass based on the number of protons and neutrons alone.\r\n\r\nElectrons contribute greatly to the atom’s charge, as each electron has a negative charge equal to the positive charge of a proton. Scientists define these charges as “+1” and “-1. ” In an uncharged, neutral atom, the number of electrons orbiting the nucleus is equal to the number of protons inside the nucleus. In these atoms, the positive and negative charges cancel each other out, leading to an atom with no net charge.', 26, NULL),
(97, 'Normal Statistics', 70, 'The most common basic statistics terms you\'ll come across are the mean, mode and median. These are all what are known as “Measures of Central Tendency.” Also important in this early chapter of statistics is the shape of a distribution. This tells us something about how data is spread out around the mean or median.', 26, NULL),
(102, 'While Loop', 75, 'A while loop is the most straightforward looping structure. While loop syntax in C programming language is as follows:\r\n\r\nIt is an entry-controlled loop. In while loop, a condition is evaluated before processing a body of the loop. If a condition is true then and only then the body of a loop is executed. After the body of a loop is executed then control again goes back at the beginning, and the condition is checked if it is true, the same process is executed until the condition becomes false. Once the condition becomes false, the control goes out of the loop.\r\n\r\nAfter exiting the loop, the control goes to the statements which are immediately after the loop. The body of a loop can contain more than one statement. If it contains only one statement, then the curly braces are not compulsory. It is a good practice though to use the curly braces even we have a single statement in the body.\r\n\r\nIn while loop, if the condition is not true, then the body of a loop will not be executed, not even once. It is different in do while loop which we will see shortly.', 26, NULL),
(103, 'Isotopes', 76, 'Isotopes are various forms of an element that have the same number of protons but a different number of neutrons. Some elements, such as carbon, potassium, and uranium, have multiple naturally-occurring isotopes. Isotopes are defined first by their element and then by the sum of the protons and neutrons present.\r\n\r\nCarbon-12 (or 12C) contains six protons, six neutrons, and six electrons; therefore, it has a mass number of 12 amu (six protons and six neutrons).\r\nCarbon-14 (or 14C) contains six protons, eight neutrons, and six electrons; its atomic mass is 14 amu (six protons and eight neutrons).\r\nWhile the mass of individual isotopes is different, their physical and chemical properties remain mostly unchanged.\r\n\r\nIsotopes do differ in their stability. Carbon-12 (12C) is the most abundant of the carbon isotopes, accounting for 98.89% of carbon on Earth. Carbon-14 (14C) is unstable and only occurs in trace amounts. Unstable isotopes most commonly emit alpha particles (He2+) and electrons. Neutrons, protons, and positrons can also be emitted and electrons can be captured to attain a more stable atomic configuration (lower level of potential energy ) through a process called radioactive decay. The new atoms created may be in a high energy state and emit gamma rays which lowers the energy but alone does not change the atom into another isotope. These atoms are called radioactive isotopes or radioisotopes.', 26, NULL),
(104, 'Electrochemistry Basics', 77, 'Electrochemistry is the study of chemical processes that cause electrons to move. This movement of electrons is called electricity, which can be generated by movements of electrons from one element to another in a reaction known as an oxidation-reduction (\"redox\") reaction. A redox reaction is a reaction that involves a change in oxidation state of one or more elements. When a substance loses an electron, its oxidation state increases; thus, it is oxidized. When a substance gains an electron, its oxidation state decreases, thus being reduced. For example, for the redox reaction', 24, NULL),
(105, 'Binomial Distribution', 78, 'A binomial distribution can be thought of as simply the probability of a SUCCESS or FAILURE outcome in an experiment or survey that is repeated multiple times. The binomial is a type of distribution that has two possible outcomes (the prefix “bi” means two, or twice). For example, a coin toss has only two possible outcomes: heads or tails and taking a test could have two possible outcomes: pass or fail.\r\n\r\n- The first variable in the binomial formula, n, stands for the number of times the experiment runs.\r\n- The second variable, p, represents the probability of one specific outcome.\r\n\r\nFor example, let’s suppose you wanted to know the probability of getting a 1 on a die roll. if you were to roll a die 20 times, the probability of rolling a one on any throw is 1/6. Roll twenty times and you have a binomial distribution of (n=20, p=1/6). SUCCESS would be “roll a one” and FAILURE would be “roll anything else.” If the outcome in question was the probability of the die landing on an even number, the binomial distribution would then become (n=20, p=1/2). That’s because your probability of throwing an even number is one half.', 21, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_question` text NOT NULL,
  `display_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_question`, `display_order`) VALUES
(93, 'Select the correct statement.', 1),
(105, 'How for loop works?\nThe initialization statement is executed only once.\nThen, the test expression is evaluated. If the test expression is evaluated to false, the for loop is terminated.\nHowever, if the test expression is evaluated to true, statements inside the body of the for loop are executed, and the update expression is updated.\nAgain the test expression is evaluated.\nThis process goes on until the test expression is false. When the test expression is false, the loop terminates.', 1),
(106, '// Print numbers from 1 to 10\n#include <stdio.h>\n\nint main() {\n  int i;\n\n  for (i = 1; i < 11; ++i)\n  {\n    printf(\"%d \", i);\n  }\n  return 0;\n}', 2),
(107, 'From the given five-number summary found after a class has taken an exam, which statement below is true?\n\n7, 13, 17, 21, 43', 1),
(108, 'What is a class?', 1),
(109, 'are you delete able', 1),
(110, 'The Atomic Mass is the number of protons in an element, while the mass number is the number of protons plus the number of neutrons.', 1),
(111, 'Protons and neutrons have approximately the mass of', 2),
(112, 'n', 1),
(113, ' The body of a loop can contain ____________ statement.', 1),
(114, 'The body of a loop can contain _______________ statement.', 1),
(115, 'The body of a loop can contain ___________ statement.', 1),
(116, 'The body of a loop can contain ____________ statement.', 1),
(117, 'The body of a loop can contain more than one statement.', 1),
(118, 'Unstable isotopes most commonly emit ', 1),
(119, 'What is the oxidation state of magnesium in  MgF2 ?', 1),
(120, 'Kelvin has taken 3 shots in a shooting practice. The probability that Kelvin strikes the target is 0.6. X represents the number of times kelvin strikes the target.\n\n(a) Calculate the probability for the occurrence of elements of X, when X = 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizz_choices`
--

CREATE TABLE `quizz_choices` (
  `choice_id` int(11) NOT NULL,
  `choice` text DEFAULT NULL,
  `true_false` tinyint(1) NOT NULL DEFAULT 0,
  `quiz_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizz_choices`
--

INSERT INTO `quizz_choices` (`choice_id`, `choice`, `true_false`, `quiz_fid`) VALUES
(7, 'Na+ is more stable than Na', 1, 93),
(8, 'Na+ is less stable than Na', 0, 93),
(9, 'Na+ and Na are equally stable', 0, 93),
(10, 'I do not know', 0, 93),
(17, 'Fine', 1, 105),
(18, 'Very fine', 0, 105),
(19, 'unlucky', 0, 105),
(20, 'dead', 0, 105),
(21, 'Yes', 0, 106),
(22, 'Nope', 1, 106),
(23, 'The mean of the lowest 25% is 7.', 1, 107),
(24, '25% of students earned 17 or fewer.', 0, 107),
(25, '50% of students earned 17 or more.', 0, 107),
(26, 'The highest score in the class was more than 43.', 0, 107),
(27, 'A logical entity', 1, 108),
(28, ' A physical entity', 0, 108),
(29, 'TRUE', 1, 109),
(30, 'FALSE', 0, 109),
(31, 'TRUE', 0, 110),
(32, 'FALSE', 1, 110),
(33, '1.67 × 10-26 grams', 0, 111),
(34, '11.11 × 10-28 grams', 0, 111),
(35, '9.11 × 10-28 grams', 0, 111),
(36, '1.67 × 10-24 grams', 1, 111),
(37, 'number of events', 1, 112),
(38, 'smallest value seen', 0, 112),
(39, 'One', 0, 113),
(40, 'Three', 0, 113),
(41, 'Two', 0, 113),
(42, 'More than one', 1, 113),
(43, 'one', 0, 114),
(44, 'more than one', 1, 114),
(45, 'three', 0, 114),
(46, 'two', 0, 114),
(47, 'one', 0, 115),
(48, 'one or more', 1, 115),
(49, 'two', 0, 115),
(50, 'three', 0, 115),
(51, 'one', 0, 116),
(52, 'more than one', 1, 116),
(53, 'two', 0, 116),
(54, 'three', 0, 116),
(55, 'one', 0, 117),
(56, 'more than one', 1, 117),
(57, 'two', 0, 117),
(58, 'three', 0, 117),
(59, 'protons.', 0, 118),
(60, 'atoms.', 0, 118),
(61, 'electrons.', 1, 118),
(62, 'neutrons.', 0, 118),
(63, 'MgF2  total charge=0 Total Charge=(-2)+(+1*2)=0', 0, 119),
(64, 'MgF2  total charge=0 Total Charge=(+2)+(-1*2)=0', 1, 119),
(65, '0.064', 0, 120),
(66, '0.288', 0, 120),
(67, '0.432', 0, 120),
(68, '0.216', 1, 120);

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
(4, 'Units and Standards I', 'These are called the base quantities for that system and their units are the system\'s base units. All other physical quantities can then be expressed as algebraic combinations of the base quantities. Each of these physical quantities is then known as a derived quantity and each unit is called a derived unit.', 26, NULL, 5),
(5, 'Descriptive statistics', 'A descriptive statistic is a summary statistic that quantitatively describes or summarizes features from a collection of information, while descriptive statistics is the process of using and analysing those statistics.', 26, NULL, 6),
(6, 'Looping with C', 'Looping Statements in C execute the sequence of statements many times until the stated condition becomes false. A loop in C consists of two parts, a body of a loop and a control statement. The control statement is a combination of some conditions that direct the body of the loop to execute until the specified condition becomes false. The purpose of the C loop is to repeat the same code a number of times.', 26, NULL, 7),
(7, 'Variables in C', 'Your C programs can use two types of values: immediate and variable. An immediate value is one that you specify in the source code — a value you type or a defined constant. Variables are also values, but their contents can change. That’s why they’re called variables and not all-the-time-ables.', 26, NULL, 7),
(8, 'C Arithmetic Operators', 'An arithmetic operator performs mathematical operations such as addition, subtraction, multiplication, division etc on numerical values (constants and variables).', 26, NULL, 7),
(9, 'A Poison Tree', '\"A Poison Tree\" is a poem written by William Blake, published in 1794 as part of his Songs of Experience collection. It describes the narrator\'s repressed feelings of anger towards an individual, emotions which eventually lead to murder.', 26, NULL, 8),
(10, 'Probability III', 'the quality or state of being probable; the extent to which something is likely to happen or be the case.', 26, NULL, 6),
(11, 'The Art of War', 'The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period. The work, which is attributed to the ancient Chinese military strategist Sun Tzu, is composed of 13 chapters.', 26, NULL, 9),
(12, 'Pointer in C', 'The Pointer in C, is a variable that stores address of another variable. A pointer can also be used to refer to another pointer function. A pointer can be incremented/decremented, i.e., to point to the next/ previous memory location. The purpose of pointer is to save memory space and achieve faster execution time.', 28, NULL, 7),
(13, 'Header Files in C', 'In C language, header files contain the set of predefined standard library functions. The “#include” preprocessing directive is used to include the header files with “.h” extension in the program.', 28, NULL, 7),
(14, 'Object oriented programming with Java', 'The OOPs Concepts in Java are abstraction, encapsulation, inheritance, and polymorphism. These concepts aim to implement real-world entities in programs.', 30, NULL, 10),
(15, 'Electrochemistry', 'Electrochemistry is the branch of physical chemistry concerned with the relationship between electrical potential, as a measurable and quantitative phenomenon, and identifiable chemical change, with either electrical potential as an outcome of a particular chemical change, or vice versa.', 26, NULL, 1),
(16, 'Units and Standards II', 'this is the description for Units and Standards II', 31, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `subtopic_materials`
--

CREATE TABLE `subtopic_materials` (
  `quiz_fid` int(11) DEFAULT NULL,
  `sub_fid` int(11) NOT NULL,
  `mat_fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtopic_materials`
--

INSERT INTO `subtopic_materials` (`quiz_fid`, `sub_fid`, `mat_fid`) VALUES
(95, 1, 77),
(97, 6, 78),
(107, 5, 93),
(108, 14, 94),
(111, 1, 96),
(112, 5, 97),
(117, 6, 102),
(118, 1, 103),
(119, 15, 104),
(120, 5, 105);

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
(30, 'helloworld', 'another yes sir', 'another@mail.com', '$2y$10$fxU1iUiK5O7QiAvHu41s4uOM52gZ/Ek0ZF.ktqMqgxgU0.PIisKWC', 0, NULL),
(31, 'testfile', 'TestFile', 'testfile@mail.com', '$2y$10$ONbb/7I/d/js3Udh4M0NVOFBEpK4WCDym02KlRYw2nFiY72Qe3A2y', 0, NULL);

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
(16, 'Science, adasdasd', '1', 'dsfdgdvbvbdfgwr', 27, '', 29),
(18, 'Technology, Engineering', '1', 'qweqweqweasd', 28, '', 31);

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
(27, 'dead.jpg', '2021-07-14 15:37:12', '1'),
(28, 'vibe.gif', '2021-07-18 01:07:34', '1'),
(37, 'vibe.gif', '2021-07-20 19:02:39', '1'),
(38, 'vibe.gif', '2021-07-20 19:03:02', '1'),
(39, 'vibe.gif', '2021-07-20 19:05:37', '1'),
(40, 'vibe.gif', '2021-07-20 19:09:21', '1'),
(41, 'vibe.gif', '2021-07-20 19:10:24', '1'),
(42, 'vibe.gif', '2021-07-20 19:11:16', '1'),
(43, 'vibe.gif', '2021-07-20 19:11:23', '1'),
(44, 'vibe.gif', '2021-07-20 19:11:34', '1'),
(45, 'vibe.gif', '2021-07-20 19:11:39', '1'),
(46, 'vibe.gif', '2021-07-20 19:16:31', '1'),
(47, 'vibe.gif', '2021-07-20 20:04:56', '1'),
(48, 'vibe.gif', '2021-07-20 20:14:33', '1'),
(49, 'vibe.gif', '2021-07-20 20:17:10', '1'),
(50, 'vibe.gif', '2021-07-20 20:34:57', '1'),
(51, 'vibe.gif', '2021-07-20 20:50:01', '1'),
(52, 'vibe.gif', '2021-07-20 20:51:58', '1'),
(53, 'vibe.gif', '2021-07-20 20:52:22', '1'),
(54, 'Ionic_bonding_animation.gif', '2021-07-20 21:48:22', '1'),
(55, 'image_2021-07-20_215235.png', '2021-07-20 21:53:26', '1'),
(56, 'image_2021-07-20_215235.png', '2021-07-20 21:58:08', '1'),
(57, 'image_2021-07-20_220250.png', '2021-07-20 22:03:57', '1'),
(58, 'image_2021-07-20_220250.png', '2021-07-20 22:04:58', '1'),
(59, 'image_2021-07-20_220250.png', '2021-07-20 22:06:28', '1'),
(60, 'vibe.gif', '2021-07-21 11:26:10', '1'),
(61, 'album_1fb2eateq.gif', '2021-07-21 11:30:58', '1'),
(62, 'vibe.gif', '2021-07-21 11:35:49', '1'),
(63, 'album_1fb2eb9lc.gif', '2021-07-21 11:36:34', '1'),
(64, 'album_1fb2eateq.gif', '2021-07-21 11:40:27', '1'),
(65, 'vibe.gif', '2021-07-21 11:41:26', '1'),
(66, 'image_2021-07-21_130101.png', '2021-07-21 13:03:05', '1'),
(67, 'image_2021-07-21_154722.png', '2021-07-21 15:48:57', '1'),
(68, 'album_1fb2e0sel.gif', '2021-07-21 19:07:49', '1'),
(69, 'image_2021-07-21_205639.png', '2021-07-21 20:58:34', '1'),
(70, 'image_2021-07-22_144147.png', '2021-07-22 14:42:36', '1'),
(71, 'image_2021-07-22_152052.png', '2021-07-22 15:22:30', '1'),
(72, 'image_2021-07-22_152945.png', '2021-07-22 15:30:26', '1'),
(73, 'image_2021-07-22_153310.png', '2021-07-22 15:35:52', '1'),
(74, 'image_2021-07-22_154015.png', '2021-07-22 15:40:42', '1'),
(75, 'image_2021-07-22_154538.png', '2021-07-22 15:46:12', '1'),
(76, 'image_2021-07-22_172023.png', '2021-07-22 17:21:46', '1'),
(77, 'image_2021-07-23_205152.png', '2021-07-23 20:53:37', '1'),
(78, 'image_2021-07-24_144925.png', '2021-07-24 14:54:16', '1');

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
-- Indexes for table `learners_course`
--
ALTER TABLE `learners_course`
  ADD KEY `l_fid` (`l_fid`,`course_fid`),
  ADD KEY `linkcourse` (`course_fid`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`mat_id`),
  ADD KEY `t_fid` (`t_fid`),
  ADD KEY `approval_admin_fid` (`approval_admin_fid`),
  ADD KEY `mat_file_upload_fid` (`mat_file_upload_fid`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quizz_choices`
--
ALTER TABLE `quizz_choices`
  ADD PRIMARY KEY (`choice_id`),
  ADD KEY `quiz_fid` (`quiz_fid`);

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
  ADD KEY `mat_fid` (`mat_fid`),
  ADD KEY `quiz_fid` (`quiz_fid`);

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
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `l_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `quizz_choices`
--
ALTER TABLE `quizz_choices`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sbjt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subtopic`
--
ALTER TABLE `subtopic`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_proposal`
--
ALTER TABLE `t_proposal`
  MODIFY `t_proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
-- Constraints for table `learners_course`
--
ALTER TABLE `learners_course`
  ADD CONSTRAINT `linkcourse` FOREIGN KEY (`course_fid`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linklearner` FOREIGN KEY (`l_fid`) REFERENCES `learners` (`l_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `mat_upload` FOREIGN KEY (`mat_file_upload_fid`) REFERENCES `uploads` (`up_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`approval_admin_fid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizz_choices`
--
ALTER TABLE `quizz_choices`
  ADD CONSTRAINT `connectquiz` FOREIGN KEY (`quiz_fid`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
