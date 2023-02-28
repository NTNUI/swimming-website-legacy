<?php

if ($_SESSION['innlogget'] == 1) {

printf("

<div class='resbox'>
	<center><big>RESULTATOR</big></center><br>
	<a href='?side=ureg.php'>Registrere Utøver</a><br>
	<a href='?side=ulist.php'>Se liste over Utøvere</a><br>
	<br>
	<a href='?side=sreg.php'>Registrere Stevne</a><br>
	<a href='?side=slist.php'>Liste over stevner</a><br>
	<a href='?side=skor.php'>Korrigere stevne</a><br>
	<a href='?side=oreg.php'>Registrere Øvelser</a><br>
	<a href='?side=olist.php'>Liste over Øvelser</a><br>
	<br>
	<a href='?side=pam.php'>Gjøre påmelding</a><br>
	<a href='?side=vpam.php'>Vise påmeldinger</a><br>
	<a href='?side=rreg.php'>Registrere Resultater</a><br>
	<a href='?side=rlist.php'>Vise resultater</a>
</div>
");

}//Innlogget-test

?>