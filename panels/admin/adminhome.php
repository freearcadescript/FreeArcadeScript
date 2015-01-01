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
                    <div align="center">';
			        echo '<fieldset>
                    <legend>Manage Settings:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/settings.png\' alt=\'Settings\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=settings\'>Settings</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/ads.png\' alt=\'Manage Ads\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=ads\'>Ads</a><br />
			        </div>
			        <div class="boximage">
					<img src=\''.$domain.'/images/socialmedia.png\' alt=\'Social Media\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=socialmedia\'>Social Media</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/themes.png\' alt=\'Manage Themes\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=themes\'>Themes</a><br />
			        </div>
			        </div>
			        </fieldset>

                    <fieldset>
                    <legend>Manage Games:</legend>
                    <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/games.png\' alt=\'Manage Games\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managegames\'>Games</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/addgame.png\' alt=\'Add Game\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=addgame\'>Add Game</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/reports.png\' alt=\'Game Reports\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=reportedgames\'>Game Reports</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/feeds.png\' alt=\'Game Feeds\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managegamefeeds\'>Game Feeds</a><br />
			        </div>
			        </div>
				    </fieldset>

                    <fieldset>
                    <legend>Manage Categories:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/gamecategories.png\' alt=\'Game Categories\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managecategories\'>Game Categories</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/blogcategories.png\' alt=\'Blog Categories\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=manageblogcategories\'>Blog Categories</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/pagecategories.png\' alt=\'Page Categories\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managepagecategories\'>Page Categories</a><br />
			        </div>
			        </div>
			        </fieldset>

                    <fieldset>
                    <legend>Manage Members:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/members.png\' alt=\'Manage Members\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managemembers\'>Members</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/comments.png\' alt=\'Game Comments\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managegamecomments\'>Game Comments</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/blogcomments.png\' alt=\'Blog Comments\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=manageblogcomments\'>Blog Comments</a><br />
			        </div>
			        </div>
			        </fieldset>

                    <fieldset>
                    <legend>Manage News and Blogs:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/news.png\' alt=\'News Letter\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=newsletter\'>News Letter</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/blog.png\' alt=\'Blog Entries\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=blogentries\'>Blog Entries</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/pages.png\' alt=\'Page Entries\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=pageentries\'>Page Entries</a><br />
			        </div>
			        </div>
			        </fieldset>

                    <fieldset>
                    <legend>Other:</legend>
			        <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/links.png\' alt=\'Manage Links\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=managelinks\'>Links</a><br />
			        </div>
			        <div class="boximage">
					<img src=\''.$domain.'/images/fasnews.png\' alt=\'FAS News\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=fasnews\'>FAS News</a><br />
			        </div>
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
