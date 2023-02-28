<?php
/*
Korrigere stevne, del 2. F�r stevneID fra stevnekor.php
*/
if ($_SESSION['innlogget'] == 1) {
	//Henter data fra linja
	$s = $_GET['s'];

	//Kobler til database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
	if ($con) {
		mysql_select_db("REDACTED", $con);

		//Skjema, og tabell
		echo "<div class='resbox'><table><form action='?side=skor3.php' method='post'>";

		if ($con) {
			//Henter stevneinfo
			$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");
			$a = mysql_fetch_array($q);
			printf(
				"<tr><td><input type='text' size='1' readonly name='stevne' value=%s></td>
				<th>%s</th><td><input type='text' size='9' name='date' value='%s'></td></tr>",
				$s,
				$a['navn'],
				$a['dato']
			);

			//Henter �velser som ikke er med p� stevnet
			$q = mysql_query("SELECT * FROM ovelse");
			while ($a = mysql_fetch_array($q)) {
				$o = $a['ovelseID'];
				$k = mysql_query("SELECT * FROM ovelsepastevne WHERE ovelse='$o' AND stevne='$s'");
				if (mysql_num_rows($k) == 0) {
					printf(
						"<tr><td><input type='checkbox' name=box[] value=%s></td><td>%s %s</td></tr>",
						$o,
						$a['distanse'],
						$a['art']
					);
				}
			}
			echo "<tr><td colspan='2'><input type='submit'></td></tr>";
		} else {
			die("Could not connect - " . mysql_error());
		}

		echo "</form></table></div>";
	} else {
		die("Could not connect - " . mysql_error());
	}
}
