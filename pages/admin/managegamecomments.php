<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){
	default:
	comments();
	break;

	case 'delete':
	delete();
	break;

	case 'edit':
	edit();
	break;

}
function comments(){
	global $domain, $db;
	echo '<div class="heading">
		<h2>Manage Game Comments</h2>
	</div>
        <br clear="all">
	<table id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Game ID</th>
				<th colspan="2">Comment</th>
			</tr>
		</thead>
		<tbody>';
	$r = $db->query(sprintf('SELECT * FROM fas_comments'));
	while($ir = $db->fetch_row($r)){
	echo '<tr>
			<td width="50px">'.$ir['ID'].'</td>
			<td width="100px">'.$ir['gameid'].'</td>
			<td width="680px">'.$ir['comment'].'</td>
			<td><a href=\''.$domain.'/index.php?action=admin&case=managegamecomments&cmd=edit&ID='.$ir['ID'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=managegamecomments&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete this comment?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a></td>
		</tr>';
	}
echo '</tbody>
</table>';
}
function delete(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
	$db->query(sprintf('DELETE FROM fas_comments WHERE ID=\'%u\'', $ID));
	echo '<div class=\'msg\'>Comment Deleted!.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
if(isset($_POST['submit'])){
	$gameid  = clean($_POST['gameid']);
	$commenter  = clean($_POST['commenter']);
	$comment  = clean($_POST['comment']);
	$date  = clean($_POST['date']);
	$approved  = clean($_POST['approved']);
	echo '<div class=\'msg\'>Comment Updated!</div>';
	mysql_query("UPDATE fas_comments SET gameid='$gameid', commenter='$commenter', comment='$comment', date='$date' , approved='$approved' WHERE ID='$ID' ");
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_comments WHERE ID=\'%u\'', $ID)));
echo '<div class="heading">
	<h2>Editing Game Comment: '.$ir['gameid'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=managegamecommentss&cmd=edit&ID='.$ID.'\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Game ID: </td>
				<td><input type=\'text\' size=\'40\' name=\'name\' value=\''.$ir['gameid'].'\'></td>
			<tr>
			</tr>
				<td>Commenter: </td>
				<td><input type=\'text\' size=\'40\' name=\'commenter\' value=\''.$ir['commenter'].'\'></td>
			<tr>
			</tr>
				<td>Comment: </td>
				<td><input type=\'text\' size=\'40\' name=\'comment\' value=\''.$ir['comment'].'\'></td>
			<tr>
			</tr>
				<td>Date Posted: </td>
				<td>'.date('M-d-Y', $ir['date']).'</td>
			<tr>
			</tr>
				<td>Approved: </td>
				<td><input type=\'text\' size=\'2\' name=\'approved\' value=\''.$ir['approved'].'\'></td>
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