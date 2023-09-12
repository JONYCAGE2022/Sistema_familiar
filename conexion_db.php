<?php
// detalles de conexión a la base de datos
$MySQL_host = 'localhost';
$MySQL_username = 'root';
$MySQL_password = '';
$MySQL_database = 'db_movimientos';
// si no se pudo conectar a la base de datos
if (!($connection = @mysqli_connect($MySQL_host,
$MySQL_username, $MySQL_password, $MySQL_database)))
// detener la ejecución y mostrar un mensaje de error
die('Error connecting to the database!<br>Make sure you have
specified correct values for host, username, password and
database.');
?>