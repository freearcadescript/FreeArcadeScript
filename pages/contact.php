<?php

$sender = clean($_POST['sender']);
$message = clean($_POST['message']);


if(!$sender || !$message){
echo 'All fields are required.';
}else{


$headers = 'From: '.$sender.' <'.$sender.'>';
$subject = 'Contact mssage from '.$sender.' through '.$sitename;
mail($supportemail, $subject, $message, $headers);
echo '<p>Thank you, message has been sent.</p>';
};
?>