<?php
if(isset($_POST['submit'])){
	$name = clean($_POST['name']);
	$tags = clean($_POST['tags']);
	$metadescr = clean($_POST['metadescr']);
	if(!$name){
		echo '<div class=\'error\'>No name submitted.</div>';
		
		
	} else {
	mysql_query("INSERT INTO fas_categories SET name='$name', tags='$tags', metadescr='$metadescr' ");
	echo '<div class=\'msg\'>Category added.<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>'; };
} else {
echo '<div class="heading">
	<h2>Add Category</h2>
</div>
<br clear="all">
<form action=\''.$domain.'/index.php?action=admin&case=addcategory\' method=\'post\'>
	<table id="table">
		<thead>
			<tr>
				<th colspan="2">Category Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name: </td>
				<td><input type=\'text\' name=\'name\' size=\'50\'></td>
			</tr>
			<tr>
				<td>Tags: </td>
				<td><input type=\'text\' name=\'tags\' size=\'50\'></td>
			</tr>
			<tr>
				<td>Meta Description: </td>
				<td><input type=\'text\' name=\'metadescr\' size=\'50\'></td>
			</tr>
			<tr>
				<td colspan="2"><input type=\'submit\' name=\'submit\' value=\'Add Category\'></td>
			</tr>
		</tbody>
	</table>
</form>';   
};
?>