-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024 年 05 月 22 日 23:57
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `restaurant`
--

-- --------------------------------------------------------

--
-- 資料表結構 `menu_content`
--

CREATE TABLE `menu_content` (
  `CHN` text NOT NULL,
  `ENG` text NOT NULL,
  `QTY` int(11) NOT NULL,
  `IMG` text NOT NULL,
  `MEMO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu_content`
--

INSERT INTO `menu_content` (`CHN`, `ENG`, `QTY`, `IMG`, `MEMO`) VALUES
('鮪魚起司三明治', 'Tuna Cheese Sandwitch', 70, 'https://www.gghu.com/uploads/allimg/20220329/2-220329110604417.png', '過敏原'),
('煙花女義大利麵', 'Alla puttanesca spaghetti', 250, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Pasta_Puttanesca.jpg/330px-Pasta_Puttanesca.jpg', '過敏原');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `order_table` text NOT NULL,
  `time` text NOT NULL DEFAULT current_timestamp(),
  `item` text NOT NULL,
  `qty` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `customize` text NOT NULL,
  `kitchen_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`order_table`, `time`, `item`, `qty`, `count`, `customize`, `kitchen_status`) VALUES
('A1', '2024-05-23 04:25:18', '鮪魚起司三明治', 2, 140, '', 1),
('A1', '2024-05-23 04:25:18', '煙花女義大利麵', 3, 750, '', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `table_status`
--

CREATE TABLE `table_status` (
  `table_A1` tinyint(1) NOT NULL,
  `table_A2` tinyint(1) NOT NULL,
  `table_A3` tinyint(1) NOT NULL,
  `table_A4` tinyint(1) NOT NULL,
  `table_A5` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `table_status`
--

INSERT INTO `table_status` (`table_A1`, `table_A2`, `table_A3`, `table_A4`, `table_A5`) VALUES
(0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
