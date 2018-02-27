-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-12-25 16:21:41
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `storegame`
--

-- --------------------------------------------------------

--
-- 資料表結構 `mainstore`
--

CREATE TABLE `mainstore` (
  `loginID` varchar(20) NOT NULL,
  `p1Num` int(10) NOT NULL,
  `p2Num` int(10) NOT NULL,
  `p3Num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `mainstore`
--

INSERT INTO `mainstore` (`loginID`, `p1Num`, `p2Num`, `p3Num`) VALUES
('jc', 130, 130, 70);

-- --------------------------------------------------------

--
-- 資料表結構 `orderr`
--

CREATE TABLE `orderr` (
  `oID` int(10) NOT NULL,
  `pID` int(10) NOT NULL,
  `number` int(10) NOT NULL,
  `aTime` datetime NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pID` int(10) NOT NULL,
  `pName` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`pID`, `pName`, `price`) VALUES
(1, '草莓甜甜圈', 90),
(2, '香蒜麵包', 100),
(3, '波蘿麵包', 85);

-- --------------------------------------------------------

--
-- 資料表結構 `substore`
--

CREATE TABLE `substore` (
  `sID` int(10) NOT NULL,
  `p1Num` int(11) NOT NULL,
  `p2Num` int(11) NOT NULL,
  `p3Num` int(11) NOT NULL,
  `p1lim` int(11) NOT NULL,
  `p2lim` int(11) NOT NULL,
  `p3lim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `substore`
--

INSERT INTO `substore` (`sID`, `p1Num`, `p2Num`, `p3Num`, `p1lim`, `p2lim`, `p3lim`) VALUES
(1, 5, 12, 7, 70, 60, 80),
(2, 3, 3, 24, 70, 60, 80);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cash` int(10) NOT NULL DEFAULT '5000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`user_id`, `pwd`, `Cash`) VALUES
('jc', '123', 270757);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `mainstore`
--
ALTER TABLE `mainstore`
  ADD PRIMARY KEY (`loginID`);

--
-- 資料表索引 `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`oID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pID`);

--
-- 資料表索引 `substore`
--
ALTER TABLE `substore`
  ADD PRIMARY KEY (`sID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `orderr`
--
ALTER TABLE `orderr`
  MODIFY `oID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- 使用資料表 AUTO_INCREMENT `substore`
--
ALTER TABLE `substore`
  MODIFY `sID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
