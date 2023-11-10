<?php
include("funciones.php");

$comerciales = consultarComerciales();

$ventas = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comercial_id"])) {
    $comercial_id = $_POST["comercial_id"];

    $ventas = consultarVentasPorComercial($comercial_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["venta_id"])) {
    $venta_id = $_POST["venta_id"];
    // Call the eliminarVenta function only if venta_id is not empty
    if (!empty($venta_id)) {
        list($codComercial, $refProducto, $fecha) = explode('-', $venta_id);
        eliminarVenta($codComercial, $refProducto, $fecha);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Eliminar Venta</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Eliminar Venta</h1>
    <form method="post">
        <label for="comercial_id">Selecciona un comercial:</label>
        <select name="comercial_id">
            <option value="" selected disabled>Seleccione un comercial</option>
            <?php
            // Populate the dropdown with commercials
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}'>{$comercial['nombre']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar Comercial">
    </form>

    <?php if (!empty($ventas)) { ?>
        <h2>Ventas para el Comercial seleccionado</h2>
        <form method="post">
            <label for="venta_id">Selecciona una venta:</label>
            <select name="venta_id">
                <option value="" selected disabled>Seleccione una venta</option>
                <?php
                // Populate the dropdown with sales records for the selected commercial
                foreach ($ventas as $venta) {
                    echo "<option value='{$venta['codComercial']}-{$venta['refProducto']}-{$venta['fecha']}'>Venta ID: {$venta['codComercial']}-{$venta['refProducto']}-{$venta['fecha']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Eliminar Venta">
        </form>
    <?php } ?>
</body>
</html>
