<?php




$gamet = clean($_GET['gameid']);

		echo '<table width=\'100%\' ><tr><td class=\'content5\' align=\'center\'><div align=\'center\'><object width=\'500\' height=\'500\' align=\'center\'>
				<param name=\'movie\' value=\''.$domain.'/'.$gamesfolder.'/'.$gamet.'\'>
				<embed src=\''.$domain.'/'.$gamesfolder.'/'.$gamet.'\' width=\'500\' height=\'500\'></embed>
			</object></div></td></tr></table>';




?>