<?php
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

	$r = $db->query('SELECT * FROM newsletter ORDER BY pageid DESC limit 5 ');
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header\'>Newsletters</td>
			
		</tr>';
	while($row = $db->fetch_row($r)){

      $pageid = $row['pageid'];
      $sent = $row['sent'];
      $showpage = $row['showpage'];
      $pagetitle = $row['pagetitle'];
      $pagebody = $row['pagebody'];
      $pageauthor = $row['pageauthor'];
      $datesent = $row['datesent'];
	echo '
<tr><td class=\'content\'>
Page ID: '
.$pageid.' <a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=editnewsletter&pageid='.$pageid.'\' >Edit</a><br>
Sent?: '.$sent.' <a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=sendnewsletter&pageid='.$pageid.'\' >Send It</a><br>

Page Title: '
.$pagetitle.'<p>
Page Body:<br>'
.$pagebody.'<p>
Author: '
.$pageauthor.'<p>
Date Sent: '
.$datesent.'<p>&nbsp;<p>
<a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=deletenewsletter&pageid='.$pageid.'\' >Delete It</a><p>&nbsp;<p>

</td></tr>'; }
echo '</table>';


}




function editnewsletter(){
global $domain, $db;
$pageid = clean($_GET['pageid']);
$row2 = $db->fetch_row($db->query(sprintf('SELECT * FROM newsletter WHERE pageid=\'%u\'', $pageid)));
	echo '<table width=\'85%\' border=\'0\' align=\'center\'>
		<tr>
			<td class=\'header5\'> Edit Newsletter</td>
			
		</tr>';
	


      $sent = $row2['sent'];
      $showpage = $row2['showpage'];
      $pagetitle = $row2['pagetitle'];
      $pagebody = $row2['pagebody'];
      $pageauthor = $row2['pageauthor'];
      $datesent = $row2['datesent'];



echo '

<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=saveedits\' method=\'POST\' >

Page ID: <select type=\'dropdown\' name=\'pageid\'><option value=\''.$pageid.'\'>'.$pageid.'</option></select><br>
Sent?: '.$sent.' <br>
Page Title: <input type=\'text\' size=\'50\' name=\'pagetitle\' value=\''.$pagetitle.'\'><p>
Page Body:<br>
<textarea name=\'pagebody\' rows=\'30\' cols=\'50\' >'.$pagebody.'</textarea><p>
Author: <input type=\'text\' name=\'pageauthor\' size=\'50\' value=\''.$pageauthor.'\'><p>
Date Sent: '.$datesent.'<p><p>
<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>' ;

}







function saveedits(){
	global $domain, $db;
$pageid = abs((int) $_POST['pageid']);
$pagetitle = clean($_POST['pagetitle']);
$pagebody = clean($_POST['pagebody']);
$pageauthor = clean($_POST['pageauthor']);

mysql_query("UPDATE newsletter SET pagetitle='$pagetitle', pagebody='$pagebody', pageauthor='$pageauthor'  WHERE pageid='$pageid'" ) ;
echo '<div class=\'msg\'>Newsletter updated</div><p>';

	
}





function newnewsletter(){
	global $domain, $db;
	

echo '
<table >
<tr><td class=\'header\'>New Newsletter</td></tr>
<tr><td class=\'content\'>
<form action=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=savenew\' method=\'POST\' >


Page Title: <input type=\'text\' name=\'pagetitle\' size=\'50\' ><p>
Page Body:<br>
<textarea name=\'pagebody\' rows=\'30\' cols=\'65\' ></textarea><p>
Author: <input type=\'text\' name=\'pageauthor\' size=\'50\' ><p>

<input type=\'submit\' value=\'save\'>
</form>
</td></tr></table>'; 




}



function savenew(){
	global $domain, $db;
	
      $pagetitle = $_POST['pagetitle'];
      $pagebody = $_POST['pagebody'];
      $pageauthor = $_POST['pageauthor'];
      $datesent = '0000-00-00';


	$r = $db->query("INSERT INTO newsletter SET 
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
if(!$pageid){exit;}
$db->query(sprintf('DELETE FROM newsletter WHERE pageid=\'%u\'', $pageid));
echo ' Newsletter deleted.';

}




function sendnewsletter(){
global $domain, $db, $supportemail;

	$pageid = abs((int) $_GET['pageid']);
if(!$pageid){exit;}
$row4 = $db->fetch_row($db->query(sprintf('SELECT * FROM newsletter WHERE pageid=\'%u\'', $pageid)));
	


      $pagetitle = $row4['pagetitle'];
      $pagebody = $row4['pagebody'];
      $pageauthor = $row4['pageauthor'];



$headers = 'From: Admin <'.$supportemail.'>' ;

$subject = $pagetitle ;
$message = $pagebody ;

	$rlist = mysql_query("SELECT * FROM dd_users WHERE newsletter='yes' ");
	echo '
<table width=\'100%\'>
<tr><td class=\'header\'>Sending Newsletter</td></tr>
<tr><td class=\'content\'>';

	while($mlist = $db->fetch_row($rlist)){
$recipient = $mlist['email'];
mail($recipient, stripslashes($subject), stripslashes($message), $headers);
echo 'sending newsletter to '.$recipient.'<br>';
};
$datesent = date("Y-m-d");
mysql_query("UPDATE newsletter SET sent='1', datesent='$datesent' WHERE pageid='$pageid'" ) ;

echo 'Newsletter sent</td></tr></table>';


}





function domailsend($rec, $sub, $mess, $head ){

mail($rec, $subject, $mes, $head); }



?>