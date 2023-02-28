<?php

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);

		$p = $_GET['r'];

		//Henter p�meldingen
		$q = mysql_query("SELECT * FROM pamelding,utover,ovelse,ovelsepastevne
			WHERE pamID='$p' AND svommer=utoverID AND pamelding.ovelsepastevne=opsID
			AND ovelsepastevne.ovelse=ovelseID");
		$a = mysql_fetch_array($q);
		echo "<div class='resbox'><table><form action='?side=rkor2.php' method='post'>";
		printf ("<tr><td><input type=text' size='2' readonly name='pam' value=%s></td><th>%s %s</th><td>%s %s</td></tr>",
			$a['pamID'],$a['fornavn'],$a['etternavn'],$a['distanse'],$a['art']);
		printf ("<th>Tid</th><td><input type='text' size='3' name='res_m' value=%s>
			<input type='text' size='3' name='res_s' value=%s></td></tr>",
			$a['res_m'],$a['res_s']);
		printf ("<tr><th>Poeng</th><td><input type='text' size='3' name='poeng' value=%s></td></tr>",$a['poeng']);
		echo "<tr><td colspan='2'><input type='submit'></td></tr></form></table>";
		echo "<br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>":

		//Lukker database
		mysql_close($con);
	} else {
		die("Could not connect - ".mysql_error());
	}
}
?>