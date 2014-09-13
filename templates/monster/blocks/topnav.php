<?php
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo '<div class="nav">
	<div class="center">';
		if($seo_on == 1){
			echo '<ul>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/memberslist/">Members</a></li>
				<li><a href="'.$domain.'/fineprint/">Fine Print</a></li>';
       	    	if ($showpages == 1) { echo '<li><a href="'.$domain.'/pages/">Pages</a></li>'; };
       	    	if ($showblog == 1) { echo '<li><a href="'.$domain.'/blog/">Blog</a></li>'; };
			echo '</ul>';
		}else{
			echo '<ul>
				<li><a href="'.$domain.'">Home</a></li>
				<li><a href="'.$domain.'/index.php?action=memberslist">Members</a></li>
				<li><a href="'.$domain.'/index.php?action=fineprint">Fine Print</a></li>';
    	   	    if ($showpages == 1) { echo '<li><a href="'.$domain.'/index.php?action=pages">Pages</a></li>'; };
    	   	    if ($showblog == 1) { echo '<li><a href="'.$domain.'/index.php?action=blog">Blog</a></li>'; };
			echo '</ul>';
		}
	echo '</div>
</div>
<div class="heading">
	<div class="center">
		<div class="logo">
			<a href="'.$domain.'"><img src="'.$domain.'/templates/'.$template.'/images/logo.png" alt="'.$sitename.'" width="270" height="80"/></a>
		</div>
		<div class="search">
			<form action="'.$su.'" method="post">
				<input onblur="if (value ==\'\') {value = \'Search...\'}" onfocus="if (value == \'Search...\') {value =\'\'}" type="text" name="keyword" style="width:150px" value="Search..." />
				<input class="button" type="submit" name="submit" value="Go" style="width:40px"/>
			</form>
		</div>
	</div>
</div>
<div class="navbottom">
	<div class="center">
		<ul>';
			$rci = $db->query('SELECT * FROM fas_categories');
			while($row = $db->Fetch_row($rci)){
			$numrws =$db->query(sprintf('SELECT ID FROM fas_games WHERE category=\'%u\' and active=\'1\'', $row['ID']));
			$categoryname = preg_replace('[^A-Za-z0-9]', '', $row['name']);
			if($seo_on == 1){
				$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categoryname.'.html';
			}else{
				$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
			}
			echo '<li><a href=\''.$categoryurl.'\'>'.$row['name'].'</a></li>';
						};
		echo'</ul>
	</div>
</div>';
?>