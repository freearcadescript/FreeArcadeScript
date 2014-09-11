
		<table width="100%">
				<tr>
					<td colspan="2" class="header" valign="top" >Admin Panel</td>
				</tr>
				<tr>
					<td class="content" valign="top" >
					<?php
					echo '
						<a href=\''.$domain.'/index.php?action=admin&case=addgame\'>Add Game</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managegames\'>Manage Games</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=addcategory\'>Add Category</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managecategories\'>Manage Categories</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=addlink\'>Add Link</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managelinks\'>Manage Links</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=approvecomments\'>Approve Comments</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=settings\'>Site Settings</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managemembers\'>Manage Memebers</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=newsletter\'>Manage Newsletters</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=newnewsletter\'>New Newsletter</a><br>
					</ul>';
					?>
					</td>

					<td class="content" valign="top" align="center" >
					 <IFRAME SRC="http://freearcadescript.net/adminsectioninsert.php" width=450 height=900 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling="yes"></IFRAME> 
                              <?php  // include "http://freearcadescript.net/adminsectioninsert.php" ;
                               ?>
					</td>
				</tr>
			</table>
