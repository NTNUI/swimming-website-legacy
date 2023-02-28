<?php

$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");
mysql_select_db("ellevset_skole",$con);

$resultat = $_GET['r'];
$stevne = $_GET['s'];

$poeng = $_POST['poeng'];
if ($tid = $_POST['tid']) {
	mysql_query("UPDATE resultat SET tid = '$tid' , poeng = '$poeng' WHERE id=$r");
	echo "<tr><td>Resultat registrert</td></tr>";
} else {
	echo "<tr><td>Ingen tid registrert.</td></tr>";
	echo "<tr><td><a href=\"resreg3.php?r=$resultat&s=$stevne\">pr�v igjen</a></td></tr>";
}

mysql_close($con);
echo "<tr><td><hr width=\"50%\"></td></tr>";
echo "<tr><td><a href=\"resreg2.php?s=$stevne\">Nytt resultat samme stevne</a></td></tr>";
include("bunn.html");
