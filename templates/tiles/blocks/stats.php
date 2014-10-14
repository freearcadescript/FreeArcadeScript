<?php
echo '<div class="side_nav">Stats</div>
	<div id="side_holder">';
		include("includes/stats.php");
		echo'Total Games: '.$totalgames.' <br />
	        Total Played: '.$totalplays.' <br />
	        Plays Today: '.$playstoday.' <br />
		Total Users: '.$totalusers.' <br />
		Total Categories: '.$totalcats.' <br />
		Total Comments: '.$totalcomments.' <br />
		Total Hits: ';include ("$directorypath/includes/counter.php"); echo '<br />
		Users Online: '.$onlineusers.' <br />
		Guests Online: '.$guests.' <br />
		<a href=" '.$domain.'/rss-arcade.php" target="_blank"><img src="'.$domain.'/images/rss.png" alt="rss" title="rss" border="0" /> RSS-Games</a><br />';
		if ($showblog == 1) { echo '<a href="'.$domain.'/rss-blog.php" target="_blank"><img src="'.$domain.'/images/rss.png" alt="rss" title="rss" border="0" /> RSS-Blog</a><br />'; };	?>
		<?php echo'
	</div>';
?>