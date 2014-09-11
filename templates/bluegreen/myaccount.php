<?php


function writebody() {
global $db, $domain, $suserid, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




if(!isset($suserid)){
echo '<div class=\'error\'>Please login first.</div>';

exit;
}; 





function changeavatar(){
	global $domain, $db, $usrdata, $seo_on;
	$userid = $usrdata['userid'];
	if(isset($_POST['avatar'])){ 

$avatar=clean($_POST['avatar']);

if ($avatar == 0) {

mysql_query("UPDATE dd_users SET avatar='$avatar', avatarfile=''  WHERE userid='$userid'" ) ;
echo 'Profile updated';


} else {
function findexts ($filename) 
{ 
$filename = strtolower($filename) ; 
$exts = split("[/\\.]", $filename) ; 
$n = count($exts)-1; 
$exts = $exts[$n]; 
return $exts; 
} 

if ( $_FILES['uploaded']['size'] > 40000 ) { echo 'Too big.'; exit; };
$ext = findexts ($_FILES['uploaded']['name']) ; 
$os = array("gif", "jpg", "jpeg", "png");
if (!in_array($ext, $os)) {
echo  "not allowed"; exit; 
} else { };

$ran = "avatar" ;
$ran3 = $usrdata['userid'];
$ran4 = $ran.$userid.'.';
$avatarfile = $ran4.$ext;
//This assigns the subdirectory you want to save into... make sure it exists!
$target = $directorypath."avatars/"; 
//This combines the directory, the userid, and the extension
$target = $target . $ran4.$ext; 
if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
{
echo "The file has been uploaded.";
mysql_query("UPDATE dd_users SET avatar='$avatar', avatarfile='$avatarfile'   WHERE userid='$userid'" ) ;

} 
else
{
echo "Sorry, there was a problem uploading your file.";
};
};






} else { 

if($seo_on == 1){
	$curl1 = ''.$domain.'/myaccount/changeavatar/';
}else{
	$curl1 = ''.$domain.'/index.php?action=myaccount&cmd=changeavatar';
}


echo '
<table width=\'100%\'>
<tr>
<td class=\'content\'>
<form enctype=\'multipart/form-data\' action=\''.$curl1.'\' method=\'POST\'>

Use Avatar?: 
 <select type=\'dropdown\' name=\'avatar\'>

<option value=\'0\'>No</option>
<option value=\'1\' >Yes</option>
</select>
<p>

Please choose a file: <input name=\'uploaded\' type=\'file\' /><br />
<input type=\'submit\' value=\'Upload\' />
</form>
</td>
</tr>
</table>
';

};
};










function account(){
global $domain, $db, $seo_on, $usrdata;
if($seo_on == 1){
	$url1 = ''.$domain.'/myaccount/favorites/';
	$url2 = ''.$domain.'/myaccount/changepassword/';
	$url3 = ''.$domain.'/myaccount/';
      $url4 = ''.$domain.'/messages/';
      $url5 = ''.$domain.'/myaccount/changeavatar/';
}else{
	$url1 = ''.$domain.'/index.php?action=myaccount&cmd=favorites';
	$url2 = ''.$domain.'/index.php?action=myaccount&cmd=changepassword';
	$url3 = ''.$domain.'/index.php?action=myaccount';
      $url4 = ''.$domain.'/index.php?action=messages';
      $url5 = ''.$domain.'/index.php?action=myaccount&cmd=changeavatar';
}

if(isset($_POST['newsletter'])){


$userid = $usrdata['userid'];
$newsletter = clean($_POST['newsletter']);
$email = clean($_POST['email']);
$aim = clean($_POST['aim']);
$icq = clean($_POST['icq']);
$msn = clean($_POST['msn']);
$yim = clean($_POST['yim']);
$location = clean($_POST['location']);
$job = clean($_POST['job']);
$website = clean($_POST['website']);
$link1 = clean($_POST['link1']);
$link2 = clean($_POST['link2']);
$link3 = clean($_POST['link3']);
$link4 = clean($_POST['link4']);
$link5 = clean($_POST['link5']);
$link6 = clean($_POST['link6']);
$link7 = clean($_POST['link7']);
$link8 = clean($_POST['link8']);
$sex = clean($_POST['sex']);
$interests = clean($_POST['interests']);
$bio = clean($_POST['bio']);
$ip = $_SERVER['REMOTE_ADDR'];


mysql_query("UPDATE dd_users SET email='$email', newsletter='$newsletter', aim='$aim', icq='$icq', msn='$msn', yim='$yim', location='$location', 
job='$job', website='$website', link1='$link1', link2='$link2', link3='$link3', link4='$link4', link5='$link5', link6='$link6', link7='$link7', link8='$link8', sex='$sex', interests='$interests', bio='$bio', ip='$ip' WHERE userid='$userid'" ) ;
echo '<div class=\'msg\'>Profile updated</div><p>';


};



$userid = $usrdata['userid'];
$ir = $db->query(sprintf('SELECT * FROM dd_users WHERE userid=\'%u\'', $userid));
$r2 = $db->fetch_row($ir);
$username = $r2['username'];
$email = $r2['email'];
$plays = $r2['plays'];
$newsletter = $r2['newsletter'];
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

if ( $newsletter == "yes" ) { $nsel = "selected" ; } ;
if ( $sex == "m" ) { $msel = "selected" ; } ;
if ( $sex == "f" ) { $fsel = "selected" ; } ;
if ($avatar == "1" ) { $avatarfileurl = '<img src=\''.$domain.'/avatars/'.$avatarfile.'\' height=\'100\' width=\'100\'>'; } else { $avatarfileurl = ''; };


	echo '
		<table align=\'center\'>
	<tr>
		<td colspan=\'4\' class=\'header\'>My Account</td>
	</tr>

			<tr>
                        <td class=\'content\' style=\'padding:3px;\'>'.$avatarfileurl.' </td>
				<td colspan=\'3\' class=\'content\' style=\'padding:3px;\'><a href=\''.$url1.'\'>My Favorites</a> -
				<a href=\''.$url2.'\'>Change Password</a> - 
                        <a href= \''.$url4.'\'>Messages</a> - 
                        <a href= \''.$url5.'\'>Change Avatar</a>
                        </td>
			</tr>



<tr>
<form action="'.$url3.'" method="POST">
<td class="content">Games Played:</td>
<td class="content">'.$plays.'</td>
</tr>
<tr>
<td class="content">Newsletter:</td>
<td class="content"><select type="dropdown" name="newsletter">
<option value="no">No</option>
<option value="yes" '.$nsel.' >Yes</option>
</select>
</td>
</tr>

<tr>
<td class="content">E-mail:</td>
<td class="content"><input name="email" type="text" size="50" value="'.$email.'"></td>
</tr>

<tr>
<td class="content">Location:</td>
<td class="content"><input name="location" type="text" size="50" value="'.$location.'"></td>
</tr>
<tr>
<td class="content">Website:<br><small>(Leave off the http://)</small></td>
<td class="content"><input name="website" type="text" size="50" value="'.$website.'"></td>
</tr>
<tr>
<td class="content">Occupation:<br></td>
<td class="content"><input name="job" type="text" size="50" value="'.$job.'"></td>
</tr>

<tr>
<td class="content">Sex:</td>
<td class="content"><select type="dropdown" name="sex" >
<option value="u">Undisclosed</option>
<option value="m" '.$msel.'>Male</option>
<option value="f" '.$fsel.'>Female</option>
</select></td>
</tr>


<tr>
<td class="content">AIM:</td>
<td class="content"><input name="aim" type="text" size="50" value="'.$aim.'"></td>
</tr>
<tr>
<td class="content">ICQ:</td>
<td class="content"><input name="icq" type="text" size="50" value="'.$icq.'"></td>
</tr>
<tr>
<td class="content">MSN:</td>
<td class="content"><input name="msn" type="text" size="50" value="'.$msn.'"></td>
</tr>
<tr>
<td class="content">Yahoo:</td>
<td class="content"><input name="yim" type="text" size="50" value="'.$yim.'"></td>
</tr>
<tr>
<td class="content">Interests:<br><small>100 characters<br>HTML/scripts not allowed!</small></td>
<td class="content"><textarea name="interests" rows="2" cols="50" >'.$interests.'</textarea></td>
</tr>
<tr>
<td class="content">About Me:<br><small>250 characters<br>HTML/scripts not allowed!</small></td>
<td class="content"><textarea name="bio" rows="4" cols="50" >'.$bio.'</textarea></td>
</tr>

<tr>
<td class="content">My Cool Sites:<br><small>For your MySpace profile, FaceBook, Twitter, Etc. <br>(Leave off the http://)</small></td>
<td class="content">
<input name="link1" type="text" size="50" value="'.$link1.'"><br>
<input name="link2" type="text" size="50" value="'.$link2.'"><br>
<input name="link3" type="text" size="50" value="'.$link3.'"><br>
<input name="link4" type="text" size="50" value="'.$link4.'"><br>
<input name="link5" type="text" size="50" value="'.$link5.'"><br>
<input name="link6" type="text" size="50" value="'.$link6.'"><br>
<input name="link7" type="text" size="50" value="'.$link7.'"><br>
<input name="link8" type="text" size="50" value="'.$link8.'">

</td>
</tr>

<tr>
<td class="content" colspan="4">
<input type="submit" name="submit" value="Submit Changes">
</td>
</tr>






		</table>	';
};





function favorites(){
global $domain, $db, $usrdata, $thumbsfolder, $gamesfolder, $seo_on;
echo '<h2>My Favorites</h2>';
$ro = $db->query(sprintf('SELECT * FROM dd_user_favorites WHERE userid=\''.$usrdata['userid'].'\''));
echo '<table width=\'100%\' border=\'0\'>';
while($r = $db->fetch_row($ro)){
$in1 = $db->query(sprintf('SELECT * FROM dd_games WHERE ID=\'%u\'', $r['gameid']));
$in = $db->fetch_row($in1);

$gamename = ereg_replace('[^A-Za-z0-9]', '', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
       echo '
	      			<tr>
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.$in['name'].'</b></td>
	      			</tr>
	      			<tr>	
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.browsedesclimit($in['description']).' 
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>';
}
echo '</table>';
echo '&nbsp;';
}







function changepassword(){
	global $domain, $db, $usrdata, $seo_on;
	
	if(isset($_POST['submit'])){
	
		$oldpass = md5($_POST['oldpass']);
		$newpass = md5($_POST['newpass']);
		
		if(!$oldpass || !$newpass){
			echo 'Old password, or new password field was not filled.';
			exit;
		}
		
		if($oldpass != $usrdata['password']){
			echo '<div class=\'error\'>Old Passwords to not match.</div>';
		}else{
			$db->query(sprintf('UPDATE dd_users SET password=\'%s\' WHERE userid=\'%u\'', $newpass, $usrdata['userid']));
			echo '<div class=\'msg\'>Password Updated</div>';
		}
		
		
		if($seo_on == 1){
			$surl = ''.$domain.'/myaccount/changepassword/';
		}else{
			$surl = ''.$domain.'/index.php?action=myaccount&cmd=changepassword';
		}
		}
		echo '<form action=\''.$surl.'\' method=\'POST\'>
		<h2>Change Password</h2>
		<table>
			<tr>
				<td>Old Password:</td>
				<td><input type=\'text\' name=\'oldpass\' size=\'35\'></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type=\'text\' name=\'newpass\' size=\'35\'></td>
			</tr>
			<tr>
				<th colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Submit\'></th>
			</tr>
		</table>		
		</form>';
		
	
}




switch($_GET['cmd']){
	default:
	account();
	break;
	
	case 'favorites':
	favorites();
	break;
	
	case 'changepassword':
	changepassword();
	break;
	
	case 'changeavatar':
	changeavatar();
	break;
	
}



};
?>