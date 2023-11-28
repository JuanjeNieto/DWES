<?php
// Establish the database connection using PDO
function connectDB() {
    // Enable error reporting for debugging purposes
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $servername = "localhost";
    $username = "dwes";
    $password = "dwes";
    $dbname = "tarea4";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
?>
