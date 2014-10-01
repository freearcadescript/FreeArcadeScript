<?php
         $query = "SELECT * FROM fas_categories WHERE ID=$ID";
	 $result = mysql_query($query);

         $name = mysql_result($result, 0, "Name");
         $metadescr = mysql_result($result, 0, "metadescr");

		echo'<h1>'.$name.' Games</h1>';
                echo'<h2>'.$metadescr.'</h2>';

?>