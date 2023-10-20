<?php

function insertItem($name, $quantity, $price) {
    if (!empty($name)) {
        $item = [
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ];
        $_SESSION['shopping_list'][] = $item;
    } else {
        echo "Name is mandatory. Item not added.";
    }
}

function modifyItem($index, $name, $quantity, $price) {
    if (!empty($name)) {
        $_SESSION['shopping_list'][$index] = [
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ];
    } else {
        echo "Name is mandatory. Item not modified.";
    }
}

function deleteItem($index) {
    unset($_SESSION['shopping_list'][$index]);
    $_SESSION['shopping_list'] = array_values($_SESSION['shopping_list']);
}

function calculateTotalPriceProduct($quantity, $price, &$total) {
    $total = $quantity * $price;
}

function calculateTotalPurchasePrice() {
    $totalPurchasePrice = 0;
    foreach ($_SESSION['shopping_list'] as $item) {
        $totalPurchasePrice += $item['quantity'] * $item['price'];
    }
    return $totalPurchasePrice;
}

function displayShoppingList() {
    if (!empty($_SESSION['shopping_list'])) {
        echo "<h2>Shopping List</h2>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr";

        foreach ($_SESSION['shopping_list'] as $index => $item) {
            $total = 0;
            calculateTotalPriceProduct($item['quantity'], $item['price'], $total);
            $totalFormatted = number_format($total, 2); // Format as a currency (e.g., 2 decimal places)

            echo "<tr>";
            echo "<td>{$item['name']}</td>";
            echo "<td>{$item['quantity']}</td>";
            echo "<td>{$item['price']}</td>";
            echo "<td>{$totalFormatted}</td>";
            echo "<td><a href='?page=modify&index=$index'>Modify</a></td>";
            echo "<td><a href='?page=delete&index=$index'>Delete</a></td>";
            echo "</tr>";
        }

        $totalPurchasePrice = calculateTotalPurchasePrice();
        $totalPurchasePriceFormatted = number_format($totalPurchasePrice, 2); // Format as a currency

        echo "<tr><td colspan='3'><b>Total Purchase Price:</b></td><td><b>{$totalPurchasePriceFormatted}</b></td></tr>";
        echo "</table>";
    } else {
        echo "Shopping list is empty.";
    }
}


?>
