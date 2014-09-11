<?php


function writebody() {
global $db, $domain, $sitename, $con1, $suserid, $userid, $userdata;




if(!isset($suserid)){
	echo '<div class=\'error\'>Please login first.</div>';
	exit;
}
	$ID = clean($_GET['cmd']);
	$ID = abs((int) ($ID));
	
	$db->query(sprintf('INSERT INTO fas_user_favorites SET
					userid=\'%u\',
					gameid=\'%u\'', $suserid, $ID));
	
	echo '<div class=\'msg\'>Game added to your favorites.</div>';
	$pgname = 'Add to favorites';

};
?>