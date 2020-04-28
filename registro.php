<!--
Incluir archivos requeridos.
Verificar la confirmación de la contraseña.
Recuperar las variables con los datos ingresados en el formulario.
Validar que el rut ingresado no se encuantre en la base de datos.
Si ya existe un registro vinculado al rut ingresado:
	Redirigir a login y entregar mensaje.
Si no existe:
	Insertar datos en tabla correspondiente.
	Redirigir a login y mostrar mensaje.
Si las contraseñas no existen redirigir a login y mostrar mensaje.
-->

<?php

	include("conexion.php");

	$consulta = "SELECT rut FROM personal";
	$ejecutar = mysqli_query($conexion, $consulta);
	$resultado = mysqli_fetch_array($ejecutar);

	if ($_POST['contrasena1'] == $_POST['contrasena2']) {
		// create variables
		$rut = $_POST['rut'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cargo = $_POST['cargo'];
		$contrasena = md5($_POST['contrasena2']); // md5 is hash function that returns a 32-character hexadecimal number of the incoming string for encryption
		// check if rut already exists in the database
		if ($rut == $resultado['rut']) {
			header("Location:crear_personal.php?existe=si");
		} else {
			// add values to database
			$consulta = "INSERT INTO personal(rut, nombre, apellido, cargo, contraseña) VALUES ('$rut', '$nombre', '$apellido', '$cargo', '$contrasena')";
			$ejecutar = mysqli_query($conexion, $consulta) or die ("unable to register to database gestion_bodega");
			header("Location:crear_personal.php?valida=si");
		}
	} else {
		header("Location:crear_personal.php?erronea=si");
	}

?>