<?php
if(isset($_POST['submit'])){
	$categoryname = clean($_POST['categoryname']);
	$topcategory = clean($_POST['topcategory']);
	$activate = clean($_POST['activate']);
	if(!$categoryname){
		echo '<div class=\'error\'>No name submitted.</div>';
		
		exit;
	};
	mysql_query("INSERT INTO blogcategories SET topcategory='$topcategory', categoryname='$categoryname', activate='$activate' ");
	echo '<div class=\'msg\'>Category added.<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}else{

echo '<div class=\'pgtitle\'>Add Blog Category</div><br />
<div align=\'center\'>
<form action=\''.$domain.'/index.php?action=blogadmin&case=addblogcategory\' method=\'POST\'>


Top Category: <select type=\'dropdown\' name=\'topcategory\' >';

	$r = $db->query(sprintf('SELECT * FROM blogcategories'));
	while($ir = $db->fetch_row($r)){
echo '<option value=\''.$ir['categoryid'].'\'>'.$ir['categoryname'].'</option>
'; };

echo '</select>
<br>
Category Name: <input type=\'text\' name=\'categoryname\' size=\'50\'><br>
<select type=\'dropdown\' name=\'activate\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select>
<input type=\'submit\' name=\'submit\' value=\'Add Category\'>
</form>
</div>';
};
?>