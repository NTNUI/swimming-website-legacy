<h2>Medlemsliste NTNUI Sv�mming 2010</h2>
Dette er kun medlemmer hvor kasserer har kontrollert innbetaling eller lisens til annen klubb.<br>
<br>

<?php
		if ($_SESSION['innlogget'] == 1) {
  			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

  			mysql_select_db("REDACTED",$db);
  			$result = mysql_query("SELECT  * FROM  `medlem_2009` WHERE kontrolldato > DATE(  '2010-08-01'  ) ORDER BY etternavn,fornavn " ,$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}

			$n = mysql_num_rows($result) - 1;

			$i = 0;
			while($i<=$n){
					printf("%s,\n", mysql_result($result,$i,"etternavn"));
					printf("%s<br>\n", mysql_result($result,$i,"fornavn"));

				$i++;
			}

  			mysql_close($db);
		}
?>