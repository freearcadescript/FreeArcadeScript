<?php

// $entryid = clean($_GET['entryid']);
$entryid = clean($_GET['entryid']);

$r5 = "SELECT * FROM fas_pageentries WHERE entryid='$entryid'" ;
$sqltitle = "pageenrty-".$entryid ;
$r6 = sqlcache($sqltitle, $cachelife, $r5);
foreach ( $r6 as $r7 )
{

$pagetitle = $r7['title'] ;
$metatags = $r7['tags'];
$metadescription = $r7['metadescription'] ;
};

function writebody() {
global $db, $suserid, $pagetitle, $metatags, $metatitle, $metadescription,  $entryid, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

$entryid = clean($_GET['entryid']);


$r3 = "SELECT * FROM fas_pageentries WHERE entryid='$entryid'" ;
$sqltitle = "pageenrty-".$entryid ;
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
// $chr_limit = 120;
// $bodystring = preg_replace("!(http:/{2}[\w\.]{2,}[/\w\-\.\?\&\=\#]*)!e", "'<a href=\"\\1\" title=\"\\1\" target=\"_blank\">'.(strlen('\\1')>=$chr_limit ? substr('\\1',0,$chr_limit).'$add':'\\1').'</a>'", $bodystring);

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
		<td colspan=\'2\' class=\'header\'>'.$title.' </td>
	</tr>
      <tr>
		<td colspan=\'2\' class=\'content\'>'.$body.'</td>
	</tr>
';


echo "</table>";



 




};

?>