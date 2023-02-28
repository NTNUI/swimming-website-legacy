<?php
	//hvis innlogget
	if ($_SESSION['innlogget'] == 1) {
		printf("Innlogget som: ");
		printf($_SESSION['navn']);
		printf("
			<br><b>Skriv p� forsiden:</b><br>
			<form action='index.php?side=nyhet.php' method='post'>
			Overskrift:<br><input type='text' name='overskrift' size='36' maxlength='36'><br>
			Melding:<br><textarea name='melding' rows='3' cols='50'></textarea><br>
			<input type='submit' value='Sett inn melding'><input type='reset' value='T�m skjema'>");

		//poste p� forsiden

		$melding = $_POST['melding'];
		$overskrift = $_POST['overskrift'];
		$navn = $_SESSION['navn'];

		if($melding != null){

			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");
				if (!$db) {
				   die('Could not connect: ' . mysql_error());
				}

			mysql_select_db("REDACTED",$db);
			mysql_query("INSERT INTO `forside` ( `nokkel` , `av` , `tid` , `overskrift` , `innhold` ) VALUES ( '', '$navn', NOW( ) , '$overskrift', '$melding');",$db);
			mysql_close($db);
			printf("Din melding er lagt ut p� forsiden!");

		}

	}else{
	printf("Du m� logge inn for � f� tilgang til denne siden!");
	}
?>