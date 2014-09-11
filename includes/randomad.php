<?php

// load the file that contain the ads
$adfile = "ads.txt";
$ads = array();

// one line per ad
$fh = fopen($adfile, "r");
while(!feof($fh)) {

  $line = fgets($fh, 10240);
  $line = trim($line);
  if($line != "") {
	$ads[] = $line;
  }
}

// randomly pick an ad
$num = count($ads);
$idx = rand(0, $num-1);

echo $ads[$idx];
?>