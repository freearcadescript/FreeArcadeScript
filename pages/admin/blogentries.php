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
$totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM fas_blogentries'),0);
$totalpages = ceil($totalres / $max);

	$r = mysql_query("SELECT * FROM fas_blogentries ORDER BY entryid DESC limit $limits,$max");
	echo '<div class="heading">
		<h2>Blog Entries</h2>
	</div>
        <br clear="all">
	<a href=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=newentry\' class="button">New Entry</a>
	<table id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th colspan="2">Name</th>
			</tr>
		<thead>
		<tbody>';
	while($row = $db->fetch_row($r)){
      $entryid = $row['entryid'];
      $title = $row['title'];
      $body = $row['body'];
      $author = $row['author'];
      $entrydate = $row['entrydate'];
      $visible = $row['visible'];
      $category = $row['category'];
			echo '<tr>
				<td width="50px">'.$entryid.'</td>
				<td width="780px">'.$title.'</td>
				<td><a href=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=editentry&entryid='.$entryid.'\' ><img src="pages/admin/img/edit.png" width="24" height="24 alt="edit" title="Edit" /></a>
					<a href=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=deleteentry&entryid='.$entryid.'\' onclick="return confirm(\'Are you sure you want to delete this blog '.$row['title'].'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" /></a></td>
			</tr>'; }
echo '</tbody>
</table>
<div class="page-box">'.$totalres.' blog(s) - Page '.$show.' of '.$totalpages.' - ';
for($i = 1; $i <= $totalpages; $i++){
	if($show == $i){
		echo '<a href="'.$domain.'/index.php?action=admin&case=blogentries&page='.$i.'" class="page-select">'.$i.'</a>&nbsp;';
	}else{
		echo '<a href="'.$domain.'/index.php?action=admin&case=blogentries&page='.$i.'" class="page">'.$i.'</a>&nbsp;';
	}
}
echo '</div>';
$pgname = 'Blog entry list';



}




function editentry(){
global $domain, $db;
$entryid = abs((int) $_GET['entryid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_blogentries WHERE entryid=\'%u\'', $entryid)));
	echo '<div class="heading">
		<h1>Edit Blog Entry: '.$row2['title'].'</h1>
	</div>
        <br clear="all">';
      $title = $row2['title'];
      $body = $row2['body'];
      $author = $row2['author'];
      $entrydate = $row2['entrydate'];
      $visible = $row2['visible'];
      $category = $row2['category'];
      $tags = $row2['tags'];
if  ($visible == 0) { $vsel='selected'; } else { $vsel=''; };

echo '<form action=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=saveedits\' method=\'post\' >
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Entry Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Entry ID:</td>
				<td>'.$entryid.'<input name=\'entryid\' type=\'hidden\' value=\''.$entryid.'\'></td>
			</tr>
			<tr>
				<td>Post Date: </td>
				<td>'.$entrydate.'</td>
			</tr>
			<tr>
				<td>Entry Author: </td>
				<td>'.$author.'</td>
			</tr>
			<tr>
				<td>Entry Title: </td>
				<td><input type=\'text\' name=\'title\' size=\'50\' value=\''.$title.'\'></td>
			</tr>
			<tr>
				<td colspan="2">No HTML is allowed. Please use the following code formats:<br />
				Links: <b>[url]</b>domain.com/path<b>[urlmid]</b>anchor<b>[/url]</b><br />
				Images: <b>[img]</b>domain.com/imgagepath/img.gif<b>[/img]</b><br />
				Bold: <b>[b]</b>text to make bold<b>[/b]</b><br />
				italic: <b>[i]</b>text to make italic<b>[/i]</b><br />
				underline: <b>[u]</b>text to underline<b>[/u]</b><br />
				New Line: <b>[br]</b></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name=\'body\' rows=\'30\' cols=\'110\' >'.$body.'</textarea></td>
			</tr>
			<tr>
				<td>Visible?: </td>
				<td><select type=\'dropdown\' name=\'visible\'>
					<option value=\'1\'>Yes</option>
					<option value=\'0\' '.$vsel.'>No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Category: </td>
				<td><input type=\'text\' name=\'category\' size=\'50\' value=\''.$category.'\'></td>
			</tr>
			<tr>
				<td>Tags: </td>
				<td><input type=\'text\' name=\'tags\' size=\'50\' value=\''.$tags.'\'></td>
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

mysql_query("UPDATE fas_blogentries SET title='$title', body='$body', visible='$visible', category='$category', tags='$tags'  WHERE entryid='$entryid'" ) ;
echo '<div class=\'msg\'>Blog Entry '.$entryid.' updated</div>';


}





function newentry(){
	global $domain, $db;


echo '<div class="heading">
	<h2>New Blog Entry</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=savenew\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Entry Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Entry Title:</td>
				<td><input type=\'text\' name=\'title\' size=\'50\' ></td>
			</tr>
			<tr>
				<td colspan="2">No HTML is allowed. Please use the following code formats:<br />
				Links: <b>[url]</b>domain.com/path<b>[urlmid]</b>anchor<b>[/url]</b><br />
				Images: <b>[img]</b>domain.com/imgagepath/img.gif<b>[/img]</b><br />
				Bold: <b>[b]</b>text to make bold<b>[/b]</b><br />
				italic: <b>[i]</b>text to make italic<b>[/i]</b><br />
				underline: <b>[u]</b>text to underline<b>[/u]</b><br />
				New Line: <b>[br]</b></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name=\'body\' rows=\'30\' cols=\'110\' ></textarea></td>
			</tr>
			<tr>
				<td>Visible?: </td>
				<td><select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select>
				</td>
			</tr>
			<tr>
				<td>Category: </td>
				<td><select type=\'dropdown\' name=\'category\' >';
					$cl = $db->query(sprintf('SELECT * FROM fas_blogcategories'));
					while($cl2 = $db->fetch_row($cl)){
					echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>'; };
					echo '</select></td>
			</tr>
			<tr>
				<td>Tags: </td>
				<td><input type=\'text\' name=\'tags\' size=\'50\' ></td>
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
      if ($usrdata['bloglevel'] == 3) { $body = clean($_POST['body']); } else { $body = clean($_POST['body']); };
      $author = $_SESSION['username'];
      $entrydate = date("Y-m-d");
      $visible = clean($_POST['visible']);
      $category = clean($_POST['category']);
      $tags = clean($_POST['tags']);

	$r = $db->query("INSERT INTO fas_blogentries SET
					title='$title',
					body='$body',
					author='$author',
					entrydate='$entrydate',
					visible='$visible',
					category='$category',
					tags='$tags'
					" );
	echo '<div class="msg">Entry Saved.</div>';


}



function deleteentry(){
	global $domain, $db;
	$entryid = abs((int) $_GET['entryid']);
if(!$entryid){echo 'Invalid entry.'; return;}
$db->query(sprintf('DELETE FROM fas_blogentries WHERE entryid=\'%u\'', $entryid));
echo '<div class="msg"> Blog Entry deleted.</div>';

}
?>