<?php
session_start();

require_once 'usuarios.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$nombreDesarrollador = "Juanje";

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

    // Obtener todos los usuarios
    $listaUsuarios = $usuarios->obtenerTodosUsuarios();
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación</title>
</head>
<body>
    <h1>Bienvenido a la Aplicación</h1>
    <p>Acceso correcto. Desarrollado por: <?php echo $nombreDesarrollador; ?></p>

    <!-- Opciones de alta, modificación, eliminación y salir -->
    <ul>
        <li><a href="alta_usuario.php">Dar de Alta Usuario</a></li>
        <li><a href="modificar_usuario.php">Modificar Datos de Usuario</a></li>
        <li><a href="eliminar_usuario.php">Eliminar Usuario</a></li>
    </ul>

    <form method="post" action="salir.php">
        <input type="submit" value="Salir">
    </form>

    <!-- Mostrar la tabla de usuarios -->
    <h2>Usuarios Registrados</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaUsuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['usuario']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
