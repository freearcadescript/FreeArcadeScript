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
$commentid = abs((int) $_GET['commentid']);
if(!$commentid){exit;}
$db->query(sprintf('UPDATE blogcomments SET visible=\'1\' WHERE commentid=\'%u\' ', $commentid));
echo '<div class=\'msg\'>Comment Approved.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function delete(){
global $domain, $db;
$commentid = abs((int) $_GET['commentid']);
if(!$commentid){exit;}
$db->query(sprintf('DELETE FROM blogcomments WHERE commentid=\'%u\'', $commentid));
echo '<div class=\'msg\'>Comment Deleted.<br />
			<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function approve(){
	global $domain, $db, $blogcommentpermissions, $template;
	if($blogcommentpermissions == 1){
		echo '<div class=\'error\'>You have auto approve blog comments set to on.</div><br />';
	}
	$r = $db->query('SELECT * FROM blogcomments WHERE visible=\'0\'');
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header5\'>Comment</td>
			<td class=\'header5\'>Action</td>
		</tr>';
	while($row = $db->fetch_row($r)){
	echo '<tr>
			<td class=\'content5\'><b>Comment Title: </b>'.$row['commenttitle'].'<p>'.$row['commentbody'].'<p><b>Commenter: </b>'.$row['commenterid'].'/'.$row['commenter'].'<br>
                  <b>Commenter IP: </b>'.$row['ipaddress'].'<br>
                  <b>Commenter URL: </b><a href=\'http://'.$row['commenterurl'].'\'>'.$row['commenterurl'].'</a></td>
			<td class=\'content5\' valign=\'top\' >
			<a href=\''.$domain.'/index.php?action=admin&case=approveblogcomments&cmd=do_approve&commentid='.$row['commentid'].'\'><img src=\''.$domain.'/templates/'.$template.'/images/approve.png\' border=\'0\'></a>

<a href=\''.$domain.'/index.php?action=admin&case=approveblogcomments&cmd=delete&commentid='.$row['commentid'].'\'  onclick="return confirm(\'Are you sure you want to delete the comment?\')"><img src=\''.$domain.'/templates/'.$template.'/images/deletebtn.png\' border=\'0\'></a>

			</td>
		</tr>';
	}
	echo '</table>';
}
?>