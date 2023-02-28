<?php

if ($_SESSION['innlogget'] == 1) {
	$con = mysql_connect("REDACTED","REDACTED","REDACTED");
	if ($con) {
		mysql_select_db("REDACTED",$con);
		echo "<div class='resbox'><form action='?side=nkurs2.php' method=post><table>";
		echo "<tr><td>Navn</td><td><input type='text' name='navn'></td></tr>";
		echo "<tr><td colspan='2'>Info</td></tr><tr><td colspan='2'><textarea cols='26' rows='3' name='info'></textarea></td></tr>";
		echo "<tr><td>Start</td><td><input type='text' name='dato'></td></tr>";
		echo "<tr><td>Max</td><td><input type='text' name='max' value='8'></td></tr>";
		echo "<tr><td>Instrukt�r</td><td><select name='inst'>";
		$q = mysql_query("SELECT * FROM instruktor");
		while ($a = mysql_fetch_array($q)) {
			printf ("<option value='%s'>%s %s</option>",$a['instID'],$a['fornavn'],$a['etternavn']);
		}
		echo "</select></td></tr><tr><td colspan='2'><input type='submit'></td></tr></table></form></div>";
		mysql_close($con);
	}
}
?>