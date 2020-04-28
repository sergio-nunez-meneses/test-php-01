<!--
Evaluar que la sesión continue, verificando la variable de sesión creada para este propósito.
Si la variable cambió su valor inicial se enviará la variable error=si al archivo salir.php
-->

<?php

	session_start();
	// receive superglobal variable from script validar.php, and check whether the value is false
	if (!$_SESSION['activo']) {
		// send variable sal with value "si" to script salir.php
		header("Location:salir.php?sal=si");
	}

?>