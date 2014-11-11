<?php

	$ID = clean($_GET['cmd']);
	$ID = abs((int) ($ID));
	$result = mysql_query("SELECT name FROM fas_games WHERE ID='$ID'");
	$name = mysql_fetch_array($result);
	
	mysql_query("INSERT INTO fas_report_game (gameid, userid, gamename) VALUES('$ID', '$suserid', '$name[0]')") or die();
	
	echo '<div class=\'msg\'>\''.$name[0].'\' successfully reported.</div>';

?>