-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2025 pada 06.47
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
(12, 'jhjhj', '• rfgfdgdg', '1000000.00', 'fotosjasa/1742833739_t.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `namapelanggan` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `nomorwa` varchar(20) NOT NULL,
  `jadwalpemotretan` date NOT NULL DEFAULT current_timestamp(),
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

INSERT INTO `pemesanan` (`id_pemesanan`, `id_jasa`, `namapelanggan`, `alamat`, `nomorwa`, `jadwalpemotretan`, `tipepembayaran`, `metodepembayaran`, `jumlahdp`, `sisapembayaran`, `totalharga`, `statuspemesanan`, `gambarbuktipembayaran`) VALUES
(13, 12, 'Iqbal Suwandi', 'fdsfsdf', '0883918331', '2025-04-07', 'Kontan', 'Transfer', '0', '0', '1000000', 'Proses', 'bukti_pembayaran/1744000728.png');

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
(7, 'Iqbal Suwandi', 'iqbal', '$2y$12$In5FkeJhF9Z9NERF.c6.n.lcUj85vNQlTBnVVe8G2jwbD/OVvOTIG', 'wasdsadsd', '081917716274', 'fotos/1742763192.jpg', 'karyawan');

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
  ADD KEY `fk_pemesanan_jasa` (`id_jasa`);

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
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_jasa` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id_jasa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
