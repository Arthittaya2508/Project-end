-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 11:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_member`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสสมาชิก',
  `name` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(30) NOT NULL COMMENT 'นามสกุล',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `username` varchar(10) NOT NULL COMMENT 'Username',
  `password` varchar(128) NOT NULL COMMENT 'Password',
  `status` varchar(1) NOT NULL COMMENT '0=user,1=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `lastname`, `address`, `telephone`, `username`, `password`, `status`) VALUES
(000006, 'ศราวุธ', 'แก้วจันทร์เพ็ง', ' เคหะร่มเกล้า', '0832669042', 'admin', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '1'),
(000010, 'แพรวา', 'ทศหล้า', ' ร่มเกล้า', '0832669042', 'ีuser', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '0'),
(000011, 'วรัชยา', 'บุญมาเลิศ', ' พัฒนาการ', '083229042', 'ีuser2', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL COMMENT 'ลำดับที่',
  `orderID` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขที่ใบสั่งซื้อ',
  `pro_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสสินค้า',
  `orderPrice` float NOT NULL COMMENT 'ราคาสินค้า',
  `orderQty` int(11) NOT NULL COMMENT 'จำนวนที่สั่งซื้อ',
  `Total` float NOT NULL COMMENT 'ราคารวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderID`, `pro_id`, `orderPrice`, `orderQty`, `Total`) VALUES
(1, 0000000000, 000001, 0, 5, 0),
(2, 0000000003, 000001, 64200, 1, 64200),
(3, 0000000004, 000001, 64200, 2, 128400),
(4, 0000000005, 000001, 64200, 1, 64200),
(5, 0000000006, 000001, 64200, 2, 128400),
(6, 0000000007, 000001, 64200, 2, 128400),
(7, 0000000008, 000001, 64200, 1, 64200),
(8, 0000000009, 000001, 64200, 1, 64200),
(9, 0000000010, 000001, 64200, 1, 64200),
(10, 0000000011, 000001, 64200, 27, 1733400),
(11, 0000000012, 000001, 64200, 2, 128400),
(12, 0000000014, 000001, 64200, 1, 64200),
(13, 0000000015, 000001, 64200, 1, 64200),
(14, 0000000016, 000001, 64200, 1, 64200),
(15, 0000000017, 000001, 64200, 1, 64200),
(16, 0000000018, 000001, 64200, 2, 128400),
(17, 0000000019, 000001, 64200, 1, 64200),
(18, 0000000020, 000001, 64200, 1, 64200),
(19, 0000000021, 000015, 55028, 2, 110056),
(20, 0000000021, 000014, 5490, 2, 10980),
(21, 0000000021, 000002, 125300, 2, 250600),
(22, 0000000021, 000001, 64200, 1, 64200),
(23, 0000000022, 000015, 55028, 1, 55028),
(24, 0000000022, 000014, 5490, 6, 32940),
(25, 0000000023, 000015, 55028, 1, 55028),
(26, 0000000023, 000002, 125300, 3, 375900),
(27, 0000000023, 000014, 5490, 2, 10980),
(28, 0000000024, 000014, 5490, 1, 5490),
(29, 0000000025, 000002, 125300, 1, 125300),
(30, 0000000026, 000014, 5490, 1, 5490),
(31, 0000000027, 000014, 5490, 1, 5490),
(32, 0000000028, 000014, 5490, 1, 5490),
(33, 0000000029, 000002, 125300, 1, 125300),
(34, 0000000030, 000001, 64200, 1, 64200),
(35, 0000000031, 000015, 55028, 1, 55028),
(36, 0000000032, 000014, 5490, 1, 5490),
(37, 0000000035, 000014, 5490, 1, 5490),
(38, 0000000036, 000015, 55028, 1, 55028),
(39, 0000000037, 000014, 5490, 2, 10980),
(40, 0000000038, 000002, 125300, 1, 125300),
(41, 0000000039, 000001, 64200, 3, 192600),
(42, 0000000040, 000015, 55028, 1, 55028),
(43, 0000000041, 000015, 55028, 2, 110056),
(44, 0000000042, 000002, 125300, 1, 125300);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `orderID` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขที่ใบสั่งซื้อ',
  `pay_money` double NOT NULL COMMENT 'จำนวนเงินที่จ่าย',
  `pay_date` date NOT NULL COMMENT 'วันที่ชำระเงินน',
  `pay_time` time NOT NULL COMMENT 'เวลาที่โอนเงิน',
  `pay_image` varchar(100) NOT NULL COMMENT 'รูปหลักฐานการชำระเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสสินค้า',
  `pro_name` varchar(128) NOT NULL COMMENT 'ชื่อสินค้า',
  `detail` text NOT NULL COMMENT 'รายละเอียดสินค้า',
  `type_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสประเภทสินค้า',
  `price` float NOT NULL COMMENT 'ราคาสินค้า',
  `amount` int(11) NOT NULL COMMENT 'จำนวนสินค้าคงเหลือ',
  `image` varchar(100) NOT NULL COMMENT 'รูปสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `detail`, `type_id`, `price`, `amount`, `image`) VALUES
(000001, 'Grid inverter Huawei 10000 Watt 3 Phase', 'เครื่องแปลงกระแสไฟฟ้าแบบเชื่อมต่อสายส่งการไฟฟ้า ( On grid inverter/Grid connected inverter /Grid tie inverter)\r\nHuawei-10000KTL 3เฟส เครื่องรับประกันศูนย์ไทย Communicative ระบบแสดงผลทาง internet และ สมาร์ทโฟน\r\nเป็นระบบไฮบริด รองรับการต่อแบตเตอรี่ ลิเธียม ขนาดสูงสุด 30KW และโหมดแปลงไฟจาก แบตเตอรี่\r\nMore Efficiency ประสิทธิภาพสูง 98.6%\r\nมีระบบป้องกันกระแสอาร์คของแผงโซล่าเซล Arcfault protection\r\nRS485 ,Wifi มีให้ภายในเครื่อง\r\nMore Flexible ระบบ MPPT 2 MPPT ทำให้สามารถต่อแผงโซล่าเซลล์ได้หลากหลาย\r\nมีระบบ DC switch ติดตั้งมาภายในเครื่อง\r\nรองรับ DC voltage 1100Vdc\r\nต่อแผงโซล่าเซลได้สูงสุด 15,000วัตต์\r\nMEA/PEA approved ผ่านมาตรฐานการไฟฟ้านครหลวงและภูมิภาค\r\nมีระบบ Zero export กันไฟย้อนออกการไฟฟ้า\r\nรับประกันนานถึง 10 ปี', 001, 64200, 30, 'iy607y.jpg'),
(000002, 'Growatt 5000W 5000es Solar Inverter 48Vdc to 220Vac', 'อินเวอร์เตอร์ Growatt 3500W 5000W 48V Off Grid อินเวอร์เตอร์ MPPT 80A 100A Solar Charger Current Max PV 450Vdc ทำงานแม้แบตเตอรี่และ Parallel', 001, 125300, 21, 'images.jpg'),
(000014, 'แผงเซลล์แสงอาทิตย์ ยี่ห้อ LONGi ขนาด 550 วัตต์ Tier-1', 'แผงโซล่าเซลล์ แบรนด์ LONGI Solar เป็นแผงโซล่าเซลล์ ที่ได้รับมาตฐาน TIER 1 สำหรับสินค้าประเภทแผงโซล่าเซลล์ ที่ผลิตออกโดย LONGI Solar เป็นแผงโซล่าเซลล์ประสิทธิภาพภาพสูง เกรดA แบบซิลิคอนผลึกเดี่ยว Solar Mono half crystalline มาตรฐานสากล กรอบอลูมิเนียมอัลลอย กระจกนิรภัย 3 ไดโอดบายพาส ข้อต่อสาย MC4 นวัตกรรมแผงโซลาร์เซลล์ประสิทธิภาพสูง เป็นแผงชนิดที่กำลังนิยมในงานโปรเจคใหญ่ๆทั่วโลก ทั้งโซล่าฟาร์ม โซล่ารูฟท๊อป กระแสไหลได้ดีกว่ารุ่นปกติเพราะเซลล์เล็กกว่า ความร้อนสะสมน้อยกว่า ใช้งานได้หลายหลาย\r\n', 002, 5490, 0, 'PNG_แผง.jpg'),
(000015, 'แบตลิเธียม NMC 48V 450A', '48V 5000wh แบตเตอรี่ Lithium LMO NMC Max 200A BMS สำหรับไฟฟ้า Outboards', 003, 55028, 7, 'Lithium-LMO.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marks`
--

CREATE TABLE `tbl_marks` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(35) NOT NULL,
  `marks` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_marks`
--

INSERT INTO `tbl_marks` (`student_id`, `student_name`, `marks`) VALUES
(1, 'John', 39),
(2, 'Mary ', 46),
(3, 'Maya', 65),
(4, 'Rahul', 90),
(5, 'Priya', 75);

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสสมาชิก',
  `name` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(30) NOT NULL COMMENT 'นามสกุล',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `position` text NOT NULL COMMENT 'ตำแหน่ง',
  `username` varchar(10) NOT NULL COMMENT 'Username',
  `password` varchar(128) NOT NULL COMMENT 'Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `name`, `lastname`, `address`, `telephone`, `position`, `username`, `password`) VALUES
(000006, 'ทศหล้า', 'แพรวา', 'เคหะร่มเกล้า 2', '0832669042', 'แอดมิน', 'admin', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(000028, 'ศราวุธ', 'แก้วจันทร์เพ็ง', 'เคหะร่มเกล้า', '0832669042', 'แอดมิน', 'admin2', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(000029, 'วรัชยา', 'บุญมาเลิศ', ' บ้านสุขศรีกานต์ 738-738/1 อาคาร B ห้อง 1208 ถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 'บัญชี', 'admin3', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(000037, 'ลบ', 'ซะ', ' ราม', '0832669042', 'บัญชี', 'admin4', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `orderID` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'เลขที่ใบสั่งซื้อ',
  `cus_name` varchar(60) NOT NULL COMMENT 'ชื่อ-นามสกุล',
  `address` text NOT NULL COMMENT 'ที่อยู่การจัดส่งสินค้า',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `total_price` float NOT NULL COMMENT 'ราคารวมสุทธิ์',
  `order_status` varchar(1) NOT NULL COMMENT '0=ยกเลิก,1=ยังไม่ชำระเงิน,2=ชำระเงิน',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สั่งซื้อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`orderID`, `cus_name`, `address`, `telephone`, `total_price`, `order_status`, `reg_date`) VALUES
(0000000001, 'วรัชยา บุญมาเลิศ', ' บ้านสุขศรีกานต์\r\n738-738/1 อาคาร B ห้อง 1208\r\nถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 64200, '1', '2023-08-06 15:47:33'),
(0000000002, 'วรัชยา บุญมาเลิศ', ' บ้านสุขศรีกานต์\r\n738-738/1 อาคาร B ห้อง 1208\r\nถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 64200, '2', '2023-08-06 15:47:37'),
(0000000003, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '0832669042', 64200, '2', '2023-08-06 16:00:55'),
(0000000004, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 128400, '0', '2023-08-06 16:07:45'),
(0000000005, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '0832669042', 64200, '0', '2023-08-06 16:21:02'),
(0000000006, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '0832669042', 128400, '1', '2023-08-06 16:30:18'),
(0000000007, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 128400, '1', '2023-08-06 16:31:19'),
(0000000008, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 64200, '0', '2023-08-06 16:37:14'),
(0000000009, 'วรัชยา บุญมาเลิศ', ' พัมนาการ', '0832669042', 64200, '1', '2023-08-06 16:37:46'),
(0000000010, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 64200, '2', '2023-08-06 16:39:04'),
(0000000011, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 1733400, '2', '2023-08-07 14:24:37'),
(0000000012, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 128400, '0', '2023-08-07 17:39:31'),
(0000000013, 'ไอด้า ด้า', 'ร่มเกล้า', '0832669042', 64200, '1', '2023-08-07 17:46:17'),
(0000000014, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 64200, '0', '2023-08-07 17:46:56'),
(0000000015, 'ไอด้า นะต้ะ', ' มหาวิทยาลัยร่มเกล้า', '0832669042', 64200, '1', '2023-08-07 18:44:59'),
(0000000016, 'ไอด้า นะต้ะ', ' มหาวิทยาลัยร่มเกล้า', '0832669042', 64200, '1', '2023-08-07 18:45:54'),
(0000000017, 'วรัชยา บุญมาเลิศ', 'บ้านสุขศรีกานต์\r\n738-738/1 อาคาร B ห้อง 1208\r\nถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 64200, '2', '2023-08-08 14:51:59'),
(0000000018, 'ไอด้า นะต้ะ', 'ร่มเกล้า', '0000000000', 128400, '2', '2023-08-09 16:16:50'),
(0000000019, 'วรัชยา บุญมาเลิศ', ' เกษม', '0000000000', 64200, '0', '2023-08-09 16:17:18'),
(0000000020, 'ไอด้า นะต้ะ', ' รรรร', '0000000000', 64200, '0', '2023-08-09 16:17:36'),
(0000000021, 'ไอด้า นะต้ะ', 'พัฒนาการ', '0832669042', 435836, '2', '2023-08-11 13:16:14'),
(0000000022, 'ไำพะัีรนยบ', 'ดเ้่าส', '0264598656', 87968, '2', '2023-08-16 07:33:31'),
(0000000023, 'วรัชยา บุญมาเลิศ', ' บ้านสุขศรีกานต์ 738-738/1 อาคาร B ห้อง 1208 ถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 441908, '1', '2023-08-16 16:41:03'),
(0000000024, 'วรัชยา บุญมาเลิศ', ' บ้านสุขศรีกานต์ 738-738/1 อาคาร B ห้อง 1208 ถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 5490, '1', '2023-08-16 16:42:42'),
(0000000025, 'วรัชยา บุญมาเลิศ', ' บ้านสุขศรีกานต์ 738-738/1 อาคาร B ห้อง 1208 ถนนพัฒนาการ แขวงสวนหลวง เขตสวนหลวง กทม. 10250', '0832669042', 125300, '1', '2023-08-16 16:44:46'),
(0000000026, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '0832669042', 5490, '1', '2023-08-16 16:50:43'),
(0000000027, 'ไอด้า นะต้ะ', 'พัฒนาการ', '0832669042', 5490, '1', '2023-08-16 16:54:51'),
(0000000028, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 5490, '1', '2023-08-16 17:00:19'),
(0000000029, 'วรัชยา บุญมาเลิศ', 'พฒนาการ', '083226042', 125300, '1', '2023-08-16 17:01:32'),
(0000000030, 'วรัชยา บุญมาเลิศ', 'พัมนาการ', '0832669042', 64200, '1', '2023-08-16 17:13:12'),
(0000000031, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 55028, '1', '2023-08-16 17:14:11'),
(0000000032, 'วรัชยา บุญมาเลิศ', ' พัฒนาการ', '0832669042', 5490, '1', '2023-08-16 17:17:23'),
(0000000033, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '00000000', 5490, '1', '2023-08-20 13:21:47'),
(0000000034, 'วรัชยา บุญมาเลิศ', 'พัฒนาการ', '00000000', 0, '0', '2023-08-20 13:23:12'),
(0000000035, 'วรัชยา บุญมาเลิศ', ' 000000', '000000000', 5490, '0', '2023-08-20 13:23:27'),
(0000000036, 'วรัชยา บุญมาเลิศ', ' ggggg', '000000000', 55028, '1', '2023-08-23 07:21:53'),
(0000000037, 'วรัชยา บุญมาเลิศ', ' กรุงเทพ', '000000000', 10980, '1', '2023-08-26 05:02:26'),
(0000000038, 'ไอด้า นะต้ะ', ' กรุงเทพ', '000000000', 125300, '1', '2023-08-26 05:20:44'),
(0000000039, 'bhjv', ' bjkh gbujkgbk', '253153486', 192600, '1', '2023-08-30 08:08:46'),
(0000000040, 'วรัชยา บุญมาเลิศ', ' เเเเ', '0832669042', 55028, '1', '2023-09-29 15:07:03'),
(0000000041, 'ไอด้า นะต้ะ', ' LL', '0832669042', 110056, '1', '2023-09-29 16:14:39'),
(0000000042, 'วรัชยา บุญมาเลิศ', ' ll', '0832669042', 125300, '1', '2023-09-30 14:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสประเภทสินค้า',
  `type_name` varchar(50) NOT NULL COMMENT 'รหัสชื่อประเภทสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(001, 'สายไฟฟ้า, สายสัญญาณ'),
(002, 'แผงโซล่าเซลล์'),
(003, 'แบตเตอรี่');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `tbl_marks`
--
ALTER TABLE `tbl_marks`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับที่', AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_marks`
--
ALTER TABLE `tbl_marks`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `orderID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'เลขที่ใบสั่งซื้อ', AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทสินค้า', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
