<?php
if($usrdata['gamelevel'] ==  0 || $usrdata['gamelevel'] == 1){
	echo 'You are not game admin, therfore you can not access this part of the site.';

}else{
if (!isset($_GET['case'])){
	$_GET['case'] = NULL;
}

$a = 'top';
$b = 'top';
$c = 'top';
$d = 'top';
$e = 'top';
$f = 'top';
$g = 'top';

switch($_GET['case']){
	default:
	$a = 'active';
	break;

	case 'managegames':
	$b = 'active';
	break;

	case 'addgame':
	$b = 'active';
	break;

	case 'testgame':
	$b = 'active';
	break;

	case 'managecategories':
	$c = 'active';
	break;

	case 'addcategory':
	$c = 'active';
	break;

	case 'reportedgames':
	$d = 'active';
	break;

	case 'managegamecomments':
	$e = 'active';
	break;

	case 'approvecomments':
	$e = 'active';
	break;

	case 'reportedcomments':
	$e = 'active';
	break;

}

$gamereport = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_report_game'),0);
$commentreport = '0';
$totalreport = $gamereport;

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Game Panel</title>
	<link href="panels/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="center">
		<div class="arcade"></div>
		<div class="logo">
			<h1>'.$sitename.' - Game Control Panel</h1>
		</div>
	</div>
	<div id="nav">
		<div class="center">
   			<ul>
   				<li class="'.$a.'"><a href=\''.$domain.'/index.php?action=gamemanager\'>Home</a></li>
				<li class="'.$b.'"><a href=\''.$domain.'/index.php?action=gamemanager&case=managegames\'>Games</a></li>
				<li class="'.$c.'"><a href=\''.$domain.'/index.php?action=gamemanager&case=managecategories\'>Categories</a></li>
                <li class="'.$d.'"><a href="'.$domain.'/index.php?action=gamemanager&case=reportedgames">Reports ('.$totalreport.')</a></li>
                <li class="'.$e.'"><a href="'.$domain.'/index.php?action=gamemanager&case=approvecomments">Comments</a>
                	<ul>
            			<li><a href="'.$domain.'/index.php?action=gamemanager&case=approvecomments">Approve Comments</a></li>
                        <li><a href="'.$domain.'/index.php?action=gamemanager&case=managegamecomments">Manage Comments</a></li>
        			</ul>
        		</li>	
				<li class="'.$f.'"><a href="'.$domain.'" target="_blank">View Site</a></li>
			</ul>
		</div>
	</div>
    <div class="nav-yellow">
    </div>
	<div class="center">
        <div class="main">';
			writebody();
		echo'</div>
	       <div id="footerlinks"><a href="http://freearcadescript.net/forums/index.php?action=forum">Support Forums</a>
		<br />Powered by <a href="http://freearcadescript.net/">Free Arcade Script</a></div><br />
	</div>
</body>
</html>';
}
?>