<?php
// Check if the form is submitted for setting preferences
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $backgroundColor = $_POST["background_color"];
    setcookie("background_color", $backgroundColor, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
}

// Check if the form is submitted for resetting preferences
if (isset($_POST["reset_preferences"])) {
    setcookie("background_color", "", time() - 3600, "/"); // Expire the cookie
}

// Get the current background color from the cookie
$backgroundColor = isset($_COOKIE["background_color"]) ? $_COOKIE["background_color"] : "white";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Add a dynamic class to the body based on the background color */
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>

<h2>Preferences</h2>

<!-- Form to set preferences -->
<form method="post" action="preferencias.php">
    <label for="background_color">Background Color:</label>
    <input type="color" name="background_color" value="<?php echo $backgroundColor; ?>">
    <button type="submit">Set Preferences</button>
</form>

<!-- Form to reset preferences -->
<form method="post" action="preferencias.php">
    <button type="submit" name="reset_preferences">Reset Preferences</button>
</form>

<!-- Link to return to the home page -->
<p><a href="aplicacion.php">Return to Application</a></p>

</body>
</html>
