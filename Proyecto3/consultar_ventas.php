<?php
include("funciones.php");


$comerciales = consultarComerciales();
$ventas = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comercial_id"])) {
    $comercial_id = $_POST["comercial_id"];
    $ventas = consultarVentasPorComercial($comercial_id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Ventas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Consultar Ventas por Comercial</h1>
    
    <form method="post">
    <label for="comercial_id">Selecciona un comercial:</label>
    <select name="comercial_id">
        <option value="default" selected>Selecciona un comercial</option>
        <?php foreach ($comerciales as $comercial) : ?>
            <option value="<?= $comercial['codigo'] ?>"><?= $comercial['nombre'] ?></option>
        <?php endforeach; ?>
    </select>

        <input type="submit" value="Consultar">
    </form>

    <?php if (!empty($ventas)) : ?>
        <table>
            <tr>
                <th>Código Comercial</th>
                <th>Referencia Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?= $venta['codComercial'] ?></td>
                    <td><?= $venta['refProducto'] ?></td>
                    <td><?= $venta['cantidad'] ?></td>
                    <td><?= $venta['fecha'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
