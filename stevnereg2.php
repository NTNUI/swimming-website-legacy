<!--
<Table>
	<tr><td><?php echo "Navn: " . $_POST["navn"] ?></td></tr>
	<tr><td>50 fri</td><td><?php echo $_POST["ffri"] ?></td></tr>
	<tr><td>100 fri</td><td><?php echo $_POST["hfri"] ?></td></tr>
	<tr><td>50 bryst</td><td><?php echo $_POST["fbr"] ?></td></tr>
	<tr><td>100 bryst</td><td><?php echo $_POST["hbr"] ?></td></tr>
	<tr><td>50 rygg</td><td><?php echo $_POST["frg"] ?></td></tr>
	<tr><td>100 rygg</td><td><?php echo $_POST["hrg"] ?></td></tr>
	<tr><td>50 fly</td><td><?php echo $_POST["ffly"] ?></td></tr>
	<tr><td>100 fly</td><td><?php echo $_POST["hfly"] ?></td></tr>
	<tr><td>100 IM</td><td><?php echo $_POST["him"] ?></td></tr>
</Table>
-->
<?php
$n = $_POST["navn"];
if ($_POST["ffri"] == "on") $ovelse = "50 fri" . ", " . $ovelse;
if ($_POST["hfri"] == "on") $ovelse = "100 fri" . ", " . $ovelse;
if ($_POST["fbr"] == "on") $ovelse = "50 bryst" . ", " . $ovelse;
if ($_POST["hbr"] == "on") $ovelse = "100 bryst" . ", " . $ovelse;
if ($_POST["frg"] == "on") $ovelse = "50 rygg" . ", " . $ovelse;
if ($_POST["hrg"] == "on") $ovelse = "100 rygg" . ", " . $ovelse;
if ($_POST["ffly"] == "on") $ovelse = "50 fly" . ", " . $ovelse;
if ($_POST["hfly"] == "on") $ovelse = "100 fly" . ", " . $ovelse;
if ($_POST["him"] == "on") $ovelse = "100 IM" . ", " . $ovelse;
echo "Takk, du har valgt: " . $ovelse;

$db = mysql_connect("REDACTED", "REDACTED", "REDACTED");

if (!$db) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db\("REDACTED", $db);
$sql = "INSERT INTO stevne (navn,ovelser) VALUES ('$n','$ovelse')";
$result = mysql_query($sql);

if (!$result) {
	die('Could not query: ' . mysql_error());
}

mysql_close($db);
?>