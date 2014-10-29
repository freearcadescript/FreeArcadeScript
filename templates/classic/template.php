<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $pagetitle; ?> - <?php echo $slogan; ?></title>
<meta name="keywords" content="<?php echo $metatags; ?>" />
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta name="author" content="freearcadescript.net" />
<meta property="og:url" content="<?=$domain?>" />
<meta property="og:title" content="<?php echo $sitename; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=$domain?>/templates/<?php echo $template ; ?>/styles.css" rel="stylesheet" type="text/css">
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<?php include ("js/rating_update.php"); ?>
</head>
<body>
<?php if (!$facebookappid == "") { echo ''.$facebookappid.''; }; ?>
<table width="900" border="0" align="center" class="maintable" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
		<img src="<?=$domain?>/templates/<?php echo $template ; ?>/images/banner.png" width="100%"></img>

		<?php
      if (!$headerspace == "") { echo '<br /><div align="center">'.$headerspace.'</div><br />'; };

	echo '	<div class=\'menutop\'>';
	if($seo_on == 1){
		echo '	<ul>
				<li><a href=\''.$domain.'\' title=\'Home\'>Home</a></li>
				<li><a href=\''.$domain.'/mostplayed/\' title=\'Most Played\'>Most Played</a></li>
				<li><a href=\''.$domain.'/newest/\' title=\'Newest\'>Newest</a></li>
                                <li><a href="'.$domain.'/memberslist/" title="Member List">Member List</a></li>
				<li><a href=\''.$domain.'/search/\' title=\'Search\'>Search</a></li>
				<li><a href=\''.$domain.'/links/\' title=\'Links\'>Links</a></li>
				<li><a href=\''.$domain.'/contact/\' title=\'Contact Us\'>Contact Us</a></li>
				<li><a href=\''.$domain.'/fineprint/\' title=\'Fine Print\'>Fine Print</a></li>';
				if(!isset($suserid)){
				$mymenu1 = '	<li ><a href=\''.$domain.'/login/\'>Login</a></li>
					<li><a href=\''.$domain.'/forgotpassword/\'>Forgot password?</a></li>
					<li ><a href=\''.$domain.'/signup/\'>Signup</a></li>';
				}else{
				$mymenu1 = '
				<li ><a href=\''.$domain.'/myaccount/\'>My Account</a></li>
				<li ><a href=\''.$domain.'/logout/\'>Logout</a></li>';
				}
            if ($showpages == 1) { echo '<li><a href=\''.$domain.'/pages/\' title=\'pages\'>Pages</a></li>'; };
            if ($showblog == 1) { echo '<li><a href=\''.$domain.'/blog/\' title=\'blog\'>Blog</a></li>'; };

		echo '

	</ul>';
	}else{
		echo '	<ul>
				<li><a href=\''.$domain.'\' title=\'Home\'>Home</a></li>
				<li><a href=\''.$domain.'/index.php?action=mostplayed\' title=\'Most Played\'>Most Played</a></li>
				<li><a href=\''.$domain.'/index.php?action=newest\' title=\'Newest\'>Newest</a></li>
				<li><a href="'.$domain.'/index.php?action=memberslist" title="Member List">Member List</a></li>
				<li><a href=\''.$domain.'/index.php?action=search\' title=\'Search\'>Search</a></li>
				<li><a href=\''.$domain.'/index.php?action=links\' title=\'Links\'>Links</a></li>
				<li><a href=\''.$domain.'/index.php?action=contact\' title=\'Contact Us\'>Contact US</a></li>
				<li><a href=\''.$domain.'/index.php?action=fineprint\' title=\'Fine Print\'>Fine Print</a></li>';
				if(!isset($suserid)){
				$mymenu1 = '	<li ><a href=\''.$domain.'/index.php?action=login\'>Login</a></li>
					<li><a href=\''.$domain.'/index.php?action=forgotpassword\'>Forgot password?</a></li>
					<li ><a href=\''.$domain.'/index.php?action=signup\'>Signup</a></li>';
				}else{
				$mymenu1 = '
					<li ><a href=\''.$domain.'/index.php?action=myaccount\'>My Account</a></li>
					<li ><a href=\''.$domain.'/index.php?action=logout\'>Logout</a></li>';
				}
            if ($showpages == 1) { echo '<li ><a href=\''.$domain.'/index.php?action=pages\'>Pages</a></li>'; };
            if ($showblog == 1) { echo '<li ><a href=\''.$domain.'/index.php?action=blog\'>Blog</a></li>'; };

		echo '

			</ul>';
	}

	echo '	</div>';
		?>

			<br />

			<br />
		</td>
	</tr>
	<tr>
		<td valign="top" width="170" >
			<table width="170" >

				<tr>
					<td class="header2">Banner Exchanges</td>
				</tr>

				<tr>
					<td class="content2"><?php echo $bannersleft; ?></td>
				</tr>

				<tr>
					<td class="header2">My Menu</td>
				</tr>

				<tr>
					<td class="content2">
					<?php

					echo '<ul class=\'catmenu\'>';
                                     echo $mymenu1;
		                         if($usrdata['user_level'] == 2){echo '<li><a href=\''.$domain.'/index.php?action=admin\'>Admin</a></li>';

                                       };
                                     if($usrdata['gamelevel'] >= 2) {echo '<li><a href=\''.$domain.'/index.php?action=gameadmin\'>Game Admin</a></li>';};
                                     if($usrdata['bloglevel'] >= 2) {echo '<li><a href=\''.$domain.'/index.php?action=blogadmin\'>Blog Admin</a></li>';};
                                     echo '<p>';


                                     submenu1();

						echo '</ul>';
					?>
					</td>
				</tr>
			</table>


		<table width="100%">
                        <?php // submenu2 (); ?>

				<tr>
					<td class="header2">Ads</td>
				</tr>


				<tr>
					<td class="content2">


<?php echo $ads1; ?>
<p>
					</td>

				</tr>
			</table>
		</td>
		<td valign="top" width="560">





<?php
writebody();
?>







</td>
		<td valign="top" width="170">
		<table width="170">
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
					$rlinkx2 = "SELECT * FROM fas_links where activate = '2' " ;
                              $rlinkx1 = sqlcache('sitewidelinks', $cachelife, $rlinkx2);


					echo '<ul  class=\'catmenu\'>';
					foreach($rlinkx1 as $rlinkx){
						echo '<li><a href=\''.$rlinkx['url'].'\'>'.$rlinkx['title'].'</a></li>';
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
			$totalgames = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_games WHERE active="1"')));
			$totalusers = $db->num_rows($db->query(sprintf('SELECT userid FROM fas_users WHERE activation_key="0"')));
			$totalcats = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_categories')));
			$totalcomments = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_comments')));
			$time=time()-15*60;
			$onlineusers = $db->num_rows($db->query("SELECT userid FROM fas_users WHERE status >= $time"));
			$year = date('Y');

				$plays = mysql_query(sprintf('SELECT * FROM fas_gamestats'));

				while($rows = mysql_fetch_array($plays)){
					$totalplays = $rows['total_played'];
					$playstoday = $rows['played_today'];
	}
		?>
			<table width="100%">
				<tr>
					<td class="header2">Stats</td>
				</tr>
				<tr>
					<td class="content2" style="padding:5px">
					Total Games: <?php echo $totalgames; ?><br />
					Total Played: <?php echo $totalplays; ?><br />
					Plays Today: <?php echo $playstoday; ?><br />
					Total Users: <?php echo $totalusers; ?><br />
					Total Categories: <?php echo $totalcats; ?><br />
					Total Comments: <? echo $totalcomments; ?><br />
                              Total Hits: <?php include ("$directorypath/includes/counter.php"); ?><br />
					Users Online: <? echo $onlineusers; ?><p>
                              <a href="<?php echo $domain; ?>/rss-arcade.php"><img src="<? echo $domain; ?>/images/rss.gif"  border="0" ></img> RSS-Games</a><br />
                              <?php   if ($showblog == 1) { echo '<a href="'.$domain.'/rss-blog.php"><img src="'.$domain.'/images/rss.gif" border="0" ></img> RSS-Blog</a><br />' ; };

                              ?>

					</td>
				</tr>
			</table>
			<br />
			</td>	</tr></table><br />
<div align="center"><?php echo $footerspace; ?></div><br />
<! -- Please do not remove the "powered by" link unless, you've purchased the removal. -- >
<div align="center"> <?php echo "Copyright ".$sitename." &copy; 2008-".date('Y'); ?> All Rights Reserved - Powered By <a href="http://freearcadescript.net" target="_blank">Free Arcade Script</a>.</div> <br />
<?php echo $analytics; ?>
</body></html>
