<?php

$pagetitle = $sitename;

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("templates/$template/blocks/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Latest Games</div>';
                $max = $gamesonpage;
                if(!isset($_GET['page'])){
	        $show = '1';
                }else{
	        $show = clean($_GET['page']);	
                }
                $limits = ($show - 1) * $max; 
		$sqltitle='homepage' ;
		$baseir2 = "SELECT * FROM fas_games WHERE active='1' ORDER BY ID DESC LIMIT ".$limits.",".$max ;
		$baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);
		if(isset($baseir1)){
	      	foreach($baseir1 as $row1 ){
                $gamename = preg_replace('#\W#', '-', $row1['name']);
	      	if($seo_on == 1){
	      		$playlink = '/play/'.$row1['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = '/index.php?action=play&amp;ID='.$row1['ID'].'';
	      	}
	      	echo '<div id="game_holder"><a href=\''.$playlink.'\'>';
		if($row1['type'] == 1){
		echo '<div align="center"><img src=\'/'.$thumbsfolder.'/'.$row1['thumb'].'\' width=\'150\' height=\'100\' alt= \''.$row1['name'].'\' title= \''.$row1['name'].'\' border=\'0\'/></a><br />';
		}else{
		echo '<div align="center"><img src=\''.$row1['thumburl'].'\' width=\'150\' height=\'100\' alt= \''.$row1['name'].'\' title= \''.$row1['name'].'\' border=\'0\'/></a><br />';
		}

		echo '<a href=\''.$playlink.'\'><h2>'.titlelimit($row1['name']).'</h2></a></div></div>';
	      	};

				}else{
					echo'<div align="center">
						No games have been added yet!
					</div>';
				}
echo'</div>


</div></div>';




$pgname = 'Your resource for fantastic games!';

?>