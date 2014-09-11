<?php
switch($_GET['cmd']){
	default: 
	categories();
	break;
	
	case 'delete':
	delete();
	break;
	
	case 'edit':
	edit();
	break;
	
}
function categories(){
	global $domain, $db;
	echo '
	<div class=\'pgtitle\'>Manage Categories</div><br />
	<table width=\'80%\' align=\'center\'>
		<tr>
			<td class=\'header5\'>Name</td>
			<td class=\'header5\'>Actions</td>
		</tr>';
	$r = $db->query(sprintf('SELECT * FROM dd_categories'));
	while($ir = $db->fetch_row($r)){	
	echo '	<tr>
			<td>'.$ir['name'].'</td>
			
			<td><a href=\''.$domain.'/index.php?action=admin&case=managecategories&cmd=edit&ID='.$ir['ID'].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' border=\'0\'></a>
		
			<a href=\''.$domain.'/index.php?action=admin&case=managecategories&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['name'].'? \n All games in this category will be deleted from the database too.\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	
		</tr>';
	}	
echo '	</table>	
	';
}
function delete(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {exit;}
	$db->query(sprintf('DELETE FROM dd_games WHERE category=\'%u\'', $ID));
	$db->query(sprintf('DELETE FROM dd_categories WHERE ID=\'%u\'', $ID));
	echo '<div class=\'msg\'>Category Deleted, games deleted in category.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {exit;}
if(isset($_POST['submit'])){
	$name  = clean($_POST['name']);
	echo '<div class=\'msg\'>Category name Changed to '.$name.'</div>';
	$db->query(sprintf('UPDATE dd_categories SET name=\'%s\' WHERE ID=\'%u\'', $name, $ID));
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_categories WHERE ID=\'%u\'', $ID)));
echo '<div class=\'pgtitle\'>Editing Category '.$ir['name'].'</div><br /><div align=\'center\'>
<form action=\''.$domain.'/index.php?action=admin&case=managecategories&cmd=edit&ID='.$ID.'\' method=\'POST\'>
	<input type=\'text\' size=\'40\' name=\'name\' value=\''.$ir['name'].'\'>
	<input type=\'submit\' name=\'submit\' value=\'Change\'>
</form></div>';
}

}

?>