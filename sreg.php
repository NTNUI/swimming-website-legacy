<?php

if ($_SESSION['innlogget'] == 1) {

	echo "<div class='resbox'><center><big>Registrere stevne</center</big><table>";
	echo "<form action='?side=sreg2.php' method='post'>";
	echo "<tr><td>Navn</td><td><input type='text' name='navn'></td></tr>";
	echo "<tr><td>Lokasjon</td><td><input type='text' name='lokasjon'></td></tr>";
	echo "<tr><td>Dato</td><td><input type='text' name='dato'></td></tr>";
	echo "<tr><td colspan='2'>�velser</td></tr>";

	//Skriver ut �velser
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");

	if ($con) {
		mysql_select_db("REDACTED", $con);
		$q = mysql_query("SELECT * FROM ovelse ORDER BY art,distanse");
		echo "<div class='resbox'><table>";
		while ($a = mysql_fetch_array($q)) {
			printf(
				"<tr><td><input type='checkbox' name=box[] value='%s'>%s %s</td></tr>",
				$a['ovelseID'],
				$a['distanse'],
				$a['art']
			);
		}

		echo "<tr><td><input type='submit'></form></td></tr>";
		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
