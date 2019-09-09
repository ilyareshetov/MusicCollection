-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2018 at 10:59 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--
CREATE DATABASE IF NOT EXISTS `music` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `music`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `genre` int(11) NOT NULL,
  `releaseDate` date NOT NULL,
  `notableFact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `label`, `genre`, `releaseDate`, `notableFact`) VALUES
(1, 'Kiss Land', ' Republic Records', 7, '2013-09-10', ''),
(2, 'Dark & Wild', 'Big Hit Entertainment', 5, '2014-08-19', ''),
(3, 'Night Visions', 'Interscope', 8, '2012-09-04', ''),
(4, 'Thank Me Later', 'Aspire', 5, '2010-06-15', ''),
(5, 'Plus', 'Asylum', 4, '2011-09-09', ''),
(6, 'Invasion of Privacy', 'Atlantic', 5, '2018-04-06', ''),
(7, 'Stoney', 'Republic', 5, '2016-12-09', NULL),
(8, 'Section.80', 'Top Dawg', 5, '2011-07-02', NULL),
(9, 'Good Kid, M.A.A.D City', 'Top Dawg Aftermath Interscope', 5, '2012-10-22', NULL),
(10, 'To Pimp a Butterfly', 'Top Dawg Aftermath Interscope', 5, '2015-03-15', NULL),
(11, 'Doo-Wops & Hooligans', 'Atlantic Elektra', 7, '2010-10-04', NULL),
(12, 'Same Tour Different Trailer', 'Elektra', 7, '2013-09-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `stageName` varchar(50) NOT NULL,
  `birthName` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `deathDate` date DEFAULT NULL,
  `funNotableFact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `stageName`, `birthName`, `birthDate`, `hometown`, `deathDate`, `funNotableFact`) VALUES
(1, 'The Weeknd', 'Abel Makkonen Tesfaye', '1990-02-16', 'Toronto', '0000-00-00', ''),
(2, 'BTS', 'Bangtan Boys', '2013-06-12', 'Seoul', '0000-00-00', ''),
(3, 'Imagine Dragons ', 'Imagine Dragons ', '2008-05-13', 'Las Vegas', '0000-00-00', ''),
(4, 'Drake', 'Aubrey Drake Graham', '1986-10-24', 'Toronto', '0000-00-00', ''),
(5, 'Ed Sheeran', 'Edward Christopher Sheeran', '1991-02-17', 'Halifax', '0000-00-00', ''),
(6, 'Cardi B', 'Belcalis Almanzar ', '1992-10-11', 'The Bronx', '0000-00-00', ''),
(7, 'Post Malone', 'Austin Richard Post', '1995-07-04', 'New York', NULL, NULL),
(8, 'Kendrick Lamar', 'Kendrick Lamar Duckworth ', '1987-06-17', 'California', NULL, NULL),
(9, 'Kacey Musgraves', 'Kacey Lee Musgraves', '1988-08-21', 'Golden', NULL, NULL),
(10, 'Bruno Mars', 'Peter Gene Hernandez ', '1985-10-08', 'Honolulu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artist_in_album`
--

CREATE TABLE `artist_in_album` (
  `idArtist` int(11) NOT NULL,
  `idAlbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist_in_album`
--

INSERT INTO `artist_in_album` (`idArtist`, `idAlbum`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(4, 6),
(6, 6),
(7, 7),
(8, 8),
(8, 9),
(8, 10),
(9, 11),
(10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `artist_in_song`
--

CREATE TABLE `artist_in_song` (
  `idArtist` int(11) NOT NULL,
  `idSong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist_in_song`
--

INSERT INTO `artist_in_song` (`idArtist`, `idSong`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(4, 32),
(4, 33),
(5, 34),
(5, 35),
(5, 36),
(5, 37),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(6, 44),
(6, 45),
(6, 46),
(6, 47),
(6, 48),
(6, 49),
(6, 50),
(6, 51),
(6, 52),
(6, 53),
(6, 54),
(6, 55);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Blues'),
(2, 'Country'),
(3, 'Electronic'),
(4, 'Folk'),
(5, 'Hip hop'),
(6, 'Pop rap'),
(7, 'R&B and soul'),
(8, 'Rock'),
(9, 'Heavy metal'),
(10, 'Rap rock');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `album` int(11) DEFAULT NULL,
  `length` varchar(10) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `highestRank` int(11) NOT NULL,
  `dateRank` date NOT NULL,
  `writerName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `name`, `album`, `length`, `comment`, `highestRank`, `dateRank`, `writerName`) VALUES
(1, 'Professional', 1, '4:32', 'First', 6, '2015-03-10', 'Abel Tesfaye'),
(2, 'The Town', 1, '4:54', 'Second', 34, '2013-04-17', 'Abel Tesfaye'),
(3, 'Adaptation', 1, '6:43', 'Third', 13, '2014-06-11', 'Abel Tesfaye'),
(4, 'Love in the Sky', 1, '3:23', 'Fourth', 3, '2013-08-07', 'Abel Tesfaye'),
(5, 'Belong to the World', 1, '3:45', 'Five', 2, '2013-04-16', 'Abel Tesfaye'),
(6, 'Live For', 1, '3:32', 'Six', 1, '2013-03-06', 'Abel Tesfaye'),
(7, 'Wanderlust', 1, '3:56', 'Seven', 1, '2014-05-20', 'Abel Tesfaye'),
(8, 'Intro: What am I to You', 2, '1:12', 'Intro', 45, '2014-10-14', 'Pdogg'),
(9, 'Danger', 2, '4:32', 'First', 4, '2015-03-04', 'Pdogg'),
(10, 'Let Me Know', 2, '3:21', 'Second', 56, '2015-06-14', 'Pdogg'),
(11, 'Rain', 2, '3:24', 'Third', 41, '2016-05-03', 'Pdogg'),
(12, 'BTS Cypher Pt. 3: Killer', 2, '4:51', 'Fourth', 13, '2016-05-26', 'Pdogg'),
(13, 'Interlude', 2, '3:45', 'Five', 40, '2015-06-09', 'Pdogg'),
(14, '24/7=Heaven', 2, '3:21', 'Six', 7, '2015-06-24', 'Pdogg'),
(15, 'Outro', 2, '3:30', 'Outro', 78, '2015-12-15', 'Pdogg'),
(16, 'Radioactive', 3, '3:56', 'First', 1, '2014-05-14', 'Imagine Dragons'),
(17, 'Tiptoe', 3, '4:32', 'Second', 4, '2015-02-12', 'Imagine Dragons'),
(18, 'Demon', 3, '4:10', 'Fourth', 1, '2015-02-20', 'Imagine Dragons'),
(19, 'On Top of the World', 3, '6:10', 'Five', 4, '2016-03-02', 'Imagine Dragons'),
(20, 'Amsterdam', 3, '4:11', 'Six', 65, '2016-03-21', 'Imagine Dragons'),
(21, 'Hear Me', 3, '3:54', 'Seven', 32, '2016-04-17', 'Imagine Dragons'),
(22, 'Every Night', 3, '4:33', 'Eighth', 48, '2016-01-04', 'Imagine Dragons'),
(23, 'Bleeding Out', 3, '3:42', 'Nine', 56, '2015-03-10', 'Imagine Dragons'),
(24, 'Fireworks', 4, '4:55', 'First', 5, '2011-03-21', 'Aubrey Graham'),
(25, 'Karaoke', 4, '5:21', 'Second', 56, '2013-07-09', 'Aubrey Graham'),
(26, 'The Resistance', 4, '5:33', 'Third', 30, '2015-05-31', 'Aubrey Graham'),
(27, 'Over', 4, '4:52', 'Fourth', 44, '2015-06-23', 'Aubrey Graham'),
(28, 'Show Me a Good Time', 4, '3:10', 'Five', 31, '2015-03-25', 'Aubrey Graham'),
(29, 'Up All Night', 4, '4:34', 'Six', 66, '2016-01-24', 'Aubrey Graham'),
(30, 'Fancy', 4, '4:50', 'Seven', 13, '2016-04-05', 'Aubrey Graham'),
(31, 'Shut It Down', 4, '3:40', 'Eighth', 26, '2015-07-28', 'Aubrey Graham'),
(32, 'Unforgettable', 4, '4:12', 'Nine', 4, '2015-08-25', 'Aubrey Graham'),
(33, 'Light Up', 4, '4:56', 'Ten', 1, '2015-01-01', 'Aubrey Graham'),
(34, 'The A Team', 5, '4:55', 'First', 1, '2015-05-14', 'Ed Sheeran'),
(35, 'Drunk', 5, '5:01', 'Second', 39, '2015-01-01', 'Ed Sheeran'),
(36, 'U.N.I.', 5, '5:20', 'Third', 5, '2016-10-17', 'Ed Sheeran'),
(37, 'Grade 8', 5, '4:35', 'Fourth', 15, '2012-04-15', 'Ed Sheeran'),
(38, 'Wake Me Up', 5, '4:39', 'Five', 4, '2012-03-03', 'Ed Sheeran'),
(39, 'Small Bump', 5, '4:32', 'Six', 5, '2013-04-05', 'Ed Sheeran'),
(40, 'This', 5, '3:55', 'Seven', 29, '2013-05-04', 'Ed Sheeran'),
(41, 'The City', 5, '3:20', 'Eighth', 60, '2013-07-17', 'Ed Sheeran'),
(42, 'Lego House', 5, '4:53', 'Nine', 28, '2013-11-19', 'Ed Sheeran'),
(43, 'Kiss Me', 5, '4:03', 'Eleven', 16, '2013-03-15', 'Ed Sheeran'),
(44, 'Get Up 10', 6, '3:51', 'First', 12, '2018-04-07', 'Belcalis Almanzar'),
(45, 'Drip', 6, '4:06', 'Second', 15, '2018-04-11', 'Belcalis Almanzar'),
(46, 'Bickenhead', 6, '3:16', 'Third', 14, '2018-04-08', 'Belcalis Almanzar'),
(47, 'Bodak Yellow', 6, '3:19', 'Fourth', 18, '2018-04-09', 'Belcalis Almanzar'),
(48, 'Be Careful', 6, '4:28', 'Five', 19, '2018-04-10', 'Belcalis Almanzar'),
(49, 'Best Life', 6, '3:29', 'Six', 9, '2018-04-09', 'Belcalis Almanzar'),
(50, 'I Like It', 6, '4:03', 'Seven', 45, '2018-04-09', 'Belcalis Almanzar'),
(51, 'Ring', 6, '4:34', 'Eighth', 33, '2018-04-11', 'Belcalis Almanzar'),
(52, 'Money Bag', 6, '3:56', 'Nine', 31, '2018-04-11', 'Belcalis Almanzar'),
(53, 'Bartier Cardi', 6, '3:55', 'Ten', 14, '2018-04-08', 'Belcalis Almanzar'),
(54, 'She Bad', 6, '4:31', 'Eleven', 14, '2018-04-10', 'Belcalis Almanzar'),
(55, 'Thru Your Phone', 6, '3:54', 'Twelve', 12, '2018-04-10', 'Belcalis Almanzar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_in_album`
--
ALTER TABLE `artist_in_album`
  ADD KEY `idArtist` (`idArtist`),
  ADD KEY `idAlbum` (`idAlbum`);

--
-- Indexes for table `artist_in_song`
--
ALTER TABLE `artist_in_song`
  ADD KEY `idArtist` (`idArtist`),
  ADD KEY `idSong` (`idSong`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album` (`album`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_in_album`
--
ALTER TABLE `artist_in_album`
  ADD CONSTRAINT `artist_in_album_ibfk_1` FOREIGN KEY (`idArtist`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_in_album_ibfk_2` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_in_song`
--
ALTER TABLE `artist_in_song`
  ADD CONSTRAINT `artist_in_song_ibfk_1` FOREIGN KEY (`idArtist`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_in_song_ibfk_2` FOREIGN KEY (`idSong`) REFERENCES `song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`album`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
