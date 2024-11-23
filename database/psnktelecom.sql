-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 10:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psnktelecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `au_all`
--

CREATE TABLE `au_all` (
  `au_id` int(4) NOT NULL,
  `au_name` varchar(100) NOT NULL,
  `au_detail` varchar(255) NOT NULL,
  `au_type` varchar(20) NOT NULL,
  `au_price` double(9,2) NOT NULL,
  `au_company` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `au_all`
--

INSERT INTO `au_all` (`au_id`, `au_name`, `au_detail`, `au_type`, `au_price`, `au_company`) VALUES
(3, 'SM13075-0100090001-TH', 'Splicing OF-Cable on Aerial, Underground, In Building < 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 1338.75, 'FBH'),
(4, 'SM13075-0100090002-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2097.38, 'FBH'),
(5, 'SM13075-0100090003-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 24 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2900.63, 'FBH'),
(6, 'SM13075-0100090004-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 36 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 3748.50, 'FBH'),
(7, 'SM13075-0100090005-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 48 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4239.38, 'FBH'),
(8, 'SM13075-0100090006-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 60 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4808.79, 'FBH'),
(9, 'SM13075-0100100001-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
(10, 'SM13075-0100100002-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
(11, 'SM13075-0100100003-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
(12, 'SM13075-0100110001-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
(13, 'SM13075-0100110002-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
(14, 'SM13075-0100110003-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
(15, 'SM13075-0100170001-TH', 'Installation+Splicing L2 Splitter included Test E2E', 'Set', 870.19, 'FBH'),
(16, 'SM13075-0100190001-TH', 'Design by QRUN included Sync Test Best, Sync IM', 'M', 0.58, 'FBH'),
(17, 'SM13075-0100200001-TH', 'Remove OFC cable Y(N)', 'M', 1.34, 'FBH'),
(18, 'SM13075-0100200002-TH', 'Remove OFC cable Y(R)', 'M', 3.57, 'FBH'),
(19, 'SM13075-0100240002-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง เชียงใหม่ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.23, 'FBH'),
(20, 'SM13075-0100240003-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง น่าน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
(21, 'SM13075-0100240004-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง พะเยา ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
(22, 'SM13075-0100240005-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง แพร่ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.18, 'FBH'),
(23, 'SM13075-0100240006-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง แม่ฮ่องสอน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.30, 'FBH'),
(24, 'SM13075-0100240007-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำปาง ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.20, 'FBH'),
(25, 'SM13075-0100240008-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำพูน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
(26, 'SM13075-0100240009-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง อุตรดิตถ์ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.21, 'FBH'),
(27, 'SM13075-0100250004-TH', 'Digitize Base Map for Survey (Grid)', 'EA', 200.82, 'FBH'),
(28, 'SM13075-0100290001-TH', 'Digitize 1 - 50 HH คิดต่อ Grid  สำหรับ Happy Block', 'EA', 803.25, 'FBH'),
(29, 'SM13075-0100290002-TH', 'จำนวนบ้านส่วนที่เกินตั้งแต่ 51 ถึง 250 HH ใน Grid นั้น คิดต่อ HH สำหรับ Happy Block', 'EA', 8.93, 'FBH'),
(30, 'SM13075-0100290003-TH', 'Digitize Grid >250HH เหมาจ่าย/Grid (สำหรับผู้รับเหมาในสัญญาปกติ) สำหรับ Happy Block', 'EA', 1338.75, 'FBH'),
(31, 'SM13075-0100300001-TH', 'Detail Design for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1428.00, 'FBH'),
(32, 'SM13075-0100300002-TH', 'Detail Design for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 2856.00, 'FBH'),
(33, 'SM13075-0100300003-TH', 'Detail Design for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 3480.75, 'FBH'),
(34, 'SM13075-0100300004-TH', 'Detail Design for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 4462.50, 'FBH'),
(35, 'SM13075-0100300005-TH', 'Detail Design for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 5131.88, 'FBH'),
(36, 'SM13075-0100300006-TH', 'Detail Design for FTTH MDU >700 Homepass (Design บน Autocad)', 'SET', 5801.25, 'FBH'),
(37, 'SM13075-0100310001-TH', 'Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 626.54, 'FBH'),
(38, 'SM13075-0100310002-TH', 'Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1253.07, 'FBH'),
(39, 'SM13075-0100310003-TH', 'Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1606.50, 'FBH'),
(40, 'SM13075-0100310004-TH', 'Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2231.25, 'FBH'),
(41, 'SM13075-0100310005-TH', 'Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2677.50, 'FBH'),
(42, 'SM13075-0100310006-TH', 'Drawing for FTTH MDU >700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 4016.25, 'FBH'),
(43, 'SM13075-0100320001-TH', 'Final As-built Drawing approved for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 208.85, 'FBH'),
(44, 'SM13075-0100320002-TH', 'Final As-built Drawing approved for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 417.69, 'FBH'),
(45, 'SM13075-0100320003-TH', 'Final As-built Drawing approved for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 580.13, 'FBH'),
(46, 'SM13075-0100320004-TH', 'Final As-built Drawing approved for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 892.50, 'FBH'),
(47, 'SM13075-0100320005-TH', 'Final As-built Drawing approved for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1071.00, 'FBH'),
(48, 'SM13075-0100320006-TH', 'Final As-built Drawing approved for FTTH MDU >700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1785.00, 'FBH'),
(49, 'SM13075-0100320007-TH', 'Final As-built Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 133.88, 'FBH'),
(50, 'SM13075-0100320008-TH', 'Final As-built Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 267.75, 'FBH'),
(51, 'SM13075-0100320009-TH', 'Final As-built Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 357.00, 'FBH'),
(52, 'SM13075-0100320010-TH', 'Final As-built Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 535.50, 'FBH'),
(53, 'SM13075-0100320011-TH', 'Final As-built Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 714.00, 'FBH'),
(54, 'TPCHDMX006C', 'Cable installation service Outdoor Arial including survey Drawing and all material e.g. sticker according to PEA/MEA/Authorities standard', 'Meter', 11.00, 'Mixed'),
(55, 'Mix-TD-17.85', 'Test & Verify Fiber (Test Power Meter - Light Source & Test OTDR Core Spare) Site to Site (A-Z และ Z-A)', 'Set', 5000.00, 'Mixed'),
(56, 'TPCHDMX008C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.20, 'Mixed'),
(57, 'TPUHD54051A', 'Splicing OF-Cable on Aerial 12 Fibers', 'EA', 3250.00, 'Mixed'),
(58, 'TPUHD54052A', 'Splicing OF-Cable on Aerial 24 Fibers', 'EA', 4550.00, 'Mixed'),
(59, 'TPUHD54055A', 'Splicing OF-Cable on Aerial 60 Fibers', 'EA', 7500.00, 'Mixed'),
(60, 'TPCHDMX132C', 'Pre survey for designated hop (Hi-level Keymap) in case not installation cable in this route', 'Route', 1800.00, 'Mixed'),
(61, 'TPCHDMX001C', 'Cable installation service in-building including survey Drawing  duct and all material', 'Meter', 158.40, 'Mixed'),
(62, 'TPCHDMX002C', 'Cable installation service indoor in provided or constructed conduit or duct. Including survey and drawing ', 'Meter', 21.24, 'Mixed'),
(63, 'TPCHDMX003C', 'Service charge for Installation Optical Fiber Cable in building. (Per Site)', 'Site', 2520.00, 'Mixed'),
(64, 'TPCHDMX004C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.20, 'Mixed'),
(65, 'TPCHDMX005C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
(66, 'TPCHDMX007C', 'Cable installation service Outdoor in provided or constructed conduit Including survey and drawing ', 'Meter', 11.00, 'Mixed'),
(67, 'TPCHDMX009C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
(68, 'TPCHDMX010C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 273.60, 'Mixed'),
(69, 'TPCHDMX011C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 420.00, 'Mixed'),
(70, 'TPCHDMX012C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 410.40, 'Mixed'),
(71, 'TPCHDMX013C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 495.36, 'Mixed'),
(72, 'TPCHDMX014C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 840.00, 'Mixed'),
(73, 'TPCHDMX015C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 756.00, 'Mixed'),
(74, 'TPCHDMX016C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 777.60, 'Mixed'),
(75, 'TPCHDMX017C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 1500.00, 'Mixed'),
(76, 'TPCHDMX018C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1080.00, 'Mixed'),
(77, 'TPCHDMX019C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 360.00, 'Mixed'),
(78, 'TPCHDMX020C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 650.00, 'Mixed'),
(79, 'TPCHDMX021C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 612.00, 'Mixed'),
(80, 'TPCHDMX022C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 720.00, 'Mixed'),
(81, 'TPCHDMX023C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1000.00, 'Mixed'),
(82, 'TPCHDMX024C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 900.00, 'Mixed'),
(83, 'TPCHDMX025C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 972.00, 'Mixed'),
(84, 'TPCHDMX026C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 2000.00, 'Mixed'),
(85, 'TPCHDMX027C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1800.00, 'Mixed'),
(86, 'TPCHDMX028C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1200.00, 'Mixed'),
(87, 'TPCHDMX029A', 'Construction for conduit 1 x 3/4\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 52.89, 'Mixed'),
(88, 'TPCHDMX030A', 'Install and Supply material  Cross 1 x 4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'M', 450.00, 'Mixed'),
(89, 'TPCHDMX031A', ' Install and Supply material  Riser Pole 1-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 1500.00, 'Mixed'),
(90, 'TPCHDMX032A', 'Install and Supply material Riser Pole 2-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 2500.00, 'Mixed'),
(91, 'TPCHDMX033A', 'Install and Supply material Riser Pole 4-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 4200.00, 'Mixed'),
(92, 'TPCHDMX034A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 1800.00, 'Mixed'),
(93, 'TPCHDMX035A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 3024.00, 'Mixed'),
(94, 'TPCHDMX036A', 'Construction for conduit 1 x 1\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 72.00, 'Mixed'),
(95, 'TPCHDMX037A', 'Construction for conduit 1 x 2\" inside building  Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 174.02, 'Mixed'),
(96, 'TPCHDMX038A', 'Construction for conduit 1 x 3/4\" outside building Material type IMC', 'Meter', 75.60, 'Mixed'),
(97, 'TPCHDMX039A', 'Construction for conduit 1 x 1\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 111.60, 'Mixed'),
(98, 'TPCHDMX040A', 'Construction for conduit 1 x 2\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 226.08, 'Mixed'),
(99, 'TPCHDMX041A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 13680.00, 'Mixed'),
(100, 'TPCHDMX042A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 23040.00, 'Mixed'),
(101, 'TPCHDMX043A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 27360.00, 'Mixed'),
(102, 'TPCHDMX044A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 21600.00, 'Mixed'),
(103, 'TPCHDMX045A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 33120.00, 'Mixed'),
(104, 'TPCHDMX046A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 36000.00, 'Mixed'),
(105, 'TPCHDMX047C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 36.00, 'Mixed'),
(106, 'TPCHDMX048C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1296.00, 'Mixed'),
(107, 'TPCHDMX049C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1584.00, 'Mixed'),
(108, 'TPCHDMX050C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 2520.00, 'Mixed'),
(109, 'TPCHDMX051C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'M', 1800.00, 'Mixed'),
(110, 'TPCHDMX052C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling) Excluded Concrete pole  (scope includes Survey, Design, Installation, and Metetials)', 'M', 2100.00, 'Mixed'),
(111, 'TPCHDMX053C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 46.80, 'Mixed'),
(112, 'TPCHDMX054C', 'Open Cut & Repair road surface reinf concrete, Kerb& Drain Kerb', 'Sq. Meter', 1496.88, 'Mixed'),
(113, 'TPCHDMX055C', 'Open Cut & Repair Footpath surface Asphalt', 'Sq. Meter', 969.12, 'Mixed'),
(114, 'TPCHDMX056C', 'Open Cut & Repair Footpath surface  Interlock', 'Sq. Meter', 969.12, 'Mixed'),
(115, 'TPCHDMX057C', 'Break Through Pull Box for prepare cable couduit (service only)', 'Each', 648.00, 'Mixed'),
(116, 'TPCHDMX058C', 'Break Through Man Hole for prepare cable couduit (serviice only)', 'Each', 1080.00, 'Mixed'),
(117, 'TPCHDMX059C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 61.20, 'Mixed'),
(118, 'TPCHDMX060C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 79.20, 'Mixed'),
(119, 'TPCHDMX061A', 'Supply and install cross Arm type steel ', 'Each', 756.00, 'Mixed'),
(120, 'TPCHDMX062A', 'Supply and install cross Arm type steel ', 'Each', 972.00, 'Mixed'),
(121, 'TPCHDMX063A', 'Supply deliver and install concrete pole', 'Pole', 5400.00, 'Mixed'),
(122, 'TPCHDMX064A', 'Supply deliver and install concrete pole', 'Pole', 7920.00, 'Mixed'),
(123, 'TPCHDMX065A', 'Supply and install cross Arm type Wooden', 'Each', 540.00, 'Mixed'),
(124, 'TPCHDMX066C', 'Fiber Splicing and termination', 'Core', 165.60, 'Mixed'),
(125, 'TPCHDMX067C', 'Fiber Splicing and termination', 'Core', 126.00, 'Mixed'),
(126, 'TPCHDMX068C', 'Fiber Splicing and termination', 'Core', 108.00, 'Mixed'),
(127, 'TPCHDMX069C', 'Fiber Splicing and termination', 'Core', 93.60, 'Mixed'),
(128, 'TPCHDMX070C', 'Fiber Splicing and termination', 'Core', 86.40, 'Mixed'),
(129, 'TPCHDMX071C', 'Fiber Splicing and termination', 'Core', 64.80, 'Mixed'),
(130, 'TPCHDMX072C', 'Fiber Splicing and termination', 'Core', 57.60, 'Mixed'),
(131, 'TPCHDMX082C', 'Install Enclosure for OFC 12 cores (service only)', 'Each', 145.00, 'Mixed'),
(132, 'TPCHDMX083C', 'Install Enclosure for OFC 24-48 cores (service only)', 'Each', 145.00, 'Mixed'),
(133, 'TPCHDMX084C', 'Install Enclosure for OFC 60 cores (service only)', 'Each', 145.00, 'Mixed'),
(134, 'TPCHDMX085C', 'Install Enclosure for OFC 72 cores (service only)', 'Each', 145.00, 'Mixed'),
(135, 'TPCHDMX086C', 'Install Enclosure for OFC 96 cores (service only)', 'Each', 145.00, 'Mixed'),
(136, 'TPCHDMX087C', 'Install Enclosure for OFC 120 cores (service only)', 'Each', 145.00, 'Mixed'),
(137, 'TPCHDMX088C', 'Install Enclosure for OFC 144 cores (service only)', 'Each', 145.00, 'Mixed'),
(138, 'TPCHDMX089C', 'Install Enclosure for OFC 216 cores (service only)', 'Each', 145.00, 'Mixed'),
(139, 'TPCHDMX090C', 'Install Enclosure for OFC 312 cores (service only)', 'Each', 145.00, 'Mixed'),
(140, 'TPCHDMX102C', 'Install ODF 24 ports for rack mounted (12 pigtail) Indoor (service only)', 'Each', 360.00, 'Mixed'),
(141, 'TPCHDMX103C', 'Install ODF 24 ports for rack mounted (24 pigtail) Indoor (service only)', 'Each', 360.00, 'Mixed'),
(142, 'TPCHDMX104C', 'Install ODF 12 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
(143, 'TPCHDMX105C', 'Install ODF 24 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
(144, 'TPCHDMX106C', 'Install ODF 48 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
(145, 'TPCHDMX107C', 'Install ODF 24 ports for rack mounted (12 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
(146, 'TPCHDMX108C', 'Install ODF 24 ports for rack mounted (24 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
(147, 'TPCHDMX109C', 'Install ODF 48 ports for rack mounted (48 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
(148, 'TPCHDMX110C', 'Install ODF 120 ports for rack mounted (120 pigtail) Outdoor(service only)', 'Each', 145.00, 'Mixed'),
(149, 'TPCHDMX111C', 'Install ODF 144 ports for rack mounted (144 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
(150, 'TPCHDMX112C', 'Install ODF 216 ports for rack mounted (216 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
(151, 'TPCHDMX115C', 'Remove service for ODF Box', 'Each', 500.00, 'Mixed'),
(152, 'TPCHDMX129C', 'Service for proceeding installation permission from Authority (Per Route)', 'Route', 1296.00, 'Mixed'),
(153, 'TPCHDMX131C', 'Extra charge for transportation for island site (Per Site)', 'Site', 3600.00, 'Mixed'),
(154, 'TPCHDMX133C', 'Survey for design and drawing for work permission in case not installation cable in this route', 'Route', 2880.00, 'Mixed'),
(155, 'TPCHDMX134C', 'Survey for design and drawing for work permission (based on PEA/MEA/Authorities standard requirement) in case not installation cable in this route', 'Meter', 1.08, 'Mixed'),
(156, 'TPCHDMX135C', 'Need ODTR result both from A to Z and Z to A', 'Core', 1296.00, 'Mixed'),
(157, 'TPCHDMX136C', 'Site or enclosure location Access to support fiber core arrangement or OTDR test', 'Site', 1080.00, 'Mixed'),
(158, 'TPCHDMX137C', 'Service for proceeding the work permission from PEA/MEA/Authorities for civil work on the road (Per Route)', 'Route', 2880.00, 'Mixed'),
(159, 'TPCHDMX138C', 'Service for proceeding the work permission from  PEA/MEA/Authorities for civil work crossing the road (Per Route)', 'Route', 3600.00, 'Mixed'),
(160, 'TPCHDMX140C', 'Survey & Drawing & Permission including cost for open Pull box\\Manhole and cost for access site', 'Meter', 9.22, 'Mixed'),
(161, 'TPCHDMX141A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8.00, 'Mixed'),
(162, 'TPCHDMX142A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8.00, 'Mixed'),
(163, 'TPCHDMX143A', 'Installation service Include Micro tube  & Material ', 'Meter', 17.28, 'Mixed'),
(164, 'TPCHDMX144A', 'Installation service Include Micro tube  & Material ', 'Meter', 20.88, 'Mixed'),
(165, 'TPCHDMX145A', 'Installation service Include Micro tube  & Material ', 'Meter', 21.70, 'Mixed'),
(166, 'TPCHDMX146A', 'Installation service Include Micro Duct  & Material ', 'Meter', 37.00, 'Mixed'),
(167, 'TPCHDMX147A', 'Installation service Include Micro Duct  & Material ', 'Meter', 28.80, 'Mixed'),
(168, 'TPCHDMX148A', 'Installation service Include Micro Duct  & Material ', 'Meter', 30.84, 'Mixed'),
(169, 'TPCHDMX149A', 'Installation service Include Micro Duct  & Material ', 'Meter', 39.60, 'Mixed'),
(170, 'TPCHDMX150A', 'Installation service Include Micro Duct  & Material ', 'Meter', 63.36, 'Mixed'),
(171, 'TPCHDMX151C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 18.00, 'Mixed'),
(172, 'TPCHDMX152C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 20.88, 'Mixed'),
(173, 'TPCHDMX153C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 21.60, 'Mixed'),
(174, 'TPCHDMX154C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 23.04, 'Mixed'),
(175, 'TPCHDMX155C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 24.09, 'Mixed'),
(176, 'TPCHDMX156C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 28.79, 'Mixed'),
(177, 'TPCHDMX157C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 36.30, 'Mixed'),
(178, 'TPCHDMX158C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 48.39, 'Mixed'),
(179, 'TPCHDMX159C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 50.04, 'Mixed'),
(180, 'TPCHDMX160C', 'Installation service', 'Point', 216.00, 'Mixed'),
(181, 'TPCHDMX161C', 'Installation of Fiber Blow including OFC and Services', 'Set', 3592.80, 'Mixed'),
(182, 'TPCHDMX162A', 'Installation service Include Sub-duct Fabric  & Material  ', 'Meter', 8.00, 'Mixed'),
(183, 'TPCHDMX163A', 'Installation service Include Micro tube  & Material', 'Meter', 52.92, 'Mixed'),
(184, 'TPCHDMX164A', 'Installation service Include Micro tube  & Material', 'Meter', 49.32, 'Mixed'),
(185, 'TPCHDMX173C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
(186, 'TPCHDMX174C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
(187, 'TPCHDMX175C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
(188, 'TPCHDMX176C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
(189, 'TPCHDMX177C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
(190, 'TPCHDMX178C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
(191, 'TPCHDMX179C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
(192, 'TPCHDMX180C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
(193, 'TPCHDMX181C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
(194, 'TPCHDMX182C', 'Re-arrange OFC cable on existing pole or cross-arm (Per Pole)', 'Pole', 108.00, 'Mixed'),
(195, 'TPCHDMX184C', 'Transportation for disposal ', 'KM ', 10.80, 'Mixed'),
(196, 'TPCHDMX185C', 'Cable disposal', 'KG', 8.64, 'Mixed'),
(197, 'TPCHDMX189C', 'Install ODF 60 ports for rack mounted (60 pigtail) Indoor (service only)', 'EA', 360.00, 'Mixed'),
(198, 'TPCHDMX183A', 'Sticker attaching to the cable (incld stickers)', 'Pole per Cable', 15.00, 'Mixed'),
(199, 'TPUHD54001C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1248.00, 'Mixed'),
(200, 'TPUHD54002C', 'Remove of A8', 'EA', 1100.00, 'Mixed'),
(201, 'TPUHD54003C', 'Remove of A10', 'EA', 1550.00, 'Mixed'),
(202, 'TPUHD54004C', 'Remove of D3A Cable Extension Arm', 'EA', 350.00, 'Mixed'),
(203, 'TPUHD54005C', 'Remove Cross-arm Y(N)', 'EA', 55.00, 'Mixed'),
(204, 'TPUHD54006C', 'Remove Cross-arm Y(R)', 'EA', 65.00, 'Mixed'),
(205, 'TPUHD54007C', 'Y(S) Outdoor Dslam all Type', 'EA', 6000.00, 'Mixed'),
(206, 'TPUHD54008C', 'Y(S) Outdoor Dslam all Type included SupPort Riser', 'EA', 7500.00, 'Mixed'),
(207, 'TPUHD54009C', 'จัดระเบียบ และรื้อย้ายสายสื่อสารที่ไม่ได้ใช้งาน ตามที่ทางการไฟฟ้าฯ และ ทรูฯ กำหนด ราคาเหมาจ่าย 1 กิโลเมตร รวมค่าขนส่งเคเบิลที่ไม่ได้ใช้งานไปยังสถานที่ที่ ทรู กำหนด (เฉพาะ กทม. และ ปริมณฑล)', 'KM', 2600.00, 'Mixed'),
(208, 'TPUHD54010C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1248.00, 'Mixed'),
(209, 'TPUHD54011C', 'Breaking Reinforced Concrete 10 cm. Thickness', 'M2', 50.00, 'Mixed'),
(210, 'TPUHD54012C', 'Breaking Reinforced Concrete 15 cm. Thickness', 'M2', 140.00, 'Mixed'),
(211, 'TPUHD54013C', 'Breaking Asphalt Road 5 cm.', 'M2', 110.00, 'Mixed'),
(212, 'TPUHD54014C', 'Breaking Asphalt Road 10 cm.', 'M2', 140.00, 'Mixed'),
(213, 'TPUHD54015C', 'Dig & Repair Ground', 'M2', 120.00, 'Mixed'),
(214, 'TPUHD54016C', 'Re-Information existing \"Closure\" and included Sync Testbed and Confirm data to True\'s for Sync IM (คิดต่อ 1 Closure)', 'EA', 250.00, 'Mixed'),
(215, 'TPUHD54017C', 'Record Information งานจัดระเบียบสาย 2021 สำหรับ OF Cable, Dropwire, Coaxial Cable ทุกเส้น ตามที่ ทรู กำหนดให้ ลงบน Report หรือ Application ที่กำหนด', 'KM', 1900.00, 'Mixed'),
(216, 'TPUHD54018C', 'Remove Conduit All Type Y(N)', 'EA', 6.00, 'Mixed'),
(217, 'TPUHD54019C', 'Remove Closure Splitter and Inline Closure Y(N)', 'EA', 50.00, 'Mixed'),
(218, 'TPUHD54020C', 'Remove Closure Splitter and Inline Closure Y(R)', 'EA', 100.00, 'Mixed'),
(219, 'TPUHD54021C', 'Remove Splitter L1 and L2 Y(N) Bare & Box', 'EA', 5.00, 'Mixed'),
(220, 'TPUHD54022C', 'Remove Splitter L1 and L2 Y(R) Bare & Box', 'EA', 10.00, 'Mixed'),
(221, 'TPUHD54023C', 'Design by QRUN included Sync Test Best, Sync IM', 'M', 1.00, 'Mixed'),
(222, 'TPUHD54024C', 'Remove ODF Box All Type Y(N)', 'EA', 350.00, 'Mixed'),
(223, 'TPUHD54025C', 'Remove ODF Street Cabinet & Pole Type', 'ea\\', 4500.00, 'Mixed'),
(224, 'TPUHD54026C', 'Install RG 6 Coaxial Cable In Conduit', 'M', 6.00, 'Mixed'),
(225, 'TPUHD54027C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
(226, 'TPUHD54028C', 'Install RG 6 Coaxial Cable In Conduit', 'EA', 6.00, 'Mixed'),
(227, 'TPUHD54029C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
(228, 'TPUHD54030C', 'Remove Coaxial cable (Non-Usable)', 'M', 1.80, 'Mixed'),
(229, 'TPUHD54031C', 'Remove Coaxial cable (Re-Usable)', 'M', 4.50, 'Mixed'),
(230, 'TPUHD54032C', 'Installation  ODF 48-60 Core wall & pole mounted Indoor SC/APC Connector and included installation pigtail L=1.5, 3.0 M', 'EA', 432.00, 'Mixed'),
(231, 'TPUHD54002A', 'Installation ODF Street Cabinet and Pole Type (Included TransPortation, Vehicle Rental, Construction)', 'Set', 5250.00, 'Mixed'),
(232, 'TPUHD54003A', 'L2 Closure + Box Splitter 1:8 Material+Construction+Transportation', 'Set', 500.00, 'Mixed'),
(233, 'TPUHD54004A', 'L2 Closure + Box Splitter 1:16 Material+Construction+Transportation', 'Set', 500.00, 'Mixed'),
(234, 'TPUHD54005A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(235, 'TPUHD54006A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(236, 'TPUHD54007A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(237, 'TPUHD54008A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(238, 'TPUHD54009A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 3 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(239, 'TPUHD54010A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 4 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
(240, 'TPUHD54011A', 'Aluminum Optic Distribution Fiber support Splitter Module Maximum 32 Ports included E2E Test', 'EA', 1100.00, 'Mixed'),
(241, 'TPUHD54012A', '24 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 10 ซม.', 'M2', 750.00, 'Mixed'),
(242, 'TPUHD54013A', '24 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 15 ซม.', 'M2', 1100.00, 'Mixed'),
(243, 'TPUHD54014A', '8 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 10 ซม.', 'M2', 900.00, 'Mixed'),
(244, 'TPUHD54015A', '8 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 15 ซม.', 'M2', 1350.00, 'Mixed'),
(245, 'TPUHD54016A', 'Overlay Hotmixed 5 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 300.00, 'Mixed'),
(246, 'TPUHD54017A', 'Overlay Hotmixed 10 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 450.00, 'Mixed'),
(247, 'TPUHD54018A', 'Concrete Road 15 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 15 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 550.00, 'Mixed'),
(248, 'TPUHD54019A', 'Concrete Road 20 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 20 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 750.00, 'Mixed'),
(249, 'TPUHD54020A', 'Repair Concrete Road และ Footpath คอนกรีต 15 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750.00, 'Mixed'),
(250, 'TPUHD54021A', 'Repair Concrete Road และ Footpath คอนกรีต 20 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750.00, 'Mixed'),
(251, 'TPUHD54022A', 'งานซ่อมถนน Asphalt Road ด้วยการตัดพื้น ความหนา 5 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 420.00, 'Mixed'),
(252, 'TPUHD54023A', 'งานซ่อม Asphalt Road ด้วยการตัดพื้น ความหนา 10 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 550.00, 'Mixed'),
(253, 'TPUHD54024A', 'D1C - Galvanized Steel Ground Wire (Wire Rope) เฉพาะ W&W, Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 480.00, 'Mixed'),
(254, 'TPUHD54025A', 'D7C-Pole Ground with Ground Rod 2.4 M. Welding by Exothermic or Brass เฉพาะ W&W,  Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 250.00, 'Mixed'),
(255, 'TPUHD54026A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type A (Wall Type, Apartment),B (Last Pole of Current Subs)', 'Set', 650.00, 'Mixed'),
(256, 'TPUHD54027A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type C (Co-location L2)', 'Set', 340.00, 'Mixed'),
(257, 'TPUHD54028A', 'Installation Flat Optic 1 or 2 Fiber 1 - 25 Meter for Maintenance', 'SET', 450.00, 'Mixed'),
(258, 'TPUHD54029A', 'Installation Flat Optic 1 or 2 Fiber 26 – 50 Meter for Maintenance', 'SET', 500.00, 'Mixed'),
(259, 'TPUHD54030A', 'Installation Flat Optic 1 or 2 Fiber 51 – 75 Meter for Maintenance', 'SET', 610.00, 'Mixed'),
(260, 'TPUHD54031A', 'Installation Flat Optic 1 or 2 Fiber 76 – 100 Meter for Maintenance', 'SET', 650.00, 'Mixed'),
(261, 'TPUHD54032A', 'Installation Flat Optic 1 or 2 Fiber 101 – 125 Meter for Maintenance', 'SET', 770.00, 'Mixed'),
(262, 'TPUHD54033A', 'Installation Flat Optic 1 or 2 Fiber 126 – 150 Meter for Maintenance', 'SET', 880.00, 'Mixed'),
(263, 'TPUHD54034A', 'Installation Flat Optic 1 or 2 Fiber 151 – 175 Meter for Maintenance', 'SET', 990.00, 'Mixed'),
(264, 'TPUHD54035A', 'Installation Flat Optic 1 or 2 Fiber 176 – 200 Meter for Maintenance', 'SET', 1100.00, 'Mixed'),
(265, 'TPUHD54036A', 'Installation Flat Optic 1 or 2 Fiber 201 – 225 Meter for Maintenance', 'SET', 1210.00, 'Mixed'),
(266, 'TPUHD54037A', 'Installation Flat Optic 1 or 2 Fiber 226 – 250 Meter for Maintenance', 'SET', 1330.00, 'Mixed'),
(267, 'TPUHD54038A', 'Installation Flat Optic 1 or 2 Fiber 251 – 275 Meter for Maintenance', 'SET', 1440.00, 'Mixed'),
(268, 'TPUHD54039A', 'Installation Flat Optic 1 or 2 Fiber 276 – 300 Meter for Maintenance', 'SET', 1550.00, 'Mixed'),
(269, 'TPUHD54040A', 'Installation Flat Optic 1 or 2 Fiber 301 – 325 Meter for Maintenance', 'SET', 1660.00, 'Mixed'),
(270, 'TPUHD54041A', 'Installation Flat Optic 1 or 2 Fiber 326 – 350 Meter for Maintenance', 'SET', 1770.00, 'Mixed'),
(271, 'TPUHD54042A', 'Installation Flat Optic 1 or 2 Fiber 351 – 375 Meter for Maintenance', 'SET', 1890.00, 'Mixed'),
(272, 'TPUHD54043A', 'Installation Flat Optic 1 or 2 Fiber 376 – 400 Meter for Maintenance', 'SET', 2000.00, 'Mixed'),
(273, 'TPUHD54044A', 'Installation Flat Optic 1 or 2 Fiber 401 – 425 Meter for Maintenance', 'SET', 2100.00, 'Mixed'),
(274, 'TPUHD54045A', 'Installation Flat Optic 1 or 2 Fiber 426 – 450 Meter for Maintenance', 'SET', 2200.00, 'Mixed'),
(275, 'TPUHD54046A', 'Installation Flat Optic 1 or 2 Fiber 451 – 475 Meter for Maintenance', 'SET', 2300.00, 'Mixed'),
(276, 'TPUHD54047A', 'Installation Flat Optic 1 or 2 Fiber 476 – 500 Meter for Maintenance', 'SET', 2450.00, 'Mixed'),
(277, 'TPUHD54048C', 'ค่าเปิด Enclosure เดิมทุกขนาด (ไม่รวมค่า Splicing)', 'EA', 1800.00, 'Mixed'),
(278, 'TPCHDMX237M', '1)ประสานงานกับการ PEA,MEA เรื่องการขอติดตั้งมิเตอร์ขนาดตามที่ ทรูฯ กำหนดในทุกขั้นตอน จนสามารถติดตั้งมิเตอร์ได้ 2)รับผิดชอบค่าใช้จ่ายในการประสานงาน,ค่าธรรมเนียมในการติดตั้งมิเตอร์ และค่าดำเนินการอื่นๆที่เกี่ยวข้อง 3)หนังสือการขอติดตั้งมิเตอร์ทาง ทรูฯ เป็นผ', 'Set', 3000.00, 'Mixed'),
(279, 'TPCHDMX238A', 'OLT Suppy and Installation Power, UTP, Grounding, Transportation and All Accessories (Excluded OLT Cabinet) Include Cutover and Install Support', 'Set', 15000.00, 'Mixed'),
(280, 'TPUHD54050A', 'Splicing OF-Cable on Aerial < 12 Fibers', 'EA', 2100.00, 'Mixed'),
(281, 'TPUHD54053A', 'Splicing OF-Cable on Aerial 36 Fibers', 'EA', 5850.00, 'Mixed'),
(282, 'TPUHD54054A', 'Splicing OF-Cable on Aerial 48 Fibers', 'EA', 6650.00, 'Mixed'),
(283, 'TPUHD54056A', 'Splicing OF-Cable on Aerial 96 Fibers', 'EA', 7850.00, 'Mixed'),
(284, 'TPUHD54057A', 'Splicing OF-Cable on Aerial 120 Fibers', 'EA', 9350.00, 'Mixed'),
(285, 'TPUHD54058A', 'Splicing OF-Cable on Aerial 144 Fibers', 'EA', 13300.00, 'Mixed'),
(286, 'TPUHD54059A', 'Splicing OF-Cable on Aerial 216 Fibers', 'EA', 14000.00, 'Mixed'),
(287, 'TPUHD54060A', 'Splicing OF-Cable on Aerial 288 Fibers', 'EA', 17500.00, 'Mixed'),
(288, 'TPUHD54061A', 'Splicing OF-Cable on Aerial 312 Fibers', 'EA', 18500.00, 'Mixed'),
(289, 'TPUHD54062A', 'Splicing OF-Cable on Aerial 432 Fibers', 'EA', 23500.00, 'Mixed'),
(290, 'TPUHD54063A', 'Splicing OF-Cable on Aerial 576 Fibers', 'EA', 28500.00, 'Mixed'),
(291, 'TPUHD54064A', 'Splicing OF-Cable on Aerial 648 Fibers', 'EA', 32000.00, 'Mixed'),
(292, 'TPUHD54065A', 'Splicing OF-Cable in Conduit 12 Fibers', 'EA', 5000.00, 'Mixed'),
(293, 'TPUHD54066A', 'Splicing OF-Cable in Conduit 24 Fibers', 'EA', 6500.00, 'Mixed'),
(294, 'TPUHD54067A', 'Splicing OF-Cable in Conduit 36 Fibers', 'EA', 7750.00, 'Mixed'),
(295, 'TPUHD54068A', 'Splicing OF-Cable in Conduit 48 Fibers', 'EA', 8000.00, 'Mixed'),
(296, 'TPUHD54069A', 'Splicing OF-Cable in Conduit 60 Fibers', 'EA', 8650.00, 'Mixed'),
(297, 'TPUHD54070A', 'Splicing OF-Cable in Conduit 96 Fibers', 'EA', 8900.00, 'Mixed'),
(298, 'TPUHD54071A', 'Splicing OF-Cable in Conduit 120 Fibers', 'EA', 9100.00, 'Mixed'),
(299, 'TPUHD54072A', 'Splicing OF-Cable in Conduit 144 Fibers', 'EA', 12000.00, 'Mixed'),
(300, 'TPUHD54073A', 'Splicing OF-Cable on Conduit 216 Fibers', 'EA', 18000.00, 'Mixed'),
(301, 'TPUHD54074A', 'Splicing OF-Cable on Conduit 288 Fibers', 'EA', 22000.00, 'Mixed'),
(302, 'TPUHD54075A', 'Splicing OF-Cable on Conduit 312 Fibers', 'EA', 24000.00, 'Mixed'),
(303, 'TPUHD54076A', 'Splicing OF-Cable on Conduit 432 Fibers', 'EA', 31000.00, 'Mixed'),
(304, 'TPUHD54077A', 'Splicing OF-Cable on Conduit 576 Fibers', 'EA', 40000.00, 'Mixed'),
(305, 'TPUHD54078A', 'Splicing OF-Cable on Conduit 648 Fibers', 'EA', 41000.00, 'Mixed'),
(306, 'TPUHD54079C', 'Duct test prior Repair 1-Duct Per span', 'Lot', 1815.00, 'Mixed'),
(307, 'TPUHD54080C', 'Duct test prior Repair 2-Duct Per span', 'Lot', 1880.00, 'Mixed'),
(308, 'TPUHD54081C', 'Duct test prior Repair 3-Duct Per span', 'Lot', 1960.00, 'Mixed'),
(309, 'TPUHD54082C', 'Duct test prior Repair 4-Duct Per span', 'Lot', 2100.00, 'Mixed'),
(310, 'TPUHD54083C', 'Duct test prior Repair 5-Duct Per span', 'Lot', 2250.00, 'Mixed'),
(311, 'TPUHD54084C', 'Duct test prior Repair 6-Duct Per span', 'Lot', 2320.00, 'Mixed'),
(312, 'TPUHD54085C', 'Duct test prior Repair 7-Duct Per span', 'Lot', 2390.00, 'Mixed'),
(313, 'TPUHD54086C', 'Duct test prior Repair 8-Duct Per span', 'Lot', 2610.00, 'Mixed'),
(314, 'TPUHD54087C', 'Duct test prior Repair 10-Duct Per span', 'Lot', 2830.00, 'Mixed'),
(315, 'TPUHD54088C', 'Duct test prior Repair 12-Duct Per span', 'Lot', 2830.00, 'Mixed'),
(631, 'SM13075-0100020001-TH', 'Cable installation service Outdoor Arial including Sticker,Survey Drawing, Permission Drawing, Other Drawing, Aerial to Duct, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 9.07, 'FBH'),
(4920, 'SM13075-0100020002-TH', 'Cable installation service Underground in provided or constructed conduit or Duct. including Survey Drawing, Permission Drwaing, Other Drawing, Duct to Aerial, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 11.76, 'FBH');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(4) NOT NULL,
  `bill_name` varchar(100) NOT NULL,
  `bill_date` date NOT NULL,
  `bill_date_product` date NOT NULL,
  `bill_payment` varchar(100) NOT NULL,
  `bill_due_date` date NOT NULL,
  `bill_refer` varchar(100) NOT NULL,
  `bill_site` varchar(100) NOT NULL,
  `bill_pr` varchar(100) NOT NULL,
  `bill_work_no` varchar(100) NOT NULL,
  `bill_project` varchar(100) NOT NULL,
  `list_num` int(3) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `vat` double(9,2) NOT NULL,
  `withholding` double(9,2) NOT NULL,
  `grand_total` double(10,2) NOT NULL,
  `bill_company` varchar(50) NOT NULL,
  `employee_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_name`, `bill_date`, `bill_date_product`, `bill_payment`, `bill_due_date`, `bill_refer`, `bill_site`, `bill_pr`, `bill_work_no`, `bill_project`, `list_num`, `total_amount`, `vat`, `withholding`, `grand_total`, `bill_company`, `employee_id`) VALUES
(2, 'PS2567/001', '2567-10-09', '2567-10-09', 'N/A', '2567-10-09', '-', '', '', '', '', 1, 2.00, 0.14, 0.06, 1.86, 'FBH', 1),
(4, 'PSNK/MIXED/67/001', '2567-10-18', '2567-10-18', 'N/A', '2567-10-18', '-', '', '', '', '', 1, 33.00, 2.31, 0.99, 30.69, 'Mixed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_bank`
--

CREATE TABLE `bill_bank` (
  `bank_id` int(1) NOT NULL,
  `bank_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_bank`
--

INSERT INTO `bill_bank` (`bank_id`, `bank_detail`) VALUES
(1, 'หมายเหตุ  : ชำระเป็น เงินสด โอนเข้าบัญชี\n<br>ธนาคาร กสิกรไทย สาขา บ่อสร้าง ประเภท ออมทรัพย์\n<br>ในนาม บริษัท พีเอสเอ็นเค เทเลคอม จำกัด (สำนักงานใหญ่)\n<br>บัญชีเลขที่ 086-3-06705-7');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `bill_id` int(4) NOT NULL,
  `au_id` int(4) NOT NULL,
  `unit` int(3) NOT NULL,
  `price` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`bill_id`, `au_id`, `unit`, `price`) VALUES
(2, 5, 1, 2.00),
(4, 54, 3, 33.00);

-- --------------------------------------------------------

--
-- Table structure for table `cable`
--

CREATE TABLE `cable` (
  `cable_id` int(4) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `installed_section` varchar(100) NOT NULL,
  `placing_team` varchar(100) NOT NULL,
  `cable_form` int(4) NOT NULL,
  `cable_to` int(4) NOT NULL,
  `cable_used` int(4) NOT NULL,
  `cable_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(4) NOT NULL,
  `drum_id` int(4) NOT NULL,
  `cable_work_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cable`
--

INSERT INTO `cable` (`cable_id`, `route_name`, `installed_section`, `placing_team`, `cable_form`, `cable_to`, `cable_used`, `cable_date`, `employee_id`, `drum_id`, `cable_work_id`) VALUES
(3, 'U2211148 เชียงใหม่', 'CMI01X39ECQ - L2 NEW', 'ดุ่ย', 4000, 1, 3999, '2024-10-13 21:55:52', 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cable_work`
--

CREATE TABLE `cable_work` (
  `cable_work_id` int(1) NOT NULL,
  `cable_work_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cable_work`
--

INSERT INTO `cable_work` (`cable_work_id`, `cable_work_name`) VALUES
(1, 'Mixed'),
(2, 'FBH');

-- --------------------------------------------------------

--
-- Table structure for table `company_address`
--

CREATE TABLE `company_address` (
  `company_address_id` int(1) NOT NULL,
  `company_address_detaill` text NOT NULL,
  `company_address_type` varchar(1) NOT NULL COMMENT '0=psnk,1=mixed,2=fbh',
  `company_address_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_address`
--

INSERT INTO `company_address` (`company_address_id`, `company_address_detaill`, `company_address_type`, `company_address_name`) VALUES
(1, '<h2>บริษัท พีเอสเอ็นเค เทเลคอม จำกัด (สำนักงานใหญ่)</h2>\n<h2>PSNK Telecom Company Limited (Head office)</h2>\n<p>เลขที่ 99/2 หมู่ที่ 9 ตำบลสันทรายน้อย อำเภอสันทราย จังหวัดเชียงใหม่ 50130</p>\n<p>Tel : 063-5415398 , 064-1954565 , 064-7898995 | E-Mail: psnktelecom@gmail.com</p>\n<p>เลขประจำตัวผู้เสียภาษี 0-5055-64000-43-4</p>', '0', ''),
(2, 'หมายเหตุ  : ชำระเป็น เงินสด โอนเข้าบัญชี\n<br>ธนาคาร กสิกรไทย สาขา บ่อสร้าง ประเภท ออมทรัพย์\n<br>ในนาม บริษัท พีเอสเอ็นเค เทเลคอม จำกัด (สำนักงานใหญ่)\n<br>บัญชีเลขที่ 086-3-06705-7', '1', '<strong>ผู้ติดต่อ : Management Center</strong>\n<br>Tel.02 276-2236-8 Fax : 02 276-2239'),
(3, '<strong>Customer : บริษัท ไวร์เออ แอนด์ ไวร์เลส จำกัด</strong>\n<br>Address : 240/64-67 อาคารอโยธยาทาวเวอร์ ชั้น 26 ถนนรัชดาภิเษก แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพมหานคร 10310\n<br>Tax ID : 0105538013293 สำนักงานใหญ่', '2', '<strong>ผู้ติดต่อ : Chavisa Wisetwohan</strong> <br>Tel.02 276-2236-8 Fax : 099-614-9196');

-- --------------------------------------------------------

--
-- Table structure for table `drum`
--

CREATE TABLE `drum` (
  `drum_id` int(4) NOT NULL,
  `drum_no` varchar(4) NOT NULL,
  `drum_to` varchar(100) NOT NULL,
  `drum_description` varchar(100) NOT NULL,
  `drum_full` int(4) NOT NULL,
  `drum_remaining` int(4) NOT NULL,
  `drum_company_id` int(3) NOT NULL,
  `drum_cable_company_id` int(3) NOT NULL,
  `drum_used` int(4) NOT NULL,
  `drum_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drum`
--

INSERT INTO `drum` (`drum_id`, `drum_no`, `drum_to`, `drum_description`, `drum_full`, `drum_remaining`, `drum_company_id`, `drum_cable_company_id`, `drum_used`, `drum_date`, `employee_id`) VALUES
(3, '0062', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 1, 2, 2, 3999, '2024-10-13 21:57:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `drum_cable_company`
--

CREATE TABLE `drum_cable_company` (
  `drum_cable_company_id` int(3) NOT NULL,
  `drum_cable_company_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drum_cable_company`
--

INSERT INTO `drum_cable_company` (`drum_cable_company_id`, `drum_cable_company_detail`) VALUES
(1, 'FUTONG'),
(2, 'FIBERHOME'),
(4, 'TICC'),
(5, 'TUC');

-- --------------------------------------------------------

--
-- Table structure for table `drum_company`
--

CREATE TABLE `drum_company` (
  `drum_company_id` int(3) NOT NULL,
  `drum_company_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drum_company`
--

INSERT INTO `drum_company` (`drum_company_id`, `drum_company_detail`) VALUES
(1, 'Mixed'),
(2, 'FIBERHOME'),
(3, 'FBH'),
(4, 'CCS'),
(5, 'W&W'),
(6, 'TKI'),
(7, 'MTE'),
(8, 'Poonsub');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(4) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_lastname` varchar(100) NOT NULL,
  `employee_age` varchar(2) NOT NULL,
  `employee_phone` varchar(10) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_position` varchar(1) NOT NULL,
  `employee_status` varchar(1) NOT NULL,
  `employee_date` datetime NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_lastname`, `employee_age`, `employee_phone`, `employee_email`, `employee_position`, `employee_status`, `employee_date`, `delete_at`) VALUES
(1, 'admin', 'admin', '30', '0999999999', 'admin@gmail.com', '2', '1', '2024-07-24 15:27:24', NULL),
(31, 'view', 'view', '20', '0999999999', 'view@gmail.com', '3', '1', '2024-09-28 22:39:07', NULL),
(32, 'owner', 'owner', '20', '0999999999', 'owner@gmail.com', '1', '1', '2024-10-08 21:33:39', NULL),
(33, 'employee', 'employee', '20', '0999999999', 'employee@gmail.com', '2', '1', '2024-10-08 21:34:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(8) NOT NULL,
  `log_status` varchar(50) NOT NULL,
  `log_detail` text NOT NULL,
  `user_id` int(4) NOT NULL,
  `log_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `log_status`, `log_detail`, `user_id`, `log_date`) VALUES
(1, '2', 'Logout', 2, '2024-10-08 21:28:42'),
(2, '1', 'Login', 1, '2024-10-08 21:28:48'),
(3, '1', 'Logout', 1, '2024-10-08 21:28:51'),
(4, '2', 'Login', 2, '2024-10-08 21:28:56'),
(5, '2', 'Logout', 2, '2024-10-08 21:30:03'),
(6, '2', 'Login', 2, '2024-10-08 21:30:07'),
(7, '2', 'Logout', 2, '2024-10-08 21:30:14'),
(8, '2', 'Login', 2, '2024-10-08 21:30:27'),
(9, '2', 'Logout', 2, '2024-10-08 21:31:32'),
(10, '2', 'Login', 2, '2024-10-08 21:31:53'),
(11, '2', 'Logout', 2, '2024-10-08 21:31:59'),
(12, '1', 'Login', 1, '2024-10-08 21:32:08'),
(13, 'User Updated', 'User ID: 2, Username: view, Lv: 3, Status: 1', 1, '2024-10-08 21:32:21'),
(14, 'Employee Updated', 'Employee ID: 1, Employee Name: admin, Employee Lastname: admin, Employee Age: 30, Employee Phone: 0999999999, Employee Email: admin@gmail.com, Employee Position: 2, Employee Status: 1', 1, '2024-10-08 21:32:42'),
(15, 'Employee Updated', 'Employee ID: 31, Employee Name: view, Employee Lastname: view, Employee Age: 20, Employee Phone: 0999999, Employee Email: view@gmail.com, Employee Position: 3, Employee Status: 1', 1, '2024-10-08 21:32:51'),
(16, 'User Created', 'Username: owner, Employee Name: owner owner, Position: 1', 1, '2024-10-08 21:33:39'),
(17, 'User Created', 'Username: employee, Employee Name: employee employee, Position: 2', 1, '2024-10-08 21:34:20'),
(18, 'Employee Updated', 'Employee ID: 31, Employee Name: view, Employee Lastname: view, Employee Age: 20, Employee Phone: 0999999999, Employee Email: view@gmail.com, Employee Position: 3, Employee Status: 1', 1, '2024-10-08 21:35:07'),
(19, 'Data Inserted', 'Table: drum_company, Column: drum_company_detail, Value: ฟก, ID: 34', 1, '2024-10-08 21:55:27'),
(20, 'Data Deleted', 'Table: drum_company, Column: drum_company_id, ID: 34', 1, '2024-10-08 21:55:51'),
(21, 'Data Inserted', 'Table: drum_cable_company, Column: drum_cable_company_detail, Value: ฟก, ID: 21', 1, '2024-10-08 21:56:02'),
(22, 'Data Deleted', 'Table: drum_cable_company, Column: drum_cable_company_id, ID: 21', 1, '2024-10-08 21:56:20'),
(23, 'Data Inserted', 'Table: cable_work, Column: cable_work_name, Value: Mixed, ID: 8', 1, '2024-10-08 21:56:32'),
(24, 'Data Deleted', 'Table: cable_work, Column: cable_work_id, ID: 8', 1, '2024-10-08 21:56:40'),
(25, 'Data Updated', 'Table: bill_bank, Column: bank_detail, Value: หมายเหตุ  : ชำระเป็น เงินสด โอนเข้าบัญชี\n<br>ธนาคาร กสิกรไทย สาขา บ่อสร้าง ประเภท ออมทรัพย์\n<br>ในนาม บริษัท พีเอสเอ็นเค เทเลคอม จำกัด (สำนักงานใหญ่)\n<br>บัญชีเลขที่ 086-3-06705-7, Where: ', 1, '2024-10-08 21:56:42'),
(26, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-08 21:56:55'),
(27, 'Data Updated', 'Table: company_address, Column: company_address_name, Value: <strong>ผู้ติดต่อ : Chavisa Wisetwohan</strong> <br>Tel.02 276-2236-8 Fax : 099-614-9196, Where: WHERE company_address_type = 2', 1, '2024-10-08 21:57:05'),
(28, '2', 'Login', 2, '2024-10-08 21:58:25'),
(29, '2', 'Logout', 2, '2024-10-08 21:58:35'),
(30, 'Bill Created', 'Bill ID: 1, Total Amount: 5', 1, '2024-10-08 22:01:53'),
(31, 'AU Deleted', 'ID: 1 AU: SM13075-0100020001-TH ', 1, '2024-10-08 22:02:09'),
(32, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-08 22:02:14'),
(33, 'File Uploaded', 'File uploaded successfully: 67055151c16bd.jpg', 1, '2024-10-08 22:35:45'),
(34, 'LINE Notify Sent', 'Notification sent to group: 1, user: นุ๊ก, job: งานแม่ปาย', 1, '2024-10-08 22:35:46'),
(35, 'LINE Notify Sent', 'LINE notification sent for user: นุ๊ก, job: งานแม่ปาย', 1, '2024-10-08 22:35:46'),
(36, 'Work Report Submitted', 'Report submitted by นุ๊ก for job: งานแม่ปาย, images: 1', 1, '2024-10-08 22:35:46'),
(37, '1', 'Logout', 1, '2024-10-08 22:51:35'),
(38, '1', 'Login', 1, '2024-10-08 22:51:40'),
(39, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-08 23:17:29'),
(40, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-08 23:17:38'),
(41, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-08 23:17:39'),
(42, '1', 'Login', 1, '2024-10-08 23:21:01'),
(43, 'Bill Updated', 'Bill ID: 1, Total Amount: 5', 1, '2024-10-08 23:35:17'),
(44, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 00:39:27'),
(45, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 00:39:33'),
(46, '1', 'Logout', 1, '2024-10-09 00:39:53'),
(47, '1', 'Login', 1, '2024-10-09 00:39:57'),
(48, '1', 'Login', 1, '2024-10-09 00:40:09'),
(49, '1', 'Login', 1, '2024-10-09 02:31:38'),
(50, '1', 'Login', 1, '2024-10-09 02:31:42'),
(51, '1', 'Login', 1, '2024-10-09 02:51:12'),
(52, 'Salary Created', 'Salary ID: 1, Employee ID: 1, Date: 2567-01-01', 1, '2024-10-09 02:53:27'),
(53, 'Salary Created', 'Salary ID: 2, Employee ID: 31, Date: 2567-01-01', 1, '2024-10-09 02:53:33'),
(54, 'PDF Created', 'Bill Mixed Type quotation', 1, '2024-10-09 03:16:05'),
(55, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:12:45'),
(56, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:12:48'),
(57, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:12:54'),
(58, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:13:15'),
(59, '1', 'Logout', 1, '2024-10-09 04:13:35'),
(60, '1', 'Login', 1, '2024-10-09 04:13:38'),
(61, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:13:56'),
(62, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:14:02'),
(63, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:15:04'),
(64, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:15:53'),
(65, 'AU Deleted', 'ID: 2 AU: SM13075-0100020002-TH ', 1, '2024-10-09 04:19:05'),
(66, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 04:19:16'),
(67, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:16:19'),
(68, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:16:41'),
(69, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:17:17'),
(70, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:17:26'),
(71, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:17:45'),
(72, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:18:08'),
(73, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:18:15'),
(74, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:18:19'),
(75, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:18:33'),
(76, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:18:42'),
(77, 'Salary Created', 'Salary ID: 3, Employee ID: 32, Date: 2567-01-01', 1, '2024-10-09 05:25:33'),
(78, 'Salary Created', 'Salary ID: 4, Employee ID: 33, Date: 2567-01-01', 1, '2024-10-09 05:25:42'),
(79, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:25:46'),
(80, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:26:18'),
(81, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:26:47'),
(82, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:27:53'),
(83, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:28:50'),
(84, 'Salary Updated', 'Salary ID: 1, Employee ID: 1, Date: 2567-01-01', 1, '2024-10-09 05:28:58'),
(85, 'Salary Updated', 'Salary ID: 2, Employee ID: 31, Date: 2567-01-01', 1, '2024-10-09 05:29:00'),
(86, 'Salary Updated', 'Salary ID: 2, Employee ID: 31, Date: 2567-01-01', 1, '2024-10-09 05:29:05'),
(87, 'Salary Updated', 'Salary ID: 1, Employee ID: 1, Date: 2567-01-01', 1, '2024-10-09 05:30:31'),
(88, 'Salary Updated', 'Salary ID: 2, Employee ID: 31, Date: 2567-01-01', 1, '2024-10-09 05:30:33'),
(89, 'Salary Updated', 'Salary ID: 3, Employee ID: 32, Date: 2567-01-01', 1, '2024-10-09 05:30:36'),
(90, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:30:41'),
(91, 'PDF Created', 'Bill Mixed Type quotation', 1, '2024-10-09 05:35:35'),
(92, 'Bill Deleted', 'Bill ID: 1, Company: Mixed', 1, '2024-10-09 05:35:50'),
(93, '1', 'Logout', 1, '2024-10-09 05:39:52'),
(94, '1', 'Login', 1, '2024-10-09 05:51:41'),
(95, '1', 'Logout', 1, '2024-10-09 05:51:44'),
(96, '1', 'Login', 1, '2024-10-09 05:51:50'),
(97, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 05:56:33'),
(98, 'Delete Folder', 'deleted folder: งานแม่ปาย-นุ๊ก-20241008173545', 1, '2024-10-09 05:57:42'),
(99, 'File Uploaded', 'File uploaded successfully: 6705b93b91fb4.jpg', 1, '2024-10-09 05:59:07'),
(100, 'LINE Notify Sent', 'Notification sent to group: 1, user: admin, job: งานแม่ปาย', 1, '2024-10-09 05:59:08'),
(101, 'LINE Notify Sent', 'LINE notification sent for user: admin, job: งานแม่ปาย', 1, '2024-10-09 05:59:08'),
(102, 'Work Report Submitted', 'Report submitted by admin for job: งานแม่ปาย, images: 1', 1, '2024-10-09 05:59:08'),
(103, 'Delete Folder', 'deleted folder: งานแม่ปาย-admin-20241009005907', 1, '2024-10-09 05:59:15'),
(104, 'Bill Created', 'Bill ID: 2, Total Amount: 2', 1, '2024-10-09 06:01:33'),
(105, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:10:37'),
(106, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:12:43'),
(107, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:12:49'),
(108, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:16:40'),
(109, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:17:00'),
(110, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:17:32'),
(111, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:18:14'),
(112, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:18:33'),
(113, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:18:38'),
(114, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:19:05'),
(115, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:19:08'),
(116, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:29:14'),
(117, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:30:26'),
(118, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:39:28'),
(119, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:40:01'),
(120, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:40:22'),
(121, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:40:44'),
(122, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:41:05'),
(123, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:41:15'),
(124, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:41:29'),
(125, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:41:41'),
(126, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:42:02'),
(127, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:42:14'),
(128, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:43:35'),
(129, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:43:58'),
(130, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:44:18'),
(131, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:44:35'),
(132, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:44:46'),
(133, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:45:10'),
(134, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:45:41'),
(135, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:45:58'),
(136, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:46:12'),
(137, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:48:18'),
(138, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:48:24'),
(139, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:48:45'),
(140, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:49:11'),
(141, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:49:34'),
(142, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:49:35'),
(143, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:49:39'),
(144, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:50:26'),
(145, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:51:42'),
(146, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:51:49'),
(147, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:00'),
(148, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:01'),
(149, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:02'),
(150, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:05'),
(151, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:06'),
(152, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:09'),
(153, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:12'),
(154, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:28'),
(155, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:52:45'),
(156, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:53:01'),
(157, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:53:24'),
(158, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:02'),
(159, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:10'),
(160, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:22'),
(161, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:26'),
(162, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:30'),
(163, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:44'),
(164, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:54:53'),
(165, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:55:01'),
(166, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:56:08'),
(167, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:56:22'),
(168, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:56:56'),
(169, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 1, month: 1, year: 2567', 1, '2024-10-09 06:57:01'),
(170, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 31, month: 1, year: 2567', 1, '2024-10-09 06:57:09'),
(171, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:57:13'),
(172, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:57:26'),
(173, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:59:00'),
(174, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 32, month: 1, year: 2567', 1, '2024-10-09 06:59:03'),
(175, 'Salary Updated', 'Salary ID: 4, Employee ID: 33, Date: 2567-01-01', 1, '2024-10-09 06:59:13'),
(176, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:59:15'),
(177, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:59:23'),
(178, 'Salary Updated', 'Salary ID: 4, Employee ID: 33, Date: 2567-01-01', 1, '2024-10-09 06:59:31'),
(179, 'PDF Export', 'Personal Salary PDF export initiated for employee_id: 33, month: 1, year: 2567', 1, '2024-10-09 06:59:33'),
(180, 'PDF Export', 'Salary PDF export initiated', 1, '2024-10-09 06:59:40'),
(181, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-09 07:14:12'),
(182, 'AU Data Imported', 'File: Balance-Cable _ Materials - Fttx_PSNK_TUK.xlsx', 1, '2024-10-09 07:17:23'),
(183, 'AU Added', 'AU Name: asd, Type: asd, Price: 2312, Company: Mixed', 1, '2024-10-09 07:43:05'),
(184, 'AU Deleted', 'ID: 4726 AU: asd ', 1, '2024-10-09 07:43:16'),
(185, 'AU Added', 'AU Name: asd, Type: ฟหกฟห, Price: 4645, Company: Mixed', 1, '2024-10-09 07:52:32'),
(186, 'AU Deleted', 'ID: 4727 AU: asd ', 1, '2024-10-09 07:52:42'),
(187, 'Salary Created', 'Salary ID: 5, Employee ID: 31, Date: 2567-02-01', 1, '2024-10-09 07:56:24'),
(188, 'Salary Deleted', 'Salary ID: 5, Employee ID: 31, Date: 2567-02-01', 1, '2024-10-09 07:56:32'),
(189, 'AU Added', 'AU Name: asd, Type: asdasd, Price: 1212, Company: asds', 1, '2024-10-09 08:09:21'),
(190, 'AU Deleted', 'ID: 4728 AU: asd ', 1, '2024-10-09 08:09:26'),
(191, 'Bill Created', 'Bill ID: 3, Total Amount: 201.64', 1, '2024-10-09 08:12:43'),
(192, 'Bill Deleted', 'Bill ID: 3, Company: Mixed', 1, '2024-10-09 08:12:46'),
(193, 'File Uploaded', 'File uploaded successfully: 6705daeec4e7a.jpg', 1, '2024-10-09 08:22:54'),
(194, 'File Uploaded', 'File uploaded successfully: 6705daeec562e.jpg', 1, '2024-10-09 08:22:54'),
(195, 'File Uploaded', 'File uploaded successfully: 6705daeec5dd0.jpg', 1, '2024-10-09 08:22:54'),
(196, 'LINE Notify Sent', 'Notification sent to group: 1, user: admin, job: งานแม่ปาย', 1, '2024-10-09 08:22:55'),
(197, 'LINE Notify Sent', 'LINE notification sent for user: admin, job: งานแม่ปาย', 1, '2024-10-09 08:22:55'),
(198, 'Work Report Submitted', 'Report submitted by admin for job: งานแม่ปาย, images: 3', 1, '2024-10-09 08:22:55'),
(199, '1', 'Login', 1, '2024-10-09 09:00:28'),
(200, '1', 'Login', 1, '2024-10-09 13:33:31'),
(201, 'Drum Created', 'Drum ID: 1, Drum No: 0062, Company: 2, Cable Company: 2', 1, '2024-10-09 13:34:40'),
(202, 'Cable Created', 'Cable ID: 1, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 999, Drum ID: 1', 1, '2024-10-09 13:34:53'),
(203, '1', 'Login', 1, '2024-10-12 13:30:46'),
(204, 'Drum Created', 'Drum ID: 2, Drum No: 0062, Company: 3, Cable Company: 2', 1, '2024-10-12 17:17:22'),
(206, 'Cable Created', 'Cable ID: 2, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 99, Drum ID: 2', 1, '2024-10-12 17:17:42'),
(207, '1', 'Login', 1, '2024-10-13 14:50:46'),
(208, 'Cable Deleted', 'Cable ID: 1, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 999, Drum ID: 1', 1, '2024-10-13 15:19:20'),
(209, 'Cable Deleted', 'Cable ID: 2, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 99, Drum ID: 2', 1, '2024-10-13 15:19:22'),
(210, 'Drum Deleted', 'Drum ID: 2, Drum No: 0062, Company: 3, Cable Company: 2', 1, '2024-10-13 15:19:26'),
(211, 'Drum Deleted', 'Drum ID: 1, Drum No: 0062, Company: 2, Cable Company: 2', 1, '2024-10-13 15:19:28'),
(212, 'Drum Created', 'Drum ID: 3, Drum No: 0062, Company: 2, Cable Company: 2', 1, '2024-10-13 15:24:07'),
(213, 'Cable Created', 'Cable ID: 3, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 99, Drum ID: 3', 1, '2024-10-13 15:24:19'),
(214, 'Cable Created', 'Cable ID: 4, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 9, Drum ID: 3', 1, '2024-10-13 15:29:47'),
(215, 'Cable Updated', 'Cable ID: 3, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 4000, Drum ID: 3', 1, '2024-10-13 21:53:55'),
(216, 'Cable Updated', 'Cable ID: 3, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 3999, Drum ID: 3', 1, '2024-10-13 21:55:52'),
(217, 'Cable Created', 'Cable ID: 5, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 1, Drum ID: 3', 1, '2024-10-13 21:56:06'),
(218, 'Cable Deleted', 'Cable ID: 5, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 1, Drum ID: 3', 1, '2024-10-13 21:57:19'),
(219, '1', 'Login', 1, '2024-10-14 20:20:18'),
(220, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-14 21:10:34'),
(221, 'AU Deleted', 'ID: 4097 AU: SM13075-0100020002-TH ', 1, '2024-10-14 21:10:40'),
(222, 'AU Data Imported', 'File: AUlistAll.xlsx', 1, '2024-10-14 21:10:46'),
(223, '1', 'Login', 1, '2024-10-18 17:07:34'),
(224, 'Bill Created', 'Bill ID: 4, Total Amount: 10840', 1, '2024-10-18 17:10:28'),
(225, 'Bill Updated', 'Bill ID: 4, Total Amount: 10000', 1, '2024-10-18 17:12:25'),
(226, 'Bill Updated', 'Bill ID: 4, Total Amount: 10037.4', 1, '2024-10-18 17:13:27'),
(227, 'Bill Updated', 'Bill ID: 4, Total Amount: 10081.4', 1, '2024-10-18 17:13:32'),
(228, 'PDF Created', 'Bill Mixed Type quotation', 1, '2024-10-18 17:13:38'),
(229, 'Bill Updated', 'Bill ID: 4, Total Amount: 10033', 1, '2024-10-18 17:13:45'),
(230, 'Bill Updated', 'Bill ID: 4, Total Amount: 33', 1, '2024-10-18 17:13:51'),
(231, 'Bill Updated', 'Bill ID: 4, Total Amount: 2475', 1, '2024-10-18 17:14:01'),
(232, 'Bill Updated', 'Bill ID: 4, Total Amount: 33', 1, '2024-10-18 17:14:08'),
(233, '1', 'Login', 1, '2024-11-13 12:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(4) NOT NULL,
  `salary` double(8,2) NOT NULL,
  `ot` double(8,2) NOT NULL,
  `social_security` double(8,2) NOT NULL,
  `other` double(8,2) NOT NULL,
  `total_salary` double(8,2) NOT NULL,
  `salary_date` date NOT NULL,
  `employee_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `salary`, `ot`, `social_security`, `other`, `total_salary`, `salary_date`, `employee_id`) VALUES
(1, 20000.00, 20.00, 20.00, 20.00, 20060.00, '2567-01-01', 1),
(2, 20000.00, 20.00, 20.00, 20.00, 20060.00, '2567-01-01', 31),
(3, 20000.00, 500.00, 20.00, 20.00, 20540.00, '2567-01-01', 32),
(4, 250000.00, 20.00, 20.00, 20.00, 250060.00, '2567-01-01', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passW` varchar(100) NOT NULL,
  `lv` varchar(1) NOT NULL COMMENT '0=admin,1=เจ้าของ,2=พนักงานเอกสาร,3=พนักงานปฏิบัติงาน',
  `status` varchar(1) NOT NULL COMMENT '1=ใช้งาน,0=แบน',
  `users_date` datetime NOT NULL,
  `employee_id` int(4) NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passW`, `lv`, `status`, `users_date`, `employee_id`, `delete_at`) VALUES
(1, 'admin', '$2y$10$c8vj27z4jfmAEJFl76foR.NWV7ev8Is0zjjeZnVp8VI527nISuh3W', '0', '1', '2024-08-26 22:49:06', 1, NULL),
(2, 'view', '$2y$10$qRo0vVrwB3rxbhLZ6/txbezqvCRpxMySATaHlZ/aY3muon3p67fwG', '3', '1', '2024-09-28 22:39:07', 31, NULL),
(3, 'owner', '$2y$10$NpldOTmAGjwvy/edDtMWi.8RdMlVivCL9ldtcYde3WgtrJIM6KKle', '1', '1', '2024-10-08 21:33:39', 32, NULL),
(4, 'employee', '$2y$10$2/UWQecJz4EczPa/IuMoQ.eZMLC2R.xHv7Yo2UeaS/WgtL3fskJ0G', '2', '1', '2024-10-08 21:34:20', 33, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `au_all`
--
ALTER TABLE `au_all`
  ADD PRIMARY KEY (`au_id`),
  ADD UNIQUE KEY `au_name` (`au_name`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `bill_bank`
--
ALTER TABLE `bill_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`bill_id`,`au_id`),
  ADD KEY `au_id` (`au_id`);

--
-- Indexes for table `cable`
--
ALTER TABLE `cable`
  ADD PRIMARY KEY (`cable_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `drum_id` (`drum_id`),
  ADD KEY `cable_work_fk` (`cable_work_id`);

--
-- Indexes for table `cable_work`
--
ALTER TABLE `cable_work`
  ADD PRIMARY KEY (`cable_work_id`);

--
-- Indexes for table `company_address`
--
ALTER TABLE `company_address`
  ADD PRIMARY KEY (`company_address_id`);

--
-- Indexes for table `drum`
--
ALTER TABLE `drum`
  ADD PRIMARY KEY (`drum_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `drum_ibfk_2` (`drum_company_id`),
  ADD KEY `drum_ibfk_3` (`drum_cable_company_id`);

--
-- Indexes for table `drum_cable_company`
--
ALTER TABLE `drum_cable_company`
  ADD PRIMARY KEY (`drum_cable_company_id`);

--
-- Indexes for table `drum_company`
--
ALTER TABLE `drum_company`
  ADD PRIMARY KEY (`drum_company_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `au_all`
--
ALTER TABLE `au_all`
  MODIFY `au_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5234;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bill_bank`
--
ALTER TABLE `bill_bank`
  MODIFY `bank_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cable`
--
ALTER TABLE `cable`
  MODIFY `cable_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cable_work`
--
ALTER TABLE `cable_work`
  MODIFY `cable_work_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_address`
--
ALTER TABLE `company_address`
  MODIFY `company_address_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drum`
--
ALTER TABLE `drum`
  MODIFY `drum_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drum_cable_company`
--
ALTER TABLE `drum_cable_company`
  MODIFY `drum_cable_company_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `drum_company`
--
ALTER TABLE `drum_company`
  MODIFY `drum_company_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `au_id_fk` FOREIGN KEY (`au_id`) REFERENCES `au_all` (`au_id`),
  ADD CONSTRAINT `bill_id_fk` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`);

--
-- Constraints for table `cable`
--
ALTER TABLE `cable`
  ADD CONSTRAINT `cable_work_fk` FOREIGN KEY (`cable_work_id`) REFERENCES `cable_work` (`cable_work_id`);

--
-- Constraints for table `drum`
--
ALTER TABLE `drum`
  ADD CONSTRAINT `drum_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `drum_ibfk_2` FOREIGN KEY (`drum_company_id`) REFERENCES `drum_company` (`drum_company_id`),
  ADD CONSTRAINT `drum_ibfk_3` FOREIGN KEY (`drum_cable_company_id`) REFERENCES `drum_cable_company` (`drum_cable_company_id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
