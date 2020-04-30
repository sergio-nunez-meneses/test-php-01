<?php

	$host = '127.0.0.1';
	$db = 'gestion_bodega';
	$user = 'root';
	$pass = '';
	$port = '3306';
	$charset = 'utf8mb4';
	
	// DSN is a semicolon-delimited string, consists of param=value pairs
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

	$options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, \PDO::ATTR_EMULATE_PREPARES => false,];

	try {
		// wrap the creation of an instance of PDO class into a try..catch statement
		$pdo = new PDO($dsn, $user, $pass, $options);
	// to avoid even a chance to reveal the database credentials, catch the Exception
	} catch (\PDOException $e) {
		// immediately re-throw them, and begin stack trace without the database credentials
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

?>