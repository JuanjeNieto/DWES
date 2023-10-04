<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    function ecuacion2g($a, $b, $c){
        $discriminante = ($b * $b) + (4 * $a * $c);

        if ($discriminante < 0) {
            return false;
        } else {
            $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
            $x2 = (-$b - sqrt($discriminante)) / (2 * $a);

            return array($x1, $x2); 
        }        
    }
    
    $a = 1;

    $b = 3;

    $c = 2;

    $solucion = ecuacion2g($a, $b, $c);

    if ($solucion === false) {
        echo "no hay soluciones reales";
    } else {
        echo "las soluciones son " . $solucion[0] . ", " . $solucion[1];

    }
    ?>
</body>
</html>