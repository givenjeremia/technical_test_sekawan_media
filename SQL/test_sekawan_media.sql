-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Feb 2023 pada 16.48
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_sekawan_media`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `nama_driver` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `driver`
--

INSERT INTO `driver` (`id`, `nama_driver`, `keterangan`, `status`) VALUES
(1, 'Supardi', 'No Telp: 09731231231', 1),
(2, 'Suparno', 'No Wa : 09888\r\nFastrest via wa', 0),
(3, 'Pardi', NULL, 1),
(4, 'Suparso', NULL, 1),
(5, 'Suparsoyo', NULL, 1),
(6, 'Yono', NULL, 1),
(7, 'Parjo', 'Only Sabtu Minggu', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `nama_kendaraan` varchar(45) DEFAULT NULL,
  `komsumsi_bahan_bakar` varchar(45) DEFAULT NULL,
  `jadwal_service` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `nama_kendaraan`, `komsumsi_bahan_bakar`, `jadwal_service`) VALUES
(1, 'Pajero Sport', '11 Km/Liter', '2023-02-26'),
(2, 'Fortuner GX', '10 Km/Liter', '2023-03-01'),
(3, 'Innova', '25 KM/Liter', '2023-02-28'),
(4, 'Avanza', '30 KM/Liter', '2023-02-16'),
(5, 'Xenia', '50 KM/Liter', '2023-02-17'),
(6, 'Xpander', '35 KM/Liter', '2023-02-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aplikasi`
--

CREATE TABLE `log_aplikasi` (
  `id` int(11) NOT NULL,
  `tanggal_waktu` datetime DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id` int(11) NOT NULL,
  `tanggal_sewa` date DEFAULT NULL,
  `waktu_sewa` time DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `kendaraan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id`, `tanggal_sewa`, `waktu_sewa`, `keterangan`, `driver_id`, `kendaraan_id`) VALUES
(11, '2023-02-17', '10:01:00', 'Hallo Ubah', 1, 2),
(12, '2023-02-23', '11:00:00', 'Ketemu Client', 3, 2),
(13, '2023-02-17', '10:10:00', 'Mengantar Ke rumah', 6, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persetujuan`
--

CREATE TABLE `persetujuan` (
  `users_id` int(11) NOT NULL,
  `penyewaan_id` int(11) NOT NULL,
  `tanggal_buat` date DEFAULT NULL,
  `tanggal_setuju` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `persetujuan`
--

INSERT INTO `persetujuan` (`users_id`, `penyewaan_id`, `tanggal_buat`, `tanggal_setuju`, `status`) VALUES
(2, 11, '2023-02-16', '2023-02-17', 1),
(2, 12, '2023-02-16', '2023-02-16', 1),
(3, 13, '2023-02-16', NULL, 0),
(4, 11, '2023-02-16', '2023-02-16', 1),
(5, 12, '2023-02-16', '2023-02-16', 1),
(5, 13, '2023-02-16', '2023-02-16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_kendaraan`
--

CREATE TABLE `riwayat_kendaraan` (
  `id` int(11) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `kendaraan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `riwayat_kendaraan`
--

INSERT INTO `riwayat_kendaraan` (`id`, `waktu`, `keterangan`, `kendaraan_id`) VALUES
(1, '2023-02-12 10:35:59', 'Disewa untuk membeli bahan baku', 1),
(2, '2023-02-13 16:35:59', 'Mengantar Client Pulang', 1),
(3, '2023-02-13 16:35:59', 'Membeli Peralatan Kantor', 2),
(4, '2023-02-08 16:35:59', 'Disewa untuk membeli bahan baku', 4),
(5, '2023-02-10 16:39:52', 'Pertemuan Client Di Pelabuhan', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '$2y$10$fSQL.2iOPHhM4TcxLM96fOYsgXuVNJwJFFmwzdlNYsLJ4XH/6Q50e', 'admin@gmail.com', 0),
(2, 'suparno', '$2y$10$DbyfZMQ9o0GyhURNWJ01pOE/jXSTTtWd0dL8sdfdefocsYs1TjTli', 'suparno@gmail.com', 1),
(3, 'supardi', '$2y$10$lyH74sMuzJRgP3vkdv/8b.0cjUArh3AWPNnjjADAccqAvtbOXZqsm', 'supardi@gmail.com', 1),
(4, 'Given', '$2y$10$r2U.LCpJA.4YlgMDf4SoBuv8brfm6q.g6Us8L/0KJP0URy9ige9fC', 'given@gmail.com', 2),
(5, 'jeremia', '$2y$10$s1TYreuCBHhe2zXhpM5VxOUPds7F.4xovfc0NMLG1y8XQGcAIrl9y', 'jeremia@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_aplikasi`
--
ALTER TABLE `log_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penyewaan_driver1_idx` (`driver_id`),
  ADD KEY `fk_penyewaan_kendaraan1_idx` (`kendaraan_id`);

--
-- Indeks untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`users_id`,`penyewaan_id`),
  ADD KEY `fk_users_has_penyewaan_penyewaan1_idx` (`penyewaan_id`),
  ADD KEY `fk_users_has_penyewaan_users1_idx` (`users_id`);

--
-- Indeks untuk tabel `riwayat_kendaraan`
--
ALTER TABLE `riwayat_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_kendaraan_kendaraan_idx` (`kendaraan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `log_aplikasi`
--
ALTER TABLE `log_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `riwayat_kendaraan`
--
ALTER TABLE `riwayat_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `fk_penyewaan_driver1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penyewaan_kendaraan1` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD CONSTRAINT `fk_users_has_penyewaan_penyewaan1` FOREIGN KEY (`penyewaan_id`) REFERENCES `penyewaan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_penyewaan_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `riwayat_kendaraan`
--
ALTER TABLE `riwayat_kendaraan`
  ADD CONSTRAINT `fk_riwayat_kendaraan_kendaraan` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
