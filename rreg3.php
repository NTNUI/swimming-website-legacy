<?php

if ($_SESSION['innlogget'] == 1) {
	//Kobler til databse
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		//Henter POST-data
		$s = $_POST['stevne'];

		//Henter info om stevne
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");
		printf("<table><tr><th>%s</th></tr>", mysql_result($q, 0, "navn"));

		//Henter �velser p� stevne
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
				AND resreg=0
				");
			if (mysql_num_rows($k) > 0) {
				printf("<tr><th>%s %s</th></tr>", $a['distanse'], $a['art']);
				while ($b = mysql_fetch_array($k)) {
					$pam = $b['pamID'];
					$r_m = $pam . m;
					$r_s = $pam . s;
					$pts = $pam . p;
					$r_m = $_POST[$r_m];
					$r_s = $_POST[$r_s];
					$pts = $_POST[$pts];
					if ($r_s != "") {
						printf(
							"<tr><td>%s %s %s</td>
						<td>%s:%s</td>",
							$b['pamID'],
							$b['fornavn'],
							$b['etternavn'],
							$r_m,
							$r_s
						);
						mysql_query("UPDATE pamelding set res_m='$r_m' , res_s='$r_s' , poeng='$pts' , resreg=1
							WHERE pamID='$pam'");
					}
				}
			}
		}

		echo "</table>";
		//Lukke database
		mysql_close($con);
	} else {
		die("Could not connnect - " . mysql_error());
	}
}
