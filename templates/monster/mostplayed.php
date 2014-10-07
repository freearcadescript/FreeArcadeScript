<?php
function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

$max = $gamesonpage;
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max;
$r = $db->query(sprintf('SELECT * FROM fas_games WHERE `active`=\'1\' ORDER BY views DESC LIMIT '.$limits.','.$max.' '));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE `active`=\'1\''),0);
$totalpages = ceil($totalres / $max);
echo '<div class="header2">Top Games</div>';
$count = 0;
echo'<div class="content2">';
while($in = $db->fetch_row($r)){
	$gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
	if($count%2==0){
		echo '<div class="home_category">
			<div class="home_img">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" class="home_img" />';
					}else{
						echo'<img src="'.$in['thumburl'].'" alt="'.$gamename.'" class="home_img" />';
					}
				echo'</a>
			</div>
			<div class="home_info">
				<div class="home_title"><a href=\''.$playlink.'\'>'.titlelimit($in['name']).'</a></div>
				<div class="home_desc">'.desclimit($in['description']).'</div>';
				if($usrdata['user_level'] == 2){
					echo'<div style="float: right; vertical-align: top; padding-right: 20px;">
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=edit&amp;ID='.$in['ID'].'&amp;type='.$in['type'].'\' onclick="return confirm(\'Are you sure you want to edit the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/edit.png\' title=\'edit game\' alt=\'edit game\' border=\'0\' /></a>
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=delete&amp;ID='.$in['ID'].'\' onclick="return confirm(\'Are you sure you want to delete the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/delete.png\' title=\'delete game\' alt=\'delete game\' border=\'0\' /></a>
					</div>';
				}
			echo'</div>
		</div>';
	}else{
		echo'<div class="home_wrap">
			<div class="home_img">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" class="home_img" />';
					}else{
						echo'<img src="'.$in['thumburl'].'\' alt=\''.$gamename.'" class="home_img" />';
					}
				echo'</a>
			</div>
			<div class="home_info">
				<div class="home_title"><a href="'.$playlink.'">'.titlelimit($in['name']).'</a></div>
				<div class="home_desc">'.desclimit($in['description']).'</div>';
					if($usrdata['user_level'] == 2){
						echo'<div style="float: right; vertical-align: top; padding-right: 20px;">
							<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=edit&amp;ID='.$in['ID'].'&amp;type='.$in['type'].'\' onclick="return confirm(\'Are you sure you want to edit the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/edit.png\' title=\'edit game\' alt=\'edit game\' border=\'0\' /></a>
							<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=delete&amp;ID='.$in['ID'].'\' onclick="return confirm(\'Are you sure you want to delete the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/delete.png\' title=\'delete game\' alt=\'delete game\' border=\'0\' /></a>
						</div>';
					}
			echo'</div>
		</div>';
}
$count++;
}
echo '</div>
<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = $urk = ''.$domain.'/mostplayed/page'.$pre.'.html';
	$next = $urk = ''.$domain.'/mostplayed/page'.$ne.'.html';
}else{
	$previous = $urk = ''.$domain.'/index.php?action=mostplayed&page='.$pre.'';
	$next = $urk = ''.$domain.'/index.php?action=mostplayed&page='.$ne.'';
	}
if ($totalpages != '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/mostplayed/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=mostplayed&page='.$i.'';
				}

				if($show == $i){
					echo '<a href="'.$urk.'" class="page-select">'.$i.'</a>';
				}else{
					echo '<a href="'.$urk.'" class="page">'.$i.'</a>';
				}
			}
		}
	}
	if ($show < $totalpages){
		echo '<a href="'.$next.'" class="page">Next</a>';
	}
}
echo'</div>';
};

$pagetitle = $sitename.' - Most Played Games';
$metatags = 'most played games, popular games';
$metadescription = $sitename.' most played games';

?>