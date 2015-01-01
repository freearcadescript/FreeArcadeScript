<?php
if(isset($_POST['submit'])){

	$socialmedia1 = mysql_real_escape_string($_POST['socialmedia1']);
	$socialmedia2 = mysql_real_escape_string($_POST['socialmedia2']);
	$socialmedia3 = mysql_real_escape_string($_POST['socialmedia3']);
	$socialmedia4 = mysql_real_escape_string($_POST['socialmedia4']);
	$socialmedia5 = mysql_real_escape_string($_POST['socialmedia5']);
	$socialmedia6 = mysql_real_escape_string($_POST['socialmedia6']);
	$socialmedia7 = mysql_real_escape_string($_POST['socialmedia7']);
	$socialmedia8 = mysql_real_escape_string($_POST['socialmedia8']);
	$socialmedia9 = mysql_real_escape_string($_POST['socialmedia9']);
	$socialmedia10 = mysql_real_escape_string($_POST['socialmedia10']);
	$facebookappid = mysql_real_escape_string($_POST['facebookappid']);



 		mysql_query('UPDATE fas_settings SET
 					socialmedia1=\''.$socialmedia1.'\',
 					socialmedia2=\''.$socialmedia2.'\',
 					socialmedia3=\''.$socialmedia3.'\',
 					socialmedia4=\''.$socialmedia4.'\',
 					socialmedia5=\''.$socialmedia5.'\',
 					socialmedia6=\''.$socialmedia6.'\',
 					socialmedia7=\''.$socialmedia7.'\',
 					socialmedia8=\''.$socialmedia8.'\',
 					socialmedia9=\''.$socialmedia9.'\',
 					socialmedia10=\''.$socialmedia10.'\',
 					facebookappid=\''.$facebookappid.'\'') or die(mysql_error());
		echo '<div class=\'msg\'>Updated.</div>';

		return;

}
echo '
<div class="heading">
	<h2>Social Media</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=socialmedia\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Manage Social Media: <small>Turns off automaticaly if left empty.</small></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>FaceBook:</td>
				<td><textarea name=\'socialmedia1\' rows=\'1\' cols=\'100\' >'.$set['socialmedia1'].'</textarea></td>
			</tr>
			<tr>
				<td>Twitter:</td>
				<td><textarea name=\'socialmedia2\' rows=\'1\' cols=\'100\' >'.$set['socialmedia2'].'</textarea></td>
			</tr>
			<tr>
				<td>Google Plus:</td>
				<td><textarea name=\'socialmedia3\' rows=\'1\' cols=\'100\' >'.$set['socialmedia3'].'</textarea></td>
			</tr>
			<tr>
				<td>LinkedIn:</td>
				<td><textarea name=\'socialmedia4\' rows=\'1\' cols=\'100\' >'.$set['socialmedia4'].'</textarea></td>
			</tr>
			<tr>
				<td>Pinterest:</td>
				<td><textarea name=\'socialmedia5\' rows=\'1\' cols=\'100\' >'.$set['socialmedia5'].'</textarea></td>
			</tr>
			<tr>
				<td>You Tube:</td>
				<td><textarea name=\'socialmedia6\' rows=\'1\' cols=\'100\' >'.$set['socialmedia6'].'</textarea></td>
			</tr>
			<tr>
				<td>MySpace:</td>
				<td><textarea name=\'socialmedia7\' rows=\'1\' cols=\'100\' >'.$set['socialmedia7'].'</textarea></td>
			</tr>
			<tr>
				<td>StumbleUpon :</td>
				<td><textarea name=\'socialmedia8\' rows=\'1\' cols=\'100\' >'.$set['socialmedia8'].'</textarea></td>
			</tr>
			<tr>
				<td>Digg:</td>
				<td><textarea name=\'socialmedia9\' rows=\'1\' cols=\'100\' >'.$set['socialmedia9'].'</textarea></td>
			</tr>
			<tr>
				<td>Other:</td>
				<td><textarea name=\'socialmedia10\' rows=\'1\' cols=\'100\' >'.$set['socialmedia10'].'</textarea></td>
			</tr>
			<tr>
				<td>Facebook App:</td>
				<td><textarea name=\'facebookappid\' rows=\'4\' cols=\'100\' >'.$set['facebookappid'].'</textarea></td>
			</tr>
	         	<tr>
				<td colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Change\'></td>
			</tr>
		</tbody>
	</table>
</form>';
?>