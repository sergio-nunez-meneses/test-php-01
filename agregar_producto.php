<?php include('sesion.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Agregar productos</title>
        <link rel="stylesheet" href="estilo.css"/>
    </head>
    <body>
        <div class="contenedor">
            <div class= "encabezado">
            <div class="izq">

                <p>Bienvenido/a:<br> <!-- Agregar variable de sesión con nombre y apellido del usuario --></p>
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

                    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

                ?>

            </div>

            <div class="derecha">
                <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
            </div>
        </div>

        <br><h1 align="center">GESTIÓN DE PRODUCTOS</h1>

            <div class="formulario">
                <form name="registro" method="post" action="" enctype="application/x-www-form-urlencoded">
                    <div class="campo">
                        <label for="codigo">Código del producto:</label>
                        <input type="text" name="codigo" required/> <!-- codigo producto -->
                    </div>

                    <div class="campo">
                        <label for="nombre">Descripción:</label>
                        <input type="text" name="descripcion" required/>
                    </div>

                    <div class="campo">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" required/>
                    </div>

                    <div class="campo">
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" name="proveedor" required/>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha ingreso:</label>
                        <input type="date" name="fecha" required/>
                    </div>

                    <div class="botones">
                        <input type="submit" name="crear" value="Agregar producto"/>
                    </div>

                    <?php

                        include("conexion.php");

                        if (isset($_POST['crear'])) {
                            $codigo = $_POST['codigo'];

                            $stmt = $pdo->prepare("SELECT * FROM productos WHERE cod_producto = ?"); // PDO::prepare() method
                            $stmt->execute([$codigo]); // PDO::execute() method
                            $product = $stmt->fetch(); // array offset on value of type bool

                            // check if primary key already exists in the database
                            if ($product !== false) { 
                                echo "<p class='mensaje'> Ya existe un producto asociado al código ingresado </p>";
                            } else {
                                // create variables
                                $descripcion = $_POST['descripcion'];
                                $stock = $_POST['stock'];
                                $proveedor = $_POST['proveedor'];
                                $fecha = $_POST['fecha'];
                                // add values to database
                                $sql = "INSERT INTO productos(cod_producto, descripcion, stock, proveedor, fecha_ingreso) VALUES (?, ?, ?, ?, ?)";
                                $pdo->prepare($sql)->execute([$codigo, $descripcion, $stock, $proveedor, $fecha]);
                                echo "<p class='mensaje'> Producto agregado correctamente </p>";
                            }
                        }

                    ?>

                </form>
            </div>
        </div>
    </body>
</html>