<?php
echo '<head>
<meta http-equiv="refresh" content="5; url='.$domain.'">
</head>';

$db->query("UPDATE fas_users SET status='0' WHERE `userid`='$suserid'");

session_destroy();

                echo'<div id="container">
                <div id="content-container">
                <div id="side">';
                include("includes/blocks.php");
                echo'</div>

                <div id="content">';
		echo '<div class=\'msg\'>You\'ve successfully logged out.
		<br><br>
		<a href=\''.$domain.'\' title=\'Home\'>Back to Arcade</a>
		</div>'; 
                echo'</div></div>';

?>