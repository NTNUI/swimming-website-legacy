Godkjenning av medlem.<br>
<br>

<?php

//henter id variabelen for medlemmet som skal godkjennes
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
		mysql_query("UPDATE `medlem_2009` SET `kontrolldato` = NOW( ) WHERE `id` = '$id';", $db);

		//henter data
		$result = mysql_query("SELECT * FROM medlem_2009 WHERE `id` = '$id';" ,$db);


		printf("%s \n", mysql_result($result,$i,"fornavn"));
		printf("%s \n", mysql_result($result,$i,"etternavn"));
		printf("ble registrert.<br>");


		//sende mail til medlem
		$sendTo = mysql_result($result,$i,"epost");
		$subject = "NTNUI - Sv�mmegruppa: Medlemskap godkjent";

		$headers .= "Dette er en automatisk e-post sendt av NTNUI-Sv�mmegruppas medlemssystem. \n";
		$headers .= "\n";
		$headers .= "Din innmelding er registrert og godkjent i v�r database.\n";
		$headers .= "Nye lister blir levert til Pirbadet fortl�pende, slik at du kan begynne � trene.\n";

		mail($sendTo, $subject, $headers, "From: REDACTED");

		mysql_close($db);


		printf("E-post er sendt til medlemmet.<br>");

}else{
	printf("Du m� velge ett medlem for � godkjenne det.<br>");
}

?>

<a href="http://redacted-domain.com/svomming/index.php?side=medlemsreg.php">Registrer fler medlemmer</a>
