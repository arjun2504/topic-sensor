<?php
	session_start();
	//error_reporting(0);
	require_once('config.php');
	require_once('lib/twitteroauth.php');
	require_once('lib/twitter_stream.php');
	require_once('db.php');
	require_once('lib/functions.php');
	$access_token = $_SESSION['access_token'];
	$keyword = @$_GET['keyword'];
	$con = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$data = $con->get('search/tweets', array('q' => $keyword.' -filter:retweets', 'lang' => 'en', 'count' => '100'));

	foreach($data->statuses as $status) {
		
		if(contains($status->user->screen_name, $keyword) && !contains($status->text, $keyword)) continue;

		echo "@".$status->user->screen_name." : ".$status->text."<br/>";
		//usleep(100000);
		$tweet_id = $status->id_str;
		$text = $status->text;
		$username = $status->user->screen_name;
		$geo = $status->geo;
		$time = gmdate('Y-m-d H:i:s', strtotime($status->created_at));

		$check_exist = $db->query("SELECT text FROM raw_tweets WHERE text = '$text'");

		if($check_exist->num_rows == 0) {
			$db->query("INSERT INTO raw_tweets (tweet_id, text, username, post_time, geo) VALUES ('$tweet_id', '$text', '$username', CONVERT_TZ('$time','+00:00','+05:30'),'$geo')");
		}

	}
	//echo json_encode($data);

	// for($i=0;$i<count($data);$i++) {
	// 	echo '@'.$data['user']['screen_name'].':'.$data['text']."<br/>";
	// }

	/*$stream = new ctwitter_stream();
	$stream->login(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$stream->start(array($_GET['keyword']));*/
?>