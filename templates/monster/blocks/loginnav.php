<?php
echo'<div class="leftside">';
	$avatarfileurl = get_avatar($suserid);
	if($seo_on == 1){
		$login = ''.$domain.'/login/';
		$signup = ''.$domain.'/signup/';
		$myaccount = ''.$domain.'/myaccount/';
		$logout = ''.$domain.'/logout/';
	}else{
		$login = ''.$domain.'/index.php?action=login';
		$signup = ''.$domain.'/index.php?action=signup';
		$myaccount = ''.$domain.'/index.php?action=myaccount';
		$logout = ''.$domain.'/index.php?action=logout';
	}
	if(!isset($suserid)){
		echo'<div class="userarea">Welcome Guest, <a href="'.$login.'">Login</a> | <a href="'.$signup.'">Signup</a></div>';
	}else{
		echo '<div class="userarea"><a href="'.$myaccount.'"><img src="'.$domain.'/avatars/'.$avatarfileurl.'"  alt="avatar" class="miniavatar" />'.$usrdata['username'].'</a> | <a href="'.$logout.'">Logout</a>';
		if($usrdata['user_level'] == 2){echo '<a href=\''.$domain.'/index.php?action=admin\'> Admin</a>';};
		if($usrdata['gamelevel'] >= 2) {echo '<a href=\''.$domain.'/index.php?action=gameadmin\'> Game Admin</a>';};
		if($usrdata['bloglevel'] >= 2) {echo '<a href=\''.$domain.'/index.php?action=blogadmin\'> Blog Admin</a>';};
		echo'</div>';
	}
  echo'</div>

<div class="rightside">
	<a href=" '.$domain.'/rss-arcade.php" target="_blank"><img src="'.$domain.'/templates/'.$template.'/images/rss.png" alt="rss" border="0" /></a>
</div>';
?>