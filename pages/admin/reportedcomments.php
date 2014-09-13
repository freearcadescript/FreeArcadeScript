<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}
switch($_GET['cmd']){
	default:
	listreport();
	break;

	case 'solved':
	solved();
	break;
}
function listreport(){
global $domain, $db;



$max = '50';
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);	
}
$limits = ($show - 1) * $max; 
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_report_comments'),0); 
$totalpages = ceil($totalres / $max);

	$r = mysql_query("SELECT * FROM fas_report_comments ORDER BY ID DESC limit $limits,$max");
	echo '<div class="heading">
		<h2>Reported Blogs</h2>
	</div>
	<table id="table">
		<thead>
			<tr>
				<th>Reported By</th>
				<th colspan="2">Blog Entry</th>
			</tr>
		</thead>';
	while($row = $db->fetch_row($r)){
		
		$gameid = $row['gameid'];
    	$gamename = $row['gamename'];
    	$suserid = $row['userid'];
		$hi = mysql_query("SELECT username FROM fas_users WHERE userid='$suserid'");
		$blah = mysql_fetch_array($hi);
		$type = $blah[0];
		if($suserid == '0'){
			$user = 'Guest';	
		}else{
			$result = mysql_query("SELECT username FROM fas_users WHERE userid='$suserid'");
			$name = mysql_fetch_array($result);
			$user = $name[0];
		}
	echo '<tbody>
		<tr>
			<td width="155px">'.$user.'</td>
			<td width="655px"><a href=\''.$domain.'/index.php?action=admin&case=testgame&gameid='.$gameid.'\' target=\'_blank\'>'.$gamename.'</a></td> 
			<td><a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$gameid.'&type='.$type.'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=delete&ID='.$gameid.'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$gamename.'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=reported&cmd=solved&ID='.$gameid.'\' ><img src="pages/admin/img/approve.png" width="24" height="24" alt="solved" title="Solved" /></a></td> 
		</tr>
	</tbody>'; }
echo '</table>
<div class="page-box">'.$totalres.' report(s) - Page '.$show.' of '.$totalpages.' - ';
for($i = 1; $i <= $totalpages; $i++){ 
	if($show == $i){
		echo '<a href="'.$domain.'/index.php?action=admin&case=reported&page='.$i.'" class="page-select">'.$i.'</a>&nbsp;';
	}else{
		echo '<a href="'.$domain.'/index.php?action=admin&case=reported&page='.$i.'" class="page">'.$i.'</a>&nbsp;';
	}
}
echo '</div><p>';
}




function solved(){
global $domain, $db;
	
	$ID = clean($_GET['ID']);
	$ID = abs((int) ($ID));
	mysql_query("DELETE FROM fas_report_comments WHERE gameid='$ID'");
	echo'<div class="msg">Game Solved.</div>';
}
?>