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

            <br><h1 align='center'>PRODUCTOS EXISTENTES</h1><br>

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
                <div class="campo">
                    <label name="rut">Rut personal que retira:</label>
                    <input name='rut' type="text">
                </div>

                <div class="campo">
                    <label name="cod">Código del producto:</label>
                    <input name='codigo' type="text"> <!-- codigo producto -->
                </div>

                <div class="campo">
                    <label name="cantd">Cantidad:</label>
                    <input name='cantidad' type="text">
                </div>

                <div class="campo">
                    <label name="cantd">Fecha entrega:</label>
                    <input name='fecha' type="date">
                </div>

                <div class="botones">
                    <input name='agregar' type="submit" value="Agregar">
                </div>
            </form>

            <?php

                include("conexion.php");

                if (isset($_POST['agregar'])) {
                    $codigo = $_POST['codigo'];
                    $rut = $_POST['rut'];
                    $cantidad = $_POST['cantidad'];
                    $fecha = $_POST['fecha'];
                    $nueva_cantidad = $row['stock'] - $cantidad;

                    $sql = "UPDATE productos SET stock = ? WHERE cod_producto = ?";
                    $pdo->prepare($sql)->execute([$nueva_cantidad, $codigo]);
                    
                    $sql = "INSERT INTO entregas(rut, cod_producto, cantidad, fecha_entrega) VALUES (?, ?, ?, ?)";
                    $pdo->prepare($sql)->execute([$rut, $codigo, $cantidad, $fecha]);
                    header("Location:realizar_entrega.php");
                    echo "<p class='mensaje'> Producto entregado correctamente </p>";
                }

            ?>

        </div>
    </body>
</html>