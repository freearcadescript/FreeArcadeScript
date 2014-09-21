<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){
	default:
	themes();
	break;

	case 'edit':
	edit();
	break;

	case 'delete':
	delete();
	break;

	case 'install':
	install();
	break;
}

function themes(){
	global $domain, $db, $directorypath;

	$r = mysql_query("SELECT * FROM fas_themes WHERE active='1' ORDER BY ID DESC");
	echo '<div class="heading">
		<h2>Themes</h2>
	</div>
	<br clear="all">
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Active Themes</th>
			</tr>
		</thead>
		<tbody>';
	while($row = $db->fetch_row($r)){
		$ID = $row['ID'];
    	$name = $row['name'];
		echo'<tr>
				<td width="855px">'.$name.'</td>
				<td><a href="'.$domain.'/index.php?action=admin&case=themes&cmd=edit&ID='.$ID.'"><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
					<a href="'.$domain.'/index.php?action=admin&case=themes&cmd=delete&ID='.$ID.'"  onclick="return confirm(\'Are you sure you want to delete the theme '.$name.'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
			</tr>'; }
echo'</tbody>
</table>';

$r = mysql_query("SELECT * FROM fas_themes WHERE active='0' ORDER BY ID DESC");
echo'<table id="table">
		<thead>
			<tr>
				<th colspan="2">Inactive Themes</th>
			</tr>
		</thead>
		<tbody>';
	while($row = $db->fetch_row($r)){
		$ID = $row['ID'];
    	$name = $row['name'];
		echo'<tr>
				<td width="855px">'.$name.'</td>
				<td><a href="'.$domain.'/index.php?action=admin&case=themes&cmd=edit&ID='.$ID.'"><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
					<a href="'.$domain.'/index.php?action=admin&case=themes&cmd=delete&ID='.$ID.'"  onclick="return confirm(\'Are you sure you want to delete the theme '.$name.'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
			</tr>'; }
echo'</tbody>
</table>

<table id="table">
		<thead>
			<tr>
				<th colspan="2">Uninstalled Themes</th>
			</tr>
		</thead>
		<tbody>';
	$path = $directorypath."templates";
	$directory = dir($path);
	while (false !== ($item = $directory->read())) {
		if ($item !== "." && $item !== "..") {
			$query = mysql_query("SELECT COUNT(*) FROM fas_themes WHERE template='$item'");
			$total = mysql_fetch_array($query);
			$total = $total[0];
			if($total == 0){
			echo'<tr>
				<td width="855px">'.$item.'</td>
				<td><a href="'.$domain.'/index.php?action=admin&case=themes&cmd=install&name='.$item.'">install</a></td>
			</tr>';
			}
		}
	}
echo'</tbody>
</table>';


}

function delete(){
global $domain, $db;

	$ID = clean($_GET['ID']);
	$ID = abs((int) ($ID));
	mysql_query("DELETE FROM fas_themes WHERE ID='$ID'");
	echo'<div class="msg">Theme deleted.</div>';
}

function edit(){
global $domain, $db;

	if(isset($_POST['submit'])){
		$name = clean($_POST['name']);
		$active = clean($_POST['active']);
		if(isset($_POST['default'])){
			$default = clean($_POST['default']);
		}else{
			$default = '1';
		}

		if($default == '1' && $active== '0'){
			echo '<div class="error">You cannot deactivate the default theme!</div>';
			return;
		}

		if(!$name){
			echo '<div class="error">Not all of the fields where filled!</div>';
			return;
		}

		if($default == 1){
			mysql_query("UPDATE fas_themes SET
 						`default`='0' WHERE `default`='1'") or die(mysql_error());
		}

 		mysql_query('UPDATE fas_themes SET
					name="'.$name.'",
 					active="'.$active.'",
					`default`="'.$default.'" WHERE name="'.$name.'"') or die(mysql_error());

		echo'<div class="msg">The theme "'.$name.'" has been updated.</div>';
		return;
	}
	$ID = clean($_GET['ID']);
	$ID = abs((int) ($ID));
	$sql = $db->query(sprintf('SELECT * FROM fas_themes WHERE ID=\'%u\' ', $ID)) or die(mysql_error());
	echo'<div class="heading">
		<h2>Edit Theme</h2>
	</div>
	<br clear="all">
	<form action=\''.$domain.'/index.php?action=admin&case=themes&cmd=edit\' method=\'post\'>
		<table id="table">';
			while($row = $db->fetch_row($sql)){
				if ($row['active'] == "0") {$asel = "selected";}else{$asel = NULL;};
				echo'<thead>
					<tr>
						<th colspan="2">Edit Theme: '.$row['name'].'</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" size="40" value="'.$row['name'].'"></td>
					</tr>
					<tr>
						<td>Theme:</td>
						<td>'.$row['template'].'</td>
					</tr>
					<tr>
						<td>Active:</td>
						<td><select type="dropdown" name="active">
								<option value="1">Yes</option>
								<option value="0" '.$asel.'>No</option>
							</select>
						</td>
					</tr>';
					if($row['default'] == "0"){
					echo'<tr>
						<td>Make Default:</td>
						<td><select type="dropdown" name="default">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</td>
					</tr>';
					}
					echo'<tr>
						<td colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Save\'></td>
					</tr>
				</tbody>';
			}
		echo'</table>
	</form>';
}

function install(){
global $domain, $db;

	if(isset($_POST['submit'])){
		$name = clean($_POST['name']);
		$theme = clean($_POST['theme']);
		if(!$name){
			echo 'Not all of the fields where filled!';
			return;
		}
		mysql_query("INSERT INTO fas_themes SET
					name='$name',
					template='$theme';");

		echo'<div class="msg">Your theme "'.$name.'" has been installed.</div>';
		return;
	}
	$name = clean($_GET['name']);
	echo'<div class="heading">
		<h2>Install Theme</h2>
	</div>
	<br clear="all">';
	echo'<form action="'.$domain.'/index.php?action=admin&case=themes&cmd=install&name='.$name.'" method=\'post\'>
		<table id="table">
			<thead>
				<tr>
					<th colspan="2">Install Theme: '.$name.'</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Name:</td>
					<td><input type=\'text\' name=\'name\' size=\'40\' value=\''.$name.'\'></td>
				</tr>
				<tr>
					<td>Theme:</td>
					<td>'.$name.'<input type=\'hidden\' name=\'theme\' size=\'0\' value=\''.$name.'\'></td>
				</tr>
				<tr>
					<td colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Install\'></td>
				</tr>
			</tbody>
		</table>
	</form>';
}
?>