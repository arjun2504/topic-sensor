<?php
	require_once('db.php');
	require_once('lib/functions.php');
	session_start();
	$activity = $_SESSION['activity'];
	$tweets = $db->query("SELECT id, tweet FROM data WHERE pid = '$activity'");
	$single = array();
	while($t = $tweets->fetch_array(MYSQLI_ASSOC)) {
		$cur_id = $t['id'];
		if(trim($t['tweet']) == "") {
			$db->query("DELETE FROM data WHERE id = $cur_id");
		}

		
		$single = explode(" ",$t['tweet']);
		$single = array_map('trim', $single);
		$i = 0;
		foreach($single as $word ) {
			$single[$i] = replace_accents($single[$i]);
			$single[$i] = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $word);
			if(filter_var($word, FILTER_VALIDATE_URL) || substr($word,0,1) == '#' || substr($word,0,1) == '@' || contains($word,'http') || contains($word,'https')) {
				$single[$i] = "";
			}
			$i++;
		}
		$single = implode($single, " ");
		$db->query("UPDATE data SET tweet = '$single' WHERE id = '$cur_id'");
		$db->query("UPDATE project SET process_status = 'eliminated' WHERE pid = '$activity'");
?>
<div class="mdl-cell mdl-cell--3-col">
<div class="mdl-card mdl-shadow--2dp">
	<div class="mdl-card__supporting-text">
		<?php echo $single; ?>
	</div>
</div>
</div>
<?php
	}
?>