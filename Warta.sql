-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2025 at 03:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Warta`
--

-- --------------------------------------------------------

--
-- Table structure for table `WDadmin`
--

CREATE TABLE `WDadmin` (
  `ID` tinyint(2) NOT NULL,
  `nmAdmin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDadminuser`
--

CREATE TABLE `WDadminuser` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `adminID` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `WDadminuser`
--

INSERT INTO `WDadminuser` (`ID`, `userID`, `adminID`) VALUES
(1, 13, 1),
(2, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `WDapbdes`
--

CREATE TABLE `WDapbdes` (
  `ID` int(11) NOT NULL,
  `Kode` varchar(20) NOT NULL,
  `Uraian` varchar(255) NOT NULL,
  `Jenis` tinyint(1) NOT NULL,
  `Kategori` varchar(100) NOT NULL,
  `Jumlah` bigint(20) NOT NULL,
  `Tahun` year(4) NOT NULL,
  `TglInput` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDberita`
--

CREATE TABLE `WDberita` (
  `ID` int(11) NOT NULL,
  `Judul` varchar(150) NOT NULL,
  `Konten` text NOT NULL,
  `Img` varchar(100) NOT NULL,
  `jmlGbr` tinyint(2) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `penulisID` int(11) NOT NULL,
  `TglPublish` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDberkassurat`
--

CREATE TABLE `WDberkassurat` (
  `ID` int(11) NOT NULL,
  `permintaanID` int(11) NOT NULL,
  `nmFile` char(100) NOT NULL,
  `Ket` char(40) NOT NULL,
  `TglUpload` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDlapor`
--

CREATE TABLE `WDlapor` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `Jenis` tinyint(1) NOT NULL,
  `Desk` text NOT NULL,
  `Foto` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Publik` tinyint(1) NOT NULL,
  `TglLapor` datetime NOT NULL DEFAULT current_timestamp(),
  `TglSelesai` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDnotif`
--

CREATE TABLE `WDnotif` (
  `ID` int(11) NOT NULL,
  `Judul` varchar(100) NOT NULL,
  `Ket` text NOT NULL,
  `Tempat` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `authorID` int(11) NOT NULL,
  `TglAcara` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDpermohonansurat`
--

CREATE TABLE `WDpermohonansurat` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `jnsSurat` tinyint(1) NOT NULL,
  `statAdmin` tinyint(1) NOT NULL,
  `statKades` tinyint(1) NOT NULL,
  `TglPengajuan` datetime NOT NULL DEFAULT current_timestamp(),
  `TglSelesai` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDsesi`
--

CREATE TABLE `WDsesi` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `Sesi` char(64) NOT NULL,
  `TglLog` datetime NOT NULL DEFAULT current_timestamp(),
  `TglExp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDstdesa`
--

CREATE TABLE `WDstdesa` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDtarget`
--

CREATE TABLE `WDtarget` (
  `ID` int(11) NOT NULL,
  `targetID` int(11) NOT NULL,
  `notifID` int(11) NOT NULL,
  `Jenis` tinyint(1) NOT NULL,
  `TglKirim` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WDuser`
--

CREATE TABLE `WDuser` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(150) DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `TglLahir` date NOT NULL DEFAULT current_timestamp(),
  `Nowa` varchar(20) NOT NULL,
  `Kode` varchar(6) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `fotoPP` varchar(60) DEFAULT NULL,
  `desaID` varchar(15) DEFAULT NULL,
  `TglDaftar` datetime NOT NULL DEFAULT current_timestamp(),
  `TglOtp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `WDuser`
--

INSERT INTO `WDuser` (`ID`, `Nama`, `Gender`, `TglLahir`, `Nowa`, `Kode`, `Status`, `fotoPP`, `desaID`, `TglDaftar`, `TglOtp`) VALUES
(13, 'NICHIRO', NULL, '2025-11-21', '812345678', '624060', 6, '13_7c3188ab97a918c1a8eb6bb98b7ba4730283446a.jpeg', '3517142005', '2025-11-21 09:03:24', '2025-11-21 20:26:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `WDadminuser`
--
ALTER TABLE `WDadminuser`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDapbdes`
--
ALTER TABLE `WDapbdes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDberita`
--
ALTER TABLE `WDberita`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDberkassurat`
--
ALTER TABLE `WDberkassurat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDlapor`
--
ALTER TABLE `WDlapor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `WDnotif`
--
ALTER TABLE `WDnotif`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDpermohonansurat`
--
ALTER TABLE `WDpermohonansurat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `WDsesi`
--
ALTER TABLE `WDsesi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `WDstdesa`
--
ALTER TABLE `WDstdesa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDtarget`
--
ALTER TABLE `WDtarget`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `WDuser`
--
ALTER TABLE `WDuser`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nowa` (`Nowa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `WDadminuser`
--
ALTER TABLE `WDadminuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `WDapbdes`
--
ALTER TABLE `WDapbdes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDberita`
--
ALTER TABLE `WDberita`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDberkassurat`
--
ALTER TABLE `WDberkassurat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDlapor`
--
ALTER TABLE `WDlapor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDnotif`
--
ALTER TABLE `WDnotif`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDpermohonansurat`
--
ALTER TABLE `WDpermohonansurat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDsesi`
--
ALTER TABLE `WDsesi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDstdesa`
--
ALTER TABLE `WDstdesa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDtarget`
--
ALTER TABLE `WDtarget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WDuser`
--
ALTER TABLE `WDuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
