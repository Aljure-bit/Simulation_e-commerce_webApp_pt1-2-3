<?php
session_start();
include 'includes/connection_db.php';

// Obtenemos los datos del formulario
$email = $_POST['email'];
$password = $_POST['contrasena'];

// Aquí se verifica el usuario
$sql = "SELECT id, nombre, contraseña FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id, $nombre, $hashed_password);
$stmt->fetch();

if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $nombre;
    header("Location: dashboard.php");
} else {
    echo "Email o contraseña incorrectos. <a href='login.php'>Intenta de nuevo</a>";
}

$stmt->close();
$conn->close();
?>
