-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2019 at 11:29 PM
-- Server version: 10.2.27-MariaDB-cll-lve
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u5906d12198_spin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` bigint(20) NOT NULL,
  `type` varchar(24) DEFAULT NULL,
  `username` varchar(24) DEFAULT NULL,
  `ip` varchar(24) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `banby` varchar(24) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) NOT NULL,
  `request` varchar(34) NOT NULL,
  `friend` varchar(34) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) NOT NULL,
  `username` varchar(45) NOT NULL,
  `itemID` int(11) NOT NULL,
  `itemColor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` bigint(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` text NOT NULL,
  `pemail` text NOT NULL,
  `country` varchar(40) NOT NULL,
  `country_code` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `birthmonth` int(11) NOT NULL,
  `birthyear` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `appearance` text NOT NULL,
  `inRoom` text DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `regip` varchar(15) DEFAULT NULL,
  `freeTalk` tinyint(1) DEFAULT NULL,
  `loginHash` varchar(48) DEFAULT NULL,
  `cash` bigint(20) DEFAULT NULL,
  `iLevel` int(11) DEFAULT NULL,
  `serverID` int(11) DEFAULT 0,
  `mailHash` varchar(32) NOT NULL,
  `sessionCode` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serverinfo`
--

CREATE TABLE `serverinfo` (
  `id` bigint(20) NOT NULL,
  `serverID` int(11) DEFAULT NULL,
  `userCount` int(11) DEFAULT NULL,
  `serverName` varchar(42) DEFAULT NULL,
  `serverHost` varchar(62) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopitems`
--

CREATE TABLE `shopitems` (
  `id` bigint(20) NOT NULL,
  `itemID` bigint(20) DEFAULT NULL,
  `itemName` text DEFAULT NULL,
  `itemDesc` text DEFAULT NULL,
  `itemType` varchar(10) DEFAULT NULL,
  `buyPrice` int(11) DEFAULT NULL,
  `sellPrice` int(11) DEFAULT NULL,
  `canSell` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username,ip` (`username`,`ip`) USING BTREE;

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend,request` (`request`,`friend`) USING BTREE,
  ADD KEY `friends_idx_request_friend` (`request`,`friend`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Username` (`username`) USING BTREE,
  ADD KEY `username_2` (`username`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`username`) USING HASH,
  ADD UNIQUE KEY `Username, Hash` (`username`,`loginHash`) USING HASH,
  ADD KEY `players_idx_username_gender_inroom` (`username`,`gender`,`inRoom`(255)),
  ADD KEY `players_idx_serveri_usernam_inroom_gender` (`serverID`,`username`,`inRoom`(255),`gender`),
  ADD KEY `players_idx_username_password` (`username`,`password`);

--
-- Indexes for table `serverinfo`
--
ALTER TABLE `serverinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopitems`
--
ALTER TABLE `shopitems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serverinfo`
--
ALTER TABLE `serverinfo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopitems`
--
ALTER TABLE `shopitems`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
