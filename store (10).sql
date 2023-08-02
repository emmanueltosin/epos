-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 05:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_product_table`
--

CREATE TABLE `batch_product_table` (
  `SN` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `batch_code` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(12,3) NOT NULL,
  `quantity` bigint(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `date_recieved` date NOT NULL,
  `current_batch` enum('Yes','No') NOT NULL,
  `status` enum('sorted','unsorted') NOT NULL DEFAULT 'unsorted',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch_table`
--

CREATE TABLE `batch_table` (
  `SN` int(11) NOT NULL,
  `batch_id` varchar(30) NOT NULL,
  `expiry_date` date NOT NULL,
  `user` int(11) NOT NULL,
  `current_batch` enum('Yes','No') NOT NULL,
  `status` enum('sorted','unsorted') NOT NULL DEFAULT 'unsorted',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_table`
--

INSERT INTO `batch_table` (`SN`, `batch_id`, `expiry_date`, `user`, `current_batch`, `status`, `created`, `updated`) VALUES
(1, 'NH1616249768', '0000-00-00', 1, 'No', 'unsorted', '2021-03-20 14:16:08', '2021-03-20 15:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `SN` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` tinytext NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`SN`, `branch_name`, `branch_address`, `delete_status`, `created`, `updated`) VALUES
(1, 'Unilorin', 'ilorin city', 0, '2023-04-28 18:51:23', '2023-04-28 18:51:23'),
(2, 'GANMO,ILORIN', 'ganmo', 0, '2023-04-29 16:28:41', '2023-04-29 16:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `SN` int(11) NOT NULL,
  `category` tinytext NOT NULL,
  `vat` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`SN`, `category`, `vat`, `updated`, `created`) VALUES
(1, 'Taxable Product', 0, '2021-03-18 15:16:00', '2020-10-23 14:36:48'),
(2, 'Non Taxable Product', 0, '2020-10-23 14:37:01', '2020-10-23 14:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `credit_payment_history`
--

CREATE TABLE `credit_payment_history` (
  `sn` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `credit_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_id` varchar(100) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_payment_history`
--

INSERT INTO `credit_payment_history` (`sn`, `customer_id`, `date_added`, `amount`, `sales_rep`, `payment_method`, `credit_SN`, `branch_id`, `credit_id`, `reciept_id`, `created`, `updated`) VALUES
(1, 251, '2021-04-02', '1000', 1, 2, 5, 0, 'IH1617371644', 'JE1617371690', '2021-04-02 13:54:50', '2021-04-02 14:54:50'),
(2, 251, '2021-04-02', '13400', 1, 1, 5, 0, 'IH1617371644', 'EO1617371718', '2021-04-02 13:55:18', '2021-04-02 14:55:18'),
(3, 191, '2021-04-02', '3625000', 1, 2, 6, 0, 'RM1617372237', 'DS1617372348', '2021-04-02 14:05:48', '2021-04-02 15:05:48'),
(4, 191, '2021-04-02', '850100', 1, 2, 6, 0, 'RM1617372237', 'OY1617372375', '2021-04-02 14:06:15', '2021-04-02 15:06:15'),
(5, 250, '2021-04-02', '4320', 1, 2, 4, 0, 'DH1617371536', 'VN1617372627', '2021-04-02 14:10:27', '2021-04-02 15:10:27'),
(6, 250, '2021-04-02', '5000', 1, 2, 1, 0, 'EH1617371249', 'EM1617372781', '2021-04-02 14:13:01', '2021-04-02 15:13:01'),
(7, 90, '2021-04-07', '1500000', 1, 2, 7, 0, 'HC1617785871', 'RZ1617786120', '2021-04-07 09:02:00', '2021-04-07 10:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `SN` int(11) NOT NULL,
  `department` varchar(300) NOT NULL,
  `type` enum('Service','Sales','Others') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`SN`, `department`, `type`, `created`, `updated`) VALUES
(1, 'store', 'Sales', '2021-02-03 13:53:03', '2023-07-27 00:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` varchar(100) NOT NULL,
  `SN` bigint(30) NOT NULL,
  `date_added` date NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `product` text NOT NULL,
  `amount` varchar(500) NOT NULL,
  `reciept_id` varchar(500) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `reason_for_refund` text NOT NULL,
  `deposit_for` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `deposit_status` enum('PENDING-USAGE','USED','REFUND','PENDING') NOT NULL DEFAULT 'PENDING',
  `sales_id` int(11) NOT NULL,
  `refund_for` text NOT NULL,
  `date_refunded` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_payment_history`
--

CREATE TABLE `deposit_payment_history` (
  `sn` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `deposit_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `deposit_id` varchar(100) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `SN` int(11) NOT NULL,
  `genre` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_history`
--

CREATE TABLE `invoice_payment_history` (
  `sn` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `bank` int(11) NOT NULL,
  `description` text NOT NULL,
  `Invoice_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login_session`
--

CREATE TABLE `login_session` (
  `SN` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `department` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` enum('APPROVED','PENDING') NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_session`
--

INSERT INTO `login_session` (`SN`, `user_id`, `fullname`, `username`, `department`, `role`, `date_`, `time`, `status`) VALUES
(1, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-08', '05:39:35pm', 'PENDING'),
(2, 31, 'user user', 'user', 'FAITH', 'Sales Representative', '2021-09-11', '06:34:43pm', 'APPROVED'),
(3, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-11', '06:52:57pm', 'PENDING'),
(4, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-13', '09:59:59am', 'PENDING'),
(5, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-14', '09:57:56am', 'PENDING'),
(6, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-15', '10:02:53am', 'PENDING'),
(7, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-16', '09:19:18am', 'PENDING'),
(8, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-17', '10:42:38am', 'PENDING'),
(9, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-18', '11:02:17am', 'PENDING'),
(10, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-20', '09:32:52am', 'PENDING'),
(11, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-21', '10:16:56am', 'PENDING'),
(12, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-22', '09:44:02am', 'PENDING'),
(13, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-23', '09:23:47am', 'PENDING'),
(14, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-24', '09:45:14am', 'PENDING'),
(15, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-25', '10:55:04am', 'PENDING'),
(16, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-27', '09:22:53am', 'PENDING'),
(17, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-28', '10:27:01am', 'PENDING'),
(18, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-29', '09:57:55am', 'PENDING'),
(19, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-09-30', '09:41:59am', 'PENDING'),
(20, 30, 'Salesman Salesman', 'salesman', 'FAITH', 'Sales Representative', '2021-10-01', '10:53:14am', 'PENDING'),
(21, 32, 'emmanuel dosu', 'etrendit', 'FAITH', 'Sales Representative', '2023-04-28', '09:12:50pm', 'PENDING'),
(22, 37, 'emma  emma', 'emma', 'FAITH', 'Sales Representative', '2023-04-29', '06:35:36pm', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `SN` int(11) NOT NULL,
  `manufacturer` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`SN`, `manufacturer`, `updated`, `created`) VALUES
(1, 'FAITH', '2021-03-18 15:17:18', '2020-10-17 12:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `moved_history`
--

CREATE TABLE `moved_history` (
  `SN` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `qty_moved` int(11) NOT NULL,
  `remaining_qty` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `SN` int(11) NOT NULL,
  `moviecode` varchar(20) NOT NULL,
  `genre` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(400) NOT NULL,
  `movieyear` int(10) NOT NULL,
  `total_seat` int(11) NOT NULL,
  `single` varchar(10) NOT NULL,
  `category` int(11) NOT NULL,
  `couple` varchar(10) NOT NULL,
  `moviedate` date NOT NULL,
  `movietime` time NOT NULL,
  `duration` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies_shows`
--

CREATE TABLE `movies_shows` (
  `SN` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date_` date NOT NULL,
  `time_` time NOT NULL,
  `added_by` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `qty_sold` int(11) NOT NULL,
  `price` decimal(12,3) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `SN` int(11) NOT NULL,
  `vat` varchar(20) NOT NULL,
  `scharge` varchar(20) NOT NULL,
  `sname` text NOT NULL,
  `saddress_1` text NOT NULL,
  `saddress_2` text NOT NULL,
  `scontact_no` text NOT NULL,
  `footer_rec` text NOT NULL,
  `slogo` varchar(250) NOT NULL,
  `track_expiry_date` int(11) NOT NULL,
  `credit_limit` bigint(20) NOT NULL,
  `store_name` varchar(600) NOT NULL,
  `min_qty` int(11) NOT NULL,
  `pending_cart` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`SN`, `vat`, `scharge`, `sname`, `saddress_1`, `saddress_2`, `scontact_no`, `footer_rec`, `slogo`, `track_expiry_date`, `credit_limit`, `store_name`, `min_qty`, `pending_cart`, `created`, `updated`) VALUES
(1, '0', '0', 'FAITH VENTURES', '20, New Market Road, Baboko, Ilorin, Kwara State', '', '08173331279', 'Goods Received in Good Condition! No Refund of Money after Payment', 'http://localhost/store/store_assets/1629364953-store_logo.jpg', 20, 0, 'Ilorin Branchfffffff', 6, '{\"1324482601\":{\"hold_id\":1324482601,\"time\":\"03 July 2022, 08:31:20 PM\",\"total\":2400,\"items\":[{\"item_name\":\"Golden Penny Noodles\",\"item_price\":\"2400.00\",\"item_qty\":\"1\",\"total\":2400,\"id\":\"33\",\"type\":\"pieces\"}],\"department\":\"FAITH\",\"pending_cart_name\":\"admin\\/03\\/07\\/2022 08:31 pm\"}}', '2020-10-06 12:24:51', '2023-04-28 19:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `SN` int(11) NOT NULL,
  `payment_method` varchar(300) NOT NULL,
  `defaults` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`SN`, `payment_method`, `defaults`, `created`, `updated`) VALUES
(1, 'POS', 1, '2020-10-06 12:25:25', '2020-10-06 13:25:25'),
(2, 'CASH', 1, '2020-10-06 12:25:25', '2020-10-06 13:25:25'),
(3, 'DEPOSIT', 1, '2020-10-06 12:25:25', '2020-10-06 13:25:25'),
(4, 'TRANSFER', 0, '2020-10-06 12:25:25', '2020-10-06 13:25:25'),
(5, 'SPLIT', 0, '2023-01-11 14:42:14', '2023-01-11 15:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_bar_code`
--

CREATE TABLE `product_bar_code` (
  `SN` int(11) NOT NULL,
  `bar_code` tinytext NOT NULL,
  `stock_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `recieved_ref` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SN` int(11) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  `items` longtext NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `total_amount` decimal(16,2) NOT NULL,
  `status` enum('COMPLETE','VOID','HOLD','PICKUP') NOT NULL,
  `total_amount_paid` decimal(16,2) NOT NULL,
  `amount_tendered` varchar(40) NOT NULL,
  `total_profit` decimal(16,2) NOT NULL,
  `vat_amount` decimal(16,2) NOT NULL,
  `s_charge_amt` decimal(16,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sales_time` varchar(10) NOT NULL,
  `payment_type` enum('Direct','Invoice') NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `customer` int(11) NOT NULL,
  `reservation_invoice_link` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department` varchar(30) NOT NULL,
  `vat` decimal(16,2) NOT NULL,
  `scharge` decimal(16,2) NOT NULL,
  `reason` text NOT NULL,
  `voided_by` int(11) NOT NULL,
  `date_voided` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SN`, `reciept_id`, `items`, `discount_type`, `discount`, `total_amount`, `status`, `total_amount_paid`, `amount_tendered`, `total_profit`, `vat_amount`, `s_charge_amt`, `user_id`, `date`, `sales_time`, `payment_type`, `payment_method`, `customer`, `reservation_invoice_link`, `comment`, `branch_id`, `department`, `vat`, `scharge`, `reason`, `voided_by`, `date_voided`, `created`, `updated`) VALUES
(1, 'HS1673448177', '[{\"item_name\":\"Honeywell Flour\",\"item_price\":\"20200.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":20200,\"cost_price\":\"19500.00\",\"total_cost_price\":19500,\"profit\":700,\"id\":\"WH1617784692\"},{\"item_name\":\"CROWN Spaghetti\",\"item_price\":\"5500.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":5500,\"cost_price\":\"5400.00\",\"total_cost_price\":5400,\"profit\":100,\"id\":\"OV1629541193\"},{\"item_name\":\"Indomie Noodles (Super Pack)\",\"item_price\":\"4400.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":4400,\"cost_price\":\"4000.00\",\"total_cost_price\":4000,\"profit\":400,\"id\":\"QP1617785547\"}]', 2, '0.00', '30100.00', 'COMPLETE', '30100.00', '0', '1200.00', '0.00', '0.00', 1, '2023-01-11', '03:42 pm', 'Direct', '5', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 15:42:57', '2023-01-11 15:42:57'),
(2, 'VV1673448263', '[{\"item_name\":\"Haano Margarine (25g) SACHET\",\"item_price\":\"16000.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":16000,\"cost_price\":\"15000.00\",\"total_cost_price\":15000,\"profit\":1000,\"id\":\"XT1629552337\"}]', 2, '0.00', '16000.00', 'COMPLETE', '16000.00', '0', '1000.00', '0.00', '0.00', 1, '2023-01-11', '03:44 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 15:44:23', '2023-01-11 15:44:23'),
(3, 'GB1673448553', '[{\"item_name\":\"Dangote Salt\",\"item_price\":\"4400.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":4400,\"cost_price\":\"4200.00\",\"total_cost_price\":4200,\"profit\":200,\"id\":\"BA1619599352\"}]', 2, '0.00', '4400.00', 'COMPLETE', '4400.00', '0', '200.00', '0.00', '0.00', 1, '2023-01-11', '03:49 pm', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 15:49:13', '2023-01-11 15:49:13'),
(4, 'FZ1673448587', '[{\"item_name\":\"Dangote Salt\",\"item_price\":\"4400.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":4400,\"cost_price\":\"4200.00\",\"total_cost_price\":4200,\"profit\":200,\"id\":\"BA1619599352\"}]', 2, '0.00', '4400.00', 'COMPLETE', '4400.00', '0', '200.00', '0.00', '0.00', 1, '2023-01-11', '03:49 pm', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 15:49:47', '2023-01-11 15:49:47'),
(5, 'JN1673451021', '[{\"item_name\":\"Dangote Salt\",\"item_price\":\"4400.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":4400,\"cost_price\":\"4200.00\",\"total_cost_price\":4200,\"profit\":200,\"id\":\"BA1619599352\"}]', 2, '0.00', '4400.00', 'COMPLETE', '4400.00', '0', '200.00', '0.00', '0.00', 1, '2023-01-11', '04:30 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 16:30:21', '2023-01-11 16:30:21'),
(6, 'VT1673451037', '[{\"item_name\":\"Golden Penny Noodles (Jollof)\",\"item_price\":\"2400.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2400,\"cost_price\":\"2100.00\",\"total_cost_price\":2100,\"profit\":300,\"id\":\"WP1617785145\"}]', 2, '0.00', '2400.00', 'COMPLETE', '2400.00', '0', '300.00', '0.00', '0.00', 1, '2023-01-11', '04:30 pm', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 16:30:37', '2023-01-11 16:30:37'),
(7, 'YB1673451059', '[{\"item_name\":\"STK Royal Margarine (15kg)\",\"item_price\":\"16500.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":16500,\"cost_price\":\"16000.00\",\"total_cost_price\":16000,\"profit\":500,\"id\":\"QW1631969763\"}]', 2, '0.00', '16500.00', 'COMPLETE', '16500.00', '0', '500.00', '0.00', '0.00', 1, '2023-01-11', '04:30 pm', 'Direct', '5', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 16:30:59', '2023-01-11 16:30:59'),
(8, 'MI1673451072', '[{\"item_name\":\"CROWN Spaghetti\",\"item_price\":\"5500.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":5500,\"cost_price\":\"5400.00\",\"total_cost_price\":5400,\"profit\":100,\"id\":\"OV1629541193\"}]', 2, '0.00', '5500.00', 'COMPLETE', '5500.00', '0', '100.00', '0.00', '0.00', 1, '2023-01-11', '04:31 pm', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 16:31:12', '2023-01-11 16:31:12'),
(9, 'SF1673451125', '[{\"item_name\":\"Golden Penny Pasta Twist\",\"item_price\":\"6000.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":6000,\"cost_price\":\"5500.00\",\"total_cost_price\":5500,\"profit\":500,\"id\":\"WE1618392217\"}]', 2, '0.00', '6000.00', 'COMPLETE', '6000.00', '0', '500.00', '0.00', '0.00', 1, '2023-01-11', '04:32 pm', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-01-11 16:32:05', '2023-01-11 16:32:05'),
(10, 'XX1682786275', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '06:37 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:37:55', '2023-04-29 17:37:55'),
(11, 'PH1682786441', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '06:40 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:40:41', '2023-04-29 17:40:41'),
(12, 'FC1682786760', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '06:46 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:46:00', '2023-04-29 17:46:00'),
(13, 'DZ1682786858', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '06:47 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:47:38', '2023-04-29 17:47:38'),
(14, 'CJ1682786954', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '06:49 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:49:14', '2023-04-29 17:49:14'),
(15, 'JP1682787546', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '06:59 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:59:06', '2023-04-29 17:59:06'),
(16, 'XI1682787586', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '06:59 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 17:59:46', '2023-04-29 17:59:46'),
(17, 'VA1682787708', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:01 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:01:48', '2023-04-29 18:01:48'),
(18, 'FK1682787731', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:02 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:02:11', '2023-04-29 18:02:11'),
(19, 'KP1682787795', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:03 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:03:15', '2023-04-29 18:03:15'),
(20, 'LJ1682788156', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:09 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:09:16', '2023-04-29 18:09:16'),
(21, 'XQ1682788272', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:11 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:11:12', '2023-04-29 18:11:12'),
(22, 'VO1682788450', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '07:14 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:14:10', '2023-04-29 18:14:10'),
(23, 'ZR1682788508', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '07:15 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:15:08', '2023-04-29 18:15:08'),
(24, 'RB1682788612', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '2600', '60.00', '0.00', '0.00', 37, '2023-04-29', '07:16 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:16:52', '2023-04-29 18:16:52'),
(25, 'YU1682788758', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:19 pm', 'Direct', '2', 1, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:19:18', '2023-04-29 18:19:18'),
(26, 'UN1682788957', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:22 pm', 'Direct', '2', 1, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:22:37', '2023-04-29 18:22:37'),
(27, 'NW1682789022', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:23 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:23:42', '2023-04-29 18:23:42'),
(28, 'UD1682789245', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:27 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:27:25', '2023-04-29 18:27:25'),
(29, 'VK1682789325', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '07:28 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:28:45', '2023-04-29 18:28:45'),
(30, 'DO1682789709', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-04-29', '07:35 pm', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 18:35:09', '2023-04-29 18:35:09'),
(31, 'NQ1682791662', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 37, '2023-04-29', '08:07 pm', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-04-29 19:07:42', '2023-04-29 19:07:42'),
(32, 'UX1689153810', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1000\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060000,\"cost_price\":\"2000.00\",\"total_cost_price\":2000000,\"profit\":60000,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060000.00', 'COMPLETE', '2060000.00', '0', '60000.00', '0.00', '0.00', 1, '2023-07-12', '11:23 am', 'Direct', '1', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-12 10:23:30', '2023-07-12 10:23:30'),
(33, 'HT1689153928', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1000\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060000,\"cost_price\":\"2000.00\",\"total_cost_price\":2000000,\"profit\":60000,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060000.00', 'COMPLETE', '2060000.00', '0', '60000.00', '0.00', '0.00', 1, '2023-07-12', '11:25 am', 'Direct', '2', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-12 10:25:28', '2023-07-12 10:25:28'),
(34, 'BT1689154093', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"500\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":1030000,\"cost_price\":\"2000.00\",\"total_cost_price\":1000000,\"profit\":30000,\"id\":\"JM1682786246\"}]', 2, '0.00', '1030000.00', 'COMPLETE', '1030000.00', '0', '30000.00', '0.00', '0.00', 1, '2023-07-12', '11:28 am', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-12 10:28:13', '2023-07-12 10:28:13'),
(35, 'TA1689154308', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-07-12', '11:31 am', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-12 10:31:48', '2023-07-12 10:31:48'),
(36, 'UL1689154420', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"10\",\"product_type\":\"pieces\",\"department\":\"FAITH\",\"total\":20600,\"cost_price\":\"2000.00\",\"total_cost_price\":20000,\"profit\":600,\"id\":\"JM1682786246\"}]', 2, '0.00', '20600.00', 'COMPLETE', '20600.00', '0', '600.00', '0.00', '0.00', 1, '2023-07-12', '11:33 am', 'Direct', '4', 0, '', '', 0, 'FAITH', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-12 10:33:40', '2023-07-12 10:33:40'),
(37, 'DD1690418750', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"product_type\":\"pieces\",\"department\":\"store\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '0', '60.00', '0.00', '0.00', 1, '2023-07-27', '02:45 am', 'Direct', '1', 0, '', '', 0, 'store', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-27 01:45:50', '2023-07-27 01:45:50'),
(38, 'XP1690418774', '[{\"item_name\":\"sample - Packed\",\"item_price\":\"2900.000\",\"item_qty\":\"1\",\"product_type\":\"packed\",\"department\":\"store\",\"total\":2900,\"cost_price\":\"2000.000\",\"total_cost_price\":2000,\"profit\":900,\"id\":\"WK1689448151packed\"}]', 2, '0.00', '2900.00', 'COMPLETE', '2900.00', '0', '900.00', '0.00', '0.00', 1, '2023-07-27', '02:46 am', 'Direct', '2', 0, '', '', 0, 'store', '0.00', '0.00', '', 0, '0000-00-00', '2023-07-27 01:46:14', '2023-07-27 01:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `SN` int(11) NOT NULL,
  `servicecode` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `price` decimal(12,3) NOT NULL,
  `category` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE `service_category` (
  `SN` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `vat` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `SN` bigint(20) NOT NULL,
  `id_stock` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` longtext NOT NULL,
  `model` tinytext NOT NULL,
  `quantity` bigint(11) NOT NULL,
  `markup` int(11) NOT NULL,
  `cartoon_qty` int(11) NOT NULL,
  `shelve_quantity` bigint(20) NOT NULL,
  `item_packed` int(11) NOT NULL,
  `price` double(16,2) NOT NULL,
  `expired_date` date NOT NULL,
  `cost_price` double(16,2) NOT NULL,
  `date_available` date NOT NULL,
  `expiry_status` enum('Yes','No') NOT NULL,
  `last_stock_date` date NOT NULL,
  `image` tinytext NOT NULL,
  `department` varchar(40) NOT NULL,
  `bar_code_code` varchar(600) NOT NULL,
  `product_code` varchar(300) NOT NULL,
  `product_type` enum('Pieces','Packed') NOT NULL DEFAULT 'Pieces',
  `whole_price` decimal(12,3) NOT NULL,
  `whole_cost_price` decimal(12,3) NOT NULL,
  `status` int(11) NOT NULL,
  `manufacturer` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`SN`, `id_stock`, `product_name`, `product_description`, `model`, `quantity`, `markup`, `cartoon_qty`, `shelve_quantity`, `item_packed`, `price`, `expired_date`, `cost_price`, `date_available`, `expiry_status`, `last_stock_date`, `image`, `department`, `bar_code_code`, `product_code`, `product_type`, `whole_price`, `whole_cost_price`, `status`, `manufacturer`, `category_id`, `created`, `updated`) VALUES
(1, 'JM1682786246', 'MAMA GOLD', '', 'FLOUR', 13280, 3, 0, 0, 0, 2060.00, '0000-00-00', 2000.00, '2023-04-29', 'No', '2023-07-12', '', 'store', '', '', 'Pieces', '0.000', '0.000', 1, 1, 2, '2023-04-29 16:37:26', '2023-04-29 16:37:26'),
(2, 'WK1689448151', 'sample', '', '', 40, 45, 15, 0, 10, 290.00, '0000-00-00', 200.00, '2023-07-15', 'No', '2023-07-15', '', 'store', '', '', 'Packed', '2900.000', '2000.000', 1, 0, 2, '2023-07-15 19:09:11', '2023-07-15 19:09:11'),
(3, 'RW1690418583', 'olaburns', '', '', 0, 2, 0, 0, 0, 20.00, '0000-00-00', 20.00, '2023-07-27', 'No', '0000-00-00', '', 'store', '', '', 'Pieces', '0.000', '0.000', 1, 0, 2, '2023-07-27 00:43:03', '2023-07-27 00:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `stock_open_close`
--

CREATE TABLE `stock_open_close` (
  `SN` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `id_stock` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `opening` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `closing` int(11) NOT NULL,
  `transfered` int(11) NOT NULL,
  `recieved` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_recieved`
--

CREATE TABLE `stock_recieved` (
  `SN` bigint(11) NOT NULL,
  `recieved_id` varchar(25) NOT NULL,
  `products` longtext NOT NULL,
  `recieved_date` date NOT NULL,
  `branch` varchar(200) NOT NULL,
  `supplier` int(11) NOT NULL,
  `reciever_userfullname` int(11) NOT NULL,
  `transfer_user` varchar(255) NOT NULL,
  `confirm_userfullname` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_recieved`
--

INSERT INTO `stock_recieved` (`SN`, `recieved_id`, `products`, `recieved_date`, `branch`, `supplier`, `reciever_userfullname`, `transfer_user`, `confirm_userfullname`, `note`, `branch_id`, `created`, `updated`) VALUES
(1, 'FS1616404637', '[{\"qty\":\"2933\",\"remark\":\"Received\",\"product\":\"KY1616404637\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 09:17:17', '2021-03-22 09:17:17'),
(2, 'VB1616404683', '[{\"qty\":\"458\",\"remark\":\"Received\",\"product\":\"PW1616404683\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 09:18:03', '2021-03-22 09:18:03'),
(3, 'YH1616406732', '[{\"qty\":\"460\",\"remark\":\"Received\",\"product\":\"IK1616406732\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 09:52:12', '2021-03-22 09:52:12'),
(4, 'AM1616406927', '[{\"qty\":\"273\",\"remark\":\"Received\",\"product\":\"RQ1616406927\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 09:55:27', '2021-03-22 09:55:27'),
(5, 'UW1616408839', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"IH1616408839\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 10:27:19', '2021-03-22 10:27:19'),
(6, 'XP1616409065', '[{\"qty\":\"240\",\"remark\":\"Received\",\"product\":\"VY1616409065\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 10:31:05', '2021-03-22 10:31:05'),
(7, 'SA1616409347', '[{\"qty\":\"550\",\"remark\":\"Received\",\"product\":\"CA1616409347\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 10:35:48', '2021-03-22 10:35:48'),
(8, 'QO1616410641', '[{\"qty\":\"9\",\"remark\":\"Received\",\"product\":\"TL1616410641\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 10:57:22', '2021-03-22 10:57:22'),
(9, 'GQ1616410975', '[{\"qty\":\"711\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:02:56', '2021-03-22 11:02:56'),
(10, 'IM1616411792', '[{\"qty\":\"576\",\"remark\":\"Received\",\"product\":\"IO1616411792\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:16:32', '2021-03-22 11:16:32'),
(11, 'WL1616411841', '[{\"qty\":\"1541\",\"remark\":\"Received\",\"product\":\"IF1616411841\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:17:21', '2021-03-22 11:17:21'),
(12, 'PQ1616412016', '[{\"qty\":\"360\",\"remark\":\"Received\",\"product\":\"IN1616412016\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:20:16', '2021-03-22 11:20:16'),
(13, 'ZF1616412433', '[{\"qty\":\"187\",\"remark\":\"Received\",\"product\":\"MU1616412432\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:27:14', '2021-03-22 11:27:14'),
(14, 'VV1616413517', '[{\"qty\":\"188\",\"remark\":\"Received\",\"product\":\"LG1616413517\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:45:17', '2021-03-22 11:45:17'),
(15, 'AI1616413905', '[{\"qty\":\"442\",\"remark\":\"Received\",\"product\":\"FU1616413905\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:51:45', '2021-03-22 11:51:45'),
(16, 'HJ1616413940', '[{\"qty\":\"362\",\"remark\":\"Received\",\"product\":\"MY1616413940\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 11:52:20', '2021-03-22 11:52:20'),
(17, 'XC1616416337', '[{\"qty\":\"420\",\"remark\":\"Received\",\"product\":\"FK1616416337\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 12:32:18', '2021-03-22 12:32:18'),
(18, 'BZ1616418862', '[{\"qty\":\"161\",\"remark\":\"Received\",\"product\":\"GS1616418861\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 13:14:22', '2021-03-22 13:14:22'),
(19, 'OD1616420268', '[{\"qty\":\"1254\",\"remark\":\"Received\",\"product\":\"CX1616420267\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 13:37:48', '2021-03-22 13:37:48'),
(20, 'OJ1616425631', '[{\"qty\":\"175\",\"remark\":\"Received\",\"product\":\"HV1616425631\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 15:07:11', '2021-03-22 15:07:11'),
(21, 'XZ1616430322', '[{\"qty\":\"311\",\"remark\":\"Received\",\"product\":\"EJ1616430322\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 16:25:22', '2021-03-22 16:25:22'),
(22, 'BK1616435588', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 17:53:08', '2021-03-22 17:53:08'),
(23, 'YQ1616435985', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 17:59:45', '2021-03-22 17:59:45'),
(24, 'YE1616446861', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 21:01:01', '2021-03-22 21:01:01'),
(25, 'DE1616447509', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"16\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 21:11:49', '2021-03-22 21:11:49'),
(26, 'FB1616448348', '[{\"qty\":\"199\",\"remark\":\"Received\",\"product\":\"JQ1616448348\"}]', '2021-03-22', '', 1, 1, 'Almas', '', '', 0, '2021-03-22 21:25:48', '2021-03-22 21:25:48'),
(27, 'NT1616492350', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"10\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 09:39:10', '2021-03-23 09:39:10'),
(28, 'UU1616518106', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 16:48:26', '2021-03-23 16:48:26'),
(29, 'EN1616518139', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 16:48:59', '2021-03-23 16:48:59'),
(30, 'CO1616518184', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 16:49:44', '2021-03-23 16:49:44'),
(31, 'JB1616518893', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 17:01:33', '2021-03-23 17:01:33'),
(32, 'VA1616518907', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-03-23', '', 1, 1, 'Almas', '', '', 0, '2021-03-23 17:01:47', '2021-03-23 17:01:47'),
(33, 'ZQ1616580701', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"7\"}]', '2021-03-24', '', 1, 1, 'Almas', '', '', 0, '2021-03-24 10:11:41', '2021-03-24 10:11:41'),
(34, 'JJ1616589866', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-24', '', 1, 1, 'Almas', '', '', 0, '2021-03-24 12:44:26', '2021-03-24 12:44:26'),
(35, 'VA1616594407', '[{\"qty\":\"1800\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-24', '', 1, 1, 'Almas', '', '', 0, '2021-03-24 14:00:07', '2021-03-24 14:00:07'),
(36, 'BE1616597616', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-24', '', 1, 1, 'Almas', '', '', 0, '2021-03-24 14:53:36', '2021-03-24 14:53:36'),
(37, 'BE1616607882', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-03-24', '', 1, 1, 'Almas', '', '', 0, '2021-03-24 17:44:43', '2021-03-24 17:44:43'),
(38, 'NC1616691061', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-25', '', 1, 1, 'Almas', '', '', 0, '2021-03-25 16:51:01', '2021-03-25 16:51:01'),
(39, 'KL1616778602', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"16\"}]', '2021-03-26', '', 1, 1, 'Almas', '', '', 0, '2021-03-26 17:10:02', '2021-03-26 17:10:02'),
(40, 'WN1616778654', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-03-26', '', 1, 1, 'Almas', '', '', 0, '2021-03-26 17:10:54', '2021-03-26 17:10:54'),
(41, 'PR1616842928', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"3\"}]', '2021-03-27', '', 1, 1, 'Almas', '', '', 0, '2021-03-27 11:02:08', '2021-03-27 11:02:08'),
(42, 'UV1616863309', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-27', '', 1, 1, 'Almas', '', '', 0, '2021-03-27 16:41:50', '2021-03-27 16:41:50'),
(43, 'MA1616863325', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-03-27', '', 1, 1, 'Almas', '', '', 0, '2021-03-27 16:42:05', '2021-03-27 16:42:05'),
(44, 'JC1617011263', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"7\"}]', '2021-03-29', '', 1, 1, 'Almas', '', '', 0, '2021-03-29 09:47:44', '2021-03-29 09:47:44'),
(45, 'SL1617018212', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-03-29', '', 1, 1, 'Almas', '', '', 0, '2021-03-29 11:43:32', '2021-03-29 11:43:32'),
(46, 'IA1617025245', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-03-29', '', 1, 1, 'Almas', '', '', 0, '2021-03-29 13:40:46', '2021-03-29 13:40:46'),
(47, 'AY1617037291', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"16\"}]', '2021-03-29', '', 1, 1, 'Almas', '', '', 0, '2021-03-29 17:01:32', '2021-03-29 17:01:32'),
(48, 'PJ1617121945', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-30', '', 1, 1, 'Almas', '', '', 0, '2021-03-30 16:32:26', '2021-03-30 16:32:26'),
(49, 'WD1617202454', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"7\"}]', '2021-03-31', '', 1, 1, 'Almas', '', '', 0, '2021-03-31 14:54:15', '2021-03-31 14:54:15'),
(50, 'IK1617202464', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"20\"}]', '2021-03-31', '', 1, 1, 'Almas', '', '', 0, '2021-03-31 14:54:24', '2021-03-31 14:54:24'),
(51, 'NC1617210121', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-03-31', '', 1, 1, 'Almas', '', '', 0, '2021-03-31 17:02:01', '2021-03-31 17:02:01'),
(52, 'DO1617211139', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-03-31', '', 1, 1, 'Almas', '', '', 0, '2021-03-31 17:18:59', '2021-03-31 17:18:59'),
(53, 'YD1617292779', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-04-01', '', 1, 1, 'Almas', '', '', 0, '2021-04-01 15:59:39', '2021-04-01 15:59:39'),
(54, 'UZ1617292791', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"21\"}]', '2021-04-01', '', 1, 1, 'Almas', '', '', 0, '2021-04-01 15:59:51', '2021-04-01 15:59:51'),
(55, 'KY1617292803', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"13\"}]', '2021-04-01', '', 1, 1, 'Almas', '', '', 0, '2021-04-01 16:00:03', '2021-04-01 16:00:03'),
(56, 'RV1617298078', '[{\"qty\":\"1799\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-01', '', 1, 1, 'Almas', '', '', 0, '2021-04-01 17:27:58', '2021-04-01 17:27:58'),
(57, 'SX1617299381', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"4\"}]', '2021-04-01', '', 1, 1, 'Almas', '', '', 0, '2021-04-01 17:49:41', '2021-04-01 17:49:41'),
(58, 'BM1617366786', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 12:33:06', '2021-04-02 12:33:06'),
(59, 'RY1617371126', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"KN1617371126\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 13:45:26', '2021-04-02 13:45:26'),
(60, 'SH1617377194', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:26:35', '2021-04-02 15:26:35'),
(61, 'EM1617377374', '[{\"qty\":\"25\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:29:34', '2021-04-02 15:29:34'),
(62, 'EN1617377433', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:30:33', '2021-04-02 15:30:33'),
(63, 'KR1617377886', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:38:06', '2021-04-02 15:38:06'),
(64, 'MM1617377907', '[{\"qty\":\"25\",\"remark\":\"Received\",\"product\":\"15\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:38:27', '2021-04-02 15:38:27'),
(65, 'BA1617377920', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"6\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 15:38:40', '2021-04-02 15:38:40'),
(66, 'BH1617382436', '[{\"qty\":\"800\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-02', '', 1, 1, 'Almas', '', '', 0, '2021-04-02 16:53:57', '2021-04-02 16:53:57'),
(67, 'SQ1617438428', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-04-03', '', 1, 1, 'Almas', '', '', 0, '2021-04-03 08:27:08', '2021-04-03 08:27:08'),
(68, 'AS1617439232', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"6\"}]', '2021-04-03', '', 1, 1, 'Almas', '', '', 0, '2021-04-03 08:40:32', '2021-04-03 08:40:32'),
(69, 'IU1617440424', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"5\"}]', '2021-04-03', '', 1, 1, 'Almas', '', '', 0, '2021-04-03 09:00:24', '2021-04-03 09:00:24'),
(70, 'GY1617440571', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"6\"}]', '2021-04-03', '', 1, 1, 'Almas', '', '', 0, '2021-04-03 09:02:51', '2021-04-03 09:02:51'),
(71, 'ES1617450249', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-03', '', 1, 1, 'Almas', '', '', 0, '2021-04-03 11:44:10', '2021-04-03 11:44:10'),
(72, 'BG1617638110', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-05', '', 1, 1, 'Almas', '', '', 0, '2021-04-05 15:55:10', '2021-04-05 15:55:10'),
(73, 'XD1617639928', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"14\"}]', '2021-04-05', '', 1, 1, 'Almas', '', '', 0, '2021-04-05 16:25:28', '2021-04-05 16:25:28'),
(74, 'AM1617706726', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"DR1617706726\"}]', '2021-04-06', '', 1, 1, 'Almas', '', '', 0, '2021-04-06 10:58:46', '2021-04-06 10:58:46'),
(75, 'WQ1617728949', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-04-06', '', 1, 1, 'Almas', '', '', 0, '2021-04-06 17:09:09', '2021-04-06 17:09:09'),
(76, 'QA1617784468', '[{\"qty\":\"3029\",\"remark\":\"Received\",\"product\":\"YE1617784468\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:34:28', '2021-04-07 08:34:28'),
(77, 'FC1617784502', '[{\"qty\":\"876\",\"remark\":\"Received\",\"product\":\"FM1617784502\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:35:02', '2021-04-07 08:35:02'),
(78, 'HU1617784601', '[{\"qty\":\"690\",\"remark\":\"Received\",\"product\":\"HV1617784601\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:36:42', '2021-04-07 08:36:42'),
(79, 'QN1617784692', '[{\"qty\":\"163\",\"remark\":\"Received\",\"product\":\"WH1617784692\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:38:13', '2021-04-07 08:38:13'),
(80, 'XT1617784738', '[{\"qty\":\"408\",\"remark\":\"Received\",\"product\":\"TQ1617784737\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:38:58', '2021-04-07 08:38:58'),
(81, 'XL1617784786', '[{\"qty\":\"69\",\"remark\":\"Received\",\"product\":\"ZP1617784786\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:39:47', '2021-04-07 08:39:47'),
(82, 'CB1617784819', '[{\"qty\":\"431\",\"remark\":\"Received\",\"product\":\"PV1617784819\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:40:19', '2021-04-07 08:40:19'),
(83, 'US1617784860', '[{\"qty\":\"240\",\"remark\":\"Received\",\"product\":\"WM1617784860\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:41:01', '2021-04-07 08:41:01'),
(84, 'WI1617784914', '[{\"qty\":\"94\",\"remark\":\"Received\",\"product\":\"RM1617784914\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:41:54', '2021-04-07 08:41:54'),
(85, 'GE1617785112', '[{\"qty\":\"890\",\"remark\":\"Received\",\"product\":\"HC1617785112\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:45:13', '2021-04-07 08:45:13'),
(86, 'BT1617785145', '[{\"qty\":\"66\",\"remark\":\"Received\",\"product\":\"WP1617785145\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:45:45', '2021-04-07 08:45:45'),
(87, 'HF1617785253', '[{\"qty\":\"508\",\"remark\":\"Received\",\"product\":\"WA1617785252\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:47:33', '2021-04-07 08:47:33'),
(88, 'PU1617785311', '[{\"qty\":\"156\",\"remark\":\"Received\",\"product\":\"PZ1617785310\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:48:31', '2021-04-07 08:48:31'),
(89, 'CZ1617785348', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"DZ1617785348\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:49:09', '2021-04-07 08:49:09'),
(90, 'BU1617785486', '[{\"qty\":\"144\",\"remark\":\"Received\",\"product\":\"QH1617785486\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:51:26', '2021-04-07 08:51:26'),
(91, 'OV1617785547', '[{\"qty\":\"481\",\"remark\":\"Received\",\"product\":\"QP1617785547\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:52:27', '2021-04-07 08:52:27'),
(92, 'IN1617785734', '[{\"qty\":\"120\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:55:34', '2021-04-07 08:55:34'),
(93, 'CE1617785743', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-07', '', 1, 1, 'Almas', '', '', 0, '2021-04-07 08:55:43', '2021-04-07 08:55:43'),
(97, 'HS1617964486', '[{\"qty\":\"15\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-04-09', '', 1, 1, 'Almas', '', '', 0, '2021-04-09 10:34:46', '2021-04-09 10:34:46'),
(98, 'OZ1617964501', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-04-09', '', 1, 1, 'Almas', '', '', 0, '2021-04-09 10:35:01', '2021-04-09 10:35:01'),
(99, 'JT1617987962', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-09', '', 1, 1, 'Almas', '', '', 0, '2021-04-09 17:06:02', '2021-04-09 17:06:02'),
(100, 'YX1618042168', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 08:09:29', '2021-04-10 08:09:29'),
(101, 'UC1618042391', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 08:13:11', '2021-04-10 08:13:11'),
(102, 'KW1618042413', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 08:13:33', '2021-04-10 08:13:33'),
(103, 'DC1618055480', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 11:51:20', '2021-04-10 11:51:20'),
(104, 'RG1618055511', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 11:51:51', '2021-04-10 11:51:51'),
(105, 'NK1618055580', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 11:53:00', '2021-04-10 11:53:00'),
(106, 'RS1618066259', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 14:50:59', '2021-04-10 14:50:59'),
(107, 'WD1618066285', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 14:51:26', '2021-04-10 14:51:26'),
(108, 'ZJ1618074477', '[{\"qty\":\"9\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:07:58', '2021-04-10 17:07:58'),
(109, 'VN1618074491', '[{\"qty\":\"11\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:08:11', '2021-04-10 17:08:11'),
(110, 'CL1618074535', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"37\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:08:55', '2021-04-10 17:08:55'),
(111, 'KA1618074552', '[{\"qty\":\"15\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:09:12', '2021-04-10 17:09:12'),
(112, 'RO1618074565', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:09:25', '2021-04-10 17:09:25'),
(113, 'CK1618074578', '[{\"qty\":\"8\",\"remark\":\"Received\",\"product\":\"38\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:09:39', '2021-04-10 17:09:39'),
(114, 'SJ1618074592', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:09:52', '2021-04-10 17:09:52'),
(115, 'EN1618074603', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"36\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:10:03', '2021-04-10 17:10:03'),
(116, 'YC1618074616', '[{\"qty\":\"14\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-04-10', '', 1, 1, 'Almas', '', '', 0, '2021-04-10 17:10:16', '2021-04-10 17:10:16'),
(117, 'PQ1618221667', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 10:01:07', '2021-04-12 10:01:07'),
(118, 'VB1618229330', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 12:08:51', '2021-04-12 12:08:51'),
(119, 'KW1618230490', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 12:28:10', '2021-04-12 12:28:10'),
(120, 'ML1618230559', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 12:29:20', '2021-04-12 12:29:20'),
(121, 'EU1618241880', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 15:38:00', '2021-04-12 15:38:00'),
(122, 'HE1618241902', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"31\"}]', '2021-04-12', '', 1, 1, 'Almas', '', '', 0, '2021-04-12 15:38:22', '2021-04-12 15:38:22'),
(123, 'KV1618304344', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-13', '', 1, 1, 'Almas', '', '', 0, '2021-04-13 08:59:04', '2021-04-13 08:59:04'),
(124, 'NS1618304357', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-13', '', 1, 1, 'Almas', '', '', 0, '2021-04-13 08:59:17', '2021-04-13 08:59:17'),
(125, 'AQ1618315345', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-13', '', 1, 1, 'Almas', '', '', 0, '2021-04-13 12:02:25', '2021-04-13 12:02:25'),
(126, 'GG1618315356', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-13', '', 1, 1, 'Almas', '', '', 0, '2021-04-13 12:02:37', '2021-04-13 12:02:37'),
(127, 'QX1618324612', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-13', '', 1, 1, 'Almas', '', '', 0, '2021-04-13 14:36:52', '2021-04-13 14:36:52'),
(128, 'PH1618390610', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 08:56:50', '2021-04-14 08:56:50'),
(129, 'KD1618391402', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 09:10:02', '2021-04-14 09:10:02'),
(130, 'IG1618392217', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"WE1618392217\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 09:23:38', '2021-04-14 09:23:38'),
(131, 'TA1618397412', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 10:50:12', '2021-04-14 10:50:12'),
(132, 'UX1618404198', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 12:43:18', '2021-04-14 12:43:18'),
(133, 'QN1618409993', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"GX1618409993\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 14:19:54', '2021-04-14 14:19:54'),
(134, 'EP1618412697', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 15:04:58', '2021-04-14 15:04:58'),
(135, 'AU1618416206', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"29\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 16:03:27', '2021-04-14 16:03:27'),
(136, 'MR1618416247', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 16:04:07', '2021-04-14 16:04:07'),
(137, 'XD1618418650', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-14', '', 1, 1, 'Almas', '', '', 0, '2021-04-14 16:44:10', '2021-04-14 16:44:10'),
(138, 'SA1618488814', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 12:13:35', '2021-04-15 12:13:35'),
(139, 'XT1618489925', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"AT1618489925\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 12:32:05', '2021-04-15 12:32:05'),
(140, 'QW1618489985', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"TS1618489985\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 12:33:06', '2021-04-15 12:33:06'),
(141, 'RC1618490018', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"TC1618490017\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 12:33:38', '2021-04-15 12:33:38'),
(142, 'TH1618504154', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 16:29:14', '2021-04-15 16:29:14'),
(143, 'OK1618504169', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 16:29:29', '2021-04-15 16:29:29'),
(144, 'JC1618509111', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-15', '', 1, 1, 'Almas', '', '', 0, '2021-04-15 17:51:51', '2021-04-15 17:51:51'),
(145, 'IG1618654754', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"SO1618654754\"}]', '2021-04-17', '', 1, 1, 'Almas', '', '', 0, '2021-04-17 10:19:14', '2021-04-17 10:19:14'),
(146, 'ZI1618676068', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"41\"}]', '2021-04-17', '', 1, 1, 'Almas', '', '', 0, '2021-04-17 16:14:28', '2021-04-17 16:14:28'),
(147, 'DD1618676165', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-17', '', 1, 1, 'Almas', '', '', 0, '2021-04-17 16:16:05', '2021-04-17 16:16:05'),
(148, 'CS1618821575', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"PT1618821574\"}]', '2021-04-19', '', 1, 1, 'Almas', '', '', 0, '2021-04-19 08:39:35', '2021-04-19 08:39:35'),
(149, 'GT1618823288', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-04-19', '', 1, 1, 'Almas', '', '', 0, '2021-04-19 09:08:08', '2021-04-19 09:08:08'),
(150, 'NK1618835060', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-04-19', '', 1, 1, 'Almas', '', '', 0, '2021-04-19 12:24:20', '2021-04-19 12:24:20'),
(151, 'QP1618835095', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-04-19', '', 1, 1, 'Almas', '', '', 0, '2021-04-19 12:24:55', '2021-04-19 12:24:55'),
(152, 'MA1618910144', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 09:15:44', '2021-04-20 09:15:44'),
(153, 'LF1618914589', '[{\"qty\":\"599\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 10:29:50', '2021-04-20 10:29:50'),
(154, 'KF1618914641', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 10:30:41', '2021-04-20 10:30:41'),
(155, 'NH1618916310', '[{\"qty\":\"150\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 10:58:30', '2021-04-20 10:58:30'),
(156, 'XQ1618916326', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 10:58:46', '2021-04-20 10:58:46'),
(157, 'XD1618916484', '[{\"qty\":\"62\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 11:01:25', '2021-04-20 11:01:25'),
(158, 'RO1618920604', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 12:10:04', '2021-04-20 12:10:04'),
(159, 'ID1618932753', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"41\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 15:32:33', '2021-04-20 15:32:33'),
(160, 'QA1618932778', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"30\"}]', '2021-04-20', '', 1, 1, 'Almas', '', '', 0, '2021-04-20 15:32:58', '2021-04-20 15:32:58'),
(161, 'UZ1618989919', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 07:25:19', '2021-04-21 07:25:19'),
(162, 'WG1619008425', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 12:33:45', '2021-04-21 12:33:45'),
(163, 'TG1619018839', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 15:27:19', '2021-04-21 15:27:19'),
(164, 'VB1619019349', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 15:35:49', '2021-04-21 15:35:49'),
(165, 'SY1619019358', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 15:35:58', '2021-04-21 15:35:58'),
(166, 'YO1619022638', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-21', '', 1, 1, 'Almas', '', '', 0, '2021-04-21 16:30:38', '2021-04-21 16:30:38'),
(167, 'JD1619088443', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-22', '', 1, 1, 'Almas', '', '', 0, '2021-04-22 10:47:23', '2021-04-22 10:47:23'),
(168, 'GY1619105604', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-22', '', 1, 1, 'Almas', '', '', 0, '2021-04-22 15:33:24', '2021-04-22 15:33:24'),
(169, 'HR1619178705', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-23', '', 1, 1, 'Almas', '', '', 0, '2021-04-23 11:51:45', '2021-04-23 11:51:45'),
(170, 'XK1619178716', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-23', '', 1, 1, 'Almas', '', '', 0, '2021-04-23 11:51:56', '2021-04-23 11:51:56'),
(171, 'VF1619169455', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-23', '', 1, 1, 'Almas', '', '', 0, '2021-04-23 09:17:35', '2021-04-23 09:17:35'),
(172, 'NZ1619169464', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-23', '', 1, 1, 'Almas', '', '', 0, '2021-04-23 09:17:44', '2021-04-23 09:17:44'),
(173, 'EI1619276000', '[{\"qty\":\"15\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-24', '', 1, 1, 'Almas', '', '', 0, '2021-04-24 14:53:20', '2021-04-24 14:53:20'),
(174, 'VL1619283222', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"28\"}]', '2021-04-24', '', 1, 1, 'Almas', '', '', 0, '2021-04-24 16:53:42', '2021-04-24 16:53:42'),
(175, 'ON1619283398', '[{\"qty\":\"15\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-24', '', 1, 1, 'Almas', '', '', 0, '2021-04-24 16:56:38', '2021-04-24 16:56:38'),
(176, 'UI1619283549', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-24', '', 1, 1, 'Almas', '', '', 0, '2021-04-24 16:59:09', '2021-04-24 16:59:09'),
(177, 'PV1619421796', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 07:23:16', '2021-04-26 07:23:16'),
(178, 'DI1619422571', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 07:36:11', '2021-04-26 07:36:11'),
(179, 'CP1619422584', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 07:36:24', '2021-04-26 07:36:24'),
(180, 'GL1619250877', '[{\"qty\":\"400\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-24', '', 1, 1, 'Almas', '', '', 0, '2021-04-24 07:54:37', '2021-04-24 07:54:37'),
(181, 'MD1619431112', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 09:58:32', '2021-04-26 09:58:32'),
(182, 'JP1619431122', '[{\"qty\":\"6\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 09:58:42', '2021-04-26 09:58:42'),
(183, 'KY1619457328', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-26', '', 1, 1, 'Almas', '', '', 0, '2021-04-26 17:15:28', '2021-04-26 17:15:28'),
(184, 'EO1619511556', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"25\"}]', '2021-04-27', '', 1, 1, 'Almas', '', '', 0, '2021-04-27 08:19:16', '2021-04-27 08:19:16'),
(185, 'CD1619511568', '[{\"qty\":\"80\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-04-27', '', 1, 1, 'Almas', '', '', 0, '2021-04-27 08:19:28', '2021-04-27 08:19:28'),
(186, 'OB1619527968', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"FN1619527968\"}]', '2021-04-27', '', 1, 1, 'Almas', '', '', 0, '2021-04-27 12:52:48', '2021-04-27 12:52:48'),
(187, 'SB1619540900', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"24\"}]', '2021-04-27', '', 1, 1, 'Almas', '', '', 0, '2021-04-27 16:28:20', '2021-04-27 16:28:20'),
(188, 'EN1619598898', '[{\"qty\":\"979\",\"remark\":\"Received\",\"product\":\"PC1619598898\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:34:58', '2021-04-28 08:34:58'),
(189, 'AK1619599026', '[{\"qty\":\"709\",\"remark\":\"Received\",\"product\":\"VN1619599026\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:37:07', '2021-04-28 08:37:07'),
(190, 'YV1619599224', '[{\"qty\":\"969\",\"remark\":\"Received\",\"product\":\"KJ1619599224\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:40:24', '2021-04-28 08:40:24'),
(191, 'PC1619599352', '[{\"qty\":\"742\",\"remark\":\"Received\",\"product\":\"BA1619599352\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:42:32', '2021-04-28 08:42:32'),
(192, 'WY1619599995', '[{\"qty\":\"199\",\"remark\":\"Received\",\"product\":\"EF1619599995\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:53:16', '2021-04-28 08:53:16'),
(193, 'FX1619600147', '[{\"qty\":\"148\",\"remark\":\"Received\",\"product\":\"IR1619600147\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:55:47', '2021-04-28 08:55:47'),
(194, 'GH1619600198', '[{\"qty\":\"378\",\"remark\":\"Received\",\"product\":\"RH1619600198\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 08:56:38', '2021-04-28 08:56:38'),
(195, 'QM1619607107', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 10:51:47', '2021-04-28 10:51:47'),
(196, 'UF1619621393', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"ZR1619621393\"}]', '2021-04-28', '', 1, 1, 'Almas', '', '', 0, '2021-04-28 14:49:53', '2021-04-28 14:49:53'),
(197, 'YN1619705042', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-04-29', '', 1, 1, 'Almas', '', '', 0, '2021-04-29 14:04:02', '2021-04-29 14:04:02'),
(198, 'OZ1619705082', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-04-29', '', 1, 1, 'Almas', '', '', 0, '2021-04-29 14:04:42', '2021-04-29 14:04:42'),
(199, 'IQ1619804284', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-04-30', '', 1, 1, 'Almas', '', '', 0, '2021-04-30 17:38:04', '2021-04-30 17:38:04'),
(200, 'RH1619881150', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-01', '', 1, 1, 'Almas', '', '', 0, '2021-05-01 14:59:10', '2021-05-01 14:59:10'),
(201, 'NM1619885211', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-01', '', 1, 1, 'Almas', '', '', 0, '2021-05-01 16:06:51', '2021-05-01 16:06:51'),
(202, 'YA1619885224', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-05-01', '', 1, 1, 'Almas', '', '', 0, '2021-05-01 16:07:04', '2021-05-01 16:07:04'),
(203, 'VF1619886564', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-05-01', '', 1, 1, 'Almas', '', '', 0, '2021-05-01 16:29:24', '2021-05-01 16:29:24'),
(204, 'EU1620028530', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 07:55:30', '2021-05-03 07:55:30'),
(205, 'FT1620032535', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 09:02:15', '2021-05-03 09:02:15'),
(206, 'MS1620033245', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 09:14:05', '2021-05-03 09:14:05'),
(207, 'QL1620034637', '[{\"qty\":\"6\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 09:37:17', '2021-05-03 09:37:17'),
(208, 'GB1620038294', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"RX1620038294\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 10:38:15', '2021-05-03 10:38:15'),
(209, 'JD1620038325', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"44\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 10:38:45', '2021-05-03 10:38:45'),
(210, 'IP1620038338', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"43\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 10:38:59', '2021-05-03 10:38:59'),
(211, 'LL1620038393', '[{\"qty\":\"2000\",\"remark\":\"Received\",\"product\":\"42\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 10:39:53', '2021-05-03 10:39:53'),
(212, 'TL1620039752', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"42\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 11:02:33', '2021-05-03 11:02:33'),
(213, 'PU1620051091', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 14:11:31', '2021-05-03 14:11:31'),
(214, 'RP1620052504', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 14:35:05', '2021-05-03 14:35:05'),
(215, 'DD1620052833', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-05-03', '', 1, 1, 'Almas', '', '', 0, '2021-05-03 14:40:33', '2021-05-03 14:40:33'),
(216, 'OJ1629179920', '[{\"qty\":\"302\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 05:58:40', '2021-08-17 05:58:40'),
(217, 'QE1629185753', '[{\"qty\":\"153\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 07:35:53', '2021-08-17 07:35:53'),
(218, 'DE1629185783', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"32\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 07:36:23', '2021-08-17 07:36:23'),
(219, 'TC1629185848', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 07:37:28', '2021-08-17 07:37:28'),
(220, 'DS1629186016', '[{\"qty\":\"227\",\"remark\":\"Received\",\"product\":\"44\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 07:40:17', '2021-08-17 07:40:17'),
(221, 'VG1629186200', '[{\"qty\":\"14\",\"remark\":\"Received\",\"product\":\"YG1629186200\"}]', '2021-08-17', '', 1, 1, 'Almas', '', '', 0, '2021-08-17 07:43:21', '2021-08-17 07:43:21'),
(222, 'CU1628927181', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"57\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 07:46:21', '2021-08-14 07:46:21'),
(223, 'CD1626249139', '[{\"qty\":\"9\",\"remark\":\"Received\",\"product\":\"ZC1626249139\"}]', '2021-07-14', '', 1, 1, 'Almas', '', '', 0, '2021-07-14 07:52:19', '2021-07-14 07:52:19'),
(224, 'PR1626249197', '[{\"qty\":\"34\",\"remark\":\"Received\",\"product\":\"GA1626249197\"}]', '2021-07-14', '', 1, 1, 'Almas', '', '', 0, '2021-07-14 07:53:17', '2021-07-14 07:53:17'),
(225, 'JX1626249248', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-07-14', '', 1, 1, 'Almas', '', '', 0, '2021-07-14 07:54:08', '2021-07-14 07:54:08'),
(226, 'VB1626249298', '[{\"qty\":\"167\",\"remark\":\"Received\",\"product\":\"EN1626249298\"}]', '2021-07-14', '', 1, 1, 'Almas', '', '', 0, '2021-07-14 07:54:58', '2021-07-14 07:54:58'),
(227, 'HJ1612171374', '[{\"qty\":\"83\",\"remark\":\"Received\",\"product\":\"HH1612171374\"}]', '2021-02-01', '', 1, 1, 'Almas', '', '', 0, '2021-02-01 09:22:54', '2021-02-01 09:22:54'),
(228, 'HD1612171420', '[{\"qty\":\"355\",\"remark\":\"Received\",\"product\":\"VP1612171420\"}]', '2021-02-01', '', 1, 1, 'Almas', '', '', 0, '2021-02-01 09:23:41', '2021-02-01 09:23:41'),
(229, 'BG1612171621', '[{\"qty\":\"131\",\"remark\":\"Received\",\"product\":\"38\"}]', '2021-02-01', '', 1, 1, 'Almas', '', '', 0, '2021-02-01 09:27:01', '2021-02-01 09:27:01'),
(230, 'WV1612171687', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"EU1612171687\"}]', '2021-02-01', '', 1, 1, 'Almas', '', '', 0, '2021-02-01 09:28:07', '2021-02-01 09:28:07'),
(231, 'JY1629128426', '[{\"qty\":\"169\",\"remark\":\"Received\",\"product\":\"37\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 15:40:26', '2021-08-16 15:40:26'),
(232, 'ED1629100000', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 07:46:40', '2021-08-16 07:46:40'),
(233, 'DA1629100044', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 07:47:24', '2021-08-16 07:47:24'),
(234, 'GV1629100052', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 07:47:32', '2021-08-16 07:47:32'),
(235, 'MY1629100707', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"60\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 07:58:27', '2021-08-16 07:58:27'),
(236, 'MS1629100916', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 08:01:57', '2021-08-16 08:01:57'),
(237, 'QU1629100926', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"62\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 08:02:06', '2021-08-16 08:02:06'),
(238, 'QI1629101038', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"60\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 08:03:59', '2021-08-16 08:03:59'),
(239, 'WU1629365252', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-08-19', '', 1, 1, 'Almas', '', '', 0, '2021-08-19 09:27:32', '2021-08-19 09:27:32'),
(240, 'AI1629366315', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-08-19', '', 1, 1, 'Almas', '', '', 0, '2021-08-19 09:45:15', '2021-08-19 09:45:15'),
(241, 'KG1628940904', '[{\"qty\":\"2000\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 11:35:04', '2021-08-14 11:35:04'),
(242, 'DT1628940911', '[{\"qty\":\"2000\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 11:35:11', '2021-08-14 11:35:11'),
(243, 'LX1628941564', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 11:46:04', '2021-08-14 11:46:04'),
(244, 'JN1628942073', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 11:54:33', '2021-08-14 11:54:33'),
(245, 'MT1628942081', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"62\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 11:54:41', '2021-08-14 11:54:41'),
(246, 'SC1628942406', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 12:00:07', '2021-08-14 12:00:07'),
(247, 'KK1620739285', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-05-11', '', 1, 1, 'Almas', '', '', 0, '2021-05-11 13:21:26', '2021-05-11 13:21:26'),
(248, 'IC1628948007', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"60\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 13:33:27', '2021-08-14 13:33:27'),
(249, 'VQ1628948402', '[{\"qty\":\"15\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 13:40:02', '2021-08-14 13:40:02'),
(250, 'WC1628949794', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"42\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:03:14', '2021-08-14 14:03:14'),
(251, 'SW1628949810', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"43\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:03:30', '2021-08-14 14:03:30'),
(252, 'UN1628949825', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"44\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:03:45', '2021-08-14 14:03:45'),
(253, 'LL1628949833', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"59\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:03:53', '2021-08-14 14:03:53'),
(254, 'FL1628950576', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"37\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:16:16', '2021-08-14 14:16:16'),
(255, 'LF1628951041', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:24:01', '2021-08-14 14:24:01'),
(256, 'AA1628951048', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"62\"}]', '2021-08-14', '', 1, 1, 'Almas', '', '', 0, '2021-08-14 14:24:08', '2021-08-14 14:24:08'),
(257, 'CV1629355244', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-08-19', '', 1, 1, 'Almas', '', '', 0, '2021-08-19 06:40:44', '2021-08-19 06:40:44'),
(258, 'AK1628837187', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 06:46:27', '2021-08-13 06:46:27'),
(259, 'PT1628840400', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:40:00', '2021-08-13 07:40:00'),
(260, 'YH1628840756', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:45:56', '2021-08-13 07:45:56'),
(261, 'BB1628840856', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"44\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:47:36', '2021-08-13 07:47:36'),
(262, 'NX1628840885', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"59\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:48:05', '2021-08-13 07:48:05'),
(263, 'DZ1628840895', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"42\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:48:15', '2021-08-13 07:48:15'),
(264, 'SE1628841174', '[{\"qty\":\"40\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 07:52:54', '2021-08-13 07:52:54'),
(265, 'FR1629111155', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-16', '', 1, 1, 'Almas', '', '', 0, '2021-08-16 10:52:35', '2021-08-16 10:52:35'),
(266, 'UA1628852625', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 11:03:45', '2021-08-13 11:03:45'),
(267, 'EN1628852740', '[{\"qty\":\"2000\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 11:05:40', '2021-08-13 11:05:40'),
(268, 'VR1628852833', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-13', '', 1, 1, 'Almas', '', '', 0, '2021-08-13 11:07:13', '2021-08-13 11:07:13'),
(269, 'EY1628767744', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 11:29:04', '2021-08-12 11:29:04'),
(270, 'SU1628767744', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 11:29:04', '2021-08-12 11:29:04'),
(271, 'OE1628768879', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 11:47:59', '2021-08-12 11:47:59'),
(272, 'LG1628777743', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"43\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 14:15:43', '2021-08-12 14:15:43'),
(273, 'NG1628777771', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 14:16:11', '2021-08-12 14:16:11'),
(274, 'IH1628779270', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 14:41:10', '2021-08-12 14:41:10'),
(275, 'HU1628779602', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 14:46:42', '2021-08-12 14:46:42'),
(276, 'MB1628779643', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"36\"}]', '2021-08-12', '', 1, 1, 'Almas', '', '', 0, '2021-08-12 14:47:23', '2021-08-12 14:47:23'),
(277, 'XV1629541193', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"OV1629541193\"}]', '2021-08-21', '', 1, 1, 'Almas', '', '', 0, '2021-08-21 10:19:53', '2021-08-21 10:19:53'),
(278, 'DM1623671654', '[{\"qty\":\"1900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-06-14', '', 1, 1, 'Almas', '', '', 0, '2021-06-14 11:54:14', '2021-06-14 11:54:14'),
(279, 'CZ1623671662', '[{\"qty\":\"1900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-06-14', '', 1, 1, 'Almas', '', '', 0, '2021-06-14 11:54:22', '2021-06-14 11:54:22'),
(280, 'IJ1623671670', '[{\"qty\":\"1900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-06-14', '', 1, 1, 'Almas', '', '', 0, '2021-06-14 11:54:30', '2021-06-14 11:54:30'),
(281, 'BN1629552337', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"XT1629552337\"}]', '2021-08-21', '', 1, 1, 'Almas', '', '', 0, '2021-08-21 13:25:37', '2021-08-21 13:25:37'),
(282, 'MB1629556882', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"64\"}]', '2021-08-21', '', 1, 1, 'Almas', '', '', 0, '2021-08-21 14:41:22', '2021-08-21 14:41:22');
INSERT INTO `stock_recieved` (`SN`, `recieved_id`, `products`, `recieved_date`, `branch`, `supplier`, `reciever_userfullname`, `transfer_user`, `confirm_userfullname`, `note`, `branch_id`, `created`, `updated`) VALUES
(283, 'JY1629703362', '[{\"qty\":\"139\",\"remark\":\"Received\",\"product\":\"36\"}]', '2021-08-23', '', 1, 1, 'Almas', '', '', 0, '2021-08-23 07:22:42', '2021-08-23 07:22:42'),
(284, 'IN1629722606', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-08-23', '', 1, 1, 'Almas', '', '', 0, '2021-08-23 12:43:26', '2021-08-23 12:43:26'),
(285, 'UI1629733632', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-08-23', '', 1, 1, 'Almas', '', '', 0, '2021-08-23 15:47:12', '2021-08-23 15:47:12'),
(286, 'YO1628593385', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-08-10', '', 1, 1, 'Almas', '', '', 0, '2021-08-10 11:03:05', '2021-08-10 11:03:05'),
(287, 'HY1628615226', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"38\"}]', '2021-08-10', '', 1, 1, 'Almas', '', '', 0, '2021-08-10 17:07:06', '2021-08-10 17:07:06'),
(288, 'OA1629880699', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-25', '', 1, 1, 'Almas', '', '', 0, '2021-08-25 08:38:19', '2021-08-25 08:38:19'),
(289, 'UN1628519761', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 14:36:01', '2021-08-09 14:36:01'),
(290, 'SI1628517245', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"60\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 13:54:05', '2021-08-09 13:54:05'),
(291, 'SU1628517255', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"63\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 13:54:15', '2021-08-09 13:54:15'),
(292, 'ZB1628517552', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"43\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 13:59:12', '2021-08-09 13:59:12'),
(293, 'SD1628517667', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"59\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 14:01:07', '2021-08-09 14:01:07'),
(294, 'UG1629902384', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-08-25', '', 1, 1, 'Almas', '', '', 0, '2021-08-25 14:39:44', '2021-08-25 14:39:44'),
(295, 'QE1628520770', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 14:52:50', '2021-08-09 14:52:50'),
(296, 'NO1628529073', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 17:11:13', '2021-08-09 17:11:13'),
(297, 'CE1628529196', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 17:13:16', '2021-08-09 17:13:16'),
(298, 'PN1629912105', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-25', '', 1, 1, 'Almas', '', '', 0, '2021-08-25 17:21:45', '2021-08-25 17:21:45'),
(299, 'SD1629912113', '[{\"qty\":\"1900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-25', '', 1, 1, 'Almas', '', '', 0, '2021-08-25 17:21:54', '2021-08-25 17:21:54'),
(300, 'AP1628505084', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 10:31:24', '2021-08-09 10:31:24'),
(301, 'KG1628505689', '[{\"qty\":\"29\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-09', '', 1, 1, 'Almas', '', '', 0, '2021-08-09 10:41:29', '2021-08-09 10:41:29'),
(302, 'UQ1629974630', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 10:43:50', '2021-08-26 10:43:50'),
(303, 'JZ1627901065', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-02', '', 1, 1, 'Almas', '', '', 0, '2021-08-02 10:44:25', '2021-08-02 10:44:25'),
(304, 'YW1627901167', '[{\"qty\":\"576\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-08-02', '', 1, 1, 'Almas', '', '', 0, '2021-08-02 10:46:07', '2021-08-02 10:46:07'),
(305, 'FY1629888539', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-08-25', '', 1, 1, 'Almas', '', '', 0, '2021-08-25 10:48:59', '2021-08-25 10:48:59'),
(306, 'XQ1629715767', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-08-23', '', 1, 1, 'Almas', '', '', 0, '2021-08-23 10:49:27', '2021-08-23 10:49:27'),
(307, 'CA1625482309', '[{\"qty\":\"126\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-07-05', '', 1, 1, 'Almas', '', '', 0, '2021-07-05 10:51:49', '2021-07-05 10:51:49'),
(308, 'IX1625482415', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"51\"}]', '2021-07-05', '', 1, 1, 'Almas', '', '', 0, '2021-07-05 10:53:35', '2021-07-05 10:53:35'),
(309, 'BD1629972699', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 10:11:39', '2021-08-26 10:11:39'),
(310, 'LV1629999399', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 17:36:39', '2021-08-26 17:36:39'),
(311, 'GB1629999410', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 17:36:50', '2021-08-26 17:36:50'),
(312, 'AA1629999418', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 17:36:58', '2021-08-26 17:36:58'),
(313, 'VN1629999428', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 17:37:08', '2021-08-26 17:37:08'),
(314, 'OS1630000410', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-26', '', 1, 1, 'Almas', '', '', 0, '2021-08-26 17:53:30', '2021-08-26 17:53:30'),
(315, 'AA1630084222', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-27', '', 1, 1, 'Almas', '', '', 0, '2021-08-27 17:10:22', '2021-08-27 17:10:22'),
(316, 'UH1630084230', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-27', '', 1, 1, 'Almas', '', '', 0, '2021-08-27 17:10:30', '2021-08-27 17:10:30'),
(317, 'ND1630084237', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-27', '', 1, 1, 'Almas', '', '', 0, '2021-08-27 17:10:37', '2021-08-27 17:10:37'),
(318, 'OT1630087445', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-08-27', '', 1, 1, 'Almas', '', '', 0, '2021-08-27 18:04:05', '2021-08-27 18:04:05'),
(319, 'MX1630153384', '[{\"qty\":\"25\",\"remark\":\"Received\",\"product\":\"57\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 12:23:04', '2021-08-28 12:23:04'),
(320, 'IY1630173234', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 17:53:54', '2021-08-28 17:53:54'),
(321, 'VD1630173243', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 17:54:03', '2021-08-28 17:54:03'),
(322, 'DS1630173612', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 18:00:12', '2021-08-28 18:00:12'),
(323, 'AP1630173619', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 18:00:19', '2021-08-28 18:00:19'),
(324, 'CU1630173628', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 18:00:28', '2021-08-28 18:00:28'),
(325, 'CR1630173692', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 18:01:32', '2021-08-28 18:01:32'),
(326, 'ME1630173698', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-28', '', 1, 1, 'Almas', '', '', 0, '2021-08-28 18:01:38', '2021-08-28 18:01:38'),
(327, 'HR1630222147', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-29', '', 1, 1, 'Almas', '', '', 0, '2021-08-29 07:29:07', '2021-08-29 07:29:07'),
(328, 'VF1630325050', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 12:04:10', '2021-08-30 12:04:10'),
(329, 'RA1630325667', '[{\"qty\":\"139\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 12:14:27', '2021-08-30 12:14:27'),
(330, 'MP1630325745', '[{\"qty\":\"161\",\"remark\":\"Received\",\"product\":\"JI1630325745\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 12:15:46', '2021-08-30 12:15:46'),
(331, 'AM1630327819', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 12:50:19', '2021-08-30 12:50:19'),
(332, 'WW1630346166', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 17:56:06', '2021-08-30 17:56:06'),
(333, 'RV1630346173', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 17:56:13', '2021-08-30 17:56:13'),
(334, 'AM1630346181', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 17:56:21', '2021-08-30 17:56:21'),
(335, 'ZC1630346188', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-30', '', 1, 1, 'Almas', '', '', 0, '2021-08-30 17:56:28', '2021-08-30 17:56:28'),
(336, 'JB1630411922', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-08-31', '', 1, 1, 'Almas', '', '', 0, '2021-08-31 12:12:02', '2021-08-31 12:12:02'),
(337, 'BZ1630430092', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-08-31', '', 1, 1, 'Almas', '', '', 0, '2021-08-31 17:14:53', '2021-08-31 17:14:53'),
(338, 'UM1630430102', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-08-31', '', 1, 1, 'Almas', '', '', 0, '2021-08-31 17:15:02', '2021-08-31 17:15:02'),
(339, 'KW1630491771', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"AW1630491771\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 10:22:51', '2021-09-01 10:22:51'),
(340, 'MC1630492543', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 10:35:43', '2021-09-01 10:35:43'),
(341, 'ZO1630497690', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"67\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 12:01:30', '2021-09-01 12:01:30'),
(342, 'IN1630511145', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 15:45:45', '2021-09-01 15:45:45'),
(343, 'MZ1630511157', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 15:45:58', '2021-09-01 15:45:58'),
(344, 'BW1630511171', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 15:46:11', '2021-09-01 15:46:11'),
(345, 'LA1630511213', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-01', '', 1, 1, 'Almas', '', '', 0, '2021-09-01 15:46:53', '2021-09-01 15:46:53'),
(346, 'XR1630578487', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-02', '', 1, 1, 'Almas', '', '', 0, '2021-09-02 10:28:07', '2021-09-02 10:28:07'),
(347, 'UJ1630599833', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-02', '', 1, 1, 'Almas', '', '', 0, '2021-09-02 16:23:53', '2021-09-02 16:23:53'),
(348, 'SG1630599899', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-09-02', '', 1, 1, 'Almas', '', '', 0, '2021-09-02 16:24:59', '2021-09-02 16:24:59'),
(349, 'EG1630679405', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-03', '', 1, 1, 'Almas', '', '', 0, '2021-09-03 14:30:05', '2021-09-03 14:30:05'),
(350, 'GW1630683588', '[{\"qty\":\"253\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-03', '', 1, 1, 'Almas', '', '', 0, '2021-09-03 15:39:48', '2021-09-03 15:39:48'),
(351, 'DI1630747810', '[{\"qty\":\"1500\",\"remark\":\"Received\",\"product\":\"FK1630747810\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 09:30:10', '2021-09-04 09:30:10'),
(352, 'AK1630747858', '[{\"qty\":\"1500\",\"remark\":\"Received\",\"product\":\"BD1630747858\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 09:30:58', '2021-09-04 09:30:58'),
(353, 'PX1630750732', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 10:18:52', '2021-09-04 10:18:52'),
(354, 'ZB1630751953', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 10:39:13', '2021-09-04 10:39:13'),
(355, 'QB1630752211', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 10:43:31', '2021-09-04 10:43:31'),
(356, 'DK1630754942', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 11:29:02', '2021-09-04 11:29:02'),
(357, 'HT1630754953', '[{\"qty\":\"50\",\"remark\":\"Received\",\"product\":\"66\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 11:29:13', '2021-09-04 11:29:13'),
(358, 'CY1630755122', '[{\"qty\":\"47\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 11:32:02', '2021-09-04 11:32:02'),
(359, 'JI1630759473', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"55\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 12:44:33', '2021-09-04 12:44:33'),
(360, 'FQ1630771597', '[{\"qty\":\"1500\",\"remark\":\"Received\",\"product\":\"69\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 16:06:37', '2021-09-04 16:06:37'),
(361, 'BX1630771671', '[{\"qty\":\"197\",\"remark\":\"Received\",\"product\":\"55\"}]', '2021-09-04', '', 1, 1, 'Almas', '', '', 0, '2021-09-04 16:07:51', '2021-09-04 16:07:51'),
(362, 'PJ1630917015', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-06', '', 1, 1, 'Almas', '', '', 0, '2021-09-06 08:30:15', '2021-09-06 08:30:15'),
(363, 'YG1630923969', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-06', '', 1, 1, 'Almas', '', '', 0, '2021-09-06 10:26:09', '2021-09-06 10:26:09'),
(364, 'NO1630935998', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-06', '', 1, 1, 'Almas', '', '', 0, '2021-09-06 13:46:38', '2021-09-06 13:46:38'),
(365, 'WT1631015295', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-07', '', 1, 1, 'Almas', '', '', 0, '2021-09-07 11:48:15', '2021-09-07 11:48:15'),
(366, 'SY1631018590', '[{\"qty\":\"6\",\"remark\":\"Received\",\"product\":\"36\"}]', '2021-09-07', '', 1, 1, 'Almas', '', '', 0, '2021-09-07 12:43:10', '2021-09-07 12:43:10'),
(367, 'HV1631023536', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-07', '', 1, 1, 'Almas', '', '', 0, '2021-09-07 14:05:36', '2021-09-07 14:05:36'),
(368, 'OL1631026169', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"55\"}]', '2021-09-07', '', 1, 1, 'Almas', '', '', 0, '2021-09-07 14:49:29', '2021-09-07 14:49:29'),
(369, 'BP1631108175', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"QS1631108175\"}]', '2021-09-08', '', 1, 1, 'Almas', '', '', 0, '2021-09-08 13:36:15', '2021-09-08 13:36:15'),
(370, 'EH1631202316', '[{\"qty\":\"194\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-09-09', '', 1, 1, 'Almas', '', '', 0, '2021-09-09 15:45:16', '2021-09-09 15:45:16'),
(371, 'RL1631204517', '[{\"qty\":\"400\",\"remark\":\"Received\",\"product\":\"37\"}]', '2021-09-09', '', 1, 1, 'Almas', '', '', 0, '2021-09-09 16:21:57', '2021-09-09 16:21:57'),
(372, 'FH1631176807', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-09', '', 1, 1, 'Almas', '', '', 0, '2021-09-09 08:40:07', '2021-09-09 08:40:07'),
(373, 'XL1631176815', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-09', '', 1, 1, 'Almas', '', '', 0, '2021-09-09 08:40:15', '2021-09-09 08:40:15'),
(374, 'YF1631268032', '[{\"qty\":\"785\",\"remark\":\"Received\",\"product\":\"46\"}]', '2021-09-10', '', 1, 1, 'Almas', '', '', 0, '2021-09-10 10:00:32', '2021-09-10 10:00:32'),
(375, 'FK1631346792', '[{\"qty\":\"2000\",\"remark\":\"Received\",\"product\":\"69\"}]', '2021-09-11', '', 1, 1, 'Almas', '', '', 0, '2021-09-11 07:53:12', '2021-09-11 07:53:12'),
(376, 'JU1631346801', '[{\"qty\":\"1000\",\"remark\":\"Received\",\"product\":\"69\"}]', '2021-09-11', '', 1, 1, 'Almas', '', '', 0, '2021-09-11 07:53:21', '2021-09-11 07:53:21'),
(377, 'HV1631346818', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-11', '', 1, 1, 'Almas', '', '', 0, '2021-09-11 07:53:38', '2021-09-11 07:53:38'),
(378, 'YH1631523843', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 09:04:03', '2021-09-13 09:04:03'),
(379, 'AD1631543817', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"32\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 14:36:57', '2021-09-13 14:36:57'),
(380, 'DY1631544488', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"30\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 14:48:08', '2021-09-13 14:48:08'),
(381, 'HJ1631547783', '[{\"qty\":\"490\",\"remark\":\"Received\",\"product\":\"30\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 15:43:04', '2021-09-13 15:43:04'),
(382, 'PG1631547807', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"53\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 15:43:27', '2021-09-13 15:43:27'),
(383, 'NQ1631549276', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-13', '', 1, 30, 'Almas', '', '', 0, '2021-09-13 16:07:57', '2021-09-13 16:07:57'),
(384, 'AJ1631609077', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-14', '', 1, 30, 'Almas', '', '', 0, '2021-09-14 08:44:37', '2021-09-14 08:44:37'),
(385, 'HT1631615822', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-14', '', 1, 30, 'Almas', '', '', 0, '2021-09-14 10:37:02', '2021-09-14 10:37:02'),
(386, 'UB1631625389', '[{\"qty\":\"9\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-14', '', 1, 30, 'Almas', '', '', 0, '2021-09-14 13:16:29', '2021-09-14 13:16:29'),
(387, 'WV1631631151', '[{\"qty\":\"47\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-14', '', 1, 1, 'Almas', '', '', 0, '2021-09-14 14:52:31', '2021-09-14 14:52:31'),
(388, 'XV1631692907', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-15', '', 1, 1, 'Almas', '', '', 0, '2021-09-15 08:01:47', '2021-09-15 08:01:47'),
(389, 'ZO1631693380', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-15', '', 1, 30, 'Almas', '', '', 0, '2021-09-15 08:09:40', '2021-09-15 08:09:40'),
(390, 'NL1631703181', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"66\"}]', '2021-09-15', '', 1, 30, 'Almas', '', '', 0, '2021-09-15 10:53:01', '2021-09-15 10:53:01'),
(391, 'FR1631706271', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"66\"}]', '2021-09-15', '', 1, 30, 'Almas', '', '', 0, '2021-09-15 11:44:31', '2021-09-15 11:44:31'),
(392, 'YG1631786429', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-16', '', 1, 30, 'Almas', '', '', 0, '2021-09-16 10:00:29', '2021-09-16 10:00:29'),
(393, 'HY1631800490', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"34\"}]', '2021-09-16', '', 1, 30, 'Almas', '', '', 0, '2021-09-16 13:54:50', '2021-09-16 13:54:50'),
(394, 'DM1631800524', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-16', '', 1, 30, 'Almas', '', '', 0, '2021-09-16 13:55:24', '2021-09-16 13:55:24'),
(395, 'QT1631870050', '[{\"qty\":\"1000\",\"remark\":\"Received\",\"product\":\"55\"}]', '2021-09-17', '', 1, 30, 'Almas', '', '', 0, '2021-09-17 09:14:10', '2021-09-17 09:14:10'),
(396, 'XH1631878817', '[{\"qty\":\"4\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 11:40:17', '2021-09-17 11:40:17'),
(397, 'QT1631884929', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 13:22:09', '2021-09-17 13:22:09'),
(398, 'QI1631884930', '[{\"qty\":\"3\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 13:22:10', '2021-09-17 13:22:10'),
(399, 'WA1631884940', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 13:22:20', '2021-09-17 13:22:20'),
(400, 'YB1631884982', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 13:23:02', '2021-09-17 13:23:02'),
(401, 'IZ1631885065', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"51\"}]', '2021-09-17', '', 1, 1, 'Almas', '', '', 0, '2021-09-17 13:24:25', '2021-09-17 13:24:25'),
(402, 'BX1631955825', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 09:03:45', '2021-09-18 09:03:45'),
(403, 'LV1631955844', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 09:04:05', '2021-09-18 09:04:05'),
(404, 'NG1631955861', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 09:04:21', '2021-09-18 09:04:21'),
(405, 'EI1631956788', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 09:19:48', '2021-09-18 09:19:48'),
(406, 'MF1631969571', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"RN1631969571\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 12:52:51', '2021-09-18 12:52:51'),
(407, 'SJ1631969673', '[{\"qty\":\"100\",\"remark\":\"Received\",\"product\":\"OC1631969673\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 12:54:34', '2021-09-18 12:54:34'),
(408, 'WX1631969763', '[{\"qty\":\"250\",\"remark\":\"Received\",\"product\":\"QW1631969763\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 12:56:03', '2021-09-18 12:56:03'),
(409, 'ST1631970882', '[{\"qty\":\"306\",\"remark\":\"Received\",\"product\":\"39\"}]', '2021-09-18', '', 1, 1, 'Almas', '', '', 0, '2021-09-18 13:14:42', '2021-09-18 13:14:42'),
(410, 'FM1631977856', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 15:10:56', '2021-09-18 15:10:56'),
(411, 'TN1631982655', '[{\"qty\":\"11\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-09-18', '', 1, 1, 'Almas', '', '', 0, '2021-09-18 16:30:55', '2021-09-18 16:30:55'),
(412, 'LN1631984069', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 16:54:29', '2021-09-18 16:54:29'),
(413, 'TB1631984435', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 17:00:35', '2021-09-18 17:00:35'),
(414, 'ZF1631987175', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-18', '', 1, 30, 'Almas', '', '', 0, '2021-09-18 17:46:15', '2021-09-18 17:46:15'),
(415, 'KJ1632127701', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 08:48:21', '2021-09-20 08:48:21'),
(416, 'HR1632132319', '[{\"qty\":\"1600\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 10:05:19', '2021-09-20 10:05:19'),
(417, 'CG1632132331', '[{\"qty\":\"1200\",\"remark\":\"Received\",\"product\":\"62\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 10:05:31', '2021-09-20 10:05:31'),
(418, 'WT1632132371', '[{\"qty\":\"200\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 10:06:11', '2021-09-20 10:06:11'),
(419, 'BO1632132838', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 10:13:58', '2021-09-20 10:13:58'),
(420, 'AS1632132858', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 10:14:18', '2021-09-20 10:14:18'),
(421, 'TB1632144271', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 13:24:31', '2021-09-20 13:24:31'),
(422, 'UO1632151132', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 15:18:53', '2021-09-20 15:18:53'),
(423, 'EH1632157203', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 17:00:03', '2021-09-20 17:00:03'),
(424, 'YY1632159687', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-20', '', 1, 30, 'Almas', '', '', 0, '2021-09-20 17:41:27', '2021-09-20 17:41:27'),
(425, 'ZR1632222683', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 11:11:23', '2021-09-21 11:11:23'),
(426, 'NN1632222695', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 11:11:36', '2021-09-21 11:11:36'),
(427, 'TK1632222719', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 11:11:59', '2021-09-21 11:11:59'),
(428, 'KZ1632222731', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 11:12:11', '2021-09-21 11:12:11'),
(429, 'DJ1632222741', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 11:12:21', '2021-09-21 11:12:21'),
(430, 'RL1632232650', '[{\"qty\":\"1\",\"remark\":\"Received\",\"product\":\"35\"}]', '2021-09-21', '', 1, 30, 'Almas', '', '', 0, '2021-09-21 13:57:30', '2021-09-21 13:57:30'),
(431, 'QG1632310477', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"27\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 11:34:37', '2021-09-22 11:34:37'),
(432, 'TN1632310562', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 11:36:02', '2021-09-22 11:36:02'),
(433, 'HT1632310587', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 11:36:28', '2021-09-22 11:36:28'),
(434, 'SH1632310732', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"50\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 11:38:52', '2021-09-22 11:38:52'),
(435, 'MQ1632327689', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 16:21:29', '2021-09-22 16:21:29'),
(436, 'XB1632330494', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 17:08:14', '2021-09-22 17:08:14'),
(437, 'HK1632330517', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 17:08:37', '2021-09-22 17:08:37'),
(438, 'PV1632330621', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-22', '', 1, 30, 'Almas', '', '', 0, '2021-09-22 17:10:21', '2021-09-22 17:10:21'),
(439, 'ZT1632388161', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-23', '', 1, 30, 'Almas', '', '', 0, '2021-09-23 09:09:21', '2021-09-23 09:09:21'),
(440, 'HN1632404198', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-23', '', 1, 30, 'Almas', '', '', 0, '2021-09-23 13:36:38', '2021-09-23 13:36:38'),
(441, 'RV1632404198', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-23', '', 1, 30, 'Almas', '', '', 0, '2021-09-23 13:36:39', '2021-09-23 13:36:39'),
(442, 'EI1632499707', '[{\"qty\":\"500\",\"remark\":\"Received\",\"product\":\"33\"}]', '2021-09-24', '', 1, 30, 'Almas', '', '', 0, '2021-09-24 16:08:27', '2021-09-24 16:08:27'),
(443, 'LF1632569182', '[{\"qty\":\"520\",\"remark\":\"Received\",\"product\":\"55\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 11:26:22', '2021-09-25 11:26:22'),
(444, 'CX1632573564', '[{\"qty\":\"7\",\"remark\":\"Received\",\"product\":\"26\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 12:39:24', '2021-09-25 12:39:24'),
(445, 'AR1632573758', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"49\"}]', '2021-09-25', '', 1, 1, 'Almas', '', '', 0, '2021-09-25 12:42:38', '2021-09-25 12:42:38'),
(446, 'VK1632588074', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"54\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 16:41:14', '2021-09-25 16:41:14'),
(447, 'ER1632589621', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"73\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 17:07:01', '2021-09-25 17:07:01'),
(448, 'RF1632589634', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"72\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 17:07:15', '2021-09-25 17:07:15'),
(449, 'GV1632589728', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"71\"}]', '2021-09-25', '', 1, 30, 'Almas', '', '', 0, '2021-09-25 17:08:48', '2021-09-25 17:08:48'),
(450, 'QI1632903780', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 08:23:00', '2021-09-29 08:23:00'),
(451, 'MK1632907125', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:18:46', '2021-09-29 09:18:46'),
(452, 'NJ1632907126', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:18:46', '2021-09-29 09:18:46'),
(453, 'DN1632907126', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:18:46', '2021-09-29 09:18:46'),
(454, 'EQ1632907126', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"40\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:18:46', '2021-09-29 09:18:46'),
(455, 'TT1632907141', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"61\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:19:01', '2021-09-29 09:19:01'),
(456, 'KT1632907154', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"62\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 09:19:14', '2021-09-29 09:19:14'),
(457, 'RR1632911873', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 10:37:53', '2021-09-29 10:37:53'),
(458, 'GM1632911948', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 10:39:08', '2021-09-29 10:39:08'),
(459, 'UB1632925670', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 14:27:50', '2021-09-29 14:27:50'),
(460, 'VL1632929091', '[{\"qty\":\"30\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-29', '', 1, 30, 'Almas', '', '', 0, '2021-09-29 15:24:51', '2021-09-29 15:24:51'),
(461, 'FX1632996087', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 10:01:27', '2021-09-30 10:01:27'),
(462, 'AA1632996223', '[{\"qty\":\"610\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 10:03:43', '2021-09-30 10:03:43'),
(463, 'HD1632998508', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 10:41:49', '2021-09-30 10:41:49'),
(464, 'YY1632999829', '[{\"qty\":\"602\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 11:03:49', '2021-09-30 11:03:49'),
(465, 'OZ1633008381', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 13:26:21', '2021-09-30 13:26:21'),
(466, 'ZI1633016108', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-09-30', '', 1, 30, 'Almas', '', '', 0, '2021-09-30 15:35:08', '2021-09-30 15:35:08'),
(467, 'UM1633081817', '[{\"qty\":\"900\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-10-01', '', 1, 30, 'Almas', '', '', 0, '2021-10-01 09:50:17', '2021-10-01 09:50:17'),
(468, 'JC1633097106', '[{\"qty\":\"600\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-10-01', '', 1, 30, 'Almas', '', '', 0, '2021-10-01 14:05:06', '2021-10-01 14:05:06'),
(469, 'LN1633098852', '[{\"qty\":\"10\",\"remark\":\"Received\",\"product\":\"48\"}]', '2021-10-01', '', 1, 30, 'Almas', '', '', 0, '2021-10-01 14:34:12', '2021-10-01 14:34:12'),
(470, 'QF1682786246', '[{\"qty\":\"2\",\"remark\":\"Received\",\"product\":\"JM1682786246\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 16:37:26', '2023-04-29 16:37:26'),
(471, 'CF1682786747', '[{\"qty\":\"5\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 16:45:47', '2023-04-29 16:45:47'),
(472, 'LS1682787697', '[{\"qty\":\"8\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 17:01:37', '2023-04-29 17:01:37'),
(473, 'WD1682788719', '[{\"qty\":\"1000\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 17:18:39', '2023-04-29 17:18:39'),
(474, 'BA1682791258', '[{\"qty\":\"3500\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 18:00:58', '2023-04-29 18:00:58'),
(475, 'ZX1682791293', '[{\"qty\":\"10000\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-04-29', '', 1, 1, 'Almas', '', '', 0, '2023-04-29 18:01:33', '2023-04-29 18:01:33'),
(476, 'GS1689153436', '[{\"qty\":\"300\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-07-12', '', 1, 1, 'Almas', '', '', 0, '2023-07-12 09:17:16', '2023-07-12 09:17:16'),
(477, 'XE1689153453', '[{\"qty\":\"1000\",\"remark\":\"Received\",\"product\":\"1\"}]', '2023-07-12', '', 1, 1, 'Almas', '', '', 0, '2023-07-12 09:17:33', '2023-07-12 09:17:33'),
(478, 'OV1689448151', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"WK1689448151\"}]', '2023-07-15', '', 1, 1, 'Almas', '', '', 0, '2023-07-15 19:09:11', '2023-07-15 19:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `SN` bigint(11) NOT NULL,
  `transfer_id` varchar(25) NOT NULL,
  `products` longtext NOT NULL,
  `transfer_date` date NOT NULL,
  `branch` int(11) NOT NULL,
  `transfer_user` int(11) NOT NULL,
  `reciever_userfullname` varchar(255) NOT NULL,
  `confirm_userfullname` varchar(255) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SN` bigint(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` tinytext NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_phone_number` varchar(16) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SN`, `supplier_name`, `supplier_address`, `supplier_email`, `supplier_phone_number`, `created`, `updated`) VALUES
(1, 'FAITH', '', '', '', '2021-03-18 15:47:24', '2021-03-18 15:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice`
--

CREATE TABLE `supplier_invoice` (
  `SN` bigint(11) NOT NULL,
  `supplier_id` varchar(25) NOT NULL,
  `products` longtext NOT NULL,
  `recieved_date` date NOT NULL,
  `supplier` int(11) NOT NULL,
  `note` text NOT NULL,
  `amount_paid` decimal(16,2) NOT NULL,
  `total_invoice_amount` decimal(16,2) NOT NULL,
  `bank` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(20) NOT NULL,
  `status` enum('Pending','Complete') NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_invoice`
--

INSERT INTO `supplier_invoice` (`SN`, `supplier_id`, `products`, `recieved_date`, `supplier`, `note`, `amount_paid`, `total_invoice_amount`, `bank`, `payment_method`, `status`, `branch_id`, `created`, `updated`) VALUES
(1, 'OF1616424963', '[{\"qty\":\"40\",\"product\":\"KY1616404637\",\"remark\":\"Received\"}]', '2021-03-22', 1, '', '0.00', '0.00', 0, '', 'Pending', 0, '2021-03-22 14:56:03', '2021-03-22 14:56:03'),
(2, 'XF1616426104', '[{\"qty\":\"30\",\"product\":\"KY1616404637\",\"remark\":\"Received\"}]', '2021-03-22', 1, '', '0.00', '0.00', 0, '', 'Pending', 0, '2021-03-22 15:15:04', '2021-03-22 15:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets`
--

CREATE TABLE `tbl_assets` (
  `SN` int(11) NOT NULL,
  `assests_name` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(120) NOT NULL,
  `department` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `purchase_date` date NOT NULL,
  `date_sold` date NOT NULL,
  `model_number` varchar(200) NOT NULL,
  `purchase_price` decimal(16,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `SN` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`SN`, `bank_name`, `account_number`, `account_name`, `created`, `updated`) VALUES
(1, 'gtb', '0118551578', 'jjjnkjn', '2023-04-29 18:13:55', '2023-04-29 19:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashbook`
--

CREATE TABLE `tbl_cashbook` (
  `SN` int(11) NOT NULL,
  `date_` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `bank` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `comment` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_sales`
--

CREATE TABLE `tbl_credit_sales` (
  `SN` int(11) NOT NULL,
  `credit_id` varchar(100) NOT NULL,
  `items` longtext NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `total_amount` decimal(16,2) NOT NULL,
  `status` enum('COMPLETE','PENDING') NOT NULL,
  `total_amount_paid` decimal(16,2) NOT NULL,
  `total_profit` decimal(16,2) NOT NULL,
  `vat_amount` decimal(16,2) NOT NULL,
  `s_charge_amt` decimal(16,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sales_time` varchar(10) NOT NULL,
  `payment_type` enum('Direct','Invoice') NOT NULL,
  `payment_method` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `reservation_invoice_link` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `scharge` int(11) NOT NULL,
  `reason` text NOT NULL,
  `voided_by` int(11) NOT NULL,
  `date_voided` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_credit_sales`
--

INSERT INTO `tbl_credit_sales` (`SN`, `credit_id`, `items`, `discount_type`, `discount`, `total_amount`, `status`, `total_amount_paid`, `total_profit`, `vat_amount`, `s_charge_amt`, `user_id`, `date`, `sales_time`, `payment_type`, `payment_method`, `customer`, `reservation_invoice_link`, `comment`, `branch_id`, `vat`, `scharge`, `reason`, `voided_by`, `date_voided`, `created`, `updated`) VALUES
(1, 'CQ1682791781', '[{\"item_name\":\"MAMA GOLD\",\"item_price\":\"2060.00\",\"item_qty\":\"1\",\"total\":2060,\"cost_price\":\"2000.00\",\"total_cost_price\":2000,\"profit\":60,\"id\":\"JM1682786246\"}]', 2, '0.00', '2060.00', 'COMPLETE', '2060.00', '60.00', '0.00', '0.00', 1, '2023-04-29', '08:09 pm', 'Direct', 1, 1042, '', '', 0, 0, 0, '', 0, '0000-00-00', '2023-04-29 19:09:41', '2023-04-29 19:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `SN` bigint(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` tinytext NOT NULL,
  `credit_limit` decimal(16,2) NOT NULL,
  `weeks` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `date` date NOT NULL,
  `city` varchar(40) NOT NULL,
  `additional_info` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`SN`, `firstname`, `lastname`, `email`, `phone`, `address`, `credit_limit`, `weeks`, `expired_date`, `date`, `city`, `additional_info`, `branch_id`, `updated`, `created`) VALUES
(1, 'BABA ', 'MORABA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 10:49:38', '2021-03-22 10:49:38'),
(2, 'BABA ', 'MORABA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 10:49:38', '2021-03-22 10:49:38'),
(3, 'DADDY', 'NIKE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 13:33:01', '2021-03-22 13:33:01'),
(4, 'DADDY', 'NIKE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 13:33:02', '2021-03-22 13:33:02'),
(5, 'GOLDEN', 'CROWN', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 13:41:54', '2021-03-22 13:41:54'),
(6, 'Mummy ', 'Ope', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:08:49', '2021-03-22 15:08:49'),
(7, 'Iya', 'Hikmah', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:15:29', '2021-03-22 15:15:29'),
(8, 'Iya', 'Agbo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:19:25', '2021-03-22 15:19:25'),
(9, 'Opeyemi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:32:15', '2021-03-22 15:32:15'),
(10, 'Baba', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:37:47', '2021-03-22 15:37:47'),
(11, 'Baba', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 15:37:48', '2021-03-22 15:37:48'),
(12, 'Mr.', 'Paul', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 16:00:34', '2021-03-22 16:00:34'),
(13, 'Iya', 'Ibeji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 16:11:13', '2021-03-22 16:11:13'),
(14, 'Iya', 'Danialu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 16:29:47', '2021-03-22 16:29:47'),
(15, 'Omo', 'Iyadun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:05:22', '2021-03-22 17:05:22'),
(16, 'Ola', 'Daddy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:06:51', '2021-03-22 17:06:51'),
(17, 'Iya', 'Odota', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:13:27', '2021-03-22 17:13:27'),
(18, 'Ola', 'rinoye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:21:41', '2021-03-22 17:21:41'),
(19, 'Aunty', 'Fali', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:25:41', '2021-03-22 17:25:41'),
(20, 'Daddy', 'Kaosara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:29:33', '2021-03-22 17:29:33'),
(21, 'AMI', 'GBORO', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:33:13', '2021-03-22 17:33:13'),
(22, 'Mummy', 'Mujib', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:34:23', '2021-03-22 17:34:23'),
(23, 'K', 'Goodies', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:47:22', '2021-03-22 17:47:22'),
(24, 'Mr', 'Abayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:48:44', '2021-03-22 17:48:44'),
(25, 'SHOP', 'B', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 17:51:28', '2021-03-22 17:51:28'),
(26, 'Mummy', 'Bode', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 18:38:34', '2021-03-22 18:38:34'),
(27, 'Mummy', 'Samiat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 18:51:26', '2021-03-22 18:51:26'),
(28, 'Alhaja', 'Amina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 19:00:28', '2021-03-22 19:00:28'),
(29, 'Alh.', 'Adeshina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 19:02:57', '2021-03-22 19:02:57'),
(30, 'Wonderful', 'Ogbomosho', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 10:07:03', '2021-03-23 10:07:03'),
(31, 'Ileri', 'Oluwa Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 22:26:16', '2021-03-22 22:26:16'),
(32, 'Mummy', 'Aunty Busayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-22 22:32:56', '2021-03-22 22:32:56'),
(33, 'Mummy ', 'Peace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 10:37:09', '2021-03-23 10:37:09'),
(34, 'Mummy', 'Hawau', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:00:31', '2021-03-23 11:00:31'),
(35, 'Karumo', 'Karmo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:03:12', '2021-03-23 11:03:12'),
(36, 'Karumo', 'Karmo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:03:12', '2021-03-23 11:03:12'),
(37, 'Bro', 'Bola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:28:02', '2021-03-23 11:28:02'),
(38, 'Iya', 'Ridwan', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:30:24', '2021-03-23 11:30:24'),
(39, 'Iya', 'Luku', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:36:31', '2021-03-23 11:36:31'),
(40, 'Omo', 'boriowo 1', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:38:27', '2021-03-23 11:38:27'),
(41, 'Omo', 'boriowo 1', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:38:27', '2021-03-23 11:38:27'),
(42, 'Hero', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:58:06', '2021-03-23 11:58:06'),
(43, 'Hero', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 11:58:06', '2021-03-23 11:58:06'),
(44, 'Mr. ', 'Dunni', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:05:38', '2021-03-23 12:05:38'),
(45, 'Mummy', 'Ahmed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:16:34', '2021-03-23 12:16:34'),
(46, 'Ayo', 'ola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:21:20', '2021-03-23 12:21:20'),
(47, 'Aminat', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:28:11', '2021-03-23 12:28:11'),
(48, 'Aminat', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:28:11', '2021-03-23 12:28:11'),
(49, 'Alfa', 'Tanke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:30:00', '2021-03-23 12:30:00'),
(50, 'Temitope', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:41:26', '2021-03-23 12:41:26'),
(51, 'Temitope', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:41:27', '2021-03-23 12:41:27'),
(52, 'Temitope', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:41:27', '2021-03-23 12:41:27'),
(53, 'Mummy', 'Bukky', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:48:27', '2021-03-23 12:48:27'),
(54, 'Iya', 'Folorunsho', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 12:59:17', '2021-03-23 12:59:17'),
(55, 'Iya', 'Quadri', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 13:03:13', '2021-03-23 13:03:13'),
(56, 'Alhaja', 'Iyabo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 13:12:32', '2021-03-23 13:12:32'),
(57, 'Sis', 'Romoke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 13:21:16', '2021-03-23 13:21:16'),
(58, 'Alfa', 'Kayamoli', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 13:26:12', '2021-03-23 13:26:12'),
(59, 'Halleluyah ', 'Egbe', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 13:36:39', '2021-03-23 13:36:39'),
(60, 'Iya', 'Igbo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 14:09:06', '2021-03-23 14:09:06'),
(61, 'Aunty', 'Diamond', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 14:21:01', '2021-03-23 14:21:01'),
(62, 'Iya', 'Mariam', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 14:50:09', '2021-03-23 14:50:09'),
(63, 'Alhaja', 'Iya Muyi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 15:09:54', '2021-03-23 15:09:54'),
(64, 'Mr.', 'Kehinde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 15:11:11', '2021-03-23 15:11:11'),
(65, 'Shop', 'B', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 15:25:57', '2021-03-23 15:25:57'),
(66, 'Omo', 'Ga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 15:28:37', '2021-03-23 15:28:37'),
(67, 'Abdul', 'Rasheed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 16:05:18', '2021-03-23 16:05:18'),
(68, 'Mr.', 'Solomon Ishola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 16:11:22', '2021-03-23 16:11:22'),
(69, 'Iya', 'Amirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 17:22:44', '2021-03-23 17:22:44'),
(70, 'Iya', 'Amirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-23 17:22:44', '2021-03-23 17:22:44'),
(71, 'SHOP', 'C', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 10:15:18', '2021-03-24 10:15:18'),
(72, 'Alhaja', 'Iya Muyi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 10:21:15', '2021-03-24 10:21:15'),
(73, 'Alhaji', 'Alhaji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 09:39:10', '2021-03-24 09:39:10'),
(74, 'Mummy', 'Wunmi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 09:40:40', '2021-03-24 09:40:40'),
(75, 'Mr', 'Kehinde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 11:09:40', '2021-03-24 11:09:40'),
(76, 'Mr', 'Kehinde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 11:09:40', '2021-03-24 11:09:40'),
(77, 'Oluwa', 'nisola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 11:24:30', '2021-03-24 11:24:30'),
(78, 'Alhaji', 'Karamo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 11:45:54', '2021-03-24 11:45:54'),
(79, 'Alhaji', 'Karamo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 11:45:54', '2021-03-24 11:45:54'),
(80, 'Mummy', 'Muyiba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:06:11', '2021-03-24 12:06:11'),
(81, 'Mummy', 'Muyiba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:06:11', '2021-03-24 12:06:11'),
(82, 'Mummy', 'Korede', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:23:49', '2021-03-24 12:23:49'),
(83, 'Alfa', 'Taju', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:39:35', '2021-03-24 12:39:35'),
(84, 'Mummy', 'Victor', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:42:10', '2021-03-24 12:42:10'),
(85, 'Mummy', 'Betty', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 12:48:56', '2021-03-24 12:48:56'),
(86, 'Mummy', 'Abdulmalik', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:02:21', '2021-03-24 13:02:21'),
(87, 'Mummy', 'Abdulmalik', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:02:21', '2021-03-24 13:02:21'),
(88, 'Mummy', 'Twins', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:10:09', '2021-03-24 13:10:09'),
(89, 'Mummy', 'Muhammed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:12:53', '2021-03-24 13:12:53'),
(90, 'Uche', 'Best', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:16:31', '2021-03-24 13:16:31'),
(91, 'Iyiola', 'Victoria', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:35:49', '2021-03-24 13:35:49'),
(92, 'Opeyemi', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:39:56', '2021-03-24 13:39:56'),
(93, 'Iya', 'Ile Film', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:47:48', '2021-03-24 13:47:48'),
(94, 'Iya', 'Ile Film', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 13:47:48', '2021-03-24 13:47:48'),
(95, 'Iya', 'Ogbodoroko', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 14:24:38', '2021-03-24 14:24:38'),
(96, 'Omoboriowo', 'Eiyenkorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 14:50:35', '2021-03-24 14:50:35'),
(97, 'Mr', 'John Okolowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:04:23', '2021-03-24 15:04:23'),
(98, 'Mr', 'Olarewaju', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:48:59', '2021-03-24 15:48:59'),
(99, 'Daddy', 'Daddy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:49:57', '2021-03-24 15:49:57'),
(100, 'Daddy', 'Daddy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:49:57', '2021-03-24 15:49:57'),
(101, 'Alfa', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:54:08', '2021-03-24 15:54:08'),
(102, 'Oko', 'lowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 15:58:06', '2021-03-24 15:58:06'),
(103, 'Alhaja', 'Oloru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:03:32', '2021-03-24 16:03:32'),
(104, 'Ola', 'Daddy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:18:01', '2021-03-24 16:18:01'),
(105, 'Daddy', 'Faruk', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:33:08', '2021-03-24 16:33:08'),
(106, 'Ala', 'gbara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:38:46', '2021-03-24 16:38:46'),
(107, 'Ade', 'leke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:45:11', '2021-03-24 16:45:11'),
(108, 'Mummy', 'Success', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 16:57:17', '2021-03-24 16:57:17'),
(109, 'Alfa', 'Ibrahim', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-24 18:45:27', '2021-03-24 18:45:27'),
(110, 'Mr', 'Williams', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 09:23:41', '2021-03-25 09:23:41'),
(111, 'Iya', 'Kaosara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 09:36:40', '2021-03-25 09:36:40'),
(112, 'Mummy', 'Habeeb', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 09:56:42', '2021-03-25 09:56:42'),
(113, 'Orin', 'dowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 10:20:02', '2021-03-25 10:20:02'),
(114, 'Uni', 'lorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 10:28:12', '2021-03-25 10:28:12'),
(115, 'Arilewo', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 10:31:00', '2021-03-25 10:31:00'),
(116, 'Mummy', 'Bolu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 10:43:22', '2021-03-25 10:43:22'),
(117, 'Mummy', 'Anthony', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 10:55:42', '2021-03-25 10:55:42'),
(118, 'Banke', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 11:05:52', '2021-03-25 11:05:52'),
(119, 'Mrs', 'Ola Ore', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 11:10:01', '2021-03-25 11:10:01'),
(120, 'Iya', 'Oke Andi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 11:17:47', '2021-03-25 11:17:47'),
(121, 'Alhaja', 'M. D. Ayoka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 11:19:38', '2021-03-25 11:19:38'),
(122, 'Iya', 'Shao', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 12:06:48', '2021-03-25 12:06:48'),
(123, 'Iya', 'Shao', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 12:06:48', '2021-03-25 12:06:48'),
(124, 'Alhaja', 'Ajase', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 12:43:01', '2021-03-25 12:43:01'),
(125, 'Mummy', 'Lekan Eiyenkorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 12:45:04', '2021-03-25 12:45:04'),
(126, 'Alfa', 'Alfa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 13:12:52', '2021-03-25 13:12:52'),
(127, 'Aunty', 'Folake', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 13:29:23', '2021-03-25 13:29:23'),
(128, 'Tobi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 13:41:33', '2021-03-25 13:41:33'),
(129, 'Iya', 'Suleiman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 14:41:46', '2021-03-25 14:41:46'),
(130, 'Adeyemi', 'Stores', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 14:43:19', '2021-03-25 14:43:19'),
(131, 'Mr', 'Hope', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 14:52:47', '2021-03-25 14:52:47'),
(132, 'Iya', 'Ifelodun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 15:08:40', '2021-03-25 15:08:40'),
(133, 'Mummy', 'Ife', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 15:14:13', '2021-03-25 15:14:13'),
(134, 'Mummy', 'Fawaz', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 15:20:46', '2021-03-25 15:20:46'),
(135, 'Mummy', 'Wale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:08:46', '2021-03-25 16:08:46'),
(136, 'Mrs', 'Mossi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:10:38', '2021-03-25 16:10:38'),
(137, 'Rashi', 'dat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:14:02', '2021-03-25 16:14:02'),
(138, 'Mummy', 'Mulikat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:20:02', '2021-03-25 16:20:02'),
(139, 'Aro', 'ma', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:21:43', '2021-03-25 16:21:43'),
(140, 'Simbiat', 'Stores', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:24:26', '2021-03-25 16:24:26'),
(141, 'Iya', 'Ayisat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:33:08', '2021-03-25 16:33:08'),
(142, 'Mr', 'Issa Musa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:34:42', '2021-03-25 16:34:42'),
(143, 'Mr', 'Issa Musa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 16:35:10', '2021-03-25 16:35:10'),
(144, 'Mrs', 'Alaka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 17:12:27', '2021-03-25 17:12:27'),
(145, 'C', 'Race', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 17:39:40', '2021-03-25 17:39:40'),
(146, 'Adesina', 'Wife', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 17:45:55', '2021-03-25 17:45:55'),
(147, 'Adesina', 'Wife', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-25 17:45:55', '2021-03-25 17:45:55'),
(148, 'Mummy', 'Dara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 09:01:58', '2021-03-26 09:01:58'),
(149, 'Brother ', 'Patigi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 09:13:45', '2021-03-26 09:13:45'),
(150, 'K.', 'Goodies', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:05:55', '2021-03-26 10:05:55'),
(151, 'K.', 'Goodies', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:05:55', '2021-03-26 10:05:55'),
(152, 'K.', 'Goodies', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:05:55', '2021-03-26 10:05:55'),
(153, 'K.', 'Goodies', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:06:38', '2021-03-26 10:06:38'),
(154, 'mr.', 'Amadu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:21:58', '2021-03-26 10:21:58'),
(155, 'Iya', 'Rodiat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:45:28', '2021-03-26 10:45:28'),
(156, 'Iya', 'Anu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:51:42', '2021-03-26 10:51:42'),
(157, 'customer', 'mr.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 10:55:47', '2021-03-26 10:55:47'),
(158, 'mr.', 'oriyomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 11:21:44', '2021-03-26 11:21:44'),
(159, 'salihu', 'titi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 11:37:18', '2021-03-26 11:37:18'),
(160, 'Azeez', 'Asejere', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 12:18:06', '2021-03-26 12:18:06'),
(161, 'Austina', 'mrs', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 12:57:39', '2021-03-26 12:57:39'),
(162, 'iya', 'omu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 13:01:45', '2021-03-26 13:01:45'),
(163, 'Iya', 'omu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 13:02:45', '2021-03-26 13:02:45'),
(164, 'Ace', 'Ace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 13:15:59', '2021-03-26 13:15:59'),
(165, 'mummy', 'goodluck', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 13:17:16', '2021-03-26 13:17:16'),
(166, 'iya', 'akande', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 13:43:08', '2021-03-26 13:43:08'),
(167, 'Mummy', 'Success', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 14:52:01', '2021-03-26 14:52:01'),
(168, 'mummy', 'pastor', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 14:53:18', '2021-03-26 14:53:18'),
(169, 'Lateef', 'Abdul', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 14:55:19', '2021-03-26 14:55:19'),
(170, 'Mr. ', 'Paul', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:02:32', '2021-03-26 15:02:32'),
(171, 'Mummy', 'oyin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:11:21', '2021-03-26 15:11:21'),
(172, 's', 'k', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:28:28', '2021-03-26 15:28:28'),
(173, 'sisi', 'bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:38:17', '2021-03-26 15:38:17'),
(174, 'sisi', 'bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:38:17', '2021-03-26 15:38:17'),
(175, 'sisi', 'bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 15:38:17', '2021-03-26 15:38:17'),
(176, 'olu', 'shola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:11:48', '2021-03-26 16:11:48'),
(177, 'customer', 'mrs', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:18:11', '2021-03-26 16:18:11'),
(178, 'customer', 'mrs', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:18:11', '2021-03-26 16:18:11'),
(179, 'God', 'is good', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:54:25', '2021-03-26 16:54:25'),
(180, 'daddy', 'yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:55:45', '2021-03-26 16:55:45'),
(181, 'iya', 'ronke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 16:59:49', '2021-03-26 16:59:49'),
(182, 'iya', 'ronke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 17:01:35', '2021-03-26 17:01:35'),
(183, 'iya', 'ronke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 17:01:35', '2021-03-26 17:01:35'),
(184, 'Alhaja', 'Omolabake', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 17:44:48', '2021-03-26 17:44:48'),
(185, 'Zeto', 'rash', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-26 17:50:04', '2021-03-26 17:50:04'),
(186, 'Omo', 'Sunna', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:12:50', '2021-03-27 11:12:50'),
(187, 'Alhaji', 'One Day', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:17:11', '2021-03-27 11:17:11'),
(188, 'Daddy', 'Raimo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:10:58', '2021-03-27 11:10:58'),
(189, 'Aji', 'ha', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:51:52', '2021-03-27 11:51:52'),
(190, 'Alh', 'aja', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:53:48', '2021-03-27 11:53:48'),
(191, 'Edinwo', 'S. M', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:58:47', '2021-03-27 11:58:47'),
(192, 'Edinwo', 'S. M', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 11:58:47', '2021-03-27 11:58:47'),
(193, 'Ola', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 12:06:52', '2021-03-27 12:06:52'),
(194, 'Aje', 'Wole', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 13:07:53', '2021-03-27 13:07:53'),
(195, 'Ola Bola', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 13:49:03', '2021-03-27 13:49:03'),
(196, 'Glory', 'Ventures', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 14:47:40', '2021-03-27 14:47:40'),
(197, 'Mummy', 'Toyin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 15:24:08', '2021-03-27 15:24:08'),
(198, 'Alhaji', 'Olorungbebe', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 15:53:58', '2021-03-27 15:53:58'),
(199, 'Mummy', 'Eri', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 16:11:05', '2021-03-27 16:11:05'),
(200, 'Alhaja', 'Alaba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 16:12:34', '2021-03-27 16:12:34'),
(201, 'Ola', 'Oluwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 16:29:25', '2021-03-27 16:29:25'),
(202, 'Alhaji', 'Sikiru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-27 16:44:39', '2021-03-27 16:44:39'),
(203, 'Daddy', 'Jumoke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 09:51:37', '2021-03-29 09:51:37'),
(204, 'Dad', 'Dad', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 10:13:33', '2021-03-29 10:13:33'),
(205, 'Ogun', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 10:19:52', '2021-03-29 10:19:52'),
(206, 'Mrs', 'Ogun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 10:49:37', '2021-03-29 10:49:37'),
(207, 'Mrs', 'Adeyemo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 10:51:06', '2021-03-29 10:51:06'),
(208, 'Alhaja', 'Saleke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 11:53:28', '2021-03-29 11:53:28'),
(209, 'Oga', 'Emma', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 12:09:51', '2021-03-29 12:09:51'),
(210, 'Mrs', 'Olajide', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 12:10:44', '2021-03-29 12:10:44'),
(211, 'Royals', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 13:47:22', '2021-03-29 13:47:22'),
(212, 'Mummy', 'Kola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 14:22:03', '2021-03-29 14:22:03'),
(213, 'Sakariyau', 'Aminat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 14:27:39', '2021-03-29 14:27:39'),
(214, 'Alhaja', 'Otte', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 14:36:16', '2021-03-29 14:36:16'),
(215, 'Iya', 'Biodun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 15:25:12', '2021-03-29 15:25:12'),
(216, 'Mummy', 'Emmanuella', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 15:40:24', '2021-03-29 15:40:24'),
(217, 'Oluwa', 'joba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 15:52:19', '2021-03-29 15:52:19'),
(218, 'Alhaji', 'Alaba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 15:58:57', '2021-03-29 15:58:57'),
(219, 'Mummy', 'Israel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-29 17:17:41', '2021-03-29 17:17:41'),
(220, 'Orin', 'dowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 10:48:27', '2021-03-30 10:48:27'),
(221, 'Amazing', 'Grace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 11:25:08', '2021-03-30 11:25:08'),
(222, 'Grand', 'Ma', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 12:15:09', '2021-03-30 12:15:09'),
(223, 'Alhaja', 'One Day', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 12:36:52', '2021-03-30 12:36:52'),
(224, 'Jemila', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 15:53:44', '2021-03-30 15:53:44'),
(225, 'Baba', 'Igbeti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 16:08:36', '2021-03-30 16:08:36'),
(226, 'Bro', 'David', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 16:30:05', '2021-03-30 16:30:05'),
(227, 'Alhaja', 'Okolowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 16:45:05', '2021-03-30 16:45:05'),
(228, 'Mr', 'Shayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-30 16:47:13', '2021-03-30 16:47:13'),
(229, 'Aunty', 'Biola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 10:19:46', '2021-03-31 10:19:46'),
(230, 'Ostrich', 'Bakery', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 12:47:08', '2021-03-31 12:47:08'),
(231, 'Mr', 'Ajayi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 13:47:08', '2021-03-31 13:47:08'),
(232, 'Iya', 'Yetunde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 15:25:46', '2021-03-31 15:25:46'),
(233, 'God\'s', 'Heritage', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 16:03:30', '2021-03-31 16:03:30'),
(234, 'Olorunwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 16:28:15', '2021-03-31 16:28:15'),
(235, 'Adeleke', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 16:56:05', '2021-03-31 16:56:05'),
(236, 'Omo', 'Aje', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-03-31 16:57:25', '2021-03-31 16:57:25'),
(237, 'Mrs', 'Ododo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 10:12:54', '2021-04-01 10:12:54'),
(238, 'Iya', 'Jamiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 11:48:30', '2021-04-01 11:48:30'),
(239, 'Mummy', 'Arif', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 12:18:39', '2021-04-01 12:18:39'),
(240, 'Iya', 'Ruwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 12:36:14', '2021-04-01 12:36:14'),
(241, 'Mr', 'Babagida', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 13:06:14', '2021-04-01 13:06:14'),
(242, 'Mummy', 'Feranmi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 13:31:58', '2021-04-01 13:31:58'),
(243, 'Adenike', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 15:32:22', '2021-04-01 15:32:22'),
(244, 'Bovina', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 15:39:31', '2021-04-01 15:39:31'),
(245, 'Mummy', 'Airat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-01 16:53:27', '2021-04-01 16:53:27'),
(246, 'Mr', 'Ade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 10:53:59', '2021-04-02 10:53:59'),
(247, 'Mrs', 'Esther', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 11:00:34', '2021-04-02 11:00:34'),
(248, 'Mrs', 'Olayemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 12:56:52', '2021-04-02 12:56:52'),
(249, 'MOTOR', 'VEHICLE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 13:31:39', '2021-04-02 13:31:39'),
(250, 'Yusuf', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 14:46:34', '2021-04-02 14:46:34'),
(251, 'mm', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 14:53:42', '2021-04-02 14:53:42'),
(252, 'Wonderful', 'Ilorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 16:11:50', '2021-04-02 16:11:50'),
(253, 'Olushola', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 16:30:54', '2021-04-02 16:30:54'),
(254, 'Faiyegbami', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-02 16:33:41', '2021-04-02 16:33:41'),
(255, 'Mr', 'Funsho', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 09:24:53', '2021-04-03 09:24:53'),
(256, 'BABBI', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 09:27:27', '2021-04-03 09:27:27'),
(257, 'Mr', 'Pele', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 09:35:21', '2021-04-03 09:35:21'),
(258, 'Hassinunallahi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 09:36:20', '2021-04-03 09:36:20'),
(259, 'Baba', 'Adeshina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 12:39:18', '2021-04-03 12:39:18'),
(260, 'Okolowo', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 14:15:50', '2021-04-03 14:15:50'),
(261, 'Alhaja', 'Iya Gani', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-03 14:48:25', '2021-04-03 14:48:25'),
(262, 'Daddy', 'Success', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 10:32:08', '2021-04-05 10:32:08'),
(263, 'Mr', 'Tayo Kogi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 10:45:17', '2021-04-05 10:45:17'),
(264, 'Mr', 'Gbenga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 11:30:53', '2021-04-05 11:30:53'),
(265, 'Bankole', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 11:38:00', '2021-04-05 11:38:00'),
(266, 'Home of ', 'Peace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 11:39:04', '2021-04-05 11:39:04'),
(267, 'Mrs', 'Eunice', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 12:19:31', '2021-04-05 12:19:31'),
(268, 'Almas', 'Places', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 14:42:11', '2021-04-05 14:42:11'),
(269, 'Mummy', 'Alimat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-05 15:27:55', '2021-04-05 15:27:55'),
(270, 'Mummy', 'Sophia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 09:33:15', '2021-04-06 09:33:15'),
(271, 'Alhaja', 'Sakele', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 09:34:21', '2021-04-06 09:34:21'),
(272, 'Mummy', 'Tobi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 10:00:26', '2021-04-06 10:00:26'),
(273, 'Mummy', 'Alia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 10:41:54', '2021-04-06 10:41:54'),
(274, 'Softy ', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 11:54:26', '2021-04-06 11:54:26'),
(275, 'Olobi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 12:15:16', '2021-04-06 12:15:16'),
(276, 'Daddy', 'Rohimat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 12:17:57', '2021-04-06 12:17:57'),
(277, 'Mummy', 'Ella', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 12:18:37', '2021-04-06 12:18:37'),
(278, 'Alhaja', 'Pupa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 13:40:13', '2021-04-06 13:40:13'),
(279, 'Kafila', 'Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 15:40:11', '2021-04-06 15:40:11'),
(280, 'Alhaji', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 16:16:52', '2021-04-06 16:16:52'),
(281, 'Alhaja', 'Shoga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 16:51:46', '2021-04-06 16:51:46'),
(282, 'Alhaja', 'Ayox', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-06 16:54:26', '2021-04-06 16:54:26'),
(283, 'Iya', 'Okeonigbin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 09:59:17', '2021-04-07 09:59:17'),
(284, 'Mrs', 'Odukoya', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 10:11:55', '2021-04-07 10:11:55'),
(285, 'Pastor', 'Adewuyi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:17:30', '2021-04-07 11:17:30'),
(286, 'Customer', 'Ojaoba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:22:06', '2021-04-07 11:22:06'),
(287, 'Mummy', 'Joy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:31:32', '2021-04-07 11:31:32'),
(288, 'Mummy', 'Joy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:31:32', '2021-04-07 11:31:32'),
(289, 'Alhaji', 'Karamoli', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:35:44', '2021-04-07 11:35:44'),
(290, 'Alhaji', 'Karamoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 11:36:38', '2021-04-07 11:36:38'),
(291, 'Mr', 'Eluku', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 15:05:16', '2021-04-07 15:05:16'),
(292, 'Iya', 'Taiwo Isale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 15:54:33', '2021-04-07 15:54:33'),
(293, 'Mummy', 'Baby', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 17:22:01', '2021-04-07 17:22:01'),
(294, 'Alhaji', 'Umar', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-07 17:52:52', '2021-04-07 17:52:52'),
(295, 'Daddy', 'Bode', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 09:55:16', '2021-04-08 09:55:16'),
(296, 'Daddy', 'Bode', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 09:55:16', '2021-04-08 09:55:16'),
(297, 'Iya', 'Muhammed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:06:15', '2021-04-08 11:06:15'),
(298, 'Mummy', 'Deborah', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:30:22', '2021-04-08 11:30:22'),
(299, 'Mummy', 'Biodun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:32:13', '2021-04-08 11:32:13'),
(300, 'Mummy', 'Biodun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:32:13', '2021-04-08 11:32:13'),
(301, 'Shade', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:38:15', '2021-04-08 11:38:15'),
(302, 'Omu', 'Iyadun Saadu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 11:52:44', '2021-04-08 11:52:44'),
(303, 'Ramota', 'Fatia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 13:26:44', '2021-04-08 13:26:44'),
(304, 'Ramota', 'Fatia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 13:26:44', '2021-04-08 13:26:44'),
(305, 'Authority', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 13:45:29', '2021-04-08 13:45:29'),
(306, 'Authority', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 13:45:29', '2021-04-08 13:45:29'),
(307, 'Share', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 14:03:27', '2021-04-08 14:03:27'),
(308, 'Mr', 'Okanlawon', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 14:31:45', '2021-04-08 14:31:45'),
(309, 'Bodunde', 'Bukola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-08 16:02:02', '2021-04-08 16:02:02'),
(310, 'Adeosun', 'Folake', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 10:00:00', '2021-04-09 10:00:00'),
(311, 'Iya', 'Bili', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:05:22', '2021-04-09 11:05:22'),
(312, 'Iya', 'Bili', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:05:22', '2021-04-09 11:05:22'),
(313, 'Iya', 'Danladi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:39:56', '2021-04-09 11:39:56'),
(314, 'Iya', 'Danladi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:39:56', '2021-04-09 11:39:56'),
(315, 'Somi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:40:52', '2021-04-09 11:40:52'),
(316, 'Somi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 11:40:52', '2021-04-09 11:40:52'),
(317, 'Hausa', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 12:39:46', '2021-04-09 12:39:46'),
(318, 'Abubakar', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 15:12:44', '2021-04-09 15:12:44'),
(319, 'Aliu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-09 15:14:12', '2021-04-09 15:14:12'),
(320, 'Iya', 'Lukman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 09:16:42', '2021-04-10 09:16:42'),
(321, 'Mr', 'Ola-Amina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 09:51:14', '2021-04-10 09:51:14'),
(322, 'Mummy', 'Ayishat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 10:29:33', '2021-04-10 10:29:33'),
(323, 'Laide', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 11:31:04', '2021-04-10 11:31:04'),
(324, 'Iya', 'Aminat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 12:41:00', '2021-04-10 12:41:00'),
(325, 'Mrs.', 'Ayara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 12:59:34', '2021-04-10 12:59:34'),
(326, 'Mrs', 'Aminat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 13:18:33', '2021-04-10 13:18:33'),
(327, 'Simbi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 15:02:28', '2021-04-10 15:02:28'),
(328, 'Simbi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 15:02:28', '2021-04-10 15:02:28'),
(329, 'Rosemary', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 15:21:13', '2021-04-10 15:21:13'),
(330, 'Alhaji', 'Isiaka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 15:25:38', '2021-04-10 15:25:38'),
(331, 'Ola Oluwa', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 16:39:06', '2021-04-10 16:39:06'),
(332, 'Ayoola', 'Ventures', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-10 16:56:22', '2021-04-10 16:56:22'),
(333, 'Iya', 'Jumoi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 09:26:12', '2021-04-12 09:26:12'),
(334, 'Mrs', 'Ayoade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 10:32:31', '2021-04-12 10:32:31'),
(335, 'Mummy', 'Kariff', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 10:33:36', '2021-04-12 10:33:36'),
(336, 'Mrs', 'Abike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 11:41:15', '2021-04-12 11:41:15'),
(337, 'Iya', 'Aro', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 12:16:46', '2021-04-12 12:16:46'),
(338, 'Mrs', 'Bola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 13:08:14', '2021-04-12 13:08:14'),
(339, 'Iya', 'Mujib', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 13:38:04', '2021-04-12 13:38:04'),
(340, 'Mummy', 'NIKE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 14:00:44', '2021-04-12 14:00:44'),
(341, 'Alhaja', 'Aminat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 14:31:06', '2021-04-12 14:31:06'),
(342, 'Mummy', 'Fawasi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 14:38:34', '2021-04-12 14:38:34'),
(343, 'Olorunjeda', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-12 15:06:31', '2021-04-12 15:06:31'),
(344, 'Adirigo', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 09:21:26', '2021-04-13 09:21:26'),
(345, 'K.', 'B', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 09:28:13', '2021-04-13 09:28:13'),
(346, 'Iya', 'Mary', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 09:56:57', '2021-04-13 09:56:57'),
(347, 'Alhaji', 'Isiaka Sango', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 09:59:39', '2021-04-13 09:59:39'),
(348, 'Alhaji', 'Isiaka Okolowo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 10:00:29', '2021-04-13 10:00:29'),
(349, 'D King', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 10:01:32', '2021-04-13 10:01:32'),
(350, 'Mummy', 'Moyin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 11:39:17', '2021-04-13 11:39:17'),
(351, 'Iya', 'Adenike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 12:36:37', '2021-04-13 12:36:37');
INSERT INTO `tbl_customers` (`SN`, `firstname`, `lastname`, `email`, `phone`, `address`, `credit_limit`, `weeks`, `expired_date`, `date`, `city`, `additional_info`, `branch_id`, `updated`, `created`) VALUES
(352, 'Bro', 'Ade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 14:01:04', '2021-04-13 14:01:04'),
(353, 'Mummy', 'Gooluck', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 14:21:51', '2021-04-13 14:21:51'),
(354, 'Alagbada', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 14:51:23', '2021-04-13 14:51:23'),
(355, 'Keneathe', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-13 15:35:04', '2021-04-13 15:35:04'),
(356, 'Iya ', 'Yibo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 09:57:45', '2021-04-14 09:57:45'),
(357, 'Mummy', 'Eniola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 10:00:00', '2021-04-14 10:00:00'),
(358, 'Mr', 'Michael Wonderful', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 11:00:04', '2021-04-14 11:00:04'),
(359, 'Iya', 'Sherriff', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 12:56:09', '2021-04-14 12:56:09'),
(360, 'Anabi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 14:23:00', '2021-04-14 14:23:00'),
(361, 'Mrs', 'Odukoya', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 14:39:02', '2021-04-14 14:39:02'),
(362, 'Iyanuoluwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-14 15:02:30', '2021-04-14 15:02:30'),
(363, 'Iya', 'Akeem', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 09:56:13', '2021-04-15 09:56:13'),
(364, 'Mummy', 'Soirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 10:53:26', '2021-04-15 10:53:26'),
(365, 'Mummy', 'Soirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 10:53:26', '2021-04-15 10:53:26'),
(366, 'Mummy', 'Sobirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 10:54:05', '2021-04-15 10:54:05'),
(367, 'Mrs', 'Opeyemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 13:13:05', '2021-04-15 13:13:05'),
(368, 'Hay', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 13:52:50', '2021-04-15 13:52:50'),
(369, 'Hay', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 13:52:50', '2021-04-15 13:52:50'),
(370, 'Mr', 'Richard', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 14:11:54', '2021-04-15 14:11:54'),
(371, 'Brother', 'Sarafa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 15:08:44', '2021-04-15 15:08:44'),
(372, 'Brother', 'Sarafa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 15:08:44', '2021-04-15 15:08:44'),
(373, 'Alhaja', 'Harmony', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 16:06:11', '2021-04-15 16:06:11'),
(374, 'Ise', 'Oluwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 17:09:16', '2021-04-15 17:09:16'),
(375, 'Ise', 'Oluwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-15 17:09:16', '2021-04-15 17:09:16'),
(376, 'Iya', 'Baba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 09:45:32', '2021-04-16 09:45:32'),
(377, 'Iya', 'Abayomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 11:08:10', '2021-04-16 11:08:10'),
(378, 'Iya', 'Zainab', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 11:17:49', '2021-04-16 11:17:49'),
(379, 'Cash', 'Madam', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 11:59:27', '2021-04-16 11:59:27'),
(380, 'Iya', 'Ekiti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 12:09:31', '2021-04-16 12:09:31'),
(381, 'Damilare', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 14:34:52', '2021-04-16 14:34:52'),
(382, 'Mummy', 'Samuel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-16 16:16:15', '2021-04-16 16:16:15'),
(383, 'Mummy', 'Baraka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 10:34:18', '2021-04-17 10:34:18'),
(384, 'Imole', 'Ayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 11:19:35', '2021-04-17 11:19:35'),
(385, 'Awotunde', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 11:48:11', '2021-04-17 11:48:11'),
(386, 'Mummy', 'Sodiq', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 14:08:53', '2021-04-17 14:08:53'),
(387, 'Mummy', 'Sodiq', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 14:08:53', '2021-04-17 14:08:53'),
(388, 'Provite', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-17 16:34:27', '2021-04-17 16:34:27'),
(389, 'Hospitality', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 09:51:54', '2021-04-19 09:51:54'),
(390, 'Mr', 'Azeez', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 09:54:00', '2021-04-19 09:54:00'),
(391, 'Tersee', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 10:13:33', '2021-04-19 10:13:33'),
(392, 'Mr', 'Abubakar', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 10:15:11', '2021-04-19 10:15:11'),
(393, 'Mrs', 'Mustapha', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 10:23:40', '2021-04-19 10:23:40'),
(394, 'Mummy', 'Kola Tanke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 10:50:23', '2021-04-19 10:50:23'),
(395, 'Mummy', 'Kola Gaa Akanbi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 10:54:27', '2021-04-19 10:54:27'),
(396, 'Aunty', 'Oyin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 11:02:37', '2021-04-19 11:02:37'),
(397, 'Driver', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 11:14:28', '2021-04-19 11:14:28'),
(398, 'Brother', 'Sayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 12:26:04', '2021-04-19 12:26:04'),
(399, 'Animasahun ', 'Funmilayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 14:13:45', '2021-04-19 14:13:45'),
(400, 'Alhaja', 'Shittu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 14:27:23', '2021-04-19 14:27:23'),
(401, 'Iya', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 14:30:48', '2021-04-19 14:30:48'),
(402, 'Alfa', 'Adeshina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 14:36:20', '2021-04-19 14:36:20'),
(403, 'Mopelola', 'Ventures (BOSS)', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-19 14:47:42', '2021-04-19 14:47:42'),
(404, 'Mrs', 'Morifat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 09:00:38', '2021-04-20 09:00:38'),
(405, 'Onimango', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 09:14:37', '2021-04-20 09:14:37'),
(406, 'Brother', 'Usman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 09:42:38', '2021-04-20 09:42:38'),
(407, 'Alhaji', 'Bawasa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 14:37:46', '2021-04-20 14:37:46'),
(408, 'Alhaja', 'Olorungbebe', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 14:48:41', '2021-04-20 14:48:41'),
(409, 'Aro', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-20 16:49:08', '2021-04-20 16:49:08'),
(410, 'Faith', 'Nwadike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-21 14:03:03', '2021-04-21 14:03:03'),
(411, 'Mummy', 'Adesewa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-21 16:01:05', '2021-04-21 16:01:05'),
(412, 'Mama', 'Vick', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-21 17:03:39', '2021-04-21 17:03:39'),
(413, 'SAIMAT', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 09:57:20', '2021-04-22 09:57:20'),
(414, 'Mr', 'Ade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 10:35:18', '2021-04-22 10:35:18'),
(415, 'mum', 'bose', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 12:11:27', '2021-04-22 12:11:27'),
(416, 'Ajaami', 'Eleha', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 12:40:41', '2021-04-22 12:40:41'),
(417, 'sis', 'mariam', '', '08051259980', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 12:51:42', '2021-04-22 12:51:42'),
(418, 'Jamiu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 14:06:31', '2021-04-22 14:06:31'),
(419, 'Ciades', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 14:28:42', '2021-04-22 14:28:42'),
(420, 'Khalees', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 14:44:18', '2021-04-22 14:44:18'),
(421, 'Alhaji', 'Gbari', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 15:06:19', '2021-04-22 15:06:19'),
(422, 'Alhaji', 'Gbari', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 15:06:19', '2021-04-22 15:06:19'),
(423, 'Driver', 'Abu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 15:09:03', '2021-04-22 15:09:03'),
(424, 'Mrs', 'Lawal', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 16:00:22', '2021-04-22 16:00:22'),
(425, 'Mrs', 'Lawal', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 16:00:23', '2021-04-22 16:00:23'),
(426, 'Profit', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 16:23:25', '2021-04-22 16:23:25'),
(427, 'Profit', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 16:23:25', '2021-04-22 16:23:25'),
(428, 'Alhaja', 'Ololomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 17:01:59', '2021-04-22 17:01:59'),
(429, 'Iya', 'Aroworopo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 17:16:38', '2021-04-22 17:16:38'),
(430, 'Iya', 'Aroworopo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 17:16:38', '2021-04-22 17:16:38'),
(431, 'Iya', 'Aroworopo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-22 17:16:39', '2021-04-22 17:16:39'),
(432, 'iya', 'omuaran', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 11:38:44', '2021-04-23 11:38:44'),
(433, 'Mrs', 'Adebike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:15:11', '2021-04-23 14:15:11'),
(434, 'Mrs', 'Adebike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:15:11', '2021-04-23 14:15:11'),
(435, 'Mrs', 'Adebike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:15:11', '2021-04-23 14:15:11'),
(436, 'Mrs', 'Adebike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:15:11', '2021-04-23 14:15:11'),
(437, 'Mummy', 'Abdulazeem', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:17:55', '2021-04-23 14:17:55'),
(438, 'Iya', 'Keu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 14:43:36', '2021-04-23 14:43:36'),
(439, 'Dickson', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 15:16:54', '2021-04-23 15:16:54'),
(440, 'Vick', 'Glory of God', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 15:23:37', '2021-04-23 15:23:37'),
(441, 'Iyawo', 'Alfa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 15:37:58', '2021-04-23 15:37:58'),
(442, 'Iyawo', 'Alfa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 15:37:58', '2021-04-23 15:37:58'),
(443, 'Iyawo', 'Alfa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-23 15:37:58', '2021-04-23 15:37:58'),
(444, 'Mr', 'Michael', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 11:40:56', '2021-04-24 11:40:56'),
(445, 'Mr', 'Wasiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 12:40:42', '2021-04-24 12:40:42'),
(446, 'Mr', 'Wasiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 12:40:42', '2021-04-24 12:40:42'),
(447, 'Mr', 'Wasiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 12:40:43', '2021-04-24 12:40:43'),
(448, 'Alhaja', 'Tawakalitu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 13:07:53', '2021-04-24 13:07:53'),
(449, 'Alhaja', 'Olalomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 13:52:51', '2021-04-24 13:52:51'),
(450, 'Glory', 'Foods', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 13:53:52', '2021-04-24 13:53:52'),
(451, 'Glory', 'Foods', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 13:53:52', '2021-04-24 13:53:52'),
(452, 'Alhaja', 'Iya Nuru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 14:23:58', '2021-04-24 14:23:58'),
(453, 'Alhaja', 'Iya Nuru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 14:23:58', '2021-04-24 14:23:58'),
(454, 'Alhaja', 'Iya Nuru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 14:23:58', '2021-04-24 14:23:58'),
(455, 'Oluwabamishe', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 14:29:21', '2021-04-24 14:29:21'),
(456, 'Foresight', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:06:36', '2021-04-24 16:06:36'),
(457, 'Foresight', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:06:37', '2021-04-24 16:06:37'),
(458, 'Royal', 'Ventures', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:21:09', '2021-04-24 16:21:09'),
(459, 'Alhaji', 'Ibrahim', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:36:09', '2021-04-24 16:36:09'),
(460, 'Alhaji', 'Ibrahim', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:36:10', '2021-04-24 16:36:10'),
(461, 'Brother', 'Taiye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:45:28', '2021-04-24 16:45:28'),
(462, 'Brother', 'Taiye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 16:45:28', '2021-04-24 16:45:28'),
(463, 'Mr', 'Oladejo Solomon', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 17:01:31', '2021-04-24 17:01:31'),
(464, 'Kifayah', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 17:42:51', '2021-04-24 17:42:51'),
(465, 'Kifayah', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-24 17:42:51', '2021-04-24 17:42:51'),
(466, 'Yuhuza', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 09:45:47', '2021-04-26 09:45:47'),
(467, 'Mummy', 'Rofia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 11:24:52', '2021-04-26 11:24:52'),
(468, 'Adozin', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 11:54:01', '2021-04-26 11:54:01'),
(469, 'Mummy', 'Favour', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 12:21:35', '2021-04-26 12:21:35'),
(470, 'Alhaji', 'Kiasi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 13:23:50', '2021-04-26 13:23:50'),
(471, 'Bello', 'Salawu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 15:01:30', '2021-04-26 15:01:30'),
(472, 'Mummy', 'Peter', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 15:03:03', '2021-04-26 15:03:03'),
(473, 'Idiyah', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-26 15:38:18', '2021-04-26 15:38:18'),
(474, 'Iya', 'Idofia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-27 10:01:21', '2021-04-27 10:01:21'),
(475, 'Oyeyemi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-27 12:03:24', '2021-04-27 12:03:24'),
(476, 'Iya', 'Alore', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-27 16:40:15', '2021-04-27 16:40:15'),
(477, 'Mummy', 'Nasirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-28 13:18:46', '2021-04-28 13:18:46'),
(478, 'Mummy', 'Nasirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-28 13:18:47', '2021-04-28 13:18:47'),
(479, 'Mummy', 'Nasirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-28 13:18:47', '2021-04-28 13:18:47'),
(480, 'Nathaniel', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-28 15:43:10', '2021-04-28 15:43:10'),
(481, 'Oga', 'Friday', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 10:32:05', '2021-04-29 10:32:05'),
(482, 'Mr', 'Mayowa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 10:33:17', '2021-04-29 10:33:17'),
(483, 'Alhaja', 'Alasirin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 10:36:08', '2021-04-29 10:36:08'),
(484, 'Alhaji', 'Malete', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 11:09:59', '2021-04-29 11:09:59'),
(485, 'Omoboriowo', '4', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 11:15:47', '2021-04-29 11:15:47'),
(486, 'Mummy', 'Iyanuoluwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 11:42:00', '2021-04-29 11:42:00'),
(487, 'Deshina', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-29 13:46:51', '2021-04-29 13:46:51'),
(488, 'Daddy', 'Odunayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 13:46:53', '2021-04-30 13:46:53'),
(489, 'Daddy', 'Odunayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 13:46:53', '2021-04-30 13:46:53'),
(490, 'Daddy', 'Odunayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 13:46:53', '2021-04-30 13:46:53'),
(491, 'Mummy', 'Yemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 14:42:22', '2021-04-30 14:42:22'),
(492, 'Mummy', 'Yemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 14:42:22', '2021-04-30 14:42:22'),
(493, 'Mummy', 'Yemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 14:43:08', '2021-04-30 14:43:08'),
(494, 'Alhaja', 'Kishi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 15:09:14', '2021-04-30 15:09:14'),
(495, 'Ajiboye', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-04-30 16:54:49', '2021-04-30 16:54:49'),
(496, 'Iya', 'Saheed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 11:14:12', '2021-05-01 11:14:12'),
(497, 'Mummy', 'Rasheed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 11:15:43', '2021-05-01 11:15:43'),
(498, 'Mummy', 'Rasheed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 11:15:44', '2021-05-01 11:15:44'),
(499, 'Iya', 'Eiyenkorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 13:46:51', '2021-05-01 13:46:51'),
(500, 'Iya', 'Faruk', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 13:49:05', '2021-05-01 13:49:05'),
(501, 'Mummy', 'Orobo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-01 15:49:40', '2021-05-01 15:49:40'),
(502, 'Mummy', 'Bashit', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 09:10:18', '2021-05-03 09:10:18'),
(503, 'Iya', 'Siliamiat', '', '0', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 09:51:41', '2021-05-03 09:51:41'),
(504, 'Alhaja', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 11:33:13', '2021-05-03 11:33:13'),
(505, 'Alhaja', 'Rashidat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:05:56', '2021-05-03 12:05:56'),
(506, 'Alhaji', 'Wasiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:09:14', '2021-05-03 12:09:14'),
(507, 'Mr', 'Musa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:20:36', '2021-05-03 12:20:36'),
(508, 'Alhaja', 'Sikirat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:24:13', '2021-05-03 12:24:13'),
(509, 'Alhaja', 'Saka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:34:58', '2021-05-03 12:34:58'),
(510, 'Onireke', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:35:53', '2021-05-03 12:35:53'),
(511, 'Alhaja', 'Kide', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 12:54:13', '2021-05-03 12:54:13'),
(512, 'Mummy', 'Grace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 14:39:08', '2021-05-03 14:39:08'),
(513, 'Orinoye', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 14:43:17', '2021-05-03 14:43:17'),
(514, 'Mummy', 'Dominion', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 14:44:37', '2021-05-03 14:44:37'),
(515, 'Otibu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 15:06:05', '2021-05-03 15:06:05'),
(516, 'Mummy', 'Fuad', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 15:07:06', '2021-05-03 15:07:06'),
(517, 'Mummy', 'Halleluyah', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-05-03 16:49:21', '2021-05-03 16:49:21'),
(518, 'Bacita', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:32:26', '2021-08-17 08:32:26'),
(519, 'Aunty', 'Pelumi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:41:29', '2021-08-16 08:41:29'),
(520, 'Alhaja', 'Bale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 09:04:19', '2021-08-17 09:04:19'),
(521, 'Gift', 'Butter Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 09:24:01', '2021-08-17 09:24:01'),
(522, 'Abanise', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 09:36:26', '2021-08-17 09:36:26'),
(523, 'Omonla', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:01:44', '2021-08-17 10:01:44'),
(524, 'Mummy', 'Toluwani', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:03:11', '2021-08-17 10:03:11'),
(525, 'Temitope', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:04:50', '2021-08-17 10:04:50'),
(526, 'Olalere', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:14:51', '2021-08-17 10:14:51'),
(527, 'Alhaja', 'Zainab', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:43:51', '2021-08-17 10:43:51'),
(528, 'Abayomi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 10:46:33', '2021-08-17 10:46:33'),
(529, 'Alhaja', 'Amidu Monsurat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 11:27:06', '2021-08-17 11:27:06'),
(530, 'Alhaja', 'Amidu Monsurat Tunra', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 11:27:43', '2021-08-17 11:27:43'),
(531, 'Alhaja Amidu', 'Monsurat Tunrayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 11:28:27', '2021-08-17 11:28:27'),
(532, 'Samuel', 'Ekundayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 11:29:25', '2021-08-16 11:29:25'),
(533, 'Mummy', 'Hammad', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 11:38:07', '2021-08-17 11:38:07'),
(534, 'Mrs', 'Adeleke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 11:55:01', '2021-08-17 11:55:01'),
(535, 'Iya', 'Tapa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 12:04:40', '2021-08-17 12:04:40'),
(536, 'Okiki', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 12:13:52', '2021-08-17 12:13:52'),
(537, 'Iya', 'Faruku', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 12:17:13', '2021-08-17 12:17:13'),
(538, 'Mummy', 'Sukurat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 12:40:59', '2021-08-17 12:40:59'),
(539, 'God is Good', 'Saadu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 06:53:04', '2021-08-17 06:53:04'),
(540, 'Mummy', 'Ibukun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 06:54:23', '2021-08-17 06:54:23'),
(541, 'A. Z.', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 06:56:32', '2021-08-17 06:56:32'),
(542, 'Olayinka', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 06:57:47', '2021-08-17 06:57:47'),
(543, 'Ultimate', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 07:06:55', '2021-08-17 07:06:55'),
(544, 'Oluwaseyi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 07:10:38', '2021-08-17 07:10:38'),
(545, 'Ola', 'Fatia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 07:15:13', '2021-08-17 07:15:13'),
(546, 'Chidudi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 07:24:55', '2021-08-17 07:24:55'),
(547, 'Seyi', 'Balogun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 07:45:46', '2021-08-17 07:45:46'),
(548, 'Kehinde', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:05:04', '2021-08-17 08:05:04'),
(549, 'Mr', 'Abdullateef', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:06:56', '2021-08-17 08:06:56'),
(550, 'Mummy', 'Gbolahan', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:11:33', '2021-08-17 08:11:33'),
(551, 'Ogo-Oluwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:14:37', '2021-08-17 08:14:37'),
(552, 'Azeez', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:17:54', '2021-08-17 08:17:54'),
(553, 'Iya', 'Kazeem', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:27:15', '2021-08-17 08:27:15'),
(554, 'Aluke', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:29:00', '2021-08-16 08:29:00'),
(555, 'Omoboyede', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:29:33', '2021-08-16 08:29:33'),
(556, 'Radiance', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:30:47', '2021-08-16 08:30:47'),
(557, 'Alhaji', 'Olobi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:31:56', '2021-08-16 08:31:56'),
(558, 'Mummy', 'Ajoke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:34:15', '2021-08-17 08:34:15'),
(559, 'Mr', 'Alabi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:34:49', '2021-08-17 08:34:49'),
(560, 'Sakirat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:35:53', '2021-08-17 08:35:53'),
(561, 'Hammed', 'Oloru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:48:30', '2021-08-16 08:48:30'),
(562, 'Mr', 'Olakunle', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 08:54:59', '2021-08-17 08:54:59'),
(563, 'Mummy', 'Mercy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 09:05:29', '2021-08-17 09:05:29'),
(564, 'Alhaja', 'Lady B', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:08:40', '2021-08-16 09:08:40'),
(565, 'Alhaja', 'Olobi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:10:31', '2021-08-16 09:10:31'),
(566, 'Oluwatosin', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:15:13', '2021-08-16 09:15:13'),
(567, 'Adeleke', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-17 09:17:00', '2021-08-17 09:17:00'),
(568, 'Oriyomi', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:28:26', '2021-08-16 09:28:26'),
(569, 'Alhaja', 'Shonga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:28:57', '2021-08-16 09:28:57'),
(570, 'Oga', 'Yibo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:39:40', '2021-08-16 09:39:40'),
(571, 'Ifelodun', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:41:19', '2021-08-16 09:41:19'),
(572, 'Oriyomi', '2', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:44:56', '2021-08-16 09:44:56'),
(573, 'Food', 'Mat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:50:00', '2021-08-16 09:50:00'),
(574, 'Mummy', 'Emmanuella', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 08:38:36', '2021-08-18 08:38:36'),
(575, 'Mummy', 'Emmanuel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 08:39:05', '2021-08-18 08:39:05'),
(576, 'Mr', 'Adetunji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 09:22:34', '2021-08-18 09:22:34'),
(577, 'Alhaja', 'Okeonigbin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 09:30:59', '2021-08-18 09:30:59'),
(578, 'Dove', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 09:46:06', '2021-08-18 09:46:06'),
(579, 'Mummy', 'Lateefat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 09:49:03', '2021-08-18 09:49:03'),
(580, 'Alhaja', 'Yetunde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 10:22:03', '2021-08-18 10:22:03'),
(581, 'Mummy', 'Zainabu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 10:30:33', '2021-08-18 10:30:33'),
(582, 'Iya', 'Hawau', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 10:32:39', '2021-08-18 10:32:39'),
(583, 'Mummy', 'Fatia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 11:33:12', '2021-08-18 11:33:12'),
(584, 'Mummy', 'Ayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 11:40:28', '2021-08-18 11:40:28'),
(585, 'Mummy', 'Muslimat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 12:16:21', '2021-08-18 12:16:21'),
(586, 'Iya', 'Wasiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 12:19:26', '2021-08-18 12:19:26'),
(587, 'Mrs', 'Omodara', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 12:36:28', '2021-08-18 12:36:28'),
(588, 'JELILI', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 13:00:13', '2021-08-18 13:00:13'),
(589, 'Adex', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 13:41:37', '2021-08-18 13:41:37'),
(590, 'Ajoke', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 14:07:46', '2021-08-18 14:07:46'),
(591, 'Mummy', 'Dele', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 15:00:26', '2021-08-18 15:00:26'),
(592, 'Mummy', 'Dami', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 15:01:30', '2021-08-18 15:01:30'),
(593, 'M & T', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 15:40:49', '2021-08-18 15:40:49'),
(594, 'Harmony', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 16:01:18', '2021-08-18 16:01:18'),
(595, 'G. T. B.', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-18 16:03:28', '2021-08-18 16:03:28'),
(596, 'Mummy', 'Alhaja Biola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 08:27:43', '2021-08-19 08:27:43'),
(597, 'Oluwashina', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:44:44', '2021-08-16 08:44:44'),
(598, 'Bolaji', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:48:12', '2021-08-16 08:48:12'),
(599, 'Fortunate', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 08:49:37', '2021-08-16 08:49:37'),
(600, 'Alhaja', 'Oke Andi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-16 09:02:36', '2021-08-16 09:02:36'),
(601, 'Heavenly', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 09:14:26', '2021-08-19 09:14:26'),
(602, 'Mummy', 'Okiki', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:10:28', '2021-08-19 10:10:28'),
(603, 'Iya', 'Awali', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:23:02', '2021-08-19 10:23:02'),
(604, 'Mama', 'Tolu Ekiti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:33:18', '2021-08-19 10:33:18'),
(605, 'Modupe', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:40:48', '2021-08-19 10:40:48'),
(606, 'Boluwatife', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:42:49', '2021-08-19 10:42:49'),
(607, 'Kemi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:44:49', '2021-08-19 10:44:49'),
(608, 'Bolatito', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:47:46', '2021-08-19 10:47:46'),
(609, 'Iya', 'Asabi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:48:37', '2021-08-19 10:48:37'),
(610, 'Mummy', 'Walia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 10:56:32', '2021-08-19 10:56:32'),
(611, 'Moyosore', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 11:04:39', '2021-08-19 11:04:39'),
(612, 'Iya', 'beji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 11:35:42', '2021-08-19 11:35:42'),
(613, 'Mr', 'Siru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 11:36:36', '2021-08-19 11:36:36'),
(614, 'Brother', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 11:41:24', '2021-08-19 11:41:24'),
(615, 'Unilorin', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 12:37:36', '2021-08-19 12:37:36'),
(616, 'Gbogbolomo', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 12:46:21', '2021-08-14 12:46:21'),
(617, 'Agness', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 12:52:37', '2021-08-14 12:52:37'),
(618, 'Oluwanishola', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 13:03:45', '2021-08-14 13:03:45'),
(619, 'Mr', 'Tunde', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 13:05:10', '2021-08-14 13:05:10'),
(620, 'Mummy', 'Muisi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 13:21:13', '2021-08-14 13:21:13'),
(621, 'Oluwasola', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 13:29:53', '2021-08-19 13:29:53'),
(622, 'Mummy', 'Rukayat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 13:44:20', '2021-08-19 13:44:20'),
(623, 'Mummy', 'Gideon', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 13:55:34', '2021-08-19 13:55:34'),
(624, 'Temitope', 'Gbugbi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 14:05:12', '2021-08-19 14:05:12'),
(625, 'Mummy', 'Qudus', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 14:08:31', '2021-08-19 14:08:31'),
(626, 'Alhaji', 'Olosasa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 14:11:45', '2021-08-19 14:11:45'),
(627, 'Aunty', 'Salewa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 14:32:43', '2021-08-14 14:32:43'),
(628, 'Baba', 'Igbeti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 14:40:16', '2021-08-14 14:40:16'),
(629, 'Alfa', 'Yinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 14:55:11', '2021-08-14 14:55:11'),
(630, 'Abubakar', 'Lukman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 14:56:55', '2021-08-14 14:56:55'),
(631, 'Shalom', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 14:59:29', '2021-08-19 14:59:29'),
(632, 'Aliat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 15:14:00', '2021-08-14 15:14:00'),
(633, 'Mr', 'Emmanuel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-14 15:24:33', '2021-08-14 15:24:33'),
(634, 'Ilally', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 15:34:35', '2021-08-19 15:34:35'),
(635, 'Iya', 'Seun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 16:09:25', '2021-08-19 16:09:25'),
(636, 'Brother', 'Ali', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 16:16:59', '2021-08-19 16:16:59'),
(637, 'Mariam', 'Emirs Road', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 16:37:25', '2021-08-19 16:37:25'),
(638, 'Returned', '(Mount Olive)', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-19 07:40:13', '2021-08-19 07:40:13'),
(639, 'Alhaja', 'Amoyo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:19:39', '2021-08-13 08:19:39'),
(640, 'Kasamadupe', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:29:45', '2021-08-13 08:29:45'),
(641, 'Shuaib', 'Aminat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:44:30', '2021-08-13 08:44:30'),
(642, 'Alhaji', 'Oriyomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:46:37', '2021-08-13 08:46:37'),
(643, 'Ishas', 'Cake', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:54:28', '2021-08-13 08:54:28'),
(644, 'Olanisunwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:55:40', '2021-08-13 08:55:40'),
(645, 'Ibadan', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 08:56:57', '2021-08-13 08:56:57'),
(646, 'Mummy', 'Awa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 09:06:15', '2021-08-20 09:06:15'),
(647, 'Mummy', 'Tolani', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 09:16:19', '2021-08-20 09:16:19'),
(648, 'Brother', 'Yemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 09:22:04', '2021-08-20 09:22:04'),
(649, 'Mr', 'Bayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 09:55:33', '2021-08-20 09:55:33'),
(650, 'Mummy', 'Enoch', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 09:58:49', '2021-08-20 09:58:49'),
(651, 'Mariam', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 10:35:45', '2021-08-20 10:35:45'),
(652, 'Mr', 'Bamidele', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 10:50:57', '2021-08-20 10:50:57'),
(653, 'Alhaji', 'Dudu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-13 12:09:23', '2021-08-13 12:09:23'),
(654, 'Indomie', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:17:22', '2021-08-20 12:17:22'),
(655, 'Sukurallahi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:21:17', '2021-08-20 12:21:17'),
(656, 'Mummy', 'Ore', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:23:02', '2021-08-20 12:23:02'),
(657, 'Mummy', 'Emeka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:26:39', '2021-08-20 12:26:39'),
(658, 'Anuoluwapo', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 12:31:50', '2021-08-12 12:31:50'),
(659, 'Mummy', 'Victoria', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:40:18', '2021-08-20 12:40:18'),
(660, 'Alhaji', 'White', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 12:45:28', '2021-08-12 12:45:28'),
(661, 'Abdulganiyu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 12:48:37', '2021-08-12 12:48:37'),
(662, 'Mrs', 'David', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 12:51:21', '2021-08-12 12:51:21'),
(663, 'African', 'Pot', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 12:57:17', '2021-08-20 12:57:17'),
(664, 'Olorunwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 14:14:50', '2021-08-20 14:14:50'),
(665, 'Emeka', 'Kayamo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 14:16:57', '2021-08-20 14:16:57'),
(666, 'Iya', 'Luku Bacita', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 14:43:37', '2021-08-20 14:43:37'),
(667, 'Mummy', 'Ganiyat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-20 15:05:46', '2021-08-20 15:05:46'),
(668, 'Alhaji', 'Usman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 15:35:14', '2021-08-12 15:35:14'),
(669, 'Ifeoluwa', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-12 15:51:41', '2021-08-12 15:51:41'),
(670, 'Mummy', 'John', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 08:04:27', '2021-08-21 08:04:27'),
(671, 'Kaosara', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 10:15:09', '2021-08-21 10:15:09'),
(672, 'Mummy', 'Ola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 10:53:22', '2021-08-21 10:53:22'),
(673, 'Iya', 'Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 10:55:46', '2021-08-21 10:55:46'),
(674, 'Mummy', 'Fatimoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 11:08:14', '2021-08-21 11:08:14'),
(675, 'Praise', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 11:18:13', '2021-08-21 11:18:13'),
(676, 'Mama', 'K', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 12:20:59', '2021-08-21 12:20:59'),
(677, 'Baba', 'Raheemat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 12:37:42', '2021-08-21 12:37:42'),
(678, 'Miracle', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 12:42:31', '2021-08-21 12:42:31'),
(679, 'Mummy', 'Abdulganiyu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:09:36', '2021-08-21 13:09:36'),
(680, 'Sao', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:14:41', '2021-08-21 13:14:41'),
(681, 'Sunday', 'Balogun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:35:04', '2021-08-21 13:35:04'),
(682, 'Mummy', 'Titilayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:39:02', '2021-08-21 13:39:02'),
(683, 'Alhaja', 'Iya Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:43:56', '2021-08-21 13:43:56'),
(684, 'Mrs', 'Salami', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 13:54:56', '2021-08-21 13:54:56'),
(685, 'Yusuf', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 14:11:02', '2021-08-21 14:11:02'),
(686, 'Mrs', 'Ajibola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 14:48:39', '2021-08-21 14:48:39'),
(687, 'Iya', 'Ogele', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 14:50:19', '2021-08-21 14:50:19'),
(688, 'Mummy', 'Mayowa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 15:04:33', '2021-08-21 15:04:33'),
(689, 'Alhaja', 'Iya Suleiman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 15:57:55', '2021-08-21 15:57:55'),
(690, 'Ugoeze', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 16:03:54', '2021-08-21 16:03:54'),
(691, 'Okin', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-21 16:25:40', '2021-08-21 16:25:40'),
(692, 'Alhaja', 'Aminatu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 08:29:16', '2021-08-23 08:29:16'),
(693, 'Alhaja', 'Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 08:40:08', '2021-08-23 08:40:08'),
(694, 'Oluwakemi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 08:42:10', '2021-08-23 08:42:10'),
(695, 'Alhaja', 'Omo-Olupo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 08:53:13', '2021-08-23 08:53:13'),
(696, 'Mummy', 'Opeyemi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:05:49', '2021-08-23 09:05:49'),
(697, 'Mummy', 'Abubakar', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:07:05', '2021-08-23 09:07:05'),
(698, 'Emirate', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:10:07', '2021-08-23 09:10:07'),
(699, 'Alhaja', 'Iya Laide', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:11:07', '2021-08-23 09:11:07'),
(700, 'Alhaja', 'Iya Ganiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:13:12', '2021-08-23 09:13:12');
INSERT INTO `tbl_customers` (`SN`, `firstname`, `lastname`, `email`, `phone`, `address`, `credit_limit`, `weeks`, `expired_date`, `date`, `city`, `additional_info`, `branch_id`, `updated`, `created`) VALUES
(701, 'Alhaja', 'Adeshina', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:41:16', '2021-08-23 09:41:16'),
(702, 'Ayisat', 'Habeeb', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:43:08', '2021-08-23 09:43:08'),
(703, 'Ghaz', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 09:43:52', '2021-08-23 09:43:52'),
(704, 'Mummy', 'Isaac', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:09:06', '2021-08-23 10:09:06'),
(705, 'Federal', 'College', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:12:38', '2021-08-23 10:12:38'),
(706, 'Alhaji', 'Tiamiyu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:14:16', '2021-08-23 10:14:16'),
(707, 'Hand of', 'God', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:15:57', '2021-08-23 10:15:57'),
(708, 'Ibrahim', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:16:41', '2021-08-23 10:16:41'),
(709, 'Ola', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:18:27', '2021-08-23 10:18:27'),
(710, 'Sodiq', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:37:00', '2021-08-23 10:37:00'),
(711, 'Mrs', 'Tijani', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:40:03', '2021-08-23 10:40:03'),
(712, 'Alhaja', 'Jabata', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:43:37', '2021-08-23 10:43:37'),
(713, 'Dodo', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 10:50:31', '2021-08-23 10:50:31'),
(714, 'Mummy', 'Ajewole', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 11:14:47', '2021-08-23 11:14:47'),
(715, 'Iya', 'Sunday', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 12:19:19', '2021-08-23 12:19:19'),
(716, 'Alhaja', 'Isale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 12:34:55', '2021-08-23 12:34:55'),
(717, 'Iya', 'Nafisat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 12:40:47', '2021-08-23 12:40:47'),
(718, 'Mr', 'Samuel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 13:06:31', '2021-08-23 13:06:31'),
(719, 'Mummy', 'Abdullahi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 13:18:46', '2021-08-23 13:18:46'),
(720, 'Alhaji', 'Usman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 13:42:44', '2021-08-23 13:42:44'),
(721, 'Idayat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 14:02:22', '2021-08-23 14:02:22'),
(722, 'Iya', 'Sugar', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 14:05:10', '2021-08-23 14:05:10'),
(723, 'Iya', 'Taiwo Isale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 14:17:09', '2021-08-23 14:17:09'),
(724, 'Iya', 'Ogbomoso', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 15:14:48', '2021-08-23 15:14:48'),
(725, 'Alhaja', 'Adabata', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 15:39:18', '2021-08-23 15:39:18'),
(726, 'Alhaja', 'Gaa-Akanbi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 15:49:23', '2021-08-23 15:49:23'),
(727, 'Engineer', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-23 16:42:03', '2021-08-23 16:42:03'),
(728, 'Abdullateef', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-11 18:14:18', '2021-08-11 18:14:18'),
(729, 'Uncle', 'Bacita', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-11 18:23:37', '2021-08-11 18:23:37'),
(730, 'Mummy', 'Abdulraman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-11 18:24:24', '2021-08-11 18:24:24'),
(731, 'Mr', 'Bolaji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-11 18:29:40', '2021-08-11 18:29:40'),
(732, 'Aunty', 'Wumi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 10:18:33', '2021-08-24 10:18:33'),
(733, 'Alhaja', 'Laide', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 10:29:17', '2021-08-24 10:29:17'),
(734, 'Iya', 'Femi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 10:39:01', '2021-08-24 10:39:01'),
(735, 'Alhaja', 'Iya Damola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 11:18:54', '2021-08-24 11:18:54'),
(736, 'Inioluwa', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-10 12:05:54', '2021-08-10 12:05:54'),
(737, 'Alhaji', 'Aluku', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 13:43:12', '2021-08-24 13:43:12'),
(738, 'Mummy', 'Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 13:45:04', '2021-08-24 13:45:04'),
(739, 'Mummy', 'Tola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 14:29:31', '2021-08-24 14:29:31'),
(740, 'Mr', 'Usman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 14:39:12', '2021-08-24 14:39:12'),
(741, 'Iyawo', 'Bro Saheed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 15:05:15', '2021-08-24 15:05:15'),
(742, 'Mr', 'Sokoge', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 15:10:06', '2021-08-24 15:10:06'),
(743, 'Abdullahi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 15:51:58', '2021-08-24 15:51:58'),
(744, 'Mummy', 'Omis', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 15:54:09', '2021-08-24 15:54:09'),
(745, 'Mummy', 'Rukayat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-24 16:36:27', '2021-08-24 16:36:27'),
(746, 'A. K.', 'Bakery', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-10 17:54:14', '2021-08-10 17:54:14'),
(747, 'Mummy', 'Hannah', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-10 18:04:06', '2021-08-10 18:04:06'),
(748, 'Mummy', 'Lafiagi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-10 18:07:52', '2021-08-10 18:07:52'),
(749, 'Ekitii', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 09:25:29', '2021-08-25 09:25:29'),
(750, 'Mummy', 'Farida', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 09:56:51', '2021-08-25 09:56:51'),
(751, 'Mummy', 'Agboola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 11:14:13', '2021-08-25 11:14:13'),
(752, 'Mummy', 'Lanre', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 14:48:33', '2021-08-25 14:48:33'),
(753, 'Mr', 'Ola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 14:49:32', '2021-08-25 14:49:32'),
(754, 'Tanu', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 15:41:18', '2021-08-09 15:41:18'),
(755, 'Royals', 'Delight', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 15:42:12', '2021-08-09 15:42:12'),
(756, 'Wabilat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 15:00:28', '2021-08-09 15:00:28'),
(757, 'Mrs', 'Adebayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 15:03:07', '2021-08-25 15:03:07'),
(758, 'Iya', 'Tayo Offa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 15:23:22', '2021-08-25 15:23:22'),
(759, 'Alhaja', 'Otte 2', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 18:07:44', '2021-08-25 18:07:44'),
(760, 'Damola', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-25 18:30:22', '2021-08-25 18:30:22'),
(761, 'Ismaila', 'Shonga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 11:17:50', '2021-08-09 11:17:50'),
(762, 'Iya', 'Tapa Shonga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 11:23:36', '2021-08-09 11:23:36'),
(763, 'T.', 'Ayoka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-09 11:32:24', '2021-08-09 11:32:24'),
(764, 'Alhaja', 'Iya Pusi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 10:01:43', '2021-08-26 10:01:43'),
(765, 'Alhaja', 'Iya Ibeji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 10:12:19', '2021-08-26 10:12:19'),
(766, 'Olawoyin', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 10:53:39', '2021-08-26 10:53:39'),
(767, 'Mummy', 'David', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 10:54:40', '2021-08-26 10:54:40'),
(768, 'Mummy', 'Awal', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 10:57:01', '2021-08-26 10:57:01'),
(769, 'Alhaja', 'Biola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 11:03:50', '2021-08-26 11:03:50'),
(770, 'Iyawo', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 11:12:09', '2021-08-26 11:12:09'),
(771, 'Iyawo', 'Alfa Omu-Aran', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 12:33:22', '2021-08-26 12:33:22'),
(772, 'Mrs', 'Salako', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 13:09:40', '2021-08-26 13:09:40'),
(773, 'Damilola', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 13:13:07', '2021-08-26 13:13:07'),
(774, 'Iya', 'Kewu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 13:33:36', '2021-08-26 13:33:36'),
(775, 'Mummy', 'Suleiman', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 13:41:26', '2021-08-26 13:41:26'),
(776, 'Mummy', 'Balikis', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 14:25:00', '2021-08-26 14:25:00'),
(777, 'Mr', 'Kazeem', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 14:29:29', '2021-08-26 14:29:29'),
(778, 'God\'s', 'Will', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 14:47:11', '2021-08-26 14:47:11'),
(779, 'Mummy', 'Habeeb', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-26 18:38:01', '2021-08-26 18:38:01'),
(780, 'Iya', 'Ikimot', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-27 10:50:21', '2021-08-27 10:50:21'),
(781, 'Iya', 'Mubarak', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-27 11:00:26', '2021-08-27 11:00:26'),
(782, 'Mummy Michael', 'Oye-Ekiti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-27 11:10:59', '2021-08-27 11:10:59'),
(783, 'Ramat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-27 11:28:28', '2021-08-27 11:28:28'),
(784, 'Fortunate', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-27 18:11:03', '2021-08-27 18:11:03'),
(785, 'Mr', 'Wadi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 10:18:04', '2021-08-28 10:18:04'),
(786, 'Mummy', 'Muktar', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 11:10:32', '2021-08-28 11:10:32'),
(787, 'Umaru', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 12:44:37', '2021-08-28 12:44:37'),
(788, 'Mummy', 'Adedamola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 12:58:20', '2021-08-28 12:58:20'),
(789, 'Fortunate', 'Food', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 15:24:58', '2021-08-28 15:24:58'),
(790, 'Ayisat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 15:25:53', '2021-08-28 15:25:53'),
(791, 'Eleburuke', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-28 18:46:54', '2021-08-28 18:46:54'),
(792, 'Alhaja', 'Ajibola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 09:43:00', '2021-08-30 09:43:00'),
(793, 'Mummy', 'Quiyum', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 11:21:25', '2021-08-30 11:21:25'),
(794, 'Mummy', 'Sobi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 11:34:01', '2021-08-30 11:34:01'),
(795, 'Mummy', 'Tolu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 11:34:55', '2021-08-30 11:34:55'),
(796, 'Glory of', 'God', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 13:05:26', '2021-08-30 13:05:26'),
(797, 'Iya ', 'Oro', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 13:20:34', '2021-08-30 13:20:34'),
(798, 'Mummy', 'Azeez', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 14:49:53', '2021-08-30 14:49:53'),
(799, 'Alhaja', 'Taiye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 14:57:42', '2021-08-30 14:57:42'),
(800, 'Olawale', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 16:05:00', '2021-08-30 16:05:00'),
(801, 'Henny Fresh', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 17:37:12', '2021-08-30 17:37:12'),
(802, 'Mr', 'Jethro', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-30 17:50:58', '2021-08-30 17:50:58'),
(803, 'Mummy', 'Farouq', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 11:46:05', '2021-08-31 11:46:05'),
(804, 'Alhaja', 'Blessing', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 11:58:34', '2021-08-31 11:58:34'),
(805, 'Mummy', 'Rashidat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 12:02:48', '2021-08-31 12:02:48'),
(806, 'Mrs', 'Shade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 12:08:27', '2021-08-31 12:08:27'),
(807, 'Mummy', 'Gold', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 12:11:52', '2021-08-31 12:11:52'),
(808, 'Adunni', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 12:48:31', '2021-08-31 12:48:31'),
(809, 'Mummy', 'Bola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 14:14:40', '2021-08-31 14:14:40'),
(810, 'Saula', 'Ekiti', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 14:30:29', '2021-08-31 14:30:29'),
(811, 'Mrs', 'Ojo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 15:06:31', '2021-08-31 15:06:31'),
(812, 'Iroyin-Ayo', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 15:10:30', '2021-08-31 15:10:30'),
(813, 'Mrs', 'Kolawole', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 15:11:30', '2021-08-31 15:11:30'),
(814, 'Aduranigba', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 16:33:32', '2021-08-31 16:33:32'),
(815, 'Omo', 'Dudu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 17:02:54', '2021-08-31 17:02:54'),
(816, 'Buari', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 17:04:05', '2021-08-31 17:04:05'),
(817, 'Ti-Top', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 17:05:25', '2021-08-31 17:05:25'),
(818, 'Tunbosun', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-08-31 17:24:44', '2021-08-31 17:24:44'),
(819, 'Mummy', 'Adeleke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 10:23:45', '2021-09-01 10:23:45'),
(820, 'Mr', 'Jimoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 10:37:41', '2021-09-01 10:37:41'),
(821, 'Alhaja', 'Iya Risi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 11:28:17', '2021-09-01 11:28:17'),
(822, 'Opeoluwa', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 11:48:31', '2021-09-01 11:48:31'),
(823, 'Mummy', 'Afsoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 11:51:10', '2021-09-01 11:51:10'),
(824, 'Mr', 'Kayode', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 13:44:50', '2021-09-01 13:44:50'),
(825, 'Mummy', 'Yusuf', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 14:18:02', '2021-09-01 14:18:02'),
(826, 'Mr', 'Favour', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 15:42:30', '2021-09-01 15:42:30'),
(827, 'Re-Bag Flour', '(To Mama Gold)', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-01 16:48:21', '2021-09-01 16:48:21'),
(828, 'Alhaja', 'Iya Sulu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 09:50:17', '2021-09-02 09:50:17'),
(829, 'Mr', 'femi shonibare', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 10:06:47', '2021-09-02 10:06:47'),
(830, 'mayor ', 'praise', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 10:36:24', '2021-09-02 10:36:24'),
(831, 'Aminat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 11:38:47', '2021-09-02 11:38:47'),
(832, 'Lanre', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 12:21:39', '2021-09-02 12:21:39'),
(833, 'Mrs', 'Alonge', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 12:58:41', '2021-09-02 12:58:41'),
(834, 'Mummy', 'Hammad Omu-Aran', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 13:03:52', '2021-09-02 13:03:52'),
(835, 'Sharon', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 13:39:36', '2021-09-02 13:39:36'),
(836, 'Brother', 'Jesilu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-02 13:45:08', '2021-09-02 13:45:08'),
(837, 'Ijebu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-03 09:39:05', '2021-09-03 09:39:05'),
(838, 'Alhaji', 'S. Jagun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-03 11:10:40', '2021-09-03 11:10:40'),
(839, 'Mummy', 'Gani', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-03 11:38:21', '2021-09-03 11:38:21'),
(840, 'Omo Jesu', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-03 14:08:04', '2021-09-03 14:08:04'),
(841, 'Iya Awa', 'Saraji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-03 15:55:54', '2021-09-03 15:55:54'),
(842, 'Mrs', 'Akin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 10:31:24', '2021-09-04 10:31:24'),
(843, 'Divine', 'Love', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 11:14:27', '2021-09-04 11:14:27'),
(844, 'Marylat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 11:36:58', '2021-09-04 11:36:58'),
(845, 'Moronike', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 12:02:54', '2021-09-04 12:02:54'),
(846, 'Mummy', 'Labake', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 12:22:44', '2021-09-04 12:22:44'),
(847, 'Mummy', 'Abigail', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 12:23:43', '2021-09-04 12:23:43'),
(848, 'Mummy', 'Roimat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 12:25:33', '2021-09-04 12:25:33'),
(849, 'Mummy', 'Abdulramo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 13:08:45', '2021-09-04 13:08:45'),
(850, 'Joy', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 13:46:48', '2021-09-04 13:46:48'),
(851, 'Mummy', 'Mujid', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 13:50:37', '2021-09-04 13:50:37'),
(852, 'Mummy', 'Godwin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 14:13:48', '2021-09-04 14:13:48'),
(853, 'Destiny', 'Bakery', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 14:44:20', '2021-09-04 14:44:20'),
(854, 'Obalopeye', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 15:09:12', '2021-09-04 15:09:12'),
(855, 'Bread', 'Plus', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 15:41:33', '2021-09-04 15:41:33'),
(856, 'Olajide', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 16:31:10', '2021-09-04 16:31:10'),
(857, 'Adeduro', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-04 16:56:15', '2021-09-04 16:56:15'),
(858, 'Charity', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 10:01:48', '2021-09-06 10:01:48'),
(859, 'Mummy', 'Bisola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 11:27:33', '2021-09-06 11:27:33'),
(860, 'Alhaji', 'Sanusi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 11:37:52', '2021-09-06 11:37:52'),
(861, 'Alhaja', 'Kanike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 12:13:08', '2021-09-06 12:13:08'),
(862, 'Mummy', 'Mariam', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 12:33:53', '2021-09-06 12:33:53'),
(863, 'Mutia', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 12:42:11', '2021-09-06 12:42:11'),
(864, 'His', 'Mercy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 14:04:16', '2021-09-06 14:04:16'),
(865, 'Mummy', 'Ibrahim', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 14:08:04', '2021-09-06 14:08:04'),
(866, 'Mummy', 'Iya Farida', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 14:40:42', '2021-09-06 14:40:42'),
(867, 'Mummy', 'Ganiyu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 14:49:17', '2021-09-06 14:49:17'),
(868, 'David', 'Mary', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 15:12:40', '2021-09-06 15:12:40'),
(869, 'Mummy', 'Ramat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 15:29:52', '2021-09-06 15:29:52'),
(870, 'Adamu', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 16:23:59', '2021-09-06 16:23:59'),
(871, 'Iya', 'Ewatomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-06 17:41:45', '2021-09-06 17:41:45'),
(872, 'Brother', 'Dayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 11:47:08', '2021-09-07 11:47:08'),
(873, 'Kwara', 'Chemical', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 11:58:26', '2021-09-07 11:58:26'),
(874, 'Mummy', 'Abibat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 12:10:45', '2021-09-07 12:10:45'),
(875, 'Mummy', 'Juwon', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 12:13:47', '2021-09-07 12:13:47'),
(876, 'Alhaji', 'Eleburuke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 12:43:44', '2021-09-07 12:43:44'),
(877, 'Mummy', 'Tiwa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 12:44:17', '2021-09-07 12:44:17'),
(878, 'Alhaji', 'Bello', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 12:47:22', '2021-09-07 12:47:22'),
(879, 'Ajiboro', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 13:37:48', '2021-09-07 13:37:48'),
(880, 'Funwasi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 14:28:38', '2021-09-07 14:28:38'),
(881, 'Mummy', 'Abdulsalam', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 14:34:56', '2021-09-07 14:34:56'),
(882, 'Tiptop', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 14:55:21', '2021-09-07 14:55:21'),
(883, 'Mummy', 'Adisa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 15:10:13', '2021-09-07 15:10:13'),
(884, 'Shola', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 15:37:04', '2021-09-07 15:37:04'),
(885, 'Alhaja', 'Ipata', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 15:53:47', '2021-09-07 15:53:47'),
(886, 'Alhaja', 'Mustapha', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 15:55:34', '2021-09-07 15:55:34'),
(887, 'Mummy', 'Olayinka', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 16:03:21', '2021-09-07 16:03:21'),
(888, 'Alfa', 'Inu Oja', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 16:21:02', '2021-09-07 16:21:02'),
(889, 'Mummy', 'Shehu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 16:21:58', '2021-09-07 16:21:58'),
(890, 'Daddy', 'Isaac', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-07 16:26:36', '2021-09-07 16:26:36'),
(891, 'Ejiwumi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 09:29:50', '2021-09-08 09:29:50'),
(892, 'Martha', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 12:04:24', '2021-09-08 12:04:24'),
(893, 'Adeola', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 12:36:51', '2021-09-08 12:36:51'),
(894, 'Mummy', 'Blessing', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 13:04:34', '2021-09-08 13:04:34'),
(895, 'Temilade', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 14:13:32', '2021-09-08 14:13:32'),
(896, 'Mummy', 'Iya Ibeji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 16:26:15', '2021-09-08 16:26:15'),
(897, 'Iya', 'Fati', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-08 17:50:04', '2021-09-08 17:50:04'),
(898, 'Mummy', 'Lekan Oja-Oba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-09 12:16:53', '2021-09-09 12:16:53'),
(899, 'Mummy', 'Abdulkadir', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-09 12:54:36', '2021-09-09 12:54:36'),
(900, 'Mummy', 'ademola amoyo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-09 16:27:30', '2021-09-09 16:27:30'),
(901, 'Alhaji', 'Olorunjuedalo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-09 16:54:58', '2021-09-09 16:54:58'),
(902, 'Mr', 'Samuel golden penny', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-09 17:47:00', '2021-09-09 17:47:00'),
(903, 'Mrs', 'Hammed', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-10 10:31:25', '2021-09-10 10:31:25'),
(904, 'Ina ', 'Tappa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-10 11:07:50', '2021-09-10 11:07:50'),
(905, 'Mr', 'Idowu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-10 11:43:09', '2021-09-10 11:43:09'),
(906, 'Latifat', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-10 15:30:24', '2021-09-10 15:30:24'),
(907, 'ADEOYE', 'ROIMAT', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 09:57:37', '2021-09-11 09:57:37'),
(908, 'Mummy', 'Iremide', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 11:44:32', '2021-09-11 11:44:32'),
(909, 'Umaru', 'Ladei', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 12:29:43', '2021-09-11 12:29:43'),
(910, 'Alhaja', 'Sekinat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 12:53:27', '2021-09-11 12:53:27'),
(911, 'Daddy', 'Mercy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 13:20:29', '2021-09-11 13:20:29'),
(912, 'I. D.', 'Indomie', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 13:28:11', '2021-09-11 13:28:11'),
(913, 'Adam', 'Shonga', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 14:50:06', '2021-09-11 14:50:06'),
(914, 'Oguntoye', 'Omolewa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-11 15:31:47', '2021-09-11 15:31:47'),
(915, 'Mummy', 'exel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-13 10:16:36', '2021-09-13 10:16:36'),
(916, 'Baba', 'Seun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-13 10:39:17', '2021-09-13 10:39:17'),
(917, 'AROMA', 'PLACE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-13 11:01:18', '2021-09-13 11:01:18'),
(918, 'mummy', 'bayowa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 09:58:35', '2021-09-14 09:58:35'),
(919, 'MUMMY ', 'AMAMA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 11:15:18', '2021-09-14 11:15:18'),
(920, 'MRS', 'APALARA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 12:09:39', '2021-09-14 12:09:39'),
(921, 'MUMMY ', '`AKANKE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 12:34:05', '2021-09-14 12:34:05'),
(922, 'OLUWATOYIN', 'OLU', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 14:06:09', '2021-09-14 14:06:09'),
(923, 'MUMMY ', 'OMOTOSHO', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 14:39:04', '2021-09-14 14:39:04'),
(924, 'ALHAJA', 'OTE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 15:02:30', '2021-09-14 15:02:30'),
(925, 'MUMMY', 'AYO', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 15:49:07', '2021-09-14 15:49:07'),
(926, 'MUMMY ', 'ABIBU', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-14 17:06:28', '2021-09-14 17:06:28'),
(927, 'SMC', 'Gaa-Akanbi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 10:04:56', '2021-09-15 10:04:56'),
(928, 'MUMMY  ', 'Awa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 11:02:15', '2021-09-15 11:02:15'),
(929, 'OWOWAMI', 'O', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 11:03:27', '2021-09-15 11:03:27'),
(930, 'BROTHER', 'BOLA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 11:17:14', '2021-09-15 11:17:14'),
(931, 'mummy', 'racheal', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 13:24:19', '2021-09-15 13:24:19'),
(932, 'Mummy', 'precious', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 14:46:31', '2021-09-15 14:46:31'),
(933, 'Mr', 'isaal', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-15 15:42:14', '2021-09-15 15:42:14'),
(934, 'Aunty', 'Zainab', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-16 10:09:40', '2021-09-16 10:09:40'),
(935, 'cidees', 'mrs', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-16 13:47:51', '2021-09-16 13:47:51'),
(936, 'MERCY', 'OF GOD', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-16 17:14:58', '2021-09-16 17:14:58'),
(937, 'Mr', 'uncle', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 11:15:54', '2021-09-17 11:15:54'),
(938, 'MUMMY ', 'AYO EKITI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 11:43:51', '2021-09-17 11:43:51'),
(939, 'MRS ', 'AYOMI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 11:47:55', '2021-09-17 11:47:55'),
(940, 'Mummy', 'ABDULGAFAR', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 12:51:23', '2021-09-17 12:51:23'),
(941, 'Mummy', 'abdul omun-aran', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 15:40:45', '2021-09-17 15:40:45'),
(942, 'coco', 'phile', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 15:47:06', '2021-09-17 15:47:06'),
(943, 'MUMMY ', 'KUDIYA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-17 17:02:51', '2021-09-17 17:02:51'),
(944, 'MUMMY ', 'TITI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 10:11:15', '2021-09-18 10:11:15'),
(945, 'OLUWA', 'BUNMI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 11:14:29', '2021-09-18 11:14:29'),
(946, 'Oguntola ', 'oluwaseun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 11:16:35', '2021-09-18 11:16:35'),
(947, 'Mariam', 'miss', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 11:51:44', '2021-09-18 11:51:44'),
(948, 'omo', 'olupo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 11:56:01', '2021-09-18 11:56:01'),
(949, 'Bamise', 'bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 12:13:11', '2021-09-18 12:13:11'),
(950, 'MUMMY ', 'RUTH', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 13:34:46', '2021-09-18 13:34:46'),
(951, 'IYA HABIBU ', 'OJATUNTUN', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 13:41:42', '2021-09-18 13:41:42'),
(952, 'alfa ', 'jamiu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 14:20:07', '2021-09-18 14:20:07'),
(953, 'alfa', 'inuoja', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 14:21:53', '2021-09-18 14:21:53'),
(954, 'MUMMY ', 'Daniel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 14:52:20', '2021-09-18 14:52:20'),
(955, 'Alhaji ', 'garba', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 15:20:33', '2021-09-18 15:20:33'),
(956, 'alhaja', 'iya ajoke', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-18 17:21:12', '2021-09-18 17:21:12'),
(957, 'Alhaja ', 'okeandi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 10:26:00', '2021-09-20 10:26:00'),
(958, 'IYA', 'RILIWAN', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 11:23:53', '2021-09-20 11:23:53'),
(959, 'MUMMY ', 'mana', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 11:29:55', '2021-09-20 11:29:55'),
(960, 'MUMMY ', 'Amadi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:03:10', '2021-09-20 12:03:10'),
(961, 'Mummy', 'shola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:19:23', '2021-09-20 12:19:23'),
(962, 'Mr', 'Adewale', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:22:06', '2021-09-20 12:22:06'),
(963, 'Mummy', 'Habibu okeonigbin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:27:03', '2021-09-20 12:27:03'),
(964, 'Mummy', 'Lanre', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:31:57', '2021-09-20 12:31:57'),
(965, 'Al', 'Mustapha', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:48:12', '2021-09-20 12:48:12'),
(966, 'Mr', 'Ismail', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:52:44', '2021-09-20 12:52:44'),
(967, 'Mummy', 'Testimony', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 12:58:32', '2021-09-20 12:58:32'),
(968, 'Mrs', 'BALA', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 13:12:29', '2021-09-20 13:12:29'),
(969, 'iya', 'confection', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 13:17:58', '2021-09-20 13:17:58'),
(970, 'miss', 'stella', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 13:37:31', '2021-09-20 13:37:31'),
(971, 'Baba', 'oyo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 13:43:58', '2021-09-20 13:43:58'),
(972, 'Bola', 'Butter', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 14:22:10', '2021-09-20 14:22:10'),
(973, 'Mummy', 'Falilat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 14:42:17', '2021-09-20 14:42:17'),
(974, 'oyeniyi', 'anifat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 15:10:37', '2021-09-20 15:10:37'),
(975, 'Alhaja ', 'iya Adam', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 15:12:21', '2021-09-20 15:12:21'),
(976, 'Aminu', 'Oloru', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 15:19:11', '2021-09-20 15:19:11'),
(977, 'F.M', 'Bacita', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-20 16:57:16', '2021-09-20 16:57:16'),
(978, 'HERITA', 'GE', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 10:18:58', '2021-09-21 10:18:58'),
(979, 'Motun', 'rayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 10:20:28', '2021-09-21 10:20:28'),
(980, 'Mummy', 'Bright', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 10:46:49', '2021-09-21 10:46:49'),
(981, 'Mummy', 'boyi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 11:14:54', '2021-09-21 11:14:54'),
(982, 'Mummy', 'salamat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 11:16:16', '2021-09-21 11:16:16'),
(983, 'Mummy', 'TAIWO', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 11:32:29', '2021-09-21 11:32:29'),
(984, 'oniseoluwa', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 11:41:33', '2021-09-21 11:41:33'),
(985, 'Baba ', 'Ramoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-21 13:22:37', '2021-09-21 13:22:37'),
(986, 'Mummy', 'faith', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 08:44:44', '2021-09-22 08:44:44'),
(987, 'Mummy', 'Asisat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 08:47:39', '2021-09-22 08:47:39'),
(988, 'Mummy', 'Islamiat', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 09:31:39', '2021-09-22 09:31:39'),
(989, 'Empire', 'store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 10:37:32', '2021-09-22 10:37:32'),
(990, 'Baba ibeji', 'eiyenkorin', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 11:49:21', '2021-09-22 11:49:21'),
(991, 'Iya ', 'marry', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 11:50:52', '2021-09-22 11:50:52'),
(992, 'IYA ', 'LUKU', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 12:06:45', '2021-09-22 12:06:45'),
(993, 'Big ', 'Mummy', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 12:23:28', '2021-09-22 12:23:28'),
(994, 'Mr', 'Olanrewaju', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 12:48:58', '2021-09-22 12:48:58'),
(995, 'miss', 'chidinma', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 13:00:29', '2021-09-22 13:00:29'),
(996, 'Danjuma', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 13:03:51', '2021-09-22 13:03:51'),
(997, 'Mummy', 'Shehu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 14:04:35', '2021-09-22 14:04:35'),
(998, 'A', '-Z', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 15:55:33', '2021-09-22 15:55:33'),
(999, 'A', '-Z', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 15:56:55', '2021-09-22 15:56:55'),
(1000, 'ola', 'Fatia', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-22 16:36:12', '2021-09-22 16:36:12'),
(1001, 'Ibukunoluwa', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 09:42:28', '2021-09-23 09:42:28'),
(1002, 'Mummy', 'promise', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 09:44:38', '2021-09-23 09:44:38'),
(1003, 'Dad', 'Samuel', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 11:06:37', '2021-09-23 11:06:37'),
(1004, 'cake', 'palace', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 12:11:30', '2021-09-23 12:11:30'),
(1005, 'omega', 'Store', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 12:40:51', '2021-09-23 12:40:51'),
(1006, 'Arioowo', 'saye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 12:53:42', '2021-09-23 12:53:42'),
(1007, 'Mummy', 'Odunola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-23 16:51:04', '2021-09-23 16:51:04'),
(1008, 'Mummy', 'Rokib', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-24 13:08:50', '2021-09-24 13:08:50'),
(1009, 'Mr', 'Ola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-24 13:55:08', '2021-09-24 13:55:08'),
(1010, 'Mrs', 'adekeye', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-24 14:51:38', '2021-09-24 14:51:38'),
(1011, 'Iya', 'alfa', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-24 15:59:33', '2021-09-24 15:59:33'),
(1012, 'Mr', 'WAIDI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 12:40:47', '2021-09-25 12:40:47'),
(1013, 'Mummy', 'Alikimoh', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 14:15:56', '2021-09-25 14:15:56'),
(1014, 'Alhaja', 'REAL', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 15:57:02', '2021-09-25 15:57:02'),
(1015, 'Mummy', 'THANKGOD', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 15:58:30', '2021-09-25 15:58:30'),
(1016, 'Mummy', 'ABDULBAKI', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 16:01:12', '2021-09-25 16:01:12'),
(1017, 'Alhaja', 'BODE SAADU', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 16:07:37', '2021-09-25 16:07:37'),
(1018, 'Ola', 'Bola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-25 17:11:03', '2021-09-25 17:11:03'),
(1019, 'Alhaja', 'omu iyadun', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-27 10:51:51', '2021-09-27 10:51:51'),
(1020, 'Iya', 'Ajobi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-27 16:01:52', '2021-09-27 16:01:52'),
(1021, 'Ade', 'tona', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-27 16:27:58', '2021-09-27 16:27:58'),
(1022, 'Mummy', 'Teslim', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-28 11:56:09', '2021-09-28 11:56:09'),
(1023, 'miss', 'olaside', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-28 12:10:15', '2021-09-28 12:10:15'),
(1024, 'Mr', 'chibike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-28 14:55:28', '2021-09-28 14:55:28'),
(1025, 'Aunty', 'Tomi', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-28 17:06:03', '2021-09-28 17:06:03'),
(1026, 'Mrs', 'Adefalu', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 09:11:29', '2021-09-29 09:11:29'),
(1027, 'Mrs', 'Aderinola', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 10:36:59', '2021-09-29 10:36:59'),
(1028, 'Iya', 'Mike', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 11:10:31', '2021-09-29 11:10:31'),
(1029, 'Iya', 'Ayo', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 11:47:57', '2021-09-29 11:47:57'),
(1030, 'Mummy', 'MUSOLIU', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 12:35:25', '2021-09-29 12:35:25'),
(1031, 'omowumi', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-29 13:36:21', '2021-09-29 13:36:21'),
(1032, 'Mummy', 'Ayoade', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 11:27:13', '2021-09-30 11:27:13'),
(1033, 'Baba', 'Olori', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 11:51:13', '2021-09-30 11:51:13'),
(1034, 'Promise', 'Bread', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 12:50:28', '2021-09-30 12:50:28'),
(1035, 'Smart', 'K', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 13:34:36', '2021-09-30 13:34:36'),
(1036, 'Iya', 'Alhaji', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 14:52:13', '2021-09-30 14:52:13'),
(1037, 'Aina', '.', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-09-30 15:00:46', '2021-09-30 15:00:46'),
(1038, 'Alhaja', 'olugbon', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-10-01 11:06:12', '2021-10-01 11:06:12'),
(1039, 'Mrs', 'oni', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-10-01 12:50:22', '2021-10-01 12:50:22'),
(1040, 'Mummy', 'chioma', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-10-01 13:16:14', '2021-10-01 13:16:14'),
(1041, 'Alhaja', 'Ojagboro', '', '08173331279', '', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2021-10-01 15:10:17', '2021-10-01 15:10:17'),
(1042, 'emmanuel', 'dosu', '', '+2348124884650', 'lagos', '0.00', 0, '0000-00-00', '0000-00-00', '', '', 0, '2023-04-29 19:09:36', '2023-04-29 19:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `SN` bigint(11) NOT NULL,
  `expense_date` date NOT NULL,
  `month` varchar(15) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department` varchar(120) NOT NULL,
  `expense_total_amount` decimal(10,0) NOT NULL,
  `expense_purpose` text NOT NULL,
  `expense_purpose_title` tinytext NOT NULL,
  `branch_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_history`
--

CREATE TABLE `tbl_invoice_history` (
  `SN` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `last_modeified_user` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `customer` int(11) NOT NULL,
  `invoice_item` mediumtext NOT NULL,
  `reservation_invoice_link` varchar(100) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_serial` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `scharge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `SN` int(11) NOT NULL,
  `sales_id` varchar(50) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `pos_stan` varchar(100) DEFAULT NULL,
  `customer` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `department` varchar(100) NOT NULL,
  `payment_date` date NOT NULL,
  `user` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`SN`, `sales_id`, `payment_method_id`, `pos_stan`, `customer`, `amount`, `department`, `payment_date`, `user`, `modified`, `created`) VALUES
(0, '28', 2, NULL, 0, '2060', 'FAITH', '2023-04-29', 1, '2023-04-29 18:27:25', '2023-04-29 18:27:25'),
(0, '29', 2, NULL, 0, '2060', 'FAITH', '2023-04-29', 37, '2023-04-29 18:28:45', '2023-04-29 18:28:45'),
(0, '30', 1, NULL, 0, '2060', 'FAITH', '2023-04-29', 1, '2023-04-29 18:35:09', '2023-04-29 18:35:09'),
(0, '31', 2, NULL, 0, '2060', 'FAITH', '2023-04-29', 37, '2023-04-29 19:07:42', '2023-04-29 19:07:42'),
(0, '32', 1, NULL, 0, '2060000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:23:30', '2023-07-12 10:23:30'),
(0, '33', 2, NULL, 0, '2060000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:25:28', '2023-07-12 10:25:28'),
(0, '34', 1, NULL, 0, '500000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:28:13', '2023-07-12 10:28:13'),
(0, '34', 2, NULL, 0, '400000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:28:13', '2023-07-12 10:28:13'),
(0, '34', 4, NULL, 0, '130000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:28:13', '2023-07-12 10:28:13'),
(0, '35', 4, NULL, 0, '2060', 'FAITH', '2023-07-12', 1, '2023-07-12 10:31:48', '2023-07-12 10:31:48'),
(0, '36', 1, NULL, 0, '10000', 'FAITH', '2023-07-12', 1, '2023-07-12 10:33:40', '2023-07-12 10:33:40'),
(0, '36', 2, NULL, 0, '10600', 'FAITH', '2023-07-12', 1, '2023-07-12 10:33:40', '2023-07-12 10:33:40'),
(0, '37', 1, NULL, 0, '2060', 'store', '2023-07-27', 1, '2023-07-27 01:45:50', '2023-07-27 01:45:50'),
(0, '38', 2, NULL, 0, '2900', 'store', '2023-07-27', 1, '2023-07-27 01:46:14', '2023-07-27 01:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_payrole`
--

CREATE TABLE `tbl_payment_payrole` (
  `SN` int(11) NOT NULL,
  `payment_id` varchar(60) NOT NULL,
  `month` varchar(15) NOT NULL,
  `month_number` varchar(15) NOT NULL,
  `year` varchar(15) NOT NULL,
  `total_pay` varchar(30) NOT NULL,
  `total_staff` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pay_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_payrole_history`
--

CREATE TABLE `tbl_payment_payrole_history` (
  `SN` int(11) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `month` varchar(10) NOT NULL,
  `month_no` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `addition` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `loan_deduction` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_recieved`
--

CREATE TABLE `tbl_transfer_recieved` (
  `SN` bigint(20) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `amt_in` bigint(20) NOT NULL,
  `amt_out` bigint(20) NOT NULL,
  `sold` bigint(20) NOT NULL,
  `date_` date NOT NULL,
  `balance` varchar(100) NOT NULL,
  `user` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transfer_recieved`
--

INSERT INTO `tbl_transfer_recieved` (`SN`, `tracking_id`, `stock_id`, `amt_in`, `amt_out`, `sold`, `date_`, `balance`, `user`, `comment`, `created`, `updated`) VALUES
(1, 'HS1673448177', 27, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 14:42:57', '2023-01-11 15:42:57'),
(2, 'HS1673448177', 64, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 14:42:57', '2023-01-11 15:42:57'),
(3, 'HS1673448177', 39, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 14:42:57', '2023-01-11 15:42:57'),
(4, 'VV1673448263', 65, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 14:44:23', '2023-01-11 15:44:23'),
(5, 'GB1673448553', 51, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 14:49:13', '2023-01-11 15:49:13'),
(6, 'FZ1673448587', 51, 0, 0, 1, '2023-01-11', '1998', 1, '', '2023-01-11 14:49:47', '2023-01-11 15:49:47'),
(7, 'JN1673451021', 51, 0, 0, 1, '2023-01-11', '1997', 1, '', '2023-01-11 15:30:21', '2023-01-11 16:30:21'),
(8, 'VT1673451037', 34, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 15:30:37', '2023-01-11 16:30:37'),
(9, 'YB1673451059', 73, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 15:30:59', '2023-01-11 16:30:59'),
(10, 'MI1673451072', 64, 0, 0, 1, '2023-01-11', '1998', 1, '', '2023-01-11 15:31:12', '2023-01-11 16:31:12'),
(11, 'SF1673451125', 40, 0, 0, 1, '2023-01-11', '1999', 1, '', '2023-01-11 15:32:05', '2023-01-11 16:32:05'),
(12, 'QF1682786246', 1, 2, 0, 0, '2023-04-29', '2', 1, '', '2023-04-29 16:37:26', '2023-04-29 17:37:26'),
(13, 'XX1682786275', 1, 0, 0, 1, '2023-04-29', '1', 37, '', '2023-04-29 16:37:55', '2023-04-29 17:37:55'),
(14, 'PH1682786441', 1, 0, 0, 1, '2023-04-29', '0', 1, '', '2023-04-29 16:40:41', '2023-04-29 17:40:41'),
(15, 'CF1682786747', 1, 5, 0, 0, '2023-04-29', '5', 1, '', '2023-04-29 16:45:47', '2023-04-29 17:45:47'),
(16, 'FC1682786760', 1, 0, 0, 1, '2023-04-29', '4', 1, '', '2023-04-29 16:46:00', '2023-04-29 17:46:00'),
(17, 'DZ1682786858', 1, 0, 0, 1, '2023-04-29', '3', 1, '', '2023-04-29 16:47:38', '2023-04-29 17:47:38'),
(18, 'CJ1682786954', 1, 0, 0, 1, '2023-04-29', '2', 37, '', '2023-04-29 16:49:14', '2023-04-29 17:49:14'),
(19, 'JP1682787546', 1, 0, 0, 1, '2023-04-29', '1', 1, '', '2023-04-29 16:59:06', '2023-04-29 17:59:06'),
(20, 'XI1682787586', 1, 0, 0, 1, '2023-04-29', '0', 1, '', '2023-04-29 16:59:46', '2023-04-29 17:59:46'),
(21, 'LS1682787697', 1, 8, 0, 0, '2023-04-29', '8', 1, '', '2023-04-29 17:01:37', '2023-04-29 18:01:37'),
(22, 'VA1682787708', 1, 0, 0, 1, '2023-04-29', '7', 1, '', '2023-04-29 17:01:48', '2023-04-29 18:01:48'),
(23, 'FK1682787731', 1, 0, 0, 1, '2023-04-29', '6', 1, '', '2023-04-29 17:02:11', '2023-04-29 18:02:11'),
(24, 'KP1682787795', 1, 0, 0, 1, '2023-04-29', '5', 1, '', '2023-04-29 17:03:15', '2023-04-29 18:03:15'),
(25, 'LJ1682788156', 1, 0, 0, 1, '2023-04-29', '4', 1, '', '2023-04-29 17:09:16', '2023-04-29 18:09:16'),
(26, 'XQ1682788272', 1, 0, 0, 1, '2023-04-29', '3', 1, '', '2023-04-29 17:11:12', '2023-04-29 18:11:12'),
(27, 'VO1682788450', 1, 0, 0, 1, '2023-04-29', '2', 37, '', '2023-04-29 17:14:10', '2023-04-29 18:14:10'),
(28, 'ZR1682788508', 1, 0, 0, 1, '2023-04-29', '1', 37, '', '2023-04-29 17:15:08', '2023-04-29 18:15:08'),
(29, 'RB1682788612', 1, 0, 0, 1, '2023-04-29', '0', 37, '', '2023-04-29 17:16:52', '2023-04-29 18:16:52'),
(30, 'WD1682788719', 1, 1000, 0, 0, '2023-04-29', '1000', 1, '', '2023-04-29 17:18:39', '2023-04-29 18:18:39'),
(31, 'YU1682788758', 1, 0, 0, 1, '2023-04-29', '999', 1, '', '2023-04-29 17:19:18', '2023-04-29 18:19:18'),
(32, 'UN1682788957', 1, 0, 0, 1, '2023-04-29', '998', 1, '', '2023-04-29 17:22:37', '2023-04-29 18:22:37'),
(33, 'NW1682789022', 1, 0, 0, 1, '2023-04-29', '997', 1, '', '2023-04-29 17:23:42', '2023-04-29 18:23:42'),
(34, 'UD1682789245', 1, 0, 0, 1, '2023-04-29', '996', 1, '', '2023-04-29 17:27:25', '2023-04-29 18:27:25'),
(35, 'VK1682789325', 1, 0, 0, 1, '2023-04-29', '995', 37, '', '2023-04-29 17:28:45', '2023-04-29 18:28:45'),
(36, 'DO1682789709', 1, 0, 0, 1, '2023-04-29', '994', 1, '', '2023-04-29 17:35:09', '2023-04-29 18:35:09'),
(37, 'BA1682791258', 1, 3500, 0, 0, '2023-04-29', '4494', 1, '', '2023-04-29 18:00:58', '2023-04-29 19:00:58'),
(38, 'ZX1682791293', 1, 10000, 0, 0, '2023-04-29', '14494', 1, '', '2023-04-29 18:01:33', '2023-04-29 19:01:33'),
(39, 'NQ1682791662', 1, 0, 0, 1, '2023-04-29', '14493', 37, '', '2023-04-29 18:07:42', '2023-04-29 19:07:42'),
(40, 'CQ1682791781', 1, 0, 0, 1, '2023-04-29', '14492', 1, '', '2023-04-29 18:09:41', '2023-04-29 19:09:41'),
(41, 'GS1689153436', 1, 300, 0, 0, '2023-07-12', '14792', 1, '', '2023-07-12 09:17:16', '2023-07-12 10:17:16'),
(42, 'XE1689153453', 1, 1000, 0, 0, '2023-07-12', '15792', 1, '', '2023-07-12 09:17:33', '2023-07-12 10:17:33'),
(43, 'UX1689153810', 1, 0, 0, 1000, '2023-07-12', '14792', 1, '', '2023-07-12 09:23:30', '2023-07-12 10:23:30'),
(44, 'HT1689153928', 1, 0, 0, 1000, '2023-07-12', '13792', 1, '', '2023-07-12 09:25:28', '2023-07-12 10:25:28'),
(45, 'BT1689154093', 1, 0, 0, 500, '2023-07-12', '13292', 1, '', '2023-07-12 09:28:13', '2023-07-12 10:28:13'),
(46, 'TA1689154308', 1, 0, 0, 1, '2023-07-12', '13291', 1, '', '2023-07-12 09:31:48', '2023-07-12 10:31:48'),
(47, 'UL1689154420', 1, 0, 0, 10, '2023-07-12', '13281', 1, '', '2023-07-12 09:33:40', '2023-07-12 10:33:40'),
(48, 'OV1689448151', 2, 20, 0, 0, '2023-07-15', '20', 1, '', '2023-07-15 19:09:11', '2023-07-15 20:09:11'),
(49, 'OV1689448151', 2, 0, 2, 0, '2023-07-15', '18', 1, 'De-packed/Convert Product (2)', '2023-07-15 19:10:38', '2023-07-15 20:10:38'),
(50, 'OV1689448151', 2, 20, 0, 0, '2023-07-15', '20', 1, '', '2023-07-15 19:10:38', '2023-07-15 20:10:38'),
(51, 'DD1690418750', 1, 0, 0, 1, '2023-07-27', '13280', 1, '', '2023-07-27 00:45:50', '2023-07-27 01:45:50'),
(52, 'XP1690418774', 2, 0, 0, 1, '2023-07-27', '17', 1, 'Packed/Cartoon Product (1) Sold', '2023-07-27 00:46:14', '2023-07-27 01:46:14'),
(53, '0', 2, 0, 2, 0, '2023-08-02', '15', 39, 'De-packed/Convert Product (2)', '2023-08-02 14:31:29', '2023-08-02 15:31:29'),
(54, '0', 2, 20, 0, 0, '2023-08-02', '40', 39, '', '2023-08-02 14:31:29', '2023-08-02 15:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SN` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(400) COLLATE utf8_bin NOT NULL,
  `bank_account_name` varchar(300) COLLATE utf8_bin NOT NULL,
  `bank_account_no` varchar(60) COLLATE utf8_bin NOT NULL,
  `salary` varchar(300) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `branch_id` int(11) NOT NULL,
  `role` enum('Sales Representative','Administrator','Stock Officer','Superuser','Top Administrator') COLLATE utf8_bin NOT NULL,
  `department` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`SN`, `firstname`, `lastname`, `username`, `bank_name`, `bank_account_name`, `bank_account_no`, `salary`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `branch_id`, `role`, `department`) VALUES
(1, 'Admin', 'Istrator', 'admin', 'Wefwef', 'Wefwef', '1233223', '30000', '$2a$08$lbIhXnh/nZDqv9fqpivNQu4ltct/mKkSWOEsEvgQWIkMlkGx9Fxja', 'admin@admin.com', 1, 0, '', NULL, NULL, '', '', '::1', '2023-08-02 16:47:59', '2018-12-17 09:20:31', '2023-08-02 14:47:59', 0, 'Top Administrator', 'Top Administrator'),
(32, 'Emmanuel', 'Dosu', 'etrendit', '', '', '', '0', '$2a$08$XO.7qEsdHj1vSR8vvA5yDeQgUJdNz2RYDuSIOqRIHq3AG2h2XJSg.', 'ettttt', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2023-08-02 16:09:22', '2023-04-28 21:11:34', '2023-08-02 14:09:22', 0, 'Administrator', 'store'),
(33, 'test', 'user', 'testuser', '', '', '', '0', '$2a$08$gl36JzPbCiy.0i4T3qSp5uf1YVBos5iKXNyymI066Ru.SDx8HLEqm', 'testuser@example.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2023-04-29 17:39:08', '2023-04-29 15:39:08', 0, 'Stock Officer', '1'),
(34, 'test', 'user1', 'testuser2', '', '', '', '0', '$2a$08$bpW.uro59Ubae5vjIiHN1u0rNXlQXGYeo7My0uoy0GoMOWV9dkDLy', 'testuser1', 0, 0, NULL, NULL, NULL, NULL, '4faa290ce0e289c6fbd50e9f7126eec6', '::1', '0000-00-00 00:00:00', '2023-04-29 17:44:47', '2023-04-29 15:44:47', 0, 'Stock Officer', 'Store'),
(35, 'test', 'user3', 'testuser3', '', '', '', '0', '$2a$08$gE87CLWxRbFEFVdSr2JGiuVipMTCZ.JGGeAPXJUwWPD.W0MEUzBzO', 'testuser3@example.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2023-07-26 19:34:26', '2023-04-29 17:53:52', '2023-07-26 17:34:26', 1, 'Stock Officer', 'Store'),
(36, 'test', 'user4', 'testuser4', '', '', '', '0', '$2a$08$gRrYGVr6jTegfmr0daNVzO/qmj5EbebsvLEbOhUXjKn.OKh3.JVgm', 'testuser4@example.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2023-04-29 18:33:22', '2023-04-29 16:33:22', 1, 'Stock Officer', 'Store'),
(37, 'emma ', 'emma', 'emma', '', '', '', '0', '$2a$08$oail2pGciI/lJ/c1SIqCc.O23RjcjtR/P3BtPHjg5LeWAsTtMS.bq', 'emmhinrf', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2023-04-29 18:35:36', '2023-04-29 18:34:23', '2023-07-27 00:48:09', 2, 'Sales Representative', 'Store'),
(38, 'emmanuel', 'dosu', 'tosin', '', '', '', '0', '$2a$08$YWXKIa8nIpjXzGNq5qp.W.WqPxMYP3jcmjFCnleLuJp5tloHR3ccC', 'eweemm', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '0000-00-00 00:00:00', '2023-07-26 19:59:49', '2023-07-26 17:59:49', 0, 'Stock Officer', 'Store'),
(39, 'Emmanuel', 'Dosu', 'etrend', '', '', '', '0', '$2a$08$B.l/o2GOU.WKOe5XN7MtaeuFxhIoM2V5E3GxhqaQcVzZn959WG4i.', 'fujgjb', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2023-08-02 17:06:49', '2023-07-26 20:07:18', '2023-08-02 15:06:49', 0, 'Stock Officer', 'Store');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, '', ''),
(29, 28, NULL, NULL),
(30, 29, NULL, NULL),
(31, 30, NULL, NULL),
(32, 31, NULL, NULL),
(33, 32, NULL, NULL),
(34, 33, NULL, NULL),
(35, 35, NULL, NULL),
(36, 36, NULL, NULL),
(37, 37, NULL, NULL),
(38, 38, NULL, NULL),
(39, 39, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_product_table`
--
ALTER TABLE `batch_product_table`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `batch_table`
--
ALTER TABLE `batch_table`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `credit_payment_history`
--
ALTER TABLE `credit_payment_history`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `deposit_payment_history`
--
ALTER TABLE `deposit_payment_history`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `invoice_payment_history`
--
ALTER TABLE `invoice_payment_history`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_session`
--
ALTER TABLE `login_session`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `moved_history`
--
ALTER TABLE `moved_history`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `movies_shows`
--
ALTER TABLE `movies_shows`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `product_bar_code`
--
ALTER TABLE `product_bar_code`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `service_category`
--
ALTER TABLE `service_category`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `stock_open_close`
--
ALTER TABLE `stock_open_close`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `stock_recieved`
--
ALTER TABLE `stock_recieved`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `transfer_id` (`recieved_id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `transfer_id` (`transfer_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `supplier_invoice`
--
ALTER TABLE `supplier_invoice`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `transfer_id` (`supplier_id`);

--
-- Indexes for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_credit_sales`
--
ALTER TABLE `tbl_credit_sales`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_invoice_history`
--
ALTER TABLE `tbl_invoice_history`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_payment_payrole`
--
ALTER TABLE `tbl_payment_payrole`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_payment_payrole_history`
--
ALTER TABLE `tbl_payment_payrole_history`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tbl_transfer_recieved`
--
ALTER TABLE `tbl_transfer_recieved`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_product_table`
--
ALTER TABLE `batch_product_table`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch_table`
--
ALTER TABLE `batch_table`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_payment_history`
--
ALTER TABLE `credit_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `SN` bigint(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_payment_history`
--
ALTER TABLE `deposit_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_payment_history`
--
ALTER TABLE `invoice_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `login_session`
--
ALTER TABLE `login_session`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `moved_history`
--
ALTER TABLE `moved_history`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies_shows`
--
ALTER TABLE `movies_shows`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_bar_code`
--
ALTER TABLE `product_bar_code`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_category`
--
ALTER TABLE `service_category`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_open_close`
--
ALTER TABLE `stock_open_close`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_recieved`
--
ALTER TABLE `stock_recieved`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_invoice`
--
ALTER TABLE `supplier_invoice`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_credit_sales`
--
ALTER TABLE `tbl_credit_sales`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1043;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_history`
--
ALTER TABLE `tbl_invoice_history`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_payrole`
--
ALTER TABLE `tbl_payment_payrole`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_payrole_history`
--
ALTER TABLE `tbl_payment_payrole_history`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transfer_recieved`
--
ALTER TABLE `tbl_transfer_recieved`
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
