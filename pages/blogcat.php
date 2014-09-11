<?php
$name = clean($_GET['name']);
$catname = clean($_GET['catname']);
$max = $blogentriesshown;
$show = clean($_GET['page']);
$show = abs((int) ($show));
$category = clean($_GET['category']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 

$r = $db->query(sprintf('SELECT * FROM blogentries WHERE visible=\'1\' and category=\'%s\' order by entryid desc LIMIT '.$limits.', '.$max.' ', $category));
/*
$totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM blogentries where category=\'$category\' '),0);	



*/
$r2 = mysql_query("SELECT * FROM blogentries where category='$category' ");	

$totalres = mysql_numrows($r2);
$totalpages = ceil($totalres / $max); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Blog Entries</td>
	</tr>';

if(!$db->num_rows($r)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no blog entries.</td>
	</tr>';
}

while($in = $db->fetch_row($r)){
$blogentry = $in['blogentry'];
$author = $in['author'];
$title  = $in['title'];
$entryid = abs((int) ($in['entryid']));
$entrydate = $in['entrydate'];

if ($seo_on == 1) {
$rburl = ''.$domain.'/blogentry/entryid/'.$entryid.'/1.html';
} else {
$rburl = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid ; };
$body = $in['body'];

if(strlen($body) > $blogcharactersshown) { $body = substr($body, 0, $blogcharactersshown) ; $body .= '...';};

$bodystring = str_replace("[urlhead]","<a href='http://",$body);
$bodystring = str_replace("[urlmid]","'>",$bodystring);
$bodystring = str_replace("[urlend]","</a>",$bodystring);
$bodystring = str_replace("[imghead]","<img src='http://",$bodystring);
$bodystring = str_replace("[imgend]","'>",$bodystring);
$bodystring = str_replace("[bhead]","<b>",$bodystring);
$bodystring = str_replace("[bend]","</b>",$bodystring);
$bodystring = str_replace("[p]","<p>",$bodystring);
$body = str_replace("[br]","<br>",$bodystring);




       echo ' <tr>
				<td width=\'15%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> '.$author.'</td>
				<td valig=\'top\' class=\'content\'><a href=\''.$rburl.'\' >'.$title.'</a><p>'.$body.'</td>
			</tr>
			<tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'><small><i><b>Posted On:</b> '.$entrydate.'</i></small></td>
			</tr>
	';




}

echo "</table>";

echo 'Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urk = ''.$domain.'/blog/'.$category.'/'.$i.'/';
}else{
	$urk = ''.$domain.'/index.php?action=blogcat&category='.$category.'&page='.$i.'';
}
echo '<a href=\''.$urk.'\' class=\'pagenat\'>'.$i.'</a>&nbsp; ';

}
echo '<br /><br />';


?>