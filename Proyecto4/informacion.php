<?php
session_start();

// Include the funciones.inc file
include 'functions.php';

// Check if the user is authenticated, if not, set default information
if (!isset($_SESSION["username"])) {
    $username = "Not Authenticated";
    $loginTime = null; // or set to a default value for unauthenticated users
} else {
    // User is authenticated, get user information from the session
    $username = $_SESSION["username"];
    $loginTime = $_SESSION["login_time"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Add a dynamic class to the body based on the background color */
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>

<h2>Application Information</h2>

<!-- Display user information or unauthenticated message -->
<?php if ($username !== "Not Authenticated") : ?>
    <p>Welcome, <?php echo $username; ?>!</p>
    <p>Login Time: <?php echo ($loginTime) ? date('Y-m-d H:i:s', $loginTime) : 'N/A'; ?></p>
<?php else : ?>
    <p>Welcome!</p>
    <p>You are currently browsing without authentication.</p>
<?php endif; ?>

<!-- Application information -->
<p>This is a simple web application that allows users to log in and access different pages based on their authentication status.</p>

<!-- Link to return to the home page -->
<p><a href="aplicacion.php">Return to Home Page</a></p>

</body>
</html>
