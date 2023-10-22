<link rel="stylesheet" type="text/css" href="styles.css">

<?php
// Start a PHP session
session_start();

// Initialize the shopping list array in the session if it doesn't exist
if (!isset($_SESSION['lista'])) {
    $_SESSION['lista'] = array();
}

// This function displays the shopping list in a table or notifies the user if it is empty
function mostrar_lista() {
    $lista = $_SESSION['lista'];

    // Check if the list is empty
    if (empty($lista)) {
        // Display a message that there is nothing to show
        echo "<p>There is nothing to show in the shopping list.</p>";
    } else {
        // Display the list in a table with four columns: Name, Quantity, Price, Total
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Quantity</th>";
        echo "<th>Price</th>";
        echo "<th>Total</th>";
        echo "<th>Modify</th>";
        echo "<th>Delete</th>";
        echo "</tr>";

        // Initialize a variable to store the total purchase price
        $total_compra = 0;

        // Loop through each item in the list and display its information in a row
        foreach ($lista as $indice => $item) {
            // Get the name, quantity, and price of the item
            $nombre = $item['nombre'];
            $cantidad = $item['cantidad'];
            $precio = $item['precio'];

            // Calculate the total price of the item
            $total_producto = $cantidad * $precio;

            // Add the total price of the item to the total purchase price
            $total_compra += $total_producto;

            // Display the information of the item in a row
            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>$cantidad</td>";
            echo "<td>$precio</td>";
            echo "<td>$total_producto</td>";
            echo "<td><a href='?opcion=modificar&indice=$indice'>Modify</a></td>";
            echo "<td><a href='?opcion=eliminar&indice=$indice'>Delete</a></td>";
            echo "</tr>";
        }

        // Display the total purchase price at the end of the table
        echo "<tr>";
        echo "<td colspan='3'>Total Purchase Price</td>";
        echo "<td>$total_compra</td>";
        echo "</tr>";

        // Close the table tag
        echo "</table>";
    }
}

// This function inserts a new item to the shopping list
function insertar_item() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        if (!empty($nombre)) {
            $nuevo_item = array(
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio' => $precio,
            );

            $_SESSION['lista'][] = $nuevo_item;

            echo "<p>The item $nombre has been added to the shopping list.</p>";
        } else {
            echo "<p>The name field is mandatory, please enter a valid name.</p>";
        }
    }

    mostrar_formulario_insertar();
}

// This function displays the form to request the information of the new item
function mostrar_formulario_insertar() {
    echo "<form action='' method='POST'>";
    echo "<p>Please enter the information of the new item:</p>";
    echo "<p>Name: <input type='text' name='nombre'></p>";
    echo "<p>Quantity: <input type='number' name='cantidad'></p>";
    echo "<p>Price: <input type='number' name='precio'></p>";
    echo "<p><input type='submit' name='submit' value='Insert'></p>";
    echo "</form>";
}

// This function modifies an existing item in the shopping list
function modificar_item() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $indice = $_POST['indice'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        if (!empty($nombre)) {
            $_SESSION['lista'][$indice]['nombre'] = $nombre;
            $_SESSION['lista'][$indice]['cantidad'] = $cantidad;
            $_SESSION['lista'][$indice]['precio'] = $precio;

            echo "<p>The item $nombre has been modified in the shopping list.</p>";
        } else {
            echo "<p>The name field is mandatory, please enter a valid name.</p>";
        }
    }

    mostrar_formulario_modificar();
}

// This function displays the form to request the information of the modified item
function mostrar_formulario_modificar() {
    if (isset($_GET['indice'])) {
        $indice = $_GET['indice'];

        if (is_numeric($indice) && isset($_SESSION['lista'][$indice])) {
            $nombre = $_SESSION['lista'][$indice]['nombre'];
            $cantidad = $_SESSION['lista'][$indice]['cantidad'];
            $precio = $_SESSION['lista'][$indice]['precio'];

            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='indice' value='$indice'>";
            echo "<p>Please enter the information of the modified item:</p>";
            echo "<p>Name: <input type='text' name='nombre' value='$nombre'></p>";
            echo "<p>Quantity: <input type='number' name='cantidad' value='$cantidad'></p>";
            echo "<p>Price: <input type='number' name='precio' value='$precio'></p>";
            echo "<p><input type='submit' name='submit' value='Modify'></p>";
            echo "</form>";
        } else {
            echo "<p>Invalid index, please choose a valid one.</p>";
        }
    } else {
        echo "<p>Please choose an item to modify from the shopping list:</p>";

        foreach ($_SESSION['lista'] as $indice => $item) {
            $nombre = $item['nombre'];
            echo "<p><a href='?opcion=modificar&indice=$indice'>$nombre</a></p>";
        }
    }
}

// This function deletes an item from the shopping list
function eliminar_item() {
    if (isset($_GET['indice'])) {
        $indice = $_GET['indice'];

        if (is_numeric($indice) && isset($_SESSION['lista'][$indice])) {
            $nombre = $_SESSION['lista'][$indice]['nombre'];
            unset($_SESSION['lista'][$indice]);

            echo "<p>The item $nombre has been deleted from the shopping list.</p>";
        } else {
            echo "<p>Invalid index, please choose a valid one.</p>";
        }
    } else {
        echo "<p>Please choose an item to delete from the shopping list:</p>";

        foreach ($_SESSION['lista'] as $indice => $item) {
            $nombre = $item['nombre'];
            echo "<p><a href='?opcion=eliminar&indice=$indice'>$nombre</a></p>";
        }
    }
}

// Display a welcome message and the menu options
echo "<h1>Juanje Shopping S.A.</h1>";
echo "<p>Please choose one of the following options:</p>";
echo "<ul>";
echo "<li><a href='?opcion=mostrar'>Show List</a></li>";
echo "<li><a href='?opcion=insertar'>Insert</a></li>";
echo "<li><a href='?opcion=modificar'>Modify</a></li>";
echo "<li><a href='?opcion=eliminar'>Delete</a></li>";
echo "</ul>";

// Call the appropriate function based on the selected option
if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];

    switch ($opcion) {
        case 'mostrar':
            mostrar_lista();
            break;
        case 'insertar':
            insertar_item();
            break;
        case 'modificar':
            modificar_item();
            break;
        case 'eliminar':
            eliminar_item();
            break;
        default:
            echo "<p>Invalid option, please choose a valid one.</p>";
    }
}
?>
