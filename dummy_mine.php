<?php
	require_once('db.php');
	require_once('lib/functions.php');

	$tweets = $db->query("SELECT text FROM raw_tweets");
	$single = array();
	while($t = $tweets->fetch_array(MYSQLI_ASSOC)) {
		$single = explode(" ",$t['text']);
		$single = array_map('trim', $single);
		$i = 0;
		foreach($single as $word ) {
			$single[$i] = replace_accents($single[$i]);
			$single[$i] = preg_replace('/[^\p{L}\p{N}\s]/u', '', $word);
			if(filter_var($word, FILTER_VALIDATE_URL) || substr($word,0,1) == '#' || substr($word,0,1) == '@' || contains($word,'http') || contains($word,'https')) {
				$single[$i] = "";
			}
			$i++;
		}
		$single = implode($single, " ");
		echo $single."<br/>";
	}
?>