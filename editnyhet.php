<?php

if ($_SESSION['innlogget'] == 1) {
	//Dersom innlogget
	printf("Innlogget som: ");
	printf($_POST['navn']."<br><br>");

	$db = mysql_connect("REDACTED","REDACTED","REDACTED");

	if(!$db) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("REDACTED",$db);
	$result = mysql_query("SELECT * FROM forside",$db);

	if(!$result) {
		die('Could not query: '.mysql_error());
	}

	$i = 0;
	$n = mysql_num_rows($result) - 1;

	$ekey = $_REQUEST['ekey'];

	if ($ekey == null) {
		while ($n>=0 && $i<10) {
			printf("<b>%s</b><br>\n",mysql_result($result,$n,"overskrift"));
			printf("%s<br>\n",mysql_result($result,$n,"innhold"));
			printf("<small><small>");
			printf("Av: %s\n",mysql_result($result,$n,"av"));
			printf("</small></small><br><br>");
			printf("<center><a href='index.php?side=editnyhet.php&ekey=%d'>Endre</a></center>",mysql_result($result,$n,"nokkel"));
			printf("<hr width=50><br>");
			$n--;
			$i++;
		}
	} else {
		printf("ekey: %d<br>",$ekey);

		$alres = mysql_query("SELECT * FROM forside WHERE nokkel='$ekey'",$db);

		printf("<form action='index.php?side=editnyhet2.php' method='post'>
				<input type='hidden' name='id' size='4' value='%d'>
				Overskrift:<br><input type='text' name='overskrift' value='%s'><br>
				Melding:<br><textarea name='melding' rows='10' cols='75' >%s</textarea><br>
				<input type='submit' value='Gung Ho'><br>",$ekey,mysql_result($alres,0,"overskrift"),mysql_result($alres,0,"innhold"));

		$ekey = null;
	}

	} else {
	printf("Du m� v�re innlogget!!");
	}

?>


