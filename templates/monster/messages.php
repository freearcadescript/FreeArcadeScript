<?php

$pagetitle = 'Messages - '.$sitename;

function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




if(!isset($suserid)){
echo '<div class="error">Please login.</div>';
return;
}



function inbox(){
global $db, $domain, $userid, $template;

$w = $db->query("SELECT * FROM fas_messages WHERE to_userid='{$userid}' ORDER BY datesent DESC");
echo '<h2>Messages</h2>
<table width="100%" border="0" align="center">
<tr>
<th class="header">#</th>
<th class="header">Details</th>
<th class="header">Status</th>
<th class="header">Options</th>
</tr>
';
while($iw = $db->fetch_row($w)){
if($iw['status'] == 0){
$status = '<font color="green">Unread</font>';
}else{
$status = '<font color="red">Read</font>';
}
$gr = $db->fetch_row($db->query("SELECT userid, username FROM fas_users WHERE userid='{$iw['from_userid']}'"));
echo ' <tr>
<td class="content"><div align="center">'.$iw['ID'].'</div></td>
<td class="content"><small>
Subject: '.$iw['subject'].'<br />
Date: '.date('d/m/Y', $iw['datesent']).'<br />
From: '.$gr['username'].'<br />
</small></td>
<td class="content"><div align="center">'.$status.'</div></td>
<td class="content" align="center">
<div align="center">
[<a href="'.$domain.'/index.php?action=messages&case=delete&ID='.$iw['ID'].'">Delete</a> -
<a href="'.$domain.'/index.php?action=messages&case=read&ID='.$iw['ID'].'">Read</a>]</div></td>
</tr>';
}
echo '</table>

<br />
<div align="center">
<a href="'.$domain.'/index.php?action=messages&case=deleteall">Delete All</a>
</div>';

}
function read(){
global $db, $domain, $template, $userid, $template;

$ID = abs((int) $_GET['ID']);
$ir = $db->query("SELECT * FROM fas_messages WHERE to_userid='{$userid}' AND ID='{$ID}'");

$or = $db->fetch_row($ir);
if(!$db->num_rows($ir)){
echo 'Either you do not own that message or it does not exist.';
return;
}
$db->query("UPDATE fas_messages SET status='1' WHERE ID='$ID'");
$ud = $db->fetch_row($db->query("SELECT username, userid FROM fas_users WHERE userid='{$or['from_userid']}'"));
$message = str_replace('\n', '<br />', $or['content']);
$replysubject = 'Re: '.$or['subject'];
echo '
<table width="100%" border="0" align="center">
<tr>
<td class="content" width="30%">Message From:</td>
<td class="content">'.$ud['username'].'</td>
</tr>
<tr>
<td class="content">Subject Details</td>
<td class="content">'.$or['subject'].'<small>'.date('d/m/Y', $or['datesent']).'</small></td>
</tr>
<tr>
<td class="header" colspan="2"><div align="center">Message</div></td>
</tr>
<tr>
<td class="content" colspan="2" valign="top">'.$message.'</td>
</tr>
</table>
</td>
<td class=\'middleright\'></td>
</tr>
<tr>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/bl.png" alt="" height="18" width="18" /></td>
<td class=\'bottommiddle\'></td>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/br.png" alt="" height="18" width="18" /></td>

</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>

<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/tl.png" alt="" height="18" width="18" /></td>
<td class=\'topmiddle\'></td>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/tr.png" alt="" height="18" width="18" /></td>
</tr>
<tr>
<td class=\'middleleft\'></td>
<td>
<table width="100%" border="0" align="center">
<tr>
<td class="header"  colspan="2">Quick Reply</td></tr>
<tr>
<td class="content" colspan="2">


<form action="'.$domain.'/index.php?action=messages&case=reply&;ID='.$or['from_userid'].'" method="post">
<textarea cols="50" rows="6" name="message"></textarea><br>
<input name="to" value="'.$or['from_userid'].'" type="hidden">

<input size="37" name="subject" value="'.$replysubject.'" type="hidden">
<input name="submit" value="Send" type="submit">
</form>
</td>
</tr>
</table>
</td>
<td class=\'middleright\'></td>
</tr>
<tr>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/bl.png" alt="" height="18" width="18" /></td>
<td class=\'bottommiddle\'></td>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/br.png" alt="" height="18" width="18" /></td>

</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>

<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/tl.png" alt="" height="18" width="18" /></td>
<td class=\'topmiddle\'></td>
<td height="18" width="18"><img src="'.$domain.'/templates/'.$template.'/images/tr.png" alt="" height="18" width="18" /></td>
</tr>
<tr>
<td class=\'middleleft\'></td>
<td>
<table width="100%" border="0" align="center">
<tr>
<td class="header" colspan="2">Your Conversation with '.$ud['username'].'.</td>
</tr>
<tr>
<th class="header">From/Date</th>
<th class="header">Message</th>
</tr>';
$senderid=$or['from_userid'];
$tt = $db->query("SELECT * FROM fas_messages WHERE to_userid='{$userid}' AND from_userid='$senderid' ORDER BY datesent DESC") or die(mysql_error());

while($row = mysql_fetch_array($tt)){
$op = $db->fetch_row($db->query("select username from fas_users where userid='{$row['from_userid']}'"));
echo ' <tr align="center">

<td class="content">'.$op['username'].'
<br /><small>On: '.date('d/m/Y', $row['datesent']).'</small></td>
<td class="content">'.$row['content'].'</td>
</tr>';

}
echo'</table>';
}
function reply(){
global $userid, $domain, $db, $template;
$to = abs((int) $_POST['to']);
$message = clean($_POST['message']);
$subject = clean($_POST['subject']);
if(empty($to) || empty($message) || empty($subject)){ echo "All fields must be filled in!";
 return; };
$date = time();
$db->query("INSERT INTO fas_messages SET
from_userid='{$userid}',
to_userid='{$to}',
subject='{$subject}',
content = '$message',
status = '0',
datesent='$date'");
echo '<div class="msg">Message sent.</div>';
}
function compose(){
global $userid, $domain, $db, $template;
if(isset($_POST['submit'])){
$to = abs((int) $_POST['to']);
$message = clean($_POST['message']);
$subject = clean($_POST['subject']);
if(empty($to) || empty($message) || empty($subject)){ echo "All fields must be filled in!";
return; }
$date = time();
$db->query("INSERT INTO fas_messages SET
from_userid='{$userid}',
to_userid='{$to}',
subject='{$subject}',
content = '$message',
status = '0',
datesent='{$date}'");

echo '<div class="msg">Message sent.</div>';
return;
}
if(empty($to)){
$to = '';
}else{
$to = $ID;
}


echo '
<form action="'.$domain.'/index.php?action=messages&case=compose" method="post">
<table width="100%" border="0" align="center">
<tr>
<td class="header" colspan="2">Compose</td>
</tr>
<tr>
<td class="content" width="30%">To (Userid#):</td>
<td class="content" width="30%"><input type="text" name="to" value="'.$to.'" size="35"></td>
</tr>
<tr>
<td class="content" width="30%">Subject:</td>
<td class="content" width="30%"><input type="text" name="subject" value="[No Subject]" size="35"></td>
</tr>
<tr>
<td colspan="2" class="content" align="center">Body</td>
</tr>
<tr>
<td colspan="2" class="content">
<textarea cols="65" rows="6" name="message"></textarea>
</td>

</tr>
<tr>
<td colspan="2" align="center" class="content"><input type="submit" name="submit" value="Send"></td>
</tr>

</table>
</form> ';
}
function delete(){
$ID = abs((int) $_GET['ID']);
global $db, $userid, $template;

$db->query("DELETE FROM fas_messages WHERE ID='$ID' AND to_userid='$userid'");
echo 'Deleted.';

}
function deleteall(){
global $db, $userid, $template;
$db->query("DELETE FROM fas_messages WHERE to_userid='$userid'");
}



$userid=$suserid;
echo '

<table align="center">
<tr>
<td class="content"><a href="'.$domain.'/index.php?action=messages&case=compose">Compose</a></td>
<td class="content"><a href="'.$domain.'/index.php?action=messages&case=deleteall">Delete All</a></td>
<td class="content"><a href="'.$domain.'/index.php?action=messages">Messages Home</a></td>
</tr>
</table>';
if(!isset($_GET['case'])){
	$_GET['case'] = NULL;
}
switch($_GET['case']){
default:
inbox();
break;

case 'compose':
compose();
break;


case 'reply':
reply();
break;

case 'read':
read();
break;


case 'delete':
delete();
break;

case 'deleteall':
deleteall();
break;
}
};
?>

