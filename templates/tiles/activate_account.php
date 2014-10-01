<?php
function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages;

$id=clean($_GET['id']);

$res=mysql_query("SELECT * from `fas_users` WHERE `activation_key`='$id'") or die(mysql_error());
$row=mysql_fetch_assoc($res);
$key=clean($row['activation_key']);
if($key == $id){

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Activate Account</div>


echo "<div class='msg'>Your account has been activated, you may now login</div>";
}else{
echo "<div class='error'>The activation key was incorrect, please try again</div>";
}

echo'</div></div></div>';

$sql3 ="UPDATE `fas_users` SET `activation_key`='0' WHERE `activation_key`='$id'";
$res3 = mysql_query($sql3) or die(mysql_error());

};

$pagetitle="Activate Account";
?>