<?php
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo '<div class="nav">
	<div class="center">';
		if($seo_on == 1){
			echo '<ul>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/memberslist/">Members</a></li>
				<li><a href="'.$domain.'/fineprint/">Fine Print</a></li>
				<li><a href="'.$domain.'/contact/">Contact Us</a></li>
				<li><a href="'.$domain.'/links/">Links</a></li>';
       	    	if ($showpages == 1) { echo '<li><a href="'.$domain.'/pages/">Pages</a></li>'; };
       	    	if ($showblog == 1) { echo '<li><a href="'.$domain.'/blog/">Blog</a></li>'; };
			echo '</ul>';
		}else{
			echo '<ul>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/index.php?action=memberslist">Members</a></li>
				<li><a href="'.$domain.'/index.php?action=fineprint">Fine Print</a></li>
				<li><a href="'.$domain.'/index.php?action=contact">Contact Us</a></li>
				<li><a href="'.$domain.'/index.php?action=links">Links</a></li>';
    	   	    if ($showpages == 1) { echo '<li><a href="'.$domain.'/index.php?action=pages">Pages</a></li>'; };
    	   	    if ($showblog == 1) { echo '<li><a href="'.$domain.'/index.php?action=blog">Blog</a></li>'; };
			echo '</ul>';
		}
	echo '</div>
</div>
<div class="heading">
	<div class="center">
		<div class="logo">
			<a href="'.$domain.'"><img src="'.$domain.'/templates/'.$template.'/images/logo.png" alt="'.$sitename.'" width="270" height="80"/></a>
		</div>
		<div class="search">
			<form action="'.$su.'" method="post">
				<input onblur="if (value ==\'\') {value = \'Search...\'}" onfocus="if (value == \'Search...\') {value =\'\'}" type="text" name="keyword" style="width:150px" value="Search..." />
				<input class="button" type="submit" name="submit" value="Go" style="width:40px"/>
			</form>
		</div>
        <div class="socialmedia">';
if (!$socialmedia1 == "") { echo '<a href="'.$socialmedia1.'"><img src="'.$domain.'/images/icons/facebook.png" alt="FaceBook" width="16" height="16" /></a> '; };
if (!$socialmedia2 == "") { echo '<a href="'.$socialmedia2.'"><img src="'.$domain.'/images/icons/twitter.png" alt="Twitter" width="16" height="16" /></a> '; };
if (!$socialmedia3 == "") { echo '<a href="'.$socialmedia3.'"><img src="'.$domain.'/images/icons/googleplus.png" alt="Google Plus" width="16" height="16" /></a> '; };
if (!$socialmedia4 == "") { echo '<a href="'.$socialmedia4.'"><img src="'.$domain.'/images/icons/linkedin.png" alt="Linkedin" width="16" height="16" /></a> '; };
if (!$socialmedia5 == "") { echo '<a href="'.$socialmedia5.'"><img src="'.$domain.'/images/icons/pinterest.png" alt="Pinterest" width="16" height="16" /></a> '; };
if (!$socialmedia6 == "") { echo '<a href="'.$socialmedia6.'"><img src="'.$domain.'/images/icons/youtube.png" alt="You Tube" width="16" height="16" /></a> '; };
if (!$socialmedia7 == "") { echo '<a href="'.$socialmedia7.'"><img src="'.$domain.'/images/icons/myspace.png" alt="MySpace" width="16" height="16" /></a> '; };
if (!$socialmedia8 == "") { echo '<a href="'.$socialmedia8.'"><img src="'.$domain.'/images/icons/stumbleupon.png" alt="StumbleUpon" width="16" height="16" /></a> '; };
if (!$socialmedia9 == "") { echo '<a href="'.$socialmedia9.'"><img src="'.$domain.'/images/icons/digg.png" alt="Digg" width="16" height="16" /></a> '; };
if (!$socialmedia10 == "") { echo '<a href="'.$socialmedia10.'"><img src="'.$domain.'/images/icons/icon4.png" alt="" width="16" height="16" /></a> '; };
       echo '</div>
	</div>
</div>
<div class="navbottom">
	<div class="center">
		<ul>';
			$rci = $db->query('SELECT * FROM fas_categories WHERE active=\'1\'');
			while($row = $db->Fetch_row($rci)){
			//$numrws =$db->query(sprintf('SELECT ID FROM fas_games WHERE category=\'%u\' and active=\'1\'', $row['ID']));
			$categoryname = preg_replace('[^A-Za-z0-9]', '', $row['name']);
			if($seo_on == 1){
				$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categoryname.'.html';
			}else{
				$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
			}
			echo '<li><a href=\''.$categoryurl.'\'>'.$row['name'].'</a></li>';
						};
		echo'</ul>
	</div>
</div>';
?>