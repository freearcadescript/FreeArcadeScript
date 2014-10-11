<?php


function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages, $suserid;

$time = time()-15*60;

if(!isset($_GET['orderby'])){
	$orderby = NULL;
}else{
	$orderby = clean($_GET['orderby']);
}
$max = '70';
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;

if(!empty($orderby)){
if($orderby == "playshl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY plays DESC LIMIT $limits,$max"));
}
if($orderby == "usernamehl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY username DESC LIMIT $limits,$max"));
}
if($orderby == "ranklh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY user_level ASC LIMIT $limits,$max"));
}
if($orderby == "statuslh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY status ASC LIMIT $limits,$max"));
}
if($orderby == "playslh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY plays ASC LIMIT $limits,$max"));
}
if($orderby == "usernamelh"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY username ASC LIMIT $limits,$max"));
}
if($orderby == "rankhl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY user_level DESC LIMIT $limits,$max"));
}
if($orderby == "statushl"){
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY status DESC LIMIT $limits,$max"));
}
}else{
$r = $db->query(sprintf("SELECT * FROM fas_users WHERE activation_key='0' AND user_level!='0' ORDER BY username ASC LIMIT $limits,$max"));
}

$totalres = mysql_result($db->query('SELECT COUNT(userid) AS total FROM fas_users WHERE userid != "0" '),0);
$totalpages = ceil($totalres / $max);
$down = '<img src="'.$domain.'/templates/'.$template.'/images/down.png" width="12" height="12" alt="down" title="Down" />';
$up = '<img src="'.$domain.'/templates/'.$template.'/images/up.png" width="12" height="12" alt="up" title="Up" />';

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Members List</div>
<table width="100%" align="center">
<tr>
<th class="header2">Name <a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=usernamelh\'>'.$down.'</a><a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=usernamehl\'>'.$up.'</a></th>
<th class="header2">Plays <a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=playslh\'>'.$down.'</a><a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=playshl\'>'.$up.'</a></th>
<th class="header2">Status <a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=statushl\'>'.$down.'</a><a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=statuslh\'>'.$up.'</a></th>
<th class="header2">Rank <a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=rankhl\'>'.$down.'</a><a href=\''.$domain.'/index.php?action=memberslist&amp;orderby=ranklh\'>'.$up.'</a></th>
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
  $rank='<font color="#FF0000">Admin</font>';
} else {
  $rank='Guest'; // PHP Else
}

if($ir['status'] >= $time){
$status='<font color="#008000">Online!</font>';
}else{
$status='<font color="#FF0000">Offline!</font>';
}

echo ' <tr>
<td class="content"><a href="'.$urlp.'">'.$ir['username'].'</a></td>
<td class="content">'.$ir['plays'].'</td>
<td class="content">'.$status.'</td>
<td class="content">'.$rank.'</td>
</tr>';
}

echo '</table>
<div class="page-box">
'.$totalres.' user(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';
if($seo_on == 1){
	$previous = ''.$domain.'/memberslist/'.$pre.'.html';
	$next = ''.$domain.'/memberslist/'.$ne.'.html';
}else{
	$previous = $urk = ''.$domain.'/index.php?action=memberslist&page='.$pre;
	$next = $urk = ''.$domain.'/index.php?action=memberslist&page='.$ne;
	}
if ($totalpages != '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				if($seo_on == 1){
					$urk = ''.$domain.'/memberslist/'.$i.'.html';
				}else{
					$urk = ''.$domain.'/index.php?action=memberslist&page='.$i;
				}

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
echo'</div>
</div></div></div>';

};

$pagetitle = 'Members - '.$sitename;
$metatags = 'members, member list';
$metadescription = $sitename.' member list';
?>