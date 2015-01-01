<?php
if(isset($_POST['submit'])){
	$title = clean($_POST['title']);
	$url = clean($_POST['url']);
	$hits = '0';
	$dateadded = time();
      $activate='1';
      $linkbackat= clean($_POST['linkbackat']);
      $linkbackreq= clean($_POST['linkbackreq']);
      $emailaddress= clean($_POST['emailaddress']);

	if(!$title || !$url){
		echo '<div class=\'error\'>Title or URL was not filled.</div>';
		
		
	} else {
	mysql_query("INSERT INTO fas_links SET 
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
	echo'<div class="heading">
		<h2>Add Link</h2>
	</div>
        <br clear="all">
	<form action=\''.$domain.'/index.php?action=admin&case=addlink\' method=\'post\'>
		<table id="table">
			<thead>
				<tr>
					<th colspan="2">Add Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Title:</td>
					<td><input type=\'text\' name=\'title\' size=\'40\'></td>
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
					<td colspan=\'2\'><input type=\'submit\' name=\'submit\' value=\'Add Link\'></td>
				</tr>
			</body>
		</table>
	</form>';
}
?>