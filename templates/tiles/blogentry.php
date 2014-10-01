<?php


function writebody() {
global $db, $suserid, $entryid, $cachelife, $sitename, $domain, $directorypath, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username, $avatar_on, $gender_on, $aimg, $fimg, $mimg, $seoheading, $seotext, $showpages;

function show(){
global $domain, $db, $seo_on, $usrdata, $entryid, $suserid, $template, $cachelife, $gamesfolder, $thumbsfolder, $directorypath, $ads1, $ads2, $ads3, $showblog, $showpages;
// $r3 = $db->query(sprintf('SELECT * FROM fas_blogentries WHERE entryid=\'%u\'', $entryid));
// $r4 = $db->fetch_row($r3);
$r3 = "SELECT * FROM fas_blogentries WHERE entryid='$entryid'" ;
$sqltitle = "blogentry-".$entryid ;
$r1 = sqlcache($sqltitle, $cachelife, $r3);
foreach ( $r1 as $r4 )
{
$title = $r4['title'];
$body = $r4['body'];
$author = $r4['author'];
$entrydate = $r4['entrydate'];
$visible = $r4['visible'];
$category = $r4['category'];
$tags = $r4['tags'];
};
 $chr_limit = 120;
$add = '...';

$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $body, $url)){
	$bodystring = preg_replace($reg_exUrl, "<a href='".$url[0]."'>{$url[0]}</a> ", $body);
}else{
	$bodystring = $body;
}
//$bodystring = ereg_replace("!(http:/{2}[\w\.]{2,}[/\w\-\.\?\&\=\#]*)!e", "'<a href=\"\\1\" title=\"\\1\" target=\"_blank\">'.(strlen('\\1')>=$chr_limit ? substr('\\1',0,$chr_limit).'$add':'\\1').'</a>'", $bodystring);

$bodystring = str_replace("[url]","<a href='http://",$bodystring);
$bodystring = str_replace("[urlmid]","'>",$bodystring);
$bodystring = str_replace("[/url]","</a>",$bodystring);
$bodystring = str_replace("[img]","<img alt='' src='http://",$bodystring);
$bodystring = str_replace("[/img]","' />",$bodystring);
$bodystring = str_replace("[b]","<b>",$bodystring);
$bodystring = str_replace("[/b]","</b>",$bodystring);
$bodystring = str_replace("[i]","<i>",$bodystring);
$bodystring = str_replace("[/i]","</i>",$bodystring);
$bodystring = str_replace("[u]","<u>",$bodystring);
$bodystring = str_replace("[/u]","</u>",$bodystring);
$bodystring = str_replace("\n","<br />",$bodystring);
$body = str_replace("[br]","<br />",$bodystring);

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">'.$title.' - '.$entrydate.'</div>';


echo '<table width=\'100%\' border=\'0\' align=\'center\'>
      <tr>
		<td colspan=\'2\' class=\'content\'>'.$body.'</td>
	</tr>
      <tr>
		<td colspan=\'2\' class=\'content\'>Posted By: '.$author.'</td>
	</tr>
      <tr>
		<td colspan=\'2\' class=\'content\'>Tags: '.$tags.'</td>
	</tr>
';


echo '</table>';



echo'<div class="content_nav">Submit Comment</div>';
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'content\'>';
             if(!isset($suserid)) { echo 'You must be logged in to submit a comment</td></tr>'; } else {


			if($seo_on == 1){
				$sublink = ''.$domain.'/blogentry/submitcomment/';
			}else{
				$sublink = ''.$domain.'/index.php?action=blogentry&cmd=submitcomment';
			};
             echo '     Comment Title:<br />
				<form action=\''.$sublink.'\' method=\'post\'>
                        <input type=\'hidden\' name=\'entryid\' value=\''.$entryid.'\' />

                        <input type=\'text\' size=\'40\' name=\'commenttitle\' /><p>Body of Comment:</p><br />
                        <small>(HTML and BBCode do not work.)</small><br />
				<textarea cols=\'35\' rows=\'5\' name=\'commentbody\'></textarea>
				<br />
				<input type=\'submit\' name=\'commentsubmit\' value=\'Add Comment\' />
				</form>



           </td>
	</tr>
                  ';};


echo '</table>';

listcomments ();
};

function listcomments(){
global $domain, $db, $seo_on, $usrdata, $entryid, $blogcommentsshown, $i, $blogfollowtags, $template, $gamesfolder, $thumbsfolder, $ads1, $ads2, $ads3, $showpages;

$blogentryid = $entryid;
$max = $blogcommentsshown;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;

 $r5 = $db->query(sprintf('SELECT * FROM fas_blogcomments WHERE blogentryid=\'%u\' and visible=\'1\' order by commentid desc LIMIT '.$limits.','.$max.' ', $entryid));


$totalres = mysql_result($db->query("SELECT COUNT(blogentryid) AS total FROM fas_blogcomments WHERE blogentryid='$entryid' AND visible='1' "), 0 );
$totalpages = ceil($totalres / $max);
echo'<div class="content_nav">Comments - Total('.$totalres.')</div>';
echo '<table width=\'100%\' border=\'0\' align=\'center\'>';

if( $totalres == '0' ){
echo '<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no comments.</td>
	 </tr>';
};
while ($rc6 = $db->fetch_row($r5)) {
$commenter = $rc6['commenter'];
$commenterurl = $rc6['commenterurl'];

$bodystringc = $rc6['commentbody'];
$bodystringc = str_replace("[url]","<a href='http://",$bodystringc);
$bodystringc = str_replace("[urlmid]","'>",$bodystringc);
$bodystringc = str_replace("[/url]","</a>",$bodystringc);
$bodystringc = str_replace("[img]","<img alt='' src='http://",$bodystringc);
$bodystringc = str_replace("[/img]","' />",$bodystringc);
$bodystringc = str_replace("[b]","<b>",$bodystringc);
$bodystringc = str_replace("[/b]","</b>",$bodystringc);
$bodystring = str_replace("[i]","<i>",$bodystring);
$bodystring = str_replace("[/i]","</i>",$bodystring);
$bodystring = str_replace("[u]","<>",$bodystring);
$bodystring = str_replace("[/u]","</u>",$bodystring);
$bodystringc = str_replace("[br]","<br />",$bodystringc);



if ( !$commenterurl ) {$displaycommenter = $commenter; } else { $displaycommenter = '<a href=\'http://'.$commenterurl.'\' rel=\''.$blogfollowtags.'\' target=\'_blank\'>'.$commenter.'</a>'; };
echo '<tr><td class=\'content\' width=\'15%\'>Posted By: '.$displaycommenter.'<p>Posted On: '.date('d-m-Y', $rc6['commentdate']).'</p>
          <td class=\'content\'>'.$rc6['commenttitle'].'<p>'.$bodystringc.'</p></td></tr>';
}   ;

echo '</table>
<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/blogentry/entryid/'.$entryid.'/'.$pre.'.html';
	$next = ''.$domain.'/blogentry/entryid/'.$entryid.'/'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid.'&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid.'&page='.$ne.'';
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
					$urk = ''.$domain.'/blogentry/entryid/'.$entryid.'/'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid.'&page='.$i.'';
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
echo'</div>
</div></div></div>';
};


function submitcomment(){
global $domain, $db, $seo_on, $suserid, $entryid, $blogentriesshown, $usrdata, $commenterurl, $commenter, $gamesfolder, $thumbsfolder, $blogcommentpermissions, $template, $ads1, $ads2, $ads3, $showpages;

$commenttitle = clean($_POST['commenttitle']);
$commentbody = clean($_POST['commentbody']);
$entryid = clean($_POST['entryid']);
$commentdate = time();
$commenterurl = $usrdata['website'];
$commenter = $usrdata['username'];
$commenterid = $usrdata['userid'];
$ipaddress = $_SERVER['REMOTE_ADDR'];


	if($blogcommentpermissions == 1){
		$msgcom = 'Comment Posted.'; $visible='1';
	}else{
		$msgcom = 'Comment Posted, Awaiting admin approval.'; $visible='0';
	}



	mysql_query("INSERT INTO fas_blogcomments SET
						blogentryid='$entryid',
						commenttitle='$commenttitle',
						commentbody='$commentbody',
						commenter='$commenter',
						commenterid='$commenterid',
						commenterurl='$commenterurl',
						visible='$visible',
						commentdate='$commentdate',
						ipaddress='$ipaddress'");

	echo '<div class=\'msg\'>'.$msgcom.'</div><br />';




};






$entryid = clean($_GET['entryid']);
if(!isset($_GET['cmd'])){
	$cmd = '1';
}else{
	$cmd = clean($_GET['cmd']);
}
switch ($cmd){

	case 'submitcomment':
	submitcomment();
	break;

	default:
	show();
	break;

};




};
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}


$entryid = clean($_GET['entryid']);
$r3 = $db->query(sprintf('SELECT * FROM fas_blogentries WHERE entryid=\'%u\'', $entryid));
$r4 = $db->fetch_row($r3);
$pagetitle = 'Blog Entry '.$r4['entrydate'].': '.$r4['title'].' - Page '.$show ;
$metatags = $r4['tags'];
$metadescription = $r4['body'];


if(strlen($metadescription) > $blogcharactersshown) { $metadescription = substr($metadescription, 0, $blogcharactersshown) ; $metadescription .= '...';};





?>