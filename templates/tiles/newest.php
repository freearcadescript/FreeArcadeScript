<?php
function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $suserid, $usrdata, $userid, $showpages;

$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);	
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf('SELECT * FROM fas_games WHERE `active`=\'1\' ORDER BY dateadded DESC LIMIT '.$limits.','.$max.' '));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE `active`="1"'),0);	
$totalpages = ceil($totalres / $max); 

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>';

echo '<div id="content">';
$count = 0;
echo'<div class="content_nav">Newest Games</div>';
while($in = $db->fetch_row($r)){
        $gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
		echo '<div id="game_holder">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<div align="center"><img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" title="'.$gamename.'" width="150" height="100" />';
					}else{
						echo'<div align="center"><img src="'.$in['thumburl'].'" alt="'.$gamename.'" title="'.$gamename.'" width="150" height="100" />';
					}
				echo'</a><br /><a href=\''.$playlink.'\'><h2>'.titlelimit($in['name']).'</h2></a>
			</div>';
			echo'</div>';
//$count1++;
}
echo '<div style="clear:both"></div>
<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/newest/page'.$pre.'.html';
	$next = ''.$domain.'/newest/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=newest&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=newest&page='.$ne.'';
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
					$urk = ''.$domain.'/newest/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=newest&page='.$i.'';
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
echo'</div></div>
</div></div>';
};

$pagetitle = $sitename.' - Newest Games';
$metatags = 'new games, latest games, newest games';
$metadescription = $sitename.' newest Games';

?>