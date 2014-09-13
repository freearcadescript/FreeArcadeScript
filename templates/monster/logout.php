<?php
echo '<head>
<meta http-equiv="refresh" content="5; url='.$domain.'">
</head>';

function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $suserid;

$db->query("UPDATE fas_users SET status='0' WHERE `userid`='$suserid'");

session_destroy();
		echo '<div class=\'msg\'>You\'ve successfully logged out.
		<br><br>
		<a href=\''.$domain.'\' title=\'Home\'>Back to Arcade</a>
		</div>'; 


};
?>