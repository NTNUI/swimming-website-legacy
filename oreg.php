<?php

if ($_SESSION['innlogget'] == 1) {
	
	echo "<div class='resbox'><center><big>Registrere øvelse</center</big><table>";
	echo "<form action='?side=oreg2.php' method='post'>";
	echo "<tr><td>Distanse</td><td><input type='text' name='distanse'></td></tr>";
	echo "<tr><td>Art</td><td><input type='text' name='art'></td></tr>";
	echo "<tr><td colspan='2'><input type='submit'></td></tr>";
	echo "</form></table><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
}

?>