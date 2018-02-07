-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-02-07 15:54:47
-- 服务器版本： 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `no_hole-forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `blacklist`
--

CREATE TABLE `blacklist` (
  `number` int(10) UNSIGNED NOT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blacklist`
--

INSERT INTO `blacklist` (`number`, `section`, `name`) VALUES
(4, '黑名单', '黑名单'),
(6, '生活', 'lhl');

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE `post` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `essential` tinyint(1) NOT NULL,
  `top` tinyint(1) NOT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `replyAmount` tinyint(255) UNSIGNED NOT NULL DEFAULT '0',
  `replyNumber` tinyint(255) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `title`, `author`, `date`, `text`, `essential`, `top`, `section`, `replyAmount`, `replyNumber`) VALUES
(1, '论坛成功建立', 'admin', '2018-02-06 17:36:57', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 15, 15),
(4, '论坛成功建立', 'admin', '2018-02-06 17:52:34', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(5, '论坛成功建立', 'admin', '2018-02-06 17:52:36', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(6, '开始水吧', 'admin', '2018-02-06 19:30:03', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(7, 'WHY？', 'admin', '2018-02-06 19:37:33', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 3, 5),
(40, '论坛成功建立........lllll', 'admin', '2018-02-06 21:05:18', '哈哈哈哈哈哈再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 2, 2),
(41, '论坛成功建立........lllll', 'admin', '2018-02-06 21:05:23', '哈哈哈哈哈哈再来遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 1, '生活', 1, 1),
(42, '论坛成功建立........lllll', 'admin', '2018-02-06 21:05:30', '哈哈哈哈哈哈再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 2, 2),
(43, 'WHY？', 'admin', '2018-02-06 21:05:45', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 1, 1),
(44, 'WHY？', 'admin', '2018-02-06 21:05:48', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 1, '生活', 12, 13),
(45, 'WHY？', 'admin', '2018-02-06 21:05:51', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(46, 'WHY？', 'admin', '2018-02-06 21:05:54', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(47, 'WHY？', 'admin', '2018-02-07 00:29:26', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(48, '开始水啊', 'admin', '2018-02-07 10:50:09', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(49, '来啦', 'admin', '2018-02-07 10:50:30', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(51, '哈哈', 'admin', '2018-02-07 10:50:42', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(52, '快活呀', 'admin', '2018-02-07 10:51:00', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0),
(53, '论坛成功建立', 'lhl', '2018-02-07 22:17:22', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，123，再来一遍，哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 0, 0, '生活', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `postlist`
--

CREATE TABLE `postlist` (
  `number` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) NOT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `top` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `postlist`
--

INSERT INTO `postlist` (`number`, `id`, `section`, `top`) VALUES
(39, 45, '生活', 0),
(40, 46, '生活', 0),
(42, 43, '生活', 0),
(43, 47, '生活', 0),
(59, 42, '生活', 0),
(61, 40, '生活', 0),
(62, 41, '生活', 1),
(65, 44, '生活', 1),
(66, 48, '生活', 0),
(67, 49, '生活', 0),
(69, 51, '生活', 0),
(70, 52, '生活', 0),
(72, 53, '生活', 0),
(74, 1, '生活', 0);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE `reply` (
  `number` tinyint(255) UNSIGNED NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`number`, `user`, `date`, `id`, `text`) VALUES
(1, 'admin', '2018-02-06 19:14:49', 1, '我是第一个回复！！！'),
(2, 'admin', '2018-02-06 19:19:13', 1, '第二个！！！！！'),
(3, 'admin', '2018-02-06 19:19:23', 1, '第三个！！！！！'),
(4, 'admin', '2018-02-06 19:19:30', 1, '第四个！！！！！'),
(5, 'admin', '2018-02-06 19:19:35', 1, '第五个！！！！！'),
(6, 'admin', '2018-02-06 19:19:41', 1, '第六个！！！！！'),
(7, 'admin', '2018-02-06 19:19:49', 1, '第七个！！！！！'),
(8, 'admin', '2018-02-06 19:19:57', 1, '第八个！！！！！'),
(9, 'admin', '2018-02-06 19:20:06', 1, '第九个！！！！！'),
(10, 'admin', '2018-02-06 19:20:14', 1, '第十个！！！！！'),
(11, 'admin', '2018-02-06 19:20:21', 1, '第十一个！！！！！'),
(12, 'admin', '2018-02-06 19:20:26', 1, '第十二个！！！！！'),
(13, 'admin', '2018-02-06 19:20:31', 1, '第十三个！！！！！'),
(1, 'admin', '2018-02-06 19:30:26', 6, '水一个'),
(2, 'admin', '2018-02-06 19:30:28', 6, '水一个'),
(3, 'admin', '2018-02-06 19:30:28', 6, '水一个'),
(4, 'admin', '2018-02-06 19:30:29', 6, '水一个'),
(1, 'admin', '2018-02-06 19:38:29', 7, '！！！！'),
(4, 'admin', '2018-02-06 19:41:15', 7, '！！！！'),
(5, 'admin', '2018-02-06 20:05:56', 7, '！！！！'),
(1, 'admin', '2018-02-06 21:06:39', 43, '！！！！'),
(1, 'admin', '2018-02-07 00:48:04', 41, '第十三个！！！！！'),
(1, 'admin', '2018-02-07 00:49:14', 42, '第十三个！！！！！'),
(2, 'admin', '2018-02-07 00:50:49', 42, '第十三个！！！！！'),
(1, 'admin', '2018-02-07 00:50:59', 44, '第十三个！！！！！'),
(2, 'admin', '2018-02-07 00:52:31', 44, '第十三个！！！！！'),
(3, 'admin', '2018-02-07 00:54:12', 44, '第十三个！！！！！'),
(4, 'admin', '2018-02-07 00:54:13', 44, '第十三个！！！！！'),
(5, 'admin', '2018-02-07 00:54:26', 44, '第十三个！！！！！'),
(6, 'admin', '2018-02-07 00:54:28', 44, '第十三个！！！！！'),
(7, 'admin', '2018-02-07 00:58:00', 44, '第十三个！！！！！'),
(8, 'admin', '2018-02-07 00:58:27', 44, '第十三个！！！！！'),
(9, 'admin', '2018-02-07 00:59:53', 44, '第十三个！！！！！'),
(10, 'admin', '2018-02-07 01:00:12', 44, '第十三个！！！！！'),
(1, 'admin', '2018-02-07 01:00:23', 40, '第十三个！！！！！'),
(2, 'admin', '2018-02-07 01:08:16', 40, '第十三个！！！！！'),
(12, 'admin', '2018-02-07 10:46:51', 44, '第十三个！！！！！'),
(13, 'admin', '2018-02-07 10:48:32', 44, '第十三个！！！！！'),
(1, 'lhl', '2018-02-07 22:17:52', 1, '第十三个！！！！！'),
(15, 'lhl', '2018-02-07 22:24:46', 1, '第十三个！！！！！');

-- --------------------------------------------------------

--
-- 表的结构 `sections`
--

CREATE TABLE `sections` (
  `name` char(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `moderator` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'admin',
  `introduce` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sections`
--

INSERT INTO `sections` (`name`, `moderator`, `introduce`) VALUES
('生活', '', '在这里分享你生活中的事儿吧'),
('生活a', 'lhl', '在这里分享你生活中的事儿吧');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sex` enum('male','famale') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `province` char(64) DEFAULT NULL,
  `city` char(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `phoneNumber` char(64) DEFAULT NULL,
  `qq` bigint(20) DEFAULT NULL,
  `signature` varbinary(255) DEFAULT NULL,
  `imageUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '../../userImage/userImage.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `sex`, `birthday`, `province`, `city`, `phoneNumber`, `qq`, `signature`, `imageUrl`) VALUES
(1, 'admin', '$2y$10$USU1MeVp/smUZVYOF5qXweJoeEc9IggBr86S3sOIQGj2K863nNcne', 'admin@qq.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '../../userImage/userImage.jpg'),
(7, 'lhl', '$2y$10$jJf2lX1.gg.CNE8tVrr1ze0UVrXEXJvF3aGqJgEpxU0RjHDCaFSkC', '2530159726@qq.com', '', '0000-00-00', '', '', '', 2530159726, 0xe59388e59388e59388, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `essential` (`essential`),
  ADD KEY `top` (`top`),
  ADD KEY `author` (`author`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `postlist`
--
ALTER TABLE `postlist`
  ADD PRIMARY KEY (`number`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `section` (`section`),
  ADD KEY `id` (`id`),
  ADD KEY `top` (`top`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD KEY `user` (`user`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 使用表AUTO_INCREMENT `postlist`
--
ALTER TABLE `postlist`
  MODIFY `number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
