<?php
include("funciones.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["table"] === "comerciales") {
        $codigo = $_POST["codigo"];
        
        try {
            eliminarComercial($codigo);
            echo "Comercial eliminado correctamente.";
        } catch (PDOException $e) {
            echo "Error al eliminar comercial: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Eliminar Datos</h1>
    <h2>Al eliminar el producto/comercial, se elimina automáticamente cualquier venta asociada</h2>
    <form method="post">
        <label for="codigo">Selecciona un Comercial:</label>
        <select name="codigo">
            <?php
            $comerciales = consultarComerciales();
            foreach ($comerciales as $comercial) {
                echo "<option value='{$comercial['codigo']}'>{$comercial['nombre']}</option>";
            }
            ?>
        </select>
        <input type="hidden" name="table" value="comerciales">
        <input type="submit" value="Eliminar Comercial">        
    </form>
    <h3><a href="index.php">Volver</a></h3>
</body>
</html>
