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

	case 'managecategories':
	$b = 'active';
	break;

	case 'addgame':
	$c = 'active';
	break;

	case 'addcategory':
	$d = 'active';
	break;

	case 'reportedgames':
	$e = 'active';
	break;

	case 'managegamecomments':
	$f = 'active';
	break;
}

$gamereport = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_report_game'),0);
$commentreport = '0';
$totalreport = $gamereport;

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administrative Panel</title>
	<link href="pages/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="center">
		<div class="arcade"></div>
		<div class="logo">
			<h1>'.$sitename.' - Game Admin Control Panel</h1>
		</div>
	</div>
	<div id="nav">
		<div class="center">
   			<ul>
				<li class="'.$a.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=managegames\'>Manage Games</a></li>
				<li class="'.$b.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=managecategories\'>Manage Categories</a></li>
				<li class="'.$c.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=addgame\'>Add Game</a></li>
				<li class="'.$d.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=addcategory\'>Add Category</a></li>
                <li class="'.$e.'"><a href="'.$domain.'/index.php?action=gameadmin&case=reportedgames">Reports ('.$totalreport.')</a></li>
                <li class="'.$f.'"><a href="'.$domain.'/index.php?action=gameadmin&case=managegamecomments">Manage Comments</a></li>
				<li class="'.$g.'"><a href="'.$domain.'" target="_blank">View Site</a></li>
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