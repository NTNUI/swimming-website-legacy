<?php

if ($_SESSION['innlogget'] == 1) {
	//Koble til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		$s = $_GET['s'];

		//Henter info om stevne
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");
		echo "<table><form action='index.php?side=rreg3.php' method='post'>";
		printf(
			"<tr><td><input type='text' size ='1' readonly name='stevne' value=%s></td>",
			mysql_result($q, 0, "stevneID")
		);
		printf("<th colspan='2'>%s</th></tr>", mysql_result($q, 0, "navn"));

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
				WHERE pamelding.ovelsepastevne=$ops AND pamelding.svommer=utover.utoverID AND resreg=0
				");
			if (mysql_num_rows($k) > 0) {
				printf("<tr><th>%s %s</th></tr>", $a['distanse'], $a['art']);
				while ($b = mysql_fetch_array($k)) {
					$r_m = $b['pamID'] . m;
					$r_s = $b['pamID'] . s;
					$pts = $b['pamID'] . p;
					printf(
						"<tr><td>%s %s</td>
					<td><input type='text' size='3' name='$r_m'></td>
					<td><input type='text' size='3' name='$r_s'></td></tr>
					<tr><td>Poeng</td><td><input type='text' size='3' name='$pts'></td></tr>",
						$b['fornavn'],
						$b['etternavn']
					);
				}
			}
		}

		echo "</select></td></tr><tr><td><input type='submit'></td></tr>";
		echo "</form><tr><td><a href='?p=resreg.php'>Annet stevne</a></td></tr></table>";

		//Lukker database
		mysql_close($con);
	} else {
		die("Could not connect - " . mysql_error());
	}
}
