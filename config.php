<?php
$databaseHost = 'localhost';
$databaseName = 'kubera';
$databaseUsername = 'root';
$databasePassword = '';


try {
	// http://php.net/manual/en/pdo.connections.php
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
	
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
	// More on setAttribute: http://php.net/manual/en/pdo.setattribute.php
} catch(PDOException $e) {
	echo $e->getMessage();
}


error_reporting(0);

$active = 0;
$inactive = 1;
$hide = "style=\"display: none;\"";


?>