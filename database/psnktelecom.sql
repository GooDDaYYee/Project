-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 11:21 AM
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
  `au_price` double(9,2) NOT NULL,
  `au_company` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `au_all`
--

INSERT INTO `au_all` (`au_id`, `au_detail`, `au_type`, `au_price`, `au_company`) VALUES
('Mix-TD-17.85', 'Test & Verify Fiber (Test Power Meter - Light Source & Test OTDR Core Spare) Site to Site (A-Z และ Z-A)', 'Set', 5.00, 'Mixed'),
('SM13075-0100020001-TH', 'Cable installation service Outdoor Arial including Sticker,Survey Drawing, Permission Drawing, Other Drawing, Aerial to Duct, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 9.07, 'FBH'),
('SM13075-0100020002-TH', 'Cable installation service Underground in provided or constructed conduit or Duct. including Survey Drawing, Permission Drwaing, Other Drawing, Duct to Aerial, all material and OMF inner-outer BMA (Exclued Monitor Permission)', 'M', 11.76, 'FBH'),
('SM13075-0100090001-TH', 'Splicing OF-Cable on Aerial, Underground, In Building < 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 1.00, 'FBH'),
('SM13075-0100090002-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 12 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2.00, 'FBH'),
('SM13075-0100090003-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 24 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 2.00, 'FBH'),
('SM13075-0100090004-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 36 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 3.00, 'FBH'),
('SM13075-0100090005-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 48 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4.00, 'FBH'),
('SM13075-0100090006-TH', 'Splicing OF-Cable on Aerial, Underground, In Building 60 Fibers included Protection Sleeve, Splicing Tools, Worm สาย Fiber ใน Closure&ODF, การยก OF Cable ขึ้น-ลง เพื่อเก็บหัวต่อ&ODF', 'Set', 4.00, 'FBH'),
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
('SM13075-0100240006-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง แม่ฮ่องสอน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.30, 'FBH'),
('SM13075-0100240007-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำปาง ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.20, 'FBH'),
('SM13075-0100240008-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง ลำพูน ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.22, 'FBH'),
('SM13075-0100240009-TH', 'ค่าขนส่ง OF Cable สำหรับงาน Turnkey จาก กรุงเทพฯ ไปยัง อุตรดิตถ์ ใช้กับรถยนต์ทุกขนาด โดยให้คำนวณจากค่าติดตั้ง (Installation Cost) ของ OFC ที่เป็น Aerial หรือ Undergeround หรือ Conduit เท่านั้น', 'M', 0.21, 'FBH'),
('SM13075-0100250004-TH', 'Digitize Base Map for Survey (Grid)', 'EA', 200.82, 'FBH'),
('SM13075-0100290001-TH', 'Digitize 1 - 50 HH คิดต่อ Grid  สำหรับ Happy Block', 'EA', 803.25, 'FBH'),
('SM13075-0100290002-TH', 'จำนวนบ้านส่วนที่เกินตั้งแต่ 51 ถึง 250 HH ใน Grid นั้น คิดต่อ HH สำหรับ Happy Block', 'EA', 8.93, 'FBH'),
('SM13075-0100290003-TH', 'Digitize Grid >250HH เหมาจ่าย/Grid (สำหรับผู้รับเหมาในสัญญาปกติ) สำหรับ Happy Block', 'EA', 1.00, 'FBH'),
('SM13075-0100300001-TH', 'Detail Design for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1.00, 'FBH'),
('SM13075-0100300002-TH', 'Detail Design for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 2.00, 'FBH'),
('SM13075-0100300003-TH', 'Detail Design for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 3.00, 'FBH'),
('SM13075-0100300004-TH', 'Detail Design for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 4.00, 'FBH'),
('SM13075-0100300005-TH', 'Detail Design for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 5.00, 'FBH'),
('SM13075-0100300006-TH', 'Detail Design for FTTH MDU >700 Homepass (Design บน Autocad)', 'SET', 5.00, 'FBH'),
('SM13075-0100310001-TH', 'Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 626.54, 'FBH'),
('SM13075-0100310002-TH', 'Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1.00, 'FBH'),
('SM13075-0100310003-TH', 'Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 1.00, 'FBH'),
('SM13075-0100310004-TH', 'Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2.00, 'FBH'),
('SM13075-0100310005-TH', 'Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 2.00, 'FBH'),
('SM13075-0100310006-TH', 'Drawing for FTTH MDU >700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 4.00, 'FBH'),
('SM13075-0100320001-TH', 'Final As-built Drawing approved for FTTH MDU 1-100 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 208.85, 'FBH'),
('SM13075-0100320002-TH', 'Final As-built Drawing approved for FTTH MDU 1-200 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 417.69, 'FBH'),
('SM13075-0100320003-TH', 'Final As-built Drawing approved for FTTH MDU 1-300 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 580.13, 'FBH'),
('SM13075-0100320004-TH', 'Final As-built Drawing approved for FTTH MDU 1-500 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 892.50, 'FBH'),
('SM13075-0100320005-TH', 'Final As-built Drawing approved for FTTH MDU 1-700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1.00, 'FBH'),
('SM13075-0100320006-TH', 'Final As-built Drawing approved for FTTH MDU >700 Homepass (Design บน Autocad) คิด AU ต่อ 1 อาคาร', 'SET', 1.00, 'FBH'),
('SM13075-0100320007-TH', 'Final As-built Drawing for FTTH MDU 1-100 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 133.88, 'FBH'),
('SM13075-0100320008-TH', 'Final As-built Drawing for FTTH MDU 1-200 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 267.75, 'FBH'),
('SM13075-0100320009-TH', 'Final As-built Drawing for FTTH MDU 1-300 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 357.00, 'FBH'),
('SM13075-0100320010-TH', 'Final As-built Drawing for FTTH MDU 1-500 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 535.50, 'FBH'),
('SM13075-0100320011-TH', 'Final As-built Drawing for FTTH MDU 1-700 Homepass By QRUN คิด AU ต่อ 1 อาคาร', 'SET', 714.00, 'FBH'),
('TPCHDMX001C', 'Cable installation service in-building including survey Drawing  duct and all material', 'Meter', 158.40, 'Mixed'),
('TPCHDMX002C', 'Cable installation service indoor in provided or constructed conduit or duct. Including survey and drawing ', 'Meter', 21.24, 'Mixed'),
('TPCHDMX003C', 'Service charge for Installation Optical Fiber Cable in building. (Per Site)', 'Site', 2.00, 'Mixed'),
('TPCHDMX004C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.20, 'Mixed'),
('TPCHDMX005C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
('TPCHDMX006C', 'Cable installation service Outdoor Arial including survey Drawing and all material e.g. sticker according to PEA/MEA/Authorities standard', 'Meter', 11.00, 'Mixed'),
('TPCHDMX007C', 'Cable installation service Outdoor in provided or constructed conduit Including survey and drawing ', 'Meter', 11.00, 'Mixed'),
('TPCHDMX008C', 'Remove OFC cable (Non-Usable)', 'Meter', 2.20, 'Mixed'),
('TPCHDMX009C', 'Remove OFC cable (Re-Usable)', 'Meter', 5.04, 'Mixed'),
('TPCHDMX010C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 273.60, 'Mixed'),
('TPCHDMX011C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 420.00, 'Mixed'),
('TPCHDMX012C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 410.40, 'Mixed'),
('TPCHDMX013C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 495.36, 'Mixed'),
('TPCHDMX014C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 840.00, 'Mixed'),
('TPCHDMX015C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 756.00, 'Mixed'),
('TPCHDMX016C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 777.60, 'Mixed'),
('TPCHDMX017C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'M', 1.00, 'Mixed'),
('TPCHDMX018C', 'Conduit construction in soft surface such as soil or sand  (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1.00, 'Mixed'),
('TPCHDMX019C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 360.00, 'Mixed'),
('TPCHDMX020C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 650.00, 'Mixed'),
('TPCHDMX021C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 612.00, 'Mixed'),
('TPCHDMX022C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 720.00, 'Mixed'),
('TPCHDMX023C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1.00, 'Mixed'),
('TPCHDMX024C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 900.00, 'Mixed'),
('TPCHDMX025C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 972.00, 'Mixed'),
('TPCHDMX026C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 2.00, 'Mixed'),
('TPCHDMX027C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'Meter', 1.00, 'Mixed'),
('TPCHDMX028C', 'Conduit construction in  hard surface such as concrete or rock. (scope includes Survey, Design, Installation, and Materials)', 'M', 1.00, 'Mixed'),
('TPCHDMX029A', 'Construction for conduit 1 x 3/4\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 52.89, 'Mixed'),
('TPCHDMX030A', 'Install and Supply material  Cross 1 x 4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'M', 450.00, 'Mixed'),
('TPCHDMX031A', ' Install and Supply material  Riser Pole 1-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 1.00, 'Mixed'),
('TPCHDMX032A', 'Install and Supply material Riser Pole 2-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 2.00, 'Mixed'),
('TPCHDMX033A', 'Install and Supply material Riser Pole 4-4\" GIP (scope includes Survey, Design, Installation, and Metetials)', 'Set', 4.00, 'Mixed'),
('TPCHDMX034A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 1.00, 'Mixed'),
('TPCHDMX035A', 'Scope includes Survey, Design, Installation, and Metetials but exclude Concrete Pole', 'Point', 3.00, 'Mixed'),
('TPCHDMX036A', 'Construction for conduit 1 x 1\" inside building Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 72.00, 'Mixed'),
('TPCHDMX037A', 'Construction for conduit 1 x 2\" inside building  Material type EMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 174.02, 'Mixed'),
('TPCHDMX038A', 'Construction for conduit 1 x 3/4\" outside building Material type IMC', 'Meter', 75.60, 'Mixed'),
('TPCHDMX039A', 'Construction for conduit 1 x 1\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 111.60, 'Mixed'),
('TPCHDMX040A', 'Construction for conduit 1 x 2\" outside building Material type IMC (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 226.08, 'Mixed'),
('TPCHDMX041A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 13.00, 'Mixed'),
('TPCHDMX042A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 23.00, 'Mixed'),
('TPCHDMX043A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 27.00, 'Mixed'),
('TPCHDMX044A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 21.00, 'Mixed'),
('TPCHDMX045A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 33.00, 'Mixed'),
('TPCHDMX046A', '  Supply and install included material (scope includes Survey, Design, Installation, and Metetials)', 'Each', 36.00, 'Mixed'),
('TPCHDMX047C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 36.00, 'Mixed'),
('TPCHDMX048C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1.00, 'Mixed'),
('TPCHDMX049C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 1.00, 'Mixed'),
('TPCHDMX050C', 'Construction for conduit by HDD  under ground (horizontal directional drilling)  (scope includes Survey, Design, Installation, and Metetials)', 'Meter', 2.00, 'Mixed'),
('TPCHDMX051C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling)  Excluded Concrete pole (scope includes Survey, Design, Installation, and Metetials)', 'M', 1.00, 'Mixed'),
('TPCHDMX052C', 'Construction for conduit Pipe Jacking GIP  type in  under ground (horizontal directional drilling) Excluded Concrete pole  (scope includes Survey, Design, Installation, and Metetials)', 'M', 2.00, 'Mixed'),
('TPCHDMX053C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 46.80, 'Mixed'),
('TPCHDMX054C', 'Open Cut & Repair road surface reinf concrete, Kerb& Drain Kerb', 'Sq. Meter', 1.00, 'Mixed'),
('TPCHDMX055C', 'Open Cut & Repair Footpath surface Asphalt', 'Sq. Meter', 969.12, 'Mixed'),
('TPCHDMX056C', 'Open Cut & Repair Footpath surface  Interlock', 'Sq. Meter', 969.12, 'Mixed'),
('TPCHDMX057C', 'Break Through Pull Box for prepare cable couduit (service only)', 'Each', 648.00, 'Mixed'),
('TPCHDMX058C', 'Break Through Man Hole for prepare cable couduit (serviice only)', 'Each', 1.00, 'Mixed'),
('TPCHDMX059C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 61.20, 'Mixed'),
('TPCHDMX060C', 'Scope includes Survey, Design, Installation, and Metetials', 'Meter', 79.20, 'Mixed'),
('TPCHDMX061A', 'Supply and install cross Arm type steel ', 'Each', 756.00, 'Mixed'),
('TPCHDMX062A', 'Supply and install cross Arm type steel ', 'Each', 972.00, 'Mixed'),
('TPCHDMX063A', 'Supply deliver and install concrete pole', 'Pole', 5.00, 'Mixed'),
('TPCHDMX064A', 'Supply deliver and install concrete pole', 'Pole', 7.00, 'Mixed'),
('TPCHDMX065A', 'Supply and install cross Arm type Wooden', 'Each', 540.00, 'Mixed'),
('TPCHDMX066C', 'Fiber Splicing and termination', 'Core', 165.60, 'Mixed'),
('TPCHDMX067C', 'Fiber Splicing and termination', 'Core', 126.00, 'Mixed'),
('TPCHDMX068C', 'Fiber Splicing and termination', 'Core', 108.00, 'Mixed'),
('TPCHDMX069C', 'Fiber Splicing and termination', 'Core', 93.60, 'Mixed'),
('TPCHDMX070C', 'Fiber Splicing and termination', 'Core', 86.40, 'Mixed'),
('TPCHDMX071C', 'Fiber Splicing and termination', 'Core', 64.80, 'Mixed'),
('TPCHDMX072C', 'Fiber Splicing and termination', 'Core', 57.60, 'Mixed'),
('TPCHDMX082C', 'Install Enclosure for OFC 12 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX083C', 'Install Enclosure for OFC 24-48 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX084C', 'Install Enclosure for OFC 60 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX085C', 'Install Enclosure for OFC 72 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX086C', 'Install Enclosure for OFC 96 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX087C', 'Install Enclosure for OFC 120 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX088C', 'Install Enclosure for OFC 144 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX089C', 'Install Enclosure for OFC 216 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX090C', 'Install Enclosure for OFC 312 cores (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX102C', 'Install ODF 24 ports for rack mounted (12 pigtail) Indoor (service only)', 'Each', 360.00, 'Mixed'),
('TPCHDMX103C', 'Install ODF 24 ports for rack mounted (24 pigtail) Indoor (service only)', 'Each', 360.00, 'Mixed'),
('TPCHDMX104C', 'Install ODF 12 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
('TPCHDMX105C', 'Install ODF 24 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
('TPCHDMX106C', 'Install ODF 48 ports FC/PC wall & pole mounted Indoor (service only)', 'Each', 432.00, 'Mixed'),
('TPCHDMX107C', 'Install ODF 24 ports for rack mounted (12 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX108C', 'Install ODF 24 ports for rack mounted (24 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX109C', 'Install ODF 48 ports for rack mounted (48 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX110C', 'Install ODF 120 ports for rack mounted (120 pigtail) Outdoor(service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX111C', 'Install ODF 144 ports for rack mounted (144 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX112C', 'Install ODF 216 ports for rack mounted (216 pigtail) Outdoor (service only)', 'Each', 145.00, 'Mixed'),
('TPCHDMX115C', 'Remove service for ODF Box', 'Each', 500.00, 'Mixed'),
('TPCHDMX129C', 'Service for proceeding installation permission from Authority (Per Route)', 'Route', 1.00, 'Mixed'),
('TPCHDMX131C', 'Extra charge for transportation for island site (Per Site)', 'Site', 3.00, 'Mixed'),
('TPCHDMX132C', 'Pre survey for designated hop (Hi-level Keymap) in case not installation cable in this route', 'Route', 1.00, 'Mixed'),
('TPCHDMX133C', 'Survey for design and drawing for work permission in case not installation cable in this route', 'Route', 2.00, 'Mixed'),
('TPCHDMX134C', 'Survey for design and drawing for work permission (based on PEA/MEA/Authorities standard requirement) in case not installation cable in this route', 'Meter', 1.08, 'Mixed'),
('TPCHDMX135C', 'Need ODTR result both from A to Z and Z to A', 'Core', 1.00, 'Mixed'),
('TPCHDMX136C', 'Site or enclosure location Access to support fiber core arrangement or OTDR test', 'Site', 1.00, 'Mixed'),
('TPCHDMX137C', 'Service for proceeding the work permission from PEA/MEA/Authorities for civil work on the road (Per Route)', 'Route', 2.00, 'Mixed'),
('TPCHDMX138C', 'Service for proceeding the work permission from  PEA/MEA/Authorities for civil work crossing the road (Per Route)', 'Route', 3.00, 'Mixed'),
('TPCHDMX140C', 'Survey & Drawing & Permission including cost for open Pull box\\Manhole and cost for access site', 'Meter', 9.22, 'Mixed'),
('TPCHDMX141A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8.00, 'Mixed'),
('TPCHDMX142A', 'Installation service Include Sub Duct Fabric  & Material ', 'Meter', 8.00, 'Mixed'),
('TPCHDMX143A', 'Installation service Include Micro tube  & Material ', 'Meter', 17.28, 'Mixed'),
('TPCHDMX144A', 'Installation service Include Micro tube  & Material ', 'Meter', 20.88, 'Mixed'),
('TPCHDMX145A', 'Installation service Include Micro tube  & Material ', 'Meter', 21.70, 'Mixed'),
('TPCHDMX146A', 'Installation service Include Micro Duct  & Material ', 'Meter', 37.00, 'Mixed'),
('TPCHDMX147A', 'Installation service Include Micro Duct  & Material ', 'Meter', 28.80, 'Mixed'),
('TPCHDMX148A', 'Installation service Include Micro Duct  & Material ', 'Meter', 30.84, 'Mixed'),
('TPCHDMX149A', 'Installation service Include Micro Duct  & Material ', 'Meter', 39.60, 'Mixed'),
('TPCHDMX150A', 'Installation service Include Micro Duct  & Material ', 'Meter', 63.36, 'Mixed'),
('TPCHDMX151C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 18.00, 'Mixed'),
('TPCHDMX152C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 20.88, 'Mixed'),
('TPCHDMX153C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 21.60, 'Mixed'),
('TPCHDMX154C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 23.04, 'Mixed'),
('TPCHDMX155C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 24.09, 'Mixed'),
('TPCHDMX156C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 28.79, 'Mixed'),
('TPCHDMX157C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 36.30, 'Mixed'),
('TPCHDMX158C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 48.39, 'Mixed'),
('TPCHDMX159C', 'Installation of Fiber Blow including OFC and Services', 'Meter', 50.04, 'Mixed'),
('TPCHDMX160C', 'Installation service', 'Point', 216.00, 'Mixed'),
('TPCHDMX161C', 'Installation of Fiber Blow including OFC and Services', 'Set', 3.00, 'Mixed'),
('TPCHDMX162A', 'Installation service Include Sub-duct Fabric  & Material  ', 'Meter', 8.00, 'Mixed'),
('TPCHDMX163A', 'Installation service Include Micro tube  & Material', 'Meter', 52.92, 'Mixed'),
('TPCHDMX164A', 'Installation service Include Micro tube  & Material', 'Meter', 49.32, 'Mixed'),
('TPCHDMX173C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
('TPCHDMX174C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
('TPCHDMX175C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
('TPCHDMX176C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 14.00, 'Mixed'),
('TPCHDMX177C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
('TPCHDMX178C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
('TPCHDMX179C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
('TPCHDMX180C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
('TPCHDMX181C', 'Installation of OFC including  Services, Survey and Design', 'Meter', 18.00, 'Mixed'),
('TPCHDMX182C', 'Re-arrange OFC cable on existing pole or cross-arm (Per Pole)', 'Pole', 108.00, 'Mixed'),
('TPCHDMX183A', 'Sticker attaching to the cable (incld stickers)', 'Pole per Cable', 15.00, 'Mixed'),
('TPCHDMX184C', 'Transportation for disposal ', 'KM ', 10.80, 'Mixed'),
('TPCHDMX185C', 'Cable disposal', 'KG', 8.64, 'Mixed'),
('TPCHDMX189C', 'Install ODF 60 ports for rack mounted (60 pigtail) Indoor (service only)', 'EA', 360.00, 'Mixed'),
('TPCHDMX237M', '1)ประสานงานกับการ PEA,MEA เรื่องการขอติดตั้งมิเตอร์ขนาดตามที่ ทรูฯ กำหนดในทุกขั้นตอน จนสามารถติดตั้งมิเตอร์ได้ 2)รับผิดชอบค่าใช้จ่ายในการประสานงาน,ค่าธรรมเนียมในการติดตั้งมิเตอร์ และค่าดำเนินการอื่นๆที่เกี่ยวข้อง 3)หนังสือการขอติดตั้งมิเตอร์ทาง ทรูฯ เป็นผ', 'Set', 3.00, 'Mixed'),
('TPCHDMX238A', 'OLT Suppy and Installation Power, UTP, Grounding, Transportation and All Accessories (Excluded OLT Cabinet) Include Cutover and Install Support', 'Set', 15.00, 'Mixed'),
('TPUHD54001C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1.00, 'Mixed'),
('TPUHD54002A', 'Installation ODF Street Cabinet and Pole Type (Included TransPortation, Vehicle Rental, Construction)', 'Set', 5.00, 'Mixed'),
('TPUHD54002C', 'Remove of A8', 'EA', 1.00, 'Mixed'),
('TPUHD54003A', 'L2 Closure + Box Splitter 1:8 Material+Construction+Transportation', 'Set', 500.00, 'Mixed'),
('TPUHD54003C', 'Remove of A10', 'EA', 1.00, 'Mixed'),
('TPUHD54004A', 'L2 Closure + Box Splitter 1:16 Material+Construction+Transportation', 'Set', 500.00, 'Mixed'),
('TPUHD54004C', 'Remove of D3A Cable Extension Arm', 'EA', 350.00, 'Mixed'),
('TPUHD54005A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54005C', 'Remove Cross-arm Y(N)', 'EA', 55.00, 'Mixed'),
('TPUHD54006A', 'L1 Closure 48F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54006C', 'Remove Cross-arm Y(R)', 'EA', 65.00, 'Mixed'),
('TPUHD54007A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 1 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54007C', 'Y(S) Outdoor Dslam all Type', 'EA', 6.00, 'Mixed'),
('TPUHD54008A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 2 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54008C', 'Y(S) Outdoor Dslam all Type included SupPort Riser', 'EA', 7.00, 'Mixed'),
('TPUHD54009A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 3 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54009C', 'จัดระเบียบ และรื้อย้ายสายสื่อสารที่ไม่ได้ใช้งาน ตามที่ทางการไฟฟ้าฯ และ ทรูฯ กำหนด ราคาเหมาจ่าย 1 กิโลเมตร รวมค่าขนส่งเคเบิลที่ไม่ได้ใช้งานไปยังสถานที่ที่ ทรู กำหนด (เฉพาะ กทม. และ ปริมณฑล)', 'KM', 2.00, 'Mixed'),
('TPUHD54010A', 'L1 Closure 72F+Bare Splitter 1:4 or 1:8 / 4 Set Material+Constuction+Transportation', 'Set', 300.00, 'Mixed'),
('TPUHD54010C', 'Installation+Splicing L2 Splitter included Test E2E\n(สำหรับผู้รับเหมาในสัญญาปกติ)', 'SET', 1.00, 'Mixed'),
('TPUHD54011A', 'Aluminum Optic Distribution Fiber support Splitter Module Maximum 32 Ports included E2E Test', 'EA', 1.00, 'Mixed'),
('TPUHD54011C', 'Breaking Reinforced Concrete 10 cm. Thickness', 'M2', 50.00, 'Mixed'),
('TPUHD54012A', '24 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 10 ซม.', 'M2', 750.00, 'Mixed'),
('TPUHD54012C', 'Breaking Reinforced Concrete 15 cm. Thickness', 'M2', 140.00, 'Mixed'),
('TPUHD54013A', '24 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 24 ชม. หนา 15 ซม.', 'M2', 1.00, 'Mixed'),
('TPUHD54013C', 'Breaking Asphalt Road 5 cm.', 'M2', 110.00, 'Mixed'),
('TPUHD54014A', '8 HR. Curing Cement 10 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 10 ซม.', 'M2', 900.00, 'Mixed'),
('TPUHD54014C', 'Breaking Asphalt Road 10 cm.', 'M2', 140.00, 'Mixed'),
('TPUHD54015A', '8 HR. Curing Cement 15 cm. งานเทซีเมนต์ชนิดแห้งเร็วภายใน 8 ชม. หนา 15 ซม.', 'M2', 1.00, 'Mixed'),
('TPUHD54015C', 'Dig & Repair Ground', 'M2', 120.00, 'Mixed'),
('TPUHD54016A', 'Overlay Hotmixed 5 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 300.00, 'Mixed'),
('TPUHD54016C', 'Re-Information existing \"Closure\" and included Sync Testbed and Confirm data to True\'s for Sync IM (คิดต่อ 1 Closure)', 'EA', 250.00, 'Mixed'),
('TPUHD54017A', 'Overlay Hotmixed 10 cm. ซ่อมชั่วคราว ไม่รวมพื้นฐาน', 'M2', 450.00, 'Mixed'),
('TPUHD54017C', 'Record Information งานจัดระเบียบสาย 2021 สำหรับ OF Cable, Dropwire, Coaxial Cable ทุกเส้น ตามที่ ทรู กำหนดให้ ลงบน Report หรือ Application ที่กำหนด', 'KM', 1.00, 'Mixed'),
('TPUHD54018A', 'Concrete Road 15 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 15 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 550.00, 'Mixed'),
('TPUHD54018C', 'Remove Conduit All Type Y(N)', 'EA', 6.00, 'Mixed'),
('TPUHD54019A', 'Concrete Road 20 cm. Thickness กรณีที่ทำใหม่ หรือซ่อมเต็มแผง มาตรฐานงานซ่อมเต็มแผง ตามแบบ มท.1 กว้าง 4 เมตร x ยาว 6 เมตร หรือ กว้าง 3.5 เมตร x ยาว 10.5 คอนกรีตหนา 20 ซม. ไม่รวมคันหิน (Kerb) ไม่รวมคันหิน (Kerb)', 'M2', 750.00, 'Mixed'),
('TPUHD54019C', 'Remove Closure Splitter and Inline Closure Y(N)', 'EA', 50.00, 'Mixed'),
('TPUHD54020A', 'Repair Concrete Road และ Footpath คอนกรีต 15 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750.00, 'Mixed'),
('TPUHD54020C', 'Remove Closure Splitter and Inline Closure Y(R)', 'EA', 100.00, 'Mixed'),
('TPUHD54021A', 'Repair Concrete Road และ Footpath คอนกรีต 20 cm. Thickness สำหรับการตัดซ่อม หรือซ่อมไม่เต็มแผง', 'M', 750.00, 'Mixed'),
('TPUHD54021C', 'Remove Splitter L1 and L2 Y(N) Bare & Box', 'EA', 5.00, 'Mixed'),
('TPUHD54022A', 'งานซ่อมถนน Asphalt Road ด้วยการตัดพื้น ความหนา 5 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 420.00, 'Mixed'),
('TPUHD54022C', 'Remove Splitter L1 and L2 Y(R) Bare & Box', 'EA', 10.00, 'Mixed'),
('TPUHD54023A', 'งานซ่อม Asphalt Road ด้วยการตัดพื้น ความหนา 10 ซม. ไม่มีวัสดุพื้นฐาน', 'M2', 550.00, 'Mixed'),
('TPUHD54023C', 'Design by QRUN included Sync Test Best, Sync IM', 'M', 1.00, 'Mixed'),
('TPUHD54024A', 'D1C - Galvanized Steel Ground Wire (Wire Rope) เฉพาะ W&W, Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 480.00, 'Mixed'),
('TPUHD54024C', 'Remove ODF Box All Type Y(N)', 'EA', 350.00, 'Mixed'),
('TPUHD54025A', 'D7C-Pole Ground with Ground Rod 2.4 M. Welding by Exothermic or Brass เฉพาะ W&W,  Family Telecom, FiberHome, Srisomwong, Thaikin, Thongkao, Susaku, Linetech, Divengent, YOFC  (Turnkey) เริ่มใช้ 1 มิถุนายน 2565', 'EA', 250.00, 'Mixed'),
('TPUHD54025C', 'Remove ODF Street Cabinet & Pole Type', 'ea\\', 4.00, 'Mixed'),
('TPUHD54026A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type A (Wall Type, Apartment),B (Last Pole of Current Subs)', 'Set', 650.00, 'Mixed'),
('TPUHD54026C', 'Install RG 6 Coaxial Cable In Conduit', 'M', 6.00, 'Mixed'),
('TPUHD54027A', 'L3 Installation+L3 Closure inclued 1:2 splitter Type C (Co-location L2)', 'Set', 340.00, 'Mixed'),
('TPUHD54027C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
('TPUHD54028A', 'Installation Flat Optic 1 or 2 Fiber 1 - 25 Meter for Maintenance', 'SET', 450.00, 'Mixed'),
('TPUHD54028C', 'Install RG 6 Coaxial Cable In Conduit', 'EA', 6.00, 'Mixed'),
('TPUHD54029A', 'Installation Flat Optic 1 or 2 Fiber 26 – 50 Meter for Maintenance', 'SET', 500.00, 'Mixed'),
('TPUHD54029C', 'Install RG 6 for Aerial', 'M', 5.25, 'Mixed'),
('TPUHD54030A', 'Installation Flat Optic 1 or 2 Fiber 51 – 75 Meter for Maintenance', 'SET', 610.00, 'Mixed'),
('TPUHD54030C', 'Remove Coaxial cable (Non-Usable)', 'M', 1.80, 'Mixed'),
('TPUHD54031A', 'Installation Flat Optic 1 or 2 Fiber 76 – 100 Meter for Maintenance', 'SET', 650.00, 'Mixed'),
('TPUHD54031C', 'Remove Coaxial cable (Re-Usable)', 'M', 4.50, 'Mixed'),
('TPUHD54032A', 'Installation Flat Optic 1 or 2 Fiber 101 – 125 Meter for Maintenance', 'SET', 770.00, 'Mixed'),
('TPUHD54032C', 'Installation  ODF 48-60 Core wall & pole mounted Indoor SC/APC Connector and included installation pigtail L=1.5, 3.0 M', 'EA', 432.00, 'Mixed'),
('TPUHD54033A', 'Installation Flat Optic 1 or 2 Fiber 126 – 150 Meter for Maintenance', 'SET', 880.00, 'Mixed'),
('TPUHD54034A', 'Installation Flat Optic 1 or 2 Fiber 151 – 175 Meter for Maintenance', 'SET', 990.00, 'Mixed'),
('TPUHD54035A', 'Installation Flat Optic 1 or 2 Fiber 176 – 200 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54036A', 'Installation Flat Optic 1 or 2 Fiber 201 – 225 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54037A', 'Installation Flat Optic 1 or 2 Fiber 226 – 250 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54038A', 'Installation Flat Optic 1 or 2 Fiber 251 – 275 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54039A', 'Installation Flat Optic 1 or 2 Fiber 276 – 300 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54040A', 'Installation Flat Optic 1 or 2 Fiber 301 – 325 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54041A', 'Installation Flat Optic 1 or 2 Fiber 326 – 350 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54042A', 'Installation Flat Optic 1 or 2 Fiber 351 – 375 Meter for Maintenance', 'SET', 1.00, 'Mixed'),
('TPUHD54043A', 'Installation Flat Optic 1 or 2 Fiber 376 – 400 Meter for Maintenance', 'SET', 2.00, 'Mixed'),
('TPUHD54044A', 'Installation Flat Optic 1 or 2 Fiber 401 – 425 Meter for Maintenance', 'SET', 2.00, 'Mixed'),
('TPUHD54045A', 'Installation Flat Optic 1 or 2 Fiber 426 – 450 Meter for Maintenance', 'SET', 2.00, 'Mixed'),
('TPUHD54046A', 'Installation Flat Optic 1 or 2 Fiber 451 – 475 Meter for Maintenance', 'SET', 2.00, 'Mixed'),
('TPUHD54047A', 'Installation Flat Optic 1 or 2 Fiber 476 – 500 Meter for Maintenance', 'SET', 2.00, 'Mixed'),
('TPUHD54048C', 'ค่าเปิด Enclosure เดิมทุกขนาด (ไม่รวมค่า Splicing)', 'EA', 1.00, 'Mixed'),
('TPUHD54050A', 'Splicing OF-Cable on Aerial < 12 Fibers', 'EA', 2.00, 'Mixed'),
('TPUHD54051A', 'Splicing OF-Cable on Aerial 12 Fibers', 'EA', 3.00, 'Mixed'),
('TPUHD54052A', 'Splicing OF-Cable on Aerial 24 Fibers', 'EA', 4.00, 'Mixed'),
('TPUHD54053A', 'Splicing OF-Cable on Aerial 36 Fibers', 'EA', 5.00, 'Mixed'),
('TPUHD54054A', 'Splicing OF-Cable on Aerial 48 Fibers', 'EA', 6.00, 'Mixed'),
('TPUHD54055A', 'Splicing OF-Cable on Aerial 60 Fibers', 'EA', 7.00, 'Mixed'),
('TPUHD54056A', 'Splicing OF-Cable on Aerial 96 Fibers', 'EA', 7.00, 'Mixed'),
('TPUHD54057A', 'Splicing OF-Cable on Aerial 120 Fibers', 'EA', 9.00, 'Mixed'),
('TPUHD54058A', 'Splicing OF-Cable on Aerial 144 Fibers', 'EA', 13.00, 'Mixed'),
('TPUHD54059A', 'Splicing OF-Cable on Aerial 216 Fibers', 'EA', 14.00, 'Mixed'),
('TPUHD54060A', 'Splicing OF-Cable on Aerial 288 Fibers', 'EA', 17.00, 'Mixed'),
('TPUHD54061A', 'Splicing OF-Cable on Aerial 312 Fibers', 'EA', 18.00, 'Mixed'),
('TPUHD54062A', 'Splicing OF-Cable on Aerial 432 Fibers', 'EA', 23.00, 'Mixed'),
('TPUHD54063A', 'Splicing OF-Cable on Aerial 576 Fibers', 'EA', 28.00, 'Mixed'),
('TPUHD54064A', 'Splicing OF-Cable on Aerial 648 Fibers', 'EA', 32.00, 'Mixed'),
('TPUHD54065A', 'Splicing OF-Cable in Conduit 12 Fibers', 'EA', 5.00, 'Mixed'),
('TPUHD54066A', 'Splicing OF-Cable in Conduit 24 Fibers', 'EA', 6.00, 'Mixed'),
('TPUHD54067A', 'Splicing OF-Cable in Conduit 36 Fibers', 'EA', 7.00, 'Mixed'),
('TPUHD54068A', 'Splicing OF-Cable in Conduit 48 Fibers', 'EA', 8.00, 'Mixed'),
('TPUHD54069A', 'Splicing OF-Cable in Conduit 60 Fibers', 'EA', 8.00, 'Mixed'),
('TPUHD54070A', 'Splicing OF-Cable in Conduit 96 Fibers', 'EA', 8.00, 'Mixed'),
('TPUHD54071A', 'Splicing OF-Cable in Conduit 120 Fibers', 'EA', 9.00, 'Mixed'),
('TPUHD54072A', 'Splicing OF-Cable in Conduit 144 Fibers', 'EA', 12.00, 'Mixed'),
('TPUHD54073A', 'Splicing OF-Cable on Conduit 216 Fibers', 'EA', 18.00, 'Mixed'),
('TPUHD54074A', 'Splicing OF-Cable on Conduit 288 Fibers', 'EA', 22.00, 'Mixed'),
('TPUHD54075A', 'Splicing OF-Cable on Conduit 312 Fibers', 'EA', 24.00, 'Mixed'),
('TPUHD54076A', 'Splicing OF-Cable on Conduit 432 Fibers', 'EA', 31.00, 'Mixed'),
('TPUHD54077A', 'Splicing OF-Cable on Conduit 576 Fibers', 'EA', 40.00, 'Mixed'),
('TPUHD54078A', 'Splicing OF-Cable on Conduit 648 Fibers', 'EA', 41.00, 'Mixed'),
('TPUHD54079C', 'Duct test prior Repair 1-Duct Per span', 'Lot', 1.00, 'Mixed'),
('TPUHD54080C', 'Duct test prior Repair 2-Duct Per span', 'Lot', 1.00, 'Mixed'),
('TPUHD54081C', 'Duct test prior Repair 3-Duct Per span', 'Lot', 1.00, 'Mixed'),
('TPUHD54082C', 'Duct test prior Repair 4-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54083C', 'Duct test prior Repair 5-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54084C', 'Duct test prior Repair 6-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54085C', 'Duct test prior Repair 7-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54086C', 'Duct test prior Repair 8-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54087C', 'Duct test prior Repair 10-Duct Per span', 'Lot', 2.00, 'Mixed'),
('TPUHD54088C', 'Duct test prior Repair 12-Duct Per span', 'Lot', 2.00, 'Mixed');

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

INSERT INTO `bill` (`bill_id`, `bill_date`, `bill_date_product`, `bill_payment`, `bill_due_date`, `bill_refer`, `bill_site`, `bill_pr`, `bill_work_no`, `bill_project`, `list_num`, `total_amount`, `vat`, `withholding`, `grand_total`, `bill_company`, `employee_id`) VALUES
('PS2567/001', '2567-09-05', '2567-09-05', 'N/A', '2567-09-05', '-', '2', '2', '2', '2', 3, 1754.38, 122.81, 52.63, 1631.57, 'FBH', 1),
('PS2567/002', '2567-09-08', '2567-09-08', 'N/A', '2567-09-08', '-', '22', '22', '22', '22', 3, 2924.96, 204.75, 87.75, 2720.21, 'FBH', 1),
('PSNK/MIXED/67/001', '2567-09-05', '2567-09-05', 'N/A', '2567-09-05', '-', '2', '2', '2', '2', 2, 8252.00, 577.64, 247.56, 7674.36, 'mixed', 1),
('PSNK/MIXED/67/002', '2567-09-07', '2567-09-07', 'N/A', '2567-09-07', '-', '2', '2', '2', '2', 1, 33.00, 2.31, 0.99, 30.69, 'mixed', 1),
('PSNK/MIXED/67/003', '2567-09-07', '2567-09-07', 'N/A', '2567-09-07', '-', '2', '2', '2', '2', 3, 1521.44, 106.50, 45.64, 1414.94, 'mixed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `bill_id` varchar(100) NOT NULL,
  `au_id` varchar(100) NOT NULL,
  `unit` int(3) NOT NULL,
  `price` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`bill_id`, `au_id`, `unit`, `price`) VALUES
('PS2567/001', 'SM13075-0100090002-TH', 3, 6.00),
('PS2567/001', 'SM13075-0100090006-TH', 2, 8.00),
('PS2567/001', 'SM13075-0100170001-TH', 2, 1740.38),
('PS2567/002', 'SM13075-0100090006-TH', 21, 84.00),
('PS2567/002', 'SM13075-0100100002-TH', 21, 2811.48),
('PS2567/002', 'SM13075-0100200001-TH', 22, 29.48),
('PSNK/MIXED/67/001', 'TPCHDMX008C', 20, 44.00),
('PSNK/MIXED/67/001', 'TPCHDMX012C', 20, 8208.00),
('PSNK/MIXED/67/002', 'TPCHDMX006C', 3, 33.00),
('PSNK/MIXED/67/003', 'TPCHDMX008C', 2, 4.40),
('PSNK/MIXED/67/003', 'TPCHDMX009C', 1, 5.04),
('PSNK/MIXED/67/003', 'TPCHDMX015C', 2, 1512.00);

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
  `cable_work` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cable`
--

INSERT INTO `cable` (`cable_id`, `route_name`, `installed_section`, `placing_team`, `cable_form`, `cable_to`, `cable_used`, `cable_date`, `employee_id`, `drum_id`, `cable_work`) VALUES
(13, 'U2211148 เชียงใหม่', 'CMI01X39ECQ - L2 NEW', 'ดุ่ย', 1000, 50, 950, '2024-08-28 12:55:06', 1, 8, 'Mixed'),
(14, 'U2211148 เชียงใหม่', 'CMI01X39ECQ - L2 NEW', 'ดุ่ย', 3, 2, 1, '2024-09-07 19:19:23', 1, 8, 'Mixed');

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
  `drum_used` int(4) NOT NULL,
  `drum_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drum`
--

INSERT INTO `drum` (`drum_id`, `drum_no`, `drum_to`, `drum_description`, `drum_full`, `drum_remaining`, `drum_company`, `drum_cable_company`, `drum_used`, `drum_date`, `employee_id`) VALUES
(8, '0062', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 4000, 'Mixed', 'FUTONG', 951, '2024-09-08 14:48:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(4) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_lastname` varchar(100) NOT NULL,
  `employee_age` int(2) NOT NULL,
  `employee_phone` varchar(10) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_position` int(1) NOT NULL,
  `employee_status` int(1) NOT NULL,
  `employee_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_lastname`, `employee_age`, `employee_phone`, `employee_email`, `employee_position`, `employee_status`, `employee_date`) VALUES
(1, 'นุ๊ก', 'นุ๊ก', 30, '0999999999', 'Thanakon@gmail.com', 2, 1, '2024-07-24 15:27:24'),
(26, 'อัครพล', 'กันธิยะ', 20, '0848099560', 'bollboll41@gmail.com', 2, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `files_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(4) NOT NULL,
  `folders_id` int(5) DEFAULT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `files_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`files_id`, `name`, `description`, `user_id`, `folders_id`, `file_type`, `file_path`, `is_public`, `files_date`) VALUES
(416, 'Resume', '', 2, NULL, 'pdf', '1725870000_Resume.pdf', 0, '2024-09-09 15:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `folders_id` int(5) NOT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT 0,
  `folder_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `folders_type` int(1) NOT NULL COMMENT '1 = files , 2 =report'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`folders_id`, `user_id`, `name`, `parent_id`, `folder_date`, `folders_type`) VALUES
(187, 2, 'โฟลเดอร์1', 0, '2024-09-09 15:18:29', 1),
(188, 2, 'โฟลเดอร์2', 0, '2024-09-09 15:18:37', 1),
(189, 2, 'โฟลเดอร์3', 0, '2024-09-09 15:19:19', 1);

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
(161, 'Salary Created', 'Salary ID: 11', 2, '2024-08-27 00:34:08'),
(162, 'Bill Created', 'Bill ID: PS2567/001, Total Amount: 133.88', 2, '2024-08-27 00:44:01'),
(163, 'Bill Updated', 'Bill ID: PS2567/001, Total Amount: 267.76', 2, '2024-08-27 00:46:14'),
(164, 'Bill Updated', 'Bill ID: PS2567/001, Total Amount: 401.64', 2, '2024-08-27 00:46:22'),
(165, 'Bill Updated', 'Bill ID: PS2567/001, Total Amount: 133.88', 2, '2024-08-27 00:46:32'),
(166, 'Bill Created', 'Bill ID: PSNK/MIXED/67/001, Total Amount: 10', 2, '2024-08-27 00:46:43'),
(167, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/001, Total Amount: 5', 2, '2024-08-27 00:46:47'),
(168, 'Drum Inserted', 'Drum ID: 1, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-27 00:47:25'),
(169, 'Drum Inserted', 'Drum ID: 2, Drum No: 0012, Company: FIBERHOME, Cable Company: FIBERHOME', 2, '2024-08-27 00:47:39'),
(170, 'Cable Inserted', 'Cable ID: 1, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-27 00:48:13'),
(171, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-27 00:48:20'),
(172, 'Folder Deleted', 'Folder name: า่า่าส', 2, '2024-08-27 00:48:45'),
(173, 'Folder Created', 'Folder name: 4545', 2, '2024-08-27 00:51:25'),
(174, 'Folder Created', 'Folder name: 6546', 2, '2024-08-27 01:01:25'),
(175, 'Folder Updated', 'Folder name: 6546452', 2, '2024-08-27 01:02:54'),
(176, 'User Created', 'Username: admin3, Employee Name: อัครพล กันธิยะ, Position: 0', 2, '2024-08-27 01:11:06'),
(177, 'User Deleted', 'User ID: 28, Employee ID: 25', 2, '2024-08-27 01:11:10'),
(178, 'Reset Password', 'User : admin3', 29, '2024-08-27 01:11:35'),
(179, 'File Uploaded', 'File name: psnktelecom', 2, '2024-08-27 13:23:14'),
(180, 'File Deleted', 'File name: psnktelecom', 2, '2024-08-27 13:23:18'),
(181, 'Folder Deleted', 'Folder name: 6546452', 2, '2024-08-27 13:34:00'),
(182, 'Folder Created', 'Folder name: ฟฟฟฟหหก', 2, '2024-08-27 13:34:06'),
(183, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 13:36:32'),
(184, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 13:36:45'),
(185, 'Folder Created', 'Folder name: 12222', 2, '2024-08-27 13:36:53'),
(186, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:37:16'),
(187, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:37:26'),
(188, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:38:13'),
(189, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:38:28'),
(190, 'Folder Deleted', 'Folder name: 12222', 2, '2024-08-27 13:38:46'),
(191, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 13:38:51'),
(192, 'File Uploaded', 'File name: report', 2, '2024-08-27 13:40:13'),
(193, 'File Deleted', 'File name: report', 2, '2024-08-27 13:40:19'),
(194, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:43:09'),
(195, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 13:51:19'),
(196, 'Folder Deleted', 'Folder name: ', 2, '2024-08-27 13:51:19'),
(197, 'Folder Created', 'Folder name: หฟกฟห', 2, '2024-08-27 13:51:33'),
(198, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 13:51:40'),
(199, 'Folder Deleted', 'Folder name: หฟกฟห', 2, '2024-08-27 13:51:43'),
(200, 'Folder Deleted', 'Folder name: ', 2, '2024-08-27 13:51:43'),
(201, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 13:52:05'),
(202, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 13:52:15'),
(203, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-08-27 13:52:25'),
(204, 'Folder Deleted', 'Folder name: ', 2, '2024-08-27 13:52:25'),
(205, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 13:56:41'),
(206, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:56:47'),
(207, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 13:56:52'),
(208, 'Folder Created', 'Folder name: หก', 2, '2024-08-27 13:57:19'),
(209, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:57:25'),
(210, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 13:58:57'),
(211, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:02:27'),
(212, 'Folder Deleted', 'Folder name: หก', 2, '2024-08-27 14:03:08'),
(213, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:04:37'),
(214, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:04:42'),
(215, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 14:05:43'),
(216, 'Folder Created', 'Folder name: ฟหกฟหกฟฟฟฟฟ', 2, '2024-08-27 14:05:49'),
(217, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:05:55'),
(218, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:11:42'),
(219, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:11:48'),
(220, 'Folder Created', 'Folder name: 121212', 2, '2024-08-27 14:11:52'),
(221, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:13:26'),
(222, 'Folder Deleted', 'Folder name: 121212', 2, '2024-08-27 14:13:30'),
(223, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:13:34'),
(224, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:13:44'),
(225, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:14:20'),
(226, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:14:27'),
(227, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:16:18'),
(228, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:16:38'),
(229, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:17:12'),
(230, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:17:17'),
(231, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:17:23'),
(232, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:17:37'),
(233, 'Folder Created', 'Folder name: อัครพล2', 2, '2024-08-27 14:17:42'),
(234, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:21:56'),
(235, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:22:05'),
(236, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:24:20'),
(237, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:24:24'),
(238, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:24:29'),
(239, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:25:09'),
(240, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:25:14'),
(241, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:25:18'),
(242, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:26:17'),
(243, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:26:27'),
(244, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:28:23'),
(245, 'File Uploaded', 'File name: ประเทศฟิลิปปินส์-ล่าสุด', 2, '2024-08-27 14:28:32'),
(246, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:29:26'),
(247, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 14:29:33'),
(248, 'File Deleted', 'File name: ประเทศฟิลิปปินส์-ล่าสุด', 2, '2024-08-27 14:29:36'),
(249, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:29:40'),
(250, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:33:02'),
(251, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:34:20'),
(252, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:34:27'),
(253, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:34:35'),
(254, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:34:47'),
(255, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:35:23'),
(256, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:37:51'),
(257, 'Folder Created', 'Folder name: 12222', 2, '2024-08-27 14:38:08'),
(258, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:38:16'),
(259, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:40:17'),
(260, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:40:22'),
(261, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:40:30'),
(262, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:40:41'),
(263, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:41:12'),
(264, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:41:16'),
(265, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:41:21'),
(266, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:41:24'),
(267, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:47:06'),
(268, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:47:11'),
(269, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:47:22'),
(270, 'Folder Deleted', 'Folder name: ', 2, '2024-08-27 14:47:29'),
(271, 'Folder Deleted', 'Folder name: ', 2, '2024-08-27 14:47:29'),
(272, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:49:23'),
(273, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:49:27'),
(274, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:49:31'),
(275, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:54:49'),
(276, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:54:54'),
(277, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:58:08'),
(278, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:58:24'),
(279, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:58:28'),
(280, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:58:33'),
(281, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:58:36'),
(282, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 14:59:20'),
(283, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 14:59:26'),
(284, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 14:59:41'),
(285, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:00:46'),
(286, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:00:54'),
(287, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 15:04:00'),
(288, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:04:13'),
(289, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:04:17'),
(290, 'File Uploaded', 'File name: ประเทศฟิลิปปินส์-ล่าสุด2 (1)', 2, '2024-08-27 15:04:25'),
(291, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:05:10'),
(292, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:05:14'),
(293, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 15:06:09'),
(294, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:06:20'),
(295, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 15:06:26'),
(296, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:06:32'),
(297, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:08:22'),
(298, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:08:27'),
(299, 'File Uploaded', 'File name: ประเทศฟิลิปปินส์-ล่าสุด2 (1)', 2, '2024-08-27 15:08:32'),
(300, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:11:22'),
(301, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 15:11:28'),
(302, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:13:31'),
(303, 'File Uploaded', 'File name: folders', 2, '2024-08-27 15:13:37'),
(304, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 15:13:41'),
(305, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:13:51'),
(306, 'File Uploaded', 'File name: สำรวจระบบนิเวศทางเดินขึ้นวัดผาลาด', 2, '2024-08-27 15:14:15'),
(307, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:14:19'),
(308, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 15:14:26'),
(309, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 15:17:28'),
(310, 'File Uploaded', 'File name: folders', 2, '2024-08-27 15:17:34'),
(311, 'File Deleted', 'File name: folders', 2, '2024-08-27 15:17:48'),
(312, 'File Uploaded', 'File name: files', 2, '2024-08-27 15:43:56'),
(313, 'File Uploaded', 'File name: folders (1)', 2, '2024-08-27 15:43:56'),
(314, 'File Uploaded', 'File name: folders', 2, '2024-08-27 15:43:56'),
(315, 'File Deleted', 'File name: files', 2, '2024-08-27 15:44:17'),
(316, 'File Deleted', 'File name: folders (1)', 2, '2024-08-27 15:44:21'),
(317, 'File Deleted', 'File name: folders', 2, '2024-08-27 15:44:27'),
(318, 'Folder Created', 'Folder name: อัครพล1', 2, '2024-08-27 15:45:24'),
(319, 'File Uploaded', 'File name: folders', 2, '2024-08-27 16:27:18'),
(320, 'File Uploaded', 'File name: folders ||1', 2, '2024-08-27 16:27:46'),
(321, 'File Uploaded', 'File name: files', 2, '2024-08-27 16:28:05'),
(322, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 16:30:02'),
(323, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 16:39:40'),
(324, 'File Deleted', 'File name: files', 2, '2024-08-27 16:39:43'),
(325, 'Folder Deleted', 'Folder name: อัครพล1', 2, '2024-08-27 16:43:14'),
(326, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 16:43:17'),
(327, 'Cable Deleted', 'Cable ID: 1, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-27 16:43:27'),
(328, 'Cable Inserted', 'Cable ID: 2, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 90', 2, '2024-08-27 16:43:56'),
(329, 'Bill Deleted', 'Bill ID: PSNK/MIXED/67/001, Company: mixed', 2, '2024-08-27 16:46:20'),
(330, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24 (1)', 2, '2024-08-27 16:53:15'),
(331, 'File Renamed', 'New name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24 (1)', 2, '2024-08-27 16:53:20'),
(332, 'File Updated', 'File ID: 88', 2, '2024-08-27 16:53:24'),
(333, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24 (1)', 2, '2024-08-27 16:53:33'),
(334, 'File Uploaded', 'File name: PHPMailer-6', 2, '2024-08-27 16:55:40'),
(335, 'File Updated', 'File ID: 89', 2, '2024-08-27 16:55:44'),
(336, 'File Deleted', 'File name: PHPMailer-6', 2, '2024-08-27 16:55:53'),
(337, 'File Uploaded', 'File name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-27 16:58:48'),
(338, 'File Uploaded', 'File name: PHPMailer-6', 2, '2024-08-27 17:00:36'),
(339, 'File Uploaded', 'File name: การถ่ายภาพ AF-SN', 2, '2024-08-27 17:00:42'),
(340, 'File Uploaded', 'File name: PHPMailer-6_9_1', 2, '2024-08-27 17:01:01'),
(341, 'File Deleted', 'File name: PHPMailer-6', 2, '2024-08-27 17:01:05'),
(342, 'File Uploaded', 'File name: 1434430277-TRex001-o', 2, '2024-08-27 17:04:40'),
(343, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 17:06:00'),
(344, 'File Deleted', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 17:06:04'),
(345, 'File Deleted', 'File name: 1434430277-TRex001-o', 2, '2024-08-27 17:10:45'),
(346, 'File Deleted', 'File name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-27 17:10:57'),
(347, 'File Deleted', 'File name: การถ่ายภาพ AF-SN', 2, '2024-08-27 17:11:01'),
(348, 'File Deleted', 'File name: PHPMailer-6_9_1', 2, '2024-08-27 17:11:05'),
(349, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 17:11:32'),
(350, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 17:11:37'),
(351, 'File Uploaded', 'File name: Plan Work RFC Consolidat _ Smart City Project _North_region_Progress_report_as_21-Aug-24', 2, '2024-08-27 17:11:46'),
(352, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 17:11:59'),
(353, 'Folder Created', 'Folder name: โฟลเดอร์ 1', 2, '2024-08-27 17:12:38'),
(354, 'Folder Created', 'Folder name: โฟลเดอร์ 2', 2, '2024-08-27 17:12:49'),
(355, 'File Uploaded', 'File name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-27 17:13:10'),
(356, 'File Renamed', 'New name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-27 17:13:17'),
(357, 'File Renamed', 'New name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-27 17:13:17'),
(358, 'File Renamed', 'New name: 36704245096_2755956675318857470_n', 2, '2024-08-27 17:13:26'),
(359, 'File Renamed', 'New name: 755956675318857470_n', 2, '2024-08-27 17:13:28'),
(360, 'File Renamed', 'New name: 755956675318857470_n', 2, '2024-08-27 17:13:28'),
(361, 'File Renamed', 'New name: 18857470_n', 2, '2024-08-27 17:13:33'),
(362, 'File Renamed', 'New name: 18857470', 2, '2024-08-27 18:20:36'),
(363, 'File Renamed', 'New name: 18857470', 2, '2024-08-27 18:20:36'),
(364, 'File Renamed', 'New name: 1885747', 2, '2024-08-27 18:20:43'),
(365, 'File Renamed', 'New name: 1885747', 2, '2024-08-27 18:20:43'),
(366, 'File Renamed', 'New name: 188574', 2, '2024-08-27 18:22:22'),
(367, 'File Renamed', 'New name: 1885', 2, '2024-08-27 18:22:25'),
(368, 'File Renamed', 'New name: 1885หฟกฟหก', 2, '2024-08-27 18:22:30'),
(369, 'File Renamed', 'New name: 1885หฟก', 2, '2024-08-27 18:22:33'),
(370, 'File Renamed', 'New name: 1885หฟ', 2, '2024-08-27 18:22:39'),
(371, 'File Renamed', 'New name: 1885ห', 2, '2024-08-27 18:22:44'),
(372, 'File Renamed', 'New name: 1885', 2, '2024-08-27 18:24:20'),
(373, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:24:24'),
(374, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:24:24'),
(375, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:24:24'),
(376, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:24:24'),
(377, 'File Renamed', 'New name: 18851212 หกหก', 2, '2024-08-27 18:25:15'),
(378, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:25:17'),
(379, 'File Renamed', 'New name: 18851212', 2, '2024-08-27 18:25:17'),
(380, 'File Renamed', 'New name: 188512121212', 2, '2024-08-27 18:26:06'),
(381, 'File Renamed', 'New name: 188512121212', 2, '2024-08-27 18:26:06'),
(382, 'File Renamed', 'New name: 188512121212', 2, '2024-08-27 18:26:06'),
(383, 'Folder Updated', 'Folder name: โฟลเดอร์ 3', 2, '2024-08-27 18:27:13'),
(384, 'Folder Updated', 'Folder name: โฟลเดอร์ 1', 2, '2024-08-27 18:27:19'),
(385, 'Folder Updated', 'Folder name: โฟลเดอร์ 3', 2, '2024-08-27 18:27:40'),
(386, 'File Renamed', 'New name: 188512121', 2, '2024-08-27 18:29:45'),
(387, 'File Renamed', 'New name: 1885121', 2, '2024-08-27 18:29:47'),
(388, 'File Renamed', 'New name: 1885121', 2, '2024-08-27 18:29:47'),
(389, 'Folder Updated', 'Folder name: โฟลเดอร์ ', 2, '2024-08-27 18:30:00'),
(390, 'Folder Deleted', 'Folder name: โฟลเดอร์ 1', 2, '2024-08-27 18:30:19'),
(391, 'Folder Updated', 'Folder name: โฟลเดอร์ ', 2, '2024-08-27 18:30:23'),
(392, 'Folder Deleted', 'Folder name: โฟลเดอร์ ', 2, '2024-08-27 18:30:33'),
(393, 'File Deleted', 'File name: 1885121', 2, '2024-08-27 18:30:36'),
(394, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 18:30:40'),
(395, 'Folder Created', 'Folder name: อัครพล12', 2, '2024-08-27 18:30:49'),
(396, 'Folder Deleted', 'Folder name: อัครพล12', 2, '2024-08-27 18:30:53'),
(397, 'Folder Updated', 'Folder name: อัครพล', 2, '2024-08-27 18:30:56'),
(398, 'Folder Updated', 'Folder name: อัครพลหกหก', 2, '2024-08-27 18:31:43'),
(399, 'Folder Updated', 'Folder name: อัครพลหกหกหกหก', 2, '2024-08-27 18:31:47'),
(400, 'Folder Updated', 'Folder name: อัครพลหกหกหกหกกกก', 2, '2024-08-27 18:31:51'),
(401, 'Folder Updated', 'Folder name: อัครพลหก', 2, '2024-08-27 18:32:38'),
(402, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 18:33:17'),
(403, 'File Uploaded', 'File name: files', 2, '2024-08-27 18:33:21'),
(404, 'Folder Updated', 'Folder name: อัครพล', 2, '2024-08-27 18:35:15'),
(405, 'Folder Updated', 'Folder name: อัครพล12', 2, '2024-08-27 18:35:23'),
(406, 'Folder Updated', 'Folder name: อัครพล', 2, '2024-08-27 18:35:33'),
(407, 'Folder Created', 'Folder name: อัครพล2', 2, '2024-08-27 18:35:43'),
(408, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 18:35:47'),
(409, 'File Uploaded', 'File name: files', 2, '2024-08-27 18:35:52'),
(410, 'File Deleted', 'File name: files', 2, '2024-08-27 18:35:56'),
(411, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-08-27 18:36:00'),
(412, 'Folder Deleted', 'Folder name: อัครพล2', 2, '2024-08-27 18:36:14'),
(413, 'Folder Updated', 'Folder name: อัครพลหหห', 2, '2024-08-27 18:36:44'),
(414, 'Folder Updated', 'Folder name: อัครพลหหห', 2, '2024-08-27 18:36:47'),
(415, 'Folder Updated', 'Folder name: อัครพลหหห', 2, '2024-08-27 18:36:50'),
(416, 'Folder Updated', 'Folder name: อัครพลหหห', 2, '2024-08-27 18:36:50'),
(417, 'Folder Updated', 'Folder name: อัครพลหหห', 2, '2024-08-27 18:36:50'),
(418, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 18:37:26'),
(419, 'Folder Updated', 'Folder name: อัครพ12', 2, '2024-08-27 18:37:28'),
(420, 'Folder Updated', 'Folder name: อัครพ12', 2, '2024-08-27 18:37:28'),
(421, 'Folder Updated', 'Folder name: อัครพ12', 2, '2024-08-27 18:44:36'),
(422, 'Folder Updated', 'Folder name: อัครพ12', 2, '2024-08-27 18:44:36'),
(423, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 18:44:42'),
(424, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 18:44:42'),
(425, 'Folder Updated', 'Folder name: อัครพกดก', 2, '2024-08-27 18:45:15'),
(426, 'Folder Updated', 'Folder name: อัครพก', 2, '2024-08-27 18:45:27'),
(427, 'Folder Updated', 'Folder name: อัครพก2323', 2, '2024-08-27 18:47:30'),
(428, 'File Uploaded', 'File name: files', 2, '2024-08-27 18:50:53'),
(429, 'File Uploaded', 'File name: files ||1', 2, '2024-08-27 18:51:04'),
(430, 'File Deleted', 'File name: files ||1', 2, '2024-08-27 18:51:10'),
(431, 'File Uploaded', 'File name: files ||1', 2, '2024-08-27 18:51:55'),
(432, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 18:52:00'),
(433, 'Folder Created', 'Folder name: อัครพล2', 2, '2024-08-27 18:52:08'),
(434, 'Folder Updated', 'Folder name: อัครพก245', 2, '2024-08-27 18:52:15'),
(435, 'Folder Updated', 'Folder name: อัครพก245', 2, '2024-08-27 18:52:17'),
(436, 'Folder Updated', 'Folder name: อัครพก245', 2, '2024-08-27 18:52:19'),
(437, 'Folder Updated', 'Folder name: อัครพก245', 2, '2024-08-27 18:52:20'),
(438, 'Folder Updated', 'Folder name: อัครพก245', 2, '2024-08-27 18:52:20'),
(439, 'File Updated', 'File ID: 101', 2, '2024-08-27 18:56:02'),
(440, 'File Updated', 'File ID: 103', 2, '2024-08-27 18:56:06'),
(441, 'Folder Updated', 'Folder name: อัครพล111', 2, '2024-08-27 18:56:18'),
(442, 'Folder Updated', 'Folder name: อัครพล111', 2, '2024-08-27 18:56:24'),
(443, 'Folder Updated', 'Folder name: อัครพล111', 2, '2024-08-27 18:56:24'),
(444, 'Folder Updated', 'Folder name: อัครพล111', 2, '2024-08-27 18:56:24'),
(445, 'Folder Updated', 'Folder name: อัครพล', 2, '2024-08-27 18:56:30'),
(446, 'File Uploaded', 'File name: folders', 2, '2024-08-27 19:09:22'),
(447, 'File Uploaded', 'File name: files ||2', 2, '2024-08-27 19:09:22'),
(448, 'File Deleted', 'File name: files ||2', 2, '2024-08-27 19:09:28'),
(449, 'File Deleted', 'File name: folders', 2, '2024-08-27 19:09:31'),
(450, 'File Deleted', 'File name: files ||1', 2, '2024-08-27 19:09:34'),
(451, 'File Updated', 'File ID: 101', 2, '2024-08-27 19:10:45'),
(452, 'File Deleted', 'File name: files', 2, '2024-08-27 19:10:50'),
(453, 'Folder Deleted', 'Folder name: อัครพล2', 2, '2024-08-27 19:12:15'),
(454, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 19:12:22'),
(455, 'Folder Deleted', 'Folder name: อัครพก', 2, '2024-08-27 19:13:50'),
(456, 'File Uploaded', 'File name: folders', 2, '2024-08-27 19:17:07'),
(457, 'File Deleted', 'File name: folders', 2, '2024-08-27 19:17:13'),
(458, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 19:19:23'),
(459, 'File Uploaded', 'File name: files', 2, '2024-08-27 19:19:32'),
(460, 'File Uploaded', 'File name: files ||1', 2, '2024-08-27 19:19:33'),
(461, 'File Uploaded', 'File name: files ||2', 2, '2024-08-27 19:19:33'),
(462, 'File Uploaded', 'File name: files ||3', 2, '2024-08-27 19:19:34'),
(463, 'File Uploaded', 'File name: files ||4', 2, '2024-08-27 19:19:34'),
(464, 'File Uploaded', 'File name: files ||5', 2, '2024-08-27 19:19:34'),
(465, 'File Uploaded', 'File name: files ||6', 2, '2024-08-27 19:19:34'),
(466, 'File Uploaded', 'File name: files ||7', 2, '2024-08-27 19:19:34'),
(467, 'File Deleted', 'File name: files ||7', 2, '2024-08-27 19:19:52'),
(468, 'File Deleted', 'File name: files ||6', 2, '2024-08-27 19:19:54'),
(469, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 19:19:58'),
(470, 'File Deleted', 'File name: files', 2, '2024-08-27 19:20:01'),
(471, 'File Deleted', 'File name: files ||1', 2, '2024-08-27 19:20:13'),
(472, 'File Deleted', 'File name: files ||2', 2, '2024-08-27 19:20:19'),
(473, 'File Deleted', 'File name: files ||3', 2, '2024-08-27 19:20:22'),
(474, 'File Deleted', 'File name: files ||4', 2, '2024-08-27 19:20:25'),
(475, 'File Deleted', 'File name: files ||5', 2, '2024-08-27 19:20:28'),
(476, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 19:24:11'),
(477, 'Folder Updated', 'Folder name: อัครพล12', 2, '2024-08-27 19:24:18'),
(478, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 19:24:30'),
(479, 'Folder Created', 'Folder name: อัครพลหก', 2, '2024-08-27 19:24:33'),
(480, 'Folder Created', 'Folder name: อัครพล4', 2, '2024-08-27 19:24:42'),
(481, 'Folder Created', 'Folder name: อัครพล45', 2, '2024-08-27 19:24:48'),
(482, 'Folder Updated', 'Folder name: อัครพล4544', 2, '2024-08-27 19:24:53'),
(483, 'Folder Updated', 'Folder name: อัครพล565656', 2, '2024-08-27 19:25:02'),
(484, 'Folder Deleted', 'Folder name: อัครพล565656', 2, '2024-08-27 19:25:11'),
(485, 'File Uploaded', 'File name: files', 2, '2024-08-27 19:25:18'),
(486, 'File Deleted', 'File name: files', 2, '2024-08-27 19:25:44'),
(487, 'Folder Updated', 'Folder name: อัครพล45444545', 2, '2024-08-27 19:25:48'),
(488, 'File Uploaded', 'File name: folders', 2, '2024-08-27 19:25:56'),
(489, 'File Deleted', 'File name: folders', 2, '2024-08-27 19:27:45'),
(490, 'Folder Deleted', 'Folder name: อัครพล45444545', 2, '2024-08-27 19:27:48'),
(491, 'Folder Deleted', 'Folder name: อัครพล4', 2, '2024-08-27 19:27:50'),
(492, 'Folder Deleted', 'Folder name: อัครพลหก', 2, '2024-08-27 19:27:54'),
(493, 'Folder Deleted', 'Folder name: อัครพล12', 2, '2024-08-27 19:27:56'),
(494, 'File Uploaded', 'File name: folders', 2, '2024-08-27 19:28:05'),
(495, 'File Deleted', 'File name: folders', 2, '2024-08-27 19:28:10'),
(496, 'File Uploaded', 'File name: folders (1)', 2, '2024-08-27 19:28:25'),
(497, 'Folder Created', 'Folder name: 45454', 2, '2024-08-27 19:44:02'),
(498, 'Folder Updated', 'Folder name: 45454หกหก', 2, '2024-08-27 19:44:07'),
(499, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 19:44:35'),
(500, 'Folder Created', 'Folder name: ฟหกฟหกฟหกฟหกฟห', 2, '2024-08-27 19:44:49'),
(501, 'Folder Updated', 'Folder name: 45454หกหกฟหกฟหก', 2, '2024-08-27 19:44:52'),
(502, 'Folder Updated', 'Folder name: ฟหกฟหกฟหกฟหก', 2, '2024-08-27 19:45:00'),
(503, 'Folder Updated', 'Folder name: ฟหก', 2, '2024-08-27 19:47:55'),
(504, 'Folder Updated', 'Folder name: ฟหก4545', 2, '2024-08-27 19:47:57'),
(505, 'Folder Updated', 'Folder name: ฟหก4545', 2, '2024-08-27 19:47:58'),
(506, 'Folder Updated', 'Folder name: ฟหก454545444', 2, '2024-08-27 19:47:59'),
(507, 'Folder Updated', 'Folder name: ฟหก454545444', 2, '2024-08-27 19:47:59'),
(508, 'Folder Updated', 'Folder name: ฟหก454545444', 2, '2024-08-27 19:48:00'),
(509, 'Folder Updated', 'Folder name: sdsdsd', 2, '2024-08-27 19:48:03'),
(510, 'Folder Updated', 'Folder name: sdsdsd', 2, '2024-08-27 19:48:04'),
(511, 'Folder Updated', 'Folder name: sdsdsd', 2, '2024-08-27 19:48:04'),
(512, 'Folder Created', 'Folder name: หหกหก', 2, '2024-08-27 19:48:16'),
(513, 'Folder Updated', 'Folder name: 45454หกหกหกหก', 2, '2024-08-27 19:48:33'),
(514, 'Folder Updated', 'Folder name: ฟ', 2, '2024-08-27 19:48:49'),
(515, 'Folder Updated', 'Folder name: sdsdsd45', 2, '2024-08-27 19:49:12'),
(516, 'Folder Updated', 'Folder name: 4', 2, '2024-08-27 19:49:49'),
(517, 'Folder Updated', 'Folder name: 456456546', 2, '2024-08-27 19:49:54'),
(518, 'Folder Updated', 'Folder name: ห', 2, '2024-08-27 19:50:00'),
(519, 'File Deleted', 'File name: 12f', 2, '2024-08-27 19:53:54'),
(520, 'Folder Deleted', 'Folder name: ห', 2, '2024-08-27 19:53:57'),
(521, 'Folder Updated', 'Folder name: 456456546', 2, '2024-08-27 19:54:00'),
(522, 'Folder Deleted', 'Folder name: 456456546', 2, '2024-08-27 19:54:06'),
(523, 'Folder Deleted', 'Folder name: 4', 2, '2024-08-27 19:54:10'),
(524, 'Folder Deleted', 'Folder name: ฟ', 2, '2024-08-27 19:54:12'),
(525, 'File Uploaded', 'File name: folders', 2, '2024-08-27 19:57:34'),
(526, 'File Deleted', 'File name: fo', 2, '2024-08-27 19:57:56'),
(527, 'File Uploaded', 'File name: files', 2, '2024-08-27 19:58:02'),
(528, 'File Deleted', 'File name: files', 2, '2024-08-27 19:59:44'),
(529, 'File Uploaded', 'File name: files', 2, '2024-08-27 19:59:48'),
(530, 'File Deleted', 'File name: fil', 2, '2024-08-27 19:59:56'),
(531, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:02:04'),
(532, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:02:19'),
(533, 'Folder Updated', 'Folder name: อัคร', 2, '2024-08-27 20:02:24'),
(534, 'File Deleted', 'File name: filหฟกฟหกฟหก', 2, '2024-08-27 20:11:42'),
(535, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:12:10'),
(536, 'File Deleted', 'File name: filesหกหกหกหก', 2, '2024-08-27 20:12:23'),
(537, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:16:08'),
(538, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:17:18'),
(539, 'File Deleted', 'File name: fil', 2, '2024-08-27 20:17:30'),
(540, 'Folder Deleted', 'Folder name: อัคร', 2, '2024-08-27 20:17:35'),
(541, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 20:17:38'),
(542, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:17:41'),
(543, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 20:17:47'),
(544, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:17:52'),
(545, 'File Uploaded', 'File name: folders', 2, '2024-08-27 20:17:59'),
(546, 'File Deleted', 'File name: folders', 2, '2024-08-27 20:18:14'),
(547, 'File Deleted', 'File name: files', 2, '2024-08-27 20:18:18'),
(548, 'Folder Created', 'Folder name: ฟหกหฟก', 2, '2024-08-27 20:18:33'),
(549, 'Folder Created', 'Folder name: อัครพล2', 2, '2024-08-27 20:18:48'),
(550, 'File Uploaded', 'File name: folders', 2, '2024-08-27 20:18:55'),
(551, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 20:20:55'),
(552, 'File Deleted', 'File name: fol4545', 2, '2024-08-27 20:21:08'),
(553, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 20:21:48'),
(554, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-08-27 20:21:51'),
(555, 'Folder Deleted', 'Folder name: ฟหกหฟก', 2, '2024-08-27 20:21:59'),
(556, 'Folder Deleted', 'Folder name: อัครพ', 2, '2024-08-27 20:22:02'),
(557, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:22:13'),
(558, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:22:19'),
(559, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:22:23'),
(560, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 20:22:27'),
(561, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:23:26'),
(562, 'Folder Updated', 'Folder name: อัครพล565', 2, '2024-08-27 20:23:50'),
(563, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 20:24:08'),
(564, 'Folder Updated', 'Folder name: อัครพ56', 2, '2024-08-27 20:24:20'),
(565, 'Folder Updated', 'Folder name: อัครพ', 2, '2024-08-27 20:24:32'),
(566, 'Folder Updated', 'Folder name: อัครพ2323', 2, '2024-08-27 20:24:35'),
(567, 'Folder Updated', 'Folder name: อัครพ223232323', 2, '2024-08-27 20:25:04'),
(568, 'Folder Updated', 'Folder name: อัค', 2, '2024-08-27 20:25:08'),
(569, 'Folder Updated', 'Folder name: อัค233265465', 2, '2024-08-27 20:25:11'),
(570, 'Folder Updated', 'Folder name: อัค233', 2, '2024-08-27 20:25:13'),
(571, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-08-27 20:25:18'),
(572, 'Folder Created', 'Folder name: 4556456456', 2, '2024-08-27 20:25:23'),
(573, 'Folder Created', 'Folder name: dfdf', 2, '2024-08-27 20:25:28'),
(574, 'Folder Created', 'Folder name: asdaaaa', 2, '2024-08-27 20:25:32'),
(575, 'Folder Updated', 'Folder name: อัค233454', 2, '2024-08-27 20:26:33'),
(576, 'Folder Created', 'Folder name: 454545', 2, '2024-08-27 20:26:35'),
(577, 'Folder Updated', 'Folder name: ฟหกฟหก45454545', 2, '2024-08-27 20:27:18'),
(578, 'Folder Updated', 'Folder name: 45454544444', 2, '2024-08-27 20:27:21'),
(579, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:30:30'),
(580, 'Folder Created', 'Folder name: 232323', 2, '2024-08-27 20:30:50'),
(581, 'Folder Created', 'Folder name: 2323', 2, '2024-08-27 20:31:12'),
(582, 'Folder Updated', 'Folder name: อัค545454', 2, '2024-08-27 20:31:15'),
(583, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:32:33'),
(584, 'Folder Updated', 'Folder name: ฟหกฟหก', 2, '2024-08-27 20:34:13'),
(585, 'Folder Updated', 'Folder name: 45454', 2, '2024-08-27 20:34:16'),
(586, 'Folder Updated', 'Folder name: อัครพ3232', 2, '2024-08-27 20:34:30'),
(587, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:06'),
(588, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:06'),
(589, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:07'),
(590, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:07'),
(591, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:07'),
(592, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:07'),
(593, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:08'),
(594, 'Folder Updated', 'Folder name: 23232', 2, '2024-08-27 20:35:08'),
(595, 'Folder Updated', 'Folder name: 23232323', 2, '2024-08-27 20:38:12'),
(596, 'Folder Updated', 'Folder name: อั', 2, '2024-08-27 20:38:27'),
(597, 'Folder Deleted', 'Folder name: อั', 2, '2024-08-27 20:39:31'),
(598, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-08-27 20:39:38'),
(599, 'Folder Deleted', 'Folder name: 45454', 2, '2024-08-27 20:39:41'),
(600, 'Folder Deleted', 'Folder name: อัครพ3232', 2, '2024-08-27 20:39:44'),
(601, 'Folder Deleted', 'Folder name: 23232', 2, '2024-08-27 20:39:48'),
(602, 'Folder Deleted', 'Folder name: 23232323', 2, '2024-08-27 20:39:52'),
(603, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-27 20:40:00'),
(604, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-27 20:40:06'),
(605, 'File Deleted', 'File name: fil1112323', 2, '2024-08-27 20:40:10'),
(606, 'File Uploaded', 'File name: files', 2, '2024-08-27 20:40:49'),
(607, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-27 20:54:13'),
(608, 'Drum Inserted', 'Drum ID: 3, Drum No: 0062, Company: CCS, Cable Company: FIBERHOME', 2, '2024-08-27 20:54:23'),
(609, 'Drum Inserted', 'Drum ID: 4, Drum No: 0062, Company: Mixed, Cable Company: TICC', 2, '2024-08-27 20:57:55'),
(610, 'Drum Deleted', 'Drum ID: 4, Drum No: 0062, Company: Mixed, Cable Company: TICC', 2, '2024-08-27 20:58:01'),
(611, 'Drum Deleted', 'Drum ID: 3, Drum No: 0062, Company: CCS, Cable Company: FIBERHOME', 2, '2024-08-27 20:58:03'),
(612, 'Drum Deleted', 'Drum ID: 2, Drum No: 0012, Company: FIBERHOME, Cable Company: FIBERHOME', 2, '2024-08-27 20:58:05'),
(613, 'Drum Inserted', 'Drum ID: 5, Drum No: 0062, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-27 20:58:16'),
(614, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-27 20:58:21'),
(615, 'Drum Inserted', 'Drum ID: 6, Drum No: 0, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-27 20:58:36'),
(616, 'Drum Deleted', 'Drum ID: 6, Drum No: 0, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-27 20:58:41'),
(617, 'Drum Inserted', 'Drum ID: 7, Drum No: 0062, Company: FIBERHOME, Cable Company: FIBERHOME', 2, '2024-08-27 20:59:23'),
(618, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-28 08:16:12'),
(619, 'File Uploaded', 'File name: files', 2, '2024-08-28 08:16:57'),
(620, 'File Uploaded', 'File name: files ||1', 2, '2024-08-28 08:17:04'),
(621, 'File Deleted', 'File name: fil', 2, '2024-08-28 08:17:40'),
(622, 'File Deleted', 'File name: files', 2, '2024-08-28 08:17:43'),
(623, 'File Deleted', 'File name: files ||1', 2, '2024-08-28 08:17:46'),
(624, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-28 08:17:50'),
(625, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-28 08:27:59'),
(626, 'Cable Inserted', 'Cable ID: 3, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 90', 2, '2024-08-28 08:28:11'),
(627, 'Cable Deleted', 'Cable ID: 3, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 90', 2, '2024-08-28 08:49:06'),
(628, 'Cable Inserted', 'Cable ID: 4, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:49:35'),
(629, 'Cable Inserted', 'Cable ID: 5, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:49:37'),
(630, 'Cable Inserted', 'Cable ID: 6, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:49:38'),
(631, 'Cable Inserted', 'Cable ID: 7, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:49:38'),
(632, 'Cable Inserted', 'Cable ID: 8, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:49:44'),
(633, 'Cable Inserted', 'Cable ID: 9, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:49:46'),
(634, 'Cable Inserted', 'Cable ID: 10, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:49:46'),
(635, 'Cable Deleted', 'Cable ID: 4, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:50:00'),
(636, 'Cable Deleted', 'Cable ID: 5, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:50:03'),
(637, 'Cable Deleted', 'Cable ID: 9, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:50:05'),
(638, 'Cable Deleted', 'Cable ID: 10, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:50:07'),
(639, 'Cable Deleted', 'Cable ID: 8, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-28 08:50:09'),
(640, 'Cable Deleted', 'Cable ID: 6, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:50:11'),
(641, 'Cable Deleted', 'Cable ID: 7, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-28 08:50:14'),
(642, 'Cable Inserted', 'Cable ID: 11, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 990', 2, '2024-08-28 08:50:24'),
(643, 'Cable Inserted', 'Cable ID: 12, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 990', 2, '2024-08-28 08:50:44'),
(646, 'Drum Deleted', 'Drum ID: 7, Drum No: 0062, Company: FIBERHOME, Cable Company: FIBERHOME', 2, '2024-08-28 08:50:57'),
(649, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-28 08:51:45'),
(650, 'File Uploaded', 'File name: Javascript 101', 2, '2024-08-28 08:52:17'),
(651, 'File Uploaded', 'File name: Javascript 101 ||1', 2, '2024-08-28 08:52:25'),
(652, 'File Updated', 'File ID: 133', 2, '2024-08-28 08:53:37'),
(653, 'File Deleted', 'File name: Javas', 2, '2024-08-28 08:55:22'),
(654, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-08-28 08:55:25'),
(656, 'Drum Deleted', 'Drum ID: 5, Drum No: 0062, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-28 09:01:43'),
(657, 'File Uploaded', 'File name: Thanin Chinlapha - CV', 2, '2024-08-28 10:47:28'),
(658, 'File Updated', 'File ID: 135', 2, '2024-08-28 10:52:54'),
(659, 'Folder Created', 'Folder name: อัครพล', 2, '2024-08-28 10:53:04'),
(660, 'Drum Updated', 'Drum ID: 1, Drum No: , Company: , Cable Company: ', 2, '2024-08-28 12:53:11'),
(661, 'Drum Updated', 'Drum ID: 1, Drum No: , Company: , Cable Company: ', 2, '2024-08-28 12:54:31'),
(662, 'Cable Deleted', 'Cable ID: 2, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 90', 2, '2024-08-28 12:54:40'),
(663, 'Cable Deleted', 'Cable ID: 11, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 990', 2, '2024-08-28 12:54:42'),
(664, 'Cable Deleted', 'Cable ID: 12, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 990', 2, '2024-08-28 12:54:43'),
(665, 'Drum Deleted', 'Drum ID: 1, Drum No: , Company: , Cable Company: ', 2, '2024-08-28 12:54:46'),
(666, 'Drum Inserted', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-28 12:54:55'),
(667, 'Cable Inserted', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-08-28 12:55:06'),
(668, 'Drum Updated', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-08-28 12:55:11'),
(669, 'File Deleted', 'File name: Thanin Chinlapha - CV', 2, '2024-09-03 20:20:30'),
(670, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:20:36'),
(671, 'Folder Updated', 'Folder name: อัครพลหกหก', 2, '2024-09-03 20:20:43'),
(672, 'File Uploaded', 'File name: rendercapslog', 2, '2024-09-03 20:21:05'),
(673, 'File Renamed', 'Old name: rendercapslog, New name: rende', 2, '2024-09-03 20:21:13'),
(674, 'File Renamed', 'Old name: rende, New name: rende', 2, '2024-09-03 20:21:13'),
(675, 'File Renamed', 'Old name: rende, New name: ren', 2, '2024-09-03 20:21:19'),
(676, 'File Renamed', 'Old name: ren, New name: ren', 2, '2024-09-03 20:21:19'),
(677, 'File Deleted', 'File name: ren', 2, '2024-09-03 20:22:05'),
(678, 'Folder Updated', 'Folder name: อัคร', 2, '2024-09-03 20:22:19'),
(679, 'Folder Deleted', 'Folder name: อัคร', 2, '2024-09-03 20:22:24'),
(680, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-03 20:23:08'),
(681, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:23:08'),
(682, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:23:08'),
(683, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n ||1', 2, '2024-09-03 20:23:20'),
(684, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n ||1', 2, '2024-09-03 20:23:20'),
(685, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n ||1', 2, '2024-09-03 20:23:20'),
(686, 'File Deleted', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-03 20:23:30'),
(687, 'File Deleted', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:23:33'),
(688, 'File Deleted', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:23:36'),
(689, 'File Deleted', 'File name: 213224417_800378113996553_6734008933617835215_n ||1', 2, '2024-09-03 20:23:39'),
(690, 'File Deleted', 'File name: 415945709_1103847357506482_449857628865336633_n ||1', 2, '2024-09-03 20:23:42'),
(691, 'File Deleted', 'File name: 415945709_1103847357506482_449857628865336633_n ||1', 2, '2024-09-03 20:23:45'),
(692, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-03 20:23:50'),
(693, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:23:55'),
(694, 'File Uploaded', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-03 20:24:00'),
(695, 'File Deleted', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-03 20:25:15'),
(696, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-03 20:25:22'),
(697, 'File Deleted', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-03 20:25:35'),
(698, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:31:37'),
(699, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-03 20:31:42'),
(700, 'File Uploaded', 'File name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 2, '2024-09-03 20:32:05'),
(701, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-03 20:32:22'),
(702, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:32:32'),
(703, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-03 20:33:05'),
(704, 'File Deleted', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-03 20:33:09'),
(705, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:36:23'),
(706, 'File Uploaded', 'File name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 2, '2024-09-03 20:37:45'),
(707, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-03 20:37:58'),
(708, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:38:03'),
(709, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-03 20:38:10'),
(710, 'File Renamed', 'Old name: 415945709_1103847357506482_449857628865336633_n, New name: 7357506482_449857628865336633_n', 2, '2024-09-03 20:38:34'),
(711, 'File Renamed', 'Old name: 7357506482_449857628865336633_n, New name: 7357506482_449857628865336633_n', 2, '2024-09-03 20:38:34'),
(712, 'Folder Updated', 'Folder name: อัคร', 2, '2024-09-03 20:38:41'),
(713, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่', 2, '2024-09-03 20:38:46'),
(714, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่, New name: แบบฝึกหัดท้ายหน่วยเรียนที่', 2, '2024-09-03 20:38:46'),
(715, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่, New name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 2, '2024-09-03 20:38:50'),
(716, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 2, '2024-09-03 20:38:50'),
(717, 'Folder Deleted', 'Folder name: อัคร', 2, '2024-09-03 20:39:04'),
(718, 'File Deleted', 'File name: 7357506482_449857628865336633_n', 2, '2024-09-03 20:52:26'),
(719, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:52:33'),
(720, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-03 20:52:51'),
(721, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-03 20:54:02'),
(722, 'Folder Updated', 'Folder name: อัคร', 2, '2024-09-03 20:54:09'),
(723, 'Reset Password', 'User : admin3', 29, '2024-09-03 21:14:25'),
(724, 'Folder Created', 'Folder name: ฟหกฟหก', 29, '2024-09-03 22:04:07'),
(725, 'Folder Created', 'Folder name: a', 29, '2024-09-03 22:07:51'),
(726, 'File Updated', 'File ID: 160', 29, '2024-09-04 01:01:23'),
(727, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 29, '2024-09-04 15:18:25'),
(728, 'File Uploaded', 'File name: Screenshot 2024-04-05 182619', 29, '2024-09-04 15:18:39'),
(729, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่ ', 29, '2024-09-04 15:18:47'),
(730, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ , New name: แบบฝึกหัดท้ายหน่วยเรียนที่ ', 29, '2024-09-04 15:18:47'),
(731, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ , New name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 29, '2024-09-04 15:18:51'),
(732, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 29, '2024-09-04 15:18:51'),
(733, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6', 29, '2024-09-04 15:18:51'),
(734, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่ 6, New name: แบบฝึกหัดท้ายหน่วยเรียนที่', 29, '2024-09-04 15:26:17'),
(735, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่, New name: แบบฝึกหัดท้ายหน่วยเรียนที่', 29, '2024-09-04 15:26:17'),
(736, 'Folder Updated', 'Folder name: ฟหกฟ', 29, '2024-09-04 15:26:20'),
(737, 'Folder Updated', 'Folder name: ฟห', 29, '2024-09-04 15:27:50'),
(738, 'Folder Updated', 'Folder name: อัครพลหก', 29, '2024-09-04 15:29:29'),
(739, 'Folder Updated', 'Folder name: ฟห2323', 29, '2024-09-04 15:29:38'),
(740, 'Folder Updated', 'Folder name: a1111', 29, '2024-09-04 16:05:45'),
(741, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 12:49:35'),
(742, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-05 12:49:51'),
(743, 'File Renamed', 'Old name: 213224417_800378113996553_6734008933617835215_n, New name: 6553_6734008933617835215_n', 2, '2024-09-05 12:49:54'),
(744, 'File Renamed', 'Old name: 6553_6734008933617835215_n, New name: 6553_6734008933617835215_n', 2, '2024-09-05 12:49:54'),
(745, 'File Renamed', 'Old name: 6553_6734008933617835215_n, New name: 08933617835215_n', 2, '2024-09-05 12:49:57'),
(746, 'File Renamed', 'Old name: 08933617835215_n, New name: 08933617835215_n', 2, '2024-09-05 12:49:57'),
(747, 'File Renamed', 'Old name: แบบฝึกหัดท้ายหน่วยเรียนที่, New name: หน่วยเรียนที่', 2, '2024-09-05 12:50:01'),
(748, 'File Renamed', 'Old name: หน่วยเรียนที่, New name: หน่วยเรียนที่', 2, '2024-09-05 12:50:01'),
(749, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-05 12:50:06'),
(750, 'File Uploaded', 'File name: 213224417_800378113996553_6734008933617835215_n ||1', 2, '2024-09-05 12:50:12'),
(751, 'File Renamed', 'Old name: 08933617835215_n, New name: 617835215_n', 2, '2024-09-05 12:52:10'),
(752, 'File Renamed', 'Old name: 617835215_n, New name: 617835215_n', 2, '2024-09-05 12:52:10'),
(753, 'File Renamed', 'Old name: 617835215_n, New name: 617835215_n', 2, '2024-09-05 12:52:25'),
(754, 'File Renamed', 'Old name: 617835215_n, New name: 617835215_n', 2, '2024-09-05 12:52:25'),
(755, 'File Renamed', 'Old name: 617835215_n, New name: 617835215_n', 2, '2024-09-05 12:52:25'),
(756, 'File Deleted', 'File name: 213224417_800378113996553_6734008933617835215_n ||1', 2, '2024-09-05 12:52:30'),
(757, 'File Deleted', 'File name: 213224417_800378113996553_6734008933617835215_n', 2, '2024-09-05 12:52:45');
INSERT INTO `log` (`log_id`, `log_status`, `log_detail`, `user_id`, `log_date`) VALUES
(758, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-05 12:52:52'),
(759, 'File Renamed', 'Old name: Assignment 5 (Web Application Development), New name: nt 5 (Web Application Development)', 2, '2024-09-05 12:52:55'),
(760, 'File Renamed', 'Old name: nt 5 (Web Application Development), New name: nt 5 (Web Application Development)', 2, '2024-09-05 12:52:55'),
(761, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-05 12:53:00'),
(762, 'File Renamed', 'Old name: Assignment 5 (Web Application Development), New name: t 5 (Web Application Development)', 2, '2024-09-05 12:53:03'),
(763, 'File Renamed', 'Old name: t 5 (Web Application Development), New name: t 5 (Web Application Development)', 2, '2024-09-05 12:53:03'),
(764, 'File Deleted', 'File name: t 5 (Web Application Development)', 2, '2024-09-05 12:53:06'),
(765, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-05 12:53:14'),
(766, 'File Renamed', 'Old name: Assignment 5 (Web Application Development), New name:  (Web Application Development)', 2, '2024-09-05 12:53:18'),
(767, 'File Renamed', 'Old name:  (Web Application Development), New name:  (Web Application Development)', 2, '2024-09-05 12:53:18'),
(768, 'File Uploaded', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-05 12:53:23'),
(769, 'File Deleted', 'File name: Assignment 5 (Web Application Development)', 2, '2024-09-05 12:53:28'),
(770, 'File Deleted', 'File name:  (Web Application Development)', 2, '2024-09-05 12:53:31'),
(771, 'File Deleted', 'File name: 617835215_n', 2, '2024-09-05 12:53:34'),
(772, 'File Deleted', 'File name: nt 5 (Web Application Development)', 2, '2024-09-05 12:53:38'),
(773, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 12:58:19'),
(774, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-09-05 13:02:42'),
(775, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-09-05 13:02:50'),
(776, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 13:04:50'),
(777, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-09-05 13:05:12'),
(778, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-09-05 13:05:25'),
(779, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-05 13:05:31'),
(780, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 13:20:16'),
(781, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-05 13:22:04'),
(782, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 13:22:08'),
(783, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-05 13:22:20'),
(784, 'File Renamed', 'Old name: 415945709_1103847357506482_449857628865336633_n, New name: 7506482_449857628865336633_n', 2, '2024-09-05 13:22:23'),
(785, 'File Renamed', 'Old name: 7506482_449857628865336633_n, New name: 7506482_449857628865336633_n', 2, '2024-09-05 13:22:23'),
(786, 'File Deleted', 'File name: 7506482_449857628865336633_n', 2, '2024-09-05 13:22:32'),
(787, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-05 13:23:34'),
(788, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-05 13:23:40'),
(789, 'Folder Updated', 'Folder name: อัครพล', 2, '2024-09-05 13:23:48'),
(790, 'Folder Created', 'Folder name: อัครพลหก', 2, '2024-09-05 13:27:19'),
(791, 'Folder Updated', 'Folder name: อัครพลหก', 2, '2024-09-05 13:27:23'),
(792, 'Folder Updated', 'Folder name: ', 2, '2024-09-05 13:27:31'),
(793, 'Folder Updated', 'Folder name: อัครพลหก', 2, '2024-09-05 13:27:39'),
(794, 'Folder Deleted', 'Folder name: อัครพลหก', 2, '2024-09-05 13:28:58'),
(795, 'Folder Created', 'Folder name: 1233', 2, '2024-09-05 13:44:30'),
(796, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-05 13:44:30'),
(797, 'File Uploaded', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-05 13:44:30'),
(798, 'Folder Created', 'Folder name: 12334', 2, '2024-09-05 13:46:24'),
(799, 'File Uploaded', 'File name: 415945709_1103847357506482_449857628865336633_n', 2, '2024-09-05 13:46:24'),
(800, 'File Uploaded', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-05 13:46:24'),
(801, 'Folder Created', 'Folder name: 1233232', 2, '2024-09-05 13:55:27'),
(802, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-05 13:55:27'),
(803, 'File Uploaded', 'File name: asdasdsad', 2, '2024-09-05 13:55:27'),
(804, 'File Uploaded', 'File name: icon', 2, '2024-09-05 13:55:27'),
(805, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔หหห๐๑๒๙_1', 2, '2024-09-05 13:55:27'),
(806, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔๐๑๒๘_1', 2, '2024-09-05 13:55:27'),
(807, 'File Uploaded', 'File name: จินเบ', 2, '2024-09-05 13:55:27'),
(808, 'File Uploaded', 'File name: ปิดออเดอร์', 2, '2024-09-05 13:55:27'),
(809, 'Folder Deleted', 'Folder name: 1233232', 2, '2024-09-05 13:59:38'),
(810, 'Folder Deleted', 'Folder name: 12334', 2, '2024-09-05 13:59:45'),
(811, 'Folder Deleted', 'Folder name: 1233', 2, '2024-09-05 13:59:48'),
(812, 'Folder Created', 'Folder name: 12', 2, '2024-09-05 14:03:41'),
(813, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-05 14:03:41'),
(814, 'File Uploaded', 'File name: asdasdsad', 2, '2024-09-05 14:03:41'),
(815, 'File Uploaded', 'File name: icon', 2, '2024-09-05 14:03:41'),
(816, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔หหห๐๑๒๙_1', 2, '2024-09-05 14:03:41'),
(817, 'Folder Deleted', 'Folder name: 12', 2, '2024-09-05 14:22:06'),
(818, 'Folder Created', 'Folder name: 123', 2, '2024-09-05 17:59:38'),
(819, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-05 17:59:38'),
(820, 'File Uploaded', 'File name: asdasdsad', 2, '2024-09-05 17:59:38'),
(821, 'File Uploaded', 'File name: icon', 2, '2024-09-05 17:59:38'),
(822, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔หหห๐๑๒๙_1', 2, '2024-09-05 17:59:38'),
(823, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔๐๑๒๘_1', 2, '2024-09-05 17:59:38'),
(824, 'File Uploaded', 'File name: จินเบ', 2, '2024-09-05 17:59:38'),
(825, 'File Uploaded', 'File name: ปิดออเดอร์', 2, '2024-09-05 17:59:38'),
(826, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-05 18:24:48'),
(827, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-05 18:24:55'),
(828, 'Bill Deleted', 'Bill ID: PS2567/001, Company: FBH', 2, '2024-09-05 18:48:31'),
(829, 'Bill Created', 'Bill ID: PS2567/001, Total Amount: 1754.38', 2, '2024-09-05 18:48:48'),
(830, 'Bill Created', 'Bill ID: PSNK/MIXED/67/001, Total Amount: 8252', 2, '2024-09-05 18:56:16'),
(831, 'Folder Deleted', 'Folder name: 123', 2, '2024-09-05 19:19:12'),
(832, 'File Deleted', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-05 19:19:18'),
(833, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-07 18:30:26'),
(834, 'Drum Updated', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-09-07 18:30:29'),
(835, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-07 18:30:34'),
(836, 'Folder Created', 'Folder name: 1', 2, '2024-09-07 18:32:44'),
(837, 'File Uploaded', 'File name: icon', 2, '2024-09-07 18:32:44'),
(838, 'Folder Deleted', 'Folder name: 1', 2, '2024-09-07 18:32:47'),
(839, 'Cable Updated', 'Cable ID: , Route: , Section: , Used: 0', 2, '2024-09-07 18:49:21'),
(840, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-07 18:49:46'),
(841, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-07 18:51:47'),
(842, 'Reset Password', 'User : admin3', 29, '2024-09-07 18:57:55'),
(843, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-09-07 18:59:18'),
(844, 'Cable Inserted', 'Cable ID: 14, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 1', 2, '2024-09-07 19:19:23'),
(845, 'Drum Updated', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-09-07 19:20:42'),
(846, 'Bill Created', 'Bill ID: PSNK/MIXED/67/002, Total Amount: 33', 2, '2024-09-07 19:45:52'),
(847, 'Bill Created', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 1521.44', 2, '2024-09-07 19:46:21'),
(848, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 1521.44', 2, '2024-09-08 14:44:07'),
(849, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/001, Total Amount: 8252', 2, '2024-09-08 14:44:09'),
(850, 'Bill Updated', 'Bill ID: PS2567/001, Total Amount: 1754.38', 2, '2024-09-08 14:44:12'),
(851, 'Drum Updated', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-09-08 14:45:06'),
(852, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-08 14:45:09'),
(853, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 1521.44', 2, '2024-09-08 14:45:12'),
(854, 'User Updated', 'User ID: 29, Username: admin3, Level: 3, Status: 1', 2, '2024-09-08 14:48:28'),
(855, 'Cable Updated', 'Cable ID: 13, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 950', 2, '2024-09-08 14:48:34'),
(856, 'Drum Updated', 'Drum ID: 8, Drum No: 0062, Company: Mixed, Cable Company: FUTONG', 2, '2024-09-08 14:48:38'),
(857, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 14:48:51'),
(858, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 14:49:01'),
(859, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 14:49:06'),
(860, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 14:51:56'),
(861, 'File Uploaded', 'File name: test', 2, '2024-09-08 14:52:06'),
(862, 'File Renamed', 'Old name: test, New name: testsdsd', 2, '2024-09-08 14:52:10'),
(863, 'File Renamed', 'Old name: testsdsd, New name: testsdsd', 2, '2024-09-08 14:52:10'),
(864, 'File Renamed', 'Old name: testsdsd, New name: test', 2, '2024-09-08 14:52:14'),
(865, 'File Renamed', 'Old name: test, New name: test', 2, '2024-09-08 14:52:14'),
(866, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 14:52:33'),
(867, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:00:58'),
(868, 'File Renamed', 'Old name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L, New name: 25a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:03:31'),
(869, 'File Renamed', 'Old name: 25a8336173_800x0xcover_lx5UkK5L, New name: 25a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:03:31'),
(870, 'File Renamed', 'Old name: 25a8336173_800x0xcover_lx5UkK5L, New name: 25a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:03:31'),
(871, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 15:03:42'),
(872, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:03:50'),
(873, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 15:08:09'),
(874, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 15:20:12'),
(875, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 15:45:35'),
(876, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 15:48:29'),
(877, 'File Uploaded', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-08 15:49:37'),
(878, 'File Deleted', 'File name: 25a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:49:53'),
(879, 'File Deleted', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 15:49:59'),
(880, 'File Deleted', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 15:50:04'),
(881, 'File Deleted', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 15:50:07'),
(882, 'File Deleted', 'File name: Screenshot 2024-04-05 182619', 2, '2024-09-08 15:50:10'),
(883, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 15:50:14'),
(884, 'File Uploaded', 'File name: จินเบ', 2, '2024-09-08 15:50:28'),
(885, 'File Renamed', 'Old name: จินเบ, New name: aasd', 2, '2024-09-08 15:50:39'),
(886, 'File Renamed', 'Old name: aasd, New name: aasd', 2, '2024-09-08 15:50:39'),
(887, 'File Renamed', 'Old name: aasd, New name: aasd', 2, '2024-09-08 15:50:39'),
(888, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 15:50:51'),
(889, 'File Uploaded', 'File name: icon', 2, '2024-09-08 15:50:57'),
(890, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:52:01'),
(891, 'File Uploaded', 'File name: LINE_ALBUM_Meme_๒๔หหห๐๑๒๙_1', 2, '2024-09-08 15:52:16'),
(892, 'File Deleted', 'File name: aasd', 2, '2024-09-08 15:56:24'),
(893, 'File Deleted', 'File name: icon', 2, '2024-09-08 15:56:32'),
(894, 'File Deleted', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:56:38'),
(895, 'File Deleted', 'File name: LINE_ALBUM_Meme_๒๔หหห๐๑๒๙_1', 2, '2024-09-08 15:56:43'),
(896, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:56:51'),
(897, 'File Deleted', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:56:54'),
(898, 'File Uploaded', 'File name: asdasdsad', 2, '2024-09-08 15:57:06'),
(899, 'File Renamed', 'Old name: asdasdsad, New name: dsad', 2, '2024-09-08 15:57:09'),
(900, 'File Renamed', 'Old name: dsad, New name: dsad', 2, '2024-09-08 15:57:09'),
(901, 'File Renamed', 'Old name: dsad, New name: dsa56565', 2, '2024-09-08 15:57:17'),
(902, 'File Renamed', 'Old name: dsa56565, New name: dsa56565', 2, '2024-09-08 15:57:17'),
(903, 'File Renamed', 'Old name: dsa56565, New name: 1', 2, '2024-09-08 15:57:40'),
(904, 'File Renamed', 'Old name: 1, New name: 1', 2, '2024-09-08 15:57:40'),
(905, 'File Deleted', 'File name: 1', 2, '2024-09-08 15:57:46'),
(906, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 15:57:51'),
(907, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 15:58:45'),
(908, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:58:51'),
(909, 'File Renamed', 'Old name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L, New name: 336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:58:59'),
(910, 'File Renamed', 'Old name: 336173_800x0xcover_lx5UkK5L, New name: 336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:58:59'),
(911, 'File Deleted', 'File name: 336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 15:59:03'),
(912, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 16:00:17'),
(913, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 16:05:52'),
(914, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 16:06:00'),
(915, 'Folder Updated', 'Folder name: อัค', 2, '2024-09-08 16:06:14'),
(916, 'File Uploaded', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 16:06:22'),
(917, 'File Deleted', 'File name: 61d580b1a973b025a8336173_800x0xcover_lx5UkK5L', 2, '2024-09-08 16:06:29'),
(918, 'Folder Deleted', 'Folder name: อัค', 2, '2024-09-08 16:09:50'),
(919, 'File Uploaded', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:09:57'),
(920, 'File Deleted', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:10:57'),
(921, 'File Uploaded', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:11:02'),
(922, 'File Deleted', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:15:39'),
(923, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ หม่าล่าใหญ่', 2, '2024-09-08 16:16:30'),
(924, 'File Deleted', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:16:37'),
(925, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ หม่าล่าใหญ่', 2, '2024-09-08 16:16:55'),
(926, 'Folder Created', 'Folder name: อัครพล', 2, '2024-09-08 16:17:30'),
(927, 'Folder Created', 'Folder name: อัครพล22', 2, '2024-09-08 16:17:36'),
(928, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ หม่าล่าใหญ่', 2, '2024-09-08 16:18:12'),
(929, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ หม่าล่าใหญ่ ||1', 2, '2024-09-08 16:18:20'),
(930, 'File Deleted', 'File name: หม่าล่าใหญ่ ||1', 2, '2024-09-08 16:18:35'),
(931, 'File Deleted', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:18:37'),
(932, 'File Deleted', 'File name: หม่าล่าใหญ่', 2, '2024-09-08 16:18:40'),
(933, 'Folder Deleted', 'Folder name: อัครพล22', 2, '2024-09-08 16:18:42'),
(934, 'Folder Deleted', 'Folder name: อัครพล', 2, '2024-09-08 16:18:43'),
(935, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-09-08 16:21:05'),
(936, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:21:05'),
(937, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:21:05'),
(938, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:21:05'),
(939, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:21:05'),
(940, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:21:05'),
(941, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:21:05'),
(942, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:21:05'),
(943, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:21:05'),
(944, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:21:05'),
(945, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:21:05'),
(946, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:21:05'),
(947, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:21:05'),
(948, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:21:05'),
(949, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:21:05'),
(950, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:21:05'),
(951, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:21:05'),
(952, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:21:05'),
(953, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:21:05'),
(954, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:21:05'),
(955, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:21:05'),
(956, 'Folder Created', 'Folder name: ฟหกฟหกหหห', 2, '2024-09-08 16:21:13'),
(957, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:21:13'),
(958, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:21:13'),
(959, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:21:13'),
(960, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:21:13'),
(961, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:21:13'),
(962, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:21:13'),
(963, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:21:13'),
(964, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:21:13'),
(965, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:21:13'),
(966, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:21:13'),
(967, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:21:13'),
(968, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:21:13'),
(969, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:21:13'),
(970, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:21:13'),
(971, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:21:13'),
(972, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:21:13'),
(973, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:21:13'),
(974, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:21:13'),
(975, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:21:13'),
(976, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:21:13'),
(977, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-09-08 16:21:25'),
(978, 'Folder Deleted', 'Folder name: ฟหกฟหกหหห', 2, '2024-09-08 16:21:28'),
(979, 'Folder Created', 'Folder name: 123', 2, '2024-09-08 16:26:43'),
(980, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:26:43'),
(981, 'Folder Created', 'Folder name: 1234', 2, '2024-09-08 16:26:57'),
(982, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:26:57'),
(983, 'Folder Created', 'Folder name: ฟหกฟหก', 2, '2024-09-08 16:27:55'),
(984, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:27:55'),
(985, 'Folder Deleted', 'Folder name: ฟหกฟหก', 2, '2024-09-08 16:28:02'),
(986, 'Folder Deleted', 'Folder name: 1234', 2, '2024-09-08 16:28:04'),
(987, 'Folder Deleted', 'Folder name: 123', 2, '2024-09-08 16:28:06'),
(988, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:31:39'),
(989, 'File Deleted', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:32:56'),
(990, 'Folder Created', 'Folder name: 1233', 2, '2024-09-08 16:47:59'),
(991, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:47:59'),
(992, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:47:59'),
(993, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:47:59'),
(994, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:47:59'),
(995, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:47:59'),
(996, 'Folder Deleted', 'Folder name: 1233', 2, '2024-09-08 16:48:14'),
(997, 'Folder Created', 'Folder name: 12333', 2, '2024-09-08 16:53:27'),
(998, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:53:27'),
(999, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:53:27'),
(1000, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:53:27'),
(1001, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:53:27'),
(1002, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:53:27'),
(1003, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:53:27'),
(1004, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:53:27'),
(1005, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:53:27'),
(1006, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:53:27'),
(1007, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:53:27'),
(1008, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:53:27'),
(1009, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:53:27'),
(1010, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:53:27'),
(1011, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:53:27'),
(1012, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:53:27'),
(1013, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:53:27'),
(1014, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:53:27'),
(1015, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:53:27'),
(1016, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:53:27'),
(1017, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:53:27'),
(1018, 'Folder Deleted', 'Folder name: 12333', 2, '2024-09-08 16:53:38'),
(1019, 'Folder Created', 'Folder name: อัครพล กดดกด', 2, '2024-09-08 16:54:08'),
(1020, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:54:08'),
(1021, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:54:08'),
(1022, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:54:08'),
(1023, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:54:08'),
(1024, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:54:08'),
(1025, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:54:08'),
(1026, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:54:08'),
(1027, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:54:08'),
(1028, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:54:08'),
(1029, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:54:08'),
(1030, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:54:08'),
(1031, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:54:08'),
(1032, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:54:08'),
(1033, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:54:08'),
(1034, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:54:08'),
(1035, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:54:08'),
(1036, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:54:08'),
(1037, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:54:08'),
(1038, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:54:08'),
(1039, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:54:08'),
(1040, 'Folder Created', 'Folder name: 123123123', 2, '2024-09-08 16:54:40'),
(1041, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:54:40'),
(1042, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:54:40'),
(1043, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:54:40'),
(1044, 'Folder Deleted', 'Folder name: 123123123', 2, '2024-09-08 16:54:44'),
(1045, 'Folder Deleted', 'Folder name: อัครพล กดดกด', 2, '2024-09-08 16:54:46'),
(1046, 'Folder Created', 'Folder name: หกหดกหดเกดหเหกด', 2, '2024-09-08 16:54:53'),
(1047, 'Folder Created', 'Folder name: หกหดกหดเกดหเหกดฟหกฟหกฟหก', 2, '2024-09-08 16:55:10'),
(1048, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:55:10'),
(1049, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:55:10'),
(1050, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:55:10'),
(1051, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:55:10'),
(1052, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:55:10'),
(1053, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:55:10'),
(1054, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:55:10'),
(1055, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:55:10'),
(1056, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:55:10'),
(1057, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:55:10'),
(1058, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:55:10'),
(1059, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:55:10'),
(1060, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:55:10'),
(1061, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:55:10'),
(1062, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:55:10'),
(1063, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:55:10'),
(1064, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:55:10'),
(1065, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:55:10'),
(1066, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:55:10'),
(1067, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:55:10'),
(1068, 'Folder Created', 'Folder name: ฟหฟฟฟฟฟ', 2, '2024-09-08 16:55:21'),
(1069, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:55:21'),
(1070, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:55:21'),
(1071, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:55:21'),
(1072, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:55:21'),
(1073, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:55:21'),
(1074, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:55:21'),
(1075, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:55:21'),
(1076, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:55:21'),
(1077, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:55:21'),
(1078, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:55:21'),
(1079, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:55:21'),
(1080, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:55:21'),
(1081, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:55:21'),
(1082, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:55:21'),
(1083, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:55:21'),
(1084, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:55:21'),
(1085, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:55:21'),
(1086, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:55:21'),
(1087, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:55:21'),
(1088, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:55:21'),
(1089, 'Folder Created', 'Folder name: ฟ', 2, '2024-09-08 16:55:28'),
(1090, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:55:28'),
(1091, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:55:28'),
(1092, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:55:28'),
(1093, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:55:28'),
(1094, 'Folder Created', 'Folder name: 54564564556', 2, '2024-09-08 16:55:57'),
(1095, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:55:57'),
(1096, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:55:57'),
(1097, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:55:57'),
(1098, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:55:57'),
(1099, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:55:57'),
(1100, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:55:57'),
(1101, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:55:57'),
(1102, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:55:57'),
(1103, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:55:57'),
(1104, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:55:57'),
(1105, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:55:57'),
(1106, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:55:57'),
(1107, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:55:57'),
(1108, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:55:57'),
(1109, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:55:57'),
(1110, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:55:57'),
(1111, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:55:57'),
(1112, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:55:57'),
(1113, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:55:57'),
(1114, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:55:57'),
(1115, 'Folder Created', 'Folder name: หฟกฟหฟฟฟฟหกก', 2, '2024-09-08 16:56:28'),
(1116, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:56:28'),
(1117, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:56:28'),
(1118, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:56:28'),
(1119, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:56:28'),
(1120, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:56:28'),
(1121, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:56:28'),
(1122, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:56:28'),
(1123, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:56:28'),
(1124, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:56:28'),
(1125, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:56:28'),
(1126, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:56:28'),
(1127, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:56:28'),
(1128, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:56:28'),
(1129, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:56:28'),
(1130, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:56:28'),
(1131, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:56:28'),
(1132, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:56:28'),
(1133, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:56:28'),
(1134, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:56:28'),
(1135, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:56:28'),
(1136, 'Folder Created', 'Folder name: หฟกฟหฟฟฟฟหกกฟฟฟหกหก', 2, '2024-09-08 16:56:33'),
(1137, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_1', 2, '2024-09-08 16:56:33'),
(1138, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_2', 2, '2024-09-08 16:56:33'),
(1139, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_3', 2, '2024-09-08 16:56:33'),
(1140, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_4', 2, '2024-09-08 16:56:33'),
(1141, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_5', 2, '2024-09-08 16:56:33'),
(1142, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_6', 2, '2024-09-08 16:56:33'),
(1143, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_7', 2, '2024-09-08 16:56:33'),
(1144, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_8', 2, '2024-09-08 16:56:33'),
(1145, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_9', 2, '2024-09-08 16:56:33'),
(1146, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_10', 2, '2024-09-08 16:56:33'),
(1147, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_11', 2, '2024-09-08 16:56:33'),
(1148, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_12', 2, '2024-09-08 16:56:33'),
(1149, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_13', 2, '2024-09-08 16:56:33'),
(1150, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_14', 2, '2024-09-08 16:56:33'),
(1151, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_15', 2, '2024-09-08 16:56:33'),
(1152, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_16', 2, '2024-09-08 16:56:33'),
(1153, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_17', 2, '2024-09-08 16:56:33'),
(1154, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_18', 2, '2024-09-08 16:56:33'),
(1155, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_19', 2, '2024-09-08 16:56:33'),
(1156, 'File Uploaded', 'File name: LINE_ALBUM_D_LPN0098 คัดก่อนลง_240810_20', 2, '2024-09-08 16:56:33'),
(1157, 'Folder Deleted', 'Folder name: หกหดกหดเกดหเหกด', 2, '2024-09-08 16:56:43'),
(1158, 'Folder Deleted', 'Folder name: หกหดกหดเกดหเหกดฟหกฟหกฟหก', 2, '2024-09-08 16:56:45'),
(1159, 'Folder Deleted', 'Folder name: ฟหฟฟฟฟฟ', 2, '2024-09-08 16:56:47'),
(1160, 'Folder Deleted', 'Folder name: ฟ', 2, '2024-09-08 16:56:50'),
(1161, 'Folder Deleted', 'Folder name: หฟกฟหฟฟฟฟหกก', 2, '2024-09-08 16:56:53'),
(1162, 'Folder Deleted', 'Folder name: 54564564556', 2, '2024-09-08 16:56:55'),
(1163, 'Folder Deleted', 'Folder name: หฟกฟหฟฟฟฟหกกฟฟฟหกหก', 2, '2024-09-08 16:56:57'),
(1164, 'Bill Created', 'Bill ID: PS2567/002, Total Amount: 2924.96', 2, '2024-09-08 17:23:30'),
(1165, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 1521.44', 2, '2024-09-08 18:19:18'),
(1166, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-09-08 18:21:18'),
(1167, 'Folder Created', 'Folder name: โฟลเดอร์1', 2, '2024-09-09 15:18:29'),
(1168, 'Folder Created', 'Folder name: โฟลเดอร์2', 2, '2024-09-09 15:18:37'),
(1169, 'Folder Created', 'Folder name: โฟลเดอร์3', 2, '2024-09-09 15:19:19'),
(1170, 'อัปโหลดไฟล์แล้ว', 'ชื่อไฟล์ Resume', 2, '2024-09-09 15:20:11');

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
(11, 1.00, 1.00, 1.00, 1.00, 4.00, '2567-01-01', 1);

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
  `employee_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passW`, `lv`, `status`, `users_date`, `employee_id`) VALUES
(2, 'admin', '$2y$10$c8vj27z4jfmAEJFl76foR.NWV7ev8Is0zjjeZnVp8VI527nISuh3W', '0', '1', '2024-08-26 22:49:06', 1),
(29, 'admin3', '$2y$10$mzOk5rHixUx5y3f2x0Yt../0em3MP6n6RNliDMuT6HWg/bKZiKs8S', '3', '1', '0000-00-00 00:00:00', 26);

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
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `employee_id` (`employee_id`);

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
  ADD KEY `drum_id` (`drum_id`);

--
-- Indexes for table `drum`
--
ALTER TABLE `drum`
  ADD PRIMARY KEY (`drum_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `folders_id` (`folders_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`folders_id`),
  ADD KEY `fk_user` (`user_id`);

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
-- AUTO_INCREMENT for table `cable`
--
ALTER TABLE `cable`
  MODIFY `cable_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `drum`
--
ALTER TABLE `drum`
  MODIFY `drum_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `folders_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1171;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  ADD CONSTRAINT `bill_detail_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`),
  ADD CONSTRAINT `bill_detail_ibfk_2` FOREIGN KEY (`au_id`) REFERENCES `au_all` (`au_id`);

--
-- Constraints for table `cable`
--
ALTER TABLE `cable`
  ADD CONSTRAINT `cable_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `cable_ibfk_2` FOREIGN KEY (`drum_id`) REFERENCES `drum` (`drum_id`);

--
-- Constraints for table `drum`
--
ALTER TABLE `drum`
  ADD CONSTRAINT `drum_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`folders_id`) REFERENCES `folders` (`folders_id`);

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
