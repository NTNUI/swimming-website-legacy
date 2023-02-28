<?php

if ($_SESSION['innlogget'] == 1) {
	$s = $_GET['s'];

	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");

	if ($con) {
		mysql_select_db("REDACTED", $con);

		//Navn p� stevne
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID=$s");
		$a = mysql_fetch_array($q);
		echo "<div class='resbox'><table><tr><th>" . $a['navn'] . "</th></tr>";

		//Hvilke �velser som er p� stevnet
		$q = mysql_query("SELECT * FROM ovelse,ovelsepastevne
			WHERE ovelsepastevne.stevne=$s AND ovelsepastevne.ovelse=ovelseID
			ORDER BY art ASC , distanse ASC");
		while ($a = mysql_fetch_array($q)) {
			//Henter ut ut�vere for hvert resultat
			$ops = $a['opsID'];
			$k = mysql_query("SELECT * FROM pamelding,utover
				WHERE pamelding.ovelsepastevne='$ops' AND pamelding.svommer=utoverID AND resreg=1
				ORDER BY res_m ASC , res_s ASC");
			//Tester for � se om det er noen p�meldinger
			if (mysql_num_rows($k) > 0) {
				printf("<tr><th>%s %s</th></tr>", $a['distanse'], $a['art']);
				//Teller plassering
				$ctr = 1;
				while ($b = mysql_fetch_array($k)) {
					printf(
						"<tr><th>%s</th><td>%s %s</td><td>%s</td><td>%s:%s</td>",
						$ctr,
						$b['fornavn'],
						$b['etternavn'],
						$b['klubb'],
						$b['res_m'],
						$b['res_s']
					);
					printf("<td><a href='?side=rkor.php&r=%s'>EDIT</a></td></tr>", $b['pamID']);
					$ctr++;
				}
			}
		}
		echo "</table><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
