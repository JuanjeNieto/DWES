<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventas_comerciales", "dwes", "dwes");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

function consultarVentasPorComercial($comercial_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT codComercial, refProducto, cantidad, fecha FROM Ventas WHERE codComercial = :comercial_id");
        $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al consultar ventas por comercial: " . $e->getMessage());
    }
}

function consultarComerciales() {
    global $pdo;
    return consultarDatos($pdo, "Comerciales", ["codigo", "nombre"]);
}

function consultarProductos() {
    global $pdo;
    return consultarDatos($pdo, "Productos", ["referencia", "nombre"]);
}

function consultarDatos($pdo, $table, $columns) {
    try {
        $stmt = $pdo->query("SELECT " . implode(", ", $columns) . " FROM " . $table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al consultar $table: " . $e->getMessage());
    }
}


function insertarVenta($comercial_id, $producto_referencia, $fecha, $cantidad) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO Ventas (codComercial, refProducto, cantidad, fecha) VALUES (:comercial_id, :producto_referencia, :cantidad, :fecha)");
        $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);
        $stmt->bindParam(':producto_referencia', $producto_referencia, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al insertar venta: " . $e->getMessage());
    }
}
function insertarComercial($codigo, $nombre, $salario, $hijos, $fNacimiento) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO Comerciales (codigo, nombre, salario, hijos, fNacimiento) VALUES (:codigo, :nombre, :salario, :hijos, :fNacimiento)");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':salario', $salario, PDO::PARAM_STR);
        $stmt->bindParam(':hijos', $hijos, PDO::PARAM_INT);
        $stmt->bindParam(':fNacimiento', $fNacimiento, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al insertar comercial: " . $e->getMessage());
    }
}
function insertarProducto($referencia, $nombre, $descripcion, $precio, $descuento) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO Productos (referencia, nombre, descripcion, precio, descuento) VALUES (:referencia, :nombre, :descripcion, :precio, :descuento)");
        $stmt->bindParam(':referencia', $referencia, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':descuento', $descuento, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al insertar producto: " . $e->getMessage());
    }
}



function modificarVenta($venta_id, $comercial_id, $producto_referencia, $fecha, $cantidad) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE Ventas SET codComercial = :comercial_id, refProducto = :producto_referencia, cantidad = :cantidad, fecha = :fecha WHERE venta_id = :venta_id");
        $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);
        $stmt->bindParam(':producto_referencia', $producto_referencia, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al modificar venta: " . $e->getMessage());
    }
}

function eliminarVenta($venta_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM Ventas WHERE venta_id = :venta_id");
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al eliminar venta: " . $e->getMessage());
    }
}

function controlIntegridadReferencialVenta($producto_referencia) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM Ventas WHERE refProducto = :producto_referencia");
        $stmt->bindParam(':producto_referencia', $producto_referencia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al verificar integridad referencial: " . $e->getMessage());
    }
}
