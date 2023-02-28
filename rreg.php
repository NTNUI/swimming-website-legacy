<?php
/*
Her registreres resultater
F�rst m� man velge stevne
*/

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);
		echo "<div class='resbox'><table><tr><th>Velg Stevne</th></tr>";
		$q = mysql_query("SELECT * FROM stevne");
		while ($a = mysql_fetch_array($q)) {
			printf("<tr><td><a href='index.php?side=rreg2.php&s=%d'>%s</a></td><td>%s</td></tr>", $a['stevneID'], $a['navn'], $a['dato']);
		}
		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
		//Lukker database
		mysql_close($con);
	} else {
		die("Could not connect - " . mysql_error());
	}
}
