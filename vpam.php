<?php

/*
Vise alle p�meldinger gjort
*/

if ($_SESSION['innlogget'] == 1) {
	//Koble til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		echo "<div class='resbox'><table><tr><th>Velg stevne</td></tr>";

		$q = mysql_query("SELECT * FROM stevne ORDER BY dato");

		while ($a = mysql_fetch_array($q)) {
			printf("<tr><td><a href='index.php?side=vpam2.php&s=%d'>%s %s</a></td></tr>", $a['stevneID'], $a['navn'], $a['lokasjon']);
		}
		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";

		//Lukker database
		mysql_close($con);
	}
}
