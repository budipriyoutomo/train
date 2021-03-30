-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 11:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bogajaba_train`
--
CREATE DATABASE IF NOT EXISTS `bogajaba_train` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bogajaba_train`;

-- --------------------------------------------------------

--
-- Table structure for table `mdept`
--

CREATE TABLE `mdept` (
  `iddept` tinyint(4) NOT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mdept`
--

INSERT INTO `mdept` (`iddept`, `nama`) VALUES
(1, 'Services'),
(2, 'Kitchen'),
(3, 'IT'),
(4, 'HRD'),
(5, 'Accounting'),
(6, 'Purchasing'),
(7, 'PPIC'),
(8, 'GA'),
(9, 'Operational'),
(10, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `mjabatan`
--

CREATE TABLE `mjabatan` (
  `idjabatan` tinyint(4) NOT NULL,
  `iddept` tinyint(4) DEFAULT NULL,
  `namajabatan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mjabatan`
--

INSERT INTO `mjabatan` (`idjabatan`, `iddept`, `namajabatan`) VALUES
(1, 1, 'Waiter'),
(2, 1, 'Captain'),
(3, 2, 'Cook 1'),
(4, 2, 'Cook 2'),
(5, 2, 'Cook 3'),
(6, 3, 'Staff'),
(7, 3, 'Supervisor'),
(8, 10, 'BOD'),
(9, 9, 'BOD'),
(10, 10, 'General Manager'),
(11, 9, 'General Manager'),
(12, 9, 'Area Manager'),
(13, 1, 'Store Supervisor'),
(14, 1, 'Store Manager'),
(15, 1, 'Ass Store Manager'),
(16, 2, 'CDP'),
(17, 2, 'Chef Area'),
(18, 7, 'Manager'),
(19, 9, 'Training Manager');

-- --------------------------------------------------------

--
-- Table structure for table `mpengumuman`
--

CREATE TABLE `mpengumuman` (
  `id` int(11) NOT NULL,
  `pengumuman` text NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mpengumuman`
--

INSERT INTO `mpengumuman` (`id`, `pengumuman`, `start`, `end`) VALUES
(3, 'Pendaftaran untuk training all staf sebaiknya sudah selesai pada tanggal 13 Januari 2019 , karena di tanggal 14 Januari 2019 sudah akan mulai berjalan trainingnya. Silahkan Leader mengisi di kolom leader dan staf mengisi di nomor. Untuk kelas training nya sendiri akan dilaksanakan dari tanggal 14 januari sampai dengan 11 februari 2019', '2019-01-10', '2019-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `mtraining`
--

CREATE TABLE `mtraining` (
  `idtraining` tinyint(4) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tema` varchar(50) NOT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `trainer` varchar(30) DEFAULT NULL,
  `kapasitas` tinyint(4) DEFAULT NULL,
  `tersedia` tinyint(4) DEFAULT NULL,
  `terisi` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mtraining`
--

INSERT INTO `mtraining` (`idtraining`, `nama`, `tema`, `tempat`, `tanggal`, `jam`, `trainer`, `kapasitas`, `tersedia`, `terisi`) VALUES
(1, 'Training Leadership - Team Pla', '', 'Sushi tei Sumatra - VIP', '2018-12-10', '10:00:00', 'Steffie', 20, 10, 10),
(2, 'Training Leadership - Team Pla', '', 'Sushi tei Sumatra - VIP', '2018-12-11', '10:00:00', 'Steffie', 20, 6, 14),
(3, 'Training Leadership', '', 'Sushi tei Sumatra - VIP', '2018-12-17', '10:00:00', 'Steffie', 20, 16, 4),
(4, 'Training Leadership', '', 'Sushi tei Sumatra - VIP', '2018-12-18', '10:00:00', 'Steffie', 20, 5, 15),
(5, 'Training Soft Skill ALL staf', '', 'Sushi tei Sumatra - VIP', '2019-01-14', '08:00:00', 'Steffie', 25, 25, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rraport`
-- (See below for the actual view)
--
CREATE TABLE `rraport` (
`training` varchar(30)
,`iduser` int(11)
,`peserta` varchar(100)
,`NIK` varchar(10)
,`dept` varchar(2)
,`jabatan` varchar(2)
,`nilai` char(3)
,`evaluasi` text
);

-- --------------------------------------------------------

--
-- Table structure for table `rtraining`
--

CREATE TABLE `rtraining` (
  `nilai` char(3) DEFAULT NULL,
  `evaluasi` text DEFAULT NULL,
  `idtraining` tinyint(4) DEFAULT NULL,
  `namatraining` varchar(30) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `trainer` varchar(30) DEFAULT NULL,
  `terisi` tinyint(4) DEFAULT NULL,
  `peserta` varchar(100) DEFAULT NULL,
  `dept` varchar(2) DEFAULT NULL,
  `jabatan` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ttraining`
--

CREATE TABLE `ttraining` (
  `id` int(11) NOT NULL,
  `idtraining` tinyint(4) DEFAULT NULL,
  `iduser` tinyint(4) DEFAULT NULL,
  `kehadiran` char(1) DEFAULT NULL,
  `nilai` char(3) DEFAULT NULL,
  `evaluasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ttraining`
--

INSERT INTO `ttraining` (`id`, `idtraining`, `iduser`, `kehadiran`, `nilai`, `evaluasi`) VALUES
(0, 0, 1, '1', NULL, NULL),
(0, 1, 13, '1', NULL, NULL),
(0, 1, 22, '1', NULL, NULL),
(0, 1, 23, '1', NULL, NULL),
(0, 3, 22, '1', NULL, NULL),
(0, 3, 23, '1', NULL, NULL),
(0, 2, 21, '1', NULL, NULL),
(0, 2, 21, '1', NULL, NULL),
(0, 4, 21, '1', NULL, NULL),
(0, 2, 15, '1', NULL, NULL),
(0, 4, 15, '1', NULL, NULL),
(0, 2, 24, '1', NULL, NULL),
(0, 0, 46, '1', NULL, NULL),
(0, 4, 24, '1', NULL, NULL),
(0, 1, 46, '1', NULL, NULL),
(0, 4, 46, '1', NULL, NULL),
(0, 1, 37, '1', NULL, NULL),
(0, 4, 37, '1', NULL, NULL),
(0, 2, 26, '1', NULL, NULL),
(0, 1, 42, '1', NULL, NULL),
(0, 1, 17, '1', NULL, NULL),
(0, 4, 17, '1', NULL, NULL),
(0, 4, 42, '1', NULL, NULL),
(0, 1, 39, '1', NULL, NULL),
(0, 4, 39, '1', NULL, NULL),
(0, 1, 41, '1', NULL, NULL),
(0, 4, 41, '1', NULL, NULL),
(0, 2, 31, '1', NULL, NULL),
(0, 2, 51, '1', NULL, NULL),
(0, 4, 18, '1', NULL, NULL),
(0, 4, 18, '1', NULL, NULL),
(0, 1, 18, '1', NULL, NULL),
(0, 2, 18, '1', NULL, NULL),
(0, 2, 18, '1', NULL, NULL),
(0, 4, 18, '1', NULL, NULL),
(0, 2, 50, '1', NULL, NULL),
(0, 2, 48, '1', NULL, NULL),
(0, 2, 49, '1', NULL, NULL),
(0, 4, 49, '1', NULL, NULL),
(0, 2, 19, '1', NULL, NULL),
(0, 2, 28, '1', NULL, NULL),
(0, 4, 28, '1', NULL, NULL),
(0, 3, 49, '1', NULL, NULL),
(0, 3, 49, '1', NULL, NULL),
(0, 4, 27, '1', NULL, NULL),
(0, 4, 51, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('Admin','User','SuperAdmin') DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pp` varchar(20) DEFAULT NULL,
  `NIK` varchar(10) DEFAULT NULL,
  `dept` varchar(2) DEFAULT NULL,
  `jabatan` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama`, `pp`, `NIK`, `dept`, `jabatan`) VALUES
(1, 'admin', '9222e8edf1c3f65d9d87590914012f35e4676f0e', 'SuperAdmin', 'System Administrator', 'an.png', NULL, NULL, NULL),
(6, 'test', '9222e8edf1c3f65d9d87590914012f35e4676f0e', 'SuperAdmin', 'test1', 'an.png', NULL, NULL, NULL),
(11, 'evyanita', '596c6f893131998017d03e06aaa8765f55b01a59', 'Admin', 'Evy Anita', 'an.png', 'HO-7240905', '10', '8'),
(12, 'fellerlokanata', '2b0e6d80c7e0dc88d6b4db94cce633b47b81f31e', 'Admin', 'Feller Lokanata', 'an.png', 'HO-7250905', '9', '9'),
(13, 'melindaliyoto', 'b6423341847e1d62947d7fe6b5ae92d66c57c63b', 'Admin', 'Melinda Liyoto', 'an.png', 'HO-0830905', '10', '10'),
(14, 'ivansaputra', '0391ba2a836b6d8e60982e49d3434c2077a85be7', 'Admin', 'Ivan Saputra', 'an.png', 'ST-0881010', '9', '11'),
(15, 'michaelutomo', '66727110a3a6e5b3c0c9a98a6cc03260fedba71c', 'User', 'Michael Utomo', 'an.png', 'BG-0021017', '9', '12'),
(16, 'patrawibowo', '4bbcc4c8868ce5fa0c50fa9aed553a8c12f47272', 'User', 'Patra Wibowo', 'an.png', 'PL-0011207', '9', '12'),
(17, 'siscafebrianty', '94f209bad3b63ebc0008f3fb2ec0d41047a3d93e', 'User', 'Sisca Febrianty', 'an.png', 'ST-0600905', '9', '12'),
(18, 'rikarahmawati', '6d1af836011b3e0b201baf356bd3ba0ad61d5991', 'User', 'Rika Rahmawati', 'an.png', 'PL-4131217', '1', '13'),
(19, 'kurniawan', '7562f7c03b4aa311e4f2a902e34d30eb1fe4290e', 'User', 'Kurniawan', 'an.png', 'PL-0430711', '1', '13'),
(20, 'sannyillyusin', '0e4fd5923d701bab7ac104688a499c1331c8f77b', 'User', 'Sanny Illyusin', 'an.png', 'PL-0021207', '1', '14'),
(21, 'nanirahmawati', '22b76316f7d5413c0c17b862f68103a1efcadf70', 'User', 'Nani Rahmawati', 'an.png', 'PL-0180409', '1', '13'),
(22, 'juwitairama', '2dff69bec4bc667f0204c8d51afe6353bb2cf298', 'User', 'Juwita Irama', 'an.png', 'PL-0190709', '1', '13'),
(23, 'iwanhermawan', 'c0914f7eebceefb06c1b88ba1aebb95344ca10a1', 'User', 'Iwan Hermawan', 'an.png', 'PL-3290416', '1', '13'),
(24, 'mamaykurniawan', '1c146d86a628520b4a4dd888c28cfe3f545bf8f0', 'User', 'Mamay Kurniawan', 'an.png', 'PL-0520711', '1', '13'),
(25, 'bramantokurniawidi', '9937be03d2f440a64538717b4cb6fa28d85a6305', 'User', 'Bramanto Kurniawidi', 'an.png', 'PL-4240318', '1', '13'),
(26, 'pranindika', '61388d4c3783a903cc1934c4c31271e4b06d295d', 'User', 'Muh Kryogena Pranindika', 'an.png', 'FC-0021017', '1', '13'),
(27, 'marianamarlina', '2e75ee58402cb2848dce9ac1d6ecdc643dd55811', 'User', 'Mariana Marlina', 'an.png', 'FC-0080118', '1', '13'),
(28, 'noviaanriani', '4df4cfcbbe74674897baac2ddc9d0f1eafd406ef', 'User', 'Novia Anriani', 'an.png', 'FC-0071117', '2', '16'),
(29, 'irmajulianti', '7f97b58c1558316187d2b66d933a944bce0ef40c', 'User', 'Irma Julianti', 'an.png', 'BI-1120218', '1', '13'),
(30, 'mochsandi', '5da8114c7c57abcfa90761ea8c0f0429d8d1f86c', 'User', 'Moch. Sandi', 'an.png', 'BI-1051117', '1', '13'),
(31, 'septiansuhendi', '9ef7f55c5549f1deecfa0af4d6a0b55996fc0b53', 'User', 'Septian Suhendi', 'an.png', 'BI-1071217', '2', '16'),
(32, 'felixgunawan', '7c6ca416848b114fad65414ae89c45ef7b2c66f7', 'User', 'Felix Gunawan', 'an.png', 'SK-0101217', '1', '13'),
(33, 'winaristo', 'ebe8fa8b317686562902d93a7ed0d063c8a1d50d', 'User', 'Win Aristo', 'an.png', 'SK-0641217', '1', '13'),
(34, 'teddy', 'ccf8dd7f943d5922edd19c5da519521593acd193', 'User', 'Teddy', 'an.png', 'SK-0041017', '2', '16'),
(35, 'hendrygunadi', '8e606da3a4bd36f8bee59feb6fa6005309c8df4d', 'User', 'Hendry Gunadi', 'an.png', 'HO-6080514', '7', '18'),
(36, 'heriyanto', '008c90e1621f2e130b17deb6921f53ac0e69e07c', 'User', 'Heriyanto', 'an.png', 'ST-0280905', '2', '17'),
(37, 'shyllarizki', 'edb43ffcc0f06e032c327a2883ecdf80a91f8c18', 'User', 'Shylla Rizki', 'an.png', 'ST-4160912', '1', '15'),
(38, 'okysoniansyah', '38f5a07543f4c7de50b84d747fe4e5626ba34b9d', 'User', 'Oky Soniansyah', 'an.png', 'ST-2631111', '1', '13'),
(39, 'novitasumiaty', 'da35c6667b991566d54f1a94c73858c93f8fd60d', 'User', 'Novita Sumiaty', 'an.png', 'ST-2030211', '1', '13'),
(40, 'febyabdarosad', '3757a4aced8d99f5c435ac35f51af53aa7daf33c', 'User', 'Feby Abdarosad', 'an.png', 'ST-9830218', '1', '13'),
(41, 'lusynurochmah', 'b064009b0741e7d3d2278e8b53ea78d311775030', 'User', 'Lusy Nurochmah', 'an.png', 'ST-2941211', '1', '13'),
(42, 'sintarahayu', '37d1ef658c884f801bfc2f301539fb6a9764e808', 'User', 'Sinta Rahayu', 'an.png', 'ST-9261017', '1', '13'),
(43, 'pipinsolihin', 'fdb6de175eef9fba93e6214afa6d21ed6e8928d3', 'User', 'Pipin Solihin', 'an.png', 'ST-0520905', '2', '16'),
(44, 'andygunawan', 'bdf2eee1f9529aa1e41a278704cbae0b085ddb33', 'User', 'Andy Gunawan', 'an.png', 'ST-0051006', '2', '16'),
(45, 'yandinurcahya', '1027e907709137006887841004407e9283efb1c3', 'User', 'Yandi Nur Cahya', 'an.png', 'ST-0671207', '2', '16'),
(46, 'anamodsushitei', 'fad9f8baae05d87770b685e0f15e92902fb9589e', 'User', 'Ana Wihana', 'an.png', 'ST-1024061', '1', '13'),
(47, 'steffi', '9d46abe6cea539e88700a7940aecc84a8dbdcfb4', 'Admin', 'Steffi', 'an.png', '1', '9', '19'),
(48, 'erinawalia', '6e554778ef6989cbac54fb309d7cf1137fbc7cd9', 'User', 'Erin Awalia', 'an.png', 'PL-1', '1', '13'),
(49, 'andyafriandi', '05a992f39fd5c7e3d23b4a9cdf44750c5a86e931', 'User', 'Andy Afriandi Ishak', 'an.png', 'PL-2', '1', '13'),
(50, 'yuliyanti', 'b0650d655cea3b94c24b8af8b18b016a5a37090a', 'User', 'Yuliyanti', 'an.png', 'PL-3', '1', '13'),
(51, 'tantanherry', 'ec421d106a12e954bd9e8386ebd8ba1287deb471', 'User', 'Tantan Herry Hidayat', 'an.png', 'PL-4', '1', '13');

-- --------------------------------------------------------

--
-- Structure for view `rraport`
--
DROP TABLE IF EXISTS `rraport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`bogajabarco`@`localhost` SQL SECURITY DEFINER VIEW `rraport`  AS  (select `mtraining`.`nama` AS `training`,`user`.`id` AS `iduser`,`user`.`nama` AS `peserta`,`user`.`NIK` AS `NIK`,`user`.`dept` AS `dept`,`user`.`jabatan` AS `jabatan`,`ttraining`.`nilai` AS `nilai`,`ttraining`.`evaluasi` AS `evaluasi` from ((`user` join `ttraining`) join `mtraining`) where `user`.`id` = `ttraining`.`iduser` and `mtraining`.`idtraining` = `ttraining`.`idtraining`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdept`
--
ALTER TABLE `mdept`
  ADD PRIMARY KEY (`iddept`);

--
-- Indexes for table `mjabatan`
--
ALTER TABLE `mjabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `mpengumuman`
--
ALTER TABLE `mpengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtraining`
--
ALTER TABLE `mtraining`
  ADD PRIMARY KEY (`idtraining`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mpengumuman`
--
ALTER TABLE `mpengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mtraining`
--
ALTER TABLE `mtraining`
  MODIFY `idtraining` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
