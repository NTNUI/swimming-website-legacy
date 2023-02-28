<?php

if ($_SESSION['innlogget'] == 1) {
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		$q = mysql_query("SELECT * FROM kurs,instruktor WHERE instruktor=instID");
		echo "<div class='resbox'>";
		while ($a = mysql_fetch_array($q)) {
			printf("%s :: %s %s <a href='?side=kurs.php&k=%s'>INFO</a><br>",$a['navn'],$a['fornavn'],$a['etternavn'],$a['kursID']);
		}
		$k = $_GET['k'];
		if ($k != "") {
			$q = mysql_query("SELECT * FROM pamelding WHERE kurs='$k'");
			echo "<table><tr><th colspan='4'>Deltakere</th></tr>";
			while ($a = mysql_fetch_array($q)) {
				printf("<tr><td>%s %s</td><td>%s</td><td>%s</td></tr>",$a['fornavn'],$a['etternavn'],$a['mail'],$a['tlf']);
			}
			echo "</table>";
		}
		echo "</div>";
		mysql_close($con);
	} else {
		die ("Could not connect".mysql_error());
	}
}

?>