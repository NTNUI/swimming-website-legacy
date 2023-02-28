<html>
	<body>
		<h2>Velkommen til NTNUI Sv�mming</h2>
		
        ================================================================================
        For English. Press "English" on the right side of the menu.
        ================================================================================      
        
		================================================================================
		Hvis du har sp�rsm�l ang�ende medlemsskap. Ta en titt p� Ofte Stilte Sp�rsm�l(til h�yre i menyen). Der kan du finne svaret p� det du lurer p�. Vi ber om at du leser igjennom dette f�r du sender mail med eventuelle sp�rsm�l.
		================================================================================
		
Sv�mmegruppen er en bredt sammensatt gruppe med alt fra mosjonssv�mmere til norgesmestere. H�per du liker treningstilbudet i sv�mmegruppen. All informasjon om gruppen er � finne p� sidene her. Klikk deg inn p� Medlemskap for � se hvordan du melder deg inn. Dersom det er ting du lurer p� som du ikke finner p� sidene eller saker du vil foresl� for styret,
s� kan du sende mail til REDACTED s� svarer vi etter beste evne.<br>

        <hr>

		<h3>Nyheter / News:</h3>
		<?php

  			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

  			mysql_select_db("REDACTED",$db);
  			$result = mysql_query("SELECT * FROM forside",$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}

			$i = 0;
			$n = mysql_num_rows($result) - 1;


			while($n>=0 && $i<10){

				printf("<b>%s</b><br>\n", mysql_result($result,$n,"overskrift"));
  				printf("%s<br>\n", mysql_result($result,$n,"innhold"));
  				printf("<small><small>");
  					printf("Av: %s\n", mysql_result($result,$n,"av"));
  					printf("Tid: %s<br>\n", mysql_result($result,$n,"tid"));
  				printf("</small></small>");
  				printf("<br>");

				$n--;
				$i++;
			}


  			mysql_close($db);
		?>
	</body>

</html>
