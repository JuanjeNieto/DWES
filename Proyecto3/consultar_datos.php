<?php
include("funciones.php");

$datos = [];
$table_name = '';
$columns = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table"])) {
    $table_name = $_POST["table"];
    if ($table_name === "comerciales") {
        $columns = ["codigo", "nombre", "salario", "fNacimiento"];
        $datos = consultarComerciales();
    } elseif ($table_name === "productos") {
        $columns = ["referencia", "nombre", "descripcion", "precio", "descuento"];
        $datos = consultarProductos();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Consultar Datos</h1>
    <form method="post">
        <label for="table">Selecciona una tabla:</label>
        <select name="table">
        <option value="default" selected>Selecciona una tabla</option>
            <option value="comerciales">Comerciales</option>
            <option value="productos">Productos</option>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <?php if (!empty($datos)) : ?>
        <table>
            <tr>
                <?php foreach ($columns as $column) : ?>
                    <th><?= ucfirst($column) ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($datos as $dato) : ?>
                <tr>
                    <?php foreach ($columns as $column) : ?>
                        <td><?= $dato[$column] ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
