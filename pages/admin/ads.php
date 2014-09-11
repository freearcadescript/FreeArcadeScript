<?php
if(isset($_POST['submit'])){


	$bannersleft = mysql_real_escape_string($_POST['bannersleft']);
	$bannersright = mysql_real_escape_string($_POST['bannersright']);
	$ads1 = mysql_real_escape_string($_POST['ads1']);
	$ads2 = mysql_real_escape_string($_POST['ads2']);
	$ads3 = mysql_real_escape_string($_POST['ads3']);
	$headerspace = mysql_real_escape_string($_POST['headerspace']);
	$footerspace = mysql_real_escape_string($_POST['footerspace']);
	$abovegames = mysql_real_escape_string($_POST['abovegames']);
	$belowgames = mysql_real_escape_string($_POST['belowgames']);
	$analytics = mysql_real_escape_string($_POST['analytics']);
	



	
	
 		mysql_query('UPDATE fas_settings SET 
 					bannersleft=\''.$bannersleft.'\',
 					bannersright=\''.$bannersright.'\',
 					ads1=\''.$ads1.'\',
 					ads2=\''.$ads2.'\',
 					ads3=\''.$ads3.'\',
 					headerspace=\''.$headerspace.'\',
 					footerspace=\''.$footerspace.'\',
 					abovegames=\''.$abovegames.'\',
 					belowgames=\''.$belowgames.'\',
 					analytics=\''.$analytics.'\'') or die(mysql_error());
		echo '<div class=\'msg\'>Updated.</div>';
		
		return;
	
}
echo '
<div class="heading">
	<h2>Advertising</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=ads\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Manage Ads</th>
			</tr>
		</thead>
		<tbody>	
			</tr>
				<td>Left Banner:</td>	
				<td><textarea name=\'bannersleft\' rows=\'12\' cols=\'50\' >'.$set['bannersleft'].'</textarea></td>
			</tr>
			</tr>
				<td>Right Banner:</td>	
				<td><textarea name=\'bannersright\' rows=\'12\' cols=\'50\' >'.$set['bannersright'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad one:</td>	
				<td><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$set['ads1'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad two:</td>	
				<td><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$set['ads2'].'</textarea></td>
			</tr>
			</tr>
				<td>Ad three:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  	where you want.</small></td>	
				<td><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$set['ads3'].'</textarea></td>
			</tr>
			</tr>
				<td>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>	
				<td><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$set['headerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Footer Space:</td>	
				<td><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$set['footerspace'].'</textarea></td>
			</tr>
			</tr>
				<td>Above Games:</td>	
				<td><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$set['abovegames'].'</textarea></td>
			</tr>
			</tr>
				<td>Below Games:</td>	
				<td><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$set['belowgames'].'</textarea></td>
			</tr>
			</tr>
				<td>Google Analytics Code:</td>	
				<td><textarea name=\'analytics\' rows=\'12\' cols=\'50\' >'.$set['analytics'].'</textarea></td>
			</tr>
	    	<tr>
				<td colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Change\'></td>
			</tr>
		</tbody>
	</table>
</form>';
?>