<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Validación de Fecha en PHP</title>
</head>
<body>

<?php
// Definir variables y establecer valores predeterminados
$fecha = $fechaError = "";

// Función para validar el formato de fecha
function validarFecha($fecha) {
    // Expresión regular para el formato YYYY-MM-DD
    $patron = "/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/";
    return preg_match($patron, $fecha);
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar la fecha
    $fecha = $_POST["fecha"];
    if (!validarFecha($fecha)) {
        $fechaError = "Formato de fecha no válido. Utiliza YYYY-MM-DD.";
    }
}
?>

<h2>Formulario con Validación de Fecha en PHP</h2>

<form method="post" action="https://educacionadistancia.juntadeandalucia.es/centros/cadiz/pluginfile.php/887484/mod_assign/introattachment/0/<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>
    <span style="color: red;"><?php echo $fechaError;?></span>
    <br><br>
    <input type="submit" value="Enviar">
</form>

</body>
</html>
