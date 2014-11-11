<?php
if(!isset($_GET['action'])){
	$_GET['action'] = NULL;
}

//Create writebody function that inserts each page content into template
function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, 
$seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, 
$abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogcharactersshown, 
$blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $headerspace, 
$gamename, $fbcomments_on, $taf_on, $suserid;

//select the page based on the link
switch($_GET['action']){

	case 'submit':
	include ('templates/'.$template.'/submit.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'play':
	include ('templates/'.$template.'/play.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'mostplayed':
	include ('templates/'.$template.'/mostplayed.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'newest':
	include ('templates/'.$template.'/newest.php');
	include ('includes/arcadesubmenu.php');
	break;

    case 'messages':
    include ('templates/'.$template.'/messages.php');
	include ('includes/arcadesubmenu.php');
    break;

	case 'browse':
	include ('templates/'.$template.'/browse.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'forgotpassword':
	include ('templates/'.$template.'/forgot_pass.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'login':
	include ('templates/'.$template.'/login.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'signup':
	include ('templates/'.$template.'/signup.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'activate':
	include ('templates/'.$template.'/activate_account.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'activateemail':
	include ('templates/'.$template.'/activate_new_email.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'myaccount':
	include ('templates/'.$template.'/myaccount.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'logout':
	include ('templates/'.$template.'/logout.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'search':
	include ('templates/'.$template.'/search.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'report':
	include ('templates/'.$template.'/report.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'addtofavorites':
	include ('templates/'.$template.'/addtofavorites.php');
	include ('includes/arcadesubmenu.php');
	break;

    case 'memberslist':
    include ('templates/'.$template.'/memberslist.php');
	include ('includes/arcadesubmenu.php');
    break;

	case 'links':
	include ('templates/'.$template.'/links.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'showprofile':
	include ('templates/'.$template.'/showprofile.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'fineprint':
	include ('templates/'.$template.'/fineprint.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'contact':
	include ('templates/'.$template.'/contact.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'taf':
	include ('templates/'.$template.'/taf.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'blog':
	include ('templates/'.$template.'/blog.php');
	include ('includes/blogsubmenu.php');
	break;

	case 'blogcat':
	include ('templates/'.$template.'/blogcat.php');
	include ('includes/blogsubmenu.php');
	break;

	case 'blogentry':
	include ('templates/'.$template.'/blogentry.php');
	include ('includes/blogsubmenu.php');
	break;

	case 'showcomments':
	include ('templates/'.$template.'/showcomments.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'page':
	include ('templates/'.$template.'/page.php');
	include ('includes/arcadesubmenu.php');
	break;

	case 'pages':
	include ('templates/'.$template.'/pages.php');
	include ('includes/arcadesubmenu.php');
	break;

	default:
	include ('includes/arcadesubmenu.php');
	include ('templates/'.$template.'/base_home.php');
	
	break;

}
}

?>