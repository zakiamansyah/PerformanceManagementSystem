-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 09:11 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` char(10) NOT NULL,
  `nama_indikator` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `nama_indikator`) VALUES
('ID01', 'awkdakwd'),
('ID02', 'rama'),
('ID03', 'kris');

-- --------------------------------------------------------

--
-- Table structure for table `keberatan`
--

CREATE TABLE `keberatan` (
  `id_keberatan` int(11) NOT NULL,
  `komplain` text NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  `id_sub_nilai` char(10) NOT NULL,
  `status` int(2) NOT NULL,
  `pengirim` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keberatan`
--

INSERT INTO `keberatan` (`id_keberatan`, `komplain`, `tgl_kirim`, `id_sub_nilai`, `status`, `pengirim`) VALUES
(1, 'hi', '2018-09-16 23:09:15', 'NILAI01', 1, '11'),
(2, 'hai juga', '2018-09-16 23:09:32', 'NILAI01', 1, 'admin'),
(3, 'oi', '2018-09-17 18:50:39', 'NILAI01', 1, '11'),
(4, 'apa?', '2018-09-17 18:50:49', 'NILAI01', 1, 'admin'),
(5, 'nani the fuck??', '2018-09-17 18:55:11', 'NILAI02', 1, '12'),
(6, 'oi', '2018-09-17 22:35:24', 'NILAI03', 1, '11'),
(7, 'bales cok', '2018-09-18 00:28:13', 'NILAI03', 1, '11'),
(8, 'fuck', '2018-09-18 00:28:32', 'NILAI02', 1, 'admin'),
(9, 'cok', '2018-09-18 00:28:47', 'NILAI03', 1, 'admin'),
(10, 'a', '2018-09-18 00:29:52', 'NILAI03', 1, 'admin'),
(11, 'b', '2018-09-18 00:39:52', 'NILAI03', 1, 'admin'),
(12, 'bacot', '2018-09-18 00:53:16', 'NILAI03', 1, '11'),
(13, 'awd', '2018-10-07 19:26:42', 'NILAI01', 1, '11');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nik` char(16) NOT NULL,
  `nama` char(100) NOT NULL,
  `tempat_lahir` char(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `sd` char(50) NOT NULL,
  `smp` char(50) NOT NULL,
  `sma` char(50) NOT NULL,
  `akademik` char(50) NOT NULL,
  `thn_masuk_kerja` year(4) NOT NULL,
  `status` char(25) NOT NULL,
  `nomor_sk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama`, `tempat_lahir`, `tgl_lahir`, `sd`, `smp`, `sma`, `akademik`, `thn_masuk_kerja`, `status`, `nomor_sk`) VALUES
('001', 'sheli', '001', '2019-01-09', 'ffrrew', 'fredgf`', 'f feffdf', 'f dvfdvfd', 0000, 'jomblo', 1),
('003', 'karin', 'indramayu', '2019-01-10', 'sdn2sussukan', 'smpn1susukan', 'smkn1jamblang', '1', 2014, 'jomblo', 1),
('004', 'Rama Alfareza', 'indramayu', '2019-01-17', 'sdn2sussukan', 'smpn1susukan', 'smkn1jamblang', '1', 2016, '1', 1),
('005', 'najih', 'cirebon', '2019-01-18', 'sdn2sussukan', 'smpn1susukan', 'smkn1jamblang', '1', 2014, 'jomblo', 1),
('12', 'ayu', '12', '2018-09-17', 'SD', 'SMP', 'SMA', 'IKMI', 2017, 'BUJANK', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_nilai` int(11) NOT NULL,
  `id_sub_nilai` char(10) NOT NULL,
  `semester` char(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nik` char(16) NOT NULL,
  `id_indikator` char(10) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_nilai`, `id_sub_nilai`, `semester`, `tahun`, `nik`, `id_indikator`, `nilai`) VALUES
(19, 'NILAI02', '1', 2018, '12', 'ID01', 50),
(20, 'NILAI02', '1', 2018, '12', 'ID02', 60),
(21, 'NILAI02', '1', 2018, '12', 'ID03', 90),
(25, 'NILAI04', '2', 2018, '12', 'ID01', 70),
(26, 'NILAI04', '2', 2018, '12', 'ID02', 80),
(27, 'NILAI04', '2', 2018, '12', 'ID03', 90);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, '11', '6512bd43d9caa6e02c990b0a82652dca', 3),
(3, '', '202cb962ac59075b964b07152d234b70', 3),
(4, '', '202cb962ac59075b964b07152d234b70', 3),
(5, '003', '123', 3),
(6, '004', '202cb962ac59075b964b07152d234b70', 3),
(7, '005', '202cb962ac59075b964b07152d234b70', 3),
(8, 'kepala', '870f669e4bbbfa8a6fde65549826d1c4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`);

--
-- Indexes for table `keberatan`
--
ALTER TABLE `keberatan`
  ADD PRIMARY KEY (`id_keberatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `fk_kinerja_1` (`nik`),
  ADD KEY `fk_kinerja_2` (`id_indikator`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keberatan`
--
ALTER TABLE `keberatan`
  MODIFY `id_keberatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_kinerja_1` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`),
  ADD CONSTRAINT `fk_kinerja_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
