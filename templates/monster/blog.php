<?php


function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;



$max = $blogentriesshown;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r2 = "SELECT * FROM fas_blogentries WHERE visible='1' order by entryid desc LIMIT ".$limits.",".$max ;

$sqltitle="blogmain-page".$show ;
$r1 = sqlcache($sqltitle, $cachelife, $r2);

$totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM fas_blogentries where visible=\'1\' '),0);
$totalpages = ceil($totalres / $max);
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Blog Entries</td>
	</tr>';

if($totalres == 0){
echo '	<tr>
		<td colspan=\'2\' class=\'content\'>There currently are no blog entries.</td>
	</tr>';
}else{

foreach($r1 as $in ){
$author = $in['author'];
$title  = $in['title'];
$entryid = abs((int) ($in['entryid']));
$entrydate = $in['entrydate'];

if ($seo_on == 1) {
$rburl = ''.$domain.'/blogentry/entryid/'.$entryid.'/1.html';
} else {
$rburl = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid ; };
$body = $in['body'];


if(strlen($body) > $blogcharactersshown) { $body = substr($body, 0, $blogcharactersshown) ; $body .= '...';};
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




       echo ' <tr>
				<td width=\'15%\' class=\'content\' style=\'padding:4px;\' valign=\'top\'><b>Posted By:</b> '.$author.'</td>
				<td valign=\'top\' class=\'content\'><a href=\''.$rburl.'\' >'.$title.'</a><p>'.$body.'</p></td>
			</tr>
			<tr>
				<td width=\'100%\' colspan=\'2\' class=\'content\'><small><i><b>Posted On:</b> '.$entrydate.'</i></small></td>
			</tr>
	';




}}

echo '</table>';
echo 'Pages: ';
for($i = 1; $i <= $totalpages; $i++){
if($seo_on == 1){
	$urk = ''.$domain.'/blog/page/'.$i.'.html';
}else{
	$urk = ''.$domain.'/index.php?action=blog&page='.$i.'';
}
echo '<a href=\''.$urk.'\' class=\'pagenat\'>'.$i.'</a>&nbsp; ';

}
echo '<br /><br />';

};

$pagetitle = $sitename.' Blog';
$metatags = 'blog, arcade blog';
$metadescription = $sitename.' blog';
?>