<?php
function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

if($usrdata['bloglevel'] ==  0 || $usrdata['bloglevel'] == 1){
	echo 'You are not blog admin, therfore you can not access this part of the site.';
}else{

if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}

switch($_GET['case']){
	default:
	include ('blogentries.php');
	break;

	case 'blogentries':
	include ('blogentries.php');
	break;

	case 'addblogcategory':
	include ('addblogcategory.php');
	break;

	case 'manageblogcategories':
	include ('manageblogcategories.php');
	break;

	case 'approveblogcomments':
	include ('approveblogcomments.php');
	break;

	case 'manageblogcomments':
	include ('manageblogcomments.php');
	break;

	case 'reportedcomments':
	include ('reportedcomments.php');
	break;
}
}
};
include ('pages/blogadmin/template.php');
?>