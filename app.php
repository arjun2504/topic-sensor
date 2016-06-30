<?php
	session_start();
	if(!isset($_SESSION['access_token'])) {
	header("Location: ./");
	}

	require_once('config.php');
	require_once('lib/twitteroauth.php');
	require_once('lib/twitter_stream.php');
	require_once('db.php');
	require_once('lib/functions.php');
	$access_token = $_SESSION['access_token'];
	//print_r($access_token);
	$con = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$credentials = $con->get('account/verify_credentials');
	$_SESSION['username'] = $credentials->screen_name;
	$username = $_SESSION['username'];
	
	if(!empty($username))
		$db->query("INSERT INTO users (username, created_at) VALUES ('$username', NOW())");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/material.min.js"></script>
	<script src="js/custom.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> </head>

<body>
	<div class="mdl-layout mdl-js-layout">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title --><span class="mdl-layout-title">Twitter Topic Sensor</span> </div>
			<!-- Tabs -->
			<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
				<a href="#search" class="mdl-layout__tab is-active" id="searchtab">1. Search</a>
				<a href="#retrieve" class="mdl-layout__tab" id="rettab">2. Retrieve</a>
				<a href="#store" class="mdl-layout__tab" id="dbtab">3. Database</a>
				<a href="#remove-components" class="mdl-layout__tab" id="elimtab">4. Remove Components</a>
				<a href="#normalize" class="mdl-layout__tab">5. Normalize</a>
				<a href="#sense-topics" class="mdl-layout__tab">6. Sense Topics</a>
				<a href="#summarize" class="mdl-layout__tab">7. Summarize</a>
			</div>
		</header>
		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Twitter Topic Sensor</span>
			<nav class="mdl-navigation">
		    	<a class="mdl-navigation__link" href="http://twitter.com/<?=$credentials->screen_name?>" target="_blank">@<?=$credentials->screen_name?></a>
		    	<a class="mdl-navigation__link" href="logout">Logout</a>
		    </nav>
		</div>
		<main class="mdl-layout__content">
			<section class="mdl-layout__tab-panel is-active" id="search">
				<div class="page-content">
					<?php include "search.php"; ?>
				</div>
			</section>
			<section class="mdl-layout__tab-panel" id="retrieve">
				<div class="page-content">
					<?php include "retrieve.php"; ?>
				</div>
			</section>
			<section class="mdl-layout__tab-panel" id="store">
				<div class="page-content">
					<?php include "store.php"; ?>
				</div>
			</section>
			<section class="mdl-layout__tab-panel" id="remove-components">
				<div class="page-content">
					<?php include "elimination.php"; ?>
				</div>
			</section>
			<section class="mdl-layout__tab-panel" id="normalize">
				<div class="page-content">
					<!-- Your content goes here -->
				</div>
			</section>
		</main>
	</div>

</body>

</html>