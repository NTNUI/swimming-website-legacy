<?php

if ($_SESSION['innlogget'] == 1) {

	$fornavn = $_POST['fornavn'];
	$etternavn = $_POST['etternavn'];
	$klubb = $_POST['klubb'];
	$argang = $_POST['argang'];

	echo "<table>";

	if (($fornavn == "") || ($etternavn == "") || ($argang == "")) {
		echo "<tr><td>Vennligst fyll inn all iformasjon</td></tr>";
		echo "</table>";
		include("ureg.php");
	} else {
		$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");

		if ($con) {
			mysql_select_db("REDACTED", $con);
			$q = mysql_query("SELECT * FROM utover WHERE fornavn LIKE '$fornavn' AND argang='$argang'");
			if (mysql_num_rows($q) > 0) {
				printf("<tr><th colspan='2'>Fant lignende person i databasen</th></tr>");
				while ($a = mysql_fetch_array($q)) {
					printf("<tr><th>%s %s</th><td>Ingen ut�ver registrert</tr>", $a['fornavn'], $a['etternavn']);
					echo "</table>";
					include("ureg.php");
				}
			} else {
				mysql_query("INSERT INTO utover (fornavn,etternavn,klubb,argang) VALUES ('$fornavn','$etternavn','$klubb','$argang')");
				printf("<tr><th>%s %s</th><td>f�dt %d</td></tr>", $fornavn, $etternavn, $argang);
				printf("<tr><td>Ble registrert</td></tr>");
				echo "</table>";
				mysql_close($con);
				include("resmenu.php");
			}
		} else {
			die("Could not connect" . mysql_error());
		}
		//Lukker database
	}
}//Innlogget-test
