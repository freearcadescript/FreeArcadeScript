<?php

$dbhost = 'localhost'; // Database host usually localhost
$dbuser = 'DBUSER'; // Database user
$dbpass = 'DBPASSWORD'; // Database password
$dbname = 'DBNAME'; // Database name
$dbpre = 0;

$db_options = array(
	PDO::ATTR_EMULATE_PREPARES => false,				//	important! use actual prepared statements (default: emulate prepared statements)
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,		//	throw exceptions on errors (default: stay silent)
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC	//	fetch associative arrays (default: mixed arrays)
);

$database = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', ''.$dbuser.'', ''.$dbpass.'', $db_options);	// important! specify the character encoding in the DSN string, don't use SET NAMES

?>