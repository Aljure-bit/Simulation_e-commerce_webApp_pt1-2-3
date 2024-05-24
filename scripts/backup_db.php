<?php
// Aquí se define la zona horaria
date_default_timezone_set('America/Bogota');

// Datos de conexión a la base de datos 
$nombreServidor = "localhost";
$nomUsuarioDB = "BrandonAlj";
$contrasena = "Root1234.";
$dbNombre = "pruebatecnica_db";

//Esta función ejecuta un comando y maneja los errores
function ejecutarComando($command) {
    exec($command . ' 2>&1', $output, $return_var);
    if ($return_var !== 0) {
        throw new Exception("Error al ejecutar comando. Detalles: " . implode(", ", $output));
    }
}

try {
    // Validamos las variables de conexión
    if (empty($nombreServidor) || empty($nomUsuarioDB) || empty($contrasena)) {
        throw new Exception("Error: Las credenciales de conexión no están configuradas correctamente.");
    }

    // Intentamos establecer la conexión
    $conn = new mysqli($nombreServidor, $nomUsuarioDB, $contrasena, $dbNombre);

    // Verificamos si hubo un error en la conexión
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    // Consultamos la existencia de la base de datos
    $result = $conn->query("SHOW DATABASES LIKE '$dbNombre'");

    if ($result->num_rows == 0) {
        die("La base de datos '$dbNombre' no existe. No se puede realizar la copia de seguridad.");
    }

    // Aquí nombramos el archivo de copia de seguridad
    $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Ruta donde se almacenará la copia de seguridad
    $backupPath = 'C:/xampp/htdocs/prueba_php/backups/' . $backupFile;

    // Aquí se verifica si el archivo de copia de seguridad ya existe
    if (file_exists($backupPath)) {
        die("El archivo de copia de seguridad '$backupFile' ya existe. No se puede sobrescribir.");
    }

    // Comando para exportar la base de datos utilizando mysqldump
    // Ajustamos la ruta de mysqldump si es necesario
    $command = "C:\\xampp\\mysql\\bin\\mysqldump.exe --default-auth=mysql_native_password --user=$nomUsuarioDB --password=$contrasena --host=$nombreServidor $dbNombre > " . $backupPath;

    // Ejecutamos el comando de la copia de seguridad
    ejecutarComando($command);

    //Adiconalmente, se agregó un backup_log.txt, para tener una mejor visualización de nuestras copias de seguridad hechas
    // Mensaje para el log
    $logMessage = date('Y-m-d H:i:s') . " - Copia de seguridad creada correctamente en: $backupPath";

    // Ésto escribe el mensaje en el archivo de log
    $logFile = 'C:/xampp/htdocs/prueba_php/logs/backup_log.txt';
    file_put_contents($logFile, $logMessage . PHP_EOL, FILE_APPEND);

    // Aquí mostramos el mensaje en el navegador (para pruebas manuales)
    echo nl2br($logMessage);

    // Cerramos la conexión
    $conn->close();
} catch (Exception $e) {
    // Capturamos y mostramos cualquier excepción ocurrida
    die("Error: " . $e->getMessage());
}
?>






