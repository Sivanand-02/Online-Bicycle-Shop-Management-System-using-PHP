/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.7.9 : Database - bicycle_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bicycle_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bicycle_db`;

/*Table structure for table `tbl_card` */

DROP TABLE IF EXISTS `tbl_card`;

CREATE TABLE `tbl_card` (
  `Card_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cust_id` int(5) NOT NULL,
  `Card_no` decimal(16,0) NOT NULL,
  `Card_holder` varchar(30) NOT NULL,
  `Exp_date` date DEFAULT NULL,
  PRIMARY KEY (`Card_id`),
  KEY `Cust_id` (`Cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_card` */

insert  into `tbl_card`(`Card_id`,`Cust_id`,`Card_no`,`Card_holder`,`Exp_date`) values 
(1,11,1234567894567895,'Sivanand M Prabhu','2024-10-12'),
(2,11,1234567894567895,'Sivanand M Prabhu','2024-10-12'),
(3,13,4565789845651232,'Sivanand M Prabhu','2024-07-12'),
(4,14,37811414032,'Agnal N Philip','2024-05-03'),
(5,13,78945612345678,'Sivanand M Prabhu','2024-08-31'),
(6,13,1234567895612356,'Sivanand','2024-06-02'),
(7,13,1234567894561234,'Sivanand M Prabhu','2024-05-02');

/*Table structure for table `tbl_cart_child` */

DROP TABLE IF EXISTS `tbl_cart_child`;

CREATE TABLE `tbl_cart_child` (
  `Cart_child_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cart_master_id` int(5) NOT NULL,
  `Item_id` int(5) NOT NULL,
  `Cart_qty` int(10) NOT NULL,
  `Cart_date` date NOT NULL,
  PRIMARY KEY (`Cart_child_id`),
  KEY `Cart_master_id` (`Cart_master_id`),
  KEY `Item_id` (`Item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cart_child` */

insert  into `tbl_cart_child`(`Cart_child_id`,`Cart_master_id`,`Item_id`,`Cart_qty`,`Cart_date`) values 
(1,1,1,1,'2022-11-01'),
(2,1,3,1,'2022-11-01'),
(3,2,1,1,'2022-11-01');

/*Table structure for table `tbl_cart_master` */

DROP TABLE IF EXISTS `tbl_cart_master`;

CREATE TABLE `tbl_cart_master` (
  `Cart_master_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cust_id` int(5) NOT NULL,
  `Cart_status` varchar(10) NOT NULL,
  `Cart_tot_amt` int(10) NOT NULL,
  PRIMARY KEY (`Cart_master_id`),
  KEY `Cust_id` (`Cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cart_master` */

insert  into `tbl_cart_master`(`Cart_master_id`,`Cust_id`,`Cart_status`,`Cart_tot_amt`) values 
(1,13,'Paid',7500),
(2,13,'pending',4000);

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `Cat_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cat_name` varchar(20) NOT NULL,
  `Cat_desc` varchar(20) NOT NULL,
  `Cat_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_category` */

insert  into `tbl_category`(`Cat_id`,`Cat_name`,`Cat_desc`,`Cat_status`) values 
(1,'Men','Men Bicycles',1),
(2,'Women','Women Bicycles',1),
(3,'Kids','Kids Bicycles',1);

/*Table structure for table `tbl_customer` */

DROP TABLE IF EXISTS `tbl_customer`;

CREATE TABLE `tbl_customer` (
  `Cust_id` int(5) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Cust_fname` varchar(20) NOT NULL,
  `Cust_lname` varchar(20) NOT NULL,
  `Cust_city` varchar(20) NOT NULL,
  `Cust_dist` varchar(20) NOT NULL,
  `Cust_pin` int(6) NOT NULL,
  `Cust_street` varchar(20) NOT NULL,
  `Cust_phone` decimal(10,0) NOT NULL,
  `Cust_dob` date NOT NULL,
  `Cust_gender` varchar(10) NOT NULL,
  `Cust_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_customer` */

insert  into `tbl_customer`(`Cust_id`,`Username`,`Cust_fname`,`Cust_lname`,`Cust_city`,`Cust_dist`,`Cust_pin`,`Cust_street`,`Cust_phone`,`Cust_dob`,`Cust_gender`,`Cust_status`) values 
(7,'abc@gmail.com','Sivanand','M ','Tripunithura','Ernakulam',682038,'Layam Road',9895123645,'2002-06-12','Male',1),
(11,'siva','siva','siva','kochi','Ernakulam',123456,'Cross Street 1',1234567895,'2002-06-12','Male',1),
(12,'siva123','sad','da','ddasda','Ernakulam',212337,'Cross Street 1',1121454456,'2002-06-12','Male',1),
(13,'varkey@gmail.com','Varkey ','Mathan','Angamaly','Ernakulam',682003,'abc street',9865984512,'2001-12-05','Male',1),
(14,'agnal@gmail.com','Agnal','Philip','Aroor','Ernakulam',688537,'Ezhupunna',8086424826,'2002-12-20','Male',1);

/*Table structure for table `tbl_item` */

DROP TABLE IF EXISTS `tbl_item`;

CREATE TABLE `tbl_item` (
  `Item_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cat_id` int(5) NOT NULL,
  `Subcat_id` int(5) NOT NULL,
  `Model_id` int(5) NOT NULL,
  `Item_name` varchar(20) NOT NULL,
  `Item_color` varchar(10) NOT NULL,
  `Sell_price` decimal(10,2) NOT NULL,
  `Item_desc` varchar(100) NOT NULL,
  `Item_stock` int(10) NOT NULL,
  `Item_image` varchar(255) NOT NULL,
  `Item_status` tinyint(1) NOT NULL,
  `Gear_type` varchar(10) NOT NULL,
  `Suspension_type` varchar(10) NOT NULL,
  `Brake_type` varchar(10) NOT NULL,
  `Handlebar_type` varchar(10) NOT NULL,
  PRIMARY KEY (`Item_id`),
  KEY `Cat_id` (`Cat_id`),
  KEY `Subcat_id` (`Subcat_id`),
  KEY `Model_id` (`Model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_item` */

insert  into `tbl_item`(`Item_id`,`Cat_id`,`Subcat_id`,`Model_id`,`Item_name`,`Item_color`,`Sell_price`,`Item_desc`,`Item_stock`,`Item_image`,`Item_status`,`Gear_type`,`Suspension_type`,`Brake_type`,`Handlebar_type`) values 
(1,31,1,1,'Ladybird','Cyan',4000.00,'Ladybird is a very beautiful bicycle available in various colors. ',3,'images/b1.jpg',1,'None','None','Disc','Normal'),
(3,31,1,1,'Ladythunder','Pink',3500.00,'Ladythunder is an awesome bicycle for women.',2,'images/b7.jpg',1,'None','None','Disc','Normal');

/*Table structure for table `tbl_login` */

DROP TABLE IF EXISTS `tbl_login`;

CREATE TABLE `tbl_login` (
  `Username` varchar(40) NOT NULL,
  `login_password` varchar(20) NOT NULL,
  `login_type` varchar(15) NOT NULL,
  `login_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_login` */

insert  into `tbl_login`(`Username`,`login_password`,`login_type`,`login_status`) values 
('admin','admin','admin',1),
('def@gmail.com','devika123','staff',1),
('siva','sivaa','customer',1),
('var@gmail.com','var@123','staff',1),
('siva@gmail.com','siva@123','staff',1),
('sal@gmail.com','sal123','staff',1),
('varkey@gmail.com','Varkeyy','customer',1),
('agnal@gmail.com','Kanjuss','customer',1);

/*Table structure for table `tbl_model` */

DROP TABLE IF EXISTS `tbl_model`;

CREATE TABLE `tbl_model` (
  `Model_id` int(5) NOT NULL AUTO_INCREMENT,
  `Model_name` varchar(10) NOT NULL,
  `Model_desc` varchar(40) NOT NULL,
  `Model_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_model` */

insert  into `tbl_model`(`Model_id`,`Model_name`,`Model_desc`,`Model_status`) values 
(1,'Hercules','Hercules Mountian bike',0),
(5,'Road Bike','Road bikes',0);

/*Table structure for table `tbl_order` */

DROP TABLE IF EXISTS `tbl_order`;

CREATE TABLE `tbl_order` (
  `Order_id` int(5) NOT NULL AUTO_INCREMENT,
  `Cart_master_id` int(5) NOT NULL,
  `Order_date` date NOT NULL,
  PRIMARY KEY (`Order_id`),
  KEY `Cart_master_id` (`Cart_master_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_order` */

insert  into `tbl_order`(`Order_id`,`Cart_master_id`,`Order_date`) values 
(1,1,'2022-11-01'),
(2,1,'2022-11-01'),
(3,1,'2022-11-01'),
(4,1,'2022-11-01'),
(5,0,'2022-11-01'),
(6,0,'2022-11-01'),
(7,0,'2022-11-01'),
(8,0,'2022-11-01'),
(9,0,'2022-11-01'),
(10,1,'2022-11-01'),
(11,1,'2022-11-01'),
(12,1,'2022-11-01');

/*Table structure for table `tbl_payment` */

DROP TABLE IF EXISTS `tbl_payment`;

CREATE TABLE `tbl_payment` (
  `Payment_id` int(5) NOT NULL AUTO_INCREMENT,
  `Order_id` int(5) NOT NULL,
  `Card_id` int(5) NOT NULL,
  `Cart_master_id` int(5) NOT NULL,
  `Payment_date` date NOT NULL,
  PRIMARY KEY (`Payment_id`),
  KEY `Order_id` (`Order_id`),
  KEY `Card_id` (`Card_id`),
  KEY `Cart_master_id` (`Cart_master_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_payment` */

insert  into `tbl_payment`(`Payment_id`,`Order_id`,`Card_id`,`Cart_master_id`,`Payment_date`) values 
(1,2,1,1,'2022-10-30'),
(2,4,2,1,'2022-10-30'),
(3,10,3,1,'2022-11-01'),
(4,13,4,2,'2022-11-01'),
(5,15,5,1,'2022-11-01'),
(6,4,6,1,'2022-11-01'),
(7,12,7,1,'2022-11-01');

/*Table structure for table `tbl_purchase_child` */

DROP TABLE IF EXISTS `tbl_purchase_child`;

CREATE TABLE `tbl_purchase_child` (
  `Pur_child_id` int(5) NOT NULL AUTO_INCREMENT,
  `Pur_master_id` int(5) NOT NULL,
  `Item_id` int(5) NOT NULL,
  `Pur_qty` int(5) NOT NULL,
  `Cost_price` int(10) NOT NULL,
  PRIMARY KEY (`Pur_child_id`),
  KEY `Pur_master_id` (`Pur_master_id`),
  KEY `Item_id` (`Item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_child` */

insert  into `tbl_purchase_child`(`Pur_child_id`,`Pur_master_id`,`Item_id`,`Pur_qty`,`Cost_price`) values 
(1,1,1,1,5000),
(2,2,1,2,4500),
(3,3,1,3,5000);

/*Table structure for table `tbl_purchase_master` */

DROP TABLE IF EXISTS `tbl_purchase_master`;

CREATE TABLE `tbl_purchase_master` (
  `Pur_master_id` int(5) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(5) NOT NULL,
  `Vendor_id` int(5) NOT NULL,
  `Pur_date` date NOT NULL,
  PRIMARY KEY (`Pur_master_id`),
  KEY `Staff_id` (`Staff_id`),
  KEY `Vendor_id` (`Vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchase_master` */

insert  into `tbl_purchase_master`(`Pur_master_id`,`Staff_id`,`Vendor_id`,`Pur_date`) values 
(1,0,5,'2022-10-17'),
(2,0,4,'2022-10-17'),
(3,0,4,'2022-11-01');

/*Table structure for table `tbl_staff` */

DROP TABLE IF EXISTS `tbl_staff`;

CREATE TABLE `tbl_staff` (
  `Staff_id` int(5) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Staff_fname` varchar(15) NOT NULL,
  `Staff_lname` varchar(15) NOT NULL,
  `Staff_city` varchar(20) NOT NULL,
  `Staff_dist` varchar(20) NOT NULL,
  `Staff_pin` int(6) NOT NULL,
  `Staff_street` varchar(15) NOT NULL,
  `Staff_phone` decimal(10,0) NOT NULL,
  `Staff_gender` varchar(10) NOT NULL,
  `Staff_dob` date NOT NULL,
  `Staff_join` date NOT NULL,
  `Staff_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Staff_id`),
  KEY `Staff_username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_staff` */

insert  into `tbl_staff`(`Staff_id`,`Username`,`Staff_fname`,`Staff_lname`,`Staff_city`,`Staff_dist`,`Staff_pin`,`Staff_street`,`Staff_phone`,`Staff_gender`,`Staff_dob`,`Staff_join`,`Staff_status`) values 
(1,'siva@gmail.com','Sivanand','M','Thripunithura','Ernakulam',682038,'Poonithura',8289851798,'Male','2002-06-12','2022-10-09',1),
(2,'mer@gmail.com','Merin','Varghese','Athani','Ernakulam',682480,'Manjapra',8798654512,'Male','2002-07-20','2022-10-09',1),
(3,'dev@gmail.com','Devika','Sreenivas','Palarivattom','Ernakulam',682034,'Vennala',7478956895,'Female','2002-06-20','2020-06-16',1),
(4,'var@gmail.com','Varkey','Mathan','Angamaly','Ernakulam',683572,'Church Nagar',9961099428,'Male','2001-12-20','2022-10-11',1),
(5,'sal@gmail.com','Salman ','Salim','Kochi','Ernakulam',682352,'Church Street',7356895118,'Male','2002-06-12','2022-10-18',1);

/*Table structure for table `tbl_subcategory` */

DROP TABLE IF EXISTS `tbl_subcategory`;

CREATE TABLE `tbl_subcategory` (
  `Subcat_id` int(5) NOT NULL AUTO_INCREMENT,
  `Subcat_name` varchar(20) NOT NULL,
  `Subcat_desc` varchar(20) NOT NULL,
  `Subcat_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Subcat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_subcategory` */

insert  into `tbl_subcategory`(`Subcat_id`,`Subcat_name`,`Subcat_desc`,`Subcat_status`) values 
(1,'27\"','27 inch rim size',1);

/*Table structure for table `tbl_vendor` */

DROP TABLE IF EXISTS `tbl_vendor`;

CREATE TABLE `tbl_vendor` (
  `Vendor_id` int(5) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(5) NOT NULL,
  `Vendor_name` varchar(20) NOT NULL,
  `Vendor_gno` varchar(20) NOT NULL,
  `Vendor_city` varchar(20) NOT NULL,
  `Vendor_dist` varchar(20) NOT NULL,
  `Vendor_pin` int(6) NOT NULL,
  `Vendor_phone` decimal(10,0) NOT NULL,
  `Vendor_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Vendor_id`),
  KEY `Staff_id` (`Staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vendor` */

insert  into `tbl_vendor`(`Vendor_id`,`Staff_id`,`Vendor_name`,`Vendor_gno`,`Vendor_city`,`Vendor_dist`,`Vendor_pin`,`Vendor_phone`,`Vendor_status`) values 
(4,1,'Varkey','Varkey Gno1','Angamaly','Ernakulam',689547,8968680809,1),
(5,1,'Roshan','Roshan gno1','Aluva','Ernakulam',682547,1234568975,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
