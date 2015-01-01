<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){
	default:
	approve();
	break;

	case 'do_approve':
	do_approve();
	break;

	case 'delete':
	delete();
	break;
}
function do_approve(){
global $domain, $db, $action;
$ID = abs((int) $_GET['ID']);
if(!$ID){return;}
$db->query(sprintf('UPDATE fas_comments SET approved=\'1\' WHERE ID=\'%u\' ', $ID));
echo '<div class=\'msg\'>Comment Approved.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function delete(){
global $domain, $db, $action;
$ID = abs((int) $_GET['ID']);
if(!$ID){return;}
$db->query(sprintf('DELETE FROM fas_comments WHERE ID=\'%u\'', $ID));
echo '<div class=\'msg\'>Comment Deleted.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function approve(){
	global $domain, $db, $autoapprovecomments, $action;
	if($autoapprovecomments == 1){
		echo '<div class=\'error\'>You have auto approve comments set to on.</div><br />';
	}else{
	$r = $db->query('SELECT * FROM fas_comments WHERE approved=\'0\'');
	echo '<div class="heading">
		<h2>Approve Game Comments</h2>
	</div>
        <br clear="all">
        <a href=\''.$domain.'/index.php?action='.$action.'&case=managegamecomments\' class="button">Manage Game Comments</a>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Comment</th>
			</tr>
		</thead>
		<tbody>';
	while($row = $db->fetch_row($r)){
	echo '<tr>
			<td width="850px">'.$row['comment'].'</td>
			<td><a href=\''.$domain.'/index.php?action='.$action.'&case=approvecomments&cmd=do_approve&ID='.$row['ID'].'\'><img src="panels/admin/img/approve.png" width="24" height="24" alt="approve" title="Approve" border="0" /></a>
				<a href=\''.$domain.'/index.php?action='.$action.'&case=approvecomments&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the comment?\')"><img src="panels/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a>
			</td>
		</tr>';
	}
	echo '</tbody>
	</table>';
	}
}
?>