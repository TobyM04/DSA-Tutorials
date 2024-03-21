--
-- Database: `quotes-db`
--
CREATE DATABASE IF NOT EXISTS `quotes-db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quotes-db`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `c-name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `c-name`) VALUES
(6, 'education'),
(5, 'humour'),
(4, 'love'),
(2, 'philosophy'),
(1, 'politics'),
(3, 'science');

-- --------------------------------------------------------

--
-- Table structure for table `category_quotes`
--

CREATE TABLE `category_quotes` (
  `cid-fk` int(11) NOT NULL,
  `qid-fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_quotes`
--

INSERT INTO `category_quotes` (`cid-fk`, `qid-fk`) VALUES
(1, 1),
(2, 1),
(2, 4),
(3, 2),
(3, 3),
(3, 4),
(4, 2),
(5, 3),
(5, 6),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `qid` int(11) NOT NULL,
  `quote` varchar(2048) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sid-fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`qid`, `quote`, `ts`, `sid-fk`) VALUES
(1, 'I shall tell you a great secret, my friend. Do not wait for the last judgment. It takes place every day.', '2023-02-18 20:41:00', 1),
(2, 'Dear Mrs. Chown, Ignore your son\\\'s attempts to teach you physics. Physics isn\\\'t the most important thing. Love is. Best wishes, Richard Feynman.', '2023-02-18 20:41:01', 2),
(3, 'I think I can safely say that nobody understands quantum mechanics.', '2023-02-18 20:41:02', 2),
(4, 'Science may set limits to knowledge, but should not set limits to imagination.', '2023-02-18 20:41:04', 3),
(5, 'Nothing in education is so astonishing as the amount of ignorance it accumulates in the form of inert facts.', '2023-01-18 20:41:04', 4),
(6, 'Any astronomer can predict with absolute accuracy just where every star in the universe will be at 11:30 tonight. He can make no such prediction about his teenage daughter.', '2023-01-18 20:41:04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `sid` int(11) NOT NULL,
  `s-name` varchar(48) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `dod` varchar(12) DEFAULT NULL,
  `wplink` varchar(256) NOT NULL,
  `wpimg` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`sid`, `s-name`, `dob`, `dod`, `wplink`, `wpimg`) VALUES
(1, 'Albert Camus', '1913', '1960', 'https://en.wikipedia.org/wiki/Albert Camus', 'https://upload.wikimedia.org/wikipedia/commons/0/08/Albert_Camus%2C_gagnant_de_prix_Nobel%2C_portrait_en_buste%2C_pos%C3%A9_au_bureau%2C_faisant_face_%C3%A0_gauche%2C_cigarette_de_tabagisme.jpg'),
(2, 'Richard Feynman', '1918', '1988', 'https://en.wikipedia.org/wiki/Richard_Feynman', 'https://upload.wikimedia.org/wikipedia/en/4/42/Richard_Feynman_Nobel.jpg'),
(3, 'Bertrand Russell', '1872', '1970', 'https://en.wikipedia.org/wiki/Bertrand_Russell', 'https://upload.wikimedia.org/wikipedia/commons/5/5f/Bertrand_Russell_1957.jpg'),
(4, 'Henry Brooks Adams', '1838', '1918', 'https://en.wikipedia.org/wiki/Henry_Brooks_Adams', 'https://upload.wikimedia.org/wikipedia/commons/b/bf/William_Notman_-_Henry_Brooks_Adams%2C_1885_%28transparent%29.png'),
(5, 'Ronald Reagan', '1911', '2004', 'https://en.wikipedia.org/wiki/Ronald_Reagan', 'https://upload.wikimedia.org/wikipedia/commons/1/16/Official_Portrait_of_President_Reagan_1981.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `name` (`c-name`);

--
-- Indexes for table `category_quotes`
--
ALTER TABLE `category_quotes`
  ADD PRIMARY KEY (`cid-fk`,`qid-fk`),
  ADD KEY `qid-fk` (`qid-fk`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `sid-fk` (`sid-fk`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `name` (`s-name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;