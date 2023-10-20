<h2>Insert Item</h2>

<form method="post">
    <input type="hidden" name="action" value="insert">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" step="1" min="1" required><br>
    <label for="price">Price (USD):</label>
    <input type="number" step="0.01" name="price" min="0.01" required><br>
    <input type="submit" value="Insert">
</form>
