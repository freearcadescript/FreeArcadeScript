<?php
if(isset($_POST['submit'])){
	$categoryname = clean($_POST['categoryname']);
	$topcategory = clean($_POST['topcategory']);
	$activate = clean($_POST['activate']);
	if(!$categoryname){
		echo '<div class=\'error\'>No name submitted.</div>';
		return;
	};
	mysql_query("INSERT INTO fas_blogcategories SET topcategory='$topcategory', categoryname='$categoryname', activate='$activate' ");
	echo '<div class=\'msg\'>Category added.<br />
		<A href="#" onclick="history.go(-1)">Back</a></div>';
}else{

	echo'<div class="heading">
		<h2>Add Blog Category</h2>
	</div>
	<form action=\''.$domain.'/index.php?action=blogadmin&case=addblogcategory\' method=\'post\'>
		<table id="table">
			<thead>
				<tr>
					<th colspan="2">Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Top Category:</td>
					<td><select type=\'dropdown\' name=\'topcategory\' >';
						$r = $db->query(sprintf('SELECT * FROM fas_blogcategories'));
						while($ir = $db->fetch_row($r)){
						echo '<option value=\''.$ir['categoryid'].'\'>'.$ir['categoryname'].'</option>'; };
						echo '</select>
					</td>
				</tr>
				<tr>
					<td>Category Name:</td>
					<td><input type=\'text\' name=\'categoryname\' size=\'50\'></td>
				</tr>
				<tr>
					<td>Active:</td>
					<td><select type=\'dropdown\' name=\'activate\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\' >No</option>
						</select></td>
				</tr>
				<tr>
					<td colspan="2"><input type=\'submit\' name=\'submit\' value=\'Add Category\'></td>
				</tr>
			</tbody>
		</table>
	</form>';
};
?>