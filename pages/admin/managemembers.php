<?php
switch($_GET['cmd']){
	default: 
	first();
	break;
	
	case 'delete':
	delete();
	break;
	
	case 'edit':
	edit();
	break;
	
	case 'submited':
	submited();
	break;
	

};
function first(){
	global $domain, $db;


$max = '100';
$show = clean($_GET['page']);
if(empty($show)){
$show = 1;
}
$limits = ($show - 1) * $max; 
$r = $db->query(sprintf("SELECT * FROM dd_users ORDER BY username ASC LIMIT $limits,$max"));
$totalres = mysql_result($db->query('SELECT COUNT(userid) AS total FROM dd_users'),0); 
$totalpages = ceil($totalres / $max); 
echo '

<table width="89%" align="center">
	<tr>
		<td colspan=\'4\' class=\'header\'>User List</td>
	</tr>
<tr>
<th class="header">#</th>
<th class="header">Name</th>
<th class="header">Plays</th>
<th class="header">Action</th>
</tr>';
while($ir = $db->fetch_row($r)){
$userid=$ir['userid'];
if($seo_on == 1){
	$urlp = ''.$domain.'/showprofile/'.$userid.'.html';
}else{
	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$userid ;
}



echo ' <tr>
<td class="content">'.$ir['userid'].'</td>
<td class="content">'.$ir['username'].'</td>
<td class="content">'.$ir['plays'].'</td>
<td class="content"><a href="'.$urlp.'">View Profile</a> ~ <a href="'.$domain.'/index.php?action=admin&case=managemembers&cmd=edit&userid='.$userid.'">Edit</a></td>
</tr>';
}

echo '</table>
<div align="center">Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 
echo '<a href="'.$domain.'/index.php?action=admin&case=managemembers&page='.$i.'" class="pagenat">'.$i.'</a>&nbsp; ';

}
echo '</div><p>';
$pgname = 'Member list';










};






function delete(){
global $db, $domain;
$userid = abs((int) $_GET['userid']);
if(!$userid) {echo 'No profile selected'; exit;}
else {
	$db->query(sprintf('DELETE FROM dd_users WHERE userid=\'%u\'', $userid));
	echo '<div class=\'msg\'>Member Deleted.<br>';
	$db->query(sprintf('DELETE FROM dd_comments WHERE commenter=\'%u\'', $userid));
	echo 'Member comments Deleted from games.<br>';
	$db->query(sprintf('DELETE FROM blogcomments WHERE commenterid=\'%u\'', $userid));
	echo 'Member comments Deleted from blog.<br>
				</div>';
}

};






function submited(){
global $db, $domain;
$userid = abs((int) $_POST['userid']);
if(!$userid) {exit;}
if(isset($_POST['submit'])){
	


$userid = clean($_POST['userid']);

$user_level = clean($_POST['user_level']);

$newsletter = clean($_POST['newsletter']);
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
$bloglevel = clean($_POST['bloglevel']);
$forumlevel = clean($_POST['forumlevel']);
$gamelevel = clean($_POST['gamelevel']);
$signature = clean($_POST['signature']);
$avatar = clean($_POST['avatar']);
$avatarfile = clean($_POST['avatarfile']);

mysql_query("UPDATE dd_users SET user_level='$user_level', newsletter='$newsletter', aim='$aim', icq='$icq', msn='$msn', yim='$yim', location='$location', 
job='$job', website='$website', link1='$link1', link2='$link2', link3='$link3', link4='$link4', link5='$link5', link6='$link6', link7='$link7', link8='$link8', sex='$sex', interests='$interests', bio='$bio', bloglevel='$bloglevel', forumlevel='$forumlevel', gamelevel='$gamelevel', signature='$signature', avatar='$avatar', avatarfile='$avatarfile' WHERE userid='$userid'" ) ;
echo '<div class=\'msg\'>Profile updated</div><p>';



}
else
{
echo 'No profile selected';


};

};








function edit(){
global $db, $domain;
$userid = abs((int) $_GET['userid']);
if(!$userid) { echo 'No profile selected ' ; exit;}

$set = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_users WHERE userid=\'%u\'', $userid)));
$username = $set['username'];
$user_level = $set['user_level'];

$newsletter = $set['newsletter'];
$aim = $set['aim'];
$icq = $set['icq'];
$msn = $set['msn'];
$yim = $set['yim'];
$location = $set['location'];
$link1 = $set['link1'];
$link2 = $set['link2'];
$link3 = $set['link3'];
$link4 = $set['link4'];
$link5 = $set['link5'];
$link6 = $set['link6'];
$link7 = $set['link7'];
$link8 = $set['link8'];
$job = $set['job'];
$website = $set['website'];
$sex = $set['sex'];
$interests = $set['interests'];
$bio = $set['bio'];
$bloglevel = $set['bloglevel'];
$forumlevel = $set['forumlevel'];
$gamelevel = $set['gamelevel'];
$signature = $set['signature'];
$avatar = $set['avatar'];
$avatarfile = $set['avatarfile'];


if ( $newsletter == "yes" ) { $nsel = "selected" ; } ;
if ( $sex == "m" ) { $msel = "selected" ; } ;
if ( $sex == "f" ) { $fsel = "selected" ; } ;
if ( $avatar == "1" ) {$avsel = "selected" ; $avatarfileurl='<img src=\''.$domain.'/avatars/'.$avatarfile.'\' width=\'100\' height=\'100\'>'; } ;



	echo '
		<table align=\'center\'>
	<tr>  
		<td colspan=\'4\' class=\'header\'>User Profile: '.$username.'/'.$userid.' ~ 
<a href=\''.$domain.'/index.php?action=admin&case=managemembers&cmd=delete&userid='.$userid.'\' class=\'playlink\'>Delete Member?</a>
</td>
	</tr>



<tr>
<td class="content">
<form action="'.$domain.'/index.php?action=admin&case=managemembers&cmd=submited" method="POST">

User Level:</td>
<td class="content">
<input type="hidden" name="userid" value="'.$userid.'"><br>
<input type="text" name="user_level" size="2" value="'.$user_level.'"></td>
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
<td class="content">Location:<br></td>
<td class="content"><input name="location" type="text" size="50" value="'.$location.'"></td>
</tr>
<tr>
<td class="content">Link 1:<br>(Leave off the http://)</td>
<td class="content"><input name="link1" type="text" size="50" value="'.$link1.'"></td>
</tr>
<tr>
<td class="content">Link 2:<br></td>
<td class="content"><input name="link2" type="text" size="50" value="'.$link2.'"></td>
</tr>
<tr>
<td class="content">Link 3:<br></td>
<td class="content"><input name="link3" type="text" size="50" value="'.$link3.'"></td>
</tr>
<tr>
<td class="content">Link 4:<br></td>
<td class="content"><input name="link4" type="text" size="50" value="'.$link4.'"></td>
</tr>
<tr>
<td class="content">Link 5:<br></td>
<td class="content"><input name="link5" type="text" size="50" value="'.$link5.'"></td>
</tr>
<tr>
<td class="content">Link 6:<br></td>
<td class="content"><input name="link6" type="text" size="50" value="'.$link6.'"></td>
</tr>
<tr>
<td class="content">Link 7:<br></td>
<td class="content"><input name="link7" type="text" size="50" value="'.$link7.'"></td>
</tr>
<tr>
<td class="content">Link 8:<br></td>
<td class="content"><input name="link8" type="text" size="50" value="'.$link8.'"></td>
</tr>
<tr>
<td class="content">Website:<br>(Leave off the http://)</td>
<td class="content"><input name="website" type="text" size="50" value="'.$website.'"></td>
</tr>
<tr>
<td class="content">Occupation:</td>
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
<td class="content">Interests:<br>HTML/scripts not allowed!</td>
<td class="content"><textarea name="interests" rows="2" cols="50" >'.$interests.'</textarea></td>
</tr>
<tr>
<td class="content">About Me:<br>HTML/scripts not allowed!</td>
<td class="content"><textarea name="bio" rows="4" cols="50" >'.$bio.'</textarea></td>
</tr>
<tr>
<td class="content">Blog Permissions:<br><small>1=read<br>2=write: no HTML<br>3= TRUSTED: can use HTML</small></td>
<td class="content"><input name="bloglevel" type="text" size="1" value="'.$bloglevel.'"></td>
</tr>

<tr>
<td class="content">Forum Permissions:</td>
<td class="content"><input name="forumlevel" type="text" size="1" value="'.$forumlevel.'"></td>
</tr>
<tr>
<td class="content">Game Permissions:<br><small>1=user<br>2=game adder: not live<br></small></td>
<td class="content"><input name="gamelevel" type="text" size="1" value="'.$gamelevel.'"></td>
</tr>

<tr>
<td class="content">Signature:</td>
<td class="content"><input name="signature" type="text" size="50" value="'.$signature.'"></td>
</tr>
<tr>
<td class="content">Use Avatar:</td>
<td class="content"><select type="dropdown" name="avatar" >
<option value="0">No</option>
<option value="1" '.$avsel.'>Yes</option>
</select></td>
</tr>
<tr>
<td class="content">Avatar File:<br>'.$avatarfileurl.'</td>
<td class="content"><input name="avatarfile" type="text" size="50" value="'.$avatarfile.'"></td>
</tr>

<tr>
<td class="content" colspan="4">
<input type="submit" name="submit" value="Submit Changes">
</td>
</tr>






		</table>	';




};




?>