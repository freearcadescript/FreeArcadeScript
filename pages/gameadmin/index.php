<?php


function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

if($usrdata['gamelevel'] ==  0 || $usrdata['gamelevel'] == 1){
	echo 'You are not game admin, therfore you can not access this part of the site.';	
}else{

if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}
	
switch($_GET['case']){
	default: 
	include ('managegames.php');
	break;
	
	case 'addgame':
	include ('addgame.php');
	break;
	
	case 'managegames':
	include ('managegames.php');
	break;
	
	case 'managecategories':
	include ('managecategories.php');
	break;
		
	case 'addcategory':
	include ('addcategory.php');
	break;
}
}
};
include ('pages/gameadmin/template.php');
?>