/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.1.38-MariaDB : Database - cpms_imported
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cpms_imported` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cpms_imported`;

/*Table structure for table `client_info` */

DROP TABLE IF EXISTS `client_info`;

CREATE TABLE `client_info` (
  `C_id` int(100) NOT NULL AUTO_INCREMENT,
  `office` varchar(50) DEFAULT NULL,
  `imported_by` varchar(50) DEFAULT NULL,
  `date_imported` datetime DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `encoded_by` varchar(50) DEFAULT NULL,
  `client_num` varchar(50) DEFAULT NULL,
  `date_accomplished` datetime DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `mun_city` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `extraname` varchar(10) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `mode_admission` varchar(50) DEFAULT NULL,
  `type_assistance` varchar(50) DEFAULT NULL,
  `amount1` varchar(50) DEFAULT NULL,
  `source_of_fund1` varchar(50) DEFAULT NULL,
  `type_assistance2` varchar(50) DEFAULT NULL,
  `amount2` varchar(50) DEFAULT NULL,
  `source_fund2` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `charging` varchar(50) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `b_lname` varchar(50) DEFAULT NULL,
  `b_fname` varchar(50) DEFAULT NULL,
  `b_mname` varchar(50) DEFAULT NULL,
  `b_exname` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `client_info` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
