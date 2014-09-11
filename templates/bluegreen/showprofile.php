<?php


function writebody() {
global $db, $cachelife, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username;




$max = '70';
$userids = clean($_GET['profile']);

if(!isset($suserid)){
$smessage='Please login to send a message.'; }
else 
{ $smessage='
<form action="'.$domain.'/index.php?action=messages&case=compose" method="post">
<input size="40" name="subject" value="[No Subject]" >
<textarea cols="50" rows="5" name="message" ></textarea><br>
<input name="to" value="'.$userids.'" type="hidden">


<input name="submit" value="Send" type="submit"> 
</form> ';};



if(empty($userids)){
echo 'No profile selected';


}
 else {
$r = "SELECT * FROM dd_users WHERE userid='$userids' " ;
$sqltitle = "userprofile-".$userids ;
$r1 = sqlcache($sqltitle, $cachelife, $r);
foreach ($r1 as $r2 ) {
$username = $r2['username'];
$plays = $r2['plays'];
$aim = $r2['aim'];
$icq = $r2['icq'];
$msn = $r2['msn'];
$yim = $r2['yim'];
$location = $r2['location'];
$job = $r2['job'];
$website = $r2['website'];
$link1 = $r2['link1'];
$link2 = $r2['link2'];
$link3 = $r2['link3'];
$link4 = $r2['link4'];
$link5 = $r2['link5'];
$link6 = $r2['link6'];
$link7 = $r2['link7'];
$link8 = $r2['link8'];
$sex = $r2['sex'];
$interests = $r2['interests'];
$bio = $r2['bio'];
$avatar = $r2['avatar'];
$avatarfile = $r2['avatarfile'];
};


if ($link1 != '') {$mylinks .= '<a href=\'http://'.$link1.'\' target=\'_blank\'>'.$link1.'</a><br>';};
if ($link2 != '') {$mylinks .= '<a href=\'http://'.$link2.'\' target=\'_blank\'>'.$link2.'</a><br>';};
if ($link3 != '') {$mylinks .= '<a href=\'http://'.$link3.'\' target=\'_blank\'>'.$link3.'</a><br>';};
if ($link4 != '') {$mylinks .= '<a href=\'http://'.$link4.'\' target=\'_blank\'>'.$link4.'</a><br>';};
if ($link5 != '') {$mylinks .= '<a href=\'http://'.$link5.'\' target=\'_blank\'>'.$link5.'</a><br>';};
if ($link6 != '') {$mylinks .= '<a href=\'http://'.$link6.'\' target=\'_blank\'>'.$link6.'</a><br>';};
if ($link7 != '') {$mylinks .= '<a href=\'http://'.$link7.'\' target=\'_blank\'>'.$link7.'</a><br>';};
if ($link8 != '') {$mylinks .= '<a href=\'http://'.$link8.'\' target=\'_blank\'>'.$link8.'</a>';};

if ($avatar == "1" ) { $avatarfileurl = '<img src=\''.$domain.'/avatars/'.$avatarfile.'\' height=\'100\' width=\'100\'>'; } else { $avatarfileurl = ''; };



if ( $plays >= $showwebsitelimit ) {$webvar = '
 <tr>
<td class="content">Website:</th>
<th class="content"><a href="http://'.$website.'" target="_blank" class="playlink">'.$website.'</a></th>
</tr>
';} else $webvar=' ';

echo '

<table width="89%" align="center">
	<tr>
		<td colspan=\'2\' class=\'header\'>User Profile: '.$username.'</td>
	</tr>
<tr>
<td class="content">About Me:<br>'.$avatarfileurl.'<br>
<a href="'.$domain.'/index.php?action=messages&case=compose&userid='.$userids.'">PM</a></th>
<th class="content">'.$bio.'</th>
</tr>
<tr>
<td class="content">Interests:</th>
<th class="content">'.$interests.'</th>
</tr>
<tr>
<td class="content" >Games Played:</th>
<th class="content">'.$plays.'</th>
</tr>
<tr>
<td class="content">Location:</th>
<th class="content">'.$location.'</th>
</tr>
'.$webvar.'

<tr>
<td class="content">Occupation:<br></td>
<td class="content">'.$job.'</td>
</tr>
<tr>
<td class="content">Sex:</th>
<th class="content">'.$sex.'</th>
</tr>


	<tr>
		<td colspan=\'2\' class=\'header\'>Contact Info</td>
	</tr>

<tr>
<td class="content">AIM:</th>
<th class="content">'.$aim.'</th>
</tr>
<tr>
<td class="content">ICQ:</th>
<th class="content">'.$icq.'</th>
</tr>
<tr>
<td class="content">MSN:</th>
<th class="content">'.$msn.'</th>
</tr>
<tr>
<td class="content">Yahoo:</th>
<th class="content">'.$yim.'</th>
</tr>




	<tr>
		<td colspan=\'2\' class=\'header\'>Misc</td>
	</tr>

<tr>
<td class="content">My Links:<br><small>For such things as Myspace profile, FaceBook, Twitter,etc.</small></th>
<th class="content">
'.$mylinks.'

</th>
</tr>



</table>









'; };



};

$pagetitle = $sitename.' - Member profile page ';
$metatags = 'profile page, member page';
$metadescription = $sitename.' - Member profile page ';


?>