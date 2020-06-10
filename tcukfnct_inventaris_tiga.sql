-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Jun 2020 pada 09.32
-- Versi server: 10.3.23-MariaDB
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
(1, 'A001', '1', 'general', '2 orang', '1', '46', '-', '2020-01-07', '-', 'inventory-smkniu-200128-cab033640c.jpg', '2020-01-06 03:56:50', '2020-05-23 08:44:58', 'ready'),
(2, 'A002', '1', 'general', '2 orang', '1', '46', '-', '2020-01-16', '-', 'inventory-smkniu-200128-fcf99cc321.jpg', '2020-01-06 07:33:56', '2020-02-10 11:34:26', 'ready'),
(3, 'A005', '1', 'general', '2 orang', '1', '46', '-', '2020-01-08', '-', 'inventory-smkniu-200128-a3fedf522c.jpg', '2020-01-07 03:04:23', '2020-02-10 11:34:47', 'ready'),
(4, 'A004', '1', 'general', '2 orang', '1', '46', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-08a16613f0.jpg', '2020-01-28 12:07:17', '2020-02-10 11:35:04', 'ready'),
(5, 'A003', '2', 'general', 'personal', '1', '46', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-b931d03a66.jpg', '2020-01-28 12:09:19', '2020-02-10 11:35:31', 'ready'),
(6, 'A006', '1', 'general', '2 orang', '1', '46', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-f51a78414d.jpg', '2020-01-28 12:11:44', '2020-02-10 11:35:42', 'ready'),
(7, 'A007', '1', 'general', '2 orang', '1', '46', '-', '2019-12-25', 'Pemerintah', 'inventory-smkniu-200128-107bd73c47.jpg', '2020-01-28 12:19:46', '2020-02-10 11:35:58', 'ready'),
(8, 'OL001', '13', 'mikasa', 'Bola Sepak (Besar)', '1', '45', 'Blok Olahraga', '2019-11-22', 'Pemerintah', 'inventory-smkniu-200210-863e12ff87.jpg', '2020-02-10 11:27:08', '2020-02-10 11:31:24', 'ready'),
(10, 'G001', '10', 'ge', 'Tool kit PC', '1', '39', 'Rak 3', '2020-01-27', 'Pemerintah', NULL, '2020-02-10 11:33:16', '', 'ready'),
(11, 'OL003', '16', 'general', '-', '1', '45', 'blok olahraga', '2020-01-28', 'Pemerintah', 'inventory-smkniu-200210-e34366e23e.jpg', '2020-02-10 11:37:11', '', 'ready'),
(12, 'OL004', '16', 'general', '-', '1', '45', 'blok olahraga', '2020-01-28', 'Pemerintah', 'inventory-smkniu-200210-a63aa1639d.jpg', '2020-02-10 11:39:46', '', 'ready'),
(13, 'OL005', '15', 'general', '-', '1', '45', 'blok olahraga', '2020-01-28', 'Pemerintah', 'inventory-smkniu-200210-502ad829db.jpg', '2020-02-10 11:40:56', '', 'ready'),
(14, 'OL007', '16', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-91506f4271.jpg', '', '2020-02-12 17:05:27', 'ready'),
(15, 'OL006', '17', 'general', 'Bola futsal', '1', '45', 'blok', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-af2bc51d9b.jpg', '', '2020-02-12 17:03:53', 'ready'),
(26, 'OL008', '16', 'general', '-', '2', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-187eee2bf6.jpg', '2020-02-12 17:13:01', '', 'ready'),
(27, 'OL009', '16', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-6c786526d5.jpg', '2020-02-12 17:14:14', '', 'ready'),
(28, 'OL010', '16', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-d3f8981f5b.jpg', '2020-02-12 17:16:53', '', 'ready'),
(29, 'OL011', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-67a6fb278a.jpg', '2020-02-12 17:19:16', '', 'ready'),
(30, 'OL012', '18', 'general', '-', '1', '45', 'blok', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-2783e9e96c.jpg', '2020-02-12 17:21:13', '', 'ready'),
(31, 'OL013', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-b4386e4292.jpg', '2020-02-12 17:22:34', '', 'ready'),
(32, 'OL014', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-d3d7562316.jpg', '2020-02-12 17:25:18', '', 'ready'),
(33, 'OL015', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-88b4b68212.jpg', '2020-02-12 17:27:07', '', 'ready'),
(34, 'OL016', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-58000d771c.jpg', '2020-02-12 17:27:50', '', 'ready'),
(35, 'OL017', '18', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-8646f191bf.jpg', '2020-02-12 17:28:37', '', 'ready'),
(36, 'OL018', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-12b6423a5a.jpg', '2020-02-12 17:29:29', '', 'ready'),
(37, 'OL019', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-c080a9456f.jpg', '2020-02-12 17:29:49', '', 'ready'),
(38, 'OL020', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-11c2e57fdb.jpg', '2020-02-12 17:35:57', '', 'ready'),
(39, 'OL021', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-d82a5f4fd9.jpg', '2020-02-12 17:36:05', '', 'ready'),
(40, 'OL022', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-f9e1c3b513.jpg', '2020-02-12 17:36:12', '', 'ready'),
(41, 'OL023', '13', 'general', '-', '1', '45', 'blok olahraga', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200212-6e7a4026f1.jpg', '2020-02-12 17:36:18', '', 'ready'),
(42, 'AB002', '20', 'general', '-', '1', '39', 'lemari jaringan', '2020-01-29', 'Pemerintah', 'inventory-smkniu-200213-f2c8f89bb2.jpg', '2020-02-13 10:54:34', '', 'ready');

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
(4, 'Kursi'),
(6, 'Proyektor'),
(7, 'Router'),
(8, 'Access Point'),
(9, 'Kabel Olor'),
(10, 'Tool Kit'),
(11, 'Harddisk'),
(12, 'PC (Satuan)'),
(13, 'Bola Sepak (Besar)'),
(15, 'Matras'),
(16, 'Lembing'),
(17, 'Bola (Futsal)'),
(18, 'Bola (Takraw)'),
(20, 'Router');

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
(1, 'Baik'),
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
(44, 'Gudang TKR'),
(45, 'Gudang Induk'),
(46, 'Kelas X TKJ 1'),
(47, 'Kelas X TKJ 2'),
(48, 'Kelas XI TKJ 1'),
(49, 'Kelass XII TKJ 2'),
(50, 'Kelas X AK 1'),
(51, 'Kelas X INKA 1'),
(53, 'Gudang Akuntansi');

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
  `status` enum('addlist','pinjam','finishlist','kembali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(41, 'D2122', 'yusuf nur fauzi', 'yusuf', '$2y$10$d8J5yLL8JSW0aODebtPxJOtjZfk3ukbngdUxFeN8jKZGb9nYcdyda', 'default.png', 2, 1, 1581414594),
(44, 'AD12', 'Admin', 'admin', '$2y$10$e1ngtclreTENSIjiRVUSiebUAa/bMZnzGrENYt9IDqzd69iz8LQny', 'default.png', 1, 1, 1591669747);

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
(19, 2, 5),
(21, 1, 5),
(22, 2, 6),
(23, 1, 6),
(26, 1, 4);

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
  `password` varchar(128) NOT NULL,
  `token` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_pjm`
--

INSERT INTO `user_pjm` (`id`, `name`, `nis`, `kelas`, `username`, `password`, `token`) VALUES
(25, 'Abdul Basyit Aly', 'aku', 'TKJ 2', 'basyit', 'aku', 'cB6wtxi5zeo:APA91bEh6XYex0qo5jJTw9M09BMZPZkAf0mcgfvDzc0eu2vsMOYW3IVzaEqc39xJ4Lw9uIzybD8fvkLjbozbKmHT_QHcmW3MgkgfUNzMU6TwMYthsbxeYWRBne6TCz9Cnlul9xQgAy_d'),
(26, 'Fahmi', '202020', 'X TKJ 1', 'fahmi', 'fahmi', 'd89fxc1_hP0:APA91bHVY2y8Wcm7-fqGgZFevF7IYc87FdavFa1idhI2h4r-rM5dHqVsri254iG_HeAUJj06NyNGs_WvtH3MbmTtZC7l1XMvMBrac2LW-EAW3f2d7_R212thQp6OknYcw3QyoWjrxsyM'),
(33, 'Mahardka', '211212', 'X TKJ 2', 'dika', 'dika', 'feBgwnAtPK0:APA91bHxN39wC7ufyyl5Fv7MLDJqktzbRStY7FI5g8q1Y_rJPeA-CI25aPks1MhNse5EaWoFD990EOb9PHIZ9JXOSwG8p7PqCNlk3Ul7SaRp38e2OD_Gf3NPjBnpDOFcz_cg53KhuoF5');

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
(2, 'Member');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `barang_kategori`
--
ALTER TABLE `barang_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `barang_kondisi`
--
ALTER TABLE `barang_kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `barang_lokasi`
--
ALTER TABLE `barang_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_temp`
--
ALTER TABLE `pengembalian_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_pjm`
--
ALTER TABLE `user_pjm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
