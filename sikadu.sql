-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 05 Jan 2021 pada 16.25
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikadu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `klien`
--

DROP TABLE IF EXISTS `klien`;
CREATE TABLE IF NOT EXISTS `klien` (
  `nik` varchar(18) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_ayah` varchar(32) NOT NULL,
  `nama_ibu` varchar(32) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `klien`
--

INSERT INTO `klien` (`nik`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `nama_ayah`, `nama_ibu`, `alamat`) VALUES
('000000000000000001', 'DUMMY A', 'L', 'JAKARTA', '2020-10-04', 'A', 'B', 'C'),
('000000000000000002', 'DUMMY B', 'P', 'KARAWANG', '2020-07-04', 'A', 'B', 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_penyuluhan`
--

DROP TABLE IF EXISTS `master_penyuluhan`;
CREATE TABLE IF NOT EXISTS `master_penyuluhan` (
  `id_penyuluhan` varchar(4) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `konten` text NOT NULL,
  PRIMARY KEY (`id_penyuluhan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_penyuluhan`
--

INSERT INTO `master_penyuluhan` (`id_penyuluhan`, `judul`, `konten`) VALUES
('PL01', 'PENYULUHAN A', '<p>konten penyuluhan a</p>'),
('PL02', 'PENYULUHAN B', '<p>konten penyuluhan b<br></p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tindakan`
--

DROP TABLE IF EXISTS `master_tindakan`;
CREATE TABLE IF NOT EXISTS `master_tindakan` (
  `id_tindakan` varchar(4) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jenis` enum('imunisasi','vitamin') NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  PRIMARY KEY (`id_tindakan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_tindakan`
--

INSERT INTO `master_tindakan` (`id_tindakan`, `nama`, `jenis`, `keterangan`) VALUES
('TD01', 'VITAMIN B', 'vitamin', '-'),
('TD02', 'HEPATITIS B', 'imunisasi', '-'),
('TD03', 'BCG', 'imunisasi', '-'),
('TD04', 'POLIO TETES 1', 'imunisasi', '-'),
('TD05', 'DPT-HB-HIB 1', 'imunisasi', '-'),
('TD06', 'POLIO TETES 2', 'imunisasi', '-'),
('TD07', 'PCV 1', 'imunisasi', '-'),
('TD08', 'DPT-HB-HIB 2', 'imunisasi', '-'),
('TD09', 'POLIO TETES 3', 'imunisasi', '-'),
('TD10', 'PCV 2', 'imunisasi', '-'),
('TD11', 'DPT-HB-HIB 3', 'imunisasi', '-'),
('TD12', 'POLIO TETES 4', 'imunisasi', '-'),
('TD13', 'POLIO SUNTIK (IPV)', 'imunisasi', '-'),
('TD14', 'CAMPAK-RUBELIA', 'imunisasi', '-'),
('TD15', 'JE', 'imunisasi', '-'),
('TD16', 'PCV 3', 'imunisasi', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` varchar(12) NOT NULL,
  `sandi` varchar(128) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `level` enum('administrator','kader') NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `sandi`, `nama`, `level`) VALUES
('admin', '$2y$06$/SkmoHOi6Cn1BbKlOfKgx.jBGYk.PUZkQMqdljRNA3nbOd1QCmw.a', 'Rizky', 'administrator'),
('kader', '$2y$06$rD6X3t.cILR8XN3eu37DtuU9zyBvICz0ImXrmQ0UmR9VDiutgZaCO', 'Amel', 'kader');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posyandu`
--

DROP TABLE IF EXISTS `posyandu`;
CREATE TABLE IF NOT EXISTS `posyandu` (
  `id_posyandu` int(11) NOT NULL AUTO_INCREMENT,
  `periode` varchar(7) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `tinggi_badan` float DEFAULT NULL,
  `berat_badan` float DEFAULT NULL,
  `ket_penyuluhan` text DEFAULT NULL,
  `cap_waktu` datetime NOT NULL,
  PRIMARY KEY (`id_posyandu`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posyandu`
--

INSERT INTO `posyandu` (`id_posyandu`, `periode`, `nik`, `tinggi_badan`, `berat_badan`, `ket_penyuluhan`, `cap_waktu`) VALUES
(5, '2020-12', '000000000000000001', 15.5, 7.5, NULL, '2020-12-01 06:29:00'),
(6, '2021-01', '000000000000000001', 16.5, 8.5, 'blablabla', '2021-01-01 06:29:00'),
(7, '2021-02', '000000000000000001', 16.6, 7.3, NULL, '2021-02-05 22:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posyandu_penyuluhan`
--

DROP TABLE IF EXISTS `posyandu_penyuluhan`;
CREATE TABLE IF NOT EXISTS `posyandu_penyuluhan` (
  `id_posyandu` int(11) NOT NULL,
  `id_penyuluhan` varchar(4) NOT NULL,
  KEY `id_posyandu` (`id_posyandu`),
  KEY `id_penyuluhan` (`id_penyuluhan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posyandu_penyuluhan`
--

INSERT INTO `posyandu_penyuluhan` (`id_posyandu`, `id_penyuluhan`) VALUES
(6, 'PL02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posyandu_tindakan`
--

DROP TABLE IF EXISTS `posyandu_tindakan`;
CREATE TABLE IF NOT EXISTS `posyandu_tindakan` (
  `id_posyandu` int(11) NOT NULL,
  `id_tindakan` varchar(4) NOT NULL,
  KEY `id_posyandu` (`id_posyandu`),
  KEY `id_tindakan` (`id_tindakan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posyandu_tindakan`
--

INSERT INTO `posyandu_tindakan` (`id_posyandu`, `id_tindakan`) VALUES
(6, 'TD16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar_bb_by_umur`
--

DROP TABLE IF EXISTS `standar_bb_by_umur`;
CREATE TABLE IF NOT EXISTS `standar_bb_by_umur` (
  `bulan` int(11) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `min_3` float NOT NULL,
  `min_2` float NOT NULL,
  `min_1` float NOT NULL,
  `median` float NOT NULL,
  `plus_1` float NOT NULL,
  `plus_2` float NOT NULL,
  `plus_3` float NOT NULL,
  UNIQUE KEY `bulan` (`bulan`,`jk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `standar_bb_by_umur`
--

INSERT INTO `standar_bb_by_umur` (`bulan`, `jk`, `min_3`, `min_2`, `min_1`, `median`, `plus_1`, `plus_2`, `plus_3`) VALUES
(0, 'L', 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5),
(0, 'P', 2, 2.4, 2.8, 3.2, 3.7, 4.2, 4.8),
(1, 'L', 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6),
(1, 'P', 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2),
(2, 'L', 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8),
(2, 'P', 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5),
(3, 'L', 4.4, 5, 5.7, 6.4, 7.2, 8, 9),
(3, 'P', 4, 4.5, 5.2, 5.8, 6.6, 7.5, 8.5),
(4, 'L', 4.9, 5.6, 6.2, 7, 7.8, 8.7, 9.7),
(4, 'P', 4.4, 5, 5.7, 6.4, 7.3, 8.2, 9.3),
(5, 'L', 5.3, 6, 6.7, 7.5, 8.4, 9.3, 10.4),
(5, 'P', 4.8, 5.4, 6.1, 6.9, 7.8, 8.8, 10),
(6, 'L', 5.7, 6.4, 7.1, 7.9, 8.8, 9.8, 10.9),
(6, 'P', 5.1, 5.7, 6.5, 7.3, 8.2, 9.3, 10.6),
(7, 'L', 5.9, 6.7, 7.4, 8.3, 9.2, 10.3, 11.4),
(7, 'P', 5.3, 6, 6.8, 7.6, 8.6, 9.8, 11.1),
(8, 'L', 6.2, 6.9, 7.7, 8.6, 9.6, 10.7, 11.9),
(8, 'P', 5.6, 6.3, 7, 7.9, 9, 10.2, 11.6),
(9, 'L', 6.4, 7.1, 8, 8.9, 9.9, 11, 12.3),
(9, 'P', 5.8, 6.5, 7.3, 8.2, 9.3, 10.5, 12),
(10, 'L', 6.6, 7.4, 8.2, 9.2, 10.2, 11.4, 12.7),
(10, 'P', 5.9, 6.7, 7.5, 8.5, 9.6, 10.9, 12.4),
(11, 'L', 6.8, 7.6, 8.4, 9.4, 10.5, 11.7, 13),
(11, 'P', 6.1, 6.9, 7.7, 8.7, 9.9, 11.2, 12.8),
(12, 'L', 6.9, 7.7, 8.6, 9.6, 10.8, 12, 13.3),
(12, 'P', 6.3, 7, 7.9, 8.9, 10.1, 11.5, 13.1),
(13, 'L', 7.1, 7.9, 8.8, 9.9, 11, 12.3, 13.7),
(13, 'P', 6.4, 7.2, 8.1, 9.2, 10.4, 11.8, 13.5),
(14, 'L', 7.2, 8.1, 9, 10.1, 11.3, 12.6, 14),
(14, 'P', 6.6, 7.4, 8.3, 9.4, 10.6, 12.1, 13.8),
(15, 'L', 7.4, 8.3, 9.2, 10.3, 11.5, 12.8, 14.3),
(15, 'P', 6.7, 7.6, 8.5, 9.6, 10.9, 12.4, 14.1),
(16, 'L', 7.5, 8.4, 9.4, 10.5, 11.7, 13.1, 14.6),
(16, 'P', 6.9, 7.7, 8.7, 9.8, 11.1, 12.6, 14.5),
(17, 'L', 7.7, 8.6, 9.6, 10.7, 12, 13.4, 14.9),
(17, 'P', 7, 7.9, 8.9, 10, 11.4, 12.9, 14.8),
(18, 'L', 7.8, 8.8, 9.8, 10.9, 12.2, 13.7, 15.3),
(18, 'P', 7.2, 8.1, 9.1, 10.2, 11.6, 13.2, 15.1),
(19, 'L', 8, 8.9, 10, 11.1, 12.5, 13.9, 15.6),
(19, 'P', 7.3, 8.2, 9.2, 10.4, 11.8, 13.5, 15.4),
(20, 'L', 8.1, 9.1, 10.1, 11.3, 12.7, 14.2, 15.9),
(20, 'P', 7.5, 8.4, 9.4, 10.6, 12.1, 13.7, 15.7),
(21, 'L', 8.2, 9.2, 10.3, 11.5, 12.9, 14.5, 16.2),
(21, 'P', 7.6, 8.6, 9.6, 10.9, 12.3, 14, 16),
(22, 'L', 8.4, 9.4, 10.5, 11.8, 13.2, 14.7, 16.5),
(22, 'P', 7.8, 8.7, 9.8, 11.1, 12.5, 14.3, 16.4),
(23, 'L', 8.5, 9.5, 10.7, 12, 13.4, 15, 16.8),
(23, 'P', 7.9, 8.9, 10, 11.3, 12.8, 14.6, 16.7),
(24, 'L', 8.6, 9.7, 10.8, 12.2, 13.6, 15.3, 17.1),
(24, 'P', 8.1, 9, 10.2, 11.5, 13, 14.8, 17),
(25, 'L', 8.8, 9.8, 11, 12.4, 13.9, 15.5, 17.5),
(25, 'P', 8.2, 9.2, 10.3, 11.7, 13.3, 15.1, 17.3),
(26, 'L', 8.9, 10, 11.2, 12.5, 14.1, 15.8, 17.8),
(26, 'P', 8.4, 9.4, 10.5, 11.9, 13.5, 15.4, 17.7),
(27, 'L', 9, 10.1, 11.3, 12.7, 14.3, 16.1, 18.1),
(27, 'P', 8.5, 9.5, 10.7, 12.1, 13.7, 15.7, 18),
(28, 'L', 9.1, 10.2, 11.5, 12.9, 14.5, 16.3, 18.4),
(28, 'P', 8.6, 9.7, 10.9, 12.3, 14, 16, 18.3),
(29, 'L', 9.2, 10.4, 11.7, 13.1, 14.8, 16.6, 18.7),
(29, 'P', 8.8, 9.8, 11.1, 12.5, 14.2, 16.2, 18.7),
(30, 'L', 9.4, 10.5, 11.8, 13.3, 15, 16.9, 19),
(30, 'P', 8.9, 10, 11.2, 12.7, 14.4, 16.5, 19),
(31, 'L', 9.5, 10.7, 12, 13.5, 15.2, 17.1, 19.3),
(31, 'P', 9, 10.1, 11.4, 12.9, 14.7, 16.8, 19.3),
(32, 'L', 9.6, 10.8, 12.1, 13.7, 15.4, 17.4, 19.6),
(32, 'P', 9.1, 10.3, 11.6, 13.1, 14.9, 17.1, 19.6),
(33, 'L', 9.7, 10.9, 12.3, 13.8, 15.6, 17.6, 19.9),
(33, 'P', 9.3, 10.4, 11.7, 13.3, 15.1, 17.3, 20),
(34, 'L', 9.8, 11, 12.4, 14, 15.8, 17.8, 20.2),
(34, 'P', 9.4, 10.5, 11.9, 13.5, 15.4, 17.6, 20.3),
(35, 'L', 9.9, 11.2, 12.6, 14.2, 16, 18.1, 20.4),
(35, 'P', 9.5, 10.7, 12, 13.7, 15.6, 17.9, 20.6),
(36, 'L', 10, 11.3, 12.7, 14.3, 16.2, 18.3, 20.7),
(36, 'P', 9.6, 10.8, 12.2, 13.9, 15.8, 18.1, 20.9),
(37, 'L', 10.1, 11.4, 12.9, 14.5, 16.4, 18.6, 21),
(37, 'P', 9.7, 10.9, 12.4, 14, 16, 18.4, 21.3),
(38, 'L', 10.2, 11.5, 13, 14.7, 16.6, 18.8, 21.3),
(38, 'P', 9.8, 11.1, 12.5, 14.2, 16.3, 18.7, 21.6),
(39, 'L', 10.3, 11.6, 13.1, 14.8, 16.8, 19, 21.6),
(39, 'P', 9.9, 11.2, 12.7, 14.4, 16.5, 19, 22),
(40, 'L', 10.4, 11.8, 13.3, 15, 17, 19.3, 21.9),
(40, 'P', 10.1, 11.3, 12.8, 14.6, 16.7, 19.2, 22.3),
(41, 'L', 10.5, 11.9, 13.4, 15.2, 17.2, 19.5, 22.1),
(41, 'P', 10.2, 11.5, 13, 14.8, 16.9, 19.5, 22.7),
(42, 'L', 10.6, 12, 13.6, 15.3, 17.4, 19.7, 22.4),
(42, 'P', 10.3, 11.6, 13.1, 15, 17.2, 19.8, 23),
(43, 'L', 10.7, 12.1, 13.7, 15.5, 17.6, 20, 22.7),
(43, 'P', 10.4, 11.7, 13.3, 15.2, 17.4, 20.1, 23.4),
(44, 'L', 10.8, 12.2, 13.8, 15.7, 17.8, 20.2, 23),
(44, 'P', 10.5, 11.8, 13.4, 15.3, 17.6, 20.4, 23.7),
(45, 'L', 10.9, 12.4, 14, 15.8, 18, 20.5, 23.3),
(45, 'P', 10.6, 12, 13.6, 15.5, 17.8, 20.7, 24.1),
(46, 'L', 11, 12.5, 14.1, 16, 18.2, 20.7, 23.6),
(46, 'P', 10.7, 12.1, 13.7, 15.7, 18.1, 20.9, 24.5),
(47, 'L', 11.1, 12.6, 14.3, 16.2, 18.4, 20.9, 23.9),
(47, 'P', 10.8, 12.2, 13.9, 15.9, 18.3, 21.2, 24.8),
(48, 'L', 11.2, 12.7, 14.4, 16.3, 18.6, 21.2, 24.2),
(48, 'P', 10.9, 12.3, 14, 16.1, 18.5, 21.5, 25.2),
(49, 'L', 11.3, 12.8, 14.5, 16.5, 18.8, 21.4, 24.5),
(49, 'P', 11, 12.4, 14.2, 16.3, 18.8, 21.8, 25.5),
(50, 'L', 11.4, 12.9, 14.7, 16.7, 19, 21.7, 24.8),
(50, 'P', 11.1, 12.6, 14.3, 16.4, 19, 22.1, 25.9),
(51, 'L', 11.5, 13.1, 14.8, 16.8, 19.2, 21.9, 25.1),
(51, 'P', 11.2, 12.7, 14.5, 16.6, 19.2, 22.4, 26.3),
(52, 'L', 11.6, 13.2, 15, 17, 19.4, 22.2, 25.4),
(52, 'P', 11.3, 12.8, 14.6, 16.8, 19.4, 22.6, 26.6),
(53, 'L', 11.7, 13.3, 15.1, 17.2, 19.6, 22.4, 25.7),
(53, 'P', 11.4, 12.9, 14.8, 17, 19.7, 22.9, 27),
(54, 'L', 11.8, 13.4, 15.2, 17.3, 19.8, 22.7, 26),
(54, 'P', 11.5, 13, 14.9, 17.2, 19.9, 23.2, 27.4),
(55, 'L', 11.9, 13.5, 15.4, 17.5, 20, 22.9, 26.3),
(55, 'P', 11.6, 13.2, 15.1, 17.3, 20.1, 23.5, 27.7),
(56, 'L', 12, 13.6, 15.5, 17.7, 20.2, 23.2, 26.6),
(56, 'P', 11.7, 13.3, 15.2, 17.5, 20.3, 23.8, 28.1),
(57, 'L', 12.1, 13.7, 15.6, 17.8, 20.4, 23.4, 26.9),
(57, 'P', 11.8, 13.4, 15.3, 17.7, 20.6, 24.1, 28.5),
(58, 'L', 12.2, 13.8, 15.8, 18, 20.6, 23.7, 27.2),
(58, 'P', 11.9, 13.5, 15.5, 17.9, 20.8, 24.4, 28.8),
(59, 'L', 12.3, 14, 15.9, 18.2, 20.8, 23.9, 27.6),
(59, 'P', 12, 13.6, 15.6, 18, 21, 24.6, 29.2),
(60, 'L', 12.4, 14.1, 16, 18.3, 21, 24.2, 27.9),
(60, 'P', 12.1, 13.7, 15.8, 18.2, 21.2, 24.9, 29.5);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `posyandu`
--
ALTER TABLE `posyandu`
  ADD CONSTRAINT `posyandu_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `klien` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posyandu_penyuluhan`
--
ALTER TABLE `posyandu_penyuluhan`
  ADD CONSTRAINT `posyandu_penyuluhan_ibfk_1` FOREIGN KEY (`id_posyandu`) REFERENCES `posyandu` (`id_posyandu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posyandu_penyuluhan_ibfk_2` FOREIGN KEY (`id_penyuluhan`) REFERENCES `master_penyuluhan` (`id_penyuluhan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posyandu_tindakan`
--
ALTER TABLE `posyandu_tindakan`
  ADD CONSTRAINT `posyandu_tindakan_ibfk_1` FOREIGN KEY (`id_posyandu`) REFERENCES `posyandu` (`id_posyandu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posyandu_tindakan_ibfk_2` FOREIGN KEY (`id_tindakan`) REFERENCES `master_tindakan` (`id_tindakan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
