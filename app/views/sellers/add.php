<?php
require_once __DIR__ . '/../../controllers/SellerController.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Seller</title>
</head>
<body>
  <h1>Add Seller</h1>
  <form action="index.php?action=add" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" id="lastname" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="mobile">Mobile:</label>
    <input type="text" name="mobile" id="mobile" required><br>

    <!-- Add more input fields for other seller attributes such as address, city, etc. -->

    <button type="submit">Add Seller</button>
  </form>
</body>
</html>
