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
	global $domain, $db, $action;
	echo '<div class="heading">
		<h2>Manage Blog Comments</h2>
	</div>
        <br clear="all">

	<table id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Blog ID</th>
				<th colspan="2">Comment</th>
			</tr>
		</thead>
		<tbody>';
	$r = $db->query(sprintf('SELECT * FROM fas_blogcomments'));
	while($ir = $db->fetch_row($r)){
	echo '<tr>
			<td width="50px">'.$ir['commentid'].'</td>
			<td width="100px">'.$ir['blogentryid'].'</td>
			<td width="680px">'.$ir['commentbody'].'</td>
			<td><a href=\''.$domain.'/index.php?action='.$action.'&case=manageblogcomments&cmd=edit&commentid='.$ir['commentid'].'\'><img src="panels/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
				<a href=\''.$domain.'/index.php?action='.$action.'&case=manageblogcomments&cmd=delete&commentid='.$ir['commentid'].'\'  onclick="return confirm(\'Are you sure you want to delete this Blog Comment?\')"><img src="panels/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a></td>
		</tr>';
	}
echo '</tbody>
</table>';
}
function delete(){
global $db, $domain, $action;
$commentid = abs((int) $_GET['commentid']);
if(!$commentid) {return;}
	$db->query(sprintf('DELETE FROM fas_blogcomments WHERE commentid=\'%u\'', $commentid));
	echo '<div class=\'msg\'>Blog Comment Deleted!.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain, $action;
$commentid = abs((int) $_GET['commentid']);
if(!$commentid) {return;}
if(isset($_POST['submit'])){
	$commentid  = clean($_POST['commentid']);
	$blogentryid  = clean($_POST['blogentryid']);
	$commenttitle  = clean($_POST['commenttitle']);
	$commentbody  = clean($_POST['commentbody']);
	$commenter  = clean($_POST['commenter']);
	$commenterid  = clean($_POST['commenterid']);
	$commenterurl  = clean($_POST['commenterurl']);
	$visible  = clean($_POST['visible']);
	echo '<div class=\'msg\'>Blog Comment Updated!</div>';
	mysql_query("UPDATE fas_blogcomments SET commentid='$commentid', blogentryid='$blogentryid', commenttitle='$commenttitle', commentbody='$commentbody', commenter='$commenter', commenterid='$commenterid', commenterurl='$commenterurl', visible='$visible' WHERE commentid='$commentid' ");
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_blogcomments WHERE commentid=\'%u\'', $commentid)));
echo '<div class="heading">
	<h2>Editing Blog Comment: '.$ir['commentid'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action='.$action.'&case=manageblogcomments&cmd=edit&commentid='.$commentid.'\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Comment commentid: </td>
				<td><input type=\'text\' size=\'40\' name=\'commentid\' value=\''.$ir['commentid'].'\'></td>
			<tr>
			</tr>
				<td>Blog commentid: </td>
				<td><input type=\'text\' size=\'40\' name=\'blogentryid\' value=\''.$ir['blogentryid'].'\'></td>
			<tr>
			</tr>
				<td>Comment Title: </td>
				<td><input type=\'text\' size=\'40\' name=\'commenttitle\' value=\''.$ir['commenttitle'].'\'></td>
			<tr>
			</tr>
				<td>Comment: </td>
				<td><input type=\'text\' size=\'20\' name=\'commentbody\' value=\''.$ir['commentbody'].'\'></td>
			<tr>
			</tr>
				<td>Comment By: </td>
				<td><input type=\'text\' size=\'20\' name=\'commenter\' value=\''.$ir['commenter'].'\'></td>
			<tr>
			</tr>
				<td>User commentid: </td>
				<td><input type=\'text\' size=\'20\' name=\'commenterid\' value=\''.$ir['commenterid'].'\'></td>
			<tr>
			</tr>
				<td>URL: </td>
				<td><input type=\'text\' size=\'20\' name=\'commenterurl\' value=\''.$ir['commenterurl'].'\'></td>
			<tr>
			</tr>
				<td>Approved: </td>
				<td><input type=\'text\' size=\'20\' name=\'visible\' value=\''.$ir['visible'].'\'></td>
			<tr>
			</tr>
				<td>Date: </td>
				<td>'.date('M-d-Y', $ir['commentdate']).'</td>
			<tr>
			</tr>
				<td>IPaddress: </td>
				<td>'.$ir['ipaddress'].'</td>
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