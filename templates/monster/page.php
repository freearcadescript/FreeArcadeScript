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
global $db, $suserid, $pagetitle, $cachelife, $metatags, $metatitle, $metadescription,  $entryid, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

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
$visible = $r4['visible'];
$category = $r4['category'];
$tags = $r4['tags'];

};
// $chr_limit = 120;
// $bodystring = preg_replace("!(http:/{2}[\w\.]{2,}[/\w\-\.\?\&\=\#]*)!e", "'<a href=\"\\1\" title=\"\\1\" target=\"_blank\">'.(strlen('\\1')>=$chr_limit ? substr('\\1',0,$chr_limit).'$add':'\\1').'</a>'", $bodystring);

$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $body, $url)){
	$bodystring = preg_replace($reg_exUrl, "<a href='".$url[0]."'>{$url[0]}</a> ", $body);
}else{
	$bodystring = $body;
}
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



echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>'.$title.'</td>
	</tr>
      <tr>
		<td colspan=\'2\' class=\'content\'>'.$body.'</td>
	</tr>
';
echo '</table>';



 




};

?>