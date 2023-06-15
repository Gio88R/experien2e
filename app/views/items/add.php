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

    <!-- Add more input fields for other item attributes such as color, brand, etc. -->

    <button type="submit">Add Item</button>
  </form>
</body>
</html>
