<?php


function writebody() {
global $db, $set, $domain, $showpages, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





if($usrdata['user_level'] != 2){
	echo 'You are not admin, therfore you can not access this part of the site.';
	
}
else {
	
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




};	
};




};
$pagetitle = 'Admin Panel';
function writeheaders() { echo '

'; }
?>