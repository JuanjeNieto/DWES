<?php
session_start();
include 'functions.php';

$backgroundColor = getBackgroundColor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        if (isset($_POST["background_color"])) {
            $selectedColor = $_POST["background_color"];
            setBackgroundColor($selectedColor);
            $backgroundColor = $selectedColor;
        } elseif (isset($_POST["reset_preferences"])) {
            resetBackgroundColor();
            $backgroundColor = getBackgroundColor(); // Reset to default color after preferences reset
        }
    }
}

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
