<?php
/*
F�r stevneID fra slist.php og skriver ut alle �velser registrert til det stevnet
*/

if ($_SESSION['innlogget'] == 1) {
	//Henter fra linja
	$s = $_GET['s'];
	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");
		$a = mysql_fetch_array($q);
		echo "<div class = 'resbox'>";
		printf("<b>%s %s, %s</b><br>", $a['navn'], $a['lokasjon'], $a['dato']);
		$q = mysql_query("SELECT * FROM ovelsepastevne,ovelse WHERE ovelse=ovelseID AND stevne='$s' ORDER BY art , distanse");
		while ($a = mysql_fetch_array($q)) {
			printf("%s %s<br>", $a['distanse'], $a['art']);
		}
		echo "<center><br><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
