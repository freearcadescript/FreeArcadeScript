<?php
if($usrdata['bloglevel'] ==  0 || $usrdata['bloglevel'] == 1){
	echo 'You are not blog admin, therfore you can not access this part of the site.';
	include ('templates/'.$template.'/footer.php');
	exit;
}

	
switch($_GET['case']){
	default: 
	include ('blogadminhome.php');
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
	
	
	

}	
$pgname = 'Blog Admin Panel';	
?>