<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--1-col"></div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text"><i class="material-icons custom-est-icon">power</i> Connection</h2> </div>
			<div class="divider"></div>
			<div class="mdl-card__supporting-text">
				<div class="mdl-textfield mdl-js-textfield less-wide-tbox">
					<input class="mdl-textfield__input" type="text" id="dbhost">
					<label class="mdl-textfield__label" for="dbhost">Host...</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield less-wide-tbox">
					<input class="mdl-textfield__input" type="text" id="dbuser">
					<label class="mdl-textfield__label" for="dbuser">Username...</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield less-wide-tbox">
					<input class="mdl-textfield__input" type="text" id="dbpass">
					<label class="mdl-textfield__label" for="dbpass">Password...</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield less-wide-tbox">
					<input class="mdl-textfield__input" type="text" id="dbname">
					<label class="mdl-textfield__label" for="dbname">Database Name...</label>
				</div>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<center><a id="test-btn" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="testConnection()">
      Test
    </a> &nbsp;

    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="makeRaw()">
      Store
    </a> </center>

    <div id="test-toast" class="mdl-js-snackbar mdl-snackbar">
	  <div class="mdl-snackbar__text"></div>
	  <button class="mdl-snackbar__action" type="button"></button>
	</div>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--7-col">
	<div class="mdl-card mdl-shadow--2dp" style="display:none" id="dbwarning">
	  <div class="mdl-card__supporting-text">
	  	Your data is stored in database. You can continue to next step.
	  </div>
	  <div class="mdl-card__actions mdl-card--border">
	  	<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="loadNoisyTweets(); goToPage('elimtab')">
	      Continue
	    </a>
	  </div>
	</div>
		<table class="db-table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<td>Username</td>
					<td>Tweet</td>
					<td>Post Time</td>
				</tr>
			</thead>
			<tbody id="table-contents">
				
			</tbody>
		</table>
	</div>
	<div class="mdl-cell mdl-cell--1-col"></div>
</div>