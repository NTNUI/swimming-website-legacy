<?php
/***************************************************\
 * PHP 4.1.0+ version of email script. For more
 * information on the mail() function for PHP, see
 * http://www.php.net/manual/en/function.mail.php
\***************************************************/

//henter post data
$fornavn = $_POST['fornavn'];
$etternavn = $_POST['etternavn'];
$aar = $_POST['aar'];
$sex = $_POST['sex'];
$klubb = $_POST['klubb'];
$email = $_POST['email'];

$ov1 = $_POST['ov1'];
$ov2 = $_POST['ov2'];
$ov3 = $_POST['ov3'];
$ov4 = $_POST['ov4'];
$ov5 = $_POST['ov5'];
$ov6 = $_POST['ov6'];
$ov7 = $_POST['ov7'];
$ov8 = $_POST['ov8'];

$frlor = $_POST['frlor'];
$lorso = $_POST['lorso'];
$bankett = $_POST['bankett'];


$beskjed = $_POST['beskjed'];
$mennesketest = $_POST['mennesketest'];

$utfyllt = $_REQUEST['utfylt'];



if ($mennesketest == "SM2009"){
	if($fornavn != "null" && $etternavn != "null" && $aar != "null" && $sex != "null" && $klubb != "null" && $email != "null"){

			//sende mail til sm-lista
			$sendTo = "REDACTED";
			$subject = "Påmelding SM2009";
			//$headers .= "Return-path: " . $_POST["email"];
			//$innhold = $_POST[

			$headers .= 'Fornavn: ' . $fornavn . "\n";
			$headers .= 'Etternavn: ' . $etternavn . "\n";
			$headers .= 'År: ' . $aar . "\n";
			$headers .= 'Kjønn: ' . $sex . "\n";
			$headers .= 'Klubb: ' . $klubb . "\n";
			$headers .= 'E-post: ' . $email . "\n";

			$headers .= "Øvelser: \n";
			if($ov1 == 'ov1'){
						$headers .= "50fri \n";
			}
			if($ov2 == "ov2"){
						$headers .= "50rygg \n";
			}
			if($ov3 == "ov3"){
						$headers .= "50bryst \n";
			}
			if($ov4 == "ov4"){
						$headers .= "50fly \n";
			}
			if($ov5 == "ov5"){
						$headers .= "100fri \n";
			}
			if($ov6 == "ov6"){
						$headers .= "100bryst \n";
			}
			if($ov7 == "ov7"){
						$headers .= "100rygg \n";
			}
			if($ov8 == "ov8"){
						$headers .= "100medley \n";
			}

			$headers .= "Overnatting: \n";
			if($frlor == 'frlor'){
				$headers .= "Fredag - Lørdag \n";
			}
			if($lorso == "lorso"){
				$headers .= "Lørdag - Søndag \n";
			}

			if($bankett == "bankett"){
				$headers .= "Ønsker å delta på bankett \n";
			}else{
				$headers .= "Ønsker IKKE å delta på bankett \n";
			}

			$headers .= 'Beskjed: ' . $beskjed . "\n";

			mail($sendTo, $subject, $headers, "From: $email");



			print("Din påmelding er blitt sendt til NTNUI Svømming!<br>
			Dersom du ikke hører noe i løpet av en uke så ta kontakt!<br>
			<br>
			Your message has been sendt!<br>");
		}else{
			//hvis noen fyller ut mennesketest men glemmer noen av de andre obligatoriske feltene
			print("Det mangler data i ett eller flere av feltene. Vennligst prøv igjen!");
		}
}else if ($utfyllt == "true"){
		//hvis noen trykker send men ikke fyller ut mennesketest
		print("Det mangler data i ett eller flere av feltene. Vennligst prøv igjen!");
}
?>
