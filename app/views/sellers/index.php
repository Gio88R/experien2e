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
        <th>Namn</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <!-- Loopa igenom säljare och visa i tabellen -->
      <?php if (isset($sellers) && !empty($sellers)): ?>
        <?php foreach ($sellers as $seller): ?>
          <tr>
            <td><?php echo $seller->getSellerId(); ?></td>
            <td><?php echo $seller->getName(); ?></td>
            <td><?php echo $seller->getEmail(); ?></td>
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
