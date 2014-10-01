<?php
$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$max = 1;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);	
}
$limits = ($show - 1) * $max; 
//$rrr2 = "SELECT * FROM fas_comments WHERE gameid='$ID' AND approved='1' ORDER BY date DESC LIMIT 3";
$rrr2 = "SELECT * FROM fas_comments WHERE gameid='$ID' AND approved='1' ORDER BY date DESC LIMIT ".$limits.",".$max ;
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_comments WHERE approved=\'1\' and gameid=\''.$ID.'\''),0);	
$totalpages = ceil($totalres / $max); 
echo '<table  width="100%">
<tr>
		<td class=\'header\' colspan=\'2\'>Comments</td>
	</tr>
	<tr>
		<td  width=\'70%\' valign=\'top\' colspan=\'2\' align=\'center\'>
		<div align=\'center\'>
		<table width=\'100%\' border=\'0\'>';
		$gamename = preg_replace('#\W#', '', $r['name']);
			if($seo_on == 1){
				$comlink = ''.$domain.'/play/'.$ID.'-'.$gamename.'.html';
			}else{
				$comlink = ''.$domain.'/index.php?action=play&amp;ID='.$ID.'';
			}
			if(!isset($suserid)) { $commentvar = 'You must be logged in to post a comment'; }
            else {$commentvar = '
				<form action=\''.$comlink.'\' method=\'post\'>
				<textarea cols=\'60\' rows=\'5\' name=\'comment\'></textarea>
				<br />
				<input type=\'submit\' name=\'commentsubmit\' value=\'Add Comment\' />
				</form>' ;
                        } ;



		echo '	<tr>
				<td colspan=\'2\' class=\'content\'>
				<div align=\'center\'>
                        '.$commentvar.'
				</div>
				</td>
			</tr>';
		
        $sqltitle = "gamecomments-".$ID ;


            if ($rrr1 = sqlcache($sqltitle, $cachelife, $rrr2)) {
		foreach ($rrr1 as $row ){
		$date = date('d-m-Y', $row['date']);
            $useridc=$row['commenter'] ;
		$rra2 = "SELECT * FROM fas_users WHERE userid='$useridc'";

            $sqltitle = "userprofile-".$row['commenter'] ;
            $rra1 = sqlcache($sqltitle, $cachelife, $rra2);
            foreach ( $rra1 as $rra ) {
            $useridl=$row['commenter'];
            $avatarfileurl = get_avatar($userid);


            if($seo_on == 1){
	           $urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
            }else{
       	$urlp = ''.$domain.'/index.php?action=showprofile&amp;profile='.$useridl ;
            };
            if ( $row['commenter'] == '0' ) {$commenter='Guest';} else {$commenter=$rra['username'];};
		echo '	<tr>
				<td width=\'20%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> <a href="'.$urlp.'">'.$commenter.'<img src=\''.$domain.'/avatars/'.$avatarfileurl.'\' height=\'100\' width=\'100\' /></a><p>
                        <small><i><b>Posted On:</b> '.$date.'</i></small>
                        </td>
				<td valign=\'top\' class=\'content\'>'.$row['comment'].'';
if($usrdata['user_level'] == 2){
	echo '
<div style="float: right; padding-right: 20px;"><a href=\''.$domain.'/index.php?action=admin&amp;case=approvecomments&amp;cmd=delete&amp;ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the 

comment?\')"><img src=\''.$domain.'/templates/'.$template.'/images/delete.png\' border=\'0\' alt=\'\' /></a></div>';
}

echo '<div style="float: right; padding-right: 20px;"><a href=\''.$domain.'/index.php?action=admin&amp;case=approvecomments&amp;cmd=delete&amp;ID='.$row['ID'].'\'"><img src=\''.$domain.'/templates/'.$template.'/images/report.png\' border=\'0\' alt=\'\' /></a></div>
				</td>
			</tr>
			<tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'>&nbsp;</td>
			</tr>';
			
		};
            };

} else { echo '<tr><td colspan=\'2\' class=\'content\'>no comments yet</td></tr>';};
if($seo_on == 1){
	$urco = ''.$domain.'/showcomments/'.$cname.'/'.$ID.'/1.html';
}else{
	$urco = ''.$domain.'/index.php?action=showcomments&amp;name='.$cname.'&amp;ID='.$ID.'&amp;page=1';
};


		echo ' <tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'><a href=\''.$urco.'\'><small><i><b>More Comments</b></i></small></a></td>
			</tr>';
          	
		echo '
	</table>
	<div class="page-box">
'.$totalres.' comment(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$pre.'.html';
	$next = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$ne.'';
	}
if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){ 
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$i.'';
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
echo'</div>';';
?>