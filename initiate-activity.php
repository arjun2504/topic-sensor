<?php
	require_once('db.php');
	$keyword = $_REQUEST['keyword'];
	$name = $_REQUEST['name'];
	$api = $_REQUEST['api_method'];
	$lang = $_REQUEST['lang'];
	$time = $_REQUEST['time'];

	session_start();
	if(isset($_SESSION['access_token'])) {
		$username = $_SESSION['username'];
		$ald = $db->query("SELECT pid FROM project WHERE pname = '$name'");
		if($ald->num_rows == 0) {
			$_SESSION['json_fetch'] = uniqid();
			$datafile = $_SESSION['json_fetch'];
			$check = $db->query("INSERT INTO project (pname, initial_keyword, lang, api_method, created_by, creation_time, datafile) VALUES ('$name', '$keyword', '$lang', '$api', '$username', NOW(), '$datafile')");
			$_SESSION['activity'] = mysqli_insert_id($db);
			if($check) echo "New activity created.";
		}
		else {
			$pid = $ald->fetch_array(MYSQLI_NUM);
			$_SESSION['activity'] = $pid[0];
			echo "Existing activity started : ".$pid[0];	
		}
	}
?>