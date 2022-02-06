<?php
$databaseHost = 'localhost';
$databaseName = 'kubera';
$databaseUsername = 'root';
$databasePassword = 'root';

/*
//local
$databaseHost = 'localhost';
$databaseName = 'kubera';
$databaseUsername = 'root';
$databasePassword = '';


//production
$databaseHost = 'localhost';
$databaseName = 'besttryi_kubera';
$databaseUsername = 'besttryi_gym';
$databasePassword = 'kubera_password';

$databaseHost = 'localhost';
$databaseName = 'kuberbxi_kubera';
$databaseUsername = 'kuberbxi_db_user';
$databasePassword = 'kubera_password';
*/


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
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i:sa");
$date = (date("Y/m/d"));
$month_and_year_input = date('F Y'); 

$kubera_user_name = "kubera";
$kubera_password = "kubera_password";

?>