<?php
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$url = $_POST['url'];
	$hits = '0';
	$dateadded = time();
      $activate='1';
      $linkbackat= $_POST['linkbackat'];
      $linkbackreq= $_POST['linkbackreq'];
      $emailaddress= $_POST['emailaddress'];

	if(!$title || !$url){
		echo '<div class=\'error\'>Title or URL was not filled.</div>';
		
		
	} else {
	mysql_query("INSERT INTO dd_links SET 
					title='$title',
					url='$url',
					hits='$hits',
					dateadded='$dateadded',
                              activate='$activate',
                              linkbackreq='$linkbackreq',
                              linkbackat='$linkbackat',
                              emailaddress='$emailaddress'; ");
					
	echo '<div class=\'msg\'>Link Added. </a><br />
			<A href="#" onclick="history.go(-1)">Back</a>';		};		
}else{
	echo '
	<form action=\''.$domain.'/index.php?action=admin&case=addlink\' method=\'POST\'>
	<table align=\'center\'>
		<tr>
			<td>Title:</td>
			<td><input type=\'text\' name=\'title\' size=\'35\'></td>
		</tr>
		<tr>
			<td>URL:</td>
			<td><input type=\'text\' name=\'url\' size=\'40\' value=\'http://\'></td>
		</tr>
		<tr>
			<td>Link Back Required?:</td>
			<td><input type=\'text\' name=\'linkbackreq\' size=\'40\' value=\'1\'></td>
		</tr>
		<tr>
			<td>Link Back At:</td>
			<td><input type=\'text\' name=\'linkbackat\' size=\'40\' value=\'http://\'></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type=\'text\' name=\'emailaddress\' size=\'40\' value=\'theirname@domain.com\'></td>
		</tr>



		<tr>
			<td colspan=\'2\' align=\'center\'><input type=\'submit\' name=\'submit\' value=\'Add Link\'></td>
		</tr>
	</table>
	</form>';
}
?>