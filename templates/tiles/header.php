<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title><?php echo $pagetitle; ?></title>
<head>
<meta name="keywords" content="<?php echo $metatags; ?>" />
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta name="author" content="freearcadescript.net" />
<meta property="og:url" content="<?=$domain?>" />
<meta property="og:title" content="<?php echo $sitename; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=$domain?>/templates/<?php echo $template ; ?>/styles.css" rel="stylesheet" type="text/css">
<?php include ("js/rating_update.php"); ?>
</head>
<body>
<?php if (!$facebookappid == "") { echo ''.$facebookappid.''; }; ?>
echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">';


			

