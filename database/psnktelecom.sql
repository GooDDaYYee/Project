-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 06:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `au_id` varchar(100) NOT NULL,
  `au_detail` varchar(255) NOT NULL,
  `au_type` varchar(20) NOT NULL,
  `au_price` double NOT NULL,
  `au_company` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `au_all`
--

INSERT INTO `au_all` (`au_id`, `au_detail`, `au_type`, `au_price`, `au_company`) VALUES
('Mix-TD-17.85', 'Test & Verify Fiber (Test Power Meter - Light Source & Test OTDR Core Spare) Site to Site (A-Z และ Z-A)', 'Set', 5, 'Mixed'),
('SM13075-0100020001-TH', 'Cable installation service Outdoor Arial including Sticker,Survey Drawing, Permission Drawing, Other Drawing, Aerial to Duct, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 9.07, 'FBH'),
('SM13075-0100020002-TH', 'Cable installation service Underground in provided or constructed conduit or Duct. including Survey Drawing, Permission Drwaing, Other Drawing, Duct to Aerial, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 11.76, 'FBH'),
('SM13075-0100090001-TH', 'Splicing OF-Cable on Aerial, Underground, In Building < 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 1, 'FBH'),
('SM13075-0100090002-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2, 'FBH'),
('SM13075-0100090003-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 24 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2, 'FBH'),
('SM13075-0100090004-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 36 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 3, 'FBH'),
('SM13075-0100090005-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 48 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4, 'FBH'),
('SM13075-0100090006-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 60 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4, 'FBH'),
('SM13075-0100100001-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
('SM13075-0100100002-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
('SM13075-0100100003-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 133.88, 'FBH'),
('SM13075-0100110001-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
('SM13075-0100110002-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
('SM13075-0100110003-TH', 'Installation  Inline&L1 Closure  material only', 'EA', 223.13, 'FBH'),
('SM13075-0100170001-TH', 'Installation+Splicing L2 Splitter included Test E2E', 'Set', 870.19, 'FBH'),
('SM13075-0100190001-TH', 'Design by QRUN included Sync Test Best, Sync IM', 'M', 0.58, 'FBH'),
('SM13075-0100200001-TH', 'Remove OFC cable Y(N)', 'M', 1.34, 'FBH'),
('SM13075-0100200002-TH', 'Remove OFC cable Y(R)', 'M', 3.57, 'FBH'),
('SM13075-0100240002-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง เชียงใหม่ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.23, 'FBH'),
('SM13075-0100240003-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง น่าน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
('SM13075-0100240004-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง พะเยา ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
('SM13075-0100240005-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง แพร่ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.18, 'FBH'),
('SM13075-0100240006-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง แม่ฮ่องสอน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.3, 'FBH'),
('SM13075-0100240007-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำปาง ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.2, 'FBH'),
('SM13075-0100240008-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำพูน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
('SM13075-0100240009-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง อุตรดิตถ์ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.21, 'FBH'),
('SM13075-0100250004-TH', 'Digitize Base Map for Survey (Grid)', 'EA', 200.82, 'FBH'),
('SM13075-0100290001-TH', 'Digitize 1 - 50 HH คิดต่อ Grid  สำหรับ Happy Block', 'EA', 803.25, 'FBH'),
('SM13075-0100290002-TH', 'จำนวนบ้านส่วนที่เกินตั้งแต่ 51 ถึง 250 HH ใน Grid นั้น คิดต่อ HH สำหรับ Happy Block', 'EA', 8.93, 'FBH'),
('SM13075-0100290003-TH', 'Digitize Grid >250HH เหมาจ่าย/Grid (สำหรับผู้รับเหมาในสัญญาปกติ) สำหรับ Happy Block', 'EA', 1, 'FBH'),
('SM13075-0100300001-TH', 'Detail Design for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1, 'FBH'),
('SM13075-0100300002-TH', 'Detail Design for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 2, 'FBH'),
('SM13075-0100300003-TH', 'Detail Design for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 3, 'FBH'),
('SM13075-0100300004-TH', 'Detail Design for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 4, 'FBH'),
('SM13075-0100300005-TH', 'Detail Design for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 5, 'FBH'),
('SM13075-0100300006-TH', 'Detail Design for FTTH MDU >700 Homepass (Design บน Autocad)', 'SET', 5, 'FBH'),
('SM13075-0100310001-TH', 'Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 626.54, 'FBH'),
('SM13075-0100310002-TH', 'Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1, 'FBH'),
('SM13075-0100310003-TH', 'Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1, 'FBH'),
('SM13075-0100310004-TH', 'Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2, 'FBH'),
('SM13075-0100310005-TH', 'Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2, 'FBH'),
('SM13075-0100310006-TH', 'Drawing for FTTH MDU >700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 4, 'FBH'),
('SM13075-0100320001-TH', 'Final As-built Drawing approved for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 208.85, 'FBH'),
('SM13075-0100320002-TH', 'Final As-built Drawing approved for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 417.69, 'FBH'),
('SM13075-0100320003-TH', 'Final As-built Drawing approved for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 580.13, 'FBH'),
('SM13075-0100320004-TH', 'Final As-built Drawing approved for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 892.5, 'FBH'),
('SM13075-0100320005-TH', 'Final As-built Drawing approved for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1, 'FBH'),
('SM13075-0100320006-TH', 'Final As-built Drawing approved for FTTH MDU >700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1, 'FBH'),
('SM13075-0100320007-TH', 'Final As-built Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 133.88, 'FBH'),
('SM13075-0100320008-TH', 'Final As-built Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 267.75, 'FBH'),
('SM13075-0100320009-TH', 'Final As-built Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 357, 'FBH'),
('SM13075-0100320010-TH', 'Final As-built Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 535.5, 'FBH'),
('SM13075-0100320011-TH', 'Final As-built Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 714, 'FBH'),
('TPCHDMX001C', 'Cable installation service in-building including survey Drawing  duct and all material', 'Meter', 158.4, 'Mixed'),
('TPCHDMX002C', 'Cable installation service indoor in provided or constructed conduit or duct. Including survey and drawing ', 'Meter', 21.24, 'Mixed'),
('TPCHDMX003C', 'Service charge for Installation Optical Fiber Cable in building. (Per Site)', 'Site', 2, 'Mixed'),
('TPCHDMX004C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.2, 'Mixed'),
('TPCHDMX005C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
('TPCHDMX006C', 'Cable installation service Outdoor Arial including survey Drawing and all material e.g. sticker according to PEA/MEA/Authorities standard', 'Meter', 11, 'Mixed'),
('TPCHDMX007C', 'Cable installation service Outdoor in provided or constructed conduit Including survey and drawing ', 'Meter', 11, 'Mixed'),
('TPCHDMX008C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.2, 'Mixed'),
('TPCHDMX009C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
('TPCHDMX010C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 273.6, 'Mixed'),
('TPCHDMX011C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 420, 'Mixed'),
('TPCHDMX012C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 410.4, 'Mixed'),
('TPCHDMX013C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 495.36, 'Mixed'),
('TPCHDMX014C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 840, 'Mixed'),
('TPCHDMX015C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 756, 'Mixed'),
('TPCHDMX016C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 777.6, 'Mixed'),
('TPCHDMX017C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 1, 'Mixed'),
('TPCHDMX018C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1, 'Mixed'),
('TPCHDMX019C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 360, 'Mixed'),
('TPCHDMX020C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 650, 'Mixed'),
('TPCHDMX021C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 612, 'Mixed'),
('TPCHDMX022C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 720, 'Mixed'),
('TPCHDMX023C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1, 'Mixed'),
('TPCHDMX024C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 900, 'Mixed'),
('TPCHDMX025C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 972, 'Mixed'),
('TPCHDMX026C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 2, 'Mixed'),
('TPCHDMX027C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1, 'Mixed'),
('TPCHDMX028C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1, 'Mixed'),
('TPCHDMX029A', 'Construction for conduit 1 x 3/4\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 52.89, 'Mixed'),
('TPCHDMX030A', 'Install and Supply material  Cross 1 x 4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'M', 450, 'Mixed'),
('TPCHDMX031A', ' Install and Supply material  Riser Pole 1-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 1, 'Mixed'),
('TPCHDMX032A', 'Install and Supply material Riser Pole 2-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 2, 'Mixed'),
('TPCHDMX033A', 'Install and Supply material Riser Pole 4-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 4, 'Mixed'),
('TPCHDMX034A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 1, 'Mixed'),
('TPCHDMX035A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 3, 'Mixed'),
('TPCHDMX036A', 'Construction for conduit 1 x 1\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 72, 'Mixed'),
('TPCHDMX037A', 'Construction for conduit 1 x 2\" inside building  Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 174.02, 'Mixed'),
('TPCHDMX038A', 'Construction for conduit 1 x 3/4\" outside building Material type IMC', 'Meter', 75.6, 'Mixed'),
('TPCHDMX039A', 'Construction for conduit 1 x 1\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 111.6, 'Mixed'),
('TPCHDMX040A', 'Construction for conduit 1 x 2\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 226.08, 'Mixed'),
('TPCHDMX041A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 13, 'Mixed'),
('TPCHDMX042A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 23, 'Mixed'),
('TPCHDMX043A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 27, 'Mixed'),
('TPCHDMX044A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 21, 'Mixed'),
('TPCHDMX045A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 33, 'Mixed'),
('TPCHDMX046A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 36, 'Mixed'),
('TPCHDMX047C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 36, 'Mixed'),
('TPCHDMX048C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1, 'Mixed'),
('TPCHDMX049C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1, 'Mixed'),
('TPCHDMX050C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 2, 'Mixed'),
('TPCHDMX051C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'M', 1, 'Mixed'),
('TPCHDMX052C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling) Excluded Concrete pole  (scope includes Survey, Design, Installation, and Metetials)', 'M', 2, 'Mixed'),
('TPCHDMX053C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 46.8, 'Mixed'),
('TPCHDMX054C', 'Open Cut & Repair road surface reinf concrete, Kerb& Drain Kerb', 'Sq. Meter', 1, 'Mixed'),
('TPCHDMX055C', 'Open Cut & Repair Footpath surface Asphalt', 'Sq. Meter', 969.12, 'Mixed'),
('TPCHDMX056C', 'Open Cut & Repair Footpath surface  Interlock', 'Sq. Meter', 969.12, 'Mixed'),
('TPCHDMX057C', 'Break Through Pull Box for prepare cable couduit (service only)', 'Each', 648, 'Mixed'),
('TPCHDMX058C', 'Break Through Man Hole for prepare cable couduit (serviice only)', 'Each', 1, 'Mixed'),
('TPCHDMX059C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 61.2, 'Mixed'),
('TPCHDMX060C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 79.2, 'Mixed'),
('TPCHDMX061A', 'Supply and install cross Arm type steel ', 'Each', 756, 'Mixed'),
('TPCHDMX062A', 'Supply and install cross Arm type steel ', 'Each', 972, 'Mixed'),
('TPCHDMX063A', 'Supply deliver and install concrete pole', 'Pole', 5, 'Mixed'),
('TPCHDMX064A', 'Supply deliver and install concrete pole', 'Pole', 7, 'Mixed'),
('TPCHDMX065A', 'Supply and install cross Arm type Wooden', 'Each', 540, 'Mixed'),
('TPCHDMX066C', 'Fiber Splicing and termination', 'Core', 165.6, 'Mixed'),
('TPCHDMX067C', 'Fiber Splicing and termination', 'Core', 126, 'Mixed'),
('TPCHDMX068C', 'Fiber Splicing and termination', 'Core', 108, 'Mixed'),
('TPCHDMX069C', 'Fiber Splicing and termination', 'Core', 93.6, 'Mixed'),
('TPCHDMX070C', 'Fiber Splicing and termination', 'Core', 86.4, 'Mixed'),
('TPCHDMX071C', 'Fiber Splicing and termination', 'Core', 64.8, 'Mixed'),
('TPCHDMX072C', 'Fiber Splicing and termination', 'Core', 57.6, 'Mixed'),
('TPCHDMX082C', 'Install Enclosure for OFC 12 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX083C', 'Install Enclosure for OFC 24-48 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX084C', 'Install Enclosure for OFC 60 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX085C', 'Install Enclosure for OFC 72 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX086C', 'Install Enclosure for OFC 96 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX087C', 'Install Enclosure for OFC 120 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX088C', 'Install Enclosure for OFC 144 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX089C', 'Install Enclosure for OFC 216 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX090C', 'Install Enclosure for OFC 312 cores (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX102C', 'Install ODF 24 ports for rack mounted (12 pigtail) Indoor (service only)', 'Each', 360, 'Mixed'),
('TPCHDMX103C', 'Install ODF 24 ports for rack mounted (24 pigtail) Indoor (service only)', 'Each', 360, 'Mixed'),
('TPCHDMX104C', 'Install ODF 12 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432, 'Mixed'),
('TPCHDMX105C', 'Install ODF 24 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432, 'Mixed'),
('TPCHDMX106C', 'Install ODF 48 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432, 'Mixed'),
('TPCHDMX107C', 'Install ODF 24 ports for rack mounted (12 pigtail) Outdoor (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX108C', 'Install ODF 24 ports for rack mounted (24 pigtail) Outdoor (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX109C', 'Install ODF 48 ports for rack mounted (48 pigtail) Outdoor (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX110C', 'Install ODF 120 ports for rack mounted (120 pigtail) Outdoor(service only)', 'Each', 145, 'Mixed'),
('TPCHDMX111C', 'Install ODF 144 ports for rack mounted (144 pigtail) Outdoor (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX112C', 'Install ODF 216 ports for rack mounted (216 pigtail) Outdoor (service only)', 'Each', 145, 'Mixed'),
('TPCHDMX115C', 'Remove service for ODF Box', 'Each', 500, 'Mixed'),
('TPCHDMX129C', 'Service for proceeding installation permission from Authority (Per Route)', 'Route', 1, 'Mixed'),
('TPCHDMX131C', 'Extra charge for transportation for island site (Per Site)', 'Site', 3, 'Mixed'),
('TPCHDMX132C', 'Pre survey for designated hop (Hi-level Keymap) in case not installation cable in this route', 'Route', 1, 'Mixed'),
('TPCHDMX133C', 'Survey for design and drawing for work permission in case not installation cable in this route', 'Route', 2, 'Mixed'),
('TPCHDMX134C', 'Survey for design and drawing for work permission (based on PEA/MEA/Authorities standard requirement) in case not installation cable in this route', 'Meter', 1.08, 'Mixed'),
('TPCHDMX135C', 'Need ODTR result both from A to Z and Z to A', 'Core', 1, 'Mixed'),
('TPCHDMX136C', 'Site or enclosure location Access to support fiber core arrangement or OTDR test', 'Site', 1, 'Mixed'),
('TPCHDMX137C', 'Service for proceeding the work permission from PEA/MEA/Authorities for civil work on the road (Per Route)', 'Route', 2, 'Mixed'),
('TPCHDMX138C', 'Service for proceeding the work permission from  PEA/MEA/Authorities for civil work crossing the road (Per Route)', 'Route', 3, 'Mixed'),
('TPCHDMX140C', 'Survey & Drawing & Permission including cost for open Pull box\\Manhole and cost for access site', 'Meter', 9.22, 'Mixed'),
('TPCHDMX141A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8, 'Mixed'),
('TPCHDMX142A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8, 'Mixed'),
('TPCHDMX143A', 'Installation service Include Micro tube  & Material ', 'Meter', 17.28, 'Mixed'),
('TPCHDMX144A', 'Installation service Include Micro tube  & Material ', 'Meter', 20.88, 'Mixed'),
('TPCHDMX145A', 'Installation service Include Micro tube  & Material ', 'Meter', 21.7, 'Mixed'),
('TPCHDMX146A', 'Installation service Include Micro Duct  & Material ', 'Meter', 37, 'Mixed'),
('TPCHDMX147A', 'Installation service Include Micro Duct  & Material ', 'Meter', 28.8, 'Mixed'),
('TPCHDMX148A', 'Installation service Include Micro Duct  & Material ', 'Meter', 30.84, 'Mixed'),
('TPCHDMX149A', 'Installation service Include Micro Duct  & Material ', 'Meter', 39.6, 'Mixed'),
('TPCHDMX150A', 'Installation service Include Micro Duct  & Material ', 'Meter', 63.36, 'Mixed'),
('TPCHDMX151C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 18, 'Mixed'),
('TPCHDMX152C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 20.88, 'Mixed'),
('TPCHDMX153C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 21.6, 'Mixed'),
('TPCHDMX154C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 23.04, 'Mixed'),
('TPCHDMX155C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 24.09, 'Mixed'),
('TPCHDMX156C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 28.79, 'Mixed'),
('TPCHDMX157C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 36.3, 'Mixed'),
('TPCHDMX158C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 48.39, 'Mixed'),
('TPCHDMX159C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 50.04, 'Mixed'),
('TPCHDMX160C', 'Installation service', 'Point', 216, 'Mixed'),
('TPCHDMX161C', 'Installation of Fiber Blow including OFC and Services', 'Set', 3, 'Mixed'),
('TPCHDMX162A', 'Installation service Include Sub-duct Fabric  & Material  ', 'Meter', 8, 'Mixed'),
('TPCHDMX163A', 'Installation service Include Micro tube  & Material', 'Meter', 52.92, 'Mixed'),
('TPCHDMX164A', 'Installation service Include Micro tube  & Material', 'Meter', 49.32, 'Mixed'),
('TPCHDMX173C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14, 'Mixed'),
('TPCHDMX174C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14, 'Mixed'),
('TPCHDMX175C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14, 'Mixed'),
('TPCHDMX176C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14, 'Mixed'),
('TPCHDMX177C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18, 'Mixed'),
('TPCHDMX178C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18, 'Mixed'),
('TPCHDMX179C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18, 'Mixed'),
('TPCHDMX180C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18, 'Mixed'),
('TPCHDMX181C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18, 'Mixed'),
('TPCHDMX182C', 'Re-arrange OFC cable on existing pole or cross-arm (Per Pole)', 'Pole', 108, 'Mixed'),
('TPCHDMX183A', 'Sticker attaching to the cable (incld stickers)', 'Pole per Cable', 15, 'Mixed'),
('TPCHDMX184C', 'Transportation for disposal ', 'KM ', 10.8, 'Mixed'),
('TPCHDMX185C', 'Cable disposal', 'KG', 8.64, 'Mixed'),
('TPCHDMX189C', 'Install ODF 60 ports for rack mounted (60 pigtail) Indoor (service only)', 'EA', 360, 'Mixed'),
('TPCHDMX237M', '1)ประสานงานกับการ PEA,MEA เรื่องการขอติดตั้งมิเตอร์ขนาดตามที่ ทรูฯ กำหนดในทุกขั้นตอน จนสามารถติดตั้งมิเตอร์ได้ 2)รับผิดชอบค่าใช้จ่ายในการประสานงาน,ค่าธรรมเนียมในการติดตั้งมิเตอร์ และค่าดำเนินการอื่นๆที่เกี่ยวข้อง 3)หนังสือการขอติดตั้งมิเตอร์ทาง ทรูฯ เป็นผ', 'Set', 3, 'Mixed'),
('TPCHDMX238A', 'OLT Suppy and Installation Power, UTP, Grounding, Transportation and All Accessories (Excluded OLT Cabinet) Include Cutover and Install Support', 'Set', 15, 'Mixed'),
('TPUHD54001C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1, 'Mixed'),
('TPUHD54002A', 'Installation ODF Street Cabinet and Pole Type (Included TransPortation, Vehicle Rental, Construction)', 'Set', 5, 'Mixed'),
('TPUHD54002C', 'Remove of A8', 'EA', 1, 'Mixed'),
('TPUHD54003A', 'L2 Closure + Box Splitter 1:8 Material+Construction+Transportation', 'Set', 500, 'Mixed'),
('TPUHD54003C', 'Remove of A10', 'EA', 1, 'Mixed'),
('TPUHD54004A', 'L2 Closure + Box Splitter 1:16 Material+Construction+Transportation', 'Set', 500, 'Mixed'),
('TPUHD54004C', 'Remove of D3A Cable Extension Arm', 'EA', 350, 'Mixed'),
('TPUHD54005A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54005C', 'Remove Cross-arm Y(N)', 'EA', 55, 'Mixed'),
('TPUHD54006A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54006C', 'Remove Cross-arm Y(R)', 'EA', 65, 'Mixed'),
('TPUHD54007A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54007C', 'Y(S) Outdoor Dslam all Type', 'EA', 6, 'Mixed'),
('TPUHD54008A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54008C', 'Y(S) Outdoor Dslam all Type included SupPort Riser', 'EA', 7, 'Mixed'),
('TPUHD54009A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 3 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54009C', 'จัดระเบียบ และรื้อย้ายสายสื่อสารที่ไม่ได้ใช้งาน ตามที่ทางการไฟฟ้าฯ และ ทรูฯ กำหนด ราคาเหมาจ่าย 1 กิโลเมตร รวมค่าขนส่งเคเบิลที่ไม่ได้ใช้งานไปยังสถานที่ที่ ทรู กำหนด (เฉพาะ กทม. และ ปริมณฑล)', 'KM', 2, 'Mixed'),
('TPUHD54010A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 4 Set Material+Constuction+Transportation', 'Set', 300, 'Mixed'),
('TPUHD54010C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1, 'Mixed'),
('TPUHD54011A', 'Aluminum Optic Distribution Fiber support Splitter Module Maximum 32 Ports included E2E Test', 'EA', 1, 'Mixed'),
('TPUHD54011C', 'Breaking Reinforced Concrete 10 cm. Thickness', 'M2', 50, 'Mixed'),
('TPUHD54012A', '24 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 10 ซม.', 'M2', 750, 'Mixed'),
('TPUHD54012C', 'Breaking Reinforced Concrete 15 cm. Thickness', 'M2', 140, 'Mixed'),
('TPUHD54013A', '24 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 15 ซม.', 'M2', 1, 'Mixed'),
('TPUHD54013C', 'Breaking Asphalt Road 5 cm.', 'M2', 110, 'Mixed'),
('TPUHD54014A', '8 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 10 ซม.', 'M2', 900, 'Mixed'),
('TPUHD54014C', 'Breaking Asphalt Road 10 cm.', 'M2', 140, 'Mixed'),
('TPUHD54015A', '8 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 15 ซม.', 'M2', 1, 'Mixed'),
('TPUHD54015C', 'Dig & Repair Ground', 'M2', 120, 'Mixed'),
('TPUHD54016A', 'Overlay Hotmixed 5 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 300, 'Mixed'),
('TPUHD54016C', 'Re-Information existing \"Closure\" and included Sync Testbed and Confirm data to True\'s for Sync IM (คิดต่อ 1 Closure)', 'EA', 250, 'Mixed'),
('TPUHD54017A', 'Overlay Hotmixed 10 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 450, 'Mixed'),
('TPUHD54017C', 'Record Information งานจัดระเบียบสาย 2021 สำหรับ OF Cable, Dropwire, Coaxial Cable ทุกเส้น ตามที่ ทรู กำหนดให้ ลงบน Report หรือ Application ที่กำหนด', 'KM', 1, 'Mixed'),
('TPUHD54018A', 'Concrete Road 15 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 15 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 550, 'Mixed'),
('TPUHD54018C', 'Remove Conduit All Type Y(N)', 'EA', 6, 'Mixed'),
('TPUHD54019A', 'Concrete Road 20 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 20 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 750, 'Mixed'),
('TPUHD54019C', 'Remove Closure Splitter and Inline Closure Y(N)', 'EA', 50, 'Mixed'),
('TPUHD54020A', 'Repair Concrete Road และ Footpath คอนกรีต 15 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750, 'Mixed'),
('TPUHD54020C', 'Remove Closure Splitter and Inline Closure Y(R)', 'EA', 100, 'Mixed'),
('TPUHD54021A', 'Repair Concrete Road และ Footpath คอนกรีต 20 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750, 'Mixed'),
('TPUHD54021C', 'Remove Splitter L1 and L2 Y(N) Bare & Box', 'EA', 5, 'Mixed'),
('TPUHD54022A', 'งานซ่อมถนน Asphalt Road ด้วยการตัดพื้น ความหนา 5 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 420, 'Mixed'),
('TPUHD54022C', 'Remove Splitter L1 and L2 Y(R) Bare & Box', 'EA', 10, 'Mixed'),
('TPUHD54023A', 'งานซ่อม Asphalt Road ด้วยการตัดพื้น ความหนา 10 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 550, 'Mixed'),
('TPUHD54023C', 'Design by QRUN included Sync Test Best, Sync IM', 'M', 1, 'Mixed'),
('TPUHD54024A', 'D1C - Galvanized Steel Ground Wire (Wire Rope) เฉพาะ W&W, Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 480, 'Mixed'),
('TPUHD54024C', 'Remove ODF Box All Type Y(N)', 'EA', 350, 'Mixed'),
('TPUHD54025A', 'D7C-Pole Ground with Ground Rod 2.4 M. Welding by Exothermic or Brass เฉพาะ W&W,  Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 250, 'Mixed'),
('TPUHD54025C', 'Remove ODF Street Cabinet & Pole Type', 'ea\\', 4, 'Mixed'),
('TPUHD54026A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type A (Wall Type, Apartment),B (Last Pole of Current Subs)', 'Set', 650, 'Mixed'),
('TPUHD54026C', 'Install RG 6 Coaxial Cable In Conduit', 'M', 6, 'Mixed'),
('TPUHD54027A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type C (Co-location L2)', 'Set', 340, 'Mixed'),
('TPUHD54027C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
('TPUHD54028A', 'Installation Flat Optic 1 or 2 Fiber 1 - 25 Meter for Maintenance', 'SET', 450, 'Mixed'),
('TPUHD54028C', 'Install RG 6 Coaxial Cable In Conduit', 'EA', 6, 'Mixed'),
('TPUHD54029A', 'Installation Flat Optic 1 or 2 Fiber 26 – 50 Meter for Maintenance', 'SET', 500, 'Mixed'),
('TPUHD54029C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
('TPUHD54030A', 'Installation Flat Optic 1 or 2 Fiber 51 – 75 Meter for Maintenance', 'SET', 610, 'Mixed'),
('TPUHD54030C', 'Remove Coaxial cable (Non-Usable)', 'M', 1.8, 'Mixed'),
('TPUHD54031A', 'Installation Flat Optic 1 or 2 Fiber 76 – 100 Meter for Maintenance', 'SET', 650, 'Mixed'),
('TPUHD54031C', 'Remove Coaxial cable (Re-Usable)', 'M', 4.5, 'Mixed'),
('TPUHD54032A', 'Installation Flat Optic 1 or 2 Fiber 101 – 125 Meter for Maintenance', 'SET', 770, 'Mixed'),
('TPUHD54032C', 'Installation  ODF 48-60 Core wall & pole mounted Indoor SC/APC Connector and included installation pigtail L=1.5, 3.0 M', 'EA', 432, 'Mixed'),
('TPUHD54033A', 'Installation Flat Optic 1 or 2 Fiber 126 – 150 Meter for Maintenance', 'SET', 880, 'Mixed'),
('TPUHD54034A', 'Installation Flat Optic 1 or 2 Fiber 151 – 175 Meter for Maintenance', 'SET', 990, 'Mixed'),
('TPUHD54035A', 'Installation Flat Optic 1 or 2 Fiber 176 – 200 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54036A', 'Installation Flat Optic 1 or 2 Fiber 201 – 225 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54037A', 'Installation Flat Optic 1 or 2 Fiber 226 – 250 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54038A', 'Installation Flat Optic 1 or 2 Fiber 251 – 275 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54039A', 'Installation Flat Optic 1 or 2 Fiber 276 – 300 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54040A', 'Installation Flat Optic 1 or 2 Fiber 301 – 325 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54041A', 'Installation Flat Optic 1 or 2 Fiber 326 – 350 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54042A', 'Installation Flat Optic 1 or 2 Fiber 351 – 375 Meter for Maintenance', 'SET', 1, 'Mixed'),
('TPUHD54043A', 'Installation Flat Optic 1 or 2 Fiber 376 – 400 Meter for Maintenance', 'SET', 2, 'Mixed'),
('TPUHD54044A', 'Installation Flat Optic 1 or 2 Fiber 401 – 425 Meter for Maintenance', 'SET', 2, 'Mixed'),
('TPUHD54045A', 'Installation Flat Optic 1 or 2 Fiber 426 – 450 Meter for Maintenance', 'SET', 2, 'Mixed'),
('TPUHD54046A', 'Installation Flat Optic 1 or 2 Fiber 451 – 475 Meter for Maintenance', 'SET', 2, 'Mixed'),
('TPUHD54047A', 'Installation Flat Optic 1 or 2 Fiber 476 – 500 Meter for Maintenance', 'SET', 2, 'Mixed'),
('TPUHD54048C', 'ค่าเปิด Enclosure เดิมทุกขนาด (ไม่รวมค่า Splicing)', 'EA', 1, 'Mixed'),
('TPUHD54050A', 'Splicing OF-Cable on Aerial < 12 Fibers', 'EA', 2, 'Mixed'),
('TPUHD54051A', 'Splicing OF-Cable on Aerial 12 Fibers', 'EA', 3, 'Mixed'),
('TPUHD54052A', 'Splicing OF-Cable on Aerial 24 Fibers', 'EA', 4, 'Mixed'),
('TPUHD54053A', 'Splicing OF-Cable on Aerial 36 Fibers', 'EA', 5, 'Mixed'),
('TPUHD54054A', 'Splicing OF-Cable on Aerial 48 Fibers', 'EA', 6, 'Mixed'),
('TPUHD54055A', 'Splicing OF-Cable on Aerial 60 Fibers', 'EA', 7, 'Mixed'),
('TPUHD54056A', 'Splicing OF-Cable on Aerial 96 Fibers', 'EA', 7, 'Mixed'),
('TPUHD54057A', 'Splicing OF-Cable on Aerial 120 Fibers', 'EA', 9, 'Mixed'),
('TPUHD54058A', 'Splicing OF-Cable on Aerial 144 Fibers', 'EA', 13, 'Mixed'),
('TPUHD54059A', 'Splicing OF-Cable on Aerial 216 Fibers', 'EA', 14, 'Mixed'),
('TPUHD54060A', 'Splicing OF-Cable on Aerial 288 Fibers', 'EA', 17, 'Mixed'),
('TPUHD54061A', 'Splicing OF-Cable on Aerial 312 Fibers', 'EA', 18, 'Mixed'),
('TPUHD54062A', 'Splicing OF-Cable on Aerial 432 Fibers', 'EA', 23, 'Mixed'),
('TPUHD54063A', 'Splicing OF-Cable on Aerial 576 Fibers', 'EA', 28, 'Mixed'),
('TPUHD54064A', 'Splicing OF-Cable on Aerial 648 Fibers', 'EA', 32, 'Mixed'),
('TPUHD54065A', 'Splicing OF-Cable in Conduit 12 Fibers', 'EA', 5, 'Mixed'),
('TPUHD54066A', 'Splicing OF-Cable in Conduit 24 Fibers', 'EA', 6, 'Mixed'),
('TPUHD54067A', 'Splicing OF-Cable in Conduit 36 Fibers', 'EA', 7, 'Mixed'),
('TPUHD54068A', 'Splicing OF-Cable in Conduit 48 Fibers', 'EA', 8, 'Mixed'),
('TPUHD54069A', 'Splicing OF-Cable in Conduit 60 Fibers', 'EA', 8, 'Mixed'),
('TPUHD54070A', 'Splicing OF-Cable in Conduit 96 Fibers', 'EA', 8, 'Mixed'),
('TPUHD54071A', 'Splicing OF-Cable in Conduit 120 Fibers', 'EA', 9, 'Mixed'),
('TPUHD54072A', 'Splicing OF-Cable in Conduit 144 Fibers', 'EA', 12, 'Mixed'),
('TPUHD54073A', 'Splicing OF-Cable on Conduit 216 Fibers', 'EA', 18, 'Mixed'),
('TPUHD54074A', 'Splicing OF-Cable on Conduit 288 Fibers', 'EA', 22, 'Mixed'),
('TPUHD54075A', 'Splicing OF-Cable on Conduit 312 Fibers', 'EA', 24, 'Mixed'),
('TPUHD54076A', 'Splicing OF-Cable on Conduit 432 Fibers', 'EA', 31, 'Mixed'),
('TPUHD54077A', 'Splicing OF-Cable on Conduit 576 Fibers', 'EA', 40, 'Mixed'),
('TPUHD54078A', 'Splicing OF-Cable on Conduit 648 Fibers', 'EA', 41, 'Mixed'),
('TPUHD54079C', 'Duct test prior Repair 1-Duct Per span', 'Lot', 1, 'Mixed'),
('TPUHD54080C', 'Duct test prior Repair 2-Duct Per span', 'Lot', 1, 'Mixed'),
('TPUHD54081C', 'Duct test prior Repair 3-Duct Per span', 'Lot', 1, 'Mixed'),
('TPUHD54082C', 'Duct test prior Repair 4-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54083C', 'Duct test prior Repair 5-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54084C', 'Duct test prior Repair 6-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54085C', 'Duct test prior Repair 7-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54086C', 'Duct test prior Repair 8-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54087C', 'Duct test prior Repair 10-Duct Per span', 'Lot', 2, 'Mixed'),
('TPUHD54088C', 'Duct test prior Repair 12-Duct Per span', 'Lot', 2, 'Mixed');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` varchar(20) NOT NULL,
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
  `total_amount` double NOT NULL,
  `vat` double NOT NULL,
  `withholding` double NOT NULL,
  `grand_total` double NOT NULL,
  `bill_company` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_date`, `bill_date_product`, `bill_payment`, `bill_due_date`, `bill_refer`, `bill_site`, `bill_pr`, `bill_work_no`, `bill_project`, `list_num`, `total_amount`, `vat`, `withholding`, `grand_total`, `bill_company`) VALUES
('PS2567/001', '2567-06-04', '2567-06-04', 'N/A', '2567-06-04', '-', '', '', '', '', 2, 50.35, 3.5245, 1.5105, 46.8255, 'FBH'),
('PS2567/002', '2567-06-14', '2567-06-14', 'N/A', '2567-06-14', '-', '', '', '', '', 2, 268.92, 18.8244, 8.0676, 250.0956, 'FBH'),
('PS2567/003', '2567-07-04', '2567-07-04', 'N/A', '2567-07-04', '-', '', '', '', '', 4, 301.28, 21.0896, 9.0384, 280.1904, 'FBH'),
('PSNK/MIXED/67/001', '2567-06-04', '2567-06-04', 'N/A', '2567-06-04', '-', 'LPG3182', '', '', '', 17, 15243.2, 1067.024, 457.296, 14176.176, 'Mixed'),
('PSNK/MIXED/67/002', '2567-07-04', '2567-07-16', 'N/A', '2567-07-17', '-', '', '', '', '', 3, 273.2, 19.124, 8.196, 254.076, 'mixed');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `bill_id` varchar(100) NOT NULL,
  `au_id` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`bill_id`, `au_id`, `unit`, `price`) VALUES
('PS2567/001', 'SM13075-0100020001-TH', 5, 45.35),
('PS2567/001', 'SM13075-0100320006-TH', 5, 5),
('PS2567/002', 'SM13075-0100100001-TH', 2, 267.76),
('PS2567/002', 'SM13075-0100190001-TH', 2, 1.16),
('PS2567/003', 'SM13075-0100020002-TH', 2, 23.52),
('PS2567/003', 'SM13075-0100090002-TH', 2, 4),
('PS2567/003', 'SM13075-0100090004-TH', 2, 6),
('PS2567/003', 'SM13075-0100100002-TH', 2, 267.76),
('PSNK/MIXED/67/001', 'Mix-TD-17.85', 5, 25),
('PSNK/MIXED/67/001', 'TPCHDMX001C', 5, 792),
('PSNK/MIXED/67/001', 'TPCHDMX003C', 3, 6),
('PSNK/MIXED/67/001', 'TPCHDMX004C', 4, 8.8),
('PSNK/MIXED/67/001', 'TPCHDMX005C', 5, 25.2),
('PSNK/MIXED/67/001', 'TPCHDMX006C', 2, 22),
('PSNK/MIXED/67/001', 'TPCHDMX009C', 5, 25.2),
('PSNK/MIXED/67/001', 'TPCHDMX010C', 2, 547.2),
('PSNK/MIXED/67/001', 'TPCHDMX011C', 4, 1680),
('PSNK/MIXED/67/001', 'TPCHDMX013C', 5, 2476.8),
('PSNK/MIXED/67/001', 'TPCHDMX014C', 5, 4200),
('PSNK/MIXED/67/001', 'TPCHDMX018C', 5, 5),
('PSNK/MIXED/67/001', 'TPCHDMX021C', 2, 1224),
('PSNK/MIXED/67/001', 'TPCHDMX023C', 2, 2),
('PSNK/MIXED/67/001', 'TPCHDMX025C', 2, 1944),
('PSNK/MIXED/67/001', 'TPCHDMX030A', 5, 2250),
('PSNK/MIXED/67/001', 'TPCHDMX050C', 5, 10),
('PSNK/MIXED/67/002', 'Mix-TD-17.85', 20, 100),
('PSNK/MIXED/67/002', 'TPCHDMX005C', 30, 151.2),
('PSNK/MIXED/67/002', 'TPCHDMX008C', 10, 22);

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
  `employee_id` int(4) NOT NULL,
  `drum_id` int(4) NOT NULL,
  `cable_work` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `drum_company` varchar(100) NOT NULL,
  `drum_cable_company` varchar(100) NOT NULL,
  `drum_used` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drum`
--

INSERT INTO `drum` (`drum_id`, `drum_no`, `drum_to`, `drum_description`, `drum_full`, `drum_remaining`, `drum_company`, `drum_cable_company`, `drum_used`) VALUES
(0, '0062', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 0, 'Mixed', 'FBH', 0),
(0, '0011', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 0, 'FBH', 'FBH', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(4) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_lastname` varchar(100) NOT NULL,
  `employee_age` int(11) NOT NULL,
  `employee_phone` varchar(10) NOT NULL,
  `employee_salary` double NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_lastname`, `employee_age`, `employee_phone`, `employee_salary`, `employee_email`, `employee_position`) VALUES
(1, 'นุ๊ก', 'นุ๊ก', 30, '0999999999', 20000, 'Thanakon@gmail.com', 'พนักงานเอกสาร'),
(2, 'เก่ง', 'เก่ง', 30, '0888888888', 20000, 'Kang@gmail.com', 'พนักงานเอกสาร');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `parent_id`) VALUES
(28, 2, 'PSNK+++++++', 0),
(29, 2, 'เอกสาร บปช', 0),
(32, 2, 'เอกสาร PSNK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `passW` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `lv` char(1) NOT NULL DEFAULT '1' COMMENT '0=admin,1=เจ้าของ,2=พนักงานเอกสาร,3=พนักงานปฏิบัติงาน',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1=ใช้งาน,0=แบน',
  `user_id` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `passW`, `name`, `lastname`, `lv`, `status`, `user_id`) VALUES
('pond2', '$2y$10$.c8BuHqsCegEBry2BjdxSOld0NvQwomfMdDDNy5U68VR6.v0CnoP.', 'pond2', 'pond2', '3', '1', 8),
('admin', '$2y$10$c8vj27z4jfmAEJFl76foR.NWV7ev8Is0zjjeZnVp8VI527nISuh3W', 'admin', 'admin', '0', '1', 2),
('pond', '$2y$10$Owi8TaPs/ES/1ujurGVq2evd.bxTD.0kbe6HzHJFiexTkcHQzjEAm', 'pond', 'pond', '1', '1', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `au_all`
--
ALTER TABLE `au_all`
  ADD PRIMARY KEY (`au_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`bill_id`,`au_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
