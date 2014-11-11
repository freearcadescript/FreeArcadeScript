<?php
echo'<div class="header">
		Top Games
	</div>
	<div class="content">';
		$minViews = 1;
		$count1 = 0;
		$newest2 = "SELECT * FROM fas_games WHERE `active`='1' AND Views>$minViews ORDER BY Views DESC";
		$newest1 = sqlcache('newest', $cachelife, $newest2);
		if(isset($newest1)){ 
			foreach($newest1 as $row1){
				$newestname = preg_replace('#\W#', '-', $row1['name']);
				if($row1['type'] == 1){	
						$img = "<img src='".$domain."/".$thumbsfolder."/".$row1["thumb"]."' alt='".$newestname."' class='minithumb' />";
					}else{
						$img = "<img src='".$row1["thumburl"]."' alt='".$newestname."' class='minithumb' />";
					}
				if($count1<=4){
					echo '<ul class=\'catmenu\'>
						<li>';
							if ($seo_on == 1){						
								echo "<a href='".$domain."/play/".$row1["ID"]."-".$newestname.".html'>".$img.titlelimit($row1["name"])." - (" .$row1["views"].")</a>";	
							}else{
								echo "<a href='".$domain."/index.php?action=play&amp;ID=" .$row1["ID"]. "'>".$img.titlelimit($row1["name"])." - (" .$row1["views"].")</a>";
                           	}
						echo '</li>
					</ul>';
				}
				$count1++;
			}
			echo '<br />';
			if ($seo_on == 1){
				echo '&nbsp;<a href=\''.$domain.'/mostplayed/\' title=\'Most Played\'>View more >>></a>';
			}else{
				echo '&nbsp;<a href=\''.$domain.'/index.php?action=mostplayed\' title=\'Most Played\'>View more >>></a>';
			};
		}else{
			echo'<ul class="catmenu">
				<li>No games have been played yet!</li>
			</ul>';
		};
	echo'</div>';
?>