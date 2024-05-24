<?php
//Conexión con la base de datos
include 'connection_db.php';

// Crear la tabla usuarios
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla usuarios creada correctamente<br>";
} else {
    echo "Error al crear la tabla: " . $conn->error . "<br>";
}

// Insertar registros en la tabla usuarios
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES 
    ('Juanes', 'juanes101@gmail.com', '".password_hash("contraJuanes101", PASSWORD_DEFAULT)."'),
    ('María', 'maria102@gmail.com', '".password_hash("contraMaria102", PASSWORD_DEFAULT)."'),
    ('Luis', 'luis103@gmail.com', '".password_hash("contraLuis103", PASSWORD_DEFAULT)."')";

if ($conn->query($sql) === TRUE) {
    echo "Registros insertados correctamente <br>";
} else {
    echo "Error al insertar registros: " . $conn->error ."<br>";
}

// Función para obtener el nombre por email
function obtenerNombrePorEmail($email, $conn) {
    // Inicializar la variable $nombre
    $nombre = "";

    // Prepararamos la consulta
    $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE email = ?");
    if ($stmt === FALSE) {
        die("Error preparando la consulta: " . $conn->error . "<br>");
    }
    
    // Vinculamos el parámetro y la s, significa que es de tipo string
    $stmt->bind_param("s", $email);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Vinculamos la columna del resultado a una variable
    $stmt->bind_result($nombre);
    
    // Obtenemos el resultado
    if ($stmt->fetch()) {
        return $nombre;
    } else {
        return NULL;
    }
    
    // Cerraramos nuestra declaración
    $stmt->close();
}

// Función para actualizar la contraseña por nombre
function actualizarContraseñaPorNombre($nombre, $nuevaContraseña, $conn) {
    $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("UPDATE usuarios SET contraseña = ? WHERE nombre = ?");
    if ($stmt === FALSE) {
        die("Error preparando la consulta: " . $conn->error . "<br>");
    }
    $stmt->bind_param("ss", $hashContraseña, $nombre);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Contraseña actualizada correctamente para $nombre <br>";
    } else {
        echo "No se encontró el usuario con el nombre $nombre <br>";
    }
    $stmt->close();
}

// Probamos las funciones
$email = "maria102@gmail.com";
$nomUsuarioPorEmail = obtenerNombrePorEmail($email, $conn);
if ($nomUsuarioPorEmail !== NULL) {
    echo "El nombre del usuario con email $email es $nomUsuarioPorEmail <br>";
} else {
    echo "No se encontró un usuario con el email $email <br>";
}

$nombreUsuario = "Luis";
$nuevaContraseña = "nuevaContraseña";

actualizarContraseñaPorNombre($nombreUsuario, $nuevaContraseña, $conn);

$conn->close();
?>
