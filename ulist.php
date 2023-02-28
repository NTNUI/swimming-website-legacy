<?php

if ($_SESSION['innlogget'] == 1) {

	//�pner mot database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	mysql_select_db("REDACTED", $con);

	$q = mysql_query("SELECT * FROM utover,klubb WHERE klubb=klubbID ORDER BY etternavn");
	echo "<div class='resbox'><table>";
	echo "<tr><th>Registrerte ut�vere</th><tr>";
	while ($a = mysql_fetch_array($q)) {
		printf(
			"
			<tr><td>%s, %s</t><td>%s</td><td>%d</td>",
			$a['etternavn'],
			$a['fornavn'],
			$a['navn'],
			$a['argang']
		);
	}
	echo "</table><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";

	//Lukker database
	mysql_close($con);
}
