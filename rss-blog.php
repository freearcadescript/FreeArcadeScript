<?php

include ('includes/functions.php');
include ('includes/core.php');






header ("Content-type: text/xml");





$datas = mysql_query ("SELECT * FROM `fas_blogentries` where visible='1' ORDER BY `entryid` DESC LIMIT 10");
$row = mysql_fetch_array($datas);
print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
print ""."<rss version=\"2.0\">\n";
print ""."<channel>\n";
print ""."<title>" . $sitename . "</title>\n";
print ""."<link>" . $domain . "</link>\n";

print ""."<ttl>600</ttl>\n";
print ""."<description>We love to give you the best in free games.</description>\n";
print ""."<copyright>2014 " . $sitename . " All rights reserved.</copyright>\n";	



do
{
$title = $row['title'];
$entryid = $row['entryid'];
$body = $row['body'];
$entrydate = $row['entrydate'];


if ($seo_on == 1) {
$rburl = ''.$domain.'/blogentry/entryid/'.$entryid.'/1.html';
} else {
$rburl = ''.$domain.'/index.php?action=blogentry&entryid='.$entryid ; };



if(strlen($body) > $blogcharactersshown) { $body = substr($body, 0, $blogcharactersshown) ; $body .= '...';};

$bodystring = str_replace("[urlhead]","<a href='http://",$body);
$bodystring = str_replace("[urlmid]","'>",$bodystring);
$bodystring = str_replace("[urlend]","</a>",$bodystring);
$bodystring = str_replace("[imghead]","<img src='http://",$bodystring);
$bodystring = str_replace("[imgend]","'>",$bodystring);
$bodystring = str_replace("[bhead]","<b>",$bodystring);
$bodystring = str_replace("[bend]","</b>",$bodystring);
$bodystring = str_replace("[p]","<p>",$bodystring);
$body = str_replace("[br]","<br>",$bodystring);




print ""."<item>\n";

print ""."<title>$entryid - $title - $entrydate</title> \n";
print ""."<link>" . $rburl ."</link> \n";
print ""."<description><![CDATA[ $body ]]></description> \n";

print ""."</item>\n";
} while($row = mysql_fetch_array($datas)) ;

print "</channel>\n";
print "</rss>";

?>
