<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


function conectarBaseDeDatos() {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ventas_comerciales", "dwes", "dwes");


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}

function consultarVentasPorComercial($comercial_id) {
    try {
        $pdo = conectarBaseDeDatos();
        $stmt = $pdo->prepare("SELECT * FROM Ventas WHERE codComercial = :comercial_id");
        $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al consultar ventas por comercial: " . $e->getMessage());
    }
}



function consultarComerciales() {
    try {
        $pdo = conectarBaseDeDatos();
        $stmt = $pdo->query("SELECT codigo, nombre FROM Comerciales");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al consultar comerciales: " . $e->getMessage());
    }
}


function consultarProductos() {
    try {
        $pdo = conectarBaseDeDatos();
        $stmt = $pdo->query("SELECT referencia, nombre FROM Productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al consultar productos: " . $e->getMessage());
    }
}

function insertarVenta($comercial_id, $producto_referencia, $fecha, $cantidad, $precio) {
    
}

function modificarVenta($venta_id, $comercial_id, $producto_referencia, $fecha, $cantidad, $precio) {
    
}

function eliminarVenta($venta_id) {
   
}

function controlIntegridadReferencialVenta($producto_referencia) {
    
}
?>
