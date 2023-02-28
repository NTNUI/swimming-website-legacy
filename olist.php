<?php
/*
Skriver ut liste over alle �velser i database

Peter E 2008

*/

if ($_SESSION['innlogget'] == 1) {
	
	//Koblet til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);		
		$q = mysql_query("SELECT * FROM ovelse ORDER BY art ASC , distanse ASC");
		echo "<div class='resbox'><table><tr><th>�velse</th></tr>";
		while ($a = mysql_fetch_array($q)) {
			printf("<tr><td>%s %s</td></tr>",$a['distanse'],$a['art']);
		}
		echo "</table><center><a href='?side=resmenu.php'>Hovedmeny</a></div>";
	} else {
		die("Could not connect - ".mysql_error());
	}
}
?>