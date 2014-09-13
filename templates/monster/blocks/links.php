<?php
echo'<div class="header">
		Links
	</div>
	<div class="content">';
			$rlinkx2 = "SELECT * FROM fas_links where activate = '2' " ;
			$rlinkx1 = sqlcache('sitewidelinks', $cachelife, $rlinkx2);
			echo '<ul  class=\'catmenu\'>';
				if(isset($rlinkx1)){
					foreach($rlinkx1 as $rlinkx){
						echo '<li><a href=\''.$rlinkx['url'].'\' target="_blank">'.$rlinkx['title'].'</a></li>';
					}
				}else{
					echo'<li>No links have been added yet!</li>';
				}
			echo '</ul>';
			echo '<br />';
			if ($seo_on == 1){
				echo '<a href=\''.$domain.'/links/\' title=\'Links\'>&nbsp;Add links >>></a>';
			}else{
				echo '<a href=\''.$domain.'/index.php?action=links\' title=\'Links\'>&nbsp;Add links >>></a>';
			}
	echo'</div>'; 
?>