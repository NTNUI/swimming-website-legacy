<?php
if ($_SESSION['innlogget'] == 1) {

echo "<div class='nkurs'><form action=?side=ninst2.php method=post>";
echo "<table><tr><th colspan='2'>Fyll ut info</th></tr>";
echo "<tr><td>Fornavn</td><td><input type='text' name='fornavn'></td></tr>";
echo "<tr><td>Etternavn</td><td><input type='text' name='etternavn'></td></tr>";
echo "<tr><td>Mail</td><td><input type='text' name='mail'></td></tr>";
echo "<tr><td>Tlf</td><td><input type='text' name ='tlf'></td></tr>";
echo "<tr><td colspan='2'><input type='submit'></td><tr>";
echo "</table></form></div>";

}
?>