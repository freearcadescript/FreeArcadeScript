<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){
	default:
	listentries();
	break;

	case 'editentry':
	editentry();
	break;

	case 'newentry':
	newentry();
	break;

	case 'savenew':
	savenew();
	break;

	case 'deleteentry':
	deleteentry();
	break;

	case 'saveedits':
	saveedits();
	break;

}
function listentries(){
global $domain, $db;



$max = '50';
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM fas_pageentries'),0);
$totalpages = ceil($totalres / $max);

	$r = mysql_query("SELECT * FROM fas_pageentries ORDER BY entryid DESC limit $limits,$max");
	echo '<div class="heading">
			<h2>Page Entries</h2>
		</div>
                <br clear="all">
		<a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=newentry\' class="button">New Page</a>
		<table id="table">
			<thead>
				<tr>
					<th>ID</th>
					<th colspan="2">Name</th>
				</tr>
			</thead>';
	while($row = $db->fetch_row($r)){

      $entryid = $row['entryid'];
      $title = $row['title'];
      $body = $row['body'];
      $author = $row['author'];
      $entrydate = $row['entrydate'];
      $visible = $row['visible'];
      $category = $row['category'];
		echo'<tbody>
			<tr>
				<td width="50px">'.$entryid.'</td>
				<td width="780px">'.$title.'</td>
				<td><a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=editentry&entryid='.$entryid.'\' ><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=deleteentry&entryid='.$entryid.'\' ><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
			</tr>
		</tbody>'; }
echo '</table>';




echo '
<div class="page-box">'
.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';

$previous = ''.$domain.'/index.php?action=admin&case=pageentries&page='.$pre.'';
$next = ''.$domain.'/index.php?action=admin&case=pageentries&page='.$ne.'';

if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				
				$urk = ''.$domain.'/index.php?action=admin&case=pageentries&page='.$i.'';
				
				if($show == $i){
					echo '<a href="'.$urk.'" class="page-select">'.$i.'</a>';
				}else{
					echo '<a href="'.$urk.'" class="page">'.$i.'</a>';
				}
			}
		}
	}
	if ($show < $totalpages){
		echo '<a href="'.$next.'" class="page">Next</a>';
	}
}
echo '</div>';
$pgname = 'Page entry list';



}




function editentry(){
global $domain, $db;
$entryid = abs((int) $_GET['entryid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_pageentries WHERE entryid=\'%u\'', $entryid)));
	echo '<div class="heading">
			<h2>Edit Page Entry</h2>
		</div>
                <br clear="all">
		<form action=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=saveedits\' method=\'post\' >
			<table id="table">
				<thead>
					<tr>
						<th colspan="3">Page Details</th>
					</tr>
				</thead>';

      $title = $row2['title'];
      $body = $row2['body'];
      $author = $row2['author'];
      $entrydate = $row2['entrydate'];
      $visible = $row2['visible'];
      $category = $row2['category'];
      $tags = $row2['tags'];
      $metadescription = $row2['metadescription'];

if  ($visible == 0) { $vsel='selected'; } else { $vsel=''; };


echo'<tbody>
		<tr>
			<td>Entry ID:</td>
			<td>'.$entryid.'<input name=\'entryid\' type=\'hidden\' value=\''.$entryid.'\'></td>
		</tr>
		<tr>
			<td>Post Date:</td>
			<td>'.$entrydate.'</td>
		</tr>
		<tr>
			<td>Entry Author:</td>
			<td>'.$author.'</td>
		</tr>
		<tr>
			<td>Entry Title:</td>
			<td><input type=\'text\' name=\'title\' size=\'50\' value=\''.$title.'\'></td>
		</tr>
		<tr>
			<td colspan="2">Entry Body:</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name=\'body\' rows=\'30\' cols=\'110\' >'.$body.'</textarea></td>
		</tr>
		<tr>
			<td>Visible?:</td>
			<td><select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$vsel.'>No</option>
						</select></td>
		</tr>
		<tr>
			<td>Category:</td>
			<td><input type=\'text\' name=\'category\' size=\'50\' value=\''.$category.'\'></td>
		</tr>
		<tr>
			<td>Meta Keywords:</td>
			<td><input type=\'text\' name=\'tags\' size=\'50\' value=\''.$tags.'\'></td>
		</tr>
		<tr>
			<td>Meta Description:</td>
			<td><input type=\'text\' name=\'metadescription\' size=\'50\' value=\''.$metadescription.'\'></td>
		</tr>
		<tr>
			<td colspan="2"><input type=\'submit\' value=\'save\'></td>
		</tr>
		</tbody>
	</table>
</form>';

}







function saveedits(){
	global $domain, $db;
$entryid = abs((int) $_POST['entryid']);
$title = clean($_POST['title']);
$body = clean($_POST['body']);
$visible = clean($_POST['visible']);
$category = clean($_POST['category']);
$tags = clean($_POST['tags']);
$metadescription = clean($_POST['metadescription']);
mysql_query("UPDATE fas_pageentries SET title='$title', body='$body', visible='$visible', category='$category', tags='$tags', metadescription='$metadescription'  WHERE entryid='$entryid'" ) ;
echo '<div class=\'msg\'>Page Entry '.$entryid.' updated</div><p>';


}





function newentry(){
	global $domain, $db;


echo '<div class="heading">
	<h2>New Page Entry</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=savenew\' method=\'post\' >
	<table id="table">
		<thead>
			<tr>
				<th colspan="3">Page Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Entry Title:</td>
				<td><input type=\'text\' name=\'title\' size=\'50\' ></td>
			</tr>
			<tr>
				<td colspan="2">Entry Body:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name=\'body\' rows=\'30\' cols=\'110\' ></textarea></td>
			</tr>
			<tr>
				<td>Visible?:</td>
				<td><select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select></td>
			</tr>
			<tr>
				<td>Category:</td>
				<td><select type=\'dropdown\' name=\'category\' ><p>';

	$cl = $db->query(sprintf('SELECT * FROM fas_pagecategories'));
	while($cl2 = $db->fetch_row($cl)){
echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>
'; };


echo '</select></td>
			</tr>
			<tr>
				<td>Meta Keywords:</td>
				<td><input type=\'text\' name=\'tags\' size=\'50\' ></td>
			</tr>
			<tr>
				<td>Meta Description:</td>
				<td><input type=\'text\' name=\'metadescription\' size=\'50\' ></td>
			</tr>
			<tr>
			<td colspan="2"><input type=\'submit\' value=\'save\'></td>
			</tr>
		</tbody>
	</table>
</form>';




}



function savenew(){
	global $domain, $db, $susername, $usrdata;

      $title = clean($_POST['title']);
      $body = clean($_POST['body']);
      $author = $usrdata['userid'];
      $entrydate = date("Y-m-d");
      $visible = clean($_POST['visible']);
      $category = clean($_POST['category']);
      $tags = clean($_POST['tags']);
      $metadescription = clean($_POST['metadescription']);

	$r = $db->query("INSERT INTO fas_pageentries SET
					title='$title',
					body='$body',
					author='$author',
					entrydate='$entrydate',
					visible='$visible',
					category='$category',
					tags='$tags',
					metadescription='$metadescription'
					" );
	echo 'Entry Saved.';


}



function deleteentry(){
	global $domain, $db;
	$entryid = abs((int) $_GET['entryid']);
if(!$entryid){echo 'Invalid entry.'; return;}
$db->query(sprintf('DELETE FROM fas_pageentries WHERE entryid=\'%u\'', $entryid));
echo ' Page Entry deleted.';

}
?>