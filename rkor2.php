<?php

if ($_SESSION['innlogget'] == 1) {
	//Kobler til database
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);

		//Henter POST-data
		$pam = $_POST['pam'];
		$r_m = $_POST['res_m'];
		$r_s = $_POST['res_s'];
		$pts = $_POST['poeng'];

		//Oppdaterer
		if ($con) {
			mysql_query("UPDATE pamelding SET res_m='$r_m',res_s='$r_s',poeng='$pts' WHERE pamID='$pam'");
			echo "<b>Oppdatering utf�rt</b><br><br>";
			include("resmenu.php");
		} else {
			die("Could not connect!".mysql_error());
		}

		//Lukker database
		mysql_close($con);
	} else {
		die("Could not connect - ".mysql_error());
	}
}
?>