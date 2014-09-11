<?php
$count = 0;

$r = $db->query('SELECT * FROM dd_categories');
echo '<table width=\'99%\' border=\'0\' align=\'center\'>';
while($row = $db->fetch_row($r)){

$categorynamev = $row['name'];
$categorynameu = ereg_replace('[^A-Za-z0-9]', '-', $categorynamev );

if($seo_on == 1){
		$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categorynameu.'.html';
		}else{
		$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
		    };


if($count%2==0){
       echo '<tr>
	      	<td width=\'50%\' valign=\'top\'>
	      	<table width=\'97%\' border=\'0\'>
	      		<tr>
	      			<td class=\'header\'>'.$row['name'].'</td>
	      		</tr>
	      		<tr>
	      			<td>';
	      	echo '<table>';
	      	$ir = $db->query(sprintf('SELECT * FROM dd_games WHERE category=\'%u\' and active=\'1\' ORDER BY rand() LIMIT 0,'.$limitboxgames.'', $row['ID']));
	      	while($row = $db->fetch_row($ir)){
	      	$gamename = ereg_replace('[^A-Za-z0-9]', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}
	      	echo '	<tr>
	      			<td width=\'45\' height=\'45\' valign=\'top\' class=\'content\'>
	      			<a href=\''.$playlink.'\'>
	      			';
				      		if($row['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$row['thumburl'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}
				      			
				      		echo '	
	      			</a>
	      			</td>
	      			<td valign=\'top\' class=\'content\'><div class=\'gamehometitle\'>'.$row['name'].'</div>
	      						<div class=\'gamehomedesc\'>'.desclimit($row['description']).'
	      						<a href=\''.$playlink.'\'>Play</a></div></td>
	      		</tr>';
	      	};	 


echo '<tr><td colspan=\'2\' class=\'content\'>';			      	
echo '<a href=\''.$categoryurl.'\'>Play more '.$categorynamev.' games</a>';
echo '</td></tr>';	





  	
	      echo '  </table>';		
	      			
	      		echo '	</td>
	      		</tr>
	      	</table>		
	      		</td>';
}else{
echo '
	      	<td width=\'50%\' valign=\'top\'>
	      	<table width=\'97%\' border=\'0\'>
	      		<tr>
	      			<td class=\'header\'>'.$row['name'].'</td>
	      		</tr>
	      		<tr>
	      			<td>';
	      			      	echo '<table>';
				      	$ir = $db->query(sprintf('SELECT * FROM dd_games WHERE category=\'%u\' and active=\'1\' ORDER BY rand() LIMIT 0,'.$limitboxgames.'', $row['ID']));
				      	while($row = $db->fetch_row($ir)){
				      	$gamename = ereg_replace('[^A-Za-z0-9]', '-', $row['name']);
				      	if($seo_on == 1){
				      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
				      	}else{
				      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
				      	}
				      	echo '	<tr>
				      			<td width=\'45\' height=\'45\' valign=\'top\' class=\'content\'>
				      			<a href=\''.$playlink.'\'>';
				      		if($row['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$row['thumburl'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
				      			</td>
				      			<td valign=\'top\' class=\'content\'><div class=\'gamehometitle\'>'.$row['name'].'</div>
				      						<div class=\'gamehomedesc\'>'.desclimit($row['description']).'
				      						<a href=\''.$playlink.'\'>Play</a></div></td>
				      		</tr>';
				      	};


echo '<tr><td colspan=\'2\' class=\'content\'>';			      	
echo '<a href=\''.$categoryurl.'\'>Play more '.$categorynamev.' games</a>';
echo '</td></tr>';	




	   	
				      echo '  </table>';	
	      			
	      		echo '	</td>
	      		</tr>
	      	</table>		
	      		</td>
	      	</tr>';
}
$count++;
}
echo "</table>";
$pgname = 'Your resource for fantastic games!';
?>