-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2018 at 02:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE `apps_countries` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apps_countries`
--

INSERT INTO `apps_countries` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `bug_reports`
--

CREATE TABLE `bug_reports` (
  `bug_report_id` int(11) NOT NULL,
  `bug_report_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bug_report_message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `track_id` int(11) NOT NULL,
  `category_url` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `track_id`, `category_url`) VALUES
(1, 'WarmUp', 1, 'warmup'),
(2, 'Strings', 1, 'strings'),
(3, 'Sorting', 1, 'sorting'),
(4, 'Search', 1, 'search'),
(5, 'Graphs', 1, 'graphs'),
(6, 'Greedy', 1, 'greedy'),
(7, 'Dynamic Programming', 1, 'dynamic_programming'),
(8, 'WarmUp', 2, 'warmup'),
(9, 'Linked Lists', 2, 'linked_lists'),
(10, 'Trees', 2, 'trees'),
(11, 'WarmUp', 3, 'warmup'),
(12, 'Bot Building', 3, 'bot_building'),
(13, 'Games', 3, 'games');

-- --------------------------------------------------------

--
-- Table structure for table `feature_requests`
--

CREATE TABLE `feature_requests` (
  `feature_request_id` int(11) NOT NULL,
  `feature_request_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `feature_request_message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feature_requests`
--

INSERT INTO `feature_requests` (`feature_request_id`, `feature_request_title`, `feature_request_message`, `username`) VALUES
(1, 'Feature', 'Feature', 'dexa96');

-- --------------------------------------------------------

--
-- Table structure for table `problem_statements`
--

CREATE TABLE `problem_statements` (
  `problem_statement_id` int(11) NOT NULL,
  `problem_statement_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `problem_statement_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `difficulty` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `sample_input` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sample_output` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sample_case_exec_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `problem_statements`
--

INSERT INTO `problem_statements` (`problem_statement_id`, `problem_statement_name`, `problem_statement_description`, `difficulty`, `points`, `sample_input`, `sample_output`, `category_id`, `sample_case_exec_time`) VALUES
(1, 'Hello World', 'Print out \"Hello, World!\" to the standard output', 'Easy', 10, '', 'Hello, World!', 1, 0.1),
(3, 'Array Sum', 'Given an array of integers, find the sum of its elements.', 'Easy', 15, '6\r\n1 2 3 4 10 11', '31', 1, 0.2),
(4, 'Fibonacci', 'Given a number n, print n-th Fibonacci Number.', 'Easy', 15, '7', '13', 1, 0.1),
(5, 'Simple Maximum', 'Print out greater of two given values.', 'Easy', 5, '1 2', '2', 1, 0.1),
(6, 'Array Minimum', 'Find the minimum of the given array.', 'Easy', 15, '0 1 2 3 4 5 6 7 -1', '-1', 1, 0.1),
(7, 'Intro to Arrays', 'Given an array,A , of N integers, print each element in reverse order as a single line of space-separated integers.', 'Easy', 15, '1 2 3 4', '4 3 2 1', 8, 0.1),
(8, 'CamelCase', 'Alice wrote a sequence of words in CamelCase as a string of letters, s, having the following properties:\r\n\r\n    It is a concatenation of one or more words consisting of English letters.\r\n    All letters in the first word are lowercase.\r\n    For each of the subsequent words, the first letter is uppercase and rest of the letters are lowercase.\r\n\r\nGiven , print the number of words in on a new line.', 'Easy', 20, 'camelCase', '2', 2, 0.1),
(9, 'Median', 'The median of a list of numbers is essentially it\'s middle element after sorting. The same number of elements occur after it as before. Given a list of numbers with an odd number of elements, can you find the median?', 'Easy', 20, '0 1 2 4 6 5 3', '3', 3, 0.1),
(10, 'Combo String', 'Given 2 strings, a and b, return a string of the form short+long+short, with the shorter string on the outside and the longer string on the inside. The strings will not be the same length.', 'Easy', 15, 'hello hi', 'hihellohi', 2, 0.1),
(11, 'Simple Search', 'Given a list of distinct N numbers a1, a2, ... , an, find the position of the number K in the list.\r\nIndexing starts from zero.\r\nFirst input number is K, and the other ones represent the list.', 'Easy', 15, '3\r\n1 2 3 4 5 6 7 8', '2', 4, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `solved_problem_statements`
--

CREATE TABLE `solved_problem_statements` (
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `problem_statement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `solved_problem_statements`
--

INSERT INTO `solved_problem_statements` (`username`, `problem_statement_id`) VALUES
('dexa', 1),
('dexa', 3),
('dexa', 4),
('dexa', 5),
('dexa', 6),
('dexa', 7),
('dexa', 8),
('dexa', 9),
('dexa', 10),
('dexa', 11);

-- --------------------------------------------------------

--
-- Table structure for table `test_cases`
--

CREATE TABLE `test_cases` (
  `test_case_id` int(11) NOT NULL,
  `input` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `output` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `problem_statement_id` int(11) NOT NULL,
  `test_case_exec_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_cases`
--

INSERT INTO `test_cases` (`test_case_id`, `input`, `output`, `problem_statement_id`, `test_case_exec_time`) VALUES
(1, '', 'Hello, World!', 1, 0.1),
(2, '6\r\n1 2 3 4 10 11', '31', 3, 0.2),
(3, '12\r\n1 2 3 4 5 6 7 8 9 10 11 12', '78', 3, 0.2),
(4, '6\r\n1231027 123 12123 5545688832 348275 12345678', '5559626058', 3, 0.5),
(5, '7', '13', 4, 0.1),
(6, '0', '0', 4, 0.1),
(7, '23', '28657', 4, 0.2),
(8, '1 2', '2', 5, 0.1),
(9, '9 9', '9', 5, 0.1),
(10, '123987 2144349', '2144349', 5, 0.1),
(11, '0 1 2 3 4 5 6 7 -1', '-1', 6, 0.1),
(12, '12 21 32 0 9 -1 -14 8 123455', '-14', 6, 0.1),
(13, '1 2 3 4', '4 3 2 1', 7, 0.1),
(14, '1 5 8 3 23 93 5 4 1', '1 4 5 93 23 3 8 5 1', 7, 0.1),
(15, 'camelCase', '2', 8, 0.1),
(16, 'saveChangesInTheEditor', '5', 8, 0.2),
(17, 'stringStringString', '3', 8, 0.1),
(18, '0 1 2 4 6 5 3', '3', 9, 0.1),
(19, '4 5 23 8 58 72 1 3 2', '5', 9, 0.1),
(20, 'hello hi', 'hihellohi', 10, 0.1),
(21, 'tac tick', 'tacticktac', 10, 0.1),
(22, '3\r\n1 2 3 4 5 6 7 8', '2', 11, 0.1),
(23, '14\r\n0 5 2 7 2 14 76', '5', 11, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `track_id` int(11) NOT NULL,
  `track_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `track_url` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `track_name`, `track_url`) VALUES
(1, 'Algorithms', 'algorithms'),
(2, 'Data Structures', 'data_structures'),
(3, 'Artificial Intelligence', 'artificial_intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `account_type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `registration_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `country_id`, `account_type`, `points`, `active`, `registration_token`) VALUES
(12, 'dexa', '$2y$10$PVMeYDFlIra/dEUg1jIe0eol7MBVb3uj8iAj9OfHT5gPWaTcm8FP.', 'dexa96@gmail.com', 230, 'admin', 145, 1, '58e524779ea0d1a31b734010b8e6cad2a91ae8abdf341963aadcd28e6b36b815');

-- --------------------------------------------------------

--
-- Table structure for table `users_track_points`
--

CREATE TABLE `users_track_points` (
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `track_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_track_points`
--

INSERT INTO `users_track_points` (`username`, `track_name`, `points`) VALUES
('dexa', 'Algorithms', 130),
('dexa', 'Data Structures', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_countries`
--
ALTER TABLE `apps_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `bug_reports`
--
ALTER TABLE `bug_reports`
  ADD PRIMARY KEY (`bug_report_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `track_id` (`track_id`);

--
-- Indexes for table `feature_requests`
--
ALTER TABLE `feature_requests`
  ADD PRIMARY KEY (`feature_request_id`);

--
-- Indexes for table `problem_statements`
--
ALTER TABLE `problem_statements`
  ADD PRIMARY KEY (`problem_statement_id`),
  ADD KEY `problem_statement_id` (`problem_statement_id`,`category_id`);

--
-- Indexes for table `solved_problem_statements`
--
ALTER TABLE `solved_problem_statements`
  ADD PRIMARY KEY (`username`,`problem_statement_id`);

--
-- Indexes for table `test_cases`
--
ALTER TABLE `test_cases`
  ADD PRIMARY KEY (`test_case_id`),
  ADD KEY `foreign_key_problem_statement_id` (`problem_statement_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `users_track_points`
--
ALTER TABLE `users_track_points`
  ADD PRIMARY KEY (`username`,`track_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_countries`
--
ALTER TABLE `apps_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `bug_reports`
--
ALTER TABLE `bug_reports`
  MODIFY `bug_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feature_requests`
--
ALTER TABLE `feature_requests`
  MODIFY `feature_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `problem_statements`
--
ALTER TABLE `problem_statements`
  MODIFY `problem_statement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test_cases`
--
ALTER TABLE `test_cases`
  MODIFY `test_case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `foreign_key_track_id` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_cases`
--
ALTER TABLE `test_cases`
  ADD CONSTRAINT `foreign_key_problem_statement_id` FOREIGN KEY (`problem_statement_id`) REFERENCES `problem_statements` (`problem_statement_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `foreign_key_country_id` FOREIGN KEY (`country_id`) REFERENCES `apps_countries` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
