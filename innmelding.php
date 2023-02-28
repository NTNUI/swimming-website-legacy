<br>
<b>Obs! Du må fylle ut allt unntatt kommentar for å bli registrert!</b><br>
<b>Obs! You have to fill out all the fields except comment to be registered!</b><br>

<form action="index.php?side=innmelding_mottak.php&utfyllt=true" method="post">
Fornavn (Og mellomnavn)\ First name:<br>
<input type="text" name="fornavn" size="36" maxlength="36"><br>

Etternavn (Bare det siste navnet ditt er etternavn!)\ Last name(Only the last one):<br>
<input type="text" name="etternavn" size="36" maxlength="36"><br>

Fødselsdato \ Date of birth:<br>
<input type="text" name="dag" size="2" maxlength="36">
<input type="text" name="mnd" size="2" maxlength="36">
<input type="text" name="aar" size="4" maxlength="36"> dd-mm-åååå<br>

Kjønn \ Sex:<br>
<input type="radio" name="sex" value="Female"> Kvinne \ Female
<input type="radio" name="sex" value="Male"> Mann \ Male<br>

Postnummer \ ZIP code:<br>
<input type="text" name ="zip" size="36" maxlength="36"><br>

Adresse \ Adress:<br>
<textarea name="adresse" rows="3" cols="27"></textarea><br>

E-post \ E-mail:<br>
<input type="text" name="email" size="36" maxlength="36"><br>

Dato lisensen ble betalt \ License pay date:<br>
<input type="text" name="lisensdato" size="36" maxlength="36"><br>

Kommentar \ Comment: (Hvis du har betalt lisens for annen klubb i år så skriv hvilken klubb her. Dersom du har vært medlem av annen klubb i løpet av de siste to åra må du også gi beskjed om dette. Har noen andre betalt lisensen for deg går det fortere dersom du gir beskjed om dette)<br> 
<textarea name="beskjed" rows="5" cols="27"></textarea><br>

For å bevise at du er et menneske må du skrive NTNUI (med store bokstaver) i det neste feltet:<br>
Write NTNUI (uppercase) in this field to prove that you are a human being (or at least not a computer):<br>
<input type="text" name="mennesketest" size="36" maxlength="36"><br>

<input type="submit" value="Send melding \ Submit">
<input type="reset" value="Tøm skjema \ Reset">