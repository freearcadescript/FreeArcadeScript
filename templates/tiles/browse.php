<?php
function writebody() {
global $db, $domain, $suserid, $cachelife, $sponsor, $ads1, $ads2, $ads3, $bannersleft, $headerspace, $footerspace, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $fbcomments_on, $taf_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $avatar_on, $gender_on, $aimg, $fimg, $mimg, $seoheading, $seotext, $showpages;

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>';

$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$query = "SELECT Name FROM fas_categories WHERE ID=$ID";
$result = mysql_query($query);
$title = mysql_result($result, 0, "Name");
$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r2 = "SELECT * FROM fas_games WHERE category='$ID' && active='1' ORDER BY ID DESC LIMIT ".$limits.",".$max ;
$sqltitle = "browse-cat".$ID."page ".$show;
$r1 = sqlcache($sqltitle, $cachelife, $r2);
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE active=\'1\' and category=\''.$ID.'\''),0);
$totalpages = ceil($totalres / $max);

$count1 = 0;
if(!isset($r1)){
echo'<div id="content">
<div class="content_nav">'.$title.' Games</div>
<div align="center">There currently are no games in this category.</div></div>
</div></div>';
}else{
echo'<div id="content">
<div class="content_nav">'.$title.' Games</div>';
foreach($r1 as $in ){
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
$count1++;
}
echo '<div style="clear:both"></div><div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$pre.'.html';
	$next = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$ne.'';
	}
if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$i.'';
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
echo'</div>
</div></div></div>';
}
};

$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$m1 = mysql_query("SELECT * FROM fas_categories where ID='$ID' limit 1 ");

$m4 = mysql_fetch_row($m1) ;
$pagetitle = $m4[1];
$pagetitle .= ' games - Page '.$show ;
$metatags = $m4[2];
if ( $metatags == '' ) { $metatags = $m4[1]; };
$metadescription = $m4[3];
if ( $metadescription == '' ) { $metadescription = $pagetitle; } ;

?>