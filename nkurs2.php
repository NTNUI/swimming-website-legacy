<?php

if ($_SESSION['innlogget'] == 1) {
	$n = $_POST['navn'];
	$i = $_POST['info'];
	$d = $_POST['dato'];
	$m = $_POST['max'];
	$in = $_POST['inst'];
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		mysql_query("INSERT INTO kurs (instruktor,start,info,aktiv,max,navn) VALUES ('$in','$d','$i',1,'$m','$n')",$con);
		echo "<center><b>Kurs satt opp</b></center>";
		include("login.php");
		mysql_select_db\("REDACTED",$con);
		$ov = "Kurs";
		$mld = "Nytt kurs satt opp ".$n."<br><a href=\'kurspam.php\' target=\'blank\'>P�melding</a>";
		if (mysql_query("INSERT INTO forside (av,tid,overskrift,innhold) VALUES ('$navn',NOW(),'$ov','$mld')"));
		else echo mysql_error();
		mysql_close($con);
	}
}
?>