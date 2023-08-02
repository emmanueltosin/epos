DROP TABLE branch;

CREATE TABLE `branch` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` tinytext NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO branch VALUES("1","Taiwo","Ilorin","0","2019-09-02 14:20:39","2019-09-02 14:20:39");
INSERT INTO branch VALUES("2","Lekki Branch","Lekki","0","2019-09-17 14:29:35","2019-09-17 14:29:35");
INSERT INTO branch VALUES("3","Ikeja Branch","Ikeja Branch","0","2019-09-17 14:29:49","2019-09-17 14:29:49");



DROP TABLE category;

CREATE TABLE `category` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE ci_sessions;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




DROP TABLE credit_payment_history;

CREATE TABLE `credit_payment_history` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `credit_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_id` varchar(100) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE deposit;

CREATE TABLE `deposit` (
  `deposit_id` varchar(100) NOT NULL,
  `SN` bigint(30) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`SN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE deposit_payment_history;

CREATE TABLE `deposit_payment_history` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `sales_rep` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `deposit_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `deposit_id` varchar(100) NOT NULL,
  `reciept_id` varchar(100) NOT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE invoice_payment_history;

CREATE TABLE `invoice_payment_history` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `amount` varchar(500) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `Invoice_SN` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO invoice_payment_history VALUES("1","1","2020-02-21","50000","1","2","0","LP1582282554");
INSERT INTO invoice_payment_history VALUES("2","1","2020-02-21","50000","2","2","0","LP1582282554");
INSERT INTO invoice_payment_history VALUES("3","1","2020-02-21","20000","1","1","0","RU1582282527");
INSERT INTO invoice_payment_history VALUES("4","1","2020-02-21","20000","2","1","0","RU1582282527");



DROP TABLE login_attempts;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




DROP TABLE manufacturer;

CREATE TABLE `manufacturer` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` tinytext NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE moved_history;

CREATE TABLE `moved_history` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `qty_moved` int(11) NOT NULL,
  `remaining_qty` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE others;

CREATE TABLE `others` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO others VALUES("1","0","0","Ediwo Super Market","No 28, University Road, Besides Ostrich Bakery Tanke Ilorin. Nigeria","hello","08051516565","Goods Bought in Good <br/> condition can not be returned <br/>","http://localhost/pos/store_assets/1578864411-store_logo.png","34","400","Taiwo Branch","6");



DROP TABLE payment_method;

CREATE TABLE `payment_method` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(300) NOT NULL,
  `defaults` int(11) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO payment_method VALUES("1","POS","1");
INSERT INTO payment_method VALUES("2","CASH","1");
INSERT INTO payment_method VALUES("3","DEPOSIT","1");
INSERT INTO payment_method VALUES("4","TRANSFER","0");



DROP TABLE product_bar_code;

CREATE TABLE `product_bar_code` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `bar_code` tinytext NOT NULL,
  `stock_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `recieved_ref` varchar(100) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE sales;

CREATE TABLE `sales` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","NK1581719038","[{\"item_name\":\"Milo\",\"item_price\":\"1200.00\",\"item_qty\":\"1\",\"total\":1200,\"cost_price\":\"100.00\",\"total_cost_price\":100,\"profit\":1100,\"id\":\"HH1581718724\"}]","2","0.00","1200.00","COMPLETE","1200.00","1100.00","0.00","0.00","1","2020-02-14","23:23 pm","Direct","1","0","","","0","0.00","0.00","","0","0000-00-00","2020-02-14 23:23:58","2020-02-14 23:23:58");
INSERT INTO sales VALUES("2","ZW1582280538","[{\"item_name\":\"Milo\",\"item_price\":\"1200.00\",\"item_qty\":\"7\",\"total\":8400,\"cost_price\":\"100.00\",\"total_cost_price\":700,\"profit\":7700,\"id\":\"HH1581718724\"}]","2","0.00","8400.00","COMPLETE","8400.00","7700.00","0.00","0.00","1","2020-02-21","11:22 am","Direct","1","0","","","0","0.00","0.00","","0","0000-00-00","2020-02-21 11:22:18","2020-02-21 11:22:18");



DROP TABLE stock;

CREATE TABLE `stock` (
  `SN` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO stock VALUES("1","HH1581718724","Milo","","Small","4","1200.00","2020-02-14","100.00","2020-02-14","","","001","1","0","0","2020-02-14 23:18:44","2020-02-21 11:22:18");



DROP TABLE stock_open_close;

CREATE TABLE `stock_open_close` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `id_stock` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `opening` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `closing` int(11) NOT NULL,
  `transfered` int(11) NOT NULL,
  `recieved` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE stock_recieved;

CREATE TABLE `stock_recieved` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
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
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`),
  UNIQUE KEY `transfer_id` (`recieved_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO stock_recieved VALUES("1","YA1581718770","[{\"qty\":\"12\",\"product\":\"HH1581718724\",\"remark\":\"Received\"}]","2020-02-14","","1","1","Akin","","","0","2020-02-14 23:19:30","2020-02-14 23:19:30");



DROP TABLE stock_transfer;

CREATE TABLE `stock_transfer` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
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
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`),
  UNIQUE KEY `transfer_id` (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE supplier;

CREATE TABLE `supplier` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` tinytext NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_phone_number` varchar(16) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("1","Dangote Salt","No 17 Taiwo Road Ilorin","dangotegroup@gmail.com","09087655354","2020-02-14 23:19:07","2020-02-14 23:19:07");



DROP TABLE supplier_invoice;

CREATE TABLE `supplier_invoice` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
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
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`),
  UNIQUE KEY `transfer_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO supplier_invoice VALUES("1","RU1582282527","[{\"qty\":\"4\",\"product\":\"HH1581718724\",\"remark\":\"Received\"},{\"qty\":\"3\",\"product\":\"HH1581718724\",\"remark\":\"Received\"}]","2020-02-21","1","","0.00","40000.00","0","","Complete","0","2020-02-21 11:59:27","2020-02-21 11:59:27");
INSERT INTO supplier_invoice VALUES("2","LP1582282554","[{\"qty\":\"3\",\"product\":\"HH1581718724\",\"remark\":\"Received\"},{\"qty\":\"3\",\"product\":\"HH1581718724\",\"remark\":\"Received\"}]","2020-02-21","1","","0.00","100000.00","0","","Complete","0","2020-02-21 11:58:52","2020-02-21 11:58:52");



DROP TABLE tbl_assets;

CREATE TABLE `tbl_assets` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `assests_name` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(120) NOT NULL,
  `department` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `purchase_date` date NOT NULL,
  `date_sold` date NOT NULL,
  `model_number` varchar(200) NOT NULL,
  `purchase_price` decimal(16,2) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_bank;

CREATE TABLE `tbl_bank` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_bank VALUES("1","GT BANK","0140010012","Edinwo");



DROP TABLE tbl_cashbook;

CREATE TABLE `tbl_cashbook` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `date_` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `bank` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `comment` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_credit_sales;

CREATE TABLE `tbl_credit_sales` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_customers;

CREATE TABLE `tbl_customers` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_expenses;

CREATE TABLE `tbl_expenses` (
  `SN` bigint(11) NOT NULL AUTO_INCREMENT,
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_expenses VALUES("1","2020-02-20","February","2","2020","8","1200","fwefwefwef","wefwefwefwef","0","2020-02-20 09:19:48","2020-02-20 09:19:48");
INSERT INTO tbl_expenses VALUES("2","2020-02-20","February","2","2020","1","1200","fgergergerger","wefwefwefwf","0","2020-02-20 09:20:30","2020-02-20 09:20:30");



DROP TABLE tbl_invoice_history;

CREATE TABLE `tbl_invoice_history` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  `scharge` int(11) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_name;

CREATE TABLE `tbl_name` (
  `product_name` varchar(36) DEFAULT NULL,
  `product_description` varchar(239) DEFAULT NULL,
  `price` varchar(7) DEFAULT NULL,
  `id_stock` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE tbl_payment;

CREATE TABLE `tbl_payment` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_payment_payrole;

CREATE TABLE `tbl_payment_payrole` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(60) NOT NULL,
  `month` varchar(15) NOT NULL,
  `month_number` varchar(15) NOT NULL,
  `year` varchar(15) NOT NULL,
  `total_pay` varchar(30) NOT NULL,
  `total_staff` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pay_date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_payment_payrole_history;

CREATE TABLE `tbl_payment_payrole_history` (
  `SN` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_transfer_recieved;

CREATE TABLE `tbl_transfer_recieved` (
  `SN` bigint(20) NOT NULL AUTO_INCREMENT,
  `tracking_id` varchar(100) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `amt_in` bigint(20) NOT NULL,
  `amt_out` bigint(20) NOT NULL,
  `sold` bigint(20) NOT NULL,
  `date_` date NOT NULL,
  `balance` varchar(100) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`SN`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_transfer_recieved VALUES("1","YA1581718770","1","12","0","0","2020-02-14","12","1");
INSERT INTO tbl_transfer_recieved VALUES("2","NK1581719038","1","0","0","1","2020-02-14","11","1");
INSERT INTO tbl_transfer_recieved VALUES("3","ZW1582280538","1","0","0","7","2020-02-21","4","1");



DROP TABLE user_autologin;

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




DROP TABLE user_profiles;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO user_profiles VALUES("1","1","","");
INSERT INTO user_profiles VALUES("2","2","","");
INSERT INTO user_profiles VALUES("3","3","","");
INSERT INTO user_profiles VALUES("4","2","","");
INSERT INTO user_profiles VALUES("5","3","","");
INSERT INTO user_profiles VALUES("6","4","","");
INSERT INTO user_profiles VALUES("7","5","","");
INSERT INTO user_profiles VALUES("8","6","","");
INSERT INTO user_profiles VALUES("9","7","","");



DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `role` enum('Sales Representative','Administrator','Manager','Accountant','Auditor','Stock Officer','Others','Superuser') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO users VALUES("1","Fwefwe","Wefwe","admin","Wefwef","Wefwef","1233223","30000","$2a$08$6nZ/WpXeawimlwmbJJBG3.JLp15zMH7yLfHXtLzh21zDebhyABrcm","admin@admin.com","1","0","","","","","","::1","2020-02-21 11:42:04","2018-12-17 09:20:31","2020-02-21 11:42:04","0","Administrator");
INSERT INTO users VALUES("3","Ewfwef","Wefwef","sales","Wefwef","Wefwef","2353534","10000","$2a$08$y91pOI268.kfsmTVZCe0g.WMGDDJi3AXvEoYVs8Is6RZA5CaN96Ja","sales@sales.com","1","0","","","0000-00-00 00:00:00","","","::1","2020-02-14 12:28:35","2019-12-07 01:18:47","2020-02-14 12:28:35","0","Sales Representative");
INSERT INTO users VALUES("4","Accontant","Accontant","accountant","GT BANK","Yusuf Olatunji","38484544","1200","$2a$08$M5yf.muDiBxIZlWZgNczUO.E5jbA3iTGNfeYUU.yC8aXhsaUhak9W","accontant@accontant.com","1","0","","","0000-00-00 00:00:00","","","::1","2020-01-24 14:37:44","2020-01-08 14:43:39","2020-01-24 14:37:44","0","Accountant");
INSERT INTO users VALUES("5","Manager","Manager","manager","Sky Bank","Manager Manager","090887373","12000","$2a$08$M5yf.muDiBxIZlWZgNczUO.E5jbA3iTGNfeYUU.yC8aXhsaUhak9W","manager@manager.com","1","0","","","","","","::1","2020-02-21 11:26:42","2020-01-23 11:15:02","2020-02-21 11:26:42","0","Manager");
INSERT INTO users VALUES("6","Stock","Officer","stock","GT BANK","Stock Officer","014010012","12000","$2a$08$Mfd60/M7RA6Kc9xnn8dXY.OBPQJ44YFCDmgFtbqHLo7NZWbCz34Va","stock@gmail.com","1","0","","","0000-00-00 00:00:00","","","::1","2020-01-29 13:23:30","2020-01-29 11:05:59","2020-01-29 13:23:30","0","Stock Officer");
INSERT INTO users VALUES("7","Others","Staff","other","Other Acc","Other Staff","039848545","3000","","other@yahoo.com","1","0","","","0000-00-00 00:00:00","","","::1","2020-01-29 11:31:12","2020-01-29 11:22:24","2020-01-29 11:36:25","0","Others");
INSERT INTO users VALUES("8","Fwefwe","Wefwe","superuser","Wefwef","Wefwef","1233223","30000","$2a$08$6nZ/WpXeawimlwmbJJBG3.JLp15zMH7yLfHXtLzh21zDebhyABrcm","admin@admin.com","1","0","","","0000-00-00 00:00:00","","","::1","2020-02-20 07:36:25","2018-12-17 09:20:31","2020-02-20 07:36:25","0","Superuser");



