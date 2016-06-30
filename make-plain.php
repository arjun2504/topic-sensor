<?php
	require_once('db.php');
	require_once('functions.php');
	session_start();
	$activity = $_SESSION['activity'];
	$datafile = $db->query("SELECT datafile from project WHERE pid = '$activity'")->fetch_array(MYSQLI_NUM);
	$filename = "json/".$datafile[0].".json";
	$textfile = "text/".$datafile[0].".txt";
	$data_contents = json_decode(file_get_contents($filename));
	$text_array = array();
	foreach($data_contents->statuses as $data) {
		array_push($text_array, $data->user->screen_name."|, ".$data->text."|, ".$data->created_at."\r\n");
	}
	if(file_exists($textfile)) unlink($textfile);
	file_put_contents($textfile, implode("\n", $text_array));
	echo "Converted to plain text.\r\n";
	echo "File: http://127.0.0.1/twitter/".$textfile."\r\n";
	echo "Size: ".show_size($textfile);
?>