-- testAPI table structures

DROP TABLE if exists `receipt_lines` ;
DROP TABLE if exists `receipts` ;
DROP TABLE if exists `customers` ;

DROP TABLE if exists `article_categories`;
DROP TABLE  if exists `addresses` ;
DROP TABLE  if exists `users`;
DROP TABLE  if exists `userrights`;
DROP TABLE  if exists `usergroups`;
DROP TABLE  if exists `member_of_group`;
DROP TABLE  if exists `has_right`;
DROP TABLE  if exists `articles`;
DROP TABLE  if exists `countries`;
DROP TABLE  if exists `currencies`;




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(20) NOT NULL UNIQUE,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `birthdate` date DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `userrights` (
  -- `id` int(11) NOT NULL AUTO_INCREMENT,  
  `id` varchar(20) NOT NULL UNIQUE,  
  `name` varchar(100) NOT NULL UNIQUE,  
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `usergroups` (
  -- `id` int(11) NOT NULL AUTO_INCREMENT,  
  `id` varchar(20) NOT NULL UNIQUE,  
  `name` varchar(100) NOT NULL UNIQUE,  
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `member_of_group` (
  -- `id` int(11) NOT NULL AUTO_INCREMENT,  
  `usergroup_id` varchar(20) NOT NULL,  
  `user_id` int(11) NOT NULL,      
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`user_id`,`usergroup_id`)
  -- PRIMARY KEY (`id`),
  -- UNIQUE KEY `unique_member_of_group` (`user_id`,`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `has_right` (
  -- `id` int(11) NOT NULL AUTO_INCREMENT,  
  `userright_id` varchar(20) NOT NULL,  
  `usergroup_id` varchar(20) NOT NULL,      
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`userright_id`,`usergroup_id`)
  -- PRIMARY KEY (`id`),
  -- UNIQUE KEY `unique_has_right` (`userright_id`,`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



CREATE TABLE `countries` (
  `id` char(3) NOT NULL ,	
  `name` varchar(100) NOT NULL,  
  `description` text DEFAULT NULL,
  `currency_id` char(3) DEFAULT NULL ,	  
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;


CREATE TABLE `currencies` (
  `id` char(3) NOT NULL ,	
  `name` varchar(100) NOT NULL,  
  `minor_unit` int(11) NOT NULL,    
  `description` text DEFAULT NULL,  
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,  
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;


CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` char(3) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;


CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `ean` varchar(13) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `article_category_id` int(11) DEFAULT NULL,
  `price` decimal(13,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `suplier_customer_id` int(11) DEFAULT NULL,
  `manufacturer_customer_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  

  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `article_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `article_id` int(11) NOT NULL,  
  `pricetype` char(3) NOT NULL,  
  `price` decimal(13,2) DEFAULT NULL,
  `vat` decimal(6,2) DEFAULT NULL,
  `valid_from` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `valid_to` DATETIME DEFAULT null,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



CREATE TABLE `article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,  
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  

  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;




CREATE TABLE `customers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) DEFAULT NULL,
    `address_id` INT(11) DEFAULT NULL,
    `customer_category_id` int(11) DEFAULT NULL,
    `shipping_address_id` INT(11) DEFAULT NULL,
    `description` TEXT DEFAULT NULL,
    `customertype` INT(11) DEFAULT NULL,
    `created_by` INT(11) DEFAULT NULL,
    `modified_by` INT(11) DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY (`id`)
)  ENGINE=INNODB AUTO_INCREMENT=0 DEFAULT CHARSET=LATIN1;




CREATE TABLE `customer_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,  
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  

  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptnumber` varchar(45) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,  
  `duedate` datetime DEFAULT NULL,
  `receipttype` char(3) DEFAULT NULL,  
  `value` decimal(13,2) DEFAULT 0,  
  `vat_value` decimal(13,2) DEFAULT 0,  
  `currency_id` char(3) DEFAULT 'EUR',    
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `receipt_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `qty` decimal(13,2) DEFAULT NULL,
  `price` decimal(13,2) DEFAULT NULL,
  `vat` decimal(6,2) DEFAULT NULL,
  `rabat` decimal(6,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



CREATE TABLE `transaction_types` (
  `id` char(3) NOT NULL ,  
  `name` varchar(200) NOT NULL,
  `reference_on` char(3) DEFAULT '',  
  `reference_required` bool ,  
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `stock_types` (
  `id` char(3) NOT NULL ,  
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `stock` (
  `id` char(3) NOT NULL ,  
  `stock_type` char(3) NOT NULL ,  
  `storage_space` char(13) NOT NULL ,  
  `article_id` int(11) NOT NULL,
  `qty` decimal(13,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `storage_spaces` (
  `id` char(13) NOT NULL ,  
  `storage_type` char(3) NOT NULL ,  
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `modified_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;






ALTER TABLE users ADD   FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE users ADD    FOREIGN KEY (modified_by) REFERENCES users(id) ;

ALTER TABLE usergroups ADD   FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE usergroups ADD    FOREIGN KEY (modified_by) REFERENCES users(id) ;

ALTER TABLE userrights ADD   FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE userrights ADD    FOREIGN KEY (modified_by) REFERENCES users(id) ;

ALTER TABLE member_of_group ADD FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE member_of_group ADD FOREIGN KEY (modified_by) REFERENCES users(id) ;
ALTER TABLE member_of_group ADD FOREIGN KEY (user_id) REFERENCES users(id) ;
ALTER TABLE member_of_group ADD FOREIGN KEY (usergroup_id) REFERENCES usergroups(id) ;

ALTER TABLE has_right ADD FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE has_right  ADD FOREIGN KEY (modified_by) REFERENCES users(id) ;
ALTER TABLE has_right  ADD FOREIGN KEY (userright_id) REFERENCES userrights(id) ;
ALTER TABLE has_right  ADD FOREIGN KEY (usergroup_id) REFERENCES usergroups(id) ;



ALTER TABLE receipts ADD FOREIGN KEY (customer_id) REFERENCES customers(id);
ALTER TABLE receipts ADD FOREIGN KEY (currency_id) REFERENCES currencies(id);
ALTER TABLE receipts ADD  FOREIGN KEY (modified_by) REFERENCES users (id);
ALTER TABLE receipts ADD FOREIGN KEY (created_by)  REFERENCES users (id);
        
ALTER TABLE receipt_lines ADD	FOREIGN KEY (article_id) REFERENCES articles(id);
ALTER TABLE receipt_lines ADD	FOREIGN KEY (receipt_id) REFERENCES receipts(id);
ALTER TABLE receipt_lines ADD	FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE receipt_lines ADD	FOREIGN KEY (modified_by) REFERENCES users(id); 



ALTER TABLE customers ADD		FOREIGN KEY (address_id)     REFERENCES addresses (id);
ALTER TABLE customers ADD	    FOREIGN KEY (customer_category_id) REFERENCES customer_categories(id);
ALTER TABLE customers ADD	    FOREIGN KEY (shipping_address_id)        REFERENCES addresses (id);
ALTER TABLE customers ADD	    FOREIGN KEY (modified_by)        REFERENCES users (id);
ALTER TABLE customers ADD	    FOREIGN KEY (created_by)        REFERENCES users (id)  ;

ALTER TABLE countries ADD	    FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE countries ADD	   FOREIGN KEY (modified_by) REFERENCES users(id) ;


ALTER TABLE articles ADD	    FOREIGN KEY (article_category_id) REFERENCES article_categories(id);
ALTER TABLE articles ADD	    FOREIGN KEY (suplier_customer_id) REFERENCES customers(id);
ALTER TABLE articles ADD	    FOREIGN KEY (manufacturer_customer_id) REFERENCES customers(id);
ALTER TABLE articles ADD	    FOREIGN KEY (modified_by) REFERENCES users(id);
ALTER TABLE articles ADD	    FOREIGN KEY (created_by) REFERENCES users(id);


ALTER TABLE addresses ADD	    FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE addresses ADD	  FOREIGN KEY (modified_by) REFERENCES users(id) ;

ALTER TABLE article_categories ADD	   FOREIGN KEY (parent_category_id) REFERENCES article_categories(id);
ALTER TABLE article_categories ADD	   FOREIGN KEY (modified_by) REFERENCES users(id);
ALTER TABLE article_categories ADD	   FOREIGN KEY (created_by) REFERENCES users(id);

-- initial inserts

INSERT INTO  users (name, email, loginname,password) VALUES ('test','test@test.com','test','test');
INSERT INTO  usergroups (id,name) VALUES ('admin','admin group');
INSERT INTO  usergroups (id,name) VALUES ('guest','guests1');
INSERT INTO  usergroups (id,name) VALUES ('sales','sales group');
INSERT INTO  userrights (id,name) VALUES ('admin','admin rights');
INSERT INTO  userrights (id,name) VALUES ('guest','guest rights');
INSERT INTO  userrights (id,name) VALUES ('customers','customer rights');
INSERT INTO  userrights (id,name) VALUES ('articles','articles rights');



INSERT INTO  has_right (userright_id, usergroup_id) VALUES ('admin','admin');
INSERT INTO  has_right (userright_id, usergroup_id) VALUES ('guest','guest');
INSERT INTO  has_right (userright_id, usergroup_id) VALUES ('articles','sales');
INSERT INTO  has_right (userright_id, usergroup_id) VALUES ('customers','sales');

INSERT INTO  member_of_group (user_id, usergroup_id) VALUES (1,'admin');
INSERT INTO  member_of_group (user_id, usergroup_id) VALUES (1,'guest');
INSERT INTO  member_of_group (user_id, usergroup_id) VALUES (2,'guest');
INSERT INTO  member_of_group (user_id, usergroup_id) VALUES (13,'guest');
INSERT INTO  member_of_group (user_id, usergroup_id) VALUES (13,'sales');




INSERT INTO customer_categories (name) values ('cust category 1 ');
INSERT INTO article_categories (name) values ('art category 1 ');

INSERT INTO  transaction_types (id, name, reference_on , reference_required) VALUES ('CO','Cusomer Order','',0);
INSERT INTO  transaction_types (id, name, reference_on , reference_required) VALUES ('SO','Supplier Order','',0);
INSERT INTO  transaction_types (id, name, reference_on , reference_required) VALUES ('SO','Supplier Order','',0);

INSERT INTO  storage_spaces (id, storage_type) VALUES ('SO','Supplier Order','',0);
  