<?php
switch($_GET['cmd']){

	default:
	cats();
	break;
	
	case 'games':
	games();
	break;
	
	case 'edit':
	edit();
	break;
	
	case 'delete':
	delete();
	break;	
}
function cats(){
global $domain;
$rr = mysql_query(sprintf('SELECT * FROM dd_categories'));
$count = 0;
echo '<div class=\'pgtitle\'>Choose Category to manage</div><table align=\'center\'>';
while($row = mysql_fetch_array($rr)){
if($count%3==0){
       echo '<tr>
	      	<td width=\'30%\' valign=\'top\'>
	      	<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
	      	</td>
	      	';
     }
else if($count%3==1){
       echo '<td width=\'30%\' valign=\'top\'>
       		<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
       		</td>';
     }     
     else{
       echo '	<td width=\'30%\' valign=\'top\'>
       		<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
       		</td>
	      </tr>';
     }
     $count++;
   }
   
	echo "</table>";

}
function games(){
global $domain, $db, $usrdata;
$CID = abs((int) $_GET['CID']);

$max = 20;
$show = abs((int) $_GET['show']);
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$useridm = clean($usrdata['userid']);

$sql = $db->query(sprintf('SELECT * FROM dd_games WHERE category=\'%u\' and gameadder=\'%s\' order by name ASC LIMIT '.$limits.','.$max.' ', $CID, $useridm)) or die(mysql_error());
$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM dd_games WHERE category=\'%u\' and  gameadder=\'%s\' ', $CID, $useridm)),0);	
$totalpages = ceil($totalres / $max); 

echo '<div class=\'pgtitle\'>Games</div>
<form action=\'\' method=\'POST\'>
<table width=\'95%\' border=\'0\' align=\'center\' class=\'header5\'>
	<tr>
		<th>Name</th>
		<th>Type</th>
		<th>&nbsp;</th>
	</tr>';
if(!mysql_num_rows($sql)){
	echo '<tr>
			<td colspan=\'4\' align=\'center\'>There are no games added.<b></td>
		</tr>	';
}
while($row = $db->fetch_row($sql)){
if($row['type'] == 1){
	$type = 'Self Hosted';
}else{
	$type = 'Enabled Code';
}
echo '<tr>
		<td class=\'content5\' align=\'center\'>'.$row['name'].'</td>
		<td class=\'content5\' align=\'center\'>'.$type.'</td>
		<td class=\'content5\' width=\'50\' align=\'center\'>
		<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$row['ID'].'&type='.$row['type'].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' border=\'0\'></a>
		<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row['name'].'?\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	</tr>';
}
echo '
</table></form>Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 

echo '<a href=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=games&CID='.$CID.'&show='.$i.'\'>'.$i.'</a>&nbsp;';

}
}
function delete(){
$ID = abs((int) $_GET['ID']);
mysql_query(sprintf('DELETE FROM dd_games WHERE ID=\'%u\' and gameadder=\'%s\' ', $ID, $useridm));
echo '<div class=\'msg\'>Game Deleted.
		<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}
function edit(){
global $domain, $db, $gamesfolder, $thumbsfolder, $usrdata;
$useridm = clean($usrdata['userid']);
$ID = abs((int) $_GET['ID']);
$r = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_games WHERE ID=\'%u\' and gameadder=\'%s\' ', $ID, $useridm)));
if($_GET['type'] == 1){
if($_POST['submit']){

	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$category = $_POST['category'];

	$tags = $_POST['tags'];
	$highscore = $_POST['highscore'];
	$highscoreable = $_POST['highscoreable'];
	$highscoreuser = $_POST['highscoreuser'];
	$highscoredate = $_POST['highscoredate'];
	$highscoreip = $_POST['highscoreip'];
	if(!$name){
		echo 'No name entered.';
	}else{

	mysql_query("UPDATE dd_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						tags='$tags',
						highscore='$highscore',
						highscoreable='$highscoreable',
						highscoreuser='$highscoreuser',
						highscoredate='$highscoredate', 
						highscoreip='$highscoreip' WHERE ID='$ID' and gameadder='$useridm'"); 
						
	echo '<div class=\'error\'>Game updated.<br />

		<A href="#" onclick="history.go(-1)">Back</a></div></div>';		
}
}else{
echo '<form action=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'POST\'>
	<table align=\'center\'>
		<tr>
			<td>Name:*</td>
			<td><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
		</tr>
		<tr>
			<td>Description:*</td>
			<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
		</tr>
		<tr>
			<td>Width:*</td>
			<td><input type=\'text\' name=\'width\' value=\''.$r['width'].'\'></td>
		</tr>
		<tr>
			<td>Height:*</td>
			<td><input type=\'text\' name=\'height\' value=\''.$r['height'].'\'></td>
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
			<td>'.$thumbsfolder.'/'.$r['thumb'].'</td>
		</tr>
		<tr>
			<td>SWF Game File:*</td>
			<td>'.$gamesfolder.'/'.$r['file'].'</td>
		</tr>



		<tr>
			<td>Tags:</td>
			<td><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
		</tr>


		<tr>
			<td>Highscore:</td>
			<td><input type=\'text\' name=\'highscore\' value=\''.$r['highscore'].'\'></td>
		</tr>


		<tr>
			<td >Highscore Capable:<br><small></td>
			<td ><input type=\'text\' name=\'highscoreable\' value=\''.$r['highscoreable'].'\'></td>
		</tr>



		<tr>
			<td>Highscore User:</td>
			<td><input type=\'text\' name=\'highscoreuser\' value=\''.$r['highscoreuser'].'\'></td>
		</tr>


		<tr>
			<td>Highscore Date:</td>
			<td><input type=\'text\' name=\'highscoredate\' value=\''.$r['highscoredate'].'\'></td>
		</tr>


		<tr>
			<td>Highscore IP:</td>
			<td><input type=\'text\' name=\'highscoreip\' value=\''.$r['highscoreip'].'\'></td>
		</tr>





		<tr>
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
		</tr>
	</table>		
	</form>';
}
}else{

if(isset($_POST['submit'])){
	$thumburl = clean($_POST['thumburl']);
	$name = clean($_POST['name']);
	$desc = clean($_POST['desc']);
	$category = clean($_POST['category']);
	$active = clean($_POST['active']);
	$enabledcode = clean($_POST['enabledcode']);
	$tags = clean($_POST['tags']);
	$highscore = clean($_POST['highscore']);
	$highscoreuser = clean($_POST['highscoreuser']);
	$highscoredate = clean($_POST['highscoredate']);
	$highscoreip = clean($_POST['highscoreip']);
	

	mysql_query("UPDATE dd_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						thumburl='$thumburl',
						enabledcode='$enabledcode' 
						active='$active', 
						tags='$tags',
						highscore='$highscore',
						highscoreuser='$highscoreuser',
						highscoredate='$highscoredate', 
						highscoreip='$highscoreip' WHERE ID='$ID' and gameadder='$useridm'"); 

}else{
echo '<form action=\''.$domain.'/index.php?action=gameadmin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'POST\'>
	<table align=\'center\'>
		<tr>
			<td>Name:*</td>
			<td><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
		</tr>
		<tr>
			<td>Description:*</td>
			<td><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
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
			<td>Thumb URL:*</td>
			<td><input type=\'text\' size=\'55\' name=\'thumburl\' value=\''.$r['thumburl'].'\'></td>
		</tr>
		<tr>
			<td>Code:*</td>
			<td><textarea cols=\'45\' rows=\'6\' name=\'enabledcode\'>'.$r['enabledcode'].'</textarea></td>
		</tr>

		<tr>
			<td>Active:</td>
			<td><input type=\'text\' name=\'active\' value=\''.$r['active'].'\'></td>
		</tr>


		<tr>
			<td>Tags:</td>
			<td><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
		</tr>


		<tr>
			<td>Highscore:</td>
			<td><input type=\'text\' name=\'highscore\' value=\''.$r['highscore'].'\'></td>
		</tr>


		<tr>
			<td>Highscore User:</td>
			<td><input type=\'text\' name=\'highscoreuser\' value=\''.$r['highscoreuser'].'\'></td>
		</tr>


		<tr>
			<td>Highscore Date:</td>
			<td><input type=\'text\' name=\'highscoredate\' value=\''.$r['highscoredate'].'\'></td>
		</tr>


		<tr>
			<td>Highscore IP:</td>
			<td><input type=\'text\' name=\'highscoreip\' value=\''.$r['highscoreip'].'\'></td>
		</tr>




		<tr>
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
		</tr>
	</table>		
	</form>';
}




}
}
?>