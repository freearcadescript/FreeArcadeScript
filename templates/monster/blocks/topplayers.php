<?php

function submenu2() {
global $db, $domain, $cachelife, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username;

echo'<div class="header">Top Players</div>
	<div class="content">';

					echo '<ul>';
					$tur1 = 'SELECT username, userid, plays FROM fas_users ORDER BY plays DESC LIMIT 0,15';
                                        $tur = sqlcache('topplayers', $cachelife, $tur1);
					foreach($tur as $r){
					echo '<li>'.$r['username'].' - ('.$r['plays'].')</li>';
					}
					echo '</ul>';
					};
	echo'</div>';
?>