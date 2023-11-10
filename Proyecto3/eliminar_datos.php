<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["table"] === "productos") {
        $referencia = $_POST["referencia"];
        
        try {
            eliminarProducto($referencia);
            echo "Producto eliminado correctamente.";
        } catch (PDOException $e) {
            echo "Error al eliminar producto: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Eliminar Datos</h1>

    <form method="post">
        <label for="referencia">Selecciona un Producto:</label>
        <select name="referencia">
            <?php
            $productos = consultarProductos();
            foreach ($productos as $producto) {
                echo "<option value='{$producto['referencia']}'>{$producto['nombre']}</option>";
            }
            ?>
        </select>
        <input type="hidden" name="table" value="productos">
        <input type="submit" value="Eliminar Producto">        
    </form>
</body>
</html>
