<?php
/*
Viser resultater
*/

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);

		echo "<div class='resbox'><table><tr><th>Velg stevne</th></tr>";

		//Henter ut alle stevner
		$q = mysql_query("SELECT * FROM stevne ORDER BY dato");
		while ($a = mysql_fetch_array($q)) {
			printf ("<tr><td><a href='?side=rlist2.php&s=%s'>%s</a></td><td>%s</td></tr>",
				$a['stevneID'],$a['navn'],$a['dato']);
		}

		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";

		//Lukker databbase
		mysql_close($con);
	} else {
		die("Could not connect - ".mysql_error());
	}
}
?>