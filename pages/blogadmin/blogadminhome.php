
		<table width="100%">
				<tr>
					<td class="header" valign="top" >Blog Admin Panel</td>
				</tr>
				<tr>
					<td class="content" valign="top" >
					<?php
					echo '
						
						<a href=\''.$domain.'/index.php?action=blogadmin&case=blogentries\'>Blog Entries</a><br>
						<a href=\''.$domain.'/index.php?action=blogadmin&case=blogentries&cmd=newentry\'>New Entry</a><br>
						<a href=\''.$domain.'/index.php?action=blogadmin&case=addblogcategory\'>Add Blog Category</a><br>
						<a href=\''.$domain.'/index.php?action=blogadmin&case=manageblogcategories\'>Manage Blog Categories</a><br>
						<a href=\''.$domain.'/index.php?action=blogadmin&case=approveblogcomments\'>Approve Blog Comments</a><br>
					</ul>';
					?>
					</td>
				</tr>
			</table>
