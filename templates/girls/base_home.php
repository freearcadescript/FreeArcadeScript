<?php

$pagetitle = $sitename;

function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

$count = 0;

$baser2 = "SELECT * FROM fas_categories where active='1'";
$baser1 = sqlcache('mainpagecats', $cachelife, $baser2);

echo '<table width=\'99%\' border=\'0\' align=\'center\'>';
foreach($baser1 as $row){

$categorynamev = $row['name'];
$categorynameu = preg_replace('[^A-Za-z0-9]', '-', $categorynamev );

if($seo_on == 1){
		$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categorynameu.'.html';
		}else{
		$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
		    };

       echo '<tr>
	      	<td width=\'100%\' valign=\'top\'>
	      	<table width=\'100%\' border=\'0\'><div align=\'center\'>
	      		<tr>
	      			<td class=\'header\'>'.$row['name'].'</td>
	      		</tr>
	      		<tr>
	      			<td>';
	      	echo '<table><tr> <td width=\'755\' align=\'center\' class=\'content\'><div align=\'center\'>';
                $catid1=$row['ID'];
                $sqltitle='mainpagecat'.$catid1 ;
	        $baseir2 = "SELECT * FROM fas_games WHERE category='$catid1' and active='1' ORDER BY rand() LIMIT 0,".$limitboxgames ;
                $baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);
                if(isset($baseir1)){
	      	foreach($baseir1 as $row ){
                $gamename = preg_replace('#\W#', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}
	      	echo '<a href=\''.$playlink.'\' title=\''.$row['name'].'\'>';

				      		if($row['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' width=\'80\' height=\'80\' style=\'margin:3px\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$row['thumburl'].'\' width=\'80\' height=\'80\' style=\'margin:3px\' border=\'0\'>';
				      		}

				      		echo '</a>';
	      	};

				}else{
					echo'<div>
						No games in this category yet.
					</div>';
				}

echo '<tr><td class=\'content\'>';
echo '<a href=\''.$categoryurl.'\'>Play more '.$categorynamev.' games</a>';
echo '</td></tr></div>';


	      echo '  </table></div>';

	      		echo '	</td>
	      		</tr>
	      	</table>
	      		</td>';

$count++;
}
echo "</table>";
$pgname = 'Your resource for fantastic games!';
}
?>