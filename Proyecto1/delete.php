<h2>Delete Item</h2>
<form method="post">
    <input type="hidden" name="action" value="delete">
    <?php
    if (isset($_GET['index']) && isset($_SESSION['shopping_list']) && isset($_SESSION['shopping_list'][$_GET['index']])) {
        echo "<input type='hidden' name='index' value='{$_GET['index']}'>";
        echo "Are you sure you want to delete this item?<br>";
        echo "<input type='submit' value='Delete'>";
    } else {
        echo "Invalid item index.";
    }
    ?>
</form>
s