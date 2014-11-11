<?php

if(!empty($_POST['keyword'])){
$keyword = mysql_real_escape_String($_POST['keyword']);

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">';
$max = $gamesonpage;
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r = mysql_query("SELECT * FROM fas_games WHERE `active`='1' && name LIKE '%$keyword%'") or die(mysql_error());
$totalres = mysql_result($db->query('SELECT COUNT(ID) AS total FROM fas_games WHERE `active`="1" && name LIKE "%$keyword%"'),0);
$totalpages = ceil($totalres / $max);
echo'<div class="content_nav">Search results for "'.$keyword.'"</div>';
$count = 0;
echo'<div class="content2">';
while($in = $db->fetch_row($r)){
	$gamename = preg_replace('#\W#', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
		echo '<div id="game_holder"><div align="center">
				<a href="'.$playlink.'">';
					if($in['type'] == 1){
						echo'<img src="'.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'" alt="'.$gamename.'" title="'.$gamename.'" width="150" height="100"/>';
					}else{
						echo'<img src="'.$in['thumburl'].'" alt="'.$gamename.'" title="'.$gamename.'" width="150" height="100"/>';
					}
				echo'</a><br /><a href=\''.$playlink.'\'><h2>'.titlelimit($in['name']).'</h2></a>';
			echo'</div></div>';

$count++;
}
echo '</div><div style="clear:both"></div>
<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/search/page'.$pre.'.html';
	$next = ''.$domain.'/search/page'.$ne.'.html';
}else{
	$previous = ''.$domain.'/index.php?action=search&page='.$pre.'';
	$next = ''.$domain.'/index.php?action=search&page='.$ne.'';
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
					$urk = ''.$domain.'/search/page'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=search&page='.$i.'';
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
echo'</div>
</div></div></div>';
}else{
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Search</div>
<div style="clear:both"></div>';
	echo '<form action=\''.$su.'\' method=\'post\'>
	<table align=\'center\' width="100%">
			<tr>
				<td class=\'content\'>Keyword(s):</td>
				<td class=\'content\'><input type=\'text\' name=\'keyword\' size=\'45\' /></td>
			</tr>
			<tr>
				<td colspan=\'2\' align=\'center\' class=\'content\'><input type=\'submit\' name=\'submit\' value=\'Search\' /></td>
			</tr>
		</table>
</form>
</div></div></div>';
}

?>