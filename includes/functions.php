<?php
function get_avatar($id){
global $db, $domain, $avatar_on, $aimg, $gender_on, $mimg, $fimg;
	$ir = $db->query(sprintf('SELECT * FROM fas_users WHERE userid=\'%u\'', $id));
	$r2 = $db->fetch_row($ir);
	$sex = $r2['sex'];
	$avatar = $r2['avatar'];
	$avatarfile = $r2['avatarfile'];
	
	if ($avatar == "1" ) { 
		$avatarfileurl = $avatarfile; 
	}elseif ($avatar_on == "1" && $gender_on == "1"){
		if ($sex == "u" || $sex == ""){
			$avatarfileurl = $aimg;
		}elseif ($sex == "m"){
			$avatarfileurl = $mimg;
		}elseif ($sex == "f"){
			$avatarfileurl = $fimg;
		} 
	}elseif ($avatar_on == "1"){
		$avatarfileurl = $aimg;
	}else{ 
		$avatarfileurl = ''; 
	};
	
	return $avatarfileurl;
}

function valid_email($email)
{
	if(preg_match("/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0)
		return true;
	else
		return false;
}

function clean ($str){
    $str = strip_tags ($str);
    $str = htmlspecialchars ($str, ENT_NOQUOTES);
    $str = stripslashes ($str);
    $str = mysql_real_escape_string($str);
    return $str;
}

function titlelimit($str, $n =24, $end_char = '&#8230;'){
if (strlen($str) <= $n){
	return $str;
}

if(strlen($str)>$n){
    return substr($str,0,$n).$end_char;
}
}

function desclimit($str, $n =70, $end_char = '&#8230;'){
if (strlen($str) <= $n){
	return $str;
}

if(strlen($str)>$n){
    return substr($str,0,$n).$end_char;
}
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

function sqlcache($name, $expire, $query) {
 global $db, $domain, $sitename, $domain, $template, $cachepath, $userid;

$file = $cachepath . $name ;
 
if (file_exists($file) && filemtime($file) > (time() - $expire)) {
    $records = unserialize(file_get_contents($file));
} else {
    
  /* form SQL query */
    $result = mysql_query($query) or die (mysql_error());
    while ($record = mysql_fetch_array($result) ) {
        $records[] = $record;
    }
	if(empty($records))
		$records = NULL;
    //Cache the query
  	$OUTPUT = serialize($records);
    $fp = fopen($file,"w");
    fputs($fp, $OUTPUT);
    fclose($fp);
} // end else
 
return $records;
}
?>