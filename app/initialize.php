<?php

	// Turning on error reporting for easy debug
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	// define app root	
	define('LIB_PATH', __DIR__);
	// define site root	
	define('SITE_ROOT', LIB_PATH . "/..");
	
	// Define database credentials
	require_once( SITE_ROOT . '/config.php' );	
	defined('DB_SERVER') ? null : define("DB_SERVER", $db_host);
	defined('DB_USER') ? null : define("DB_USER", $db_user);
	defined('DB_PASS') ? null : define("DB_PASS", $db_password);
	defined('DB_NAME') ? null : define("DB_NAME", $db_name);
	
	// Include functions and other required libraries
	require_once( LIB_PATH . '/functions.php' );
	require_once( LIB_PATH . '/database_object.php');	
	
?>