<?php

if ($_SESSION['innlogget'] == 1) {

	//Connect to databse
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	mysql_select_db("REDACTED", $con);

	if ($con) {
		echo "<div class='resbox'>";
		echo "<center><big>Registrere Utover</big></center><br>";
		echo "<table><form action='?side=ureg2.php' method='post'>";
		echo "<tr><td>Fornavn</td><td><input type='text' name='fornavn'></td></tr>";
		echo "<tr><td>Etternavn</td><td><input type='text' name='etternavn'></td></tr>";
		//Henter klubb-data
		$q = mysql_query("SELECT * FROM klubb");
		echo "<tr><td>Klubb</td><td><select name='klubb'>";
		while ($a = mysql_fetch_array($q)) {
			printf("<option value='%s'>%s</option>", $a['klubbID'], $a['navn']);
		}
		echo "</select></td>";
		echo "<tr><td>Aargang</td><td><input type='text' name='argang'></td></tr>";
		echo "<tr><td colspan='2'><input type='submit' value='Go'></td></tr></form></table>";
		echo "<center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}//Innlogget-test