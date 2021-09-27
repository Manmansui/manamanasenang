<?php
 define('DB_SERVER', 'localhost');
 define('DB_CUSTNAME', 'root');
 define('DB_PASSWORD', '');
 define('DB_DATABASE', 'mywebsite');
 

$db = mysqli_connect(DB_SERVER,DB_CUSTNAME,DB_PASSWORD,DB_DATABASE);

if (!$db) { 
	die("Connection failed: " . mysqli_connect_error());
}

?>