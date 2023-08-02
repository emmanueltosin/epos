-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2021 at 04:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_pos`
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
(1, 'Taxable Product', 5, '2020-10-23 14:36:48', '2020-10-23 14:36:48'),
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
(1, 'Sales', 'Sales', '2021-02-03 13:53:03', '2021-02-03 13:53:03');

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

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`SN`, `genre`, `updated`, `created`) VALUES
(1, 'Action', '2020-10-17 13:26:49', '2020-10-17 13:26:49'),
(2, 'Commedy', '2020-10-17 13:26:55', '2020-10-17 13:26:55');

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

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(102, '::1', 'md', '2021-02-03 13:52:26');

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
(1, 19, 'ABDULLSALAM  TEMITOPE', 'TEMITOPE', 'Super Market', 'Sales Representative', '2020-12-09', '12:15:13am', 'PENDING');

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
(1, 'ALMAS', '2020-10-17 12:26:24', '2020-10-17 12:26:24');

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
(1, '0', '0', 'ALMAS PLACE', '', 'ITA NMON, ALONG ALFA YAHAYA, ILORIN', '(234) 07031350058', '', 'http://localhost/shakipos/store_assets/1609830061-store_logo.png', 20, 400, 'Ilorin Branch', 6, '{\"1913152938\":{\"hold_id\":1913152938,\"time\":\"09 December 2020, 12:15:34 AM\",\"total\":220,\"items\":[{\"item_name\":\"MILK TEETH AGE 1-6 50ML\",\"item_price\":\"220.00\",\"item_qty\":\"1\",\"total\":220,\"id\":\"217\",\"type\":\"pieces\"}],\"department\":\"Super Market\",\"pending_cart_name\":\"TEMITOPE\\/09\\/12\\/2020 12:15 am\"}}', '2020-10-06 12:24:51', '2021-01-05 08:01:01');

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
(4, 'TRANSFER', 0, '2020-10-06 12:25:25', '2020-10-06 13:25:25');

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
(1, 'PC1612360406', 'Sachet Peak Milk', '', 'CAMRY', 20, 0, 0, 0, 0, 3000.00, '0000-00-00', 2000.00, '2021-02-03', 'No', '0000-00-00', '', 'Sales', '', '', 'Pieces', '0.000', '0.000', 1, 1, 2, '2021-02-03 13:53:26', '2021-02-03 13:53:26');

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
(1, 'LN1612360415', '[{\"qty\":\"20\",\"remark\":\"Received\",\"product\":\"1\"}]', '2021-02-03', '', 1, 1, 'Almas', '', '', 0, '2021-02-03 13:53:35', '2021-02-03 13:53:35');

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
(1, 'LN1612360415', 1, 20, 0, 0, '2021-02-03', '20', 1, '', '2021-02-03 13:53:35', '2021-02-03 14:53:35');

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
(1, 'Admin', 'Istrator', 'admin', 'Wefwef', 'Wefwef', '1233223', '30000', '$2a$08$CUzZ2hsjaAF03MyhIJtP4ObMV92N2ulxjOOAsuudqyilEpN9DNjWi', 'admin@admin.com', 1, 0, '', NULL, NULL, '', '', '::1', '2021-02-03 14:52:31', '2018-12-17 09:20:31', '2021-02-03 13:52:31', 0, 'Top Administrator', 'Top Administrator'),
(19, 'ABDULLSALAM ', 'TEMITOPE', 'TEMITOPE', '', '', '', '0', '$2a$08$Wfz2kgYfkmVptz45AMbJHegtoAjfyVxdVo1/T7uHIcoI3TKkVlTbC', 'OPE', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2020-12-09 00:15:13', '2020-10-27 08:57:20', '2020-12-08 23:15:13', 0, 'Sales Representative', 'Super Market'),
(20, 'MUBARAQ ', 'MUSLIM', 'MUSLIM', '', '', '', '0', '$2a$08$SGew5I7p1ZcUCz9Vso2VFu5F1JboTMMxDnDCckB0LuAnH8VFgnUGW', 'OLA', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.7', '2020-11-13 08:06:47', '2020-10-27 08:59:10', '2020-11-13 07:06:47', 0, 'Sales Representative', 'Super Market'),
(21, 'ABIMBOLA', 'AHMED', 'abimbola', '', '', '', '0', '$2a$08$1jyiM5nRbw3Pq0Cq5ntFQuWETqTsGE8JvYrdjyVmEuBqe/SW8XRpW', 'abimbola', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.6', '2020-11-13 12:00:32', '2020-10-27 12:21:41', '2020-11-13 11:00:32', 0, 'Sales Representative', 'Eatery'),
(22, 'AYODIMEJI', 'JAMIU', 'ayo', '', '', '', '0', '$2a$08$cpJ5T5DeDDkfbfUgo8oXeOLtvjkWbtkei6Keo5oRw36vetwFbbXA6', 'ayo', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.6', '2020-11-13 07:54:15', '2020-10-27 14:48:48', '2020-11-13 06:54:15', 0, 'Sales Representative', 'Phone'),
(23, 'AJIBADE', 'OLUBUNMI', 'OLUBUNMI', '', '', '', '0', '$2a$08$StLJt2KVdDjiiVJnvqAFbuDzIEl/AkjxJwAW2LIU6UtVGn8YVVxZS', 'OLU', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.16', '2020-11-08 18:42:55', '2020-10-29 16:59:55', '2020-11-08 17:42:55', 0, 'Sales Representative', 'Super Market'),
(24, 'AJIBOLA', 'OLAITAN', 'olaitan', '', '', '', '0', '$2a$08$RLbFizdRCN0nWwhipaNHv.10MxzRHzolDg9BIj1EJJceEQkyC0nne', 'olaitan', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.170', '2020-10-31 14:59:27', '2020-10-29 19:38:12', '2020-10-31 13:59:27', 0, 'Sales Representative', 'Boutique'),
(25, 'EMMANUEL', 'BLESSING', 'blessing', '', '', '', '0', '$2a$08$CyOLnmJyTPTVvgBA7ypBieK8F7asOLqqweu8jrbiu6wmKvdBlp7BS', 'blessing', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.16', '2020-11-03 15:25:11', '2020-10-30 17:14:07', '2020-11-03 14:25:11', 0, 'Sales Representative', 'Super Market'),
(26, 'moshood', 'kafilat', 'kafilat', '', '', '', '0', '$2a$08$MdcutMtQ4zFzA.YVqHr2KO9Qu0EUucPVpI/qFTke5NZPbDf1HHTSm', 'odun', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.6', '2020-11-10 16:49:32', '2020-11-10 09:28:08', '2020-11-10 15:49:32', 0, 'Sales Representative', 'Boutique'),
(27, 'adeladan', 'ismail', 'ismail', '', '', '', '0', '$2a$08$QTIesYRQvoDj7UiD4JqYSe4So3AbnwOMx7axxuTxexqB49jxjnD26', 'ade', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.100.16', '0000-00-00 00:00:00', '2020-11-10 09:29:49', '2020-11-10 08:29:49', 0, 'Sales Representative', 'Super Market');

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
(20, 19, NULL, NULL),
(21, 20, NULL, NULL),
(22, 21, NULL, NULL),
(23, 22, NULL, NULL),
(24, 23, NULL, NULL),
(25, 24, NULL, NULL),
(26, 25, NULL, NULL),
(27, 26, NULL, NULL),
(28, 27, NULL, NULL);

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
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_payment_history`
--
ALTER TABLE `credit_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_payment_history`
--
ALTER TABLE `invoice_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `login_session`
--
ALTER TABLE `login_session`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_bar_code`
--
ALTER TABLE `product_bar_code`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_open_close`
--
ALTER TABLE `stock_open_close`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_recieved`
--
ALTER TABLE `stock_recieved`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_invoice`
--
ALTER TABLE `supplier_invoice`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_credit_sales`
--
ALTER TABLE `tbl_credit_sales`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
