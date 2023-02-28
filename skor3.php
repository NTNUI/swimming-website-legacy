<?php

if ($_SESSION['innlogget'] == 1) {
	//Getting POST-data
	$s = $_POST['stevne'];
	$d = $_POST['date'];

	//Connecting to database
	$con = mysql_connect("REDACTED", "REDACTED", "REDACTED");

	if ($con) {
		mysql_select_db("REDACTED", $con);
		//Update date
		mysql_query("UPDATE stevne SET dato='$d' WHERE stevneID='$s'");
		$q = mysql_query("SELECT * FROM stevne WHERE stevneID='$s'");

		echo "<table>";
		$a = mysql_fetch_array($q);
		printf("<tr><th>%s</th><td>%s</td></tr>", $a['navn'], $a['dato']);

		while (list($key, $val) = @each($box)) {
			$q = mysql_query("SELECT * FROM ovelse WHERE ovelseID='$val'");
			printf("<tr><td>%s %s</td></tr>", mysql_result($q, 0, "distanse"), mysql_result($q, 0, "art"));
			mysql_query("INSERT INTO ovelsepastevne (stevne,ovelse) VALUES ('$s','$val')");
		}
		echo "<tr><td colspan='2'>Update done</td></tr></table>";
		include("resmenu.php");
	} else {
		die("Could not connect" . mysql . error());
	}
}
