<?php
	session_start();
	$json_fetch = $_SESSION['json_fetch'];
	$filename = "text/".$json_fetch.".txt";
	$json = file_get_contents($filename);
	echo $json;
?>