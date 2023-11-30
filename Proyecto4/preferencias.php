<?php
// Start the session
session_start();

// Check if the form is submitted for setting preferences
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $backgroundColor = $_POST["background_color"];

    // Store the background color in a cookie that expires in 30 days, with a unique name based on the username
    setcookie("background_color_" . $_SESSION["username"], $backgroundColor, time() + (86400 * 30), "/");
}

// Check if the form is submitted for resetting preferences
if (isset($_POST["reset_preferences"]) && isset($_SESSION["username"])) {
    // Expire the background color cookie
    setcookie("background_color_" . $_SESSION["username"], "", time() - 3600, "/");
}

// Get the current background color from the cookie or set a default
$backgroundColor = isset($_COOKIE["background_color_" . $_SESSION["username"]]) ? $_COOKIE["background_color_" . $_SESSION["username"]] : "white";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences</title>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>

<h2>Preferences</h2>

<!-- Display the current user -->
<p>Logged in as: <?php echo $_SESSION["username"]; ?></p>

<!-- Form to set preferences (only if user is logged in) -->
<?php if (isset($_SESSION["username"])) : ?>
    <form method="post" action="preferencias.php">
        <label for="background_color">Background Color:</label>
        <input type="color" name="background_color" value="<?php echo $backgroundColor; ?>">
        <button type="submit">Set Preferences</button>
    </form>

    <!-- Form to reset preferences (only if user is logged in) -->
    <form method="post" action="preferencias.php">
        <button type="submit" name="reset_preferences">Reset Preferences</button>
    </form>
<?php endif; ?>

<!-- Link to return to the home page -->
<p><a href="aplicacion.php">Return to Application</a></p>

</body>
</html>
