<?php
include ('includes/config.php');
global $_CONFIG;
include_once ('includes/db.class.php');
$db=new database;
$db->configure(
	$dbhost,
	$dbuser,
	$dbpass,
	$dbname,
	$dbpre
	);
$db->connect();
// $set = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_settings')));
//ALTER TABLE dd_users ADD template VARCHAR(250) AFTER plays;



if(isset($_SESSION['userid'])){
	$suserid = $_SESSION['userid'];
	$usrdata = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_users WHERE userid=\'%u\'', $suserid)));
}else{
	$suserid = NULL;
	$usrdata = NULL;
}

if(isset($suserid)){
	$query = mysql_query("SELECT `template` FROM `fas_users` WHERE `userid`='$suserid'");
	$row = mysql_fetch_array($query);
	$user_template = $row['template'];
}else{
	$user_template = '';
}

if(!empty($user_template) && $user_template != "default"){
	$template = $user_template;
}else{
	$query = mysql_query("SELECT `template` FROM `fas_themes` WHERE `default`='1'");
	$row = mysql_fetch_array($query);
	$template = $row['template'];
}

$set2 = "SELECT * FROM fas_settings" ;
$set1 = sqlcache('sitesettings', '1', $set2);
foreach($set1 as $set){
	$domain = $set['domain'];
	$directorypath = $set['directorypath'];
	$slogan = $set['slogan'];
	$gamesfolder = $set['gamesfolder'];
	$thumbsfolder = $set['thumbsfolder'];
	$limitboxgames = $set['limitboxgames'];
	$email_on = $set['email_on'];
	$comments_on = $set['comments_on'];
	$taf_on = $set['taf_on'];
	$fbcomments_on = $set['fbcomments_on'];
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
	$analytics = $set['analytics'];
	$socialmedia1 = $set['socialmedia1'];
	$socialmedia2 = $set['socialmedia2'];
	$socialmedia3 = $set['socialmedia3'];
	$socialmedia4 = $set['socialmedia4'];
	$socialmedia5 = $set['socialmedia5'];
	$socialmedia6 = $set['socialmedia6'];
	$socialmedia7 = $set['socialmedia7'];
	$socialmedia8 = $set['socialmedia8'];
	$socialmedia9 = $set['socialmedia9'];
	$socialmedia10 = $set['socialmedia10'];
	$facebookappid = $set['facebookappid'];
	$showwebsitelimit = $set['showwebsitelimit'];
	$supportemail = $set['supportemail'];
	$avatar_on = $set['avatar_on'];
	$aimg = $set['aimg'];
	$gender_on = $set['gender_on'];
	$mimg = $set['mimg'];
	$fimg = $set['fimg'];
	$showblog = $set['showblog'];
	$showpages = $set['showpages'];
	$blogentriesshown = $set['blogentriesshown'];
	$blogcharactersshown = $set['blogcharactersshown'];
	$blogcommentpermissions = $set['blogcommentpermissions'];
	$blogcommentsshown = $set['blogcommentsshown'];
	$blogfollowtags = $set['blogfollowtags'];
	$blogcharactersrss = $set['blogcharactersrss'];
	$metatags = $set['metatags'];
	$metadescription = $set['metadescr'];
	$seoheading = $set['seoheading'];
	$seotext = $set['seotext'];
	$pagetitle = $sitename ;
};


?>