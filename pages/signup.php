<?php

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
	
	if(!$user_name || !$pass_word || !$pass_word2 || !$email){
		echo '<div class=\'error\'>You\'ve not filled all required fields in.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	if(!valid_email($email)){
		echo '<div class=\'error\'>Email is not valid.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$ru = $db->query('SELECT username FROM dd_users WHERE username=\''.$user_name.'\'');
	if($db->num_rows($ru) == 1){
		echo '<div class=\'error\'>Username is already in use.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$pass = md5($pass_word);
	$db->query(sprintf('INSERT INTO dd_users SET
				username=\'%s\',
				password=\'%s\',
				email =\'%s\'', $user_name, $pass, $email));
				echo '<div class=\'msg\'>Success, you\'ve now registered.</div>';
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
			<td class=\'content\'>Email:*</td>
			<td class=\'content\'><input type=\'text\' name=\'email\' size=\'40\'></td>
		</tr>
		<tr>
			<td colspan=\'2\' align=\'center\' class=\'header\'><input type=\'submit\' name=\'submit\' value=\'Signup Now\'>
		</tr>
	</table></form>			
';
$pgname = 'Signup';
?>