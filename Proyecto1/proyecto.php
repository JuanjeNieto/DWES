<?php 
    session_start();

    include("functions.php");

    if (!isset($_SESSION["shopping-list"])) {
        $_SESSION["shopping_list"]= [];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'insert') {
                insertItem($_POST['name'], $_POST['quantity'], $_POST['price']);
            } elseif ($_POST['action'] === 'modify') {
                modifyItem($_POST['index'], $_POST['name'], $_POST['quantity'], $_POST['price']);
            } elseif ($_POST['action'] === 'delete') {
                deleteItem($_POST['index']);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Shopping List</h1>

    <h2>Menu:</h2>
    <ul>
        <li><a href="?page=show">Show List</a></li>
        <li><a href="?page=insert">Insert</a></li>
        <li><a href="?page=modify">Modify</a></li>
        <li><a href="?page=delete">Delete</a></li>
    </ul>

    <?php 
    
         if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page === 'show') {
                displayShoppingList();
            } elseif ($page === 'insert') {
                include 'insert.php';
            } elseif ($page === 'modify') {
                include 'modify.php';
            } elseif ($page === 'delete') {
                include 'delete.php';
            }
        }
    
    ?>
</body>
</html>