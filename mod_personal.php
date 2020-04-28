<!-- Inclución de archivos requeridos -->
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

				$consulta = "SELECT * FROM personal";
				$ejecutar = mysqli_query($conexion, $consulta);

				echo "<table  width='80%' align='center'><tr>";
				echo "<th width='20%'> RUT </th>";
				echo "<th width='20%'> NOMBRE </th>";
				echo "<th width='20%'> APELLIDO </th>";
				echo "<th width='20%'> CARGO </th>";
				echo  "</tr>";

				while($resultado = mysqli_fetch_array($ejecutar)) {
	    	      	echo "<tr>";
				  	echo '<td width=20%>' .	$resultado['rut'] . '</td>';
				  	echo '<td width=20%>' .	$resultado['nombre'] . '</td>';
				  	echo '<td width=20%>' .	$resultado['apellido'] . '</td>';
				  	echo '<td width=20%>' .	$resultado['cargo'] . '</td>';
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

				    // La siguiente línea verifica que la varible del boton submit "modificar" este creada.
					if (isset($_POST['modificar'])) {
						//La siguiente linea recupera la variable donde se ingreso el rut a modificar.
						$seleccionar = $_POST['seleccionar'];
						// Las siguientes 2 líneas verifican que el registro que se desea modificar no corresponda al rut del Admin y se muestra alerta con mensaje.
						if ($seleccionar == '180332403') {
							echo "<script type='text/javascript'> alert('Admin general no puede ser modificado'); </script>";
						} else {
							/*
							Si no corresponde al rut del Admin entonces:
							Recuperar las variables con los datos ingresados.
							Realizar la actualización de los datos.
							Redirigir el flujo a esta misma página para visualizar los cambios
							*/

                        	$nombre = $_POST['nombre'];
                        	$apellido = $_POST['apellido'];
                        	$cargo = $_POST['cargo'];
                        	$consulta = "UPDATE personal SET nombre = '$nombre', apellido = '$apellido', cargo = '$cargo' WHERE rut = '$seleccionar'";
                        	$ejecutar = mysqli_query($conexion, $consulta);
                        	header("Location:mod_personal.php");
						}
					};

				?>

			</div>
		</div>
	</body>
</html>