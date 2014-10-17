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
print ""."<description>" . $slogan . "</description>\n";
print ""."<copyright>".date("Y")." " . $sitename . " All rights reserved.</copyright>\n";

do
{
$name = $row['name'];
$ID = $row['ID'];
$description = $row['description'];
$thumb = $row['thumb'];
	      	$gamename = preg_replace('#\W#', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}
                if($row['type'] == 1){
	        $type = 'Self Hosted';
	               $thumburl = ''.$domain.'/'.$thumbsfolder.'/'.$thumb ;
                }else{
	        $type = 'Enabled Code';
	               $thumburl = ''.$row['thumburl'].'';
                }

print ""."<item>\n";

print ""."<title>$ID - $name</title>\n";
print ""."<link>" . $playlink ."</link>\n";
print ""."<description><![CDATA[ <img src='$thumburl' ><br /> $description ]]></description>\n";

print ""."</item>\n";
} while($row = mysql_fetch_array($datas)) ;

print "</channel>\n";
print "</rss>";

?>
