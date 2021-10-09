<?php

require_once('config.php');

// Opening connection and verify
$conxn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conxn->connect_error) {
  die("Could not connect to database: " . $conxn->connect_error);
} 

$sql = "
	CREATE TABLE `my_addresses` ( 
		`id` BIGINT NOT NULL AUTO_INCREMENT , 
		`first_name` VARCHAR(20) NOT NULL , 
		`last_name` VARCHAR(20) NOT NULL , 
		`email` VARCHAR(40) NOT NULL , 
		`street` VARCHAR(40) NOT NULL , 
		`zip` INT(6) NOT NULL , 
		`city` VARCHAR(20) NOT NULL , 
		`created_at` DATETIME NOT NULL , 
		PRIMARY KEY (`id`)
	) ENGINE = InnoDB; 
";
$conxn->query($sql);

$dateTime = date('Y-m-d H:i:s');
$sql = "
	INSERT INTO `my_addresses` 
		(`id`, `first_name`, `last_name`, `email`, `street`, `zip`, `city`, `created_at`) 
	VALUES		
		(1, 'Rakesh', 'Kumar', 'cvceup@gmail.com', 'Daulatabad, Bhulikhas', '231302', '1', '".$dateTime."'),
		(2, 'Ram Bachan', 'Bind', 'rbvindra@gmail.com', 'Rampur, Sherwan', '221008', '5', '".$dateTime."'),
		(3, 'Asha', 'Devi', 'ashakbind@gmail.com', 'Madachak, Aharaura', '256587', '3', '".$dateTime."')
";

$conxn->query($sql);

$sql = "
	CREATE TABLE `cities` ( 
		`id` BIGINT NOT NULL AUTO_INCREMENT , 
		`city` VARCHAR(20) NOT NULL , 
		`created_at` DATETIME NOT NULL , 
		PRIMARY KEY (`id`), 
		UNIQUE `city` (`city`(20))
	) ENGINE = InnoDB; 
";
$conxn->query($sql);

$dateTime = date('Y-m-d H:i:s');
$sql = "
	INSERT INTO `cities` 
		(`id`, `city`, `created_at`) 
	VALUES
		(NULL, 'Varanasi', '".$dateTime."'),  
		(NULL, 'New Delhi', '".$dateTime."'),  
		(NULL, 'Lucknow', '".$dateTime."'),  
		(NULL, 'Hyderabad', '".$dateTime."'),  
		(NULL, 'Pune', '".$dateTime."'),  
		(NULL, 'Prayagraj', '".$dateTime."'),  
		(NULL, 'Mizapur', '".$dateTime."'),  
		(NULL, 'Jaunpur', '".$dateTime."')
";
$conxn->query($sql);

header("Location: index.php");

?>