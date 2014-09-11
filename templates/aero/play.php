<?php
$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));

$ir1 = "SELECT * FROM fas_games WHERE ID='$ID'" ;
$sqltitle = "gamedata-".$ID ;
$ir2 = sqlcache($sqltitle, $cachelife, $ir1);

foreach ( $ir2 as $r ); {

$fsponsor = $r['sponsor'];
$fads1 = $r['ads1'];
if ( $fads1 !='' ) { $ads1 = $fads1; };
$fads2 = $r['ads2'];
if ( $fads2 !='' ) { $ads2 = $fads2; };
$fads3 = $r['ads3'];
if ( $fads3 !='' ) { $ads3 = $fads3; };
$fabovegames = $r['abovegames'];

$fbelowgames = $r['belowgames'];
if ( $fbelowgames !='' ) { $belowgames = $fbelowgames; };
$fheaderspace = $r['headerspace'];
if ( $headerspace !='' ) { $headerspace = $fheaderspace; };
$ffooterspace = $r['footerspace'];
if ( $ffooterspace !='' ) { $footerspace = $ffooterspace; };
$cname = $r['name'];
$metadescription = $r['description'];
$pagetitle=$cname;
if ( $r['tags'] == '' ) { $metatags = $cname; } else { $metatags = $r['tags']; };
};
 
// $gwidth
// $gheight
// $gfile
// $genabledcode
// $gdescription
// $gviews

function writebody() {
global $db, $domain, $suserid, $cachelife, $ir, $ir2, $r, $cname, $sponsor, $ads1, $ads2, $ads3, $headerspace, $footerspace, $ID, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $avatar_on, $gender_on, $aimg, $fimg, $mimg;




if(!$ID){
	echo '<div class=\'error\'>No game selected.</div>';
	return;
}
if(!$r['name']){
	echo '<div class=\'error\'>Game does not exist.</div>';
	
	return;
}
 $ir = $db->query(sprintf('SELECT * FROM fas_games WHERE ID=\'%u\'', $ID));

 $r = $db->fetch_row($ir);

$cname = preg_replace('#\W#', '-', $cname );
if(isset($_POST['commentsubmit'])){
	$commenter = $usrdata['userid'];
      
	$gameid = $ID;
	$comment = clean($_POST['comment']);
	$date = time();
	if($autoapprovecomments == 1){
		$approved = 1;
	}else{
		$approved = 0;
	}
	$db->query(sprintf('INSERT INTO fas_comments SET
						gameid=\'%u\',
						commenter=\'%u\',
						comment=\'%s\',
						date=\'%u\',
						approved=\'%u\'
						', $ID, $commenter, $comment, $date, $approved));
	if($autoapprovecomments == 1){
		$msgcom = 'Comment Posted.';
	}else{
		$msgcom = 'Comment Posted, Awaiting admin approval.';
	}
	echo '<div class=\'msg\'>'.$msgcom.'</div><br />';
}
echo '<table width=\'100%\' align=\'center\'>';
				 if (!$abovegames == "") { 
	echo '<tr>
		<td class=\'content\' colspan=\'2\' ><div align=\'center\'>'.$abovegames.'<p></div></td>
	</tr>'; };
	echo'	<tr>
		<td class=\'header\' colspan=\'2\' >'.$r['name'].'</td>
	</tr>

	<tr>
		<td class=\'content\' align=\'center\' colspan=\'2\'>
		<div align=\'center\'>';
		if($r['type'] == 1){
		/**echo '<object width=\''.$r['width'].'\' height=\''.$r['height'].'\'>
				<param name=\'movie\' value=\''.$domain.'/'.$gamesfolder.'/'.$r['file'].'\' />
				<embed src=\''.$domain.'/'.$gamesfolder.'/'.$r['file'].'\' width=\''.$r['width'].'\' height=\''.$r['height'].'\'></embed>
			</object>';**/
			
		echo'<object type="application/x-shockwave-flash" data="'.$domain.'/'.$gamesfolder.'/'.$r['file'].'" width="'.$r['width'].'" height="'.$r['height'].'">
 				<param name="movie" value="'.$domain.'/'.$gamesfolder.'/'.$r['file'].'" />
 			</object>';
		}else{
			echo $r['enabledcode'];
		}	
			
	echo '		
		</div>
		</td>
	</tr>
	</table>

	<table width=\'100%\'>
	<tr>
		<td class=\'header\' colspan=\'2\'>Details</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'><div align=\'center\'>'.$belowgames.'</div></td>
	</tr>

	<tr>
		<td class=\'content\' width=\'70%\' valign=\'top\'><b>Description:</b> '.$r['description'].'
		<br />';
		$query = "SELECT category FROM fas_games WHERE ID='$ID'";
		$result = mysql_query($query);

		$category1 = mysql_result($result, 0, "category");

		$query2 = "SELECT name FROM fas_categories WHERE ID='$category1'";
		$result2 = mysql_query($query2);

		$name = mysql_result($result2, 0, "name");
		echo'<b>Category:</b> '.$name.'
		<br />
		<div align="left">'; echo pullRating($ID,true,false,true); echo '
		</div>
		<br />
		';
if($usrdata['user_level'] == 2){
	echo '
<div style="float: right; vertical-align: top; padding-right: 20px;">
		<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=edit&amp;ID='.$r['ID'].'&amp;type='.$r['type'].'\' onclick="return confirm(\'Are you sure you want to edit the game '.$r['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/edit.png\' title=\'edit game\' alt=\'edit game\' border=\'0\' /></a>
		<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=delete&amp;ID='.$r['ID'].'\' onclick="return confirm(\'Are you sure you want to delete the game '.$r['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/images/delete.png\' title=\'delete game\' alt=\'delete game\' border=\'0\' /></a></div><br />
';
}
echo '</td>
		<td class=\'content\' valign=\'top\' style=\'padding:2px;\' width="30%"><b>Total Views:</b> '.$r['views'].'<br />';
		if ($seo_on == 1){
		echo '<a href=\''.$domain.'/addtofavorites/'.$ID.'/\'>Add to my favorites</a><br />';
		}else{
		echo '<a href=\''.$domain.'/index.php?action=addtofavorites&amp;cmd='.$ID.'\'>Add to my favorites</a><br />';	
		}
		if ($seo_on == 1){
		echo '<a href=\''.$domain.'/report/'.$ID.'/\'>Report broken</a></td>';
		}else{
		echo '<a href=\''.$domain.'/index.php?action=report&amp;cmd='.$ID.'\'>Report broken</a></td>';	
		}
	echo '</tr>
	</table>
	<table  width="100%">
	<tr>
		<td colspan=\'2\' class=\'header\'>Bored of this game? check these out!</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'>
		<div align=\'center\' style=\'padding:5px;\'>';
	$rrb = $db->query('SELECT * FROM fas_games WHERE `active`=\'1\' ORDER BY RAND() LIMIT 0,8');
		
	echo '<table align=\'center\'>
			<tr>';
	
	while($ro = $db->fetch_row($rrb)){
$gamename = preg_replace('#\W#', '', $ro['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$ro['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$ro['ID'].'';
	}
	if($ro['type'] == 1){
		$imgg = ''.$domain.'/'.$thumbsfolder.'/'.$ro['thumb'].'';
	}else{
		$imgg = $ro['thumburl'];
	}	
	echo '<td>
	<div align=\'center\'><a href=\''.$playlink.'\'>
	<img src=\''.$imgg.'\' border=\'0\' width=\'65\' height=\'65\' alt=\''.$gamename.'\' /><br />
	</a>
	</div>
	</td>
		<td width=\'2%\'></td>';
	}	
	echo '</tr>
			</table>
		</div>
		</td>	
	</tr>
	</table>';
	if($enabledcode_on == 1 && $usrdata['user_level'] >= 1){
echo '<table width="100%">
	<tr>
		<td colspan=\'2\' class=\'header\'>Enabled Code</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'>
		<div align=\'center\' style=\'padding:5px;\'>
		<textarea cols=\'60\' rows=\'5\'>';
	if($r['type'] == 1){
	echo '			
&lt;object width=&quot;500&quot; height=&quot;500&quot;&gt;
&lt;param name=&quot;movie&quot; value=&quot;'.$domain.'/'.$gamesfolder.'/'.$r['file'].'&quot;&gt;
&lt;embed src=&quot;'.$domain.'/'.$gamesfolder.'/'.$r['file'].'&quot; width=&quot;500&quot; height=&quot;500&quot;&gt;
&lt;/embed&gt;
&lt;/object&gt;	';
}else{
echo '
'.$r['enabledcode'].'
';
}	
		
	echo '	</textarea>
		</div>
		</td>	
	</tr>
	</table>';
	}
	if($comments_on == 1){
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
		
		$rrr2 = "SELECT * FROM fas_comments WHERE gameid='$ID' AND approved='1' ORDER BY date DESC LIMIT 3";
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
	</table>';
	}
if($seo_on == 1){
		$taf1 = ''.$domain.'/taf/';
	}else{
		$taf1 = ''.$domain.'/index.php?action=taf';
	};
	echo '		
					
</div>
		</td>
	</tr>
	</table>';
		if($enabledcode_on == 1 && $usrdata['user_level'] >= 1){
	echo '<table width="100%">
<tr>
		<td class=\'header\' colspan=\'2\'>Tell a Friend</td>
	</tr>
	<tr>
		<td  width=\'70%\' valign=\'top\' colspan=\'2\' class=\'content\' align=\'center\'>
		<div align=\'center\'>

<form action =\''.$taf1.'\' method=\'POST\'>
<tr>
<td class=\'content\'>Your Name: </td>
<td class=\'content\'><input type=\'text\' name=\'sender\' size=\'50\'></td>
</tr>
<tr>
<td class=\'content\'>Your friend\'s e-mail: </td>
<td class=\'content\'><input type=\'text\' name=\'recipient\' size=\'50\'></td>
</tr>
<tr>
<td class=\'content\' colspan=\'2\'>
<input type=\'hidden\' name=\'gamei\' value=\''.$ID.'\'>
<input type=\'hidden\' name=\'gamen\' value=\''.$gamename.'\'>

<input type=\'submit\' value=\'Send\'>
</td>
</tr>
</div>
     </td>
     </tr>
</table>';

};
$useridp=$usrdata['userid'] ;
if ($useridp=='0' or $useridp=='') {$useridp='-1'; };
$db->query(sprintf('UPDATE fas_games SET views=views+1 WHERE ID=\'%u\'', $ID));

if ($useridp!='-1') {
$db->query('UPDATE fas_users SET plays=plays+1 WHERE userid=\''.$useridp.'\'');
 };


};

?>