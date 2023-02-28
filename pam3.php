<?php
/*
Her blir p�meldingene gjort
stevneID og utoverID blir lagt inn i skjema som bokser man ikke kan editere
Peter E 1108
*/

if ($_SESSION['innlogget'] == 1) {
	//Kobler til databse
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		//Henter variable fra POST
		$s = $_POST['stevne'];
		$u = $_POST['utover'];
		//Starter skjema
		echo "<tr><td><form action='?side=pam4.php' method='post'></td></tr>";
		//Henter info om stevne
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");
		$a = mysql_fetch_array($q);
		printf ("<table><tr><td><input type='text' size='1' readonly name ='stevne' value=%d></td>",$a['stevneID']);
		printf ("<td>%s</td></tr>",$a['navn']);
		//Henter ut navn p� ut�veren
		$q = mysql_query("SELECT * FROM utover WHERE utoverID='$u'");
		$a = mysql_fetch_array($q);
		printf ("<tr><td><input type='text' size='1' readonly name ='utover' value='%d'></td>",$a['utoverID']);
		printf ("<td>%s %s</td></tr>",$a['fornavn'],$a['etternavn']);
		echo "<tr><td>F�r inn p�meldingstider</td></tr>";
		//antall �velser
		$n = 0;
		while (list($key,$val) = @each ($box)) {
			//Legger inn p�meldinger uten tid
			mysql_query("INSERT INTO pamelding (svommer , ovelsepastevne , resreg ) VALUES ('$u' , '$val' , '0')");
			//Henter ut id for disse p�meldinger
			$k = mysql_query("SELECT pamID FROM pamelding WHERE svommer='$u' AND ovelsepastevne='$val'");
			//Henter ut navn p� �velser, $val er n� opsID
			$q = mysql_query("SELECT distanse,art FROM ovelse,ovelsepastevne WHERE ovelsepastevne.ovelse=ovelse.ovelseID AND opsID='$val'");
			printf ("<tr><td>%d %s</td>",mysql_result($q,0,"distanse"),mysql_result($q,0,"art"));
			echo "<td><input type='text' size='2' name='".mysql_result($k,0,"pamID").m."' value='00'><input type='text' size='4' name='".mysql_result($k,0,"pamID").s."' value='00'><td></tr>";
			$n++;
		}
		echo "<tr><td><input type='submit'></form></td></tr></table>";
		//Lukker database
		mysql_close($con);
	}		
}
?>