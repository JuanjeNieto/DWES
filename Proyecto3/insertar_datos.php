<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["table"] === "comerciales") {
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $salario = $_POST["salario"];
        $hijos = $_POST["hijos"];
        $fNacimiento = $_POST["fNacimiento"];
        insertarComercial($codigo, $nombre, $salario, $hijos, $fNacimiento);
    } elseif ($_POST["table"] === "productos") {
        $referencia = $_POST["referencia"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $descuento = $_POST["descuento"];
        insertarProducto($referencia, $nombre, $descripcion, $precio, $descuento);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Insertar Datos</h1>
    
    <h2>Insertar Comerciales</h2>
    <form method="post">
        <input type="hidden" name="table" value="comerciales">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required><br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label for="salario">Salario:</label>
        <input type="number" name="salario" required step="any" min="0"><br><br>
        <label for="hijos">Hijos:</label>
        <input type="number" name="hijos" required><br><br>
        <label for="fNacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fNacimiento" required><br><br>
        <input type="submit" value="Insertar Comercial">
    </form>

    <h2>Insertar Productos</h2>
    <form method="post">
        <input type="hidden" name="table" value="productos">
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" required><br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required><br><br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" required step="any" min="0"><br><br>
        <label for="descuento">Descuento:</label>
        <input type="number" name="descuento" required step="any" min="0"><br><br>
        <input type="submit" value="Insertar Producto">
    </form>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
