<?php
// Establish the database connection using PDO
function connectDB() {
    // Enable error reporting for debugging purposes
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $servername = "localhost";
    $dbusername = "dwes";
    $dbpassword = "dwes";
    $dbname = "tarea4";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        die("Error connecting to the database: " . $e->getMessage());
    }
}

// Check the existence of a user in the database
function verifyUser($username, $password) {
    $conn = connectDB();

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify if the user exists and the password is correct
    if ($user && password_verify($password, $user['pwd'])) {
        return true;
    } else {
        return false;
    }
}

function getBackgroundColor() {
    if (isset($_SESSION["username"])) {
        return isset($_COOKIE["background_color_" . $_SESSION["username"]]) ? $_COOKIE["background_color_" . $_SESSION["username"]] : "white";
    } else {
        return "white"; // Default background color if not logged in
    }
}

function setBackgroundColor($color) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
        setcookie("background_color_" . $_SESSION["username"], $color, time() + (86400 * 30), "/");
    }
}

function resetBackgroundColor() {
    if (isset($_POST["reset_preferences"]) && isset($_SESSION["username"])) {
        setcookie("background_color_" . $_SESSION["username"], "", time() - 3600, "/");
    }
}

?>

