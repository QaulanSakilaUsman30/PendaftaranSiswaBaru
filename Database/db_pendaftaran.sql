-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2025 pada 14.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pendaftaran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasi`
--

CREATE TABLE `administrasi` (
  `ID_BAYAR` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_BANK` varchar(11) NOT NULL,
  `BUKTI_TRANSFER` varchar(100) NOT NULL,
  `TIPE` enum('CASH','TRANSFER') NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `JUMLAH_BIAYA` int(20) NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `administrasi`
--

INSERT INTO `administrasi` (`ID_BAYAR`, `ID_SISWA`, `NAMA_BANK`, `BUKTI_TRANSFER`, `TIPE`, `TGL_BUAT`, `JUMLAH_BIAYA`, `TGL_UBAH`) VALUES
(10, 19, 'VGHJK', '', 'TRANSFER', '2025-06-24 14:10:54', 12345, '2025-06-24 12:13:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataadmin`
--

CREATE TABLE `dataadmin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(20) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `TELEPON` varchar(20) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `GAMBAR` varchar(100) NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dataadmin`
--

INSERT INTO `dataadmin` (`ID_ADMIN`, `NAMA_ADMIN`, `USERNAME`, `TELEPON`, `PASSWORD`, `GAMBAR`, `TGL_BUAT`, `TGL_UBAH`) VALUES
(3, 'Admin', 'admin', '082191208347', '21232f297a57a5a743894a0e4a801fc3', 'Best 111+ Anime Profile Pictures 35.jpg', '2025-05-17 15:26:27', '2025-05-22 05:53:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataortu_wali`
--

CREATE TABLE `dataortu_wali` (
  `ID_ORTU_WALI` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_AYAH` varchar(30) NOT NULL,
  `TEMPAT_LAHIR_AYAH` varchar(20) NOT NULL,
  `TGL_LAHIR_AYAH` date NOT NULL,
  `AGAMA_AYAH` enum('Islam','Kristen Prostestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_AYAH` varchar(20) NOT NULL,
  `PEKERJAAN_AYAH` varchar(30) NOT NULL,
  `ALAMAT_RUMAH_AYAH` text NOT NULL,
  `KODE_POS_AYAH` int(5) NOT NULL,
  `TELEPON_AYAH` varchar(15) NOT NULL,
  `NAMA_IBU` varchar(30) NOT NULL,
  `TEMPAT_LAHIR_IBU` varchar(20) NOT NULL,
  `TGL_LAHIR_IBU` date NOT NULL,
  `AGAMA_IBU` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_IBU` varchar(20) NOT NULL,
  `PEKERJAAN_IBU` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_IBU` text NOT NULL,
  `KODE_POS_IBU` int(5) NOT NULL,
  `TELEPON_IBU` varchar(15) NOT NULL,
  `NAMA_WALI` varchar(20) NOT NULL,
  `TEMPAT_LAHIR_WALI` varchar(20) NOT NULL,
  `TGL_LAHIR_WALI` date NOT NULL,
  `AGAMA_WALI` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `PENDIDIKAN_TERAKHIR_WALI` varchar(20) NOT NULL,
  `PEKERJAAN_WALI` varchar(20) NOT NULL,
  `ALAMAT_RUMAH_WALI` text NOT NULL,
  `KODE_POS_WALI` int(5) NOT NULL,
  `TELEPON_WALI` varchar(15) NOT NULL,
  `HUBUNGAN_WALI` varchar(20) NOT NULL,
  `TGL_BUAT1` datetime NOT NULL,
  `TGL_UBAH1` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasiswa`
--

CREATE TABLE `datasiswa` (
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_LENGKAP` text NOT NULL,
  `NAMA_PANGGILAN` text NOT NULL,
  `TEMPAT_LAHIR` varchar(20) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `JENIS_KELAMIN` enum('Laki - Laki','Perempuan') NOT NULL,
  `TINGGI_BADAN` varchar(4) NOT NULL,
  `BERAT_BADAN` varchar(3) NOT NULL,
  `PANJANG_TANGAN` varchar(4) NOT NULL,
  `PANJANG_KAKI` varchar(4) NOT NULL,
  `AGAMA` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu') NOT NULL,
  `ALAMAT_RUMAH` text NOT NULL,
  `KODE_POS_RUMAH` varchar(5) NOT NULL,
  `TELEPON_RUMAH` varchar(15) NOT NULL,
  `ASAL_SEKOLAH` text NOT NULL,
  `KELAS_JURUSAN` varchar(20) NOT NULL,
  `ALAMAT_SEKOLAH` text NOT NULL,
  `KODE_POS_SEKOLAH` varchar(5) NOT NULL,
  `TELEPON_SEKOLAH` varchar(15) NOT NULL,
  `HOBI` varchar(15) NOT NULL,
  `TGL_BUAT` datetime NOT NULL,
  `TGL_UBAH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` enum('BELUM DIVERIFIKASI','DITOLAK','DIVERIFIKASI','') NOT NULL,
  `KETERAMPILAN_KHUSUS` varchar(20) NOT NULL,
  `PENGHARGAAN_SEKOLAH` varchar(20) NOT NULL,
  `PENGHARGAAN_KECAMATAN` varchar(20) NOT NULL,
  `PENGHARGAAN_KAB_KOTA` varchar(20) NOT NULL,
  `PENGHARGAAN_PROVINSI` varchar(20) NOT NULL,
  `PENGHARGAAN_NASIONAL` varchar(20) NOT NULL,
  `PENGHARGAAN_INTERNASIONAL` varchar(20) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `NOMOR_PENDAFTARAN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datasiswa`
--

INSERT INTO `datasiswa` (`ID_SISWA`, `NAMA_LENGKAP`, `NAMA_PANGGILAN`, `TEMPAT_LAHIR`, `TGL_LAHIR`, `JENIS_KELAMIN`, `TINGGI_BADAN`, `BERAT_BADAN`, `PANJANG_TANGAN`, `PANJANG_KAKI`, `AGAMA`, `ALAMAT_RUMAH`, `KODE_POS_RUMAH`, `TELEPON_RUMAH`, `ASAL_SEKOLAH`, `KELAS_JURUSAN`, `ALAMAT_SEKOLAH`, `KODE_POS_SEKOLAH`, `TELEPON_SEKOLAH`, `HOBI`, `TGL_BUAT`, `TGL_UBAH`, `STATUS`, `KETERAMPILAN_KHUSUS`, `PENGHARGAAN_SEKOLAH`, `PENGHARGAAN_KECAMATAN`, `PENGHARGAAN_KAB_KOTA`, `PENGHARGAAN_PROVINSI`, `PENGHARGAAN_NASIONAL`, `PENGHARGAAN_INTERNASIONAL`, `USERNAME`, `PASSWORD`, `NOMOR_PENDAFTARAN`) VALUES
(19, 'dfvb', 'dfv', 'sd', '2002-02-02', 'Perempuan', '2345', '234', '23', '234', 'Kristen Protestan', 'df', 'sdf', 'edfg', 'asdf', 'asd', 'asd', 'sd', 'asdc', '', '2025-06-24 13:33:10', '2025-06-24 04:39:17', 'BELUM DIVERIFIKASI', '', '', '', '', '', '', '', '123', '123', 'PSB20250001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `ID_DOKUMEN` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `AKTA` varchar(100) NOT NULL,
  `KARTU_KELUARGA` varchar(100) NOT NULL,
  `IJAZAH` varchar(100) NOT NULL,
  `SKL` varchar(100) NOT NULL,
  `BUKU_PIP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`ID_BAYAR`),
  ADD KEY `fk_siswa_bayar` (`ID_SISWA`);

--
-- Indeks untuk tabel `dataadmin`
--
ALTER TABLE `dataadmin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indeks untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  ADD PRIMARY KEY (`ID_ORTU_WALI`),
  ADD UNIQUE KEY `UNIQUE_SISWA` (`ID_SISWA`);

--
-- Indeks untuk tabel `datasiswa`
--
ALTER TABLE `datasiswa`
  ADD PRIMARY KEY (`ID_SISWA`),
  ADD UNIQUE KEY `NOMOR_PENDAFTARAN` (`NOMOR_PENDAFTARAN`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`ID_DOKUMEN`),
  ADD KEY `fk_siswa_dokumen` (`ID_SISWA`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  MODIFY `ID_BAYAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `dataadmin`
--
ALTER TABLE `dataadmin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  MODIFY `ID_ORTU_WALI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `datasiswa`
--
ALTER TABLE `datasiswa`
  MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `administrasi`
--
ALTER TABLE `administrasi`
  ADD CONSTRAINT `fk_siswa_bayar` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dataortu_wali`
--
ALTER TABLE `dataortu_wali`
  ADD CONSTRAINT `fk_siswa_ortu` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `fk_siswa_dokumen` FOREIGN KEY (`ID_SISWA`) REFERENCES `datasiswa` (`ID_SISWA`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
