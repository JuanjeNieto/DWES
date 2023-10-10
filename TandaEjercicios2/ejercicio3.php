<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function isPrime($num) {
            if ($num <= 1) {
                return false;
            }
            for ($i = 2; $i * $i <= $num; $i++) {
                if ($num % $i == 0) {
                    return false;
                }
            }
            return true;
        }

        $sum = 0;

        for ($i = 2; $i < 100; $i++) {
            if (isPrime($i)) {
                $sum += $i;
            }
        }

        echo "Sum of prime numbers less than 100 is: $sum";
        ?>

</body>
</html>