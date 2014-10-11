<div id="footer_box">
<div id="footer_content">
<div class="footer_boxnav">Newest Members</div>
<?php
$tur1 = 'SELECT username, userid, joindate FROM fas_users ORDER BY userid DESC LIMIT 0,6';
	$tur = sqlcache('newmembers', $cachelife, $tur1);
	if(isset($tur)){
		foreach($tur as $r){
if($seo_on == 1){
    $urlp = ''.$domain.'/showprofile/'.$r['userid'].'.html';
}else{
    $urlp = ''.$domain.'/index.php?action=showprofile&profile='.$r['userid'] ;
}
$joindate = date('M-d-Y', $r['joindate']);
$avatarfileurl = get_avatar($r['userid']);
echo '<div class="footer_info"><a href="'.$urlp.'"><img src="'.$domain.'/avatars/'.$avatarfileurl.'" alt="avatar" class="minithumb" />'.$r['username'].' - '.$joindate.'</a></div>';
		    }
	}else{
		echo'We have no members at this time!';
	}
?>
</div>

<div id="footer_content">
<div class="footer_boxnav">Advertisment</div>
<?php
if (!$ads3 == ""){
	echo'<div align="center">'.$ads3.'</div>';
};
?>
</div>

<div id="footer_content">
<div class="footer_boxnav">Top Players</div>
<?php
	$tur1 = 'SELECT username, userid, plays FROM fas_users WHERE plays!="0" ORDER BY plays DESC LIMIT 0,6';
	$tur = sqlcache('topplayers', $cachelife, $tur1);
	if(isset($tur)){
		foreach($tur as $r){
			if($seo_on == 1){
				$urlp = ''.$domain.'/showprofile/'.$r['userid'].'.html';
			}else{
				$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$r['userid'] ;
			}
			$avatarfileurl = get_avatar($r['userid']);
			echo'<div class="footer_info"><a href="'.$urlp.'"><img src="'.$domain.'/avatars/'.$avatarfileurl.'" alt="'.$r['username'].'" title="'.$r['username'].'" class="minithumb" />'.$r['username'].' - ('.$r['plays'].')</a></div>';
		    }
	        }else{
		    echo'No users have played a game yet!';
	}
?>
</div>
</div>