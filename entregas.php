<?php include('sesion.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Entregas</title>
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
	            	<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>
	            </div>

	            <div class="derecha">
	                <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
	            </div>
	        </div>

			<h1 align='center'>ENTREGAS REALIZADAS</h1><br><br>

			<?php

				include("conexion.php");

				$data = $pdo->query("SELECT * FROM entregas")->fetchAll();

				echo "<table  width='80%' align='center'><tr>";
				echo "<th width='20%'> RUT </th>";
				echo "<th width='20%'> CÓDIGO DEL PRODUCTO </th>";
				echo "<th width='20%'> CANTIDAD </th>";
				echo "<th width='20%'> FECHA DE ENTREGA </th>";
				echo  "</tr>";
				
				foreach ($data as $row) {
					echo "<tr>";
				  	echo '<td width=20%>' . $row['rut'] . '</td>';
				  	echo '<td width=20%>' . $row['cod_producto'] . '</td>';
				  	echo '<td width=20%>' . $row['cantidad'] . '</td>';
				  	echo '<td width=20%>' . $row['fecha_entrega'] . '</td>';
				  	echo "</tr>";
				}
				echo "</table></br>";

			?>

	</body>
</html>