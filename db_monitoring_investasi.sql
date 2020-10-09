-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2019 at 11:50 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_monitoring_investasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_adendum`
--

CREATE TABLE IF NOT EXISTS `ak_data_adendum` (
`adendum_id` int(11) NOT NULL,
  `adendum_kd` char(20) NOT NULL,
  `investasi_id` char(20) DEFAULT NULL,
  `eksploitasi_id` char(20) DEFAULT NULL,
  `adendum_pr_number` varchar(128) DEFAULT NULL,
  `adendum_po_number` varchar(128) DEFAULT NULL,
  `adendum_no_kontrak` varchar(128) NOT NULL DEFAULT '',
  `adendum_nilai_pekerjaan` decimal(10,0) NOT NULL DEFAULT '0',
  `adendum_tanggal_jaminan_pelaksanaan` date NOT NULL,
  `adendum_selesai_pekerjaan` date NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_data_adendum`
--

INSERT INTO `ak_data_adendum` (`adendum_id`, `adendum_kd`, `investasi_id`, `eksploitasi_id`, `adendum_pr_number`, `adendum_po_number`, `adendum_no_kontrak`, `adendum_nilai_pekerjaan`, `adendum_tanggal_jaminan_pelaksanaan`, `adendum_selesai_pekerjaan`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`) VALUES
(27, 'INV-000000001', '17', NULL, '32116', '76412', 'HK321.1.4.5.67800', '1435550', '2019-09-06', '2019-08-12', '13', '2019-08-23 10:57:27', NULL, NULL, 0),
(28, 'INV-000000002', '18', NULL, '54321', '54780', 'HK341.1.4.5.68791', '5411100', '2019-09-23', '2019-09-10', '1', '2019-08-23 13:48:32', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_bidang`
--

CREATE TABLE IF NOT EXISTS `ak_data_bidang` (
`bidang_id` int(11) NOT NULL,
  `bidang_kd` char(20) NOT NULL,
  `bidang_nama` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_data_bidang`
--

INSERT INTO `ak_data_bidang` (`bidang_id`, `bidang_kd`, `bidang_nama`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`) VALUES
(32, 'BID-00001', 'TEHKNIK SI & JARINGAN', '1', '2019-08-23 10:05:17', NULL, NULL, 0),
(33, 'BID-00002', 'TEKHNIK SIPIL', '1', '2019-08-23 10:05:30', NULL, NULL, 0),
(34, 'BID-00003', 'TEKHNIK LISTRIK', '1', '2019-08-23 10:05:44', NULL, NULL, 0),
(35, 'BID-00004', 'TEKNIK MESIN', '1', '2019-08-23 10:05:54', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_eksploitasi`
--

CREATE TABLE IF NOT EXISTS `ak_data_eksploitasi` (
`eksploitasi_id` int(11) NOT NULL,
  `eksploitasi_kd` char(20) NOT NULL,
  `vendor_id` char(20) NOT NULL DEFAULT '',
  `bidang_id` char(20) NOT NULL DEFAULT '',
  `eksploitasi_pr_number` varchar(128) DEFAULT NULL,
  `eksploitasi_po_number` varchar(128) DEFAULT NULL,
  `eksploitasi_bidang` varchar(128) NOT NULL DEFAULT '',
  `eksploitasi_uraian_pekerjaan` text NOT NULL,
  `eksploitasi_no_kontrak` varchar(128) NOT NULL DEFAULT '',
  `eksploitasi_nilai_pekerjaan` decimal(10,0) NOT NULL DEFAULT '0',
  `eksploitasi_mulai_pelaksanaan` date NOT NULL,
  `eksploitasi_selesai_pekerjaan` date NOT NULL,
  `eksploitasi_tanggal_jaminan_pelaksanaan` date NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_data_eksploitasi`
--

INSERT INTO `ak_data_eksploitasi` (`eksploitasi_id`, `eksploitasi_kd`, `vendor_id`, `bidang_id`, `eksploitasi_pr_number`, `eksploitasi_po_number`, `eksploitasi_bidang`, `eksploitasi_uraian_pekerjaan`, `eksploitasi_no_kontrak`, `eksploitasi_nilai_pekerjaan`, `eksploitasi_mulai_pelaksanaan`, `eksploitasi_selesai_pekerjaan`, `eksploitasi_tanggal_jaminan_pelaksanaan`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`) VALUES
(15, 'EXP-000000001', '5', '33', '34512', '65321', '', 'PENANGANAN PEMADAM', 'HK456.7.8.9.11344', '1300000', '2019-07-01', '2019-09-01', '2019-09-06', '1', '2019-08-23 15:29:04', NULL, NULL, 0),
(16, 'EXP-000000002', '5', '33', '78991', '65122', '', 'YYY', 'HK345.5.5.6.78912', '1236000', '2019-07-02', '2019-09-04', '2019-09-06', '1', '2019-08-23 15:38:42', NULL, NULL, 0),
(17, 'EXP-000000003', '5', '33', '45661', '65411', '', 'DESIGN', 'HK651.2.3.3.44651', '541200', '2019-07-01', '2019-09-11', '2019-09-13', '1', '2019-08-23 15:41:07', NULL, NULL, 0),
(18, 'EXP-000000004', '5', '33', '13445', '67891', '', 'MATRIX', 'HK345.6.7.9.82123', '450000', '2019-07-01', '2019-09-04', '2019-09-07', '13', '2019-08-23 15:51:23', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_investasi`
--

CREATE TABLE IF NOT EXISTS `ak_data_investasi` (
`investasi_id` int(11) NOT NULL,
  `investasi_kd` char(20) NOT NULL,
  `vendor_id` char(20) NOT NULL DEFAULT '',
  `bidang_id` char(20) NOT NULL DEFAULT '',
  `investasi_pr_number` varchar(128) DEFAULT NULL,
  `investasi_po_number` varchar(128) DEFAULT NULL,
  `investasi_uraian_pekerjaan` text NOT NULL,
  `investasi_no_kontrak` varchar(128) NOT NULL DEFAULT '',
  `investasi_nilai_pekerjaan` double NOT NULL,
  `investasi_mulai_pelaksanaan` date NOT NULL,
  `investasi_selesai_pekerjaan` date NOT NULL,
  `investasi_tanggal_jaminan_pelaksanaan` date NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_data_investasi`
--

INSERT INTO `ak_data_investasi` (`investasi_id`, `investasi_kd`, `vendor_id`, `bidang_id`, `investasi_pr_number`, `investasi_po_number`, `investasi_uraian_pekerjaan`, `investasi_no_kontrak`, `investasi_nilai_pekerjaan`, `investasi_mulai_pelaksanaan`, `investasi_selesai_pekerjaan`, `investasi_tanggal_jaminan_pelaksanaan`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`) VALUES
(17, 'INV-000000001', '7', '33', '32116', '76412', 'PEMASANGAN GAMBAR', 'HK321.1.4.5.67800', 1435550, '2019-07-01', '2019-08-07', '2019-09-03', '1', '2019-08-23 10:07:37', NULL, NULL, 0),
(18, 'INV-000000002', '5', '34', '54321', '54780', 'PEMASANGAN KABEL TRAY', 'HK341.1.4.5.68791', 5411100, '2019-08-08', '2019-09-08', '2019-09-10', '1', '2019-08-23 10:31:17', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_sewa_kategori`
--

CREATE TABLE IF NOT EXISTS `ak_data_sewa_kategori` (
`sewa_kategori_id` int(11) NOT NULL,
  `sewa_kategori_kd` char(20) NOT NULL,
  `sewa_kategori_nama` varchar(128) NOT NULL,
  `created_by` varchar(128) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_sistem_app_info`
--

CREATE TABLE IF NOT EXISTS `ak_data_sistem_app_info` (
  `app_info_id` char(20) NOT NULL DEFAULT '',
  `app_info_name` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ak_data_sistem_app_info`
--

INSERT INTO `ak_data_sistem_app_info` (`app_info_id`, `app_info_name`) VALUES
('APP19011700001', 'MONITORING INVESTASI ');

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_sistem_instansi`
--

CREATE TABLE IF NOT EXISTS `ak_data_sistem_instansi` (
  `instansi_id` char(20) NOT NULL DEFAULT '',
  `instansi_nama` varchar(128) NOT NULL DEFAULT '',
  `instansi_alamat` text,
  `instansi_kontak` char(18) NOT NULL DEFAULT '',
  `instansi_logo` varchar(128) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ak_data_sistem_instansi`
--

INSERT INTO `ak_data_sistem_instansi` (`instansi_id`, `instansi_nama`, `instansi_alamat`, `instansi_kontak`, `instansi_logo`, `deleted`) VALUES
('INS19011700001', 'MONITORING INVESTASI', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_sistem_log`
--

CREATE TABLE IF NOT EXISTS `ak_data_sistem_log` (
  `id` varchar(128) NOT NULL DEFAULT '',
  `ip_address` varchar(45) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ak_data_sistem_log`
--

INSERT INTO `ak_data_sistem_log` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0ish6m620shooigl99a5usddoahv3cv1', '::1', 1559596230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393539363231363b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30322032333a33323a3435223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('0p0dcvqbt87m6cj81nr8ffmmehommb2g', '::1', 1560313211, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303331323938313b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31312031363a31393a3335223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('1qhguhm4phpm43m0b5b7bcpi1bgdns0u', '::1', 1561963882, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313936333838323b),
('4efvfkr0hd7t0m8dlqsh339ocbvhdhis', '::1', 1560409892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303430393734303b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31322031363a33323a3037223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('5adlja1rcp9i18f8coos5t36u6ogsauj', '::1', 1559663287, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393636333035363b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30342032303a30383a3134223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('697rqujh50h9afojaco6i5ip3806v900', '::1', 1561104715, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313130343533363b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31382030393a33313a3131223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('857bhgtlhsb8o6d96naeo7opk9n4mpm7', '127.0.0.1', 1560320625, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303332303438363b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31322031313a33323a3531223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('8k2tn13n4sb99up7uu6fh2smnuif3cm3', '::1', 1559655802, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393635353732373b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30342030343a32303a3131223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('8o6eldd1qdoiiufgbue668b6qeiu41kh', '::1', 1561348710, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313334383537373b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d32312031353a30393a3036223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('9fqfavs45vg18j99k868621v8gvdhpbr', '::1', 1560216578, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303231363537373b),
('atq5l19lghme77gs4igfnvpknk3i26e0', '::1', 1562432901, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323433323838333b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30372d30312031303a32353a3235223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('bf0vi2brv5ae0kao92e15fkpbc19i3p5', '::1', 1560406576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303430363537353b),
('bolvtsmlnqsu11ujo9u5gjcr3dtnniul', '::1', 1561354028, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313335343032383b),
('c1imnbhnf8b4ikfhat92j5unpjth3rfp', '::1', 1562340639, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323334303633383b),
('don4er0hbmut5i07r9ndcaign2anicsn', '::1', 1560216913, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303231363839363b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30342032323a33393a3232223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('fp0554rjjcevvkndlh838gpov3e80ppl', '::1', 1560331810, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303333313735393b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31322031333a30393a3036223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('gd54fq90shs45ibmei2odcpu5422ria6', '::1', 1560740576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303734303537353b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31332031333a31363a3339223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('j340eopuj78abupe0iuc7as5e0neif6h', '::1', 1562551500, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323535313236343b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30372d30372030303a30383a3130223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('j62d5rdj5hhrjseqgmrcrs4p9c5spb4k', '::1', 1560221713, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303232313631353b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31312030383a33303a3435223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('k7uaspif93k7a03v0fer07ip2mec2q1d', '::1', 1560244792, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303234343736343b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31312030393a35333a3433223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('kdbfav2im3g1690j7lmlos0c7u6ivoer', '::1', 1560595897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303539353839363b),
('kpubq6qtf984qkl4gv0p2u0hejiio9nb', '::1', 1559493341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393439333135353b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30322032333a31353a3332223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('l5rq99ocidl4ik5jhpdem1l1luggcsno', '::1', 1560311636, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303331313633353b),
('mv2qbkpld6f0ksg31hucn9h6rc9km25g', '::1', 1560829434, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303832393433333b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31372030393a32393a3238223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('n5hf0rk9jgrs0tunstpskfdm3q427fr5', '::1', 1561353537, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313335333532333b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d32342031303a35363a3438223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('phs49ov8m9oorabn4p6dseq4tu39ed7e', '::1', 1561513398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313531333339353b),
('qk2ueira3u3p022jor09raf64tt4i5s8', '::1', 1560332005, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536303333313931373b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d31322031343a32323a3530223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('rv6dadckmr07j9m7o751iupelh1n1173', '127.0.0.1', 1559490840, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393439303631303b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30322030303a33323a3234223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a32353a2253495354454d204d4f4e49544f52494e47204144454e44554d223b4c6f67676564496e7c623a313b),
('u1is2rl3b73r8qpr2sqk96agj2998b68', '::1', 1559597021, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393539363830313b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d30342030343a31303a3237223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('v7b077ofdbakdvcp65b19ub47u483pql', '::1', 1561432091, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313433323038383b6b6573656d706174616e7c693a313b69647c733a31343a225553523139303131373030303031223b6c6576656c7c733a363a224d6173746572223b6e616d617c733a363a224d6173746572223b6c6173745f6c6f67696e7c733a31393a22323031392d30362d32342031323a31383a3534223b637265617465645f646174657c733a31393a22323031392d30312d31372030393a34373a3231223b73697374656d5f6e616d657c733a33323a224d4f4e49544f52494e472050524f4a4543542054454b484e494b20534950494c223b4c6f67676564496e7c623a313b),
('ve535ogvr4up0aoin7gnovinkiepu1qg', '::1', 1559663590, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393636333539303b),
('vvcrfcg7ii0gg9fl1vkj89ipp6kp9e1b', '::1', 1562551304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323535313330343b);

-- --------------------------------------------------------

--
-- Table structure for table `ak_data_vendor`
--

CREATE TABLE IF NOT EXISTS `ak_data_vendor` (
`vendor_id` int(11) NOT NULL,
  `vendor_kd` char(20) NOT NULL,
  `vendor_nama` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_data_vendor`
--

INSERT INTO `ak_data_vendor` (`vendor_id`, `vendor_kd`, `vendor_nama`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`) VALUES
(4, 'VEN-00001', 'ILCS', '1', '2019-08-23 10:06:05', NULL, NULL, 0),
(5, 'VEN-00002', 'EDI', '1', '2019-08-23 10:06:11', NULL, NULL, 0),
(6, 'VEN-00003', 'WIKA PT', '1', '2019-08-23 10:06:20', NULL, NULL, 0),
(7, 'VEN-00004', 'PT. ABC', '1', '2019-08-23 10:06:29', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Datin', 'User Experince');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE IF NOT EXISTS `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 89),
(1, 4),
(1, 3),
(2, 3),
(3, 3),
(1, 42),
(3, 42),
(1, 1),
(2, 1),
(3, 1),
(1, 95),
(2, 95),
(3, 95),
(1, 40),
(1, 43),
(3, 43),
(1, 44),
(3, 44),
(1, 96),
(2, 96),
(3, 96),
(1, 8),
(1, 89),
(1, 4),
(1, 3),
(2, 3),
(3, 3),
(1, 42),
(3, 42),
(1, 1),
(2, 1),
(3, 1),
(1, 95),
(2, 95),
(3, 95),
(1, 40),
(1, 43),
(3, 43),
(1, 44),
(3, 44),
(1, 96),
(2, 96),
(3, 96);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '99',
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 6, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 4, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 3, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 8, 2, 95, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 9, 3, 42, 'far fa-circle', 'Users', 'users', '1', 1),
(44, 10, 3, 42, 'far fa-circle', 'Groups', 'groups', '2', 1),
(89, 5, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(95, 7, 1, 0, 'empty', 'USER', '#', '#', 1),
(96, 2, 2, 1, 'fas fa-tachometer-alt', 'Agenda', 'agenda', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE IF NOT EXISTS `menu_type` (
`id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu'),
(2, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_properti`
--

CREATE TABLE IF NOT EXISTS `sewa_properti` (
`sewa_properti_id` int(11) NOT NULL,
  `sewa_properti_kd` char(20) NOT NULL,
  `status_pembayaran` enum('Hutang','Lunas') NOT NULL,
  `nama_penyewa` varchar(250) NOT NULL,
  `sewa_kategori_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `nominal` double NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `no_kontrak` varchar(128) NOT NULL,
  `tgl_kontrak` date NOT NULL,
  `status_sewa` enum('Bulanan','Tahunan') NOT NULL,
  `tgl_batas_pembayaran` date DEFAULT NULL COMMENT 'tgl_mulai + (jika bulanan 30 hari, jika tahunan 360 hari) = tgl_batas_pembayaran',
  `created_by` varchar(128) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1=administrator;2=admin investasi;3=admin sewa'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `role`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$ipVAkJ.rjy35wARE9Px47eS2k.gz2FPYy14M019VFwLtBcUax2YJS', '', 'admin@admin.com', '', 'tVIHjCnvYJORrsCEnQeuHOcbbcda55b746f82208', 1565148829, 'tTCpOabatXnfYdnqgkC4De', 1268889823, 1566814253, 1, 'Admin', 'istrator', 'ADMIN', '0', 1),
(2, '127.0.0.1', 'member', '$2y$08$ipVAkJ.rjy35wARE9Px47eS2k.gz2FPYy14M019VFwLtBcUax2YJS', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'EPyexY.pqhAnBf2lER9Hau', 1268889823, 1561998051, 1, 'Member', 'Apps', 'ADMIN', '0', 2),
(8, '::1', 'datin@gmail.com', '$2y$08$8j4Zll4O.xm.y2V5tX1SvOocDT1qTOWMdQYfITF07/XmWxzpDAXfK', NULL, 'datin@gmail.com', NULL, NULL, NULL, 'X9wX0lIYwaTlcWyV5MlWMe', 1548390852, 1548669888, 1, 'Datin', 'Administrator', 'PT. PELABUHAN II KANTOR CABANG TANJUNG PRIOK', '02139999', 2),
(9, '::1', 'a@a.com', '$2y$08$oQTrCZI5Igc7Sim9LDKAE.4iwv/joLodCK9QQm1HjLTKD63kZ.5eu', NULL, 'a@a.com', NULL, NULL, NULL, NULL, 1566395156, 1566467078, 1, 'test', 'test', 'test', '12345', 2),
(10, '::1', 'b@b.com', '$2y$08$/5B1BOhp.A.EpwTk40sreexgonKzi3l/YmjYEK2a.3dhPbOCEXw8y', NULL, 'b@b.com', NULL, NULL, NULL, NULL, 1566396200, 1566398600, 1, 'test2', 'test2', 'test2', '1221211', 3),
(12, '::1', 'c@c.com', '$2y$08$bd3FSf6DdCGZpkEHOE02oeRMiZxv2.geGgUnZxLZyJ8kjryMxaG1q', NULL, 'c@c.com', NULL, NULL, NULL, NULL, 1566466531, 1566466831, 1, '23123', '13123', '12312', '12312312', 1),
(13, '10.200.16.13', 'hendy', '$2y$08$P/iJjk6Audu07Lm0UFjpyOipJcZCPM5/qHP5295zVtD8G80k2dwhK', NULL, 'hendy@gmail.com', NULL, NULL, NULL, NULL, 1566528817, 1566898311, 1, 'Hendy', 'Tisna', 'PT. CABPRIOK', '082211001489', 1),
(14, '10.200.16.13', 'ria', '$2y$08$sFqMX9yt00crVlva.Wrfcur/6g0AZtITuq65UrwD1w///yfQypYi2', NULL, 'ria@gmail.com', NULL, NULL, NULL, NULL, 1566532906, 1566532925, 1, 'RIA', 'PUTRANTY', 'PT. CABPRIOK', '567777', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(32, 1, 1),
(33, 1, 2),
(34, 1, 3),
(24, 2, 2),
(26, 8, 3),
(35, 9, 2),
(36, 10, 2),
(38, 12, 2),
(39, 13, 2),
(40, 14, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ak_data_adendum`
--
ALTER TABLE `ak_data_adendum`
 ADD PRIMARY KEY (`adendum_id`);

--
-- Indexes for table `ak_data_bidang`
--
ALTER TABLE `ak_data_bidang`
 ADD PRIMARY KEY (`bidang_id`);

--
-- Indexes for table `ak_data_eksploitasi`
--
ALTER TABLE `ak_data_eksploitasi`
 ADD PRIMARY KEY (`eksploitasi_id`);

--
-- Indexes for table `ak_data_investasi`
--
ALTER TABLE `ak_data_investasi`
 ADD PRIMARY KEY (`investasi_id`);

--
-- Indexes for table `ak_data_sewa_kategori`
--
ALTER TABLE `ak_data_sewa_kategori`
 ADD PRIMARY KEY (`sewa_kategori_id`);

--
-- Indexes for table `ak_data_sistem_app_info`
--
ALTER TABLE `ak_data_sistem_app_info`
 ADD PRIMARY KEY (`app_info_id`);

--
-- Indexes for table `ak_data_sistem_instansi`
--
ALTER TABLE `ak_data_sistem_instansi`
 ADD PRIMARY KEY (`instansi_id`);

--
-- Indexes for table `ak_data_sistem_log`
--
ALTER TABLE `ak_data_sistem_log`
 ADD PRIMARY KEY (`id`), ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `ak_data_vendor`
--
ALTER TABLE `ak_data_vendor`
 ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
 ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `sewa_properti`
--
ALTER TABLE `sewa_properti`
 ADD PRIMARY KEY (`sewa_properti_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ak_data_adendum`
--
ALTER TABLE `ak_data_adendum`
MODIFY `adendum_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ak_data_bidang`
--
ALTER TABLE `ak_data_bidang`
MODIFY `bidang_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `ak_data_eksploitasi`
--
ALTER TABLE `ak_data_eksploitasi`
MODIFY `eksploitasi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ak_data_investasi`
--
ALTER TABLE `ak_data_investasi`
MODIFY `investasi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ak_data_sewa_kategori`
--
ALTER TABLE `ak_data_sewa_kategori`
MODIFY `sewa_kategori_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ak_data_vendor`
--
ALTER TABLE `ak_data_vendor`
MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sewa_properti`
--
ALTER TABLE `sewa_properti`
MODIFY `sewa_properti_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
