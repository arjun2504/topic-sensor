<div class="mdl-grid mdl-layout__container">
	<div class="mdl-cell mdl-cell--1-col"></div>
	<div class="mdl-cell mdl-cell--4-col">
		<div class="mdl-cell--12-col">
			<div class="mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">
    	<input type="text" placeholder="Enter keywords..." class="searchbox" name="q" id="q" autofocus>
    	<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="findTweets(true)">
		  Find Tweets
		</button>
    </h2> </div>
			</div>
			<div class="mdl-card mdl-shadow--4dp search-filter">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Settings</h2> </div>
				<div class="divider"></div>
				<div class="mdl-card__supporting-text">
					<div class="mdl-cell--12-col"> <span class="label-title">Project Name</span>
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="name" name="name">
							<label class="mdl-textfield__label" for="name">Give a name...</label>
						</div>
					</div>
					<div class="mdl-cell--12-col"> <span class="label-title">Choose Mode</span>
						<br/>
						<br/>
						<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="search-mode">Search
							<input type="radio" id="search-mode" class="mdl-radio__button" name="mode" value="search" /> </label>
						<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="stream-mode" style="margin-left: 20px">Stream
							<input type="radio" id="stream-mode" class="mdl-radio__button" name="mode" value="stream" /> </label>
					</div>
					<div class="mdl-cell--12-col" style="margin-top: 20px"> <span class="label-title">Language</span>
						<br/>
						<br/>
						<div class="mdl-selectfield">
							<label>Language</label>
							<select class="browser-default" name="lang" id="lang">
								<option value="en">English</option>
								<option value="jp">Japanese</option>
								<option value="es">Espanol</option>
							</select>
						</div>
					</div>
					<div class="mdl-cell--12-col" style="margin-top: 20px"> <span class="label-title">Time Interval</span>
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="time">
							<label class="mdl-textfield__label" for="time">Set duration in minutes</label> <span class="mdl-textfield__error">Input is not a number!</span> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--1-col">
		<div class="or-text">- OR -</div>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div class="mdl-cell--12-col">
			<div class="mdl-tabs mdl-card mdl-card-shadow--2dp mdl-js-tabs mdl-js-ripple-effect">
				<div class="mdl-tabs__tab-bar">
					<a href="#new-panel" class="mdl-tabs__tab is-active">New</a>
					<a href="#raw-panel" class="mdl-tabs__tab">Raw</a>
					<a href="#cleaned-panel" class="mdl-tabs__tab">Cleaned</a>
					<a href="#processed-panel" class="mdl-tabs__tab">Processed</a>
				</div>

				<div class="mdl-tabs__panel is-active" id="new-panel">
					<div class="mdl-list">
					<?php
						$username = $_SESSION['username'];
						$q = $db->query("SELECT * FROM project WHERE process_status = 'new' AND created_by = '$username' ORDER BY creation_time DESC");
						while($list = $q->fetch_array(MYSQLI_ASSOC)) {
							$activity = $list['pid'];
							$keyword = $list['initial_keyword'];
							$pname = $list['pname'];
							$mode = $list['api_method'];
					?>
						<div class="mdl-list__item mdl-list__item--two-line">
							<span class="mdl-list__item-primary-content">
								<i class="material-icons mdl-list__item-avatar">warning</i>
								<span><?=$list['pname']?></span>
								<span class="mdl-list__item-sub-title">No data (New)</span>
							</span>
							<span class="mdl-list__item-secondary-content">
	      						<a class="mdl-list__item-secondary-action" href="#" onclick="openActivity('<?=$activity?>', 'new', '<?=$keyword?>', '<?=$pname?>', '<?=$mode?>')"><i class="material-icons">forward</i></a>
	    					</span>
	    				</div>
	    			<?php } ?>
					</div>
				</div>


				<div class="mdl-tabs__panel" id="raw-panel">
					<div class="mdl-list">
					<?php
						$username = $_SESSION['username'];
						$q = $db->query("SELECT * FROM project WHERE process_status = 'raw' AND created_by = '$username' ORDER BY creation_time DESC");
						while($list = $q->fetch_array(MYSQLI_ASSOC)) {
							$activity = $list['pid'];
							$keyword = $list['initial_keyword'];
							$pname = $list['pname'];
							$mode = $list['api_method'];
							$count = $db->query("SELECT COUNT(id) FROM data WHERE pid = '$activity'")->fetch_array(MYSQLI_NUM);
					?>
						<div class="mdl-list__item mdl-list__item--two-line">
							<span class="mdl-list__item-primary-content">
								<i class="material-icons mdl-list__item-avatar">warning</i>
								<span><?=$list['pname']?></span>
								<span class="mdl-list__item-sub-title"><?=$count[0]?> tweets</span>
							</span>
							<span class="mdl-list__item-secondary-content">
	      						<a class="mdl-list__item-secondary-action" href="#" onclick="openActivity('<?=$activity?>', 'raw', '<?=$keyword?>', '<?=$pname?>', '<?=$mode?>')"><i class="material-icons">forward</i></a>
	    					</span>
	    				</div>
	    			<?php } ?>
					</div>
				</div>
				
				<div class="mdl-tabs__panel" id="cleaned-panel">
					<div class="mdl-list">
					<?php
						$username = $_SESSION['username'];
						$q = $db->query("SELECT * FROM project WHERE process_status = 'eliminated' AND created_by = '$username' ORDER BY creation_time DESC");
						while($list = $q->fetch_array(MYSQLI_ASSOC)) {
							$activity = $list['pid'];
							$keyword = $list['initial_keyword'];
							$pname = $list['pname'];
							$mode = $list['api_method'];
							$count = $db->query("SELECT COUNT(id) FROM data WHERE pid = '$activity'")->fetch_array(MYSQLI_NUM);
					?>
						<div class="mdl-list__item mdl-list__item--two-line">
							<span class="mdl-list__item-primary-content">
								<i class="material-icons mdl-list__item-avatar">warning</i>
								<span><?=$list['pname']?></span>
								<span class="mdl-list__item-sub-title">Eliminated</span>
							</span>
							<span class="mdl-list__item-secondary-content">
	      						<a class="mdl-list__item-secondary-action" href="#" onclick="openActivity('<?=$activity?>', 'eliminated', '<?=$keyword?>', '<?=$pname?>', '<?=$mode?>')"><i class="material-icons">forward</i></a>
	    					</span>
	    				</div>
	    			<?php } ?>
					</div>
				</div>
				
				<div class="mdl-tabs__panel" id="processed-panel">
					<div class="mdl-list">
						<div class="mdl-list__item"> <span class="mdl-list__item-primary-content">
			<i class="material-icons mdl-list__item-avatar">done</i>
				<span>Chennai Floods</span> </span>
						</div>
						<div class="divider"></div>
						<div class="mdl-list__item"> <span class="mdl-list__item-primary-content">
			<i class="material-icons mdl-list__item-avatar">done</i>
				<span>Twenty20</span> </span>
						</div>
						<div class="divider"></div>
						<div class="mdl-list__item"> <span class="mdl-list__item-primary-content">
			<i class="material-icons mdl-list__item-avatar">done</i>
				<span>Fifa</span> </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--1-col"></div>
</div>