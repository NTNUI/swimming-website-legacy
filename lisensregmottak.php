Registrering av lisensviderebetaling.<br>
<br>

<?php

//henter id variabelen for medlemmet som skal lisensregistreres
$id = $_REQUEST['id'];
//velger hovedside hvis ingen side er valgt
if($id != ""){

		//tilkobling
		$db = mysql_connect("REDACTED", "REDACTED","REDACTED");
		if (!$db) {
		   die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("REDACTED",$db);

		//oppdaterer
		mysql_query("UPDATE `medlem_2009` SET `lisensdato` = NOW( ) WHERE `id` = '$id';", $db);

		//henter data
		$result = mysql_query("SELECT * FROM medlem_2009 WHERE `id` = '$id';" ,$db);


		printf("Lisensen til ");
		printf("%s \n", mysql_result($result,$i,"fornavn"));
		printf("%s \n", mysql_result($result,$i,"etternavn"));
		printf("ble registrert.<br>");

		mysql_close($db);


}else{
	printf("Du m� velge ett medlem for � godkjenne det.<br>");
}

?>

<a href="http://www.redacted-domain.com/svomming/index.php?side=lisensreg.php">Registrer fler lisensviderebetalinger</a>
