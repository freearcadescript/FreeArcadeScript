<?php
switch($_GET['cmd']){
	default: 
	categories();
	break;
	
	case 'delete':
	delete();
	break;
	
	case 'edit':
	edit();
	break;
	
}
function categories(){
	global $domain, $db, $template;
	echo '
	<div class=\'pgtitle\'>Manage Categories</div><br />
	<table width=\'80%\' align=\'center\'>
		<tr>
			<td class=\'header5\'>Category Name</td>
			<td class=\'header5\'>Actions</td>
		</tr>';
	$r = $db->query(sprintf('SELECT * FROM pagecategories'));
	while($ir = $db->fetch_row($r)){	
	echo '	<tr>
			<td>'.$ir['categoryname'].'</td>
			
			<td><a href=\''.$domain.'/index.php?action=admin&case=managepagecategories&cmd=edit&categoryid='.$ir['categoryid'].'\'><img src=\''.$domain.'/templates/'.$template.'/images/editbtn.png\' border=\'0\'></a>
		
			<a href=\''.$domain.'/index.php?action=admin&case=managepagecategories&cmd=delete&categoryid='.$ir['categoryid'].'\'  onclick="return confirm(\'Are you sure you want to delete the category '.$ir['categoryname'].'? \n All etries in this category will be deleted from the database too.\')"><img src=\''.$domain.'/templates/'.$template.'/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	
		</tr>';
	}	
echo '	</table>	
	';
}
function delete(){
global $db, $domain;
$categoryid = abs((int) $_GET['categoryid']);
if(!$categoryid) {echo 'no category selected'; exit;}
	$db->query(sprintf('DELETE FROM pageentries WHERE category=\'%u\'', $categoryid));
	$db->query(sprintf('DELETE FROM pagecategories WHERE categoryid=\'%u\'', $categoryid));
	echo '<div class=\'msg\'>page category Deleted, entries deleted in category.
				<br /><A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $db, $domain;
$categoryid = abs((int) $_GET['categoryid']);
$topcategory = clean($_POST['topcategory']);
if(!$categoryid) {exit;}
if(isset($_POST['submit'])){
	$categoryname  = clean($_POST['categoryname']);
	echo '<div class=\'msg\'>Category name changed to '.$categoryname.'</div>';
	mysql_query("UPDATE pagecategories SET categoryname='$categoryname', topcategory='$topcategory' WHERE categoryid='$categoryid'"); 
}else{
$ir = $db->fetch_row($db->query(sprintf('SELECT * FROM pagecategories WHERE categoryid=\'%u\'', $categoryid)));
echo '<div class=\'pgtitle\'>Editing Blog Category '.$ir['categoryname'].'</div><br /><div align=\'center\'>

<form action=\''.$domain.'/index.php?action=admin&case=managepagecategories&cmd=edit&categoryid='.$categoryid.'\' method=\'POST\'>
      

<br>
Top Category: <select type=\'dropdown\' name=\'topcategory\' >';

	$cl = $db->query(sprintf('SELECT * FROM pagecategories'));
	while($cl2 = $db->fetch_row($cl)){
echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>
'; };

echo '</select>
<br>



	Category Name: <input type=\'text\' size=\'40\' name=\'categoryname\' value=\''.$ir['categoryname'].'\'><br>
      Activate?: <select type=\'dropdown\' name=\'activate\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select>

<br>
	<input type=\'submit\' name=\'submit\' value=\'Change\'>
</form></div>';
}

}

?>