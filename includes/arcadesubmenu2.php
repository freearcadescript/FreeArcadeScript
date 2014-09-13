<?php
function submenu2() {
global $db, $domain, $cachelife, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username;
	
	$tur1 = 'SELECT username, userid, plays FROM fas_users WHERE plays!="0" ORDER BY plays DESC LIMIT 0,15';
	$tur = sqlcache('topplayers', $cachelife, $tur1);
	if(isset($tur)){
		foreach($tur as $r){
			if($seo_on == 1){
				$urlp = ''.$domain.'/showprofile/'.$r['userid'].'.html';
			}else{
				$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$r['userid'] ;
			}
			$avatarfileurl = get_avatar($r['userid']);
			echo'<li><a href="'.$urlp.'"><img src="'.$domain.'/avatars/'.$avatarfileurl.'" alt="avatar" class="minithumb" />'.$r['username'].' - ('.$r['plays'].')</a></li>';
		}
	}else{
		echo'<li>Either no there are no users or no users have played a game yet!</li>';
	}
};

?>