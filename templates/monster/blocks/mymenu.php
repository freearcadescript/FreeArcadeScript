<?php 
echo'<div class="header">
		User Panel
	</div>
	<div class="content">
		<ul class=\'catmenu\'>';
				if($seo_on == 1){
					if(!isset($suserid)){
						echo '<li ><a href=\''.$domain.'/login/\'>Login</a></li>
						<li><a href=\''.$domain.'/signup/\'>Signup</a></li>';
					}else{
						echo '<li ><a href=\''.$domain.'/myaccount/\'>My Account</a></li>
						<li><a href=\''.$domain.'/myaccount/favorites/\'>Favorites</a></li>
						<li ><a href=\''.$domain.'/logout/\'>Logout</a></li>';
					}	
				}else{
					if(!isset($suserid)){
						echo '<li ><a href=\''.$domain.'/index.php?action=login\'>Login</a></li>
						<li ><a href=\''.$domain.'/index.php?action=signup\'>Signup</a></li>';
					}else{
						echo '<li ><a href=\''.$domain.'/index.php?action=myaccount\'>My Account</a></li>
						<li><a href=\''.$domain.'/index.php?action=myaccount&cmd=favorites\'>Favorites</a></li>
						<li ><a href=\''.$domain.'/index.php?action=logout\'>Logout</a></li>';
					}	
				}
				if($usrdata['user_level'] == 2){echo '<li><a href=\''.$domain.'/index.php?action=admin\'>Admin</a></li>';};
				if($usrdata['gamelevel'] >= 2) {echo '<li><a href=\''.$domain.'/index.php?action=gamemanager\'>Game Manager</a></li>';};
				if($usrdata['bloglevel'] >= 2) {echo '<li><a href=\''.$domain.'/index.php?action=blogmanager\'>Blog Manager</a></li>';};										 							
		echo'</ul>
	</div>';
?>