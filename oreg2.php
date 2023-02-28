<?php

if ($_SESSION['innlogget'] ==1 ) {
	
	//Henter post-data
	$d = $_POST['distanse'];
	$a = $_POST['art'];
	
 	if ( ($d == "") || ($a == "") ) {
		echo "<center><big>Vennligst fyll ut all info</big></center>";
		include("oreg.php");
	} else {
		//Kobler til database
		$con = mysql_connect("REDACTED","REDACTED","REDACTED");
		mysql_select_db("REDACTED",$con);
		
		if ($con) {
			$q = mysql_query("SELECT * FROM ovelse WHERE art='$a' AND distanse='$d'");
			if (mysql_num_rows($q) > 0) {
				echo "<center>�velse allerede registrert</center>";
				include("oreg.php");
			} else {
				printf ("<center>�velse: %s %s</center>",$d,$a);
				mysql_query("INSERT INTO ovelse (distanse,art) VALUES ('$d','$a')");
				include("resmenu.php");
			}
		} else {
			die("Could not connect - ".mysql_error());
		}
	}
	
}

?>