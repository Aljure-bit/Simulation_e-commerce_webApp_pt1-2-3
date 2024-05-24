<div align="center">
    <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/6/61/HTML5_logo_and_wordmark.svg" alt="html_logo">
    <img width="120" src="https://upload.wikimedia.org/wikipedia/commons/d/d5/CSS3_logo_and_wordmark.svg" alt="css_logo">
    <img width="140" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png" alt="js_logo">
    <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" alt="php_logo">
    <img width="150" src="https://upload.wikimedia.org/wikipedia/en/d/dd/MySQL_logo.svg" alt="mysql_logo">
</div>

## Instalación y Configuración

### 1. Instala XAMPP (o similar)
Si no lo has hecho ya, instala XAMPP (o una alternativa como WAMP) que incluye Apache, PHP y MySQL.

[Descargar XAMPP](https://www.apachefriends.org/index.html)

### 2. Configura XAMPP
Inicia XAMPP:
- Abre XAMPP y arranca los servicios de Apache y MySQL.

### 3. Configura Visual Studio Code
Instala la extensión PHP:

- Abre VS Code.
- Ve a la pestaña de Extensiones (Ctrl+Shift+X) y busca "PHP Intelephense".
- Instala la extensión PHP Intelephense.

## Explicación Parte 1.

# Proyecto de Conexión a Base de Datos MySQL y Manejo de Funciones Directas

Esta parte del proyecto está diseñado para conectar a una base de datos MySQL, crear una tabla de usuarios, insertar registros y manejar funciones para interactuar con la base de datos.

## Requisitos

- PHP 7.x o superior
- Servidor web con soporte para PHP y MySQL (como Apache)
- Extensión MySQLi habilitada en PHP

## Contenido

1. [Instalación](#instalación)
2. [Uso](#uso)
3. [Funciones](#funciones)
4. [Contribución](#contribución)
5. [Licencia](#licencia)
6. [Contacto](#contacto)

## Instalación

Para ejecutar este proyecto, sigue estos pasos:

1. **Clona el repositorio:**

    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    cd tu-repositorio
    ```

2. **Configura la base de datos MySQL:**

    - Crea una base de datos MySQL.
    - Configura las credenciales de conexión en el archivo `includes/dB_Connection_and_Functions.php`.

    ```php
    <?php
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "nombre_de_tu_base_de_datos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    ?>
    ```

3. **Ejecuta el script para configurar la base de datos:**

    Accede al script desde tu navegador web para crear la tabla `usuarios` y insertar registros:

    ```
    http://localhost/tu-repositorio/includes/dB_Connection_and_Functions.php
    ```

    Asegúrate de ajustar la URL según la estructura de tu proyecto.

## Uso

Después de configurar y ejecutar el script, puedes usar las siguientes funciones desde tu aplicación PHP:

1. **Obtener nombre por email:**

    ```php
    $email = "correo@example.com";
    $nombre = obtenerNombrePorEmail($email, $conn);
    echo "Nombre encontrado: $nombre";
    ```

2. **Actualizar contraseña por nombre:**

    ```php
    $nombre = "Juan";
    $nuevaContraseña = "nuevaContraseñaSegura";
    actualizarContraseñaPorNombre($nombre, $nuevaContraseña, $conn);
    ```

    Asegúrate de incluir las funciones `obtenerNombrePorEmail` y `actualizarContraseñaPorNombre` en tu script PHP para utilizarlas.

## Funciones

Esta parte del proyecto incluye las siguientes funciones principales:

- **obtenerNombrePorEmail:** Retorna el nombre de usuario dado un email.
- **actualizarContraseñaPorNombre:** Actualiza la contraseña de usuario dado un nombre.


## Explicación Parte 2.

# Proyecto de Ejecución Automática de Copia de Seguridad de Base de Datos MySQL

Esta parte del proyecto automatiza la tarea de realizar copias de seguridad diarias de una base de datos MySQL y almacenarlas en una carpeta específica del servidor.

## Requisitos

- PHP 7.x o superior
- Servidor web con soporte para PHP y MySQL (como Apache)
- Extensión MySQLi habilitada en PHP
- Utilidad `mysqldump` instalada y accesible desde la línea de comandos

## Contenido

1. [Instalación](#instalación)
2. [Configuración de la Tarea Automática](#configuración-de-la-tarea-automática)
3. [Funcionamiento](#funcionamiento)
4. [Licencia](#licencia)
5. [Contacto](#contacto)

## Instalación

Para ejecutar este proyecto, sigue estos pasos:

1. **Clona el repositorio:**

    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    cd tu-repositorio
    ```

2. **Configura la base de datos MySQL:**

    - Asegúrate de que la base de datos MySQL y la tabla de usuarios estén configuradas según la Parte 1 del proyecto.
    - Configura las credenciales de conexión en el script `backup_script.php`.

    ```php
    <?php
    // Datos de conexión a la base de datos
    $nombreServidor = "localhost";
    $nomUsuarioDB = "tu_usuario";
    $contrasena = "tu_contraseña";
    $dbNombre = "nombre_de_tu_base_de_datos";
    ?>
    ```

3. **Configura la tarea automática (cron job):**

    - En tu servidor, configura una tarea automática (cron job) para ejecutar el script `backup_script.php` todos los días a las 12:00 PM.

    ```
    0 12 * * * php /ruta/a/tu/script/backup_script.php >/dev/null 2>&1
    ```

    Asegúrate de ajustar la ruta al script según la estructura de tu servidor.

## Configuración de la Tarea Automática

La tarea automática (cron job) configurada ejecutará el script `backup_script.php` todos los días a las 12:00 PM. Este script realizará automáticamente una copia de seguridad de la base de datos y la almacenará en una carpeta designada en el servidor.

## Funcionamiento

El script `backup_script.php` realiza las siguientes acciones:

1. Conecta a la base de datos MySQL.
2. Verifica la existencia de la base de datos.
3. Crea un archivo de copia de seguridad SQL utilizando `mysqldump`.
4. Almacena la copia de seguridad en una carpeta específica del servidor.
5. Registra el resultado en un archivo de log.


## Explicación Parte 3.

# Proyecto de Desarrollo Web con PHP, HTML, CSS, JavaScript y WordPress

Esta parte del proyecto consiste en desarrollar una pequeña aplicación web que cumple con los siguientes requisitos:

1. **Registro de Usuarios**
   - Una página de inicio (`index.php`) que contiene un formulario de registro de usuarios.
   - Utiliza HTML, CSS y JavaScript para la validación del formulario.
   - Al enviar el formulario, los datos deben ser almacenados en una base de datos MySQL.

2. **Inicio de Sesión**
   - Una página (`login.php`) que permite a los usuarios iniciar sesión utilizando su email y contraseña.

3. **Dashboard**
   - Una página (`dashboard.php`) accesible solo para usuarios autenticados.
   - Muestra un mensaje de bienvenida con el nombre del usuario y un enlace para cerrar sesión.

## Requisitos

- PHP 7.x o superior
- Servidor web con soporte para PHP y MySQL (como Apache)
- Extensión MySQLi habilitada en PHP
- Utilidad `mysqldump` instalada y accesible desde la línea de comandos (para la Parte 2)

## Instalación y Configuración

Para ejecutar esta parte del proyecto, sigue estos pasos:

1. **Clona el repositorio:**

    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    cd tu-repositorio
    ```

2. **Configura la base de datos MySQL:**

    - Crea una base de datos MySQL (o utiliza la base de datos `pruebatecnica_db` creada en la Parte 1 del proyecto).
    - Configura las credenciales de conexión en el archivo `includes/connection_db.php`.

    ```php
    <?php
    // Archivo: includes/connection_db.php
    $nombreServidor = "localhost";
    $nomUsuarioDB = "tu_usuario";
    $contrasena = "tu_contraseña";
    $dbNombre = "nombre_de_tu_base_de_datos";
    
    $conn = new mysqli($nombreServidor, $nomUsuarioDB, $contrasena, $dbNombre);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    ?>
    ```

3. **Ejecuta las páginas:**

    - Accede a las siguientes páginas desde tu navegador web:

      - Para registrarse: `http://localhost/tu-repositorio/index.php`
      - Para iniciar sesión: `http://localhost/tu-repositorio/login.php`
      - Para acceder al dashboard (después de iniciar sesión correctamente): `http://localhost/tu-repositorio/dashboard.php`

[Parte 4](https://github.com/Aljure-bit/prueba_tecnica_pt_4)

