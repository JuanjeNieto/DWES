<?php
session_start();

// Include the funciones.inc file
include 'functions.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verify user credentials
    if (verifyUser($username, $password)) {
        // Authentication successful, create a session
        $_SESSION["username"] = $username;
        $_SESSION["login_time"] = time();

        // Redirect to aplicacion.php or any other authenticated page
        header("Location: aplicacion.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>

<h2>Login</h2>

<!-- Display error message if authentication failed -->
<?php if (isset($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<!-- Login form -->
<form method="post" action="index.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
<p>
    Entrar como invitado:
    <a href="informacion.php"><button>Entrar</button></a>
</p>

</body>
</html>
