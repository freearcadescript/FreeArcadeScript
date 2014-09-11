<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





if(isset($_POST['submit'])){
	$username = clean($_POST['username']);
	$password = md5(clean($_POST['password']));
	
	$r = $db->query(sprintf('SELECT userid FROM fas_users WHERE username=\'%s\' AND password=\'%s\'', $username, $password));
	if(!$db->num_rows($r)){
		echo '<div class=\'error\'>User account does not exist.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}else{
		$ir = $db->fetch_row($r);
		$_SESSION['username'] = $username;
		$_SESSION['userid']= $ir['userid'];
		$_SESSION['website']= $ir['website'];
		$_SESSION['signature']= $ir['signature'];


		$_SESSION['bloglevel']= $ir['bloglevel'];
		echo '<div class=\'msg\'>You\'ve now logged on.</div>';
		
PRINT<<<ETL
<meta http-equiv="REFRESH" content="0;url=$domain">
ETL;
	}
	
}else{
if($seo_on == 1){
	$url = ''.$domain.'/login/';
}else{
	$url = ''.$domain.'/index.php?action=login';
}
echo '	<h2>Login</h2>
	<form action=\''.$url.'\' method=\'POST\'>
	<table align=\'center\'>
	<tr>
		<td class=\'header\'>Username:</td>
		<td class=\'content\'><input type=\'text\' name=\'username\' size=\'37\'></td>
	</tr>
	<tr>
		<td class=\'header\'>Password:</td>
		<td class=\'content4\'><input type=\'password\' name=\'password\' size=\'37\'></td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\' align=\'center\'><input type=\'submit\' name=\'submit\' value=\'Signon\'></td>
	</tr>
	</table>
	
	</form>';
}

};

?>