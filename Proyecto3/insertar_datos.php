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
