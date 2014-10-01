<?php
if ($_GET['action'] == 'browse') {
include("templates/$template/blocks/cattext.php");
} else {
include("templates/$template/blocks/seotext.php");
}

?>