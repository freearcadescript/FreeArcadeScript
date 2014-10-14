<?php
echo '<div class="header">
		Stats
	</div>
	<div class="content">';
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
		<a href=" '.$domain.'/rss-arcade.php" target="_blank"><img src="'.$domain.'/templates/'.$template.'/images/rss.png" alt="rss" border="0" /> RSS-Games</a><br />';
		if ($showblog == 1) { echo '<a href="'.$domain.'/rss-blog.php" target="_blank"><img src="'.$domain.'/templates/'.$template.'/images/rss.png" alt="rss" border="0" /> RSS-Blog</a><br />'; };	?>
		<!-- AddThis Button BEGIN --> <a href="http://www.addthis.com/bookmark.php" onclick="addthis_url   = location.href; addthis_title = document.title; return addthis_click(this);" target="_blank"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" /></a><script type="text/javascript">var addthis_pub = "sssox";</script><script type="text/javascript" src="http://s7.addthis.com/js/widget.php?v=10"></script>  <!-- AddThis Button END -->
		<?php echo'
	</div>';
?>