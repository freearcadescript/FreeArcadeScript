<?php
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo '<form action="'.$su.'" method="post">
	<div class="side_nav">Search</div>
	<div id="side_holder">
		<input class="search" onblur="if (value ==\'\') {value = \'Search...\'}" onfocus="if (value == \'Search...\') {value =\'\'}" type="text" name="keyword" style="width:160px" value="Search..." />
		<input class="button" type="submit" name="submit" value="Go" style="width:40px"/>
       </div>
</form>
<div style="clear:both"></div>';
?>