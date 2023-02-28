<h2>Nye medlemmer NTNUI Sv�mming 2009</h2>
Dette er kun medlemmer hvor kasserer enn� ikke har godkjent innbetaling eller lisens fra annen klubb.<br>
<br>

<?php
		if ($_SESSION['innlogget'] == 1) {
  			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

  			mysql_select_db("REDACTED",$db);
  			$result = mysql_query("SELECT * FROM medlem_2009 WHERE kontrolldato IS NULL ORDER BY regdato" ,$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}

			$n = mysql_num_rows($result) - 1;

			$i = 0;
			while($i<=$n){
					printf("%s  \n", mysql_result($result,$i,"regdato"));
					printf("%s,\n", mysql_result($result,$i,"etternavn"));
					printf("%s  \n", mysql_result($result,$i,"fornavn"));
					printf("<a href='index.php?side=medlemsregmottak.php&id=%s'>Godkjenn</a>\n", mysql_result($result,$i,"id"));
					printf("%s<br>\n", mysql_result($result,$i,"kommentar"));

				$i++;
			}

  			mysql_close($db);
		}
?>