<?php
switch($_GET['type']){
	default: 
	echo '<div align=\'center\'>What type of game do you want to add? <br />
		<A href=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=enabled\'>Enabled Code</a> | 
		<a href=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=hosted\'>Self Hosted</a> | 
		<a href=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=uploaded\'>Pre Uploaded</a></div>';
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
// $width = $_POST['width'];
// $height = $_POST['height'];
$category = clean($_POST['category']);
$tags = clean($_POST['tags']);
$highscoreable = $_POST['highscoreable'];
$gameadder = clean($usrdata['userid']);
$adderip = $_SERVER['REMOTE_ADDR'];
if(!$game || !$thumb || !$name || !$desc){
	$error = 1;
	$msg = 'Not all fields where filled.';
}

function findexts ($filename) 
{ 
$filename = strtolower($filename) ; 
$exts = split("[/\\.]", $filename) ; 
$n = count($exts)-1; 
$exts = $exts[$n]; 
return $exts; 
} 
$ext = findexts ($_FILES['thumb']['name']) ; 
$os = array("gif", "jpg", "jpeg", "png");
if (!in_array($ext, $os)) {
echo  "Thumb extension not allowed"; exit; 
} else { };

$ext = findexts ($_FILES['game']['name']) ; 
$os = array("swf", "dcr");
if (!in_array($ext, $os)) {
echo  "Game file extension not allowed"; exit; 
} else { };










if(!move_uploaded_file($_FILES['thumb']['tmp_name'],$thumbspath . $thumb)){
	$error = 1;
	$msg = 'thumb file un-successfully uploaded, please make sure your thumbs folder is chmoded to 0777.';
}

if(!move_uploaded_file($_FILES['game']['tmp_name'],$gamespath . $game)){
	$error = 1;
	$msg = 'SWF file un-successfully uploaded, please make sure your games folder is chmoded to 0777.';
}


if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
      $gamevar1 = $gamespath.$game;
      
      $gamesize = getimagesize($gamevar1);
      $width = $gamesize[0];
      $height = $gamesize[1];
      

	echo '<div class=\'msg\'>Game Successfully added but not activated!</div>';
	$type= 1;
	$db->query(sprintf('INSERT INTO dd_games SET
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
				highscoreable=\'%s\',  
				gameadder=\'%u\',
				adderip=\'%s\'
',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type, $tags, $highscoreable, $gameadder, $adderip));
}
}
echo '<form action=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=hosted\' method=\'POST\' enctype=\'multipart/form-data\'>
	<table align=\'center\'>
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
			<td>
			<select type=\'dropdown\' name=\'category\'>';
		$query = $db->query('SELECT * FROM dd_categories');
		while($row = $db->fetch_row($query)){
			echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
		}	
		echo '	
			</select>
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
			<td>High Score Capable:</td>
			<td>
			<select type=\'dropdown\' name=\'highscoreable\'>
		      <option value=\'0\'>No</option>
			<option value=\'1\'>Yes</option>
		
		
			</select>
		</td>
			
		</tr>


		<tr>
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
		</tr>
	</table>		
	</form>';
}
function enabled(){
global $domain, $db, $suserid, $usrdata ;
if(isset($_POST['submit'])){
$time = time();

$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$category = clean($_POST['category']);
$thumburl = clean($_POST['thumburl']);
$enabledcode = clean($_POST['enabledcode']);
$tags = clean($_POST['tags']);
$gameadder = $usrdata['userid'];
$adderip = $_SERVER['REMOTE_ADDR'];

if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
	echo '<div class=\'msg\'>Game Successfully added but not activated!</div>';
	$type = 2;
	$db->query(sprintf('INSERT INTO dd_games SET
				name=\'%s\',
				description=\'%s\',
				category=\'%s\',
				type=\'%u\',
				dateadded=\'%u\',
				thumburl=\'%s\',
				enabledcode=\'%s\',
				tags=\'%s\', 
				gameadder=\'%u\',
				adderip=\'%s\' ',
				$name, $desc, $category, $type, $time, $thumburl, $enabledcode, $tags, $gameadder, $adderip));
		}
}
echo '<form action=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=enabled\' method=\'POST\'>
	<table align=\'center\'>
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
			<td>
			<select type=\'dropdown\' name=\'category\'>';
		$query = $db->query('SELECT * FROM dd_categories');
		while($row = $db->fetch_row($query)){
			echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
		}	
		echo '	
			</select>
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
// $width = $_POST['width'];
// $height = $_POST['height'];
$category = clean($_POST['category']);
$tags = clean($_POST['tags']);
$highscoreable = $_POST['highscoreable'];
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
      

	echo '<div class=\'msg\'>Game Successfully added but not activated!</div>';
	$type= 1;
	$db->query(sprintf('INSERT INTO dd_games SET
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
				highscoreable=\'%s\',  
				gameadder=\'%u\',
				adderip=\'%s\' ',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type, $tags, $highscoreable, $gameadder, $adderip));
}
}
echo '<form action=\''.$domain.'/index.php?action=gameadmin&case=addgame&type=uploaded\' method=\'POST\' enctype=\'multipart/form-data\'>
	<table align=\'center\'>
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
			<td>
			<select type=\'dropdown\' name=\'category\'>';
		$query = $db->query('SELECT * FROM dd_categories');
		while($row = $db->fetch_row($query)){
			echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
		}	
		echo '	
			</select>
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
	</table>		
	</form>';
}





?>