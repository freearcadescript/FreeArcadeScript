<?php

$pagetitle = $sitename;

function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;



$count = 0;

$baser2 = "SELECT * FROM dd_categories where active='1'";
$baser1 = sqlcache('mainpagecats', $cachelife, $baser2);


echo '<table width=\'99%\' border=\'0\' cellpadding=\'0\' cellspacing=\'0\'  align=\'center\'>';
foreach($baser1 as $row){

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
	      	<table width=\'100%\' border=\'0\'>
	      		<tr>
	      			<td class=\'header\' >'.$row['name'].'</td>
	      		</tr>
	      		<tr>
	      			<td>';
	      	echo '<table>';
                  $catid1=$row['ID'];
                  $sqltitle='mainpagecat'.$catid1 ;
	      	$baseir2 = "SELECT * FROM dd_games WHERE category='$catid1' and active='1' ORDER BY rand() LIMIT 0,".$limitboxgames ;
                  $baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);

	      	foreach($baseir1 as $row ){
	      	$gamename = ereg_replace('[^A-Za-z0-9]', '-', $row['name']);
	      	if($seo_on == 1){
	      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      	}else{
	      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      	}
	      	echo '	<tr>
	      			<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
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
	      			<td valign=\'top\' class=\'content\' width=\'310\'><div class=\'gamehometitle\'>'.$row['name'].'</div>
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
	      		</td> ';
}else{
echo '
	      	<td width=\'50%\' valign=\'top\'>
	      	<table width=\'100%\' border=\'0\'>
	      		<tr>
	      			<td class=\'header\'>'.$row['name'].'</td>
	      		</tr>
	      		<tr>
	      			<td>';
	      			      	echo '<table>';
                  $catid1=$row['ID'];
                  $sqltitle='mainpagecat'.$catid1 ;
	      	$baseir2 = "SELECT * FROM dd_games WHERE category='$catid1' and active='1' ORDER BY rand() LIMIT 0,".$limitboxgames ;
                  $baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);

	      	foreach($baseir1 as $row ){

				      	$gamename = ereg_replace('[^A-Za-z0-9]', '-', $row['name']);
				      	if($seo_on == 1){
				      		$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
				      	}else{
				      		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
				      	}
				      	echo '	<tr>
				      			<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
				      			<a href=\''.$playlink.'\'>';
				      		if($row['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$row['thumburl'].'\' width=\'45\' width=\'45\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
				      			</td>
				      			<td valign=\'top\' class=\'content\' width=\'310\'><div class=\'gamehometitle\'>'.$row['name'].'</div>
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


};
?>