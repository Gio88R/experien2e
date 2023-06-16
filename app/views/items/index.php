<?php
require_once __DIR__ . '/../../models/Item.php';
require_once __DIR__ . '/../../partials/connect.php';
require_once __DIR__ . '/../../controllers/ItemController.php';
$itemController = new ItemController();
$items = $itemController->getAllItems();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Plagg</title>
</head>
<body>
  <h1>Plagg</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Namn</th>
        <th>Färg</th>
        <th>Varumärke</th>
        <th>Säljar-ID</th>
        <th>Såld</th>
      </tr>
    </thead>
    <tbody>
      <!-- Loopa igenom plagg och visa i tabellen -->
<?php if (isset($items) && !empty($items)): ?>
  <?php foreach ($items as $item): ?>
    <tr>
      <td><?php echo $item->item_id; ?></td>
      <td><?php echo $item->name; ?></td>
      <td><?php echo $item->color; ?></td>
      <td><?php echo $item->brand; ?></td>
      <td><?php echo $item->sellerId; ?></td>
      <td><?php echo ($item->sold ? 'Ja' : 'Nej'); ?></td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr>
    <td colspan="6">Inga plagg tillgängliga.</td>
  </tr>
<?php endif; ?>

    </tbody>
  </table>
</body>
</html>
