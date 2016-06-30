<?php
	session_start();
	//error_reporting(0);
	require_once('config.php');
	require_once('lib/twitteroauth.php');
	require_once('lib/twitter_stream.php');
	require_once('db.php');
	require_once('lib/functions.php');
	require_once('functions.php');

	$q = $_REQUEST['q'];
	$mode = $_REQUEST['mode'];
	$lang = $_REQUEST['lang'];
	$activity = $_SESSION['activity'];

	if($mode == "stream") {

	}
	else if($mode == "search") {
		$access_token = $_SESSION['access_token'];
		$con = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$data = $con->get('search/tweets', array('q' => $q.' -filter:retweets', 'lang' => $lang, 'count' => '100'));
		$json = json_encode($data);
		//echo $json;
		$json_fetch = $db->query("SELECT datafile FROM project WHERE pid = '$activity' LIMIT 1");
		$js_ft = $json_fetch->fetch_array(MYSQLI_NUM);
		$_SESSION['json_fetch'] = $js_ft[0];

		if($js_ft[0] == null) {
			$_SESSION['json_fetch'] = uniqid();
			$new_js = $_SESSION['json_fetch'];
			$db->query("UPDATE project SET datafile = '$new_js' WHERE pid = '$activity'");
		}
		
		//echo $_SESSION['json_fetch'];
		
		if($json != "null") {
			$filename = "json/".$_SESSION['json_fetch'].".json";
			$handle = fopen($filename, "a+");
			$contents = file_get_contents($filename);
			$final_json = "";
			//echo $contents;
			if($contents == "") {
				fwrite($handle, $json);
			}
			else {
				file_put_contents($filename, "");
				$final_json = json_encode(array_merge_recursive(json_decode($contents, true),json_decode($json, true)));
				fwrite($handle, $final_json);
			}
			$fj = json_decode($final_json);
			echo "Fetched ".count($fj->statuses)." tweets so far.\r\n";
			echo "JSON file saved to http://127.0.0.1/twitter/".$filename."\r\n";
			echo "File size: ".show_size($filename);
			//echo $contents;
			fclose($handle);
		}
	}
?>