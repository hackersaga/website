<?php
require_once('connect.php');
$db = new DB_CONNECT();

$query_create_table_profile = "CREATE TABLE IF NOT EXISTS user (
                            serial INT(11) NOT NULL auto_increment,
                            firstname VARCHAR(30),
                            lastname VARCHAR(30),
                            gender varchar(10),
                            mobile BIGINT(15),
                            email varchar(50) NOT NULL,
                            passwd text NOT NULL,
                            recipient_name varchar(50),
                            address text(1000),
                            city varchar(100),
                            state varchar(100),
                            country varchar(100),
                            postal_code varchar(15),
                            fav_list text(65536),
							wardrobe text(65536),
                            reward_points INT(11) DEFAULT 0,
							is_verified TINYINT(1) DEFAULT 0,
                            isset_firstname TINYINT(1) DEFAULT 0,
                            isset_lastname TINYINT(1) DEFAULT 0,
                            isset_mobile TINYINT(1) DEFAULT 0,
                            isset_address TINYINT(1) DEFAULT 0,
                            isset_subscribe TINYINT(1) DEFAULT 1,
                            PRIMARY KEY(serial,email)
                            )ENGINE=InnoDB AUTO_INCREMENT=0";

$result_create_table_profile = mysql_query($query_create_table_profile) or die(mysql_error());

$query_create_table_product = "CREATE TABLE IF NOT EXISTS product(
                            pserial INT(11) NOT NULL auto_increment,
                            pid varchar(255),
                            title varchar(255),
                            price int(11),
                            color varchar(255),
                            tags text,
                            fabrics text,
                            likes int(11) DEFAULT 0,
				purchase int(11) DEFAULT 0,
                            pname varchar(255),
                            description text,
				PRIMARY KEY(pserial,pid)
                            )ENGINE=InnoDB AUTO_INCREMENT=0";
							
$result_product_table = mysql_query($query_create_table_product) or die(mysql_error());							

$query_create_uploads_table = "CREATE TABLE IF NOT EXISTS uploads(
							  serial INT(11) NOT NULL auto_increment,
							  email varchar(255) NOT NULL,
							  file_name text NOT NULL,
                                                   caption varchar(255),
							  PRIMARY KEY(serial,email)
							  )ENGINE=InnoDB AUTO_INCREMENT=0";

$result_uploads_table = mysql_query($query_create_uploads_table) or die(mysql_error());


$query_create_table_home = "CREATE TABLE IF NOT EXISTS home(
                            pserial INT(11) NOT NULL auto_increment,
                            pid varchar(255),
                            title varchar(255),
                            price int(11),
                            color varchar(255),
                            tags text,
                            fabrics text,
                            likes int(11) DEFAULT 0,
                            purchase int(11) DEFAULT 0,
                            pname varchar(255),
                            PRIMARY KEY(pserial,pid)
                            )ENGINE=InnoDB AUTO_INCREMENT=0";

$result_home_table = mysql_query($query_create_table_home) or die(mysql_error());

$query_create_var_table = "CREATE TABLE IF NOT EXISTS vars(
							var_name varchar(250) NOT NULL,
							var_value text,
							PRIMARY KEY(var_name)
							) ENGINE=InnoDB" ;
								

$result_var_table = mysql_query($query_create_var_table) or die(mysql_error());
	


//$query_index = "CREATE UNIQUE INDEX pindex ON product (pid)";	
//mysql_query($query_index);

$query_create_transaction_table = "CREATE TABLE IF NOT EXISTS transactions(
                                   serial_number INT(11) NOT NULL auto_increment,
                                   transaction_id varchar(50) NOT NULL,
                                   email varchar(255) NOT NULL,
                                   mobile varchar(20) NOT NULL,
                                   full_address text,
                                   detail text,
                                   product_name text,
                                   state varchar(255),
                                   country varchar(255),
                                   datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                   subtotal INT(11) NOT NULL,
                                   shipping INT(11) NOT NULL,
                                   total INT(11) NOT NULL,
                                   approval TINYINT(1) DEFAULT 0,
                                   PRIMARY KEY(serial_number,transaction_id)
                                   )";
$result_transaction_table = mysql_query($query_create_transaction_table);






echo "Script ran successfully!";

?>
