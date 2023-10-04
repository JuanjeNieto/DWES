<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $estaturas = array();

        $estaturas["Juan"] = 186;
        $estaturas["Alberto"] = 172;
        $estaturas["Marta"] = 173;

        echo $estaturas["Alberto"] . "<br>";


        foreach ($estaturas as $nombre => $estatura) { 
            if ($estatura % 2 == 0) {
                echo $nombre . ": " . $estatura . "<br>";
            }
        }

        echo "<br>";
        arsort($estaturas);
        foreach ($estaturas as $nombre => $estatura) {
            echo $nombre . ": " . $estatura . "<br>";
        }

        echo "<br>";
        krsort($estaturas);
        foreach ($estaturas as $nombre => $estatura) {
            echo $nombre . ": " . $estatura . "<br>";
        }
    ?>
</body>
</html>