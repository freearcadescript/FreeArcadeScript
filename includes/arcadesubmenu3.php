<?php


function submenu2() {
global $db, $domain, $cachelife, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username;



echo '
				<tr>
					<td class="header2">Top Users</td>
				</tr>

				<tr>
					<td class="content2">
			
					';
					echo '<ul class=\'catmenu\'>';
					
					$tur1 = 'SELECT username, userid, plays FROM dd_users ORDER BY plays DESC LIMIT 0,15';
                              $tur = sqlcache('topplayers', $cachelife, $tur1);
					foreach($tur as $r){
					echo '
						<li>'.$r['username'].' - ('.$r['plays'].')</li>';
					}
					echo '
			
				</ul>';
					echo '
<p>

					</td>

				</tr>

';


};


?>