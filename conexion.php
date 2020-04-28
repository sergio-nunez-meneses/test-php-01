<?php

	// mysql_connect is a function that requires 3 parameters : server name, user name, server password (empty not spaced quote marks if no password has been set)
	$conexion = mysqli_connect("localhost", "root", "") or die("unable to connect to database gestion_bodega </br>");

	// allows display of special characters
	mysqli_set_charset($conexion, "utf8");

	// select database
	mysqli_select_db($conexion, "gestion_bodega") or die("database gestion_bodega not found </br>");

?>