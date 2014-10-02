<?php
echo'<div class="header">Random Games</div>
     <div class="content">';
		$count2 = 0;
			$random2 = "SELECT * FROM fas_games  WHERE `active`='1' ORDER BY RAND ()";
			$random1 = sqlcache('random', $cachelife, $random2);
			if(isset($random1)){
				foreach($random1 as $row2){
                                        $randomname = preg_replace('#\W#', '-', $row2['name']);
					if($row2['type'] == 1){	
						$img = "<img src='".$domain."/".$thumbsfolder."/".$row2["thumb"]."' alt='".$randomname."' title='".$randomname."' class='minithumb' />";
					}else{
						$img = "<img src='".$row2["thumburl"]."' alt='".$randomname."' title='".$randomname."' class='minithumb' />";
					}
					if($count2<=4){
						echo '<ul class=\'catmenu\'>
							<li>';
								if ($seo_on == 1){						
									echo "<a href='".$domain."/play/".$row2["ID"]."-".$randomname.".html'>".$img.titlelimit($row2["name"])."</a>";	
								}else{
									echo "<a href='".$domain."/index.php?action=play&amp;ID=" .$row2["ID"]. "'>".$img.titlelimit($row2["name"])."</a>";
                            	}
							echo '</li>
						</ul>';}
					$count2++;
				}

			}else{
				echo'<ul class="catmenu">
					<li>No games have been added yet!</li>
				</ul>';
			};
	echo'</div>';
?>