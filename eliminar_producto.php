<!-- Inclución de archivos requeridos -->
<?php include('sesion.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>formulario eliminar producto</title>
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
					<?php

                	    // La siguiente validación verifica el cargo del usuario que esta viendo esta pagina para asignarle el flujo que tendra el links con imagen "Home".
                	    if ($_SESSION['cargo'] == 'Admin') {
                	        echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br> Home <center></a>";
                	    } else {
                	        echo "<a href=principalBodega.php><img src='imagenes/home.png'><br> Home </a>";
                	    };

                	?>

				</div>

				<div class="derecha">
					<!--
                	La siguiente línea corresponde al links con imagen para finalizar sesión, que redirige a la página salir.php con la varible "sal=si" que destruye la sesión y nos muestra la pagina del login.
                	-->
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>

			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
			<?php

				include("conexion.php");

				$consulta = "SELECT * FROM productos";
				$ejecutar = mysqli_query($conexion, $consulta);

				echo "<table  width='80%' align='center'><tr>";
				echo "<th width='10%'> CODIGO PRODUCTO </th>";
				echo "<th width='20%'> DESCRIPCIÓN </th>";
				echo "<th width='10%'> STOCK </th>";
				echo "<th width='20%'> PROVEEDOR </th>";
				echo "<th width='20%'> FECHA DE INGRESO </th>";
				echo  "</tr>";

				while($resultado = mysqli_fetch_array($ejecutar)){
		          	echo "<tr>";
				  	echo '<td width=10%>' . $resultado['cod_producto'] . '</td>';
				  	echo '<td width=20%>' . $resultado['descripcion'] . '</td>';
				  	echo '<td width=20%>' . $resultado['stock'] . '</td>';
				  	echo '<td width=20%>' . $resultado['proveedor'] . '</td>';
				  	echo '<td width=20%>' . $resultado['fecha_ingreso'] . '</td>';
				  	echo "</tr>";
				}
				echo "</table></br>";

			?>

			<form action="" method="post" align='center'>
			 	<label name="elimina">Ingresa el código del producto a eliminar:</label>
			 	<input name='eliminar-producto' type="text"> <!-- codigo producto -->
			 	<input name='eliminar' type="submit" value="ELIMINAR">
			</form>
			<!--
			Verificación de boton submit
			Recuperar variable con código ingresado.
			Eliminar registro de la base de datos asociado al código ingresado.
			Redirigir el flujo a esta misma página para visualizar los cambios
			-->

			<?php
				/*
				En las siguientes 5 lineas se verifica la creación del boton submit, se recupera el rut ingresado para ser eliminado y se verifica si es igual al rut del Admin,
				y se muestra alerta con mensaje
				*/
				if (isset($_POST['eliminar'])) {
					$eliminar = $_POST['eliminar-producto'];

					$consulta = "DELETE FROM productos WHERE cod_producto = '$eliminar'";
					$ejecutar = mysqli_query($conexion, $consulta);
					header("Location:eliminar_producto.php");
					echo "<p class='mensaje'> Producto eliminado correctamente </p>";
				};

			?>

		</div>
	</body>
</html>