<?php
echo '<div class="side_nav">Top Players</div>
	<div id="side_holder">';	
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
                        echo'<ul class=\'catmenu\'>';
			echo'<li><a href="'.$urlp.'"><img src="'.$domain.'/avatars/'.$avatarfileurl.'" alt="'.$r['username'].'" title="'.$r['username'].'" class="minithumb" />'.$r['username'].' - ('.$r['plays'].')</a></li>';
		}
			echo '</ul>';
	}else{
		echo'Either no there are no users or no users have played a game yet!';
	}

echo'</div>';
?>