<?php
include("funciones.php");

$comerciales = consultarComerciales();

$selectedComercial = null;
$ventas = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comercial_id"])) {
    $comercial_id = $_POST["comercial_id"];
    $selectedComercial = $comercial_id;
    $ventas = consultarVentasPorComercial($comercial_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["venta_id"], $_POST["cantidad"], $_POST["fecha"])) {
    $venta_id = $_POST["venta_id"];
    list($codComercial, $refProducto, $fecha) = explode('-', $venta_id);
    $nuevaCantidad = $_POST["cantidad"];
    $nuevaFecha = $_POST["fecha"];

    // Call the modificarVenta function
    modificarVenta($codComercial, $refProducto, $fecha, $nuevaCantidad, $nuevaFecha);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ventas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Modificar Ventas</h1>

    <form method="post">
        <label for="comercial_id">Selecciona un comercial:</label>
        <select name="comercial_id">
            <option value="" <?php echo ($selectedComercial === null) ? 'selected' : ''; ?>>Seleccione un comercial</option>
            <?php
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}' " . ($comercial['codigo'] == $selectedComercial ? 'selected' : '') . ">{$comercial['nombre']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar Comercial">
    </form>

    <?php if (!empty($ventas)) { ?>
    <h2>Ventas para el Comercial seleccionado</h2>
    <table>
        <thead>
            <tr>
                <th>Código Comercial</th>
                <th>Referencia Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ventas as $venta) {
                echo "<tr>";
                echo "<td>{$venta['codComercial']}</td>";
                echo "<td>{$venta['refProducto']}</td>";
                echo "<td>{$venta['cantidad']}</td>";
                echo "<td>{$venta['fecha']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Modificar Venta</h2>
    <form method="post">
        <label for="venta_id">Selecciona una venta:</label>
        <select name="venta_id">
            <option value="" selected disabled>Seleccione una venta</option>
            <?php
            foreach ($ventas as $venta) {
                echo "<option value='{$venta['codComercial']}-{$venta['refProducto']}-{$venta['fecha']}'>Venta ID: {$venta['codComercial']}-{$venta['refProducto']}-{$venta['fecha']}</option>";
            }
            ?>
        </select>

        <label for="cantidad">Nueva Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label for="fecha">Nueva Fecha:</label>
        <input type="date" name="fecha" required>

        <input type="submit" value="Modificar Venta">
    </form>
<?php } ?>
</body>
</html>
