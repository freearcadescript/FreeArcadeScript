<?php
function submenu1() { 
	global $domain, $db, $seo_on;
$rci = $db->query('SELECT * FROM fas_blogcategories');
						
while($row = $db->Fetch_row($rci)){
	if(empty($row['ID'])){
		$row['ID'] = NULL;
	}
	$numrws =$db->query(sprintf('SELECT ID FROM fas_games WHERE category=\'%u\'', $row['ID']));
	$cnumrws = $db->num_rows($numrws);
	$categoryname = preg_replace('#\W#', '', $row['categoryname']);
	if($seo_on == 1){
		$categoryurl = ''.$domain.'/blog/'.$row['categoryid'].'/1/';
	}else{
		$categoryurl = ''.$domain.'/index.php?action=blogcat&category='.$row['categoryid'].'';
	}
	echo '<li><a href=\''.$categoryurl.'\'>'.$row['categoryname'].'</a></li>';
};
}; 
?>