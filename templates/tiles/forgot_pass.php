<?php
function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages;


function question(){
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages;

if(isset($_POST['submit'])){
	$answer = clean($_POST['answer']);
	$username = clean($_GET['username']);
	if(!$username || !$answer){
		echo '<div class=\'error\'>You\'ve not filled all required fields in.</div>';
		return;
	}

	$r = $db->query(sprintf('SELECT * FROM fas_users WHERE username=\'%s\'', $username));
	$ir = $db->fetch_row($r);
	$salt = $ir['salt'];//check if the salt exists
	if(empty($salt)){
		$salt = createSalt();//creates a 3 character string
	}
	$answer = checkPass($answer, $salt);

	if(!$db->num_rows($r)){//check if user exists and answer is corect
		echo '<div class=\'error\'>Your username is incorrect. Please try again!</div>';
		return;
	}elseif($answer != $ir['pass_answer']){
		echo '<div class=\'error\'>Your security answer is incorrect. Please try again!</div>';
		return;
	}else{
		
		$email= clean($ir['email']);
		$pass_word = rand( );
		$subject = 'Password Reset';
		$message = 'Hello '.$username.',<br><br>You are receiving this notification because you have (or someone pretending to be you has) requested a new password be sent for your account on <a href="'.$domain.'">'.$sitename.'</a>.<br> Your password has been reset, your new password is: '.$pass_word.'.<br><br> You can of course change this password yourself via the profile page. If you have any difficulties please contact the board administrator.
		<br><br>Best regards,<br>'.$sitename.' administration';
		$headers = 'From: '.$supportemail.'' . "\r\n" .
    	'Content-Type: text/html; charset=\"iso-8859-1\"' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

		mail($email, $subject, $message, $headers);

		$pass = setPass($pass_word, $salt);
		mysql_query("UPDATE fas_users SET password='$pass', salt='$salt' WHERE username='$username' AND pass_answer='$answer'");
			echo '<div class=\'msg\'><font color=red>Your password has been reset, please check your email for the new password!</font></div>';
	}
}else{
	$username = clean($_GET['username']);

	$r = $db->query(sprintf('SELECT * FROM fas_users WHERE username=\'%s\'', $username));
		$ir = $db->fetch_row($r);
		$question= $ir['pass_question'];

	if(!$db->num_rows($r)){
		echo '<div class=\'error\'>Our records show there is no account with the username: <i>'.$username.'</i>!</div>';
		return;
	}else{

	$surl = ''.$domain.'/index.php?action=forgotpassword&amp;case=question&amp;username='.$username.'';

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Forgot Password?</div>
<div style="clear:both"></div>';

echo '<form action=\''.$surl.'\' method=\'post\'>
	<table width=\'100%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'content\'>'.$question.':</td>
			<td class=\'content\'><input type=\'text\' name=\'answer\' size=\'35\' /></td>
		</tr>
		<tr>
			<td colspan=\'2\' align=\'center\' class=\'content\'><input type=\'submit\' name=\'submit\' value=\'Get new pass!\' /></td>
		</tr>
	</table>
</form>			
';
}
}
}

function username(){
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages;

	$surl = ''.$domain.'/index.php?action=forgotpassword&amp;case=getlink';

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Forgot Password?</div>
<div style="clear:both"></div>';

echo '<form action=\''.$surl.'\' method=\'post\'>
	<table width=\'100%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'content\'>Your username:</td>
			<td class=\'content\'><input type=\'text\' name=\'username\' size=\'35\' /></td>
		</tr>
		<tr>
			<td colspan=\'2\' align=\'center\' class=\'content\'><input type=\'submit\' name=\'submit\' value=\'Next\' /></td>
		</tr>
	</table>
</form>
</div></div></div>';
}

function getlink(){
$username = clean($_POST['username']);

echo '<head>
<meta http-equiv="refresh" content=".1; url=index.php?action=forgotpassword&amp;case=question&amp;username='.$username.'">
</head>';

//echo "<center><a href='index.php?action=forgotpassword&amp;case=question&amp;username=$username'><font color='red' size='+3'>----> Next ----></font></a></center>";
}

if(!isset($_GET['case'])){
	$_GET['case'] = NULL;
}
switch($_GET['case']){
default:
username();
break;

case 'getlink':
getlink();
break;

case 'question':
question();
break;
}

};
$pagetitle="forgot password";
?>