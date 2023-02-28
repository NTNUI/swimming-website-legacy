<?php
/***************************************************\
 * PHP 4.1.0+ version of email script. For more
 * information on the mail() function for PHP, see
 * http://www.php.net/manual/en/function.mail.php
\***************************************************/

//henter post data
$fornavn = $_POST['fornavn'];
$etternavn = $_POST['etternavn'];
$dag = $_POST['dag'];
$mnd = $_POST['mnd'];
$aar = $_POST['aar'];
$sex = $_POST['sex'];
$zip = $_POST['zip'];
$adresse = $_POST['adresse'];
$email = $_POST['email'];
$lisensdato = $_POST['lisensdato'];
$beskjed = $_POST['beskjed'];
$mennesketest = $_POST['mennesketest'];

$utfyllt = $_REQUEST['utfylt'];



if ($mennesketest == "NTNUI"){
	if($fornavn != "null" && $etternavn != "null" && $dag != "null" && $mnd != "null" && $aar != "null" && $sex != "null" && $zip != "null" && $adresse != "null" && $email != "null" && $lisensdato != "null"){

			//sende mail til kasserer
			$sendTo = "REDACTED";
			$subject = "NTNUI - Sv�mmegruppa: Nytt medlem";
			//$headers .= "Return-path: " . $_POST["email"];
			//$innhold = $_POST[

			$headers .= 'Fornavn: ' . $fornavn . "\n";
			$headers .= 'Etternavn: ' . $etternavn . "\n";
			$headers .= 'Dag: ' . $dag . "\n";
			$headers .= 'Mnd: ' . $mnd . "\n";
			$headers .= '�r: ' . $aar . "\n";
			$headers .= 'Kj�nn: ' . $sex . "\n";
			$headers .= 'Postnummer: ' . $zip . "\n";
			$headers .= 'Adresse: ' . $adresse . "\n";
			$headers .= 'E-post: ' . $email . "\n";
			$headers .= 'Lisens betalt: ' . $lisensdato . "\n";
			$headers .= 'Beskjed: ' . $beskjed . "\n";

			mail($sendTo, $subject, $headers, "From: $email");

			//lagre i database

			$db = mysql_connect("REDACTED", "REDACTED","REDACTED");
				if (!$db) {
				   die('Could not connect: ' . mysql_error());
				}

			mysql_select_db("REDACTED",$db);
			mysql_query("INSERT INTO `medlem_2009` ( `id` , `fornavn` , `etternavn` , `dag` , `mnd` , `aar` , `kjonn` , `postnr` , `adresse` , `epost`  , `kommentar` , `regdato` ) VALUES ( '', '$fornavn', '$etternavn', '$dag', '$mnd', '$aar', '$sex', '$zip', '$adresse', '$email', '$beskjed', NOW( ) );",$db);
			mysql_close($db);


			print("Din innmelding er blitt sendt til kasserer! <br> Dersom du ikke h�rer noe i l�pet av en uke s� ta kontakt!<br> <br> Your message has been sendt!<br>");
		}else{
			//hvis noen fyller ut mennesketest men glemmer noen av de andre obligatoriske feltene
			print("Det mangler data i ett eller flere av feltene. Vennligst pr�v igjen!");
		}
}else if ($utfyllt == "true"){
		//hvis noen trykker send men ikke fyller ut mennesketest
		print("Det mangler data i ett eller flere av feltene. Vennligst pr�v igjen!");
}
?>
