<?php
function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;


function question(){
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

if($_POST['submit']){
	$answer = clean($_POST['answer']);
	$username = clean($_GET['username']);
	if(!$username || !$answer){
		echo '<div class=\'error\'>You\'ve not filled all required fields in.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}

$r = $db->query(sprintf('SELECT * FROM dd_users WHERE username=\'%s\' AND pass_answer=\'%s\'', $username, $answer));
	if(!$db->num_rows($r)){
		echo '<div class=\'error\'>Either your username or answer is incorrect. Please try again!</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}else{
		$ir = $db->fetch_row($r);
		$email= clean($ir['email']);
		$pass_word = rand( );
$subject = 'Password Reset';
$message = 'Dear '.$username.',<br>We have recived a password reset request for your account on <a href="'.$domain.'">'.$sitename.'</a>,<br> We have reset your password, your new password is: '.$pass_word.'. Once logged in you may change your password to what ever you wish.<br>Best regards,<br>'.$sitename.' administration';
$headers = 'From: '.$supportemail.'' . "\r\n" .
    'Content-Type: text/html; charset=\"iso-8859-1\"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $message, $headers);


	$pass = md5($pass_word);
	mysql_query("UPDATE dd_users SET password='$pass' WHERE username='$username' AND pass_answer='$answer'");
				echo '<div class=\'msg\'><font color=red>Your password has been reset, please check your email for the new password!</font></div>';

}
}else{
$username = clean($_GET['username']);

$r = $db->query(sprintf('SELECT * FROM dd_users WHERE username=\'%s\'', $username));
		$ir = $db->fetch_row($r);
		$question= $ir['pass_question'];

	if(!$db->num_rows($r)){
		echo '<div class=\'error\'>Our records show there is no account with the username: <i>'.$username.'</i>!</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}else{

	$surl = ''.$domain.'/index.php?action=forgotpassword&case=question&username='.$username.'';

echo '<form action=\''.$surl.'\' method=\'POST\'>
	<table width=\'70%\' border=\'0\' align=\'center\'>
		<tr>
			<th colspan=\'2\' align=\'center\' class=\'header\'>Forgot Password?</th>
		</tr>
		<tr>
			<td class=\'content\'>'.$question.':</td>
			<td class=\'content\'><input type=\'text\' name=\'answer\' size=\'35\'></td>
		</tr>
		<tr>
			<td colspan=\'2\' align=\'center\' class=\'header\'><input type=\'submit\' name=\'submit\' value=\'Get new pass!\'>
		</tr>
	</table></form>			
';
}
}
}

function username(){
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

	$surl = ''.$domain.'/index.php?action=forgotpassword&case=getlink';

echo '<form action=\''.$surl.'\' method=\'POST\'>
	<table width=\'70%\' border=\'0\' align=\'center\'>
		<tr>
			<th colspan=\'2\' align=\'center\' class=\'header\'>Forgot Password?</th>
		</tr>
		<tr>
			<td class=\'content\'>Your username:</td>
			<td class=\'content\'><input type=\'text\' name=\'username\' size=\'35\'></td>
		</tr>
		<tr>
			<td colspan=\'2\' align=\'center\' class=\'header\'><input type=\'submit\' name=\'submit\' value=\'Next\'>
		</tr>
	</table></form>			
';
}

function getlink(){
$username = clean($_POST['username']);

echo "<center><a href='index.php?action=forgotpassword&case=question&username=$username'><font color='red' size='+3'>----> Next ----></font></a></center>";
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