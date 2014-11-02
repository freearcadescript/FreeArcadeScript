<?php

function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $suserid, $log, $sup;


if($seo_on == 1){
	$log = ''.$domain.'/login/';
	$sup = ''.$domain.'/signup/';
}else{
	$log = ''.$domain.'/index.php?action=login';
	$sup = ''.$domain.'/index.php?action=signup';
}

	echo'<div class="header2">Submitting Game Info</div>
	<div class="content2" align="center">
	Got a game you think should be included in our site? Please fill in the form below to submit a game. You must be the developer or sponsor of the game you are submitting. We may reject games that are of low quality or that do not fit our site. All Games are reviewed before they are approved. Please allow up to 24 - 48hrs ... Thank you!
	</div>';

if(!isset($suserid)){
	echo'<div class="msg">Sorry, you have to be a <a href="'.$sup.'">Registered Member</a> or <a href="'.$log.'">Logged In</a> to Submit a Games.</div>';
} else {

	if(isset($_POST['submit'])){
		$time = time();
		$thumbspath = ''.$thumbsfolder.'/';
		$gamespath = ''.$gamesfolder.'/';
		$thumb = $_FILES['thumb']['name'];
		$game = $_FILES['game']['name'];
		$name = clean($_POST['name']);
		$desc= clean($_POST['desc']);
		$category = clean($_POST['category']);
		//$active = clean($_POST['active']);
		$tags = clean($_POST['tags']);
		$gameadder = $usrdata['userid'];
		$adderip = $_SERVER['REMOTE_ADDR'];

	    $check = "SELECT name FROM fas_games WHERE name='$name'" ;
	    $result = mysql_query($check) or die('error');
	    $row = mysql_fetch_assoc($result);

    	if(mysql_num_rows($result) > 0) {
    		$error = 1;
      		$msg = 'Sorry but a game with that name already exists';
    	}elseif(!$game || !$thumb || !$name || !$desc){
			$error = 1;
			$msg = 'Not all fields where filled in.';
		}elseif(!move_uploaded_file($_FILES['thumb']['tmp_name'],$thumbspath . $thumb)){
			$error = 1;
			$msg = 'Opps! It looks like you must have missed something!';
		}elseif(!move_uploaded_file($_FILES['game']['tmp_name'],$gamespath . $game)){
			$error = 1;
			$msg = 'Opps! It looks like you must have missed something!';
		}else{$error = NULL;}


		if($error == 1){
			echo '<div class=\'error\'>'.$msg.'</div>';
		}else{

	      $gamevar1 = $gamespath.$game;

	      $gamesize = getimagesize($gamevar1);
	      $width = $gamesize[0];
	      $height = $gamesize[1];


		echo '<div class=\'msg\'>Game Successfully Added!</div>';


		$type= 1;
		$db->query(sprintf('INSERT INTO fas_games SET
					name=\'%s\',
					description=\'%s\',
					file=\'%s\',
					width=\'%u\',
					height=\'%u\',
					category=\'%u\',
					thumb=\'%s\',
					dateadded=\'%u\',
					active=\'%u\',
					type=\'%u\',
					tags=\'%s\',
					gameadder=\'%u\',
					adderip=\'%s\'',
					$name, $desc, $game, $width, $height, $category, $thumb, $time, $active, $type, $tags, $gameadder, $adderip));
		}
	}

	echo'<div class="header2">Submit Game</div>
	<form action=\''.$domain.'/index.php?action=submit\' method=\'post\' enctype=\'multipart/form-data\'>
		<table width="100%">
				<tr>
					<td class="content">Name:*</td>
					<td class="content"><input type=\'text\' name=\'name\' size=\'40\'></td>
				</tr>
				<tr>
					<td class="content">Description:*</td>
					<td class="content"><textarea cols=\'40\' rows=\'5\' name=\'desc\'></textarea></td>
				</tr>
				<tr>
					<td class="content">Category:*</td>
					<td class="content"><select type=\'dropdown\' name=\'category\'>';
						$query = $db->query('SELECT * FROM fas_categories');
						while($row = $db->fetch_row($query)){
							echo '<option value=\''.$row['ID'].'\'>'.$row['name'].'</option>';
						}
						echo'</select>
					</td>
				</tr>
				<tr>
					<td class="content">Thumb File:*</td>
					<td class="content"><input type=\'file\' name=\'thumb\' size=\'35\'></td>
				</tr>
				<tr>
					<td class="content">SWF Game File:*</td>
					<td class="content"><input type=\'file\' name=\'game\' size=\'35\'></td>
				</tr>
				<tr>
					<td class="content">Tags:</td>
					<td class="content"><input type=\'text\' name=\'tags\' size=\'35\'></td>
				</tr>
				<tr>
					<td class=\'content\' align=\'center\' colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Game\'></td>
				</tr>

		</table>
	</form>';
}

}

$pagetitle = $sitename.' - Submit Games';
$metatags = 'submit games';
$metadescription = $sitename.' submit games';

?>


