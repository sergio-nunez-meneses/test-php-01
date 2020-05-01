<?php include('sesion.php')?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>formulario eliminar PERSONAL</title>
		<link type="text/css" href="estilo.css" rel="stylesheet">
	</head>
	<body>
		<div class="contenedor">
		<div class= "encabezado">
			<div class="izq">

				<p>Bienvenido/a:<br><!-- Agregar variable de sesión con nombre y apellido del usuario --></p>
				<?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?> <br>

			</div>

			<div class="centro">
				<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>
			</div>

			<div class="derecha">
				<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
			</div>
		</div>

		<br><br><h1 align='center'>REGISTROS EXISTENTES</h1><br>

		<?php

			include("conexion.php");

				$data = $pdo->query("SELECT * FROM personal")->fetchAll();

				echo "<table  width='80%' align='center'><tr>";
				echo "<th width='20%'> RUT </th>";
				echo "<th width='20%'> NOMBRE </th>";
				echo "<th width='20%'> APELLIDO </th>";
				echo "<th width='20%'> CARGO </th>";
				echo  "</tr>";
				
				foreach ($data as $row) {
					echo "<tr>";
				  	echo '<td width=20%>' . $row['rut'] . '</td>';
				  	echo '<td width=20%>' . $row['nombre'] . '</td>';
				  	echo '<td width=20%>' . $row['apellido'] . '</td>';
				  	echo '<td width=20%>' . $row['cargo'] . '</td>';
				  	echo "</tr>";
				}
				echo "</table></br>";

		?>

		<form action="" method="post" align='center'>
			<label name="elimina">Ingresa el Rut del personal a eliminar:</label>
			<input name='eliminar-personal' type="text"> <!-- rut -->
			<input name='eliminar' type="submit" value="ELIMINAR">
		</form>

		<?php

			if (isset($_POST['eliminar'])) {
				$eliminar = $_POST['eliminar-personal'];
				if ($eliminar == '180332403') {
					echo "<script type='text/javascript'> alert('Admin general no puede ser eliminado'); </script>";
				} else {
					$sql = "DELETE FROM personal WHERE rut = ?";
					$pdo->prepare($sql)->execute([$eliminar]);
					header("Location:eliminar_personal.php");
				}
			};

		?>

		</div>
	</body>
</html>