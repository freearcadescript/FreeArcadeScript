<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){

	default:
	cats();
	break;

	case 'games':
	games();
	break;

	case 'edit':
	edit();
	break;

	case 'delete':
	delete();
	break;
}
function cats(){
global $domain;
$rr = mysql_query(sprintf('SELECT * FROM fas_categories'));
echo '<div class="heading">
	<h2>Manage Games</h2>
</div>
<br clear="all">
<table id="table">
	<thead>
		<tr>
			<th colspan="2">Choose Game Category</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="95%">All Games</td>
			<td><a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID=all\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a></td>
		</tr>';
while($row = mysql_fetch_array($rr)){
		echo'<tr>
			<td width="95%">'.$row['name'].'</td>
			<td><a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$row['ID'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a></td>
		</tr>';
   }

	echo'</tbody>
</table>';

}
function games(){
global $domain, $db, $usrdata;
$CID = abs((int) $_GET['CID']);

$max = 20;
if(!isset($_GET['show'])){
	$show = '1';
}else{
	$show = $_GET['show'];
}
$limits = ($show - 1) * $max;
$useridm = clean($usrdata['userid']);

if($CID == "all"){
	$sql = $db->query(sprintf('SELECT * FROM fas_games WHERE gameadder=\'%s\' order by name ASC LIMIT '.$limits.','.$max.' ', $useridm)) or die(mysql_error());
	$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM fas_games WHERE gameadder=\'%s\' ',$useridm)),0);
}else{
	$sql = $db->query(sprintf('SELECT * FROM fas_games WHERE category=\'%u\' and gameadder=\'%s\' order by name ASC LIMIT '.$limits.','.$max.' ', $CID, $useridm)) or die(mysql_error());
	$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM fas_games WHERE category=\'%u\' and  gameadder=\'%s\' ', $CID, $useridm)),0);
}
$totalpages = ceil($totalres / $max);

echo '<div class="heading">
	<h2>Manage Games</h2>
</div>
<br clear="all">
<form action=\'\' method=\'post\'>
<table id="table">
		<thead>
			<tr>
				<th width="50px">Type</th>
				<th colspan="2">Name</th>
			</tr>
		</thead>
		<tbody>';
if(!mysql_num_rows($sql)){
	echo '<tr>
			<td colspan=\'3\' align=\'center\'>There are no games added.</td>
		</tr>';
}
while($row = $db->fetch_row($sql)){
if($row['type'] == 1){
	$type = 'Self Hosted';
}else{
	$type = 'Enabled Code';
}
echo '<tr>
		<td width="90px">'.$type.'</td>
		<td width="750px">'.$row['name'].'</td>
		<td><a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$row['ID'].'&type='.$row['type'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
			<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row['name'].'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a>
		</td>
	</tr>';
}
echo '</tbody>
	</table>
</form>

<div class="page-box">
'.$totalres.' game(s) - Page '.$show.' of '.$totalpages.' - ';
for($i = 1; $i <= $totalpages; $i++){
	if($show == $i){
		echo '<a href="'.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$CID.'&show='.$i.'" class="page-select">'.$i.'</a> ';
	}else{
		echo '<a href="'.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$CID.'&show='.$i.'" class="page">'.$i.'</a> ';
	}
}
echo'</div>';
}
function delete(){
$ID = abs((int) $_GET['ID']);
mysql_query(sprintf('DELETE FROM fas_games WHERE ID=\'%u\' and gameadder=\'%s\' ', $ID, $useridm));
echo '<div class=\'msg\'>Game Deleted.
		<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $domain, $db, $gamesfolder, $thumbsfolder, $usrdata;
$useridm = clean($usrdata['userid']);
$ID = abs((int) $_GET['ID']);
$r = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_games WHERE ID=\'%u\' and gameadder=\'%s\' ', $ID, $useridm)));
if($_GET['type'] == 1){
if(isset($_POST['submit'])){

	$name = clean($_POST['name']);
	$desc = clean($_POST['desc']);
	$width = clean($_POST['width']);
	$height = clean($_POST['height']);
	$category = clean($_POST['category']);

	$tags = clean($_POST['tags']);
	$highscore = clean($_POST['highscore']);
	$highscoreable = clean($_POST['highscoreable']);
	$highscoreuser = clean($_POST['highscoreuser']);
	$highscoredate = clean($_POST['highscoredate']);
	$highscoreip = clean($_POST['highscoreip']);
	if(!$name){
		echo 'No name entered.';
	}else{

	mysql_query("UPDATE fas_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						tags='$tags',
						highscore='$highscore',
						highscoreable='$highscoreable',
						highscoreuser='$highscoreuser',
						highscoredate='$highscoredate',
						highscoreip='$highscoreip' WHERE ID='$ID' and gameadder='$useridm'");

	echo '<div class=\'error\'>Game updated.<br />

		<A href="#" onclick="history.go(-1)">Back</a></div></div>';
}
}else{
echo '<div class="heading">
	<h2>Editing Game: '.$r['name'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
		<tr>
				<td>Name:*</td>
				<td><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
			</tr>
			<tr>
				<td>Description:*</td>
				<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
			</tr>
			<tr>
				<td>Width:*</td>
				<td><input type=\'text\' name=\'width\' value=\''.$r['width'].'\'></td>
			</tr>
			<tr>
				<td>Height:*</td>
				<td><input type=\'text\' name=\'height\' value=\''.$r['height'].'\'></td>
			</tr>
			<tr>
				<td>Category:*</td>
				<td><select type=\'dropdown\' name=\'category\' >';
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
						echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
					}
					echo'</select>
				</td>
			</tr>
			<tr>
				<td>Thumb File:*</td>
				<td>'.$thumbsfolder.'/'.$r['thumb'].'</td>
			</tr>
			<tr>
				<td>SWF Game File:*</td>
				<td>'.$gamesfolder.'/'.$r['file'].'</td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
			</tr>
			<tr>
				<td>Highscore:</td>
				<td><input type=\'text\' name=\'highscore\' value=\''.$r['highscore'].'\'></td>
			</tr>
			<tr>
				<td>Highscore Capable:<br><small></td>
				<td><input type=\'text\' name=\'highscoreable\' value=\''.$r['highscoreable'].'\'></td>
			</tr>
			<tr>
				<td>Highscore User:</td>
				<td><input type=\'text\' name=\'highscoreuser\' value=\''.$r['highscoreuser'].'\'></td>
			</tr>
			<tr>
				<td>Highscore Date:</td>
				<td><input type=\'text\' name=\'highscoredate\' value=\''.$r['highscoredate'].'\'></td>
			</tr>
			<tr>
				<td>Highscore IP:</td>
				<td><input type=\'text\' name=\'highscoreip\' value=\''.$r['highscoreip'].'\'></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}
}else{

if(isset($_POST['submit'])){
	$thumburl = clean($_POST['thumburl']);
	$name = clean($_POST['name']);
	$desc = clean($_POST['desc']);
	$category = clean($_POST['category']);
	$active = clean($_POST['active']);
	$enabledcode = clean($_POST['enabledcode']);
	$tags = clean($_POST['tags']);
	$highscore = clean($_POST['highscore']);
	$highscoreuser = clean($_POST['highscoreuser']);
	$highscoredate = clean($_POST['highscoredate']);
	$highscoreip = clean($_POST['highscoreip']);


	mysql_query("UPDATE fas_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						thumburl='$thumburl',
						enabledcode='$enabledcode'
						active='$active',
						tags='$tags',
						highscore='$highscore',
						highscoreuser='$highscoreuser',
						highscoredate='$highscoredate',
						highscoreip='$highscoreip' WHERE ID='$ID' and gameadder='$useridm'");

}else{
echo '<div class="heading">
	<h2>Editing Game: '.$r['name'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
		<tr>
				<td>Name:*</td>
				<td><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
			</tr>
			<tr>
				<td>Description:*</td>
				<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
			</tr>
			<tr>
				<td>Category:*</td>
				<td><select type=\'dropdown\' name=\'category\'>';
					$query = $db->query('SELECT * FROM fas_categories');
						while($row = $db->fetch_row($query)){
							echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
						}
		echo'</select>
				</td>
			</tr>
			<tr>
				<td>Thumb URL:*</td>
				<td><input type=\'text\' size=\'55\' name=\'thumburl\' value=\''.$r['thumburl'].'\'></td>
			</tr>
			<tr>
				<td>Code:*</td>
				<td><textarea cols=\'45\' rows=\'6\' name=\'enabledcode\'>'.$r['enabledcode'].'</textarea></td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
			</tr>
			<tr>
				<td>Highscore:</td>
				<td><input type=\'text\' name=\'highscore\' value=\''.$r['highscore'].'\'></td>
			</tr>
			<tr>
				<td>Highscore User:</td>
				<td><input type=\'text\' name=\'highscoreuser\' value=\''.$r['highscoreuser'].'\'></td>
			</tr>
			<tr>
				<td>Highscore Date:</td>
				<td><input type=\'text\' name=\'highscoredate\' value=\''.$r['highscoredate'].'\'></td>
			</tr>
			<tr>
				<td>Highscore IP:</td>
				<td><input type=\'text\' name=\'highscoreip\' value=\''.$r['highscoreip'].'\'></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}
}
}
?>