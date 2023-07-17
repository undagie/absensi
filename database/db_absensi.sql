-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2023 pada 11.45
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `tgl`, `waktu`, `keterangan`, `id_user`) VALUES
(4, '2019-07-25', '07:21:53', 'Masuk', 6),
(5, '2019-07-26', '09:00:47', 'Masuk', 6),
(6, '2019-07-26', '16:01:03', 'Pulang', 6),
(7, '2019-07-25', '17:01:28', 'Pulang', 6),
(8, '2020-10-23', '22:18:36', 'Masuk', 13),
(9, '2023-07-13', '20:20:21', 'Masuk', 14),
(10, '2023-07-13', '20:20:42', 'Pulang', 14),
(11, '2023-07-13', '20:21:06', 'Masuk', 14),
(12, '2023-07-13', '20:21:39', 'Pulang', 14),
(13, '2023-07-13', '20:21:43', 'Masuk', 14),
(14, '2023-07-13', '20:21:51', 'Masuk', 14),
(15, '2023-07-13', '23:54:27', 'Pulang', 14),
(16, '2023-07-14', '19:03:30', 'Masuk', 14),
(17, '2023-07-14', '19:04:37', 'Pulang', 14),
(18, '2023-07-17', '06:31:16', 'Masuk', 14),
(19, '2023-07-17', '15:20:28', 'Pulang', 14),
(20, '2023-07-17', '15:21:01', 'Pulang', 14),
(21, '2023-07-17', '15:21:10', 'Masuk', 14),
(22, '2023-07-17', '16:22:50', 'Pulang', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` smallint(3) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `gaji_pokok`) VALUES
(1, 'Marketing', 2000000),
(2, 'IT ', 2500000),
(3, 'Akuntan', 3000000),
(4, 'Security', 1500000),
(5, 'HSE', 3200000),
(6, 'Produksi', 2600000),
(13, 'Human Resource', 3150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam`
--

CREATE TABLE `jam` (
  `id_jam` tinyint(1) NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `keterangan` enum('Masuk','Pulang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jam`
--

INSERT INTO `jam` (`id_jam`, `start`, `finish`, `keterangan`) VALUES
(1, '07:00:00', '07:45:00', 'Masuk'),
(2, '16:00:00', '16:45:00', 'Pulang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` smallint(5) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(20) DEFAULT 'no-foto.png',
  `divisi` smallint(5) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('Manager','Karyawan') NOT NULL DEFAULT 'Karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nik`, `nama`, `alamat`, `telp`, `email`, `foto`, `divisi`, `username`, `password`, `level`) VALUES
(1, '12312312332123', 'Ahmad Fadillah 1', 'Komp Cempaka', '08139212092', 'ahm.fadil@mail.com', '1564316194.png', NULL, 'ahmad', '$2y$10$UwqloCX7PFLM3aQvgQxh6e9UgifqwQOZiF1zdogtLF6iVDR7Yr7IW', 'Manager'),
(6, '123456789101112', 'Anissa Rahma', 'Jl A Yani', '08151231902', 'anissa.rhm31@mail.com', '1564293217.png', 1, 'anissa', '$2y$10$2kexYaZKVXX/5Liljm2FXO0Zk7BI5LUQgOTz1bRIf211eraxpju2a', 'Karyawan'),
(7, '1231231231231123', 'Willy', 'Jl Mr Cokro', '081231238', 'willy@mail.com', 'no-foto.png', 2, 'willy', '$2y$10$zGwtkQ8uCLBCmXEbPjJWF.vZkVlf7nmxhbe9iYu08wE8qkJNPdMb.', 'Karyawan'),
(8, '8931289124891', 'Manager 1', '', '', '', 'no-foto.png', NULL, 'manager_1', '$2y$10$XtMY01KEOd5I065s8Exs0OcQ373RvRNG1JznORr6TmmBNWnZ3vjjK', 'Manager'),
(9, '1231231238900', 'Manager 2', '', '', '', 'no-foto.png', NULL, 'manager_2', '$2y$10$iJWUOXDznGEmxo.bqnhtmeFL51jN5130LfDlKg8VROfoEmlgC.cFW', 'Manager'),
(10, '908121310291', 'Manager 3', '', '', '', 'no-foto.png', NULL, 'manager_3', '$2y$10$uGsLvgl.6ji2iZ7tWkNvPelTwZdLQ6QA81Yawa20wsLairCXqV8BO', 'Manager'),
(11, '123801204012', 'Manager 4', '', '', '', 'no-foto.png', NULL, 'master_4', '$2y$10$Kot81WNqrho4WlcYI13kT.Y5V2sMg1ZSAXcITrp8cj3dqHpbl4vrS', 'Manager'),
(13, '202010765341', 'RAJA PUTRA MEDIA', 'Komp Batuah', '082137801536', 'rajaputramedia@gmail.com', '1603466299.png', 2, 'raja', '$2y$10$TUMbb787RN.ML.Z65ZFuDuaGRqi..c.5YdJp/AseHzmvf9NFd6nMG', 'Karyawan'),
(14, '1', 'Mila Siti Salamah', 'Jl Bauntung', '0000000000', 'milasitisalamah22@gmail.com', 'no-foto.png', 1, 'mila', '$2y$10$2e85lCgch7alZjfJT1bWbuqKaznzkGN/eQbS3yG.I.Rl8lvxgr4bW', 'Karyawan'),
(15, '2', 'Salamah', '', '1111111111111', 'milasiti@gmail.com', 'no-foto.png', 3, 'mil', '$2y$10$o1ZPByoMPasfql0Nn7H4Quqp3PFM6qBdBkD65fK3A71HG3Sjwu/Ui', 'Manager'),
(16, '1', 'Siti ', 'Komplek Kelapa Gading Permai', '22', 'milisitisalamah22@gmail.com', 'no-foto.png', 13, 'siti', '$2y$10$REEpT3BWC/8BTJCeevuXZ.LyzEMxJhb6i6pDuIL79jogjCnxGiwMa', 'Karyawan'),
(17, '33333', 'Salamah', 'Jl Panglima Batur', '33333', 'salamah@gmail.com', 'no-foto.png', 6, 'salamah', '$2y$10$OXhhFr/dLxw04yhb/emBA.ydQUVFHeQcn9lRUdFc6lTdlZzujkGKm', 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
