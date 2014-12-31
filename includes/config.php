<?php
$dbhost = 'localhost'; // Database host usually localhost
$dbuser = 'DBUSER'; // Database user
$dbpass = 'DBPASS'; // Database password
$dbname = 'DBNAME'; // Database name
$dbpre = 0;
// ////////////////////////////////////////////////////////////////////////////////////////////////////
// You MUST edit the variable $cachepath below to your own hosting info. If you do not, you will get errors
// At the very least you will need to replace "hostingaccountname" with your own account user name.
// On some accounts you might need to edit the rest of the path. 
//
// If you have questions, please ask for support
// from either your hosting company or the Free Arcade Script staff.
// ////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// The folowing is more secure, but not everybody can use it. It still needs to be edited though.
// $cachepath='/home/hostingaccountname/cache/';   
// This one is one almost everybody can use, but is less secure.

$cachepath='';   
$cachelife = '60' ;  // Number of seconds to keep cache alive. 900 seconds equals 15 minutes. Too long and pages do not update frequently, too short and CPU resource usage goes up.
?>