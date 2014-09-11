<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

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
	echo '<div class="heading">
		<h2>Manage Categories</h2>
	</div>
	<table id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th colspan="2">Category</th>
			</tr>
		</thead>
		<tbody>';
	$r = $db->query(sprintf('SELECT * FROM fas_categories'));
	while($ir = $db->fetch_row($r)){	
	echo '<tr>
			<td width="50px">'.$ir['ID'].'</td>
			<td width="790px">'.$ir['name'].'</td>
			<td><a href=\''.$domain.'/index.php?action=gameadmin&case=managecategories&cmd=edit&ID='.$ir['ID'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
				<a href=\''.$domain.'/index.php?action=gameadmin&case=managecategories&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['name'].'? \n All games in this category will be deleted from the database too.\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a></td>
		</tr>';
	}	
echo '</tbody>
</table>';
}
function delete(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
	$db->query(sprintf('DELETE FROM fas_games WHERE category=\'%u\'', $ID));
	$db->query(sprintf('DELETE FROM fas_categories WHERE ID=\'%u\'', $ID));
	echo '<div class=\'msg\'>Category Deleted, games deleted in category.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
if(isset($_POST['submit'])){
	$name  = clean($_POST['name']);
	$tags  = clean($_POST['tags']);
	$metadescr  = clean($_POST['metadescr']);
	echo '<div class=\'msg\'>Category info Changed</div>';
	mysql_query("UPDATE dd_categories SET name='$name', tags='$tags', metadescr='$metadescr' WHERE ID='$ID' ");
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_categories WHERE ID=\'%u\'', $ID)));
echo '<div class="heading">
	<h2>Editing Category: '.$ir['name'].'</h2>
</div>
<form action=\''.$domain.'/index.php?action=gameadmin&case=managecategories&cmd=edit&ID='.$ID.'\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name: </td>
				<td><input type=\'text\' size=\'40\' name=\'name\' value=\''.$ir['name'].'\'></td>
			<tr>
			</tr>
				<td>Tags: </td>
				<td><input type=\'text\' size=\'40\' name=\'tags\' value=\''.$ir['tags'].'\'></td>
			<tr>
			</tr>
				<td>Meta Description: </td>
				<td><input type=\'text\' size=\'40\' name=\'metadescr\' value=\''.$ir['metadescr'].'\'></td>
			<tr>
			</tr>
				<td>Active: </td>
				<td><input type=\'text\' size=\'2\' name=\'active\' value=\''.$ir['active'].'\'></td>
			<tr>
			</tr>
				<td colspan="2"><input type=\'submit\' name=\'submit\' value=\'Change\'></td>
			</tr>
		</body>
	</table>
</form>';
}

}

?>