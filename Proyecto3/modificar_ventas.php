<?php
include("funciones.php");

$comerciales = consultarComerciales(); // Retrieve the commercial data.
$selectedComercial = null; // Initialize $selectedComercial to null by default.

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comercial_id"]) && isset($_POST["venta_id"])) {
    $comercial_id = $_POST["comercial_id"];
    $venta_id = $_POST["venta_id"];
    $fecha = $_POST["fecha"];
    $cantidad = $_POST["cantidad"];

    modificarVenta($venta_id, $fecha, $cantidad);
}

$ventas = [];

if (isset($_POST["comercial_id"])) {
    $comercial_id = $_POST["comercial_id"];
    $ventas = consultarVentasPorComercial($comercial_id);

    // Fetch the selected commercial's name
    foreach ($comerciales as $comercial) {
        if ($comercial['codigo'] === $comercial_id) {
            $selectedComercial = $comercial['nombre'];
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Ventas por Comercial</title>
</head>
<body>
    <h1>Modificar Ventas por Comercial</h1>
    <form method="post">
        <label for="comercial_id">Selecciona un comercial:</label>
        <select name="comercial_id">
            <option value="" <?php echo ($selectedComercial === null) ? 'selected' : ''; ?>>Seleccione un comercial</option>
            <?php
            // Populate the dropdown with commercials
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}' " . ($comercial['nombre'] === $selectedComercial ? 'selected' : '') . ">{$comercial['nombre']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar Comercial">
    </form>
    <h2>
        <?php 
            if ($selectedComercial !== null) {
                echo "Comercial seleccionado: {$selectedComercial}";
            } else {
                echo "Comercial seleccionado: No se ha seleccionado un comercial";
            }
        ?>
    </h2>
    <?php if (!empty($ventas)) { ?>
        <h2>Ventas para el Comercial seleccionado</h2>
        <form method="post">
            <label for="venta_id">Selecciona una venta:</label>
            <select name="venta_id">
                <option value="" selected disabled>Seleccione una venta</option>
                <?php
                // Populate the dropdown with sales records for the selected commercial
                foreach ($ventas as $venta) {
                    echo "<option value='{$venta['id']}'>Venta ID: {$venta['id']}</option>";
                }
                ?>
            </select>

            <label for="fecha">Nueva Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="cantidad">Nueva Cantidad:</label>
            <input type="number" name="cantidad" required>

            <input type="submit" value="Modificar Venta">
        </form>
    <?php } ?>
</body>
</html>
