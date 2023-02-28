<?php
/*
Legge til øvelser i stevne, og endre navn/dato
*/

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		echo "<div class='resbox'><table>";

		if ($con) {
			//Henter stevner
			$q = mysql_query("SELECT * FROM stevne ORDER BY dato");
			while ($a = mysql_fetch_array($q)) {
				printf(
					"<tr><th>%s</th><td>%s</td><td><a href='?side=skor2.php&s=%s'>EDIT</a></td></tr>",
					$a['navn'],
					$a['dato'],
					$a['stevneID']
				);
			}
		} else {
			die("Could not connect - " . mysql_error());
		}

		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
