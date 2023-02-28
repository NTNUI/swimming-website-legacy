<?php

//check to make sure the session variable is registered
if ($_SESSION['innlogget'] == 1){
	//session variable is registered, the user is ready to logout
	session_unset();
	session_destroy();
	printf("Du har nå logget ut!<br> Velkommen tilbake!");
}
else{
	printf("Du kan ikke logge ut uten å ha logget inn!");
}

?>