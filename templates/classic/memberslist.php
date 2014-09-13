<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;



$orderby=clean($_GET['orderby']);
$max = '70';
$show = clean($_GET['page']);
if(empty($show)){
$show = 1;
}
$limits = ($show - 1) * $max;

if($orderby){
if($orderby == "playshl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY plays DESC LIMIT $limits,$max"));
}
if($orderby == "usernamehl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY username DESC LIMIT $limits,$max"));
}
if($orderby == "ranklh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY user_level ASC LIMIT $limits,$max"));
}

if($orderby == "playslh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY plays ASC LIMIT $limits,$max"));
}
if($orderby == "usernamelh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY username ASC LIMIT $limits,$max"));
}
if($orderby == "rankhl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY user_level DESC LIMIT $limits,$max"));
}
}else{
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' ORDER BY username ASC LIMIT $limits,$max"));
}

$totalres = mysql_result($db->query('SELECT COUNT(userid) AS total FROM fas_users'),0);
$totalpages = ceil($totalres / $max);
echo '

<table width="100%" align="center">
	<tr>
		<td colspan=\'5\' class=\'header\'>Members List</td>
	</tr>
<tr>
<th class="header">#</th>
<th class="header">Name <a href=\''.$domain.'/index.php?action=memberslist&orderby=usernamelh\'><img src=\''.$domain.'/images/minus.png\' border=\'0\'></a>  <a href=\''.$domain.'/index.php?action=memberslist&orderby=usernamehl\'><img src=\''.$domain.'/images/plus.png\' border=\'0\'></a></th>
<th class="header">Plays <a href=\''.$domain.'/index.php?action=memberslist&orderby=playslh\'><img src=\''.$domain.'/images/minus.png\' border=\'0\'></a>  <a href=\''.$domain.'/index.php?action=memberslist&orderby=playshl\'><img src=\''.$domain.'/images/plus.png\' border=\'0\'></a></th>
<th class="header">Status <a href=\''.$domain.'/index.php?action=memberslist&orderby=playslh\'><img src=\''.$domain.'/images/minus.png\' border=\'0\'></a>  <a href=\''.$domain.'/index.php?action=memberslist&orderby=playshl\'><img src=\''.$domain.'/images/plus.png\' border=\'0\'></a></th>
<th class="header">Rank <a href=\''.$domain.'/index.php?action=memberslist&orderby=rankhl\'><img src=\''.$domain.'/images/minus.png\' border=\'0\'></a>  <a href=\''.$domain.'/index.php?action=memberslist&orderby=ranklh\'><img src=\''.$domain.'/images/plus.png\' border=\'0\'></a></th>
</tr>';
while($ir = $db->fetch_row($r)){
$useridl=$ir['userid'];
if($seo_on == 1){
	$urlp = ''.$domain.'/showprofile/'.$useridl.'.html';
}else{
	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$useridl ;
}


if ($ir['user_level'] == '1') { // PHP If Statement
  $rank='Member';
} elseif ($ir['user_level'] == '2') { // PHP Elseif Statement
  $rank='<font color=red>Admin</font>';
} else {
  $rank='Guest'; // PHP Else
}

if($ir['status'] >= time()-15*60){
$status='<font color=green>Online!</font>';
}else{
$status='<font color=red>Offline!</font>';
}

echo ' <tr>
<td class="content">'.$ir['userid'].'</td>
<td class="content"><a href="'.$urlp.'">'.$ir['username'].'</a></td>
<td class="content">'.$ir['plays'].'</td>
<td class="content">'.$status.'</td>
<td class="content">'.$rank.'</td>
</tr>';
}

echo '</table>
<div align="center">Pages: ';
for($i = 1; $i <= $totalpages; $i++){
if($seo_on == 1){
	$urlmp = ''.$domain.'/memberslist/'.$i.'.html';
}else{
	$urlmp = ''.$domain.'/index.php?action=memberslist&page='.$i ;
}


echo '<a href="'.$urlmp.'" class="pagenat">'.$i.'</a>&nbsp;';

}
echo '<p></div>';

};


$pagetitle = $sitename.' member list';
$metatags = 'members, member list';
$metadescription = $sitename.' member list';
?>