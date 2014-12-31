<?php
function writebody() {
global $db, $set, $domain, $showpages, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $fbcomments_on, $taf_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $avatar_on, $gender_on, $aimg, $fimg, $mimg, $email_on, $tzone;

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

	case 'addgame':
	include ('addgame.php');
	break;

	case 'managegames':
	include ('managegames.php');
	break;

	case 'addcategory':
	include ('addcategory.php');
	break;

	case 'managecategories':
	include ('managecategories.php');
	break;

	case 'addlink':
	include ('addlink.php');
	break;

	case 'managelinks':
	include ('managelinks.php');
	break;

	case 'approvecomments':
	include ('approvecomments.php');
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

	case 'testgame':
	include ('testgame.php');
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

	case 'reportedgames':
	include ('reportedgames.php');
	break;

	case 'reportedcomments':
	include ('reportedcomments.php');
	break;

	case 'themes':
	include ('themes.php');
	break;

	case 'managegamecomments':
	include ('managegamecomments.php');
	break;

	case 'manageblogcomments':
	include ('manageblogcomments.php');
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

};
};
};
$pagetitle = 'Admin Panel';
function writeheaders() { echo '

'; }

include ('pages/admin/template.php');
?>
