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
                    <legend>Manage Games:</legend>
                    <div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/games.png\' alt=\'Manage Games\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=gamemanager&case=managegames\'>Games</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/addgame.png\' alt=\'Add Game\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=gamemanager&case=addgame\'>Add Game</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/reports.png\' alt=\'Game Reports\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=gamemanager&case=reportedgames\'>Game Reports</a><br />
			        </div>
			        <div class="boximage">
			        <img src=\''.$domain.'/images/gamecategories.png\' alt=\'Game Categories\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=gamemanager&case=managecategories\'>Game Categories</a><br />
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
