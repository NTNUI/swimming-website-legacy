<br>
<b>Obs! Du må fylle ut allt unntatt kommentar for å bli registrert!</b><br>
<b>Obs! You have to fill out all the fields except comment to be registered!</b><br>

<form action="index.php?side=smreg_mottak.php&utfyllt=true" method="post">
Fornavn (Og mellomnavn)\ First name:<br>
<input type="text" name="fornavn" size="36" maxlength="36"><br>

Etternavn (Bare det siste navnet ditt er etternavn!)\ Last name(Only the last one):<br>
<input type="text" name="etternavn" size="36" maxlength="36"><br>

Fødselsår \ Year of birth:<br>
<input type="text" name="aar" size="4" maxlength="36"><br>

Kjønn \ Sex:<br>
<input type="radio" name="sex" value="Female"> Kvinne \ Female
<input type="radio" name="sex" value="Male"> Mann \ Male<br>

Klubb \ Club:<br>
<input type="text" name ="klubb" size="36" maxlength="36"><br>

E-post \ E-mail:<br>
<input type="text" name="email" size="36" maxlength="36"><br>

Øvelser \ :<br>
<input type="checkbox" name="ov1" value="ov1"> 50 fri<br>
<input type="checkbox" name="ov2" value="ov2"> 50 rygg<br>
<input type="checkbox" name="ov3" value="ov3"> 50 bryst<br>
<input type="checkbox" name="ov4" value="ov4"> 50 fly<br>
<input type="checkbox" name="ov5" value="ov5"> 100 fri<br>
<input type="checkbox" name="ov6" value="ov6"> 100 bryst<br>
<input type="checkbox" name="ov7" value="ov7"> 100 rygg<br>
<input type="checkbox" name="ov8" value="ov8"> 100 medley<br>

Overnatting \ :<br>
<input type="checkbox" name="frlor" value="frlor"> Fredag - Lørdag<br>
<input type="checkbox" name="lorso" value="lorso"> Lørdag - Søndag<br>

Bankett \ :<br>
<input type="checkbox" name="bankett" value="bankett" checked> Ønsker å delta på bankett<br>


Kommentar \ Comment:<br>
(For eksempel om du har noen matalergier eller er vegetarianer)<br>
<textarea name="beskjed" rows="5" cols="27"></textarea><br>

For å bevise at du er et menneske må du skrive SM2009 (med store bokstaver) i det neste feltet:<br>
Write SM2009 (uppercase) in this field to prove that you are a human being (or at least not a computer):<br>
<input type="text" name="mennesketest" size="36" maxlength="36"><br>

<input type="submit" value="Send melding \ Submit">
<input type="reset" value="Tøm skjema \ Reset">