<?php


//mySQL Settings
define('DB_NAME', 'db_chefme');
define('DB_USER', 'root');	 
define('DB_PASSWORD', ''); 
define('DB_HOST', 'localhost');

// Enable error reporting
error_reporting(E_ALL);

// Try to connect to the database
try
{
	$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
	print "Error!: " . $e->getMessage() . "<br/>";
	exit;
}

