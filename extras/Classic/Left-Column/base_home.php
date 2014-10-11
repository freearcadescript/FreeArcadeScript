<?php

$pagetitle = $sitename;

function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;



$count = 0;

$baser2 = "SELECT * FROM fas_categories where active='1'";
$baser1 = sqlcache('mainpagecats', $cachelife, $baser2);


echo '<table width=\'720\' border=\'0\' cellpadding=\'0\' cellspacing=\'0\'  align=\'center\'>';
foreach($baser1 as $row){

$categorynamev = $row['name'];
$categorynameu = preg_replace('#\W#', '-', $categorynamev );

if($seo_on == 1){
		$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categorynameu.'.html';
		}else{
		$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
		    };






       echo '<tr>
	      	<td width=\'720\' valign=\'top\'>
	      	<table width=\'720\' border=\'0\'><div align=\'center\'>
	      		<tr>
	      			<td class=\'header\'><a href=\''.$categoryurl.'\'>'.$categorynamev.' Games</a></td>
	      		</tr>
	      		<tr>
	      			<td>';
	      	echo '<table><tr> <td width=\'720\' align=\'center\' class=\'content\'><div align=\'center\'>
';
	      	$ir = $db->query(sprintf('SELECT * FROM fas_games WHERE category=\'%u\' ORDER BY rand() LIMIT 0,'.$limitboxgames.'', $row['ID']));
	      	while($row = $db->fetch_row($ir)){
                $gamename = preg_replace('#\W#', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}
	      	echo '
	      			<a href=\''.$playlink.'\' title=\''.$row['name'].'\'>
	      			';
				      		if($row['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' title=\''.$row['name'].'\' alt=\''.$row['name'].'\' width=\'80\' height=\'80\' border=\'0\' alt=\''.$row['name'].'\'>';
				      		}else{
				      		echo '	<img src=\''.$row['thumburl'].'\' title=\''.$row['name'].'\' alt=\''.$row['name'].'\' width=\'80\' height=\'80\' border=\'0\' alt=\''.$row['name'].'\'>';
				      		}

				      		echo '
	      			</a>


	      		';
	      	};



echo '</div>';










				      echo '  </table>';

	      		echo '	</td>
	      		</tr>
	      	</table>
	      		</td>
	      	</tr>';
}

echo "</table>";
$pgname = 'Your resource for fantastic games!';


};
?>