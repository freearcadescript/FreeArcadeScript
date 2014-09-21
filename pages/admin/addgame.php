<?php
if (!isset($_GET['type'])){
	$_GET['type'] = NULL;
}

switch($_GET['type']){
	default:
	addgame();
	break;

	case 'enabled':
	enabled();
	break;

	case 'hosted':
	hosted();
	break;

	case 'uploaded':
	preuploaded();
	break;


}

function addgame(){
	global $domain;
	echo'<div class="heading">
			<h2>Add Game</h2>
		</div>
                <br clear="all">
		<table id="table">
			<thead>
				<tr>
					<th colspan="3">Select Type</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><a href=\''.$domain.'/index.php?action=admin&case=addgame&type=enabled\'>Enabled Code</a></td>
					<td><a href=\''.$domain.'/index.php?action=admin&case=addgame&type=hosted\'>Self Hosted</a></td>
					<td><a href=\''.$domain.'/index.php?action=admin&case=addgame&type=uploaded\'>Pre Uploaded</a></td>
				</tr>
			</tbody>
		</table>';
}

function hosted(){
global $thumbsfolder, $gamesfolder, $domain, $db, $suserid, $usrdata ;
if(isset($_POST['submit'])){
$time = time();
$thumbspath = ''.$thumbsfolder.'/';
$gamespath = ''.$gamesfolder.'/';
$thumb = $_FILES['thumb']['name'];
$game = $_FILES['game']['name'];
$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$category = clean($_POST['category']);
// $active = clean($_POST['active']);
$tags = clean($_POST['tags']);
$gameadder = $usrdata['userid'];
$adderip = $_SERVER['REMOTE_ADDR'];
if(!$game || !$thumb || !$name || !$desc){
	$error = 1;
	$msg = 'Not all fields where filled.';
}else{$error = NULL;}
if(!move_uploaded_file($_FILES['thumb']['tmp_name'],$thumbspath . $thumb)){
	$error = 1;
	$msg = 'thumb file un-successfully uploaded, please make sure your thumbs folder is chmoded to 0777.';
}else{$error = NULL;}
if(!move_uploaded_file($_FILES['game']['tmp_name'],$gamespath . $game)){
	$error = 1;
	$msg = 'SWF file un-successfully uploaded, please make sure your games folder is chmoded to 0777.';
}else{$error = NULL;}


if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
      $gamevar1 = $gamespath.$game;

      $gamesize = getimagesize($gamevar1);
      $width = $gamesize[0];
      $height = $gamesize[1];

	echo '<div class=\'msg\'>Game Successfully Added!</div>';
	$type= 1;
	$db->query(sprintf('INSERT INTO fas_games SET
				name=\'%s\',
				description=\'%s\',
				file=\'%s\',
				width=\'%u\',
				height=\'%u\',
				category=\'%u\',
				thumb=\'%s\',
				dateadded=\'%u\',
				type=\'%u\',
				tags=\'%s\',
				gameadder=\'%u\',
				adderip=\'%s\'',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type, $tags, $gameadder, $adderip));
}
}
echo '<div class="heading">
	<h2>Self Hosted</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=hosted\' method=\'post\' enctype=\'multipart/form-data\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Game Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name:*</td>
				<td><input type=\'text\' name=\'name\' size=\'40\'></td>
			</tr>
			<tr>
				<td>Description:*</td>
				<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'></textarea></td>
			</tr>
			<tr>
				<td>Category:*</td>
				<td><select type=\'dropdown\' name=\'category\'>';
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
						echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
					}
					echo'</select>
				</td>
			</tr>
			<tr>
				<td>Thumb File:*</td>
				<td><input type=\'file\' name=\'thumb\' size=\'35\'></td>
			</tr>
			<tr>
				<td>SWF Game File:*</td>
				<td><input type=\'file\' name=\'game\' size=\'35\'></td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' size=\'35\'></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}
function enabled(){
global $domain, $db, $suserid, $usrdata ;
if(isset($_POST['submit'])){
$time = time();

$name = clean($_POST['name']);
$desc = clean($_POST['desc']);
$category = clean($_POST['category']);
$thumburl = clean($_POST['thumburl']);
$enabledcode = clean($_POST['enabledcode']);
$active = clean($_POST['active']);
$tags = clean($_POST['tags']);
$gameadder = $usrdata['userid'];
$adderip = $_SERVER['REMOTE_ADDR'];
if(!$name || !$desc || !$thumburl || !$enabledcode){
	$error = 1;
	$msg = 'Not all fields where filled.';
}else{
	$error = NULL;
}

if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
	echo '<div class=\'msg\'>Game Successfully Added!</div>';
	$type = 2;
	$db->query(sprintf('INSERT INTO fas_games SET
				name=\'%s\',
				description=\'%s\',
				category=\'%s\',
				type=\'%u\',
				dateadded=\'%u\',
				thumburl=\'%s\',
				enabledcode=\'%s\',
				active=\'1\',
				tags=\'%s\',
				gameadder=\'%u\',
				adderip=\'%s\'',
				$name, $desc, $category, $type, $time, $thumburl, $enabledcode, $active, $tags, $gameadder, $adderip));
		}
}
echo '<div class="heading">
	<h2>Enabled Code</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=enabled\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Game Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name:*</td>
				<td><input type=\'text\' name=\'name\' size=\'40\'></td>
			</tr>
			<tr>
				<td>Description:*</td>
				<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'></textarea></td>
			</tr>
			<tr>
				<td>Category:*</td>
				<td><select type=\'dropdown\' name=\'category\'>';
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
						echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
					}
					echo'</select>
				</td>
			</tr>
			<tr>
				<td>Thumb URL:</td>
				<td><input type=\'text\' name=\'thumburl\' size=\'45\'></td>
			</tr>
			<tr>
				<td>Enabled Code:</td>
				<td><textarea cols=\'45\' rows=\'5\' name=\'enabledcode\'></textarea></td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' size=\'35\'></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}




function preuploaded(){
global $thumbsfolder, $gamesfolder, $domain, $db, $suserid, $usrdata ;
if(isset($_POST['submit'])){
$time = time();
$thumbspath = ''.$thumbsfolder.'/';
$gamespath = ''.$gamesfolder.'/';
$thumb = clean($_POST['thumb']);
$game = clean($_POST['game']);
$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$category = clean($_POST['category']);
$active = clean($_POST['active']);
$tags = clean($_POST['tags']);
$gameadder = $usrdata['userid'];
$adderip = $_SERVER['REMOTE_ADDR'];
if(!$game || !$thumb || !$name || !$desc){
	$error = 1;
	$msg = 'Not all fields where filled.';
}


if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
      $gamevar1 = $gamespath.$game;

      $gamesize = getimagesize($gamevar1);
      $width = $gamesize[0];
      $height = $gamesize[1];
	echo '<div class=\'msg\'>Game Successfully Added!</div>';
	$type= 1;
	$db->query(sprintf('INSERT INTO fas_games SET
				name=\'%s\',
				description=\'%s\',
				file=\'%s\',
				width=\'%u\',
				height=\'%u\',
				category=\'%u\',
				thumb=\'%s\',
				dateadded=\'%u\',
				type=\'%u\',
				active=\'1\',
				tags=\'%s\',
				gameadder=\'%u\',
				adderip=\'%s\'',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type, $active, $tags, $gameadder, $adderip));
}
}
echo '<div class="heading">
	<h2>Pre Uploaded</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=uploaded\' method=\'post\' enctype=\'multipart/form-data\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Game Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name:*</td>
				<td><input type=\'text\' name=\'name\' size=\'40\'></td>
			</tr>
			<tr>
				<td>Description:*</td>
				<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'></textarea></td>
			</tr>
			<tr>
				<td>Category:*</td>
				<td><select type=\'dropdown\' name=\'category\'>';
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
						echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
					}
					echo'</select>
				</td>
			</tr>
			<tr>
				<td>Thumb File:*</td>
				<td><input type=\'text\' name=\'thumb\' size=\'40\'></td>
			</tr>
			<tr>
				<td>SWF Game File:*</td>
				<td><input type=\'text\' name=\'game\' size=\'40\'></td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' size=\'35\'></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}
?>