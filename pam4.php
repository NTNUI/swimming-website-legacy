<?php
/*
Legger inn p�meldingstider
Peter E 1108
*/
if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);

		//Henter variable fra POST
		$s = $_POST['stevne'];
		$u = $_POST['utover'];

		$q = mysql_query("SELECT * FROM pamelding,ovelsepastevne,ovelse WHERE svommer='$u' AND ovelsepastevne=opsID AND ovelsepastevne.stevne='$s' AND ovelsepastevne.ovelse=ovelseID");
		//printf ("<tr><td>%s %s</td></tr>",mysql_
		echo "<div class='resbox'><table><tr><th>P�meldt med f�lgende tider</th></tr>";
		while ($a = mysql_fetch_array($q)) {
			/*
			Finner frem pamID for den gjeldende p�melding
			Henter data fra gjeldende form i pamelding3
			*/
			$pamID = $a['pamID'];
			$min = $a[pamID];
			$sec = $a[pamID];
			$min = $min.m;
			$sec = $sec.s;
			$min = $_POST[$min];
			$sec = $_POST[$sec];
			printf("<tr><td>%s %s</td><td>%s:%s</td></tr>",$a['distanse'],$a['art'],$min,$sec);
			mysql_query("UPDATE pamelding SET pam_m='$min' , pam_s='$sec' WHERE pamID='$pamID'");
		}
		echo "</table></div>";
		include("resmenu.php");		
	} else {
		die("Could not connect - ".mysql_error());
	}
}


?>
