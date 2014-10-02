<?php


function writebody() {
global $db, $cachelife, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




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
	$date = date('d-m-Y', $in['date']);

 $nv1 = "SELECT * FROM fas_users WHERE userid='$commenter' limit 1 "  ;
 $sqltitle = "userprofile-".$commenter; 
 $nv3 = sqlcache($sqltitle, $cachelife, $nv1);

 foreach ( $nv3 as $nv2 ){
 $useridl = $nv2['userid'];
 if (!$username) {$username="No longer a member";}; 

if ($commenter == '0') {$username = 'Guest';} else {

 $username = $nv2['username'];
};

            if($seo_on == 1){
	           $urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
            }else{
       	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$useridl ;
            };




            if ( $nv2['avatar'] == '1' ) { $avatarfileurl = '<p><img src=\''.$domain.'/avatars/'.$nv2['avatarfile'].'\' height=\'100\' width=\'100\' border=\'0\'>'; } else { $avatarfileurl = ''; };



       echo ' <tr>
				<td width=\'30%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> <a href="'.$urlp.'">'.$username.$avatarfileurl.'</a><p>
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

};
?>