<?php
//kode for å ta vare på eller eventuelt starte sessions
session_start();

//velger hovedside som default
$side = "hovedside.php";
//henter side variabelen for side som skal inkuderes
$frm_side = $_REQUEST['side'];
//bruker denne med mindre den er blank
if($frm_side != ""){
	$side = $frm_side;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>NTNUI Svømming</title>
	<LINK REL="SHORTCUT ICON" HREF="filer/logo.ico">
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body class="body_style">

<div class="maintable">

	<div class="banner">
		<!-- Banner here! -->
		<img src="filer/logo.jpg">
	</div>

	<div class="meny">
		<!-- Navigaiton here! -->
		<?php
			//inkluderer menyen
			include("meny.php");
		?>
	</div>

	<div class="textboks">
		<?php
					//inkluderer side
					if(
					!preg_match("#\.\./#",$side)
					AND preg_match("#^[-a-z0-9_.]+$#i",$side)
					AND file_exists("$side")
					) {
					    include("$side");
					} else {
					  print "Ugyldig side";
					}
		?>
	</div>

</div>

</body>
</html>



