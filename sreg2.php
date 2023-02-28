<?php

if ($_SESSION['innlogget'] == 1) {

	//Henter post-data
	$n = $_POST['navn'];
	$l = $_POST['lokasjon'];
	$d = $_POST['dato'];

	if (($n == "") || ($l == "") || ($d == "")) {
		echo "<center><big>Vennligst fyll ut all info</big></center>";
		include("sreg.php");
	} else {
		//Kobler til database
		$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");

		if ($con) {
			mysql_select_db("REDACTED", $con);
			//Sjekker om stevnet alt er registrert
			$q = mysql_query("SELECT * FROM stevne WHERE navn='$n' AND lokasjon='$l' AND dato='$d'");

			if (mysql_num_rows($q) > 0) {
				echo "<center><big>Stevne allerede registrert</big></center>";
			} else {
				//Legger inn stevnet
				printf("<center>Stevne: %s, i %s, dato: %s registrert</center>", $n, $l, $d);
				mysql_query("INSERT INTO stevne (navn,lokasjon,dato) VALUES ('$n','$l','$d')");
				//Legger inn �velser
				$q = mysql_query("SELECT stevneID,navn FROM stevne WHERE navn='$n' AND lokasjon='$l'");
				$a = mysql_fetch_array($q);
				$stevne = $a['stevneID'];
				echo "Med f�lgende �velser<br>";
				while (list($key, $val) = @each($box)) {
					mysql_query("INSERT INTO ovelsepastevne (stevne,ovelse) VALUES ('$stevne','$val')");
					$q = mysql_query("SELECT art,distanse FROM ovelse WHERE ovelseID='$val'");
					$a = mysql_fetch_array($q);
					printf("%d %s<br>", $a['distanse'], $a['art']);
				}
			}
			include("resmenu.php");
		} else {
			die("Could not connect - " . mysql_error());
		}
	}
}
