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
            <td><?php echo $item->getItemId(); ?></td>
            <td><?php echo $item->getName(); ?></td>
            <td><?php echo $item->getColor(); ?></td>
            <td><?php echo $item->getBrand(); ?></td>
            <td><?php echo $item->getSellerId(); ?></td>
            <td><?php echo ($item->isSold() ? 'Ja' : 'Nej'); ?></td>
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
