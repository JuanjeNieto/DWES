<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $colores = array("rojo", "verde", "azul", "amarillo");

        sort($colores);
        
        for ($i=0; $i < count($colores) ; $i++) { 
            echo $colores[$i];
            echo "<br>";
        }

        echo "<br>";
        rsort($colores);
        
        for ($i=0; $i < count($colores) ; $i++) { 
            echo $colores[$i];
            echo "<br>";
        }
    ?>
</body>
</html>