<?php


function writebody() {
global $db, $cachelife, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




if(!isset($_GET['ID'])){
	$ID = NULL;
}else{
	$ID = clean($_GET['ID']);
}
if(!isset($_GET['name'])){
	$name = NULL;
}else{
	$name = clean($_GET['name']);
}
$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r = "SELECT * FROM fas_comments WHERE gameid='$ID' and approved ='1' order by date desc LIMIT ".$limits.", ".$max ;

$sqltitle = "gamecomments".$show."-".$ID ;
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_comments WHERE gameid=\''.$ID.'\' and approved=\'1\' '),0);
$totalpages = ceil($totalres / $max);
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'> Comments Left For '.$name.' </td>
	</tr>';
$nr = mysql_query($r);

if(!$db->num_rows($nr)){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no comments left for this game.</td>
	</tr>';
} else {
$r4 = sqlcache($sqltitle, $cachelife, $r);
foreach ( $r4 as $in ){
$comment = $in['comment'];
$commenter = abs((int) ($in['commenter']));
$date = date('M-d-Y', $in['date']);

 $nv1 = "SELECT * FROM fas_users WHERE userid='$commenter' limit 1 "  ;
 $sqltitle = "userprofile-".$commenter;
 $nv3 = sqlcache($sqltitle, $cachelife, $nv1);

 foreach ( $nv3 as $nv2 ){
 $useridl = $nv2['userid'];
 if (empty($username)) {$username="No longer a member";};

if ($commenter == '0') {$username = 'Guest';} else {

 $username = $nv2['username'];
};

            if($seo_on == 1){
	           $urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
            }else{
       	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$useridl ;
            };




            $avatarfileurl = get_avatar($useridl);



            echo '<tr>
				<td width=\'30%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'>
				<b>Posted By:</b> <a href="'.$urlp.'">'.$username.'</a><br />
				<a href="'.$urlp.'"><img src=\''.$domain.'/avatars/'.$avatarfileurl.'\' height=\'100\' width=\'100\' /></a><br />
                <small><i><b>Posted On:</b> '.$date.'</i></small>
                </td>

				<td valig=\'top\' class=\'content\' valign=\'top\'>'.$in['comment'].'</td>
			</tr>
			<tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'>&nbsp;</td>
			</tr>
	';

};
};

}

echo '</table>
<div class="page-box">
'.$totalres.' comment(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/showcomments/'.$name.'/'.$ID.'/'.$pre.'.html';
	$next = ''.$domain.'/showcomments/'.$name.'/'.$ID.'/'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=showcomments&name='.$name.'&ID='.$ID.'&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=showcomments&name='.$name.'&ID='.$ID.'&page='.$ne.'';
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
					$urk = ''.$domain.'/showcomments/'.$name.'/'.$ID.'/'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=showcomments&name='.$name.'&ID='.$ID.'&page='.$i.'';
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
?>