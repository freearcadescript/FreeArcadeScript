<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}


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
	global $domain, $db, $seo_on;


$max = '100';
if(!isset($_GET['page'])){
	$show = '1';
}else{
	$show = clean($_GET['page']);
}
$limits = ($show - 1) * $max;
$r = $db->query(sprintf("SELECT * FROM fas_users where userid!='0' ORDER BY username ASC LIMIT $limits,$max"));
$totalres = mysql_result($db->query('SELECT COUNT(userid) AS total FROM fas_users WHERE userid != "0"'),0);
$totalpages = ceil($totalres / $max);
echo'<div class="heading">
	<h2>User List</h2>
</div>
<br clear="all">
<table id="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Plays</th>
			<th colspan="2">Name</th>
		</tr>
	</thead>';
while($ir = $db->fetch_row($r)){
$userid=$ir['userid'];
if($seo_on == 1){
	$urlp = ''.$domain.'/showprofile/'.$userid.'.html';
}else{
	$urlp = ''.$domain.'/index.php?action=showprofile&profile='.$userid ;
}

echo'<tbody>
	<tr>
		<td width="50px">'.$ir['userid'].'</td>
		<td width="50px">'.$ir['plays'].'</td>
		<td width="750px"><a href="'.$urlp.'">'.$ir['username'].'</a></td>
		<td><a href="'.$domain.'/index.php?action=admin&case=managemembers&cmd=edit&userid='.$userid.'"><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a></td>
	</tr>
</tbody>';
}

echo '</table>
<div class="page-box">'
.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';

$previous = ''.$domain.'/index.php?action=admin&case=managemembers&page='.$pre.'';
$next = ''.$domain.'/index.php?action=admin&case=managemembers&page='.$ne.'';

if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){
				
				$urk = ''.$domain.'/index.php?action=admin&case=managemembers&page='.$i.'';
				
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
echo '</div>';
$pgname = 'Member list';

};

function delete(){
global $db, $domain;
$userid = abs((int) $_GET['userid']);
if(!$userid) {echo 'No profile selected'; return;}
else {
	$db->query(sprintf('DELETE FROM fas_users WHERE userid=\'%u\'', $userid));
	echo '<div class=\'msg\'>Member Deleted.<br>';
	$db->query(sprintf('DELETE FROM fas_comments WHERE commenter=\'%u\'', $userid));
	echo 'Member comments Deleted from games.<br>';
	$db->query(sprintf('DELETE FROM fas_blogcomments WHERE commenterid=\'%u\'', $userid));
	echo 'Member comments Deleted from blog.<br>
				</div>';
}

};

function submited(){
global $db, $domain;
$userid = abs((int) $_POST['userid']);
if(!$userid) {return;}
if(isset($_POST['submit'])){

$userid = clean($_POST['userid']);

$user_level = clean($_POST['user_level']);

$newsletter = clean($_POST['newsletter']);
$utemplate = clean($_POST['template']);
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
$gamelevel = clean($_POST['gamelevel']);
$signature = clean($_POST['signature']);
$avatar = clean($_POST['avatar']);
$avatarfile = clean($_POST['avatarfile']);

mysql_query("UPDATE fas_users SET user_level='$user_level', newsletter='$newsletter', template='$utemplate', aim='$aim', icq='$icq', msn='$msn', yim='$yim', location='$location',
job='$job', website='$website', link1='$link1', link2='$link2', link3='$link3', link4='$link4', link5='$link5', link6='$link6', link7='$link7', link8='$link8', sex='$sex', interests='$interests', bio='$bio', bloglevel='$bloglevel', gamelevel='$gamelevel', signature='$signature', avatar='$avatar', avatarfile='$avatarfile' WHERE userid='$userid'" ) ;
echo '<div class=\'msg\'>Profile updated</div><p>';

}
else
{
echo 'No profile selected';

};

};

function edit(){
global $db, $domain, $utemplate;
$userid = abs((int) $_GET['userid']);
if(!$userid) { echo 'No profile selected ' ; return;}

$set = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_users WHERE userid=\'%u\'', $userid)));
$username = $set['username'];
$user_level = $set['user_level'];

$newsletter = $set['newsletter'];
$utemplate = $set['template'];
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
$gamelevel = $set['gamelevel'];
$signature = $set['signature'];
$avatar = $set['avatar'];
$avatarfile = $set['avatarfile'];

if ( $newsletter == "yes" ) { $nsel = "selected" ; }else{ $nsel = NULL;};
if ( $sex == "m" ) { $msel = "selected" ; }else{$msel = NULL;} ;
if ( $sex == "f" ) { $fsel = "selected" ; }else{$fsel = NULL;} ;
if ( $avatar == "1" ) {$avsel = "selected" ; $avatarfileurl='<img src="'.$domain.'/avatars/'.$avatarfile.'" width="100" height="100" alt="avatar" />'; } ;

echo'<div class="heading">
	<h2>Edit User</h2>
</div>
<br clear="all">
<form action="'.$domain.'/index.php?action=admin&case=managemembers&cmd=submited" method="post">
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">User Profile: '.$username.'/'.$userid.' ~
<a href=\''.$domain.'/index.php?action=admin&case=managemembers&cmd=delete&userid='.$userid.'\'>Delete Member?</a></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>User Level:</td>
				<td><input type="hidden" name="userid" value="'.$userid.'"><br>
				<input type="text" name="user_level" size="2" value="'.$user_level.'"></td>
			</tr>
			<tr>
				<td>Newsletter:</td>
				<td><select type="dropdown" name="newsletter">
					<option value="no">No</option>
					<option value="yes" '.$nsel.' >Yes</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Template:</td>
				<td><select type="dropdown" name="template">
					<option value="default">default</option>';
					$path = $directorypath."templates";
					$directory = dir($path);
					while (false !== ($item = $directory->read())) {
						if ($item !== "." && $item !== "..") {
							if ($item == $utemplate) { $usel = "selected"; }else{ $usel = NULL; }
							echo"
							<option value=".$item." ".$usel." >".$item."</option>";
						}
					}
				echo'</select>
				</td>
			</tr>
			<tr>
				<td>Location:<br></td>
				<td><input name="location" type="text" size="50" value="'.$location.'"></td>
			</tr>
			<tr>
				<td>Link 1:<br>(Leave off the http://)</td>
				<td><input name="link1" type="text" size="50" value="'.$link1.'"></td>
			</tr>
			<tr>
				<td>Link 2:<br></td>
				<td><input name="link2" type="text" size="50" value="'.$link2.'"></td>
			</tr>
			<tr>
				<td>Link 3:<br></td>
				<td><input name="link3" type="text" size="50" value="'.$link3.'"></td>
			</tr>
			<tr>
				<td>Link 4:<br></td>
				<td><input name="link4" type="text" size="50" value="'.$link4.'"></td>
			</tr>
			<tr>
				<td>Link 5:<br></td>
				<td><input name="link5" type="text" size="50" value="'.$link5.'"></td>
			</tr>
			<tr>
				<td>Link 6:<br></td>
				<td><input name="link6" type="text" size="50" value="'.$link6.'"></td>
			</tr>
			<tr>
				<td>Link 7:<br></td>
				<td><input name="link7" type="text" size="50" value="'.$link7.'"></td>
			</tr>
			<tr>
				<td>Link 8:<br></td>
				<td><input name="link8" type="text" size="50" value="'.$link8.'"></td>
			</tr>
			<tr>
				<td>Website:<br>(Leave off the http://)</td>
				<td><input name="website" type="text" size="50" value="'.$website.'"></td>
			</tr>
			<tr>
				<td>Occupation:</td>
				<td><input name="job" type="text" size="50" value="'.$job.'"></td>
			</tr>
			<tr>
				<td>Sex:</td>
				<td><select type="dropdown" name="sex" >
					<option value="u">Undisclosed</option>
					<option value="m" '.$msel.'>Male</option>
					<option value="f" '.$fsel.'>Female</option>
				</select></td>
			</tr>
			<tr>
				<td>AIM:</td>
				<td><input name="aim" type="text" size="50" value="'.$aim.'"></td>
			</tr>
			<tr>
				<td>ICQ:</td>
				<td><input name="icq" type="text" size="50" value="'.$icq.'"></td>
			</tr>
			<tr>
				<td>MSN:</td>
				<td><input name="msn" type="text" size="50" value="'.$msn.'"></td>
			</tr>
			<tr>
				<td>Yahoo:</td>
				<td><input name="yim" type="text" size="50" value="'.$yim.'"></td>
			</tr>
			<tr>
				<td>Interests:<br>HTML/scripts not allowed!</td>
				<td><textarea name="interests" rows="2" cols="50" >'.$interests.'</textarea></td>
			</tr>
			<tr>
				<td>About Me:<br>HTML/scripts not allowed!</td>
				<td><textarea name="bio" rows="4" cols="50" >'.$bio.'</textarea></td>
			</tr>
			<tr>
				<td>Blog Permissions:<br><small>1=read<br>2=write: no HTML<br>3= TRUSTED: can use HTML</small></td>
				<td><input name="bloglevel" type="text" size="1" value="'.$bloglevel.'"></td>
			</tr>
			<tr>
				<td>Game Permissions:<br><small>1=user<br>2=game adder: not live<br></small></td>
				<td><input name="gamelevel" type="text" size="1" value="'.$gamelevel.'"></td>
			</tr>
			<tr>
				<td>Signature:</td>
				<td><input name="signature" type="text" size="50" value="'.$signature.'"></td>
			</tr>
			<tr>
				<td>Use Avatar:</td>
				<td><select type="dropdown" name="avatar" >
					<option value="0">No</option>
					<option value="1" '.$avsel.'>Yes</option>
					</select></td>
			</tr>
			<tr>
				<td>Avatar File:<br>'.$avatarfileurl.'</td>
				<td><input name="avatarfile" type="text" size="50" value="'.$avatarfile.'"></td>
			</tr>
			<tr>
				<td colspan="4">
				<input type="submit" name="submit" value="Submit Changes">
				</td>
			</tr>
		</tbody>
	</table>
</form>';

};
?>