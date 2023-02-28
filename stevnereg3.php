<?php
$db = mysql_connect("REDACTED", "REDACTED", "REDACTED");
$result = mysql_query('SELECT navn,ovelser FROM stevne');
$text = mysql_fetch_array($result);
$n = mysql_num_rows($result) - 1;
echo $text;
echo "<Table>"
while ($i<=$n) {
	
}
echo "</Table>"
?>
