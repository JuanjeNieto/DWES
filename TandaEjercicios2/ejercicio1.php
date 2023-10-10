<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 1</title>
</head>
<body>
    <?php
   
    $phpVersion = phpversion();

    $phpConfig = phpinfo(INFO_ALL);

    echo "PHP Version: " . $phpVersion . "<br><br>";
    echo "PHP Configuration information:<br>";
    echo $phpConfig;
    ?>

</body>
</html>