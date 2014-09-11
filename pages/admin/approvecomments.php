<?php
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
global $domain, $db;
$ID = abs((int) $_GET['ID']);
if(!$ID){exit;}
$db->query(sprintf('UPDATE dd_comments SET approved=\'1\' WHERE ID=\'%u\' ', $ID));
echo '<div class=\'msg\'>Comment Approved.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function delete(){
global $domain, $db;
$ID = abs((int) $_GET['ID']);
if(!$ID){exit;}
$db->query(sprintf('DELETE FROM dd_comments WHERE ID=\'%u\'', $ID));
echo '<div class=\'msg\'>Comment Deleted.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function approve(){
	global $domain, $db, $autoapprovecomments;
	if($autoapprovecomments == 1){
		echo '<div class=\'error\'>You have auto approve comments set to on.</div><br />';
	}
	$r = $db->query('SELECT * FROM dd_comments WHERE approved=\'0\'');
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header5\'>Comment</td>
			<td class=\'header5\'>Action</td>
		</tr>';
	while($row = $db->fetch_row($r)){
	echo '<tr>
			<td class=\'content5\'>'.$row['comment'].'</td>
			<td class=\'content5\'>
			<a href=\''.$domain.'/index.php?action=admin&case=approvecomments&cmd=do_approve&ID='.$row['ID'].'\'><img src=\''.$domain.'/templates/default/images/approve.png\' border=\'0\'></a>

<a href=\''.$domain.'/index.php?action=admin&case=approvecomments&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the comment?\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>

			</td>
		</tr>';
	}
	echo '</table>';
}
?>