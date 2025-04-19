-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Apr 2025 pada 15.09
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesanan_jasa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL,
  `namajasa` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `namajasa`, `deskripsi`, `harga`, `gambar`) VALUES
(10, 'Selfphoto Shoot (Fix Baground)', '• 10 Menit foto\r\n• +10 Menit @35.000\r\n• Maksimal 3 Orang', '100000.00', 'fotosjasa/1741119497_gambar1.jpg'),
(12, 'jhjhj', '• rfgfdgdg', '1000000.00', 'fotosjasa/1742833739_t.jpg'),
(14, 'dasad', '• sfasasfsa\r\n• frasdfsfs\r\n• kgkhhjk', '100000.00', 'fotosjasa/1745062264_pohon.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_jasa` int(11) NOT NULL,
  `namapelanggan` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `nomorwa` varchar(20) NOT NULL,
  `jadwalpemotretan` datetime NOT NULL DEFAULT current_timestamp(),
  `tipepembayaran` enum('DP','Kontan') NOT NULL,
  `metodepembayaran` enum('Transfer','Tunai') NOT NULL,
  `jumlahdp` decimal(10,0) DEFAULT NULL,
  `sisapembayaran` decimal(10,0) DEFAULT NULL,
  `totalharga` decimal(10,0) NOT NULL,
  `statuspemesanan` enum('Setujui','Batal','Proses') NOT NULL,
  `gambarbuktipembayaran` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_user`, `id_jasa`, `namapelanggan`, `alamat`, `nomorwa`, `jadwalpemotretan`, `tipepembayaran`, `metodepembayaran`, `jumlahdp`, `sisapembayaran`, `totalharga`, `statuspemesanan`, `gambarbuktipembayaran`) VALUES
(32, 13, 12, 'Iqbal Suwandi', 'adsdsad', '6281917716274', '2025-04-16 11:43:00', 'Kontan', 'Tunai', '0', '0', '1000000', 'Setujui', 'bukti_pembayaran/1744778655.jpg'),
(33, 14, 10, 'Iqbal Suwandi', 'dsadasd', '6281917716274', '2025-04-18 13:36:00', 'Kontan', 'Tunai', '0', '0', '100000', 'Setujui', 'bukti_pembayaran/1744958225.png'),
(34, 13, 10, 'lutfi', 'fdfgdfgdfg', '6281917716274', '2025-04-19 18:32:00', 'Kontan', 'Transfer', '0', '0', '100000', 'Setujui', 'bukti_pembayaran/1745062586.jpg'),
(35, 12, 10, 'sapik', 'kraksaan', '6288743269641', '2025-04-30 09:00:00', 'DP', 'Transfer', '60000', '40000', '100000', 'Setujui', 'bukti_pembayaran/1745065205.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `namapemilik` varchar(225) NOT NULL,
  `namabang` varchar(50) NOT NULL,
  `nomorrek` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `namapemilik`, `namabang`, `nomorrek`) VALUES
(8, 'IQBAL SUWANDI', 'BNI', 1234);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `nomortelepon` varchar(225) NOT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `status` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `namalengkap`, `username`, `password`, `alamat`, `nomortelepon`, `gambar`, `status`) VALUES
(6, 'Iqbal Suwandi1234', 'iqbal', '$2y$12$IwRSofp3prAIPIo0o2cJ7eojjAh.T4qtmdjj2mZ4EDHfut4vvNuaK', 'eqweweqwe', '081917716274', 'fotos/1742763907.jpg', 'admin'),
(12, 'lutfi', 'lutfi', '$2y$12$5Vga/SpxP6jDXu7rlB9piOD0ORQxtzxjPzjjZCYkG2vOd62ZLRm8a', 'dasadas', '081917716274', 'fotos/1744864116_logo.png', 'karyawan'),
(13, 'suwandi', 'suwandi', '$2y$12$c5OtKs.41Oa/1Mu9eW17Uezd8cTtqUIeQ99Q3kfv7xS1d3lzDpDyu', 'jgfjghjhgj', '081917716274', NULL, 'karyawan'),
(14, 'arik', 'arik', '$2y$12$7yAjznWUOO/axYX5elzCVePCXex0Z1KwwDOsmmJQ1nYNuY6BlfGYy', 'twerewr', '081917716274', NULL, 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `fk_pemesanan_jasa` (`id_jasa`),
  ADD KEY `fk_pemesanan_user` (`id_user`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_jasa` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id_jasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
