<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$return_message = '';

if (!isset($_GET['cmd'])){
	$_GET['cmd'] = NULL;
}

if (isset($_GET['show']))
{
    $page = (int)$_GET['show'];
}
else
{
    $page = 1;
}

switch($_GET['cmd']){

	default:
        agffeed($page);
	    break;

	case 'edit':
        edit();
        break;

	case 'delete':
        delete();
        break;

	case 'install':
        $return_message = install($_GET['id']);
        break;

    case 'update':
        $feedmsg = update_feed();
        agffeed($page, $feedmsg);
        break;

}

/**
 * Main feed display and logic
 *
 * @param $page
 * @param string $feedmsg
 */
function agffeed($page, $feedmsg=''){
    global $domain, $db;
    ?>

    <div class="heading">
        <h2>Manage Arcade Game Feeds</h2>
    </div>
    <br clear="all">

    <table id="table">
        <thead>
            <tr>
                <th colspan="2">Arcade Game Feed</th>
            </tr>
        </thead>
    <table width="100%" border="0" align="center">
    <tr><td style="width: 100%; text-align: center"><?php echo $feedmsg; ?></td></tr>
    <tr><td><center>
    <form action="index.php" method="get">
    <input type="hidden" name="action" value="admin">
    <input type="hidden" name="case" value="manageagf">
    <input type="hidden" name="cmd" value="update">
    <input type="submit" class="button" value="Update Feed" />
    </form>
    </center></td></tr>

    <?php
    $totalgames = $db->num_rows($db->query(sprintf('SELECT id FROM fas_agffeed WHERE installed="0"')));

    echo '<tr><td colspan=\'3\'></td></tr>
    <tr><td colspan=\'3\' class=\'header5\' align=\'center\'>Total Games: '.$totalgames.'</td></tr>
    <tr><td colspan=\'3\'>
    <table id="table">
        <thead>
        <tr>
            <th width=\'90\'>Image</th>
            <th width=\'700\'>Info</th>
            <th width=\'50\'>Category</th>
            <th width=\'50\'>&nbsp;</th>
            <th width=\'50\'>&nbsp;</th>
        </tr>
        </thead>';


    $max = 10;
    $start = ($page-1) * $max;

    $totalres = mysql_result($db->query(sprintf('SELECT COUNT(id) AS total FROM fas_agffeed WHERE installed="0"')),0);
    $totalpages = ceil($totalres / $max);
    $sql = mysql_query(sprintf('SELECT * FROM fas_agffeed WHERE installed="0" ORDER BY id DESC LIMIT '.$start.', '.$max)) or die(mysql_error());
    while($row = mysql_fetch_row($sql)){

    if ($sql['installed'] != "1") {
    $thumbs = '<img src=\''.$row[4].'\' width=\'120\' height=\'90\' border=\'0\'>';
    $name = $row[2];
    $catname = $row[8];
    $urls = '<a href=\''.$row[5].'\' target=\'_blank\'>Try It!</a>';
    echo '<tr>
            <td align=\'center\'>'.$thumbs.'<p></td>
            <td><b>'.$name.'<p></b>'.$row[3].'<p>
            <b>Ads:</b> '.$row[13].'  <b>Highscores:</b> '.$row[12].'  <b>Tags:</b> '.$row[11].'</td>
            <td align=\'center\'>'.$catname.'</td>
            <td align=\'center\'><center>
            <a href=\''.$domain.'/index.php?action=admin&case=manageagf&cmd=delete&id='.$row[0].'\'  onclick="return confirm(\'Are you sure you want to delete the game '.$row[2].'?\')"><img src=\''.$domain.'/images/deletebtn.png\' alt=\'delete game\'  border=\'0\'></a>
            <a href=\''.$domain.'/index.php?action=admin&case=manageagf&cmd=install&id='.$row[0].'\' onclick="return confirm(\'Are you sure you want to install the game '.$row[2].'?\')"><img src=\''.$domain.'/images/approve.png\' alt=\'install game\'  border=\'0\'></a>
            </center></td>
            <td align=\'center\'>'.$urls.'<br /><a href=\''.$row[14].'\' target=\'_blank\'>Download</a></td>
        </tr>';
    };

}

 echo '</table>  </td></tr>
 </table>

<div class="page-box">'
.$totalres.' game(s) - Page '.$page.' of '.$totalpages;
$pre = $page - '1';
$ne = $page + '1';

$previous = ''.$domain.'/index.php?action=admin&case=manageagf&cmd=agffeed&show='.$pre.'';
$next = ''.$domain.'/index.php?action=admin&case=manageagf&cmd=agffeed&show='.$ne.'';

if ($totalpages > '1'){
    echo' - ';
    if ($page > '1'){
        echo '<a href="'.$previous.'" class="page">Previous</a>';
    }
    for($i = 1; $i <= $totalpages; $i++){
        if($page - $i < '4' || $totalpages - $i < '7'){
            if($i - $page < '4' || $i < '8'){

                $urk = ''.$domain.'/index.php?action=admin&case=manageagf&cmd=agffeed&show='.$i.'';

                if($page == $i){
                    echo '<a href="'.$urk.'" class="page-select">'.$i.'</a>';
                }else{
                    echo '<a href="'.$urk.'" class="page">'.$i.'</a>';
                }
            }
        }
    }
    if ($page < $totalpages){
        echo '<a href="'.$next.'" class="page">Next</a>';
    }
}

}


/**
* Delete game from the feed
*/
function delete(){
    $id = abs((int) $_GET['id']);
    mysql_query(sprintf('DELETE FROM fas_agffeed WHERE id=\'%u\'', $id));
    echo '<div class=\'msg\'>Game Deleted.
    <br />
    <A href="#" onclick="history.go(-1)">Back</a></div>';
}

/**
 * Install feed game to the arcade
 *
 * @param $id
 */
function install($id){

    global $usrdata, $thumbsfolder, $gamesfolder;
    $file_prefix = 'agf_';
    $id = abs((int)$id);
    $valid_image_ext = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
    $valid_game_ext = array('swf', 'dcr', 'SWF', 'DCR');

    $sql_query = mysql_query("SELECT * FROM fas_agffeed WHERE id={$id} LIMIT 1");
    $game = mysql_fetch_assoc($sql_query);


    $game['thumbspath'] = ''.$thumbsfolder.'/';
    $game['gamespath'] = ''.$gamesfolder.'/';
    $game['gameadder'] = $usrdata['userid'];
    $game['adderip'] = $_SERVER['REMOTE_ADDR'];
    $game['thumb_ext'] = substr($game['thumb_url'], strrpos($game['thumb_url'], '.') + 1);
    $game['game_ext'] = substr($game['file_url'], strrpos($game['file_url'], '.') + 1);
    $game['description'] = addslashes(strip_tags($game['description']));

    if (!in_array($game['thumb_ext'], $valid_image_ext)) {
        //$game['thumb_ext'] = 'png'; //Needs error check and error response...not assigning default file type
        return 'The game thumb extension "' . $game['thumb_ext'] . '" for ' . $game['name'] . 'is not a valid or allowed image type';
    }
    if (!in_array($game['game_ext'], $valid_game_ext)) {
        //$game['game_ext'] = 'swf'; //Needs error check and error response...not assigning default file type
        return 'The game file extension "' . $game['game_ext'] . '" for ' . $game['name'] . 'is not a valid or allowed game type';
    }

    $game['local_file'] = $file_prefix . str_replace(' ', '_', $game['name']) . '.' . $game['game_ext'];
    $game['local_thumb'] = $file_prefix . str_replace(' ', '_', $game['name']) . '.' . $game['thumb_ext'];
    $game['name'] = addslashes($game['name']);

    //Match the string Category name to the arcades category ID if possible
    $category_query = mysql_query("SELECT `ID` FROM `fas_categories` WHERE `name`='{$game['category']}' LIMIT 1");
    $cat_result =  mysql_fetch_assoc($category_query);
    if ($cat_result['ID']) {
        $game['category_id'] = $cat_result['ID'];
    } else {
        $game['category_id'] = 10; //Default to Other category if no match
    }


    $download_file_msg = download_file($game['file_url'], $game['gamespath'] . $game['local_file']);
    $download_thumb_msg = download_file($game['thumb_url'], $game['thumbspath'] . $game['local_thumb']);
    $game['time'] = time();
    if ($download_file_msg || $download_thumb_msg) {}
    $query = mysql_query("INSERT INTO `fas_games` (`name`, `description`, `file`, `width`, `height`, `category`, `thumb`, `dateadded`, `tags`)VALUES ('{$game['name']}', '{$game['description']}', '{$game['local_file']}', '{$game['width']}', '{$game['height']}', '{$game['category_id']}', '{$game['local_thumb']}', '{$game['time']}', '{$game['tags']}')");
    if (!$query)
    {
        die('Error inserting into game table: ' . mysql_error()); // May not be the best way to notify the user
    }
    mysql_query(sprintf('update fas_agffeed set installed=\'1\' where  id=\'%u\'', $id));
    echo '<div class=\'msg\'>Game Successfully Installed.
            <br />
            <A href="#" onclick="history.go(-1)">Back</a></div>';
}

/**
 * Download a remote file to the local server
 *
 * @param $url
 * @param $local_file
 * @return bool
 */
function download_file($url, $local_file) { // $url is the file we are getting, full address.....$local_file is the file to save to
    set_time_limit(0);
    $return_state = true;
    if (function_exists('curl_version'))
    {
        // If cURL library is loaded use it
        $fp = fopen ($local_file, 'wb+');//This is the file where we save the information
        $ch = curl_init($url);//Here is the file we are downloading
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //allow the server to redirect if the file location was changed. Some hosts (very few) will not allow this and error
        curl_exec($ch);
        if (curl_errno($ch))
        {
            // There was an error in the file download process

            $return_state = false;
        }
        curl_close($ch);
        fclose($fp);
    }
    else
    {
        //If cURL library is not loaded
        $f = fopen ($url, "rb");
        if ($f) {
            $fp = fopen ($local_file, "wb");

            if ($fp)
                while(!feof($f)) {
                    fwrite($fp, fread($f, 1024 * 8 ), 1024 * 8 );
                }
        } else {
            $return_state = false;
        }

        if ($f) {
            fclose($f);
        }

        if ($fp) {
            fclose($fp);
        }
    }
    return $return_state;
}

/**
* Parse and update the feed. Populate the local database with feed game data.
*
* @return string
*/
function update_feed()
{
    ini_set("memory_limit","150M");
    $i = 0;

    $feed = 'http://www.arcadegamefeed.com/feed.php?=format=json';

    if (function_exists('curl_version'))
    {
        $target = curl_init();
        curl_setopt($target, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($target, CURLOPT_URL, $feed);
        $data = curl_exec($target);
        if (curl_errno($target))
        {
            // There was an error in the file download process
            curl_close($target);
            return "Could not retrieve feed data using cURL library";
        }
        curl_close($target);
    } else {
        $data = file_get_contents($feed);
        // There was an error in the file download process
        if ($data === false)
        {
            return "Could not retrieve feed data using file_get_contents().";
        }
    }


    $out = json_decode($data, true);

    foreach($out as $game) {

        $count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM fas_agffeed WHERE agf_id='$game[id]'"),0);
        if ($count == 0) {

            $name = mysql_real_escape_string($game['title']);
            $description = mysql_real_escape_string($game['description']);
            $instructions = mysql_real_escape_string($game['instructions']);
            $category = mysql_real_escape_string($game['category']);
            $thumb_url = mysql_real_escape_string($game['thumbnail']);
            $swf_url = mysql_real_escape_string($game['file']);
            $width = mysql_real_escape_string($game['width']);
            $height = mysql_real_escape_string($game['height']);
            $tags = mysql_real_escape_string($game['keywords']);
            $highscores = mysql_real_escape_string($game['hsapi']);
            $ads = mysql_real_escape_string($game['ads']);
            $zip = mysql_real_escape_string($game['zip']);

            $sql = mysql_query("INSERT INTO fas_agffeed (agf_id, name, description, thumb_url, file_url, width, height, category, instructions, tags, highscores, ads, zip) VALUES ('$game[id]', '$name', '$description', '$thumb_url', '$swf_url', '$width', '$height', '$category', '$instructions', '$tags', '$highscores', '$ads', '$zip')") or die (mysql_error());

            $i = $i + 1;
        }}
    return  $i.' Games Added to Database<br /><br />';
}
?>
