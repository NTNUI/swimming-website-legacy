<?php
if ($_SESSION['innlogget'] == 1) {

$f = $_POST['fornavn'];
$e = $_POST['etternavn'];
$m = $_POST['mail'];
$t = $_POST['tlf'];


if ($f == "" || $e == "") {
	echo "<br><center>Vennligst fyll ut all info</center><br>";
	include("ninst.php");
} else {
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		$q = mysql_query("SELECT * FROM instruktor WHERE '$f' LIKE fornavn AND '$e' LIKE etternavn",$con);
		if (mysql_num_rows($q) > 0) {
			echo "<br><center>Vedkommende finnes allerede</center><br>";
			printf("<center>%s %s</center><br>",mysql_result($q,0,"fornavn"),mysql_result($q,0,"etternavn"));
		} else {
			echo "<br><center>Vedkommende lagt til</center><br>";
			mysql_query("INSERT INTO instruktor (fornavn,etternavn,tlf,mail) VALUES ('$f','$e','$t','$m')",$con);
			include("login.php");
		}
		mysql_close($con);
	} else {
		die("Could not connect - ".mysql_error());
	}
}
}
?>