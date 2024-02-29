<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

require_once 'usuarios.php';

// Conectar a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$dbusername = "dwes";
$dbpassword = "dwes";
$dbname = "tarea4";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia de la clase Usuarios
    $usuarios = new Usuarios($conn);

    // Verificar si el formulario de alta ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $email = $_POST['email'];

        // Lógica para dar de alta un usuario
        $usuarios->altaUsuario($usuario, $contrasena, $email);

        // Redirigir a la página principal después de dar de alta al usuario
        header('Location: aplicacion.php');
        exit;
    }
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Usuario</title>
</head>
<body>
    <h1>Dar de Alta Usuario</h1>

    <!-- Formulario de alta de usuario -->
    <form method="post" action="">
        <label for="usuario">User</label>
        <input type="text" name="usuario" required><br>
        <label for="contrasena">Password</label>
        <input type="password" name="contrasena" required><br>
        <label for="email">Email</label>
        <input type="email" name="email" required><br>
        <input type="submit" value="Dar de Alta">
    </form>
</body>
</html>
