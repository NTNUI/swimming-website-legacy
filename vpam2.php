<?php

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		$s = $_GET['s'];

		$q = mysql_query("SELECT navn,lokasjon FROM stevne WHERE stevneID=$s");
		$a = mysql_fetch_array($q);
		printf("<div class='resbox'><table><tr><th>%s %s</th></tr>", $a['navn'], $a['lokasjon']);

		//Henter ut alle �velser for gjeldende stevne
		$q = mysql_query("
			SELECT * FROM ovelse,ovelsepastevne
			WHERE ovelsepastevne.stevne=$s AND ovelsepastevne.ovelse=ovelse.ovelseID
			ORDER BY ovelse
			");

		//Skriver ut alle personer som tar alle �velser
		while ($a = mysql_fetch_array($q)) {
			//Henter ut p�melding for gjeldende �velse
			$ops = $a['opsID'];
			$k = mysql_query("
				SELECT * FROM pamelding,utover
				WHERE pamelding.ovelsepastevne=$ops AND pamelding.svommer=utover.utoverID
				");
			//Sjekker for � se om det er noen p�meldinger
			if (mysql_num_rows($k) > 0) {
				printf("<tr><th>%s %s</th></tr>", $a['distanse'], $a['art']);
				while ($b = mysql_fetch_array($k)) {
					printf(
						"<tr><td>%s %s</td><td>%s:%s</td></tr>",
						$b['fornavn'],
						$b['etternavn'],
						$b['pam_m'],
						$b['pam_s']
					);
				}
			}
		}

		echo "<tr><td><a href='index.php?side=vpam.php'>Anne stevne</a></td></tr></table>";
		echo "<br><br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";


		//Lukker database
		mysql_close($con);
	}
}
