<?php
if(!isset($suserid)){
	echo '<div class=\'error\'>Please login first.</div>';
	exit;
}
	$ID = clean($_GET['cmd']);
	$ID = abs((int) ($ID));
	
	$db->query(sprintf('INSERT INTO dd_user_favorites SET
					userid=\'%u\',
					gameid=\'%u\'', $usrdata['userid'], $ID));
	
	echo '<div class=\'msg\'>Game added to your favorites.</div>';
	$pgname = 'Add to favorites';
?>