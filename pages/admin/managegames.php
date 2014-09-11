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

	case 'approve':
	approve();
	break;	
}
function cats(){
global $domain, $thumbsfolder, $gamesfolder;
$rr = mysql_query(sprintf('SELECT * FROM dd_categories'));
$count = 0;
echo '<div class=\'pgtitle\'>Choose Category to manage</div><table align=\'center\'>';
while($row = mysql_fetch_array($rr)){
if($count%3==0){
       echo '<tr>
	      	<td class=\'content5\' width=\'30%\' valign=\'top\'>
	      	<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
	      	</td>
	      	';
     }
else if($count%3==1){
       echo '<td class=\'content5\' width=\'30%\' valign=\'top\'>
       		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
       		</td>';
     }     
     else{
       echo '	<td class=\'content5\' width=\'30%\' valign=\'top\'>
       		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$row['ID'].'\'>'.$row['name'].'</a>
       		</td>
	      </tr>';
     }
     $count++;
   }


echo '<tr><td colspan=\'3\'><hr></td></tr>
<tr><td colspan=\'3\' class=\'header5\'>Inactive Games</td></tr>
<tr><td colspan=\'3\'><table width=\'100%\'>

';



$sql = mysql_query(sprintf('SELECT * FROM dd_games WHERE active=\'0\' ', $CID)) or die(mysql_error());


while($row = mysql_fetch_row($sql)){
if($row[9] == 1){
	$type = 'Self Hosted';
}else{
	$type = 'Enabled Code';
}
$thumbs = '<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row[7].'\' width=\'55\' width=\'55\' border=\'0\'>';
$descriptions = $row[2];

$urls = '<a href=\''.$domain.'/index.php?action=admin&case=testgame&gameid='.$row[3].'\' target=\'_blank\'>Test</a>';
if ($row[9] == '1') {$dlurl1='<p><a href=\''.$domain.'/'.$gamesfolder.'/'.$row[3].'\'>Download</a>';}
echo '<tr>
		<td class=\'content5\' align=\'center\'>'.$row[1].'<br>'.$thumbs.'<p>'.$descriptions.'<p>'.$urls.'</td>
		<td class=\'content5\' align=\'center\'>'.$type.'</td>
		<td class=\'content5\' width=\'79\' align=\'center\'>
		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$row[0].'&type='.$row[9].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' alt=\'edit game\'  border=\'0\'></a>
		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=delete&ID='.$row[0].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row['name'].'?\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' alt=\'delete game\'  border=\'0\'></a>
		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=approve&ID='.$row[0].'\'  ><img src=\''.$domain.'/templates/default/images/approve.png\' alt=\'activate game\'  border=\'0\'></a>
		<a href=\''.$domain.'/index.php?action=admin&case=testgame&gameid='.$row[3].'\' target=\'_blank\'><img src=\''.$domain.'/templates/default/images/test.png\' alt=\'test game\' border=\'0\'></a>
            '.$dlurl1.'
		</td>
	</tr>';
};



 echo '</table>  </td></tr>';
	echo "</table>";

}
function games(){
global $domain, $db;
$CID = abs((int) $_GET['CID']);

$max = 5;
$show = $_GET['show'];
if(empty($show)){
	$show = 1;
}
$limits = ($show - 1) * $max; 
$sql = $db->query(sprintf('SELECT * FROM dd_games WHERE category=\'%u\' LIMIT '.$limits.','.$max.' ', $CID)) or die(mysql_error());
$totalres = mysql_result($db->query(sprintf('SELECT COUNT(ID) AS total FROM dd_games WHERE category=\'%u\'', $CID)),0);	
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
		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$row['ID'].'&type='.$row['type'].'\'><img src=\''.$domain.'/templates/default/images/editbtn.png\' border=\'0\'></a>
		<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=delete&ID='.$row['ID'].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row['name'].'?\')"><img src=\''.$domain.'/templates/default/images/deletebtn.png\' border=\'0\'></a>
		
		</td>
	</tr>';
}
echo '
</table></form>Pages: ';
for($i = 1; $i <= $totalpages; $i++){ 

echo '<a href=\''.$domain.'/index.php?action=admin&case=managegames&cmd=games&CID='.$CID.'&show='.$i.'\'>'.$i.'</a> ';

}
}
function delete(){
$ID = abs((int) $_GET['ID']);
mysql_query(sprintf('DELETE FROM dd_games WHERE ID=\'%u\'', $ID));
echo '<div class=\'msg\'>Game Deleted.
		<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}


function approve(){
$ID = abs((int) $_GET['ID']);
mysql_query(sprintf('update dd_games set active=\'1\' where  ID=\'%u\'', $ID));
echo '<div class=\'msg\'>Game Activated.
		<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}




function edit(){
global $domain, $db, $gamesfolder, $thumbsfolder;
$ID = abs((int) $_GET['ID']);
$r = $db->fetch_row($db->query(sprintf('SELECT * FROM dd_games WHERE ID=\'%u\'', $ID)));
if($_GET['type'] == 1){
if($_POST['submit']){

	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$category = $_POST['category'];
	$active = $_POST['active'];
	$tags = $_POST['tags'];
	$highscore = $_POST['highscore'];
	$highscoreable = $_POST['highscoreable'];
	$highscoreuser = $_POST['highscoreuser'];
	$highscoredate = $_POST['highscoredate'];
	$highscoreip = $_POST['highscoreip'];
	$sponsor = $_POST['sponsor'];
	$sponsornotes = $_POST['sponsornotes'];
	$sponsoractive = $_POST['sponsoractive'];
	$ads1 = $_POST['ads1'];
	$ads2 = $_POST['ads2'];
	$ads3 = $_POST['ads3'];
	$headerspace = $_POST['headerspace'];
	$footerspace = $_POST['footerspace'];
	$abovegames = $_POST['abovegames'];
	$belowgames = $_POST['belowgames'];
	

	if(!$name){
		echo 'No name entered.';
	}else{
	mysql_query("UPDATE dd_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category', 
						active='$active', 
						tags='$tags',
						highscore='$highscore',
						highscoreable='$highscoreable',
						highscoreuser='$highscoreuser',
						highscoredate='$highscoredate', 
						highscoreip='$highscoreip',
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

		<A href="#" onclick="history.go(-1)">Back</a></div></div>';		
}
}else{
echo '<form action=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'POST\'>
	<table align=\'center\'>
		<tr>
			<td class=\'content5\'>Name:*</td>
			<td class=\'content5\'><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
		</tr>
		<tr>
			<td class=\'content5\'>Description:*</td>
			<td class=\'content5\'><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
		</tr>
		<tr>
			<td class=\'content5\'>Width:*</td>
			<td class=\'content5\'><input type=\'text\' name=\'width\' value=\''.$r['width'].'\'></td>
		</tr>
		<tr>
			<td class=\'content5\'>Height:*</td>
			<td class=\'content5\'><input type=\'text\' name=\'height\' value=\''.$r['height'].'\'></td>
		</tr>
		<tr>
			<td class=\'content5\'>Category:*</td>
			<td class=\'content5\'>
			<select type=\'dropdown\' name=\'category\' >' ;
             
		$query = $db->query('SELECT * FROM dd_categories');
		while($row = $db->fetch_row($query)){
                  if ($row['ID']==$r[category]) {

			echo '<option value=\''.$row['ID'].'\' selected>'.$row['name'].'</option>';
                  } else {

			echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>'; };
		}	
		echo '	
			</select>
		</td>
			
		</tr>
		<tr>
			<td class=\'content5\'>Thumb File:*</td>
			<td class=\'content5\'>'.$thumbsfolder.'/'.$r['thumb'].'</td>
		</tr>
		<tr>
			<td class=\'content5\'>SWF Game File:*</td>
			<td class=\'content5\'>'.$gamesfolder.'/'.$r['file'].'</td>
		</tr>



		<tr>
			<td class=\'content5\'>Active:</td>
			<td class=\'content5\'><input type=\'text\' name=\'active\' value=\''.$r['active'].'\'></td>
		</tr>

		<tr>
			<td class=\'content5\'>Tags:</td>
			<td class=\'content5\'><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Highscore:</td>
			<td class=\'content5\'><input type=\'text\' name=\'highscore\' value=\''.$r['highscore'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Highscore Capable:<br><small></td>
			<td class=\'content5\'><input type=\'text\' name=\'highscoreable\' value=\''.$r['highscoreable'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Highscore User:</td>
			<td class=\'content5\'><input type=\'text\' name=\'highscoreuser\' value=\''.$r['highscoreuser'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Highscore Date:</td>
			<td class=\'content5\'><input type=\'text\' name=\'highscoredate\' value=\''.$r['highscoredate'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Highscore IP:</td>
			<td class=\'content5\'><input type=\'text\' name=\'highscoreip\' value=\''.$r['highscoreip'].'\'></td>
		</tr>



		</tr>
			<td class=\'content5\'>Sponsor:</td>	
			<td class=\'content5\'><textarea name=\'sponsor\' rows=\'12\' cols=\'50\' >'.$r['sponsor'].'</textarea></td>
		</tr>
		</tr>
			<td class=\'content5\'>Sponsor Notes:
                  <br><small>Use this to keep track of when sponsorship expires for now, or other needed notes.</small></td>	
			<td class=\'content5\'><textarea name=\'sponsornotes\' rows=\'12\' cols=\'50\' >'.$r['sponsornotes'].'</textarea></td>
		</tr>
		<tr>
			<td class=\'content5\'>Sponsorship Active:<br><small>0=No sponsor yet<br>1=Sponsor pending<br>2=Sponsor active</small></td>
			<td class=\'content5\'><input type=\'text\' name=\'sponsoractive\' value=\''.$r['sponsoractive'].'\'></td>
		</tr>





		</tr>
			<td class=\'content5\'>Ads 1:</td>	
			<td class=\'content5\'><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$r['ads1'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 2:</td>	
			<td class=\'content5\'><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$r['ads2'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 3:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  where you want.</small></td>	
			<td class=\'content5\'><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$r['ads3'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>	
			<td class=\'content5\'><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$r['headerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Footer Space:</td>	
			<td class=\'content5\'><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$r['footerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Above Games:</td>	
			<td class=\'content5\'><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$r['abovegames'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Below Games:</td>	
			<td class=\'content5\'><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$r['belowgames'].'</textarea></td>
		</tr>





		<tr>
			<td align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Edit Game\'></td>
		</tr>
	</table>		
	</form>';
}
}else{

if(isset($_POST['submit'])){
	$thumburl = $_POST['thumburl'];
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$category = $_POST['category'];
	$active = $_POST['active'];
	$enabledcode = $_POST['enabledcode'];
	$tags = $_POST['tags'];
	$sponsor = $_POST['sponsor'];
	$sponsornotes = $_POST['sponsornotes'];
	$sponsoractive = $_POST['sponsoractive'];
	$ads1 = $_POST['ads1'];
	$ads2 = $_POST['ads2'];
	$ads3 = $_POST['ads3'];
	$headerspace = $_POST['headerspace'];
	$footerspace = $_POST['footerspace'];
	$abovegames = $_POST['abovegames'];
	$belowgames = $_POST['belowgames'];

	

	mysql_query("UPDATE dd_games SET name='$name',
						description='$desc',
						width='$width',
						height='$height',
						category='$category',
						thumburl='$thumburl',
						enabledcode='$enabledcode' 
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
 				      	belowgames='$belowgames'  WHERE ID='$ID'"); 

}else{
echo '<form action=\''.$domain.'/index.php?action=admin&case=managegames&cmd=edit&ID='.$ID.'&type=1\' method=\'POST\'>
	<table align=\'center\'>
		<tr>
			<td class=\'content5\'>Name:*</td>
			<td class=\'content5\'><input type=\'text\' name=\'name\' size=\'40\' value=\''.$r['name'].'\'></td>
		</tr>
		<tr>
			<td class=\'content5\'>Description:*</td>
			<td class=\'content5\'><textarea cols=\'40\' rows=\'5\' name=\'desc\'>'.$r['description'].'</textarea></td>
		</tr>
		<tr>
			<td class=\'content5\'>Category:*</td>
			<td class=\'content5\'>
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
			<td class=\'content5\'>Thumb URL:*</td>
			<td class=\'content5\'><input type=\'text\' size=\'55\' name=\'thumburl\' value=\''.$r['thumburl'].'\'></td>
		</tr>
		<tr>
			<td class=\'content5\'>Code:*</td>
			<td class=\'content5\'><textarea cols=\'45\' rows=\'6\' name=\'enabledcode\'>'.$r['enabledcode'].'</textarea></td>
		</tr>

		<tr>
			<td class=\'content5\'>Active:</td>
			<td class=\'content5\'><input type=\'text\' name=\'active\' value=\''.$r['active'].'\'></td>
		</tr>


		<tr>
			<td class=\'content5\'>Tags:</td>
			<td class=\'content5\'><input type=\'text\' name=\'tags\' value=\''.$r['tags'].'\'></td>
		</tr>


		</tr>
			<td class=\'content5\'>Sponsor:</td>	
			<td class=\'content5\'><textarea name=\'sponsor\' rows=\'12\' cols=\'50\' >'.$r['sponsor'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Sponsor Notes:
                  <br><small>Use this to keep track of when sponsorship expires for now, or other needed notes.</small></td>	
			<td class=\'content5\'><textarea name=\'sponsornotes\' rows=\'12\' cols=\'50\' >'.$r['sponsornotes'].'</textarea></td>
		</tr>

		<tr>
			<td class=\'content5\'>Sponsorship Active:</td>
			<td class=\'content5\'><input type=\'text\' name=\'sponsoractive\' value=\''.$r['sponsoractive'].'\'></td>
		</tr>



		</tr>
			<td class=\'content5\'>Ads 1:</td>	
			<td class=\'content5\'><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$r['ads1'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 2:</td>	
			<td class=\'content5\'><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$r['ads2'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 3:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  where you want.</small></td>	
			<td class=\'content5\'><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$r['ads3'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>	
			<td class=\'content5\'><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$r['headerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Footer Space:</td>	
			<td class=\'content5\'><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$r['footerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Above Games:</td>	
			<td class=\'content5\'><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$r['abovegames'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Below Games:</td>	
			<td class=\'content5\'><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$r['belowgames'].'</textarea></td>
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