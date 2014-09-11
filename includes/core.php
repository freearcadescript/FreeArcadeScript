<?php
if($_GET['template']){
	exit('N00B.');
}
include ('config.php');
global $_CONFIG;
include_once ('db.class.php');
$db=new database;
$db->configure(
	$dbhost, 
	$dbuser, 
	$dbpass, 
	$dbname, 
	$dbpre
	);
$db->connect();
$set = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_settings')));
$domain = $set['domain'];
$directorypath = $set['directorypath'];
$template = $set['template'];
$gamesfolder = $set['gamesfolder'];
$thumbsfolder = $set['thumbsfolder'];
$limitboxgames = $set['limitboxgames'];
$comments_on = $set['comments_on'];
$autoapprovecomments = $set['autoapprovecomments'];
$seo_on = $set['seo_on'];
$sitename = $set['sitename'];
$gamesonpage = $set['gamesonpage'];
$enabledcode_on = $set['enabledcode_on'];
$bannersleft = $set['bannersleft'];
$bannersright = $set['bannersright'];
$ads1 = $set['ads1'];
$ads2 = $set['ads2'];
$ads3 = $set['ads3'];
$headerspace = $set['headerspace'];
$footerspace = $set['footerspace'];
$abovegames = $set['abovegames'];
$belowgames = $set['belowgames'];
$showwebsitelimit = $set['showwebsitelimit'];
$supportemail = $set['supportemail'];

$showblog = $set['showblog'];
$blogentriesshown = $set['blogentriesshown'];
$blogcharactersshown = $set['blogcharactersshown'];
$blogcommentpermissions = $set['blogcommentpermissions'];
$blogcommentsshown = $set['blogcommentsshown'];
$blogfollowtags = $set['blogfollowtags'];
$blogcharactersrss = $set['blogcharactersrss'];
	


if(isset($_SESSION['userid'])){
	$suserid = $_SESSION['userid'];
	$usrdata = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_users WHERE userid=\'%u\'', $suserid)));
}
?>