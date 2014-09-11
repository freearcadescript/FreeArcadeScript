<?php


function writebody() {
global $db, $suserid, $entryid, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;





function show(){
global $domain, $db, $seo_on, $usrdata, $entryid, $suserid;
// $r3 = $db->query(sprintf('SELECT * FROM blogentries WHERE entryid=\'%u\'', $entryid));
// $r4 = $db->fetch_row($r3);
$r3 = "SELECT * FROM blogentries WHERE entryid='$entryid'" ;
$sqltitle = "blogenrty-".$entryid ;
$r1 = sqlcache($sqltitle, $cachelife, $r3);
foreach ( $r1 as $r4 )
{
$title = $r4['title'];
$body = $r4['body'];
$author = $r4['author'];
$entrydate = $r4['entrydate'];
$displaydate = date('d-m-Y', $entrydate);
$visible = $r4['visible'];
$category = $r4['category'];
$tags = $r4['tags'];
};
 $chr_limit = 120;
$add = '...';
 $bodystring = preg_replace("!(http:/{2}[\w\.]{2,}[/\w\-\.\?\&\=\#]*)!e", "'<a href=\"\\1\" title=\"\\1\" target=\"_blank\">'.(strlen('\\1')>=$chr_limit ? substr('\\1',0,$chr_limit).'$add':'\\1').'</a>'", $bodystring);

$bodystring = str_replace("[urlhead]","<a href='http://",$body);
$bodystring = str_replace("[urlmid]","'>",$bodystring);
$bodystring = str_replace("[urlend]","</a>",$bodystring);
$bodystring = str_replace("[imghead]","<img src='http://",$bodystring);
$bodystring = str_replace("[imgend]","'>",$bodystring);
$bodystring = str_replace("[bhead]","<b>",$bodystring);
$bodystring = str_replace("[bend]","</b>",$bodystring);
$bodystring = str_replace("[p]","<p>",$bodystring);

$bodystring = str_replace("\n\n","<p>",$bodystring);
$bodystring = str_replace("\n","<br />",$bodystring);
$body = str_replace("[br]","<br>",$bodystring);



echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>'.$title.' - '.$entrydate.'</td>
	</tr>
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


echo "</table>";




echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Submit Comment</td>
	</tr>
	<tr>
		<td colspan=\'2\' class=\'content\'>';
             if(!isset($suserid)) { echo 'You must be logged in to submit a comment</td></tr>'; } else {


			if($seo_on == 1){
				$sublink = ''.$domain.'/blogentry/submitcomment/';
			}else{
				$sublink = ''.$domain.'/index.php?action=blogentry&cmd=submitcomment';
			};	
             echo '     Comment Title:<br>
				<form action=\''.$sublink.'\' method=\'POST\'>
                        <input type=\'hidden\' name=\'entryid\' value=\''.$entryid.'\'>
                        
                        <input type=\'text\' size=\'40\' name=\'commenttitle\'><p>Body of Comment:<br>
                        <small>(HTML and BBCode do not work.)</small><br>
				<textarea cols=\'35\' rows=\'5\' name=\'commentbody\'></textarea>
				<br>
				<input type=\'submit\' name=\'commentsubmit\' value=\'Add Comment\'>
				</form>



           </td>
	</tr>
                  ';};


echo "</table>";









listcomments ();



               };









function listcomments(){
global $domain, $db, $seo_on, $usrdata, $entryid, $blogcommentsshown, $i, $blogfollowtags;

$blogentryid = $entryid;
$max = $blogcommentsshown;
$show = clean($_GET['page']);
$show = abs((int) ($show));
if(empty($show)){
	$show = 1;
};
$limits = ($show - 1) * $max;

 $r5 = $db->query(sprintf('SELECT * FROM blogcomments WHERE blogentryid=\'%u\' and visible=\'1\' order by commentid desc LIMIT '.$limits.','.$max.' ', $entryid));


$totalres = mysql_result($db->query("SELECT COUNT(blogentryid) AS total FROM blogcomments WHERE blogentryid='$entryid' AND visible='1' "), 0 );	
$totalpages = ceil($totalres / $max); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Comments - Total('.$totalres.')</td>
	</tr>';

if( $totalres == '0' ){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no comments.</td>
	</tr>';
};
while ($rc6 = $db->fetch_row($r5)) {
$commenter = $rc6['commenter'];
$commenterurl = $rc6['commenterurl'];

$bodystringc = $rc6['commentbody'];
$bodystringc = str_replace("[urlhead]","<a href='http://",$bodystringc);
$bodystringc = str_replace("[urlmid]","'>",$bodystringc);
$bodystringc = str_replace("[urlend]","</a>",$bodystringc);
$bodystringc = str_replace("[imghead]","<img src='http://",$bodystringc);
$bodystringc = str_replace("[imgend]","'>",$bodystringc);
$bodystringc = str_replace("[bhead]","<b>",$bodystringc);
$bodystringc = str_replace("[bend]","</b>",$bodystringc);
$bodystringc = str_replace("[p]","<p>",$bodystringc);
$bodystringc = str_replace("[br]","<br>",$bodystringc);



if ( !$commenterurl ) {$displaycommenter = $commenter; } else { $displaycommenter = '<a href=\'http://'.$commenterurl.'\' rel=\''.$blogfollowtags.'\' target=\'_blank\'>'.$commenter.'</a>'; };
echo '<tr><td class=\'content\' width=\'15%\'>Posted By: '.$displaycommenter.'<p>Posted On: '.date('d-m-Y', $rc6['commentdate']).'
          <td class=\'content\'>'.$rc6['commenttitle'].'<p>'.$bodystringc.'</td></tr>';
}   ;

echo "</table>";
echo 'Pages: ';


for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urk = ''.$domain.'/blogentry/entryid/'.$entryid.'/'.$i.'.html';
}else{
	$urk = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid.'&page='.$i.'';
};
echo '<a href=\''.$urk.'\' class=\'pagenat\'>'.$i.'</a>&nbsp; ';

};
echo '<br /><br />';







};


function submitcomment(){
global $domain, $db, $seo_on, $suserid, $entryid, $blogentriesshown, $usrdata, $commenterurl, $commenter, $blogcommentpermissions;
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



	mysql_query("INSERT INTO blogcomments SET
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
if (!$_GET['cmd']) { $cmd=""; } else { $cmd= $_GET['cmd']; };
switch ($_GET['cmd']){
	
	case 'submitcomment':
	submitcomment();
	break;
	
	default:
	show();
	break;
	
};
 



};
$show = clean($_GET['page']);
$show = abs((int) ($show));
if(empty($show)){
	$show = 1;
};


$entryid = clean($_GET['entryid']);
$r3 = $db->query(sprintf('SELECT * FROM blogentries WHERE entryid=\'%u\'', $entryid));
$r4 = $db->fetch_row($r3);
$pagetitle = 'Blog Entry '.$r4['entrydate'].': '.$r4['title'].' - Page '.$show ;
$metatags = $r4['tags'];
$metadescription = $r4['body'];


if(strlen($metadescription) > $blogcharactersshown) { $metadescription = substr($metadescription, 0, $blogcharactersshown) ; $metadescription .= '...';};





?>