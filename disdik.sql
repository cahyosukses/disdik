-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.1.0.4886
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for disdik
CREATE DATABASE IF NOT EXISTS `disdik` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `disdik`;


-- Dumping structure for table disdik.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `u` varchar(15) NOT NULL,
  `p` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `menu_list` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='1 = administrator\r\n2 = cuman bisa post berita';

-- Dumping data for table disdik.admin: ~2 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `u`, `p`, `nama`, `email`, `level`, `menu_list`, `aktif`, `terhapus`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin@admin.com', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 'Y', 'N'),
	(2, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user poster berita', '', '2', '1,6,7,8,9,23,24', 'Y', 'N');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Dumping structure for table disdik.aduan
CREATE TABLE IF NOT EXISTS `aduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(50) NOT NULL,
  `nama_pengadu` varchar(50) NOT NULL,
  `email_pengadu` varchar(50) NOT NULL,
  `judul_program` varchar(50) NOT NULL,
  `tgl_tayang_program` date NOT NULL,
  `jam_tayang_program` varchar(50) NOT NULL,
  `stasiun_program` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.aduan: ~0 rows (approximately)
DELETE FROM `aduan`;
/*!40000 ALTER TABLE `aduan` DISABLE KEYS */;
INSERT INTO `aduan` (`id`, `topik`, `nama_pengadu`, `email_pengadu`, `judul_program`, `tgl_tayang_program`, `jam_tayang_program`, `stasiun_program`, `pesan`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 'topik aduan', 'nama pengadu', 'email@pengadu.com', 'judul program', '0000-00-00', '12.00 WIB', 'stasiun', 'pesan', 'Y', '2015-03-14 12:15:39', '2015-03-15 02:42:54'),
	(2, 'test topik', 'nama pengadu', 'email@pengadu.com', 'judul', '2014-01-01', '12.00WIB', 'indosiar', 'ini pesan', 'Y', '2015-03-14 18:09:08', '2015-03-15 02:42:55');
/*!40000 ALTER TABLE `aduan` ENABLE KEYS */;


-- Dumping structure for table disdik.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `ket` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.agenda: ~2 rows (approximately)
DELETE FROM `agenda`;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` (`id`, `tgl`, `ket`, `tempat`) VALUES
	(2, '2015-02-13', 'Pengajian', 'Aula Lantai 3 Dinas Pendidikan'),
	(3, '2015-02-17', 'Upacara', 'Dinas Pendidikan Provinsi Jambi');
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;


-- Dumping structure for table disdik.apresiasi
CREATE TABLE IF NOT EXISTS `apresiasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(50) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `email_pengirim` varchar(50) NOT NULL,
  `judul_program` varchar(50) NOT NULL,
  `tgl_tayang_program` date NOT NULL,
  `jam_tayang_program` varchar(50) NOT NULL,
  `stasiun_program` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.apresiasi: ~0 rows (approximately)
DELETE FROM `apresiasi`;
/*!40000 ALTER TABLE `apresiasi` DISABLE KEYS */;
INSERT INTO `apresiasi` (`id`, `topik`, `nama_pengirim`, `email_pengirim`, `judul_program`, `tgl_tayang_program`, `jam_tayang_program`, `stasiun_program`, `pesan`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 'topik apresiasi', 'nama pengirim', 'email@pengirim.com', 'judul program', '0000-00-00', '12.00 WIB', 'stasiun program', 'pesan apresiasi', 'Y', '2015-03-14 12:28:02', '2015-03-31 08:21:30'),
	(2, '12345678901234567890123456789012345678901234567890', 'nama pengirim', '', 'judul', '2014-01-01', '12.00WIB', 'indosiar', 'xxxx', 'Y', '2015-03-14 18:12:07', '2015-03-31 08:43:56');
/*!40000 ALTER TABLE `apresiasi` ENABLE KEYS */;


-- Dumping structure for table disdik.berita
CREATE TABLE IF NOT EXISTS `berita` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `isi` mediumtext NOT NULL,
  `hits` int(4) NOT NULL,
  `tglPost` datetime NOT NULL,
  `kategori` varchar(75) NOT NULL,
  `oleh` varchar(30) NOT NULL,
  `publish` int(1) NOT NULL,
  `sticky` enum('Y','N') NOT NULL DEFAULT 'N',
  `slideshow` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.berita: ~12 rows (approximately)
DELETE FROM `berita`;
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` (`id`, `judul`, `gambar`, `file_name`, `isi`, `hits`, `tglPost`, `kategori`, `oleh`, `publish`, `sticky`, `slideshow`) VALUES
	(4, 'Tim Pengembang Konten', '2c96e38076226f2b6feca07869aeeb98.jpg', '', '<p>tim pengembangn</p>', 193, '2012-12-30 23:46:06', '3', 'Hely Kurniawan', 1, 'Y', 'Y'),
	(5, 'Jambi expo', '', '', 'jambi expo 2015<br>', 6, '2015-10-07 12:08:59', '3-', 'Hely Kurniawan', 1, 'N', 'N'),
	(6, 'Kerja bakti', '', '', 'kerja bakti<br>', 1, '2012-10-07 12:09:10', '3-', 'Hely Kurniawan', 1, 'N', 'N'),
	(10, 'Seminar', '', '', 'seminar', 0, '2012-12-30 23:39:31', '2-', 'admin', 1, 'N', 'N'),
	(11, 'Kunjungan Ke sekolah', '', '', 'kunjungan', 18, '2012-12-30 23:40:24', '1-', 'admin', 1, 'N', 'N'),
	(12, 'Halal bihalal', '', '', '<p>halal bihalal</p>', 2, '2012-12-30 23:41:39', '3', 'admin', 1, 'N', 'N'),
	(13, 'Pameran ', 'a19aed3c7798d673f999c9677d32cc3a.jpg', '', '<p>pameran</p>', 18, '2012-12-30 23:42:26', '1', 'admin', 1, 'N', 'N'),
	(14, 'Sosialisai', 'Rooney_Goal.jpg', '', 'sosialisasi', 23, '2012-12-30 23:43:16', '2-', 'admin', 1, 'N', 'N'),
	(15, 'Kegiatan Pelatihan TIK', '', '', 'PELATIHAN', 0, '2012-12-30 23:44:59', '3-', 'admin', 1, 'N', 'N'),
	(16, 'Beasiswa 2015', '70b4f9ce5812e63cbb6a98ae06275085.jpg', '', '<p>Info beasiswa</p>', 7, '2012-12-30 23:45:29', '2', 'admin', 1, 'N', 'Y'),
	(17, 'Kegiatan HUT KE-58 Provinsi Jambi', 'IMG_4432.JPG', '', '<div><strong>Bola.net </strong>- Ketika beberapa klub sudah antusias bersiap menyambut jendela transfer musim dingin guna memperkuat diri, Sir Alex Ferguson malah kalem.</div>\n<div>&nbsp;</div>\n<div>Gaffer Manchester United itu mengaku tidak pernah suka dengan penambahan amunisi di tengah musim, dan ia punya alasan tersendiri akan hal tersebut.</div>\n<div>&nbsp;</div>\n<div>"Bursa transfer Januari tidak pernah menjadi bursa transfer terbaik dan itu telah terbukti selama bertahun-tahun dengan sangat sedikitnya transfer-transfer besar terjadi," ucapnya.</div>\n<div>&nbsp;</div>\n<div>Fergie mengacu pada kondisi beberapa tahun terakhir, ketika sangat jarang terjadi pembelian-pembelian yang sukses pada Januari.</div>\n<div>&nbsp;</div>\n<div>Justru yang lebih sering terjadi adalah pembelian pemain dengan biaya besar namun tidak sukses di kemudian hari.</div>\n<div>&nbsp;</div>\n<div>Hasilnya, kemungkinan klub-klub panik dengan prospek memiliki tim yang tidak maksimal sampai Mei dengan sekelompok pemain yang gagal memenuhi harapan.</div>\n<div>&nbsp;</div>\n<div>"Semua transfer besar terjadi pada musim panas," imbuh pria yang sudah bekerja di Old Trafford sejak 26 tahun silam tersebut. (dym/lex)</div>', 41, '2012-11-30 23:46:06', '2', 'admin', 1, 'N', 'Y'),
	(26, 'framework xxx', 'ac45e60c6e330951aab8faba1c0d8303.jpg', '601baceeb1b9ae63765b073c6e3666c4.pdf', '<p>sasa</p>', 34, '2015-03-03 00:32:44', '1-2', 'admin', 1, 'N', 'Y');
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;


-- Dumping structure for table disdik.berita_komen
CREATE TABLE IF NOT EXISTS `berita_komen` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_berita` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `komentar` varchar(250) NOT NULL,
  `tgl` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.berita_komen: ~2 rows (approximately)
DELETE FROM `berita_komen`;
/*!40000 ALTER TABLE `berita_komen` DISABLE KEYS */;
INSERT INTO `berita_komen` (`id`, `id_berita`, `nama`, `email`, `komentar`, `tgl`) VALUES
	(1, 4, 'xxx', 'xxx@xxx.com', 'xxxx <b>test</b>', '2015-03-04 14:21:31'),
	(2, 4, 'xxx', 'xxx@xxx.com', 'isi pesan [removed]alert&#40;\'test\'&#41;[removed]', '2015-03-04 14:23:03');
/*!40000 ALTER TABLE `berita_komen` ENABLE KEYS */;


-- Dumping structure for table disdik.data_guru
CREATE TABLE IF NOT EXISTS `data_guru` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_sekolah` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nuptk` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `jk` enum('l','p') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_guru: ~2 rows (approximately)
DELETE FROM `data_guru`;
/*!40000 ALTER TABLE `data_guru` DISABLE KEYS */;
INSERT INTO `data_guru` (`id`, `id_sekolah`, `nip`, `nuptk`, `nama`, `status`, `mapel`, `jk`, `alamat`, `foto`, `aktif`, `terhapus`) VALUES
	(1, 1, '19900326 201601 1 002', '19900326 201601 1 002', 'Nur Akhwan, S.Pd.Kom', 'gty/pty', 'Komputer', 'l', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', 'Y', 'N'),
	(2, 1, '19900326 201601 1 002', '19900326 201601 1 002', 'Nur Akhwan, S.Pd.Kom', 'gty/pty', 'Komputer', 'l', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', 'Y', 'N'),
	(7, 1, '', '1122', 'budi', 'cpns', '', 'l', '', '', 'Y', 'N');
/*!40000 ALTER TABLE `data_guru` ENABLE KEYS */;


-- Dumping structure for table disdik.data_informasi
CREATE TABLE IF NOT EXISTS `data_informasi` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `isi` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_informasi: ~2 rows (approximately)
DELETE FROM `data_informasi`;
/*!40000 ALTER TABLE `data_informasi` DISABLE KEYS */;
INSERT INTO `data_informasi` (`id`, `judul`, `isi`) VALUES
	(1, 'Rekap Data Sekolah', 'REKAP COYYYY<br>'),
	(2, 'Daftar Nama dan Alamat Sekolah', 'DAFTAR<br>');
/*!40000 ALTER TABLE `data_informasi` ENABLE KEYS */;


-- Dumping structure for table disdik.data_produk_hukum
CREATE TABLE IF NOT EXISTS `data_produk_hukum` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  `isi` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_produk_hukum: ~7 rows (approximately)
DELETE FROM `data_produk_hukum`;
/*!40000 ALTER TABLE `data_produk_hukum` DISABLE KEYS */;
INSERT INTO `data_produk_hukum` (`id`, `judul`, `terhapus`, `isi`) VALUES
	(1, 'Undang-Undang (UU)', 'N', 'UU<br>'),
	(2, 'Peraturan Pemerintah (PP)', 'N', 'PP<br>'),
	(3, 'Peraturan Presiden (Perpres)', 'N', 'Perpres'),
	(4, 'Peraturan Mendikbud', 'N', 'PM<br>'),
	(5, 'Peraturan Daerah', 'N', 'PD<br>'),
	(6, 'Peraturan Gubernur', 'N', 'PG<br>'),
	(7, 'Keputusan Kepala Dinas', 'N', 'KKD<br>');
/*!40000 ALTER TABLE `data_produk_hukum` ENABLE KEYS */;


-- Dumping structure for table disdik.data_sekolah
CREATE TABLE IF NOT EXISTS `data_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npsn` varchar(50) NOT NULL,
  `nss` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `no_faks` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `waktu_persekolahan` varchar(50) NOT NULL,
  `akreditasi` varchar(50) NOT NULL,
  `jenjang` varchar(50) NOT NULL,
  `jumlah_ruang` varchar(50) NOT NULL,
  `jumlah_lahan` varchar(50) NOT NULL,
  `jumlah_gedung` varchar(50) NOT NULL,
  `jumlah_kelas` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `lembaga` tinyint(4) NOT NULL DEFAULT '1',
  `rombel` tinyint(4) NOT NULL DEFAULT '0',
  `murid` tinyint(4) NOT NULL DEFAULT '0',
  `guru` tinyint(4) NOT NULL DEFAULT '0',
  `lulusan` tinyint(4) NOT NULL DEFAULT '0',
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='nss= nomor statistik sekolah';

-- Dumping data for table disdik.data_sekolah: ~4 rows (approximately)
DELETE FROM `data_sekolah`;
/*!40000 ALTER TABLE `data_sekolah` DISABLE KEYS */;
INSERT INTO `data_sekolah` (`id`, `npsn`, `nss`, `nama`, `id_kabupaten`, `kecamatan`, `kelurahan`, `alamat`, `kodepos`, `no_telp`, `no_faks`, `email`, `waktu_persekolahan`, `akreditasi`, `jenjang`, `jumlah_ruang`, `jumlah_lahan`, `jumlah_gedung`, `jumlah_kelas`, `status`, `website`, `lembaga`, `rombel`, `murid`, `guru`, `lulusan`, `terhapus`, `updated_at`) VALUES
	(1, '11111111', '11111', 'ini adalah nama sekolah', 2, 'kecamatan', 'kelurahan', '', '', '', '', '', '', '', 'paud', '10', '0', '0', '0', 'negeri', '', 1, 100, 0, 0, 0, 'N', '2015-03-25 13:09:22'),
	(2, '22222', '11111', 'nama', 2, '', '', '', '', '', '', '', '', '', 'sd', '10', '0', '0', '0', 'negeri', '', 1, 0, 0, 0, 0, 'N', '2015-03-25 13:00:47'),
	(3, '22222', '11111', 'nama', 2, '', '', '', '', '', '', '', '', '', 'sd', '10', '0', '0', '0', 'negeri', '', 1, 0, 0, 0, 0, 'N', '2015-03-02 15:24:19'),
	(6, '1122334455', '', 'Nama Sekolah', 10, '', '', '', '', '', '', '', '', '', 'ma', '', '', '', '', 'swasta', '', 1, 0, 0, 0, 0, 'N', '2015-03-05 13:40:12');
/*!40000 ALTER TABLE `data_sekolah` ENABLE KEYS */;


-- Dumping structure for table disdik.data_siswa
CREATE TABLE IF NOT EXISTS `data_siswa` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_sekolah` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_siswa: ~4 rows (approximately)
DELETE FROM `data_siswa`;
/*!40000 ALTER TABLE `data_siswa` DISABLE KEYS */;
INSERT INTO `data_siswa` (`id`, `id_sekolah`, `nisn`, `nama`, `jurusan`, `kelas`, `jk`, `alamat`, `foto`, `pass`, `terhapus`, `updated_at`) VALUES
	(1, 1, '12090672', 'NUr Akhwan', '2015-02-20 08:47:45', '6', 'L', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', '', 'N', '2015-02-24 09:43:44'),
	(2, 1, '19900326', 'Akhwan Noor', '2015-02-20 08:47:45', '2', 'L', 'Sidoharjo', '', 'ac6b8d6e684cf536759a626b83985b33', 'N', '2015-02-24 09:43:43'),
	(3, 1, '19950207', 'Akhwan Januzaj', 'jurusan', '3', 'L', 'Sir Matt Busby Way', '', '4b001528d78c25589ad42b115edd539e', 'N', '2015-02-25 12:10:26'),
	(4, 2, '666666', 'nama', 'jurusan', NULL, 'L', '', '', '', 'N', '2015-02-25 12:06:27'),
	(5, 1, '1122333444', 'nama siswa', '', '', 'L', '', '', '', 'N', '2015-03-06 21:30:18');
/*!40000 ALTER TABLE `data_siswa` ENABLE KEYS */;


-- Dumping structure for table disdik.ekspresi
CREATE TABLE IF NOT EXISTS `ekspresi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi_ekspresi` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.ekspresi: ~2 rows (approximately)
DELETE FROM `ekspresi`;
/*!40000 ALTER TABLE `ekspresi` DISABLE KEYS */;
INSERT INTO `ekspresi` (`id`, `nama`, `email`, `alamat`, `website`, `judul`, `isi_ekspresi`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 'tomi ', '', '', '', 'Buku Yang lain', 'Kok buku seperti Fisika, Kimia, Biologi, Ekonomi, Geografi tidak ada ya', 'Y', '0000-00-00 00:00:00', '2015-03-02 05:20:18'),
	(3, 'rumi', '', '', '', 'judul', 'ekspresi', 'Y', '0000-00-00 00:00:00', '2015-03-02 05:20:20');
/*!40000 ALTER TABLE `ekspresi` ENABLE KEYS */;


-- Dumping structure for table disdik.ekspresi_tanggapan
CREATE TABLE IF NOT EXISTS `ekspresi_tanggapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ekspresi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.ekspresi_tanggapan: ~6 rows (approximately)
DELETE FROM `ekspresi_tanggapan`;
/*!40000 ALTER TABLE `ekspresi_tanggapan` DISABLE KEYS */;
INSERT INTO `ekspresi_tanggapan` (`id`, `id_ekspresi`, `nama`, `email`, `alamat`, `website`, `komentar`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 1, 'administratorq', '', '', '', 'Lebih kengkap dapat didownnload buku dari laman BSE kemdikbud http://bse.kemdikbud.go.id/buku/kurikulum2013', 'N', '2015-02-25 14:39:46', '2015-03-02 01:03:26'),
	(2, 1, 'agus', '', '', '', 'Lebih kengkap dapat didownnload buku dari laman BSE kemdikbud http://bse.kemdikbud.go.id/buku/kurikulum2013', 'N', '2015-02-26 14:39:46', '2015-03-31 14:58:43'),
	(3, 1, 'rumi', '', '', '', 'komentar', 'Y', '2015-02-26 17:24:45', '2015-03-01 11:59:47'),
	(4, 3, 'kaskus', '', '', '', 'kaskus', 'N', '2015-02-26 17:56:09', '2015-02-26 17:56:09'),
	(5, 3, 'Administrator', '', '', '', '<p>lala lili post 3</p>', 'N', '2015-02-26 20:01:02', '2015-02-26 20:01:02'),
	(6, 1, 'Administrator', '', '', '', '<p>test aja lagi</p>', 'Y', '2015-02-26 23:26:16', '2015-03-01 11:59:51');
/*!40000 ALTER TABLE `ekspresi_tanggapan` ENABLE KEYS */;


-- Dumping structure for table disdik.forum_categories
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `publish` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.forum_categories: ~0 rows (approximately)
DELETE FROM `forum_categories`;
/*!40000 ALTER TABLE `forum_categories` DISABLE KEYS */;
INSERT INTO `forum_categories` (`id`, `parent_id`, `name`, `slug`, `date_added`, `date_edit`, `publish`) VALUES
	(1, 0, 'kategori a', 'kategori-a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(2, 1, 'sub kategori a', 'sub-kategori-a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(3, 0, 'kategori b', 'kategori-b', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(4, 3, 'sub kategori b', 'sub-kategori-b', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `forum_categories` ENABLE KEYS */;


-- Dumping structure for table disdik.forum_posts
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `reply_to_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.forum_posts: ~0 rows (approximately)
DELETE FROM `forum_posts`;
/*!40000 ALTER TABLE `forum_posts` DISABLE KEYS */;
INSERT INTO `forum_posts` (`id`, `thread_id`, `reply_to_id`, `author_id`, `post`, `date_add`, `date_edit`) VALUES
	(1, 1, 0, 1, 'isi thread', '2015-04-14 09:07:52', '0000-00-00 00:00:00'),
	(2, 1, 1, 1, '<div style="font-size:11px; background: #e3e3e3;padding:5px;">posted by <b>@admin</b><p><i>isi thread</i></p></div><br>test reply', '2015-04-14 09:08:08', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `forum_posts` ENABLE KEYS */;


-- Dumping structure for table disdik.forum_roles
CREATE TABLE IF NOT EXISTS `forum_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `admin_area` int(1) NOT NULL DEFAULT '0',
  `thread_create` int(1) NOT NULL DEFAULT '0',
  `thread_edit` int(1) NOT NULL DEFAULT '0',
  `thread_delete` int(1) NOT NULL DEFAULT '0',
  `post_create` int(1) NOT NULL DEFAULT '0',
  `post_edit` int(1) NOT NULL DEFAULT '0',
  `post_delete` int(1) NOT NULL DEFAULT '0',
  `role_create` int(1) NOT NULL DEFAULT '0',
  `role_edit` int(1) NOT NULL DEFAULT '0',
  `role_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.forum_roles: ~0 rows (approximately)
DELETE FROM `forum_roles`;
/*!40000 ALTER TABLE `forum_roles` DISABLE KEYS */;
INSERT INTO `forum_roles` (`id`, `role`, `admin_area`, `thread_create`, `thread_edit`, `thread_delete`, `post_create`, `post_edit`, `post_delete`, `role_create`, `role_edit`, `role_delete`) VALUES
	(1, 'administrator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
	(2, 'member', 0, 1, 0, 0, 1, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `forum_roles` ENABLE KEYS */;


-- Dumping structure for table disdik.forum_threads
CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `date_last_post` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.forum_threads: ~0 rows (approximately)
DELETE FROM `forum_threads`;
/*!40000 ALTER TABLE `forum_threads` DISABLE KEYS */;
INSERT INTO `forum_threads` (`id`, `category_id`, `title`, `slug`, `date_add`, `date_edit`, `date_last_post`) VALUES
	(1, 2, 'ini adalah thread pertama', 'ini-adalah-thread-pertama', '2015-04-14 09:07:52', '0000-00-00 00:00:00', '2015-04-14 09:07:52');
/*!40000 ALTER TABLE `forum_threads` ENABLE KEYS */;


-- Dumping structure for table disdik.forum_users
CREATE TABLE IF NOT EXISTS `forum_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.forum_users: ~0 rows (approximately)
DELETE FROM `forum_users`;
/*!40000 ALTER TABLE `forum_users` DISABLE KEYS */;
INSERT INTO `forum_users` (`id`, `role_id`, `username`, `password`) VALUES
	(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 2, 'member', 'aa08769cdcb26674c6706093503ff0a3'),
	(3, 2, 'trias', '5e2f28bfc775b48991e1a58fc8ea0791');
/*!40000 ALTER TABLE `forum_users` ENABLE KEYS */;


-- Dumping structure for table disdik.galeri
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_album` int(3) NOT NULL,
  `file` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `slideshow` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.galeri: ~7 rows (approximately)
DELETE FROM `galeri`;
/*!40000 ALTER TABLE `galeri` DISABLE KEYS */;
INSERT INTO `galeri` (`id`, `id_album`, `file`, `judul`, `ket`, `slideshow`) VALUES
	(11, 3, 'ae008e28af53161580d9fc09fa7a9bee.jpg', 'lazy', 'lazy', 'N'),
	(12, 2, '17a7da1a20069f22985a98c3122d3cb4.jpg', 'rock', 'rock in the river', 'Y'),
	(13, 2, '7883a0b8b72d2bc6eecf09b25424c331.jpg', 'judul', '', 'N'),
	(14, 2, '03237beafb917f13fb584aa11ea24c2e.jpg', 'indeh bingit', 'ini adalah keterangan indah bingit', 'N'),
	(15, 3, '77d9e740d88a1977361ca53a085d6b50.jpg', 'judul', '', 'N'),
	(16, 4, '0578eba339ddcb2b89e4f9353864df2d.jpg', 'test', '', '');
/*!40000 ALTER TABLE `galeri` ENABLE KEYS */;


-- Dumping structure for table disdik.galeri_album
CREATE TABLE IF NOT EXISTS `galeri_album` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.galeri_album: ~0 rows (approximately)
DELETE FROM `galeri_album`;
/*!40000 ALTER TABLE `galeri_album` DISABLE KEYS */;
INSERT INTO `galeri_album` (`id`, `nama`) VALUES
	(2, 'HUT KE-58 JAMBI'),
	(3, 'test'),
	(4, 'test');
/*!40000 ALTER TABLE `galeri_album` ENABLE KEYS */;


-- Dumping structure for table disdik.galeri_video
CREATE TABLE IF NOT EXISTS `galeri_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `view_count` mediumint(9) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.galeri_video: ~3 rows (approximately)
DELETE FROM `galeri_video`;
/*!40000 ALTER TABLE `galeri_video` DISABLE KEYS */;
INSERT INTO `galeri_video` (`id`, `video_id`, `judul`, `view_count`, `updated_at`) VALUES
	(2, 'fLe_qO4AE-M', 'Edge Of tomorow', 0, '2015-03-14 05:42:26'),
	(3, 'FLzfXQSPBOg', 'frozen', 0, '2015-03-14 06:36:42'),
	(4, 'AUq5ohgtkvg', 'LINE : Nic and Mar', 0, '2015-03-16 22:33:30');
/*!40000 ALTER TABLE `galeri_video` ENABLE KEYS */;


-- Dumping structure for table disdik.haldep
CREATE TABLE IF NOT EXISTS `haldep` (
  `isi` longtext NOT NULL,
  `id` int(1) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.haldep: ~0 rows (approximately)
DELETE FROM `haldep`;
/*!40000 ALTER TABLE `haldep` DISABLE KEYS */;
INSERT INTO `haldep` (`isi`, `id`) VALUES
	('<p><em><strong>Assalamu\'alaikum warah matullohi wabarakatuh</strong></em></p>\n<p><span><span class="align-justify"><span>Segala Puji Syukur kita panjatkan kehadirat Tuhan Yang Maha Kuasa, yang dengan Rahmat-Nya telah mengantarkan Dinas Pendidikan ini menjadi sebuah SKPD yang semakin kuat menghadapi tantangan zaman, terutama dalam rangka penyediaan pelayanan publik menuju <span>Good Governance</span> yang siap menjamin transparansi, efisiensi dan efektivitas penyelenggaraan Pemerintahan, didukung penguasaan dan pemanfaatan Teknologi Informasi dan Komunikasi (TIK). </span></span></span></p>\n<p><span><span class="align-justify"><span>Sebagai upaya untuk mewujudkan komitmen tersebut, kami seluruh jajaran Dinas Pendidikan Provinsi Jambi telah bertekad untuk mengoptimalkan segala sumber daya yang ada untuk dimanfaatkan dalam melaksanakan Tugas dan fungsi sebagai pembantu Kepala Daerah Provinsi Jambi, khususnya di dunia pendidikan. Seiring dengan perubahan Struktur Organisasi yang baru ini, kami segenap Jajaran Dinas Pendidikan mengharapkan semoga akan mampu membangkitkan semangat yang baru pula kepada seluruh pihak yang terlibat dalam pembangunan pendidikan di Provinsi Jambi. kami menyadari bahwa pembangunan pendidikan tidak akan berhasil jika hanya dikelola dan menjadi tanggung jawab dinas pendidikan, untuk itu kami berharap seluruh warga Jambi untuk ikut peduli terhadap program-program yang telah kami susun dan rencanakan. partisipasi warga Jambi berupa sumbang saran, masukan, laporan maupun kritik, dapat memanfaatkan fasilitas teknologi informasi yang kami sediakan, baik melalui website ini</span></span></span></p>\n<p><em><strong>Wassalamu\'alaikum warah matullohi wabarakatuh</strong></em></p>', 1);
/*!40000 ALTER TABLE `haldep` ENABLE KEYS */;


-- Dumping structure for table disdik.ide_saran
CREATE TABLE IF NOT EXISTS `ide_saran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `topik` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.ide_saran: ~6 rows (approximately)
DELETE FROM `ide_saran`;
/*!40000 ALTER TABLE `ide_saran` DISABLE KEYS */;
INSERT INTO `ide_saran` (`id`, `nama`, `email`, `alamat`, `website`, `topik`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 'tomi', '', '', '', 'Mohon untuk data kampus-kampus di daerah DIY, di suguhkan,, terimakasih', 'N', '0000-00-00 00:00:00', '2015-03-15 02:42:31'),
	(2, 'rumi', '', '', '', 'gagasan', 'Y', '0000-00-00 00:00:00', '2015-03-01 11:55:40'),
	(3, 'kaskus', 'triasfahrudin@gmail.com', '', '', 'xxxxx', 'Y', '2015-02-28 11:06:39', '2015-03-01 11:55:39'),
	(4, 'sasa', '', '', '', 'sasa', 'Y', '2015-02-28 11:38:20', '2015-03-01 11:55:22'),
	(5, 'trias', 'triasfahrudin@gmail.com', '', '', 'sasa', 'Y', '2015-02-28 11:39:21', '2015-03-01 11:55:31'),
	(6, 'trias', '', '', '', 'sasa', 'Y', '2015-02-28 11:58:43', '2015-03-02 14:18:11');
/*!40000 ALTER TABLE `ide_saran` ENABLE KEYS */;


-- Dumping structure for table disdik.ide_saran_tanggapan
CREATE TABLE IF NOT EXISTS `ide_saran_tanggapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ide_saran` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `komentar` text NOT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.ide_saran_tanggapan: ~19 rows (approximately)
DELETE FROM `ide_saran_tanggapan`;
/*!40000 ALTER TABLE `ide_saran_tanggapan` DISABLE KEYS */;
INSERT INTO `ide_saran_tanggapan` (`id`, `id_ide_saran`, `nama`, `email`, `alamat`, `website`, `tampil`, `komentar`, `inserted_at`, `updated_at`) VALUES
	(1, 1, 'administrator', '', '', '', 'N', 'Silahkan lihat di web dikti dinas dikpora DIY http://pendidikan-diy.go.id/dikti/home', '2015-02-26 14:55:45', '2015-02-26 14:55:55'),
	(2, 1, 'test', '', '', '', 'N', 'test', '2015-02-26 17:07:40', '2015-02-26 17:07:40'),
	(3, 1, 'test', '', '', '', 'N', 'test', '2015-02-26 17:08:31', '2015-02-26 17:08:31'),
	(4, 1, 'kaskus', '', '', '', 'N', 'komentar', '2015-02-26 17:08:45', '2015-02-26 17:08:45'),
	(5, 2, 'reply on 2', '', '', '', 'N', 'komentar reply on 2', '2015-02-26 17:14:08', '2015-02-26 17:14:08'),
	(6, 4, 'rumi', '', '', '', 'Y', 'kementar on 4', '2015-02-26 17:25:15', '2015-02-28 12:39:32'),
	(7, 4, 'Administrator', '', '', '', 'Y', 'test ajah', '2015-02-26 13:37:07', '2015-02-28 12:39:47'),
	(8, 4, 'Administrator', '', '', '', 'Y', 'test lagi', '2015-02-26 13:39:27', '2015-03-01 12:04:31'),
	(9, 4, 'Administrator', '', '', '', 'N', 'test lagi ajah', '2015-02-26 19:40:47', '2015-03-01 12:17:46'),
	(10, 4, 'Administrator', '', '', '', 'N', 'lalla', '2015-02-26 19:41:03', '2015-03-01 12:17:44'),
	(11, 4, 'Administrator', '', '', '', 'N', 'uhui', '2015-02-26 19:41:50', '2015-03-01 12:17:41'),
	(12, 2, 'Administrator', '', '', '', 'N', '<p><img src="/disdik/texteditor/upload/jambi..jpeg" alt="" width="300" height="225" /></p>', '2015-02-26 19:43:01', '2015-02-26 19:43:01'),
	(13, 3, 'reply on 2', '', '', '', 'N', 'sasa', '2015-02-28 11:07:06', '2015-02-28 11:07:06'),
	(14, 6, 'trias', '', '', '', 'N', 'ssa', '2015-02-28 12:09:30', '2015-03-02 01:03:38'),
	(15, 6, 'trias', '', '', '', 'N', 'dada', '2015-02-28 12:11:21', '2015-02-28 12:11:21'),
	(16, 5, 'sasa', '', '', '', 'N', 'blablabla', '2015-02-28 12:12:51', '2015-02-28 12:12:51'),
	(17, 4, 'Administrator', '', '', '', 'N', '<p>test admin</p>', '2015-03-01 12:04:48', '2015-03-01 12:17:17'),
	(18, 6, 'trias', '', '', '', 'N', 'xxx', '2015-03-01 12:13:29', '2015-03-01 12:13:29'),
	(19, 4, 'kaskus', '', '', '', 'N', 'xxx', '2015-03-01 12:19:12', '2015-03-01 12:19:12'),
	(20, 4, 'kaskus', '', '', '', 'N', 'xxxx', '2015-03-01 12:20:29', '2015-03-01 12:20:29');
/*!40000 ALTER TABLE `ide_saran_tanggapan` ENABLE KEYS */;


-- Dumping structure for table disdik.jenjang
CREATE TABLE IF NOT EXISTS `jenjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.jenjang: ~9 rows (approximately)
DELETE FROM `jenjang`;
/*!40000 ALTER TABLE `jenjang` DISABLE KEYS */;
INSERT INTO `jenjang` (`id`, `nama`, `alias`) VALUES
	(1, 'paud', 'PAUD'),
	(2, 'tk', 'TK'),
	(3, 'sd', 'SD'),
	(4, 'mi', 'MI'),
	(5, 'smp', 'SMP'),
	(6, 'mts', 'MTs'),
	(7, 'sma', 'SMA'),
	(8, 'smk', 'SMK'),
	(9, 'ma', 'MA'),
	(10, 'slb', 'SLB');
/*!40000 ALTER TABLE `jenjang` ENABLE KEYS */;


-- Dumping structure for table disdik.kabupaten
CREATE TABLE IF NOT EXISTS `kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propinsi` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.kabupaten: ~11 rows (approximately)
DELETE FROM `kabupaten`;
/*!40000 ALTER TABLE `kabupaten` DISABLE KEYS */;
INSERT INTO `kabupaten` (`id`, `id_propinsi`, `nama`) VALUES
	(1, 1, 'Kabupaten Batanghari'),
	(2, 1, 'Kabupaten Bungo'),
	(3, 1, 'Kabupaten Kerinci'),
	(4, 1, 'Kabupaten Merangin'),
	(5, 1, 'Kabupaten Muaro Jambi'),
	(6, 1, 'Kabupaten Sarolangun'),
	(7, 1, 'Kabupaten Tanjung Jabung Barat'),
	(8, 1, 'Kabupaten Tanjung Jabung Timur'),
	(9, 1, 'Kabupaten Tebo'),
	(10, 1, 'Kota Jambi'),
	(11, 1, 'Kota Sungai Penuh');
/*!40000 ALTER TABLE `kabupaten` ENABLE KEYS */;


-- Dumping structure for table disdik.kat
CREATE TABLE IF NOT EXISTS `kat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `terhapus` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.kat: ~3 rows (approximately)
DELETE FROM `kat`;
/*!40000 ALTER TABLE `kat` DISABLE KEYS */;
INSERT INTO `kat` (`id`, `nama`, `terhapus`) VALUES
	(1, 'MONEV', 'N'),
	(2, 'PAUD', 'N'),
	(3, 'BTIKP', 'N'),
	(5, 'nama', 'Y');
/*!40000 ALTER TABLE `kat` ENABLE KEYS */;


-- Dumping structure for table disdik.link
CREATE TABLE IF NOT EXISTS `link` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.link: ~4 rows (approximately)
DELETE FROM `link`;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
INSERT INTO `link` (`id`, `nama`, `alamat`) VALUES
	(1, 'Kemdikbud', 'http://www.kemdiknas.go.id/kemdikbud/'),
	(2, 'Pustekkom', 'http://setjen.kemdikbud.go.id/pustekkom/'),
	(3, 'Pemprov Jambi', 'http://www.jambiprov.go.id/'),
	(4, 'LPSE', 'https://lpse.lkpp.go.id/eproc4');
/*!40000 ALTER TABLE `link` ENABLE KEYS */;


-- Dumping structure for table disdik.manage_menu
CREATE TABLE IF NOT EXISTS `manage_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `show` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.manage_menu: ~28 rows (approximately)
DELETE FROM `manage_menu`;
/*!40000 ALTER TABLE `manage_menu` DISABLE KEYS */;
INSERT INTO `manage_menu` (`id`, `sort`, `name`, `method`, `show`) VALUES
	(1, 1, 'Beranda', 'index', 'Y'),
	(2, 2, 'Profil', 'profil', 'Y'),
	(3, 3, 'Program', 'program', 'Y'),
	(4, 4, 'Data Sekolah', 'data_sekolah', 'Y'),
	(5, 5, 'Produk Hukum', 'data_produk_hukum', 'Y'),
	(6, 6, 'Pengumuman', 'pengumuman', 'Y'),
	(7, 7, 'Post Berita', 'blog', 'Y'),
	(8, 8, 'Kategori Berita', 'kategori_berita', 'Y'),
	(9, 9, 'Komentar Berita', 'komentar', 'Y'),
	(10, 10, 'Galeri Foto', 'galeri', 'Y'),
	(11, 11, 'Galeri Video', 'galeri_video', 'Y'),
	(12, 12, 'Buku Tamu', 'bukutamu', 'Y'),
	(13, 13, 'Ide & Saran', 'ide_saran', 'Y'),
	(14, 14, 'Ekspresi', 'ekspresi', 'Y'),
	(15, 15, 'Aduan', 'aduan', 'N'),
	(16, 16, 'Apresiasi', 'apresiasi', 'N'),
	(17, 17, 'Pojok Opini', 'opini', 'Y'),
	(18, 18, 'Link/Tautan', 'link', 'Y'),
	(19, 19, 'Agenda', 'agenda', 'Y'),
	(20, 20, 'Newsletter', 'newsletter', 'N'),
	(21, 21, 'Managemen User', 'user', 'Y'),
	(22, 22, 'Web Settings', 'settings', 'Y'),
	(23, 23, 'Edit Profile', 'passwod', 'Y'),
	(24, 24, 'Logout', 'logout', 'Y'),
	(25, 0, '', 'prod_hukum_list', 'N'),
	(26, 0, '', 'sekolah_stats', 'N'),
	(27, 0, '', 'data_guru', 'N'),
	(28, 0, '', 'data_siswa', 'N');
/*!40000 ALTER TABLE `manage_menu` ENABLE KEYS */;


-- Dumping structure for table disdik.newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `view_count` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.newsletter: ~2 rows (approximately)
DELETE FROM `newsletter`;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` (`id`, `judul`, `keterangan`, `file`, `img`, `view_count`) VALUES
	(1, 'judul', 'keterangan', 'cb71ee948b0d9d5d18e61ec1efeaa016.pdf', '7fdcab95d745f3ed4e55a074bc10b8dc.jpg', NULL),
	(2, 'judul 2', 'keterangan 2', 'e0276bd80842819aeda2a3762f1d1ce1.pdf', 'dd4fa22ca2edccc71aa92d0a137789bb.jpg', NULL),
	(5, 'judul 3', 'keterangan 3', '79033f6662e45c7d952291d2879e450e.pdf', 'cb8b3a638367745750a1fc437287bd6a.jpg', NULL);
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;


-- Dumping structure for table disdik.opini
CREATE TABLE IF NOT EXISTS `opini` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` mediumtext NOT NULL,
  `hits` int(4) NOT NULL DEFAULT '0',
  `tglPost` datetime NOT NULL,
  `oleh` varchar(30) NOT NULL,
  `publish` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.opini: ~2 rows (approximately)
DELETE FROM `opini`;
/*!40000 ALTER TABLE `opini` DISABLE KEYS */;
INSERT INTO `opini` (`id`, `judul`, `isi`, `hits`, `tglPost`, `oleh`, `publish`) VALUES
	(1, 'judul opini A yang saaaaaaaaaaaaangat panjang sekali lho sampai banyak sekali', 'isi opini', 5, '2015-03-31 00:00:00', 'administrator A', 'Y'),
	(3, 'ini judul', '<p>test</p>', 2, '2015-03-31 15:20:50', 'admin', 'Y'),
	(4, 'ini adalah judul opini', '<p><img src="/disdik/texteditor/upload/1240345_4837007941019_1292723752504034184_n.jpg" alt="" width="220" height="242" /></p>\n<p>isi postingan alalal</p>', 10, '2015-03-31 17:38:32', 'admin', 'Y');
/*!40000 ALTER TABLE `opini` ENABLE KEYS */;


-- Dumping structure for table disdik.opini_tanggapan
CREATE TABLE IF NOT EXISTS `opini_tanggapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opini` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.opini_tanggapan: ~2 rows (approximately)
DELETE FROM `opini_tanggapan`;
/*!40000 ALTER TABLE `opini_tanggapan` DISABLE KEYS */;
INSERT INTO `opini_tanggapan` (`id`, `id_opini`, `nama`, `email`, `alamat`, `website`, `komentar`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(1, 2, 'nama', '', '', '', 'komentar', 'Y', '2015-03-31 12:50:23', '2015-03-31 14:59:24'),
	(2, 1, 'Administrator', '', '', '', '<p>test ajah</p>', 'N', '2015-03-31 14:57:49', '2015-03-31 14:59:08'),
	(3, 2, 'Administrator', '', '', '', '<p>komentar terharap komentar</p>', 'Y', '2015-03-31 14:59:36', '2015-03-31 14:59:36'),
	(4, 4, 'nama', '', '', '', 'komentar', 'Y', '2015-03-31 17:32:37', '2015-03-31 17:33:04');
/*!40000 ALTER TABLE `opini_tanggapan` ENABLE KEYS */;


-- Dumping structure for table disdik.pengumuman
CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `isi` mediumtext NOT NULL,
  `hits` int(4) NOT NULL DEFAULT '0',
  `tglPost` datetime NOT NULL,
  `oleh` varchar(30) NOT NULL,
  `publish` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.pengumuman: ~2 rows (approximately)
DELETE FROM `pengumuman`;
/*!40000 ALTER TABLE `pengumuman` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengumuman` ENABLE KEYS */;


-- Dumping structure for table disdik.pesan
CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` varchar(200) NOT NULL,
  `tgl` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.pesan: ~0 rows (approximately)
DELETE FROM `pesan`;
/*!40000 ALTER TABLE `pesan` DISABLE KEYS */;
INSERT INTO `pesan` (`id`, `nama`, `email`, `pesan`, `tgl`) VALUES
	(1, 'trias', '', '', '2015-02-26 16:23:35');
/*!40000 ALTER TABLE `pesan` ENABLE KEYS */;


-- Dumping structure for table disdik.poll
CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `tanya` varchar(255) NOT NULL,
  `op_1` varchar(200) NOT NULL,
  `op_2` varchar(200) NOT NULL,
  `op_3` varchar(200) NOT NULL,
  `op_4` varchar(200) NOT NULL,
  `j_1` int(3) NOT NULL,
  `j_2` int(3) NOT NULL,
  `j_3` int(3) NOT NULL,
  `j_4` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.poll: 1 rows
DELETE FROM `poll`;
/*!40000 ALTER TABLE `poll` DISABLE KEYS */;
INSERT INTO `poll` (`id`, `tanya`, `op_1`, `op_2`, `op_3`, `op_4`, `j_1`, `j_2`, `j_3`, `j_4`) VALUES
	(1, 'Bagaimanakah design website ini ?', 'Sangat Bagus', 'Bagus', 'Bagus Sekali', 'Tidak Jelek', 10, 2, 3, 7);
/*!40000 ALTER TABLE `poll` ENABLE KEYS */;


-- Dumping structure for table disdik.poll_stats
CREATE TABLE IF NOT EXISTS `poll_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.poll_stats: ~2 rows (approximately)
DELETE FROM `poll_stats`;
/*!40000 ALTER TABLE `poll_stats` DISABLE KEYS */;
INSERT INTO `poll_stats` (`id`, `tgl`, `ip`) VALUES
	(1, '2015-02-25', '127.0.0.1'),
	(2, '2015-02-26', '127.0.0.1'),
	(3, '2015-02-27', '127.0.0.1'),
	(4, '2015-03-06', '127.0.0.1'),
	(5, '2015-03-08', '127.0.0.1');
/*!40000 ALTER TABLE `poll_stats` ENABLE KEYS */;


-- Dumping structure for table disdik.produk_hukum_files
CREATE TABLE IF NOT EXISTS `produk_hukum_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_hukum_list` int(11) DEFAULT NULL,
  `judul` varchar(500) DEFAULT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `view_count` smallint(6) DEFAULT '0',
  `terhapus` enum('Y','N') DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.produk_hukum_files: ~8 rows (approximately)
DELETE FROM `produk_hukum_files`;
/*!40000 ALTER TABLE `produk_hukum_files` DISABLE KEYS */;
INSERT INTO `produk_hukum_files` (`id`, `id_prod_hukum_list`, `judul`, `nama_file`, `view_count`, `terhapus`, `updated_at`) VALUES
	(1, 1, 'Perpres No 15 tahun 2010', '-', 5, 'N', '2015-02-25 13:05:42'),
	(2, 2, 'PP No.17 tahun 2010', NULL, 5, 'N', '2015-02-25 13:05:42'),
	(3, 1, 'Gubernur Jambi edit', '556a320ca1336071ee8df41e7d6ceffc.rar', 1, 'N', '2015-03-08 10:32:14'),
	(4, 1, 'Pejabat Dinas Pendidikan Provinsi Jambi', '6e737671bcf13171b5dc07e0cd1653c1.pdf', 2, 'N', '2015-03-17 02:24:45'),
	(5, 1, 'Pejabat Dinas Pendidikan Provinsi Jambi', '98194246d0a9869836f6b1576a23cbf8.pdf', 1, 'N', '2015-03-08 10:32:11'),
	(6, 1, 'indeh /bingit', 'aac4fd1466746911a3b8090f068b0438.rar', 2, 'N', '2015-03-17 02:24:48'),
	(7, 4, 'judul', '7f493c094f3003db1babf8c799f63627.pdf', 1, 'N', '2015-03-17 02:24:34'),
	(9, 5, 'judul', '842b3f1191dbeaf292a27a7e7136e4c1.rar', 0, 'N', '2015-03-02 04:34:17'),
	(10, 4, 'framework', '65c5d4d5850c158bdfa08b16dc9cd1bc.zip', 3, 'N', '2015-03-17 02:24:42');
/*!40000 ALTER TABLE `produk_hukum_files` ENABLE KEYS */;


-- Dumping structure for table disdik.produk_hukum_list
CREATE TABLE IF NOT EXISTS `produk_hukum_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk_hukum` tinyint(4) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `tentang` varchar(500) NOT NULL,
  `terbit` date NOT NULL,
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.produk_hukum_list: ~4 rows (approximately)
DELETE FROM `produk_hukum_list`;
/*!40000 ALTER TABLE `produk_hukum_list` DISABLE KEYS */;
INSERT INTO `produk_hukum_list` (`id`, `id_produk_hukum`, `nomor`, `tahun`, `tentang`, `terbit`, `terhapus`, `updated_at`) VALUES
	(1, 1, '23', '2013', 'PEMERINTAHAN DAERAH', '2014-09-30', 'N', '2015-02-26 23:46:07'),
	(2, 2, '22', '2014', 'PEMILIHAN GUBERNUR, BUPATI, DAN WALIKOTA', '2014-09-30', 'N', '2015-02-25 13:10:51'),
	(3, 1, '25', '1985', 'xxxx', '2014-09-30', 'N', '2015-02-26 23:42:10'),
	(4, 1, '25', '2014', 'xxxx', '2014-09-30', 'N', '2015-02-26 23:42:22'),
	(5, 3, '25', '2014', 'PEMERINTAHAN DAERAH', '2014-09-30', 'N', '2015-03-02 03:10:40');
/*!40000 ALTER TABLE `produk_hukum_list` ENABLE KEYS */;


-- Dumping structure for table disdik.profil
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `type` enum('text','map') NOT NULL DEFAULT 'text',
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.profil: ~5 rows (approximately)
DELETE FROM `profil`;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` (`id`, `type`, `judul`, `isi`) VALUES
	(1, 'text', 'Sejarah Singkat Jambi', '<p>&nbsp; <img style="display: block; margin-left: auto; margin-right: auto;" src="/disdik/texteditor/upload/jambi..jpeg" alt="" width="300" height="225" />Kota Jambi adalah ibu kota Provinsi Jambi dan merupakan salah satu dari sepuluh daerah Kabupaten/Kota yang ada dalam Provinsi Jambi. Secara historis, Pemkot Jambi dibentuk dengan ketetapan Gubernur Sumatera No 103/1946 sebagai daerah otonom kota besar di Sumatera.</p>\n<p>Lalu diperkuat lagi dengan Undang &ndash; Undang Nomor 9 Tahun 1956 dan dinyatakan sebagai daerah otonom kota besar dalam lingkungan Provinsi Sumatera Tengah. Dengan pembentukan Provinsi Jambi pada 6 Januari 1948, sejak itu pula Kota Jambi resmi menjadi ibu kota Provinsi. Dengan demikian Kota Jambi sebagai daerah tingkat II pernah menjadi bagian dari tiga Provinsi yakni Provinsi Sumatera, Provinsi Sumatera Tengah, dan Provinsi Jambi sekarang.</p>\n<p>Memperhatikan jarak antara Proklamasi Kemerdekaan 17 Agustus 1945 dan pembentukan Pemkot Jambi pada 17 Mei 1946, relatif singkat. Hal itu jelas menunjukan bahwa pembentukan Pemerintah Otonom Kota Besar Jambi saat itu sangat dipengaruhi jiwa dan semangat Proklamasi 17 Agustus 1945.</p>\n<p><br /> Meski menurut catatan sejarah pendirian Kota Jambi bersamaan dengan berdirinya Provinsi Jambi (6 Januari 1948), hari jadinya ditetapkan dua tahun lebih dulu. Sesuai Peraturan Daerah (Perda) Kota Jambi Nomor 16 Tahun 1985 yang di sahkan Gubernur Kepala Daerah Tingkat I Jambi dengan Surat Keputusan Nomor 156 Tahun 1986.&nbsp; Hari jadi Pemkot Jambi adalah 17 Mei 1946, dengan alasan pembentukan Pemkot Jambi (sebelumnya disebut Kotamadya sebelum kemudian menjadi kota), adalah 17 Mei 1946 dengan ketetapan Gubernur Sumatera Nomor 103 tahun 1946, yang diperkuat dengan Undang &ndash; Undang Nomor 9 Tahun 1956. Kota Jambi resmi menjadi ibu kota Provinsi Jambi pada 6 Januari 1957 berdasarkan UU Nomor 61 Tahun 1958.</p>\n<p><br /> Ketentuan mengenai lambang dan motto Kota Jambi diatur melalui Perda Nomor 15 Tahun 2002 tentang Lambang Daerah Kota Jambi, yang ditetapkan di Jambi pada 21 Mei 2002 dan di tandatangani oleh Wali Kota Jambi H Arifien Manap dan Ketua DPRD KOta Jambi H Zulkifli Somad. Lambang Kota Jambi itu secara filosofis melambangkan identitas sejarah dan kebesaran Kerajaan Melayu Jambi dulu. Di lambang tersimpul pula secara simbolik kondisi geografis daerah dan sosiokultural masyarakat Jambi.</p>\n<p><br /> Lambang Kota Jambi berbentuk perisai dengan bagian yang meruncing di bawah dikelilingi tiga garis dengan warna bagian luar putih, tengah berwarna hijau, dan bagian luar berwarna putih. Garis hijau yang mengelilingi lambang pada bagian atas lebih lebar dan di dalamnya tercantum tulisan &ldquo;Kota Jambi&rdquo; yang melambangkan nama daerah dan diapit oleh dua bintang bersudut lima berwarna putih. Itu melambangkan kondisi kehidupan sosial masyarakat Jambi yang terdiri atas berbagai suku dan agama, memiliki keimanan kepada Tuhan yang Maha Esa.</p>\n<p>Warna dasar lambang berwarna biru langit. Isi dan arti lambang senapan/lelo, gong, dan angsa. Disebutkan, setelah Orang Kayo Hitam menikah dengan putri Temenggung Merah Mato yang bernama Putri Mayang Mangurai, oleh Temenggung Merah Mato anak dan menantunya itu diberi sepasang angsa serta perau kajang lako. Kemudian dia disuruh mengaliri aliran sungai Batanghari untuk mencari tempat guna mendirikan kerajaan baru. Kepada anak dan menantunya tersebut, dipesankan bahwa tempat yang akan dipilih ialah dimana sepasang angsa naik ke tebing dan mupur di tempat itu selama dua hari dua malam.</p>\n<p><br /> Setelah beberapa hari mengaliri Sungai Batanghari, kedua angsa naik ke darat di sebelah hilir (kampung jam), kampung tenadang. Dan sesuai dengan amanat mertuanya, Orang Kayo Hitam dan istrinya, Putri Mayang Mangurai, beserta pengikutnya membangun kerajaan baru yang kemudian disebut tanah pilih. Tanah Pilih dijadikan pusat pemerintahan kerajaan (Kota Jambi sekarang). &ldquo;Dulu kan ado semacam kepercayaan sebelum memulai sesuatu. Rajo zaman itu mempercayakan kepada duo ekor angso untuk menentukan pusat kota kerajaan. Duo angso itu dilepas di sungai. Kalau angso itu naik, berarti itulah awal kota. Sampai sejauh mano dio bejalan, itulah luas daerahnyo,&rdquo; tutur Sulaiman Abdullah, seorang tokoh masyarakat Jambi yang juga Ketua Majelis Ulama Indonesia (MUI) Provinsi Jambi.</p>\n<p><br /> Sewaktu Orang Kayo Hitam menebas untuk menerangi tempat pilihan dua angsa itu, ditemukan sebuah gong dan senapan/lelo yang diberi nama &ldquo;Sitimang&rdquo; dan &ldquo;Sidjimat&rdquo;. Kemudian kedua benda tersebut menjadi barang pusaka Kerajaan Jambi yang disimpan di Museum Negeri Jambi.<br /> &ldquo;Tanah Pilih itu adalah tanah yang dipilih oleh raja zaman dulu untuk dijadikan istana dan pusat kerajaan. Sedangkan pusako Batuah maksudnya adalah saat membangun, ditemukan barang &ndash; barang pusaka seperti gong dan keris,&rdquo; katanya mencoba mengingat kembali kisah &ndash; kisah lama itu. Keris yang ditemukan itu diberi nama &ldquo;Keris Siginjai&rdquo; dan merupakan lambang kebesaran serta kepahlawanan raja dan Sultan Jambi dahulu. Siapapun yang memiliki keris itu, dialah yang diakui sebagai penguasa atau berkuasa untuk memerintah Kerajaan Jambi.</p>\n<p><br /> Tanah Pilih Pesako Betuah secara filosofi mengandung pengertian bahwa Kota Jambi sebagai pusat pemerintahan kota sekaligus sebagai pusat sosial, ekonomi, kebudayaan, mencerminkan jiwa masyarakatnya sebagai duta kesatuan baik individu, keluarga, dan kelompok maupun secara institusional yang lebih luas ; berpegang teguh dan terikat pada nilai &ndash; nilai adat istiadat dan hukum adat serta peraturan perundang &ndash; undangan yang berlaku.Semoga bermanfaat (Dari Berbagai Sumber)</p>'),
	(2, 'text', 'Visi Misi Jambi Emas', '<h3 id="big_tittle">VISI</h3>\n<ul>\n<li>TERWUJUDNYA EKONOMI MAJU, AMAN, ADIL DAN SEJAHTERA <span style="font-size: 24px; font-family: ALGER; color: #fbbf3a; font-weight: bold;"> ( JAMBI EMAS )</span></li>\n</ul>\n<h3 id="big_tittle">MISI</h3>\n<ul>\n<li>Meningkatkan Kualitas dan Ketersediaan Infrastruktur Pelayanan Umum;</li>\n<li>Meningkatkan Kualitas Pendidikan, Kesehatan, Kehidupan Beragama dan Berbudaya;</li>\n<li>Meningkatkan Perekonomian Daerah dan Pendapatan Masyarakat berbasis Agribisnis dan Agroindustri;</li>\n<li>Meningkatkan Pengelolaan Sumberdaya Alam yang Optimal dan Berwawasan Lingkungan;</li>\n<li>Meningkatkan Tata Pemerintahan yang baik, Jaminan Kepastian dan Perlindungan Hukum serta Kesetaraan Gender</li>\n</ul>'),
	(3, 'text', 'Visi Misi Dinas Pendidikan', '<p style="text-align: center;"><span style="font-family: verdana,geneva;"><span style="font-size: small;"><strong><span style="font-size: medium;">V I S I</span></strong></span><span style="font-size: small;"><strong><br /></strong></span></span></p>\n<p style="text-align: center;"><span style="font-size: small; font-family: verdana,geneva;"><strong>&ldquo; Terwujudnya Pelayanan Pendidikan yang bermutu dalam rangka&nbsp; membentuk insan Kota Jambi yang berakhlak mulia, cerdas, berkeahlian, demokratis, berbudaya, dan berdaya saing menuju era globalisasi pada tahun 2018 &rdquo;</strong></span></p>\n<p style="text-align: center;"><span style="font-family: verdana,geneva;"><strong><span style="font-size: medium;">M I S I</span></strong></span></p>\n<p style="text-align: justify;">&nbsp;Untuk mewujudkan visi tersebut di atas, maka dirumuskan misi Dinas Pendidikan Kota Jambi, sebagai berikut :</p>\n<ol>\n<li>Mengupayakan pemerataan dan perluasan kesempatan memperoleh pendidikan yang bermutu bagi seluruh masyarakat Kota Jambi.</li>\n<li>Membantu dan memfasilitasi pengembangan potensi anak didik secara utuh sejak usia dini sampai akhir hayat dalam rangka mewujudkan masyarakat belajar; &nbsp;</li>\n<li>Meningkatkan kesiapan dan kualitas proses pendidikan untuk mengoptimalkan pembentukan kepribadian yang bermoral;</li>\n<li>Meningkatkan keprofesionalan dan akuntabilitas lembaga pendidikan sebagai pusat pengetahuan dan pembudayaan, keterampilan, pengalaman, sikap, dan nilai berdasarkan standar nasional dan global;</li>\n<li>Memberdayakan peran serta masyarakat dalam penyelenggaraan pendidikan berdasarkan prinsip otonomi dalam konteks Negara Kesatuan Republik Indonesia, dan</li>\n<li>Meningkatkan kemampuan keprofesionalan, akuntabilitas dan pencitraan publik terhadap kinerja pembangunan tenaga kependidikan atas dasar sistem informasi tenaga kependidikan yang lengkap, handal, dan dapat dipercaya.</li>\n</ol>'),
	(4, 'text', 'Struktur Organisasi', 'BELUM ADA<br>'),
	(5, 'map', 'Lokasi Kantor', 'LOKASI NIH BRO<br>');
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;


-- Dumping structure for table disdik.program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.program: ~8 rows (approximately)
DELETE FROM `program`;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` (`id`, `judul`, `isi`) VALUES
	(1, 'Sekretaris', ''),
	(2, 'Bidang DIKDAS', '<p>test bidang dikdas update</p>'),
	(3, 'Bidang DIKMEN', ''),
	(4, 'Bidang PAUD', ''),
	(5, 'Bidang MONEV', ''),
	(6, 'BTIKP', '<p style="margin-bottom: 0in; line-height: 100%;" align="center"><span style="font-size: medium;"><strong>PROGRAM DAN KEGIATAN</strong></span></p>\n<p style="margin-bottom: 0in; line-height: 100%;" align="center"><span style="font-size: medium;"><strong>BALAI TEKNOLOGI INFORMASI DAN KOMUNIKASI PENDIDIKAN</strong></span></p>\n<p style="margin-bottom: 0in; line-height: 100%;" align="center"><span style="font-size: medium;"><strong>DINAS PENDIDIKAN PROVINSI JAMBI</strong></span></p>\n<p style="margin-bottom: 0in; line-height: 100%;" align="center"><span style="font-size: medium;"><strong>TAHUN 2015</strong></span></p>\n<p style="margin-bottom: 0in; line-height: 100%;">&nbsp;</p>\n<ol type="A">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>PENDAHULUAN</strong></span></span></p>\n</li>\n</ol><ol>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Dasar </strong></span></span></p>\n</li>\n</ol><ol type="a">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Pemikiran</strong></span></span></p>\n</li>\n</ol>\n<p style="margin-left: 0.64in; margin-bottom: 0.14in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Pendidikan modern sudah tidak bisa lagi hanya bertahan pada model pembelajaran konvesional dimana antara guru dan murid belajar secara satu arah. Guru masih bertahan dengan pola konvesional akan tertinggal dan akhirnya akan menghasilkan anak didik yang tidak mampu bersaing di tingkat global. Oleh sebab itu mau tidak mau, mampu atau tidak mampu maka guru harus menguasai teknologi. Demikian juga dengan institusi sekolah, harus secara terbuka untuk menerima fenomena kecanggihan teknologi dengan pemanfaatan dan penguasaan secara tepat. Institusi sekolah sudah saatnya mempersiapkan perangkat-perangkat yang dapat di manfaatkan oleh guru dan siswa dalam mengaplikasikan teknologi. </span></span></p>\n<ol type="a" start="2">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Ketentuan hukum</strong></span></span></p>\n</li>\n</ol><ol>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Undang-undang Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional (Lembaga Negara Republik Indonesia Tahun 2003 Nomor 78 Tambahan Negara Nomor 4301);</span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><span lang="nb-NO">Peraturan Pemerintah Nomor 41 Tahun 2007 tentang Organisasi Perangkat Daerah</span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Permendagri Nomor 13 Tahun 2006 tentang pedoman pengelolaan keuangan daerah.</span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Peraturan Presiden Nomor 54 Tahun 2010 tentang pengadaan barang dan jasa pemerintah.</span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Perda Nomor 04 Tahun 2011 tentang Penyelenggaraan Pendidikan.</span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Peraturan Gubernur Jambi No 1 Tahun 2014 tentang Perubahan Keempat Atas Peraturan Gubernur Jambi Nomor 1 Tahun 2009 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Dinas (UPTD) pada Dinas dan Badan Daerah Provinsi Jambi.</span></span></p>\n</li>\n</ol>\n<p style="margin-left: 0.89in; margin-bottom: 0.14in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><br /><br /></p>\n<ol start="2">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Tujuan</strong></span></span></p>\n</li>\n</ol><ol type="a">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Umum </strong></span></span></p>\n</li>\n</ol>\n<p style="margin-left: 0.69in; margin-bottom: 0.14in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Balai Teknologi Informasi dan Komunikasi Pendidikan (BTIKP) merupakan salah satu Unit Pelaksana Teknis Dinas Pendidikan Provinsi Jambi yang di bentuk berdasarkan Peraturan Gubernur Jambi Nomor 1 Tahun 2014 tentang Perubahan Keempat Atas Peraturan Gubernur Jambi Nomor 1 Tahun 2009 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Dinas (UPTD) pada Dinas dan Badan Daerah Provinsi Jambi.</span></span></p>\n<p style="margin-left: 0.69in; margin-bottom: 0.14in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Tugas Pokok dan Fungsi UPTD Balai Teknologi Informasi dan Komunikasi Pendidikan pada Dinas Pendidikan Provinsi Jambi adalah </span></span><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><em>melaksanakan sebagian kewenangan dan tugas teknis tertentu yang diberikan Dinas Pendidikan Provinsi Jambi di bidang Pengembangan, pembinaan, </em></span></span><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><em><strong>pelatihan</strong></em></span></span><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><em>, evaluasi kegiatan Teknologi Pendidikan dan Pendayagunaan Teknologi, Informasi dan Komunikasi untuk Pendidikan serta sebagai pusat data pendidikan.</em></span></span></p>\n<ol type="a" start="2">\n<li>\n<p style="margin-bottom: 0in; line-height: 150%; widows: 0; orphans: 0;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;"><strong>Khusus</strong></span></span></p>\n</li>\n</ol>\n<p style="margin-left: 0.69in; margin-bottom: 0.14in; line-height: 150%;" align="justify"><span style="font-family: Calibri,serif;"><span style="font-size: medium;">Dalam melaksanakan tugas pokok dan fungsinya, Balai Teknologi Informasi dan Komunikasi Pendidikan pada Dinas Pendidikan Provinsi Jambi mempunyai fungsi :</span></span></p>\n<ol>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Penyusunan rencana, program kerja dan anggaran Balai; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Penyusunan kebijakan teknis dibidang teknologi, informasi dan komunikasi pendidikan; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pengembangan teknologi pembelajaran berbasis radio, televisi, film dan multimedia; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pengembangan dan pengelolaan jejaring dan web teknologi, informasi dan komunikasi pendidikan; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pelaksanaan fasilitasi pengembangan, pendayagunaan, pelatihan dan penelitian teknologi informasi dan komunikasi pendidikan; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pelaksanaan pemantauan dan evaluasi dibidang teknologi, informasi dan komunikasi pendidikan; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pelaksanaan kegiatan pendataan kependidikan yang ada di Provinsi Jambi; </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Penyusunan laporan pelaksanaan pengembangan teknologi, informasi dan komunikasi pendidikan; dan </span></span></span></span></p>\n</li>\n<li>\n<p style="margin-bottom: 0in; line-height: 150%;" align="justify"><span style="color: #000000;"><span style="font-family: Bookman Old Style,serif;"><span style="font-size: medium;"><span style="font-family: Calibri,serif;">Pelaksanaan tugas lain yang diberikan oleh atasan sesuai dengan bidang tugasnya. </span></span></span></span></p>\n</li>\n</ol>'),
	(7, 'BPKSDP', '');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;


-- Dumping structure for table disdik.propinsi
CREATE TABLE IF NOT EXISTS `propinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.propinsi: ~0 rows (approximately)
DELETE FROM `propinsi`;
/*!40000 ALTER TABLE `propinsi` DISABLE KEYS */;
INSERT INTO `propinsi` (`id`, `nama`) VALUES
	(1, 'Jambi');
/*!40000 ALTER TABLE `propinsi` ENABLE KEYS */;


-- Dumping structure for table disdik.sekolah_stats
CREATE TABLE IF NOT EXISTS `sekolah_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sekolah` int(11) NOT NULL,
  `lembaga` tinyint(4) NOT NULL DEFAULT '1',
  `tahun` smallint(6) NOT NULL,
  `rombel` tinyint(4) NOT NULL DEFAULT '0',
  `murid` tinyint(4) NOT NULL DEFAULT '0',
  `guru` tinyint(4) NOT NULL DEFAULT '0',
  `ruang_kelas` tinyint(4) NOT NULL DEFAULT '0',
  `lulusan` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.sekolah_stats: ~2 rows (approximately)
DELETE FROM `sekolah_stats`;
/*!40000 ALTER TABLE `sekolah_stats` DISABLE KEYS */;
INSERT INTO `sekolah_stats` (`id`, `id_sekolah`, `lembaga`, `tahun`, `rombel`, `murid`, `guru`, `ruang_kelas`, `lulusan`, `updated_at`) VALUES
	(1, 1, 1, 2014, 30, 127, 26, 7, 67, '2015-03-16 17:21:42'),
	(2, 1, 1, 2015, 30, 127, 58, 11, 89, '2015-03-16 17:25:52');
/*!40000 ALTER TABLE `sekolah_stats` ENABLE KEYS */;


-- Dumping structure for table disdik.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `tipe` enum('small-text','big-text','image') DEFAULT 'small-text',
  `value` text,
  `img_height` varchar(50) DEFAULT NULL,
  `img_width` varchar(50) DEFAULT NULL,
  `show` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.settings: ~4 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `title`, `tipe`, `value`, `img_height`, `img_width`, `show`) VALUES
	(1, 'running_text', 'small-text', 'Selamat Datang Pada Website Resmi Dinas Pendidikan Provinsi Jambi', NULL, NULL, 'Y'),
	(2, 'fb_fanpage', 'small-text', 'https://www.facebook.com/pages/Dinas-Pendidikan-Provinsi-Jambi/117994094968453', NULL, NULL, 'Y'),
	(3, 'header_img', 'image', '7c2360f38dc1bf9a11be6ca15c35aab9.png', '100', '960', 'Y'),
	(4, 'background_img', 'image', '55ab2fe8a1156129ae8f8a0fa5123e32.jpg', '250', '250', 'Y');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table disdik.tbl_agenda
CREATE TABLE IF NOT EXISTS `tbl_agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.tbl_agenda: ~0 rows (approximately)
DELETE FROM `tbl_agenda`;
/*!40000 ALTER TABLE `tbl_agenda` DISABLE KEYS */;
INSERT INTO `tbl_agenda` (`id`, `title`, `slug`, `tgl_mulai`, `tgl_selesai`, `lokasi`, `jam`, `content`, `created_at`, `last_update`) VALUES
	(1, '', '', '2015-04-09', '2015-04-09', '', '', '', '0000-00-00 00:00:00', '2015-04-09 14:20:54');
/*!40000 ALTER TABLE `tbl_agenda` ENABLE KEYS */;


-- Dumping structure for table disdik.tbl_sessions
CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `prevent_update` int(10) DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.tbl_sessions: ~20 rows (approximately)
DELETE FROM `tbl_sessions`;
/*!40000 ALTER TABLE `tbl_sessions` DISABLE KEYS */;
INSERT INTO `tbl_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `prevent_update`) VALUES
	('0a7a0c930f068c42c004cc06800135e1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428605269, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-10";}', NULL),
	('25e4a623c0e85b7edcaa75a78c45000c', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0', 1427262367, 'a:7:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-25";s:7:"user_id";s:1:"1";s:4:"user";s:5:"admin";s:9:"validated";b:1;s:9:"menu_list";s:68:"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26";s:11:"curr_method";s:23:"generate_event_calendar";}', NULL),
	('394483af10069b41bb3371c29d6aa0aa', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1428995319, 'a:17:{s:9:"user_data";s:0:"";s:15:"forum_logged_in";i:1;s:13:"forum_user_id";s:1:"1";s:14:"forum_username";s:5:"admin";s:17:"forum_user_roleid";s:1:"1";s:2:"id";s:1:"1";s:4:"role";s:13:"administrator";s:10:"admin_area";s:1:"1";s:13:"thread_create";s:1:"1";s:11:"thread_edit";s:1:"1";s:13:"thread_delete";s:1:"1";s:11:"post_create";s:1:"1";s:9:"post_edit";s:1:"1";s:11:"post_delete";s:1:"1";s:11:"role_create";s:1:"1";s:9:"role_edit";s:1:"1";s:11:"role_delete";s:1:"1";}', NULL),
	('7e3c0c0008fa689f3a91d4a439d34a29', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428286033, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-08";}', NULL),
	('9390e0f6b993d1e0564f3a0162655cef', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1428043344, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-03";}', NULL),
	('9c8205d1a9b16bde56f3cbd819a02baf', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428586025, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-09";}', NULL),
	('ab913d57aab927a75f6c101994bfec7a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1428127552, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-04";}', NULL),
	('aec9ab77ada6757dc9141247196b9dc2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1428044110, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-03";}', NULL),
	('b25081a0ccd7eb5c46748b7ed8176d2e', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0', 1426514266, 'a:9:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-19";s:7:"user_id";s:1:"1";s:4:"user";s:5:"admin";s:9:"validated";b:1;s:9:"menu_list";s:68:"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26";s:11:"curr_method";s:23:"generate_event_calendar";s:7:"curr_id";s:1:"1";s:12:"captcha_word";s:5:"31680";}', NULL),
	('c475017093c9c1e75c01012eeee7ef95', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428685724, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-11";}', NULL),
	('c4add305c5bcb898be6b8e5a9c42599e', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1428041700, 'a:8:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-03";s:7:"user_id";s:1:"1";s:4:"user";s:5:"admin";s:9:"validated";b:1;s:9:"menu_list";s:74:"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28";s:11:"curr_method";s:7:"program";s:7:"curr_id";s:1:"7";}', NULL),
	('ccadd869b9465040d51767f8aa13c4c0', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1427779601, 'a:8:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-31";s:7:"user_id";s:1:"1";s:4:"user";s:5:"admin";s:9:"validated";b:1;s:9:"menu_list";s:71:"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27";s:11:"curr_method";s:22:"aduan_apresiasi_detail";s:12:"captcha_word";s:5:"50744";}', NULL),
	('e4a9b22aabc3753ccd6bcb0ce5f084b4', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428285988, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-06";}', NULL),
	('eede59ad3bc3a7f1a8c1c611337dd997', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1428041325, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-03";}', NULL),
	('f3eca6f6880b0374f3483be40ad2024e', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428561181, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-09";}', NULL),
	('f8fd405a1f0656c0c2735da865dcca83', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0', 1428043344, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-03";}', NULL),
	('fbd955b7ec1356f6e46290ed2d780ead', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428692684, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-04-11";}', NULL);
/*!40000 ALTER TABLE `tbl_sessions` ENABLE KEYS */;


-- Dumping structure for table disdik.view_stats
CREATE TABLE IF NOT EXISTS `view_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '0',
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.view_stats: ~68 rows (approximately)
DELETE FROM `view_stats`;
/*!40000 ALTER TABLE `view_stats` DISABLE KEYS */;
INSERT INTO `view_stats` (`id`, `ip`, `tgl`) VALUES
	(1, '127.0.0.1', '2015-02-27 00:22:05'),
	(2, '127.0.0.1', '2015-02-28 00:22:04'),
	(3, '127.0.0.1', '2015-02-26 00:31:11'),
	(4, '127.0.0.1', '2015-02-26 00:35:42'),
	(5, '127.0.0.1', '2015-02-26 00:56:22'),
	(6, '127.0.0.1', '2015-02-26 12:08:40'),
	(7, '127.0.0.1', '2015-02-27 00:35:27'),
	(8, '127.0.0.1', '2015-02-28 10:17:51'),
	(9, '127.0.0.1', '2015-03-01 10:30:14'),
	(10, '127.0.0.1', '2015-03-02 01:02:59'),
	(11, '127.0.0.1', '2015-03-02 12:59:40'),
	(12, '127.0.0.1', '2015-03-02 13:10:53'),
	(13, '127.0.0.1', '2015-03-02 14:29:43'),
	(14, '127.0.0.1', '2015-03-02 14:51:53'),
	(15, '127.0.0.1', '2015-03-02 15:02:52'),
	(16, '127.0.0.1', '2015-03-03 00:55:14'),
	(17, '127.0.0.1', '2015-03-03 01:17:57'),
	(18, '127.0.0.1', '2015-03-04 02:33:28'),
	(19, '127.0.0.1', '2015-03-04 02:33:50'),
	(20, '127.0.0.1', '2015-03-04 02:35:55'),
	(21, '127.0.0.1', '2015-03-04 02:37:54'),
	(22, '127.0.0.1', '2015-03-04 02:38:50'),
	(23, '127.0.0.1', '2015-03-04 02:44:44'),
	(24, '127.0.0.1', '2015-03-04 02:45:23'),
	(25, '127.0.0.1', '2015-03-04 02:46:12'),
	(26, '127.0.0.1', '2015-03-04 02:58:09'),
	(27, '127.0.0.1', '2015-03-04 03:05:44'),
	(28, '127.0.0.1', '2015-03-04 03:07:13'),
	(29, '127.0.0.1', '2015-03-04 07:47:13'),
	(30, '127.0.0.1', '2015-03-05 13:31:57'),
	(31, '127.0.0.1', '2015-03-05 16:59:31'),
	(32, '127.0.0.1', '2015-03-05 16:59:47'),
	(33, '127.0.0.1', '2015-03-05 19:32:25'),
	(34, '127.0.0.1', '2015-03-05 19:34:30'),
	(35, '127.0.0.1', '2015-03-06 00:07:40'),
	(36, '127.0.0.1', '2015-03-06 00:08:06'),
	(37, '127.0.0.1', '2015-03-06 00:14:08'),
	(38, '127.0.0.1', '2015-03-06 00:14:44'),
	(39, '127.0.0.1', '2015-03-06 15:14:40'),
	(40, '127.0.0.1', '2015-03-06 15:14:56'),
	(41, '127.0.0.1', '2015-03-06 20:15:38'),
	(42, '127.0.0.1', '2015-03-06 20:51:57'),
	(43, '127.0.0.1', '2015-03-06 20:52:15'),
	(44, '127.0.0.1', '2015-03-06 21:42:40'),
	(45, '127.0.0.1', '2015-03-08 10:20:06'),
	(46, '127.0.0.1', '2015-03-09 06:02:31'),
	(47, '127.0.0.1', '2015-03-09 19:53:41'),
	(48, '127.0.0.1', '2015-03-14 01:09:42'),
	(49, '127.0.0.1', '2015-03-14 02:55:04'),
	(50, '127.0.0.1', '2015-03-14 06:17:22'),
	(51, '127.0.0.1', '2015-03-15 02:07:32'),
	(52, '127.0.0.1', '2015-03-16 11:20:23'),
	(53, '127.0.0.1', '2015-03-16 20:57:46'),
	(54, '127.0.0.1', '2015-03-17 00:02:21'),
	(55, '127.0.0.1', '2015-03-19 13:53:55'),
	(56, '127.0.0.1', '2015-03-25 12:46:07'),
	(57, '127.0.0.1', '2015-03-28 22:40:09'),
	(58, '127.0.0.1', '2015-03-31 08:04:20'),
	(59, '127.0.0.1', '2015-03-31 08:20:27'),
	(60, '127.0.0.1', '2015-03-31 08:41:56'),
	(61, '127.0.0.1', '2015-03-31 11:50:05'),
	(62, '127.0.0.1', '2015-03-31 12:26:41'),
	(63, '127.0.0.1', '2015-04-03 13:02:45'),
	(64, '127.0.0.1', '2015-04-03 13:08:45'),
	(65, '127.0.0.1', '2015-04-03 13:15:00'),
	(66, '127.0.0.1', '2015-04-03 13:42:24'),
	(67, '127.0.0.1', '2015-04-03 13:42:24'),
	(68, '127.0.0.1', '2015-04-03 13:55:10'),
	(69, '127.0.0.1', '2015-04-04 13:05:52'),
	(70, '127.0.0.1', '2015-04-06 09:06:28'),
	(71, '127.0.0.1', '2015-04-06 09:07:13'),
	(72, '127.0.0.1', '2015-04-08 07:44:32'),
	(73, '127.0.0.1', '2015-04-09 13:33:01'),
	(74, '127.0.0.1', '2015-04-09 20:27:06'),
	(75, '127.0.0.1', '2015-04-10 01:47:49'),
	(76, '127.0.0.1', '2015-04-11 00:08:44'),
	(77, '127.0.0.1', '2015-04-11 02:04:44'),
	(78, '127.0.0.1', '2015-04-14 00:34:01'),
	(79, '127.0.0.1', '2015-04-14 12:24:49'),
	(80, '127.0.0.1', '2015-04-14 12:27:54');
/*!40000 ALTER TABLE `view_stats` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
