-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 10:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

CREATE DATABASE IF NOT EXISTS webshop DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE webshop;

-- --------------------------------------------------------

--
-- Table structure for table `cipokepek`
--

CREATE TABLE `cipokepek` (
  `kepID` int(11) NOT NULL,
  `cipoID` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `cipokepek`
--

INSERT INTO `cipokepek` (`kepID`, `cipoID`, `url`) VALUES
(1, 3, 'img/cipo/302519-113_Tenis-Nike-Air-Max-90-Leather-Masculino-Branco-1.jpg'),
(2, 3, 'img/cipo/302519-113_Tenis-Nike-Air-Max-90-Leather-Masculino-Branco-2.jpg'),
(3, 3, 'img/cipo/302519-113_Tenis-Nike-Air-Max-90-Leather-Masculino-Branco-3.jpg'),
(4, 3, 'img/cipo/302519-113_Tenis-Nike-Air-Max-90-Leather-Masculino-Branco-4.jpg'),
(5, 1, 'img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor.jpg'),
(6, 1, 'img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg'),
(7, 1, 'img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-3.jpg'),
(8, 1, 'img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-4.jpg'),
(9, 2, 'img/cipo/307960-010_Tenis-Nike-Air-Max-95-Feminino-Preto.jpg'),
(10, 2, 'img/cipo/307960-010_Tenis-Nike-Air-Max-95-Feminino-Preto-2.jpg'),
(11, 2, 'img/cipo/307960-010_Tenis-Nike-Air-Max-95-Feminino-Preto-3.jpg'),
(12, 2, 'img/cipo/307960-010_Tenis-Nike-Air-Max-95-Feminino-Preto-4.jpg'),
(13, 4, 'img/cipo/312834-008_Tenis-Nike-Air-Max-97-PRM-Masculino-Preto.jpg'),
(14, 4, 'img/cipo/312834-008_Tenis-Nike-Air-Max-97-PRM-Masculino-Preto-2.jpg'),
(15, 4, 'img/cipo/312834-008_Tenis-Nike-Air-Max-97-PRM-Masculino-Preto-3.jpg'),
(16, 4, 'img/cipo/312834-008_Tenis-Nike-Air-Max-97-PRM-Masculino-Preto-4.jpg'),
(17, 5, 'img/cipo/314192-009_Tenis-Nike-Air-Force-1-06-GS-Preto-1.jpg'),
(18, 5, 'img/cipo/314192-009_Tenis-Nike-Air-Force-1-06-GS-Preto-2.jpg'),
(19, 5, 'img/cipo/314192-009_Tenis-Nike-Air-Force-1-06-GS-Preto-3.jpg'),
(20, 5, 'img/cipo/314192-009_Tenis-Nike-Air-Force-1-06-GS-Preto-4.jpg'),
(21, 6, 'img/cipo/AV2605-800_Tenis-Nike-React-Presto-Masculino-Laranja.jpg'),
(22, 6, 'img/cipo/AV2605-800_Tenis-Nike-React-Presto-Masculino-Laranja-2.jpg'),
(23, 6, 'img/cipo/AV2605-800_Tenis-Nike-React-Presto-Masculino-Laranja-3.jpg'),
(24, 6, 'img/cipo/AV2605-800_Tenis-Nike-React-Presto-Masculino-Laranja-4.jpg'),
(25, 7, 'img/cipo/BD8011_Tenis-adidas-NMD-R1-Feminino-Verde.jpg'),
(26, 7, 'img/cipo/BD8011_Tenis-adidas-NMD-R1-Feminino-Verde-2.jpg'),
(27, 7, 'img/cipo/BD8011_Tenis-adidas-NMD-R1-Feminino-Verde-3.jpg'),
(28, 7, 'img/cipo/BD8011_Tenis-adidas-NMD-R1-Feminino-Verde-4.jpg'),
(29, 8, 'img/cipo/BQ2728-003_Tenis-Nike-React-Element-55-Feminino-Preto.jpg'),
(30, 8, 'img/cipo/BQ2728-003_Tenis-Nike-React-Element-55-Feminino-Preto-2.jpg'),
(31, 8, 'img/cipo/BQ2728-003_Tenis-Nike-React-Element-55-Feminino-Preto-3.jpg'),
(32, 8, 'img/cipo/BQ2728-003_Tenis-Nike-React-Element-55-Feminino-Preto-4.jpg'),
(33, 9, 'img/cipo/C77124_Tenis-adidas-Superstar-Foundation.jpg'),
(34, 9, 'img/cipo/C77124_Tenis-adidas-Superstar-Foundation-2.jpg'),
(35, 9, 'img/cipo/C77124_Tenis-adidas-Superstar-Foundation-3.jpg'),
(36, 9, 'img/cipo/C77124_Tenis-adidas-Superstar-Foundation-4.jpg'),
(37, 10, 'img/cipo/D97049_Tenis-adidas-EQT-Support-9118-Masculino-Vermelho.jpg'),
(38, 10, 'img/cipo/D97049_Tenis-adidas-EQT-Support-9118-Masculino-Vermelho-2.jpg'),
(39, 10, 'img/cipo/D97049_Tenis-adidas-EQT-Support-9118-Masculino-Vermelho-3.jpg'),
(40, 10, 'img/cipo/D97049_Tenis-adidas-EQT-Support-9118-Masculino-Vermelho-4.jpg'),
(41, 11, 'img/cipo/D97319_Tenis-adidas-Alphabounce-Instinct-Feminino.jpg'),
(42, 11, 'img/cipo/D97319_Tenis-adidas-Alphabounce-Instinct-Feminino-2.jpg'),
(43, 11, 'img/cipo/D97319_Tenis-adidas-Alphabounce-Instinct-Feminino-3.jpg'),
(44, 11, 'img/cipo/D97319_Tenis-adidas-Alphabounce-Instinct-Feminino-4.jpg'),
(45, 12, 'img/cipo/D98157_Tenis-adidas-A.R.-Trainer-Masculino-Bege.jpg'),
(46, 12, 'img/cipo/D98157_Tenis-adidas-A.R.-Trainer-Masculino-Bege-2.jpg'),
(47, 12, 'img/cipo/D98157_Tenis-adidas-A.R.-Trainer-Masculino-Bege-3.jpg'),
(48, 12, 'img/cipo/D98157_Tenis-adidas-A.R.-Trainer-Masculino-Bege-4.jpg'),
(49, 13, 'img/cipo/CW2386-002_CW2386_Tenis-Nike-Crater-Impact-Feminino-Multicolor.jpg\n'),
(50, 13, 'img/cipo/CW2386-002_CW2386_Tenis-Nike-Crater-Impact-Feminino-Multicolor-2.jpg'),
(51, 13, 'img/cipo/CW2386-002_CW2386_Tenis-Nike-Crater-Impact-Feminino-Multicolor-3.jpg'),
(52, 13, 'img/cipo/CW2386-002_CW2386_Tenis-Nike-Crater-Impact-Feminino-Multicolor-4.jpg'),
(53, 14, 'img/cipo/CW2457-003_Tenis-Jordan-One-Take-II-Masculino-Multicolor.jpg\n'),
(54, 14, 'img/cipo/CW2457-003_Tenis-Jordan-One-Take-II-Masculino-Multicolor-2.jpg\r\n'),
(55, 14, 'img/cipo/CW2457-003_Tenis-Jordan-One-Take-II-Masculino-Multicolor-3.jpg\r\n'),
(56, 14, 'img/cipo/CW2457-003_Tenis-Jordan-One-Take-II-Masculino-Multicolor-4.jpg\r\n'),
(57, 15, 'img/cipo/CW3143-003_Tenis-Nike-PG-5-Multicolor.jpg\n'),
(58, 15, 'img/cipo/CW3143-003_Tenis-Nike-PG-5-Multicolor-2.jpg'),
(59, 15, 'img/cipo/CW3143-003_Tenis-Nike-PG-5-Multicolor-3.jpg'),
(60, 15, 'img/cipo/CW3143-003_Tenis-Nike-PG-5-Multicolor-4.jpg'),
(61, 16, 'img/cipo/CW3162-001_Tenis-Nike-Zoom-Freak-2-NRG-Masculino-Multicolor.jpg\n'),
(62, 16, 'img/cipo/CW3162-001_Tenis-Nike-Zoom-Freak-2-NRG-Masculino-Multicolor-2.jpg'),
(63, 16, 'img/cipo/CW3162-001_Tenis-Nike-Zoom-Freak-2-NRG-Masculino-Multicolor-3.jpg'),
(64, 16, 'img/cipo/CW3162-001_Tenis-Nike-Zoom-Freak-2-NRG-Masculino-Multicolor-4.jpg'),
(65, 17, 'img/cipo/CW5343-001_CW5343_Tenis-Nike-Air-Max-Verona-Se-Feminino-Preto.jpg\n'),
(66, 17, 'img/cipo/CW5343-001_CW5343_Tenis-Nike-Air-Max-Verona-Se-Feminino-Preto-2.jpg'),
(67, 17, 'img/cipo/CW5343-001_CW5343_Tenis-Nike-Air-Max-Verona-Se-Feminino-Preto-3.jpg'),
(68, 17, 'img/cipo/CW5343-001_CW5343_Tenis-Nike-Air-Max-Verona-Se-Feminino-Preto-4.jpg'),
(69, 18, 'img/cipo/CW5346-600_CW5346_Tenis-Nike-Air-Max-Up-Feminino-Rosa.jpg\n'),
(70, 18, 'img/cipo/CW5346-600_CW5346_Tenis-Nike-Air-Max-Up-Feminino-Rosa-2.jpg\r\n'),
(71, 18, 'img/cipo/CW5346-600_CW5346_Tenis-Nike-Air-Max-Up-Feminino-Rosa-3.jpg\r\n'),
(72, 18, 'img/cipo/CW5346-600_CW5346_Tenis-Nike-Air-Max-Up-Feminino-Rosa-3.jpg\r\n'),
(73, 19, 'img/cipo/CW5992-001_Tenis-Jordan-MA2-Feminino-Preto.jpg'),
(74, 19, 'img/cipo/CW5992-001_Tenis-Jordan-MA2-Feminino-Preto-2.jpg'),
(75, 19, 'img/cipo/CW5992-001_Tenis-Jordan-MA2-Feminino-Preto-3.jpg'),
(76, 19, 'img/cipo/CW5992-001_Tenis-Jordan-MA2-Feminino-Preto-4.jpg'),
(77, 20, 'img/cipo/CW6213-212_Tenis-Nike-Drop-Type-Prm-Masculino-Marrom.jpg'),
(78, 20, 'img/cipo/CW6213-212_Tenis-Nike-Drop-Type-Prm-Masculino-Marrom-2.jpg'),
(79, 20, 'img/cipo/CW6213-212_Tenis-Nike-Drop-Type-Prm-Masculino-Marrom-3.jpg'),
(80, 20, 'img/cipo/CW6213-212_Tenis-Nike-Drop-Type-Prm-Masculino-Marrom-4.jpg'),
(81, 21, 'img/cipo/CZ0175-101_Tenis-Nike-Air-Zoom-G.T.-Cut-Multicolor.jpg'),
(82, 21, 'img/cipo/CZ0175-101_Tenis-Nike-Air-Zoom-G.T.-Cut-Multicolor-2.jpg'),
(83, 21, 'img/cipo/CZ0175-101_Tenis-Nike-Air-Zoom-G.T.-Cut-Multicolor-3.jpg'),
(84, 21, 'img/cipo/CZ0175-101_Tenis-Nike-Air-Zoom-G.T.-Cut-Multicolor-4.jpg'),
(85, 22, 'img/cipo/CZ0269-101_CZ0269_Tenis-Nike-Air-Force-1-07-Feminino-Branco.jpg'),
(86, 22, 'img/cipo/CZ0269-101_CZ0269_Tenis-Nike-Air-Force-1-07-Feminino-Branco-2.jpg'),
(87, 22, 'img/cipo/CZ0269-101_CZ0269_Tenis-Nike-Air-Force-1-07-Feminino-Branco-3.jpg'),
(88, 22, 'img/cipo/CZ0269-101_CZ0269_Tenis-Nike-Air-Force-1-07-Feminino-Branco-4.jpg'),
(89, 23, 'img/cipo/D96536_Tenis-adidas-Alphabounce-Instinc-Masculino-Preto.jpg'),
(90, 23, 'img/cipo/D96536_Tenis-adidas-Alphabounce-Instinc-Masculino-Preto-2.jpg'),
(91, 23, 'img/cipo/D96536_Tenis-adidas-Alphabounce-Instinc-Masculino-Preto-3.jpg'),
(92, 23, 'img/cipo/D96536_Tenis-adidas-Alphabounce-Instinc-Masculino-Preto-4.jpg'),
(93, 24, 'img/cipo/D96551_Tenis-adidas-Pharrel-Willians-HU-Feminino-Rosa.jpg'),
(94, 24, 'img/cipo/D96551_Tenis-adidas-Pharrel-Willians-HU-Feminino-Rosa-2.jpg'),
(95, 24, 'img/cipo/D96551_Tenis-adidas-Pharrel-Willians-HU-Feminino-Rosa-3.jpg'),
(96, 24, 'img/cipo/D96551_Tenis-adidas-Pharrel-Willians-HU-Feminino-Rosa-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `felhasznalo_nev` varchar(25) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `regisztracios_datum` date NOT NULL DEFAULT current_timestamp(),
  `telefonszam` varchar(12) NOT NULL,
  `cim` varchar(255) DEFAULT NULL,
  `iranyitoszam` int(4) DEFAULT NULL,
  `varos` varchar(50) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `token_lejarat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kosarak`
--

CREATE TABLE `kosarak` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `letrehozva` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kosar_tetelek`
--

CREATE TABLE `kosar_tetelek` (
  `id` int(11) NOT NULL,
  `kosar_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marka`
--

CREATE TABLE `marka` (
  `id` int(11) NOT NULL,
  `ceg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `marka`
--

INSERT INTO `marka` (`id`, `ceg`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma'),
(4, 'Vans');

-- --------------------------------------------------------

--
-- Table structure for table `meret`
--

CREATE TABLE `meret` (
  `id` int(11) NOT NULL,
  `meret` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `meret`
--

INSERT INTO `meret` (`id`, `meret`) VALUES
(1, 36),
(2, 37),
(3, 38),
(4, 39),
(5, 40),
(6, 41),
(7, 42),
(8, 43),
(9, 44),
(10, 45),
(11, 46);

-- --------------------------------------------------------

--
-- Table structure for table `rendeles`
--

CREATE TABLE `rendeles` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `osszeg` int(11) NOT NULL,
  `fizetes_modja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rendeles_tetel`
--

CREATE TABLE `rendeles_tetel` (
  `id` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termek`
--

CREATE TABLE `termek` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `marka_id` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `megjelenes` date NOT NULL,
  `raktaron` tinyint(1) NOT NULL,
  `meret_id` int(11) NOT NULL,
  `nem` varchar(512) NOT NULL,
  `tipus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `termek`
--

INSERT INTO `termek` (`id`, `nev`, `marka_id`, `ar`, `megjelenes`, `raktaron`, `meret_id`, `nem`, `tipus_id`) VALUES
(1, 'Asics Gel Kayano 5 OG', 1, 4444, '2025-02-11', 1, 1, 'Férfi', 1),
(2, 'Nike Air Max 95', 1, 15000, '2025-01-25', 1, 1, 'Női', 1),
(3, 'Nike Air Max 90 Leather', 1, 25000, '2025-03-04', 1, 1, 'Férfi', 1),
(4, 'Nike Air Max 97 PRM', 1, 45000, '2025-02-03', 1, 2, 'Férfi', 1),
(5, 'Nike Air Force 1', 1, 65000, '2024-12-16', 0, 2, 'Férfi', 1),
(6, 'Nike React Presto Laranja', 1, 75000, '2024-08-14', 1, 1, 'Férfi', 1),
(7, 'Adidas NMD R1 ', 2, 150000, '2025-04-07', 1, 3, 'Női', 1),
(8, 'Nike React Element 55', 2, 54643, '2024-06-11', 1, 1, 'Női', 1),
(9, 'Adidas Superstar Foundation', 2, 73456, '2025-02-07', 1, 1, 'Női', 1),
(10, 'Adidas EQT Support 9118', 2, 164335, '2025-04-29', 1, 1, 'Férfi', 1),
(11, 'Adidas Alphabounce Instinct', 2, 12356, '2023-10-17', 1, 1, 'Női', 1),
(12, 'Adidas A.R. Trainer', 2, 68754, '2022-09-14', 1, 1, 'Férfi', 1),
(13, 'Puma Crater Impact ', 3, 52523, '2024-11-13', 1, 1, 'Női', 1),
(14, 'Puma Jordan One Take II', 3, 250350, '2024-07-10', 1, 1, 'Férfi', 1),
(15, 'Puma PG 5 ', 3, 53435, '2025-01-03', 1, 1, 'Férfi', 1),
(16, 'Puma Zoom Freak 2 NRG', 3, 42353, '2025-01-22', 1, 1, 'Férfi', 1),
(17, 'Puma Air Max Verona Se', 3, 45633, '2022-06-13', 1, 1, 'Női', 1),
(18, 'Puma Air Max Up', 3, 32444, '2016-10-18', 1, 1, 'Női', 1),
(19, 'Vans Jordan MA2', 4, 23456, '2024-04-16', 1, 1, 'Női', 1),
(20, 'Vans Drop Type Prm', 4, 53422, '2022-08-11', 1, 1, 'Férfi', 1),
(21, 'Vans Air Zoom G.T. Cut', 4, 43235, '2020-09-09', 1, 1, 'Férfi', 1),
(22, 'Vans Air Force 1 07', 4, 34243, '2021-06-22', 1, 1, 'Női', 1),
(23, 'Vans Alphabounce Instinc', 4, 86558, '2021-01-15', 1, 1, 'Férfi', 1),
(24, 'Vans Pharrel Willians HU', 4, 113000, '2024-08-27', 1, 1, 'Női', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipus`
--

CREATE TABLE `tipus` (
  `id` int(11) NOT NULL,
  `tipus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `tipus`
--

INSERT INTO `tipus` (`id`, `tipus`) VALUES
(1, 'sneaker'),
(2, 'slipper'),
(3, 'boots');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cipokepek`
--
ALTER TABLE `cipokepek`
  ADD PRIMARY KEY (`kepID`),
  ADD KEY `cipoID` (`cipoID`);

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalo_nev` (`felhasznalo_nev`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `kosarak`
--
ALTER TABLE `kosarak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- Indexes for table `kosar_tetelek`
--
ALTER TABLE `kosar_tetelek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kosar_id` (`kosar_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- Indexes for table `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meret`
--
ALTER TABLE `meret`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- Indexes for table `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendeles_id` (`rendeles_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- Indexes for table `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marka_id` (`marka_id`),
  ADD KEY `meret_id` (`meret_id`),
  ADD KEY `tipus_id` (`tipus_id`);

--
-- Indexes for table `tipus`
--
ALTER TABLE `tipus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cipokepek`
--
ALTER TABLE `cipokepek`
  MODIFY `kepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kosarak`
--
ALTER TABLE `kosarak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kosar_tetelek`
--
ALTER TABLE `kosar_tetelek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `marka`
--
ALTER TABLE `marka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meret`
--
ALTER TABLE `meret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `termek`
--
ALTER TABLE `termek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tipus`
--
ALTER TABLE `tipus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cipokepek`
--
ALTER TABLE `cipokepek`
  ADD CONSTRAINT `cipokepek_ibfk_1` FOREIGN KEY (`cipoID`) REFERENCES `termek` (`id`);

--
-- Constraints for table `kosarak`
--
ALTER TABLE `kosarak`
  ADD CONSTRAINT `kosarak_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kosar_tetelek`
--
ALTER TABLE `kosar_tetelek`
  ADD CONSTRAINT `kosar_tetelek_ibfk_1` FOREIGN KEY (`kosar_id`) REFERENCES `kosarak` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kosar_tetelek_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termek` (`id`);

--
-- Constraints for table `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD CONSTRAINT `rendeles_tetel_ibfk_1` FOREIGN KEY (`rendeles_id`) REFERENCES `rendeles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rendeles_tetel_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termek` (`id`);

--
-- Constraints for table `termek`
--
ALTER TABLE `termek`
  ADD CONSTRAINT `termek_ibfk_1` FOREIGN KEY (`marka_id`) REFERENCES `marka` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
