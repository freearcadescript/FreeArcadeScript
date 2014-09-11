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
global $domain, $db;
$commentid = abs((int) $_GET['commentid']);
if(!$commentid){return;}
$db->query(sprintf('UPDATE fas_blogcomments SET visible=\'1\' WHERE commentid=\'%u\' ', $commentid));
echo '<div class=\'msg\'>Comment Approved.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function delete(){
global $domain, $db;
$commentid = abs((int) $_GET['commentid']);
if(!$commentid){return;}
$db->query(sprintf('DELETE FROM fas_blogcomments WHERE commentid=\'%u\'', $commentid));
echo '<div class=\'msg\'>Comment Deleted.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function approve(){
	global $domain, $db, $blogcommentpermissions;
	if($blogcommentpermissions == 1){
		echo '<div class=\'error\'>Auto approve blog comments is set to on.</div><br />';
	}else{
	$r = $db->query('SELECT * FROM fas_blogcomments WHERE visible=\'0\'');
	echo '<div class="heading">
			<h2>Blog comments</h2>
		</div>
		<table id="table">
			<thead>
				<tr>
					<th>Title</th>
					<th colspan="2">Body</th>
				</tr>
			</thead>
			<tbody>';
		while($row = $db->fetch_row($r)){
		echo '<tr>
				<td width="420px">'.$row['commenttitle'].'</td>
				<td width="420px">'.$row['commentbody'].'</td>
				<td><a href="'.$domain.'/index.php?action=blogadmin&case=approveblogcomments&cmd=do_approve&commentid='.$row['commentid'].'"><img src="pages/admin/img/approve.png" width="24" height="24" alt="approve" title="Approve" /></a>
					<a href="'.$domain.'/index.php?action=blogadmin&case=approveblogcomments&cmd=delete&commentid='.$row['commentid'].'"  onclick="return confirm(\'Are you sure you want to delete the comment?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
			</tr>';
		}
	echo '</tbody>
	</table>';
	}
}
?>