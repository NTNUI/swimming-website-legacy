<head>
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<?php

$f = $_POST['fornavn'];
$e = $_POST['etternavn'];
$t = $_POST['tlf'];
$m = $_POST['mail'];

if ($f == "" || $e == "" || $m == "") {
	echo "<center><b>Please insert info<b></center><br>";
	include ("kurspam.php");
} else {
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		while (list($key,$val) = @each ($box)) {
			$id = $val;
			$q = mysql_query("SELECT max FROM kurs WHERE kursID='$id'");
			$max = mysql_result($q,0);
			$q = mysql_query("SELECT * FROM pamelding WHERE kurs='$id'");
			$pam = mysql_num_rows($q);
			if ($pam < $max) {
				mysql_query("INSERT INTO pamelding (kurs,dato,konfirmert,fornavn,etternavn,mail,tlf) VALUES ('$id',NOW(),1,'$f','$e','$m','$t')");
				echo "<br><center>You have been signed up!</center><br>";
			} else {
				mysql_query("INSERT INTO pamelding (konfirmert,fornavn,etternavn,mail,tlf) VALUES ('$id',NOW(),0,'$f','$e','$m','$t')");
				echo "<br><center>Not enough room, you are on the list!</center><br>";
			}
		}
		echo "<center>Thank you!</center><br>";
	} else {
		die("Could not connect".mysql_error());
	}
}

?>
