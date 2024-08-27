-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 04:55 PM
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
('PS2567/001', '2567-06-04', '2567-06-04', 'N/A', '2567-06-04', '-', 'LPG3182', '', '', '', 2, 50.35, 3.52, 1.51, 46.83, 'FBH', 0),
('PS2567/002', '2567-06-14', '2567-06-14', 'N/A', '2567-06-14', '-', '', '', '', '', 2, 268.92, 18.82, 8.07, 250.10, 'FBH', 0),
('PS2567/003', '2567-07-04', '2567-07-04', 'N/A', '2567-07-04', '-', 'LPG3182', '', '', '', 5, 319.42, 22.36, 9.58, 297.06, 'FBH', 0),
('PSNK/MIXED/67/001', '2567-06-04', '2567-06-04', 'N/A', '2567-06-04', '-', 'LPG3182', '', '', '', 16, 16763.20, 1173.42, 502.90, 15589.78, 'Mixed', 0),
('PSNK/MIXED/67/002', '2567-07-04', '2567-07-16', 'N/A', '2567-07-17', '-', '', '', '', '', 4, 273.60, 19.15, 8.21, 254.45, 'mixed', 0);

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
('PS2567/001', 'SM13075-0100020001-TH', 5, 45.35),
('PS2567/001', 'SM13075-0100320006-TH', 5, 5.00),
('PS2567/002', 'SM13075-0100100001-TH', 2, 267.76),
('PS2567/002', 'SM13075-0100190001-TH', 2, 1.16),
('PS2567/003', 'SM13075-0100020001-TH', 2, 18.14),
('PS2567/003', 'SM13075-0100020002-TH', 2, 23.52),
('PS2567/003', 'SM13075-0100090002-TH', 2, 4.00),
('PS2567/003', 'SM13075-0100090004-TH', 2, 6.00),
('PS2567/003', 'SM13075-0100100002-TH', 2, 267.76),
('PSNK/MIXED/67/001', 'Mix-TD-17.85', 5, 25.00),
('PSNK/MIXED/67/001', 'TPCHDMX001C', 5, 792.00),
('PSNK/MIXED/67/001', 'TPCHDMX003C', 3, 6.00),
('PSNK/MIXED/67/001', 'TPCHDMX004C', 4, 8.80),
('PSNK/MIXED/67/001', 'TPCHDMX005C', 5, 25.20),
('PSNK/MIXED/67/001', 'TPCHDMX006C', 2, 22.00),
('PSNK/MIXED/67/001', 'TPCHDMX009C', 5, 25.20),
('PSNK/MIXED/67/001', 'TPCHDMX010C', 2, 547.20),
('PSNK/MIXED/67/001', 'TPCHDMX011C', 4, 1680.00),
('PSNK/MIXED/67/001', 'TPCHDMX013C', 5, 2476.80),
('PSNK/MIXED/67/001', 'TPCHDMX014C', 5, 4200.00),
('PSNK/MIXED/67/001', 'TPCHDMX015C', 5, 3780.00),
('PSNK/MIXED/67/001', 'TPCHDMX018C', 5, 5.00),
('PSNK/MIXED/67/001', 'TPCHDMX021C', 2, 1224.00),
('PSNK/MIXED/67/001', 'TPCHDMX023C', 2, 2.00),
('PSNK/MIXED/67/001', 'TPCHDMX025C', 2, 1944.00),
('PSNK/MIXED/67/002', 'Mix-TD-17.85', 10, 50.00),
('PSNK/MIXED/67/002', 'TPCHDMX005C', 30, 151.20),
('PSNK/MIXED/67/002', 'TPCHDMX008C', 10, 22.00),
('PSNK/MIXED/67/002', 'TPCHDMX009C', 10, 50.40);

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
(69, 'U2211148 เชียงใหม่', 'CMI01X39ECQ - L2 NEW', 'ดุ่ย', 120, 20, 100, '2024-08-04 16:20:03', 1, 1, 'Mixed'),
(70, 'U2211148 เชียงใหม่', 'CMI01X39ECQ - L2 NEW', 'ดุ่ย', 1000, 100, 900, '2024-08-04 20:40:52', 1, 1, 'Mixed');

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
(1, '0062', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 3000, 'FBH', 'FUTONG', 1000, '2024-08-05 10:45:36', 0),
(2, '0012', 'DNWK-TR20220914-7', 'OFC,MINI ADSS CABLE 12 CORES,2 FR,TNE-NS', 4000, 4000, 'FBH', 'FIBERHOME', 0, '2024-08-04 17:49:00', 0);

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
(13, 'Oakkharaphon', 'Kanthiya', 20, '0927131610', 'bollboll41@gmail.com', 0, 1, '2024-08-01 20:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `files_id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(4) NOT NULL,
  `folder_id` int(5) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `files_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`files_id`, `name`, `description`, `user_id`, `folder_id`, `file_type`, `file_path`, `is_public`, `files_date`) VALUES
(79, 'FM-BIS-10_แบบบันทึกรายละเอียดการเข้าพบอาจารย์ที่ปรึกษา', 'หฟกฟหกasd', 2, 0, 'pdf', '1720880280_FM-BIS-10_แบบบันทึกรายละเอียดการเข้าพบอาจารย์ที่ปรึกษา.pdf', 1, '2024-07-13 21:18:19'),
(86, 'ประเทศฟิลิปปินส์-1 (1)', '', 2, 49, 'docx', '1722757560_ประเทศฟิลิปปินส์-1 (1).docx', 0, '2024-08-04 14:46:54'),
(106, 'checkuser1', '', 2, 65, 'php', '1724658300_checkuser.php', 0, '2024-08-26 14:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `folders_id` int(5) NOT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT 0,
  `folder_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`folders_id`, `user_id`, `name`, `parent_id`, `folder_date`) VALUES
(28, 2, 'PSNK+++++', 0, '2024-08-18 14:24:36'),
(29, 2, 'เอกสาร บปช', 0, '2024-08-04 17:12:24'),
(32, 2, 'เอกสาร PSNK', 0, '2024-08-04 17:12:24'),
(42, 2, 'asdasd', 0, '2024-08-04 17:12:24'),
(43, 2, 'asdasdsaddsa', 0, '2024-08-04 17:12:24'),
(44, 2, 'asdasddd', 0, '2024-08-04 17:12:24'),
(45, 2, 'asdasdsa', 0, '2024-08-04 17:12:24'),
(46, 2, 'asdasdasd', 0, '2024-08-04 17:12:24'),
(47, 2, 'asdasdasaaaad', 0, '2024-08-04 17:12:24'),
(50, 2, 'ssssssssssssssssssssssssssssssssssssssssssssaaaaa', 0, '2024-08-20 14:47:30'),
(54, 2, 'sssssssss', 0, '2024-08-04 17:12:24'),
(61, 2, 'ddd', 0, '2024-08-04 17:12:24'),
(63, 2, 'Oakkharaphons', 0, '2024-08-04 17:12:24'),
(65, 2, 'sdasd', 0, '2024-08-04 17:12:24'),
(66, 2, 'daaa', 0, '2024-08-04 17:12:24'),
(74, 2, 'ฟหกฟหกหฟก', 0, '2024-08-18 15:04:37'),
(75, 2, 'ฟหฟฟฟฟฟ', 0, '2024-08-18 15:04:41'),
(76, 2, 'ไไไไไไไsdsd', 0, '2024-08-20 14:47:15'),
(79, 2, '12222', 0, '2024-08-26 17:21:39'),
(80, 2, 'า่า่าส', 0, '2024-08-26 17:21:46');

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
(1, 'Folder Deleted', 'Folder name: aaaaaaaaaaaaaaaaaa', 2, '2024-08-04 15:21:32'),
(2, 'Folder Created', 'Folder name: Oakkharaphon', 2, '2024-08-04 15:21:32'),
(3, 'Folder Deleted', 'Folder name: Oakkharaphon', 2, '2024-08-04 15:21:32'),
(4, 'Bill Created', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 10', 2, '2024-08-04 15:34:56'),
(5, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 14.4', 2, '2024-08-04 15:34:58'),
(6, 'Bill Deleted', 'Bill ID: PSNK/MIXED/67/003, Company: mixed', 2, '2024-08-04 15:34:59'),
(7, 'Cable Inserted', 'Cable ID: , Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 80', 2, '2024-08-04 15:26:32'),
(8, 'Folder Deleted', 'Folder name: f', 2, '2024-08-04 15:45:17'),
(10, 'Cable Inserted', 'Cable ID: , Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 80', 2, '2024-08-04 16:08:12'),
(11, 'Cable Deleted', 'Cable ID: 66, Route: , Section: , Used: ', 2, '2024-08-04 16:09:06'),
(12, 'Cable Inserted', 'Cable ID: , Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 80', 2, '2024-08-04 16:11:04'),
(13, 'Cable Deleted', 'Cable ID: 62, Route: , Section: , Used: ', 2, '2024-08-04 16:11:17'),
(14, 'Cable Deleted', 'Cable ID: 67, Route: , Section: , Used: ', 2, '2024-08-04 16:11:55'),
(15, 'Cable Inserted', 'Cable ID: , Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 5', 2, '2024-08-04 16:16:00'),
(16, 'Cable Deleted', 'Cable ID: 68, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 5', 2, '2024-08-04 16:17:28'),
(17, 'Cable Inserted', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 16:20:03'),
(18, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 16:20:32'),
(19, 'File Updated', 'File ID: 79', 2, '2024-08-04 16:39:04'),
(20, 'File Uploaded', 'File name: maxresdefault (2)', 2, '2024-08-04 16:40:31'),
(21, 'File Deleted', 'File name: maxresdefault (2)', 2, '2024-08-04 16:54:43'),
(22, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-04 17:19:41'),
(23, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:41:58'),
(24, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:43:40'),
(25, 'Drum Updated', 'Drum ID: 2, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:43:59'),
(26, 'Drum Updated', 'Drum ID: 2, Drum No: 0012, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-04 17:44:13'),
(27, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:45:30'),
(28, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:45:58'),
(29, 'Drum Updated', 'Drum ID: 2, Drum No: 0012, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-04 17:48:40'),
(30, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 17:48:42'),
(31, 'Drum Updated', 'Drum ID: 2, Drum No: 0062, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-04 17:48:50'),
(32, 'Drum Updated', 'Drum ID: 2, Drum No: 0012, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-04 17:49:00'),
(33, 'Folder Deleted', 'Folder name: asdas', 2, '2024-08-04 17:50:58'),
(34, 'Folder Deleted', 'Folder name: ', 2, '2024-08-04 17:50:59'),
(35, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 20:10:15'),
(36, 'Drum Inserted', 'Drum No: 0111, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:13:22'),
(37, 'Drum Updated', 'Drum ID: 29, Drum No: 0111, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:13:53'),
(38, 'Drum Deleted', 'Drum No: , Company: , Cable Company: ', 2, '2024-08-04 20:15:03'),
(39, 'Drum Inserted', 'Drum ID: Drum No: 0111, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:15:18'),
(40, 'Drum Deleted', 'Drum No: , Company: , Cable Company: ', 2, '2024-08-04 20:16:19'),
(41, 'Drum Inserted', 'Drum ID: 31Drum No: 0111, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:16:26'),
(42, 'Drum Deleted', 'Drum ID: 31, Drum No: , Company: , Cable Company: ', 2, '2024-08-04 20:20:04'),
(43, 'Drum Inserted', 'Drum ID: 32, Drum No: 0062, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:23:39'),
(44, 'Drum Deleted', 'Drum ID: 32, Drum No: 0062, Company: FIBERHOME, Cable Company: FUTONG', 2, '2024-08-04 20:23:47'),
(45, 'User Created', 'Username: admin3, Employee Name: Oakkharaphon Kanthiya, Position: 0', 2, '2024-08-04 20:32:10'),
(46, 'User Updated', 'User ID: 20, Username: admin3, Level: 0, Status: 1', 2, '2024-08-04 20:32:38'),
(47, 'User Deleted', 'User ID: 20, Employee ID: 16', 2, '2024-08-04 20:32:54'),
(48, 'Bill Created', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 10', 2, '2024-08-04 20:38:32'),
(49, 'Bill Updated', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 10', 2, '2024-08-04 20:39:59'),
(50, 'Bill Updated', 'Bill ID: PS2567/003, Total Amount: 319.42', 2, '2024-08-04 20:40:07'),
(51, 'Cable Inserted', 'Cable ID: 70, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 900', 2, '2024-08-04 20:40:52'),
(52, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 20:41:00'),
(53, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-04 20:41:09'),
(54, 'File Uploaded', 'File name: 0383', 2, '2024-08-04 20:42:27'),
(55, 'File Deleted', 'File name: 0383', 2, '2024-08-04 20:45:32'),
(56, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:24'),
(57, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:24'),
(58, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:25'),
(59, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:26'),
(60, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:26'),
(61, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:27'),
(62, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:28'),
(63, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:29'),
(64, 'Cable Updated', 'Cable ID: 69, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 100', 2, '2024-08-04 21:21:30'),
(65, 'Drum Updated', 'Drum ID: 2, Drum No: 0012, Company: FBH, Cable Company: FIBERHOME', 2, '2024-08-04 21:21:47'),
(66, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:48'),
(67, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:49'),
(68, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:50'),
(69, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:51'),
(70, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:52'),
(71, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:53'),
(72, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:54'),
(73, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:55'),
(74, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:56'),
(75, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:57'),
(76, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:58'),
(77, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:21:59'),
(78, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:22:01'),
(79, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:14'),
(80, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:15'),
(81, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:16'),
(82, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:17'),
(83, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:18'),
(84, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:19'),
(85, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:20'),
(86, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:20'),
(87, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:21'),
(88, 'Employee Updated', 'Updated employee ID: 13, Name: Oakkharaphon Kanthiya', 2, '2024-08-04 21:22:22'),
(89, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-04 21:22:28'),
(90, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-04 21:22:29'),
(91, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-04 21:22:29'),
(92, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-04 21:22:30'),
(93, 'Drum Updated', 'Drum ID: 1, Drum No: 0062, Company: FBH, Cable Company: FUTONG', 2, '2024-08-04 21:27:36'),
(94, 'File Uploaded', 'File name: maxresdefault (2)', 2, '2024-08-04 21:53:32'),
(95, 'File Deleted', 'File name: maxresdefault (2)', 2, '2024-08-04 21:53:35'),
(96, 'Bill Deleted', 'Bill ID: PSNK/MIXED/67/003, Company: mixed', 2, '2024-08-05 10:43:19'),
(97, 'Cable Inserted', 'Cable ID: 71, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 120', 2, '2024-08-05 10:43:47'),
(98, 'Cable Deleted', 'Cable ID: 71, Route: U2211148 เชียงใหม่, Section: CMI01X39ECQ - L2 NEW, Used: 120', 2, '2024-08-05 10:45:36'),
(99, 'File Uploaded', 'File name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-05 14:24:07'),
(100, 'File Uploaded', 'File name: checkuser', 2, '2024-08-15 18:14:00'),
(101, 'File Uploaded', 'File name: login', 2, '2024-08-15 18:14:00'),
(102, 'File Deleted', 'File name: checkuser', 2, '2024-08-15 18:14:08'),
(103, 'File Deleted', 'File name: login', 2, '2024-08-15 18:14:12'),
(104, 'File Uploaded', 'File name: 1721901011194', 2, '2024-08-15 18:14:27'),
(105, 'File Uploaded', 'File name: 20240719061503_page-0001', 2, '2024-08-15 18:14:27'),
(106, 'File Uploaded', 'File name: checkuser', 2, '2024-08-15 18:14:44'),
(107, 'File Uploaded', 'File name: login', 2, '2024-08-15 18:14:44'),
(108, 'File Deleted', 'File name: checkuser', 2, '2024-08-15 18:14:52'),
(109, 'File Deleted', 'File name: login', 2, '2024-08-15 18:14:58'),
(110, 'File Deleted', 'File name: 20240719061503_page-0001', 2, '2024-08-15 19:36:43'),
(111, 'File Deleted', 'File name: 1721901011194', 2, '2024-08-15 19:36:50'),
(112, 'File Updated', 'File ID: 79', 2, '2024-08-15 20:00:28'),
(113, 'File Uploaded', 'File name: checkuser', 2, '2024-08-15 20:00:40'),
(114, 'File Uploaded', 'File name: login', 2, '2024-08-15 20:00:40'),
(115, 'File Updated', 'File ID: 98', 2, '2024-08-15 20:00:58'),
(116, 'File Deleted', 'File name: checkuser', 2, '2024-08-15 20:01:04'),
(117, 'File Deleted', 'File name: ', 2, '2024-08-15 20:01:05'),
(118, 'File Deleted', 'File name: login', 2, '2024-08-15 20:01:11'),
(119, 'File Deleted', 'File name: 451865270_2294336704245096_2755956675318857470_n', 2, '2024-08-15 20:43:18'),
(120, 'Folder Created', 'Folder name: Oakkharaphon', 2, '2024-08-15 20:52:12'),
(121, 'Folder Deleted', 'Folder name: Oakkharaphon', 2, '2024-08-15 20:52:16'),
(122, 'Folder Deleted', 'Folder name: ffff', 2, '2024-08-18 14:10:49'),
(123, 'File Updated', 'File ID: 79', 2, '2024-08-18 14:23:14'),
(124, 'Folder Updated', 'Folder name: ssss', 2, '2024-08-18 14:24:07'),
(125, 'Folder Updated', 'Folder name: PSNK++++++', 2, '2024-08-18 14:24:22'),
(126, 'Folder Updated', 'Folder name: PSNK+++++', 2, '2024-08-18 14:24:36'),
(127, 'Folder Deleted', 'Folder name: fff', 2, '2024-08-18 15:00:24'),
(128, 'Folder Deleted', 'Folder name: ffffffffffffffff', 2, '2024-08-18 15:00:28'),
(129, 'Folder Deleted', 'Folder name: fffffffff', 2, '2024-08-18 15:00:32'),
(130, 'Folder Deleted', 'Folder name: sdddsa', 2, '2024-08-18 15:00:36'),
(131, 'Folder Updated', 'Folder name: asdsdกกกก', 2, '2024-08-18 15:00:44'),
(132, 'File Uploaded', 'File name: 20240719061503_page-0001', 2, '2024-08-18 15:02:02'),
(133, 'File Deleted', 'File name: 20240719061503_page-0001', 2, '2024-08-18 15:02:16'),
(134, 'Folder Deleted', 'Folder name: asdsdกกกก', 2, '2024-08-18 15:02:50'),
(135, 'Folder Deleted', 'Folder name: ssss', 2, '2024-08-18 15:02:59'),
(136, 'Folder Deleted', 'Folder name: sssssss', 2, '2024-08-18 15:03:13'),
(137, 'Folder Deleted', 'Folder name: wwwwwwwwwwwww', 2, '2024-08-18 15:03:27'),
(138, 'Folder Deleted', 'Folder name: asdasdddd', 2, '2024-08-18 15:03:57'),
(139, 'Folder Deleted', 'Folder name: dddd', 2, '2024-08-18 15:04:27'),
(140, 'Folder Created', 'Folder name: ฟหกฟหกหฟก', 2, '2024-08-18 15:04:37'),
(141, 'Folder Created', 'Folder name: ฟหฟฟฟฟฟ', 2, '2024-08-18 15:04:41'),
(142, 'Folder Created', 'Folder name: ไไไไไไไ', 2, '2024-08-18 15:04:45'),
(143, 'File Renamed', 'New name: FM-BIS-10_แบบบันทึกรายละเอียดการเข้าพบอาจารย์ที่ปรึกษา', 2, '2024-08-18 16:29:52'),
(144, 'File Renamed', 'New name: FM-BIS-10_แบบบันทึกรายละเอียดการเข้าพบอาจารย์ที่ปรึกษา', 2, '2024-08-18 16:31:09'),
(145, 'Folder Deleted', 'Folder name: dddddddddddd', 2, '2024-08-19 20:38:42'),
(146, 'Folder Updated', 'Folder name: ไไไไไไไsdsd', 2, '2024-08-20 14:47:15'),
(147, 'File Renamed', 'New name: FM-BIS-10_แบบบันทึกรายละเอียดการเข้าพบอาจารย์ที่ปรึกษา', 2, '2024-08-20 14:47:22'),
(148, 'Folder Updated', 'Folder name: ssssssssssssssssssssssssssssssssssssssssssssaaaaa', 2, '2024-08-20 14:47:30'),
(149, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:43:34'),
(150, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:50:55'),
(151, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:51:02'),
(152, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:51:11'),
(153, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:51:17'),
(154, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:54:30'),
(155, 'Employee Updated', 'Updated employee ID: 1, Name: นุ๊ก นุ๊ก', 2, '2024-08-20 15:54:33'),
(156, 'Folder Created', 'Folder name: ฟฟฟฟฟ', 2, '2024-08-20 16:56:24'),
(157, 'File Uploaded', 'File name: 20240719061503_page-0001', 2, '2024-08-20 16:56:38'),
(158, 'File Updated', 'File ID: 101', 2, '2024-08-20 16:56:51'),
(159, 'File Deleted', 'File name: 20240719061503_page-0001', 2, '2024-08-20 16:57:00'),
(160, 'Folder Deleted', 'Folder name: ฟฟฟฟฟ', 2, '2024-08-20 16:57:02'),
(161, 'Folder Created', 'Folder name: Oakkharaphon', 19, '2024-08-20 18:35:37'),
(162, 'Folder Deleted', 'Folder name: Oakkharaphon', 19, '2024-08-20 18:35:44'),
(163, 'File Uploaded', 'File name: asdaaa', 19, '2024-08-20 18:35:57'),
(164, 'File Uploaded', 'File name: asdasd', 19, '2024-08-20 18:35:57'),
(165, 'File Uploaded', 'File name: ca45a47f-0146-411d-9823-a92f27bddf04', 19, '2024-08-20 18:35:57'),
(166, 'File Uploaded', 'File name: ca45a47f-0146-411d-9823-a92f27bddf04', 19, '2024-08-20 18:35:57'),
(167, 'File Deleted', 'File name: asdaaa', 19, '2024-08-20 18:35:59'),
(168, 'File Deleted', 'File name: asdasd', 19, '2024-08-20 18:36:01'),
(169, 'File Deleted', 'File name: ca45a47f-0146-411d-9823-a92f27bddf04', 19, '2024-08-20 18:36:12'),
(170, 'File Deleted', 'File name: ca45a47f-0146-411d-9823-a92f27bddf04', 19, '2024-08-20 18:36:14'),
(171, 'Folder Deleted', 'Folder name: dddaa', 2, '2024-08-22 09:33:20'),
(172, 'Reset Password', 'User : admin2', 19, '2024-08-22 20:58:39'),
(173, 'User Updated', 'User ID: 19, Username: admin2, Level: , Status: 0', 2, '2024-08-22 21:41:50'),
(174, 'User Updated', 'User ID: 19, Username: admin2, Level: , Status: 1', 2, '2024-08-22 21:42:15'),
(175, 'Reset Password', 'User : admin2', 19, '2024-08-22 21:42:55'),
(176, 'Salary Created', 'User ID: , Employee ID: 1', 2, '2024-08-23 19:42:23'),
(177, 'Bill Created', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 17', 2, '2024-08-24 15:26:47'),
(178, 'Bill Deleted', 'Bill ID: PSNK/MIXED/67/003, Company: mixed', 2, '2024-08-24 15:27:11'),
(179, 'Bill Created', 'Bill ID: PSNK/MIXED/67/003, Total Amount: 1512', 2, '2024-08-24 20:46:51'),
(180, 'Bill Deleted', 'Bill ID: PSNK/MIXED/67/003, Company: mixed', 2, '2024-08-24 20:47:01'),
(181, 'Salary Deleted', 'Salary ID: 12', 2, '2024-08-24 21:49:02'),
(182, 'Salary Created', 'User ID: , Employee ID: 1', 2, '2024-08-24 22:38:31'),
(183, 'Salary Updated', 'User ID: 1', 2, '2024-08-25 11:04:41'),
(184, 'Salary Updated', 'User ID: 1', 2, '2024-08-25 11:04:51'),
(185, 'Salary Created', 'Salary ID: 14', 2, '2024-08-25 11:07:16'),
(186, 'Salary Created', 'Salary ID: 15', 2, '2024-08-25 11:07:23'),
(187, 'Salary Deleted', 'Salary ID: 15', 2, '2024-08-25 11:08:21'),
(188, 'Reset Password', 'User : admin2', 19, '2024-08-26 14:29:14'),
(189, 'Salary Created', 'Salary ID: 16', 2, '2024-08-26 14:31:29'),
(190, 'File Uploaded', 'File name: checkuser', 2, '2024-08-26 14:45:51'),
(191, 'File Renamed', 'New name: checkuser1', 2, '2024-08-26 14:46:05'),
(192, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:06:28'),
(193, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:11:04'),
(194, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:51:00'),
(195, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:53:20'),
(196, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:54:20'),
(197, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:57:14'),
(198, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:57:17'),
(199, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:57:51'),
(200, 'Reset Password', 'User : admin2', 19, '2024-08-26 16:58:19'),
(201, 'Reset Password', 'User : admin2', 19, '2024-08-26 17:04:01'),
(202, 'Reset Password', 'User : admin2', 19, '2024-08-26 17:13:37'),
(203, 'Reset Password', 'User : admin2', 19, '2024-08-26 17:13:49'),
(204, 'Reset Password', 'User : admin2', 19, '2024-08-26 17:13:59'),
(205, 'Folder Created', 'Folder name: 12222', 2, '2024-08-26 17:21:39'),
(206, 'Folder Created', 'Folder name: า่า่าส', 2, '2024-08-26 17:21:46'),
(207, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:16:01'),
(208, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:16:05'),
(209, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:16:06'),
(210, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:17:18'),
(211, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:17:22'),
(212, 'Reset Password', 'User : admin2', 19, '2024-08-26 18:17:22'),
(214, 'User Deleted', 'User ID: 21, Employee ID: 17', 2, '2024-08-26 18:30:46'),
(216, 'User Deleted', 'User ID: 22, Employee ID: 18', 2, '2024-08-26 18:31:06'),
(218, 'User Created', 'Username: admin3, Employee Name: อัครพล กันธิยะ, Position: 0', 2, '2024-08-26 18:34:14'),
(219, 'User Deleted', 'User ID: 24, Employee ID: 20', 2, '2024-08-26 18:35:26'),
(220, 'Employee Deleted', 'Employee ID: 21', 2, '2024-08-26 18:35:37'),
(221, 'User Created', 'Username: admin3, Employee Name: อัครพล กันธิยะ, Position: 0', 2, '2024-08-26 18:38:55'),
(222, 'User Deleted', 'User ID: 25, Employee ID: 22', 2, '2024-08-26 21:01:12'),
(223, 'User Created', 'Username: admin3, Employee Name: อัครพล กันธิยะ, Position: 0', 2, '2024-08-26 21:01:25'),
(224, 'User Deleted', 'User ID: 26, Employee ID: 23', 2, '2024-08-26 21:01:34'),
(225, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-26 21:02:33'),
(226, 'User Created', 'Username: admin3, Employee Name: อัครพล กันธิยะ, Position: 0', 2, '2024-08-26 21:03:21'),
(227, 'User Deleted', 'User ID: 27, Employee ID: 24', 2, '2024-08-26 21:03:26'),
(228, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-26 21:04:57'),
(229, 'User Updated', 'User ID: 19, Username: admin2, Level: 2, Status: 1', 2, '2024-08-26 21:05:00'),
(230, 'User Updated', 'User ID: 19, Username: admin2, Level: 2, Status: 0', 2, '2024-08-26 21:05:05'),
(231, 'User Updated', 'User ID: 19, Username: admin2, Level: 2, Status: 0', 2, '2024-08-26 21:05:07'),
(232, 'User Updated', 'User ID: 19, Username: admin2, Level: 2, Status: 1', 2, '2024-08-26 21:05:11'),
(233, 'User Updated', 'User ID: 19, Username: admin2, Level: 2, Status: 1', 2, '2024-08-26 21:05:32'),
(234, 'User Updated', 'User ID: 2, Username: admin, Level: 0, Status: 1', 2, '2024-08-26 21:07:50'),
(235, 'Salary Deleted', 'Salary ID: 14', 2, '2024-08-26 21:20:38'),
(236, 'Salary Created', 'Salary ID: 17', 2, '2024-08-26 21:25:11'),
(246, 'Salary Created', 'Salary ID: 27', 2, '2024-08-26 21:38:11'),
(247, 'Salary Deleted', 'Salary ID: 27', 2, '2024-08-26 21:38:58'),
(248, 'Salary Created', 'Salary ID: 28', 2, '2024-08-26 21:39:18'),
(249, 'Salary Created', 'Salary ID: 29', 2, '2024-08-26 21:44:22'),
(250, 'Salary Created', 'Salary ID: 30', 2, '2024-08-26 21:44:39'),
(251, 'Salary Created', 'Salary ID: 31', 2, '2024-08-26 21:46:54'),
(252, 'Salary Created', 'Salary ID: 32', 2, '2024-08-26 21:47:34'),
(253, 'Salary Created', 'Salary ID: 33', 2, '2024-08-26 21:50:01');

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
(9, 1.00, 1.00, 1.00, 1.00, 4.00, '2567-02-01', 1),
(10, 1.00, 1.00, 1.00, 1.00, 4.00, '2552-01-01', 13),
(13, 25000.00, 750.00, 750.00, 100.00, 26600.00, '2567-01-01', 1),
(16, 20000.00, 700.00, 150.00, 200.00, 21050.00, '2566-01-01', 1),
(17, 1.00, 1.00, 1.00, 1.00, 4.00, '2567-01-01', 13),
(28, 1.00, 1.00, 1.00, 1.00, 4.00, '2563-01-01', 1),
(29, 1.00, 1.00, 1.00, 1.00, 4.00, '2564-01-01', 1),
(33, 11.00, 11.00, 11.00, 11.00, 44.00, '2562-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passW` varchar(100) DEFAULT NULL,
  `lv` char(1) NOT NULL DEFAULT '1' COMMENT '0=admin,1=เจ้าของ,2=พนักงานเอกสาร,3=พนักงานปฏิบัติงาน',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1=ใช้งาน,0=แบน',
  `users_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passW`, `lv`, `status`, `users_date`, `employee_id`) VALUES
(2, 'admin', '$2y$10$c8vj27z4jfmAEJFl76foR.NWV7ev8Is0zjjeZnVp8VI527nISuh3W', '0', '1', '2024-08-01 21:17:31', 1),
(19, 'admin2', '$2y$10$liIUq.MhzSgsKxLCBZhtJug81ehqhz8JOlASMs8KDKFFteHwYnpyG', '2', '1', '2024-08-26 21:05:11', 13);

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
-- Indexes for table `cable`
--
ALTER TABLE `cable`
  ADD PRIMARY KEY (`cable_id`);

--
-- Indexes for table `drum`
--
ALTER TABLE `drum`
  ADD PRIMARY KEY (`drum_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`files_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`folders_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cable`
--
ALTER TABLE `cable`
  MODIFY `cable_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `drum`
--
ALTER TABLE `drum`
  MODIFY `drum_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `files_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `folders_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
