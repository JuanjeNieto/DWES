<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comercial_id"])) {
    $comercial_id = $_POST["comercial_id"];
    $ventas = consultarVentasPorComercial($comercial_id);
}

$comerciales = consultarComerciales();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Ventas</title>
</head>
<body>
    <h1>Consultar Ventas por Comercial</h1>
    <form method="post">
        <label for="comercial_id">Selecciona un comercial:</label>
        <select name="comercial_id">
            <?php foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['id']}'>{$comercial['nombre']}</option>";
            } ?>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <?php
    if (isset($ventas)) {
        // Muestra la lista de ventas.
        echo "<table>";
        echo "<tr>";
        echo "<th>Código Comercial</th>";
        echo "<th>Referencia Producto</th>";
        echo "<th>Cantidad</th>";
        echo "<th>Fecha</th>";
        echo "</tr>";

        foreach ($ventas as $venta) {
            echo "<tr>";
            echo "<td>{$venta['codComercial']}</td>";
            echo "<td>{$venta['refProducto']}</td>";
            echo "<td>{$venta['cantidad']}</td>";
            echo "<td>{$venta['fecha']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>
</html>
