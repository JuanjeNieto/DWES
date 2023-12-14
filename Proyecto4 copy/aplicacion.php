<?php
session_start();
include 'functions.php'; // Include the functions.php file

// Check if the user is authenticated, if not, redirect to index.php
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Get user information from the session
$username = $_SESSION["username"];
$loginTime = $_SESSION["login_time"];

// Get the background color dynamically
$backgroundColor = getBackgroundColor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Page</title>
    <style>
        /* Add a dynamic class to the body based on the background color */
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>

<h2>Welcome, <?php echo $username; ?>!</h2>
<p>Login Time: <?php echo date('Y-m-d H:i:s', $loginTime); ?></p>

<!-- Navigation menu -->
<ul>
    <li><a href="informacion.php">Information</a></li>
    <li><a href="preferencias.php">Preferences</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
