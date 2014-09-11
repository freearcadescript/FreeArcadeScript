<?php
if ($email_on == "0") {$emsel = "selected=\"selected\"";}else{$emsel = NULL;};
if ($comments_on == "0") {$cesel = "selected=\"selected\"";}else{$cesel = NULL;};
if ($taf_on == "0") {$tafsel = "selected=\"selected\"";}else{$tafsel = NULL;};
if ($autoapprovecomments == "0" ) {$aasel = "selected=\"selected\"";}else{$aasel = NULL;};
if ($seo_on == "0") {$seoosel = "selected=\"selected\"";}else{$seoosel = NULL;};
if ($enabledcode_on == "0") {$ecsel = "selected=\"selected\"";}else{$ecsel = NULL;};
if ($showblog == "0") {$sbsel = "selected=\"selected\"";}else{$sbsel = NULL;};
if ($showpages == "0") {$spsel = "selected=\"selected\"";}else{$spsel = NULL;};
if ($blogcommentpermissions == "0" ) {$aabsel = "selected=\"selected\"";}else{$aabsel = NULL;};
if ($blogfollowtags == "external") {$btsel = "selected=\"selected\"";}else{$btsel = NULL;};


if(isset($_POST['submit'])){

	$ssitename = clean($_POST['sitename']);
	$sdomain = clean($_POST['domain']);
	$directorypath = clean($_POST['directorypath']);
	$stemplate = clean($_POST['template']);
	$sgamesfolder = clean($_POST['gamesfolder']);
	$sgamesthumbs = clean($_POST['thumbsfolder']);
	$slimitboxgames = clean($_POST['limitboxgames']);
	$sgamesonpage = clean($_POST['gamesonpage']);
	$semail_on = clean($_POST['email_on']);
	$scomments_on = clean($_POST['comments_on']);
	$staf_on = clean($_POST['taf_on']);
	$sautoapprovecomments = clean($_POST['autoapprovecomments']);
	$sseo_on = clean($_POST['seo_on']);
	$senabled_code = clean($_POST['enabled_code']);
	$showwebsitelimit = clean($_POST['showwebsitelimit']);
	$supportemail = clean($_POST['supportemail']);

	$showblog = clean($_POST['showblog']);
	$showpages = clean($_POST['showpages']);

	$blogentriesshown = clean($_POST['blogentriesshown']);
	$blogcharactersshown = clean($_POST['blogcharactersshown']);
	$blogcommentpermissions = clean($_POST['blogcommentpermissions']);
	$blogcommentsshown = clean($_POST['blogcommentsshown']);
	$blogfollowtags = clean($_POST['blogfollowtags']);
	$blogcharactersrss = clean($_POST['blogcharactersrss']);
	$metatags = clean($_POST['metatags']);
	$metadescr = clean($_POST['metadescr']);
	
	
	if(!$ssitename || !$domain || !$stemplate || !$sgamesfolder || !$sgamesthumbs || !$slimitboxgames || !$sgamesonpage){
		echo 'Not all of the fields where filled!';
		return;
	}
 		mysql_query('UPDATE fas_settings SET 
 					domain="'.$sdomain.'", 
 					directorypath="'.$directorypath.'",
 					template="'.$stemplate.'",
 					gamesfolder="'.$sgamesfolder.'",
 					thumbsfolder="'.$sgamesthumbs.'",
 					limitboxgames="'.$slimitboxgames.'",
 					gamesonpage="'.$sgamesonpage.'",
					email_on="'.$semail_on.'",
 					comments_on="'.$scomments_on.'",
 					taf_on="'.$staf_on.'",
 					autoapprovecomments="'.$sautoapprovecomments.'",
 					seo_on="'.$sseo_on.'",
 					sitename="'.$ssitename.'",
 					enabledcode_on="'.$senabled_code.'",
  					showwebsitelimit="'.$showwebsitelimit.'",
  					supportemail="'.$supportemail.'",
 					showblog="'.$showblog.'",
 					showpages="'.$showpages.'",
 					blogentriesshown="'.$blogentriesshown.'",
 					blogcharactersshown="'.$blogcharactersshown.'",
 					blogcommentpermissions="'.$blogcommentpermissions.'",
 					blogcommentsshown="'.$blogcommentsshown.'",
 					blogfollowtags="'.$blogfollowtags.'",
  					blogcharactersrss="'.$blogcharactersrss.'",
 					metatags="'.$metatags.'",
 					metadescr="'.$metadescr.'" ') or die(mysql_error());
		echo '<div class="msg">Updated.</div>';
		return;	
}
echo '
<div class="heading">
	<h2>Settings</h2>
</div>
<br clear="all">
<form action="'.$domain.'/index.php?action=admin&case=settings" method="post">
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Manage Settings</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Site Name:</td>	
				<td><input type="text" name="sitename" size="40" value="'.$set['sitename'].'" /></td>
			</tr>
			<tr>
				<td>Domain:</td>	
				<td><input type="text" name="domain" size="40" value="'.$set['domain'].'" /></td>
			</tr>
			<tr>
				<td>Directory Path:</td>	
				<td><input type="text" name="directorypath" size="40" value="'.$set['directorypath'].'" /></td>
			</tr>
			<tr>
				<td>Support E-mail:</td>	
				<td><input type="text" name="supportemail" size="40" value="'.$set['supportemail'].'" /></td>
			</tr>
			<tr>
				<td>Template:</td>	
				<td><input type="text" name="template" size="40" value="'.$set['template'].'" /></td>
			</tr>
			<tr>
				<td>Games Folder:<br /><small>
					Make sure you chmod the folder to 0777
					</small></td>	
				<td><input type="text" name="gamesfolder" size="40" value="'.$set['gamesfolder'].'" /></td>
			</tr>
			<tr>
				<td>Thumbs Folder:<br /><small>
					Make sure you chmod the folder to 0777
					</small></td>	
				<td><input type="text" name="thumbsfolder" size="40" value="'.$set['thumbsfolder'].'" /></td>
			</tr>
			<tr>
				<td>Games On Home:<br /><small>
					How many games in each category do you want to be displayed in each box on the homepage?
					</small></td>	
				<td><input type="text" name="limitboxgames" size="40" value="'.$set['limitboxgames'].'" /></td>
			</tr>
			<tr>
				<td>Games in category per page:</td>	
				<td><input type="text" name="gamesonpage" size="40" value="'.$set['gamesonpage'].'" /></td>
			</tr>
			<tr>
				<td>Require Email Activation:</td>	
				<td><select name="email_on">
								<option value="1">Yes</option>
								<option value="0" '.$emsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Comments Enabled:</td>	
				<td><select name="comments_on">
								<option value="1">Yes</option>
								<option value="0" '.$cesel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Tell a Friend Enabled:</td>	
				<td><select name="taf_on">
								<option value="1">Yes</option>
								<option value="0" '.$tafsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Auto Approve Comments:</td>	
				<td><select name="autoapprovecomments">
								<option value="1">Yes</option>
								<option value="0" '.$aasel.'>No</option>
							</select></td>
			</tr>
			<tr>
					<td>SEO On:</td>	
					<td><select name="seo_on">
								<option value="1">Yes</option>
								<option value="0" '.$seoosel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Allow Enabled Code:</td>	
				<td><select name="enabled_code">
								<option value="1">Yes</option>
								<option value="0" '.$ecsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Show website after:<br /><small>
					How many games must a member play before their website is displayed on their profile?
					</small></td>	
				<td><input type="text" name="showwebsitelimit" size="40" value="'.$set['showwebsitelimit'].'" /></td>
			</tr>
			<tr>
				<td>Default Meta Keywords:</td>	
				<td><input type="text" name="metatags" size="40" value="'.$set['metatags'].'" /></td>
			</tr>
			<tr>
				<td>Default Meta Description:</td>		
				<td><input type="text" name="metadescr" size="40" value="'.$set['metadescr'].'" /></td>
			</tr>
			<tr>
				<td>Show Blog?:</td>	
				<td><select name="showblog">
								<option value="1">Yes</option>
								<option value="0" '.$sbsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Show Pages?:</td>	
				<td><select name="showpages">
								<option value="1">Yes</option>
								<option value="0" '.$spsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Number of Blog Entries to show:</td>	
				<td><input type="text" name="blogentriesshown" size="2" value="'.$set['blogentriesshown'].'" /></td>
			</tr>
			<tr>
				<td>Number of Blog Entries Characters to Show:</td>	
				<td><input type="text" name="blogcharactersshown" size="4" value="'.$set['blogcharactersshown'].'" /></td>
			</tr>
			<tr>
				<td>Auto Approve Blog Comment:</td>	
				<td><select name="blogcommentpermissions">
								<option value="1">Yes</option>
								<option value="0" '.$aabsel.'>No</option>
							</select></td>
			</tr>
			<tr>
				<td>Number of Blog Comments to Show:</td>	
				<td><input type="text" name="blogcommentsshown" size="2" value="'.$set['blogcommentsshown'].'" /></td>
			</tr>
			<tr>
				<td>Follow Tags on Blog Comments:</td>	
				<td><select name="blogfollowtags">
								<option value="nofollow">nofollow</option>
								<option value="external" '.$btsel.'>external</option>
							</select></td>
			</tr>
			<tr>
				<td>Blog Entry Characters in RSS:</td>		
				<td><input type="text" name="blogcharactersrss" size="40" value="'.$set['blogcharactersrss'].'" /></td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Change" /></td>
			</tr>
		</tbody>
	</table>
</form>';
?>