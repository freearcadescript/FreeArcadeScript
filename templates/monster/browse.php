<?php

$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
$query = "SELECT Name FROM fas_categories WHERE ID=$ID";
$result = mysql_query($query);
$title = mysql_result($result, 0, "Name");
$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r2 = "SELECT * FROM fas_games WHERE category='$ID' && active='1' ORDER BY ID DESC LIMIT ".$limits.",".$max ;
$sqltitle = "browse-cat".$ID."page ".$show;
$r1 = sqlcache($sqltitle, $cachelife, $r2);
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE active=\'1\' and category=\''.$ID.'\''),0);
$totalpages = ceil($totalres / $max);
echo'<div class="header2">'.$title.'</div>';
$count = 0;
if(!isset($r1)){
echo'<div class="content2">There currently are no games in this category.</div>';
}else{
echo'<div class="content2">';
foreach($r1 as $in ){
	$gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
	if($count%2==0){
		echo '<div class="home_category">
			<div class="home_img">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" class="home_img" />';
					}else{
						echo'<img src="'.$in['thumburl'].'" alt="'.$gamename.'" class="home_img" />';
					}
				echo'</a>
			</div>
			<div class="home_info">
				<div class="home_title"><a href=\''.$playlink.'\'>'.titlelimit($in['name']).'</a></div>
				<div class="home_desc">'.desclimit($in['description']).'</div>';
				if($usrdata['user_level'] == 2){
					echo'<div style="float: right; vertical-align: top; padding-right: 20px;">
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=edit&amp;ID='.$in['ID'].'&amp;type='.$in['type'].'\' onclick="return confirm(\'Are you sure you want to edit the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/style/images/edit.png\' title=\'edit game\' alt=\'edit game\' border=\'0\' /></a>
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=delete&amp;ID='.$in['ID'].'\' onclick="return confirm(\'Are you sure you want to delete the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/style/images/delete.png\' title=\'delete game\' alt=\'delete game\' border=\'0\' /></a>
					</div>';
				}
			echo'</div>
		</div>';
	}else{
 		echo'<div class="home_wrap">
			<div class="home_img">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" class="home_img" />';
					}else{
						echo'<img src="'.$in['thumburl'].'" alt="'.$gamename.'" class="home_img" />';
					}
				echo'</a>
			</div>
			<div class="home_info">
				<div class="home_title"><a href="'.$playlink.'">'.titlelimit($in['name']).'</a></div>
				<div class="home_desc">'.desclimit($in['description']).'</div>';
				if($usrdata['user_level'] == 2){
					echo'<div style="float: right; vertical-align: top; padding-right: 20px;">
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=edit&amp;ID='.$in['ID'].'&amp;type='.$in['type'].'\' onclick="return confirm(\'Are you sure you want to edit the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/style/images/edit.png\' title=\'edit game\' alt=\'edit game\' border=\'0\' /></a>
						<a href=\''.$domain.'/index.php?action=admin&amp;case=managegames&amp;cmd=delete&amp;ID='.$in['ID'].'\' onclick="return confirm(\'Are you sure you want to delete the game '.$in['name'].'?\')"><img src=\''.$domain.'/templates/'.$template.'/style/images/delete.png\' title=\'delete game\' alt=\'delete game\' border=\'0\' /></a>
					</div>';
				}
			echo'</div>
		</div>';
}
$count++;
}
echo '</div>
<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$pre.'.html';
	$next = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$ne.'';
	}
if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/browse/'.$ID.'-'.clean($_GET['name']).'/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=browse&ID='.$ID.'&page='.$i.'';
				}

				if($show == $i){
					echo '<a href="'.$urk.'" class="page-select">'.$i.'</a>';
				}else{
					echo '<a href="'.$urk.'" class="page">'.$i.'</a>';
				}
			}
		}
	}
	if ($show < $totalpages){
		echo '<a href="'.$next.'" class="page">Next</a>';
	}
}
echo'</div>';
}

$ID = clean($_GET['ID']);
$ID = abs((int) ($ID));
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$m1 = mysql_query("SELECT * FROM fas_categories where ID='$ID' limit 1 ");

$m4 = mysql_fetch_row($m1) ;
$pagetitle = $m4[1];
$pagetitle .= ' games - Page '.$show ;
$metatags = $m4[2];
if ( $metatags == '' ) { $metatags = $m4[1]; };
$metadescription = $m4[3];
if ( $metadescription == '' ) { $metadescription = $pagetitle; } ;

?>