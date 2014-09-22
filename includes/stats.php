<?php
	$totalgames = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_games WHERE active="1"')));
	$totalusers = $db->num_rows($db->query(sprintf('SELECT userid FROM fas_users WHERE activation_key="0" AND user_level!="0"')));
	$totalcats = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_categories WHERE active="1"')));
	$totalcomments = $db->num_rows($db->query(sprintf('SELECT ID FROM fas_comments')));
	$time=time()-15*60;
	$onlineusers = $db->num_rows($db->query("SELECT userid FROM fas_users WHERE status >= $time"));
	$year = date('Y');

	$timeoutseconds 	= 600;	// Timeout Value in Seconds - 300 equals 5 minutes.
	$timestamp=time();
	$timeout=$timestamp-$timeoutseconds;
	$ip = $_SERVER['REMOTE_ADDR'];
	//Insert all users online
	$query_add = "INSERT INTO fas_onlineuser VALUES ('$timestamp','$ip')";
	$resultt = mysql_query($query_add);
	if (!$resultt) { echo 'Cannot connect to the database'; }

	//Delete guest users after timeout - Does not affect members count
	$query_time = "DELETE FROM fas_onlineuser WHERE timestamp < $timeout";
	$resultt = mysql_query($query_time);
	if (!$resultt) { echo 'Cannot connect to the database'; }

	//Count all members and guests IP's to make a grand total.
	//Then subtract the number of members online from the grand total - leaving the Guests.
	$query_resultt = "SELECT DISTINCT ip FROM fas_onlineuser";
	$resultt = mysql_query($query_resultt);
	if (!$resultt) { echo 'Cannot connect to the database'; }

	$totalonline = (mysql_num_rows($resultt));

	$guests = $totalonline - $onlineusers;
?>