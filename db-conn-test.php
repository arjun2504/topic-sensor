<?php
	//set_time_limit(0);
	//error_reporting(0);
	$host = $_REQUEST['host'];
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['pass'];
	$dbname = $_REQUEST['dbname'];

	if(!isset($_REQUEST)) {
		$host = '127.0.0.1';
		$user = 'root';
		$pass = '';
		$dbname = 'topic_sensor';
	}

	$test = mysql_connect($host, $user, $pass);
	$db;
	if(!$test) {
		echo "Error connecting database!";
	} else {
		$db = mysqli_connect($host, $user, $pass, $dbname);
	}
?>