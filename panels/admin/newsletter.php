<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

switch($_GET['cmd']){
	default:
	listnewsletters();
	break;

	case 'editnewsletter':
	editnewsletter();
	break;

	case 'newnewsletter':
	newnewsletter();
	break;

	case 'savenew':
	savenew();
	break;

	case 'deletenewsletter':
	deletenewsletter();
	break;

	case 'saveedits':
	saveedits();
	break;

	case 'sendnewsletter':
	sendnewsletter();
	break;

}
function listnewsletters(){
global $domain, $db;

	$r = $db->query('SELECT * FROM fas_newsletter ORDER BY pageid DESC limit 5 ');
	echo '<div class="heading">
	<h2>Manage News letters</h2>
	</div>
        <br clear="all">
	<a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=newnewsletter\' class="button">Create Letter</a>
	<table id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th colspan="2">Title</th>
			</tr>
		</thead>';
	while($row = $db->fetch_row($r)){

      $pageid = $row['pageid'];
      $sent = $row['sent'];
      $showpage = $row['showpage'];
      $pagetitle = $row['pagetitle'];
      $pagebody = $row['pagebody'];
      $pageauthor = $row['pageauthor'];
      $datesent = $row['datesent'];
	echo'<tbody>
			<tr>
				<td width="50px">'.$pageid.'</td>
				<td width="790px">'.$pagetitle.'</td>
				<td><a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=editnewsletter&pageid='.$pageid.'\' ><img src="panels/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
					<a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=deletenewsletter&pageid='.$pageid.'\' ><img src="panels/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a></td>
			</tr>
		</tbody>'; }
echo '</table>';


}




function editnewsletter(){
global $domain, $db;
$pageid = clean($_GET['pageid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_newsletter WHERE pageid=\'%u\'', $pageid)));
	echo'<div class="heading">
		<h2>Edit Newsletter</h2>
	</div>
        <br clear="all">
	<form action=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=saveedits\' method=\'post\' >
		<table id="table">
			<thead>
				<tr>
					<th colspan="2">Details</th>
				</tr>
			</thead>';

      $sent = $row2['sent'];
      $showpage = $row2['showpage'];
      $pagetitle = $row2['pagetitle'];
      $pagebody = $row2['pagebody'];
      $pageauthor = $row2['pageauthor'];
      $datesent = $row2['datesent'];

		echo'<tbody>
				<tr>
					<td>Page ID: </td>
					<td><select type=\'dropdown\' name=\'pageid\'><option value=\''.$pageid.'\'>'.$pageid.'</option></select></td>
				</tr>
				<tr>
					<td>Sent?: </td>
					<td>'.$sent.'</td>
				</tr>
				<tr>
					<td>Page Title: </td>
					<td><input type=\'text\' size=\'50\' name=\'pagetitle\' value=\''.$pagetitle.'\'></td>
				</tr>
				<tr>
					<td colspan="2">Page Body:</td>
				</tr>
				<tr>
					<td colspan="2"><textarea name=\'pagebody\' rows=\'30\' cols=\'110\' >'.$pagebody.'</textarea></td>
				</tr>
				<tr>
					<td>Author: </td>
					<td><input type=\'text\' name=\'pageauthor\' size=\'50\' value=\''.$pageauthor.'\'></td>
				</tr>
				<tr>
					<td>Date Sent: </td>
					<td>'.$datesent.'</td>
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
$pageid = abs((int) $_POST['pageid']);
$pagetitle = clean($_POST['pagetitle']);
$pagebody = clean($_POST['pagebody']);
$pageauthor = clean($_POST['pageauthor']);

mysql_query("UPDATE fas_newsletter SET pagetitle='$pagetitle', pagebody='$pagebody', pageauthor='$pageauthor'  WHERE pageid='$pageid'" ) ;
echo '<div class=\'msg\'>Newsletter updated</div><p>';


}





function newnewsletter(){
	global $domain, $db;


echo'<div class="heading">
	<h2>New Newsletter</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=savenew\' method=\'post\' >
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Page Title: </td>
				<td><input type=\'text\' name=\'pagetitle\' size=\'50\' ></td>
			</tr>
			<tr>
				<td colspan="2">Page Body:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name=\'pagebody\' rows=\'30\' cols=\'110\' ></textarea></td>
			</tr>
			<tr>
				<td>Author: </td>
				<td><input type=\'text\' name=\'pageauthor\' size=\'50\' ></td>
			</tr>
			<tr>
				<td colspan="2"><input type=\'submit\' value=\'save\'></td>
			</tr>
		</tbody>
	</table>
</form>';




}



function savenew(){
	global $domain, $db;

      $pagetitle = clean($_POST['pagetitle']);
      $pagebody = clean($_POST['pagebody']);
      $pageauthor = clean($_POST['pageauthor']);
      $datesent = '0000-00-00';


	$r = $db->query("INSERT INTO fas_newsletter SET
					pagetitle='$pagetitle',
					pagebody='$pagebody',
					pageauthor='$pageauthor',
					datesent='$datesent'
					" );
	echo 'Saved, but not sent. Please view it and then send it.';


}



function deletenewsletter(){
	global $domain, $db;
	$pageid = abs((int) $_GET['pageid']);
if(!$pageid){return;}
$db->query(sprintf('DELETE FROM fas_newsletter WHERE pageid=\'%u\'', $pageid));
echo ' Newsletter deleted.';

}




function sendnewsletter(){
global $domain, $db, $supportemail;

	$pageid = abs((int) $_GET['pageid']);
if(!$pageid){return;}
$row4 = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_newsletter WHERE pageid=\'%u\'', $pageid)));



      $pagetitle = $row4['pagetitle'];
      $pagebody = $row4['pagebody'];
      $pageauthor = $row4['pageauthor'];



$headers = 'From: Admin <'.$supportemail.'>' ;

$subject = $pagetitle ;
$message = $pagebody ;

	$rlist = mysql_query("SELECT * FROM fas_users WHERE newsletter='yes' ");
	echo '
<table width=\'85%\'>
<tr><td>Sending Newsletter</td></tr>
<tr><td>';

	while($mlist = $db->fetch_row($rlist)){
$recipient = $mlist['email'];
mail($recipient, stripslashes($subject), stripslashes($message), $headers);
echo 'sending newsletter to '.$recipient.'<br>';
};
$datesent = date("Y-m-d");
mysql_query("UPDATE fas_newsletter SET sent='1', datesent='$datesent' WHERE pageid='$pageid'" ) ;

echo 'Newsletter sent</td></tr></table>';


}





function domailsend($rec, $sub, $mess, $head ){

mail($rec, $subject, $mes, $head); }
?>