<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





function valid_email($email)
{
	if(preg_match("/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0)
		return true;
	else
		return false;
}



if(isset($_POST['submit'])){
	$user_name = clean($_POST['user_name']);
	$pass_word = clean($_POST['pass_word']);
	$pass_word2 = clean($_POST['pass_word2']);
	$email = clean($_POST['email']);
	$question = clean($_POST['question']);
	$answer = clean($_POST['answer']);
	$activation_number = rand( );
	
	if(!$user_name || !$pass_word || !$pass_word2 || !$email || !$question || !$answer){
		echo '<div class=\'error\'>You\'ve not filled all required fields in.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	if(!valid_email($email)){
		echo '<div class=\'error\'>Email is not valid.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$ru = $db->query('SELECT username FROM fas_users WHERE username=\''.$user_name.'\'');
	if($db->num_rows($ru) == 1){
		echo '<div class=\'error\'>Username is already in use.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$ru = $db->query('SELECT email FROM fas_users WHERE email=\''.$email.'\'');
	if($db->num_rows($ru) == 1){
		echo '<div class=\'error\'>Email is already in use.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$pass = md5($pass_word);
	$db->query(sprintf('INSERT INTO fas_users SET
				username=\'%s\',
				password=\'%s\',
				activation_key=\'%s\',
				email =\'%s\',
				pass_question =\'%s\',
				pass_answer =\'%s\'', 
				joindate =\'$date\'', $user_name, $pass, $activation_number, $email, $question, $answer, $joindate));
				echo '<div class=\'msg\'>Thank you for signing up!<br> <font color=red>Please check your email for an activation key!</font></div>';

$subject = 'Welcome to '.$sitename.'';
$message = 'Dear '.$user_name.',<br>Thank you for registering at <a href="'.$domain.'">'.$sitename.'</a>,<br> <a href="'.$domain.'/index.php?action=activate&id='.$activation_number.'">Click Here</a> to activate your new account.<br>Thanks again,<br>'.$sitename.' administration';
$headers = 'From: '.$supportemail.'' . "\r\n" .
    'Content-Type: text/html; charset=\"iso-8859-1\"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $message, $headers);

}
if($seo_on == 1){
	$surl = ''.$domain.'/signup/';
}else{
	$surl = ''.$domain.'/index.php?action=signup';
}
echo '<form action=\''.$surl.'\' method=\'POST\'>
	<table width=\'70%\' border=\'0\' align=\'center\'>
		<tr>
			<th colspan=\'2\' align=\'center\' class=\'header\'>Register now!</th>
		</tr>
		<tr>
			<td class=\'content\'>User Name:*<br><small>Must be unique, letters and numbers only!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'user_name\' size=\'35\'></td>
		</tr>
		<tr>
			<td class=\'content\'>Password:*<br><small>Must be unique, letters and numbers only!</small></td>
			<td class=\'content\'><input type=\'password\' name=\'pass_word\' size=\'35\'></td>
		</tr>
		<tr>
			<td class=\'content\'>Repeat Password:*</td>
			<td class=\'content\'><input type=\'password\' name=\'pass_word2\' size=\'35\'></td>
		</tr>
		<tr>
			<td class=\'content\'>Email:*<br><small>Email must be valid!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'email\' size=\'40\'></td>
		</tr>

		<tr>
			<td class=\'content\'>Question:*<br><small>If you forgot your password!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'question\' size=\'40\'></td>
		</tr>

		<tr>
			<td class=\'content\'>Answer:*<br><small>If you forgot your password!</small></td>
			<td class=\'content\'><input type=\'text\' name=\'answer\' size=\'40\'></td>
		</tr>

		<tr>
			<td colspan=\'2\' align=\'center\' class=\'header\'><input type=\'submit\' name=\'submit\' value=\'Signup Now\'>
		</tr>
	</table></form>			
';




};
?>