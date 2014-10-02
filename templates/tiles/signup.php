<?php


function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $email_on, $showpages;

if(isset($_POST['submit'])){
    $time = time();
	$user_name = clean($_POST['user_name']);
	$pass_word = clean($_POST['pass_word']);
	$pass_word2 = clean($_POST['pass_word2']);
	$email = clean($_POST['email']);
	$question = clean($_POST['question']);
	$answer = clean($_POST['answer']);
	$activation_number = rand( );

	if(strlen($user_name) > '16'){
		echo '<div class=\'error\'>The username you entered is to long.</div>';
		return;
	}
	if(!$user_name || !$pass_word || !$pass_word2 || !$email || !$question || !$answer){
		echo '<div class=\'error\'>You\'ve not filled all required fields in.</div>';
		return;
	}
	if(!valid_email($email)){
		echo '<div class=\'error\'>Email is not valid.</div>';
		return;
	}
	$ru = $db->query('SELECT username FROM fas_users WHERE username=\''.$user_name.'\'');
	if($db->num_rows($ru) == 1){
		echo '<div class=\'error\'>Username is already in use.</div>';
		return;
	}
	$ru = $db->query('SELECT email FROM fas_users WHERE email=\''.$email.'\'');
	if($db->num_rows($ru) == 1){
		echo '<div class=\'error\'>Email is already in use.</div>';
		return;
	}

	$salt = createSalt();//creates a 3 character string
	$pass = setPass($pass_word, $salt);
	$answer = setPass($answer, $salt);
	if($email_on == '1'){
	$db->query(sprintf('INSERT INTO fas_users SET
				username=\'%s\',
				password=\'%s\',
				salt=\'%s\',
				activation_key=\'%s\',
				email =\'%s\',
				pass_question =\'%s\',
				pass_answer =\'%s\',
				joindate=\'%u\'', $user_name, $pass, $salt, $activation_number, $email, $question, $answer, $time));
				echo '<div class=\'msg\'>Your account has been created! <br /> <font color=red>However, this board requires account activation, an activation key has been sent to the e-mail address you provided. Please check your e-mail for further information.</font></div>';

$subject = 'Welcome to '.$sitename.'';
$message = 'Dear '.$user_name.',<br>Thank you for registering at <a href="'.$domain.'">'.$sitename.'</a>,<br /> Please visit the following link in order to activate your account:<br /><br />
<a href="'.$domain.'/index.php?action=activate&id='.$activation_number.'">Activate</a><br /><br />Your password has been securely stored in our database and cannot be retrieved. In the event that it is forgotten, you will be able to reset it using the email address associated with your account.<br /><br />Thanks again,<br />'.$sitename.' administration';
$headers = 'From: '.$supportemail.'' . "\r\n" .
    'Content-Type: text/html; charset=\"iso-8859-1\"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $message, $headers);
	}else{
	$db->query(sprintf('INSERT INTO fas_users SET
				username=\'%s\',
				password=\'%s\',
				salt=\'%s\',
				activation_key=\'%s\',
				email =\'%s\',
				pass_question =\'%s\',
				pass_answer =\'%s\',
				joindate=\'%u\'',$user_name, $pass, $salt, '0', $email, $question, $answer, $time));
				echo '<div class=\'msg\'>Success, you\'ve now registered.</div>';
	}
return;
}
if($seo_on == 1){
	$surl = ''.$domain.'/signup/';
}else{
	$surl = ''.$domain.'/index.php?action=signup';
}

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">';
echo '<form action=\''.$surl.'\' method=\'post\'>
	<table width=\'100%\' border=\'0\' align=\'center\'>
		<tr>
			<th colspan=\'2\' align=\'center\' class=\'header\'>Register now!</th>
		</tr>
		<tr>
			<td class=\'content\'>User Name:*<br /><small>Must be unique, letters and numbers only!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'user_name\' size=\'40\' /></td>
		</tr>
		<tr>
			<td class=\'content\'>Password:*<br /><small>Must be unique, letters and numbers only!</small></td>
			<td class=\'content\'><input type=\'password\' name=\'pass_word\' size=\'40\' /></td>
		</tr>
		<tr>
			<td class=\'content\'>Repeat Password:*</td>
			<td class=\'content\'><input type=\'password\' name=\'pass_word2\' size=\'40\' /></td>
		</tr>
		<tr>
			<td class=\'content\'>Email:*<br /><small>Email must be valid!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'email\' size=\'40\' /></td>
		</tr>

		<tr>
			<td class=\'content\'>Question:*<br /><small>If you forgot your password!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'question\' size=\'40\' /></td>
		</tr>

		<tr>
			<td class=\'content\'>Answer:*<br /><small>If you forgot your password!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'answer\' size=\'40\' /></td>
		</tr>

		<tr>
			<td colspan=\'2\' align=\'center\' class=\'content\'><input type=\'submit\' name=\'submit\' value=\'Signup Now\' /></td>
		</tr>
	</table>
</form>
</div></div>';




};
?>