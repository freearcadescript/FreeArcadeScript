<?php
header("Content-Type: text/xml;charset=iso-8859-1");

//this is the normal header applied to any Google sitemap.xml file
	echo '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';

include ('includes/functions.php');
include ('includes/core.php');


       echo'<url>
         <loc>' . $domain . '</loc>
         <priority>0.8</priority>
       </url>';
        if($seo_on == 1){
	   	$mostplayed = ''.$domain.'/mostplayed/';
	    }else{
	   	$mostplayed = ''.$domain.'/index.php?action=mostplayed';
        }
               echo'<url>
		         <loc>'.$mostplayed.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $newest = ''.$domain.'/newest/';
        }else{
	    $newest = ''.$domain.'/index.php?action=newest';
        }
               echo'<url>
		         <loc>'.$newest.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $memberslist = ''.$domain.'/memberslist/';
        }else{
	    $memberslist = ''.$domain.'/index.php?action=memberslist';
        }
               echo'<url>
		         <loc>'.$memberslist.'</loc>
		         <priority>0.8</priority>
                 </url>';
         if($seo_on == 1){
	    $links = ''.$domain.'/links/';
        }else{
	    $links = ''.$domain.'/index.php?action=links';
        }
               echo'<url>
		         <loc>'.$links.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $contact = ''.$domain.'/contact/';
        }else{
	    $contact = ''.$domain.'/index.php?action=contact';
        }
               echo'<url>
		         <loc>'.$contact.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $fineprint = ''.$domain.'/fineprint/';
        }else{
	    $fineprint = ''.$domain.'/index.php?action=fineprint';
        }
               echo'<url>
		         <loc>'.$fineprint.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $search = ''.$domain.'/search/';
        }else{
	    $search = ''.$domain.'/index.php?action=search';
        }
               echo'<url>
		         <loc>'.$search.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $login = ''.$domain.'/login/';
        }else{
	    $login = ''.$domain.'/index.php?action=login';
        }
               echo'<url>
		         <loc>'.$login.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $signup = ''.$domain.'/signup/';
        }else{
	    $signup = ''.$domain.'/index.php?action=signup';
        }
               echo'<url>
		         <loc>'.$signup.'</loc>
		         <priority>0.8</priority>
                 </url>';
        if($seo_on == 1){
	    $forgotpassword = ''.$domain.'/forgotpassword/';
        }else{
	    $forgotpassword = ''.$domain.'/index.php?action=forgotpassword';
        }
               echo'<url>
		         <loc>'.$forgotpassword.'</loc>
		         <priority>0.8</priority>
				</url>';
        $sql = mysql_query(sprintf('SELECT * FROM fas_games WHERE active=\'1\' ')) or die(mysql_error());
		while($row = mysql_fetch_row($sql)){
        $ID = $row['0'];
        $name = preg_replace('#\W#', '-', $row['1']);
		if($seo_on == 1){
			$playlink = ''. $domain . '/play/'.$row['0'].'-'.$name.'.html';
		} else {
			$playlink = ''. $domain . '/index.php?action=play&amp;ID=' . $ID;
		}
				echo'<url>
				<loc>'.$playlink.'</loc>
				<priority>0.8</priority>
				</url>';
		}

		$sql= mysql_query(sprintf('SELECT * FROM fas_categories WHERE active=\'1\''));
		while($row = mysql_fetch_array($sql)){
        $ID = $row['0'];
        $name = preg_replace('#\W#', '-', $row['1']);
        if($seo_on == 1){
		$categoryurl = ''.$domain.'/browse/'.$row['0'].'-'.$name.'.html';
		}else{
		$categoryurl = ''.$domain.'/index.php?action=browse&amp;ID='.$row['1'].'';
		    };
				echo '<url>
				<loc>' . $categoryurl . '</loc>
				<priority>0.8</priority>
				</url>';
		}
		echo '</urlset>';

?>

