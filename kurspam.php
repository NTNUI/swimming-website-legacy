<head>
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<?php

echo "<div='kurs'><center><b>Sign up for course</b></center>";

$con = mysql_connect("REDACTED","REDACTED","REDACTED");
if ($con) {
	mysql_select_db("REDACTED",$con);
	$q = mysql_query("SELECT * FROM kurs WHERE aktiv=1");
	if (mysql_num_rows($q) > 0) {
		echo "<table><form action='kurspam2.php' method='post'>";
		echo "<tr><td>First name</td><td><input type='text' name='fornavn'></td></tr>";
		echo "<tr><td>Last name</td><td><input type='text' name='etternavn'></td></tr>";
		echo "<tr><td>Phone number</td><td><input type='text' name='tlf'></td></tr>";
		echo "<tr><td>E-mail</td><td><input type='text' name='mail'></td></tr>";
		echo "<tr><td colspan='2'>Select Course</td></tr>";
		while ($a = mysql_fetch_array($q)) {
			$id = $a['kursID'];
			printf ("<tr><td><input type='checkbox' name=box[] value=%s></td>",$id);
			printf ("<td>%s</td></tr>",$a['info']);
			$k = mysql_query("SELECT * FROM pamelding WHERE kurs=$id");
			printf ("<tr><td>Spots: %s</td><td>Taken: %s</td></tr>",$a['max'],mysql_num_rows($k));
		}
		echo "<tr><td><input type='submit'></td></tr>";
		echo "</form></table></div>";
	} else {
		echo "<center>No courses going at this time</center></div>";
		mysql_close($con);
	}
}
?>