<?php
function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $action;

if($usrdata['bloglevel'] ==  0 || $usrdata['bloglevel'] == 1){
	echo 'You are not blog admin, therfore you can not access this part of the site.';
}else{

if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}

switch($_GET['case']){
	default:
	include ('bloghome.php');
	break;

	case 'blogentries':
	include ($directorypath.'/panels/files/blog/blogentries.php');
	break;

	case 'addblogcategory':
	include ($directorypath.'/panels/files/blog/addblogcategory.php');
	break;

	case 'manageblogcategories':
	include ($directorypath.'/panels/files/blog/manageblogcategories.php');
	break;

	case 'approveblogcomments':
	include ($directorypath.'/panels/files/blog/approveblogcomments.php');
	break;

	case 'manageblogcomments':
	include ($directorypath.'/panels/files/blog/manageblogcomments.php');
	break;

	case 'reportedcomments':
	include ($directorypath.'/panels/files/blog/reportedcomments.php');
	break;
	
}
}
};
include ('panels/blogmanager/template.php');
?>