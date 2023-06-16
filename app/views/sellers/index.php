<?php
require_once __DIR__ . '/../../controllers/SellerController.php';
$sellerModel = new SellerModel();
$sellers = $sellerModel->getAllSellers();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Säljare</title>
</head>
<body>
  <h1>Säljare</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Mobile</th>
      </tr>
    </thead>
    <tbody>
      <!-- Loopa igenom säljare och visa i tabellen -->
      <?php if (isset($sellers) && !empty($sellers)): ?>
        <?php foreach ($sellers as $seller): ?>
          <tr>
            <td><?php echo $seller->getId(); ?></td>
            <td><?php echo $seller->getName(); ?></td>
            <td><?php echo $seller->getLastname(); ?></td>
            <td><?php echo $seller->getEmail(); ?></td>
            <td><?php echo $seller->getMobile(); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3">Inga säljare tillgängliga.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
