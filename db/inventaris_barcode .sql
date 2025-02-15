-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2022 pada 08.13
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_barcode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merk_barang` varchar(255) NOT NULL,
  `tahun_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id`, `nama_barang`, `merk_barang`, `tahun_pembelian`) VALUES
(4, 'Komputer', 'Asus', 2019),
(5, 'Monitor', 'Acer', 2020),
(6, 'printer', 'epson', 2020);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_peminjaman`
--

CREATE TABLE `data_peminjaman` (
  `id` int(11) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_peminjaman`
--

INSERT INTO `data_peminjaman` (`id`, `nama_peminjam`, `tgl_peminjaman`, `tgl_pengembalian`) VALUES
(6, 'boy', '2022-06-11', '2022-06-11'),
(7, 'adak', '2022-06-11', '2022-06-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pengguna`
--

CREATE TABLE `data_pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pengguna`
--

INSERT INTO `data_pengguna` (`id`, `nama`, `username`, `password`, `hak_akses`, `foto`) VALUES
(3, 'alex', 'admin', '$2a$12$1kOkP9aSZyXlE9SL2t99yuxKQcJ.9r2zvQvhcEF5Nh5VidN2uqkfa', 1, 'avatar-3.png'),
(19, 'mondi', 'mondi', '$2y$10$G1/OH93vZqSy2MDhMHJF2.PCArYR8HZ.hN2dNm6NVYdjv9qERTz8q', 2, 'avatar-1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_data_barang`
--

CREATE TABLE `detail_data_barang` (
  `id` int(11) NOT NULL,
  `id_data_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `asal_perolehan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kondisi_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_data_barang`
--

INSERT INTO `detail_data_barang` (`id`, `id_data_barang`, `kode_barang`, `asal_perolehan`, `status`, `foto`, `kondisi_barang`) VALUES
(8, 5, '1234', '1', 1, '1653829616_Icon Strix.png', 4),
(9, 5, '12123', '2', 1, '1653829723_Icon Strix.png', 4),
(10, 5, '12345', '1', 1, '1653839590_Icon Strix.png', 4),
(11, 5, '121234', '1', 1, '1654654685_Icon Strix.png', 4),
(12, 4, '1.21.31.12.232.323', 'Pembelian', 1, '1654954561_Icon Strix.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_data_peminjaman`
--

CREATE TABLE `detail_data_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_data_peminjaman`
--

INSERT INTO `detail_data_peminjaman` (`id`, `id_peminjaman`, `id_barang`, `status`) VALUES
(14, 7, 8, 1),
(15, 7, 10, 1),
(17, 6, 8, 0),
(18, 6, 10, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_distribusi_barang`
--

CREATE TABLE `detail_distribusi_barang` (
  `id` int(11) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_distribusi_barang`
--

INSERT INTO `detail_distribusi_barang` (`id`, `id_distribusi`, `id_barang`) VALUES
(1, 1, 8),
(2, 1, 9),
(7, 5, 10),
(8, 5, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi_barang`
--

CREATE TABLE `distribusi_barang` (
  `id` int(11) NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `ruangan` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `distribusi_barang`
--

INSERT INTO `distribusi_barang` (`id`, `tanggal_distribusi`, `penanggung_jawab`, `ruangan`, `keterangan`, `status`) VALUES
(1, '2022-06-11', 'Nagato', 2, 'Dipakai untuk keperluan', 1),
(5, '2022-06-17', 'boy', 1, 'kanbdjhkasbdajhkbsj', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int(11) NOT NULL,
  `kondisi_barang` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi_barang`, `warna`) VALUES
(1, 'Baik', 'success'),
(2, 'Rusak', 'danger'),
(3, 'Sedang Dipinjam', 'warning'),
(4, 'Barang Distribusi', 'primary');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`) VALUES
(1, 'Gedung 1'),
(2, 'Gedung 2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pengguna`
--
ALTER TABLE `data_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_data_barang`
--
ALTER TABLE `detail_data_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_data_peminjaman`
--
ALTER TABLE `detail_data_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_distribusi_barang`
--
ALTER TABLE `detail_distribusi_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `distribusi_barang`
--
ALTER TABLE `distribusi_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_pengguna`
--
ALTER TABLE `data_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `detail_data_barang`
--
ALTER TABLE `detail_data_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_data_peminjaman`
--
ALTER TABLE `detail_data_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `detail_distribusi_barang`
--
ALTER TABLE `detail_distribusi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `distribusi_barang`
--
ALTER TABLE `distribusi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
