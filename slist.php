<?php
/*
Skriver ut liste over alle stevner i databasen
Peter E 2008
*/

if ($_SESSION['innlogget'] == 1) {

	//Koblet til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);
		$q = mysql_query("SELECT * FROM stevne");
		echo "<div class='resbox'><table><tr><th>Stevne</th><th>Lokasjon</th><td>Dato</td></tr>";
		while ($a = mysql_fetch_array($q)) {
			printf("<tr><td><a href='?side=slist2.php&s=%s'>%s</a></td><td>%s</td><td>%s</td></tr>", $a['stevneID'], $a['navn'], $a['lokasjon'], $a['dato']);
		}
		echo "</table><center><a href='?side=resmenu.php'>Hovedmeny</a></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
