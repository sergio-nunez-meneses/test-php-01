<?php

	// receive variable 'sal' from script sesion.php, and check whether its value is 'si'
	if ($_GET['sal'] == 'si') {
		session_start();
		session_destroy();
		header("Location:login.php");
	}

?>