pull all and save to a folder "cpmsv2"


database update;

1. add column for pantawid_bene(varchar[20]) @ tbl_transaction

2. add table "client_info"

CREATE TABLE `client_info` (
  `client_num` int NOT NULL AUTO_INCREMENT,
  `office` varchar(255) DEFAULT NULL,
  `imported_by` varchar(255) DEFAULT NULL,
  `date_imported` datetime DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `date_accomplished` datetime DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `mun_city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `extraname` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `mode_admission` varchar(255) DEFAULT NULL,
  `type_assistance` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `source_of_fund` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `charging` varchar(255) DEFAULT NULL,
  `pantawid_bene` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

June 30, 2024
database
1. add column for type_of_disability(varchar[20]) @assessment

July 13, 2024
database
1. add column for program_type(varchar[50]) @tbl_transaction
2. add column for type_of_client(varchar[50]) @tbl_transaction


