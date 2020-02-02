-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Feb 2020 pada 10.44
-- Versi server: 10.3.22-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcukfnct_inventaris_tiga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activation`
--

CREATE TABLE `activation` (
  `id` int(11) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `activation`
--

INSERT INTO `activation` (`id`, `active`) VALUES
(1, 'Y'),
(2, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `barcode` varchar(128) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `merk` varchar(128) NOT NULL,
  `model` varchar(128) NOT NULL,
  `id_kondisi` varchar(128) NOT NULL,
  `id_lokasi` varchar(128) NOT NULL,
  `dtl_lokasi` text NOT NULL,
  `tgl_masuk` varchar(128) DEFAULT NULL,
  `sumber` varchar(128) NOT NULL,
  `gambar` varchar(128) DEFAULT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `status` set('ready','pinjam','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `barcode`, `nama_barang`, `merk`, `model`, `id_kondisi`, `id_lokasi`, `dtl_lokasi`, `tgl_masuk`, `sumber`, `gambar`, `created`, `updated`, `status`) VALUES
(1, 'A001', '1', 'general', '-', '1', '31', '-', '2020-01-07', '-', 'inventory-smkniu-200128-cab033640c.jpg', '2020-01-06 03:56:50', '2020-01-28 12:14:03', 'ready'),
(2, 'A002', '1', 'general', '-', '1', '31', '-', '2020-01-16', '-', 'inventory-smkniu-200128-fcf99cc321.jpg', '2020-01-06 07:33:56', '2020-01-28 12:13:28', 'ready'),
(3, 'A005', '1', 'general', '-', '1', '31', '-', '2020-01-08', '-', 'inventory-smkniu-200128-a3fedf522c.jpg', '2020-01-07 03:04:23', '2020-01-28 12:14:24', 'ready'),
(4, 'A004', '1', 'general', '-', '1', '31', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-08a16613f0.jpg', '2020-01-28 12:07:17', '2020-01-28 12:15:58', 'ready'),
(5, 'A003', '2', 'general', '-', '1', '31', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-b931d03a66.jpg', '2020-01-28 12:09:19', '', 'ready'),
(6, 'A006', '1', 'general', '-', '1', '31', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-f51a78414d.jpg', '2020-01-28 12:11:44', '', 'ready'),
(7, 'A007', '1', 'general', '-', '1', '31', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-107bd73c47.jpg', '2020-01-28 12:19:46', '', 'ready');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_kategori`
--

CREATE TABLE `barang_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_kategori`
--

INSERT INTO `barang_kategori` (`id`, `kategori`) VALUES
(1, 'Meja Siswa'),
(2, 'Meja Guru'),
(3, 'Kursi siswa'),
(4, 'Kursi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_kondisi`
--

CREATE TABLE `barang_kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_kondisi`
--

INSERT INTO `barang_kondisi` (`id`, `kondisi`) VALUES
(1, 'Baru'),
(2, 'Rusak'),
(3, 'Perbaikan'),
(4, 'Tidak terpakai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_lokasi`
--

CREATE TABLE `barang_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_lokasi`
--

INSERT INTO `barang_lokasi` (`id`, `lokasi`) VALUES
(31, 'Gudang Akuntansi'),
(32, 'Gudang INKA'),
(39, 'Gudang TKJ'),
(40, 'Gudang Multimedia'),
(41, 'Kelas XII TKJ 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `barcode` varchar(128) NOT NULL,
  `id_user_pjm` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tgl_aju_kembali` datetime NOT NULL,
  `id_admin` varchar(128) NOT NULL,
  `id_admin_kembali` varchar(128) NOT NULL,
  `keperluan` text NOT NULL,
  `status` enum('addlist','pinjam','finishlist','kembali') NOT NULL,
  `denda` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `kode`, `barcode`, `id_user_pjm`, `tgl_pinjam`, `tgl_kembali`, `tgl_aju_kembali`, `id_admin`, `id_admin_kembali`, `keperluan`, `status`, `denda`) VALUES
(14, 'INV-00000001', 'A001', 25, '2020-01-22 00:00:00', '2020-01-27 18:27:25', '2020-01-23 00:00:00', 'D220', '21', 'coba', 'kembali', '0'),
(15, 'INV-00000001', 'A002', 25, '2020-01-22 00:00:00', '0000-00-00 00:00:00', '2020-01-23 00:00:00', 'D220', '25', 'coba', 'pinjam', '0'),
(16, 'INV-002', 'A005', 26, '2020-01-22 00:00:00', '2020-01-27 11:42:42', '2020-01-26 00:00:00', 'D002', 'D220', 'aku', 'kembali', '0'),
(17, 'INV-20200127183126', 'A001', 25, '2020-01-27 18:32:02', '2020-01-27 18:35:26', '2020-01-26 18:31:00', 'D220', 'D220', 'kkk', 'kembali', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_temp`
--

CREATE TABLE `peminjaman_temp` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `id_user_pjm` int(11) NOT NULL,
  `barcode` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman_temp`
--

INSERT INTO `peminjaman_temp` (`id`, `kode`, `id_user_pjm`, `barcode`) VALUES
(20, 'INV-20200128123654', 25, 'A001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_temp`
--

CREATE TABLE `pengembalian_temp` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `id_user_pjm` int(11) NOT NULL,
  `barcode` varchar(128) NOT NULL,
  `denda` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian_temp`
--

INSERT INTO `pengembalian_temp` (`id`, `kode`, `id_user_pjm`, `barcode`, `denda`) VALUES
(22, 'INV-00000001', 25, 'A002', '10000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_admin` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_admin`, `name`, `username`, `password`, `image`, `role_id`, `is_active`, `date_created`) VALUES
(21, 'D220', 'Abdul Basyit A', 'aly', '$2y$10$2.lme21DHNSY5p0LibxkpefyKifXXX4QLhslQPcBUulb/ntcCzgm.', 'aku1.jpg', 1, 1, 1564976208),
(28, 'D110', 'Admin', 'admin', '$2y$10$t/fwhVAMJJkeDXm7eh6eTuwdSHV7.kedFOuD3lH/ERpQn.ckwdWn2', 'default.png', 1, 1, 1570510553),
(39, 'D112', 'Abdul Basyit Aly', 'abdul', '$2y$10$kjokf3RNPiA9SsNayANDru04hpEySgAyC7ZmcbG5B.f7bjClXV5jK', 'default.png', 2, 2, 1572057098);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(9, 1, 3),
(16, 2, 3),
(18, 3, 6),
(19, 2, 5),
(21, 1, 5),
(22, 2, 6),
(23, 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `ikon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `ikon`) VALUES
(2, 'Admin', 'fas fa-fw fa-user-cog'),
(3, 'User', 'fas fa-fw fa-user'),
(4, 'Menu', 'fas fa-fw fa-list'),
(5, 'Inventory', 'fas fa-fw fa-warehouse'),
(6, 'Peminjaman', 'fas fa-fw fa-handshake');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pjm`
--

CREATE TABLE `user_pjm` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `nis` varchar(128) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_pjm`
--

INSERT INTO `user_pjm` (`id`, `name`, `nis`, `kelas`, `username`, `password`) VALUES
(25, 'Abdul Basyit Aly', 'aku', 'TKJ 2', 'basyit', 'aku'),
(26, 'saya', '123', 'D1', 'saya', 'saya'),
(27, 'siswa', 'S-1010', 'TKJ 2', 's-1010', 's-1010'),
(28, 'yogi', '1233', 'xtkj', 'yogi', 'yogi123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 3, 'My Profile', 'User', 'fas fa-fw fa-user', 1),
(4, 4, 'Menu', 'Menu', 'fas fa-fw fa-folder', 1),
(5, 4, 'Submenu', 'Menu/submenu', 'fas fa-fw fa-folder-open', 1),
(11, 2, 'Role', 'Admin/role', 'fas fa-fw fa-user-tie', 1),
(15, 5, 'Kelola Barang', 'Barang', 'fas fa-fw fa-table', 1),
(16, 5, 'Kelola Lokasi', 'Lokasi', 'fas fa-fw fa-map-marked', 1),
(19, 2, 'Kelola User', 'Admin/kelolauser', 'fas fa-fw fa-users-cog', 1),
(22, 5, 'Kelola Kondisi', 'Kondisi', 'fas fa-fw fa-cart-plus', 1),
(25, 5, 'Kategori', 'Kategori', 'fas fa-fw fa-network-wired', 2),
(27, 6, 'Kelola Peminjam', 'User_pjm', 'fas fa-fw fa-user-tie', 1),
(28, 6, 'Peminjaman', 'Peminjaman', 'far fa-fw fa-handshake', 1),
(30, 6, 'Pengembalian', 'Peminjaman/kembali', 'fas fa-fw fa-exchange-alt', 1),
(31, 5, 'Kategori Barang', 'Kategori', 'fas fa-fw fa-network-wired', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_kategori`
--
ALTER TABLE `barang_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_kondisi`
--
ALTER TABLE `barang_kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_lokasi`
--
ALTER TABLE `barang_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_pjm` (`id_user_pjm`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `kode` (`kode`);

--
-- Indeks untuk tabel `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_pjm` (`id_user_pjm`),
  ADD KEY `barcode` (`barcode`);

--
-- Indeks untuk tabel `pengembalian_temp`
--
ALTER TABLE `pengembalian_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_pjm` (`id_user_pjm`),
  ADD KEY `barcode` (`barcode`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `is_active` (`is_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_pjm`
--
ALTER TABLE `user_pjm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activation`
--
ALTER TABLE `activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `barang_kategori`
--
ALTER TABLE `barang_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang_kondisi`
--
ALTER TABLE `barang_kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `barang_lokasi`
--
ALTER TABLE `barang_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_temp`
--
ALTER TABLE `pengembalian_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_pjm`
--
ALTER TABLE `user_pjm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user_pjm`) REFERENCES `user_pjm` (`id`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  ADD CONSTRAINT `peminjaman_temp_ibfk_1` FOREIGN KEY (`id_user_pjm`) REFERENCES `user_pjm` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_temp`
--
ALTER TABLE `pengembalian_temp`
  ADD CONSTRAINT `pengembalian_temp_ibfk_1` FOREIGN KEY (`id_user_pjm`) REFERENCES `user_pjm` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`is_active`) REFERENCES `activation` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
