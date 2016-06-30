<!-- <div class="mdl-grid">
	<div class="mdl-cell mdl-cell--1-col"></div>
	<div class="mdl-cell mdl-cell--4-col">
		<h5>Noisy Tweets</h5>
		<div class="divider"></div><br/>
		<div id="noisy-tweets"></div>
	</div>
	<div class="mdl-cell mdl-cell--2-col">
		<div class="clean-cont">
			<p align="center">
				<b>Press Clean to see changes</b><br/>
				
				On clicking Clean button, will remove hashtags, mentions, media and links from the tweet.
			</p>

			<center><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="cleanTweets()"><i class="material-icons">check_circle</i> Clean</butto>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<h5>Clean Tweets</h5>
		<div class="divider"></div><br/>
		<div id="clean-tweets"></div>
	</div>
	<div class="mdl-cell mdl-cell--1-col"></div>
</div> -->
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col">
		<div class="mdl-card mdl-shadow--2dp" style="background-color: gold; margin: 12px; width: 98%">
			<div class="mdl-supporting-text" style="padding: 20px; margin-bottom: -20px">
				<p style="font-size: 15px" id="cleanwarning">Clicking Clean will remove unnecessary components from the tweets such as mentions, hashtags, media, links, symbols and punctuations.</p>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="cleanTweets()" href="#">
				      Clean
				    </a>
			</div>
		</div>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col">
		<div class="mdl-grid">
			<div id="noisy-tweets">
			
			</div>
		</div>
	</div>
</div>