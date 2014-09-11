 <?
include ('config.php');
//error_reporting(E_ALL);
$server = $dbhost;
$dbuser = $dbuser;
$dbpass = $dbpass;
$dbname = $dbname;

$x = mysql_connect($server,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname,$x);
?>