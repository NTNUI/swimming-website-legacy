<h2>Admin</h2>

<?php
	//sjekk brukernavn og passord hvis ikke allerede innlogget

	$bruker = $_POST['bruker'];
	$pass = $_POST['pass'];

	if(!isset($_SESSION['innlogget'])){
		if($bruker != null){
			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");

			if (!$db) {
			   die('Could not connect: ' . mysql_error());
			}

			mysql_select_db("REDACTED",$db);
			$result = mysql_query("SELECT * FROM users WHERE username = '$bruker'",$db);

			if (!$result) {
			   die('Could not query:' . mysql_error());
			}
			$db_username = mysql_result($result, $n, "username");
			$db_passwd = mysql_result($result,$n, "passwd");

			if($bruker == $db_username && md5($pass) == $db_passwd) {
				//sette innlogget flagget h�yt
				$_SESSION['innlogget'] = 1;
				$_SESSION['navn'] = mysql_result($result,$n,"name");
				//printf("Innlogging suksessfull som: %s\n<br>", mysql_result($result,$n,"name"));
			}else{
				printf("Feil brukernavn eller passord!");
			}

			mysql_close($db);
		}
	}

	//hvis innlogget
	if ($_SESSION['innlogget'] == 1) {
		printf("Innlogget som: ");
		printf($_SESSION['navn']);
		printf("<br><br>");
		printf("<a href='index.php?side=nyhet.php'>Skriv nytt innlegg p� forsiden</a><br>");
		printf("<a href='index.php?side=editnyhet.php'>Endre innlegg</a><br>");
		printf("<a href='index.php?side=arkivuppload.php'>Arkivopplasting</a><br>");
		printf("<a href='index.php?side=programuppload.php'>Programopplasting</a><br><br>");

		printf("<a href='index.php?side=medlemsliste.php'>Medlemsliste</a> (Det er denne Pirbadet skal ha)<br>");
		printf("<a href='index.php?side=medlemsliste_detaljert.php'>Detaljert medlemsliste</a><br>");
		printf("<a href='index.php?side=medlemsreg.php'>Medlemsregistrering</a><br>");
		printf("<a href='index.php?side=lisensreg.php'>Lisensregistrering</a><br><br>");

		printf("<a href='index.php?side=changepass.php'>Bytt pasord</a><br>");
		printf("<a href='index.php?side=logout.php'>Logg ut</a><br><br>");

		printf("<a href='?side=kurs.php'>Kurs</a><br>");
		printf("<a href='?side=ninst.php'>Legge til instrukt�r</a><br>");
		printf("<a href='?side=nkurs.php'>Sette opp nytt kurs</a><br><br>");

		printf("<a href='index.php?side=resmenu.php'>RESULTATOR  !!UNDER CONSTRUCTION!!</a><br>");
	}else{
		//hvis ikke innlogget vises innloggingsskjema
		printf("
			<table border='0'>
			<tr>
				<form method='post' action='index.php?side=login.php'>
				<td>Brukernavn:</td>
				<td><input type='text' name='bruker'></td>
			</tr>
			<tr>
				<td>Passord:</td>
				<td><input type='password' name='pass'></td>
			<tr>
				<td><input type='hidden' name='action' value='login'>
					<input type='submit' value='Logg inn'>
				</td>
			</tr>
		</form>
		</table>");
	}

?>