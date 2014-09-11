<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $featuredgames_on, $seotext, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;


echo '<table width=\'100%\' border=\'0\' align=\'left\'>
	<tr>
		<td colspan=\'2\' class=\'header\' >Featured Games</td>
	</tr>
    <tr>
        <td colspan=\'2\' class=\'content\' ><div align=\'left\'>' ;

		$sqltitle = "featured";
		$featured2 = "SELECT * FROM fas_games WHERE `featured`='1' ORDER BY RAND () LIMIT 5";
		$featured1 = sqlcache($sqltitle, $cachelife, $featured2);

	      	foreach($featured1 as $row1 ){
	      	$gamename = preg_replace('[^A-Za-z0-9]', '-', $row1['name']);
	      	if($seo_on == 1){
	      		$playlink = '/play/'.$row1['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = '/index.php?action=play&amp;ID='.$row1['ID'].'';
	      	}
	      	       echo ' <div class=\'gamehomeholder\' align=\'center\'><a href=\''.$playlink.'\' title=\''.$row1['name'].'\'>';
				      		if($row1['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row1['thumb'].'\' width=\'120\' height=\'90\' alt= \''.$row1['name'].'\' border=\'0\'/><br />';
				      		}else{
				      		echo '	<img src=\'/'.$row1['thumburl'].'\' width=\'120\' height=\'90\' alt= \''.$row1['name'].'\' border=\'0\'/><br />';
				      		}

				      		echo '<a href=\''.$playlink.'\'>'.namelimit($row1['name']).'</a></div>';
	      	}


echo '</td></tr></div></table>' ;


$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$max = $limitboxgames;
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max;
$r2 = "SELECT * FROM fas_games WHERE active='1' ORDER BY ID DESC LIMIT 0,".$limitboxgames ;
// $r2 = "SELECT * FROM fas_games WHERE active='1' ORDER BY ID DESC LIMIT 0,".$limits.",".$max ;
$sqltitle = "home page";
$r1 = sqlcache($sqltitle, $cachelife, $r2);
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE active=\'1\''),0);
$totalpages = ceil($totalres / $max);
echo '<table width=\'100%\' border=\'0\' align=\'left\'>
	<tr>
		<td colspan=\'2\' class=\'header\' >Free Online Games</td>
	</tr>
      ';
$count = 0;
if(!$db->num_rows($r)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There is no games currently installed, Check Back Soon!</td>
	    </tr>';
}
echo '<tr><td colspan=\'2\' class=\'content\' ><div align=\'left\'>' ;
foreach($r1 as $in ){
$gamename = preg_replace('[^A-Za-z0-9]', '', $in['name']);

	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}


       echo '


	      				<div class=\'gamehomeholder\' align=\'center\'><a href=\''.$playlink.'\' title=\''.$in['name'].'\'>
	      				';
				      		if($in['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'120\' width=\'90\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'120\' width=\'90\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}

				      		echo '	<a href=\''.$playlink.'\'>'.namelimit($row1['name']).'</a></div>';



$count++;
}



echo '</div></td></tr><br />';



echo "</table>";


$pgname = $sitename;

};



?>