<?php


function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




$max = $gamesonpage;
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max;
$r = $db->query(sprintf('SELECT * FROM fas_games WHERE `active`=\'1\' ORDER BY ID DESC LIMIT '.$limits.','.$max.' '));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE `active`=\'1\''),0);
$totalpages = ceil($totalres / $max);

echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Newest Games</td>
	</tr>';
$count = 0;
       echo '<tr>
	    <td width=\'100%\' valign=\'top\'><div align=\'center\'>';

while($in = $db->fetch_row($r)){
$gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}

	echo '<a href=\''.$playlink.'\' title=\''.$in['name'].'\'>';

// if($count%2==0){
				      		if($in['type'] == 1){
				      		echo '<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'80\' height=\'80\' border=\'0\' title=\''.$in['name'].'\' alt=\''.$in['name'].'\' style=\'margin:2px\'>';
				      		}else{
				      		echo '<img src=\''.$in['thumburl'].'\' width=\'80\' height=\'80\' border=\'0\' title=\''.$in['name'].'\' alt=\''.$in['name'].'\' style=\'margin:2px\'>';
				      		}

				      		echo '</a>';
// }
$count++;
}

	      				echo '</div></td>
	      			</tr>';

echo "</table>";
echo 'Pages: ';
for($i = 1; $i <= $totalpages; $i++){

if($seo_on == 1){
	$urlmp = ''.$domain.'/newest/page'.$i.'.html';
}else{
	$urlmp = ''.$domain.'/index.php?action=newest&page='.$i ;
}

echo '<a href="'.$urlmp.'" class="pagenat">'.$i.'</a>&nbsp;';
}


};

$pagetitle = $sitename.' - Newest Games';
$metatags = 'new games, latest games, newest games';
$metadescription = $sitename.' newest Games';



?>