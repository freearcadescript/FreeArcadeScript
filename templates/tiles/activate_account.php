<?php
function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

$id=clean($_GET['id']);

$res=mysql_query("SELECT * from fas_users WHERE activation_key='$id'") or die(mysql_error());
$row=mysql_fetch_assoc($res);
$key=clean($row['activation_key']);
if($key == $id){
echo "<div class='msg'>Your account has been activated, you may now login</div>";
}else{
echo "<div class='error'>The activation key was incorrect, please try again</div>";
}

$sql3 ="UPDATE fas_users SET activation_key='0' WHERE activation_key='$id'";
mysql_query($sql3) or die(mysql_error());

};

$pagetitle="Activate Account";
?>