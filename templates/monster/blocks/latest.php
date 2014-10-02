<?php
echo'<div class="header">
		Latest Games
	</div>
	<div class="content">';
		$count2 = 0;
			$latest2 = "SELECT * FROM fas_games  WHERE `active`='1' ORDER BY ID DESC";
			$latest1 = sqlcache('latest', $cachelife, $latest2);
			if(isset($latest1)){
				foreach($latest1 as $row2){
					$latestname = preg_replace('#\W#', '-', $row2['name']);
					if($row2['type'] == 1){	
						$img = "<img src='".$domain."/".$thumbsfolder."/".$row2["thumb"]."' alt='".$latestname."' class='minithumb' />";
					}else{
						$img = "<img src='".$row2["thumburl"]."' alt='".$latestname."' class='minithumb' />";
					}
					if($count2<=4){
						echo '<ul class=\'catmenu\'>
							<li>';
								if ($seo_on == 1){						
									echo "<a href='".$domain."/play/".$row2["ID"]."-".$latestname.".html'>".$img.titlelimit($row2["name"])."</a>";	
								}else{
									echo "<a href='".$domain."/index.php?action=play&amp;ID=" .$row2["ID"]. "'>".$img.titlelimit($row2["name"])."</a>";
                            	}
							echo '</li>
						</ul>';}
					$count2++;
				}
				echo '<br />';
				if ($seo_on == 1){
					echo '&nbsp;<a href=\''.$domain.'/newest/\' title=\'Newest\'>View more >>></a>';}else{
					echo '&nbsp;<a href=\''.$domain.'/index.php?action=newest\' title=\'Newest\'>View more >>></a>';
				};
			}else{
				echo'<ul class="catmenu">
					<li>No games have been added yet!</li>
				</ul>';
			};
	echo'</div>';
?>