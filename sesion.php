<?php

	session_start();
	// receive superglobal variable from script validar.php, and check whether its value is false
	if (!$_SESSION['activo']) {
		// send variable sal with value "si" to script salir.php
		header("Location:salir.php?sal=si");
	}

?>