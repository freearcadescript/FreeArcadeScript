<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




$sender = clean($_POST['sender']);
$recipient = clean($_POST['recipient']);
$gamei = clean($_POST['gamei']);
$gamen = clean($_POST['gamen']);


if(!$sender || !$recipient){
echo '<div class="error">All fields are required.</div>';
}else{


if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$gamei.'-'.$gamen.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$gamei.'';
	};

$headers = 'From: '.$supportemail.' <'.$supportemail.'>';
$subject = 'Your friend '.$sender.' wanted you to see this';
$message = 'Your friend '.$sender.' wanted you to check out the game '.$gamen.' at '.$playlink ;
mail($recipient, $subject, $message, $headers);
echo '<div class="msg">Thank you, message has been sent.</div>' ;
};



};
?>