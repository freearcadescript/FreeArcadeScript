<?php


function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);	
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf('SELECT * FROM fas_games ORDER BY dateadded DESC LIMIT '.$limits.','.$max.' '));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games'),0);
$totalpages = ceil($totalres / $max);
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Newest Games</td>
	</tr>';
$count = 0;
while($in = $db->fetch_row($r)){
$gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
if($count%2==0){

       echo '<tr>
	      	<td width=\'50%\' valign=\'top\'>

	      		<table width=\'100%\' border=\'0\'>
	      			<tr>
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.titlelimit($in['name']).'</b></td>
	      			</tr>
	      			<tr>
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' height=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' height=\'55\' border=\'0\'>';
				      		}

				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.desclimit($in['description']).'
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>
	      		</table>

	      	</td>
	';
}else{
 echo '
	      	<td width=\'50%\' valign=\'top\'>

	      		<table width=\'100%\' border=\'0\'>
	      			<tr>
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.titlelimit($in['name']).'</b></td>
	      			</tr>
	      			<tr>
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' height=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' height=\'55\' border=\'0\'>';
				      		}

				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.desclimit($in['description']).'
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>
	      		</table>

	      	</td>
	</tr>';
}
$count++;
}

echo "</table>";
echo'<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/newest/page'.$pre.'.html';
	$next = ''.$domain.'/newest/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=newest&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=newest&page='.$ne.'';
	}
if ($totalpages != '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){ 
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/newest/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=newest&page='.$i.'';
				}
	
				if($show == $i){
					echo '<a href="'.$urk.'" class="page-select">'.$i.'</a>';
				}else{
					echo '<a href="'.$urk.'" class="page">'.$i.'</a>';
				}
			}
		}
	}
	if ($show < $totalpages){
		echo '<a href="'.$next.'" class="page">Next</a>';
	}
}
echo'</div>';

};

$pagetitle = $sitename.' - Newest Games';
$metatags = 'new games, latest games, newest games';
$metadescription = $sitename.' newest Games';
?>