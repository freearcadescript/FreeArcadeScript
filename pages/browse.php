<?php
$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$max = $gamesonpage;
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf('SELECT * FROM dd_games WHERE category=\'%u\' && active=\'1\' ORDER BY ID DESC LIMIT '.$limits.','.$max.' ', $ID));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM dd_games WHERE category=\''.$ID.'\''),0);	
$totalpages = ceil($totalres / $max); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>'.clean($_GET['name']).' Games</td>
	</tr>';
$count = 0;
if(!$db->num_rows($r)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no games in this category.</td>
	</tr>';
}
while($in = $db->fetch_row($r)){
$gamename = ereg_replace('[^A-Za-z0-9]', '', $in['name']);
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
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.$in['name'].'</b></td>
	      			</tr>
	      			<tr>	
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.browsedesclimit($in['description']).' 
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
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.$in['name'].'</b></td>
	      			</tr>
	      			<tr>	
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.browsedesclimit($in['description']).' 
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>
	      		</table>
	      			
	      	</td>
	</tr>';
}
$count++;
}

echo "</table>";
echo 'Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urk = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$i.'.html';
}else{
	$urk = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$i.'';
}
echo '<a href=\''.$urk.'\' class=\'pagenat\'>'.$i.'</a>&nbsp; ';

}
echo '<br /><br />';


$pgname = clean($_GET['name']);


?>