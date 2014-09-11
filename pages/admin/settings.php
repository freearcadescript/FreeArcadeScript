<?php

if ( $comments_on == "0" ) { $cesel = "selected" ; } ;
if ( $autoapprovecomments == "0" ) { $aasel = "selected" ; };
if ( $seo_on == "0" ) { $seoosel = "selected" ; };
if ( $enabledcode_on == "0" ) { $ecsel = "selected" ; };
if ( $showblog == "0" ) { $sbsel = "selected" ; };




if(isset($_POST['submit'])){

	$ssitename = $_POST['sitename'];
	$sdomain = $_POST['domain'];
	$directorypath = $_POST['directorypath'];
	$stemplate = $_POST['template'];
	$sgamesfolder = $_POST['gamesfolder'];
	$sgamesthumbs = $_POST['thumbsfolder'];
	$slimitboxgames = $_POST['limitboxgames'];
	$sgamesonpage = $_POST['gamesonpage'];
	$scomments_on = $_POST['comments_on'];
	$sautoapprovecomments = $_POST['autoapprovecomments'];
	$sseo_on = $_POST['seo_on'];
	$senabled_code = $_POST['enabled_code'];
	$bannersleft = $_POST['bannersleft'];
	$bannersright = $_POST['bannersright'];
	$ads1 = $_POST['ads1'];
	$ads2 = $_POST['ads2'];
	$ads3 = $_POST['ads3'];
	$headerspace = $_POST['headerspace'];
	$footerspace = $_POST['footerspace'];
	$abovegames = $_POST['abovegames'];
	$belowgames = $_POST['belowgames'];
	$showwebsitelimit = $_POST['showwebsitelimit'];
	$supportemail = $_POST['supportemail'];

	$showblog = $_POST['showblog'];
	$blogentriesshown = $_POST['blogentriesshown'];
	$blogcharactersshown = $_POST['blogcharactersshown'];
	$blogcommentpermissions = $_POST['blogcommentpermissions'];
	$blogcommentsshown = $_POST['blogcommentsshown'];
	$blogfollowtags = $_POST['blogfollowtags'];
	$blogcharactersrss = $_POST['blogcharactersrss'];
	



	
	if(!$ssitename || !$domain || !$stemplate || !$sgamesfolder || !$sgamesthumbs || !$slimitboxgames || !$sgamesonpage){
		echo 'Not all fields where filled.';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
 		mysql_query('UPDATE dd_settings SET 
 					domain=\''.$sdomain.'\', 
 					directorypath=\''.$directorypath.'\',
 					template=\''.$stemplate.'\',
 					gamesfolder=\''.$sgamesfolder.'\',
 					thumbsfolder=\''.$sgamesthumbs.'\',
 					limitboxgames=\''.$slimitboxgames.'\',
 					comments_on=\''.$scomments_on.'\',
 					autoapprovecomments=\''.$sautoapprovecomments.'\',
 					seo_on=\''.$sseo_on.'\',
 					sitename=\''.$ssitename.'\',
 					enabledcode_on=\''.$senabled_code.'\',
 					bannersleft=\''.$bannersleft.'\',
 					bannersright=\''.$bannersright.'\',
 					ads1=\''.$ads1.'\',
 					ads2=\''.$ads2.'\',
 					ads3=\''.$ads3.'\',
 					headerspace=\''.$headerspace.'\',
 					footerspace=\''.$footerspace.'\',
 					abovegames=\''.$abovegames.'\',
 					belowgames=\''.$belowgames.'\',
  					showwebsitelimit=\''.$showwebsitelimit.'\',
  					supportemail=\''.$supportemail.'\',
 					showblog=\''.$showblog.'\',
 					blogentriesshown=\''.$blogentriesshown.'\',
 					blogcharactersshown=\''.$blogcharactersshown.'\',
 					blogcommentpermissions=\''.$blogcommentpermissions.'\',
 					blogcommentsshown=\''.$blogcommentsshown.'\',
 					blogfollowtags=\''.$blogfollowtags.'\',
  					blogcharactersrss=\''.$blogcharactersrss.'\' ') or die(mysql_error());
		echo '<div class=\'msg\'>Updated.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	
}
echo '<form action=\''.$domain.'/index.php?action=admin&case=settings\' method=\'POST\'>
	<table align=\'center\' cellpadding=\'5\'>
		<tr>
			<th class=\'header5\' colspan=\'2\'>Settings</th>
		</tr>
			<td class=\'content5\'>Site Name:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'sitename\' size=\'40\' value=\''.$set['sitename'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Domain:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'domain\' size=\'40\' value=\''.$set['domain'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Directory Path:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'directorypath\' size=\'40\' value=\''.$set['directorypath'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Support E-mail:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'supportemail\' size=\'40\' value=\''.$set['supportemail'].'\'></td>
		</tr>

		</tr>
			<td class=\'content5\'>Template:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'template\' size=\'40\' value=\''.$set['template'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games Folder:<br /><small>
			Make sure you chmod the folder to 0777
			</small></td>	
			<td class=\'content5\'><input type=\'text\' name=\'gamesfolder\' size=\'40\' value=\''.$set['gamesfolder'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Thumbs Folder:<br /><small>
			Make sure you chmod the folder to 0777
			</small></td>	
			<td class=\'content5\'><input type=\'text\' name=\'thumbsfolder\' size=\'40\' value=\''.$set['thumbsfolder'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games On Home:<br /><small>
			How many games in each category do you want to be displayed in each box on the homepage?
			</small></td>	
			<td class=\'content5\'><input type=\'text\' name=\'limitboxgames\' size=\'40\' value=\''.$set['limitboxgames'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games in category per page:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'gamesonpage\' size=\'40\' value=\''.$set['gamesonpage'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Comments Enabled:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'comments_on\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$cesel.'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Auto Approve Comments:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'autoapprovecomments\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$aasel.'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>SEO On:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'seo_on\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$seoosel.'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Allow Enabled Code:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'enabled_code\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$ecsel.'>No</option>
						</select></td>
		</tr>


		</tr>
			<td class=\'content5\'>Show website after:<br /><small>
			How many games must a member play before their website is displayed on their profile?
			</small></td>	
			<td class=\'content5\'><input type=\'text\' name=\'showwebsitelimit\' size=\'40\' value=\''.$set['showwebsitelimit'].'\'></td>
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





		</tr>
			<td class=\'content5\'>Show Blog?:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'showblog\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' '.$sbsel.'>No</option>
						</select></td>
		</tr>

		</tr>
			<td class=\'content5\'>Number of Blog Entries to show:
			</td>	
			<td class=\'content5\'><input type=\'text\' name=\'blogentriesshown\' size=\'2\' value=\''.$set['blogentriesshown'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Number of Blog Entries Characters to Show:
			</td>	
			<td class=\'content5\'><input type=\'text\' name=\'blogcharactersshown\' size=\'4\' value=\''.$set['blogcharactersshown'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Blog Comment Permssions:
			</td>	
			<td class=\'content5\'><input type=\'text\' name=\'blogcommentpermissions\' size=\'1\' value=\''.$set['blogcommentpermissions'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Number of Blog Comments to Show:
			</td>	
			<td class=\'content5\'><input type=\'text\' name=\'blogcommentsshown\' size=\'2\' value=\''.$set['blogcommentsshown'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Follow Tags on Blog Comments:<br><small>nofollow/external</small>
			
			</td>	
			<td class=\'content5\'><input type=\'text\' name=\'blogfollowtags\' size=\'40\' value=\''.$set['blogfollowtags'].'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Blog Entry Characters in RSS:
			</td>		
			<td class=\'content5\'><input type=\'text\' name=\'blogcharactersrss\' size=\'40\' value=\''.$set['blogcharactersrss'].'\'></td>
		</tr>
			<tr>
				<th colspan=\'2\' class=\'header5\'><input type=\'submit\' name=\'submit\' value=\'Change\'></th>
	</table>
	</form>		
';
?>