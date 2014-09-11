<?php
$max = '70';
$show = clean($_GET['page']);
if(empty($show)){
$show = 1;
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf("SELECT * FROM dd_users ORDER BY username ASC LIMIT $limits,$max"));
$totalres = mysql_result($db->query('SELECT COUNT(userid) AS total FROM dd_users'),0); 
$totalpages = ceil($totalres / $max); 
echo '

<table width="89%" align="center">
	<tr>
		<td colspan=\'4\' class=\'header\'>User List</td>
	</tr>
<tr>
<th class="header">#</th>
<th class="header">Name</th>
<th class="header">Plays</th>
<th class="header"> </th>
</tr>';
while($ir = $db->fetch_row($r)){
$useridl=$ir['userid'];
if($seo_on == 1){
	$urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
}else{
	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$useridl ;
}



echo ' <tr>
<td class="content">'.$ir['userid'].'</td>
<td class="content">'.$ir['username'].'</td>
<td class="content">'.$ir['plays'].'</td>
<td class="content"><a href="'.$urlp.'">View Profile</a></td>
</tr>';
}

echo '</table>
<div align="center">Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urlmp = ''.$domain.'/memberslist/'.$i.'.html';
}else{
	$urlmp = ''.$domain.'/index.php?action=memberslist&page='.$i ;
}


echo '<a href="'.$urlmp.'" class="pagenat">'.$i.'</a>&nbsp;';

}
echo '<p></div>';
$pgname = 'Member list';




?>