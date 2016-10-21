-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2016 at 09:02 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kishoref_kfrk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(35) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `Name` varchar(150) NOT NULL,
  `block` enum('Y','N') NOT NULL DEFAULT 'N',
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `userlastip` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `user_name`, `password`, `Name`, `block`, `deleted`, `userlastip`) VALUES
(1, 'authorpoint', 'kishore@farM123#', 'Admin', 'N', 'N', '1001918584');

-- --------------------------------------------------------

--
-- Table structure for table `category_detail`
--

CREATE TABLE `category_detail` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_parent` int(10) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_description` text,
  `category_order` int(10) NOT NULL,
  `category_status` enum('Active','InActive') DEFAULT 'Active',
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_detail`
--

INSERT INTO `category_detail` (`category_id`, `category_name`, `category_parent`, `category_image`, `category_description`, `category_order`, `category_status`, `deleted`) VALUES
(26, 'Cages System', 1, '1372111340a-frame.jpg', 'The company is engaged in producing several types of cage systems for breeders , layers and growers. The company also produces cage automation products like egg collection system, manure removal system as per the customers requirement.', 0, 'Active', 'N'),
(27, 'Nest Boxes', 1, '1372111504netbox.jpg', ' \r\n  24 Hole Nest Box', 0, 'Active', 'N'),
(28, 'Ventilation & Cooling system', 1, '1372111876ventelationcooling.jpg', '  The company is associated with european companies to design and develop ventilation and cooling systems for poultry farms. The company ', 0, 'Active', 'N'),
(29, 'Feeding System', 1, '1372112047feeding.jpg', 'Company makes feeding systems form broilers and breeders and feeding trolleys for layers.Pan Feeding System, Chain Feeding System, Trolley Feeding, Feed Conveyors from Silo to houses, Manual Feeders available as per customer requirement.', 0, 'Active', 'N'),
(30, 'Drinking System', 1, '1415690656Super_Dulex_Bell_Drinker.png', 'Drinking systems provide broilers and breeder right amount of water, without spillage, at every stage of growth.', 0, 'Active', 'N'),
(31, 'Heating System', 1, '1372112395heater.jpg', 'For brooding the birds, various types of heating systems are available. Heating systems are based on gas, diesel and electric.', 0, 'Active', 'N'),
(33, 'Exhaust Fans', 28, '1372190721ventelationcooling2.jpg', 'The company produces top quality exhaust fans of various sizes.', 0, 'Active', 'N'),
(34, 'LED Candeler', 1, '1372959444LED_candler__main.jpg', 'It is use to detect hair line cracks on the eggs manually. The product consists of power led lamps. The product any heat on the egg.', 0, 'Active', 'N'),
(36, 'Vaccinators', 1, '1372960013KF-101-Double-barrel-syringe-1m.jpg', 'Various types of vaccinators are available as per the requirement of the farmer.', 0, 'Active', 'N'),
(37, 'Ventilation Fans', 28, '1372960394no-image.gif', 'The company produces top quality Ventilation fans of various sizes.', 0, 'Active', 'N'),
(38, 'Fogging System', 28, '1372960796no-image.gif', 'Company produces high and medium pressure fogging system. The pressure ranges form 30 bar to 70 bar.', 0, 'Active', 'N'),
(39, 'Debeaker', 1, '1372960934DEBEKER.jpg', 'Automatic:-Our Debeaking machine (AD-10) trims and cauterizes in a single operation. The machine is equipped with low-speed geared motor to drive the electric heated moving blade on the Gauge blade.&nbsp;', 0, 'Active', 'N'),
(40, 'Cooling pads', 28, '1372961699no-image.gif', 'The cool pad is produce with high quality water retention paper, hence permitting better cooling. The cooling pad is design for minimum static pressure drop and more water', 0, 'Active', 'N'),
(41, 'Climate controls and computers', 28, '1372961927no-image.gif', 'The company is in association with dutch company Fancom for their respective products for distribution, installation and service.', 0, 'Active', 'N'),
(42, 'Air Inlets', 28, '1372962338no-image.gif', 'Air inlets are useful for minimum ventilation and inlets is made of plastic with flap adjustment with the help of pulley and winch.', 0, 'Active', 'N'),
(43, 'Fan parts', 28, '1372962369no-image.gif', 'Company can supply any kind of fan parts.', 0, 'Active', 'N'),
(44, 'Winching Systems and accessories', 1, '1372963140winch.jpg', 'In poultry house, curtains are used to protect the birds from direct sunlight, rain and harsh winter conditions. Winches and pulleys are useful in this segment.', 0, 'Active', 'N'),
(45, 'Hatchery Automations', 1, '1373036860hatechery_automation.JPG', 'No Data Available', 0, 'Active', 'N'),
(46, 'Temperatures & Humidity Measuring Instruments', 1, '1373037325noimage.gif', 'NO DESCRIPTION AVAILABLE.', 0, 'Active', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_detail`
--

CREATE TABLE `contacts_detail` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `commentsdata` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_detail`
--

INSERT INTO `contacts_detail` (`contact_id`, `contact_name`, `company_name`, `emailid`, `phone`, `city`, `country`, `website`, `commentsdata`) VALUES
(1, 'Genuine', '', 'callrajjak@gmail.com', '9234230234', 'mumbai', 'india', 'geniune.com', 'zxcvzxcvzxcv'),
(2, 'Rajjak', 'ABAC', 'abac@gmail.com', '234998234', 'new mumbai', 'india', 'abac.com', 'something'),
(3, 'Rajjak', 'ge', 'callrajjak@gmail.com', '123456789', 'mumbai', 'india', 'ge.com', 'just show me'),
(4, 'Rajjak', 'ge', 'callrajjak@gmail.com', '123456789', 'mumbai', 'india', 'ge.com', 'just show me'),
(5, 'Rajjak', 'ge', 'callrajjak@gmail.com', '123456789', 'mumbai', 'india', 'ge.com', 'something to show for test'),
(6, 'rajjak', 'genuine', 'abc@gmail.com', '2342346', 'satara', 'indian', 'ge.com', 'for test'),
(7, 'rajjak', 'genuine', 'abc@gmail.com', '2342346', 'satara', 'indian', 'ge.com', 'asdfasdfasdfasdf'),
(8, 'rajjak', 'genuine', 'abc@gmail.com', '2342346', 'satara', 'indian', 'ge.com', 'asdfasdfasdfasdfasdf'),
(9, 'rajjak', 'genuine', 'abc@gmail.com', '2342346', 'satara', 'indian', 'ge.com', 'asdfasdfasdf'),
(10, 'Rajjak', 'GE', 'xyz@gmail.co', '123456789', 'mumbai', 'india', 'http://www.google.com', 'testing purpose'),
(11, '', '', 'xyz@gmail.co', '', '', '', '', NULL),
(12, 'Rajjak', 'GE', 'xyz@gmail.co', '123456789', 'mumbai', 'india', 'http://www.google.com', 'dfgsdfg');

-- --------------------------------------------------------

--
-- Table structure for table `dowcat_detail`
--

CREATE TABLE `dowcat_detail` (
  `dowcat_id` int(10) NOT NULL,
  `dowcat_name` varchar(255) DEFAULT NULL,
  `dowcat_order` int(10) NOT NULL,
  `dowcat_status` enum('Active','InActive') DEFAULT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dowcat_detail`
--

INSERT INTO `dowcat_detail` (`dowcat_id`, `dowcat_name`, `dowcat_order`, `dowcat_status`, `deleted`) VALUES
(1, 'Brochure', 0, 'Active', 'Y'),
(2, '', 0, 'Active', 'Y'),
(3, 'demodemo', 0, 'Active', 'Y'),
(4, 'poultry', 0, 'Active', 'Y'),
(5, 'Brochure', 0, 'Active', 'N'),
(6, 'Complete brochure', 0, 'Active', 'Y'),
(7, '', 0, 'Active', 'Y'),
(8, 'Distributor', 0, 'Active', 'Y'),
(9, 'Installation Manuals', 0, 'Active', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `download_category_detail`
--

CREATE TABLE `download_category_detail` (
  `download_id` int(10) DEFAULT NULL,
  `dowcat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download_category_detail`
--

INSERT INTO `download_category_detail` (`download_id`, `dowcat_id`) VALUES
(1, 1),
(2, 3),
(3, 4),
(5, 6),
(4, 5),
(6, 8),
(7, 8),
(8, 5),
(9, 5),
(10, 5),
(11, 9);

-- --------------------------------------------------------

--
-- Table structure for table `download_detail`
--

CREATE TABLE `download_detail` (
  `download_id` int(10) NOT NULL,
  `download_name` varchar(255) DEFAULT NULL,
  `download_icon` varchar(255) DEFAULT NULL,
  `download_image` varchar(255) DEFAULT NULL,
  `download_category_id` int(20) DEFAULT NULL,
  `download_desc` text,
  `download_order` int(5) DEFAULT NULL,
  `download_status` enum('Active','InActive') DEFAULT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download_detail`
--

INSERT INTO `download_detail` (`download_id`, `download_name`, `download_icon`, `download_image`, `download_category_id`, `download_desc`, `download_order`, `download_status`, `deleted`) VALUES
(1, 'Demo file', NULL, '1374833109kishore.pdf', NULL, 'this is demo', NULL, 'Active', 'Y'),
(2, 'my demo cat', NULL, '1374833300katty_appointment.pdf', NULL, 'asdf', NULL, 'Active', 'Y'),
(3, 'egg', NULL, '1374833953katty_appointment.pdf', NULL, 'as', NULL, 'Active', 'Y'),
(4, 'Manual Equipments 2', NULL, '1377933383manual_2.jpg', NULL, '<div class="oneone"><div class="oneone"><div class="oneone"><p>Manual Equipments 2</p></div></div></div>', NULL, 'Active', 'Y'),
(5, 'KishoreFarms Complete brochure', NULL, 'brochure/brochure.rar', NULL, 'http://www.kishorefarm.com/images/kishorefarmlogo.gif', NULL, 'Active', 'Y'),
(6, 'abc1', NULL, '1389696015debeakers-1.pdf', NULL, 'hi', NULL, 'Active', 'Y'),
(7, 'xyz2', NULL, '1389696066Kishore_Diesel_-_Kerosene_Poultry_Brooder.pdf', NULL, 'hello', NULL, 'Active', 'Y'),
(8, 'Diesel Heater / Brooders', NULL, '1389696577Kishore_Diesel_-_Kerosene_Poultry_Brooder.pdf', NULL, 'Diesel Heater / Brooders', NULL, 'Active', 'Y'),
(9, 'Spray Vaccinator - Blue Colour', NULL, '1389696631Spray_Vaccinator_-_Blue_Colour.pdf', NULL, 'Spray Vaccinator - Blue Colour', NULL, 'Active', 'N'),
(10, 'Diesel Brooder Model 125k', NULL, '1415600764DIESEL_HEATER_MANUAL.pdf', NULL, NULL, NULL, 'Active', 'N'),
(11, 'Diesel Brooder Model 125k', NULL, '1415600965DIESEL_HEATER_MANUAL.pdf', NULL, 'Operating manual for diesel/kerosene heater', NULL, 'Active', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_detail`
--

CREATE TABLE `gallery_detail` (
  `gallery_id` int(10) NOT NULL,
  `gallery_name` varchar(255) DEFAULT NULL,
  `gallery_image` varchar(255) DEFAULT NULL,
  `gallery_status` enum('Active','InActive') DEFAULT NULL,
  `gallery_order` varchar(5) DEFAULT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_detail`
--

INSERT INTO `gallery_detail` (`gallery_id`, `gallery_name`, `gallery_image`, `gallery_status`, `gallery_order`, `deleted`) VALUES
(1, 'Feeding', '1357332476feeding.jpg', 'Active', NULL, 'Y'),
(2, 'Kishorefarm.com poultry farm equipements', '1357931907576281_301998179912187_470392517_n.jpg', 'Active', NULL, 'N'),
(3, 'Kishorefarm.com poultry farm equipements', '135793191912252_301997796578892_1605541905_n.jpg', 'Active', NULL, 'N'),
(4, 'Kishorefarm.com poultry farm equipements', '135793223929604_301998099912195_1760831827_n.jpg', 'Active', NULL, 'N'),
(5, 'Kishorefarm.com poultry farm equipements', '135793228566780_301998053245533_524200668_n.jpg', 'Active', NULL, 'N'),
(6, 'Kishorefarm.com poultry farm equipements', '135793231971721_301999079912097_1055839483_n.jpg', 'Active', NULL, 'N'),
(7, 'Kishorefarm.com poultry farm equipements', '1357932336156276_302000473245291_376180744_n.jpg', 'Active', NULL, 'N'),
(8, 'Kishorefarm.com poultry farm equipements', '135793240276722_302000329911972_551775148_n.jpg', 'Active', NULL, 'N'),
(9, 'test', '1374834210MF1_small.jpg', 'Active', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `part_detail`
--

CREATE TABLE `part_detail` (
  `part_id` int(10) NOT NULL,
  `part_image` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_desc` text,
  `part_code` varchar(100) DEFAULT NULL,
  `part_new_arival` enum('No','Yes') DEFAULT NULL,
  `part_order` int(5) NOT NULL DEFAULT '0',
  `part_status` enum('Active','InActive') DEFAULT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_detail`
--

INSERT INTO `part_detail` (`part_id`, `part_image`, `part_name`, `part_desc`, `part_code`, `part_new_arival`, `part_order`, `part_status`, `deleted`) VALUES
(1, '1372189725layercase2.jpg', 'Layer case view', NULL, NULL, 'Yes', 0, 'Active', 'N'),
(2, '1372960443KF-108-Automatic-Plastic-Syringe-2ml.jpg', 'Vaccinators', '-', 'v01-a', 'Yes', 0, 'Active', 'N'),
(3, '1372960493KF--105-Automatic-Metal-Syringe-2ml.jpg', 'Vaccinators', '-', 'v01-b', 'Yes', 0, 'Active', 'N'),
(4, '1373038261Broiler_Feeder_new.JPG', 'Broilers', 'KISHORE &nbsp;has designed an automatic feeding system. Automatic feeding system is a rail movement type of system which can be moved with the winches.Feeding system can be used of deep litter. It also reduces the&nbsp;labor&nbsp;cost and time and maintain high quality.', 'fs-pf-br', 'Yes', 0, 'Active', 'N'),
(5, '1373038691breeder_feeding.JPG', 'Breeder Feeder', 'The KISHORE Breeder Feeder is ergonomically designed for comfortable perimeter eating.Birds not only have easy access to feed but also easier access to water and nests due to the feederâ€™s unique 45-degree angle on the feeder tube.', 'fs-pf-bf', 'Yes', 0, 'Active', 'N'),
(6, '1373040924manual_feeder_8kg.JPG', 'Manual Feeders 8kg', 'Capacity of bird-50 to 60, Feed Capacity- 8KG, Cone (top) dia- 290mm, Cone Height- 100mm, Pan (bottom) dia- 340mm, Lip Space- 65mm, Grill Gap- 60mm, Bucket Height- 280mm.', 'mf-8kg', 'Yes', 0, 'Active', 'N'),
(7, '1373041129manual_feeder_10kg.JPG', 'Manual Feeders 10 Kg', 'Capacity of bird- 50 to 60, Feed Capacity- 10kg, Cone (top) dia- 290mm, Cone Height- 100mm, Pan (bottom) dia- &nbsp;360mm, Lip Space- 60mm, Grill Gap- 60mm, Bucket Height- 265mm.', 'fs-mf-10kg', 'Yes', 0, 'Active', 'N'),
(8, '1373041315Chick_Feeders.JPG', 'Chick Feeders', 'Capacity of bird-50 to 60, Feed Capacity- 2.5 to 3 kg, Cone (top) dia- 170mm, Cone Height- 40mm, Pan (bottom) dia- 230mm, Lip Space- 40mm, Grill Gap- 30mm, Bucket Height- 190mm.', 'fs-mf-', 'Yes', 0, 'Active', 'N'),
(9, '1373041414Chick_Feeding_tray.JPG', 'Chick Feeding trays', 'Dimention-380mm, weight-260 gram, capacity- 100 chicks, Lip size- 40mm.', 'fs-mf-ft', 'Yes', 0, 'Active', 'N'),
(10, '1373041527Breeder_Female_Feeders.JPG', 'Breeder female Feeders', 'Capacity of bird- 10 birds,&nbsp;Pan (bottom) dia- 360mm,&nbsp;Grill Gap- 45mm.', 'fs-mf-ff', 'Yes', 0, 'Active', 'N'),
(11, '1373041609Breeder_male_Feeders.JPG', 'Breeder Male Feeders', 'Capacity of bird- 8 birds,&nbsp;Pan (bottom) dia- 360mm,&nbsp;Grill Gap- 70mm.', 'fs-mf-mf', 'Yes', 0, 'Active', 'N'),
(12, '1374837110MF1_small.jpg', 'demo part type', 'as', 'dmcat-dmpro-dp', 'Yes', 0, 'Active', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `part_product_detail`
--

CREATE TABLE `part_product_detail` (
  `part_id` int(10) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_product_detail`
--

INSERT INTO `part_product_detail` (`part_id`, `product_id`) VALUES
(1, 14),
(2, 25),
(3, 25),
(4, 53),
(5, 53),
(6, 57),
(7, 57),
(8, 57),
(9, 57),
(10, 57),
(11, 57),
(12, 59);

-- --------------------------------------------------------

--
-- Table structure for table `product_category_detail`
--

CREATE TABLE `product_category_detail` (
  `product_id` int(10) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category_detail`
--

INSERT INTO `product_category_detail` (`product_id`, `category_id`) VALUES
(14, 26),
(15, 26),
(16, 26),
(17, 33),
(18, 26),
(19, 26),
(20, 26),
(21, 27),
(22, 34),
(23, 33),
(24, 33),
(25, 36),
(26, 33),
(27, 37),
(28, 37),
(29, 37),
(30, 39),
(31, 38),
(32, 38),
(33, 38),
(34, 31),
(35, 41),
(36, 41),
(37, 28),
(38, 28),
(39, 31),
(40, 30),
(41, 31),
(42, 30),
(43, 30),
(44, 31),
(45, 30),
(46, 30),
(47, 44),
(48, 30),
(49, 30),
(50, 44),
(51, 44),
(52, 45),
(53, 29),
(54, 29),
(55, 29),
(56, 29),
(57, 29),
(58, 47),
(59, 48),
(60, 30),
(61, 26),
(61, 27),
(62, 30);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `product_id` int(10) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` text,
  `product_code` varchar(100) DEFAULT NULL,
  `product_pricing` varchar(50) DEFAULT NULL,
  `product_advantage` text,
  `product_installation` text,
  `product_new_arival` enum('No','Yes') DEFAULT NULL,
  `product_order` int(5) DEFAULT NULL,
  `product_status` enum('Active','InActive') DEFAULT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_id`, `product_image`, `product_name`, `product_desc`, `product_code`, `product_pricing`, `product_advantage`, `product_installation`, `product_new_arival`, `product_order`, `product_status`, `deleted`) VALUES
(14, '1372187685layer-cage.jpg', 'LAYER CAGES', '100% of our Mesh is made out of hot dipped pre-galvanized heavy coated wire which makes it extremely corrosion-resistant. Laboratory Test Certificate for the Zinc Coating of the wire used would be provided along with the material if the customer wishes to check the accuracy of our claims.<br><br>Wire used for manufacturing the mesh is sturdy yet flexible and ductile in nature which facilitates the fabrication of the mesh to build poultry cages and ensures strength due to bending. Tensile Strength: 350 - 540 N//mm2. Test Certificate on Customer\\''s Request.<br><br>The mesh\\''s life is guaranteed for minimum 10 years under normal conditions of wear-and-tear and exposure to humidity.<br><br>&nbsp;&nbsp; &nbsp;1 .&nbsp; Wire Partition for Excellent ventilation and light . Wire spaces is kept&nbsp; at one inch to &nbsp;&nbsp; &nbsp;redue &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; feather&nbsp; pecking.<br>&nbsp;&nbsp; &nbsp;2 .&nbsp; Bottom mesh is made of hot dipped heavy galvanized coating wire .<br>&nbsp;&nbsp; &nbsp;3 .&nbsp; Leak proof Nipples for Layers &amp; breeders<br>&nbsp;&nbsp; &nbsp;4. &nbsp;&nbsp; &nbsp;One hand operated Horizontal sliding doors , makes birds handling easy during induction.', 'cage01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(15, '1372187868BroilerBreederCage.jpg', 'Broiler Breeder cages', 'Suitable for broiler breeder birds.', 'cage02', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(16, '1372188059a-frame.jpg', 'A - Frame Cages', 'Suitable for economic cage system for layesr and breeders.', 'cage03', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(17, '1372190950exuast.jpg', '50 inch exhaust Fans', '50 inch exhaust Fans', NULL, NULL, NULL, NULL, 'Yes', NULL, 'Active', 'Y'),
(18, '1372958919no-image.gif', 'Egg Collection System', 'For automation of collecting egges by machine, can be fitted on battery or A-Frame cages.', 'case05', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(19, '1373041977Manure_Scrapper.jpg', 'Manure Removal System', 'Manure remover system consist of conver belt and scrapper system.', 'cage06', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(20, '1372959297no-image.gif', 'Cage Frames and Mesh', 'Company has got state of the art ,computerised machines to manufacture sheet metal components for cage frames. Company also has got cage mesh producing machines.', 'cage07', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(21, '1374642924nestbox.jpg', '24 Hole Nest Box', '24 Hole Nest Box For Birds is available in two sides.', 'netbox01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(22, '1372959599LED_Candler.jpg', 'LED Candeler', 'It is use to detect hair line cracks on the eggs manually. The product consists of power led lamps. The product any heat on the egg.', 'led01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(23, '1372959841no-image.gif', '50 inch exhaust Fans', '50 inch exhaust Fans', 'venti01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(24, '1372960217no-image.gif', '40 inch exhaust Fans', '40 inch exhaust Fans', 'venti02', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(25, '1372960222KF-101-Double-barrel-syringe-1ml.jpg', 'Vaccinators', 'Various types of vaccinators are available as per the requirement of the farmer', 'v01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(26, '1372960331no-image.gif', 'Cone fans', 'Cone fans', 'venti03', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(27, '1372960576no-image.gif', '50 inch Ventilation Fans', '50 inch Ventilation Fans', 'vent07', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(28, '1372960605no-image.gif', '40 Inch Ventilation Fans', '40 Inch Ventilation Fans', 'vent06', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(29, '1389866411circullation_fan.jpg', '36 inch Ventilation Fans', '<div class="oneone"><p>36 inch Ventilation Fans 1) Grills are plastic coated and thick diameter wire gauge&nbsp; (2.5mm) is used, and the gap is maintained 15mm as per international quality standards to avoid human  accidents and rats entering into the fan. 2) The blades are made of compounded plastic so less&nbsp; chances of bending and hence less breaking chances. 3) Motor is efficient and complete thermal protection and&nbsp; moisture proof 4) The CFM of fan is 13,000 and minimum airflow of 8.5 meters/sec  5)Minimum positive air throws of 50ft. When we say 50 \\\\\\''then it is 50 length in practically. 6) Easy installation &amp; zero maintenance.</p></div>', 'vent08', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(30, '1389696171debeaker.JPG', 'Debeaking machine (AD-10)', 'Automatic:-Our Debeaking machine (AD-10) trims and cauterizes in a single operation. The machine is equipped with low-speed geared motor to drive the electric heated moving blade on the Gauge blade.', 'db1', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(31, '1372961374no-image.gif', 'High Pressure Fine Fogging System', 'High Pressure fine fogging system: High pressure fogging system operates from the range of 40 bar to 70 bars. The nozzles are made of brass with stainless steel insert. The size of the orifice is from 0.1mm to 0.3 mm. This kind of system will produce fine fog without any water dropping.', 'fogging01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(32, '1372961572no-image.gif', 'Medium pressure Fogging system', '&nbsp;This kind of Flogging system is made of brass with an orifice of 0.3mm and can be directly fitted on high pressure PVC pipeline.', 'fogging02', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(33, '1372961628no-image.gif', 'Parts', 'The parts are use to install the complete fogging system', 'fogging03', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(34, '1374642796gasbrooders.jpg', 'Gas Brooders', 'Gas Brooders are comes with complete stainless steel body. Chick capacity 1500-2000 chicks.', 'hs-gb', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(35, '1372961964no-image.gif', 'F37', 'F37', 'climate01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(36, '1372962010no-image.gif', 'F38', 'F38', 'climate02', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(37, '1372962190no-image.gif', 'Fan parts', 'Company can supply any kind of fan parts.', 'venti09', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(38, '1372962230no-image.gif', 'Air Inlets', 'Air inlets are usefull for minimum ventilation and inlets is made of plastic with flap adjustment with the help of pulley and winch.', 'vent10', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(39, '1389697029Diesel_Heater.jpg', 'Diesel Heaters', 'This kind of heaters are more economical in usage as to gas heaters.', 'hs-dh', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(40, '1415624299Nipples.jpg', 'Nipples', 'Made from stainless steel with ball type and fitted with clip-on-saddle. The nipple does not required any kind of threading inside the pipe. 360 degrees side', 'drinkiingsyste01', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(41, '1372962583electric_heater_1.jpg', 'Electric Heaters', 'In Electric Heaters the capital investment is lower as to other types of heaters. This kind of heater are more suitable for small firms.', 'HS-EH', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(42, '1372962595no-image.gif', 'Nipple Drinking System', '&nbsp;Automatic nipple drinking system consists of regulators, pipes, winches, endline kit and support pipes with steel wire rope.', 'drinkiingsyste02', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'Y'),
(43, '1415624974Water_Fiter_With_Flow_Meter.JPG', 'Filters', 'The filter is indigenously developed for use of poultry farms. There is no need to change the cartridge frequently. The filter material can be changed and reused.', 'drinkiingsyste03', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(44, '1372962733no-image.gif', 'Space Heaters', 'Space heaters are used to brood the whole house. These heaters work on gas and electricity. Gas is used for combustion and electricity is used for distribution of heated air by means of fans inside the space heaters.', 'hs-sh', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(45, '1415624645Nipple_Pressure_Reducer.jpg', 'Regulators', 'They are use to regulate water pressure inside nipple drinking system. It can operate line length up to 450ft. the regulator can be fitted in both round and square pipes.', 'drinkiingsyste04', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(46, '141562452190mm_Big_Pulley.jpg', 'Winches & pulleys', 'The company produces variety of pulleys and winches to be used in feeding, drinking, curtains and other systems used in poultry. The winches too are available in different capacities.', 'drinkiingsyste05', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(47, '1372963278winch-1.jpg', 'Winches', 'No description available.', 'ws-wn', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(48, '1415625162end_kit_1.jpg', 'End Line Kit', 'End Line Kit is a part of nipple drinking system.', 'drinkiingsyste06', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(49, '1415624164Jumbo_Chick_Drinker_with_Stand.png', 'Manual Drinkers', 'Manual Drinkers', 'drinkiingsyste07', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(50, '1372963423pulley-1.jpg', 'Pulley', 'No description Available.', 'ws-pl', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(51, '1372963575UCLAMP.jpg', 'U Clamps', 'No description available.', 'ws-uc', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(52, '1373037152Egg_Handler.JPG', 'Egg Handler', 'Egg handing is used transfer hatching eggs from\r\nfarm trays to setter trays. The machine also points down to the accuracy of\r\n99.7%. This helps in getting more chicks as compared to doing it manually. This\r\nmachine is in association with Prinzen, Holland. The machine can be combined\r\nwith egg candling, egg grading and UV disinfection depending on situations and\r\nrequirements', 'ha-ea', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(53, '1373037782Pan_Feeding.JPG', 'Pan Feeding System', 'This kind of system is suitable for both broilers and breeders. Separate pan and high speed feed distribution is used for breeders.', 'fs-pf', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(54, '1373038852Chain_Feeding_System.JPG', 'Chain Feeding System', 'Chain feeding system is used for the even distribution of feed for each female dosage requirement.', 'fs-cf', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(55, '1373039104trollyFeedingSystem.jpg', 'Trolley Feeding', 'Company can supply feeding trolleys for A Frame and battery cages.', 'fs-tf', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(56, '1373039427Silo_Feeding_1.jpg', 'Feed Conveyors', 'The company produces the feed conveyors from silo to hoppers inside the house and also conveyor system to feel the silo.', 'fs-fc', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(57, '1374832226MF1_small.jpg', 'Manual Feeders', 'The company has got injection molding units to produce wide range of plastic poultry equipment like feeders and drinkers.', 'fs-mf', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(58, '1374832505MF1_small.jpg', 'dem pro', 'ad', 'dm-dm', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(59, '1374836976MF1_small.jpg', 'demo product', 'as', 'mf-12', NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N'),
(60, '1415597638DSC01036.JPG', 'Nipples', 'nipple drinker for square pipe.', NULL, NULL, NULL, NULL, 'Yes', NULL, 'Active', 'Y'),
(61, '1433196621madspotshell.php', '12 Hole nest box', '<div class="oneone"><div class="oneone"><p>12 hole nest box. One side only.</p></div></div>', NULL, NULL, '<div class="oneone"><div class="oneone"><p>Made from High quality Galvanized steel.</p></div></div>', '<div class="oneone"><div class="oneone"><p>Can also be supplied assembled form.</p></div></div>', 'Yes', NULL, 'Active', 'N'),
(62, '1415623025Nipples.jpg', 'Nipple Drinking System', 'Nipple drinking systems provide broilers and breeder nipple with the right amount of water, without spillage, at every stage of growth.', NULL, NULL, NULL, NULL, 'Yes', NULL, 'Active', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userid` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `category_detail`
--
ALTER TABLE `category_detail`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contacts_detail`
--
ALTER TABLE `contacts_detail`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `dowcat_detail`
--
ALTER TABLE `dowcat_detail`
  ADD PRIMARY KEY (`dowcat_id`);

--
-- Indexes for table `download_detail`
--
ALTER TABLE `download_detail`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `gallery_detail`
--
ALTER TABLE `gallery_detail`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `part_detail`
--
ALTER TABLE `part_detail`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `part_product_detail`
--
ALTER TABLE `part_product_detail`
  ADD KEY `part_id` (`part_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_category_detail`
--
ALTER TABLE `product_category_detail`
  ADD UNIQUE KEY `product_id` (`product_id`,`category_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category_detail`
--
ALTER TABLE `category_detail`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `contacts_detail`
--
ALTER TABLE `contacts_detail`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `dowcat_detail`
--
ALTER TABLE `dowcat_detail`
  MODIFY `dowcat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `download_detail`
--
ALTER TABLE `download_detail`
  MODIFY `download_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gallery_detail`
--
ALTER TABLE `gallery_detail`
  MODIFY `gallery_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `part_detail`
--
ALTER TABLE `part_detail`
  MODIFY `part_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
