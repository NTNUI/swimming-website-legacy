<?php

$key = $_POST['id'];
$overskrift = $_POST['overskrift'];
$melding = $_POST['melding'];

$db = mysql_connect("REDACTED","REDACTED","REDACTED");
if (!$db) {
	die('Could connect: '.mysql_error());
}

if ( ($overskrift != null) && ($melding != null) ) {
	mysql_select_db\("REDACTED",$db);

	mysql_query("UPDATE forside SET  overskrift='$overskrift' , innhold='$melding' WHERE nokkel='$key'");
	printf("<b>Alterations have been made</b><br><b>Overskrift:</b> %s<br><b>Melding:</b><br>%s<br><br>",$overskrift,$melding);
} else {
	printf("Please provide sufficient input!<br><br>");
}
?>