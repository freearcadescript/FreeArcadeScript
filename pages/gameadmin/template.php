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
}

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administrative Panel</title>
	<link href="pages/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="center">
		<div class="arcade">
			<a href="'.$domain.'"><img src="pages/admin/img/home.png" width="24" height="24" alt="arcade" title="Arcade" /></a>
		</div>
		<div class="logo">
			<img src="pages/admin/img/logo.png" alt="logo" width="336" height="37" />
		</div>
	</div>
	<div id="nav">
		<div class="center">
   			<ul>
				<li class="'.$a.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=managegames\'>Manage Games</a></li>
				<li class="'.$b.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=managecategories\'>Manage Categories</a></li>
				<li class="'.$c.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=addgame\'>Add Game</a></li>
				<li class="'.$d.'"><a href=\''.$domain.'/index.php?action=gameadmin&case=addcategory\'>Add Category</a></li>
			</ul>
		</div>
	</div>
    <div class="nav-yellow">
    </div>
	<div class="center">
        <div class="main">';
			writebody();
		echo'</div>
	</div>      
</body>
</html>';
}
?>