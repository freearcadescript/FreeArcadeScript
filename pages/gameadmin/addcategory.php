<?php
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$tags = $_POST['tags'];
	$metadescr = $_POST['metadescr'];
	if(!$name){
		echo '<div class=\'error\'>No name submitted.</div>';
		
		
	} else {
	mysql_query("INSERT INTO dd_categories SET name='$name', tags='$tags', metadescr='$metadescr' ");
	echo '<div class=\'msg\'>Category added.<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>'; };
} else {
echo '<div class=\'pgtitle\'>Add Category</div><br />
<div align=\'center\'>
<form action=\''.$domain.'/index.php?action=gameadmin&case=addcategory\' method=\'POST\'>
Name: <input type=\'text\' name=\'name\' size=\'50\'><br>
Tags: <input type=\'text\' name=\'tags\' size=\'50\'><br>
Meta Description: <input type=\'text\' name=\'metadescr\' size=\'50\'><br>
<input type=\'submit\' name=\'submit\' value=\'Add Category\'>
</form>
</div>';   };

?>