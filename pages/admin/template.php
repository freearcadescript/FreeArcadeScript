<?php
if($usrdata['user_level'] != 2){
	echo 'You are not admin, therfore you can not access this part of the site.';

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
$h = 'top';
$i = 'top';
$j = 'top';
$k = 'top';
$l = 'top';

switch($_GET['case']){
	default:
	$a = 'active';
	break;

	case 'settings':
	$b = 'active';
	break;

	case 'newsletter':
	$c = 'active';
	break;

	case 'managemembers':
	$d = 'active';
	break;

	case 'ads':
	$i = 'active';
	break;

	case 'addlink':
	$f = 'active';
	break;

	case 'managelinks':
	$f = 'active';
	break;

	case 'addgame':
	$e = 'active';
	break;

	case 'managegames':
	$e = 'active';
	break;

	case 'reportedgames':
	$k = 'active';
	break;

	case 'reportedcomments':
	$k = 'active';
	break;

	case 'addcategory':
	$e = 'active';
	break;

	case 'managecategories':
	$e = 'active';
	break;

	case 'approvecomments':
	$j = 'active';
	break;

	case 'testgame':
	$e = 'active';
	break;

	case 'blogentries':
	$h = 'active';
	break;

	case 'addblogcategory':
	$h = 'active';
	break;

	case 'manageblogcategories':
	$h = 'active';
	break;

	case 'approveblogcomments':
	$j = 'active';
	break;

	case 'pageentries':
	$g = 'active';
	break;

	case 'managepagecategories':
	$g = 'active';
	break;

	case 'addpagecategory':
	$g = 'active';
	break;

	case 'themes':
	$l = 'active';
	break;

	case 'managegamecomments':
	$j = 'active';
	break;

	case 'manageblogcomments':
	$j = 'active';
	break;
}

$gamereport = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_report_game'),0);
$commentreport = '0';
$totalreport = $commentreport + $gamereport;

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en-US"
      lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Administrative Panel</title>
	<link href="pages/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="center">
		<div class="arcade"></div>
		<div class="logo">
			<img src="pages/admin/img/logo.png" alt="logo" width="336" height="37" />
		</div>
	</div>
	<div id="nav">
		<div class="center">
   			<ul>
        		<li class="'.$a.'"><a href="'.$domain.'/index.php?action=admin">Home</a></li>
                <li class="'.$b.'"><a href="'.$domain.'/index.php?action=admin&case=settings">Settings</a></li>
				<li class="'.$c.'"><a href="'.$domain.'/index.php?action=admin&case=newsletter">News</a></li>
                <li class="'.$d.'"><a href="'.$domain.'/index.php?action=admin&case=managemembers">Users</a></li>
        		<li class="'.$e.'"><a href="'.$domain.'/index.php?action=admin&case=managegames">Games</a>
					<ul>
            			<li><a href="'.$domain.'/index.php?action=admin&case=managegames">Manage Games</a></li>
                        <li><a href="'.$domain.'/index.php?action=admin&case=managecategories">Manage Categories</a></li>
        			</ul>
				</li>
                <li class="'.$f.'"><a href="'.$domain.'/index.php?action=admin&case=managelinks">Links</a></li>
                <li class="'.$g.'"><a href="'.$domain.'/index.php?action=admin&case=pageentries">Pages</a>
					<ul>
            			<li><a href="'.$domain.'/index.php?action=admin&case=pageentries">Manage Pages</a></li>
                        <li><a href="'.$domain.'/index.php?action=admin&case=managepagecategories">Manage Categories</a></li>
        			</ul>
				</li>
                <li class="'.$h.'"><a href="'.$domain.'/index.php?action=admin&case=blogentries">Blogs</a>
					<ul>
            			<li><a href="'.$domain.'/index.php?action=admin&case=blogentries">Manage Blogs</a></li>
                        <li><a href="'.$domain.'/index.php?action=admin&case=manageblogcategories">Manage Categories</a></li>
        			</ul>
				</li>
                <li class="'.$i.'"><a href="'.$domain.'/index.php?action=admin&case=ads">Ads</a></li>
        		<li class="'.$j.'"><a href="'.$domain.'/index.php?action=admin&case=approvecomments">Comments</a>
        			<ul>
            			<li><a href="'.$domain.'/index.php?action=admin&case=approvecomments">Game Comments</a></li>
                        <li><a href="'.$domain.'/index.php?action=admin&case=approveblogcomments">Blog Comments</a></li>
        			</ul>
        		</li>
        		<li class="'.$k.'"><a href="'.$domain.'/index.php?action=admin&case=reportedgames">Reports ('.$totalreport.')</a>
        			<ul>
           				<li><a href="'.$domain.'/index.php?action=admin&case=reportedgames">Game Reports ('.$gamereport.')</a></li>
            			<li><a href="'.$domain.'/index.php?action=admin&case=reportedcomments">Comment Reports ('.$commentreport.')</a></li>
        			</ul>
        		</li>
				<li class="'.$l.'"><a href="'.$domain.'" target="_blank">View Site</a></li>
    		</ul>
		</div>
	</div>
    <div class="nav-yellow">
    </div>
	<div class="center">
        <div class="main">';
			writebody();
		echo'</div>
		<br /><div align="center"><a href="http://freearcadescript.net/forums/index.php?action=forum">Support Forums</a>
		<br />Powered by <a href="http://freearcadescript.net/">Free Arcade Script</a></div>
	</div>
</body>
</html>';
}
?>