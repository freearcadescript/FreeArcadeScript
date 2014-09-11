<?php
function clean ($str){
    $str = strip_tags ($str);
    $str = htmlspecialchars ($str, ENT_NOQUOTES);
    $str = stripslashes ($str);
    $str = mysql_real_escape_string($str);
    return $str;
}
function desclimit($str, $n =10, $end_char = '&#8230;')
{
if (strlen($str) < $n){
	return $str;
}
	$words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));
if (count($words) <= $n){
	return $str;
}
$str = '';
for ($i = 0; $i < $n; $i++){
	$str .= $words[$i].' ';
}
return trim($str).$end_char;
}

function browsedesclimit($str, $n =30, $end_char = '&#8230;')
{
if (strlen($str) < $n){
	return $str;
}
	$words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));
if (count($words) <= $n){
	return $str;
}
$str = '';
for ($i = 0; $i < $n; $i++){
	$str .= $words[$i].' ';
}
return trim($str).$end_char;
}
 function countusersonline() {
   $count = 0;

   $handle = opendir(session_save_path());
   if ($handle == false) return 1;

   while (($file = readdir($handle)) != false) {
       if (ereg("^sess", $file)) $count++;
   }
   closedir($handle);

   return $count;
}
?>