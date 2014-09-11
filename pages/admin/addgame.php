<?php
switch($_GET['type']){
	default: 
	echo '<div align=\'center\'>What type of game do you want to add? <br />
		<A href=\''.$domain.'/index.php?action=admin&case=addgame&type=enabled\'>Enabled Code</a> | 
		<a href=\''.$domain.'/index.php?action=admin&case=addgame&type=hosted\'>Self Hosted</a> | 
		<a href=\''.$domain.'/index.php?action=admin&case=addgame&type=uploaded\'>Pre Uploaded</a></div>';
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
global $thumbsfolder, $gamesfolder, $domain, $db;
if(isset($_POST['submit'])){
$time = time();
$thumbspath = ''.$thumbsfolder.'/';
$gamespath = ''.$gamesfolder.'/';
$thumb = $_FILES['thumb']['name'];
$game = $_FILES['game']['name'];
$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$width = $_POST['width'];
$height = $_POST['height'];
$category = $_POST['category'];
if(!$game || !$thumb || !$name || !$desc || !$width || !$height){
	$error = 1;
	$msg = 'Not all fields where filled.';
}
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
				type=\'%u\'',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type));
}
}
echo '<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=hosted\' method=\'POST\' enctype=\'multipart/form-data\'>
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
			<td>Width:*</td>
			<td><input type=\'text\' name=\'width\' value=\'500\'></td>
		</tr>
		<tr>
			<td>Height:*</td>
			<td><input type=\'text\' name=\'height\' value=\'450\'></td>
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
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
		</tr>
	</table>		
	</form>';
}
function enabled(){
global $domain, $db;
if(isset($_POST['submit'])){
$time = time();

$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$category = $_POST['category'];
$thumburl = $_POST['thumburl'];
$enabledcode = $_POST['enabledcode'];

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
				enabledcode=\'%s\' ',
				$name, $desc, $category, $type, $time, $thumburl, $enabledcode));
		}
}
echo '<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=enabled\' method=\'POST\'>
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
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
		</tr>
	</table>		
	</form>';	
}	




function preuploaded(){
global $thumbsfolder, $gamesfolder, $domain, $db;
if(isset($_POST['submit'])){
$time = time();
$thumbspath = ''.$thumbsfolder.'/';
$gamespath = ''.$gamesfolder.'/';
$thumb = clean($_POST['thumb']);
$game = clean($_POST['game']);
$name = clean($_POST['name']);
$desc= clean($_POST['desc']);
$width = $_POST['width'];
$height = $_POST['height'];
$category = $_POST['category'];
if(!$game || !$thumb || !$name || !$desc || !$width || !$height){
	$error = 1;
	$msg = 'Not all fields where filled.';
}


if($error == 1){
	echo '<div class=\'error\'>'.$msg.'</div>';
}else{
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
				type=\'%u\'',
				$name, $desc, $game, $width, $height, $category, $thumb, $time, $type));
}
}
echo '<form action=\''.$domain.'/index.php?action=admin&case=addgame&type=uploaded\' method=\'POST\' enctype=\'multipart/form-data\'>
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
			<td>Width:*</td>
			<td><input type=\'text\' name=\'width\' value=\'500\'></td>
		</tr>
		<tr>
			<td>Height:*</td>
			<td><input type=\'text\' name=\'height\' value=\'450\'></td>
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
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
		</tr>
	</table>		
	</form>';
}





?>