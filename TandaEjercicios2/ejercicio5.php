<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $number = 12345;
    $sum = 0;

    while ($number > 0) {
        $digit = $number % 10;
        $sum += $digit;
        $number = (int)($number / 10);
    }

    echo "Sum of the digits: $sum";
    ?>

</body>
</html>