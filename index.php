<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="scripts/scripts.js" defer></script>
</head>
<body>
    <h2>Registro de Usuarios</h2>
    <form id="registroForm" action="register.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <button type="submit">Registrar</button>
    </form>
    <a href="login.php">Inicio de sesión</a>
</body>
</html>
