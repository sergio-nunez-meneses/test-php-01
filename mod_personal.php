<?php include('sesion.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Modificar personal</title>
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

			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>

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


			<div class="encabezado">
	            <h1>Modificar personal</h1>
	        </div>

	        <div class="formulario">
	            <form name="registro" method="post" action="" enctype="application/x-www-form-urlencoded">

	                <div class="campo">
	                    <label name="Seleccionar">Ingresa el Rut del registro a modificar:</label>
			 			<input name='seleccionar' type="text" required> <!-- rut -->
	                </div>

	                <div class="campo">
	                    <div class="en-linea izquierdo">
	                        <label for="nombre">Nombre:</label>
	                        <input type="text" name="nombre" required/>
	                    </div>

	                    <div class="en-linea">
	                        <label for="apellido">Apellido:</label>
	                        <input type="text" name="apellido" required/>
	                    </div>
	                </div>

	                <div class="campo">
	                    <label for="cargo">cargo:</label>
		                <select name="cargo" required/>
		                    <option>Admin</option>
		                    <option>Bodega</option>
	                    </select>
	                </div>

	                <div class="botones">
	                    <input type="submit" name="modificar" value="Modificar"/>
					</div>
				</form>

				<?php

					if (isset($_POST['modificar'])) {
						$seleccionar = $_POST['seleccionar'];
						if ($seleccionar == '180332403') {
							echo "<script type='text/javascript'> alert('Admin general no puede ser modificado'); </script>";
						} else {
                        	$nombre = $_POST['nombre'];
                        	$apellido = $_POST['apellido'];
							$cargo = $_POST['cargo'];
							$sql = "UPDATE personal SET nombre = ?, apellido = ?, cargo = ? WHERE rut = ?";
							$pdo->prepare($sql)->execute([$nombre, $apellido, $cargo, $seleccionar]);
                        	header("Location:mod_personal.php");
						}
					};

				?>

			</div>
		</div>
	</body>
</html>