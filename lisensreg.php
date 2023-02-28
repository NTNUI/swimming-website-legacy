<h2>Ikke viderebetalte lisenser 2010</h2>
Dette er kun medlemmer hvor kasserer enn� ikke har betalt lisensen videre til NSF.<br>
<br>

<?php
		if ($_SESSION['innlogget'] == 1) {
  			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

  			mysql_select_db("REDACTED",$db);
  			$result = mysql_query("SELECT * FROM medlem_2009 WHERE kontrolldato IS NOT NULL AND lisensdato IS NULL ORDER BY etternavn, fornavn" ,$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}

			$n = mysql_num_rows($result) - 1;

			$i = 0;
			while($i<=$n){
					printf("%s,\n", mysql_result($result,$i,"etternavn"));
					printf("%s,  \n", mysql_result($result,$i,"fornavn"));
					printf("%s,  \n", mysql_result($result,$i,"kjonn"));
					printf("%s-\n", mysql_result($result,$i,"dag"));
					printf("%s-\n", mysql_result($result,$i,"mnd"));
					printf("%s,   \n", mysql_result($result,$i,"aar"));
					printf("%s,   \n", mysql_result($result,$i,"postnr"));
					printf("%s,   \n", mysql_result($result,$i,"adresse"));
					printf("<a href='index.php?side=lisensregmottak.php&id=%s'>Viderebetalt</a>\n", mysql_result($result,$i,"id"));

					printf("   %s   \n<br>", mysql_result($result,$i,"kommentar"));

				$i++;
			}

  			mysql_close($db);
		}
?>