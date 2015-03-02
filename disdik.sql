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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.admin: ~0 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `u`, `p`, `nama`, `email`, `level`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nur Akhwan', 'akhwan90@gmail.com', '1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


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


-- Dumping structure for table disdik.berita
CREATE TABLE IF NOT EXISTS `berita` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `isi` mediumtext NOT NULL,
  `hits` int(4) NOT NULL,
  `tglPost` datetime NOT NULL,
  `kategori` varchar(75) NOT NULL,
  `oleh` varchar(30) NOT NULL,
  `publish` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.berita: ~11 rows (approximately)
DELETE FROM `berita`;
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` (`id`, `judul`, `gambar`, `isi`, `hits`, `tglPost`, `kategori`, `oleh`, `publish`) VALUES
	(4, 'Tim Pengembang Konten', '', 'tim pengembangn<br>', 157, '2015-02-13 12:18:32', '3-', 'Hely Kurniawan', 1),
	(5, 'Jambi expo', '', 'jambi expo 2015<br>', 6, '2012-10-07 12:08:59', '3-', 'Hely Kurniawan', 1),
	(6, 'Kerja bakti', '', 'kerja bakti<br>', 1, '2012-10-07 12:09:10', '3-', 'Hely Kurniawan', 1),
	(10, 'Seminar', '', 'seminar', 0, '2012-12-30 23:39:31', '2-', 'admin', 1),
	(11, 'Kunjungan Ke sekolah', '', 'kunjungan', 18, '2012-12-30 23:40:24', '1-', 'admin', 1),
	(12, 'Halal bihalal', '', 'halal bihalal<br>', 2, '2012-12-30 23:41:39', '3-', 'admin', 1),
	(13, 'Pameran ', '1kanjon_reke_uvac_-_miroslav_jeremi?.jpg', 'pameran', 4, '2012-12-30 23:42:26', '1-', 'admin', 1),
	(14, 'Sosialisai', 'Rooney_Goal.jpg', 'sosialisasi', 23, '2012-12-30 23:43:16', '2-', 'admin', 1),
	(15, 'Kegiatan Pelatihan TIK', '', 'PELATIHAN', 0, '2012-12-30 23:44:59', '3-', 'admin', 1),
	(16, 'Beasiswa 2015', '70b4f9ce5812e63cbb6a98ae06275085.jpg', '<p>Info beasiswa</p>', 6, '2012-12-30 23:45:29', '2', 'admin', 1),
	(17, 'Kegiatan HUT KE-58 Provinsi Jambi', 'IMG_4432.JPG', '<div><strong>Bola.net </strong>- Ketika beberapa klub sudah antusias bersiap menyambut jendela transfer musim dingin guna memperkuat diri, Sir Alex Ferguson malah kalem.</div>\n<div>&nbsp;</div>\n<div>Gaffer Manchester United itu mengaku tidak pernah suka dengan penambahan amunisi di tengah musim, dan ia punya alasan tersendiri akan hal tersebut.</div>\n<div>&nbsp;</div>\n<div>"Bursa transfer Januari tidak pernah menjadi bursa transfer terbaik dan itu telah terbukti selama bertahun-tahun dengan sangat sedikitnya transfer-transfer besar terjadi," ucapnya.</div>\n<div>&nbsp;</div>\n<div>Fergie mengacu pada kondisi beberapa tahun terakhir, ketika sangat jarang terjadi pembelian-pembelian yang sukses pada Januari.</div>\n<div>&nbsp;</div>\n<div>Justru yang lebih sering terjadi adalah pembelian pemain dengan biaya besar namun tidak sukses di kemudian hari.</div>\n<div>&nbsp;</div>\n<div>Hasilnya, kemungkinan klub-klub panik dengan prospek memiliki tim yang tidak maksimal sampai Mei dengan sekelompok pemain yang gagal memenuhi harapan.</div>\n<div>&nbsp;</div>\n<div>"Semua transfer besar terjadi pada musim panas," imbuh pria yang sudah bekerja di Old Trafford sejak 26 tahun silam tersebut. (dym/lex)</div>', 22, '2012-12-30 23:46:06', '2', 'admin', 1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.berita_komen: ~0 rows (approximately)
DELETE FROM `berita_komen`;
/*!40000 ALTER TABLE `berita_komen` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_guru: ~1 rows (approximately)
DELETE FROM `data_guru`;
/*!40000 ALTER TABLE `data_guru` DISABLE KEYS */;
INSERT INTO `data_guru` (`id`, `id_sekolah`, `nip`, `nuptk`, `nama`, `status`, `mapel`, `jk`, `alamat`, `foto`, `aktif`, `terhapus`) VALUES
	(1, 1, '19900326 201601 1 002', '19900326 201601 1 002', 'Nur Akhwan, S.Pd.Kom', 'gty/pty', 'Komputer', 'l', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', 'Y', 'N'),
	(2, 1, '19900326 201601 1 002', '19900326 201601 1 002', 'Nur Akhwan, S.Pd.Kom', 'gty/pty', 'Komputer', 'l', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', 'Y', 'N');
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
  `alamat` varchar(50) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `no_faks` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `waktu_persekolahan` varchar(50) NOT NULL,
  `akreditasi` varchar(50) NOT NULL,
  `jenjang` varchar(50) NOT NULL,
  `jumlah_ruang` tinyint(4) NOT NULL,
  `jumlah_lahan` tinyint(4) NOT NULL,
  `jumlah_gedung` tinyint(4) NOT NULL,
  `jumlah_kelas` tinyint(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `terhapus` enum('Y','N') NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='nss= nomor statistik sekolah';

-- Dumping data for table disdik.data_sekolah: ~2 rows (approximately)
DELETE FROM `data_sekolah`;
/*!40000 ALTER TABLE `data_sekolah` DISABLE KEYS */;
INSERT INTO `data_sekolah` (`id`, `npsn`, `nss`, `nama`, `id_kabupaten`, `alamat`, `kodepos`, `no_telp`, `no_faks`, `email`, `waktu_persekolahan`, `akreditasi`, `jenjang`, `jumlah_ruang`, `jumlah_lahan`, `jumlah_gedung`, `jumlah_kelas`, `status`, `website`, `terhapus`, `updated_at`) VALUES
	(1, '11111111', '11111', 'ini adalah nama sekolah', 2, '', '', '', '', '', '', '', 'ma', 10, 0, 0, 0, 'negeri', '', 'N', '2015-02-25 09:58:08'),
	(2, '22222', '11111', 'nama', 2, '', '', '', '', '', '', '', 'tk', 10, 0, 0, 0, 'negeri', '', 'N', '2015-02-23 11:30:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.data_siswa: ~4 rows (approximately)
DELETE FROM `data_siswa`;
/*!40000 ALTER TABLE `data_siswa` DISABLE KEYS */;
INSERT INTO `data_siswa` (`id`, `id_sekolah`, `nisn`, `nama`, `jurusan`, `kelas`, `jk`, `alamat`, `foto`, `pass`, `terhapus`, `updated_at`) VALUES
	(1, 1, '12090672', 'NUr Akhwan', '2015-02-20 08:47:45', '6', 'L', 'Sumoroto, Sidoharjo, Samigaluh, Kulon Progo', '', '', 'N', '2015-02-24 09:43:44'),
	(2, 1, '19900326', 'Akhwan Noor', '2015-02-20 08:47:45', '2', 'L', 'Sidoharjo', '', 'ac6b8d6e684cf536759a626b83985b33', 'N', '2015-02-24 09:43:43'),
	(3, 1, '19950207', 'Akhwan Januzaj', 'jurusan', '3', 'L', 'Sir Matt Busby Way', '', '4b001528d78c25589ad42b115edd539e', 'N', '2015-02-25 12:10:26'),
	(4, 2, '666666', 'nama', 'jurusan', NULL, 'L', '', '', '', 'N', '2015-02-25 12:06:27');
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
	(2, 1, 'agus', '', '', '', 'Lebih kengkap dapat didownnload buku dari laman BSE kemdikbud http://bse.kemdikbud.go.id/buku/kurikulum2013', 'Y', '2015-02-26 14:39:46', '2015-03-01 11:59:50'),
	(3, 1, 'rumi', '', '', '', 'komentar', 'Y', '2015-02-26 17:24:45', '2015-03-01 11:59:47'),
	(4, 3, 'kaskus', '', '', '', 'kaskus', 'N', '2015-02-26 17:56:09', '2015-02-26 17:56:09'),
	(5, 3, 'Administrator', '', '', '', '<p>lala lili post 3</p>', 'N', '2015-02-26 20:01:02', '2015-02-26 20:01:02'),
	(6, 1, 'Administrator', '', '', '', '<p>test aja lagi</p>', 'Y', '2015-02-26 23:26:16', '2015-03-01 11:59:51');
/*!40000 ALTER TABLE `ekspresi_tanggapan` ENABLE KEYS */;


-- Dumping structure for table disdik.galeri
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_album` int(3) NOT NULL,
  `file` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `slideshow` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.galeri: ~9 rows (approximately)
DELETE FROM `galeri`;
/*!40000 ALTER TABLE `galeri` DISABLE KEYS */;
INSERT INTO `galeri` (`id`, `id_album`, `file`, `judul`, `ket`, `slideshow`) VALUES
	(6, 2, 'e39c4851b4c339c41821bc0d66d47b04.jpg', 'Gubernur Jambi edit', 'Gubernur Jambi', 'Y'),
	(7, 2, 'IMG_44411.JPG', 'Pejabat Dinas Pendidikan Provinsi Jambi', 'Pejabat Dinas Pendidikan Provinsi Jambi', 'N'),
	(8, 2, 'IMG_45911.JPG', 'KUKER DPR RI', 'KUKER DPR RI', 'Y'),
	(9, 2, 'IMG_46331.JPG', 'KEPALA DINAS PENDIDIKAN PROVINSI JAMBI', 'KEPALA DINAS PENDIDIKAN PROVINSI JAMBI', 'Y'),
	(10, 2, 'f838862de3cfc04cfdbda0ba9b532166.jpg', 'test ajah', 'test ajah', 'Y'),
	(11, 3, 'ae008e28af53161580d9fc09fa7a9bee.jpg', 'lazy', 'lazy', 'N'),
	(12, 2, '17a7da1a20069f22985a98c3122d3cb4.jpg', 'rock', 'rock in the river', 'Y'),
	(13, 2, '7883a0b8b72d2bc6eecf09b25424c331.jpg', 'judul', '', 'N'),
	(14, 2, '03237beafb917f13fb584aa11ea24c2e.jpg', 'indeh bingit', 'ini adalah keterangan indah bingit', 'N'),
	(15, 3, '77d9e740d88a1977361ca53a085d6b50.jpg', 'judul', '', 'N');
/*!40000 ALTER TABLE `galeri` ENABLE KEYS */;


-- Dumping structure for table disdik.galeri_album
CREATE TABLE IF NOT EXISTS `galeri_album` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.galeri_album: ~0 rows (approximately)
DELETE FROM `galeri_album`;
/*!40000 ALTER TABLE `galeri_album` DISABLE KEYS */;
INSERT INTO `galeri_album` (`id`, `nama`) VALUES
	(2, 'HUT KE-58 JAMBI'),
	(3, 'test');
/*!40000 ALTER TABLE `galeri_album` ENABLE KEYS */;


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
	(1, 'tomi', '', '', '', 'Mohon untuk data kampus-kampus di daerah DIY, di suguhkan,, terimakasih', 'Y', '0000-00-00 00:00:00', '2015-03-01 11:55:40'),
	(2, 'rumi', '', '', '', 'gagasan', 'Y', '0000-00-00 00:00:00', '2015-03-01 11:55:40'),
	(3, 'kaskus', 'triasfahrudin@gmail.com', '', '', 'xxxxx', 'Y', '2015-02-28 11:06:39', '2015-03-01 11:55:39'),
	(4, 'sasa', '', '', '', 'sasa', 'Y', '2015-02-28 11:38:20', '2015-03-01 11:55:22'),
	(5, 'trias', 'triasfahrudin@gmail.com', '', '', 'sasa', 'Y', '2015-02-28 11:39:21', '2015-03-01 11:55:31'),
	(6, 'trias', '', '', '', 'sasa', 'Y', '2015-02-28 11:58:43', '2015-03-02 01:03:32');
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
	(1, 'Bagaimanakah design website ini ?', 'Sangat Bagus', 'Bagus', 'Bagus Sekali', 'Tidak Jelek', 10, 2, 3, 5);
/*!40000 ALTER TABLE `poll` ENABLE KEYS */;


-- Dumping structure for table disdik.poll_stats
CREATE TABLE IF NOT EXISTS `poll_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.poll_stats: ~2 rows (approximately)
DELETE FROM `poll_stats`;
/*!40000 ALTER TABLE `poll_stats` DISABLE KEYS */;
INSERT INTO `poll_stats` (`id`, `tgl`, `ip`) VALUES
	(1, '2015-02-25', '127.0.0.1'),
	(2, '2015-02-26', '127.0.0.1'),
	(3, '2015-02-27', '127.0.0.1');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.produk_hukum_files: ~8 rows (approximately)
DELETE FROM `produk_hukum_files`;
/*!40000 ALTER TABLE `produk_hukum_files` DISABLE KEYS */;
INSERT INTO `produk_hukum_files` (`id`, `id_prod_hukum_list`, `judul`, `nama_file`, `view_count`, `terhapus`, `updated_at`) VALUES
	(1, 1, 'Perpres No 15 tahun 2010', '-', 5, 'N', '2015-02-25 13:05:42'),
	(2, 2, 'PP No.17 tahun 2010', NULL, 5, 'N', '2015-02-25 13:05:42'),
	(3, 1, 'Gubernur Jambi edit', '556a320ca1336071ee8df41e7d6ceffc.rar', 0, 'N', '2015-03-02 03:03:26'),
	(4, 1, 'Pejabat Dinas Pendidikan Provinsi Jambi', '6e737671bcf13171b5dc07e0cd1653c1.pdf', 0, 'N', '2015-03-02 03:04:57'),
	(5, 1, 'Pejabat Dinas Pendidikan Provinsi Jambi', '98194246d0a9869836f6b1576a23cbf8.pdf', 0, 'N', '2015-03-02 03:07:18'),
	(6, 1, 'indeh /bingit', 'aac4fd1466746911a3b8090f068b0438.rar', 0, 'N', '2015-03-02 03:29:59'),
	(7, 4, 'judul', '7f493c094f3003db1babf8c799f63627.pdf', 0, 'N', '2015-03-02 03:10:08'),
	(9, 5, 'judul', '842b3f1191dbeaf292a27a7e7136e4c1.rar', 0, 'N', '2015-03-02 04:34:17');
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
  `tahun` smallint(6) NOT NULL,
  `rombel` tinyint(4) NOT NULL DEFAULT '0',
  `murid` tinyint(4) NOT NULL DEFAULT '0',
  `guru` tinyint(4) NOT NULL DEFAULT '0',
  `ruang_kelas` tinyint(4) NOT NULL DEFAULT '0',
  `lulusan` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.sekolah_stats: ~0 rows (approximately)
DELETE FROM `sekolah_stats`;
/*!40000 ALTER TABLE `sekolah_stats` DISABLE KEYS */;
INSERT INTO `sekolah_stats` (`id`, `id_sekolah`, `tahun`, `rombel`, `murid`, `guru`, `ruang_kelas`, `lulusan`, `updated_at`) VALUES
	(1, 1, 2014, 11, 12, 13, 14, 16, '2015-02-26 10:56:46');
/*!40000 ALTER TABLE `sekolah_stats` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.tbl_agenda: ~4 rows (approximately)
DELETE FROM `tbl_agenda`;
/*!40000 ALTER TABLE `tbl_agenda` DISABLE KEYS */;
INSERT INTO `tbl_agenda` (`id`, `title`, `slug`, `tgl_mulai`, `tgl_selesai`, `lokasi`, `jam`, `content`, `created_at`, `last_update`) VALUES
	(1, 'pergelaran tari diblambangan', 'pergelaran-tari', '2015-02-13', '2015-02-14', 'lokasi', '18:00', 'pergelaran tari', '0000-00-00 00:00:00', '2015-02-21 23:44:17'),
	(2, 'pergelaran tari umbul-umbul', 'pergelaran-tari', '2014-02-10', '2014-02-15', 'blambangan', '18:00 ', 'pergelaran tari keren bangeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet,pergelaran tari keren bangeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet,pergelaran tari keren bangeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet,pergelaran tari keren bangeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet,pergelaran tari keren bangeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet', '0000-00-00 00:00:00', '2014-02-12 15:26:57'),
	(3, 'pergelaran tari lanang-wadon', 'pergelaran-tari', '2014-02-15', '2014-02-17', 'blambangan', '18:00 ', 'pergelaran tari', '0000-00-00 00:00:00', '2014-02-12 14:30:42'),
	(4, 'pergelaran tari trio macan', 'pergelaran-tari-trio-macan', '2014-03-01', '2014-03-02', 'blambangan', '12:00', '<p>pergelaran tari trio macan</p>', '2014-02-16 20:43:44', '2014-02-16 20:44:45');
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

-- Dumping data for table disdik.tbl_sessions: ~3 rows (approximately)
DELETE FROM `tbl_sessions`;
/*!40000 ALTER TABLE `tbl_sessions` DISABLE KEYS */;
INSERT INTO `tbl_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `prevent_update`) VALUES
	('26ef1be362e9cb1fdbf1600bf4b5c35e', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0', 1425276653, 'a:2:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-02";}', NULL),
	('d1d5dc0665a54f5d7360e17dafa1c7d2', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0', 1424757153, 'a:11:{s:9:"user_data";s:0:"";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:9:"validated";b:1;s:7:"jenjang";s:0:"";s:6:"status";s:0:"";s:12:"id_kabupaten";s:0:"";s:7:"curr_id";s:1:"1";s:5:"tahun";s:0:"";s:11:"curr_method";s:12:"data_sekolah";s:9:"last_seen";s:10:"2015-02-26";}', NULL),
	('d71e07164799e591e5195b5c7714f088', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', 1424740675, 'a:3:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-02";s:7:"curr_id";s:1:"1";}', NULL),
	('f1969713b8cc2f9c7b3fec21090a2357', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0', 1424927320, 'a:8:{s:9:"user_data";s:0:"";s:9:"last_seen";s:10:"2015-03-02";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:9:"validated";b:1;s:11:"curr_method";s:6:"galeri";s:7:"curr_id";s:2:"--";s:12:"captcha_word";s:5:"69842";}', NULL);
/*!40000 ALTER TABLE `tbl_sessions` ENABLE KEYS */;


-- Dumping structure for table disdik.view_stats
CREATE TABLE IF NOT EXISTS `view_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '0',
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table disdik.view_stats: ~2 rows (approximately)
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
	(12, '127.0.0.1', '2015-03-02 13:10:53');
/*!40000 ALTER TABLE `view_stats` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
