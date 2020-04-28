<!--
Incluir archivos requeridos.
Obtener variables con los datos ingresados en login, la contraseña debe estar dentro de una función hash.
Verificar que exista el registro en la base de datos.
Si el registro existe entonces:
	Iniciar sesión.
	Crear variables de sesión a ocupar.
	Asignar los permisos según el cargo.
Si no existe el registro enviar una variable para mostra mensaje en pagina de login.
-->

<?php

	include("conexion.php");

	// if <form> method is "post", use superglobal variable $_POST
	// <input> names "usuario" and "pass"
	$usuario = $_POST['usuario'];
	$pass = md5($_POST['pass']);

	// check if user already exists in the database
	$consulta = "SELECT * FROM personal WHERE rut = '$usuario' AND contraseña = '$pass'";
	$ejecutar = mysqli_query($conexion, $consulta);
	$resultado = mysqli_num_rows($ejecutar); // return the number of existing rows in the database
	if ($resultado > 0) {
		$resultado = mysqli_fetch_array($ejecutar);
		// login
		session_start();
		$_SESSION['activo'] = true;
		$_SESSION['nombre'] = $resultado['nombre'];
		$_SESSION['apellido'] = $resultado['apellido'];
		$_SESSION['cargo'] = $resultado['cargo'];
		if ($_SESSION['cargo'] == 'Admin') {
			header("Location:principalAdmin.php"); // header("Location:script.php") returns a redirect (302) status code to the browser
		} elseif ($resultado['cargo'] == 'Bodega') {
			header("Location:principalBodega.php");
		}
	} else {
		// user not found
		header("Location:login.php?error=si");
	}

?>