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
global $domain, $db, $usrdata ;



$useridm = $usrdata['username'];
$max = '50';
$show = clean($_GET['page']);
if(empty($show)){
$show = 1;
}
$limits = ($show - 1) * $max; 
// $totalres = mysql_result($db->query('SELECT COUNT(entryid) AS total FROM blogentries where author=\'%u\' ', $useridm'),0); 
$totalres = mysql_query("SELECT COUNT(entryid) AS total FROM blogentries where author='$useridm' " ); 
$totalpages = ceil($totalres / $max);





	$r = mysql_query("SELECT * FROM blogentries where author='$useridm' ORDER BY entryid DESC limit $limits,$max");
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header\'>Blog Entries for '.$usrdata['username'].'</td>
			
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
.$entryid.' <a href=\''.$domain.'/index.php?action=blogadmin&case=blogentries&cmd=editentry&entryid='.$entryid.'\' >Edit</a><br>
Title: '.$title.' <br>

Author: '
.$author.'<br>
Posted Dated: '
.$entrydate.'<br>
Visible?: '
.$visible.'<br>
Category: '
.$category.'<br>
<a href=\''.$domain.'/index.php?action=blogadmin&case=blogentries&cmd=deleteentry&entryid='.$entryid.'\' >Delete It</a>

</td></tr>'; }
echo '</table>';




echo '
<div align="center">Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
if($seo_on == 1){
	$urlmp = ''.$domain.'/index.php?action=blogadmin&case=blogentries&page='.$i ;
}else{
	$urlmp = ''.$domain.'/index.php?action=blogadmin&case=blogentries&page='.$i ;
}


echo '<a href="'.$urlmp.'" class="pagenat">'.$i.'</a>&nbsp;';

}
echo '</div><p>';
$pgname = 'Blog entry list';



}




function editentry(){
global $domain, $db, $usrdata ;
$useridm = $usrdata['username'];
$entryid = abs((int) $_GET['entryid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM blogentries WHERE entryid=\'%u\' and author=\'%s\'', $entryid, $useridm))); 
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header\'> Edit Blog Entry</td>
			
		</tr>';
	


      $title = $row2['title'];
      $body = $row2['body'];
      $author = $row2['author'];
      $entrydate = $row2['entrydate'];
      $visible = $row2['visible'];
      $category = $row2['category'];
      $tags = $row2['tags'];
if  ($visible == 0) { $vsel='selected'; } else { $vsel=''; };


echo '

<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=blogadmin&case=blogentries&cmd=saveedits\' method=\'POST\' >

Entry ID: '.$entryid.' 
<input name=\'entryid\' type=\'hidden\' value=\''.$entryid.'\'><br>
Post Date: '.$entrydate.' <br>
Entry Author: '.$author.'<p>
Entry Title: <input type=\'text\' name=\'title\' size=\'50\' value=\''.$title.'\'><p>
No HTML is allowed. Please use the following code formats:<br>
Links: <b>[urlhead]</b>domain.com/path<b>[urlmid]</b>anchor<b>[urlend]</b><br>
Images: <b>[imghead]</b>domain.com/imgagepath/img.gif<b>[imgend]</b><br>
Bold: <b>[bhead]</b>text to make bold<b>[bend]</b><br>
New Line: <b>[br]</b><br>
New Paragraph: <b>[p]</b><br>

Entry Body:<br>
<textarea name=\'body\' rows=\'30\' cols=\'50\' >'.$body.'</textarea><p>

Visible?: <select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$vsel.'>No</option>
						</select>

<br>
Category: <input type=\'text\' name=\'category\' size=\'50\' value=\''.$category.'\'><br>
Tags: <input type=\'text\' name=\'tags\' size=\'50\' value=\''.$tags.'\'><br>


<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>' ;

}







function saveedits(){
	global $domain, $db, $usrdata ;
$useridm = $usrdata['username'];
$entryid = abs((int) $_POST['entryid']);
$title = clean($_POST['title']);
$body = clean($_POST['body']);
$visible = clean($_POST['visible']);
$category = clean($_POST['category']);
$tags = clean($_POST['tags']);

mysql_query("UPDATE blogentries SET title='$title', body='$body', visible='$visible', category='$category', tags='$tags'  WHERE entryid='$entryid' and author='$useridm' " ) ;
echo '<div class=\'msg\'>Blog Entry '.$entryid.' updated</div><p>';

	
}





function newentry(){
	global $domain, $db, $usrdata ;
$useridm = $usrdata['username'];
	

echo '
<table >
<tr><td class=\'header\'>New Blog Entry</td></tr>
<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=blogadmin&case=blogentries&cmd=savenew\' method=\'POST\' >


Entry Title: <input type=\'text\' name=\'title\' size=\'50\' ><p>
No HTML is allowed. Please use the following code formats:<br>
Links: <b>[urlhead]</b>domain.com/path<b>[urlmid]</b>anchor<b>[urlend]</b><br>
Please note that the http:// is not needed, and will cause the save to fail.<br>
Images: <b>[imghead]</b>domain.com/imgagepath/img.gif<b>[imgend]</b><br>
Bold: <b>[bhead]</b>text to make bold<b>[bend]</b><br>
New Line: <b>[br]</b><br>
New Paragraph: <b>[p]</b><br>
Entry Body:<small>(No HTML allowed.)</small><br>
<textarea name=\'body\' rows=\'30\' cols=\'65\' ></textarea><p>
Visible?: <select type=\'dropdown\' name=\'visible\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select>


<p>
Category: 

<select type=\'dropdown\' name=\'category\' ><p>
';

	$cl = $db->query(sprintf('SELECT * FROM blogcategories'));
	while($cl2 = $db->fetch_row($cl)){
echo '<option value=\''.$cl2['categoryid'].'\'>'.$cl2['categoryname'].'</option>
'; };


echo '</select>
<p>
Tags: <input type=\'text\' name=\'tags\' size=\'50\' ><p>
<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>'; 




}



function savenew(){
	global $domain, $db, $susername, $usrdata;
	
      $title = clean($_POST['title']);
      if ($usrdata['bloglevel'] == 3) { $body = $_POST['body']; } else { $body = clean($_POST['body']); };
      $author = $_SESSION['username'];
      $entrydate = date("Y-m-d");
      $visible = clean($_POST['visible']);
      $category = clean($_POST['category']);
      $tags = clean($_POST['tags']);

	$r = $db->query("INSERT INTO blogentries SET 
					title='$title',
					body='$body',
					author='$author',
					entrydate='$entrydate',
					visible='$visible',
					category='$category',
					tags='$tags'
					" );
	echo 'Entry Saved.';


}



function deleteentry(){
	global $domain, $db, $usrdata ;
$useridm = $usrdata['username'];
	$entryid = abs((int) $_GET['entryid']);
if(!$entryid){echo 'Invalid entry.'; exit;}
$db->query(sprintf('DELETE FROM blogentries WHERE entryid=\'%u\' and author=\'%s\'', $entryid, $useridm));
echo ' Blog Entry deleted.';

}






?>