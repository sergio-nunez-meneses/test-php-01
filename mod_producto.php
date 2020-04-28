<!-- Incluir archivos requeridos -->
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
			<br><h1 align="center">PRODUCTOS EXISTENTES</h1><br>
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
	            <!--
	            Verificación del boton submit "actualizar".
	            Actualizar stock del producto seleccionado.
	            Redirigir a la misma pagina para visualizar los cambios.
	        	-->

	        	<?php

					if (isset($_POST['actualiza'])) {
						$codigo = $_POST['seleccionar'];
						$stock = $_POST['stock'];

						$consulta = "SELECT stock FROM productos WHERE cod_producto = '$codigo'";
						$ejecutar = mysqli_query($conexion, $consulta);
						$resultado = mysqli_num_rows($ejecutar);

						if ($resultado > 0) {
							$resultado = mysqli_fetch_array($ejecutar);
							$nuevo_stock = $stock + $resultado['stock'];

							$consulta = "UPDATE productos SET stock = '$nuevo_stock' WHERE cod_producto = '$codigo'";
                        	$ejecutar = mysqli_query($conexion, $consulta);
                        	header("Location:mod_producto.php");
                        	ob_end_flush(); // "stop saving things and discard whatever was saved, or stop saving and output it all at once, respectively"
						}
	        		};

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
				<!--
				Verificación del boton sumbit "modificar".
				Recuperar las variables con los valores ingresados.
				Realizar modificación de datos en la tabla correspondiente.
				Redirigir el flujo a esta misma página para visualizar los cambios.
				-->
				<?php

				    // La siguiente línea verifica que la varible del boton submit "modificar" este creada.
					if (isset($_POST['modificar'])) {
						$codigo = $_POST['seleccionar'];
                        $descripcion = $_POST['descripcion'];
                        $proveedor = $_POST['proveedor'];
                        $fecha = $_POST['fecha'];

                        $consulta = "UPDATE productos SET descripcion = '$descripcion', proveedor = '$proveedor', fecha_ingreso = '$fecha' WHERE cod_producto = '$codigo'";
                        $ejecutar = mysqli_query($conexion, $consulta);
                        header("Location:mod_producto.php");
                        ob_end_flush(); // "stop saving things and discard whatever was saved, or stop saving and output it all at once, respectively"
					};

				?>

			</div>
		</div>
	</body>
</html>