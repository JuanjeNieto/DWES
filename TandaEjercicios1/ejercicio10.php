<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $cadena="Esto es un string de varias palabras"; 

        echo "Numero de caracteres: " . strlen($cadena) . "<br>";

        echo "A mayusculas: " . strtoupper($cadena) . "<br>";

        echo "Numero de palabras: " . str_word_count($cadena) . "<br>";


    ?>
</body>
</html>