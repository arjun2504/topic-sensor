<?php
	require_once('db.php');
	session_start();
	$activity = $_SESSION['activity'];
	$q = $db->query("SELECT tweet FROM data WHERE pid = '$activity' AND pid IN (SELECT pid FROM project WHERE process_status = 'raw')");
	if($q->num_rows == 0) {
?>
<div class="mdl-cell mdl-cell--3-col">
<div class="mdl-card mdl-shadow--2dp">
	<div class="mdl-card__supporting-text">
		<font color="red">Data is already cleaned or the selected project is new</font>
	</div>
</div>
</div>
<?php
	} else {
		while($noise = $q->fetch_array(MYSQLI_ASSOC)) {
?>
<div class="mdl-cell mdl-cell--3-col">
<div class="mdl-card mdl-shadow--2dp">
	<div class="mdl-card__supporting-text">
		<?php echo $noise['tweet']; ?>
	</div>
</div>
</div>
<?php
		}
	}
?>