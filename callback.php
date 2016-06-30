<?php
	session_start();
	require_once('config.php');
	require_once('lib/twitteroauth.php');
	$con = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $con->getAccessToken($_GET['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	header("Location: /twitter/app");
?>