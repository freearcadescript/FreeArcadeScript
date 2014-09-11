<?php


if(isset($_POST['submit'])){


	$bannersleft = $_POST['bannersleft'];
	$bannersright = $_POST['bannersright'];
	$ads1 = $_POST['ads1'];
	$ads2 = $_POST['ads2'];
	$ads3 = $_POST['ads3'];
	$headerspace = $_POST['headerspace'];
	$footerspace = $_POST['footerspace'];
	$abovegames = $_POST['abovegames'];
	$belowgames = $_POST['belowgames'];
	



	
	
 		mysql_query('UPDATE dd_settings SET 
 					bannersleft=\''.$bannersleft.'\',
 					bannersright=\''.$bannersright.'\',
 					ads1=\''.$ads1.'\',
 					ads2=\''.$ads2.'\',
 					ads3=\''.$ads3.'\',
 					headerspace=\''.$headerspace.'\',
 					footerspace=\''.$footerspace.'\',
 					abovegames=\''.$abovegames.'\',
 					belowgames=\''.$belowgames.'\'') or die(mysql_error());
		echo '<div class=\'msg\'>Updated.</div>';
		
		exit;
	
}
echo '<form action=\''.$domain.'/index.php?action=admin&case=ads\' method=\'POST\'>
	<table align=\'center\' cellpadding=\'5\'>
		<tr>
			<th class=\'header5\' colspan=\'2\'>Ads</th>
		</tr>


		</tr>
			<td class=\'content5\'>Left Side Banners:</td>	
			<td class=\'content5\'><textarea name=\'bannersleft\' rows=\'12\' cols=\'50\' >'.$set['bannersleft'].'</textarea></td>
		</tr>
		</tr>
			<td class=\'content5\'>Right Side Banners:</td>	
			<td class=\'content5\'><textarea name=\'bannersright\' rows=\'12\' cols=\'50\' >'.$set['bannersright'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 1:</td>	
			<td class=\'content5\'><textarea name=\'ads1\' rows=\'12\' cols=\'50\' >'.$set['ads1'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 2:</td>	
			<td class=\'content5\'><textarea name=\'ads2\' rows=\'12\' cols=\'50\' >'.$set['ads2'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Ads 3:<br><small>Does not show up anywhere. Extra ad code you may use to place
                  where you want.</small></td>	
			<td class=\'content5\'><textarea name=\'ads3\' rows=\'12\' cols=\'50\' >'.$set['ads3'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Header Space:<br><small>Turns off automaticaly if left empty.</small></td>	
			<td class=\'content5\'><textarea name=\'headerspace\' rows=\'12\' cols=\'50\' >'.$set['headerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Footer Space:</td>	
			<td class=\'content5\'><textarea name=\'footerspace\' rows=\'12\' cols=\'50\' >'.$set['footerspace'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Above Games:</td>	
			<td class=\'content5\'><textarea name=\'abovegames\' rows=\'12\' cols=\'50\' >'.$set['abovegames'].'</textarea></td>
		</tr>

		</tr>
			<td class=\'content5\'>Below Games:</td>	
			<td class=\'content5\'><textarea name=\'belowgames\' rows=\'12\' cols=\'50\' >'.$set['belowgames'].'</textarea></td>
		</tr>


	      <tr>
				<th colspan=\'2\' class=\'header5\'><input type=\'submit\' name=\'submit\' value=\'Change\'></th>
		</tr>
	</table>
	</form>		
';
?>