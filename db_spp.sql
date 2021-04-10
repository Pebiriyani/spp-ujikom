-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2021 pada 04.35
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(1, 'XII', 'Rekayasa Perangkat Lunak'),
(2, 'XII', 'administrasi perkantoran'),
(3, 'XII', 'teknik komputer jaringan'),
(4, 'XI', 'rekayasa perangkat lunak'),
(5, 'XI', 'administrasi perkantoran'),
(6, 'XI', 'teknik komputer jaringan'),
(7, 'X', 'Rekayasa Perangkat Lunak'),
(8, 'X', 'teknik komputer jaringan'),
(9, 'X', 'administrasi perkantoran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(10) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
(36, 15, '0034667777', '2021-04-08', 'agustus', '2019', 1, 400000),
(48, 11, '0034667777', '2021-04-08', 'september', '2019', 1, 400000),
(49, 15, '0034667777', '2021-04-08', 'oktober', '2019', 1, 400000),
(60, 11, '0034667777', '2021-04-08', 'februari', '2019', 1, 400000),
(67, 15, '0034667777', '2021-04-09', 'juni', '2019', 1, 400000),
(71, 11, '0034667777', '2021-04-09', 'mei', '2019', 1, 400000),
(72, 15, '0034667777', '2021-04-09', 'maret', '2020', 1, 400000),
(73, 15, '0034667777', '2021-04-09', 'januari', '2019', 1, 400000),
(75, 11, '0034667777', '2021-04-09', 'april', '2020', 1, 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(11, 'pebiriyani', '$2y$10$QjdG5siBwvbwT8fEdX6AvuQ1B5F.YaSTHLLtSQy1AFcuve/SyW3xS', 'pebi riyani', 'admin'),
(15, 'pebi', '$2y$10$yDWOZ/QaG/oYOElfhUIKi.UwPP/5005heZaLoJjI83rvG/EnsEqDK', 'pebi', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(10) DEFAULT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) DEFAULT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`, `gambar`) VALUES
('0023585670', '1819.10030', 'Alma Damayanti', 1, 'Bandung', '088563729383', 1, 'user3.png'),
('002457383', '1819.10031', 'Citra Ananda', 8, 'Bandung', '085864157364', 1, 'J_08_P_CITRA_ANANDA.jpg'),
('0024666777', '1819.10034', 'Ajeng Sonia', 6, 'Bandung', '085864157233', 2, 'D_06_P_AJENG_SONIA_GUSTIAN.jpg'),
('0025617057', '1819.10029', 'Kirani Rizkya Desta', 1, 'Bandung', '0882374292381', 1, 'user2.png'),
('0032963806', '1819.10028', 'Yesica Anggraeni', 1, 'Bandung', '08817829474', 1, 'user1.png'),
('0033378825', '1819.10035', 'Maya Gita', 1, 'Bandung', '087637237928', 1, 'user4.png'),
('00344445', '1819.10036', 'Muhammad Dimas', 3, 'Bandung', '085864157222', 3, 'Muhammad_Dimas.jpg'),
('0034662222', '1819.10032', 'Syifa Khairunnisa', 2, 'Bandung', '08586415732', 2, 'J_28_P_SYIFA_KHAIRUNNISA.jpg'),
('0034667000', '1819.10042', 'Reysa Rahmat', 4, 'Bandung', '085864157233', 1, 'rasyha_rahmat.jpg'),
('0034667111', '1819.10039', 'Agung Gunawan', 3, 'Bandung', '088273828364', 1, 'Agung_Gunawan.jpg'),
('0034667343', '1819.10041', 'Lingga Anggara', 1, 'Bandung', '085864157222', 1, 'lingga_anggara.jpg'),
('0034667545', '1819.10040', 'Aldisar Nauval', 1, 'Bandung', '08928372938', 1, 'Aldisar_Nauval.jpg'),
('0034667722', '1819.10033', 'Tiara Marlina', 2, 'Bandung', '085864157223', 2, 'J_29_P_TIARA_MARLINA.jpg'),
('0034667766', '1819.10037', 'Raka Imam', 3, 'Bandung', '089864157215', 2, 'Raka_imam.jpg'),
('0034667777', '1819.10026', 'Pebi Riyani', 1, 'Bandung', '085864157215', 3, 'pebi.jpg'),
('0034667999', '1819.10043', 'Rahman Somantri', 8, 'Bandung', '08586415333', 1, 'rahman_somantri.jpg'),
('0034671010', '1819.10038', 'Reyhan Utama', 3, 'Bandung', '085413357215', 2, 'reyhan_utama.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2020, 500000),
(2, 2021, 400000),
(3, 2019, 400000);

--
-- Trigger `spp`
--
DELIMITER $$
CREATE TRIGGER `updt_nominal` AFTER UPDATE ON `spp` FOR EACH ROW begin
if old.nominal <> new.nominal then
insert into tb_updt_nominal values ('',new.tahun,old.nominal,new.nominal,now(),new.id_spp);
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_updt_nominal`
--

CREATE TABLE `tb_updt_nominal` (
  `id_updt` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `harga_lama` int(11) DEFAULT NULL,
  `harga_baru` int(11) DEFAULT NULL,
  `tgl_update` date DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_updt_nominal`
--

INSERT INTO `tb_updt_nominal` (`id_updt`, `tahun`, `harga_lama`, `harga_baru`, `tgl_update`, `id`) VALUES
(1, 2020, 400000, 500000, '2021-04-09', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `siswa_ibfk_1` (`id_spp`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indeks untuk tabel `tb_updt_nominal`
--
ALTER TABLE `tb_updt_nominal`
  ADD PRIMARY KEY (`id_updt`),
  ADD KEY `tb_updt_nominal_ibfk_1` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_updt_nominal`
--
ALTER TABLE `tb_updt_nominal`
  MODIFY `id_updt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_updt_nominal`
--
ALTER TABLE `tb_updt_nominal`
  ADD CONSTRAINT `tb_updt_nominal_ibfk_1` FOREIGN KEY (`id`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
