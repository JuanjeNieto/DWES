<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $input = array(1, 1, 2, 2, 3, 4, 5, 5);
    $output = array();

    for ($i = 0; $i < count($input); $i++) {
        if ($i == 0 || $input[$i] != $input[$i - 1]) {
            $output[] = $input[$i];
        }
    }

    echo "Input: (" . implode(", ", $input) . ")<br>";
    echo "Output: (" . implode(", ", $output) . ")";
    ?>

</body>
</html>