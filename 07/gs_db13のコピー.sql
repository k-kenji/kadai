-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017 年 6 月 15 日 16:43
-- サーバのバージョン： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_db13`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`) VALUES
(1, 'YAMAZAKI1111', 'test@test.jp1111', 'TEST11111', '2017-06-03 15:37:03'),
(2, 'jon', 'kenji@kawamura.com', '1234', '2017-06-03 15:38:29'),
(4, '田中', 'test4@test.jp', 'TEST4', '2017-06-03 15:39:31'),
(5, '木村', 'test5@test.jp', 'TEST5', '2017-06-03 15:39:53'),
(6, '河村健司', 'k_k_1113@icloud.com', 'こんにちは', '2017-06-03 16:30:34'),
(7, 'ほげ', 'ほげお', 'ほげほげ', '2017-06-03 16:45:54'),
(8, 'adsfas', 'faadfd', 'fadfas', '2017-06-06 08:00:23'),
(9, '河村健司', 'k_k_1113@icloud.com', 'テストテストよ', '2017-06-10 15:28:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_book`
--

CREATE TABLE `gs_book` (
  `id` int(12) NOT NULL,
  `bkname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bkurl` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bkcomment` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_book`
--

INSERT INTO `gs_book` (`id`, `bkname`, `bkurl`, `bkcomment`, `indate`) VALUES
(1, 'テスト本', 'https://goo.gl/WVIsX9', 'これはテストです。もっとチャットボットの本の本読みたいよ', '2017-06-06 07:58:26'),
(3, 'やり抜く力 GRIT', 'https://goo.gl/rtQvlv', 'やる気が出る。英語の名前がたくさんでてきた。', '2017-06-07 22:48:35'),
(4, '', '', '', '2017-06-07 23:06:23'),
(5, 'チャットボット', 'https://goo.gl/MieSXS', '基本がわかるよね', '2017-06-07 23:09:49'),
(6, 'Running Lean', 'https://goo.gl/L2llvv', '読んでない', '2017-06-07 23:17:26');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_userdata`
--

CREATE TABLE `gs_userdata` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_userdata`
--

INSERT INTO `gs_userdata` (`id`, `name`, `email`, `password`, `indate`) VALUES
(3, 'kenji', 'k_k_1113@icloud.com', '$2y$10$TCfFT2vZZWVasjJHJdi6o.LILoUSGDUm2YUrai3OA98XC0vhX6TWm', '0000-00-00 00:00:00'),
(4, 'kawamura', 'digidori@gmail.com', '$2y$10$lYPD1YnZHTsAfQNt/a9MwOW0r3fuy2Py7CUNGl3IiFghgxF.BoZDS', '0000-00-00 00:00:00'),
(5, 'kawamura', 'dgff2079@gmail.com', '$2y$10$pr5/dsHDQ0yGLVcEYwcLM.pO9xhiDv61nYU1W0c22vjYNq9e2Z.eW', '0000-00-00 00:00:00'),
(6, 'k-kenji', 'kenji@kenji.com', '$2y$10$VUGDV21k7VTwNsq4/ENNvekvXvttlwmoFMSFJbTFQGKRhSwmNwsHy', '0000-00-00 00:00:00'),
(7, 'kkk', 'kenji@kawamura.com', '$2y$10$VMDNSWHVbUvZkqRiSFAYyO/KM/mXhJfbVatkEPh1VOXmtoAfY2C86', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) DEFAULT NULL,
  `life_flg` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(2, 'ken', 'kenji@kawamura.com', '1234', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_book`
--
ALTER TABLE `gs_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_userdata`
--
ALTER TABLE `gs_userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gs_book`
--
ALTER TABLE `gs_book`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gs_userdata`
--
ALTER TABLE `gs_userdata`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
