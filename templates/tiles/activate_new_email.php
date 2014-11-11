<?php

if(!isset($suserid)){
echo '<div class=\'error\'>Please login first.</div>';

return;
}; 

		$current_email = clean($_GET['oldemail']);
		$new_email = clean($_GET['newemail']);
		$id = clean($_GET['id']);
		
		if(!$current_email || !$new_email || !$id){
			echo '<div class=\'error\'>Something was missing within your url. Please try again!</div>';
			return;
		}

$userid = $usrdata['userid'];
$ir = $db->query(sprintf('SELECT * FROM fas_users WHERE userid=\'%u\'', $userid));
$r2 = $db->fetch_row($ir);
$email = $r2['email'];
$new_email_key = $r2['new_email_key'];

if($current_email == $email && $new_email_key == $id){
mysql_query("UPDATE fas_users SET `email`='$new_email', `new_email_key`='0' WHERE userid='{$usrdata['userid']}'");
echo '<div class=\'msg\'>Your email has been changed!</div>';
}else{
echo '<div class=\'error\'>An error occured!</div>';
}

?>