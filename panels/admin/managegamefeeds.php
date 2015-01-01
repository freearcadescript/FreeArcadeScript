<?php

echo '<div class="heading">
	<h2>Manage Game Feeds</h2>
</div>
<br clear="all">
<table id="table">
	<thead>
		<tr>
			<th colspan="2">Choose Game Feed</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		          <td align="center">
              <div align="center"> Here is a list of Games Feeds that are currently supported.<br /><br />';
			        echo '<div class="box">
			        <div class="boximage">
			        <img src=\''.$domain.'/images/agf.png\' alt=\'Arcade Game Feed\' width=\'55\' height=\'55\' border=\'0\'><br /><a href=\''.$domain.'/index.php?action=admin&case=manageagf\'>Arcade Game Feed</a><br />
			        </div>
			        </div>';

					echo'</td>
				</tr>
			</tbody>
    </table>';
?>
