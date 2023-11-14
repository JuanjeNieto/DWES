<?php
include("funciones.php");

$comerciales = consultarComerciales();
$ventas = [];

$comercial_id = isset($_POST["comercial_id"]) ? $_POST["comercial_id"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $comercial_id !== null) {
    $ventas = consultarVentasPorComercial($comercial_id);

    if (isset($_POST["delete_venta"])) {
        $codComercial = $_POST["codComercial"];
        $refProducto = $_POST["refProducto"];
        $fecha = $_POST["fecha"];

        eliminarVenta($codComercial, $refProducto);
        // Refresh the table after deletion
        $ventas = consultarVentasPorComercial($comercial_id);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Ventas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Eliminar Ventas</h1>

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
                <th>Acciones</th>
            </tr>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?= $venta['codComercial'] ?></td>
                    <td><?= $venta['refProducto'] ?></td>
                    <td><?= $venta['cantidad'] ?></td>
                    <td><?= $venta['fecha'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="comercial_id" value="<?= $comercial_id ?>">
                            <input type="hidden" name="codComercial" value="<?= $venta['codComercial'] ?>">
                            <input type="hidden" name="refProducto" value="<?= $venta['refProducto'] ?>">
                            <input type="hidden" name="fecha" value="<?= $venta['fecha'] ?>">
                            <input type="submit" name="delete_venta" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
