<?php
	function show_size($filename) {
		$file_size = (round((filesize($filename) / 1024),1));
		$show_size = $file_size." KB";
		if($file_size > 1024) {
			$show_size = (round(($file_size / 1024)." MB",1))." MB";
		}
		return $show_size;
	}
?>