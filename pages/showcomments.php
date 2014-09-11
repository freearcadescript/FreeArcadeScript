<?php
$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$name = clean($_GET['name']);
$max = $gamesonpage;
$show = clean($_GET['page']);
$show = abs((int) ($show));
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf('SELECT * FROM dd_comments WHERE gameid=\'%u\' and approved =\'1\' order by date desc LIMIT '.$limits.','.$max.' ', $ID));
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM dd_comments WHERE gameid=\''.$ID.'\''),0);	
$totalpages = ceil($totalres / $max); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'> Comments Left For '.$name.' </td>
	</tr>';

if(!$db->num_rows($r)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no comments left for this game.</td>
	</tr>';
}
while($in = $db->fetch_row($r)){
$comment = $in['comment'];
$commenter = abs((int) ($in['commenter']));
	$date = date('d-m-Y', $in['date']);

if ($commenter == '0') {$username = 'Guest';} else {
 $nv1 = $db->query(sprintf("SELECT username FROM dd_users WHERE userid='%u' limit 1 ", $commenter ));
 $nv2 = $db->fetch_row($nv1);
 $username = $nv2['username'];
 if (!$username) {$username="No longer a member";}; 
};






       echo ' <tr>
				<td width=\'30%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> '.$username.'</td>
				<td valig=\'top\' class=\'content\'>'.$in['comment'].'</td>
			</tr>
			<tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'><small><i><b>Posted On:</b> '.$date.'</i></small></td>
			</tr>
	';




}

echo "</table>";
echo 'Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urk = ''.$domain.'/showcomments/'.$name.'/'.$ID.'/'.$i.'.html';
}else{
	$urk = ''.$domain.'/index.php?action=showcomments&name='.$name.'&ID='.$ID.'&page='.$i.'';
}
echo '<a href=\''.$urk.'\' class=\'pagenat\'>'.$i.'</a>&nbsp; ';

}
echo '<br /><br />';


?>