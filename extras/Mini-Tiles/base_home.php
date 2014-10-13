<?php

$pagetitle = $sitename;

function writebody() {
global $db, $domain, $suserid, $cachelife, $ir, $ir2, $r, $cname, $sponsor, $ads1, $ads2, $ads3, $bannersleft, $headerspace, $footerspace, $ID, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $fbcomments_on, $taf_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $avatar_on, $gender_on, $aimg, $fimg, $mimg, $seoheading, $seotext, $showpages, $slogan;

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Latest Games</div>';
                $max = $gamesonpage;
                if(!isset($_GET['page'])){
	        $show = '1';
                }else{
	        $show = clean($_GET['page']);
                }
                $limits = ($show - 1) * $max;
		$sqltitle='homepage' ;
		$baseir2 = "SELECT * FROM fas_games WHERE active='1' ORDER BY ID DESC LIMIT ".$limits.",".$max ;
		$baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);
		if(isset($baseir1)){
	      	foreach($baseir1 as $row1 ){
                $gamename = preg_replace('#\W#', '-', $row1['name']);
	      	if($seo_on == 1){
	      		$playlink = '/play/'.$row1['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = '/index.php?action=play&amp;ID='.$row1['ID'].'';
	      	}
	      	echo '<div id="game_holder"><a href=\''.$playlink.'\'>';
		if($row1['type'] == 1){
		echo '<div align="center"><img src=\'/'.$thumbsfolder.'/'.$row1['thumb'].'\' width=\'90\' height=\'90\' alt= \''.$row1['name'].'\' title= \''.$row1['name'].'\' border=\'0px\' class=\'game_img\' /></a><br />';
		}else{
		echo '<div align="center"><img src=\''.$row1['thumburl'].'\' width=\'90\' height=\'90\' alt= \''.$row1['name'].'\' title= \''.$row1['name'].'\' border=\'0px\' class=\'game_img\' /></a><br />';
		}

		echo '</div></div>';
	      	};

				}else{
					echo'<div align="center">
						No games have been added yet!
					</div>';
				}
echo'</div></div></div>';




$pgname = 'Your resource for fantastic games!';
};
?>