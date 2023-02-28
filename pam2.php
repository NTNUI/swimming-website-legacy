<?php
/*
Her velger man hvilken ut�ver som �nsker � registrere seg
samt hvilke �velser vedkommende �nsker � melde seg op
Sender kun info videre gjennom form
Peter E 1108
*/

if ($_SESSION['innlogget'] == 1) {
	//Kobler til databse
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);

		$stevne = $_GET['s'];

		echo "<form action='?side=pam3.php' method='post'>";

		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$stevne'");
		printf ("<table><tr><td>%s</td>",mysql_result($q,0,"navn"));
		printf ("<td><input type='text' size='1' readonly name='stevne' value=%d></td>",mysql_result($q,0,"stevneID"));

		$q = mysql_query("SELECT * FROM utover");
		echo "<tr><td>Utover</td><td><select name='utover'>";
		while ($a = mysql_fetch_array($q)) {
			printf ("<option value='%d'>%s %s</option>",$a['utoverID'],$a['fornavn'],$a['etternavn']);
		}
		echo "</select></td></tr>";
		echo "<tr><td>Ovelse</td></tr>";
		$q = mysql_query("SELECT * FROM ovelsepastevne WHERE stevne=$s");
		while ($a = mysql_fetch_array($q)) {
			$oid = $a['opsID'];
			$ovelse = $a['ovelse'];
			$k = mysql_query("SELECT art,distanse FROM ovelse WHERE ovelseID=$ovelse");
			$b = mysql_fetch_array($k);
			printf ("<tr><td>%d %s</td><td><input type='checkbox' name=box[] value='%s'></td></tr>",$b['distanse'],$b['art'],$oid);
			}

		echo "<tr><td><br><input type='submit'></form></td></tr></table>";
		mysql_close($con);
	} else {
		die("Could not connect - ".mysql_error());
	}
}

?>