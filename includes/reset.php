<?php

$getset = mysql_query("SELECT timestamp FROM fas_gamestats");
$times = mysql_fetch_array($getset);

$timestamp = $times['timestamp'];
$now = date("m:d:Y h:i A", strtotime($tzone. "hours"));
$newtime2 = date("m:d:Y 12:00",strtotime("+ 1 day"));
$newtime = $newtime2.' AM'; 

if ($timestamp < $now || $timestamp == $now){
	mysql_query("UPDATE fas_gamestats SET timestamp = '$newtime', played_today = '0'");			
}
?>