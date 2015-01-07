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

if(isset($_GET['css'])){
switch ($_GET['css']) {

case 'green':
$_SESSION['switchcss']="green.css";
break;

case 'red':
$_SESSION['switchcss']="red.css";
break;

case 'grey':
$_SESSION['switchcss']="grey.css";
break;

default:
$_SESSION['switchcss']="teal.css";

}
}else{
	$_SESSION['switchcss']="teal.css";
}

if(isset($suserid)){
mysql_query("UPDATE fas_users SET status=unix_timestamp() WHERE userid='$suserid'");
}

if ($_GET['action'] == 'admin' || $_GET['action'] == 'blogmanager' || $_GET['action'] == 'gamemanager'){
	switch($_GET['action']){

		case 'admin':
		$action = 'admin';
		include ('panels/admin/index.php');
		break;

		case 'blogmanager':
		$action = 'blogmanager';
		include ('panels/blogmanager/index.php');
		break;

		case 'gamemanager':
		$action = 'gamemanager';
		include ('panels/gamemanager/index.php');
		break;
	}
} else {
	include ('switch.php');
	include ('templates/'.$template.'/template.php');
};

?>