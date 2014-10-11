<?php


function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages, $suserid;

$r2 = "SELECT * FROM fas_pageentries WHERE visible='1' order by title asc" ;
$sqltitle="pagesmain" ;
$r1 = sqlcache($sqltitle, $cachelife, $r2);

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Pages</div>';

echo '<table width=\'100%\' border=\'0\' align=\'center\'>';

//if(!$db->num_rows($r)){
//echo '	<tr>
//		<td colspan=\'2\' class=\'content\'>There currently are no pages.</td>
//	</tr>';
//}
echo '<tr>

				<td valign=\'top\' class=\'content\' colspan=\'2\'>';
foreach($r1 as $in ){

$title = $in['title'];
$urltitle= str_replace(" ","",$title);
$category  = $in['category'];
$entryid = abs((int) ($in['entryid']));

if ($seo_on == 1) {
$rburl = ''.$domain.'/pages/'.$entryid.'-'.$urltitle.'.html';
} else {
$rburl = ''.$domain.'/index.php?action=page&entryid='.$entryid ; };
$body = $in['body'];





       echo ' <a href=\''.$rburl.'\' >'.$title.'</a><br />

	';




}

echo '<p></p></td>
			</tr>
</table>
</div></div></div>';
echo '<br /><br />';

};

$pagetitle = $sitename.' pages';
$metatags = 'pages, arcade articles';
$metadescription = $sitename.' pages';
?>