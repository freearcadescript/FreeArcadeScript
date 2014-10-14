<?php
if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

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

	case 'approve':
	approve();
	break;
}
function cats(){
global $domain, $thumbsfolder, $gamesfolder;
$rr = mysql_query(sprintf('SELECT * FROM fas_categories'));
echo '<div class="heading">
	<h2>Manage Games</h2>
</div>
<br clear="all">
<a href=\''.$domain.'/index.php?action=admin&case=addgame\' class="button">New Game</a>
<table id="table">
	<thead>
		<tr>
			<th colspan="2">Choose Game Category</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="95%">All Games</td>
			<td><a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID=all\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a></td>
		</tr>';
while($row = mysql_fetch_array($rr)){
	echo '<tr>
			<td width="95%">'.$row['name'].'</td>
			<td><a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$row['ID'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" /></a></td>
		</tr>';
}
echo'</tbody>
</table>

<table id="table">
	<thead>
		<tr>
			<th colspan=\'3\'>Inactive Games</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan=\'3\'><table width=\'100%\'>';

$sql = mysql_query(sprintf('SELECT * FROM fas_games WHERE active=\'0\' ')) or die(mysql_error());


while($row = mysql_fetch_row($sql)){
if($row[9] == 1){
	$type = 'Self Hosted';
}else{
	$type = 'Enabled Code';
}
$thumbs = '<img src="'.$domain.'/'.$thumbsfolder.'/'.$row[7].'" width="55" width="55" border="0" />';
$descriptions = $row[2];

if ($row[9] == '1') {
	$dlurl1='<a href=\''.$domain.'/'.$gamesfolder.'/'.$row[3].'\'><img src="pages/admin/img/download.png" width="24" height="24" alt="download" title="Download" border="0" /></a>';
}else{
	$dlurl1 = NULL;
}
	echo '<tr>
			<td>'.$row[1].'<br>'.$thumbs.'<p>'.$descriptions.'</td>
			<td align=\'center\'>'.$type.'</td>
			<td align=\'center\'>
				<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$row[0].'&type='.$row[9].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=delete&ID='.$row[0].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row[1].'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=approve&ID='.$row[0].'\'  ><img src="pages/admin/img/approve.png" width="24" height="24" alt="activate" title="Activate" border="0" /></a>
				<a href=\''.$domain.'/index.php?action=admin&case=testgame&gameid='.$row[3].'\' target=\'_blank\'><img src="pages/admin/img/test.png" width="24" height="24" alt="test" title="Test" border="0" /></a>
            '.$dlurl1.'
			</td>
		</tr>';
};



		echo'</table>
		</td>
	</tr>
</table>';

}
function games(){
global $domain, $db, $gamesfolder, $thumbsfolder, $directorypath;
$CID = abs((int) $_GET['CID']);

$max = 20;
if(!isset($_GET['show'])){
	$show = '1';
}else{
	$show = $_GET['show'];
}
$limits = ($show - 1) * $max;
if($CID == "all"){
	$sql = $db->query(sprintf('SELECT * FROM fas_games WHERE active=\'1\' ORDER BY ID DESC LIMIT '.$limits.','.$max.' ')) or die(mysql_error());
	$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM fas_games WHERE active=\'1\'')),0);
}else{
	$sql = $db->query(sprintf('SELECT * FROM fas_games WHERE category=\'%u\' ORDER BY ID DESC LIMIT '.$limits.','.$max.' ', $CID)) or die(mysql_error());
	$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM fas_games WHERE category=\'%u\'', $CID)),0);
}
$totalpages = ceil($totalres / $max);

echo '<div class="heading">
	<h2>Manage Games</h2>
</div>
<br clear="all">
<form action=\'\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th width="50px">Image</th>
				<th colspan="2">Name</th>
			</tr>
		</thead>
		<tbody>';
if(!mysql_num_rows($sql)){
	echo '<tr>
			<td colspan=\'3\' align=\'center\'>There are no games added.</td>
		</tr>';
}
while($row = $db->fetch_row($sql)){
if($row['type'] == 1){
	$type = 'Self Hosted';
}else{
	$type = 'Enabled Code';
}
$thumbs = '<img src="'.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'" width="55" height="55" border="0" />';
echo '<tr>
		<td width="90px">'.$thumbs.'</td>
		<td width="750px">'.$row['name'].'</td>
		<td><a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$row['ID'].'&type='.$row['type'].'\'><img src="pages/admin/img/edit.png" width="24" height="24" alt="edit" title="Edit" border="0" /></a>
			<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row['name'].'?\')"><img src="pages/admin/img/delete.png" width="24" height="24" alt="delete" title="Delete" border="0" /></a>
		</td>
	</tr>';
}
echo '</tbody>
	</table>
</form>

<div class="page-box">'
.$totalres.' game(s) - Page '.$show.' of '.$totalpages;
$pre = $show - '1';
$ne = $show + '1';

$previous = ''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$CID.'&show='.$pre.'';
$next = ''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$CID.'&show='.$ne.'';

if ($totalpages > '1'){
	echo' - ';
	if ($show > '1'){
		echo '<a href="'.$previous.'" class="page">Previous</a>';
	}
	for($i = 1; $i <= $totalpages; $i++){
		if($show - $i < '4' || $totalpages - $i < '7'){
			if($i - $show < '4' || $i < '8'){

				$urk = ''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$CID.'&show='.$i.'';

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
echo'</div>';
}
function delete(){
global $domain, $db, $gamesfolder, $thumbsfolder, $directorypath;
$ID = abs((int) $_GET['ID']);

$query = mysql_query("select * FROM `fas_games` WHERE `ID`='$ID'");
$row = mysql_fetch_array($query);

if($row["type"] == "1")
{

$file = $row["file"];

$myFile = "$directorypath/$gamesfolder/$file";
unlink($myFile);
}

if($row["type"] == "1")
{

$thumb = $row["thumb"];

$myThumb = "$directorypath/$thumbsfolder/$thumb";
unlink($myThumb);
}

mysql_query(sprintf('DELETE FROM fas_games WHERE ID=\'%u\'', $ID));

echo '
		<div class=\'msg\'>Game Deleted <a href="javascript:void(0)" onclick="history.go(-1)"> Go Back</a></div>

';
}


function approve(){
$ID = abs((int) $_GET['ID']);
mysql_query(sprintf('update fas_games set active=\'1\' where  ID=\'%u\'', $ID));
echo '<div class=\'msg\'>Game Activated.
		<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}




function edit(){
global $domain, $db, $gamesfolder, $thumbsfolder;
$ID = abs((int) $_GET['ID']);
$r = $db->fetch_row($db->query(sprintf('SELECT * FROM fas_games WHERE ID=\'%u\'', $ID)));
if($_GET['type'] == 1){
if(isset($_POST['submit'])){

	if(isset($_POST['thumburl'])){
		$thumburl = clean($_POST['thumburl']);
	}else{
		$thumburl = NULL;
	}

	if(isset($_POST['enabledcode'])){
		$enabledcode = clean($_POST['enabledcode']);
	}else{
		$enabledcode = NULL;
	}

	$name = clean($_POST['name']);
	$desc = clean($_POST['desc']);
	$width = clean($_POST['width']);
	$height = clean($_POST['height']);
	$category = clean($_POST['category']);
	$active = clean($_POST['active']);
	$tags = clean($_POST['tags']);
	$sponsor = clean($_POST['sponsor']);
	$sponsornotes = clean($_POST['sponsornotes']);
	$sponsoractive = clean($_POST['sponsoractive']);
	$ads1 = clean($_POST['ads1']);
	$ads2 = clean($_POST['ads2']);
	$ads3 = clean($_POST['ads3']);
	$headerspace = clean($_POST['headerspace']);
	$footerspace = clean($_POST['footerspace']);
	$abovegames = clean($_POST['abovegames']);
	$belowgames = clean($_POST['belowgames']);

	if(!$name){
		echo 'No name entered.';
	}else{
	mysql_query("UPDATE fas_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						thumburl='$thumburl',
						enabledcode='$enabledcode',
						active='$active',
						tags='$tags',
 					    sponsor='$sponsor',
 					    sponsornotes='$sponsornotes',
 					    sponsoractive='$sponsoractive',
 				      	ads1='$ads1',
 				      	ads2='$ads2',
 			            ads3='$ads3',
 			       		headerspace='$headerspace',
 				      	footerspace='$footerspace',
 				      	abovegames='$abovegames',
 				      	belowgames='$belowgames' WHERE ID='$ID'");

	echo '<div class=\'error\'>Game updated.<br />

		<A href="#" onclick="history.go(-1)">Back</a></div>';
}
}else{
echo '<div class="heading">
	<h2>Editing Game: '.$r['name'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
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
				<td><select type=\'dropdown\' name=\'category\' >' ;
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
                  		if ($row['ID']==$r[category]) {
							echo '<option value=\''.$row['ID'].'\' selected>'.$row['name'].'</option>';
                  		} else {
							echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
						};
					}
					echo'</select>
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
				<td>Active:</td>
				<td><input type=\'text\' name=\'active\' value=\''.$r['active'].'\'></td>
			</tr>
			<tr>
				<td>Tags:</td>
				<td><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
			</tr>
                        <tr>
				<td>Sponsor:</td>
				<td><textarea name=\'sponsor\' rows=\'12\' cols=\'50\' >'.$r['sponsor'].'</textarea></td>
			</tr>
			</tr>
				<td>Sponsor Notes:
                                <br><small>Use this to keep track of when sponsorship expires for now, or other needed notes.</small></td>
				<td><textarea name=\'sponsornotes\' rows=\'12\' cols=\'50\' >'.$r['sponsornotes'].'</textarea></td>
			</tr>
			<tr>
				<td>Sponsorship Active:<br><small>0=No sponsor yet<br>1=Sponsor pending<br>2=Sponsor active</small></td>
				<td><input type=\'text\' name=\'sponsoractive\' value=\''.$r['sponsoractive'].'\'></td>
			</tr>
			</tr>
				<td>Ad One:</td>
				<td><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$r['ads1'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad Two:</td>
				<td><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$r['ads2'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad Three:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  where you want.</small></td>
				<td><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$r['ads3'].'</textarea></td>
			</tr>
			</tr>
				<td>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>
				<td><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$r['headerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Footer Space:</td>
				<td><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$r['footerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Above Games:</td>
				<td><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$r['abovegames'].'</textarea></td>
			</tr>
			</tr>
				<td>Below Games:</td>
				<td><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$r['belowgames'].'</textarea></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';
}
}else{

echo '<div class="heading">
	<h2>Editing Game: '.$r['name'].'</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Edit</th>
			</tr>
		</thead>
		<tbody>
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
				<td><select type=\'dropdown\' name=\'category\'>';
					$query = $db->query('SELECT * FROM fas_categories');
					while($row = $db->fetch_row($query)){
                  		if ($row['ID']==$r[category]) {
							echo '<option value=\''.$row['ID'].'\' selected>'.$row['name'].'</option>';
                  		} else {
							echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
						};
					}
					echo'</select>
				</td>
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
				<td>Thumb URL:*</td>
				<td><input type=\'text\' size=\'55\' name=\'thumburl\' value=\''.$r['thumburl'].'\'></td>
			</tr>
			<tr>
				<td>Code:*</td>
				<td><textarea name=\'enabledcode\' rows=\'12\' cols=\'50\' >'.$r['enabledcode'].'</textarea></td>
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
				<td>Sponsor:</td>
				<td><textarea name=\'sponsor\' rows=\'12\' cols=\'50\' >'.$r['sponsor'].'</textarea></td>
			</tr>
			</tr>
				<td>Sponsor Notes:
                  <br><small>Use this to keep track of when sponsorship expires for now, or other needed notes.</small></td>
				<td><textarea name=\'sponsornotes\' rows=\'12\' cols=\'50\' >'.$r['sponsornotes'].'</textarea></td>
			</tr>
			<tr>
				<td>Sponsorship Active:</td>
				<td><input type=\'text\' name=\'sponsoractive\' value=\''.$r['sponsoractive'].'\'></td>
			</tr>
			</tr>
				<td>Ad One:</td>
				<td><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$r['ads1'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad Two:</td>
				<td><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$r['ads2'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad Three:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  where you want.</small></td>
				<td><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$r['ads3'].'</textarea></td>
			</tr>
			</tr>
				<td>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>
				<td><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$r['headerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Footer Space:</td>
				<td><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$r['footerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Above Games:</td>
				<td><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$r['abovegames'].'</textarea></td>
			</tr>
			</tr>
				<td>Below Games:</td>
				<td><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$r['belowgames'].'</textarea></td>
			</tr>
			<tr>
				<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
			</tr>
		</tbody>
	</table>
</form>';



}
}
?>