<?php
	echo'<div class="side_nav">Site Map</div>
	<div id="side_holder">';
		if($seo_on == 1){
			echo '<ul class=\'catmenu\'>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/memberslist/">Members</a></li>
				<li><a href="'.$domain.'/fineprint/">Fine Print</a></li>
				<li><a href="'.$domain.'/contact/">Contact Us</a></li>
                                <li><a href=\''.$domain.'/mostplayed/\' title=\'Most Played\'>Most Played</a></li>
				<li><a href=\''.$domain.'/newest/\' title=\'Newest\'>Newest Games</a></li>';
       	    	if ($showpages == 1) { echo '<li><a href="'.$domain.'/pages/">Pages</a></li>'; };
       	    	if ($showblog == 1) { echo '<li><a href="'.$domain.'/blog/">Blog</a></li>'; };
			echo '</ul>';
		}else{
			echo '<ul class=\'catmenu\'>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/index.php?action=memberslist">Members</a></li>
				<li><a href="'.$domain.'/index.php?action=fineprint">Fine Print</a></li>
				<li><a href="'.$domain.'/index.php?action=contact">Contact Us</a></li>
                                <li><a href=\''.$domain.'/index.php?action=mostplayed\' title=\'Most Played\'>Most Played</a></li>
                                <li><a href=\''.$domain.'/index.php?action=newest\' title=\'Newest\'>Newest</a></li>';
    	   	    if ($showpages == 1) { echo '<li><a href="'.$domain.'/index.php?action=pages">Pages</a></li>'; };
    	   	    if ($showblog == 1) { echo '<li><a href="'.$domain.'/index.php?action=blog">Blog</a></li>'; };
			echo '</ul>';
		}
     echo'</div>';
?>