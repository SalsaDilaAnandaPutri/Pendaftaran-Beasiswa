-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2024 pada 06.35
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_beasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar`
--

CREATE TABLE `daftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `no_hp` varchar(55) NOT NULL,
  `semester` int(55) NOT NULL,
  `last_ipk` float NOT NULL,
  `beasiswa` varchar(55) NOT NULL,
  `syarat_berkas` varchar(55) NOT NULL,
  `status_ajuan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar`
--

INSERT INTO `daftar` (`id`, `nama`, `email`, `no_hp`, `semester`, `last_ipk`, `beasiswa`, `syarat_berkas`, `status_ajuan`) VALUES
(42, 'Salsa Dila Ananda Putri', 'salsadilaputri09@gmail.com', '085641619643', 4, 3.3, 'akademik', 'Tanda Terima MBKM 21102006.pdf', 0),
(43, 'Salsa Dila Ananda Putri', 'salsadilaputri09@gmail.com', '085641619643', 8, 3.8, 'kepeimpinan', 'kepemimpinan..jpg', 1),
(45, 'salsa', 'salsadilaputri09@gmail.com', '085641619643', 2, 3.1, 'non-akademik', '5 RPS Interaksi Manusia  dan Komputer .pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(31, 'Salsa Dila Ananda Putri', 'salsadilaputri09@gmail.com', '$2y$10$sfefEHqpO5FzUyju6hz9g.Uhcw3t2hETvmuPK/B9mX29WXAbrw5Sm'),
(32, 'Salsa Dila Ananda Putri', 'salsadilaputri0@gmail.com', '$2y$10$B0hl5K5zTsBIISNqzd0JPeuNtLt38H6DdoQQDm47NX8l22QbCowRa'),
(33, 'Salsa Dila Ananda Putri', 'salsa@gmail.com', '$2y$10$Oksprjaf8LjbC7UIZloBieEaqKmeA3BXE7Z96DwQbBsANEI6XhCSm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar`
--
ALTER TABLE `daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
