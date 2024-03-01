<?php
session_start();

require_once 'usuarios.php';

try {
    // Conectar a la base de datos (reemplaza con tus propios datos)
    $servername = "localhost";
    $dbusername = "dwes";
    $dbpassword = "dwes";
    $dbname = "tarea4";

    $db = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia de la clase Usuarios
    $usuarios = new Usuarios($db);

    // Verificar si el formulario de inicio de sesión ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Validar usuario y contraseña
        if ($usuarios->validarUsuario($usuario, $contrasena)) {
            $_SESSION['usuario'] = $usuario;
            header('Location: aplicacion.php');
            exit;
        } else {
            $mensajeError = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?= isset($mensajeError) ? "<p style='color: red;'>$mensajeError</p>" : '' ?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
