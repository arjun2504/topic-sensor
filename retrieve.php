<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--1-col"></div>
	<div class="mdl-cell mdl-cell--5-col">
		<div class="mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Output</h2> </div>
			<div class="divider"></div>
			<div class="mdl-card__supporting-text">
				<div class="mdl-tabs mdl-js-ripple-effect mdl-js-tabs">
					<div class="mdl-tabs__tab-bar" style="float: left; margin-top: -15px; margin-bottom: -11px">
						<a href="#json-panel" class="mdl-tabs__tab is-active" id="jsontab">JSON</a>
						<a href="#ptext-panel" class="mdl-tabs__tab" id="pttab">Plain Text</a>
					</div>
					<div class="mdl-tabs__panel is-active" id="json-panel">
						<textarea class="json-cont" id="json-cont" onchange="getTweetCount()"></textarea>
					</div>
					<div class="mdl-tabs__panel" id="ptext-panel">
						<textarea class="json-cont" id="plain-text-cont"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--5-col">
		<div class="mdl-card mdl-shadow--2dp json-filter">
			<!-- <div class="mdl-card__title">
		<h2 class="mdl-card__title-text">JSON Output</h2>
	</div> -->
			<div class="mdl-card__supporting-text">
				<div id="progress-fetch" style="display:none">
					<div class="status-fetch">
						<p>Fetching tweets...</p>
						<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
					</div>
					<div class="cancel-btn">
						<center><a href="#" id="stop-tip" onclick="stopFetch()"><i class="material-icons">cancel</i></a> </center>
						<div class="mdl-tooltip mdl-tooltip--right" for="stop-tip"> Stop Fetching </div>
					</div>
				</div>
				<div id="wait-fetch" style="display:none">
					<div class="status-fetch">
						<p>Waiting for next API call...</p>
						<div id="waiting-prog" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
					</div>
					<div class="cancel-btn">
						<center><a href="#" id="stop-tip" onclick="stopFetch()"><i class="material-icons">cancel</i></a> </center>
						<div class="mdl-tooltip mdl-tooltip--right" for="stop-tip"> Stop Fetching </div>
					</div>
				</div>
				<div id="stop-fetch" style="display:none">
					<div class="status-fetch">
						<p>API call has been stopped.</p>
					</div>
				</div>
				<div id="fetch-not-started">
					<div class="status-fetch">
						<p>No API call placed in queue</p>
					</div>
				</div>
			</div>
			<div class="divider"></div>
			<div class="mdl-card__supporting-text">
				<p>So far...</p>
				<h5><span id="tweet-count">No</span> tweets</h5>
				<p id="console" style="display:none"></p>
			</div>
		</div>
		<div class="mdl-card mdl-shadow--2dp" style="margin-bottom: 20px">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Convert to Plain Text</h2> </div>
			<div class="divider"></div>
			<div class="mdl-card__supporting-text">
				<p> JSON format fetched from Twitter API will convert to plain text and can be used for further processing. </p>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="convertToPlainText()">Convert</button> &nbsp; </div>
		</div>
		<div class="mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Connect to database</h2> </div>
			<div class="divider"></div>
			<div class="mdl-card__supporting-text">
				<p> Once plain text is ready, be ready to insert data into the database. Requires database host, username and password. </p>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="generateTable()">Connect</button>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--1-col"></div>
</div>