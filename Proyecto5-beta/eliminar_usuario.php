<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Incluir la clase Usuarios y las funciones
require_once 'usuarios.php';

// Verificar si se ha enviado el formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos (reemplaza con tus propios datos)
    $servername = "localhost";
    $dbusername = "dwes";
    $dbpassword = "dwes";
    $dbname = "tarea4";

    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear una instancia de la clase Usuarios
        $usuarios = new Usuarios($db);

        // Obtener el ID del usuario a eliminar
        $id = $_POST['id'];

        // Lógica para eliminar usuario
        $usuarios->eliminarUsuario($id);

        // Redirigir a la página principal después de eliminar el usuario
        header('Location: aplicacion.php');
        exit;
    } catch (PDOException $e) {
        die("Error connecting to the database: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
</head>
<body>
    <h1>Eliminar Usuario</h1>

    <!-- Formulario de eliminación de usuario -->
    <form method="post" action="">
        <label for="id">ID del Usuario a Eliminar:</label>
        <input type="text" name="id" required><br>
        <input type="submit" value="Eliminar Usuario">
    </form>
</body>
</html>
