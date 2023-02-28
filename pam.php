<?php
/*
Her velger man hvilket stevne man �nsker � gj�r p�melding for
stevneID blir sendt videre i adresse-linjen
Peter E 1108
*/
if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");

	if ($con) {
		mysql_select_db("REDACTED",$con);
		$q = mysql_query("SELECT * FROM stevne ORDER BY dato DESC");
		echo "<div class='resbox'>Velg stevne<br><br><table>";
		while ($a = mysql_fetch_array($q)) {
			printf("<tr>
				<td><a href='?side=pam2.php&s=%d'>Velg</a></td>
				<td>%s</td><td>%s</td><td>%s</td></tr>",$a['stevneID'],$a['navn'],$a['lokasjon'],$a['dato']);
		}
		echo "</table>";
		echo "<br><center><a href='?side=resmenu.php'>Hovedmeny</a></center></div>";
		//Lukker database
		mysql_close($con);
	} else {
		die('Could not connect: ' . mysql_error());
	}


}

?>