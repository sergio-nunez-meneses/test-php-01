<?php

	include("conexion.php");

	$rut = $_POST['rut'];

	// check if user already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM personal WHERE rut = ?"); // PDO::prepare() method
    $stmt->execute([$rut]); // PDO::execute() method
    $user = $stmt->fetch(); // array offset on value of type bool

	if ($_POST['contrasena1'] == $_POST['contrasena2']) {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cargo = $_POST['cargo'];
		$contrasena = md5($_POST['contrasena2']); // md5 is hash function that returns a 32-character hexadecimal number of the incoming string for encryption
		if ($user !== false) {
			// user found
			header("Location:crear_personal.php?existe=si");
		} else {
			// add new user to database
			$sql = "INSERT INTO personal(rut, nombre, apellido, cargo, contraseña) VALUES (?, ?, ?, ?, ?)";
			$pdo->prepare($sql)->execute([$rut, $nombre, $apellido, $cargo, $contrasena]);
			header("Location:crear_personal.php?valida=si");
		}
	} else {
		header("Location:crear_personal.php?erronea=si");
	}

?>