<?php
	if ($_SESSION['innlogget'] == 1) {
		printf("
		Filene du laster opp m� v�re av pdf eller doc format og filnavnet kan ikke ha mellomrom for � vises p� siden!<br>
		<form enctype='multipart/form-data' action='index.php?side=programuppload.php' method='POST'>
		<input type='hidden' name='MAX_FILE_SIZE' value='100000' />
		Velg fil for opplasting: <input name='uploadedfile' type='file' /><br />
		<input type='submit' value='Last opp fil' />
		</form>");

		$uploadedfile = $_FILES['uploadedfile']['name'];

		if($uploadedfile != null){
			$target_path = "program/";

			$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
				echo "Filen ".  basename( $_FILES['uploadedfile']['name']).
				" har blitt lastet opp";
			} else{
				echo "Noe gikk galt, vennligst pr�v igjen!!";
			}
		}
	}else{
		printf("Du m� v�re logget inn for � f� tilgang til denne funksjonen!");
	}
?>