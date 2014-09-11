<?php
if($usrdata['user_level'] != 2){
	echo 'You are not admin, therfore you can not access this part of the site.';
	include ('templates/'.$template.'/footer.php');
	exit;
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
	
	case 'managemembers':
	include ('managemembers.php');
	break;

	case 'newsletter':
	include ('newsletter.php');
	break;
	

}	
$pgname = 'Admin Panel';	
?>