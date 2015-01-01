<?php
function writebody() {
global $db, $set, $domain, $showpages, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $fbcomments_on, $taf_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $avatar_on, $gender_on, $aimg, $fimg, $mimg, $email_on, $tzone, $action;

if($usrdata['user_level'] != 2){
	echo 'You are not admin, therfore you can not access this part of the site.';

}else{
if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}

switch($_GET['case']){
	default:
	include ('adminhome.php');
	break;

	case 'fasnews':
	include ('fasnews.php');
	break;

	case 'addlink':
	include ('addlink.php');
	break;

	case 'managelinks':
	include ('managelinks.php');
	break;

	case 'settings':
	include ('settings.php');
	break;

	case 'ads':
	include ('ads.php');
	break;

	case 'managemembers':
	include ('managemembers.php');
	break;

	case 'newsletter':
	include ('newsletter.php');
	break;

	case 'pageentries':
	include ('pageentries.php');
	break;

	case 'managepagecategories':
	include ('managepagecategories.php');
	break;

	case 'addpagecategory':
	include ('addpagecategory.php');
	break;

	case 'themes':
	include ('themes.php');
	break;

	case 'socialmedia':
	include ('socialmedia.php');
	break;
	
	case 'managegamefeeds':
	include ('managegamefeeds.php');
	break;

	case 'manageagf':
	include ('manageagf.php');
	break;

	//shared game files

	case 'addgame':
	include ($directorypath.'/panels/sharedfiles/game/addgame.php');
	break;

	case 'managegames':
	include ($directorypath.'/panels/sharedfiles/game/managegames.php');
	break;

	case 'addcategory':
	include ($directorypath.'/panels/sharedfiles/game/addcategory.php');
	break;

	case 'managecategories':
	include ($directorypath.'/panels/sharedfiles/game/managecategories.php');
	break;

	case 'approvecomments':
	include ($directorypath.'/panels/sharedfiles/game/approvecomments.php');
	break;

	case 'testgame':
	include ($directorypath.'/panels/sharedfiles/game/testgame.php');
	break;

	case 'reportedgames':
	include ($directorypath.'/panels/sharedfiles/game/reportedgames.php');
	break;

	case 'managegamecomments':
	include ($directorypath.'/panels/sharedfiles/game/managegamecomments.php');
	break;


	//shared blog files
	case 'reportedcomments':
	include ($directorypath.'/panels/sharedfiles/blog/reportedcomments.php');
	break;

	case 'blogentries':
	include ($directorypath.'/panels/sharedfiles/blog/blogentries.php');
	break;

	case 'addblogcategory':
	include ($directorypath.'/panels/sharedfiles/blog/addblogcategory.php');
	break;

	case 'manageblogcategories':
	include ($directorypath.'/panels/sharedfiles/blog/manageblogcategories.php');
	break;

	case 'approveblogcomments':
	include ($directorypath.'/panels/sharedfiles/blog/approveblogcomments.php');
	break;

	case 'manageblogcomments':
	include ($directorypath.'/panels/sharedfiles/blog/manageblogcomments.php');
	break;

};
};
};
$pagetitle = 'Admin Panel';
function writeheaders() { echo '

'; }

include ('panels/admin/template.php');
?>
