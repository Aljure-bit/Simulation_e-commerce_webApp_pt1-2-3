<?php
include 'includes/connection_db.php';

// Obtenemos los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

//Función para validar si un nombre de usuario ya existe 
function verificarUsuario($nombre, $conn) {
    $query = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if (verificarUsuario($nombre, $conn)) {
    // Si el nombre de usuario ya existe, redirige a una página de error
    header("Location: error.php");
    exit();
} else {

    // Insertar registro en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $password);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

}


?>
