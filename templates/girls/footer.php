</td>
		<td valign="top" width="170">
		<table width="100%">
				<tr>
					<td class="header2">Banner Exchanges</td>
				</tr>
				<tr>
					<td class="content2">
                               <?php echo $bannersright; ?>
					</td>
				</tr>
				<tr>
					<td class="header2">Ads</td>
				</tr>
				<tr>
					<td class="content2">
                               <?php echo $ads2; ?>
					</td>
				</tr>
			</table>
		<table width="100%">
				<tr>
					<td class="header2">Links</td>
				</tr>
				<tr>
					<td class="content2" stlye="padding:5px'">
					<?php
					$rlinkx = $db->query('SELECT * FROM fas_links where activate = \'2\' ');
					echo '<ul  class=\'catmenu\'>';
					while($row = $db->fetch_row($rlinkx)){
						echo '<li><a href=\''.$row['url'].'\'>'.$row['title'].'</a></li>';
					}					echo '</ul>';
					?>
					</td>
				</tr>
				<tr>
					<td class="content2" stlye="padding:5px'">
					<!-- AddThis Button BEGIN --><a href="http://www.addthis.com/bookmark.php" onclick="addthis_url   = location.href; addthis_title = document.title; return addthis_click(this);" target="_blank"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" /></a><script type="text/javascript">var addthis_pub = "sssox";</script><script type="text/javascript" src="http://s7.addthis.com/js/widget.php?v=10"></script>  <!-- AddThis Button END -->
					</td>
				</tr>
			</table>
			<?php
			$totalgames = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_games')));
			$totalusers = $db->num_rows($db->query(sprintf('SELECT userid FROM fas_users')));
			$totalcats = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_categories')));
			$totalcomments = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_comments')));
			$year = date('Y');
		?>
			<table width="100%">
				<tr>
					<td class="header2">Stats</td>
				</tr>
				<tr>
					<td class="content2" style="padding:5px">
					Total Games: <?php echo $totalgames; ?><br />
					Total Users: <?php echo $totalusers; ?><br />
					Total Categories: <?php echo $totalcats; ?><br />
					Total Comments: <? echo $totalcomments; ?><br />
                              Total Hits: <?php include ("$directorypath/includes/counter.php"); ?><br />
					Users Online: <? echo countusersonline(); ?><p>
                              <a href="<?php echo $domain; ?>/rss-arcade.php"><img src="<? echo $domain; ?>/templates/default/images/rss.gif"  border="0" ></img> RSS-Games</a><br /> 
                              <?php   if ($showblog == 1) { echo '<a href="'.$domain.'/rss-blog.php"><img src="'.$domain.'/templates/default/images/rss.gif" border="0" ></img> RSS-Blog</a><br />' ; };

                              ?>

					</td>
				</tr>
			</table>
			<br />
			</td>	</tr></table><br />
<div align="center">
 <! -- Please do not remove the "powered by" link unless, you've purchased the removal. -- >
	<div align="center"> <?php echo "Copyright ".$sitename." &copy; 2008-".date('Y'); ?> All Rights Reserved - Powered By <a href="http://www.freearcadescript.net" target="_blank">Free Arcade Script</a>.</div> <Br />
<?php echo $footerspace; ?>
</body></html>