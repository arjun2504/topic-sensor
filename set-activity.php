<?php
	session_start();
	$pid = $_REQUEST['pid'];
	$_SESSION['activity'] = $pid;
?>