-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 06:46 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`) VALUES
(7, 'Analgesics'),
(6, 'Therapeutic '),
(5, 'Capsule'),
(8, 'Anticonvulsant '),
(9, 'Anesthetics'),
(10, 'Antiparkinson '),
(11, 'Antiviral Drug'),
(12, 'Antiemetic '),
(13, 'Anticoagulants'),
(14, 'Food Supplement');

-- --------------------------------------------------------

--
-- Table structure for table `history_table`
--

CREATE TABLE `history_table` (
  `id` int(11) NOT NULL,
  `history_id` text NOT NULL,
  `history_action` text NOT NULL,
  `history_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_table`
--

INSERT INTO `history_table` (`id`, `history_id`, `history_action`, `history_date`) VALUES
(53, 'DSM3Z4ID93894', 'Vicks Added', '2022-12-26 10:02:15'),
(54, 'CPPYN', 'Admin Deleted', '2023-01-03 11:08:05'),
(55, '6NHIP7ID8619', 'aspilit Deleted', '2023-01-04 07:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `order_customer` text NOT NULL,
  `order_name` text NOT NULL,
  `order_price` text NOT NULL,
  `order_quantity` text NOT NULL,
  `order_date` datetime NOT NULL,
  `user_cashier` text NOT NULL,
  `table_order_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `order_customer`, `order_name`, `order_price`, `order_quantity`, `order_date`, `user_cashier`, `table_order_id`) VALUES
(7, 'Customer', 'Paracetamol', '3', '5', '2022-05-23 05:09:49', '', 'SZDSKX57014'),
(8, 'Customer', 'Morphine', '15', '3', '2022-05-23 05:09:49', '', 'SZDSKX57014'),
(9, 'Customer', 'MX3 Coffee', '20', '2', '2022-12-24 14:59:35', '', '9QE13P85529');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `item_id` text NOT NULL,
  `item_name` text NOT NULL,
  `item_brand` text NOT NULL,
  `item_price` text NOT NULL,
  `item_supplier` text NOT NULL,
  `item_category` text NOT NULL,
  `item_description` text NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `acquisition_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `item_id`, `item_name`, `item_brand`, `item_price`, `item_supplier`, `item_category`, `item_description`, `item_quantity`, `acquisition_date`, `expiry_date`) VALUES
(19, 'ID82911', 'Panyawan Capsule', 'Joyzkie Ikashi Hatake Company', '30', '', 'Food Supplement', 'para sa bughat, katol-katol, bun-e', 50, '2020-12-21', '0000-00-00'),
(11, 'ID80008', 'Morphine', 'Arymo ER', '15', '', 'Analgesics', 'This medication is used to treat severe pain. Morphine belongs to a class of drugs known as opioid analgesics.', 150, '2021-04-14', '2026-04-23'),
(9, 'ID30075', 'Codeine', 'Solpadol', '25', '', 'Analgesics', 'Codeine is used to relieve mild to moderate pain.', 200, '2021-03-11', '2024-05-23'),
(8, 'ID93995', 'Neozep', 'Unilab', '10', '', 'Capsule', 'Tambal sa Sipon', 1000, '2022-05-23', '2022-06-11'),
(12, 'ID36140', 'Aspirin', 'Zorprin', '3.35', '', 'Analgesics', 'Stopping the production of certain natural substances that cause fever, pain, swelling, and blood clots', 145, '2021-08-12', '2027-03-20'),
(13, 'ID4003', 'Propofol', 'Diprivan (Pro) ', '13', '', 'Anesthetics', 'Anesthesia is the use of medicines to prevent pain during surgery and other procedures.', 50, '2019-06-05', '2024-10-09'),
(14, 'ID90334', 'aprepitant ', 'Emend', '15', '', 'Antiemetic ', 'Antiemetics for chemotherapy', 79, '2019-08-01', '2022-05-23'),
(15, 'ID56067', 'dexamethasone ', 'DexPak', '34', '', 'Antiemetic ', 'The main antiemetic classes include antagonists of the serotonin, dopamine, histamine, muscarinic and neurokinin systems.', 100, '2021-09-15', '2025-05-23'),
(16, 'ID29359', 'MX3 Coffee', 'MX3', '20', '', 'Food Supplement', 'Kape sa mga tiguwang', 1000, '2022-05-24', '2022-05-31'),
(17, 'ID9481', 'Biogesic', 'Unilab', '10', '', 'Capsule', '', 50, '1970-01-01', '0000-00-00'),
(18, 'ID36405', 'Paracetamol', 'Generic', '3', '', 'Capsule', 'Painkiller for aches and pains', 100, '2022-05-23', '2023-02-23'),
(20, 'ID39704', 'Vaporub inhaler', 'VICKS', '2000', '', 'Capsule', 'foir cough', 30, '2022-12-29', '2023-01-01'),
(22, 'ID93894', 'Vicks', 'Vaporub', '46', '', 'Analgesics', 'For caugh and remedy', 30000, '2023-01-31', '2024-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `table_order`
--

CREATE TABLE `table_order` (
  `table_id` int(11) NOT NULL,
  `table_name` text NOT NULL,
  `table_quantity` text NOT NULL,
  `table_price` double NOT NULL,
  `table_order_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_acquisition` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `user_id`, `user_name`, `user_username`, `user_password`, `user_email`, `user_birthday`, `user_acquisition`) VALUES
(7, 'ID-16559', 'Admin', 'admin', 'test', 'admin.test@dnsc.edu.ph', '2000-12-03', '2023-01-03 11:09:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `history_table`
--
ALTER TABLE `history_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `history_table`
--
ALTER TABLE `history_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
