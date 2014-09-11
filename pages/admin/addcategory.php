<?php
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	if(!$name){
		echo '<div class=\'error\'>No name submitted.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	$db->query(sprintf('INSERT INTO dd_categories SET name=\'%s\'', $name));
	echo '<div class=\'msg\'>Category added.<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}else{
echo '<div class=\'pgtitle\'>Add Category</div><br />
<div align=\'center\'>
<form action=\''.$domain.'/index.php?action=admin&case=addcategory\' method=\'POST\'>
Name: <input type=\'text\' name=\'name\' size=\'50\'>&nbsp;<input type=\'submit\' name=\'submit\' value=\'Add Category\'>
</form>
</div>';
}
?>