-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 08:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmr`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `Id` int(11) NOT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `remark_fm_qa` varchar(100) DEFAULT NULL,
  `remark_spv_qa` varchar(100) DEFAULT NULL,
  `remark_mgr_qa` varchar(100) DEFAULT NULL,
  `remark_fm_ppc` varchar(100) DEFAULT NULL,
  `remark_spv_ppc` varchar(100) DEFAULT NULL,
  `remark_mgr_ppc` varchar(100) DEFAULT NULL,
  `remark_ta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctt`
--

CREATE TABLE `ctt` (
  `Id_ctt` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctt`
--

INSERT INTO `ctt` (`Id_ctt`, `Id`, `remark`) VALUES
(1, 5, 'aaaa'),
(2, 5, 'qqq');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `flags` varchar(20) NOT NULL DEFAULT 'queue',
  `send_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `phone_number`, `message`, `flags`, `send_dt`) VALUES
(1, '09142514261', 'Pemberitahuan CMRR! CMRR dengan nomor 01/CMR-4W/IX/24 telah dibuat oleh albin. Status menunggu approval foreman.', 'queue', NULL),
(2, '09142514261', 'Pemberitahuan CMR! CMR dengan nomor 01/CMR-4W/IX/24 telah diedit oleh albin. Status menunggu approval foreman.', 'queue', NULL),
(3, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 01/CMR-4W/IX/24 telah di reject oleh foreman QA favian dengan remark njca', 'queue', NULL),
(4, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 01/CMR-4W/IX/24 telah di reject oleh foreman QA favian dengan remark njca', 'queue', NULL),
(5, '0891919281', 'Pemberitahuan CMR! CMR dengan nomor 02/CMR-4W/VIII/24 telah di-approve oleh Foreman QA favian. Status menunggu approval supervisor.', 'queue', NULL),
(6, '081246172', 'Pemberitahuan NQR! NQR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Supervisor QA wew dengan remark adsd', 'queue', NULL),
(7, '08918291', 'Pemberitahuan NQR! NQR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Supervisor QA wew dengan remark adsd', 'queue', NULL),
(8, '08999999999', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di approve oleh Supervisor QA wew. Status menunggu approval Manager.', 'queue', NULL),
(9, '081246172', 'Pemberitahuan NQR! NQR dengan nomor  telah di reject oleh Manager QA rw dengan remark ads', 'queue', NULL),
(10, '08918291', 'Pemberitahuan NQR! NQR dengan nomor  telah di reject oleh Manager QA rw dengan remark ads', 'queue', NULL),
(11, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 12/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark DSA', 'queue', NULL),
(12, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 12/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark DSA', 'queue', NULL),
(13, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 25/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark A', 'queue', NULL),
(14, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 25/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark A', 'queue', NULL),
(15, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark AS', 'queue', NULL),
(16, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Manager QA rw dengan remark AS', 'queue', NULL),
(17, '0812346152', 'Pemberitahuan NQR! NQR dengan nomor  telah di approve oleh Manager QA rw. Status menunggu untuk di cek BOD.', 'queue', NULL),
(18, '089898989', 'Pemberitahuan NQR! NQR dengan nomor  telah di approve oleh Manager QA rw. Status menunggu untuk di cek BOD.', 'queue', NULL),
(19, '081246172', 'Pemberitahuan NQR! NQR dengan nomor  telah di reject oleh Manager QA  dengan remark ', 'queue', NULL),
(20, '08918291', 'Pemberitahuan NQR! NQR dengan nomor  telah di reject oleh Manager QA  dengan remark ', 'queue', NULL),
(21, '08111111111', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di approve oleh BOD & TA Baldo. Selanjutnya akan dilanjutkan oleh departemen PPC.', 'queue', NULL),
(22, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark ', 'queue', NULL),
(23, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark ', 'queue', NULL),
(24, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark ', 'queue', NULL),
(25, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark ', 'queue', NULL),
(26, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aqaq', 'queue', NULL),
(27, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aqaq', 'queue', NULL),
(28, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aaaaa', 'queue', NULL),
(29, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aaaaa', 'queue', NULL),
(30, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aq', 'queue', NULL),
(31, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark aq', 'queue', NULL),
(32, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(33, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(34, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(35, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(36, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(37, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(38, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(39, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark asas', 'queue', NULL),
(40, '081246172', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark assa', 'queue', NULL),
(41, '08918291', 'Pemberitahuan CMR! CMR dengan nomor 06/CMR-4W/III/24 telah di reject oleh BOD TA Baldo dengan remark assa', 'queue', NULL),
(42, '087777777777', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah dilanjutkan oleh ytw. Status menunggu approval foreman.', 'queue', NULL),
(43, '08111111111', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh foreman PPC ytw dengan remark aAAS', 'queue', NULL),
(44, '08717171717171', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di-approve oleh Foreman PPC . Status menunggu approval supervisor.', 'queue', NULL),
(45, '08111111111', 'Pemberitahuan NQR! NQR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Supervisor PPC fafa dengan remark asssa', 'queue', NULL),
(46, '083333333', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di approve oleh Supervisor PPC fafa. Status menunggu approval Manager.', 'queue', NULL),
(47, '08111111111', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Manager PPC fafa dengan remark aaaaq', 'queue', NULL),
(48, '0871728172', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di approve oleh Manager PPC fafa. Selanjutnya dilanjutkan oleh departemen VDD.', 'queue', NULL),
(49, '08918291872', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah dilanjutkan oleh uia. Status menunggu approval foreman.', 'queue', NULL),
(50, '0871728172', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh foreman VDD rtaq dengan remark SASAS', 'queue', NULL),
(51, '08919271821', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di-approve oleh Foreman VDD rtaq. Status menunggu approval supervisor.', 'queue', NULL),
(52, '0871728172', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh supervisor VDD tata dengan remark sasa', 'queue', NULL),
(53, '08999999999', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di approve oleh Supervisor QA . Status menunggu approval Manager.', 'queue', NULL),
(54, '0871728172', 'Pemberitahuan CMR! CMR dengan nomor 22/CMR-4W/III/24 telah di reject oleh Manager VDD yuay dengan remark adsds', 'queue', NULL),
(55, '08999999999', 'NQR dengan nomor 12/NQR/2024 belum diperiksa oleh Manager selama 6 bulan 10 hari 8 jam.', 'queue', NULL),
(56, '', 'NQR dengan nomor 192/NQR/III/2024 belum diperiksa oleh Supervisor selama 5 bulan 11 hari 22 jam.', 'queue', NULL),
(57, '0891919281', 'NQR dengan nomor 03/CMR-4W/III/24 belum diperiksa oleh Supervisor selama 5 bulan 10 hari 23 jam.', 'queue', NULL),
(58, '0891919281', 'CMR dengan nomor 03/CMR-4W/III/24 belum diperiksa oleh Supervisor selama 5 bulan 10 hari 23 jam.', 'queue', NULL),
(59, '0821309871', 'CMR dengan nomor 10/CMR-4W/III/24 belum diperiksa oleh Supervisor selama 7 bulan 21 hari 22 jam.', 'queue', NULL),
(60, '0891919281', 'CMR dengan nomor 10/CMR-4W/III/24 belum diperiksa oleh Supervisor selama 7 bulan 21 hari 22 jam.', 'queue', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_cmr`
--

CREATE TABLE `status_cmr` (
  `Id` int(11) NOT NULL,
  `sts_cmr` int(1) DEFAULT NULL,
  `status_qa` int(1) DEFAULT NULL,
  `status_op_qa` int(1) DEFAULT NULL,
  `nm_op_qa` varchar(100) DEFAULT NULL,
  `dt_op_qa` datetime DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `remark_fm_qa` varchar(100) DEFAULT NULL,
  `status_fm_qa` int(1) DEFAULT NULL,
  `nm_fm_qa` varchar(100) DEFAULT NULL,
  `dt_fm_qa` datetime NOT NULL,
  `status_spv_qa` int(1) NOT NULL,
  `nm_spv_qa` varchar(100) DEFAULT NULL,
  `dt_spv_qa` datetime NOT NULL,
  `remark_spv_qa` varchar(100) DEFAULT NULL,
  `status_mgr_qa` int(1) NOT NULL,
  `nm_mgr_qa` varchar(100) DEFAULT NULL,
  `dt_mgr_qa` datetime NOT NULL,
  `remark_mgr_qa` varchar(100) DEFAULT NULL,
  `feedback_qa` varchar(100) DEFAULT NULL,
  `status_ta` int(1) NOT NULL,
  `nm_ta` varchar(100) DEFAULT NULL,
  `dt_ta` datetime NOT NULL,
  `remark_ta` varchar(100) DEFAULT NULL,
  `feedbac_ta` varchar(200) DEFAULT NULL,
  `sts_cmr_ppc` int(1) NOT NULL,
  `sts_op_ppc` int(1) NOT NULL,
  `dt_op_ppc` datetime NOT NULL,
  `nm_op_ppc` varchar(100) DEFAULT NULL,
  `sts_fm_ppc` int(1) NOT NULL,
  `dt_fm_ppc` datetime NOT NULL,
  `remark_fm_ppc` varchar(100) DEFAULT NULL,
  `nm_fm_ppc` varchar(50) DEFAULT NULL,
  `sts_spv_ppc` int(1) NOT NULL,
  `dt_spv_ppc` datetime NOT NULL,
  `nm_spv_ppc` varchar(50) DEFAULT NULL,
  `remark_spv_ppc` varchar(100) DEFAULT NULL,
  `sts_mgr_ppc` int(1) NOT NULL,
  `dt_mgr_ppc` datetime NOT NULL,
  `nm_mgr_ppc` varchar(50) DEFAULT NULL,
  `remark_mgr_ppc` varchar(100) DEFAULT NULL,
  `feedback_ppc` varchar(100) DEFAULT NULL,
  `remark_ppc` varchar(100) NOT NULL,
  `sts_cmr_vdd` int(1) NOT NULL,
  `remark_vdd` varchar(100) DEFAULT NULL,
  `status_op_vdd` int(1) NOT NULL,
  `dt_op_vdd` datetime NOT NULL,
  `nm_op_vdd` varchar(50) DEFAULT NULL,
  `feedback_vdd` varchar(100) DEFAULT NULL,
  `status_fm_vdd` int(1) NOT NULL,
  `dt_fm_vdd` datetime NOT NULL,
  `nm_fm_vdd` varchar(50) DEFAULT NULL,
  `remark_fm_vdd` varchar(100) DEFAULT NULL,
  `status_spv_vdd` int(1) NOT NULL,
  `dt_spv_vdd` datetime NOT NULL,
  `nm_spv_vdd` varchar(50) DEFAULT NULL,
  `remark_spv_vdd` varchar(100) DEFAULT NULL,
  `status_mgr_vdd` int(1) NOT NULL,
  `dt_mgr_vdd` datetime NOT NULL,
  `nm_mgr_vdd` varchar(50) DEFAULT NULL,
  `remark_mgr_vdd` varchar(100) NOT NULL,
  `hapus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_cmr`
--

INSERT INTO `status_cmr` (`Id`, `sts_cmr`, `status_qa`, `status_op_qa`, `nm_op_qa`, `dt_op_qa`, `remark`, `remark_fm_qa`, `status_fm_qa`, `nm_fm_qa`, `dt_fm_qa`, `status_spv_qa`, `nm_spv_qa`, `dt_spv_qa`, `remark_spv_qa`, `status_mgr_qa`, `nm_mgr_qa`, `dt_mgr_qa`, `remark_mgr_qa`, `feedback_qa`, `status_ta`, `nm_ta`, `dt_ta`, `remark_ta`, `feedbac_ta`, `sts_cmr_ppc`, `sts_op_ppc`, `dt_op_ppc`, `nm_op_ppc`, `sts_fm_ppc`, `dt_fm_ppc`, `remark_fm_ppc`, `nm_fm_ppc`, `sts_spv_ppc`, `dt_spv_ppc`, `nm_spv_ppc`, `remark_spv_ppc`, `sts_mgr_ppc`, `dt_mgr_ppc`, `nm_mgr_ppc`, `remark_mgr_ppc`, `feedback_ppc`, `remark_ppc`, `sts_cmr_vdd`, `remark_vdd`, `status_op_vdd`, `dt_op_vdd`, `nm_op_vdd`, `feedback_vdd`, `status_fm_vdd`, `dt_fm_vdd`, `nm_fm_vdd`, `remark_fm_vdd`, `status_spv_vdd`, `dt_spv_vdd`, `nm_spv_vdd`, `remark_spv_vdd`, `status_mgr_vdd`, `dt_mgr_vdd`, `nm_mgr_vdd`, `remark_mgr_vdd`, `hapus`) VALUES
(1, 2, 1, 1, 'Albin Admin', '2024-03-21 07:19:21', 'aaw', 'aaw', 1, 'favian', '2024-09-02 13:39:23', 1, 'Albin Admin', '2024-03-22 10:58:13', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, '', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(3, 2, NULL, 1, 'Albin Admin', '2024-03-21 13:28:39', 'q\r\n', 'q\r\n', 1, 'Albin Admin', '2024-03-26 09:41:14', 1, 'Albin Admin', '2024-03-22 10:38:49', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(4, 2, NULL, 1, 'Albin Admin', '2024-03-21 13:31:52', 'azz', 'azz', 1, 'Albin Admin', '2024-03-28 09:56:29', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(5, 12, NULL, 1, 'Albin Admin', '2024-03-21 13:33:20', NULL, NULL, 1, 'Albin Admin', '2024-03-22 11:01:47', 1, 'Albin Admin', '2024-03-22 11:01:57', NULL, 1, 'Albin Admin', '2024-03-22 11:02:16', NULL, NULL, 2, 'Baldo', '2024-09-02 15:06:05', 'assa', NULL, 2, 1, '2024-08-26 08:23:33', 'Albin Admin', 2, '2024-04-01 09:22:46', 'mm', 'ytw', 1, '2024-03-26 10:45:36', 'Albin Admin', 's', 1, '2024-03-26 11:04:00', 'Albin Admin', 'aaqa', '', 'mm', 7, 'aaaw', 1, '2024-03-26 11:54:07', 'Albin Admin', '', 1, '2024-03-26 13:05:32', 'Albin Admin', 'aw', 2, '2024-03-27 09:25:28', 'Albin Admin', 'aaaw', 0, '0000-00-00 00:00:00', NULL, '', 0),
(6, 4, NULL, 1, 'Albin Admin', '2024-03-21 13:37:06', 'aw', NULL, 1, 'Albin Admin', '2024-03-22 10:59:05', 1, 'Albin Admin', '2024-03-22 10:59:13', NULL, 1, 'Albin Admin', '2024-08-26 07:42:18', 'aw', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 3, 0, '0000-00-00 00:00:00', NULL, 1, '2024-08-26 07:47:20', 'mm', 'Albin Admin', 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, 'mm', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(7, 2, NULL, 1, 'Albin Admin', '2024-03-22 15:15:25', NULL, NULL, 1, 'Albin Admin', '2024-03-28 08:49:26', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(8, 5, NULL, 1, 'Albin Admin', '2024-03-25 08:32:31', NULL, NULL, 1, 'Albin Admin', '2024-03-25 09:08:12', 1, 'Albin Admin', '2024-03-25 09:17:10', NULL, 1, 'Albin Admin', '2024-03-26 08:16:32', NULL, NULL, 1, 'Albin Admin', '2024-04-01 09:07:17', NULL, NULL, 5, 1, '2024-04-01 09:23:30', 'ytw', 1, '2024-04-01 09:24:34', NULL, 'ytw', 1, '2024-04-01 09:47:14', 'yatya', NULL, 1, '2024-04-01 10:11:14', 'fafa', NULL, '', '', 5, NULL, 1, '2024-04-01 10:19:19', 'Albin Admin', '', 1, '2024-04-01 10:21:10', 'rtaq', NULL, 1, '2024-04-01 10:25:51', 'tata', NULL, 1, '2024-04-01 10:29:35', 'yuay', '', 0),
(9, 2, NULL, 1, 'Albin Admin', '2024-03-25 08:48:08', NULL, NULL, 1, 'Albin Admin', '2024-03-26 09:43:39', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(10, 3, NULL, 1, 'Albin Admin', '2024-03-25 08:50:24', 'qq', 'qq', 1, 'Albin Admin', '2024-03-28 09:59:21', 1, 'Albin Admin', '2024-03-28 10:53:31', 'aza', 0, NULL, '0000-00-00 00:00:00', NULL, 'qaa', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(11, 4, NULL, 1, 'Albin Admin', '2024-03-25 08:53:38', 'qqa', NULL, 1, 'Albin Admin', '2024-03-25 09:25:27', 1, 'Albin Admin', '2024-03-28 08:41:03', 'qqa', 1, 'rw', '2024-09-02 14:09:35', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(12, 2, NULL, 1, 'Albin Admin', '2024-03-25 10:42:33', 'qqa', 'qqa', 1, 'Albin Admin', '2024-03-28 09:59:30', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', '', NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(13, 2, NULL, 1, 'Albin Admin', '2024-03-26 08:12:37', 'mm', 'mm', 1, 'Albin Admin', '2024-03-28 10:56:18', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(14, 5, NULL, 1, 'Albin Admin', '2024-03-26 09:32:40', NULL, NULL, 1, 'Albin Admin', '2024-03-26 09:39:20', 1, 'Albin Admin', '2024-03-26 09:47:59', NULL, 1, 'Albin Admin', '2024-03-26 09:49:13', NULL, NULL, 1, 'Albin Admin', '2024-03-26 09:54:44', NULL, NULL, 5, 1, '2024-03-26 13:13:52', 'Albin Admin', 1, '2024-03-27 09:22:11', NULL, 'Albin Admin', 1, '2024-03-26 13:17:48', 'Albin Admin', NULL, 1, '2024-08-26 10:22:34', 'Albin Admin', 'www', '', 'www', 5, 'aaa', 1, '2024-08-26 10:22:54', 'Albin Admin', '', 1, '2024-08-26 10:31:59', 'Albin Admin', NULL, 1, '2024-08-26 10:41:46', 'Albin Admin', 'aaaa', 1, '2024-08-26 10:44:29', 'Albin Admin', 'aaa', 0),
(15, 2, NULL, 1, 'Albin Admin', '2024-03-26 09:34:55', 'aa', 'aa', 1, 'Albin Admin', '2024-04-01 13:59:50', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(16, 9, NULL, 1, 'Albin Admin', '2024-03-27 14:31:48', 'aw', 'aw', 2, 'Albin Admin', '2024-04-01 14:00:12', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(17, 9, NULL, 1, 'Albin Admin', '2024-03-27 14:38:43', 'aw', 'aw', 2, 'Albin Admin', '2024-03-28 10:50:50', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(18, 9, NULL, 1, 'Albin Admin', '2024-03-27 14:40:49', 'aa', 'aa', 2, 'Albin Admin', '2024-03-28 08:42:27', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(19, 2, NULL, 1, 'Albin Admin', '2024-03-28 08:43:28', 'q', 'q', 1, 'Albin Admin', '2024-03-28 08:48:57', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(20, 0, NULL, 1, 'Albin Admin', '2024-03-28 08:54:20', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 1),
(21, 0, NULL, 1, 'Albin Admin', '2024-03-28 08:56:10', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 1),
(23, 0, NULL, 1, 'Albin Admin', '2024-03-28 09:27:02', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 3, 0, '0000-00-00 00:00:00', NULL, 1, '2024-04-01 09:40:51', NULL, 'yatya', 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 1),
(24, 5, NULL, 1, 'Albin Admin', '2024-03-28 09:31:18', 'AS', NULL, 1, 'Albin Admin', '2024-03-28 13:22:18', 1, 'wew', '2024-09-02 13:48:10', NULL, 1, 'rw', '2024-09-02 14:12:39', 'AS', NULL, 1, 'Baldo', '2024-09-02 14:52:19', NULL, NULL, 5, 1, '2024-09-02 15:14:36', 'ytw', 1, '2024-09-02 15:24:21', 'aAAS', 'ytw', 1, '2024-09-02 15:21:37', 'fafa', 'asssa', 1, '2024-09-02 15:24:35', 'fafa', 'aaaaq', '', 'aaaaq', 5, 'adsds', 1, '2024-09-02 15:26:52', 'uia', '', 1, '2024-09-02 15:29:53', 'rtaq', 'SASAS', 1, '2024-09-02 15:32:26', 'tata', 'sasa', 1, '2024-09-02 15:34:37', 'yuay', 'adsds', 0),
(25, 5, NULL, 1, 'Albin Admin', '2024-03-28 09:37:35', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', 1, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 3, 1, '2024-04-01 09:08:40', 'Albin Admin', 1, '2024-04-01 09:23:08', NULL, 'ytw', 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, '', '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(26, 10, NULL, 1, 'Albin Admin', '2024-03-28 10:16:32', 'qqqq', NULL, 1, 'Albin Admin', '2024-03-28 10:57:43', 2, 'wew', '2024-04-01 08:10:20', 'qqqq', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(27, 3, NULL, 1, 'Albin Admin', '2024-03-28 10:24:29', NULL, NULL, 1, 'Albin Admin', '2024-03-28 10:59:44', 1, 'wew', '2024-04-01 08:10:08', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(28, 0, NULL, 1, 'Albin Admin', '2024-04-01 13:52:01', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 1),
(29, 2, NULL, 1, 'Albin Admin', '2024-04-01 13:53:25', NULL, NULL, 1, 'Albin Admin', '2024-08-23 15:44:57', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(30, 1, NULL, 1, 'Albin Admin', '2024-04-01 13:54:37', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(31, 0, NULL, 1, 'Albin Admin', '2024-05-20 08:37:55', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 1),
(32, 1, NULL, 1, 'Albin Admin', '2024-05-20 08:40:45', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, 'aaaaaa', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(33, 1, NULL, 1, 'Albin Admin', '2024-05-20 10:09:57', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(34, 1, NULL, 1, 'Albin Admin', '2024-05-20 10:11:31', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, '1', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(35, 1, NULL, 1, 'Albin Admin', '2024-08-23 15:15:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, '1', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(36, 2, NULL, 1, 'Albin Admin', '2024-08-23 15:23:24', NULL, NULL, 1, 'favian', '2024-09-02 13:42:16', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(37, 2, NULL, 1, 'Albin Admin', '2024-08-23 15:25:42', NULL, NULL, 1, 'favian', '2024-09-02 13:39:58', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(38, 1, NULL, 1, 'Albin Admin', '2024-08-23 15:26:45', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, 'a', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0),
(39, 1, NULL, 1, 'albin', '2024-09-02 13:29:42', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', 0, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, '0000-00-00 00:00:00', NULL, 'a', 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, 0, '0000-00-00 00:00:00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, '', 0, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, NULL, 0, '0000-00-00 00:00:00', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id` int(11) NOT NULL,
  `cmr_no` varchar(100) DEFAULT NULL,
  `supp_name` varchar(100) DEFAULT NULL,
  `found_dt` date DEFAULT NULL,
  `kybNo` varchar(20) DEFAULT NULL,
  `bl_dt` date DEFAULT NULL,
  `ar_dt` date DEFAULT NULL,
  `iss_dt` date DEFAULT NULL,
  `lco` int(1) DEFAULT NULL,
  `doi1` int(1) DEFAULT NULL,
  `doi2` int(1) DEFAULT NULL,
  `cof` int(1) DEFAULT NULL,
  `dispatch` int(1) DEFAULT NULL,
  `dispo` int(1) DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `order_no` varchar(100) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `part_name` varchar(100) DEFAULT NULL,
  `part_num` varchar(100) DEFAULT NULL,
  `qty_order` varchar(50) DEFAULT NULL,
  `qty_del` varchar(50) DEFAULT NULL,
  `qty_def` varchar(20) DEFAULT NULL,
  `crate_num` varchar(20) DEFAULT NULL,
  `hand_dt` date DEFAULT NULL,
  `problem` varchar(100) DEFAULT NULL,
  `dotc` int(1) DEFAULT NULL,
  `stc` int(1) DEFAULT NULL,
  `dt_stc` date NOT NULL,
  `pay` varchar(100) DEFAULT NULL,
  `att` varchar(200) NOT NULL,
  `feedback` varchar(200) DEFAULT NULL,
  `hapus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id`, `cmr_no`, `supp_name`, `found_dt`, `kybNo`, `bl_dt`, `ar_dt`, `iss_dt`, `lco`, `doi1`, `doi2`, `cof`, `dispatch`, `dispo`, `invoice`, `order_no`, `product`, `model`, `part_name`, `part_num`, `qty_order`, `qty_del`, `qty_def`, `crate_num`, `hand_dt`, `problem`, `dotc`, `stc`, `dt_stc`, `pay`, `att`, `feedback`, `hapus`) VALUES
(1, '01/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-03', NULL, NULL, '2024-03-03', '2024-03-11', 2, 2, 1, 1, NULL, 3, '3002020008077+3002020009232', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', '2022-01-31', 'tata', NULL, NULL, '0000-00-00', NULL, '', NULL, 0),
(3, '03/CMR-4W/III/24', 'PTUBE INVESMENT of INDIA', '2024-03-03', NULL, NULL, '2024-03-03', '2024-03-11', 1, 1, 1, 1, NULL, 2, '3002020008077+3002020009232', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'tata', NULL, NULL, '0000-00-00', NULL, '1711002519_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(4, '05/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-03', NULL, NULL, '2024-03-01', '2024-03-11', 1, 1, 4, 2, NULL, 2, 'aWWWWW', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'rrr', NULL, NULL, '0000-00-00', NULL, '1711002712_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(5, '06/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-04', NULL, NULL, '2024-03-01', '2024-03-04', 1, 1, 4, 1, NULL, 2, 'aWWWWW', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'qqq', 2, 1, '2024-08-07', '', '1711002800_CV_Albin_Favian.pdf', NULL, 0),
(6, '07/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-04', NULL, NULL, '2024-03-03', '2024-03-04', 1, 1, 2, 1, NULL, 1, '3002020008077+3002020009232', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'qaa', 1, NULL, '0000-00-00', NULL, '1711003026_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 0),
(7, '08/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-04', 1, 1, 3, 2, NULL, 1, 'MRB61616', 'QQQQQ', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'aaa', NULL, NULL, '0000-00-00', NULL, '1711095325_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(8, '09/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-11', 2, 1, 3, 2, NULL, 1, '55515155151', '--', 'WA', '', 'APA', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'AQA', 1, 0, '0000-00-00', '$3222', '1711330351_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(9, '10/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-04', 2, 3, 4, 3, NULL, 1, 'MRB61616', 'QQQQQ', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'kjl', NULL, NULL, '0000-00-00', NULL, '1711331288_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(10, '11/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-11', NULL, NULL, '2024-03-04', '2024-03-04', 2, 1, 4, 3, NULL, 3, 'WQWQWQ', '', 'WA', '', 'RM STEEL TUBE', '202102', '7.777', '766', '333', '', NULL, 'j', NULL, NULL, '0000-00-00', NULL, '1711331424_CV_Albin_Favian.pdf', NULL, 0),
(11, '12/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-11', NULL, NULL, '2024-03-04', '2024-03-04', 2, 2, 3, 2, NULL, 1, 'WQWQWQ', '', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'jj', NULL, NULL, '0000-00-00', NULL, '1711331618_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 0),
(12, '13/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-11', 2, 2, 4, 1, NULL, 1, '55515155151', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'n', NULL, NULL, '0000-00-00', NULL, '1711338153_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(13, '14/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-03', NULL, NULL, '2024-03-03', '2024-03-11', 2, 2, 4, 3, NULL, 1, '3002020008077+3002020009232', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'tata', NULL, NULL, '0000-00-00', NULL, '1711415557_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(14, '15/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-03', 3, 1, 4, 1, NULL, 1, '55515155151', '11', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'hg', 1, 0, '0000-00-00', '$6161', '1711420360_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(15, '16/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-03', NULL, NULL, '2024-03-03', '2024-03-11', 2, 1, 3, 3, NULL, 1, 'aWWWWW', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'q', NULL, NULL, '0000-00-00', NULL, '1711420495_Log Book_Bulan Februari_2024_Albin Favian.pdf', NULL, 0),
(16, '17/CMR-4W/III/24', 'TOYOTA TSUSHO CORPORATION', '2024-03-04', NULL, NULL, '2024-03-05', '2024-03-05', 2, 1, 3, 1, NULL, 2, 'QQQQ', 'QQQQQ', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'HAHAHA', NULL, NULL, '0000-00-00', NULL, '1711524708_CV_Albin_Favian.pdf', NULL, 0),
(17, '18/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-03', 2, 1, 4, 4, NULL, 1, '3002020008077+3002020009232', 'YYA612', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'gvgghhu', NULL, NULL, '0000-00-00', NULL, '1711525123_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(18, '19/CMR-4W/III/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-03', 1, 1, 3, 2, NULL, 3, 'WQWQWQ', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'WAWWA', NULL, NULL, '0000-00-00', NULL, '1711525249_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 0),
(19, '20/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-11', NULL, NULL, '2024-03-04', '2024-03-10', 2, 2, 2, 2, NULL, 2, 'QQQQ', 'QQQQQ', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'm', NULL, NULL, '0000-00-00', NULL, '1711590208_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(20, '21/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-04', NULL, NULL, '2024-03-03', '2024-03-04', 3, 2, 1, 1, NULL, 1, 'MRB61616', 'YYA612', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'QA', NULL, NULL, '0000-00-00', NULL, '1711590860_CV_Albin_Favian.pdf', NULL, 1),
(21, '22/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-06', 2, 1, 3, 3, NULL, 1, 'QQQQ', '--', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'J', NULL, NULL, '0000-00-00', NULL, '1711590970_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 1),
(23, '21/CMR-4W/III/24', 'TOYOTA TSHUSO CORPORATION', '2024-03-05', NULL, NULL, '2024-03-03', '2024-03-03', 2, 1, 3, 2, NULL, 2, 'QQQQ', '1', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'k', 1, NULL, '0000-00-00', NULL, '1711592822_CV_Albin_Favian.pdf', NULL, 1),
(24, '22/CMR-4W/III/24', 'HWANGHWA MACHINERY CO.,LTD.', '2024-03-03', NULL, NULL, '2024-03-10', '2024-03-03', 2, 2, 4, 1, NULL, 2, 'WQWQWQ', '1', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, 'u', 2, 1, '2024-09-10', '', '1711593078_CV_Albin_Favian.pdf', NULL, 0),
(25, '23/CMR-4W/III/24', 'KOREA INTER CROSS', '2024-03-02', NULL, NULL, '2024-03-10', '2024-03-04', 2, 3, 2, 2, NULL, 1, '999', '--', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '9.999', '88', '', NULL, 'j', 1, 0, '0000-00-00', NULL, '1711593455_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(26, '24/CMR-4W/III/24', 'HWANGHWA MACHINERY CO.,LTD.', '2024-03-03', NULL, NULL, '2024-03-10', '2024-03-03', 3, 2, 4, 3, NULL, 1, '55515155151', '1', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, '', NULL, NULL, '0000-00-00', NULL, '1711595792_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 0),
(27, '25/CMR-4W/III/24', 'TUBE INVESMENT of INDIA', '2024-03-04', NULL, NULL, '2024-03-04', '2024-03-06', 1, 1, 3, 2, NULL, 3, 'MRB61616', '--', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '333', '', NULL, '', NULL, NULL, '0000-00-00', NULL, '1711596269_LogBook_Februari 2024_Albin Favian(1321065).pdf', NULL, 0),
(28, '01/CMR-4W/IV/24', 'TOYOTA TSHUSO CORPORATION', '2024-04-07', NULL, NULL, '2024-04-01', '2024-04-08', 2, 1, 3, 5, NULL, 2, '8181QQU', '--', 'LAH', '', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '611.661', '11', '', NULL, 'AAQA', NULL, NULL, '0000-00-00', NULL, '1711954321_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 1),
(29, '02/CMR-4W/IV/24', 'HWANGHWA MACHINERY CO.,LTD.', '2024-04-14', NULL, NULL, '2024-04-14', '2024-04-22', 3, 2, 4, 4, NULL, 3, 'MRB61616', '12', 'WAW', '', 'RM STEEL TUBE', '24.00 X 20.00', '77', '1', '111', '', NULL, '1', NULL, NULL, '0000-00-00', NULL, '1711954405_CV_Albin_Favian.pdf', NULL, 0),
(30, '03/CMR-4W/IV/24', 'TUBE INVESMENT of INDIA', '2024-04-07', NULL, NULL, '2024-04-08', '2024-04-15', 2, 3, 4, 4, NULL, 1, 'aWWWWW', '-', 'WA', '', 'RM STEEL TUBE', '24.00 X 20.00', '1', '1', '1', '', NULL, 'a', NULL, NULL, '0000-00-00', NULL, '1711954477_Surat_Pengajuan_Proses_Bimbingan.pdf', NULL, 0),
(31, '01/CMR-4W/V/24', 'KYB WUXI TOP', '2024-05-02', NULL, NULL, '2024-05-05', '2024-05-05', 2, 3, 1, 1, NULL, 1, 'ko87', '-', 'kjt', 'iui', 'RM STEEL TUBE', '24.00 X 20.00', '1', '1', '8', '', NULL, 'khfy', NULL, NULL, '0000-00-00', NULL, '1716169075_DANIEL_KEVIN_GABRIEL_SIHOMBING_CV[1].pdf', NULL, 1),
(32, '02/CMR-4W/V/24', 'KYB WUXI TOP', '2024-05-01', NULL, NULL, '2024-05-04', '2024-05-06', 2, 1, 3, 2, NULL, 1, '9191', '1', '9191', 'NJU2', 'APA', '24.00 X 20.00', '1', '1', '1', 'a', NULL, 'AQ', NULL, NULL, '0000-00-00', NULL, '1716169245_DANIEL_KEVIN_GABRIEL_SIHOMBING_CV[1].pdf', 'aaaaaa', 0),
(33, '03/CMR-4W/V/24', 'KYB WUXI TOP', '2024-05-07', '', '1970-01-01', '2024-05-01', '2024-05-06', 2, 1, 3, 2, NULL, 3, 'WQWQWQ', '1', '919', '1', 'RM STEEL TUBE', '24.00 X 20.00', '1', '1', '1', '', NULL, '', NULL, NULL, '0000-00-00', NULL, '1716174597_DANIEL_KEVIN_GABRIEL_SIHOMBING_CV[1].pdf', NULL, 0),
(34, '04/CMR-4W/V/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-05-06', '', '1970-01-01', '2024-05-05', '2024-05-08', 1, 2, 1, 4, NULL, 2, 'QQQQ', '1', '919', '1', 'RM STEEL TUBE', '24.00 X 20.00', '1', '1', '1', 'q', NULL, '1', NULL, NULL, '0000-00-00', NULL, '1716174691_DANIEL_KEVIN_GABRIEL_SIHOMBING_CV[1].pdf', NULL, 0),
(35, '01/CMR-4W/VIII/24', 'TUBE INVESMENT of INDIA', '2024-08-12', 'wud', '2024-08-26', '2024-08-12', '2024-08-19', 1, 1, 2, 1, NULL, 2, 'bjwdc', '1', 'qnjdw', 'knlqw', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '766', '8', '1', NULL, '1', NULL, NULL, '0000-00-00', NULL, '1724400900_NilaiPrakerin1_AlbinFavian_1321065.pdf', NULL, 0),
(36, '02/CMR-4W/VIII/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-08-12', 'wud', '2024-08-26', '2024-08-06', '2024-08-12', 1, 1, 3, 1, NULL, 3, 'WQWQWQ', '1', 'kjt', 'knlqw', 'RM STEEL TUBE', '24.00 X 20.00', '1', '231', '321', '', NULL, '', NULL, NULL, '0000-00-00', NULL, '1724401404_penilaian1.pdf', NULL, 0),
(37, '03/CMR-4W/VIII/24', 'TOYOTA TSHUSO CORPORATION', '2024-08-07', 'wud', '2024-08-04', '2024-08-31', '2024-08-06', 2, 3, 2, 3, NULL, 1, '3002020008077+3002020009232', '1', 'LAH', 'NJU2', 'RM STEEL TUBE', '24.00 X 20.00', '77', '766', '111', '', NULL, 'dsg', NULL, NULL, '0000-00-00', NULL, '1724401542_penilaian1.pdf', NULL, 0),
(38, '04/CMR-4W/VIII/24', 'TOYOTA TSHUSO CORPORATION', '2024-08-13', 'wud', '2024-08-26', '2024-08-05', '2024-08-13', 3, 1, 4, 3, NULL, 1, '3002020008077+3002020009232', '1', 'LAH', 'NJU2', 'RM STEEL TUBE', '24.00 X 20.00', '77', '766', '111', '321', NULL, 'dsgaaq', NULL, NULL, '0000-00-00', NULL, '1724401605_LEMBAR BIMBINGAN PENYUSUNAN LAPORAN PRAKERIN.pdf', NULL, 0),
(39, '01/CMR-4W/IX/24', 'PT NIPPON TSHUSHO INDONESIA', '2024-09-15', 'wud', '2024-09-18', '2024-09-11', '2024-09-19', 2, 1, 3, 1, NULL, 1, 'aWWWWW', 'MRQRQR666', 'WAW', 'q', 'RM STEEL TUBE', '24.00 X 20.00', '7.777', '231', '11', 'a', NULL, 'dsg', NULL, NULL, '0000-00-00', NULL, '1725258582_NilaiPrakerin1_AlbinFavian_1321065.pdf', 'a', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `ctt`
--
ALTER TABLE `ctt`
  ADD PRIMARY KEY (`Id_ctt`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_cmr`
--
ALTER TABLE `status_cmr`
  ADD UNIQUE KEY `Foreign Key` (`Id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ctt`
--
ALTER TABLE `ctt`
  MODIFY `Id_ctt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `catatan_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `transaksi` (`Id`);

--
-- Constraints for table `ctt`
--
ALTER TABLE `ctt`
  ADD CONSTRAINT `ctt_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `transaksi` (`Id`);

--
-- Constraints for table `status_cmr`
--
ALTER TABLE `status_cmr`
  ADD CONSTRAINT `status_cmr_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `transaksi` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
