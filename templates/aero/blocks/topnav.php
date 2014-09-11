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
			<img src="'.$domain.'/templates/'.$template.'/images/logo.png" alt="logo" width="270" height="80"/>
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
			$queryb = "SELECT ID, name FROM fas_categories";
			$resultb = mysql_query($queryb);
			$num_rows = mysql_num_rows($resultb);
			for ($i=0; $i<$num_rows; $i++){
				if($seo_on == 1){
					$link = ''.$domain.'/browse/'.mysql_result($resultb, $i, "ID").'';
				}else{				
					$link = ''.$domain.'/index.php?action=browse&ID='.mysql_result($resultb, $i, "ID").'';
				}
				echo '<li><a href="'.$link.'">'.mysql_result($resultb, $i, "name").'</a></li>';
			}		
		echo'</ul>
	</div>
</div>';
?>