<?php

$pagetitle = 'Log in';

function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





if(isset($_POST['submit'])){
	$username = clean($_POST['username']);
	$password = md5(clean($_POST['password']));
	
	$r = $db->query(sprintf('SELECT * FROM fas_users WHERE username=\'%s\' AND password=\'%s\'', $username, $password));
	if(!$db->num_rows($r)){
		echo '<div class=\'error\'>Your username or password is incorrect.</div>';
		return;
	}else{
		$ir = $db->fetch_row($r);
	if($ir['activation_key'] == "0"){
		$_SESSION['username'] = $username;
		$_SESSION['userid']= $ir['userid'];
		$_SESSION['website']= $ir['website'];
		$_SESSION['signature']= $ir['signature'];


		$_SESSION['bloglevel']= $ir['bloglevel'];
		echo '<div class=\'msg\'>You\'ve now logged on.</div>';
		

echo '<meta http-equiv="REFRESH" content="0;url='.$domain.'">';
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

};

?>