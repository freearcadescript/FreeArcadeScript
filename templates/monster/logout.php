<?php
echo '<head>
<meta http-equiv="refresh" content="5; url='.$domain.'">
</head>';

$db->query("UPDATE fas_users SET status='0' WHERE `userid`='$suserid'");

session_destroy();
		echo '<div class=\'msg\'>You\'ve successfully logged out.
		<br><br>
		<a href=\''.$domain.'\' title=\'Home\'>Back to Arcade</a>
		</div>'; 


?>