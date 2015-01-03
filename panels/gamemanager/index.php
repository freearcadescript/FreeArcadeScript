<?php


function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $action;

if($usrdata['gamelevel'] ==  0 || $usrdata['gamelevel'] == 1){
	echo 'You are not game admin, therfore you can not access this part of the site.';	
}else{

if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}
	
switch($_GET['case']){
	default: 
	include ('gamehome.php');
	break;

	case 'addgame':
	include ($directorypath.'/panels/files/game/addgame.php');
	break;

	case 'managegames':
	include ($directorypath.'/panels/files/game/managegames.php');
	break;

	case 'addcategory':
	include ($directorypath.'/panels/files/game/addcategory.php');
	break;

	case 'managecategories':
	include ($directorypath.'/panels/files/game/managecategories.php');
	break;

	case 'approvecomments':
	include ($directorypath.'/panels/files/game/approvecomments.php');
	break;

	case 'testgame':
	include ($directorypath.'/panels/files/game/testgame.php');
	break;

	case 'reportedgames':
	include ($directorypath.'/panels/files/game/reportedgames.php');
	break;

	case 'managegamecomments':
	include ($directorypath.'/panels/files/game/managegamecomments.php');
	break;

}
}
};
include ('panels/gamemanager/template.php');
?>