<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comercial_id = $_POST["comercial_id"];
    $producto_referencia = $_POST["producto_referencia"];
    $fecha = $_POST["fecha"];
    $cantidad = $_POST["cantidad"];
    insertarVenta($comercial_id, $producto_referencia, $fecha, $cantidad);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Ventas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Insertar Ventas</h1>
    <form method="post">
        <label for="comercial_id">Selecciona un Comercial:</label>
        <select name="comercial_id">
            <?php
            $comerciales = consultarComerciales();
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}'>{$comercial['nombre']}</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="producto_referencia">Selecciona un Producto:</label>
        <select name="producto_referencia">
            <?php
            $productos = consultarProductos();
            foreach ($productos as $producto) {
                echo "<option value='{$producto['referencia']}'>{$producto['nombre']}</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required>

        <br><br>

        <input type="submit" value="Insertar Venta">
    </form>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
