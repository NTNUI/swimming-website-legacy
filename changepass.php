<?php
	if ($_SESSION['innlogget'] == 1) {
	printf("Innlogget som: ");
	printf($_SESSION['navn']);
	printf("<br>");

	$oldpass = $_POST['oldpass'];
	$nypass1 = $_POST['nypass1'];
	$nypass2 = $_POST['nypass2'];
	$navn = $_SESSION['navn'];

	//bytter brukernavn og passord hvis utfyllt riktig
	if($oldpass != null){
		if($nypass1 == $nypass2){
				$db = mysql_connect("REDACTED", "REDACTED","REDACTED");
				if (!$db) {
				   die('Could not connect: ' . mysql_error());
				}

				mysql_select_db("REDACTED",$db);
				$result = mysql_query("SELECT * FROM users WHERE name = '$navn'",$db);
				if (!$result) {
					die('Could not query:' . mysql_error());
				}
				$db_id = mysql_result($result, $n, "id");
				$db_passwd = mysql_result($result,$n, "passwd");

				if(MD5 ($oldpass) == $db_passwd){
					mysql_query("UPDATE `users` SET `passwd` = MD5( '$nypass1' ) WHERE `id` = '$db_id' LIMIT 1;",$db);
					printf("Passord endret for bruker!");
				}else{
					printf("Du har tastet det gamle passordet ditt feil!<br>");
				}
				mysql_close($db);

		}else{
			printf("De to kolonnene med nytt passord var ikke like!<br>");
		}
	}

		//utfyllings skjema
		printf("
			<table border='0'>
				<tr>
					<form method='post' action='index.php?side=changepass.php'>
					<td>Gammel passord:</td>
					<td><input type='password' name='oldpass'></td>
				</tr>
				<tr>
					<td>Nytt passord:</td>
					<td><input type='password' name='nypass1'></td>
				</tr>
				<tr>
					<td>Nytt passord enda en gang:</td>
					<td><input type='password' name='nypass2'></td>
				</tr>
				<tr>
					<td>
						<input type='hidden' name='action' value='login'>
						<input type='submit' value='Bytt passord'>
					</td>
				</tr>
			</form>
			</table>");
	}

?>