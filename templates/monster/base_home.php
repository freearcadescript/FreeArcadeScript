<?php

$pagetitle = $sitename;

function writebody() {
global $db, $domain, $sitename, $domain, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid;

$count = 0;
$baser2 = "SELECT * FROM fas_categories where active='1'";
$baser1 = sqlcache('mainpagecats', $cachelife, $baser2);

if($baser1 == false){//If no games are added to the category yet, display error.
	echo'<div class="msg">No categories added yet</div>';
	return;	
}//end if $baser1

foreach($baser1 as $row){
	$categorynamev = $row['name'];
	$categorynameu = preg_replace('#\W#', '-', $categorynamev );
	if($seo_on == 1){
		$categoryurl = ''.$domain.'/browse/'.$row['ID'].'-'.$categorynameu.'.html';
	}else{//else seo
		$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['ID'].'';
	};//end seo
	if($count%2==0){
		echo'<div class="home_row">
		<div class="home_category">
			<div class="header2">
				<div class="home_cat_title">'.$row['name'].'</div>
				<div class="home_more"><a href=\''.$categoryurl.'\'>View more</a></div>
			</div>
			<div class="content2">';
				$catid1=$row['ID'];
				$sqltitle='mainpagecat'.$catid1 ;
				$baseir2 = "SELECT * FROM fas_games WHERE category='$catid1' and active='1' ORDER BY rand() LIMIT 0,".$limitboxgames ;
				$baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);
				if(isset($baseir1)){
	      			foreach($baseir1 as $row ){
	      				$gamename = preg_replace('#\W#', '-', $row['name']);
						if($seo_on == 1){
	      					$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
	      				}else{//else seo
	      					$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
	      				}//end seo
	      				echo'<div class="home_wrap">
	      					<div class="home_img">
	      						<a href=\''.$playlink.'\'>';
				      				if($row['type'] == 1){	
				      					echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' alt= \''.$gamename.'\' class="home_img" />';
				      				}else{//else type
				      					echo '	<img src=\''.$row['thumburl'].'\' alt= \''.$gamename.'\' class="home_img" />';
									}//end type
				      			echo'</a>
	      					</div>
							<div class="home_info">
	      						<div class=\'home_title\'><a href=\''.$playlink.'\'>'.titlelimit($row['name']).'</a></div>
	      						<div class=\'home_desc\'>'.desclimit($row['description']).'</div>
	      					</div>
						</div>';
	      				};//end foreach baseir1 
				}else{//else isset($baseir1)
					echo'<div>
						No games have been added to this category yet.
					</div>';	
				}//end isset($baseir1)
			echo'</div>
		</div>';
	}else{//else count
		echo'<div class="home_category">
			<div class="header2">
				<div class="home_cat_title">'.$row['name'].'</div>
				<div class="home_more"><a href=\''.$categoryurl.'\'>View more</a></div>
			</div>
			<div class="content2">';
				$catid1=$row['ID'];
				$sqltitle='mainpagecat'.$catid1 ;
				$baseir2 = "SELECT * FROM fas_games WHERE category='$catid1' and active='1' ORDER BY rand() LIMIT 0,".$limitboxgames ;
				$baseir1 = sqlcache($sqltitle, $cachelife, $baseir2);
				if(isset($baseir1)){
					foreach($baseir1 as $row ){
						$gamename = preg_replace('#\W#', '-', $row['name']);
			    		if($seo_on == 1){
			      			$playlink = ''.$domain.'/play/'.$row['ID'].'-'.$gamename.'.html';
			      		}else{
			      			$playlink = ''.$domain.'/index.php?action=play&amp;ID='.$row['ID'].'';
			      		}
			      		echo'<div class="home_wrap">
	      					<div class="home_img">
				      			<a href=\''.$playlink.'\'>';
				      				if($row['type'] == 1){	
				      					echo '	<img src=\''.$domain.'/'.$thumbsfolder.'/'.$row['thumb'].'\' class="home_img" alt=\''.$gamename.'\' />';
				      				}else{
				      					echo '	<img src=\''.$row['thumburl'].'\' class="home_img" alt= \''.$gamename.'\' />';
				      				}	
				      			echo'</a>
				      		</div>
							<div class="home_info">
				      			<div class=\'home_title\'><a href=\''.$playlink.'\'>'.titlelimit($row['name']).'</a></div>
				      			<div class=\'home_desc\'>'.desclimit($row['description']).'</div>
				      		</div>
						</div>';
				      	};
					}else{
						echo'<div>
							No games have been added to this category yet.
						</div>';	
					}
			echo'</div>
		</div>
	</div>';
}
$count++;
}//end foreach baser1
};//end writebody()
?>