<?php

$pagetitle = 'Log in';



if(isset($_POST['submit'])){
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);

	$r = $db->query(sprintf('SELECT * FROM fas_users WHERE username=\'%s\'', $username));
	if(!$db->num_rows($r)){
		echo "<div class='error'>The username you entered does not exist!</div>";
	}else{
		$ir = $db->fetch_row($r);
		if($ir['activation_key'] == "0"){
			$salt = $ir['salt'];
			$password1 = checkPass($password, $salt);
			if($password1 == $ir['password']){
				$_SESSION['username'] = $username;
				$_SESSION['userid']= $ir['userid'];
				$_SESSION['website']= $ir['website'];
				$_SESSION['signature']= $ir['signature'];
				$_SESSION['bloglevel']= $ir['bloglevel'];

				echo '<div class=\'msg\'>You\'ve now logged on.</div>';
				echo '<meta http-equiv="REFRESH" content="0;url='.$domain.'">';
			}elseif (md5($password) == $ir['password']) {
				$salt = createSalt();//creates a 3 character string
				$newPass = setPass($password, $salt);
				$db->query(sprintf('UPDATE fas_users SET password = \'%s\', salt = \'%s\' WHERE username = \'%s\'',$newPass, $salt, $username));


				$_SESSION['username'] = $username;
				$_SESSION['userid']= $ir['userid'];
				$_SESSION['website']= $ir['website'];
				$_SESSION['signature']= $ir['signature'];
				$_SESSION['bloglevel']= $ir['bloglevel'];

				echo '<div class=\'msg\'>You\'ve now logged on.</div>';
				echo '<meta http-equiv="REFRESH" content="0;url='.$domain.'">';
			}else{
				echo "<div class='error'>Your password is incorrect!</div>";
			}
		}else{
			echo "<div class='error'>You need to activate your account first!</div>";
		}
	}
	
}else{
if($seo_on == 1){
	$url = ''.$domain.'/login/';
	$forgot = ''.$domain.'/forgotpassword/';	
}else{
	$url = ''.$domain.'/index.php?action=login';
	$forgot = ''.$domain.'/index.php?action=forgotpassword';
}
echo '<form action=\''.$url.'\' method=\'post\'>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" align="center">
	<tr>
		<td class=\'header\' colspan=\'2\'>Log In</td>
	</tr>
	<tr>
		<td class=\'content\'>Username:</td>
		<td class=\'content\'><input type=\'text\' name=\'username\' size=\'37\' /></td>
	</tr>
	<tr>
		<td class=\'content\'>Password:</td>
		<td class=\'content\'><input type=\'password\' name=\'password\' size=\'37\' /></td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'><a href=\''.$forgot.'\'>Forgot password?</a></td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\' align=\'center\'><input type=\'submit\' name=\'submit\' value="login" /></td>
	</tr>
	</table>
</form>';
}


?>