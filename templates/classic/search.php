<?php


function writebody() {
global $db, $domain, $sitename, $domain, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;




if(isset($_POST['keyword'])){
$keyword = mysql_real_escape_String($_POST['keyword']);
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
	echo '<form action=\''.$su.'\' method=\'POST\'>
	<table align=\'center\'>
			<tr>
				<td>Keyword(s):</td>
				<td><input type=\'text\' name=\'keyword\' size=\'45\' value=\''.$keyword.'\'></td>
			</tr>
			<tr>
				<td colspan=\'2\' align=\'center\'><input type=\'submit\' name=\'submit\' value=\'Search\'></td>
			</tr>
		</table>
		</form>	';
$r = mysql_query("SELECT * FROM dd_games WHERE name LIKE '%$keyword%'") or die(mysql_error()); 
echo '<table width=\'100%\' border=\'0\' align=\'center\'>
	<tr>
		<td colspan=\'2\' class=\'header\'>Search Games - '.$keyword.'</td>
	</tr>';
$count = 0;
while($in = $db->fetch_row($r)){
$gamename = ereg_replace('[^A-Za-z0-9]', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}

if($count%2==0){
       echo '<tr>
	      	<td width=\'50%\' valign=\'top\'>
	      	
	      		<table width=\'100%\' border=\'0\'>
	      			<tr>
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.$in['name'].'</b></td>
	      			</tr>
	      			<tr>	
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.browsedesclimit($in['description']).' 
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>
	      		</table>
	      			
	      	</td>
	';
}else{
 echo '
	      	<td width=\'50%\' valign=\'top\'>
	      	
	      		<table width=\'100%\' border=\'0\'>
	      			<tr>
	      				<td valign=\'top\' colspan=\'2\' class=\'header\'><b>'.$in['name'].'</b></td>
	      			</tr>
	      			<tr>	
	      				<td width=\'55\' height=\'55\' valign=\'top\' class=\'content\'>
	      				<a href=\''.$playlink.'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'55\' width=\'55\' border=\'0\'>';
				      		}
				      			
				      		echo '	</a>
	      				</td>
	      				<td valign=\'top\' class=\'content\'>'.browsedesclimit($in['description']).' 
	      				<a href=\''.$playlink.'\' class=\'playlink\'><b>Play</b></a></td>
	      			</tr>
	      		</table>
	      			
	      	</td>
	</tr>';
}
$count++;
}

echo "</table>";
}else{
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
	echo '<form action=\''.$su.'\' method=\'POST\'>

	<table align=\'center\'>
	<tr>
		<td colspan=\'4\' class=\'header\'>Search</td>
	</tr>

			<tr>
				<td class=\'header\'>Keyword(s):</td>
				<td class=\'content\'><input type=\'text\' name=\'keyword\' size=\'45\'></td>
			</tr>
			<tr>
				<td colspan=\'2\' align=\'center\' class=\'content\'><input type=\'submit\' name=\'submit\' value=\'Search\'></td>
			</tr>
		</table>
		</form>	';
}




};
?>