<?php
session_start();
// date_default_timezone_set('America/Chicago');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

include ('includes/functions.php');
include ('includes/core.php');
include('includes/rating_functions.php');

if($suserid){
mysql_query("UPDATE fas_users SET status=unix_timestamp() WHERE userid='$suserid'");
}

switch($_GET['action']){

	case 'play':
	include ('templates/'.$template.'/play.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;
	
	case 'mostplayed':
	include ('templates/'.$template.'/mostplayed.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;
	
	case 'newest':
	include ('templates/'.$template.'/newest.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;

        case 'messages':
        include ('templates/'.$template.'/messages.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
        break;

	case 'browse':
	include ('templates/'.$template.'/browse.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;
	
	case 'forgotpassword':
	include ('templates/'.$template.'/forgot_pass.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;

	case 'login':
	include ('templates/'.$template.'/login_emailcheck.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'signup':
	include ('templates/'.$template.'/signup_emailcheck.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'activate':
	include ('templates/'.$template.'/activate_account.php');
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'activateemail':
	include ('templates/'.$template.'/activate_new_email.php');
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'myaccount':
	include ('templates/'.$template.'/myaccount.php');
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'admin':
	include ('pages/admin/index.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'blogadmin':
	include ('pages/blogadmin/index.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'gameadmin':
	include ('pages/gameadmin/index.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'logout':
	include ('templates/'.$template.'/logout.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'search':
	include ('templates/'.$template.'/search.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;
	
	case 'addtofavorites':
	include ('templates/'.$template.'/addtofavorites.php');
	include ('includes/arcadesubmenu.php');
	include ('includes/arcadesubmenu2.php');
	break;

        case 'memberslist':
        include ('templates/'.$template.'/memberslist.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
        break;	

	case 'links':
	include ('templates/'.$template.'/links.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'showprofile':
	include ('templates/'.$template.'/showprofile.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'fineprint':
	include ('templates/'.$template.'/fineprint.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'userlist':
	include ('templates/'.$template.'/userlist.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'contact':
	include ('templates/'.$template.'/contact.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'taf':
	include ('templates/'.$template.'/taf.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'blog':
	include ('templates/'.$template.'/blog.php');
	include ('includes/blogsubmenu.php');
	include ('includes/blogsubmenu2.php');
	break;
	
	case 'blogcat':
	include ('templates/'.$template.'/blogcat.php');
	include ('includes/blogsubmenu.php');
	include ('includes/blogsubmenu2.php');
	break;
	
	case 'blogentry':
	include ('templates/'.$template.'/blogentry.php');
	include ('includes/blogsubmenu.php');
	include ('includes/blogsubmenu2.php');
	break;

	case 'showcomments':
	include ('templates/'.$template.'/showcomments.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
	case 'page':
	include ('templates/'.$template.'/page.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	case 'pages':
	include ('templates/'.$template.'/pages.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;

	default: 
	include ('templates/'.$template.'/base_home.php'); 
	include ('includes/defaultsubmenu.php'); 
	include ('includes/defaultsubmenu2.php');
	break;
	
}

if ($_GET['action'] == 'admin' || $_GET['action'] == 'blogadmin' || $_GET['action'] == 'gameadmin') {/*Do Nothing*/} else {
include ('templates/'.$template.'/template.php');
};
?>
