<?php
echo '<head>
<meta http-equiv="refresh" content="5; url='.$domain.'">
</head>';

function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $suserid, $showpages;

$db->query("UPDATE fas_users SET status='0' WHERE `userid`='$suserid'");

session_destroy();

                echo'<div id="container">
                <div id="content-container">
                <div id="side">';
                include("includes/blocks.php");
                echo'</div>

                <div id="content">';
		echo '<div class=\'msg\'>You\'ve successfully logged out.
		<br><br>
		<a href=\''.$domain.'\' title=\'Home\'>Back to Arcade</a>
		</div>'; 
                echo'</div></div>';


};
?>