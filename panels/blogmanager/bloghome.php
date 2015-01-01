<?php

echo '<div class="heading">
	<h2>Home</h2>
</div>
<br clear="all">
<table id="table">
	<thead>
		<tr>
			<th colspan="2">'.$sitename.'</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		            <td align="center">
                    <div align="center">

                    <fieldset>
                    <legend>Manage Blogs:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/blogcategories.png\' alt=\'Blog Categories\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=blogmanager&case=manageblogcategories\'>Blog Categories</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/blog.png\' alt=\'Blog Entries\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=blogmanager&case=blogentries\'>Blog Entries</a><br />
			        </div>
			        </div>
			        </fieldset>

                    <fieldset>
                    <legend>Other:</legend>
			        <div class="box">
			        <div class="boximage">
					<img src=\''.$domain.'/images/icon.png\' alt=\'FAS Support\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\'http://freearcadescript.net/forums/index.php?action=forum\' target="_blank">FAS Support</a><br />
			        </div>
			        </div>
			        </fieldset>';

					echo'</td>
				</tr>
			</tbody>
    </table>';
?>
