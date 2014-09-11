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
                <br clear="all">
		<a href=\''.$domain.'/index.php?action=admin&case=addblogcategory\' class="button">New Category</a>
		<table id="table">
			<thead>
				<tr>
					<th>ID</th>
					<th colspan="2">Category Name</th>
				</tr>
			</thead>
			<tbody>';
	$r = $db->query(sprintf('SELECT * FROM fas_blogcategories'));
	while($ir = $db->fetch_row($r)){	
	echo '<tr>
			<td width="50px">'.$ir['categoryid'].'</td>
			<td width="790px">'.$ir['categoryname'].'</td>
			<td><a href=\''.$domain.'/index.php?action=admin&case=manageblogcategories&cmd=edit&categoryid='.$ir['categoryid'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=manageblogcategories&cmd=delete&categoryid='.$ir['categoryid'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['categoryname'].'? \n All etries in this category will be deleted from the database too.\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
		</tr>';
	}	
echo '</tbody>
</table>';
}
function delete(){
global $db, $domain;
$categoryid = abs((int) $_GET['categoryid']);
if(!$categoryid) {echo 'no category selected'; return;}
	$db->query(sprintf('DELETE FROM fas_blogentries WHERE category=\'%u\'', $categoryid));
	$db->query(sprintf('DELETE FROM fas_blogcategories WHERE categoryid=\'%u\'', $categoryid));
	echo '<div class=\'msg\'>Blog category Deleted, entries deleted in category.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain;
if (!isset($_POST['topcategory'])){
	$topcategory = NULL;
}else{
	$topcategory = clean($_POST['topcategory']);
}
if (!isset($_POST['activate'])){
	$activate = NULL;
}else{
	$activate = clean($_POST['activate']);
}
$categoryid = abs((int) $_GET['categoryid']);
if(!$categoryid) {return;}
if(isset($_POST['submit'])){
	$categoryname  = clean($_POST['categoryname']);
	echo '<div class=\'msg\'>Category name changed to '.$categoryname.'</div>';
	mysql_query("UPDATE fas_blogcategories SET categoryname='$categoryname', topcategory='$topcategory', activate='$activate' WHERE categoryid='$categoryid'"); 
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_blogcategories WHERE categoryid=\'%u\'', $categoryid)));
echo '<div class="heading">
	<h2>Editing Blog Category: '.$ir['categoryname'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=manageblogcategories&cmd=edit&categoryid='.$categoryid.'\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Top Category:</td>
				<td><select type=\'dropdown\' name=\'topcategory\' >';
					$cl = $db->query(sprintf('SELECT * FROM fas_blogcategories'));
					while($cl2 = $db->fetch_row($cl)){
					echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>'; };
					echo '</select>
				</td>
			</tr>
			<tr>
				<td>Category Name:</td>
				<td><input type=\'text\' size=\'40\' name=\'categoryname\' value=\''.$ir['categoryname'].'\'></td>
			</tr>
			<tr>
				<td>Activate?:</td>
				<td><select type=\'dropdown\' name=\'activate\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select></td>
			</tr>
			<tr>
				<td colspan="2"><input type=\'submit\' name=\'submit\' value=\'Change\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}

}
?>