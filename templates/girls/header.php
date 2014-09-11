<html>
<head>
<meta name="keywords" content="flash games,free flash games,games,arcade games¸sonic,nintendo,online" />
<meta name="description" content="Take a break play some free games,facebook games" />
<link href="<?=$domain?>/templates/default/styles.css" rel="stylesheet" type="text/css">
<?php
include ("js/rating_update.php");

?>
</head>
<body>
<table width="900" border="0" align="center" class="maintable" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
		<img src="<?=$domain?>/templates/default/images/banner.png" width="900"></img>
		
		<?php

      if (!$headerspace == "") { echo '<br><div align="center">'.$headerspace.'</div><br>'; };

		
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
			<table width="100%" >
				
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
                                     if($usrdata['bloglevel'] >= 2) {echo '<li><a href=\''.$domain.'/index.php?action=blogadmin\'>Blog Admin</a></li>';};
                                     echo '<p>';


                                     submenu1();						
						
						echo '</ul>';
					?>
					</td>
				</tr>
			</table>
		

		<table width="100%">
				<tr>
					<td class="header2">Top Users</td>
				</tr>

				<tr>
					<td class="content2">
			
					<?php
					echo '<ul class=\'catmenu\'>';
					
					$tur = $db->query('SELECT username, userid, plays FROM fas_users ORDER BY plays DESC LIMIT 0,15');
					while($r = $db->fetch_row($tur)){
					echo '
						<li>'.$r['username'].' - ('.$r['plays'].')</li>';
					}
					echo '
			
				</ul>';
					?>
<p>

					</td>

				</tr>

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