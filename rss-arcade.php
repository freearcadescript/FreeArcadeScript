<?php

include ('includes/functions.php');
include ('includes/core.php');






header ("Content-type: text/xml");





$datas = mysql_query ("SELECT * FROM `fas_games` where active='1' ORDER BY `ID` DESC LIMIT 10");
$row = mysql_fetch_array($datas);
print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
print ""."<rss version=\"2.0\">\n";
print ""."<channel>\n";
print ""."<title>" . $sitename . "</title>\n";
print ""."<link>" . $domain . "</link>\n";

print ""."<ttl>600</ttl>\n";
print ""."<description>We love to give you the best in free games.</description>\n";
print ""."<copyright>2009 " . $sitename . " All rights reserved.</copyright>\n";



do
{
$name = $row['name'];
$ID = $row['ID'];
$description = $row['description'];
$thumb = $row['thumb'];
	      	$gamename = preg_replace('[^A-Za-z0-9]', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}

$thumburl = ''.$domain.'/'.$thumbsfolder.'/'.$thumb ;
print ""."<item>\n";

print ""."<title>$ID - $name</title>\n";
print ""."<link>" . $playlink ."</link>\n";
print ""."<description><![CDATA[ <img src='$thumburl' > $description ]]></description>\n";

print ""."</item>\n";
} while($row = mysql_fetch_array($datas)) ;

print "</channel>\n";
print "</rss>";

?>
