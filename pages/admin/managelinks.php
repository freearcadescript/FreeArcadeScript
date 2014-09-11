<?php
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
	echo '
	<div class=\'header4\'>Manage Links</div><br />
	<table width=\'80%\' align=\'center\'>
		<tr>
			<td class=\'header5\'>Title</td>
			<td class=\'header5\'>URL</td>
			<td class=\'header5\'>Actions</td>
		</tr>';
	$r = $db->query(sprintf('SELECT * FROM dd_links'));
	while($ir = $db->fetch_row($r)){	
	echo '	<tr>
			<td>'.$ir['title'].'</td>
			<td><a href=\''.$ir['url'].'\' target=_blank\'>'.$ir['url'].'</td>
			<td>
			<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ir['ID'].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' border=\'0\'></a>
		
			<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['name'].'? \n All games in this category will be deleted from the database too.\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	
		</tr>';





	}	;



	echo '<tr><td colspan=\'3\'><p>&nbsp;<p>
	<div class=\'header4\'>New Links</div><br />
</td></tr>
		<tr>
			<td class=\'header5\'>Title</td>
			<td class=\'header5\'>URL</td>
			<td class=\'header5\'>Actions</td>
		</tr>';

	$r = $db->query(sprintf('SELECT * FROM dd_links where activate=\'0\''));

	while($ir = $db->fetch_row($r)){	
	echo '	<tr>
			<td>'.$ir['title'].'</td>
			<td><a href=\''.$ir['url'].'\' target=_blank\'>'.$ir['url'].'</td>
			<td>
			<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ir['ID'].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' border=\'0\'></a>
		
			<a href=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=delete&ID='.$ir['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['name'].'? \n All games in this category will be deleted from the database too.\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	
		</tr>';

};






echo '	</table>	
	';
}

function delete(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {exit;}
	$db->query(sprintf('DELETE FROM dd_links WHERE ID=\'%u\'', $ID));
	echo '<div class=\'msg\'>Link Deleted.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}

function edit(){
global $db, $domain;
$ID = abs((int) $_GET['ID']);
if(!$ID) {exit;}
if(isset($_POST['submit'])){
	$title = clean($_POST['title']);
	$url = clean($_POST['url']);
	$activate = clean($_POST['activate']);
	$linkbackreq = clean($_POST['linkbackreq']);
	$linkbackat = clean($_POST['linkbackat']);
	$emailaddress = clean($_POST['emailaddress']);


	echo '<div class=\'msg\'>Link info Changed </div>';
	mysql_query("UPDATE dd_links SET title='$title', url='$url', activate='$activate', linkbackreq='$linkbackreq', linkbackat='$linkbackat', emailaddress='$emailaddress' WHERE ID='$ID'");
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_links WHERE ID=\'%u\'', $ID)));
echo '<div class=\'header4\'>Editing Link: '.$ir['url'].'</div><br /><div align=\'center\'>
<form action=\''.$domain.'/index.php?action=admin&case=managelinks&cmd=edit&ID='.$ID.'\' method=\'POST\'>
	Title: <input type=\'text\' size=\'40\' name=\'title\' value=\''.$ir['title'].'\'><br>
	URL: <input type=\'text\' size=\'40\' name=\'url\' value=\''.$ir['url'].'\'><br>
	Status (0=inactive, 1=active, 2= sitewide): <input type=\'text\' size=\'1\' name=\'activate\' value=\''.$ir['activate'].'\'><br>
      IP Address Subbitted From: '.$ir['IPaddress'].'<br>
      Link Back Required?: <input type=\'text\' size=\'1\' name=\'linkbackreq\' value=\''.$ir['linkbackreq'].'\'><br>
      Link Back At: <input type=\'text\' size=\'60\' name=\'linkbackat\' value=\''.$ir['linkbackat'].'\'><br>
      Email Address: <input type=\'text\' size=\'60\' name=\'emailaddress\' value=\''.$ir['emailaddress'].'\'><br>


	<input type=\'submit\' name=\'submit\' value=\'Change\'>

</form></div>';
}

}

?>