<?php
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo '<form action="'.$su.'" method="post">
	<div class="header">
		Search
	</div>
	<div class="content">
		<input class="search" onblur="if (value ==\'\') {value = \'Search...\'}" onfocus="if (value == \'Search...\') {value =\'\'}" type="text" name="keyword" style="width:75%" value="Search..." /> 
		<input class="button" type="submit" name="submit" value="Go" style="width:20%"/>
	</div>
</form>'; 
?>