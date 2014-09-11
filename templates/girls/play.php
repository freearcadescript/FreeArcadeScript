<?php
$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));

$ir1 = "SELECT * FROM dd_games WHERE ID='$ID'" ;
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
$fsponsoractive = $r['sponsoractive'];
if ( $fabovegames !='' ) { $abovegames = $fabovegames; };
if ( $fsponsoractive == '2' ) { $abovegames = $fsponsor; } ;
if ( $fsponsoractive == '1' ) { $abovegames .= "<p>Sponsorship Pending<p>"; } ;
if ( $fsponsoractive == '0' ) { $abovegames .= "<p>Put your ad here<p>"; };

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
global $db, $domain, $suserid, $ir, $ir2, $r, $cname, $sponsor, $ads1, $ads2, $ads3, $headerspace, $footerspace, $ID, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




if(!$ID){
	echo '<div class=\'error\'>No game selected.</div>';
	include ('templates/'.$template.'/footer.php');
	exit;
}
if(!$r['name']){
	echo '<div class=\'error\'>Game does not exist.</div>';
	
	exit;
}
 $ir = $db->query(sprintf('SELECT * FROM fas_games WHERE ID=\'%u\'', $ID));

 $r = $db->fetch_row($ir);

$cname = ereg_replace('[^A-Za-z0-9]', '-', $cname );
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
echo '
<table width=\'98%\' align=\'center\'>
	<tr>
		<td class=\'content\' colspan=\'2\' ><div align=\'center\'>'.$abovegames.'<p></div></td>
	</tr>
	<tr>
		<td class=\'header\' colspan=\'2\' >'.$r['name'].'</td>
	</tr>

	<tr>
		<td class=\'content\' align=\'center\' colspan=\'2\'>
		<div align=\'center\'>';
		if($r['type'] == 1){
		echo '	<object width=\''.$r['width'].'\' height=\''.$r['height'].'\' align=\'center\'>
				<param name=\'movie\' value=\''.$domain.'/'.$gamesfolder.'/'.$r['file'].'\'>
				<embed src=\''.$domain.'/'.$gamesfolder.'/'.$r['file'].'\' width=\''.$r['width'].'\' height=\''.$r['height'].'\'></embed>
			</object>';
		}else{
			echo $r['enabledcode'];
		}	
			
	echo '		
		</div>
		</td>
	</tr>
	<tr>
		<td class=\'header\' colspan=\'2\'>Details</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'><div align=\'center\'>'.$belowgames.'</div></td>
	</tr>

	<tr>
		<td class=\'content\' width=\'70%\' valign=\'top\'><b>Description:</b> '.$r['description'].'</td>
		<td class=\'content\' valign=\'top\' style=\'padding:2px;\'><b>Total Views:</b> '.$r['views'].'<br />
										<a href=\''.$domain.'/index.php?action=addtofavorites&cmd='.$ID.'\'>Add to my favorites</a></td>
	</tr>
	<tr>
		<td class=\'header\' colspan=\'2\'>Rating</td>
	</tr>
	<tr>
		<td class=\'content\' width=\'100%\' colspan=\'2\' valign=\'top\' align=\'center\'>
		<div align="center">'; echo pullRating($ID,true,false,true); echo '
		</div></td>
</tr>
	<tr>
		<td colspan=\'2\' class=\'header\'>Bored of this game? check these out!</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'>
		<div align=\'center\' style=\'padding:5px;\'>';
	$rrb = $db->query('SELECT * FROM fas_games ORDER BY RAND() LIMIT 0,6');
		
	echo '<table align=\'center\'>';
	
	while($ro = $db->fetch_row($rrb)){
$gamename = ereg_replace('[^A-Za-z0-9]', '', $ro['name']);
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
	<div align=\'center\'><A href=\''.$playlink.'\'>
	<img src=\''.$imgg.'\' border=\'0\' width=\'65\' height=\'65\'><br />
	'.$ro['name'].'</a>
	</div>
	</td>
		<td width=\'%2\'></td>';
	}	
	echo '</table>	</div>
		</td>	
	</tr>';
	if($enabledcode_on == 1){
echo '	<tr>
		<td colspan=\'2\' class=\'header\'>Enabled Code</td>
	</tr>
	<tr>
		<td class=\'content\' colspan=\'2\'>
		<div align=\'center\' style=\'padding:5px;\'>
		<textarea cols=\'60\' rows=\'5\'>';
	if($r['type'] == 1){
	echo '			
&lt;object width=&quot;500&quot; height=&quot;500&quot;&gt;
&lt;param name=&quot;movie&quot; value=&quot;'.$domain.'/'.$gamesfolder.$r['file'].'&quot;&gt;
&lt;embed src=&quot;'.$domain.'/'.$gamesfolder.$r['file'].'&quot; width=&quot;500&quot; height=&quot;500&quot;&gt;
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
	</tr>';
	}
	if($comments_on == 1){
echo '	<tr>
		<td class=\'header\' colspan=\'2\'>Comments</td>
	</tr>
	<tr>
		<td  width=\'70%\' valign=\'top\' colspan=\'2\' align=\'center\'>
		<div align=\'center\'>
		<table width=\'100%\' border=\'0\'>';
		$rrr2 = "SELECT * FROM fas_comments WHERE gameid='$ID' AND approved='1' ORDER BY date DESC LIMIT 3";
            $sqltitle = "gamecomments0-".$ID ;


            if ($rrr1 = sqlcache($sqltitle, $cachelife, $rrr2)) {
		foreach ($rrr1 as $row ){
		$date = date('d-m-Y', $row['date']);
            $useridc=$row['commenter'] ;
		$rra2 = "SELECT * FROM fas_users WHERE userid='$useridc'";

            $sqltitle = "userprofile-".$row['commenter'] ;
            $rra1 = sqlcache($sqltitle, $cachelife, $rra2);
            foreach ( $rra1 as $rra ) {
            $useridl=$row['commenter'];
            if ( $rra['avatar'] == '1' ) { $avatarfileurl = '<p><img src=\''.$domain.'/avatars/'.$rra['avatarfile'].'\' height=\'100\' width=\'100\' border=\'0\'>'; } else { $avatarfileurl = ''; };


            if($seo_on == 1){
	           $urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
            }else{
       	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$useridl ;
            };
            if ( $row['commenter'] == '0' ) {$commenter='Guest';} else {$commenter=$rra['username'];};
		echo '	<tr>
				<td width=\'20%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> <a href="'.$urlp.'">'.$commenter.$avatarfileurl.'</a><p>
                        <small><i><b>Posted On:</b> '.$date.'</i></small>
                        </td>
				<td valign=\'top\' class=\'content\'>'.$row['comment'].'</td>
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
	$urco = ''.$domain.'/index.php?action=showcomments&name='.$cname.'&ID='.$ID.'&page=1';
};


		echo ' <tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'><a href=\''.$urco.'\'><small><i><b>More Comments</b></i></small></a></td>
			</tr>';
              
		$gamename = ereg_replace('[^A-Za-z0-9]', '', $r['name']);
			if($seo_on == 1){
				$comlink = ''.$domain.'/play/'.$ID.'-'.$gamename.'.html';
			}else{
				$comlink = ''.$domain.'/index.php?action=play&amp;ID='.$ID.'';
			}	



                        if(!isset($suserid)) { $commentvar = 'You must be logged in to post a comment'; }
                        else {$commentvar = '
				<form action=\''.$comlink.'\' method=\'POST\'>
				<textarea cols=\'35\' rows=\'5\' name=\'comment\'></textarea>
				<br />
				<input type=\'submit\' name=\'commentsubmit\' value=\'Add Comment\'>
				</form>' ;
                        } ;



		echo '	<tr>
				<td colspan=\'2\' class=\'header\'>Post Comment</td>
			</tr>
			<tr>
				<td colspan=\'2\' class=\'content\'>
				<div align=\'center\'>
                        '.$commentvar.'
				</div>
				</td>
			</tr>
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
	<tr>
		<td class=\'header\' colspan=\'2\'>Tell a Friend</td>
	</tr>
	<tr>
		<td  width=\'70%\' valign=\'top\' colspan=\'2\' class=\'content\' align=\'center\'>
		<div align=\'center\'>

<form action =\''.$taf1.'\' method=\'POST\'>
Your Name: <input type=\'text\' name=\'sender\' size=\'50\'><br>
Your friend\'s e-mail: <input type=\'text\' name=\'recipient\' size=\'50\'>
<input type=\'hidden\' name=\'gamei\' value=\''.$ID.'\'>
<input type=\'hidden\' name=\'gamen\' value=\''.$gamename.'\'>

<input type=\'submit\' value=\'Send\'>





            </div>
            </td>
      </tr>

</table>';
$useridp=$usrdata['userid'] ;
if ($useridp=='0' or $useridp=='') {$useridp='-1'; };
$db->query(sprintf('UPDATE fas_games SET views=views+1 WHERE ID=\'%u\'', $ID));

if ($useridp!='-1') {
$db->query('UPDATE fas_users SET plays=plays+1 WHERE userid=\''.$useridp.'\'');
 };


};

?>