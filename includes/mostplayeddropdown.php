<?php

$dr2 = $db->query(sprintf('SELECT * FROM fas_games ORDER BY views DESC LIMIT 100 '));
$droplisttext = '<select name=\'droplist1\' id=\'droplistgames\' onchange=\'document.location=(droplist1.value)\'>
<option value=\'/\'>Select a Game</option>';
while($dr1 = $db->fetch_row($dr2)){
$gamenamedp = ereg_replace('[^A-Za-z0-9]', '-', $dr1['name']);
	if($seo_on == 1){
		$playlink3 = ''.$domain.'/play/'.$dr1['ID'].'-'.$gamename.'.html';
	}else{
		$playlink3 = ''.$domain.'/index.php?action=play&amp;ID='.$dr1['ID'].'';
	}


       $droplisttext .= '<option value=\''.$playlink3.'\'>'.$gamenamedp.'</option>
	      ';

};
$droplisttext .= '</select>';



?>