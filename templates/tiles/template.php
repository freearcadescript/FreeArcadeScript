<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $pagetitle; ?> - <?php echo $slogan; ?></title>
<meta name="keywords" content="<?php echo $metatags; ?>" />
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta name="author" content="freearcadescript.net" />
<meta property="og:url" content="<?=$domain?>" />
<meta property="og:title" content="<?php echo $sitename; ?>" />
<meta property="og:image" content="<?=$domain?>/templates/<?php echo $template ; ?>/images/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<link href="<?=$domain?>/templates/<?php echo $template ; ?>/styles.css" rel="stylesheet" type="text/css">
<?php include ("js/rating_update.php"); ?>
</head>
<body>
<?php if (!$facebookappid == "") { echo ''.$facebookappid.''; }; ?>
<div id="body_wrapper">

<div class="heading">
		<div class="logo">
			<?php echo'<a href="'.$domain.'"><img src="'.$domain.'/templates/'.$template.'/images/logo.png" alt="'.$sitename.'" title="'.$sitename.'" width="270" height="80"/></a>';?>
		</div>
<?php
if($seo_on == 1){
	$su = ''.$domain.'/search/';
}else{
	$su = ''.$domain.'/index.php?action=search';
}
echo'<div class="search">
			<form action="'.$su.'" method="post">
				<input onblur="if (value ==\'\') {value = \'Search...\'}" onfocus="if (value == \'Search...\') {value =\'\'}" type="text" name="keyword" style="width:200px" value="Search..." />
				<input class="button" type="submit" name="submit" value="Go" style="width:40px"/>
			</form>
		</div>';
?>
        <div class="socialmedia">
Follow us on :
<?php
if (!$socialmedia1 == "") { echo '<a href="'.$socialmedia1.'"><img src="'.$domain.'/images/icons/facebook.png" alt="FaceBook" title="FaceBook" width="16" height="16" /></a> '; };
if (!$socialmedia2 == "") { echo '<a href="'.$socialmedia2.'"><img src="'.$domain.'/images/icons/twitter.png" alt="Twitter" title="Twitter" width="16" height="16" /></a> '; };
if (!$socialmedia3 == "") { echo '<a href="'.$socialmedia3.'"><img src="'.$domain.'/images/icons/googleplus.png" alt="Google Plus" title="Google Plus" width="16" height="16" /></a> '; };
if (!$socialmedia4 == "") { echo '<a href="'.$socialmedia4.'"><img src="'.$domain.'/images/icons/linkedin.png" alt="Linkedin" title="Linkedin" width="16" height="16" /></a> '; };
if (!$socialmedia5 == "") { echo '<a href="'.$socialmedia5.'"><img src="'.$domain.'/images/icons/pinterest.png" alt="Pinterest" title="Pinterest" width="16" height="16" /></a> '; };
if (!$socialmedia6 == "") { echo '<a href="'.$socialmedia6.'"><img src="'.$domain.'/images/icons/youtube.png" alt="You Tube" title="You Tube" width="16" height="16" /></a> '; };
if (!$socialmedia7 == "") { echo '<a href="'.$socialmedia7.'"><img src="'.$domain.'/images/icons/myspace.png" alt="MySpace" title="MySpace" width="16" height="16" /></a> '; };
if (!$socialmedia8 == "") { echo '<a href="'.$socialmedia8.'"><img src="'.$domain.'/images/icons/stumbleupon.png" alt="StumbleUpon" title="StumbleUpon" width="16" height="16" /></a> '; };
if (!$socialmedia9 == "") { echo '<a href="'.$socialmedia9.'"><img src="'.$domain.'/images/icons/digg.png" alt="Digg" title="Digg" width="16" height="16" /></a> '; };
if (!$socialmedia10 == "") { echo '<a href="'.$socialmedia10.'"><img src="'.$domain.'/images/icons/icon4.png" alt="" title="" width="16" height="16" /></a> '; };
?>
       </div>
</div>
<div class="clear"></div>




<?php
writebody();
?>

<div align="center">
<?php echo $footerspace; ?>
</div>


<!-- start footer nav -->
<div id="footer_nav">
<div id="seotext_left">
<?php include("includes/footerblocks.php");?>
</div>
<br /><br />
<div id="footer_left">
<?php echo "Copyright ".$sitename." &copy; 2008-".date('Y'); ?> All Rights Reserved<br />
<! -- Please do not remove the "powered by" link unless, you've purchased the removal. -- >
Powered By <a href="http://freearcadescript.net" target="_blank">Free Arcade Script</a>
</div>
<div id="footer_right">
<?php
		if($seo_on == 1){
			echo '
				<a href="'.$domain.'">Home</a> |
				<a href="'.$domain.'/memberslist/">Members</a> |
				<a href="'.$domain.'/fineprint/">Fine Print</a> |
				<a href="'.$domain.'/contact/">Contact Us</a> |
				<a href="'.$domain.'/links/">Links</a> |';
       	    	if ($showpages == 1) { echo '<a href="'.$domain.'/pages/">Pages</a> |'; };
       	    	if ($showblog == 1) { echo '<a href="'.$domain.'/blog/">Blog</a>'; };
		}else{
			echo '
				<a href="'.$domain.'">Home</a> |
				<a href="'.$domain.'/index.php?action=memberslist">Members</a> |
				<a href="'.$domain.'/index.php?action=fineprint">Fine Print</a> |
				<a href="'.$domain.'/index.php?action=contact">Contact Us</a> |
				<a href="'.$domain.'/index.php?action=links">Links</a> |';
    	   	    if ($showpages == 1) { echo '<a href="'.$domain.'/index.php?action=pages">Pages</a> |'; };
    	   	    if ($showblog == 1) { echo '<a href="'.$domain.'/index.php?action=blog">Blog</a>'; };
		}
?>
</div>
</div>
<!-- end footer nav -->
</div>
<?php echo $analytics; ?>
</body></html>
