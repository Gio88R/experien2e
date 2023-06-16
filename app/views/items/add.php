<?php
require_once __DIR__ . '/../../controllers/ItemController.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Item</title>
</head>
<body>
  <h1>Add Item</h1>
  <form action="index.php?action=add" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="sellerId">Seller ID:</label>
    <input type="number" name="sellerId" id="sellerId" required><br>

    <label for="color">Color:</label>
    <input type="text" name="color" id="color" required><br>

    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand" required><br>


    <button type="submit">Add Item</button>
  </form>
</body>
</html>

