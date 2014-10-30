<?php


function writebody() {
global $db, $cachelife, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $username, $avatar_on, $gender_on, $aimg, $fimg, $mimg;




$max = '70';
$userids = clean($_GET['profile']);

if(!isset($suserid)){
$smessage='Please login to send a message.'; }
else
{ $smessage='
<form action="'.$domain.'/index.php?action=messages&case=compose" method="post">
<div align="center"><input size="50" name="subject" value="[No Subject]" ><br />
<textarea cols="50" rows="5" name="message" ></textarea><br />
<input name="to" value="'.$userids.'" type="hidden">
<input name="submit" value="Send" type="submit">
</div>
</form> ';};

if(empty($userids)){
echo '<div class="error">No profile selected</div>';
} else {
$r = "SELECT * FROM fas_users WHERE userid='$userids' " ;
$sqltitle = "userprofile-".$userids ;
$r1 = sqlcache($sqltitle, $cachelife, $r);
foreach ($r1 as $r2 ) {
$username = $r2['username'];
$joindate = date('M-d-Y', $r2['joindate']);
$played = $r2['plays'];
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

if ($link1 != '') {$mylinks .= '<a href=\'http://'.$link1.'\' target=\'_blank\'>'.$link1.'</a><br>';}else{$mylinks = '';};
if ($link2 != '') {$mylinks .= '<a href=\'http://'.$link2.'\' target=\'_blank\'>'.$link2.'</a><br>';}else{$mylinks = '';};
if ($link3 != '') {$mylinks .= '<a href=\'http://'.$link3.'\' target=\'_blank\'>'.$link3.'</a><br>';}else{$mylinks = '';};
if ($link4 != '') {$mylinks .= '<a href=\'http://'.$link4.'\' target=\'_blank\'>'.$link4.'</a><br>';}else{$mylinks = '';};
if ($link5 != '') {$mylinks .= '<a href=\'http://'.$link5.'\' target=\'_blank\'>'.$link5.'</a><br>';}else{$mylinks = '';};
if ($link6 != '') {$mylinks .= '<a href=\'http://'.$link6.'\' target=\'_blank\'>'.$link6.'</a><br>';}else{$mylinks = '';};
if ($link7 != '') {$mylinks .= '<a href=\'http://'.$link7.'\' target=\'_blank\'>'.$link7.'</a><br>';}else{$mylinks = '';};
if ($link8 != '') {$mylinks .= '<a href=\'http://'.$link8.'\' target=\'_blank\'>'.$link8.'</a>';};
$avatarfileurl = get_avatar($userids);

if(!isset($suserid)){
echo '<div class="msg">Please login to View profile.</div>'; }
else {

if ( $played >= $showwebsitelimit ) {$webvar = '
 <tr>
<td class="content">Website:</td>
<td class="content"><a href="http://'.$website.'" target="_blank">'.$website.'</a></td>
</tr>
';} else $webvar=' ';

echo '<table width="100%" align="center">
	<tr>
		<td colspan=\'2\' class=\'header\'>User Profile: '.$username.'</td>
	</tr>
	<tr>
		<td class="content" width="100">About Me:<br><img src=\''.$domain.'/avatars/'.$avatarfileurl.'\' height=\'100\' width=\'100\' /></td>
		<td class="content" width="450">'.$bio.'</td>
	</tr>
	<tr>
		<td class="content">Joined:</td>
		<td class="content">'.$joindate.'</td>
	</tr>
	<tr>
		<td class="content">Interests:</td>
		<td class="content">'.$interests.'</td>
	</tr>
	<tr>
		<td class="content" >Games Played:</td>
		<td class="content">'.$played.'</td>
	</tr>
	<tr>
		<td class="content">Location:</td>
		<td class="content">'.$location.'</td>
	</tr>
'.$webvar.'
	<tr>
		<td class="content">Occupation:<br></td>
		<td class="content">'.$job.'</td>
	</tr>
	<tr>
		<td class="content">Sex:</td>
		<td class="content">'.$sex.'</td>
	</tr>
	<tr>
		<td colspan=\'2\' class=\'header\'>Contact Info</td>
	</tr>
	<tr>
		<td class="content">AIM:</td>
		<td class="content">'.$aim.'</td>
	</tr>
	<tr>
		<td class="content">ICQ:</td>
		<td class="content">'.$icq.'</td>
	</tr>
	<tr>
		<td class="content">MSN:</td>
		<td class="content">'.$msn.'</td>
	</tr>
	<tr>
		<td class="content">Yahoo:</td>
		<td class="content">'.$yim.'</td>
	</tr>
	<tr>
		<td colspan=\'2\' class=\'header\'>Misc</td>
	</tr>
	<tr>
		<td class="content">My Links:<br><small>For such things as Myspace profile, FaceBook, Twitter,etc.</small></td>
		<td class="content">'.$mylinks.'</td>
	</tr>
	<tr>
		<td class="header" colspan="2">Send '.$username.' a Message</td>
	</tr>
	<tr>
		<td class="content" colspan="2">'.$smessage.'</td>
	</tr>
';

$gua2 = "SELECT * FROM fas_games WHERE gameadder='$userids' AND active='1' ORDER BY dateadded DESC ";
$sqltitle = "gameuseradded-".$userids ;

            if ($gua1 = sqlcache($sqltitle, $cachelife, $gua2)) {
            echo '<tr><td class="header" colspan="2">Games Added By '.$username.'</td></tr>
            <tr><td class="content" colspan="2">';
		foreach ($gua1 as $row ){
              $gamename = preg_replace('#\W#', '', $row['name']);
		$type = clean($row['type']);
		$thumburl = clean($row['thumburl']);
		if($type == 2){
			$image='<img src=\''.$thumburl.'\' width=\'55\' height=\'55\' alt=\''.$gamename.'\' />';
		}else{
			$image='<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' width=\'55\' height=\'55\' border=\'0\' alt=\''.$gamename.'\' />';
		}
	        if($seo_on == 1){
              $playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
              }else{
              $playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
              }

              echo ' <a href=\''.$playlink.'\'>'.$image.'</a> ';

                                    };
            echo '</td></tr>';
                                                                };



$ube2 = "SELECT * FROM fas_blogentries WHERE author='$username' AND visible='1' ORDER BY entrydate DESC LIMIT 5";
$sqltitle = "userblogentries-".$userids ;


            if ($ube1 = sqlcache($sqltitle, $cachelife, $ube2)) {
            echo '<tr><td class="header" colspan="2">Latest Blog Posts By '.$username.'</td></tr>
            <tr><td class="content" colspan="2">';
		foreach ($ube1 as $row ){

	        if($seo_on == 1){
              $rburl = ''.$domain.'/blogentry/entryid/'.$row['entryid'].'/1.html';
              } else {
              $rburl = ''.$domain.'/index.php?action=blogentry&entryid='.$row['entryid'] ; };



              echo '<a href=\''.$rburl.'\' >'.$row['title'].'</a> - '.$row['entrydate'].'<br>';


                                    };
            echo '</td></tr>';
                                                                };





echo '</table>';} };



};

$pagetitle = $sitename.' - Member profile page ';
$metatags = 'profile page, member page';
$metadescription = $sitename.' - Member profile page ';


?>