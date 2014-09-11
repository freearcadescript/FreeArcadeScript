<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title><?php echo $pagetitle; ?></title>
<head>
<meta name="keywords" content="<?php echo $metatags; ?>" />
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="<?=$domain?>/templates/bluegreen/style.css" rel="stylesheet" type="text/css">
<?php
include ("js/rating_update.php");

?>
</head>
<body>
<?php
      if (!$headerspace == "") { echo '<br><div align="center">'.$headerspace.'</div><br>'; }else{
echo "<br><br><br>";
}
?>
<table width="900" border="0" align="center" class="maintable" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
		<center><img src="<?=$domain?>/templates/bluegreen/images/logo.gif" /></center>
		
		<?php

		
	echo '	<div class=\'menutop\'>';
	if($seo_on == 1){
		echo '	<ul>
				<li><a href=\''.$domain.'\' title=\'Home\'>Home</a></li>
				<li><a href=\''.$domain.'/mostplayed/\' title=\'Most Played\'>Most Played</a></li>
				<li><a href=\''.$domain.'/newest/\' title=\'Newest\'>Newest</a></li><li><a href="'.$domain.'/memberslist/" title="Member List">Member List</a></li>
				<li><a href=\''.$domain.'/search/\' title=\'Search\'>Search</a></li>
				<li><a href=\''.$domain.'/links/\' title=\'Links\'>Links</a></li>
				<li><a href=\''.$domain.'/fineprint/\' title=\'Fine Print\'>Fine Print</a></li>

					';
				if(!isset($suserid)){
				$mymenu1 = '	<li ><a href=\''.$domain.'/login/\'>Login</a></li>
					<li ><a href=\''.$domain.'/signup/\'>Signup</a></li>';
				}else{
				$mymenu1 = '	
				<li ><a href=\''.$domain.'/myaccount/\'>My Account</a></li>
					<li ><a href=\''.$domain.'/logout/\'>Logout</a></li>';
				}
            if ($showblog == 1) { echo '<li><a href=\''.$domain.'/blog/\' title=\'blog\'>Blog</a></li>'; };

		echo '	
                  
	</ul>';
	}else{
		echo '	<ul>
				<li><a href=\''.$domain.'\' title=\'Home\'>Home</a></li>
				<li><a href=\''.$domain.'/index.php?action=mostplayed\' title=\'Most Played\'>Most Played</a></li>
				<li><a href=\''.$domain.'/index.php?action=newest\' title=\'Newest\'>Newest</a></li><li><a href="'.$domain.'/memberslist/" title="Member List">Member List</a></li>
				<li><a href=\''.$domain.'/index.php?action=search\' title=\'Search\'>Search</a></li>
				<li><a href=\''.$domain.'/index.php?action=links\' title=\'Links\'>Links</a></li>
				<li><a href=\''.$domain.'/index.php?action=fineprint\' title=\'Fine Print\'>Fine Print</a></li>
				';
				if(!isset($suserid)){
				$mymenu1 = '	<li ><a href=\''.$domain.'/index.php?action=login\'>Login</a></li>
					<li ><a href=\''.$domain.'/index.php?action=signup\'>Signup</a></li>';
				}else{
				$mymenu1 = '	
					<li ><a href=\''.$domain.'/index.php?action=myaccount\'>My Account</a></li>
					<li ><a href=\''.$domain.'/index.php?action=logout\'>Logout</a></li>';
				}	
            if ($showblog == 1) { echo '<li ><a href=\''.$domain.'/index.php?action=blog\'>Blog</a></li>'; };

		echo '	
                  
			</ul>';	
	}		







	echo '	</div>';
	
		?>
			<br />
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
                        <?php submenu2 (); ?>
                        
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
		<td valign="top" width="660">





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
					$rlinkx2 = "SELECT * FROM dd_links where activate = '2' " ;
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
			$totalgames = $db->num_rows($db->query(sprintf('SELECT ID FROM dd_games')));
			$totalusers = $db->num_rows($db->query(sprintf('SELECT userid FROM dd_users')));
			$totalcats = $db->num_rows($db->query(sprintf('SELECT ID FROM dd_categories')));
			$totalcomments = $db->num_rows($db->query(sprintf('SELECT ID FROM dd_comments')));
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
	<div align="center"> <?php echo "Copyright ".$sitename." &copy; 2008-".date('Y'); ?> All Rights Reserved - Powered By <a href="http://www.freearcadescript.net" target="_blank">Free Arcade Script</a> - Rating mod by <a href="http://www.boedesign.com" target="_blank">boedesign.com</a></div> <Br />
<?php echo $footerspace; ?>
</body></html>
