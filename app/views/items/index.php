<?php
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
        <th>Åtgärder</th>
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
        <td><?php echo $item->last_updated; ?></td>
        <td>
          <form action="index.php?action=updateStatus" method="POST">
            <input type="hidden" name="itemId" value="<?php echo $item->item_id; ?>">
            <select name="status" onchange="this.form.submit()">
              <option value="0" <?php echo ($item->sold == 0 ? 'selected' : ''); ?>>Nej</option>
              <option value="1" <?php echo ($item->sold == 1 ? 'selected' : ''); ?>>Ja</option>
            </select>
          </form>
        </td>
        <td>
          <a href="index.php?action=edit&itemId=<?php echo $item->item_id; ?>">Redigera</a>
          <a href="index.php?action=delete&itemId=<?php echo $item->item_id; ?>">Ta bort</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="8">Inga plagg tillgängliga.</td>
    </tr>
  <?php endif; ?>
</tbody>
  </table>
</body>
</html>
