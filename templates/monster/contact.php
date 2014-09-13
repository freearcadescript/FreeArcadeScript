<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





$sender = clean($_POST['sender']);
$message = clean($_POST['message']);


if(!$sender || !$message){
echo 'All fields are required.';
}else{


$headers = 'From: '.$sender.' <'.$sender.'>';
$subject = 'Contact message from '.$sender.' through '.$sitename;
mail($supportemail, $subject, $message, $headers);
echo '<p>Thank you, message has been sent.</p>';
};
};
?>