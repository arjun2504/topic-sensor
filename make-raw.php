<?php
	session_start();
	$filename = "json/".$_SESSION['json_fetch'].".json";
	$json = file_get_contents($filename);
	$data = json_decode($json);
	$activity = $_SESSION['activity'];
	require_once('db.php');

	foreach($data->statuses as $status) {
		$posted_by = $status->user->screen_name."";
		$tweet = mysqli_real_escape_string($db, $status->text)."";
		$posted_on = gmdate('Y-m-d H:i:s', strtotime($status->created_at))."";
		//$geo = $status->geo;

		$check = $db->query("SELECT tweet FROM data WHERE tweet = '$tweet' AND pid = '$activity'");
		if($check->num_rows == 0) {
			$db->query("INSERT INTO 
				data (posted_by, tweet, posted_on, pid) 
				VALUES ('$posted_by', '$tweet', CONVERT_TZ('$posted_on','+00:00','+05:30'), '$activity')");
		}
		$db->query("UPDATE project SET process_status = 'raw' WHERE pid = '$activity'");
	}

	$query = $db->query("SELECT posted_by, tweet, posted_on FROM data WHERE pid = '$activity'");
	while($row = $query->fetch_array(MYSQLI_ASSOC)) {
		echo "<tr>"."<td>".$row['posted_by']."</td>"."<td>".$row['tweet']."</td>"."<td>".$row['posted_on']."</td>"."</tr>";
	}
?>