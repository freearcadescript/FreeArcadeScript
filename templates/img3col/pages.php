<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;



$name = clean($_GET['name']);
$show = clean($_GET['page']);
$show = abs((int) ($show));
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$r2 = "SELECT * FROM pageentries WHERE visible='1' order by title asc" ;

$sqltitle="pagesmain" ;
$r1 = sqlcache($sqltitle, $cachelife, $r2);

echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Pages</td>
	</tr>';

//if(!$db->num_rows($r)){
//echo '	<tr>
//		<td colspan=\'2\' class=\'content\'>There currently are no pages.</td>
//	</tr>';
//}
echo '<tr>
				
				<td valig=\'top\' class=\'content\' colspan=\'2\' class=\'content\'>';
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





       echo ' <a href=\''.$rburl.'\' >'.$title.'</a><br>
             
	';




}

echo "<p></td>
			</tr>
</table>";
echo '<br /><br />';

};

$pagetitle = $sitename.' pages';
$metatags = 'pages, arcade articles';
$metadescription = $sitename.' pages';
?>