<h2>Detaljert medlemsliste NTNUI Sv�mming 2010</h2>
Denne viser alle medlemmer, ogs� de som ikke er bekreftet innbetalt<br>
<br>

<?php
		if ($_SESSION['innlogget'] == 1) {
  			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

  			mysql_select_db("REDACTED",$db);
  			$result = mysql_query("SELECT * FROM `medlem_2009` WHERE kontrolldato > DATE(  '2009-08-01'  ) ORDER BY etternavn, fornavn" ,$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}

			$n = mysql_num_rows($result) - 1;

			$i = 0;
			while($i<=$n){
					printf("%s, \n", mysql_result($result,$i,"etternavn"));
					printf("%s, \n", mysql_result($result,$i,"fornavn"));
					printf("%s-", mysql_result($result,$i,"dag"));
					printf("%s-", mysql_result($result,$i,"mnd"));
					printf("%s, \n", mysql_result($result,$i,"aar"));
					printf("%s, \n", mysql_result($result,$i,"postnr"));
					printf("%s, \n", mysql_result($result,$i,"adresse"));
					printf("<a href='mailto:%s'>Mail</a>   <br>\n", mysql_result($result,$i,"epost"));


				$i++;
			}
			mysql_close($db);
			printf("<br>Det er totalt $i registrerte medlemmer.");
		}
?>