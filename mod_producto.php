<?php

	include('sesion.php');
	ob_start(); // "start remembering everything that would normally be outputted, but don't quite do anything with it yet"

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Modificar producto</title>
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

			<br><h1 align="center">PRODUCTOS EXISTENTES</h1><br>

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

			<div class="encabezado">
	                <h1>Modificar producto</h1>
	        </div>

	        <div class="formulario">
	            <form name="actualizar" method="post" action="" enctype="application/x-www-form-urlencoded">
	           		<div class="campo">

	               		<p>Para actualizar el stock de un producto ingresa el código del producto y la cantidad que deseas agregar. Para quitar deber ingresar la cantidad anteponiendo el signo menos (-) a la cantidad</p><br><br>

	                    <label name="Seleccionar">Ingresa el código del producto que deseas actualizar:</label>
			 			<input name='seleccionar' type="text" required> <!-- codigo producto -->
	                </div>

	                <div class="campo">
	                    <div class="en-linea izquierdo">
	                        <label for="descrip">Stock:</label>
	                        <input type="number" name="stock" required/>
	                    </div>

	                    <div class="en-linea">
	                        <label for="apellido">Stock:</label>
	                        <input type="submit" name="actualiza" value="Actualizar" required/>
	                    </div>
	                </div>
	            </form>

	        	<?php

					if (isset($_POST['actualiza'])) {
						$codigo = $_POST['seleccionar'];
						$nuevo_stock = $_POST['stock'];

    					if ($codigo == $row['cod_producto']) {
							$nuevo_stock = $nuevo_stock + $row['stock'];
							$sql = "UPDATE productos SET stock = ? WHERE cod_producto = ?";
							$pdo->prepare($sql)->execute([$nuevo_stock, $codigo]);
							header("Location:mod_producto.php");
    					} else {
							echo "<span style='color:#F00; font-size:2em;'> El código ingresado NO existe </span>";
						}
                        // ob_end_flush(); // "stop saving things and discard whatever was saved, or stop saving and output it all at once, respectively"

	        		}

				?>

	            <form name="modificar" method="post" action="" enctype="application/x-www-form-urlencoded">
	                <div class="campo">
	                    <label name="Seleccionar">Ingresa el código del producto que deseas modificar:</label>
			 			<input name='seleccionar' type="text" required> <!-- codigo producto -->
	                </div>

	                <div class="campo">
	                    <label for="descrip">Descripción:</label>
	                    <input type="text" name="descripcion" required/>
	                </div>

	                <div class="campo">
	                    <label for="cargo">Proveedor:</label>
		                <input type="text" name="proveedor" required/>
	                </div>

	                <div class="campo">
	                    <label for="cargo">Fecha ingreso:</label>
		                <input type="date" name="fecha" required/>
	                </div>

	                <div class="botones">
	                    <input type="submit" name="modificar" value="Modificar"/>
					</div>
				</form>

				<?php

					if (isset($_POST['modificar'])) {
						$codigo = $_POST['seleccionar'];
                        $descripcion = $_POST['descripcion'];
                        $proveedor = $_POST['proveedor'];
						$fecha = $_POST['fecha'];

						$sql = "UPDATE productos SET descripcion = ?, proveedor = ?, fecha_ingreso = ? WHERE cod_producto = ?";
						$pdo->prepare($sql)->execute([$descripcion, $proveedor, $fecha, $codigo]);
                        header("Location:mod_producto.php");
                        // ob_end_flush(); // "stop saving things and discard whatever was saved, or stop saving and output it all at once, respectively"
					}

				?>

			</div>
		</div>
	</body>
</html>