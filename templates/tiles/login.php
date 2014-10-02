<?php

$pagetitle = 'Log in';

function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages;





if(isset($_POST['submit'])){
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);

	$r = $db->query(sprintf('SELECT * FROM fas_users WHERE username=\'%s\'', $username));
	if(!$db->num_rows($r)){
                  echo'<div id="container">
                       <div id="content-container">
                       <div id="side">';
                       include("includes/blocks.php");
                  echo'</div>

                       <div id="content">';
		echo "<div class='error'>The username you entered does not exist!</div>";
                 echo'</div></div></div>';
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

                                echo'<div id="container">
                                <div id="content-container">
                                <div id="side">';
                                include("includes/blocks.php");
                                echo'</div>

                                <div id="content">';
				echo '<div class=\'msg\'>You\'ve now logged on.</div>';
				echo '<meta http-equiv="REFRESH" content="0;url='.$domain.'">';
                                echo'</div></div></div>';
			}elseif (md5($password) == $ir['password']) {
				$salt = createSalt();//creates a 3 character string
				$newPass = setPass($password, $salt);
				$db->query(sprintf('UPDATE fas_users SET password = \'%s\', salt = \'%s\' WHERE username = \'%s\'',$newPass, $salt, $username));


				$_SESSION['username'] = $username;
				$_SESSION['userid']= $ir['userid'];
				$_SESSION['website']= $ir['website'];
				$_SESSION['signature']= $ir['signature'];
				$_SESSION['bloglevel']= $ir['bloglevel'];

                                echo'<div id="container">
                                <div id="content-container">
                                <div id="side">';
                                include("includes/blocks.php");
                                echo'</div>

                                <div id="content">';
				echo '<div class=\'msg\'>You\'ve now logged on.</div>';
				echo '<meta http-equiv="REFRESH" content="0;url='.$domain.'">';
                                echo'</div></div></div>';
			}else{
                                echo'<div id="container">
                                <div id="content-container">
                                <div id="side">';
                                include("includes/blocks.php");
                                echo'</div>

                                <div id="content">';
				echo "<div class='error'>Your password is incorrect!</div>";
                                echo'</div></div></div>';
			}
		}else{
                                echo'<div id="container">
                                <div id="content-container">
                                <div id="side">';
                                include("includes/blocks.php");
                                echo'</div>

                                <div id="content">';
			 echo "<div class='error'>You need to activate your account first!</div>";
                                echo'</div></div></div>';
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
echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Log In</div>
<div style="clear:both"></div>';
echo '<form action=\''.$url.'\' method=\'post\'>
	<table width="100%" border="0" cellpadding="0" cellspacing="1" align="center">
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
</form>
</div></div></div>';
}

};

?>