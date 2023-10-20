<h2>Modify Item</h2>
<form method="post">
    <input type="hidden" name="action" value="modify">
    <?php
    if (isset($_GET['index']) && isset($_SESSION['shopping_list'][$_GET['index']])) {
        $item = $_SESSION['shopping_list'][$_GET['index']];
        echo "<input type='hidden' name='index' value='{$_GET['index']}'>";
        echo "Name: <input type='text' name='name' value='{$item['name']}' required><br>";
        echo "Quantity: <input type='number' name='quantity' value='{$item['quantity']}' required><br>";
        echo "Price: <input type='number' step='0.01' name='price' value='{$item['price']}' required><br>";
        echo "<input type='submit' value='Modify'>";
    } else {
        echo "Invalid item index.";
    }
    ?>
</form>
