<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <p>Inserta el dia de la semana (lunes a viernes)</p>
        <input type="text" name="dia">
        <input type="submit" value="Asignatura">
    </form>
    <?php 
    $dia = $_GET['dia'];
    switch ($dia) {
        case 'lunes':
            echo "Toca DWES el día $dia a primera hora";
            break;
        
        default:
            # code...
            break;
    }
    
    ?>
</body>
</html>