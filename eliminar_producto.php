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

                	    // check user "cargo" to display the corresponding "home" button
                	    if ($_SESSION['cargo'] == 'Admin') {
                	        echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br> Home <center></a>";
                	    } else {
                	        echo "<a href=principalBodega.php><img src='imagenes/home.png'><br> Home </a>";
                	    };

                	?>

				</div>

				<div class="derecha">
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>

			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
			<?php

				include("conexion.php");

				$data = $pdo->query("SELECT * FROM productos")->fetchAll();

				echo "<table  width='80%' align='center'><tr>";
				echo "<th width='20%'> CODIGO PRODUCTO </th>";
				echo "<th width='20%'> DESCRIPCIÓN </th>";
				echo "<th width='20%'> STOCK </th>";
				echo "<th width='20%'> PROVEEDOR </th>";
				echo "<th width='20%'> FECHA DE INGRESO </th>";
				echo  "</tr>";
				
				foreach ($data as $row) {
					echo "<tr>";
				  	echo '<td width=20%>' . $row['cod_producto'] . '</td>';
				  	echo '<td width=20%>' . $row['descripcion'] . '</td>';
				  	echo '<td width=20%>' . $row['stock'] . '</td>';
				  	echo '<td width=20%>' . $row['proveedor'] . '</td>';
				  	echo '<td width=20%>' . $row['fecha_ingreso'] . '</td>';
				  	echo "</tr>";
				}
				echo "</table></br>";

			?>

			<form action="" method="post" align='center'>
			 	<label name="elimina">Ingresa el código del producto a eliminar:</label>
			 	<input name='eliminar-producto' type="text"> <!-- codigo producto -->
			 	<input name='eliminar' type="submit" value="ELIMINAR">
			</form>

			<?php

				if (isset($_POST['eliminar'])) {
					$eliminar = $_POST['eliminar-producto'];

					$sql = "DELETE FROM productos WHERE cod_producto = ?";
					$pdo->prepare($sql)->execute([$eliminar]);
					header("Location:eliminar_producto.php");
				}

			?>

		</div>
	</body>
</html>