<?php
//Aquí tenemos la conexión con nuestra base de datos
$nombreServidor = "localhost";
$nomUsuarioDB = "BrandonAlj";
$contrasena = "Root1234.";
$dbNombre = "pruebatecnica_db";

$conn = new mysqli($nombreServidor, $nomUsuarioDB, $contrasena, $dbNombre);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
