<!--
Verificar que la variable sal sea igual a si.
Cerrar la sesión.
Redirigir el flujo a la pagina del login
-->

<?php

	// receive variable 'sal' with value 'si' from script sesion.php
	if ($_GET['sal'] == 'si') {
		session_start();
		session_destroy();
		header("Location:login.php");
	}

?>