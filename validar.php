<?php

	include("conexion.php");

	$usuario = $_POST['usuario'];
	$pass = md5($_POST['pass']);

	// check if user already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM personal WHERE rut = ? AND contraseña = ?"); // PDO::prepare() method
    $stmt->execute([$usuario, $pass]); // PDO::execute() method
    $user = $stmt->fetch(); // array offset on value of type bool
    if ($user !== false) {
		// login
		session_start();
		$_SESSION['activo'] = true;
		$_SESSION['nombre'] = $user['nombre'];
		$_SESSION['apellido'] = $user['apellido'];
		$_SESSION['cargo'] = $user['cargo'];
		if ($_SESSION['cargo'] == 'Admin') {
			header("Location:principalAdmin.php"); // header("Location:script.php") returns a redirect (302) status code to the browser
		} elseif ($_SESSION['cargo'] == 'Bodega') {
			header("Location:principalBodega.php");
		}
	} else {
		// user not found
		header("Location:login.php?error=si");
	}

?>