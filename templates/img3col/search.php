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
	</tr>
	<tr>
		<td colspan=\'2\' class=\'content\'><div align=\'center\'>';
$count = 0;
while($in = $db->fetch_row($r)){
$gamename = ereg_replace('[^A-Za-z0-9]', '-', $in['name']);
	if($seo_on == 1){
		$playlink = ''.$domain.'/play/'.$in['ID'].'-'.$gamename.'.html';
	}else{
		$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$in['ID'].'';
	}
       




       echo '
	      	
	      		
	      				<a href=\''.$playlink.'\' title=\''.$in['name'].'\'>
	      				';
				      		if($in['type'] == 1){	
				      		echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$in['thumb'].'\' width=\'80\' width=\'80\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}else{
				      		echo '	<img src=\''.$in['thumburl'].'\' width=\'80\' width=\'80\' border=\'0\' alt=\''.$in['name'].'\'>';
				      		}
				      			
				      		echo '	</a>';







 




$count++;
}

echo "</div></td></tr></table>";
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