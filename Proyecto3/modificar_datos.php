<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["table"] === "comerciales") {
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $salario = $_POST["salario"];
        $hijos = $_POST["hijos"];
        $fNacimiento = $_POST["fNacimiento"];
        modificarComercial($codigo, $nombre, $salario, $hijos, $fNacimiento);
    } elseif ($_POST["table"] === "productos") {
        $referencia = $_POST["referencia"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $descuento = $_POST["descuento"];
        modificarProducto($referencia, $nombre, $descripcion, $precio, $descuento);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Modificar Datos</h1>
    
    <h2>Modificar Comerciales</h2>
    <form method="post">
        <input type="hidden" name="table" value="comerciales">
        
        <label for="codigo">Selecciona un Comercial:</label>
        <select name="codigo">
            <?php
            $comerciales = consultarComerciales();
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}'>{$comercial['nombre']}</option>";
            }
            ?>
        </select>
        
        <br><br>
        
        <label for="nombre">Nuevo Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        
        <label for="salario">Nuevo Salario:</label>
        <input type="number" name="salario" required step="any" min="0"><br><br>
        
        <label for="hijos">Nuevo Número de Hijos:</label>
        <input type="number" name="hijos" required><br><br>
        
        <label for="fNacimiento">Nueva Fecha de Nacimiento:</label>
        <input type="date" name="fNacimiento" required><br><br>
        
        <input type="submit" value="Modificar Comercial">
    </form>
<br>
    <h2>Modificar Productos</h2>
    <form method="post">
        <input type="hidden" name="table" value="productos">
        
        <label for="referencia">Selecciona un Producto:</label>
        <select name="referencia">
            <?php
            $productos = consultarProductos();
            foreach ($productos as $producto) {
                echo "<option value='{$producto['referencia']}'>{$producto['nombre']}</option>";
            }
            ?>
        </select>
        
        <br><br>
        
        <label for="nombre">Nuevo Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        
        <label for="descripcion">Nueva Descripción:</label>
        <input type="text" name = "descripcion" required><br><br>
        
        <label for="precio">Nuevo Precio:</label>
        <input type="number" name="precio" required step="any" min="0"><br><br>
        
        <label for="descuento">Nuevo Descuento:</label>
        <input type="number" name="descuento" required step="any" min="0"><br><br>
        
        <input type="submit" value="Modificar Producto">
    </form>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
