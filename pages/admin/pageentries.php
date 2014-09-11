<?php
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
$show = clean($_GET['page']);
if(empty($show)){
$show = 1;
}
$limits = ($show - 1) * $max; 
$totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM pageentries'),0); 
$totalpages = ceil($totalres / $max);





	$r = mysql_query("SELECT * FROM pageentries ORDER BY entryid DESC limit $limits,$max");
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header\'>Page Entries</td>
			
		</tr>';
	while($row = $db->fetch_row($r)){

      $entryid = $row['entryid'];
      $title = $row['title'];
      $body = $row['body'];
      $author = $row['author'];
      $entrydate = $row['entrydate'];
      $visible = $row['visible'];
      $category = $row['category'];
	echo '
<tr><td class=\'content\'>
Entry ID: '
.$entryid.' <a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=editentry&entryid='.$entryid.'\' >Edit</a><br>
Title: '.$title.' <br>

Author: '
.$author.'<br>
Posted Dated: '
.$entrydate.'<br>
Visible?: '
.$visible.'<br>
Category: '
.$category.'<br>
<a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=deleteentry&entryid='.$entryid.'\' >Delete It</a>

</td></tr>'; }
echo '</table>';




echo '
<div align="center">Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urlmp = ''.$domain.'/index.php?action=admin&case=pageentries&page='.$i ;
}else{
	$urlmp = ''.$domain.'/index.php?action=admin&case=pageentries&page='.$i ;
}


echo '<a href="'.$urlmp.'" class="pagenat">'.$i.'</a>&nbsp;';

}
echo '</div><p>';
$pgname = 'Page entry list';



}




function editentry(){
global $domain, $db;
$entryid = abs((int) $_GET['entryid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM pageentries WHERE entryid=\'%u\'', $entryid))); 
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header\'> Edit Page Entry</td>
			
		</tr>';
	


      $title = $row2['title'];
      $body = $row2['body'];
      $author = $row2['author'];
      $entrydate = $row2['entrydate'];
      $visible = $row2['visible'];
      $category = $row2['category'];
      $tags = $row2['tags'];
      $metadescription = $row2['metadescription'];

if  ($visible == 0) { $vsel='selected'; } else { $vsel=''; };


echo '

<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=saveedits\' method=\'POST\' >

Entry ID: '.$entryid.' 
<input name=\'entryid\' type=\'hidden\' value=\''.$entryid.'\'><br>
Post Date: '.$entrydate.' <br>
Entry Author: '.$author.'<p>
Entry Title: <input type=\'text\' name=\'title\' size=\'50\' value=\''.$title.'\'><p>

Entry Body:<br>
<textarea name=\'body\' rows=\'30\' cols=\'50\' >'.$body.'</textarea><p>

Visible?: <select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$vsel.'>No</option>
						</select>

<br>
Category: <input type=\'text\' name=\'category\' size=\'50\' value=\''.$category.'\'><br>
Meta Keywords: <input type=\'text\' name=\'tags\' size=\'50\' value=\''.$tags.'\'><br>
Meta Description: <input type=\'text\' name=\'metadescription\' size=\'50\' value=\''.$metadescription.'\'><br>


<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>' ;

}







function saveedits(){
	global $domain, $db;
$entryid = abs((int) $_POST['entryid']);
$title = $_POST['title'];
$body = $_POST['body'];
$visible = clean($_POST['visible']);
$category = clean($_POST['category']);
$tags = clean($_POST['tags']);
$metadescription = clean($_POST['metadescription']);
mysql_query("UPDATE pageentries SET title='$title', body='$body', visible='$visible', category='$category', tags='$tags', metadescription='$metadescription'  WHERE entryid='$entryid'" ) ;
echo '<div class=\'msg\'>Page Entry '.$entryid.' updated</div><p>';

	
}





function newentry(){
	global $domain, $db;
	

echo '
<table >
<tr><td class=\'header\'>New Page Entry</td></tr>
<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=savenew\' method=\'POST\' >


Entry Title: <input type=\'text\' name=\'title\' size=\'50\' ><p>

Entry Body:</small><br>
<textarea name=\'body\' rows=\'30\' cols=\'65\' ></textarea><p>
Visible?: <select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select>


<p>
Category: 

<select type=\'dropdown\' name=\'category\' ><p>
';

	$cl = $db->query(sprintf('SELECT * FROM pagecategories'));
	while($cl2 = $db->fetch_row($cl)){
echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>
'; };


echo '</select>
<p>
Meta Keywords: <input type=\'text\' name=\'tags\' size=\'50\' ><p>
Meta Description: <input type=\'text\' name=\'metadescription\' size=\'50\' ><p>
<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>'; 




}



function savenew(){
	global $domain, $db, $susername, $usrdata;
	
      $title = $_POST['title'];
      $body = $_POST['body'];
      $author = $usrdata['userid'];
      $entrydate = date("Y-m-d");
      $visible = clean($_POST['visible']);
      $category = clean($_POST['category']);
      $tags = clean($_POST['tags']);
      $metadescription = clean($_POST['metadescription']);

	$r = $db->query("INSERT INTO pageentries SET 
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
if(!$entryid){echo 'Invalid entry.'; exit;}
$db->query(sprintf('DELETE FROM pageentries WHERE entryid=\'%u\'', $entryid));
echo ' Page Entry deleted.';

}






?>