<?php

function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $con1, $suserid, $userid, $userdata, $usrdata, $showpages;



if(!isset($suserid)){
	echo'<div id="container">
        <div id="content-container">
        <div id="side">';
        include("includes/blocks.php");
        echo'</div>

        <div id="content">';
	echo '<div class=\'error\'>Please login first.</div>';
        echo'</div></div></div>';
	return;
}
	$ID = clean($_GET['cmd']);
	$ID = abs((int) ($ID));
	
	$db->query(sprintf('INSERT INTO fas_user_favorites SET
					userid=\'%u\',
					gameid=\'%u\'', $suserid, $ID));
	echo'<div id="container">
        <div id="content-container">
        <div id="side">';
        include("includes/blocks.php");
        echo'</div>

        <div id="content">
        <div class="content_nav">Favorite Games</div>';
	echo '<div class=\'msg\'>Game added to your favorites.</div>';
        echo'</div></div></div>';

	$pgname = 'Add to favorites';

};
?>