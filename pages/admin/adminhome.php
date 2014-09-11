
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
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=addcategory\'>Add Category</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managecategories\'>Manage Categories</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=blogentries\'>Blog Entries</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=blogentries&cmd=newentry\'>New Entry</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=addblogcategory\'>Add Blog Category</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=manageblogcategories\'>Manage Blog Categories</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=approveblogcomments\'>Approve Blog Comments</a><br>
					      <p>

						<a href=\''.$domain.'/index.php?action=admin&case=addlink\'>Add Link</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managelinks\'>Manage Links</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=approvecomments\'>Approve Comments</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=settings\'>Site Settings</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=ads\'>Manage Ads</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=managemembers\'>Manage Memebers</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=newsletter\'>Manage Newsletters</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=newsletter&cmd=newnewsletter\'>New Newsletter</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=pageentries\'>Page Entries</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=pageentries&cmd=newentry\'>New Page</a><br>
                                    <p>
						<a href=\''.$domain.'/index.php?action=admin&case=addpagecategory\'>Add Page Category</a><br>
						<a href=\''.$domain.'/index.php?action=admin&case=managepagecategories\'>Manage Page Categories</a><br>

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
