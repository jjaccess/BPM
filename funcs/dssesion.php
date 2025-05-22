<?php
function resultBlocksession($dsession){
		if(count($dsession) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($dsession as $dsession)
			{
				echo "<li>".$dsession."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
    }
    ?>