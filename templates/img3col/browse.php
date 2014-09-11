<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$max = $gamesonpage;
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$r2 = "SELECT * FROM dd_games WHERE category='$ID' && active='1' ORDER BY ID DESC LIMIT ".$limits.",".$max ;
$sqltitle = "browse-cat".$ID."page".$show;
$r1 = sqlcache($sqltitle, $cachelife, $r2);
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM dd_games WHERE active=\'1\' and category=\''.$ID.'\''),0);	
$totalpages = ceil($totalres / $max); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\' >'.clean($_GET['name']).' Games</td>
	</tr>
      ';
$count = 0;
if(!$db->num_rows($r)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no games in this category.</td>
	</tr>';
}
echo '<tr><td colspan=\'2\' class=\'content\' ><div align=\'center\'>' ;
foreach($r1 as $in ){
$gamename = ereg_replace('[^A-Za-z0-9]', '', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}






       echo '
	      	
	      		
	      				<a href=\''.$playlink.'\' title=\''.$in['name'].'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'80\' width=\'80\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'80\' width=\'80\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}
				      			
				      		echo '	</a>';



$count++;
}

echo "</div></td></tr></table>";
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

};

$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$show = clean($_GET['page']);
if(empty($show)){
	$show = 1; };
$m1 = mysql_query("SELECT * FROM dd_categories where ID='$ID' limit 1 ");	

$m4 = mysql_fetch_row($m1) ;
$pagetitle = $m4[1];
$pagetitle .= ' games - Page '.$show ;
$metatags = $m4[2];
if ( $metatags == '' ) { $metatags = $m4[1]; };
$metadescription = $m4[3];
if ( $metadescription == '' ) { $metadescription = $pagetitle; } ;

?>