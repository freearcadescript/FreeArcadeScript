<?php
session_start();
date_default_timezone_set('America/Chicago');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

if(!isset($_GET['action'])){
	$_GET['action'] = NULL;
}

include ('includes/functions.php');
include ('includes/core.php');
include ('includes/rating_functions.php');
include ('includes/reset.php');


if(isset($suserid)){
mysql_query("UPDATE fas_users SET status=unix_timestamp() WHERE userid='$suserid'");
}

if ($_GET['action'] == 'admin' || $_GET['action'] == 'blogadmin' || $_GET['action'] == 'gameadmin'){
	switch($_GET['action']){

		case 'admin':
		include ('pages/admin/index.php');
		break;

		case 'blogadmin':
		include ('pages/blogadmin/index.php');
		break;

		case 'gameadmin':
		include ('pages/gameadmin/index.php');
		break;
	}
} else {
	include ('switch.php');
	include ('templates/'.$template.'/template.php');
};

?>