-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 10:55 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_project`
--
CREATE DATABASE IF NOT EXISTS `pos_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pos_project`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `SN` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` tinytext NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`SN`, `branch_name`, `branch_address`, `delete_status`, `created`, `updated`) VALUES
(1, 'Taiwo', 'Ilorin', 0, '2019-09-02 13:20:39', '2019-09-02 13:20:39'),
(2, 'Lekki Branch', 'Lekki', 0, '2019-09-17 13:29:35', '2019-09-17 13:29:35'),
(3, 'Ikeja Branch', 'Ikeja Branch', 0, '2019-09-17 13:29:49', '2019-09-17 13:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `SN` int(11) NOT NULL,
  `category` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `credit_payment_history`
--

DROP TABLE IF EXISTS `credit_payment_history`;
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
  `reciept_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

DROP TABLE IF EXISTS `deposit`;
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
  `date_refunded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_payment_history`
--

DROP TABLE IF EXISTS `deposit_payment_history`;
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
  `reciept_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_history`
--

DROP TABLE IF EXISTS `invoice_payment_history`;
CREATE TABLE `invoice_payment_history` (
  `sn` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `bank` int(11) NOT NULL,
  `description` text NOT NULL,
  `Invoice_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_payment_history`
--

INSERT INTO `invoice_payment_history` (`sn`, `supplier_id`, `date_added`, `amount`, `bank`, `description`, `Invoice_SN`, `branch_id`, `invoice_id`) VALUES
(1, 1, '2020-02-25', '20000', 1, 'efwef', 1, 0, 'SW1582621214');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE `manufacturer` (
  `SN` int(11) NOT NULL,
  `manufacturer` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moved_history`
--

DROP TABLE IF EXISTS `moved_history`;
CREATE TABLE `moved_history` (
  `SN` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `qty_moved` int(11) NOT NULL,
  `remaining_qty` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

DROP TABLE IF EXISTS `others`;
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
  `min_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`SN`, `vat`, `scharge`, `sname`, `saddress_1`, `saddress_2`, `scontact_no`, `footer_rec`, `slogo`, `track_expiry_date`, `credit_limit`, `store_name`, `min_qty`) VALUES
(1, '0', '0', 'Ediwo Super Market', 'No 28, University Road, Besides Ostrich Bakery Tanke Ilorin. Nigeria', 'hello', '08051516565', 'Goods Bought in Good <br/> condition can not be returned <br/>', 'http://localhost/pos/store_assets/1578864411-store_logo.png', 34, 400, 'Taiwo Branch', 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `SN` int(11) NOT NULL,
  `payment_method` varchar(300) NOT NULL,
  `defaults` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`SN`, `payment_method`, `defaults`) VALUES
(1, 'POS', 1),
(2, 'CASH', 1),
(3, 'DEPOSIT', 1),
(4, 'TRANSFER', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_bar_code`
--

DROP TABLE IF EXISTS `product_bar_code`;
CREATE TABLE `product_bar_code` (
  `SN` int(11) NOT NULL,
  `bar_code` tinytext NOT NULL,
  `stock_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `recieved_ref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `SN` int(11) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  `items` longtext NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `total_amount` decimal(16,2) NOT NULL,
  `status` enum('COMPLETE','VOID','HOLD','PICKUP') NOT NULL,
  `total_amount_paid` decimal(16,2) NOT NULL,
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
  `vat` decimal(16,2) NOT NULL,
  `scharge` decimal(16,2) NOT NULL,
  `reason` text NOT NULL,
  `voided_by` int(11) NOT NULL,
  `date_voided` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SN`, `reciept_id`, `items`, `discount_type`, `discount`, `total_amount`, `status`, `total_amount_paid`, `total_profit`, `vat_amount`, `s_charge_amt`, `user_id`, `date`, `sales_time`, `payment_type`, `payment_method`, `customer`, `reservation_invoice_link`, `comment`, `branch_id`, `vat`, `scharge`, `reason`, `voided_by`, `date_voided`, `created`, `modified`) VALUES
(1, 'NK1581719038', '[{\"item_name\":\"Milo\",\"item_price\":\"1200.00\",\"item_qty\":\"1\",\"total\":1200,\"cost_price\":\"100.00\",\"total_cost_price\":100,\"profit\":1100,\"id\":\"HH1581718724\"}]', 2, '0.00', '1200.00', 'COMPLETE', '1200.00', '1100.00', '0.00', '0.00', 1, '2020-02-14', '23:23 pm', 'Direct', '1', 0, '', '', 0, '0.00', '0.00', '', 0, '0000-00-00', '2020-02-14 23:23:58', '2020-02-14 23:23:58'),
(2, 'ZW1582280538', '[{\"item_name\":\"Milo\",\"item_price\":\"1200.00\",\"item_qty\":\"7\",\"total\":8400,\"cost_price\":\"100.00\",\"total_cost_price\":700,\"profit\":7700,\"id\":\"HH1581718724\"}]', 2, '0.00', '8400.00', 'COMPLETE', '8400.00', '7700.00', '0.00', '0.00', 1, '2020-02-21', '11:22 am', 'Direct', '1', 0, '', '', 0, '0.00', '0.00', '', 0, '0000-00-00', '2020-02-21 11:22:18', '2020-02-21 11:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `SN` bigint(20) NOT NULL,
  `id_stock` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` longtext NOT NULL,
  `model` tinytext NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(16,2) NOT NULL,
  `expired_date` date NOT NULL,
  `cost_price` double(16,2) NOT NULL,
  `date_available` date NOT NULL,
  `image` tinytext NOT NULL,
  `bar_code_code` varchar(600) NOT NULL,
  `product_code` varchar(300) NOT NULL,
  `status` int(11) NOT NULL,
  `manufacturer` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`SN`, `id_stock`, `product_name`, `product_description`, `model`, `quantity`, `price`, `expired_date`, `cost_price`, `date_available`, `image`, `bar_code_code`, `product_code`, `status`, `manufacturer`, `category_id`, `date_added`, `date_updated`) VALUES
(1, 'HH1581718724', 'Milo', '', 'Small', 4, 1200.00, '2020-02-14', 100.00, '2020-02-14', '', '', '001', 1, 0, 0, '2020-02-14 22:18:44', '2020-02-21 10:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `stock_open_close`
--

DROP TABLE IF EXISTS `stock_open_close`;
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_recieved`
--

DROP TABLE IF EXISTS `stock_recieved`;
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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_recieved`
--

INSERT INTO `stock_recieved` (`SN`, `recieved_id`, `products`, `recieved_date`, `branch`, `supplier`, `reciever_userfullname`, `transfer_user`, `confirm_userfullname`, `note`, `branch_id`, `created`, `updated`) VALUES
(1, 'YA1581718770', '[{\"qty\":\"12\",\"product\":\"HH1581718724\",\"remark\":\"Received\"}]', '2020-02-14', '', 1, 1, 'Akin', '', '', 0, '2020-02-14 22:19:30', '2020-02-14 22:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

DROP TABLE IF EXISTS `stock_transfer`;
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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `SN` bigint(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` tinytext NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_phone_number` varchar(16) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SN`, `supplier_name`, `supplier_address`, `supplier_email`, `supplier_phone_number`, `created`, `updated`) VALUES
(1, 'Dangote Salt', 'No 17 Taiwo Road Ilorin', 'dangotegroup@gmail.com', '09087655354', '2020-02-14 22:19:07', '2020-02-14 22:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice`
--

DROP TABLE IF EXISTS `supplier_invoice`;
CREATE TABLE `supplier_invoice` (
  `SN` bigint(11) NOT NULL,
  `supplier_id` varchar(25) NOT NULL,
  `products` longtext NOT NULL,
  `recieved_date` date NOT NULL,
  `supplier` int(11) NOT NULL,
  `note` text NOT NULL,
  `amount_paid` decimal(16,2) NOT NULL,
  `total_invoice_amount` decimal(16,2) NOT NULL,
  `bank` int(11) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `status` enum('Pending','Complete') NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_invoice`
--

INSERT INTO `supplier_invoice` (`SN`, `supplier_id`, `products`, `recieved_date`, `supplier`, `note`, `amount_paid`, `total_invoice_amount`, `bank`, `payment_method`, `status`, `branch_id`, `created`, `updated`) VALUES
(1, 'SW1582621214', '[{\"qty\":\"10\",\"product\":\"HH1581718724\",\"remark\":\"Received\"},{\"qty\":\"6\",\"product\":\"HH1581718724\",\"remark\":\"Received\"}]', '2020-02-25', 1, 'helo', '0.00', '40000.00', 0, '', 'Pending', 0, '2020-02-25 09:00:14', '2020-02-25 09:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets`
--

DROP TABLE IF EXISTS `tbl_assets`;
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
  `purchase_price` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

DROP TABLE IF EXISTS `tbl_bank`;
CREATE TABLE `tbl_bank` (
  `SN` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(11) NOT NULL,
  `account_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`SN`, `bank_name`, `account_number`, `account_name`) VALUES
(1, 'GT BANK', '0140010012', 'Edinwo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashbook`
--

DROP TABLE IF EXISTS `tbl_cashbook`;
CREATE TABLE `tbl_cashbook` (
  `SN` int(11) NOT NULL,
  `date_` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `bank` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `comment` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_sales`
--

DROP TABLE IF EXISTS `tbl_credit_sales`;
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
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
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

DROP TABLE IF EXISTS `tbl_expenses`;
CREATE TABLE `tbl_expenses` (
  `SN` bigint(11) NOT NULL,
  `expense_date` date NOT NULL,
  `month` varchar(15) NOT NULL,
  `month_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expense_total_amount` decimal(10,0) NOT NULL,
  `expense_purpose` text NOT NULL,
  `expense_purpose_title` tinytext NOT NULL,
  `branch_id` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`SN`, `expense_date`, `month`, `month_number`, `year`, `user_id`, `expense_total_amount`, `expense_purpose`, `expense_purpose_title`, `branch_id`, `modified`, `created`) VALUES
(1, '2020-02-20', 'February', 2, 2020, 8, '1200', 'fwefwefwef', 'wefwefwefwef', 0, '2020-02-20 09:19:48', '2020-02-20 09:19:48'),
(2, '2020-02-20', 'February', 2, 2020, 1, '1200', 'fgergergerger', 'wefwefwefwf', 0, '2020-02-20 09:20:30', '2020-02-20 09:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_history`
--

DROP TABLE IF EXISTS `tbl_invoice_history`;
CREATE TABLE `tbl_invoice_history` (
  `SN` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `last_modeified_user` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `tbl_name`
--

DROP TABLE IF EXISTS `tbl_name`;
CREATE TABLE `tbl_name` (
  `product_name` varchar(36) DEFAULT NULL,
  `product_description` varchar(239) DEFAULT NULL,
  `price` varchar(7) DEFAULT NULL,
  `id_stock` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE `tbl_payment` (
  `SN` int(11) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `cuustomer` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `invoice_id` varchar(60) NOT NULL,
  `type` varchar(100) NOT NULL,
  `payment_type` enum('Invoice','Direct') NOT NULL DEFAULT 'Invoice',
  `department` varchar(100) NOT NULL,
  `invoice_serial` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `user` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `scharge` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_payrole`
--

DROP TABLE IF EXISTS `tbl_payment_payrole`;
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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_payrole_history`
--

DROP TABLE IF EXISTS `tbl_payment_payrole_history`;
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
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_recieved`
--

DROP TABLE IF EXISTS `tbl_transfer_recieved`;
CREATE TABLE `tbl_transfer_recieved` (
  `SN` bigint(20) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `amt_in` bigint(20) NOT NULL,
  `amt_out` bigint(20) NOT NULL,
  `sold` bigint(20) NOT NULL,
  `date_` date NOT NULL,
  `balance` varchar(100) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transfer_recieved`
--

INSERT INTO `tbl_transfer_recieved` (`SN`, `tracking_id`, `stock_id`, `amt_in`, `amt_out`, `sold`, `date_`, `balance`, `user`) VALUES
(1, 'YA1581718770', 1, 12, 0, 0, '2020-02-14', '12', 1),
(2, 'NK1581719038', 1, 0, 0, 1, '2020-02-14', '11', 1),
(3, 'ZW1582280538', 1, 0, 0, 7, '2020-02-21', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(400) COLLATE utf8_bin NOT NULL,
  `bank_account_name` varchar(300) COLLATE utf8_bin NOT NULL,
  `bank_account_no` varchar(60) COLLATE utf8_bin NOT NULL,
  `salary` varchar(300) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL,
  `role` enum('Sales Representative','Administrator','Manager','Accountant','Auditor','Stock Officer','Others','Superuser') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `bank_name`, `bank_account_name`, `bank_account_no`, `salary`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `branch_id`, `role`) VALUES
(1, 'Fwefwe', 'Wefwe', 'admin', 'Wefwef', 'Wefwef', '1233223', '30000', '$2a$08$6nZ/WpXeawimlwmbJJBG3.JLp15zMH7yLfHXtLzh21zDebhyABrcm', 'admin@admin.com', 1, 0, '', NULL, NULL, '', '', '::1', '2020-02-25 09:57:07', '2018-12-17 09:20:31', '2020-02-25 08:57:07', 0, 'Administrator'),
(3, 'Ewfwef', 'Wefwef', 'sales', 'Wefwef', 'Wefwef', '2353534', '10000', '$2a$08$y91pOI268.kfsmTVZCe0g.WMGDDJi3AXvEoYVs8Is6RZA5CaN96Ja', 'sales@sales.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-02-14 12:28:35', '2019-12-07 01:18:47', '2020-02-14 11:28:35', 0, 'Sales Representative'),
(4, 'Accontant', 'Accontant', 'accountant', 'GT BANK', 'Yusuf Olatunji', '38484544', '1200', '$2a$08$M5yf.muDiBxIZlWZgNczUO.E5jbA3iTGNfeYUU.yC8aXhsaUhak9W', 'accontant@accontant.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-01-24 14:37:44', '2020-01-08 14:43:39', '2020-01-24 13:37:44', 0, 'Accountant'),
(5, 'Manager', 'Manager', 'manager', 'Sky Bank', 'Manager Manager', '090887373', '12000', '$2a$08$M5yf.muDiBxIZlWZgNczUO.E5jbA3iTGNfeYUU.yC8aXhsaUhak9W', 'manager@manager.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-02-21 11:26:42', '2020-01-23 11:15:02', '2020-02-21 10:26:42', 0, 'Manager'),
(6, 'Stock', 'Officer', 'stock', 'GT BANK', 'Stock Officer', '014010012', '12000', '$2a$08$Mfd60/M7RA6Kc9xnn8dXY.OBPQJ44YFCDmgFtbqHLo7NZWbCz34Va', 'stock@gmail.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-01-29 13:23:30', '2020-01-29 11:05:59', '2020-01-29 12:23:30', 0, 'Stock Officer'),
(7, 'Others', 'Staff', 'other', 'Other Acc', 'Other Staff', '039848545', '3000', '', 'other@yahoo.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-01-29 11:31:12', '2020-01-29 11:22:24', '2020-01-29 10:36:25', 0, 'Others'),
(8, 'Fwefwe', 'Wefwe', 'superuser', 'Wefwef', 'Wefwef', '1233223', '30000', '$2a$08$6nZ/WpXeawimlwmbJJBG3.JLp15zMH7yLfHXtLzh21zDebhyABrcm', 'admin@admin.com', 1, 0, '', '', '0000-00-00 00:00:00', '', '', '::1', '2020-02-20 07:36:25', '2018-12-17 09:20:31', '2020-02-20 06:36:25', 0, 'Superuser');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
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
(2, 2, '', ''),
(3, 3, '', ''),
(4, 2, '', ''),
(5, 3, '', ''),
(6, 4, '', ''),
(7, 5, '', ''),
(8, 6, '', ''),
(9, 7, '', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_payment_history`
--
ALTER TABLE `credit_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `invoice_payment_history`
--
ALTER TABLE `invoice_payment_history`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moved_history`
--
ALTER TABLE `moved_history`
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
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_invoice`
--
ALTER TABLE `supplier_invoice`
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `SN` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoice_history`
--
ALTER TABLE `tbl_invoice_history`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
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
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
