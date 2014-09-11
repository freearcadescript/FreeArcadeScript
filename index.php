<?php
session_start();
include ('includes/functions.php');
include ('includes/core.php');
include('includes/rating_functions.php');
switch($_GET['action']){

	case 'play':
	include ('includes/arcadesubmenu.php');
	break;
	
	case 'mostplayed':
	include ('includes/arcadesubmenu.php');
	break;
	
	case 'newest':
	include ('includes/arcadesubmenu.php');
	break;

	
	case 'browse':
	include ('includes/arcadesubmenu.php');
	break;
	
	
	case 'myaccount':
	include ('includes/defaultsubmenu.php');
	break;
	
	
	break;
	case 'search':
	include ('includes/arcadesubmenu.php');
	break;
	
	case 'addtofavorites':
	include ('includes/arcadesubmenu.php');
	break;

	case 'blog':
	include ('includes/blogsubmenu.php');
	break;

	case 'blogcat':
	include ('includes/blogsubmenu.php');
	break;


	case 'blogentry':
	include ('includes/blogsubmenu.php');
	break;


	default: 
	include ('includes/defaultsubmenu.php');
	break;

	
}

include ('templates/'.$template.'/header.php');
switch($_GET['action']){

	case 'play':
	include ('pages/play.php');
	break;
	
	case 'mostplayed':
	include ('pages/mostplayed.php');
	break;
	
	case 'newest':
	include ('pages/newest.php');
	break;

      case 'messages':
      include ('pages/messages.php');
      break;

	
	case 'browse':
	include ('pages/browse.php');
	break;
	
	case 'login':
	include ('pages/login.php');
	break;
	
	case 'signup':
	include ('pages/signup.php');
	break;
	
	case 'myaccount':
	include ('pages/myaccount.php');
	break;
	
	case 'admin':
	include ('pages/admin/index.php');
	break;
	case 'blogadmin':
	include ('pages/blogadmin/index.php');
	break;
	
	case 'logout':
	session_destroy();
		echo '<div class=\'msg\'>You\'ve successfully logged out.</div>';
	break;
	case 'search':
	include ('pages/search.php');
	break;
	
	case 'addtofavorites':
	include ('pages/addtofavorites.php');
	break;

      case 'memberslist':
      include ('pages/memberslist.php');
      break;	


	case 'links':
	include ('pages/links.php');
	break;
	
	case 'showprofile':
	include ('pages/showprofile.php');
	break;
	
	case 'fineprint':
	include ('pages/fineprint.php');
	break;



	case 'userlist':
	include ('pages/userlist.php');
	break;
	

	case 'contact':
	include ('pages/contact.php');
	break;
	
	case 'taf':
	include ('pages/taf.php');
	break;
	

	case 'blog':
	include ('pages/blog.php');
	break;
	
	case 'blogcat':
	include ('pages/blogcat.php');
	break;
	

	case 'blogentry':
	include ('pages/blogentry.php');
	break;

	case 'showcomments':
	include ('pages/showcomments.php');
	break;
	




	default: 
	include ('pages/base_home.php');
	break;
	
}
echo '<title>'.$sitename.' - '.$pgname.'</title>';
include ('templates/'.$template.'/footer.php');

?>