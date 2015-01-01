<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}


switch($_GET['cmd']){
	default: 
	links();
	break;
	
	case 'delete':
	delete();
	break;
	
	case 'edit':
	edit();
	break;
	
}
function links(){
	global $domain, $db;
	echo'<div class="heading">
		<h2>Manage Links</h2>
	</div>
        <br clear="all">
	<a href=\''.$domain.'/index.php?action=admin&case=addlink\' class="button">New Link</a>
	<table id="table">
		<thead>
			<tr>
				<th>Title</th>
				<th colspan="2">URL</th>
			</tr>
		</thead>
		<tbody>';
	$r = $db->query(sprintf('SELECT * FROM fas_links where activate!="0"'));
	while($ir = $db->fetch_row($r)){	
	echo'<tr>
		<td width="420px">'.$ir['title'].'</td>
		<td width="420px"><a href=\''.$ir['url'].'\' target=_blank\'>'.$ir['url'].'</td>
		<td><a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ir['ID'].'\'><img src="panels/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
			<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete this link '.$ir['title'].'? \')"><img src="panels/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
	</tr>';
	};
	echo'</tbody></table>';
	echo '<table id="table">
		<thead>
			<tr>
				<th colspan="3">New links</tr>
			</tr>
			<tr>
				<th>Title</th>
				<th colspan="2">URL</th>
			</tr>
		</thead>';

	$r = $db->query(sprintf('SELECT * FROM fas_links where activate=\'0\''));

	while($ir = $db->fetch_row($r)){	
	echo'<tbody>
		<tr>
			<td width="420px">'.$ir['title'].'</td>
			<td width="420px"><a href=\''.$ir['url'].'\' target=_blank\'>'.$ir['url'].'</td>
			<td><a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ir['ID'].'\'><img src="panels/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the link '.$ir['title'].'?\')"><img src="panels/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>	
		</tr>
	</tbody>';
};
echo'</table>';
}

function delete(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
	$db->query(sprintf('DELETE FROM fas_links WHERE ID=\'%u\'', $ID));
	echo '<div class=\'msg\'>Link Deleted.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}

function edit(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {return;}
if(isset($_POST['submit'])){
	$title = clean($_POST['title']);
	$url = clean($_POST['url']);
	$activate = clean($_POST['activate']);
	$linkbackreq = clean($_POST['linkbackreq']);
	$linkbackat = clean($_POST['linkbackat']);
	$emailaddress = clean($_POST['emailaddress']);


	echo '<div class=\'msg\'>Link info Changed </div>';
	mysql_query("UPDATE fas_links SET title='$title', url='$url', activate='$activate', linkbackreq='$linkbackreq', linkbackat='$linkbackat', emailaddress='$emailaddress' WHERE ID='$ID'");
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_links WHERE ID=\'%u\'', $ID)));
echo'<div class="heading">
		<h2>Edit Link</h2>
	</div>
        <br clear="all">
	<form action=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ID.'\' method=\'post\'>
		<table id="table">
			<thead>
				<tr>
					<th colspan="2">Editing Link: '.$ir['title'].'</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Title: </td>
					<td><input type=\'text\' size=\'40\' name=\'title\' value=\''.$ir['title'].'\'></td>
				</tr>
				<tr>
					<td>URL:</td> 
					<td><input type=\'text\' size=\'40\' name=\'url\' value=\''.$ir['url'].'\'></td>
				</tr>
				<tr>
					<td>Status (0=inactive, 1=active, 2= sitewide): </td>
					<td><input type=\'text\' size=\'1\' name=\'activate\' value=\''.$ir['activate'].'\'></td>
     			</tr>
				<tr>
					<td>IP Address Subbitted From: </td>
					<td>'.$ir['IPaddress'].'</td>
     			</tr>
				<tr>
					<td>Link Back Required?: </td>
					<td><input type=\'text\' size=\'1\' name=\'linkbackreq\' value=\''.$ir['linkbackreq'].'\'></td>
     			</tr>
				<tr>
					<td>Link Back At: </td>
					<td><input type=\'text\' size=\'60\' name=\'linkbackat\' value=\''.$ir['linkbackat'].'\'></td>
     			</tr>
				<tr>
					<td>Email Address: </td>
					<td><input type=\'text\' size=\'60\' name=\'emailaddress\' value=\''.$ir['emailaddress'].'\'></td>
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