-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 04:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genshin_impact`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artifact`
--

CREATE TABLE `artifact` (
  `artifact_id` int(11) NOT NULL,
  `artifact_name` varchar(255) NOT NULL,
  `deskripsi_efek_artifact` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artifact`
--

INSERT INTO `artifact` (`artifact_id`, `artifact_name`, `deskripsi_efek_artifact`, `image`) VALUES
(1, 'Viridescent Venerer', 'Bonus DMG elemen Swril dan debuff elemen musuh', 'viridescentvenerer.png'),
(2, 'Crimson Witch of Flames', 'Bonus DMG reaksi Melt addn Vaporize', 'crimsonwitchofflames.png'),
(3, 'Crimson Witch of Flames', 'Bonus DMG reaksi Overloaded dan Burning', 'crimsonwitchofflames.png'),
(4, 'Blizzard Strayer', 'Bonus Crite rate melawan musuh beku', 'blizzardstrayer.png'),
(5, 'Thundering Fury', 'Bonus DMG Electro Charged', 'thunderingfury.png'),
(6, 'Thundering Fury', 'Bonus DMG Overloaded', 'thunderingfury.png'),
(7, 'Gilded Dreams', 'Bonus Elemental Mastery dan ATK', 'gildeddreams.png'),
(8, 'Heart of Depth', 'Bonus DMG Hydro dan Vaporize', 'heartofdepth.png'),
(9, 'Archaic Petra', 'Buff elemen Cryztalize', 'archaicpetra.png');

-- --------------------------------------------------------

--
-- Table structure for table `artifact_recomendation`
--

CREATE TABLE `artifact_recomendation` (
  `recommendation_artifact_id` int(11) NOT NULL,
  `elemental_id_1` int(11) DEFAULT NULL,
  `elemental_id_2` int(11) DEFAULT NULL,
  `artifact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artifact_recomendation`
--

INSERT INTO `artifact_recomendation` (`recommendation_artifact_id`, `elemental_id_1`, `elemental_id_2`, `artifact_id`) VALUES
(1, 6, 1, 1),
(2, 6, 4, 1),
(3, 6, 3, 1),
(4, 6, 2, 1),
(5, 6, 5, 1),
(6, 6, 7, 1),
(7, 1, 4, 2),
(8, 1, 3, 3),
(9, 1, 2, 2),
(10, 1, 5, 2),
(11, 1, 7, 3),
(12, 4, 3, 4),
(13, 4, 2, 4),
(14, 4, 5, 4),
(15, 4, 7, 4),
(16, 3, 2, 5),
(17, 3, 5, 6),
(18, 3, 7, 7),
(19, 2, 5, 8),
(20, 2, 7, 8),
(21, 5, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `elemental`
--

CREATE TABLE `elemental` (
  `elemental_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elemental`
--

INSERT INTO `elemental` (`elemental_id`, `nama`, `deskripsi`, `image`) VALUES
(1, 'Pyro', 'Elemen Api', 'pyro.png'),
(2, 'Hydro', 'Elemen Air', 'hydro.png'),
(3, 'Electro', 'Elemen Listrik', 'electro.png'),
(4, 'Cryo', 'Elemen Es', 'cyro.png\r\n'),
(5, 'Geo', 'Elemen Tanah', 'geo.png'),
(6, 'Anemo', 'Elemen Angin', 'anemo.png'),
(7, 'Dendro', 'Elemen Tumbuhan', 'dendro.png');

-- --------------------------------------------------------

--
-- Table structure for table `elemental_reaction`
--

CREATE TABLE `elemental_reaction` (
  `reaction_id` int(11) NOT NULL,
  `elemental_id_1` int(11) DEFAULT NULL,
  `elemental_id_2` int(11) DEFAULT NULL,
  `reaction` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elemental_reaction`
--

INSERT INTO `elemental_reaction` (`reaction_id`, `elemental_id_1`, `elemental_id_2`, `reaction`) VALUES
(1, 6, 1, 'Swirl'),
(2, 6, 4, 'Freeze'),
(3, 6, 3, 'Overloaded'),
(4, 6, 2, 'Electro-Charged'),
(5, 6, 5, 'Swirl'),
(6, 6, 7, 'Burning'),
(7, 1, 4, 'Melt'),
(8, 1, 3, 'Burning'),
(9, 1, 2, 'Vaporize'),
(10, 1, 5, 'Burning'),
(11, 1, 7, 'Burning'),
(12, 4, 3, 'Superconduct'),
(13, 4, 2, 'Freeze'),
(14, 4, 5, 'Cryztalize'),
(15, 4, 7, 'Burning'),
(16, 3, 2, 'Electro-Charged'),
(17, 3, 5, 'Shocking'),
(18, 3, 7, 'Quicken'),
(19, 2, 5, 'Cryztalize'),
(20, 2, 7, 'Burning'),
(21, 5, 7, 'Burning');

-- --------------------------------------------------------

--
-- Table structure for table `karakter`
--

CREATE TABLE `karakter` (
  `karakter_id` int(11) NOT NULL,
  `nama_karakter` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `elemental_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karakter`
--

INSERT INTO `karakter` (`karakter_id`, `nama_karakter`, `image`, `elemental_id`) VALUES
(1, 'Diluc', 'diluc.png', 1),
(2, 'Hu Tao', 'hutao.png', 1),
(3, 'Mona', 'mona.png', 2),
(4, 'Furina', 'furina.png', 2),
(5, 'Ganyu', 'ganyu.png', 4),
(6, 'Eula', 'eula.png', 4),
(7, 'Keqing', 'keqing.png', 3),
(8, 'Baizhu', 'baizhu.png', 3),
(9, 'Venti', 'venti.png', 6),
(10, 'Kazuha', 'kazuha.png', 6),
(11, 'Zhongli', 'zhongli.png', 5),
(12, 'Albedo', 'albedo.png', 5),
(13, 'Tighnari', 'tighnari.png', 7),
(14, 'Alhaitham', 'alhaitham.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'nexuszero10', '$2y$10$uK6fp7VjURe1gqNCfFcTHeqX3YFboxiT036VXR1Kxkvv3rNlCjkLW', 'user'),
(2, 'tansah', '$2y$10$sD3xfFb1rtEP/xHRHxbbEuaRtmX3qmaMvA4kkO1/OBTt1NEK7p9Ku', 'user'),
(3, 'monti', '$2y$10$eGQsAIA6XT6s9epNNconLuX.0NywJgf3KtqtZv7/6/ebaZEDvcL.u', 'user'),
(4, 'coba', '$2y$10$RQx8KlaiwK6AbT/foy/cIukjeT3.kraV6ZMDkY6wu8dWttnUy.bHi', 'user'),
(5, 'coba2', '$2y$10$WzpPf7ud3.3gHSqrhbIqBe0DOCbNvBWm6kk25SF8PkBqHUg2ucIg.', 'user'),
(6, 'coba3', '$2y$10$iSSKTJIl8yOwmHJN7TyM5.fWTT4nHw.t6NLhXF2QiDKvFytI3mgBC', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `weapon`
--

CREATE TABLE `weapon` (
  `weapon_id` int(11) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `deskripsi_efek_weapon` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapon`
--

INSERT INTO `weapon` (`weapon_id`, `weapon_name`, `deskripsi_efek_weapon`, `image`) VALUES
(1, 'Freedom Sworn', 'Buff elemen reaksi dan ATK', 'freedomsworn.png'),
(2, 'Skyward Blade', 'Crit rate dan energi recharge', 'skywardblade.png'),
(3, 'Favonious Sword', 'Energi recharge', 'favonioussword.png'),
(4, 'Iron Sting', 'Elemental Mastery untuk meningkatkan Swirl', 'ironsting.png'),
(5, 'Skyward Harp', 'Crite rate dan energi recharge', 'skywardharp.png'),
(6, 'Sacrificial Sword', 'Reset cooldown skill', 'sacrificialsword.png'),
(7, 'Staff of Homa', 'Crit DMG dan MP buff', 'staffofhoma.png'),
(8, 'The Widsith', 'Bonus Elemental Mastery atau crit DMG', 'thewidsith.png'),
(9, 'Kagura Verity', 'Bonus Elemental DMG', 'kaguraverity.png'),
(10, 'Serpent Spine', 'Crite Rate', 'serpentspine.png'),
(11, 'Solar Pearl', 'Crirte Rate dan bonus DMG', 'solarpearl.png'),
(12, 'Mistsplitter Reforged', 'Crite DMG dan Elemental DMG', 'mistsplitterreforged.png'),
(13, 'Amenoma Kageuchi', 'Energi Recharge', 'amenomakageuchi.png'),
(14, 'Summit Shaper', 'Shield strength dan ATK buff', 'summitshaper.png'),
(15, 'Festering Desire', 'Skill DMG dan elemental recharge', 'festeringdesire.png'),
(16, 'Engulfing Lightning', 'Energi recharge dan ATK buff', 'engulfinglightning.png'),
(17, 'Skyward Spine', 'Crit rate dan Energi recharge', 'skywardspine.png'),
(18, 'Freedom Sworn', 'Buff Elemental mastery', 'freedomsworn.png'),
(19, 'Key of Khaj Nisut', 'Buff HP', 'keyofkhajnisut.png'),
(20, 'Prototype Amber', 'Energi Recharge', 'prototypeamber.png'),
(21, 'Whiteblind', 'Buff ATK dan DEF', 'whiteblind.png');

-- --------------------------------------------------------

--
-- Table structure for table `weapon_recomendation`
--

CREATE TABLE `weapon_recomendation` (
  `recommendation_weapon_id` int(11) NOT NULL,
  `elemental_id_1` int(11) DEFAULT NULL,
  `elemental_id_2` int(11) DEFAULT NULL,
  `weapon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapon_recomendation`
--

INSERT INTO `weapon_recomendation` (`recommendation_weapon_id`, `elemental_id_1`, `elemental_id_2`, `weapon_id`) VALUES
(1, 6, 1, 1),
(2, 6, 4, 2),
(3, 6, 3, 3),
(4, 6, 2, 4),
(5, 6, 5, 5),
(6, 6, 7, 6),
(7, 1, 4, 7),
(8, 1, 3, 8),
(9, 1, 2, 9),
(10, 1, 5, 10),
(11, 1, 7, 11),
(12, 4, 3, 12),
(13, 4, 2, 13),
(14, 4, 5, 14),
(15, 4, 7, 15),
(16, 3, 2, 16),
(17, 3, 5, 17),
(18, 3, 7, 18),
(19, 2, 5, 19),
(20, 2, 7, 20),
(21, 5, 7, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artifact`
--
ALTER TABLE `artifact`
  ADD PRIMARY KEY (`artifact_id`);

--
-- Indexes for table `artifact_recomendation`
--
ALTER TABLE `artifact_recomendation`
  ADD PRIMARY KEY (`recommendation_artifact_id`),
  ADD KEY `elemental_id_1` (`elemental_id_1`),
  ADD KEY `elemental_id_2` (`elemental_id_2`),
  ADD KEY `artifact_id` (`artifact_id`);

--
-- Indexes for table `elemental`
--
ALTER TABLE `elemental`
  ADD PRIMARY KEY (`elemental_id`);

--
-- Indexes for table `elemental_reaction`
--
ALTER TABLE `elemental_reaction`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `elemental_id_1` (`elemental_id_1`),
  ADD KEY `elemental_id_2` (`elemental_id_2`);

--
-- Indexes for table `karakter`
--
ALTER TABLE `karakter`
  ADD PRIMARY KEY (`karakter_id`),
  ADD KEY `elemental_id` (`elemental_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `weapon`
--
ALTER TABLE `weapon`
  ADD PRIMARY KEY (`weapon_id`);

--
-- Indexes for table `weapon_recomendation`
--
ALTER TABLE `weapon_recomendation`
  ADD PRIMARY KEY (`recommendation_weapon_id`),
  ADD KEY `elemental_id_1` (`elemental_id_1`),
  ADD KEY `elemental_id_2` (`elemental_id_2`),
  ADD KEY `weapon_id` (`weapon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artifact`
--
ALTER TABLE `artifact`
  MODIFY `artifact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `artifact_recomendation`
--
ALTER TABLE `artifact_recomendation`
  MODIFY `recommendation_artifact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `elemental`
--
ALTER TABLE `elemental`
  MODIFY `elemental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `elemental_reaction`
--
ALTER TABLE `elemental_reaction`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `karakter`
--
ALTER TABLE `karakter`
  MODIFY `karakter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weapon`
--
ALTER TABLE `weapon`
  MODIFY `weapon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `weapon_recomendation`
--
ALTER TABLE `weapon_recomendation`
  MODIFY `recommendation_weapon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artifact_recomendation`
--
ALTER TABLE `artifact_recomendation`
  ADD CONSTRAINT `artifact_recomendation_ibfk_1` FOREIGN KEY (`elemental_id_1`) REFERENCES `elemental` (`elemental_id`),
  ADD CONSTRAINT `artifact_recomendation_ibfk_2` FOREIGN KEY (`elemental_id_2`) REFERENCES `elemental` (`elemental_id`),
  ADD CONSTRAINT `artifact_recomendation_ibfk_3` FOREIGN KEY (`artifact_id`) REFERENCES `artifact` (`artifact_id`);

--
-- Constraints for table `elemental_reaction`
--
ALTER TABLE `elemental_reaction`
  ADD CONSTRAINT `elemental_reaction_ibfk_1` FOREIGN KEY (`elemental_id_1`) REFERENCES `elemental` (`elemental_id`),
  ADD CONSTRAINT `elemental_reaction_ibfk_2` FOREIGN KEY (`elemental_id_2`) REFERENCES `elemental` (`elemental_id`);

--
-- Constraints for table `karakter`
--
ALTER TABLE `karakter`
  ADD CONSTRAINT `karakter_ibfk_1` FOREIGN KEY (`elemental_id`) REFERENCES `elemental` (`elemental_id`);

--
-- Constraints for table `weapon_recomendation`
--
ALTER TABLE `weapon_recomendation`
  ADD CONSTRAINT `weapon_recomendation_ibfk_1` FOREIGN KEY (`elemental_id_1`) REFERENCES `elemental` (`elemental_id`),
  ADD CONSTRAINT `weapon_recomendation_ibfk_2` FOREIGN KEY (`elemental_id_2`) REFERENCES `elemental` (`elemental_id`),
  ADD CONSTRAINT `weapon_recomendation_ibfk_3` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`weapon_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
