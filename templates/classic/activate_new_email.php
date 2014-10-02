<?php
function writebody() {
global $db, $domain, $suserid, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;


if(!isset($suserid)){
echo '<div class=\'error\'>Please login first.</div>';

exit;
}; 

		$current_email = clean($_GET['oldemail']);
		$new_email = clean($_GET['newemail']);
		$id = clean($_GET['id']);
		
		if(!$current_email || !$new_email || !$id){
			echo 'Something was missing within your url. Please try again!';
			exit;
		}

$userid = $usrdata['userid'];
$ir = $db->query(sprintf('SELECT * FROM fas_users WHERE userid=\'%u\'', $userid));
$r2 = $db->fetch_row($ir);
$email = $r2['email'];
$new_email_key = $r2['new_email_key'];

if($current_email == $email && $new_email_key == $id){
mysql_query("UPDATE dd_users SET `email`='$new_email', `new_email_key`='0' WHERE userid='{$usrdata['userid']}'");
echo '<div class=\'msg\'>Your email has been changed!</div>';
}else{
echo 'ERROR!!';
}
		
};
?>